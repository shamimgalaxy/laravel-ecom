@extends('website.master')

@section('title', 'Order Complete | My Shop')

@section('body')
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Order Complete</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li>Complete Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body text-center py-5 shadow-sm">
                    <div class="mb-4">
                        <i class="lni lni-checkmark-circle text-success" style="font-size: 80px; display: block;"></i>
                    </div>
                    
                    <h2 class="mb-2">Thank You for Your Order!</h2>
                    
                    @if(session('message'))
                        <h5 class="text-success mb-4">{{ session('message') }}</h5>
                    @endif
                    
                    <p class="text-muted">We've received your order and are getting it ready. You'll receive an email confirmation shortly.</p>
                    
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary px-4">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection