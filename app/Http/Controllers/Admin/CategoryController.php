<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function showCategory()
    {
        $allcategory = Category::all();
        return view('admin.categories.category',['categories'=>$allcategory]);
    }

    public function addCategory(Request $request)
    {
        if($request->method() == 'POST'){
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

            return redirect()->route('showCategory')->with(['msg'=>['alertKey'=>'success','message'=>'Category Added Successfully']]);
        }

        return view('admin.categories.addCategory');
    }

    public function updateCategory(Request $request,$id)
    {
        $updatedRow = Category::find($id);


        if($request->method() == 'POST'){
            try {

                if($request->slug == $updatedRow->slug){
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
                    $categoryData['catThumb'] = $updatedRow->thumb_img;
                }else{
                    $categoryData['catThumb'] = $request->validate([
                        'catThumb'=>['required','mimes:png,jpeg,gif']
                    ]);
                }

                if($request->file('catThumb') !== null){
                    $categoryData['catThumb'] = $this->imageUpload($request);
                }

                $updatedRow->name = $categoryData['name'];
                $updatedRow->slug = $categoryData['slug'];
                $updatedRow->description = $categoryData['description'];
                $updatedRow->active = $categoryData['active'];
                $updatedRow->thumb_img = $categoryData['catThumb'];
                $updatedRow->feature = $categoryData['feature'];

                $updatedRow->save();

                return redirect()->route('showCategory')->with(['msg'=>['alertKey'=>'info','message'=>'Category Updated Successfully']]);

            }catch (QueryException $e){
                dd($e->getMessage());
            }


        }

        return view('admin.categories.updatecategory',['category' => $updatedRow]);
    }


    public function deleteCategory(Request $request,$id)
    {
        $deleteCategory = Category::find($id);

        $deleteCategory->delete();

        return redirect()->route('showCategory')->with(['msg'=>['alertKey'=>'danger','message'=>'Category Deleted Successfully']]);
    }

    public function imageUpload(Request $request){
        $filename = substr(md5(time()),0,20).'.'.$request->catThumb->extension();

        $uploadedPath = 'Uploads/Category/'.$filename;

        $request->catThumb->move(public_path('Uploads/Category'),$uploadedPath);

        return $uploadedPath;
    }
}
