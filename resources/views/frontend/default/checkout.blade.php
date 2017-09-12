@extends('frontend.default.master')
@section('content')
    <section id="checkout-page">
        <div class="container">
            <div class="col-xs-12 no-margin">

                <div class="billing-address">
                    <h2 class="border h1">billing address</h2>
                    <form method="post" action="{{ route('frontend.checkout.placeOrder') }}" id="billing-info">
                        {{ csrf_field() }}
                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-4 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label>full name*</label>
                                <input class="le-input" name="name" value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="col-xs-12 col-sm-4 {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label>email address*</label>
                                <input class="le-input" name="email" value="{{ old('email') }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="col-xs-12 col-sm-4 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label>phone number*</label>
                                <input class="le-input" name="phone" value="{{ old('phone') }}">
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-12 {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label>address*</label>
                                <input class="le-input" placeholder="street address" name="address" value="{{ old('address') }}">
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            </div>
                        </div><!-- /.field-row -->

                        {{--<div class="row field-row">--}}
                        {{--<div id="create-account" class="col-xs-12">--}}
                        {{--<input  class="le-checkbox big" type="checkbox"  />--}}
                        {{--<a class="simple-link bold" href="#">Create Account?</a> - you will receive email with temporary generated password after login you need to change it.--}}
                        {{--</div>--}}
                        {{--</div><!-- /.field-row -->--}}

                    </form>
                </div><!-- /.billing-address -->


                {{--<section id="shipping-address">--}}
                {{--<h2 class="border h1">shipping address</h2>--}}
                {{--<form>--}}
                {{--<div class="row field-row">--}}
                {{--<div class="col-xs-12">--}}
                {{--<input  class="le-checkbox big" type="checkbox"  />--}}
                {{--<a class="simple-link bold" href="#">ship to different address?</a>--}}
                {{--</div>--}}
                {{--</div><!-- /.field-row -->--}}
                {{--</form>--}}
                {{--</section><!-- /#shipping-address -->--}}


                <section id="your-order">
                    <h2 class="border h1">Đơn hàng của bạn</h2>
                    <form>
                        @foreach($products as $product)
                            <div class="row no-margin order-item">
                                <div class="col-xs-12 col-sm-1 no-margin">
                                    <a href="#" class="qty">{{ $product->quantity }} x</a>
                                </div>

                                <div class="col-xs-12 col-sm-9 ">
                                    <div class="title"><a href="{{ route('frontend.home.show', ['slug' => $product->slug]) }}">{{ $product->name }} </a></div>
                                    <div class="brand">{{ $product->code }}</div>
                                </div>

                                <div class="col-xs-12 col-sm-2 no-margin">
                                    <div class="price">{{ get_currency($product->subtotal, 'vn', 'Đ', false) }} Đ</div>
                                </div>
                            </div><!-- /.order-item -->
                        @endforeach
                    </form>
                </section><!-- /#your-order -->

                <div id="total-area" class="row no-margin">
                    <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                        <div id="subtotal-holder">
                            <ul class="tabled-data inverse-bold no-border">
                                {{--<li>--}}
                                {{--<label>cart subtotal</label>--}}
                                {{--<div class="value ">$8434.00</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<label>shipping</label>--}}
                                {{--<div class="value">--}}
                                {{--<div class="radio-group">--}}
                                {{--<input class="le-radio" type="radio" name="group1" value="free"> <div class="radio-label bold">free shipping</div><br>--}}
                                {{--<input class="le-radio" type="radio" name="group1" value="local" checked>  <div class="radio-label">local delivery<br><span class="bold">$15</span></div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</li>--}}
                            </ul><!-- /.tabled-data -->

                            <ul id="total-field" class="tabled-data inverse-bold ">
                                <li>
                                    <label>Tổng cộng</label>
                                    <div class="value">{{ get_currency($total, 'vn', 'Đ', false) }} Đ</div>
                                </li>
                            </ul><!-- /.tabled-data -->

                        </div><!-- /#subtotal-holder -->
                    </div><!-- /.col -->
                </div><!-- /#total-area -->

                {{--<div id="payment-method-options">--}}
                {{--<form>--}}
                {{--<div class="payment-method-option">--}}
                {{--<input class="le-radio" type="radio" name="group2" value="Direct">--}}
                {{--<div class="radio-label bold ">Direct Bank Transfer<br>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum tempus elit, vestibulum vestibulum erat ornare id.</p>--}}
                {{--</div>--}}
                {{--</div><!-- /.payment-method-option -->--}}

                {{--<div class="payment-method-option">--}}
                {{--<input class="le-radio" type="radio" name="group2" value="cheque">--}}
                {{--<div class="radio-label bold ">cheque payment</div>--}}
                {{--</div><!-- /.payment-method-option -->--}}

                {{--<div class="payment-method-option">--}}
                {{--<input class="le-radio" type="radio" name="group2" value="paypal">--}}
                {{--<div class="radio-label bold ">paypal system</div>--}}
                {{--</div><!-- /.payment-method-option -->--}}
                {{--</form>--}}
                {{--</div><!-- /#payment-method-options -->--}}

                <div class="place-order-button">
                    <button class="le-button big" onclick="document.getElementById('billing-info').submit()">Đặt hàng</button>
                </div><!-- /.place-order-button -->

            </div><!-- /.col -->
        </div><!-- /.container -->
    </section><!-- /#checkout-page -->
@endsection