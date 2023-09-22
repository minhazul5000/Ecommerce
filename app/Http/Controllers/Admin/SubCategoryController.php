<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

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
                'active'=>['required']
            ]);

            Subcategory::create($subCategoryData);

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
                $categoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required'],
                    'description'=>[],
                    'active'=>['required'],
                    'category_id'=>['required']
                ]);
            }else{
                $categoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required','unique:subcategories'],
                    'description'=>[],
                    'active'=>['required'],
                    'category_id'=>['required']
                ]);
            }


            $subcategory->name = $categoryData['name'];

            $subcategory->slug = $categoryData['slug'];

            $subcategory->description = $categoryData['description'];
            $subcategory->active = $categoryData['active'];
            $subcategory->category_id = $categoryData['category_id'];

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
}
