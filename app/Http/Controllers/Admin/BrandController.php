<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.brandindex',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.addbrand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $brandData = $request->validate([
                'name'=>['required'],
                'slug'=>['required','unique:brands'],
                'active'=>['required'],
                'brandThumb'=>['required','mimes:png,jpg,jpeg,gif']
            ]);

            if($request->file('brandThumb')->isValid()){
                $brandData['brandThumb'] = $this->uploadImage($request->name,$request->brandThumb);
            }

            $storeBrand = new Brand();

            $storeBrand->name = $brandData['name'];
            $storeBrand->slug = $brandData['slug'];
            $storeBrand->active = $brandData['active'];
            $storeBrand->thumb_img = $brandData['brandThumb'];
            $storeBrand->description = $request->description;

            $storeBrand->save();

        }catch (QueryException $e){
            dd($e->getMessage());
        }

        return redirect()->route('brands.index')->with(['msg'=>['alertKey'=>'success','message'=>'Brand Added Successfully']]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);

        if($brand){
            return view('admin.brands.updatebrand',compact('brand'));
        }else{
            return redirect()->route('brands.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        try {

            if($request->slug == $brand->slug){

                $brandData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required'],
                    'active'=>['required'],
                ]);
            }else{
                $brandData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required','unique:brands'],
                    'active'=>['required'],
                ]);
            }

            if($request->file('brandThumb') == null){
                $brandData['brandThumb'] = $brand->thumb_img;
            }else{
                $brandData['brandThumb'] = $request->validate([
                    'brandThumb'=>['required','mimes:png,jpg,jpeg,gif']
                ]);
            }

            if($request->file('brandThumb') !== null){
                $brandData['brandThumb'] = $this->uploadImage($request->name,$request->brandThumb);
            }

            $brand->name = $brandData['name'];
            $brand->slug = $brandData['slug'];
            $brand->active = $brandData['active'];
            $brand->thumb_img = $brandData['brandThumb'];
            $brand->description = $request->description;

            $brand->save();

            return redirect()->route('brands.index')->with(['msg'=>['alertKey'=>'info','message'=>'Brand Updated Successfully']]);

        }catch (QueryException $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if($brand){
            $brand->delete();

            return redirect()->route('brands.index')->with(['msg'=>['alertKey'=>'danger','message'=>'Brand Deleted Successfully']]);
        }
        return redirect()->route('brands.index');
    }

    //Image Upload
    public function uploadImage($name, $image)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$name. '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path().'/app/public/brands/';

        if(!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }

        Image::make($image)->resize(600,400)->save($pathToUpload.$file_name);

        return $file_name;
    }
}
