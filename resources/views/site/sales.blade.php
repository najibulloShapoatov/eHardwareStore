@extends('layouts.site')
@section('title', 'Скидки в АЗИМИСТРОЙ')
@section('description', 'Скидки в АЗИМИСТРОЙ')

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
                        <li class="breadcrumb-item active" aria-current="page">Скидки</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Скидки в АЗИМИСТРОЙ</h1>
                <br>

                <p>Спешим сообщить Вам отличную новость: в период с пятницы 29.11.2019 и на протяжении целой недели (до 20.12.2019) у нас состоится масштабная акция, в течение которой все стройматериалы будут в продаже по СУПЕРценам!</p>

            </div>
        </div>
    </div>
@endsection