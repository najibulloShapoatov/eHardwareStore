@extends('layouts.site')
@section('title', 'Мои заказы | Заказ #' . $orderData->id)
@section('description', 'Мои заказы | Заказ #' . $orderData->id)

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
                        <li class="breadcrumb-item">
                            <a href="/account/orders">Мои заказы</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ 'Заказ #' . $orderData->id }}</li>
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
                            <h5>{{ 'Заказ #' . $orderData->id }}</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table MyOrders">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Дата:</strong></td>
                                            <td>{{Carbon\Carbon::parse($orderData->order_date)->format('d.m.Y H:i')}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Статус:</strong></td>
                                            <td>
                                                @if($orderData->order_status == 1)
                                                    В ожидании
                                                @elseif($orderData->order_status == 2)
                                                    Обработан
                                                @else
                                                    Доставлен
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сумма заказа:</strong></td>
                                            <td>
                                                {{ $orderData->order_sum }} сом.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Способ оплаты:</strong></td>
                                            <td>
                                                @if($orderData->payment_type == 1)
                                                    Оплата при доставки
                                                @else
                                                    Другой
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <br>
                    @if(count($orderData->content) > 0)
                        <h5>Содержание заказа</h5>
                        <div class="table-responsive-sm">
                            <table class="table m-0">
                                <tr>
                                    <td>#</td>
                                    <td>Артикул</td>
                                    <td>Название</td>
                                    <td>Цена</td>
                                    <td>Количество</td>
                                    <td>Всего</td>
                                </tr>
                                @php
                                    $sum = 0;
                                @endphp
                                @foreach($orderData->content as $item)
                                    <tr>
                                        <td>
                                            @if(!empty($item->product->image))
                                                <img src="/public/uploads/products/{{ $item->product->id }}/thumb_{{ $item->product->image }}" alt="{{ $item->product->title }}" width="50">
                                            @else
                                                <img src="/public/uploads/no_image.png" alt="{{ $item->product->title }}">
                                            @endif
                                        </td>
                                        <td>{{ $item->product->articul }}</td>
                                        <td>{{ $item->product->title }}</td>
                                        <td>
                                            <nobr>{{ $item->price }} сом.</nobr>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td><nobr>{{ (float)$item->price * $item->quantity }} сом.</nobr></td>
                                    </tr>
                                    @php
                                        $sum = $sum + ((float)$item->price * $item->quantity);
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="6" align="right">
                                        <strong>Всего:</strong> {{ $sum }} сом.
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="right">
                                        <strong>Стоимость доставки:</strong> {{ ($sum >= 2000) ? 'Бесплатно' : 'от 20 сом.' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="float-right">
                            <br>
                            <a href="{{ url('/account/orders') }}" class="btn btn-primary">История заказов</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
