@extends('layouts.MasterAdmin')

@section('title')
    Admin || Proudcts
@endsection
@section('pageTitle')
    Proudcts
@endsection


@section('content')
    <!-- Button trigger modal -->
    <a href="{{route('products.create')}}" class="btn btn-primary mb-3">
        Add Product
    </a>

    <!-- Category List -->
    <div class="container">
        @if(session()->has('msg'))
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-{{session()->get('msg')['alertKey']}} d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div>
                    <strong>{{ucfirst(session()->get('msg')['alertKey'])}}!</strong> {{session()->get('msg')['message']}}
                </div>
            </div>

        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-light">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Regular Price</th>
                    <th>Active</th>
                    <th>Status</th>
                    <th>Summary</th>
                    <th>Specification</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @isset($products)
                @php
                    $serial = 1;
                @endphp
                @foreach($products as $product)
                    <tr>
                        <td>{{$serial}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->slug}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->model}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->regular_price}}</td>
                        <td>@if($product->active == 1){{'Yes'}} @else {{'No'}} @endif</td>
                        <td>{{$product->status}}</td>
                        <td>{!!substr($product->summary,0,100)!!}</td>
                        <td>{{substr($product->specification,0,50)}}</td>
                        <td>{!!substr($product->description,0,100) !!}</td>
                        <td>
                            <img src="{{asset('storage/products/'.$product->product_img)}}" width="50px" alt="">
                        </td>
                        <td>
                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-info">Edit</a>
                            <form class="d-inline" action="{{route('products.destroy',$product->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $serial++;
                    @endphp
                @endforeach
            @endisset

            </tbody>
        </table>
        </div>
    </div>
@endsection
