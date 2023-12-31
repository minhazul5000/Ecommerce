@extends('layouts.MasterFrontend')
@section('title')
    Dashboard
@endsection
@section('content')

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->

                @if(count($featureList['featureCategory']))
                    @foreach($featureList['featureCategory'] as $singleFeature)
                        <div class="col-md-4 col-xs-6">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="{{asset('storage/categories/'.$singleFeature->thumb_img)}}" alt="">
                                </div>
                                <div class="shop-body">
                                    <h3>{{$singleFeature->name}}</h3>
                                    <a href="{{asset($singleFeature->slug)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(count($featureList['featureSubCategory']))
                    @foreach($featureList['featureSubCategory'] as $singleSubFeature)
                        <div class="col-md-4 col-xs-6">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="{{asset('storage/subcategories/'.$singleSubFeature->thumb_img)}}" alt="">
                                </div>
                                <div class="shop-body">
                                    <h3>{{$singleSubFeature->name}}</h3>
                                    <a href="{{asset($singleSubFeature->category->slug.'/'.$singleSubFeature->slug)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @isset($newProducts)
                                        @foreach($newProducts as $products)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                                    <div class="product-label">
                                                        <span class="new">NEW</span>
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">{{$products->category->name}}</p>
                                                    <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">
                                                            {!! strlen($products->name) <= 60 ? "$products->name <br><br>" : "$products->name" !!}
                                                        </a></h3>
                                                    <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
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
                                        @endforeach
                                    @endisset
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @isset($newProducts)
                                        @foreach($newProducts as $products)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                                    <div class="product-label">
                                                        <span class="new">NEW</span>
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">{{$products->category->name}}</p>
                                                    <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">
                                                            {!! strlen($products->name) <= 60 ? "$products->name <br><br>" : "$products->name" !!}
                                                        </a></h3>
                                                    <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
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
                                        @endforeach
                                    @endisset
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @isset($newProducts)
                                @foreach($newProducts as $products)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('storage/products')}}/{{$products->product_img}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$products->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('products.details')}}/{{$products->slug}}">{{$products->name}}</a></h3>
                                            <h4 class="product-price">TK {{$products->price}} <del class="product-old-price">TK {{$products->regular_price}}</del></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

@endsection
