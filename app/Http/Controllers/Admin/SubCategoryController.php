<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function showSubCategory()
    {

        return view('admin.categories.subCategory',['subcatsmodel'=>Subcategory::class]);
    }

    public function addSubCategory(Request $request)
    {
        $allcategory = Category::all();

        if($request->method() == 'POST'){
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

            return redirect()->route('showSubCategory')->with(['msg'=>['alertKey'=>'success','message'=>'Sub Category Added Successfully']]);
        }

        return view('admin.categories.addSubCategory',['categories'=>$allcategory]);
    }

    public function updateSubCategory(Request $request,$id)
    {
        $updatedRow = Subcategory::find($id);
        $allcategory = Category::all();

        if($request->method() == 'POST'){
            try {

                if($request->slug == $updatedRow->slug){
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


                $updatedRow->name = $categoryData['name'];

                $updatedRow->slug = $categoryData['slug'];

                $updatedRow->description = $categoryData['description'];
                $updatedRow->active = $categoryData['active'];
                $updatedRow->category_id = $categoryData['category_id'];

                $updatedRow->save();

                return redirect()->route('showSubCategory')->with(['msg'=>['alertKey'=>'info','message'=>'Sub Category Updated Successfully']]);

            }catch (QueryException $e){
                dd($e->getMessage());
            }


        }

        return view('admin.categories.updateSubCategory',['subcategory' => $updatedRow,'categories'=>$allcategory]);
    }


    public function deleteSubCategory(Request $request,$id)
    {
        $deleteSubCategory = Subcategory::find($id);

        $deleteSubCategory->delete();

        return redirect()->route('showSubCategory')->with(['msg'=>['alertKey'=>'danger','message'=>'Sub Category Deleted Successfully']]);
    }
}
