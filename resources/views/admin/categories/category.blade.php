@extends('layouts.MasterAdmin')

@section('title')
    Admin || Category
@endsection
@section('pageTitle')
    Category
@endsection


@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>

    <!-- Category List -->
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




    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
