@extends('website.master')

@section('title')
Cart Page
@endsection

@section('body')

<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Cart</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="{{ route('home') }}">Shop</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="shopping-cart section">
    <div class="container">

        @if(empty($cart_items))
            <div class="alert alert-info text-center my-5">
                Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
            </div>
        @else

        <div class="cart-list-head">
            <div class="cart-list-title">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-12"></div>
                    <div class="col-lg-4 col-md-3 col-12"><p>Product Name</p></div>
                    <div class="col-lg-2 col-md-2 col-12"><p>Unit Price</p></div>
                    <div class="col-lg-2 col-md-2 col-12"><p>Quantity</p></div>
                    <div class="col-lg-2 col-md-2 col-12"><p>Total</p></div>
                    <div class="col-lg-1 col-md-2 col-12"><p>Remove</p></div>
                </div>
            </div>

            @php $subtotal = 0; @endphp

            @foreach ($cart_items as $productId => $item)
            <div class="cart-single-list">
                <div class="row align-items-center">

                    {{-- Thumbnail --}}
                    <div class="col-lg-1 col-md-1 col-12">
                        <a href="{{ route('product-detail', $productId) }}">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                        </a>
                    </div>

                    {{-- Name --}}
                    <div class="col-lg-4 col-md-3 col-12">
                        <h5 class="product-name">
                            <a href="{{ route('product-detail', $productId) }}">{{ $item['name'] }}</a>
                        </h5>
                    </div>

                    {{-- Unit price --}}
                    <div class="col-lg-2 col-md-2 col-12">
                        <div>৳{{ $item['price'] }}</div>
                    </div>

                    {{-- Quantity update form --}}
                    <div class="col-lg-2 col-md-2 col-12">
                        <form action="{{ route('update-cart-item', ['id' => $productId]) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="number"
                                       value="{{ $item['quantity'] }}"
                                       class="form-control"
                                       name="qty"
                                       min="1"
                                       required>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    {{-- Line total --}}
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>৳{{ $item['price'] * $item['quantity'] }}</p>
                    </div>

                    {{-- Remove --}}
                    <div class="col-lg-1 col-md-2 col-12">
                        <a class="remove-item"
                           onclick="return confirm('Remove this item from cart?');"
                           href="{{ route('remove-cart-item', ['id' => $productId]) }}">
                            <i class="lni lni-close"></i>
                        </a>
                    </div>

                </div>
            </div>

            @php $subtotal += $item['price'] * $item['quantity']; @endphp
            @endforeach

        </div>{{-- /.cart-list-head --}}

        <div class="row">
            <div class="col-12">
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <div class="button">
                                            <button class="btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="right">
                                @php
                                    $tax        = ($subtotal * 15) / 100;
                                    $shipping   = 100;
                                    $orderTotal = $subtotal + $tax + $shipping;
                                @endphp
                                <ul>
                                    <li>Cart Subtotal <span>৳{{ number_format($subtotal, 2) }}</span></li>
                                    <li>Tax (15%)     <span>৳{{ number_format($tax, 2) }}</span></li>
                                    <li>Shipping      <span>৳{{ number_format($shipping, 2) }}</span></li>
                                    <li class="last">You Pay <span>৳{{ number_format($orderTotal, 2) }}</span></li>
                                </ul>
                                <div class="button">
                                    <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                    <a href="{{ route('home') }}" class="btn btn-alt">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </div>
</div>

@endsection