<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination justify-content-center">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link page-link--with-arrow" href="{{ $paginator->url(1) }}" aria-label="Previous">
                <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">
                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-left-8x13"></use>
                </svg>
            </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }} {!! ($paginator->currentPage() == $i) ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
            @endif
        @endfor
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link page-link--with-arrow" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Next">
                <svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">
                    <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-8x13"></use>
                </svg>
            </a>
        </li>
    </ul>
@endif
