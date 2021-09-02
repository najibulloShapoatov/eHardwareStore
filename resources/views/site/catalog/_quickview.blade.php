<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
</head>

<body>
<div class="quickview">
    <button class="quickview__close" type="button" data-id="{{ $data->id }}">
        <svg width="20px" height="20px">
            <use xlink:href="/public/site_assets/images/sprite.svg#cross-20"></use>
        </svg>
    </button>
    <div class="product product--layout--quickview" data-layout="quickview">
        <div class="product__content">

            <!-- .product__gallery -->
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
                                    <img src="/public/uploads/products/{{ $data->id }}/thumb_{{ $data->image }}" class="product-gallery__carousel-image" alt="{{ $data->id }}">
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
            <!-- .product__gallery / end -->

            <!-- .product__info -->
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
                        $rating = \App\Models\Product::getReview($data->id);
                        $wishlistSts = \App\Models\Cart::getStatus($data->id);
                    @endphp
                    <div class="product__rating-stars">
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
                    </div>
                    <div class="product__rating-legend">
                        <a href="javascript:void(0)">{{ $rating['text'] }}</a>
                        {{--<span>/</span>
                        <a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Write A Review</a>--}}
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
                    <li>Бренд: <a href="#">{{ ($data->brand_id != '') ? $data->brand->title : '-' }}</a></li>
                    <li>Артикул: {{ $data->articul }}</li>
                </ul>

            </div>
            <!-- .product__info / end -->

            <!-- .product__sidebar -->
            <div class="product__sidebar">
                <div class="product__availability">В наличие: <span class="text-success">{{ ($data->quantity != 0) ? 'Есть' : 'Нет' }}</span></div>
                <div class="product__prices">{{ $data->price }} сом.</div>

               {{--
                <form class="product__options">
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
                                    <input
                                            id="product-quantity"
                                            class="input-number__input form-control form-control-lg"
                                            type="number"
                                            min="1"
                                            value="1"
                                            data-id="{{ $data->id }}"
                                    >
                                    <div class="input-number__add"></div>
                                    <div class="input-number__sub"></div>
                                </div>
                            </div>
                            <div class="product__actions-item product__actions-item--addtocart">
                                <button
                                        class="btn btn-primary btn-lg addToCart"
                                        data-id="{{ $data->id }}"
                                        data-qnt="1"
                                        id="_cart_{{ $data->id }}"
                                >Добавить в корзину</button>
                            </div>

                            <div class="product__actions-item product__actions-item--wishlist">
                                <button
                                    class="btn {{ ($wishlistSts == 1) ? 'btn-wishlist' : 'btn-primary-wishlist' }} btn-lg btn-secondary btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist wishlist_{{ $data->id }}"
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
                <!-- .product__options / end -->
            </div>
            <!-- .product__end -->

            {{--<div class="product__footer">
                <div class="product__tags tags">
                    <div class="tags__list"><a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Mounts</a> <a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Electrodes</a> <a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Chainsaws</a></div>
                </div>
                <div class="product__share-links share-links">
                    <ul class="share-links__list">
                        <li class="share-links__item share-links__item--type--like"><a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Like</a></li>
                        <li class="share-links__item share-links__item--type--tweet"><a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Tweet</a></li>
                        <li class="share-links__item share-links__item--type--pin"><a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">Pin It</a></li>
                        <li class="share-links__item share-links__item--type--counter"><a href="https://stroyka.html.themeforest.scompiler.ru/themes/default-ltr/quickview.html">4K</a></li>
                    </ul>
                </div>
            </div>--}}

        </div>
    </div>
</div>
</body>

</html>
