@extends('backend.master')
@section('css-plugins')
    <link href="{{ asset('backend/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js-plugins')
    <script src="{{ asset('backend/global/plugins/jquery-nestable/jquery.nestable.js') }}" type="text/javascript"></script>
@endsection
@section('js-scripts')
    <script type="text/javascript">
        var UINestable = function () {

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };


            return {
                //main function to initiate the module
                init: function () {
                    @foreach($categories[0] as $category)
                        // activate Nestable
                        $('#nestable_list_{{ $category->id }}').nestable({
                            group: {{ $category->id }}
                        }).on('change', updateOutput);
                        // output initial serialised data
                        updateOutput($('#nestable_list_{{ $category->id }}').data('output', $('#nestable_list_{{ $category->id }}_output')));
                        $('#nestable_list_{{ $category->id }}_output').hide();
                    @endforeach

                    $('#nestable_list_menu').on('click', function (e) {
                        var target = $(e.target),
                            action = target.data('action');
                        if (action === 'expand-all') {
                            $('.dd').nestable('expandAll');
                        }
                        if (action === 'collapse-all') {
                            $('.dd').nestable('collapseAll');
                        }
                    });
                }
            };
        }();

        jQuery(document).ready(function() {
            UINestable.init();
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
                <span>UI Features</span>
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
    <h1 class="page-title"> Nestable List
        <small>Drag & drop hierarchical list with mouse and touch compatibility</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="note note-success">
        <span class="label label-danger">NOTE!</span>
        <span class="bold">Nestable List Plugin </span> supported in Firefox, Chrome, Opera, Safari, Internet Explorer 10 and Internet Explorer 9 only. Internet Explorer 8 not supported. For more info please check out
        <a href="http://dbushell.github.com/Nestable/"
           target="_blank">the official documentation</a>. </div>
    <div class="portlet light bordered">
        <div class="portlet-body ">
            <div class="row">
                <div class="col-md-12">
                    <div class="margin-bottom-10" id="nestable_list_menu">
                        <button type="button" class="btn green btn-outline sbold uppercase" data-action="expand-all">Expand All</button>
                        <button type="button" class="btn red btn-outline sbold uppercase" data-action="collapse-all">Collapse All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($categories[0] as $category)
            <div class="col-md-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            @php
                                $a=array("red","green","blue","yellow","brown");
                            @endphp
                            <i class="icon-bubble font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">{{ $category->name }}</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Option 1</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;">Option 2</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Option 3</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Option 4</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body ">
                        <div class="dd" id="nestable_list_{{ $category->id }}">
                            {!! view_nestable($category->id, $categories) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($categories[0] as $category)
                <textarea id="nestable_list_{{ $category->id }}_output" class="form-control col-md-12 margin-bottom-10"></textarea>
            @endforeach
        </div>
    </div>
@endsection