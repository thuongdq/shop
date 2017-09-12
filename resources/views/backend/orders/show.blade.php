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
        <small>Cập nhật đơn hàng</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="container">
        {{--{{ dd($errors->all()) }}--}}
        <div class="row">
            <div>
                <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Danh sách đơn hàng</a>
            </div>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Thông tin khách hàng
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-2">Họ tên</label>
                        <div class="col-md-10">{{ $order->name }}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2">Số điện thoại</label>
                        <div class="col-md-10">{{ $order->phone }}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2">Email</label>
                        <div class="col-md-10">{{ $order->email }}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2">Địa chỉ</label>
                        <div class="col-md-10">{{ $order->address }}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2">Tài khoản</label>
                        <div class="col-md-10">
                            @if ($order->user !== null)
                                {{ $order->user->name }} ({{ $order->user->email }})
                            @else
                                Không
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    Thông tin sản phẩm
                    <span class="pull-right">{{ $order->updated_at }}</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($order->products as $product)
                                @php
                                    $subtotal = $product->pivot->quantity * $product->sale_price;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <th>{{ get_currency($product->sale_price, 'vn', 'Đ', false) }}</th>
                                    <th>{{ get_currency($subtotal, 'vn', 'Đ', false) }}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right"><strong>Tổng tiền</strong>: {{ get_currency($total, 'vn', 'Đ', false) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection







