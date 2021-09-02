@extends('layouts.admin')

@section('content')

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Каталог</a></li>
            @if(!empty($cat['parent']))
                <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $cat['parent']['id']) }}">{{ $cat['parent']['title'] }}</a></li>
            @endif
            @if(!empty($cat['section']))
                <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $cat['section']['id']) }}">{{ $cat['section']['title'] }}</a></li>
            @endif
            @if(!empty($cat['child']))
                <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $cat['child']['id']) }}">{{ $cat['child']['title'] }}</a></li>
            @endif
        </ol>
    </nav>

    <div class="clearfix m-b-10"></div>

    @include('includes.form-errors')

    {!! Form::model($data, ['method' => 'POST', 'action' => ['Admin\ProductController@update', $data->id], 'files'=> true, 'class' => 'form-horizontal']) !!}
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">

                    <h4>Редактировать: "{{ $data->title }}"</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::label('product_ID', 'ID:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8" style="margin-top:6px;"><strong>{{ $data->id }}</strong></div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_active', 'Активный:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    <div class="checkbox checkbox-primary">
                                        @if($data->is_active == 1)
                                            {!! Form::checkbox('is_active', '1', true, ['id' => 'is_active']); !!}
                                        @else
                                            {!! Form::checkbox('is_active', '1', false, ['id' => 'is_active']); !!}
                                        @endif
                                        <label for="is_active"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('category_id', 'Категория:*', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="category_id" style='width:400px'>
                                        <option value="">-== Выберите ==-</option>
                                        @foreach($categories as $item)
                                            <option value="{{ $item['id'] }}" {{ ($item['id']==$data->category_id) ? 'selected="selected"' : '' }}>{{ $item['title'] }}</option>
                                            @if(!empty($item['child']))
                                                @foreach($item['child'] as $sub)
                                                    <option value="{{ $sub['id'] }}" {{ ($sub['id']==$data->category_id) ? 'selected="selected"' : '' }}>&middot;&middot;&middot; {{ $sub['title'] }}</option>
                                                    @if(!empty($sub['child']))
                                                        @foreach($sub['child'] as $subsub)
                                                            <option value="{{ $subsub['id'] }}" {{ ($subsub['id']==$data->category_id) ? 'selected="selected"' : '' }}>&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot; {{ $subsub['title'] }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('date_add', 'Начало активности:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('date_add', $data->date_add, ['class'=>'form-control', 'id'=>'datepicker', 'placeholder'=>'']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('date_end', 'Окончание активности:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('date_end', $data->date_end, ['class'=>'form-control', 'id'=>'datepicker2', 'placeholder'=>'']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('brand_id', 'Бренд:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    <select class="form-control" name="brand_id" style='width:400px'>
                                        <option value="">-== Выберите ==-</option>
                                        @foreach($brands as $item)
                                            <option value="{{ $item->id }}" {{ ($item->id == $data->brand_id) ? 'selected="selected"' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('country_id', 'Страна производителя:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    <select class="form-control" name="country_id" style='width:400px'>
                                        <option value="">-== Выберите ==-</option>
                                        @foreach($countries as $item)
                                            <option value="{{ $item->id }}" {{ ($item->id == $data->country_id) ? 'selected="selected"' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('title', 'Заголовок*:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('title', $data->title, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Алиас*:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('slug', $data->slug, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('articul', 'Артикул*:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('articul', $data->articul, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Стоимость (в сом.)*:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('price', $data->price, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('quantity', 'Количество на складе:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('quantity', $data->quantity, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Картинка (500x500):', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    @if(!empty($data->image))
                                        <p id="imgID"><img style="border:1px solid #ccc;" src="/public/uploads/products/{{ $data->id }}/{{ $data->image }}" width="200" alt="img"></p>
                                        <p id="removeSub">
                                            <a href="javascript:" data-id="{{$data->id}}" id="removeIMG">
                                                <i class="fa fa-trash"></i> Удалить картинку
                                            </a>
                                        </p>
                                    @endif
                                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Описание*:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::textarea('description', $data->description, ['id'=>'my-editor', 'class'=>'form-control', 'placeholder'=>'Описание', 'rows'=>5]); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('viewed', 'Просмотрено:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('viewed', $data->viewed, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('sold', 'Продано:', ['class' => 'col-sm-4 control-label']); !!}
                                <div class="col-sm-8">
                                    {!! Form::text('sold', $data->sold, ['class'=>'form-control', 'placeholder'=>'']); !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4>Свойство:</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($details as $item)
                                {!! $item !!}
                            @endforeach
                        </div>
                    </div>

                    <hr>
                    <h4>Галерея:</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::label('gallery', 'Картинка (500x500):', ['class' => 'col-sm-4 control-label', 'style'=>'padding-top:40px;']); !!}
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-12 contGallery">
                                            @if($data->gallery)
                                                @foreach($data->gallery as $item)
                                                    <div id="igal_{{$item->id}}">
                                                        <img src="/public/uploads/products/{{ $data->id }}/thumb_{{$item->image}}" width="75">
                                                        <a href="javascript:removeGalleryImage({{$item->id}});"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div id="loading"></div>
                                    <div class="clearfix"></div>
                                    {!! Form::file('gallery', null, ['class'=>'form-control', 'id'=>'gallery']); !!}
                                    <br>
                                    <a href="javascript:" class="btn btn-custom btn-bordered" id="galleryBtn">Загрузить</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    {!! Form::submit('Редактировать', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}
    {!! Form::close() !!}
    <div class="clearfix"></div>
@endsection

@section('scripts')

    <script>

        // date
        jQuery('#datepicker, #datepicker2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        });

        $(document).ready(function(){

            //$(".select2").select2("val", "{{ $data->category_id }}"); //set the value
            $('[name=category_id]').val({{ $data->category_id }});

            // remove product image
            $('#removeIMG').on('click', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('/admin/products/deleteimg') }}' + '/' + id,
                    type: 'GET',
                    data: {'id':id},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function( data ) {
                        //console.log(data.msg);
                        if(data.msg == 'ok'){
                            $('#imgID').html('');
                            $('#removeSub').remove();
                        }
                    },
                    error: function( data ) {
                        console.log(data);
                    }
                });

            });

            // gallery upload image
            $('#galleryBtn').on('click', function(e) {

                e.preventDefault();

                var id = '{{$data->id}}';
                var file_data =  $('#gallery').prop('files')[0];
                //console.log(file_data);

                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('id', id);

                $('#loading').html('<img src="/public/images/ajax-loader.gif">загрузка...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ url('/admin/products/gallery') }}',
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    //dataType: 'json',
                    success: function( data ) {
                        $('#loading').html('');
                        $('#gallery').val('');
                        $('.contGallery').append('<div id="igal_'+data.id+'"><img src="/public/uploads/products/'+id+'/'+data.img+'" width="75" alt="'+data.img+'"><a href="javascript:removeGalleryImage('+data.id+')"><i class="fa fa-trash-o"></i></a></div>');
                        //console.log(data.id);
                    },
                    error: function( data ) {
                        //console.log(data);
                    }
                });

            });

        });

        // remove gallery image
        function removeGalleryImage(id){

            var form_data_rem = new FormData();
            form_data_rem.append('id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/admin/products/gallery/remove') }}',
                data: form_data_rem,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function( data ) {
                    //console.log(data.msg);
                    if(data.sts == 'ok' ){
                        $('#igal_'+id).remove();
                    }
                },
                error: function( data ) {
                    //console.log(data);
                }
            });
        }

    </script>

    {{-- FILE MANAGER--}}
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
@endsection