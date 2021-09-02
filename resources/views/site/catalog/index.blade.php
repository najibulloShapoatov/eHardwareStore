@extends('layouts.site')
@section('title', 'Каталог')
@section('description', 'Каталог')

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Главная</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        @if($data['props']['slug'] == 'all')
                            <li class="breadcrumb-item active" aria-current="page">Каталог</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ url('/catalog/all')}}">Каталог</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                        @endif

                        @if(!empty($data['props']['child']))
                            @foreach($categories as $key => $item)
                                @if($item['slug'] == $data['props']['parent'])
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/catalog/' . $item['slug'])}}">{{ $item['title'] }}</a>
                                        <svg class="breadcrumb-arrow" width="6px" height="9px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                        </svg>
                                    </li>
                                    @foreach($item['child'] as $section)
                                        @if($section['slug'] == $data['props']['section'])
                                            <li class="breadcrumb-item">
                                                <a href="{{ url('/catalog/' . $section['slug'])}}">{{ $section['title'] }}</a>
                                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                </svg>
                                            </li>
                                            @if(!empty($section['child']))
                                                @foreach($section['child'] as $value)
                                                    @if($value['slug'] == $data['props']['child'])
                                                        <li class="breadcrumb-item active">{{ $value['title'] }}</li>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                            @break
                                        @endif
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                        @elseif(!empty($data['props']['section']))
                            @foreach($categories as $key => $item)
                                @if($item['slug'] == $data['props']['parent'])
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/catalog/' . $item['slug'])}}">{{ $item['title'] }}</a>
                                        <svg class="breadcrumb-arrow" width="6px" height="9px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                        </svg>
                                    </li>
                                    @foreach($item['child'] as $section)
                                        @if($section['slug'] == $data['props']['section'])
                                            <li class="breadcrumb-item active">{{ $section['title'] }}</li>
                                            @break
                                        @endif
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                        @elseif(!empty($data['props']['parent']) && empty($data['props']['section']) && empty($data['props']['child']))
                            @foreach($categories as $key => $item)
                                @if($item['slug'] == $data['props']['parent'])
                                    <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Каталог</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="shop-layout shop-layout--sidebar--start">
            <div class="shop-layout__sidebar">
                <div class="block block-sidebar block-sidebar--offcanvas--mobile">
                    <div class="block-sidebar__backdrop"></div>
                    <div class="block-sidebar__body">
                        <div class="block-sidebar__header">
                            <div class="block-sidebar__title">Категории</div>
                            <button class="block-sidebar__close" type="button">
                                <svg width="20px" height="20px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#cross-20"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="block-sidebar__item">
                            <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened">
                                <h4 class="widget-filters__title widget__title">Категории</h4>
                                <div class="widget-filters__list">
                                    <div class="widget-filters__item" style="border-bottom: none;">
                                        <div class="filter filter--opened" data-collapse-item>
                                            <div class="filter__body" data-collapse-content>
                                                <div class="filter__container">
                                                    <div class="filter-categories">
                                                        @if(empty($data['props']['parent']))
                                                            <ul class="filter-categories__list">
                                                                @foreach($categories as $item)
                                                                    <li class="filter-categories__item filter-categories__item--current">
                                                                        <a href="{{ url('/catalog/' . $item['slug']) }}">{{ $item['title'] }}</a>
                                                                        {{--<div class="filter-categories__counter">21</div>--}}
                                                                    </li>
                                                                    @if(!empty($item['child']))
                                                                        @foreach($item['child'] as $sub)
                                                                            <li class="filter-categories__item filter-categories__item--child">
                                                                                <a href="{{ url('/catalog/' . $sub['slug']) }}">{{ $sub['title'] }}</a>
                                                                                {{--<div class="filter-categories__counter">12</div>--}}
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @elseif(empty($data['props']['section']))
                                                            <ul class="filter-categories__list">
                                                                @foreach($categories as $key => $item)
                                                                    @if($item['slug'] == $data['props']['parent'])
                                                                        @foreach($item['child'] as $section)
                                                                            <li class="filter-categories__item filter-categories__item--current">
                                                                                <a href="{{ url('/catalog/' . $section['slug'])}}">{{ $section['title'] }}</a>
                                                                                @if(!empty($section['child']))
                                                                                    @foreach($section['child'] as $value)
                                                                                        <li class="filter-categories__item filter-categories__item--child">
                                                                                            <a href="{{ url('/catalog/' . $value['slug'])}}" class="{{ ($value['slug'] == $data['props']['child'])? 'active' : '' }}">{{ $value['title'] }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <ul class="filter-categories__list">
                                                                @foreach($categories as $key => $item)
                                                                    @if($item['slug'] == $data['props']['parent'])
                                                                        @foreach($item['child'] as $section)
                                                                            @if($section['slug'] == $data['props']['section'])
                                                                                <li class="filter-categories__item filter-categories__item--current">
                                                                                    <a href="{{ url('/catalog/' . $section['slug'])}}">{{ $section['title'] }}</a>
                                                                                    @if(!empty($section['child']))
                                                                                        @foreach($section['child'] as $value)
                                                                                            <li class="filter-categories__item filter-categories__item--child">
                                                                                                <a href="{{ url('/catalog/' . $value['slug'])}}" class="{{ ($value['slug'] == $data['props']['child'])? 'active' : '' }}">{{ $value['title'] }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </li>
                                                                                @break
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($data['props']['section'] != '')

                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item>
                                                <button type="button" class="filter__title" data-collapse-trigger>Стоимость
                                                    <svg class="filter__arrow" width="12px" height="7px">
                                                        <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                                <div class="filter__body" data-collapse-content>
                                                    <div class="filter__container">
                                                        <div class="filter-price" data-min="10" data-max="5000" data-from="500" data-to="3500">
                                                            <div class="filter-price__slider"></div>
                                                            <div class="filter-price__title"><span class="filter-price__min-value"></span> сом. – <span class="filter-price__max-value"></span> сом.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if(count($data['props']['brand']) > 0)
                                            <div class="widget-filters__item">
                                                <div class="filter filter--opened" data-collapse-item>
                                                    <button type="button" class="filter__title" data-collapse-trigger>Бренд
                                                        <svg class="filter__arrow" width="12px" height="7px">
                                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                        </svg>
                                                    </button>
                                                    <div class="filter__body" data-collapse-content>
                                                        <div class="filter__container">
                                                            <div class="filter-list">
                                                                <div class="filter-list__list">
                                                                    @foreach($data['props']['brand'] as $brand)
                                                                        <label class="filter-list__item">
                                                                            <span class="filter-list__input input-check">
                                                                                <span class="input-check__body">
                                                                                    <input class="input-check__input" type="checkbox">
                                                                                    <span class="input-check__box"></span>
                                                                                    <svg class="input-check__icon" width="9px" height="7px">
                                                                                        <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </span>
                                                                            <span class="filter-list__title" data-slug="{{ $brand->slug }}">{{ $brand->title }} </span>
                                                                            {{--<span class="filter-list__counter">7</span>--}}
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item>
                                                <button type="button" class="filter__title" data-collapse-trigger>Цвет
                                                    <svg class="filter__arrow" width="12px" height="7px">
                                                        <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                                <div class="filter__body" data-collapse-content>
                                                    <div class="filter__container">
                                                        <div class="filter-color">
                                                            <div class="filter-color__list">
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color input-check-color--white" style="color: #fff;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color input-check-color--light" style="color: #d9d9d9;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #b3b3b3;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #808080;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #666;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #4d4d4d;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #262626;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #ff4040;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #ff8126;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color input-check-color--light" style="color: #ffd440;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color input-check-color--light" style="color: #becc1f;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #8fcc14;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #47cc5e;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #47cca0;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #47cccc;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #40bfff;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #3d6dcc;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #7766cc;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #b852cc;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                                <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #e53981;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox"> <span class="input-check-color__box"></span>
                                                                            <svg class="input-check-color__icon" width="12px" height="9px">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                            </svg> <span class="input-check-color__stick"></span></label>
                                                                        </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="widget-filters__actions d-flex">
                                            <button class="btn btn-primary btn-sm">Применить</button>
                                            <button class="btn btn-secondary btn-sm">Сбросить</button>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-layout__content">
                <div class="block">
                    <div class="products-view">
                        <div class="products-view__options">
                            <div class="view-options view-options--offcanvas--mobile">
                                <div class="view-options__filters-button">
                                    <button type="button" class="filters-button">
                                        <svg class="filters-button__icon" width="16px" height="16px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#filters-16"></use>
                                        </svg>
                                        <span class="filters-button__title">Фильтр</span>
                                        <span class="filters-button__counter">3</span>
                                    </button>
                                </div>
                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                        <div class="layout-switcher__list">
                                            <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid" type="button" class="layout-switcher__button layout-switcher__button--active">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#layout-grid-16x16"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="grid-3-sidebar" data-with-features="true" title="Grid With Features" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#layout-grid-with-details-16x16"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#layout-list-16x16"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="view-options__legend">Showing 6 of 98 products</div>--}}
                                <div class="view-options__divider"></div>
                                <div class="view-options__control">
                                    <label for="">Сортировать</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="" id="">
                                            <option value="0">По умолчанию</option>
                                            <option value="new">Новинки</option>
                                            <option value="sale">Скидки</option>
                                            <option value="top">Топ продажи</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="view-options__control">
                                    <label for="">Показать</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="" id="">
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="60">60</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products-view__list products-list" data-layout="grid-3-sidebar" data-with-features="false">
                            <div class="products-list__body">
                                @if(count($data['productsList']) > 0)
                                    @foreach($data['productsList'] as $item)
                                        <div class="products-list__item">
                                            <div class="product-card">

                                                <button class="product-card__quickview" type="button" data-id="{{ $item->id }}">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="/public/site_assets/images/sprite.svg#quickview-16"></use>
                                                    </svg> <span class="fake-svg-icon"></span>
                                                </button>

                                                <!--
                                                <div class="product-card__badges-list">
                                                    <div class="product-card__badge product-card__badge--new">New</div>
                                                    <div class="product-card__badge product-card__badge--hot">Hot</div>
                                                    <div class="product-card__badge product-card__badge--sale">Sale</div>
                                                </div>
                                                -->

                                                <div class="product-card__image">
                                                    <a href="/catalog/product/{{ $item->articul }}">
                                                        @if(!empty($item->image))
                                                            <img src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" alt="{{ $item->title }}">
                                                        @else
                                                            <img src="/public/uploads/no-thumb.png" alt="no image">
                                                        @endif
                                                    </a>
                                                </div>

                                                <div class="product-card__info">
                                                    <div class="product-card__name">
                                                        <a href="/catalog/product/{{ $item->articul }}">{{ $item->title }}</a>
                                                    </div>
                                                    <div class="product-card__rating">
                                                        @php
                                                            $rating = \App\Models\Product::getReview($item->id);
                                                            $wishlistSts = \App\Models\Cart::getStatus($item->id);
                                                        @endphp
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                @foreach($rating['star'] as $rate)
                                                                    @if($rate == 'gold')
                                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                                            <g class="rating__fill">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#star-normal"></use>
                                                                            </g>
                                                                            <g class="rating__stroke">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#star-normal-stroke"></use>
                                                                            </g>
                                                                        </svg>
                                                                        <div class="rating__star rating__star--only-edge rating__star--active">
                                                                            <div class="rating__fill">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                            <div class="rating__stroke">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <svg class="rating__star" width="13px" height="12px">
                                                                            <g class="rating__fill">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#star-normal"></use>
                                                                            </g>
                                                                            <g class="rating__stroke">
                                                                                <use xlink:href="/public/site_assets/images/sprite.svg#star-normal-stroke"></use>
                                                                            </g>
                                                                        </svg>
                                                                        <div class="rating__star rating__star--only-edge">
                                                                            <div class="rating__fill">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                            <div class="rating__stroke">
                                                                                <div class="fake-svg-icon"></div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="product-card__rating-legend">{{ $rating['text'] }}</div>
                                                    </div>
                                                    <ul class="product-card__features-list">
                                                        @php
                                                            $prod = new \App\Models\Product();
                                                            $attrs = $prod->attributes($item->category_id, $item->id);
                                                            echo $attrs;
                                                        @endphp
                                                    </ul>
                                                </div>

                                                <div class="product-card__actions">
                                                    <div class="product-card__availability">В наличие: <span class="text-success">{{ ($item->quantity != 0) ? 'Есть' : 'Нет' }}</span></div>
                                                    <div class="product-card__prices">{{ $item->price }} сом.</div>

                                                    <!--
                                                    <div class="product-card__prices">
                                                        <span class="product-card__new-price">$949.00</span>
                                                        <span class="product-card__old-price">$1189.00</span>
                                                    </div>
                                                    -->

                                                    <div class="product-card__buttons">

                                                        <button class="btn btn-primary product-card__addtocart" type="button" data-id="{{ $item->id }}" id="addtocart">В корзину</button>
                                                        <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button" data-id="{{ $item->id }}" id="addtocart">В корзину</button>

                                                        <button
                                                            class="btn {{ ($wishlistSts == 1) ? 'btn-wishlist' : 'btn-primary-wishlist' }} btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist wishlist_{{ $item->id }}"
                                                            type="button"
                                                            id="addtowish"
                                                            data-id="{{ $item->id }}"
                                                            data-sts="{{ $wishlistSts }}"
                                                            title="Добавить в список желаний"
                                                        >
                                                            <svg width="16px" height="16px">
                                                                <use xlink:href="/public/site_assets/images/sprite.svg#wishlist-16"></use>
                                                            </svg>
                                                            <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
                                                        </button>

                                                        {{--
                                                       <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">
                                                           <svg width="16px" height="16px">
                                                               <use xlink:href="/public/site_assets/images/sprite.svg#compare-16"></use>
                                                           </svg>
                                                           <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
                                                       </button>
                                                        --}}

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <a
                            href="javascript:"
                            class="btn btn-primary text-center load-more-products"
                            data-cnt="1"
                        >Загруить еще</a>

                        <input type="hidden" id="cat_1_lvl" value="{{ $data['props']['parent'] }}">
                        <input type="hidden" id="cat_2_lvl" value="{{ $data['props']['section'] }}">
                        <input type="hidden" id="cat_3_lvl" value="{{ $data['props']['child'] }}">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
