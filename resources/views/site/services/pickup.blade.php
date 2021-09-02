@extends('layouts.site')
@section('title', 'Самовывоз товаров')
@section('description', 'Самовывоз товаров')

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
                        <li class="breadcrumb-item active" aria-current="page">Самовывоз товаров</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Самовывоз товаров в Душанбе</h1>
                <br>

                <p>
                    <strong></strong>
                </p>

                <p>Нет времени ходить по гипермаркету и искать подходящие товары?


                <p>Нет возможности ждать доставку?


                <p>Сделайте онлайн-заказ и заберите его самостоятельно – <strong>из любого удобного магазина АЗИМИСТРОЙ!</strong>

                <p>
                    <strong>Стоимость услуги</strong><br>
                    Самовывоз из магазинов АЗИМИСТРОЙ осуществляется бесплатно.</p>

                <p><strong>Условия</strong><br>
                Для получения заказа необходимо обратиться на стойку самовывоза в выбранном магазине и назвать идентификационный номер заказа.
                </p>
                <p><strong>Срок хранения товара</strong><br>
                Срок хранения заказов, подготовленных к самовывозу из магазина составляет 3 дня.
                </p>
                <p><strong>Отказ от товара</strong><br>
                Для отказа от покупки после получения заказа следует обратиться на кассу возврата.
                </p>
                <p>Приятных покупок!</p>
            </div>
        </div>
    </div>
@endsection