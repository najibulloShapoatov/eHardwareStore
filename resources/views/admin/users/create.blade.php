@extends('layouts.admin')

@section('content')

    <h4 class="pull-left">Добавить нового пользователя</h4>
    <div class="clearfix m-b-20"></div>

    <div class="row">
        <div class="col-sm-8">

            @include('includes.form-errors')

            {!! Form::open(['method' => 'POST', 'action' => 'Admin\UsersController@store', 'files'=> true, 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('user_type', 'Роль:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::select('user_type', [ '1' => 'Клиент', '7' => 'Администратор', '2' => 'Контент-менеджер'], null, ['class'=>'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Имя:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Имя', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('surname', 'Фамилия:', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('surname', '', ['class'=>'form-control', 'placeholder'=>'Фамилия', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Картинка (100x100):', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::file('image', null, ['class'=>'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Эл. почта:', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('email', '', ['class'=>'form-control', 'placeholder'=>'Эл. почта', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('phone', 'Номер телефона:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::text('phone', '', ['class'=>'form-control', 'placeholder'=>'Номер телефона', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Пароль:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::input('password', 'password', '', ['class'=>'form-control', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password-confirm', 'Подтвердите пароль:*', ['class' => 'col-sm-4 control-label']); !!}
                <div class="col-sm-8">
                    {!! Form::input('password', 'password_confirmation', '', ['class'=>'form-control', 'id' => 'password-confirm', 'autocomplete' => 'off']); !!}
                </div>
            </div>

            {!! Form::submit('Добавить', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
