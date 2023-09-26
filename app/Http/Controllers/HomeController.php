<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function frontendDashboard()
    {
        $featureCategory = Category::where('active','=',1)->where('feature','=',1)->get();
        $featureSubCategory = Subcategory::with('category')->where('active','=',1)->where('feature','=',1)->get();

        $featureList = array_merge(compact('featureCategory','featureSubCategory'));

        return view('frontend.frontendDashboard',compact('featureList'));
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
