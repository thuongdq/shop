@extends('backend.auth')
@section('content')
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{ route('admin.password.email') }}" method="post" style="display: block;">
        {{ csrf_field() }}
        <h3>Quên mật khẩu ?</h3>
        <p> Nhập địa chỉ email của bạn dưới đây để đổi mật khẩu. </p>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ $email or old('email') }}"/>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="form-actions">
            <a href="{{ route('admin.login') }}" id="back-btn" class="btn red btn-outline">Trang chủ </a>
            <button type="submit" class="btn green pull-right"> Gửi </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
@endsection

{{--/*--}}
{{--@extends('backend.master')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Reset Password</div>--}}
                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.email') }}">--}}
                        {{--{{ csrf_field() }}--}}
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

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Send Password Reset Link--}}
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
{{--*/--}}