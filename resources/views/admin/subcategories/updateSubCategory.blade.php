@extends('layouts.MasterAdmin')

@section('title')
    Admin || Update Sub Category
@endsection
@section('pageTitle')
    Update Sub Category
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="{{route('sub-categories.update',$subcategory->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body bg-light">

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$subcategory->name}}" class="form-control" id="name"
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
                                <input type="text" name="slug" value="{{$subcategory->slug}}"  class="form-control" id="slug"
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
                                            <option @if($category->id == $subcategory->category->id){{'selected'}}@endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            @error('category')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-sm-3 text-end control-label col-form-label">
                                Active</label>
                            <div class="col-sm-9">
                                <select name="active" class="form-select" id="active">
                                    @if($subcategory->active == 1)
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
                            <label for="feature" class="col-sm-3 text-end control-label col-form-label">
                                Feature</label>
                            <div class="col-sm-9">
                                <select name="feature" class="form-select" id="feature">
                                    @if($subcategory->feature == 1)
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>

                            @error('feature')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="subCatThumb" class="col-sm-3 text-end control-label col-form-label">
                                Thumbnail Image</label>
                            <div class="col-sm-9">
                                <input type="file" id="subCatThumb" class="form-control" name="subCatThumb">
                                <img src="{{asset('storage/subcategories/'.$subcategory->thumb_img)}}" width="50px" height="50px" alt="">
                            </div>

                            @error('subCatThumb')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                   class="col-sm-3 text-end control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="description" name="description"  placeholder="Electronics product like mobile,desktop etc" class="form-control">{{$subcategory->description}}</textarea>
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
