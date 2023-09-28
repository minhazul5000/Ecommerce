<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function frontendDashboard()
    {
        $featureCategory = Category::where('active','=',1)->where('feature','=',1)->get();
        $featureSubCategory = Subcategory::with('category')->where('active','=',1)->where('feature','=',1)->get();

        $newProducts = Product::with(['category','subcategory','brand'])->orderByDesc('created_at')->offset(0)->limit(10)->get();

        $featureList = array_merge(compact('featureCategory','featureSubCategory'));

        return view('frontend.frontendDashboard',compact('featureList','newProducts'));
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

    public function productDetails($slug=null)
    {
        $product = Product::where('slug','=',$slug)->get()->first();


        return view('frontend.productdetails',compact('product'));
    }
}
