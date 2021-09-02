@extends('layouts.site')
@section('title', 'Мои заказы')
@section('description', 'Мои заказы')

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
                        <li class="breadcrumb-item active" aria-current="page">Мои заказы</li>
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
                            <li class="account-nav__item account-nav__item--active">
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
                            <h5>История заказов</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table">
                            @if(count($myOrders) > 0)
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
                                            @foreach($myOrders as $item)
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

                        <div class="card-divider"></div>
                        {!! $myOrders->render() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
