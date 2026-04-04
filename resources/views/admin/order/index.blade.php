@extends('admin.master')
@section('body')

<div class="row mt-3">
   <div class="col-12">

    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Product Information</h4>
                                
                                <div class="table-responsive m-t-40">
                                    <p class="text-center text-success">{{ session('message') }}</p>
                                    <table id="myTable" class="table table-striped border">
                                        <thead>
                                           
                                            
                                            
                                            <tr>
                                                <th>SL No</th>
                                                <th>Order Number</th>
                                                <th>Order Date</th>
                                                <th>Customer Info</th>
                                                <th>Order Total</th>
                                                <th>Order Status</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>

                                           
                                        </thead>
                                        <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->customer->name . ' (' . $order->customer->mobile . ')' }}</td>
                                            <td>{{ $order->order_total }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>
                                            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-info btn-sm" title="View Order Detail">
                                                <i class="ti-book"></i>
                                            </a>

                                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-success btn-sm" title="Order Edit">
                                                <i class="ti-reddit"></i>
                                            </a>

                                            <a href="{{ route('admin.order-invoice', $order->id) }}" class="btn btn-primary btn-sm" title="View Order Invoice">
                                                <i class="ti-infinite"></i>
                                            </a>

                                            <a href="{{ route('admin.print-invoice', $order->id) }}" class="btn btn-warning btn-sm" title="Print Order Invoice">
                                                <i class="ti-dropbox"></i>
                                            </a>

                                            <a href="{{ route('admin.order-delete', $order->id) }}" 
                                            class="btn btn-danger btn-sm" 
                                            title="Delete Order"
                                            onclick="return confirm('Are you sure you want to delete this order? This cannot be undone.')">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                        </tr>

                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        </div>
                        </div>

@endsection