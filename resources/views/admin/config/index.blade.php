@extends('layouts.admin')

@section('content')
    <h4 class="pull-left">Конфигурации сайта</h4>
    <div class="clearfix m-b-20"></div>
    @include('includes.alert')
    @include('includes.form-errors')
    <div class="row">
        <div class="col-sm-12">
            {!! Form::model($config, ['method' => 'POST', 'action' => 'Admin\ConfigurationController@save', 'files'=> true, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('office_manager_phone', 'Телефон (Офис-менеджер):*', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('office_manager_phone', $config->office_manager_phone, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Адрес:*', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('address', $config->address, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Телефон:*', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', $config->phone, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Эл. почта:*', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('email', $config->email, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('working_days', 'Рабочие дни:*', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('working_days', $config->working_days, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('facebook_link', 'Ссылка на Facebook:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('facebook_link', $config->facebook_link, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('instagram_link', 'Ссылка на Instagram:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('instagram_link', $config->instagram_link, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('telegram_link', 'Ссылка на Telegram:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('telegram_link', $config->telegram_link, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('whatsapp_link', 'Ссылка на Whatsapp:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('whatsapp_link', $config->whatsapp_link, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('viber_link', 'Ссылка на Viber:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::text('viber_link', $config->viber_link, ['class'=>'form-control', 'placeholder'=>'']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('about_company_sitebar', 'Текст о компании (сайдбар)*:', ['class' => 'col-sm-3 control-label']); !!}
                <div class="col-sm-9">
                    {!! Form::textarea('about_company_sitebar', $config->about_company_sitebar, ['class'=>'form-control', 'placeholder'=>'', 'rows'=>5]); !!}
                </div>
            </div>
            {!! Form::submit('Сохранить', ['class'=>'btn btn-custom btn-bordered pull-right']); !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
