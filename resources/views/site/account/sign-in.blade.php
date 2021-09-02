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
                        <li class="breadcrumb-item active" aria-current="page">Войти в личный кабинет</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Войти в личный кабинет</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="card flex-grow-1 mb-md-0">
                        <div class="card-body">
                            <div class="auth-result sign-in-result"></div>
                            <form id="si-form-auth">
                                <div class="form-group">
                                    <label>Номер телефона</label>
                                    <input type="text" autocomplete="off" id="si-phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Пароль</label>
                                    <input type="password" class="form-control" id="si-password">
                                    <small class="form-text text-muted"><a href="#">Забыли пароль?</a></small>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                       <span class="form-check-input input-check">
                                          <span class="input-check__body">
                                             <input class="input-check__input" type="checkbox" id="login-remember" value="0"> <span class="input-check__box"></span>
                                             <svg class="input-check__icon" width="9px" height="7px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                             </svg>
                                          </span>
                                       </span>
                                        <label class="form-check-label" for="login-remember">Запомнить меня?</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4" id="signInSubmit">Войти</button>
                                <br>
                                <br>
                                <p>Если у вас нет аккаунта, пожалуйста <a href="{{ url('/sign-up') }}">зарегистрируйтесь</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <img src="/public/uploads/random/{{ $image }}" class="img-responsive" alt="{{ $image }}">
                </div>
            </div>
        </div>
    </div>

@endsection
