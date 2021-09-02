@foreach($data as $item)
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
