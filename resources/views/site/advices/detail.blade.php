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
                        <li class="breadcrumb-item"><a href="{{ url('/advices') }}">Советы от АЗИМИСТРОЙ</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block post post--layout--classic">
                    <div class="post__header post-header post-header--layout--classic">
                        {{--<div class="post-header__categories"><a href="#">Latest news</a></div>--}}
                        <h1 class="post-header__title">{{ $data->title }}</h1>
                        <div class="post-header__meta">
                            <div class="post-header__meta-item">
                                <a href="javascript:">{{ date('d.m.Y', strtotime($data->date_add)) }}</a>
                            </div>
                            {{--<div class="post-header__meta-item"><a href="#">4 Comments</a></div>--}}
                        </div>
                    </div>
                    <div class="post__featured">
                        @if(!empty($data->image))
                            <img src="/public/uploads/advices/{{ $data->image }}" alt="{{ $data->title }}">
                        @else
                            <img src="/public/uploads/no-thumb.png" alt="no image">
                        @endif
                    </div>
                    <div class="post__content typography">
                        {!! $data->description !!}
                    </div>

                    {{--
                    <div class="post__footer">
                        <div class="post__tags-share-links">
                            <div class="post__tags tags">
                                <div class="tags__list"><a href="#">Promotion</a> <a href="#">Power Tool</a> <a href="#">Wrench</a> <a href="#">Electrodes</a></div>
                            </div>
                            <div class="post__share-links share-links">
                                <ul class="share-links__list">
                                    <li class="share-links__item share-links__item--type--like"><a href="#">Like</a></li>
                                    <li class="share-links__item share-links__item--type--tweet"><a href="#">Tweet</a></li>
                                    <li class="share-links__item share-links__item--type--pin"><a href="#">Pin It</a></li>
                                    <li class="share-links__item share-links__item--type--counter"><a href="#">4K</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="post-author">
                            <div class="post-author__avatar">
                                <a href="#"><img src="/public/site_assets/images/avatars/avatar-1.jpg" alt=""></a>
                            </div>
                            <div class="post-author__info">
                                <div class="post-author__name"><a href="#">Jessica Moore</a></div>
                                <div class="post-author__about">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit suscipit mi, non tempor nulla finibus eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    --}}

                    {{--
                    <section class="post__section">
                        <h4 class="post__section-title">Related Posts</h4>
                        <div class="related-posts">
                            <div class="related-posts__list">
                                <div class="related-posts__item post-card post-card--layout--related">
                                    <div class="post-card__image">
                                        <a href="#"><img src="/public/site_assets/images/posts/post-1.jpg" alt=""></a>
                                    </div>
                                    <div class="post-card__info">
                                        <div class="post-card__name"><a href="#">Philosophy That Addresses Topics Such As Goodness</a></div>
                                        <div class="post-card__date">October 19, 2019</div>
                                    </div>
                                </div>
                                <div class="related-posts__item post-card post-card--layout--related">
                                    <div class="post-card__image">
                                        <a href="#"><img src="/public/site_assets/images/posts/post-2.jpg" alt=""></a>
                                    </div>
                                    <div class="post-card__info">
                                        <div class="post-card__name"><a href="#">Logic Is The Study Of Reasoning And Argument Part 2</a></div>
                                        <div class="post-card__date">September 5, 2019</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    --}}

                    {{--
                    <section class="post__section">
                        <h4 class="post__section-title">Comments (4)</h4>
                        <ol class="comments-list comments-list--level--0">
                            <li class="comments-list__item">
                                <div class="comment">
                                    <div class="comment__avatar">
                                        <a href="#"><img src="/public/site_assets/images/avatars/avatar-1.jpg" alt=""></a>
                                    </div>
                                    <div class="comment__content">
                                        <div class="comment__header">
                                            <div class="comment__author"><a href="#">Jessica Moore</a></div>
                                            <div class="comment__reply">
                                                <button type="button" class="btn btn-xs btn-light">Reply</button>
                                            </div>
                                        </div>
                                        <div class="comment__text">Aliquam ullamcorper elementum sagittis. Etiam lacus lacus, mollis in mattis in, vehicula eu nulla. Nulla nec tellus pellentesque.</div>
                                        <div class="comment__date">November 30, 2018</div>
                                    </div>
                                </div>
                                <div class="comment-list__children">
                                    <ol class="comments-list comments-list--level--1">
                                        <li class="comments-list__item">
                                            <div class="comment">
                                                <div class="comment__avatar">
                                                    <a href="#"><img src="/public/site_assets/images/avatars/avatar-2.jpg" alt=""></a>
                                                </div>
                                                <div class="comment__content">
                                                    <div class="comment__header">
                                                        <div class="comment__author"><a href="#">Adam Taylor</a></div>
                                                        <div class="comment__reply">
                                                            <button type="button" class="btn btn-xs btn-light">Reply</button>
                                                        </div>
                                                    </div>
                                                    <div class="comment__text">Ut vitae finibus nisl, suscipit porttitor urna. Integer efficitur efficitur velit non pulvinar. Aliquam blandit volutpat arcu vel tristique. Integer commodo ligula id augue tincidunt faucibus.</div>
                                                    <div class="comment__date">December 4, 2018</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="comments-list__item">
                                            <div class="comment">
                                                <div class="comment__avatar">
                                                    <a href="#"><img src="/public/site_assets/images/avatars/avatar-3.jpg" alt=""></a>
                                                </div>
                                                <div class="comment__content">
                                                    <div class="comment__header">
                                                        <div class="comment__author"><a href="#">Helena Garcia</a></div>
                                                        <div class="comment__reply">
                                                            <button type="button" class="btn btn-xs btn-light">Reply</button>
                                                        </div>
                                                    </div>
                                                    <div class="comment__text">Suspendisse dignissim luctus metus vitae aliquam. Vestibulum sem odio, ullamcorper a imperdiet a, tincidunt sed lacus. Sed magna felis, consequat a erat ut, rutrum finibus odio.</div>
                                                    <div class="comment__date">December 12, 2018</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li class="comments-list__item">
                                <div class="comment">
                                    <div class="comment__avatar">
                                        <a href="#"><img src="/public/site_assets/images/avatars/avatar-4.jpg" alt=""></a>
                                    </div>
                                    <div class="comment__content">
                                        <div class="comment__header">
                                            <div class="comment__author"><a href="#">Ryan Ford</a></div>
                                            <div class="comment__reply">
                                                <button type="button" class="btn btn-xs btn-light">Reply</button>
                                            </div>
                                        </div>
                                        <div class="comment__text">Nullam at varius sapien. Sed sit amet condimentum elit.</div>
                                        <div class="comment__date">December 5, 2018</div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </section>
                    --}}

                    {{--
                    <section class="post__section">
                        <h4 class="post__section-title">Write A Comment</h4>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="comment-first-name">First Name</label>
                                    <input type="text" class="form-control" id="comment-first-name" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="comment-last-name">Last Name</label>
                                    <input type="text" class="form-control" id="comment-last-name" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="comment-email">Email Address</label>
                                    <input type="email" class="form-control" id="comment-email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment-content">Comment</label>
                                <textarea class="form-control" id="comment-content" rows="6"></textarea>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Post Comment</button>
                            </div>
                        </form>
                    </section>
                    --}}

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

                    <div class="block-sidebar__item">
                        <div class="widget-posts widget">
                            <h4 class="widget__title">Другие советы</h4>
                            <div class="widget-posts__list">
                                @foreach($otherAdvices as $item)
                                    <div class="widget-posts__item">
                                        <div class="widget-posts__image">
                                            <a href="{{ url('/advices/' . $item->slug) }}">
                                                @if(!empty($item->image))
                                                    <img src="/public/uploads/advices/{{ $item->image }}" alt="{{ $item->title }}">
                                                @else
                                                    <img src="/public/uploads/no-thumb.png" alt="no image">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="widget-posts__info">
                                            <div class="widget-posts__name">
                                                <a href="{{ url('/advices/' . $item->slug) }}">{{ $item->title }}</a>
                                            </div>
                                            <div class="widget-posts__date">{{ date('d.m.Y', strtotime($item->date_add)) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
