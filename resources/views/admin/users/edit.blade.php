@extends('layouts.admin')

@section('content')

    <h4 class="pull-left">Пользователь: "{{$data->name}}"</h4>
    <div class="clearfix m-b-20"></div>

    <div class="row">
        <div class="col-sm-8">

            @include('includes.form-errors')

            {!! Form::model($data, ['method' => 'POST', 'action' => ['Admin\UsersController@update', $data->id], 'files'=> true, 'class' => 'form-horizontal']) !!}

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
                {!! Form::label('user_type', 'Роль:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::select('user_type', [ '1' => 'Клиент', '7' => 'Администратор', '2' => 'Контент-менеджер'], $data->user_type, ['class'=>'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Картинка (100x100):', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    @if(!empty($data->image))
                        <p id="imgID"><img style="border:1px solid #ccc;" src="/public/uploads/users/{{ $data->image }}" class="thumb-md img-circle" width="100" alt="img"></p>
                        <p id="removeSub">
                            <a href="javascript:" class="removePic" id="removeIMG">
                                <i class="fa fa-trash"></i> Удалить картинку
                            </a>
                        </p>
                    @endif
                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Имя:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('name', $data->name, ['class'=>'form-control', 'placeholder'=>'Имя', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('surname', 'Фамилия:', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('surname', $data->surname, ['class'=>'form-control', 'placeholder'=>'Фамилия', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Эл. почта:', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('email', $data->email, ['class'=>'form-control', 'placeholder'=>'Эл. почта', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('phone', 'Номер телефона:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('phone', $data->phone, ['class'=>'form-control', 'placeholder'=>'Номер телефона', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Новый пароль:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::input('password', 'password', '', ['class'=>'form-control', 'placeholder' => 'Оставьте поле пустым, если не хотите менять', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password-confirm', 'Подтвердите новый пароль*:', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::input('password', 'password_confirmation', '', ['class'=>'form-control', 'id' => 'password-confirm', 'placeholder' => 'Оставьте поле пустым, если не хотите менять', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            {!! Form::submit('Сохранить', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Remove image
        $(document).on("click", "#removeIMG", function(e){
            e.preventDefault();

            var id = '{{ $data->id }}';
            //console.log(id);

            var form_data = new FormData();
            form_data.append('id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
            });

            $.ajax({
                url: '/admin/users/remove_image',
                data: form_data,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                dataType : 'json',
                success: function( data ) {
                    //console.log(data);
                    if(data.sts == 1){
                        $('#imgID').fadeOut(500).remove();
                        $('#removeSub').fadeOut(500).remove();
                    }
                },
                error: function( data ) {
                    console.log(data);
                }
            });

            return false;
        });
    </script>
@endsection
