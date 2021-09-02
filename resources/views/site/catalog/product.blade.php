@extends('layouts.site')
@section('title', $data->title)
@section('description', $data->title)

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
                        <li class="breadcrumb-item"><a href="{{ url('/catalog') }}">Каталог</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>

                        @if(!empty($breadcrumb['child']))
                            @foreach($categories as $key => $item)
                                @if($item['slug'] == $breadcrumb['parent'])
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/catalog/' . $item['slug'])}}">{{ $item['title'] }}</a>
                                        <svg class="breadcrumb-arrow" width="6px" height="9px">
                                            <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                        </svg>
                                    </li>
                                    @foreach($item['child'] as $section)
                                        @if($section['slug'] == $breadcrumb['section'])
                                            <li class="breadcrumb-item">
                                                <a href="{{ url('/catalog/' . $section['slug'])}}">{{ $section['title'] }}</a>
                                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                </svg>
                                            </li>
                                            @if(!empty($section['child']))
                                                @foreach($section['child'] as $value)
                                                    @if($value['slug'] == $breadcrumb['child'])
                                                        <li class="breadcrumb-item">
                                                            <a href="{{ url('/catalog/' . $value['slug'])}}">{{ $value['title'] }}</a>
                                                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                            </svg>
                                                        </li>
                                                        <li class="breadcrumb-item active" aria-current="page">{{ !empty($data->title) ? $data->title : '-' }}</li>
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
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="container">
            <div class="product product--layout--standard" data-layout="standard">
                <div class="product__content">

                    <div class="product__gallery">
                        <div class="product-gallery">
                            <div class="product-gallery__featured">
                                <button class="product-gallery__zoom">
                                    <svg width="24px" height="24px">
                                        <use xlink:href="/public/site_assets/images/sprite.svg#zoom-in-24"></use>
                                    </svg>
                                </button>
                                <div class="owl-carousel" id="product-image">

                                    {{-- preview image --}}
                                    @if(!empty($data->image))
                                        <a href="/public/uploads/products/{{ $data->id }}/{{ $data->image }}" target="_blank">
                                            <img src="/public/uploads/products/{{ $data->id }}/{{ $data->image }}" alt="{{ $data->title }}">
                                        </a>
                                    @endif

                                    {{-- gallery --}}
                                    @if($data->gallery)
                                        @foreach($data->gallery as $item)
                                            <a href="/public/uploads/products/{{ $data->id }}/{{ $item->image }}" target="_blank">
                                                <img src="/public/uploads/products/{{ $data->id }}/{{ $item->image }}" alt="{{ $item->id }}">
                                            </a>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="product-gallery__carousel">
                                <div class="owl-carousel" id="product-carousel">
                                    {{-- preview image --}}
                                    @if(!empty($data->image))
                                        <a href="/public/uploads/products/{{ $data->id }}/{{ $data->image }}" class="product-gallery__carousel-item" >
                                            <img src="/public/uploads/products/{{ $data->id }}/thumb_{{ $data->image }}" class="product-gallery__carousel-image" alt="{{ $data->title }}">
                                        </a>
                                    @endif

                                    {{-- gallery --}}
                                    @if($data->gallery)
                                        @foreach($data->gallery as $item)
                                            <a href="/public/uploads/products/{{ $data->id }}/{{ $item->image }}" class="product-gallery__carousel-item">
                                                <img src="/public/uploads/products/{{ $data->id }}/thumb_{{ $item->image }}" class="product-gallery__carousel-image" alt="{{ $item->id }}">
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product__info">

                        {{--
                        <div class="product__wishlist-compare">
                            <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                <svg width="16px" height="16px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#wishlist-16"></use>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Compare">
                                <svg width="16px" height="16px">
                                    <use xlink:href="/public/site_assets/images/sprite.svg#compare-16"></use>
                                </svg>
                            </button>
                        </div>
                        --}}

                        <h1 class="product__name">{{ $data->title }}</h1>
                        <div class="product__rating">
                            @php
                                $rating = $data->getReview($data->id);
                                $wishlistSts = \App\Models\Cart::getStatus($data->id);
                            @endphp
                            <div class="product__rating-stars">
                                <div class="rating">
                                    <div class="rating__body">
                                        @foreach($rating['star'] as $item)
                                            @if($item == 'gold')
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
                            </div>
                            <div class="product__rating-legend">
                                <a href="javascript:">{{ $rating['text'] }}</a>
                                <span>/</span><a href="#" id="writeReview">Оставить отзыв</a>
                            </div>
                        </div>

                        {{--<div class="product__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare, mi in ornare elementum, libero nibh lacinia urna, quis convallis lorem erat at purus. Maecenas eu varius nisi.</div>--}}

                        <ul class="product-card__features-list">
                            @php
                                $prod = new \App\Models\Product();
                                $attrs = $prod->attributes($data->category_id, $data->id);
                                echo $attrs;
                            @endphp
                        </ul>

                        <ul class="product__meta">
                            <li class="product__meta-availability">В наличие: <span class="text-success">{{ ($data->quantity != 0) ? 'Есть' : 'Нет' }}</span></li>
                            <li>Бренд: <a href="#">{{ !empty($data->brand_id) ? $data->brand->title : '-' }}</a></li>
                            <li>Артикул: {{ $data->articul }}</li>
                        </ul>

                    </div>

                    <!-- .product__sidebar -->
                    <div class="product__sidebar">
                        <div class="product__availability">В наличие: <span class="text-success">{{ ($data->quantity != 0) ? 'Есть' : 'Нет' }}</span></div>
                        <div class="product__prices">{{ $data->price }} сом.</div>


                        <form class="product__options">

                            {{--
                            <div class="form-group product__option">
                                <label class="product__option-label">Цвет</label>
                                <div class="input-radio-color">
                                    <div class="input-radio-color__list">
                                        <label class="input-radio-color__item input-radio-color__item--white" style="color: #fff;" data-toggle="tooltip" title="White">
                                            <input type="radio" name="color"> <span></span></label>
                                        <label class="input-radio-color__item" style="color: #ffd333;" data-toggle="tooltip" title="Yellow">
                                            <input type="radio" name="color"> <span></span></label>
                                        <label class="input-radio-color__item" style="color: #ff4040;" data-toggle="tooltip" title="Red">
                                            <input type="radio" name="color"> <span></span></label>
                                        <label class="input-radio-color__item input-radio-color__item--disabled" style="color: #4080ff;" data-toggle="tooltip" title="Blue">
                                            <input type="radio" name="color" disabled="disabled"> <span></span></label>
                                    </div>
                                </div>
                            </div>
                            --}}

                            {{--
                            <div class="form-group product__option">
                                <label class="product__option-label">Характеристики</label>
                                <div class="input-radio-label">
                                    <div class="input-radio-label__list">
                                        <label>
                                            <input type="radio" name="material"> <span>Metal</span></label>
                                        <label>
                                            <input type="radio" name="material"> <span>Wood</span></label>
                                        <label>
                                            <input type="radio" name="material" disabled="disabled"> <span>Plastic</span></label>
                                    </div>
                                </div>
                            </div>
                            --}}

                            <div class="form-group product__option">
                                <label class="product__option-label" for="product-quantity">Количество</label>
                                <div class="product__actions">
                                    <div class="product__actions-item">
                                        <div class="input-number product__quantity">
                                            <input id="product-quantity" data-id="{{ $data->id }}" class="input-number__input form-control form-control-lg" type="number" min="1" value="1">
                                            <div class="input-number__add"></div>
                                            <div class="input-number__sub"></div>
                                        </div>
                                    </div>
                                    <div class="product__actions-item product__actions-item--addtocart">
                                        <button class="btn btn-primary btn-lg addToCart" data-id="{{ $data->id }}" data-qnt="1" id="_cart_{{ $data->id }}">Добавить в корзину</button>
                                    </div>

                                    <div class="product__actions-item product__actions-item--wishlist">
                                        <button
                                            class="btn {{ ($wishlistSts == 1) ? 'btn-wishlist' : 'btn-primary-wishlist' }} btn-secondary btn-svg-icon btn-lg btn-svg-icon--fake-svg product-card__wishlist wishlist_{{ $data->id }}"
                                            type="button"
                                            data-toggle="tooltip"
                                            id="addtowish"
                                            data-id="{{ $data->id }}"
                                            data-sts="{{ $wishlistSts }}"
                                            title="Добавить в список желаний"
                                        >
                                            <svg width="16px" height="16px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#wishlist-16"></use>
                                            </svg>
                                        </button>
                                    </div>

                                    {{--
                                    <div class="product__actions-item product__actions-item--wishlist">
                                        <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Wishlist">
                                            <svg width="16px" height="16px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#wishlist-16"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="product__actions-item product__actions-item--compare">
                                        <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Compare">
                                            <svg width="16px" height="16px">
                                                <use xlink:href="/public/site_assets/images/sprite.svg#compare-16"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    --}}

                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- .product__end -->

                    {{--<div class="product__footer">
                        <div class="product__tags tags">
                            <div class="tags__list"><a href="#">Mounts</a> <a href="#">Electrodes</a> <a href="#">Chainsaws</a></div>
                        </div>
                        <div class="product__share-links share-links">
                            <ul class="share-links__list">
                                <li class="share-links__item share-links__item--type--like"><a href="#">Like</a></li>
                                <li class="share-links__item share-links__item--type--tweet"><a href="#">Tweet</a></li>
                                <li class="share-links__item share-links__item--type--pin"><a href="#">Pin It</a></li>
                                <li class="share-links__item share-links__item--type--counter"><a href="#">4K</a></li>
                            </ul>
                        </div>
                    </div>--}}

                </div>
            </div>
            <div class="product-tabs">
                <div class="product-tabs__list">
                    <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Описание</a>
                    <a href="#tab-specification" class="product-tabs__item">Характеристики</a>
                    <a href="#tab-reviews" class="product-tabs__item rewTab">Отзывы</a></div>
                <div class="product-tabs__content">
                    <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                        <div class="typography">
                            <h3>Описание товара</h3>
                            {!! $data->description !!}
                        </div>
                    </div>
                    <div class="product-tabs__pane" id="tab-specification">
                        <div class="spec">
                            <h3 class="spec__header">Характеристики товара</h3>
                            <div class="spec__section">
                                <h4 class="spec__section-title">Свойство</h4>
                                @foreach($details as $item)
                                    {!! $item !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="product-tabs__pane" id="tab-reviews">
                        <div class="reviews-view">
                            <div class="reviews-view__list">
                                <h3 class="reviews-view__header">Отзывы клиентов ({{ count($reviews) }})</h3>
                                <div class="reviews-list">
                                    <ol class="reviews-list__content">
                                        @if(count($reviews) > 0)
                                            @foreach($reviews as $item)
                                                <li class="reviews-list__item">
                                                    <div class="review">
                                                        <div class="review__content">
                                                            <div class="review__author">{{ $item->user->name ?? 'Без имени' }}</div>
                                                            <div class="review__rating">
                                                                <div class="rating">
                                                                    <div class="rating__body">
                                                                        @for($i=1; $i<=5; $i++)
                                                                            @if((int)$item->point >= $i)
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
                                                                                <div class="rating__star">
                                                                                    <div class="rating__fill">
                                                                                        <div class="fake-svg-icon"></div>
                                                                                    </div>
                                                                                    <div class="rating__stroke">
                                                                                        <div class="fake-svg-icon"></div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="review__text">{!! $item->description !!}</div>
                                                            <div class="review__date">{{Carbon\Carbon::parse($item->date_publish)->format('d.m.Y')}}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="reviews-list__item">
                                                <div class="review">
                                                    <div class="review__content">Нет отзыва</div>
                                                </div>
                                            </li>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                            <div class="reviews-view__form">
                                <h3 class="reviews-view__header">Оставить отзыв</h3>
                                @if(!empty($userInfo->id))
                                    <div class="row">
                                        <div class="col-12 col-lg-9 col-xl-8">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="review-stars">Оценить</label>
                                                    <select id="review-stars" class="form-control">
                                                        <option value="5">5 баллов</option>
                                                        <option value="4">4 балла</option>
                                                        <option value="3">3 балла</option>
                                                        <option value="2">2 балла</option>
                                                        <option value="1">1 балл</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="review-text">Отзыв</label>
                                                <textarea class="form-control" id="review-text" rows="6"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg" id="submitReview" data-id="{{ $data->id }}">Опубликовать</button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>Чтобы оставить отзыв,
                                        <a href="{{ url('/sign-in') }}">авторизуйтесь</a> или
                                        <a href="{{ url('/sign-up') }}">зарегистрируйтесь</a> на сайте!
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
