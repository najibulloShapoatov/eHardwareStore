@extends('layouts.site')
@section('title', 'Каталог')
@section('description', 'Каталог')

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
                        <li class="breadcrumb-item active" aria-current="page">Каталог</li>
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
                            <div class="block-sidebar__title">Filters</div>
                            <button class="block-sidebar__close" type="button">
                                <svg width="20px" height="20px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#cross-20"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="block-sidebar__item">
                            <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened">
                                <h4 class="widget-filters__title widget__title">Фильтры</h4>
                                <div class="widget-filters__list">
                                    <div class="widget-filters__item">
                                        <div class="filter filter--opened" data-collapse-item>
                                            <button type="button" class="filter__title" data-collapse-trigger>Категории
                                                <svg class="filter__arrow" width="12px" height="7px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                </svg>
                                            </button>
                                            <div class="filter__body" data-collapse-content>
                                                <div class="filter__container">
                                                    <div class="filter-categories-alt">
                                                        <ul class="filter-categories-alt__list" data-collapse-opened-class="filter-categories-alt__item--open">
                                                            @foreach($categories as $item)
                                                                @php
                                                                    $a = 1;
                                                                    if($a == 2){
                                                                        $selected = "filter-categories-alt__item--open filter-categories-alt__item--current";
                                                                        $active = "filter-categories-alt__sub-item--current";
                                                                    }
                                                                    else{
                                                                        $selected = "";
                                                                        $active = "";
                                                                    }
                                                                @endphp
                                                                <li class="filter-categories-alt__item {{ $selected }}" data-collapse-item>
                                                                    <button class="filter-categories-alt__expander" data-collapse-trigger></button>
                                                                    <a href="{{ url('/catalog/' . $item['id']) }}">{{ $item['title'] }}</a>
                                                                    @if(!empty($item['child']))
                                                                        <div class="filter-categories-alt__sub" data-collapse-content>
                                                                            <ul class="filter-categories-alt__sub-list">
                                                                                @foreach($item['child'] as $sub)
                                                                                    <li class="filter-categories-alt__sub-item {{ $active }}">
                                                                                        <a href="{{ url('/catalog/' . $sub['id']) }}">{{ $sub['title'] }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-filters__item">
                                        <div class="filter filter--opened" data-collapse-item>
                                            <button type="button" class="filter__title" data-collapse-trigger>Стоимость
                                                <svg class="filter__arrow" width="12px" height="7px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                </svg>
                                            </button>
                                            <div class="filter__body" data-collapse-content>
                                                <div class="filter__container">
                                                    <div class="filter-price" data-min="500" data-max="1500" data-from="590" data-to="1130">
                                                        <div class="filter-price__slider"></div>
                                                        <div class="filter-price__title"><span class="filter-price__min-value"></span> – <span class="filter-price__max-value"></span> сом.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-filters__item">
                                        <div class="filter filter--opened" data-collapse-item>
                                            <button type="button" class="filter__title" data-collapse-trigger>Бренды
                                                <svg class="filter__arrow" width="12px" height="7px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                </svg>
                                            </button>
                                            <div class="filter__body" data-collapse-content>
                                                <div class="filter__container">
                                                    <div class="filter-list">
                                                        <div class="filter-list__list">
                                                            <label class="filter-list__item"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">Wakita </span><span class="filter-list__counter">7</span></label>
                                                            <label class="filter-list__item"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox" checked="checked"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">Zosch </span><span class="filter-list__counter">42</span></label>
                                                            <label class="filter-list__item filter-list__item--disabled"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox" checked="checked" disabled="disabled"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">WeVALT</span></label>
                                                            <label class="filter-list__item filter-list__item--disabled"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox" disabled="disabled"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">Hammer</span></label>
                                                            <label class="filter-list__item"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">Mitasia </span><span class="filter-list__counter">1</span></label>
                                                            <label class="filter-list__item"><span class="filter-list__input input-check"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span>
                                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-9x7"></use>
                                                                        </svg>
                                                                        </span>
                                                                        </span><span class="filter-list__title">Metaggo </span><span class="filter-list__counter">25</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                            <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #ff4040;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox" checked="checked"> <span class="input-check-color__box"></span>
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
                                                            <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #8fcc14;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox" checked="checked"> <span class="input-check-color__box"></span>
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
                                                            <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #40bfff;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox" disabled="disabled"> <span class="input-check-color__box"></span>
                                                                        <svg class="input-check-color__icon" width="12px" height="9px">
                                                                            <use xlink:href="/public/site_assets/images/sprite.svg#check-12x9"></use>
                                                                        </svg> <span class="input-check-color__stick"></span></label>
                                                                    </span>
                                                            </label>
                                                            <label class="filter-color__item"><span class="filter-color__check input-check-color" style="color: #3d6dcc;"><label class="input-check-color__body"><input class="input-check-color__input" type="checkbox" checked="checked"> <span class="input-check-color__box"></span>
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
                                </div>
                                <div class="widget-filters__actions d-flex">
                                    <button class="btn btn-primary btn-sm">Показать</button>
                                    <button class="btn btn-secondary btn-sm">Сбросить</button>
                                </div>
                            </div>
                        </div>

                        @if(!empty($topWeek))
                            <div class="block-sidebar__item d-none d-lg-block">
                                <div class="widget-products widget">
                                    <h4 class="widget__title">Топ недели</h4>
                                    <div class="widget-products__list">
                                        @foreach($topWeek as $item)
                                            <div class="widget-products__item">
                                                <div class="widget-products__image">
                                                    <a href="/catalog/product/{{ $item->articul }}">
                                                        @if(!empty($item->image))
                                                            <img src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" alt="{{ $item->title }}">
                                                        @else
                                                            <img src="/public/uploads/no-thumb.png" alt="no image">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="widget-products__info">
                                                    <div class="widget-products__name">
                                                        <a href="/catalog/product/{{ $item->articul }}">{{ $item->title }}</a>
                                                    </div>
                                                    <div class="widget-products__prices">{{ $item->price }} сом.</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

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
                                        <span class="filters-button__title">Filters</span>
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
                                            <option value="">По умолчанию</option>
                                            <option value="">Название (А-Я)</option>
                                            <option value="">Стоимости</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="view-options__control">
                                    <label for="">Показать</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="" id="">
                                            <option value="">12</option>
                                            <option value="">24</option>
                                            <option value="">50</option>
                                            <option value="">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($allProducts) > 0)
                            <div class="products-view__list products-list" data-layout="grid-3-sidebar" data-with-features="false">
                                <div class="products-list__body">
                                    @foreach($allProducts as $item)
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
                                                        <div class="rating">
                                                            <div class="rating__body">
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
                                                            </div>
                                                        </div>

                                                        <!--
                                                        <div class="product-card__rating-legend">9 Reviews</div>
                                                        -->

                                                    </div>
                                                    <ul class="product-card__features-list">
                                                        <li>Speed: 750 RPM</li>
                                                        <li>Power Source: Cordless-Electric</li>
                                                        <li>Battery Cell Type: Lithium</li>
                                                        <li>Voltage: 20 Volts</li>
                                                        <li>Battery Capacity: 2 Ah</li>
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
                                                        <button class="btn btn-primary product-card__addtocart" type="button">В корзину</button>
                                                        <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button">В корзину</button>
                                                        <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" type="button">
                                                            <svg width="16px" height="16px">
                                                                <use xlink:href="/public/site_assets/images/sprite.svg#wishlist-16"></use>
                                                            </svg>
                                                            <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
                                                        </button>
                                                        <!--
                                                        <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">
                                                            <svg width="16px" height="16px">
                                                                <use xlink:href="/public/site_assets/images/sprite.svg#compare-16"></use>
                                                            </svg>
                                                            <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
                                                        </button>
                                                        -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                        <div class="products-view__pagination">
                            @include('pagination.default', ['paginator' => $allProducts])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection