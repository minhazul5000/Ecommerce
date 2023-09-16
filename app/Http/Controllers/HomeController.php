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

    public function viewCategoryProduct($cat=null,$subcat=null)
    {
        if(isset($cat) && isset($subcat)){
            return view('frontend.categoryView',['breadcrumb'=>['category'=>$cat,'subcategory'=>$subcat]]);
        }elseif(isset($cat)){
            return view('frontend.categoryView');
        }else{
            abort(404);
        }

    }
}
