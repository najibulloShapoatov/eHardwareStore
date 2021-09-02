@extends('layouts.site')
@section('title', 'Оформления заказа')
@section('description', 'Оформления заказа')

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
                        <li class="breadcrumb-item active" aria-current="page">Оформления заказа</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Оформления заказа</h1>
            </div>
        </div>
    </div>

    <div class="checkout block">
        <div class="container checkoutMainBlock">
            <div class="row">

                @if(!Auth::user())
                    <div class="col-12 mb-3">
                        <div class="alert alert-lg alert-primary">Являетесь клиентом магазина? <a href="{{ url('/sign-in') }}">Войти</a> / <a href="{{ url('/sign-up') }}">Регистрация</a></div>
                    </div>
                @endif

                @if(!empty($basket['items']))
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="card mb-lg-0">
                            <div class="card-body">
                                <h3 class="card-title">Личные данные</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="checkout-name">Имя*</label>
                                        <input type="text" class="form-control" id="checkout-name" value="{{ (isset($userInfo['name']) ? $userInfo['name'] : '') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="checkout-last-name">Фамилия</label>
                                        <input type="text" class="form-control" id="checkout-last-name" value="{{ (isset($userInfo['surname']) ? $userInfo['surname'] : '') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-address">Адрес*</label>
                                    <textarea id="checkout-address" class="form-control" rows="4">{{ (isset($userInfo['address']) ? $userInfo['address'] : '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-city">Город</label>
                                    <input type="text" class="form-control" id="checkout-city" value="{{ (isset($userInfo['city']) ? $userInfo['city'] : '') }}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="checkout-email">Эл. почта</label>
                                        <input type="email" class="form-control" id="checkout-email" value="{{ (isset($userInfo['email']) ? $userInfo['email'] : '') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="checkout-phone">Номер телефона*</label>
                                        <input type="text" class="form-control" id="checkout-phone" value="{{ (isset($userInfo['phone']) ? $userInfo['phone'] : '') }}" {{ ($phoneNo) ? 'readonly' : '' }} >
                                    </div>
                                </div>

                                @if($createAccount)
                                    <div class="form-group">
                                        <div class="form-check">
                                            <span class="form-check-input input-check">
                                                <span class="input-check__body">
                                                    <input class="input-check__input" type="checkbox" id="checkout-create-account" value="0">
                                                    <span class="input-check__box"></span>
                                                    <svg class="input-check__icon" width="9px" height="7px">
                                                        <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                    </svg>
                                                </span>
                                            </span>
                                            <label class="form-check-label" for="checkout-create-account">Создать аккаунт?</label>
                                        </div>
                                    </div>
                                @endif

                                <p><small>* &mdash; поля обязательны для заполнения!</small></p>

                            </div>

                            {{--
                            <div class="card-divider"></div>
                            <div class="card-body">
                                <h3 class="card-title">Shipping Details</h3>
                                <div class="form-group">
                                    <div class="form-check"><span class="form-check-input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox" id="checkout-different-address"> <span class="input-check__box"></span>
                                                <svg class="input-check__icon" width="9px" height="7px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                </svg>
                                                </span>
                                                </span>
                                        <label class="form-check-label" for="checkout-different-address">Ship to a different address?</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-comment">Order notes <span class="text-muted">(Optional)</span></label>
                                    <textarea id="checkout-comment" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            --}}
                        </div>

                        <br>
                        <br>
                        <div class="checkoutResult"></div>

                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Ваш заказ</h3>
                                <table class="checkout__totals">
                                    <thead class="checkout__totals-header">
                                        <tr>
                                            <th>Товар</th>
                                            <th>Итого</th>
                                        </tr>
                                    </thead>
                                    <tbody class="checkout__totals-products">
                                        @foreach($basket['items'] as $item)
                                            <tr>
                                                <td>{{ str_limit($item->title, 38, '...') }} × {{ $item->cart_qnt }}</td>
                                                <td>{{ $item->cart_price }} сом.</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="checkout__totals-footer">
                                        <tr>
                                            <th>Всего</th>
                                            <td>{{ $basket['sum'] }} сом.</td>
                                        </tr>
                                        <tr class="deliverInfo">
                                            <th>Доставка</th>
                                            <td>{{ ($basket['sum'] >= 2000) ? 'Бесплатно' : 'от 20 сом.' }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="payment-methods">
                                    <ul class="payment-methods__list">
                                        <li class="payment-methods__item payment-methods__item--active">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input checkout_payment_method" name="checkout_payment_method" type="radio" value="1" checked="checked"> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">Оплата при доставке</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">Вы оплачиваете покупку при получении курьеру. Стоимость курьерской доставки при покупке на сумму больше 2000 сом. - Бесплатно.</div>
                                            </div>
                                        </li>
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input checkout_payment_method" name="checkout_payment_method" type="radio" value="2"> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">Корти милли</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">В процессе.</div>
                                            </div>
                                        </li>
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input checkout_payment_method" name="checkout_payment_method" type="radio" value="3"> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">VISA/Master карты</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">В процессе.</div>
                                            </div>
                                        </li>
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input checkout_payment_method" name="checkout_payment_method" type="radio" value="4"> <span class="input-radio__circle"></span> </span>
                                                        </span><span class="payment-methods__item-title">Электронные кошельки</span></label>
                                            <div class="payment-methods__item-container">
                                                <div class="payment-methods__item-description text-muted">В процессе.</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="checkout__agree form-group">
                                    <div class="form-check"><span class="form-check-input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox" id="checkout-terms"> <span class="input-check__box"></span>
                                                <svg class="input-check__icon" width="9px" height="7px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                </svg>
                                                </span>
                                                </span>
                                        <label class="form-check-label" for="checkout-terms">Я согласен с <a target="_blank" href="{{ url('/terms-and-conditions') }}">правилами</a> магазина*</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xl btn-block checkoutSubmit" disabled>Оформить заказ</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 mb-3">
                        <div class="alert alert-lg alert-danger">
                            Не имея товаров в корзине, пытаетесь оформить заказ :)
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
