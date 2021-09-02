@extends('layouts.site')
@section('title', 'Советы от АЗИМИСТРОЙ | ' . $data->title)
@section('description', 'Советы от АЗИМИСТРОЙ, ' . $data->title)

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
                        <li class="breadcrumb-item"><a href="{{ url('/advices') }}">Советы от АЗИМИСТРОЙ</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>{{ $data->title }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block">
                    <div class="posts-view">
                        <div class="posts-view__list posts-list posts-list--layout--grid2">
                            <div class="posts-list__body">
                                @if(count($list))
                                    @foreach($list as $item)
                                        <div class="posts-list__item">
                                            <div class="post-card post-card--layout--grid post-card--size--nl">
                                                <div class="post-card__image">
                                                    <a href="{{ url('/advices/' . $item->slug) }}">
                                                        @if(!empty($item->image))
                                                            <img src="/public/uploads/advices/{{ $item->image }}" alt="{{ $item->title }}">
                                                        @else
                                                            <img src="/public/uploads/no-thumb.png" alt="no image">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="post-card__info">
                                                    <div class="post-card__category">
                                                        <a href="#">{{ $item->category->title }}</a>
                                                    </div>
                                                    <div class="post-card__name">
                                                        <a href="{{ url('/advices/' . $item->slug) }}">{{ $item->title }}</a>
                                                    </div>
                                                    <div class="post-card__date">{{ date('d.m.Y', strtotime($item->date_add)) }}</div>
                                                    <div class="post-card__content">{{ $item->preview_text }}</div>
                                                    <div class="post-card__read-more"><a href="#" class="btn btn-secondary btn-sm">Read More</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p style="margin:20px 0 0 15px;">Нет данных</p>
                                @endif
                            </div>
                        </div>
                        <div class="posts-view__pagination">
                            @include('pagination.default', ['paginator' => $list])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block block-sidebar block-sidebar--position--end">

                    <div class="block-sidebar__item">
                        <div class="widget-aboutus widget">
                            <h4 class="widget__title">Наша компания</h4>
                            <div class="widget-aboutus__text">{!! $dataConfig->about_company_sitebar !!}</div>
                        </div>
                    </div>

                    {{--
                    <div class="block-sidebar__item">
                        <div class="widget-categories widget-categories--location--blog widget">
                            <h4 class="widget__title">Категории</h4>
                            <ul class="widget-categories__list" data-collapse data-collapse-opened-class="widget-categories__item--open">
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Latest News</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Special Offers </a>
                                        <button class="widget-categories__expander" type="button" data-collapse-trigger></button>
                                    </div>
                                    <div class="widget-categories__subs" data-collapse-content>
                                        <ul>
                                            <li><a href="#">Spring Sales</a></li>
                                            <li><a href="#">Summer Sales</a></li>
                                            <li><a href="#">Autumn Sales</a></li>
                                            <li><a href="#">Christmas Sales</a></li>
                                            <li><a href="#">Other Sales</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> New Arrivals</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Reviews</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Drills and Mixers</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Cordless Screwdrivers</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Screwdrivers</a>
                                    </div>
                                </li>
                                <li class="widget-categories__item" data-collapse-item>
                                    <div class="widget-categories__row">
                                        <a href="#">
                                            <svg class="widget-categories__arrow" width="6px" height="9px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                            </svg> Wrenches</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    --}}

                    <div class="block-sidebar__item">
                        <div class="widget-tags widget">
                            <h4 class="widget__title">По типу</h4>
                            <div class="tags tags--lg">
                                <div class="tags__list">
                                    @foreach($tags as $item)
                                        <a href="{{ url('/advices/type/' . $item->slug) }}">{{ $item->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
