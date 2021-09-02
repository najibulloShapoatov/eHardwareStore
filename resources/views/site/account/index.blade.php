@extends('layouts.site')
@section('title', 'Мой аккаунт')
@section('description', 'Мой аккаунт')

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
                        <li class="breadcrumb-item active" aria-current="page">Мой аккаунт</li>
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
                            <li class="account-nav__item account-nav__item--active">
                                <a href="{{ url('/account') }}">Мой аккаунт</a>
                            </li>
                            <li class="account-nav__item">
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
                    <div class="dashboard">
                        <div class="dashboard__profile card profile-card">
                            <div class="card-body profile-card__body">
                                <div class="profile-card__avatar">
                                    @if(!empty($userInfo->image))
                                        <img src="/public/uploads/users/{{ $userInfo->image }}" alt="{{ $userInfo->id }}" id="myPhoto">
                                    @else
                                        <img src="/public/uploads/no_avatar.png" alt="no photo">
                                    @endif
                                </div>
                                <div class="profile-card__name">{{ $userInfo->name }} {{ $userInfo->surname }}</div>
                                <div class="profile-card__email">{{ $userInfo->phone }}</div>
                                <div class="profile-card__edit">
                                    <a href="{{ url('/account/profile') }}" class="btn btn-secondary btn-sm">Мой профиль</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard__address card address-card address-card--featured">
                            <div class="address-card__badge">Личные данные</div>
                            <div class="address-card__body">
                                <div class="address-card__name">{{ $userInfo->name }} {{ $userInfo->surname }}</div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Город</div>
                                    <div class="address-card__row-content">
                                        {{ !empty($userInfo->city) ? $userInfo->city : 'Не указан' }}
                                    </div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Адрес</div>
                                    <div class="address-card__row-content">
                                        {{ !empty($userInfo->address) ? $userInfo->address : 'Не указан' }}
                                    </div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Номер телефона</div>
                                    <div class="address-card__row-content">{{ $userInfo->phone }}</div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Эл. почта</div>
                                    <div class="address-card__row-content">
                                        {{ !empty($userInfo->email) ? $userInfo->email : 'Не указан' }}
                                    </div>
                                </div>
                                <div class="address-card__footer">
                                    <a href="{{ url('/account/profile') }}">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard__orders card">
                            <div class="card-header">
                                <h5>Недавние заказы</h5>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-table">

                                @if(count($recentOrders) > 0)
                                    <div class="table-responsive-sm">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Заказ</th>
                                                    <th>Дата</th>
                                                    <th>Статус</th>
                                                    <th>Итого</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentOrders as $item)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('/account/orders/' . $item->id) }}">#{{ $item->id }}</a>
                                                        </td>
                                                        <td>{{Carbon\Carbon::parse($item->order_date)->format('d.m.Y H:i')}}</td>
                                                        <td>
                                                            @if($item->order_status == 1)
                                                                В ожидании
                                                            @elseif($item->order_status == 2)
                                                                Обработан
                                                            @else
                                                                Доставлен
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->order_sum }} сом.</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p style="padding: 1.5rem 2rem;">Нет заказов</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
