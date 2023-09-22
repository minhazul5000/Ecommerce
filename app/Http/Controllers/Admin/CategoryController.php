<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.categoryindex',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categoryData = $request->validate([
                'name'=>['required'],
                'slug'=>['required','unique:categories'],
                'description'=>[],
                'active'=>['required'],
                'feature'=>['required'],
                'catThumb'=>['required','mimes:png,jpeg,gif']
            ]);

            if($request->file('catThumb')->isValid()){
                $categoryData['catThumb'] = $this->imageUpload($request);
            }

            $storeCat = new Category();
            $storeCat->name = $categoryData['name'];
            $storeCat->slug = $categoryData['slug'];
            $storeCat->description = $categoryData['description'];
            $storeCat->active = $categoryData['active'];
            $storeCat->thumb_img = $categoryData['catThumb'];
            $storeCat->feature = $categoryData['feature'];

            $storeCat->save();

        }catch (QueryException $e){
            dd($e->getMessage());
        }

        return redirect()->route('categories.index')->with(['msg'=>['alertKey'=>'success','message'=>'Category Added Successfully']]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        if($category){
            return view('admin.categories.updatecategory',compact('category'));
        }else{
            return redirect()->route('categories.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        try {
            if($request->slug == $category->slug){
                $categoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required'],
                    'description'=>[],
                    'active'=>['required'],
                    'feature'=>['required'],
                ]);
            }else{
                $categoryData = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required','unique:categories'],
                    'description'=>[],
                    'active'=>['required'],
                    'feature'=>['required'],
                ]);
            }

            if($request->file('catThumb') == null){
                $categoryData['catThumb'] = $category->thumb_img;
            }else{
                $categoryData['catThumb'] = $request->validate([
                    'catThumb'=>['required','mimes:png,jpeg,gif']
                ]);
            }

            if($request->file('catThumb') !== null){
                $categoryData['catThumb'] = $this->imageUpload($request);
            }

            $category->name = $categoryData['name'];
            $category->slug = $categoryData['slug'];
            $category->description = $categoryData['description'];
            $category->active = $categoryData['active'];
            $category->thumb_img = $categoryData['catThumb'];
            $category->feature = $categoryData['feature'];

            $category->save();

            return redirect()->route('categories.index')->with(['msg'=>['alertKey'=>'info','message'=>'Category Updated Successfully']]);

        }catch (QueryException $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if($category){
            $category->delete();

            return redirect()->route('categories.index')->with(['msg'=>['alertKey'=>'danger','message'=>'Category Deleted Successfully']]);
        }
        return redirect()->route('categories.index');
    }


    //Image Upload
    public function imageUpload(Request $request){
        $filename = substr(md5(time()),0,20).'.'.$request->catThumb->extension();

        $uploadedPath = 'Uploads/Category/'.$filename;

        $request->catThumb->move(public_path('Uploads/Category'),$uploadedPath);

        return $uploadedPath;
    }
}
