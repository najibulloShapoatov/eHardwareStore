@extends('layouts.site')
@section('title', 'Мой профиль')
@section('description', 'Мой профиль')

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
                        <li class="breadcrumb-item active" aria-current="page">Мой профиль</li>
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
                            <li class="account-nav__item account-nav__item--active">
                                <a href="{{ url('/account/profile') }}">Мой профиль</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ url('/account/orders') }}">Мои заказы</a>
                            </li>
                            <li class="account-nav__item">
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
                            <h5>Редактирование профиля</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="row no-gutters">
                                    <div class="col-12 col-lg-7 col-xl-6">
                                        <div id="profileResult"></div>
                                        <div class="form-group">
                                            <label for="name">Ваше имя*</label>
                                            <input type="text" class="form-control" id="name" autocomplete="off" value="{{ $userInfo->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Ваше фамилия</label>
                                            <input type="text" class="form-control" id="surname" autocomplete="off" value="{{ $userInfo->surname }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Номер телефона*</label>
                                            <input type="text" class="form-control" id="phone" autocomplete="off" value="{{ $userInfo->phone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Эл. почта</label>
                                            <input type="email" class="form-control" id="email" autocomplete="off" value="{{ $userInfo->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Город*</label>
                                            <input type="text" class="form-control" id="city" autocomplete="off" value="{{ $userInfo->city }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Адрес*</label>
                                            <input type="text" class="form-control" id="address" autocomplete="off" value="{{ $userInfo->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Фото</label>
                                            @if(!empty($userInfo->image))
                                                <div class="profile-card__avatar">
                                                    <img src="/public/uploads/users/{{ $userInfo->image }}" alt="{{ $userInfo->id }}" id="myPhoto">
                                                </div>
                                                {{--<small><a href="javascript:void(0)" class="deletePhoto pull-left">Удалить фото</a></small>
                                                <br>
                                                <br>--}}
                                            @else
                                                <div class="profile-card__avatar">
                                                    <img src="/public/uploads/no_avatar.png" alt="no image" id="myPhoto">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="image">
                                        </div>
                                        <div class="form-group mt-5 mb-0">
                                            <button class="btn btn-primary" id="editProfile">Сохранить</button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5 col-xl-6 text-right">
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Дата регистрации:</div>
                                            <div class="address-card__row-content">{{Carbon\Carbon::parse($userInfo->date_reg)->format('d.m.Y H:i')}}</div>
                                        </div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Дата последнего входа:</div>
                                            <div class="address-card__row-content">{{Carbon\Carbon::parse($userInfo->date_auth)->format('d.m.Y H:i')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
