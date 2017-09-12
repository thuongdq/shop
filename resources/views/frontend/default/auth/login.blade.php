@extends('frontend.default.master')
@section('content')
<!-- ========================================= MAIN ========================================= -->
<main id="authentication" class="inner-bottom-md">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <section class="section sign-in inner-right-xs">
                    <h2 class="bordered">Sign In</h2>
                    <p>Hello, Welcome to your account</p>

                    <div class="social-auth-buttons">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn-block btn-lg btn btn-facebook" href="{{ route('loginFacebook') }}"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button>
                            </div>
                        </div>
                    </div>

                    <form role="form" class="login-form cf-style-1" action="{{ route('frontend.login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="field-row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email</label>
                            <input type="text" class="le-input" name="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->

                        <div class="field-row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password</label>
                            <input type="password" class="le-input" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->

                        <div class="field-row clearfix">
                        	<span class="pull-left">
                        		<label class="content-color"><input type="checkbox" class="le-checbox auto-width inline" name="remember"> <span class="bold">Remember me</span></label>
                        	</span>
                            <span class="pull-right">
                        		<a href="{{ route('frontend.password.request') }}" class="content-color bold">Forgotten Password ?</a>
                        	</span>
                        </div>

                        <div class="buttons-holder">
                            <button type="submit" class="le-button huge">Secure Sign In</button>
                        </div><!-- /.buttons-holder -->
                    </form><!-- /.cf-style-1 -->

                </section><!-- /.sign-in -->
            </div><!-- /.col -->

            <div class="col-md-6">
                <section class="section register inner-left-xs">
                    <h2 class="bordered">Create New Account</h2>
                    <p>Create your own Media Center account</p>

                    <form role="form" class="register-form cf-style-1" action="{{ route('frontend.register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="field-row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            <input type="text" class="le-input" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->

                        <div class="field-row {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email</label>
                            <input type="text" class="le-input" name="email" value="{{ $email or old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->
                        <div class="field-row {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Mật khẩu</label>
                            <input type="password" class="le-input" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->
                        <div class="field-row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" class="le-input" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div><!-- /.field-row -->

                        <div class="buttons-holder">
                            <button type="submit" class="le-button huge">Sign Up</button>
                        </div><!-- /.buttons-holder -->
                    </form>

                    <h2 class="semi-bold">Sign up today and you'll be able to :</h2>

                    <ul class="list-unstyled list-benefits">
                        <li><i class="fa fa-check primary-color"></i> Speed your way through the checkout</li>
                        <li><i class="fa fa-check primary-color"></i> Track your orders easily</li>
                        <li><i class="fa fa-check primary-color"></i> Keep a record of all your purchases</li>
                    </ul>

                </section><!-- /.register -->

            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</main><!-- /.authentication -->
<!-- ========================================= MAIN : END ========================================= -->
@endsection