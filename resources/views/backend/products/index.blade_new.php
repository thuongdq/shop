@extends('backend.master')
@section('css-plugins')
    <link href="{{ asset('backend/global/plugins/datatables/datatables.min.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"  rel="stylesheet" type="text/css" />
@endsection
@section('js-plugins')
    {{--<script src="{{ asset('backend/global/scripts/datatable.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('backend/global/scripts/datatable.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/datatables/datatables.min.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"  type="text/javascript"></script>
@endsection
@section('js-scripts')
    <script src="{{ asset('backend/pages/scripts/table-datatables-ajax.js') }}"  type="text/javascript"></script>
@endsection
@section('content')
    @php
        $status = [
            0 => "Xoá",
            1 => "Hiển thị",
            2 => "Chưa duyệt"
        ];
    @endphp
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Tables</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Datatables</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
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
                            <i class="icon-user"></i> Something else here</a>
                    </li>
                    <li class="divider"> </li>
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
    <h1 class="page-title"> Ajax Datatables
        <small>basic datatable samples</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="note note-danger">
                <p> NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only. </p>
            </div>
            <!-- Begin: Demo Datatable 1 -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Ajax Datatable</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Tools </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;"> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Export to CSV </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Export to XML </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:;"> Print Invoices </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <div class="table-actions-wrapper">
                            <span> </span>
                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                <option value="">Select...</option>
                                <option value="Cancel">Cancel</option>
                                <option value="Cancel">Hold</option>
                                <option value="Cancel">On Hold</option>
                                <option value="Close">Close</option>
                            </select>
                            <button class="btn btn-sm green table-group-action-submit">
                                <i class="fa fa-check"></i> Submit</button>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th width="6%"> ID </th>
                                <th width="15%"> Tên sản phẩm </th>
                                <th width="15%"> Danh mục </th>
                                <th width="10%"> Giá bán </th>
                                <th width="10%"> Số lượng </th>
                                <th width="15%"> Ngày tạo </th>
                                <th width="10%"> Trạng thái </th>
                                <th width="11%"> Chức năng </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="product_id"> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="product_name"> </td>
                                <td>
                                    <select name="product_category" class="form-control form-filter input-sm">
                                        <option value="">Lưa chọn...</option>
                                        <option value="1">Mens</option>
                                        <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Footwear</option>
                                        <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clothing</option>
                                        <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accessories</option>
                                        <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fashion Outlet</option>
                                        <option value="6">Football Shirts</option>
                                        <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Premier League</option>
                                        <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Football League</option>
                                        <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serie A</option>
                                        <option value="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bundesliga</option>
                                        <option value="11">Brands</option>
                                        <option value="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adidas</option>
                                        <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nike</option>
                                        <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Airwalk</option>
                                        <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USA Pro</option>
                                        <option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kangol</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm" name="product_price_from" placeholder="Từ" /> </div>
                                    <input type="text" class="form-control form-filter input-sm" name="product_price_to" placeholder="Đến" /> </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm" name="product_quantity_from" placeholder="Từ" /> </div>
                                    <input type="text" class="form-control form-filter input-sm" name="product_quantity_to" placeholder="Đến" /> </td>
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="Từ">
                                        <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_created_to " placeholder="Đến">
                                        <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                    </div>
                                </td>
                                <td>
                                    <select name="product_status" class="form-control form-filter input-sm">
                                        <option value="">Lựa chọn...</option>
                                        <option value="published">Published</option>
                                        <option value="notpublished">Not Published</option>
                                        <option value="deleted">Deleted</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <button class="btn btn-sm btn-default filter-cancel">
                                        <i class="fa fa-times"></i> Reset</button>
                                </td>
                            </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End: Demo Datatable 1 -->
        </div>
    </div>
@endsection