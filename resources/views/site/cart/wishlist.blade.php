@extends('layouts.site')
@section('title', 'Мои желания')
@section('description', 'Мои желания')

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
                        <li class="breadcrumb-item active" aria-current="page">Мои желания</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Мои желания</h1>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="container wishlistBlk">
            @if(count($data) > 0)
                <table class="wishlist">
                    <thead class="wishlist__head">
                    <tr class="wishlist__row">
                        <th class="wishlist__column wishlist__column--image">&nbsp;</th>
                        <th class="wishlist__column wishlist__column--product">Название</th>
                        <th class="wishlist__column wishlist__column--stock">Наличие на складе</th>
                        <th class="wishlist__column wishlist__column--price">Стоимость</th>
                        <th class="wishlist__column wishlist__column--tocart"></th>
                        <th class="wishlist__column wishlist__column--remove"></th>
                    </tr>
                    </thead>
                    <tbody class="wishlist__body">
                        @foreach($data as $item)
                            <tr class="wishlist__row wishlist_{{ $item->id }}">
                                <td class="wishlist__column wishlist__column--image">
                                    <a href="/catalog/product/{{ $item->articul }}">
                                        @if(!empty($item->image))
                                            <img src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" alt="{{ $item->title }}">
                                        @else
                                            <img src="/public/uploads/no-thumb.png" alt="no image">
                                        @endif
                                    </a>
                                </td>
                                <td class="wishlist__column wishlist__column--product">
                                    <a href="/catalog/product/{{ $item->articul }}" class="wishlist__product-name">{{ $item->title }}</a>
                                    <div class="wishlist__product-rating">
                                        @php
                                            $rating = \App\Models\Product::getReview($item->id);
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
                                        <div class="wishlist__product-rating-legend">{{ $rating['text'] }}</div>
                                    </div>
                                </td>
                                <td class="wishlist__column wishlist__column--stock">
                                    @if($item->quantity != 0)
                                        <div class="badge badge-success">В наличии</div>
                                    @else
                                        <div class="badge badge-danger">Нет в наличие</div>
                                    @endif
                                </td>
                                <td class="wishlist__column wishlist__column--price"><nobr>{{ $item->price }} сом.</nobr></td>
                                <td class="wishlist__column wishlist__column--tocart">
                                    <div class="product-card__buttons mt-0">
                                        <button type="button" class="btn btn-primary btn-sm product-card__addtocart" data-id="{{ $item->id }}" id="addtocart">В корзину</button>
                                    </div>
                                </td>
                                <td class="wishlist__column wishlist__column--remove">
                                    <button type="button" class="btn btn-light btn-sm btn-svg-icon" id="removeFromWishlist" data-id="{{ $item->id }}">
                                        <svg width="12px" height="12px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#cross-12"></use>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="not-found">
                    <div class="not-found__content">
                        <h1 class="not-found__title">У вас нет желаний :(</h1>
                        <p class="not-found__text">У вас нет каких-либо товаров в листе желаний.</p>
                        <p class="not-found__text">Вы найдете много интересных товаров в нашем магазине.</p>
                        <a class="btn btn-secondary btn-sm" href="{{ url('/catalog/all') }}">Товары</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
