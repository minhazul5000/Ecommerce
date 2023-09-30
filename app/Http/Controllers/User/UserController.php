<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkout(Request $request)
    {


        $cart = json_decode($request->order);


        $orderId = substr(md5(time()),0,15);
        $userId = Auth::id();
        $status = 'pending';

        if(!$cart){
            abort(404);
        }
        $carts = $cart->cartProduct;

        foreach ($carts as $cart){
            $OrderModel = new Order();

            $OrderModel->user_id = $userId;
            $OrderModel->order_id = $orderId;
            $OrderModel->status = $status;
            $OrderModel->product_name = $cart->name;
            $pureslug = explode('/',$cart->slug);
            $pureslug = end($pureslug);
            $OrderModel->product_slug = $pureslug;

            //Get Product Image
            $product = Product::where('slug','=',$pureslug)->get()->first();

            $OrderModel->product_image = $product->product_img;
            $OrderModel->quantity = $cart->quantity;
            $OrderModel->price = $cart->price;
            $OrderModel->total_price = ($cart->price*$cart->quantity);

            $OrderModel->save();
        }


        return view('user.order.checkout');
    }


    public function orderList(){
        $user_id = Auth::id();

        $orders = Order::where('user_id','=',$user_id)->get();

        return view('user.order.orderList',compact('orders'));
    }
}
