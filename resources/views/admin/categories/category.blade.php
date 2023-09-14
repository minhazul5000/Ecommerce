@extends('layouts.MasterAdmin')

@section('title')
    Admin || Category
@endsection
@section('pageTitle')
    Category
@endsection


@section('content')
    <!-- Button trigger modal -->
    <a href="{{route('addCategory')}}" class="btn btn-primary mb-3">
        Add Category
    </a>

    <!-- Category List -->
    <div class="container">
        <table class="table table-bordered table-light">
            <thead >
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Desktop</td>
                <td>desktop</td>
                <td>Desktop product</td>
                <td>1</td>
                <td>
                    <a href="#" class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-danger text-white">Delete</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
