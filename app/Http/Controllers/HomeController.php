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


    public function viewCategoryProduct($catslug=null,$subcatslug=null)
    {
        if(isset($catslug) && isset($subcatslug)){
            $subcat = Subcategory::with('brand')->where('slug','=',$subcatslug)->get()->first();
            $products = Product::with(['category','subcategory'])->where('subcategory_id','=',$subcat->id)->get();

            $brandfilter = true;
            $brands = $subcat->brand;

            if(count($products)){
                $breadcrumbs = [
                    ['name'=>$products[0]->category->name,'slug'=>$products[0]->category->slug],
                    ['name'=>$products[0]->subcategory->name,'slug'=>$products[0]->category->slug."/".$products[0]->subcategory->slug],
                ];
            }else{
                $breadcrumbs = [
                    ['name'=>$catslug,'slug'=>$catslug],
                    ['name'=>$subcatslug,'slug'=>$catslug."/".$subcatslug],
                ];
            }

            return view('frontend.categoryView',compact('products','brandfilter','brands','breadcrumbs'));

        }elseif(isset($catslug)){
            $cat = Category::where('slug','=',$catslug)->get('id')->first();
            $products = Product::where('category_id','=',$cat->id)->get();
            $brandfilter = false;

            if(count($products)){
                $breadcrumbs = [
                    ['name'=>$products[0]->category->name,'slug'=>$products[0]->category->slug]
                ];
            }else{
                $breadcrumbs = [
                    ['name'=>$catslug,'slug'=>$catslug]
                ];
            }

            return view('frontend.categoryView',compact('products','brandfilter','breadcrumbs'));
        }else {
            abort(404);
        }
    }

    public function productDetails($slug=null)
    {
        $product = Product::with(['category','subcategory'])->where('slug','=',$slug)->get()->first();

        if(!$product){
            abort(404);
        }

        $breadcrumbs = [
            ['name'=>$product->category->name,'slug'=>$product->category->slug],
            ['name'=>$product->subcategory->name,'slug'=>$product->category->slug.'/'.$product->subcategory->slug],
            ['name'=>$product->name,'slug'=>'products/'.$product->slug]
        ];

        return view('frontend.productdetails',compact('product','breadcrumbs'));
    }
}
