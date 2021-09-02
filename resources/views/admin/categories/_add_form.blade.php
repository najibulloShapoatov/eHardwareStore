<link href="/public/admin_assets/plugins/summernote/summernote.css" rel="stylesheet" />

<div class="addCategoryForm">
    <form class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-3 control-label">Сортировка</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="sort_order" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Категория</label>
            <div class="col-md-9">
                <select class="form-control" id="parent_id">
                    <option value="0">-== Выберите категорию ==-</option>
                    @foreach($categories as $item)
                        <option value="{{ $item['id'] }}" {{ ($item['id']==$id) ? 'selected="selected"' : '' }}>{{ $item['title'] }}</option>
                        @if(!empty($item['child']))
                            @foreach($item['child'] as $sub)
                                <option value="{{ $sub['id'] }}" {{ ($sub['id']==$id) ? 'selected="selected"' : '' }}>&middot;&middot;&middot; {{ $sub['title'] }}</option>
                                @if(!empty($sub['child']))
                                    @foreach($sub['child'] as $subsub)
                                        <option value="{{ $subsub['id'] }}" {{ ($subsub['id']==$id) ? 'selected="selected"' : '' }}>&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot; {{ $subsub['title'] }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Заголовок</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Алиас</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="slug" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Картинка</label>
            <div class="col-md-9">
                <input type="file" id="image">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Описание</label>
            <div class="col-md-9" id="summernote">
                <div class="summernote" id="description"></div>
            </div>
        </div>
    </form>
</div>

<script src="/public/admin_assets/plugins/summernote/summernote.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                 // set focus to editable area after initializing summernote
            styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'small', 'div'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36'],

            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    });
</script>