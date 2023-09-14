<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategory()
    {
        return view('admin.categories.category');
    }

    public function addCategory(Request $request)
    {
        if($request->method() == 'POST'){
            $categoryData = $request->validate([
                'name'=>['required'],
                'slug'=>['required'],
                'description'=>[],
                'active'=>[]
            ]);

            Category::create($categoryData);

            return redirect()->route('showCategory');
        }

        return view('admin.categories.addCategory');
    }
}
