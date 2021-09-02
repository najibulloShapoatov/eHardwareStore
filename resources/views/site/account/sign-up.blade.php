@extends('layouts.site')
@section('title', 'О нас')
@section('description', 'О нас')

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Главная</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Регистрация</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Регистрация</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="card flex-grow-1 mb-md-0">
                        <div class="card-body">
                            <div class="auth-result sign-up-result"></div>
                            <form id="su-form-auth">
                                <div class="form-group">
                                    <label>Ваше имя*</label>
                                    <input type="text" class="form-control" autocomplete="off" id="su-name">
                                </div>
                                <div class="form-group">
                                    <label>Номер телефона*</label>
                                    <input type="text" class="form-control" autocomplete="off" id="su-phone">
                                </div>
                                <div class="form-group">
                                    <label>Пароль*</label>
                                    <input type="password" class="form-control" autocomplete="off" id="su-password">
                                </div>
                                <div class="form-group">
                                    <label>Подтверждение пароля*</label>
                                    <input type="password" class="form-control" autocomplete="off" id="su-password-confirm">
                                </div>
                                <button type="submit" class="btn btn-primary mt-4" id="signUpSubmit">Зарегистрироваться</button>
                                <p><small>* &mdash; обязательны к заполнению</small></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <img src="/public/uploads/random/{{ $image }}" class="img-responsive" alt="{{ $image }}">
                </div>
            </div>
            <br>
            <p>Если вы зарегистрированы на azimistroy.tj, просто воспользуйтесь <a href="{{ url('/sign-in') }}">личным кабинетом</a></p>
        </div>
    </div>


@endsection