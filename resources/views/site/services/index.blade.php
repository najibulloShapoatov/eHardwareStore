@extends('layouts.site')
@section('title', 'Наши услуги')
@section('description', 'Наши услуги')

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
                        <li class="breadcrumb-item active" aria-current="page">Наши услуги</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Наши услуги</h1>
            </div>
        </div>
    </div>

    Наши услуги...

@endsection