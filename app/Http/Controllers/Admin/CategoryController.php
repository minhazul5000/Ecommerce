<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
                    'active'=>['required']
                ]);

                Category::create($categoryData);

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
                        'active'=>['required']
                    ]);
                }else{
                    $categoryData = $request->validate([
                        'name'=>['required'],
                        'slug'=>['required','unique:categories'],
                        'description'=>[],
                        'active'=>['required']
                    ]);
                }


                $updatedRow->name = $categoryData['name'];

                $updatedRow->slug = $categoryData['slug'];

                $updatedRow->description = $categoryData['description'];
                $updatedRow->active = $categoryData['active'];

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
}
