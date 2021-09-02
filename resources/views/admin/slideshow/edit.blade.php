@extends('layouts.admin')

@section('content')

    <h4 class="pull-left">Редактировать: {{$slide->title}}</h4>
    <div class="clearfix m-b-20"></div>

    @include('includes.form-errors')

    <div class="row">
        <div class="col-sm-12">
            {!! Form::model($slide, ['method' => 'POST', 'action' => ['Admin\SlideshowController@update', $slide->id], 'files'=> true, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('status', 'Активный:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    <div class="checkbox checkbox-primary">
                        @if($slide->is_active == 1)
                            {!! Form::checkbox('is_active', '1', true, ['id' => 'is_active']); !!}
                        @else
                            {!! Form::checkbox('is_active', '1', false, ['id' => 'is_active']); !!}
                        @endif
                        <label for="is_active"></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('date_add', 'Начало активности*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('date_add', $slide->date_add, ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('date_end', 'Окончание активности:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('date_end', $slide->date_end, ['class'=>'form-control', 'id'=>'datepicker2', 'placeholder'=>'']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Заголовок*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('title', $slide->title, ['class'=>'form-control', 'placeholder'=>'Заголовок']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('link', 'Ссылка:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('link', $slide->link, ['class'=>'form-control', 'placeholder'=>'Ссылка']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Описание:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description', $slide->description, ['id'=>'my-editor', 'class'=>'form-control', 'placeholder'=>'', 'rows'=>5]); !!}
                </div>
            </div>
            <div class="form-group forWeb">
                {!! Form::label('image', 'Картинка (840x395)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    @if(!empty($slide->image))
                        <p id="imgID"><img style="border:1px solid #ccc;" src="/public/uploads/slideshow/{{ $slide->image }}" width="200" alt="img"></p>
                        <p id="removeSub">
                            <a href="javascript:" data-id="{{$slide->id}}" data-type="web" class="btn btn-icon btn-primary" id="removeIMG">
                                <i class="fa fa-trash"></i> Удалить картинку
                            </a>
                        </p>
                    @endif
                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
                </div>
            </div>
            <div class="form-group forMob">
                {!! Form::label('image_mobile', 'Картинка для моб. (400x400)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    @if(!empty($slide->image_mobile))
                        <p id="imgID"><img style="border:1px solid #ccc;" src="/public/uploads/slideshow/{{ $slide->image_mobile }}" width="200" alt="img"></p>
                        <p id="removeSub">
                            <a href="javascript:" data-id="{{$slide->id}}" data-type="mob" class="btn btn-icon btn-primary" id="removeIMG">
                                <i class="fa fa-trash"></i> Удалить картинку
                            </a>
                        </p>
                    @endif
                    {!! Form::file('image_mobile', null, ['class'=>'form-control']); !!}
                </div>
            </div>

            {!! Form::submit('Сохранить', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}

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

        // REMOVE IMAGE
        $(document).on("click", "#removeIMG", function(e){
            e.preventDefault();

            var _id = $(this).attr('data-id');
            var _type = $(this).attr('data-type');
            //console.log(_type);

            $.ajax({
                url: '{{ url('/admin/slideshow/deleteimg') }}' + '/' + _id + '/' + _type,
                type: 'GET',
                data: {'id': _id, 'type' : _type},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function( data ) {

                    $('.' + data.cl + ' #imgID').html('');
                    $('.' + data.cl + ' #removeSub').remove();

                },
                error: function( data ) {
                    console.log(data);
                }
            });

        });
    </script>
@endsection
