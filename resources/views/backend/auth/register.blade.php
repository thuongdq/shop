@extends('backend.auth')
@section('content')
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{ route('admin.register') }}" method="post" style="display: block">
        {{ csrf_field() }}
        <h3>Đăng ký nhanh</h3>
        <p> Nhập thông tin cá nhân cả bạn vào bên dưới: </p>
        @if($errors->first('name') || $errors->first('email') || $errors->first('password') || $errors->first('agree'))
            <div class="alert alert-block alert-danger fade in">
                <button class="close" data-close="alert"></button>
                <h4 class="alert-heading">Lỗi rồi!</h4>
                @foreach($errors as $e)
                    {{ $e }}
                @endforeach
                @if ($errors->has('name'))
                    <span>{{ $errors->first('name') }}</span>
                @endif
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
                @if ($errors->has('agree'))
                    <span>{{ $errors->first('agree') }}</span>
                @endif
            </div>
        @endif
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Họ tên</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Họ tên" name="name" value="{{ old('name') }}"/>
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="{{ old('email') }}"/>
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Mật khẩu đăng nhập" name="password" />
            </div>
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Nhập lại mật khẩu</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Nhập lại mật khẩu trên" name="password_confirmation" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="agree" /> Tôi đồng ý với
                <a href="javascript:;">Các điều khoản dịch vụ </a> &
                <a href="javascript:;">Chính sách bảo mật </a>
                <span></span>
            </label>
            <div id="register_tnc_error"></div>
        </div>
        <div class="form-actions">
            <a id="register-back-btn" href="{{ route('admin.login') }}" class="btn red btn-outline"> Đăng nhập </a>
            <button type="submit" id="register-submit-btn" class="btn green pull-right"> Đăng ký </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
@endsection

{{--@extends('backend.master')--}}
{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
