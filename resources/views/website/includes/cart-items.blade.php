@forelse ($cart ?? [] as $id => $item)
    <li class="lx-cart-item" id="cart-row-{{ $id }}">
        <div class="lx-cart-item-img">
            <a href="{{ route('product-detail', ['id' => $item['id']]) }}">
                <img src="{{ asset($item['image'] ?? '') }}" alt="{{ $item['name'] }}">
            </a>
        </div>
        <div class="lx-cart-item-body">
            <div class="lx-cart-item-cat">Product</div>
            <h4><a href="{{ route('product-detail', ['id' => $item['id']]) }}">{{ $item['name'] }}</a></h4>
            <div class="lx-cart-item-meta">
                {{ $item['quantity'] }} × <span>৳{{ number_format($item['price'], 2) }}</span>
            </div>
            <div class="lx-cart-item-meta" style="color: var(--gold-dark); font-weight: 600; margin-top: 3px;">
                Total: <span>৳{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </div>
        </div>
        <button class="lx-cart-remove"
                data-remove-url="{{ route('remove-cart-item', $id) }}"
                data-row-id="{{ $id }}"
                title="Remove">
            <i class="lni lni-close"></i>
        </button>
    </li>
@empty
    <li id="cart-empty-msg" class="lx-cart-empty-msg">
        <i class="lni lni-cart"></i>
        Your cart is empty
    </li>
@endforelse