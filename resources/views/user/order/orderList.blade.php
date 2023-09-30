@extends('layouts.MasterFrontend')

@section('title')
    User || Dashboard
@endsection

@section('content')
    <div class="container" style="margin:90px auto">
        <h3>Order List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @isset($orders)
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>
                                <a href="{{asset('/products/')}}/{{$order->product_slug}}">{{$order->product_name}}</a>
                            </td>
                            <td>
                                <img width="70px" src="{{asset('storage/products/')}}/{{$order->product_image}}" alt="">
                            </td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>
                                <span class="badge">{{$order->status}}</span>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>

        </table>
    </div>
@endsection
