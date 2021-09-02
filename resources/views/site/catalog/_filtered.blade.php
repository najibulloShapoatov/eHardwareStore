@foreach($result['data'] as $item)
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
