@extends('layouts.admin')

@section('content')
    <h4>Панель управления</h4>
    <br>
    <div class="row">
        <div class="col-sm-12">

            <p>Добро пожаловать, {{ $userInfo->name }} {{ $userInfo->surname }}</p>

            {{--
            <div class="card-box widget-inline">
                <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                            <a href="{{ url('/admin/slideshow') }}">
                                <h3 class="m-t-10"><i class="text-custom  fa fa-image"></i></h3>
                                <p class="text-muted">Слайдшоу</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                            <a href="{{ url('/admin/services') }}">
                                <h3 class="m-t-10"><i class="text-custom  fa fa-bullhorn"></i></h3>
                                <p class="text-muted">Услуги</p>
                            </a>
                        </div>
                    </div>



                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                            <a href="{{ url('/admin/users') }}">
                                <h3 class="m-t-10"><i class="text-custom  fa fa-users"></i></h3>
                                <p class="text-muted">Пользователи</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                            <a href="{{ url('/admin/config') }}">
                                <h3 class="m-t-10"><i class="text-custom  fa fa-cogs"></i></h3>
                                <p class="text-muted">Конфигурации</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                            <a href="{{ url('/') }}" target="_blank">
                                <h3 class="m-t-10"><i class="text-custom  fa fa-globe"></i></h3>
                                <p class="text-muted">Сайт</p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            --}}

        </div>
    </div>
@endsection
