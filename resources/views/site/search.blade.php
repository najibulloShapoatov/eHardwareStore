@extends('layouts.site')
@section('title', 'Поиск товаров')
@section('description', 'Поиск товаров')

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
                        <li class="breadcrumb-item active" aria-current="page">Поиск товаров</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Поиск товаров</h1>
            </div>
        </div>
    </div>
    Поиск товаров...
@endsection