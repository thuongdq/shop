<link href="{{ asset('./backend/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('./backend/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('./backend/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('./backend/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('./backend/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ asset('./backend/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ asset('./backend/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('./backend/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        if (!jQuery().wysihtml5) {
            return;
        }
        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": [""],
                "font-styles": true,
                "emphasis": true,
                "lists": true,
                "html": false,
                "link": true,
                "image": false
            });
        }
    });
</script>
<form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post" id="form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title font-blue uppercase sbold text-center">Tạo danh mục con demo</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 ">
                @if(isset($report))
                    <div class="alert alert-success">{!! $report !!}</div>
                @endif
                {{--                {!! view_nestable($root_category->id, $root_category->id, $categories_all) !!}--}}
                <div class="caption title-box">
                    <i class="fa fa-info-circle font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Thông tin</span>
                </div>
                <div class="form-group">
                    <label for="single" class="control-label">Danh mục cha</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="{{ $root_category->id }}">{{ $root_category->name }}</option>
                        @php
                            $disabled = get_all_child($category->id, $categories_all);
                            $disabled[] = $category->id;
                        @endphp
                        {!! view_select_list($category->parent, $root_category, $disabled, $categories_all, "&nbsp;&nbsp;", '') !!}
                    </select>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label>Tên chuyên mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên chuyên mục"
                           value="{{ $category->name }}">
                    <span class="help-block">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label>Mô tả</label>
                    <textarea class="wysihtml5 form-control" rows="6" id="description" name="description" data-error-container="#editor1_error">{{ $category->description }}</textarea>
                    <span class="help-block">{{ $errors->first('description') }}</span>
                </div>
                <div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
                    <label>Thứ tự ưu tiên</label>
                    <input type="text" class="form-control" id="order" name="order" placeholder="Thứ tự ưu tiên"
                           value="{{ $category->order }}">
                    <span class="help-block">{{ $errors->first('order') }}</span>
                </div>

                <div class="caption title-box">
                    <i class="fa fa-search font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">SEO</span>
                </div>
                <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : ''}}">
                    <label>SEO Title</label>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" placeholder="Meta Title"
                           value="{{ $category->seo_title }}">
                    <span class="help-block">{{ $errors->first('seo_title') }}</span>
                </div>
                <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                    <label>Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                           value="{{ $category->slug }}">
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                </div>
                <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
                    <label>Meta Description</label>
                    <textarea rows="6" id="meta_description" name="meta_description" class="form-control">{{ $category->meta_description }}</textarea>
                    <span class="help-block">{{ $errors->first('meta_description') }}</span>
                </div>
                <div class="form-group {{ $errors->has('keyword') ? 'has-error' : ''}}">
                    <label>Meta Keywords</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Slug"
                           value="{{ $category->keywords }}">
                    <span class="help-block">{{ $errors->first('keyword') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Huỷ</button>
        <button type="button" class="btn blue" id="action">Lưu lại</button>
    </div>
    <textarea id="nestable_list_{{ $root_category->id }}_init" class="form-control col-md-12 margin-bottom-10">{{get_data_nestable($root_category->id, $root_category->id, $categories_all)}}</textarea>
    <script type="text/javascript">
        $("#nestable_list_{{ $root_category->id }}_init").hide();
        @if(isset($report))
            $('#ajax-modal').modal('hide')
            swal({
                title: "Cập nhật",
                text: "Danh mục {{ $category->name }} cập nhật thành công",
                type: "success",
                allowOutsideClick: "true",
                showConfirmButton: "btn-success",
            });

            var id = {{$root_category->id}};
            var data = jQuery.parseJSON($("#nestable_list_"+id+"_init").val());
            init_nestable(id, data);
        @endif

        $('#action').on('click', function(){
            axios({
                method: 'post',
                url: "{{ route('admin.category.update-item', ['root' => $root, 'id' => $category->id]) }}",
                data: {
                    'parent': $("#parent").val(),
                    'name': $("#name").val(),
                    'description' : $("#description").val(),
                    'order' : $("#order").val(),
                    'seo_title' : $("#seo_title").val(),
                    'slug': $("#slug").val(),
                    'meta_description' : $("#meta_description").val(),
                    'keyword' : $("#keyword").val()
                }
            })
                .then(function (response) {
                    $("#form").html(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });

            {{--        alert($("#nestable_list_{{ $root_category->id }}").html());--}}
        });

        function init_nestable(id, data){
            //create data for nestable
//            var data = jQuery.parseJSON($("#nestable_list_"+id+"_init").val());
            var html = get_view_nestable(data, '');
            $("#nestable_list_"+id).html(html);

            //load ajax:
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
                '</div>';
            $.fn.modalmanager.defaults.resize = true;
            var $modal = $('#ajax-modal');
            $('.ajax-create, .ajax-update').on('click', function(){
                // create the backdrop and wait for next modal to be triggered
                $('body').modalmanager('loading');
                var el = $(this);
                setTimeout(function(){
                    $modal.load(el.attr('data-url'), '', function(){
                        $modal.modal();
                    });
                }, 1000);
            });
        }

        function get_view_nestable(data, result){
            result += '<ol class="dd-list">';
            $.each(data, function( index, value ) {
                result += '<li class="dd-item" data-id="'+value.id+'">';
                result += '<div class="dd-handle"> '+value.name+' </div>';
                if (typeof value.children != "undefined") {
                    result = get_view_nestable(value.children, result);
                }
                result += value.extends;
                result += '</li>';

            });
            result += '</ol>';
            return result;
        }
    </script>
</form>
