@extends('website.master')

@section('title')

cart page

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
<li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
<li><a href="index.html">Shop</a></li>
<li>Cart</li>
</ul>
</div>
</div>
</div>
</div>


<div class="shopping-cart section">
<div class="container">
<div class="cart-list-head">

<div class="cart-list-title">
<div class="row">
<div class="col-lg-1 col-md-1 col-12">
</div>
<div class="col-lg-4 col-md-3 col-12">
<p>Product Name</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
<p>Unit Price</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
<p>Quantity</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
<p>Total</p>
</div>
<div class="col-lg-1 col-md-2 col-12">
<p>Remove</p>
</div>
</div>
</div>
@php($total=0)
@foreach ($cart_items as $item)

<div class="cart-single-list">
<div class="row align-items-center">
<div class="col-lg-1 col-md-1 col-12">
<a href="{{ route('product-detail', $item->id) }}"><img src="{{ asset($item->image) }}" alt="#"></a> 
</div>
<div class="col-lg-4 col-md-3 col-12">
<h5 class="product-name"><a href="{{ route('product-detail', $item->id) }}">
{{$item->name}}</a></h5>
<p class="product-des">
<span><em>Category:</em> {{ $item->type }}</span>
<span><em> Brand:</em>  {{$item->brand }} </span> 
</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
<div class="">
{{ $item->price }}
</div>
</div>
<div class="col-lg-2 col-md-2 col-12">
    <form action="{{ route('update-cart-item', ['id' => $item->__raw_id]) }}" method="POST">
        @csrf

        <div class="input-group">
            <input type="number" value="{{ $item->qty }}" class="form-control" name="qty" min="1" required>
            <input type="submit" class="btn btn-success" value="update">
        </div>
    </form>
</div>
<div class="col-lg-2 col-md-2 col-12">
<p>${{ $item->price * $item->qty }}</p>
</div>
<div class="col-lg-1 col-md-2 col-12">
<a class="remove-item" onclick="return confirm('Are you sure you want to remove this item from the cart?');" href="{{ route('remove-cart-item',['id'=>$item->__raw_id]) }}"> <i class="lni lni-close"></i></a>
</div>
</div>
</div>

@php($total=$total+($item->price * $item->qty))

@endforeach




</div>
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
<ul>
<li>Cart Subtotal<span>${{$total}}</span></li>
<li>Tax(15%)<span>{{ $tax=($total*15)/100 }}</span></li>
<li>Shipping<span>{{ $shipping=100 }}</span></li>
<li class="last">You Pay<span>${{ $orderTotal=$total+$tax+$shipping }}</span></li>
</ul>
<div class="button">
<a href="{{route('checkout')}}" class="btn">Checkout</a>
<a href="{{ '/' }}" class="btn btn-alt">Continue shopping</a>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

@endsection