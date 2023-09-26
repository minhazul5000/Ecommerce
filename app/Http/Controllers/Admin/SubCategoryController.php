<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();

        return view('admin.subcategories.subcategoryindex',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.subcategories.addSubCategory',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $subCategoryData = $request->validate([
                'name'=>['required'],
                'slug'=>['required','unique:subcategories'],
                'category_id'=>['required'],
                'description'=>[],
                'active'=>['required'],
                'feature'=>['required'],
                'subCatThumb'=>['required','mimes:png,jpg,jpeg,gif']
            ]);

            if($request->file('subCatThumb')->isValid()){
                $subCategoryData['subCatThumb'] = $this->uploadImage($request->name,$request->subCatThumb);
            }

            $storeSubCat = new Subcategory();

            $storeSubCat->name = $subCategoryData['name'];
            $storeSubCat->slug = $subCategoryData['slug'];
            $storeSubCat->description = $subCategoryData['description'];
            $storeSubCat->active = $subCategoryData['active'];
            $storeSubCat->thumb_img = $subCategoryData['subCatThumb'];
            $storeSubCat->feature = $subCategoryData['feature'];
            $storeSubCat->category_id = $subCategoryData['category_id'];

            $storeSubCat->save();

        }catch (QueryException $e){
            dd($e->getMessage());
        }

        return redirect()->route('sub-categories.index')->with(['msg'=>['alertKey'=>'success','message'=>'Sub Category Added Successfully']]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::with('category')->find($id);

        return view('admin.subcategories.updateSubCategory',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = Subcategory::with('category')->find($id);

        try {
            if($request->slug == $subcategory->slug){
                $subcategoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required'],
                    'active'=>['required'],
                    'feature'=>['required'],
                    'category_id'=>['required']
                ]);
            }else{
                $subcategoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required','unique:subcategories'],
                    'active'=>['required'],
                    'feature'=>['required'],
                    'category_id'=>['required']
                ]);
            }

            if($request->file('subCatThumb') == null){
                $subcategoryData['subCatThumb'] = $subcategory->thumb_img;
            }else{
                $subcategoryData['subCatThumb'] = $request->validate([
                    'subCatThumb'=>['required','mimes:png,jpg,jpeg,gif']
                ]);
            }

            if($request->file('subCatThumb') !== null){
                $subcategoryData['subCatThumb'] = $this->uploadImage($request->name,$request->subCatThumb);
            }

            $subcategory->name = $subcategoryData['name'];
            $subcategory->slug = $subcategoryData['slug'];
            $subcategory->description = $request->description;
            $subcategory->active = $subcategoryData['active'];
            $subcategory->feature = $subcategoryData['feature'];
            $subcategory->category_id = $subcategoryData['category_id'];
            $subcategory->thumb_img = $subcategoryData['subCatThumb'];

            $subcategory->save();

            return redirect()->route('sub-categories.index')->with(['msg'=>['alertKey'=>'info','message'=>'Sub Category Updated Successfully']]);

        }catch (QueryException $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::find($id);

        $subcategory->delete();

        return redirect()->route('sub-categories.index')->with(['msg'=>['alertKey'=>'danger','message'=>'Sub Category Deleted Successfully']]);
    }

    //Image Upload
    public function uploadImage($name, $image)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$name. '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path().'/app/public/subcategories/';

        if(!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }

        Image::make($image)->resize(600,400)->save($pathToUpload.$file_name);

        return $file_name;
    }
}
