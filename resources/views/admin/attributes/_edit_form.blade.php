<div class="editPropsForm">
    <form class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" value="{{ $data->id }}" id="propID">
        <input type="hidden" value="{{ $data->category_id }}" id="category_id">
        <div class="form-group">
            <label class="col-md-3 control-label">Сортировка</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="sort_order" value="{{ $data->sort_order }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Заголовок свойства</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" value="{{ $data->title }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип</label>
            <div class="col-md-9">
                <select id="form_field" class="form-control">
                    <option value="select" {{ ($data->form_field == 'select') ? 'selected="selected"' : '' }}>select</option>
                    <option value="multiple" {{ ($data->form_field == 'multiple') ? 'selected="selected"' : '' }}>multiple</option>
                    <option value="text" {{ ($data->form_field == 'text') ? 'selected="selected"' : '' }}>text</option>
                    <option value="checkbox" {{ ($data->form_field == 'checkbox') ? 'selected="selected"' : '' }}>checkbox</option>
                    <option value="radio" {{ ($data->form_field == 'radio') ? 'selected="selected"' : '' }}>radio</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип для фильтра</label>
            <div class="col-md-9">
                <select id="front_form_field" class="form-control">
                    <option value="select" {{ ($data->front_form_field == 'select') ? 'selected="selected"' : '' }}>select</option>
                    <option value="multiple" {{ ($data->front_form_field == 'multiple') ? 'selected="selected"' : '' }}>multiple</option>
                    <option value="text" {{ ($data->front_form_field == 'text') ? 'selected="selected"' : '' }}>text</option>
                    <option value="checkbox" {{ ($data->front_form_field == 'checkbox') ? 'selected="selected"' : '' }}>checkbox</option>
                    <option value="radio" {{ ($data->front_form_field == 'radio') ? 'selected="selected"' : '' }}>radio</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип поля</label>
            <div class="col-md-9">
                <select id="field_type" class="form-control">
                    <option value="1" {{ ($data->field_type == 1) ? 'selected="selected"' : '' }}>Строка</option>
                    <option value="2" {{ ($data->field_type == 2) ? 'selected="selected"' : '' }}>Число</option>
                </select>
            </div>
        </div>
    </form>
</div>