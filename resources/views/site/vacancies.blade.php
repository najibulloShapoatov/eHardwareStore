@extends('layouts.site')
@section('title', 'Работа в АЗИМИСТРОЙ а Душанбе')
@section('description', 'Работа в АЗИМИСТРОЙ в Душанбе')

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
                        <li class="breadcrumb-item active" aria-current="page">Наши вакансии</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Работа в АЗИМИСТРОЙ в Душанбе</h1>
                <br>

                <p>АЗИМИСТРОЙ специализируется на продаже товаров для ремонта, строительства и обустройства дома.</p>

                {{--<p>Ознакомьтесь с подробным списком вакансий в Душанбе и присоединитесь к команде профессионалов!</p>
                <br>

                <h4>Оператор склада</h4>
                <p>
                    <strong>Город:</strong> Душанбе
                    <br><strong>Магазин:</strong> 84 мкр. ул. Гафурова 33/3, (за зданием "Милано Мода")
                </p>

                <br>
                <h4>Инженер-энергетик </h4>
                <p>
                    <strong>Город:</strong> Душанбе
                    <br><strong>Магазин:</strong> ТЦ «Осиё» магазин 49
                </p>

                <br>

                <h4>Продавец-консультант </h4>
                <p>
                    <strong>Город:</strong> Душанбе
                    <br><strong>Магазин:</strong> ТЦ «Олами кафели Мухаммад» 1 и 2 этажи(рядом с Лесторгом)
                </p>

                <br>

                <h4>Практикант в IT </h4>
                <p>
                    <strong>Город:</strong> Душанбе
                    <br><strong>Магазин:</strong> ТЦ «Олами кафели Мухаммад» 1 и 2 этажи(рядом с Лесторгом)
                </p>

                <br>
                <br>--}}
                <p>
                    <strong>Обращайтесь по телефону:</strong>
                    <br>(+992) 779996006
                </p>

            </div>
        </div>
    </div>
@endsection