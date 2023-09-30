@extends('layouts.MasterFrontend')

@section('title')
    User || Dashboard
@endsection

@section('content')
    <div class="container text-center" style="margin:100px auto">
        <h3>Thank You For your Order.</h3>
        <h2 class="text-success">Your Order Placed Successfully!</h2>
        <script>
            localStorage.removeItem('cart');
        </script>
    </div>
@endsection
