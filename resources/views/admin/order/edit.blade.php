@extends('admin.master')
@section('body')

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Information</h4>
                <hr>

                {{-- Alert Messages --}}
                @if (Session::has('noti'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('noti') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('msg') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('update-order', $order->id) }}" method="post">
                    @csrf
                <div class="row mb-3">
                    <label class="col-md-3">Order ID</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" readonly value="{{$order->id}}"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3">Order Total</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" readonly value="{{$order->order_total}}"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3">Order Status</label>
                    <div class="col-md-9">
                      <select name="order_status" class="form-control">
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ $order->order_status == 'canceled' ? 'selected' : '' }}>Cancel</option>
                    </select>
                    </div>
                </div>
                 <div class="row mb-3">
                <label class="col-md-3">Delivery Address</label>
                <div class="col-md-9">
                    <textarea name="delivery_address" class="form-control">{{ $order->delivery_address }}</textarea>
                </div>
            </div>
                 <div class="row mb-3">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <input type="submit" class="btn btn-success w-100" value="Update Order"/>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection