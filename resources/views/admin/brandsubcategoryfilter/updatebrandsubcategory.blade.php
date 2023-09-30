@extends('layouts.MasterAdmin')

@section('title')
    Admin || Edit Brand Category
@endsection
@section('pageTitle')
    Edit Brand Category
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="{{route('brand-subcategories.update',$brandsubcategory->id)}}" enctype="multipart/form-data" method="post" class="form-horizontal">
                @csrf
                @method('patch')
                <div class="modal-body bg-light">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="subcategory"
                                   class="col-sm-3 text-end control-label col-form-label">Sub Category</label>
                            <div class="col-sm-9">
                                <select name="subcategory" id="subcategory" class="form-select">
                                    @isset($subcategories)
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" {{$subcategory->id == $brandsubcategory->subcategory->id ? 'selected' : null}}>{{$subcategory->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            @error('subcategory')
                            <span class="text-center">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="brand"
                                   class="col-sm-3 text-end control-label col-form-label">Brand</label>
                            <div class="col-sm-9">
                                <select name="brand" id="brand" class="form-select">
                                    @isset($brands)
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$brand->id == $brandsubcategory->brand->id ? 'selected' : null}}> {{$brand->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            @error('brand')
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
