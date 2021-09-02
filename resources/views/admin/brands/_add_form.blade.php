<div class="addBrandForm">
    <form class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            {!! Form::label('date_add', 'Начало активности:', ['class' => 'col-md-4 control-label']); !!}
            <div class="col-md-8">
                {!! Form::text('date_add', '', ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'', 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('date_end', 'Окончание активности:', ['class' => 'col-md-4 control-label']); !!}
            <div class="col-md-8">
                {!! Form::text('date_end', '', ['class'=>'form-control', 'id'=>'datepicker2', 'placeholder'=>'', 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Заголовок</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="title" value="" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Алиас</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="slug" value="" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Картинка</label>
            <div class="col-md-8">
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