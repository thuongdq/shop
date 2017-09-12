@extends('backend.master')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Blank Page</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Page Layouts</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                        data-toggle="dropdown"> Actions
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="#">
                            <i class="icon-bell"></i> Action</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-shield"></i> Another action</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-category"></i> Something else here</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <i class="icon-bag"></i> Separated link</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Quản lý chuyên mục
        <small>Cập nhật chuyên mục</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="container">
        {{--{{ dd($errors->all()) }}--}}
        <div class="row">
            <div>
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Danh sách chuyên mục</a>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label>Tên chuyên mục</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên chuyên mục"
                                   value="{{ $category->name }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
                            <label>Thứ tự ưu tiên</label>
                            <input type="text" class="form-control" id="order" name="order" placeholder="Thứ tự ưu tiên"
                                   value="{{ $category->order }}">
                            <span class="help-block">{{ $errors->first('order') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
                            <label>Chuyên mục cha</label>
                            <select name="parent" id="parent" class="form-control">
                                <option value="0">Không</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $sCategory)
                                        <option value="{{ $sCategory->id }}" {{ $category->parent == $sCategory->id ? 'selected' : '' }} >{{ $sCategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('parent') }}</span>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật chuyên mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection







