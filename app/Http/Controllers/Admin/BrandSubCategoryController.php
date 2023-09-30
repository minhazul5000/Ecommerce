<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandSubcategory;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class BrandSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandsubcategories = BrandSubcategory::with(['subcategory','brand'])->get();

        return view('admin.brandsubcategoryfilter.brandsubcategoryindex',compact('brandsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        $brands = Brand::all();

        return view('admin.brandsubcategoryfilter.addbrandsubcategory',compact('subcategories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subcategory'=>['required'],
            'brand'=>['required']
        ]);

        $brandsubcategorymodel = new BrandSubcategory();

        $brandsubcategorymodel->subcategory_id = $data['subcategory'];
        $brandsubcategorymodel->brand_id = $data['brand'];

        $brandsubcategorymodel->save();

        return redirect()->route('brand-subcategories.index')->with(['msg'=>['alertKey'=>'success','message'=>'Brand Subcategory Added Successfully']]);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brandsubcategory = BrandSubcategory::with(['subcategory','brand'])->find($id);
        $subcategories = Subcategory::all();
        $brands = Brand::all();

        return view('admin.brandsubcategoryfilter.updatebrandsubcategory',compact('subcategories','brands','brandsubcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brandsubcategorymodel = BrandSubcategory::find($id);

        $data = $request->validate([
            'subcategory'=>['required'],
            'brand'=>['required']
        ]);

        $brandsubcategorymodel->subcategory_id = $data['subcategory'];
        $brandsubcategorymodel->brand_id = $data['brand'];

        $brandsubcategorymodel->save();

        return redirect()->route('brand-subcategories.index')->with(['msg'=>['alertKey'=>'info','message'=>'Brand Subcategory Updated Successfully']]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brandsubcategorymodel = BrandSubcategory::find($id);
        $brandsubcategorymodel->delete();

        return redirect()->route('brand-subcategories.index')->with(['msg'=>['alertKey'=>'danger','message'=>'Brand Subcategory Deleted Successfully']]);
    }
}
