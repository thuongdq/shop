@extends('frontend.default.master')
@section('content')
    <!-- ========================================= MAIN ========================================= -->
    <main id="authentication" class="inner-bottom-md">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <section class="section sign-in inner-right-xs">
                        <h2 class="bordered">Quên mật khẩu</h2>
                        <p>Vui lòng nhập email</p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" class="login-form cf-style-1" action="{{ route('frontend.password.email') }}" method="post">
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
                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">Gửi email</button>
                            </div><!-- /.buttons-holder -->
                        </form><!-- /.cf-style-1 -->

                    </section><!-- /.sign-in -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </main><!-- /.authentication -->
    <!-- ========================================= MAIN : END ========================================= -->
@endsection