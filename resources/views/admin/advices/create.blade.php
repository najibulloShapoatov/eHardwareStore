@extends('layouts.admin')

@section('content')

    <h4 class="pull-left">Добавить совет</h4>
    <div class="clearfix m-b-20"></div>

    @include('includes.form-errors')

    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['method' => 'POST', 'action' => 'Admin\AdviceController@store', 'files'=> true, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('category_id', 'Категория*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    <select class="form-control select2" name="category_id" style='width:400px'>
                        <option value="">-== Выберите ==-</option>
                        @foreach($categories as $item)
                            <option value="{{ $item['id'] }}" disabled>{{ $item['title'] }}</option>
                            @if(!empty($item['child']))
                                @foreach($item['child'] as $sub)
                                    <option value="{{ $sub['id'] }}" disabled>&middot;&middot;&middot; {{ $sub['title'] }}</option>
                                    @if(!empty($sub['child']))
                                        @foreach($sub['child'] as $subsub)
                                            <option value="{{ $subsub['id'] }}">&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot; {{ $subsub['title'] }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('advice_type_id', 'Тип совета*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    <select class="form-control select2" name="advice_type_id" style='width:400px'>
                        <option value="">-== Выберите ==-</option>
                        @foreach($adviceTypes as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('date_add', 'Начало активности*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('date_add', '', ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'']) !!}
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
                    {!! Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Алиас*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('slug', '', ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('preview_text', 'Текст аннонса:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('preview_text', '', ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Описание*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description', '', ['id'=>'my-editor', 'class'=>'form-control', 'placeholder'=>'', 'rows'=>5]); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('image', 'Картинка (730x490)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
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
