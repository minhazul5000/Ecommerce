<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function frontendDashboard()
    {
        $featureCategory = Category::where('feature',1)->get();
        $data = ['featureCategory'=>$featureCategory];

        return view('frontend.frontendDashboard',$data);
    }


    public function viewCategoryProduct($cat=null,$subcat=null)
    {
        if(isset($cat) && isset($subcat)){
            return view('frontend.categoryView',['breadcrumb'=>['category'=>$cat,'subcategory'=>$subcat]]);
        }elseif(isset($cat)){
            return view('frontend.categoryView');
        }else {
            abort(404);
        }
    }
}
