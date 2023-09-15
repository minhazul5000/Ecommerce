<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function frontendDashboard()
    {
        return view('frontend.frontendDashboard');
    }

    public function viewCategoryProduct($cat='',$subcat='')
    {
        if(!empty($cat)){
            return view('frontend.categoryView');
        }

    }
}
