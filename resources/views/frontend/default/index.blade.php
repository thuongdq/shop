@extends('frontend.default.master')
@section('body_scripts')
    {{--plugin js in admin--}}

@endsection
@section('content')
    <div id="top-banner-and-menu">
        <div class="container">

            <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown">
                    <div class="head"><i class="fa fa-list"></i> Chuyên mục</div>
                    <nav class="yamm megamenu-horizontal" role="navigation">
                        <ul class="nav">
                            @if(count($categories[0]) > 0)
                                @foreach($categories[0] as $category)
                                    <li class="dropdown menu-item">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }}</a>
                                        @if(isset($categories[$category->id]))
                                            <ul class="dropdown-menu mega-menu">
                                                <li class="yamm-content">
                                                    <div class="row">
                                                        @php
                                                            $count = 0;
                                                        @endphp
                                                        @foreach($categories[$category->id] as $childCategory)
                                                            @if($count % 6 == 0)
                                                                <div class="col-md-4">
                                                                    <ul class="list-unstyled">
                                                            @endif
                                                                    <li><a href="{{ route('frontend.home.productIndex', ['category'=>$category->id]) }}">{{ $childCategory->name }}</a></li>
                                                            @php
                                                                $count++;
                                                            @endphp
                                                             @if($count % 6 == 0)
                                                                    </ul>
                                                                </div>
                                                             @endif
                                                        @endforeach
                                                    </div>
                                                </li>

                                            </ul>
                                        @endif
                                    </li><!-- /.menu-item -->
                                @endforeach
                            @endif
                        </ul><!-- /.nav -->
                    </nav><!-- /.megamenu-horizontal -->
                </div><!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
            </div><!-- /.sidemenu-holder -->

            <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                        <div class="item"
                             style="background-image: url({{ asset('frontend/default/assets/images/sliders/slider01.jpg') }});">
                            <div class="container-fluid">
                                <div class="caption vertical-center text-left">
                                    <div class="big-text fadeInDown-1">
                                        Save up to a<span class="big"><span class="sign">$</span>400</span>
                                    </div>

                                    <div class="excerpt fadeInDown-2">
                                        on selected laptops<br>
                                        & desktop pcs or<br>
                                        smartphones
                                    </div>
                                    <div class="small fadeInDown-2">
                                        terms and conditions apply
                                    </div>
                                    <div class="button-holder fadeInDown-3">
                                        <a href="single-product.html" class="big le-button ">shop now</a>
                                    </div>
                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                        </div><!-- /.item -->

                        <div class="item"
                             style="background-image: url({{ asset('frontend/default/assets/images/sliders/slider03.jpg') }});">
                            <div class="container-fluid">
                                <div class="caption vertical-center text-left">
                                    <div class="big-text fadeInDown-1">
                                        Want a<span class="big"><span class="sign">$</span>200</span>Discount?
                                    </div>

                                    <div class="excerpt fadeInDown-2">
                                        on selected <br>desktop pcs<br>
                                    </div>
                                    <div class="small fadeInDown-2">
                                        terms and conditions apply
                                    </div>
                                    <div class="button-holder fadeInDown-3">
                                        <a href="single-product.html" class="big le-button ">shop now</a>
                                    </div>
                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                        </div><!-- /.item -->

                    </div><!-- /.owl-carousel -->
                </div>

                <!-- ========================================= SECTION – HERO : END ========================================= -->
            </div><!-- /.homebanner-holder -->

        </div><!-- /.container -->
    </div><!-- /#top-banner-and-menu -->

    <!-- ========================================= HOME BANNERS ========================================= -->
    <section id="banner-holder" class="wow fadeInUp">
        <div class="container">
            <div class="col-xs-12 col-lg-6 no-margin banner">
                <a href="category-grid-2.html">
                    <div class="banner-text theblue">
                        <h1>New Life</h1>
                        <span class="tagline">Introducing New Category</span>
                    </div>
                    <img class="banner-image" alt="" src="{{ asset('frontend/default/assets/images/blank.gif') }}"
                         data-echo="{{ asset('frontend/default/assets/images/banners/banner-narrow-01.jpg') }}"/>
                </a>
            </div>
            <div class="col-xs-12 col-lg-6 no-margin text-right banner">
                <a href="category-grid-2.html">
                    <div class="banner-text right">
                        <h1>Time &amp; Style</h1>
                        <span class="tagline">Checkout new arrivals</span>
                    </div>
                    <img class="banner-image" alt="" src="{{ asset('frontend/default/assets/images/blank.gif') }}"
                         data-echo="{{ asset('frontend/default/assets/images/banners/banner-narrow-02.jpg') }}"/>
                </a>
            </div>
        </div><!-- /.container -->
    </section><!-- /#banner-holder -->
    <!-- ========================================= HOME BANNERS : END ========================================= -->
    <div id="products-tab" class="wow fadeInUp">
        <div class="container">
            <div class="tab-holder">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#latest-products" data-toggle="tab">Sản Phẩm Mới</a></li>
                    <li><a href="#featured" data-toggle="tab">Nổi bật</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="latest-products">
                        <div class="product-grid-holder">
                            @forelse($products as $product)
                                <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                    <div class="product-item">
                                        {{--<div class="ribbon blue"><span>new!</span></div>--}}
                                        <div class="image">
                                            {!! media_image_view($product->image, '-246x186', $product->name, $product->content, 'img-responsive', '', true) !!}
                                        </div>
                                        <div class="body">
                                            <div class="label-discount clear"></div>
                                            <div class="title">
                                                <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="brand">{{ $product->code }}</div>
                                        </div>
                                        <div class="prices">
                                            <div class="price-prev">{{ get_currency($product->regular_price, 'vn', 'Đ', false) }}</div>
                                            <div class="price-current pull-right">{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</div>
                                        </div>
                                        <div class="hover-area">
                                            <div class="add-cart-button">
                                                <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}" v-on:click="addToCart({{ $product->id }}, $event)" class="le-button">
                                                    Thêm vào giỏ hàng
                                                </a>
                                            </div>
                                            <div class="wish-compare">
                                                <a class="btn-add-to-wishlist" href="#">ưa thích</a>
                                                <a class="btn-add-to-compare" href="#">so sánh</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-sm-12 col-md-12  no-margin">
                                    Dữ liệu đang được cập nhật
                                </div>
                            @endforelse
                        </div>
                        <div class="loadmore-holder text-center">
                            <a class="btn-loadmore" href="{{ route('frontend.home.productIndex') }}">
                                <i class="fa fa-plus"></i>
                                Xem thêm sản phẩm</a>
                        </div>

                    </div>
                    <div class="tab-pane" id="featured">
                        <div class="product-grid-holder">
                            @forelse($featureds as $product)
                                <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                                    <div class="product-item">
                                        {{--<div class="ribbon red"><span>sale</span></div>--}}
                                        {{--<div class="ribbon green"><span>bestseller</span></div>--}}
                                        {{--<div class="ribbon blue"><span>new</span></div>--}}
                                        <div class="image">
                                            @if (!empty($product->image) && file_exists(public_path(get_thumbnail("uploads/$product->image"))))
                                                <img src="{{ asset('frontend/default/assets/images/blank.gif') }}"
                                                     data-echo="{{ asset(get_thumbnail("uploads/$product->image")) }}"
                                                     alt="Image">
                                            @else
                                                <img src="{{ asset('frontend/default/assets/images/blank.gif') }}"
                                                     data-echo="{{ asset('frontend/default/assets/images/no-image.jpg') }}"
                                                     alt="No Image">
                                            @endif
                                        </div>
                                        <div class="body">
                                            {{--<div class="label-discount green">-50% sale</div>--}}
                                            <div class="title">
                                                <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="brand">{{ $product->code }}</div>
                                        </div>
                                        <div class="prices">
                                            <div class="price-prev">{{ get_currency($product->regular_price, 'vn', 'Đ', false) }}</div>
                                            <div class="price-current pull-right">{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</div>
                                        </div>

                                        <div class="hover-area">
                                            <div class="add-cart-button">
                                                <a href="single-product.html" class="le-button">Thêm giỏ hàng</a>
                                            </div>
                                            {{--<div class="wish-compare">--}}
                                            {{--<a class="btn-add-to-wishlist" href="#">ưa thích</a>--}}
                                            {{--<a class="btn-add-to-compare" href="#">so sánh</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="loadmore-holder text-center">
                            <a class="btn-loadmore" href="{{ route('frontend.home.productIndex') }}">
                                <i class="fa fa-plus"></i>
                                Xem thêm sản phẩm</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================= BEST SELLERS ========================================= -->
    @if(count($best_sellers) >= 7)
        <section id="bestsellers" class="color-bg wow fadeInUp">
            <div class="container">
                <h1 class="section-title">Bán chạy</h1>

                <div class="product-grid-holder medium">
                    <div class="col-xs-12 col-md-7 no-margin">
                        @foreach($best_sellers as $key => $product)
                            @if($key != 0)
                                @if(($key - 1) % 3 == 0)
                                    <div class="row no-margin">
                                        @endif
                                        <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                            <div class="product-item">
                                                <div class="image">
                                                    {!! media_image_view($product->image, '-246x186', $product->name, $product->content, '', '', true) !!}
                                                </div>
                                                <div class="body">
                                                    <div class="label-discount clear"></div>
                                                    <div class="title">
                                                        <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                    </div>
                                                    <div class="brand">{{ $product->code }}</div>
                                                </div>
                                                <div class="prices">
                                                    <div class="price-current text-right">
                                                        {{ get_currency($product->sale_price, 'vn', 'Đ', false) }}
                                                    </div>
                                                </div>
                                                <div class="hover-area">
                                                    <div class="add-cart-button">
                                                        <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}" class="le-button">Thêm vào giỏ hàng</a>
                                                    </div>
                                                    <div class="wish-compare">
                                                        <a class="btn-add-to-wishlist" href="#">ưa thích</a>
                                                        <a class="btn-add-to-compare" href="#">so sánh</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.product-item-holder -->
                                        @if($key % 3 == 0 || $key == count($best_sellers))
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div><!-- /.col -->
                    <div class="col-xs-12 col-md-5 no-margin">
                        <div class="product-item-holder size-big single-product-gallery small-gallery">
                            @foreach($best_sellers as $key => $product)
                                <div id="best-seller-single-product-slider" class="single-product-slider owl-carousel">
                                    @forelse($product->attachments as $key => $file)
                                        <div class="single-product-gallery-item" id="slide-{{ $key }}">
                                            <a data-rel="prettyphoto"
                                               href="{{ media_get_image_src($file->path, '') }}">
                                                {!! media_image_view($file->path, '-420x325', $product->name, $product->content, 'img-responsive', '', true) !!}

                                            </a>
                                        </div><!-- /.   single-product-gallery-item -->
                                    @empty
                                        <a data-rel="prettyphoto"
                                           href="{{ media_get_image_src($product->image, '') }}">
                                            {!! media_image_view($product->image, '-420x325', $product->name, $product->content, 'img-responsive', '', true) !!}
                                        </a>
                                    @endforelse
                                </div><!-- /.single-product-slider -->


                                <div class="gallery-thumbs clearfix">
                                    <ul>
                                        @forelse($product->attachments as $key => $file)
                                            <li>
                                                <a class="horizontal-thumb active" data-target="#best-seller-single-product-slider"
                                                   data-slide="{{ $key }}" href="#slide{{$key}}">
                                                    {!! media_image_view($file->path, '-73x73', $product->name, $product->content, 'img-responsive', '', true) !!}
                                                </a>
                                            </li>
                                        @empty
                                            <a class="horizontal-thumb active" data-target="#best-seller-single-product-slider"
                                               data-slide="0" href="#slide0">
                                                {!! media_image_view($product->image, '-73x73', $product->name, $product->content, 'img-responsive', '', true) !!}
                                            </a>
                                        @endforelse
                                    </ul>
                                </div><!-- /.gallery-thumbs -->

                                <div class="body">
                                    <div class="label-discount clear"></div>
                                    <div class="title">
                                        <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </div>
                                    <div class="brand">{{ $product->code }}</div>
                                </div>
                                <div class="prices text-right">
                                    <div class="price-current inline">{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</div>
                                    <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}" v-on:click="addToCart({{ $product->id }}, $event)" class="le-button big inline">
                                        Thêm vào giỏ hàng
                                    </a>
                                </div>
                                @break
                            @endforeach
                        </div><!-- /.product-item-holder -->
                    </div><!-- /.col -->

                </div><!-- /.product-grid-holder -->
            </div><!-- /.container -->
        </section><!-- /#bestsellers -->
    @endif
    <!-- ========================================= BEST SELLERS : END ========================================= -->
    <!-- ========================================= RECENTLY VIEWED ========================================= -->
    <section id="recently-reviewd" class="wow fadeInUp">
        <div class="container">
            <div class="carousel-holder hover">

                <div class="title-nav">
                    <h2 class="h1">Recently Viewed</h2>
                    <div class="nav-holder">
                        <a href="#prev" data-target="#owl-recently-viewed"
                           class="slider-prev btn-prev fa fa-angle-left"></a>
                        <a href="#next" data-target="#owl-recently-viewed"
                           class="slider-next btn-next fa fa-angle-right"></a>
                    </div>
                </div><!-- /.title-nav -->

                <div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                    @foreach($recent_products as $product)
                        <div class="no-margin carousel-item product-item-holder size-small hover">
                            <div class="product-item">
                                {{--<div class="ribbon red"><span>sale</span></div>--}}
                                {{--<div class="ribbon green"><span>bestseller</span></div>--}}
                                {{--<div class="ribbon blue"><span>new</span></div>--}}
                                <div class="image">
                                    {!! media_image_view($product->image, '-246x186', $product->name, $product->content, 'img-responsive', '', true) !!}
                                </div>
                                <div class="body">
                                    {{--<div class="label-discount green">-50% sale</div>--}}
                                    <div class="title">
                                        <a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </div>
                                    <div class="brand">{{ $product->code }}</div>
                                </div>
                                <div class="prices">
                                    <div class="price-current text-right">{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</div>
                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="single-product.html" class="le-button">Thêm giỏ hàng</a>
                                    </div>
                                    {{--<div class="wish-compare">--}}
                                    {{--<a class="btn-add-to-wishlist" href="#">ưa thích</a>--}}
                                    {{--<a class="btn-add-to-compare" href="#">so sánh</a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div><!-- /.product-item-holder -->
                    @endforeach
                </div><!-- /#recently-carousel -->

            </div><!-- /.carousel-holder -->
        </div><!-- /.container -->
    </section><!-- /#recently-reviewd -->
    <!-- ========================================= RECENTLY VIEWED : END ========================================= -->
    <!-- ========================================= TOP BRANDS ========================================= -->
    <section id="top-brands" class="wow fadeInUp">
        <div class="container">
            <div class="carousel-holder">

                <div class="title-nav">
                    <h1>Top Brands</h1>
                    <div class="nav-holder">
                        <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                        <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                    </div>
                </div><!-- /.title-nav -->

                <div id="owl-brands" class="owl-carousel brands-carousel">

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-01.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-02.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-03.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-04.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-01.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-02.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-03.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                    <div class="carousel-item">
                        <a href="#">
                            <img alt="" src="{{ asset('frontend/default/assets/images/brands/brand-04.jpg') }}"/>
                        </a>
                    </div><!-- /.carousel-item -->

                </div><!-- /.brands-caresoul -->

            </div><!-- /.carousel-holder -->
        </div><!-- /.container -->
    </section><!-- /#top-brands -->
    <!-- ========================================= TOP BRANDS : END ========================================= -->
@endsection