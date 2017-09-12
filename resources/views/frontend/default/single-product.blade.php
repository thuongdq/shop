@extends('frontend.default.master')
@section('content')
    <div id="single-product">
        <div class="container">
            <!-- gallery-holder -->
            <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
                <div class="product-item-holder size-big single-product-gallery small-gallery">
                    <div id="owl-single-product">
                        @forelse($product->attachments as $key => $file)
                            <div class="single-product-gallery-item" id="slide-{{ $key }}">
                                <a data-rel="prettyphoto"
                                   href="{{ media_get_image_src($file->path, '') }}">
                                    <img class="img-responsive" alt=""
                                         src="{{ asset('frontend/default/assets/images/blank.gif') }}"
                                         data-echo="{{ media_get_image_src($file->path, '-420x325') }}"/>
                                </a>
                            </div><!-- /.   single-product-gallery-item -->
                        @empty
                            <a data-rel="prettyphoto"
                               href="{{ media_get_image_src($product->image, '') }}">
                                {!! media_image_view($product->image, '-420x325', $product->name, $product->content, 'img-responsive', '', true) !!}
                            </a>

                        @endforelse
                    </div><!-- /.single-product-slider -->


                    <div class="single-product-gallery-thumbs gallery-thumbs">

                        <div id="owl-single-product-thumbnails">
                            @forelse($product->attachments as $key => $file)
                                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="{{ $key }}"
                                   href="#slide-{{$key}}">
                                    {!! media_image_view($file->path, '-73x73', $product->name, $product->content, 'img-responsive', '', true) !!}
                                </a>
                            @empty
                                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="0"
                                   href="#slide-0">
                                    {!! media_image_view($product->image, '-420x325', $product->name, $product->content, 'img-responsive', '', true) !!}
                                </a>
                            @endforelse
                        </div><!-- /#owl-single-product-thumbnails -->

                        <div class="nav-holder left hidden-xs">
                            <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails"
                               href="#prev"></a>
                        </div><!-- /.nav-holder -->

                        <div class="nav-holder right hidden-xs">
                            <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails"
                               href="#next"></a>
                        </div><!-- /.nav-holder -->

                    </div><!-- /.gallery-thumbs -->

                </div><!-- /.single-product-gallery -->
            </div>
            <!-- /.gallery-holder -->


            <div class="no-margin col-xs-12 col-sm-7 body-holder">
                <div class="body">
                    <div class="star-holder inline">
                        <div class="star" data-score="{{ floor($product->comments()->avg('rating')) }}"></div>
                    </div>
                    <div class="availability"><label>Tình trạng:</label>
                        <span class="{{ $product->quantity > 0 ? 'available' : 'not-available' }}">
                            {{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                        </span>
                    </div>

                    <div class="title"><a href="#">{{ $product->name }}</a></div>
                    <div class="brand">{{ $product->code }}</div>

                    <div class="social-row">
                        <span class="st_facebook_hcount"></span>
                        <span class="st_twitter_hcount"></span>
                        <span class="st_pinterest_hcount"></span>
                    </div>

                    <div class="buttons-holder">
                        <a class="btn-add-to-wishlist" href="#">Thêm vào ưa thích</a>
                        <a class="btn-add-to-compare" href="#">Thêm vào so sánh </a>
                    </div>

                    {{--<div class="excerpt">--}}
                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ornare turpis non risus--}}
                    {{--semper dapibus. Quisque eu vehicula turpis. Donec sodales lacinia eros, sit amet auctor--}}
                    {{--tellus volutpat non.</p>--}}
                    {{--</div>--}}

                    <div class="prices">
                        <div class="price-current">{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</div>
                        <div class="price-prev">{{ get_currency($product->regular_price, 'vn', 'Đ', false) }}</div>
                    </div>

                    <div class="qnt-holder">
                        <div class="le-quantity">
                            <form>
                                <a class="minus" href="#reduce" v-on:click="subtractQuantity({{ $product->id }}, $event, true)"></a>
                                <input name="quantity" readonly="readonly" type="text" value="1"/>
                                <a class="plus" href="#add" v-on:click="addQuantity({{ $product->id }}, $event, true)"></a>
                            </form>
                        </div>
                        <a id="addto-cart" href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}" v-on:click="addToCart({{ $product->id }}, $event, true)" class="le-button huge">
                            Thêm vào giỏ hàng
                        </a>
                    </div><!-- /.qnt-holder -->
                </div><!-- /.body -->

            </div><!-- /.body-holder -->
        </div><!-- /.container -->
    </div><!-- /.single-product -->

    <!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
    <section id="single-product-tab">
        <div class="container">
            <div class="tab-holder">

                <ul class="nav nav-tabs simple">
                    <li class="active"><a href="#description" data-toggle="tab">Mô tả</a></li>
                    <li><a href="#additional-info" data-toggle="tab">Thông tin thêm</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh giá ({{ $product->comments()->count() }})</a></li>
                </ul><!-- /.nav-tabs -->

                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <p>
                            {!! $product->content !!}
                        </p>

                        <div class="meta-row">
                            <div class="inline">
                                <label>Code:</label>
                                <span>{{ $product->code }}</span>
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>

                            <div class="inline">
                                <label>categories:</label>
                                <span><a href="#">{{ $product->category->name }}</a></span>
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>

                            <div class="inline">
                                <label>tag:</label>
                                @forelse($product->tags as $key => $tag)
                                    <span>
                                        <a href="#">{{ $tag->name }}</a>
                                        @if($key < count($product->tags) - 1)
                                            ,
                                        @endif
                                    </span>
                                @empty
                                @endforelse
                            </div><!-- /.inline -->
                        </div><!-- /.meta-row -->
                    </div><!-- /.tab-pane #description -->

                    <div class="tab-pane" id="additional-info">
                        <ul class="tabled-data">
                            @php
                                $product->attributes = json_decode($product->attributes);
                            @endphp
                            @if(!empty($product->attributes))
                                @forelse($product->attributes as $attribute)
                                    <li>
                                        <label>{{ $attribute->name }}</label>
                                        <div class="value">{{ $attribute->value }}</div>
                                    </li>
                                @empty
                                @endforelse
                            @endif
                        </ul><!-- /.tabled-data -->

                        <div class="meta-row">
                            <div class="inline">
                                <label>Code:</label>
                                <span>{{ $product->code }}</span>
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>

                            <div class="inline">
                                <label>categories:</label>
                                <span><a href="#">{{ $product->category->name }}</a></span>
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>

                            <div class="inline">
                                <label>tag:</label>
                                @forelse($product->tags as $tag)
                                    <span><a href="#">{{ $tag->name }}</a>,</span>
                                @empty
                                @endforelse
                            </div><!-- /.inline -->
                        </div><!-- /.meta-row -->
                    </div><!-- /.tab-pane #additional-info -->


                    <div class="tab-pane" id="reviews">
                        <div class="comments">
                            @forelse($product->comments as $comment)
                                <div class="comment-item">
                                    <div class="row no-margin">
                                        <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                            <div class="avatar">
                                                <img alt="avatar"
                                                     src="{{ asset('frontend/default/assets/images/default-avatar.jpg') }}">
                                            </div><!-- /.avatar -->
                                        </div><!-- /.col -->

                                        <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                            <div class="comment-body">
                                                <div class="meta-info">
                                                    <div class="author inline">
                                                        <a href="#" class="bold">{{ $comment->name }}</a>
                                                    </div>
                                                    <div class="star-holder inline">
                                                        <div class="star" data-score="{{ $comment->rating }}"></div>
                                                    </div>
                                                    <div class="date inline pull-right">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </div>
                                                </div><!-- /.meta-info -->
                                                <p class="comment-text">
                                                    {{ $comment->content }}
                                                </p><!-- /.comment-text -->
                                            </div><!-- /.comment-body -->

                                        </div><!-- /.col -->

                                    </div><!-- /.row -->
                                </div><!-- /.comment-item -->
                            @empty
                                Chưa có đánh giá
                            @endforelse
                        </div><!-- /.comments -->

                        <div class="add-review row">
                            <div class="col-sm-8 col-xs-12">
                                <div class="new-review-form">
                                    <h2>Thêm đánh giá</h2>
                                    @if(session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <form id="contact-form" class="contact-form" method="post" action="{{ route('frontend.home.comment', [ 'slug' => $product->slug]) }}">
                                        {{ csrf_field() }}
                                        <div class="row field-row">
                                            <div class="col-xs-12 col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label>Tên*</label>
                                                <input class="le-input" name="name">
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label>email*</label>
                                                <input class="le-input" name="email">
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div><!-- /.field-row -->

                                        <div class="field-row star-row {{ $errors->has('score') ? 'has-error' : '' }}">
                                            <label>Bình chọn</label>
                                            <div class="star-holder">
                                                <div class="star big" data-score="0"></div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('score') }}</span>
                                        </div><!-- /.field-row -->

                                        <div class="field-row {{ $errors->has('content') ? 'has-error' : '' }}">
                                            <label>Đánh giá của bạn</label>
                                            <textarea rows="8" class="le-input" name="content"></textarea>
                                            <span class="help-block">{{ $errors->first('content') }}</span>
                                        </div><!-- /.field-row -->

                                        <div class="buttons-holder">
                                            <button type="submit" class="le-button huge">Gửi</button>
                                        </div><!-- /.buttons-holder -->
                                    </form><!-- /.contact-form -->
                                </div><!-- /.new-review-form -->
                            </div><!-- /.col -->
                        </div><!-- /.add-review -->

                    </div><!-- /.tab-pane #reviews -->
                </div><!-- /.tab-content -->

            </div><!-- /.tab-holder -->
        </div><!-- /.container -->
    </section><!-- /#single-product-tab -->
    <!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->
    <!-- ========================================= RECENTLY VIEWED ========================================= -->
    @if(isset($recent_products) && !empty($recent_products))
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
    @endif
    <!-- ========================================= RECENTLY VIEWED : END ========================================= -->
@endsection