<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category','subcategory','brand'])->get();

        return view('admin.products.productindex',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();

        return view('admin.products.addproduct',compact('categories','subcategories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = $request->validate([
                'name'=>['required'],
                'slug'=>['required','unique:products'],
                'category'=>['required'],
                'subcategory'=>['required'],
                'brand'=>['required'],
                'model'=>['required'],
                'price'=>['required'],
                'regularprice'=>['required'],
                'active'=>['required'],
                'status'=>['required'],
                'summary'=>['required'],
                'specification'=>['required'],
                'description'=>['required'],
                'product_thumb'=>['required','mimes:jpg,jpeg,png,gif,webp'],
            ]);

            if($request->file('product_thumb')->isValid()){
                $product['product_thumb'] = $this->uploadImage($request->product_thumb->getClientOriginalName(),$request->product_thumb);
            }

            $productmodel = new Product();

            $productmodel->name = $product['name'];
            $productmodel->slug = $product['slug'];
            $productmodel->category_id = $product['category'];
            $productmodel->subcategory_id = $product['subcategory'];
            $productmodel->brand_id = $product['brand'];
            $productmodel->model = $product['model'];
            $productmodel->price = $product['price'];
            $productmodel->regular_price = $product['regularprice'];
            $productmodel->active = $product['active'];
            $productmodel->status = $product['status'];
            $productmodel->summary = $product['summary'];
            $productmodel->specification = $product['specification'];
            $productmodel->description = $product['description'];
            $productmodel->product_img = $product['product_thumb'];

            $productmodel->save();

        }catch (QueryException $e){
            dd($e->getMessage());
        }

        return redirect()->route('products.index')->with(['msg'=>['alertKey'=>'success','message'=>'Product Added Successfully']]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['category','subcategory','brand'])->find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();

        return view('admin.products.editproduct',compact('product','categories','subcategories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        try {
            if($request->slug == $product->slug){
                $productdata = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required'],
                    'category'=>['required'],
                    'subcategory'=>['required'],
                    'brand'=>['required'],
                    'model'=>['required'],
                    'price'=>['required'],
                    'regularprice'=>['required'],
                    'active'=>['required'],
                    'status'=>['required'],
                    'summary'=>['required'],
                    'specification'=>['required'],
                    'description'=>['required'],
                ]);
            }else{
                $productdata = $request->validate([
                    'name'=>['required'],
                    'slug'=>['required','unique:products'],
                    'category'=>['required'],
                    'subcategory'=>['required'],
                    'brand'=>['required'],
                    'model'=>['required'],
                    'price'=>['required'],
                    'regularprice'=>['required'],
                    'active'=>['required'],
                    'status'=>['required'],
                    'summary'=>['required'],
                    'specification'=>['required'],
                    'description'=>['required'],
                ]);
            }

            if($request->file('product_thumb') == null){
                $productdata['product_thumb'] = $product->product_img;
            }else{
                $productdata['product_thumb'] = $request->validate([
                    'product_thumb'=>['required','mimes:png,jpg,jpeg,gif,webp']
                ]);
            }

            if($request->file('product_thumb') !== null){
                $productdata['product_thumb'] = $this->uploadImage($request->product_thumb->getClientOriginalName(),$request->product_thumb);
            }

            $product->name = $productdata['name'];
            $product->slug = $productdata['slug'];
            $product->category_id = $productdata['category'];
            $product->subcategory_id = $productdata['subcategory'];
            $product->brand_id = $productdata['brand'];
            $product->model = $productdata['model'];
            $product->price = $productdata['price'];
            $product->regular_price = $productdata['regularprice'];
            $product->active = $productdata['active'];
            $product->status = $productdata['status'];
            $product->summary = $productdata['summary'];
            $product->specification = $productdata['specification'];
            $product->description = $productdata['description'];
            $product->product_img = $productdata['product_thumb'];

            $product->save();

            return redirect()->route('products.index')->with(['msg'=>['alertKey'=>'info','message'=>'Product Updated Successfully']]);

        }catch (QueryException $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if($product){
            $product->delete();

            return redirect()->route('products.index')->with(['msg'=>['alertKey'=>'danger','message'=>'Product Deleted Successfully']]);
        }
        return redirect()->route('products.index');
    }

    //Image Upload
    public function uploadImage($name, $image)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$name. '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path().'/app/public/products/';

        if(!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }


        Image::make($image)->resize(500,500)->save($pathToUpload.$file_name);

        return $file_name;
    }
}
