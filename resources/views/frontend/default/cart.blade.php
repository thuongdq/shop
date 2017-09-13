@extends('frontend.default.master')
@section('content')
    <section id="cart-page">
        <div class="container">
            <!-- ========================================= CONTENT ========================================= -->
            <div class="col-xs-12 col-md-9 items-holder no-margin">
                <form action="{{ route('frontend.cart.updateCart') }}" method="post">
                    {{ csrf_field() }}
                    @foreach($cart as $key => $product)
                        <div class="row no-margin cart-item">
                            <div class="col-xs-12 col-sm-2 no-margin">
                                <a href="#" class="thumb-holder">
                                    <img class="lazy" alt="" src="{{ $product['image'] }}"/>
                                </a>
                            </div>

                            <div class="col-xs-12 col-sm-5 ">
                                <div class="title">
                                    <a href="{{ route('frontend.home.show', [ 'slug' => $product['slug']]) }}">{{ $product['name'] }}</a>
                                </div>
                                <div class="brand">{{ $product['code'] }}</div>
                            </div>

                            <div class="col-xs-12 col-sm-3 no-margin">
                                <div class="quantity">
                                    <div class="le-quantity">
                                        <a class="minus" href="#reduce"></a>
                                        <input name="cart[{{ $key }}]" readonly="readonly" type="text" value="{{ $product['quantity'] }}"/>
                                        <a class="plus" href="#add"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-2 no-margin">
                                <div class="price">
                                    {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }} Đ
                                </div>
                                <a class="close-btn" href="{{ route('frontend.cart.delete', ['id'=>$key]) }}"></a>
                            </div>
                        </div><!-- /.cart-item -->
                    @endforeach
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Cập nhật giỏ hàng</button>
                        <a href="{{ route('frontend.cart.deleteAll') }}" class="btn btn-danger">Xóa giỏ hàng</a>
                    </div>
                </form>
            </div>
            <!-- ========================================= CONTENT : END ========================================= -->

            <!-- ========================================= SIDEBAR ========================================= -->

            <div class="col-xs-12 col-md-3 no-margin sidebar ">
                <div class="widget cart-summary">
                    <h1 class="border">shopping cart</h1>
                    <div class="body">
                        {{--<ul class="tabled-data no-border inverse-bold">--}}
                            {{--<li>--}}
                                {{--<label>cart subtotal</label>--}}
                                {{--<div class="value pull-right">$8434.00</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<label>shipping</label>--}}
                                {{--<div class="value pull-right">free shipping</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        <ul id="total-price" class="tabled-data inverse-bold no-border">
                            <li>
                                <label>order total</label>
                                <div class="value pull-right">{{ $sumPrice }} đ</div>
                            </li>
                        </ul>
                        <div class="buttons-holder">
                            <a class="le-button big"
                               href="{{ route('frontend.checkout.index') }}">checkout</a>
                            <a class="simple-link block"
                               href="{{ route('frontend.home.index') }}">continue
                                shopping</a>
                        </div>
                    </div>
                </div><!-- /.widget -->

                {{--<div id="cupon-widget" class="widget">--}}
                    {{--<h1 class="border">use coupon</h1>--}}
                    {{--<div class="body">--}}
                        {{--<form>--}}
                            {{--<div class="inline-input">--}}
                                {{--<input data-placeholder="enter coupon code" type="text"/>--}}
                                {{--<button class="le-button" type="submit">Apply</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div><!-- /.widget -->--}}
            </div><!-- /.sidebar -->

            <!-- ========================================= SIDEBAR : END ========================================= -->
        </div>
    </section>
@endsection