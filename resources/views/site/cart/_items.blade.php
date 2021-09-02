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
