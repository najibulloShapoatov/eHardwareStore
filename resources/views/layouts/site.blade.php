<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('description')">

    <meta name="author" content="GRAVITY STUDIO, www.gravity.studio, info@gravity.tj, (+992)918246924">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="/public/site_assets/images/favicon.ico">

    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">

    <!-- css -->
    <link rel="stylesheet" href="/public/site_assets/vendor/bootstrap-4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/site_assets/vendor/owl-carousel-2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/public/site_assets/vendor/photoswipe-4.1.3/photoswipe.css">
    <link rel="stylesheet" href="/public/site_assets/vendor/photoswipe-4.1.3/default-skin/default-skin.css">
    <link rel="stylesheet" href="/public/site_assets/vendor/select2-4.0.10/css/select2.min.css">
    <link rel="stylesheet" href="/public/site_assets/css/jquery.growl.css">
    <link rel="stylesheet" href="/public/site_assets/css/style.css">
    <link rel="stylesheet" href="/public/site_assets/css/custom.css">

    <!-- font - fontawesome -->
    <link rel="stylesheet" href="/public/site_assets/vendor/fontawesome-5.6.1/css/all.min.css">

    <!-- font - stroyka -->
    <link rel="stylesheet" href="/public/site_assets/fonts/stroyka/stroyka.css">

    @yield('styles')

</head>

<body>

<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content"></div>
    </div>
</div>
<!-- quickview-modal / end -->

<!-- mobilemenu -->
<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title">Меню</div>
            <button type="button" class="mobilemenu__close">
                <svg width="20px" height="20px">
                    <use xlink:href="/public/site_assets/images/sprite.svg#cross-20"></use>
                </svg>
            </button>
        </div>
        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">
                <li class="mobile-links__item">
                    <div class="mobile-links__item-title">
                        <a href="/" class="mobile-links__item-link">Главная</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title"><a href="/catalog/all" class="mobile-links__item-link">Товары</a>
                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-links__item-sub-links" data-collapse-content>
                        <ul class="mobile-links mobile-links--level--1">
                            @foreach($categories as $item)
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ url('/catalog/' . $item['slug']) }}" class="mobile-links__item-link">{{ $item['title'] }}</a>
                                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-12x7"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    @if(!empty($item['child']))
                                        <div class="mobile-links__item-sub-links" data-collapse-content>
                                            <ul class="mobile-links mobile-links--level--2">
                                                @foreach($item['child'] as $sub)
                                                    <li class="mobile-links__item" data-collapse-item>
                                                        <div class="mobile-links__item-title">
                                                            <a href="{{ url('/catalog/' . $sub['slug']) }}" class="mobile-links__item-link">{{ $sub['title'] }}</a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="/advices" class="mobile-links__item-link">Советы</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="/delivery" class="mobile-links__item-link">Доставка</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="/sales" class="mobile-links__item-link">Скидки</a>
                    </div>
                </li>
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="/contacts" class="mobile-links__item-link">Контакты</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- mobilemenu / end -->

