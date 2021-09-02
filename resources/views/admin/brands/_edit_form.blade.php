<div class="brandForm">
    <input type="hidden" id="brand_id" value="{{ $data->id }}">
    <form class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            {!! Form::label('date_add', 'Начало активности:', ['class' => 'col-md-4 control-label']); !!}
            <div class="col-md-8">
                {!! Form::text('date_add', ($data->date_add != '') ? $data->date_add : '', ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'', 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('date_end', 'Окончание активности:', ['class' => 'col-md-4 control-label']); !!}
            <div class="col-md-8">
                {!! Form::text('date_end', ($data->date_end != '') ? $data->date_end : '', ['class'=>'form-control', 'id'=>'datepicker2', 'placeholder'=>'', 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Заголовок</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="title" value="{{ ($data->title != '') ? $data->title : '' }}" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Алиас</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="slug" value="{{ ($data->slug != '') ? $data->slug : '' }}" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Картинка</label>
            <div class="col-md-8">
                @if(!empty($data->image))
                    <img width="150" src="/public/uploads/brands/{{ $data->image }}" style="margin-bottom: 10px">
                @endif
                <input type="file" id="image">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // date
        $('#datepicker, #datepicker2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>