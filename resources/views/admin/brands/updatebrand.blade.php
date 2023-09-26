@extends('layouts.MasterAdmin')

@section('title')
    Admin || Edit Brand
@endsection
@section('pageTitle')
    Edit Brand
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="{{route('brands.update',$brand->id)}}" enctype="multipart/form-data" method="post" class="form-horizontal">
                @csrf
                @method('patch')
                <div class="modal-body bg-light">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$brand->name}}" class="form-control" id="name"
                                       placeholder="Electronics">
                            </div>
                            @error('name')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-sm-3 text-end control-label col-form-label">
                                Slug (Route)</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" value="{{$brand->slug}}"  class="form-control" id="slug"
                                       placeholder="elctronics">
                            </div>
                            @error('slug')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-3 text-end control-label col-form-label">
                                Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-select" id="category">
                                    @isset($categories)
                                        @foreach($categories as $category)
                                            @if($category->id == $brand->category->id)
                                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('category_id')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="subcategory" class="col-sm-3 text-end control-label col-form-label">
                                Sub Category</label>
                            <div class="col-sm-9">
                                <select name="subcategory_id" class="form-select" id="subcategory">
                                    @isset($subcategories)
                                        @foreach($subcategories as $subcategory)
                                            @if($subcategory->id == $brand->subcategory->id)
                                                <option selected value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @else
                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('subcategory_id')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-sm-3 text-end control-label col-form-label">
                                Active</label>
                            <div class="col-sm-9">
                                <select name="active" class="form-select" id="active">
                                    @if($brand->active == 1)
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>

                            @error('active')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="brandThumb" class="col-sm-3 text-end control-label col-form-label">
                                Thumbnail Image</label>
                            <div class="col-sm-9">
                                <input type="file" id="brandThumb" class="form-control" name="brandThumb">
                                <img src="{{asset('storage/brands/'.$brand->thumb_img)}}" width="50px" height="50px" alt="">
                            </div>

                            @error('brandThumb')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                   class="col-sm-3 text-end control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="description" name="description"  placeholder="Electronics product like mobile,desktop etc" class="form-control">{{$brand->description}}</textarea>
                            </div>
                            @error('description')
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