<!-- site -->
<div class="site">

    <!-- mobile site__header -->
    <header class="site__header d-lg-none">
        <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
        <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
            <div class="mobile-header__panel">
                <div class="container">
                    <div class="mobile-header__body">

                        <button class="mobile-header__menu-button">
                            <svg width="18px" height="14px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#menu-18x14"></use>
                            </svg>
                        </button>

                        <a class="mobile-header__logo" href="/">АЗИМИСТРОЙ</a>

                        <div class="mobile-header__search">
                            <form class="mobile-header__search-form">
                                <input class="mobile-header__search-input" name="search" placeholder="Поиск товара ..." aria-label="Site search" type="text" autocomplete="off" id="searchInputMobile">
                                <button class="mobile-header__search-button mobile-header__search-button--submit" type="submit" id="searchSubmitMobile">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/public/site_assets/images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                                <button class="mobile-header__search-button mobile-header__search-button--close" type="button">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/public/site_assets/images/sprite.svg#cross-20"></use>
                                    </svg>
                                </button>
                                <div class="mobile-header__search-body"></div>
                            </form>
                        </div>
                        <div class="mobile-header__indicators">
                            <div class="indicator indicator--mobile-search indicator--mobile d-sm-none">
                                <button class="indicator__button">
                                    <span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="/public/site_assets/images/sprite.svg#search-20"></use></svg></span>
                                </button>
                            </div>
                            <div class="indicator indicator--mobile d-sm-flex d-none">
                                <a href="/wishlist" class="indicator__button">
                                    <span class="indicator__area"><svg width="20px" height="20px"><use xlink:href="/public/site_assets/images/sprite.svg#heart-20"></use></svg>
                                        <span class="indicator__value indicator_wishlist_value">{{ $wishlistQnt }}</span>
                                    </span>
                                </a>
                            </div>
                            <div class="indicator indicator--mobile">
                                <a href="/cart" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px"><use xlink:href="/public/site_assets/images/sprite.svg#cart-20"></use></svg>
                                        <span class="indicator__value indicator_cart_value">{{ $basket['qnt'] }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- mobile site__header / end -->

    <!-- desktop site__header -->
    <header class="site__header d-lg-block d-none">
        <div class="site-header">
            <!-- .topbar -->
            <div class="site-header__topbar topbar">
                <div class="topbar__container container">
                    <div class="topbar__row">
                        <div class="topbar__item topbar__item--link"><a class="topbar-link" href="{{ url('/about') }}">Наша компания</a></div>
                        <div class="topbar__item topbar__item--link"><a class="topbar-link" href="{{ url('/stores') }}">Наши магазины</a></div>
                        <div class="topbar__item topbar__item--link"><a class="topbar-link" href="{{ url('/our-brands') }}">Наши марки</a></div>
                        <div class="topbar__spring"></div>
                        <div class="topbar__item">
                            @if($userInfo)
                                <div class="topbar-dropdown">
                                    <button class="topbar-dropdown__btn" type="button">{{ $userInfo->name }} {{ $userInfo->surname }}
                                        <svg width="7px" height="5px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                        </svg>
                                    </button>
                                    <div class="topbar-dropdown__body">
                                        <!-- .menu -->
                                        <div class="menu menu--layout--topbar">
                                            <div class="menu__submenus-container"></div>
                                            <ul class="menu__list">
                                                <li class="menu__item">
                                                    <div class="menu__item-submenu-offset"></div>
                                                    <a class="menu__item-link" href="{{ url('/account') }}">Мой аккаунт</a>
                                                </li>
                                                <li class="menu__item">
                                                    <div class="menu__item-submenu-offset"></div>
                                                    <a class="menu__item-link" href="{{ url('/account/profile') }}">Мой профиль</a>
                                                </li>
                                                <li class="menu__item">
                                                    <div class="menu__item-submenu-offset"></div>
                                                    <a class="menu__item-link" href="{{ url('/account/orders') }}">Мои заказы</a>
                                                </li>
                                                <li class="menu__item">
                                                    <div class="menu__item-submenu-offset"></div>
                                                    <a class="menu__item-link" href="{{ url('/account/password') }}">Изменить пароль</a>
                                                </li>
                                                <li class="menu__item">
                                                    <div class="menu__item-submenu-offset"></div>
                                                    <a class="menu__item-link" href="{{ url('/logout') }}">Выйти</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- .menu / end -->
                                    </div>
                                </div>
                            @else
                                <div class="topbar__item topbar__item--link"><a class="topbar-link" href="{{ url('/sign-in') }}">Вход</a></div>
                                <div class="topbar__item topbar__item--link"><a class="topbar-link" href="{{ url('/sign-up') }}">Регистрация</a></div>
                            @endif
                        </div>

                        {{--
                        <div class="topbar__item">
                            <div class="topbar-dropdown">
                                <button class="topbar-dropdown__btn" type="button">Currency: <span class="topbar__item-value">USD</span>
                                    <svg width="7px" height="5px">
                                        <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                    </svg>
                                </button>
                                <div class="topbar-dropdown__body">
                                    <!-- .menu -->
                                    <div class="menu menu--layout--topbar">
                                        <div class="menu__submenus-container"></div>
                                        <ul class="menu__list">
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div><a class="menu__item-link" href="#">€ Euro</a></li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div><a class="menu__item-link" href="#">£ Pound Sterling</a></li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div><a class="menu__item-link" href="#">$ US Dollar</a></li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div><a class="menu__item-link" href="#">₽ Russian Ruble</a></li>
                                        </ul>
                                    </div>
                                    <!-- .menu / end -->
                                </div>
                            </div>
                        </div>
                        <div class="topbar__item">
                            <div class="topbar-dropdown">
                                <button class="topbar-dropdown__btn" type="button">Language: <span class="topbar__item-value">EN</span>
                                    <svg width="7px" height="5px">
                                        <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-7x5"></use>
                                    </svg>
                                </button>
                                <div class="topbar-dropdown__body">
                                    <!-- .menu -->
                                    <div class="menu menu--layout--topbar menu--with-icons">
                                        <div class="menu__submenus-container"></div>
                                        <ul class="menu__list">
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div>
                                                <a class="menu__item-link" href="#">
                                                    <div class="menu__item-icon"><img srcset="/public/site_assets/images/languages/language-1.png, /public/site_assets/images/languages/language-1@2x.png 2x" src="/public/site_assets/images/languages/language-1.png" alt=""></div>English</a>
                                            </li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div>
                                                <a class="menu__item-link" href="#">
                                                    <div class="menu__item-icon"><img srcset="/public/site_assets/images/languages/language-2.png, /public/site_assets/images/languages/language-2@2x.png 2x" src="/public/site_assets/images/languages/language-2.png" alt=""></div>French</a>
                                            </li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div>
                                                <a class="menu__item-link" href="#">
                                                    <div class="menu__item-icon"><img srcset="/public/site_assets/images/languages/language-3.png, /public/site_assets/images/languages/language-3@2x.png 2x" src="/public/site_assets/images/languages/language-3.png" alt=""></div>German</a>
                                            </li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div>
                                                <a class="menu__item-link" href="#">
                                                    <div class="menu__item-icon"><img srcset="/public/site_assets/images/languages/language-4.png, /public/site_assets/images/languages/language-4@2x.png 2x" src="/public/site_assets/images/languages/language-4.png" alt=""></div>Russian</a>
                                            </li>
                                            <li class="menu__item">
                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                <div class="menu__item-submenu-offset"></div>
                                                <a class="menu__item-link" href="#">
                                                    <div class="menu__item-icon"><img srcset="/public/site_assets/images/languages/language-5.png, /public/site_assets/images/languages/language-5@2x.png 2x" src="/public/site_assets/images/languages/language-5.png" alt=""></div>Italian</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .menu / end -->
                                </div>
                            </div>
                        </div>
                        --}}

                    </div>
                </div>
            </div>
            <!-- .topbar / end -->
            <div class="site-header__middle container">
                <div class="site-header__logo">
                    <a href="/">
                        <img src="/public/images/logo.png" alt="logo">
                    </a>
                </div>
                <div class="site-header__search">
                    <div class="search">
                        <form class="search__form">
                            <input class="search__input" name="search" placeholder="Поиск товара ..." aria-label="Site search" type="text" autocomplete="off" id="searchInput">
                            <button class="search__button" type="submit" id="searchSubmit">
                                <svg width="20px" height="20px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#search-20"></use>
                                </svg>
                            </button>
                            <div class="search__border"></div>
                        </form>
                    </div>
                </div>
                <div class="site-header__phone">
                    <div class="site-header__phone-title">Офис-менеджер</div>
                    <div class="site-header__phone-number">{{ $dataConfig->office_manager_phone }}</div>
                </div>
            </div>
            <div class="site-header__nav-panel">
                <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
                <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                    <div class="nav-panel__container container">
                        <div class="nav-panel__row">
                            <div class="nav-panel__departments">
                                <!-- .departments -->
                                @php
                                    $catClass = '';
                                    $fixType = '';

                                    if (Request::is('/')) {
                                        $catClass = 'departments--open departments--fixed';
                                        $fixType = '.block-slideshow';
                                    }
                                @endphp
                                <div class="departments {{ $catClass }}" data-departments-fixed-by="{{ $fixType }}">
                                    <div class="departments__body">
                                        <div class="departments__links-wrapper">
                                            <div class="departments__submenus-container"></div>
                                            <ul class="departments__links">
                                                @foreach($categories as $item)
                                                    <li class="departments__item">
                                                        <a class="departments__item-link" href="{{ url('/catalog/' . $item['slug']) }}">{{ $item['title'] }} <svg class="departments__item-arrow" width="6px" height="9px">
                                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use></svg>
                                                        </a>
                                                        <div class="departments__submenu departments__submenu--type--megamenu departments__submenu--size--lg">
                                                            <div class="megamenu megamenu--departments">
                                                                <div class="megamenu__body" style="background-image: url('/public/uploads/category/{{ $item['image'] }}'); background-position: right bottom; background-repeat: no-repeat; background-size: 30%;">
                                                                    <div class="row">
                                                                        @if(!empty($item['child']))
                                                                            @foreach($item['child'] as $sub)
                                                                                <div class="col-4">
                                                                                    <ul class="megamenu__links megamenu__links--level--0">
                                                                                        <li class="megamenu__item megamenu__item--with-submenu"><a href="{{ url('/catalog/' . $sub['slug']) }}">{{ $sub['title'] }}</a>
                                                                                            @if(!empty($sub['child']))
                                                                                                <ul class="megamenu__links megamenu__links--level--1">
                                                                                                    @foreach($sub['child'] as $subsub)
                                                                                                        <li class="megamenu__item"><a href="{{ url('/catalog/' . $subsub['slug']) }}">{{ $subsub['title'] }}</a></li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            @endif
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button class="departments__button">
                                        <svg class="departments__button-icon" width="18px" height="14px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#menu-18x14"></use>
                                        </svg> Каталог товаров
                                        <svg class="departments__button-arrow" width="9px" height="6px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-down-9x6"></use>
                                        </svg>
                                    </button>
                                </div>
                                <!-- .departments / end -->
                            </div>
                            <!-- .nav-links -->
                            <div class="nav-panel__nav-links nav-links">
                                <ul class="nav-links__list">
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/') }}">
                                            <div class="nav-links__item-body">Главная</div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/catalog/all') }}">
                                            <div class="nav-links__item-body">Товары</div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/advices') }}">
                                            <div class="nav-links__item-body">Советы</div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/delivery') }}">
                                            <div class="nav-links__item-body">Достаква</div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/sales') }}">
                                            <div class="nav-links__item-body">Скидки</div>
                                        </a>
                                    </li>
                                    <li class="nav-links__item">
                                        <a class="nav-links__item-link" href="{{ url('/contacts') }}">
                                            <div class="nav-links__item-body">Контакты</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- .nav-links / end -->

                            <div class="nav-panel__indicators">

                                <!-- wishlist -->
                                <div class="indicator">
                                    <a href="{{ url('/wishlist') }}" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#heart-20"></use>
                                            </svg>
                                            <span class="indicator__value indicator_wishlist_value">{{ $wishlistQnt }}</span>
                                        </span>
                                    </a>
                                </div>

                                <!-- cart -->
                                <div class="indicator indicator--trigger--click">
                                    <a href="{{ url('/cart') }}" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#cart-20"></use>
                                            </svg>
                                            <span class="indicator__value indicator_cart_value">{{ $basket['qnt'] }}</span>
                                        </span>
                                    </a>
                                    <div class="indicator__dropdown">
                                        <div class="dropcart">
                                            @if(!empty($basket['items']))
                                                <div class="dropcart__products-list">
                                                    @foreach($basket['items'] as $item)
                                                        <div class="dropcart__product cart-row-{{ $item->id }}">
                                                            <div class="dropcart__product-image">
                                                                <a href="/catalog/product/{{ $item->articul }}">
                                                                    @if(!empty($item->image))
                                                                        <img src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" alt="{{ $item->title }}">
                                                                    @else
                                                                        <img src="/public/uploads/no-thumb.png" alt="no image">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="dropcart__product-info">
                                                                <div class="dropcart__product-name">
                                                                    <a href="/catalog/product/{{ $item->articul }}">
                                                                        {{ str_limit($item->title, 38, '...') }}
                                                                    </a>
                                                                </div>
                                                                <div class="dropcart__product-meta">
                                                                    <span class="dropcart__product-quantity">{{ $item->cart_qnt }}</span> ×
                                                                    <span class="dropcart__product-price">{{ $item->cart_price }} сом.</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" data-id="{{ $item->id }}" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                                <svg width="10px" height="10px">
                                                                    <use xlink:href="/public/site_assets/images/sprite.svg#cross-10"></use>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="dropcart__totals">
                                                    <table>
                                                        <tr>
                                                            <th>Всего</th>
                                                            <td>{{ $basket['sum'] }} сом.</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="dropcart__buttons">
                                                    <a class="btn btn-secondary" href="{{ url('/cart') }}">Корзина</a>
                                                    <a class="btn btn-primary" href="{{ url('/checkout') }}">Оформить</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- desktop site__header / end -->

    <!-- site__body -->
    <div class="site__body">
        @yield('content')
    </div>
    <!-- site__body / end -->

    <!-- site__footer -->
    <footer class="site__footer">
        <div class="site-footer">
            <div class="container">
                <div class="site-footer__widgets">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="site-footer__widget footer-contacts">
                                <h5 class="footer-contacts__title">Контакты</h5>
                                <ul class="footer-contacts__contacts">
                                    <li><i class="footer-contacts__icon fas fa-globe-americas"></i> {{ $dataConfig->address }}</li>
                                    <li><i class="footer-contacts__icon far fa-envelope"></i> <a href="mailto:{{ $dataConfig->email }}">{{ $dataConfig->email }}</a></li>
                                    <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> {{ $dataConfig->phone }}</li>
                                    <li><i class="footer-contacts__icon far fa-clock"></i> {{ $dataConfig->working_days }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="site-footer__widget footer-links">
                                <h5 class="footer-links__title">Информация</h5>
                                <ul class="footer-links__list">
                                    <li class="footer-links__item"><a href="{{ url('/about') }}" class="footer-links__link">Наша компания</a></li>
                                    <li class="footer-links__item"><a href="{{ url('/stores') }}" class="footer-links__link">Наши магазины</a></li>
                                    <li class="footer-links__item"><a href="{{ url('/our-brands') }}" class="footer-links__link">Наши марки</a></li>
                                    <li class="footer-links__item"><a href="{{ url('/vacancies') }}" class="footer-links__link">Наши вакансии</a></li>
                                    <li class="footer-links__item"><a href="{{ url('/contacts') }}" class="footer-links__link">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="site-footer__widget footer-links">
                                <h5 class="footer-links__title">Услуги</h5>
                                <ul class="footer-links__list">
                                    <li class="footer-links__item"><a href="/delivery" class="footer-links__link">Доставка</a></li>
                                    <li class="footer-links__item"><a href="/pickup" class="footer-links__link">Самовывоз</a></li>
                                    {{--<li class="footer-links__item"><a href="#" class="footer-links__link">Проверка техники</a></li>
                                    <li class="footer-links__item"><a href="#" class="footer-links__link">Установка</a></li>--}}
                                    <li class="footer-links__item"><a href="/purchase-returns" class="footer-links__link">Возврат товара</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="site-footer__widget footer-newsletter">
                                <h5 class="footer-newsletter__title">Подпишись на скидки</h5>
                                <div class="footer-newsletter__text">Получайте скидку до 10%</div>
                                <form action="#" class="footer-newsletter__form">
                                    <label class="sr-only" for="footer-newsletter-address">Введите эл. почту</label>
                                    <input type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="Введите эл. почту">
                                    <button class="footer-newsletter__form-button btn btn-primary" id="footer-newsletter-submit">Подписаться</button>
                                </form>
                                <div id="subsResult"></div>
                                <div class="footer-newsletter__text footer-newsletter__text--social">Мы в соц. сети</div>
                                <ul class="footer-newsletter__social-links">
                                    @if(!empty($dataConfig->facebook_link))
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--facebook"><a href="{{ $dataConfig->facebook_link }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if(!empty($dataConfig->instagram_link))
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--instagram"><a href="{{ $dataConfig->instagram_link }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(!empty($dataConfig->telegram_link))
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--telegram"><a href="{{ $dataConfig->telegram_link }}" target="_blank"><i class="fab fa-telegram"></i></a></li>
                                    @endif
                                    @if(!empty($dataConfig->whatsapp_link))
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--whatsapp"><a href="{{ $dataConfig->whatsapp_link }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                    @endif
                                    @if(!empty($dataConfig->viber_link))
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--viber"><a href="{{ $dataConfig->viber_link }}" target="_blank"><i class="fab fa-viber"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-footer__bottom">
                    <div class="site-footer__payments">
                        &copy;{{ date('Y') }} ООО «<a href="{{ url('/') }}">Азими.Ко</a>»
                        {{--<img src="/public/site_assets/images/payments.png" alt="">--}}
                    </div>
                    <div class="site-footer__copyright">Разработан в <a href="https://www.gravity.studio" target="_blank">Gravity Studio</a></div>
                </div>
            </div>
            <div class="totop">
                <div class="totop__body">
                    <div class="totop__start"></div>
                    <div class="totop__container container"></div>
                    <div class="totop__end">
                        <button type="button" class="totop__button">
                            <svg width="13px" height="8px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-up-13x8"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- site__footer / end -->

</div>
<!-- site / end -->

<!-- photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <!--<button class="pswp__button pswp__button&#45;&#45;share" title="Share"></button>-->
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<!-- photoswipe / end -->

<!-- js -->
<script src="/public/site_assets/vendor/jquery-3.3.1/jquery.min.js"></script>
<script src="/public/site_assets/vendor/bootstrap-4.2.1/js/bootstrap.bundle.min.js"></script>
<script src="/public/site_assets/vendor/owl-carousel-2.3.4/owl.carousel.min.js"></script>
<script src="/public/site_assets/vendor/nouislider-12.1.0/nouislider.min.js"></script>
<script src="/public/site_assets/vendor/photoswipe-4.1.3/photoswipe.min.js"></script>
<script src="/public/site_assets/vendor/photoswipe-4.1.3/photoswipe-ui-default.min.js"></script>
<script src="/public/site_assets/vendor/select2-4.0.10/js/select2.min.js"></script>
<script src="/public/site_assets/js/number.js"></script>
<script src="/public/site_assets/js/main.js"></script>
<script src="/public/site_assets/js/header.js"></script>
<script src="/public/site_assets/js/jquery.growl.js"></script>
<script src="/public/site_assets/js/custom.js"></script>
<script src="/public/site_assets/vendor/svg4everybody-2.1.9/svg4everybody.min.js"></script>
<script>
    svg4everybody();
</script>

@yield('scripts')

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(61876735, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/61876735" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



</body>
</html>
