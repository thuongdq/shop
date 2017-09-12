@extends('backend.auth')
@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="POST" action="{{ route('admin.login') }}">
        {{ csrf_field() }}
        <h3 class="form-title">Đăng nhập</h3>
        @if($errors->first('email') || $errors->first('password'))
            <div class="alert alert-block alert-danger fade in">
                <button class="close" data-close="alert"></button>
                <h4 class="alert-heading">Lỗi rồi!</h4>
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
            </div>
        @endif
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="{{ old('email') }}" placeholder="Email" name="email" />
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
            </div>
        </div>
        <div class="form-actions">
            <label class="rememberme mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}/> Tự động đăng nhập
                <span></span>
            </label>
            <button type="submit" class="btn green pull-right"> Đăng nhập </button>
        </div>
        <div class="login-options">
            <h4>Hoặc đăng nhập bằng</h4>
            <ul class="social-icons">
                <li>
                    <a class="facebook" data-original-title="facebook" href="javascript:;"> </a>
                </li>
                <li>
                    <a class="twitter" data-original-title="Twitter" href="javascript:;"> </a>
                </li>
                <li>
                    <a class="googleplus" data-original-title="Goole Plus" href="javascript:;"> </a>
                </li>
                <li>
                    <a class="linkedin" data-original-title="Linkedin" href="javascript:;"> </a>
                </li>
            </ul>
        </div>
        <div class="forget-password">
            <h4>Bạn quên mật khẩu ?</h4>
            <p> Đừng lo lắng, nhấn
                <a href="{{ route('admin.password.request') }}" id="forget-password"> đây </a>để lấy mật khẩu mới. </p>
        </div>
        <div class="create-account">
            <p> Bạn chưa có tài khoản ?&nbsp;
                <a href="{{ route('admin.register') }}" id="register-btn"> Tạo tài khoản mới </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
@endsection