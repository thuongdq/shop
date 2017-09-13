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
                            <i class="icon-product"></i> Something else here</a>
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
    <h1 class="page-title"> Quản lý sản phẩm
        <small>Danh sách sản phẩm</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="container">
        <div class="row">
            <div>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Tạo sản phẩm</a>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Tên</td>
                                <td>Code</td>
                                <td>Giá bán</td>
                                <td>Số lượng</td>
                                <td>Hình ảnh</td>
                                <td>Tác giả</td>
                                <td>Ngày cập nhật</td>
                                <td style="min-width: 175px">Chức năng</td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.show', ['id'=>$product->id]) }}"
                                           title="{{ $product->name }}" class="thumbnail-view">
                                            <img src="{{ media_get_image_src($product->image, '_thumb') }}"
                                                 alt="Image" class="img-responsive img-thumbnail">
                                        </a>
                                    </td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.setFeaturedProduct', ['id'=>$product->id]) }}"
                                           title="Edit" class="btn btn-{{ $product->featured ? 'success' : 'default' }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('product-feature-{{ $product->id }}').submit();">
                                            <i class="glyphicon glyphicon-eye-{{ $product->featured ? 'open' : 'close' }}"></i>
                                        </a>
                                        <a href="{{ route('admin.product.show', ['id'=>$product->id]) }}" title="Edit"
                                           class="btn btn-primary">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.product.delete', ['id'=>$product->id]) }}"
                                           title="Delete" class="btn btn-danger"
                                           onclick="event.preventDefault(); window.confirm('Bạn đã chắc chắn muốn xoá chưa ?') ? document.getElementById('product-delete-{{ $product->id }}').submit() : 0;">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                        <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                              method="post" id="product-delete-{{ $product->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                        <form action="{{ route('admin.product.setFeaturedProduct', ['id' => $product->id]) }}"
                                              method="post" id="product-feature-{{ $product->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('patch') }}
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection