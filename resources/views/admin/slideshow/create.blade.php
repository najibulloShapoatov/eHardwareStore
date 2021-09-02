@extends('layouts.admin')

@section('content')

    <h4 class="pull-left">Добавить слайд</h4>
    <div class="clearfix m-b-20"></div>

    @include('includes.form-errors')

    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['method' => 'POST', 'action' => 'Admin\SlideshowController@store', 'files'=> true, 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('date_add', 'Начало активности*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('date_add', date('Y-m-d'), ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('date_end', 'Окончание активности:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('date_end', '', ['class'=>'form-control', 'id'=>'datepicker2', 'placeholder'=>'']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Заголовок*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Заголовок']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('link', 'Ссылка:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('link', '', ['class'=>'form-control', 'placeholder'=>'Ссылка']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Описание:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description', '', ['id'=>'my-editor', 'class'=>'form-control', 'placeholder'=>'', 'rows'=>5]); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('image', 'Картинка (840x395)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('image_mobile', 'Картинка длм моб. (400x400)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::file('image_mobile', null, ['class'=>'form-control']); !!}
                </div>
            </div>

            {!! Form::submit('Добавить', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
            height: 300,
            language: 'ru'
        };
        CKEDITOR.replace('my-editor', options);
    </script>
    <script>
        // date
        jQuery('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        });
        jQuery('#datepicker2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        });
    </script>
@endsection
