@extends('website.master')
@section('title')

this is the body

@endsection

@section('body')

<div class="breadcrumbs">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6 col-md-6 col-12">
<div class="breadcrumbs-content">
<h1 class="page-title">checkout</h1>
</div>
</div>
<div class="col-lg-6 col-md-6 col-12">
<ul class="breadcrumb-nav">
<li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
<li><a href="index.html">Shop</a></li>
<li>checkout</li>
</ul>
</div>
</div>
</div>
</div>

<section class="checkout-wrapper section">
<div class="container">
<div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="checkout-steps-form-style-1">
            <ul class="nav nav-pills">
                <li><a href="" class="nav-link active" data-bs-target="#cash" data-bs-toggle="pill">Cash On Delivery</a></li>
                <li><a href="" class="nav-link" data-bs-target="#online" data-bs-toggle="pill">Online Payment</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="cash">
  
<form action="{{ route('new-cash-order') }}" method="POST" id="cashOrderForm">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="single-form form-default">
                <label>User Full Name</label>
                <div class="form-input form">
                    <input type="text" name="name" value="{{ $customer->name ?? old('name') }}" {{ isset($customer->id) ? 'readonly' : '' }} placeholder="Full Name" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="single-form form-default">
                <label>Email Address</label>
                <div class="form-input form">
                    <input type="email" name="email" value="{{ $customer->email ?? old('email') }}" {{ isset($customer->id) ? 'readonly' : '' }} placeholder="Email Address" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="single-form form-default">
                <label>Phone Number</label>
                <div class="form-input form">
                    <input type="tel" name="mobile" value="{{ $customer->mobile ?? old('mobile') }}" {{ isset($customer->id) ? 'readonly' : '' }} placeholder="Phone Number" required>
                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="single-form form-default">
                <label>Delivery Address</label>
                <div class="form-input form">
                    <textarea name="delivery_address" placeholder="Delivery Address" rows="4" style="height: 100px; width: 100%; padding: 10px;" required>{{ old('delivery_address') }}</textarea>
                    @error('delivery_address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="single-form form-default">
                <label>Payment Type</label>
                <div>
                    <label>
                        <input type="radio" name="payment_type" value="1" checked> Cash On Delivery
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="single-checkbox checkbox-style-3">
                <input type="checkbox" id="checkbox-3" name="terms" required>
                <label for="checkbox-3"><span></span> I accept all the terms & conditions</label>
            </div>
        </div>

        <div class="col-md-12">
            <div class="single-form button">
                <button type="submit" class="btn">Confirm Order</button>
            </div>
        </div>
    </div>
</form>


</div>
<div class="tap-pane fade" id="online">
   
            <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required>
                        <div class="invalid-feedback">
                            Valid customer name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+88</span>
                        </div>
                        <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Mobile"
                               required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your Mobile number is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Mandatory)</span></label>
                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="you@example.com"  required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="delivery_address" id="address" placeholder="Delivery Address"
                            required> 
                           </textarea>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100 form-control" id="country" required>
                            <option value="">Choose...</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100 form-control" id="state" required>
                            <option value="">Choose...</option>
                            <option value="Dhaka">Dhaka</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
    <div class="single-form form-default">
        <label>Payment Type</label>
        <div class="">
            <label><input type="radio" name="payment_type" value="2"> Online </label>
        </div>
    </div>
</div>

<div class="col-md-12">
<div class="single-checkbox checkbox-style-3">
<input type="checkbox" id="checkbox-33" >
<label for="checkbox-33"><span></span></label>
<p>I accepy all the terms & condition</p>
</div>
</div>
                
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout </button>
            </form>
</div>
</div>


</div>
</div>

<div class="col-lg-4">
<div class="checkout-sidebar">
<div class="checkout-sidebar-coupon">
<p>Appy Coupon to get discount!</p>
<form action="#">
<div class="single-form form-default">
<div class="form-input form">
<input type="text" placeholder="Coupon Code">
</div>
<div class="button">
<button class="btn">apply</button>
</div>
</div>
</form>
</div>


<div class="checkout-sidebar-price-table">
    <h5 class="title">Your Cart</h5>
    
    <div class="sub-total-price">
        @php $subtotal = 0; @endphp 
        
        {{-- 1. Loop only through items to get the base price --}}
        @foreach(ShoppingCart::all() as $item)
            @php $subtotal += ($item->price * $item->qty); @endphp 
            
            <div class="total-price">
                <p class="value">
                    {{ $item->name }} x {{ $item->qty }}
                </p>
                <p class="price">${{ number_format($item->price * $item->qty, 2) }}</p>
            </div>
        @endforeach
    </div>

    <hr> {{-- Visual separator --}}

    {{-- 2. Calculate Totals once after the loop --}}
    @php 
        $tax = ($subtotal * 15) / 100;
        $shipping = 100;
        $orderTotal = $subtotal + $tax + $shipping;
    @endphp

    <div class="price-calculations">
        <div class="total-tax d-flex justify-content-between">
            <p class="value">Tax Amount (15%):</p>
            <p class="price">${{ number_format($tax, 2) }}</p>
        </div>
        <div class="total-shipping d-flex justify-content-between">
            <p class="value">Shipping Amount:</p>
            <p class="price">$100.00</p>
        </div>
    </div>

    <div class="total-payable">
        <div class="payable-price">
            <p class="value"><strong>Total Payable:</strong></p>
            <p class="price"><strong>${{ number_format($orderTotal, 2) }}</strong></p>
        </div>

   @php
    session([
        'order_total'    => $orderTotal,
        'tax_total'      => $tax,
        'shipping_total' => $shipping
    ]);
    @endphp
            
       
    </div>
  <div class="price-table-btn button">
        <a href="javascript:void(0)" class="btn"> Checkout </a>
    </div>
</div>


<div class="checkout-sidebar-banner mt-30">
<a href="product-grids.html">
<img src="{{ asset('website/assets/images/banner/banner.jpg')}}" alt="#">
</a>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection