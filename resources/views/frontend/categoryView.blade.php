@extends('layouts.MasterFrontend')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('frontendDashboard')}}">Home</a></li>
                        @isset($breadcrumbs)
                            @foreach($breadcrumbs as $breadcrumb)
                                <li><a href="{{asset($breadcrumb['slug'])}}">{{$breadcrumb['name']}}</a></li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    @if($brandfilter)
                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Brand</h3>

                            @isset($brands)
                                @foreach($brands as $brand)
                                    <div class="checkbox-filter">
                                        <div class="input-checkbox">
                                            <input type="checkbox" id="{{$brand->name}}">
                                            <label for="{{$brand->name}}">
                                                <span></span>
                                                {{$brand->name}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset


                        </div>
                        <!-- /aside Widget -->
                    @endif

                    <div class="aside">
                        <h3 class="aside-title">Availablity</h3>
                        <div class="checkbox-filter">
                            <div class="input-checkbox">
                                <input type="checkbox" id="availibility-1">
                                <label for="availibility-1">
                                    <span></span>
                                    In Stock
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select">
                                    <option value="0">Popular</option>
                                    <option value="1">Position</option>
                                </select>
                            </label>

                            <label>
                                Show:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        @isset($products)
                            @foreach($products as $product)
                        <!-- product -->
                        <div class="col-md-4 col-xs-6">
                            <!-- product -->
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{asset('storage/products')}}/{{$product->product_img}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$product->category->name}}</p>
                                    <h3 class="product-name"><a href="{{route('products.details')}}/{{$product->slug}}">
                                            {!! strlen($product->name) <= 60 ? "$product->name <br><br>" : "$product->name" !!}
                                        </a></h3>
                                    <h4 class="product-price">TK {{$product->price}} <del class="product-old-price">TK {{$product->regular_price}}</del></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>
                            </div>
                                    <!-- /product -->
                        </div>
                            @endforeach
                        @endisset
                        <!-- /product -->
                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing 20-100 products</span>
                        <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <script defer>
        $(function() {
            "use strict"


            var priceInputMax = document.getElementById('price-max'),
                priceInputMin = document.getElementById('price-min');

            priceInputMax.addEventListener('change', function(){
                updatePriceSlider($(this).parent() , this.value)
            });

            priceInputMin.addEventListener('change', function(){
                updatePriceSlider($(this).parent() , this.value)
            });

            function updatePriceSlider(elem , value) {
                if ( elem.hasClass('price-min') ) {
                    console.log('min')
                    priceSlider.noUiSlider.set([value, null]);
                } else if ( elem.hasClass('price-max')) {
                    console.log('max')
                    priceSlider.noUiSlider.set([null, value]);
                }
            }

            // Price Slider
            var priceSlider = document.getElementById('price-slider');
            if (priceSlider) {
                noUiSlider.create(priceSlider, {
                    start: [1, 999],
                    connect: true,
                    step: 1,
                    range: {
                        'min': 1,
                        'max': 999
                    }
                });

                priceSlider.noUiSlider.on('update', function( values, handle ) {
                    var value = values[handle];
                    handle ? priceInputMax.value = value : priceInputMin.value = value
                });
            }
        });
    </script>
@endsection
