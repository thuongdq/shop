<link href="{{ asset('backend/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('backend/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<form action="{{ route('admin.category.store') }}" method="post">
    {{ csrf_field() }}
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
                               value="{{ old('name') }}">
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
                        <label>Thứ tự ưu tiên</label>
                        <input type="text" class="form-control" id="order" name="order" placeholder="Thứ tự ưu tiên"
                               value="{{ old('order') }}">
                        <span class="help-block">{{ $errors->first('order') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
                        <label>Chuyên mục cha</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value="0">Không</option>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('parent') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="help-block">{{ $errors->first('parent') }}</span>
                    </div>

                    <div class="form-group">
                    <label for="single" class="control-label">Danh mục cha</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="0">Không</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parent') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>






            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Huỷ</button>
        <button type="button" class="btn blue" id="action">Lưu lại</button>
    </div>
</form>
<script type="text/javascript">
    $('#action').on('click', function(){
        alert(123123);
    });
</script>
