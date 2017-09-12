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
                            <i class="icon-order"></i> Something else here</a>
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
    <h1 class="page-title"> Quản lý đơn hàng
        <small>Danh sách đơn hàng</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="container">
        <div class="row">
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
                                <td>Tên khách hàng</td>
                                <td>Số điện thoại</td>
                                <td>Tài khoản</td>
                                <td>Số sản phẩm</td>
                                <td>Ngày tạo</td>
                                <td>Ngày cập nhật</td>
                                <td>Chức năng</td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>
                                        @if ($order->user !== null)
                                            <i class="glyphicon glyphicon-ok text-success"></i>
                                        @else
                                            <i class="glyphicon glyphicon-remove text-danger"></i>
                                        @endif
                                    </td>
                                    <td>{{ $order->products()->count() }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.order.show', ['id'=>$order->id]) }}"
                                           title="Edit"
                                           class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.order.delete', ['id'=>$order->id]) }}"
                                           title="Delete"
                                           class="btn btn-danger"
                                           onclick="event.preventDefault(); window.confirm('Bạn đã chắc chắn muốn xoá chưa ?') ? document.getElementById('order-delete-{{ $order->id }}').submit() : 0;">Delete</a>
                                        <form action="{{ route('admin.order.delete', ['id' => $order->id]) }}"
                                              method="post"
                                              id="order-delete-{{ $order->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
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
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection