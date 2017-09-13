@extends('backend.master')
@section('title')
    Tạo sản phẩm mới
@endsection
@section('css-plugins')
    <link href="{{ asset('backend/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@section('js-plugins')
    <script src="{{ asset('backend/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/typeahead/handlebars.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/global/plugins/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>
@endsection

@section('js-scripts')
    {{--    <script src="{{ asset('backend/pages/scripts/components-bootstrap-tagsinput.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript">
        var citynames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '<?php echo route('admin.design.listTags')?>',
                filter: function (list) {
                    return $.map(list, function (cityname) {
                        return {name: cityname};
                    });
                }
            }
        });

        citynames.initialize();

        //        console.log(citynames);
        $('#typeahead_tag').tagsinput({
            typeaheadjs: {
                name: 'citynames',
                displayKey: 'name',
                valueKey: 'name',
                source: citynames.ttAdapter()
            }
        });
    </script>
@endsection

@section('js-bottom')
    <script type="text/javascript" src="{{ asset('backend/global/plugins/vue-js/vue.js') }}"></script>
    <script type="text/x-template" id="tdq-attributes-template">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Thuộc tính</th>
                <th>Giá trị</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, key) in attributes">
                <td>
                    <input type="text" v-bind:name="'attributes['+ key +'][name]'" v-model="item.name"
                           class="form-control" placeholder="Thuộc tính">
                </td>
                <td>
                    <input type="text" v-bind:name="'attributes['+ key +'][value]'" v-model="item.value"
                           class="form-control" placeholder="Giá trị">
                </td>
                <td>
                    <button type="button" v-if="key != 0" v-on:click="deleteAttribute(item)" class="btn btn-danger"><i
                                class="glyphicon glyphicon-remove"></i></button>
                    <button type="button" v-if="key == attributes.length - 1" v-on:click="addAttribute"
                            class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
    </script>
    <script type="text/javascript">
        @php
        $attributes = old('attributes') ? json_encode(old('attributes')) : null;
        @endphp
        Vue.component('tdq-attributes', {
            template: '#tdq-attributes-template',
            data: function () {
                var attributes = [
                    {name: '', value: ''}
                ];
                @if($attributes)
                    attributes =  {!! $attributes !!};
                @endif
                    return {
                    attributes: attributes
                };
            },
            methods: {
                addAttribute: function () {
                    this.attributes.push({name: '', value: ''});
                },
                deleteAttribute: function (obj) {
                    this.attributes.splice(this.attributes.indexOf(obj), 1);
                }
            }
        });
        new Vue({
            el: '#tdq-app'
        });

//        $("#name,#code").change(function(){
//            get_slug();
//        });

        function get_slug(){
            if($("#slug").val() == ""){
                var data = [];
                data['name'] = $("#name").val();
                data['code'] = $("#code").val();
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '<?php echo route('admin.design.getSlug')?>', // AJAX handler
                    data: {'name':$("#name").val(), 'code':$("#code").val(), },
                    type: 'POST',
                    beforeSend: function(xhr) {
                        $("#slug").attr("placeholder",'Đang xử lý...'); // change the button text, you can also add a preloader image
                    },
                    success: function(result) {
                        $("#slug").val(result);
                    }
                });
            }
        }
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
        <small>Thêm sản phẩm</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="container">
        <div class="row">
            <div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Danh sách sản phẩm</a>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên sản phẩm"
                                   value="{{ old('name') }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                            <label>Mã sản phẩm</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Mã sản phẩm"
                                   value="{{ old('code') }}">
                            <span class="help-block">{{ $errors->first('code') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                            <label>Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                                   value="{{ old('slug') }}">
                            <span class="help-block">{{ $errors->first('slug') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                            <label>Nội dung</label>
                            <textarea name="content" id="content" rows="5" class="form-control"
                                      placeholder="Nội dung">{{ old('content') }}</textarea>
                            <span class="help-block">{{ $errors->first('content') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('regular_price') ? 'has-error' : ''}}">
                            <label>Giá thị trường</label>
                            <input type="number" min="0" class="form-control" id="regular_price" name="regular_price"
                                   placeholder="Giá thị trường"
                                   value="{{ old('regular_price') }}">
                            <span class="help-block">{{ $errors->first('regular_price') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
                            <label>Giá bán</label>
                            <input type="number" min="0" class="form-control" id="sale_price" name="sale_price"
                                   placeholder="Giá bán"
                                   value="{{ old('sale_price') }}">
                            <span class="help-block">{{ $errors->first('sale_price') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('original_price') ? 'has-error' : ''}}">
                            <label>Giá gốc</label>
                            <input type="number" min="0" class="form-control" id="original_price" name="original_price"
                                   placeholder="Giá gốc"
                                   value="{{ old('original_price') }}">
                            <span class="help-block">{{ $errors->first('original_price') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
                            <label>Số lượng</label>
                            <input type="number" min="0" class="form-control" id="quantity" name="quantity"
                                   placeholder="Số lượng"
                                   value="{{ old('quantity') }}">
                            <span class="help-block">{{ $errors->first('quantity') }}</span>
                        </div>

                        @permission('upload-images')
                        <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }}">
                            <label for="image">Thư viện hình ảnh của sản phẩm</label>
                            <input type="file" class="form-control" id="image" name="image"
                                   value="{{ old('image') }}">
                            <span class="help-block">{{ $errors->first('image') }}</span>
                        </div>


                        {{--Up load Thư viện hình ảnh--}}
                        <div class="form-group {{ $errors->has('images.*') ? 'has-error' : '' }}">
                            <label for="images">Hình sản phẩm</label>
                            <input type="file" class="form-control" id="images" name="images[]"
                                   value="{{ old('images') }}" multiple>
                            <span class="help-block">{{ $errors->first('images.*') }}</span>
                        </div>
                        @endpermission

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                            <label>Chuyên mục cha</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @if(count($categories[0]) > 0)
                                    @foreach($categories[0] as $category)
                                        @if($category->id != 1)
                                            <optgroup label="{{ $category->name }}">
                                                @if(isset($categories[$category->id]))
                                                    @foreach($categories[$category->id] as $childCategory)
                                                        <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }} >{{ $childCategory->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                                @endif
                                            </optgroup>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('category_id') }}</span>
                        </div>

                        <div class="form-group">
                            <label>Typeahead</label>
                            <input name="tags" type="text" value="{{ old('tags') }}" id="typeahead_tag">
                        </div>

                        <div class="form-group" id="tdq-app">
                            <tdq-attributes></tdq-attributes>
                        </div>

                        <button type="submit" class="btn btn-success">Tạo sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection







