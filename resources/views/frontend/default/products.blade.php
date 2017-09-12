@extends('frontend.default.master')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('frontend.home.productIndex') }}" method="get" id="orderby-form" class="col-xs-12">
                @if($search  = Request::input('search'))
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif
                @if($category  = Request::input('category'))
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                @if(Request::input('search'))
                    <h3 style="display: block; float: left;padding: 8px 0px;">Từ khóa: "{{ $search }}"</h3>
                @endif
                <select class="form-control pull-right" style="width: 200px; margin-bottom: 10px;" onchange="event.preventDefault();document.getElementById('orderby-form').submit()" name="orderBy">
                    <option value="lastest" {{ Request::input('orderBy') == "lastest" ? 'selected' : '' }}>Mới nhất</option>
                    <option value="oldest" {{ Request::input('orderBy') == "oldest" ? 'selected' : '' }}>Cũ nhất</option>
                    <option value="hightest" {{ Request::input('orderBy') == "hightest" ? 'selected' : '' }}>Giá giảm dần</option>
                    <option value="lowest" {{ Request::input('orderBy') == "lowest" ? 'selected' : '' }}>Giá tăng dần</option>
                </select>
            </form>

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
            <div class="row col-xs-12 text-center">
                @php
                    $uriArr = [];
                    if($search = Request::input('search')){
                        $uriArr['search'] = $search;
                    }
                    if($orderBy = Request::input('orderBy')){
                        $uriArr['orderBy'] = $orderBy;
                    }
                    if($category = Request::input('category')){
                        $uriArr['category'] = $category;
                    }
                @endphp
                {{ $products->appends($uriArr)->links('vendor.pagination.frontend') }}
            </div>
        </div>
    </div>
@endsection