<link href="{{ asset('backend/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('backend/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/jstree/dist/jstree.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('backend/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('#tree_view_categories').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $('#event_result').html('Selected: ' + r.join(', '));
        $('#parent').val(r.join(', '));
        $('#view_parent').html(data.instance.get_node(data.selected).text);
    }).jstree({
        "core" : {
            "multiple" : false,
            "themes" : {
                "responsive": true
            },
            'data': {!! json_encode(get_data_jstree($category->parent, $root_category, $categories_all)) !!},
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            },
            "default-selected" : {
                "icon" : "fa fa-folder icon-state-success"
            },
            "file-selected" : {
                "icon" : "fa fa-check icon-state-success"
            },
        },
        "plugins": ["types"]
    });
</script>
{{--{{dd(json_encode(get_data_jstree($category->parent, $root_category, $categories_all)))}}--}}
<form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Tạo danh mục con demo</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
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
                {{--<div class="form-group">--}}
                    {{--<label for="single" class="control-label">Danh mục cha</label>--}}
                    {{--<select name="parent" id="parent" class="form-control select2">--}}
                        {{--<option value="0">Không</option>--}}
                        {{--@if(isset($categories_all[$root]))--}}
                            {{--@foreach($categories_all[$root] as $cat)--}}
                                {{--<option value="{{ $cat->id }}" {{ $cat->id == $category->parent ? 'selected' : '' }} >{{ $cat->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
                    <label>Danh mục cha: <span id="view_parent"></span></label>
                    <input type="hidden" class="form-control" id="parent" name="parent">
                    <div id="tree_view_categories" class="tree_view_categories_scoll"></div>
                </div>





            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn blue" id="action">Lưu lại</button>
    </div>
</form>
<script type="text/javascript">
//    $('#action').on('click', function(){
//        alert(123123);
//    });
</script>
