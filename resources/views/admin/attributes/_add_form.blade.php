<div class="addPropsForm">
    <form class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" value="{{ $id }}" id="category_id">
        <div class="form-group">
            <label class="col-md-3 control-label">Сортировка</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="sort_order" value="0">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Заголовок свойства</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип</label>
            <div class="col-md-9">
                <select id="form_field" class="form-control">
                    <option value="select">select</option>
                    <option value="multiple">multiple</option>
                    <option value="text">text</option>
                    <option value="checkbox">checkbox</option>
                    <option value="radio">radio</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип для фильтра</label>
            <div class="col-md-9">
                <select id="front_form_field" class="form-control">
                    <option value="select">select</option>
                    <option value="multiple">multiple</option>
                    <option value="text">text</option>
                    <option value="checkbox">checkbox</option>
                    <option value="radio">radio</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Тип поля</label>
            <div class="col-md-9">
                <select id="field_type" class="form-control">
                    <option value="1">Строка</option>
                    <option value="2">Число</option>
                </select>
            </div>
        </div>
    </form>
</div>