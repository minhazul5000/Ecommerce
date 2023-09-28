@extends('layouts.MasterAdmin')

@section('title')
    Admin || Add Product
@endsection
@section('pageTitle')
    Add Product
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="{{route('products.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body bg-light">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                                       placeholder="Lenovo Ideapad l340">
                            </div>
                            @error('name')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-sm-3 text-end control-label col-form-label">
                                Slug (Route)</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" value="{{old('slug')}}"  class="form-control" id="slug"
                                       placeholder="lenovo-ideapad-l340">
                            </div>
                            @error('slug')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-3 text-end control-label col-form-label">
                                Category</label>
                            <div class="col-sm-9">
                                <select name="category" class="form-select" id="category">
                                    @isset($categories)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('category')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="subcategory" class="col-sm-3 text-end control-label col-form-label">
                                Subcategory</label>
                            <div class="col-sm-9">
                                <select name="subcategory" class="form-select" id="subcategory">
                                    @isset($subcategories)
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('subcategory')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-sm-3 text-end control-label col-form-label">
                                Brand</label>
                            <div class="col-sm-9">
                                <select name="brand" class="form-select" id="brand">
                                    @isset($brands)
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('brand')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="model"
                                   class="col-sm-3 text-end control-label col-form-label">Model</label>
                            <div class="col-sm-9">
                                <input type="text" name="model" value="{{old('model')}}" class="form-control" id="model"
                                       placeholder="Ideapad l340">
                            </div>
                            @error('model')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="price"
                                   class="col-sm-3 text-end control-label col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" name="price" value="{{old('price')}}" class="form-control" id="price"
                                       placeholder="13800">
                            </div>
                            @error('price')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="regularprice"
                                   class="col-sm-3 text-end control-label col-form-label">Regular Price</label>
                            <div class="col-sm-9">
                                <input type="text" name="regularprice" value="{{old('regularprice')}}" class="form-control" id="regularprice"
                                       placeholder="13800">
                            </div>
                            @error('regularprice')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-sm-3 text-end control-label col-form-label">
                                Active</label>
                            <div class="col-sm-9">
                                <select name="active" class="form-select" id="active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            @error('active')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-3 text-end control-label col-form-label">
                                Status</label>
                            <div class="col-sm-9">
                                <select name="status" class="form-select" id="status">
                                    <option value="instock" selected>In Stock</option>
                                    <option value="outofstock">Out of Stock</option>
                                </select>
                            </div>

                            @error('status')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="ckeditor1"
                                   class="col-sm-3 text-end control-label col-form-label">Summary</label>
                            <div class="col-sm-9">
                                <textarea name="summary" class="form-control" id="ckeditor1">{{old('summary')}}</textarea>
                            </div>
                            @error('summary')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="ckeditor2"
                                   class="col-sm-3 text-end control-label col-form-label">Specification</label>
                            <div class="col-sm-9">
                                <textarea name="specification" class="form-control" id="ckeditor2">{{old('specification')}}</textarea>
                            </div>
                            @error('specification')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="ckeditor3"
                                   class="col-sm-3 text-end control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="ckeditor3">{{old('specification')}}</textarea>
                            </div>
                            @error('description')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="product_thumb" class="col-sm-3 text-end control-label col-form-label">
                                Image</label>
                            <div class="col-sm-9">
                                <input type="file" id="product_thumb" class="form-control" name="product_thumb">
                            </div>

                            @error('product_thumb')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary addCatSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
