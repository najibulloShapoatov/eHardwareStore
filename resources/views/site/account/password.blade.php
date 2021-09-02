@extends('layouts.site')
@section('title', 'Изменить пароль')
@section('description', 'Изменить пароль')

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
                        <li class="breadcrumb-item active" aria-current="page">Изменить пароль</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="container">
            <div class="row">

                <div class="col-12 col-lg-3 d-flex">
                    <div class="account-nav flex-grow-1">
                        <br>
                        <ul>
                            <li class="account-nav__item">
                                <a href="{{ url('/account') }}">Мой аккаунт</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ url('/account/profile') }}">Мой профиль</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ url('/account/orders') }}">Мои заказы</a>
                            </li>
                            <li class="account-nav__item account-nav__item--active">
                                <a href="{{ url('/account/password') }}">Изменить пароль</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ url('/logout') }}">Выйти</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-header">
                            <h5>Изменить пароль</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-12 col-lg-7 col-xl-6">

                                    <div id="passwordResult"></div>

                                    <div class="form-group">
                                        <label for="password">Новый пароль</label>
                                        <input type="password" class="form-control" id="password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Подтверждение нового пароля</label>
                                        <input type="password" class="form-control" id="password-confirm" autocomplete="off">
                                    </div>
                                    <div class="form-group mt-5 mb-0">
                                        <button class="btn btn-primary" id="changePassword">Изменить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
