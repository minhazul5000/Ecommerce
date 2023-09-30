
@extends('layouts.MasterFrontend')

@section('title')
    User || Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1" style="margin-top: 40px;margin-bottom: 40px">
                <table class="table table-hover cart-table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <tbody class="cartoutput">

                        <input type="hidden" class="order" name="order" value="">
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h3>Total</h3></td>
                                <td class="text-right subtotal"><h3><strong>$31.53</strong></h3></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                    <a href="{{route('frontendDashboard')}}" type="button" class="btn btn-default">
                                         Continue Shopping
                                    </a></td>
                                <td>
                                    <button type="submit" class="btn btn-success">
                                        Checkout
                                    </button></td>
                            </tr>

                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>

@endsection
