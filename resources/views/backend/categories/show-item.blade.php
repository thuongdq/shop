<link href="{{ asset('backend/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('backend/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />



<script src="{{ asset('backend/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        if (!jQuery().wysihtml5) {
            return;
        }
        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["./backend/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"],
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
                <div class="caption title-box">
                    <i class="fa fa-info-circle font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Thông tin</span>
                    <div class="alert alert-success"></div>
                </div>
                <div class="form-group">
                    <label for="single" class="control-label">Danh mục cha</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="{{ $root_category->id }}">{{ $root_category->name }}</option>
                        {!! view_select_list($category->parent, $root_category, $categories_all, "&nbsp;&nbsp;") !!}
                    </select>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label>Tên chuyên mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên chuyên mục"
                           value="{{ $category->name }}">
                    <span class="help-block">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                    <label>Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                           value="{{ $category->slug }}">
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label>Mô tả</label>
                    <textarea class="wysihtml5 form-control" rows="6" name="description" data-error-container="#editor1_error">{{ $category->description }}</textarea>
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
                <div class="form-group {{ $errors->has('meta_title') ? 'has-error' : ''}}">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title"
                           value="{{ $category->meta_title }}">
                    <span class="help-block">{{ $errors->first('meta_title') }}</span>
                </div>
                <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                    <label>Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Slug"
                           value="{{ $category->meta_keywords }}">
                    <span class="help-block">{{ $errors->first('meta_keywords') }}</span>
                </div>
                <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
                    <label>Meta Description</label>
                    <textarea rows="6" name="description" class="form-control">{{ $category->meta_description }}</textarea>
                    <span class="help-block">{{ $errors->first('meta_description') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Huỷ</button>
        <button type="button" class="btn blue" id="action">Lưu lại</button>
    </div>
    <script type="text/javascript">
        $('#action').on('click', function(){
            axios({
                method: 'post',
                url: "{{ route('admin.category.update-item', ['root' => $root, 'id' => $category->id]) }}",
                data: {
                    'name': $("#name").val(),
                    'slug': $("#slug").val(),
                    'order' : $("#order").val(),
                    'parent': $("#parent").val(),
                }
            })
            .then(function (response) {
                if(response == "success"){
                    alert("ok");
                }else{
                    $("#form").html(response.data);
                }
            })
            .catch(function (error) {
                console.log(error);
            });

        });
    </script>
</form>
