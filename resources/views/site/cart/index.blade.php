@extends('layouts.site')
@section('title', 'Моя корзина')
@section('description', 'Моя корзина')

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Главная</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Моя корзина</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Моя корзина</h1>
            </div>
        </div>
    </div>

    <div class="cart block">
        <div class="container _cartPageBlock">

            @if(!empty($data['items']))

                <table class="cart__table cart-table cartPageTable">
                    <thead class="cart-table__head">
                    <tr class="cart-table__row">
                        <th class="cart-table__column cart-table__column--image">&nbsp;</th>
                        <th class="cart-table__column cart-table__column--product">Название</th>
                        <th class="cart-table__column cart-table__column--price">Стоимость</th>
                        <th class="cart-table__column cart-table__column--quantity">Количество</th>
                        <th class="cart-table__column cart-table__column--total">Итого</th>
                        <th class="cart-table__column cart-table__column--remove"></th>
                    </tr>
                    </thead>
                    <tbody class="cart-table__body">
                        @foreach($data['items'] as $item)
                            <tr class="cart-table__row cart_row_{{ $item->id }}">
                                <td class="cart-table__column cart-table__column--image">
                                    <a href="/catalog/product/{{ $item->articul }}">
                                        @if(!empty($item->image))
                                            <img src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" alt="{{ $item->title }}">
                                        @else
                                            <img src="/public/uploads/no-thumb.png" alt="no image">
                                        @endif
                                    </a>
                                </td>
                                <td class="cart-table__column cart-table__column--product">
                                    <a href="/catalog/product/{{ $item->articul }}" class="cart-table__product-name">{{ str_limit($item->title, 50, '...') }}</a>
                                </td>
                                <td class="cart-table__column cart-table__column--price" data-title="Стоимость">{{ $item->cart_price }} сом.</td>
                                <td class="cart-table__column cart-table__column--quantity" data-title="Количество">
                                    <div class="input-number">
                                        <input class="form-control input-number__input cart_chg_qnt" type="number" min="1" value="{{ $item->cart_qnt }}" data-id="{{ $item->id }}">
                                        <div class="input-number__add"></div>
                                        <div class="input-number__sub"></div>
                                    </div>
                                </td>
                                <td class="cart-table__column cart-table__column--total cart_total_price" data-title="Итого">
                                    <span>{{ number_format((float)( $item->cart_price * $item->cart_qnt ), 2, '.', '') }}</span> сом.
                                </td>
                                <td class="cart-table__column cart-table__column--remove removeCartItem" data-id="{{ $item->id }}">
                                    <button type="button" class="btn btn-light btn-sm btn-svg-icon">
                                        <svg width="12px" height="12px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#cross-12"></use>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{--<div class="cart__actions">
                    <form class="cart__coupon-form">
                        <label for="input-coupon-code" class="sr-only">Пароль</label>
                        <input type="text" class="form-control" id="input-coupon-code" placeholder="Код купона">
                        <button type="submit" class="btn btn-primary">Применить купон</button>
                    </form>
                </div>--}}

                <div class="row justify-content-end pt-5 cartPageTotalPrice">
                    <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Сумма заказов</h3>
                                <table class="cart__totals">
                                    <tfoot class="cart__totals-footer">
                                        <tr>
                                            <th>Всего</th>
                                            <td id="cart_vsego"><span>{{ $data['sum'] }}</span> сом.</td>
                                        </tr>
                                        <tr class="deliverInfo">
                                            <th>Доставка</th>
                                            <td>{{ ($basket['sum'] >= 2000) ? 'Бесплатно' : 'от 20 сом.' }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{ url('/checkout') }}">Оформить заказ</a></div>
                        </div>
                    </div>
                </div>

            @else
                <p>Ваша корзина пуста</p>
            @endif

        </div>
    </div>

@endsection
