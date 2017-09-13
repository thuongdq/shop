@extends('backend.master')
@section('css-plugins')
    <link href="{{ asset('backend/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js-plugins')
    <script src="{{ asset('backend/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
@endsection
@section('js-scripts')
    {{--    <script src="{{ asset('backend/pages/scripts/ecommerce-products.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('backend/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript">
        var EcommerceProducts = function () {

            var initPickers = function () {
                //init date pickers
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    autoclose: true
                });
            }
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var handleProducts = function() {
                var grid = new Datatable();

                grid.init({

                    src: $("#datatable_products"),
                    onSuccess: function (grid) {
                        // execute some code after table records loaded
                    },
                    onError: function (grid) {
                        // execute some code on network or other general error
                        // execute some code on network or other general error
                    },
                    loadingMessage: 'Loading...',
                    dataTable: {
                        "bStateSave": true,
                        // save custom filters to the state
                        "fnStateSaveParams":    function ( oSettings, sValue ) {
                            $("#datatable_products tr.filter .form-control").each(function() {
                                sValue[$(this).attr('name')] = $(this).val();
                            });

                            return sValue;
                        },

                        // read the custom filters from saved state and populate the filter inputs
                        "fnStateLoadParams" : function ( oSettings, oData ) {
                            //Load custom filters
                            $("#datatable_products tr.filter .form-control").each(function() {
                                var element = $(this);
                                if (oData[element.attr('name')]) {
                                    element.val( oData[element.attr('name')] );
                                }
                            });

                            return true;
                        },
                        "lengthMenu": [
                            [10, 20, 50, 100, 150],
                            [10, 20, 50, 100, 150] // change per page values here
                        ],
                        "pageLength": 20, // default record count per page
                        "ajax": {
                            "url": '{{ route('api.product.datatableListProduct') }}'
                        },
                        "order": [
                            [1, "asc"]
                        ],
                        "language": {
                            "aria": {
                                "sortAscending": ": activate to sort column ascending",
                                "sortDescending": ": activate to sort column descending"
                            },
                            "paginate": {
                                "previous": 'Trước',
                                "next": 'Sau',
                                "page": "Trang",
                                "pageOf": "của"
                            },
                            "emptyTable": "Dữ liệu đạng được cập nhật",
                            "info": " | Tổng cộng _MAX_ bản ghi",
                            "infoEmpty": "Không tìm thấy dữ liệu phù hợp",
                            "infoFiltered": "(filtered1 from _MAX_ total entries)",
                            "lengthMenu": " | Hiển thị _MENU_ Trường",
//                            "search": "Tìm kiếm:",
//                            "zeroRecords": "No matching records found"
                        },
                        "buttons": [
                            { extend: 'print', className: 'btn default' },
                            { extend: 'copy', className: 'btn default' },
                            { extend: 'pdf', className: 'btn default' },
                            { extend: 'excel', className: 'btn default' },
                            { extend: 'csv', className: 'btn default' },
                            {
                                text: 'Reload',
                                className: 'btn default',
                                action: function ( e, dt, node, config ) {
                                    dt.ajax.reload();
                                    alert('Datatable reloaded!');
                                }
                            }
                        ]
                    }
                });


                // handle group actionsubmit button click
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("id", grid.getSelectedRows());
                        grid.getDataTable().ajax.reload();
                        grid.clearAjaxParams();
                    } else if (action.val() == "") {
                        App.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'Please select an action',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    } else if (grid.getSelectedRowsCount() === 0) {
                        App.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'No record selected',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    }
                });

                //grid.setAjaxParam("customActionType", "group_action");
                //grid.getDataTable().ajax.reload();
                //grid.clearAjaxParams();

                // handle datatable custom tools
                $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
                    var action = $(this).attr('data-action');
                    grid.getDataTable().button(action).trigger();
                });
            }

            return {

                //main function to initiate the module
                init: function () {

                    handleProducts();
                    initPickers();

                }

            };

        }();

        jQuery(document).ready(function() {
            EcommerceProducts.init();
        });


    </script>
@endsection
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>eCommerce</span>
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
    <h1 class="page-title"> Danh sách sản phẩm
        <small>Quản lý sản phẩm</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="note note-danger">
                <p> NOTE: tìm kiếm theo danh mục và ngày tháng chưa xử lý. </p>
            </div>
            @if(session('message'))
                <div class="alert alert-success">
                    {}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
             @endif
            <!-- Begin: life time stats -->
            <div class="portlet ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Danh sách sản phẩm</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-circle btn-info">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Tạo sản phẩm </span>
                        </a>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Xuất dữ liệu </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                                <li>
                                    <a href="javascript:;" data-action="0" class="tool-action">
                                        <i class="icon-printer"></i> In</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="1" class="tool-action">
                                        <i class="icon-check"></i> Copy</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="2" class="tool-action">
                                        <i class="icon-doc"></i> PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="3" class="tool-action">
                                        <i class="icon-paper-clip"></i> Excel</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="4" class="tool-action">
                                        <i class="icon-cloud-upload"></i> CSV</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:;" data-action="5" class="tool-action">
                                        <i class="icon-refresh"></i> Tải lại</a>
                                </li>
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
                                <option value="">Lựa chọn...</option>
                                @foreach($status as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-success table-group-action-submit">
                                <i class="fa fa-check"></i> Cập nhật</button>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th width="6%"> Mã </th>
                                <th width="20%"> Tên sản phẩm </th>
                                <th width="20%"> Danh mục </th>
                                <th width="10%"> Giá bán (đ) </th>
                                <th width="9%"> Số lượng </th>
                                <th width="12%"> Ngày tạo </th>
                                <th width="10%"> Trạng thái </th>
                                <th width="13%"> Lượt xem </th>
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
                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_created_to" placeholder="Đến">
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
                                        @foreach($status as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
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
            <!-- End: life time stats -->
        </div>
    </div>
@endsection