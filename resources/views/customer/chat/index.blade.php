@extends('website.master')



@section('title', )
customer dashboard

@section('body')
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Dashboard</h1>
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
            <div class="col-md-3">
                            <div class="list-group">
  
                            <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                            <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action">Profile</a>
                            <a href="{{ route('customer.order') }}" class="list-group-item list-group-item-action">Order</a>
                            <a href="#" class="list-group-item list-group-item-action">Account</a>
                            <a href="#" class="list-group-item list-group-item-action">Change Password</a>
                            <a href="#" class="list-group-item list-group-item-action">Logout</a>
                             <a href="{{ route('customer.chat-support') }}" class="list-group-item list-group-item-action">Chat Support</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
                            </div>
             

            </div>

<div class="col-md-9">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0"><i class="lni lni-comments"></i> Chat with Admin</h5>
        </div>
        <div class="card-body p-0 d-flex flex-column" style="height: 50vh; background: #f9f9f9;">
            <div id="chatWindow" class="flex-grow-1 p-3" style="overflow-y:auto;">
                @if(isset($messages))
                    @foreach($messages as $msg)
                        <div class="mb-3 {{ $msg->from_id == Session::get('customer_id') ? 'text-end' : 'text-start' }}">
                            <div class="d-inline-block p-2 px-3 rounded shadow-sm {{ $msg->from_id == Session::get('customer_id') ? 'bg-primary text-white' : 'bg-white text-dark' }}" style="max-width: 80%;">
                                {{ $msg->message }}
                            </div>
                            <div class="small text-muted mt-1" style="font-size: 0.7rem;">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="border-top p-3 bg-white">
                <form id="chatForm" class="d-flex">
                    <input type="text" id="messageInput" class="form-control me-2" placeholder="Type a message..." autocomplete="off">
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>    
        </div>
    </div>
</section>
@endsection


