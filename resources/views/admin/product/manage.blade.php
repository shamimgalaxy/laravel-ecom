@extends('admin.master')
@section('body')

<div class="row mt-3">
   <div class="col-12">

    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Product Information</h4>
                                <h6 class="card-subtitle">Data table example</h6>
                                <div class="table-responsive m-t-40">
                                    <p class="text-center text-success">{{ session('message') }}</p>
                                    <table id="myTable" class="table table-striped border">
                                        <thead>
                                           
                                            
                                            
                                            <tr>
                                                <th>SL No</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Stock Amount</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>

                                           
                                        </thead>
                                        <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product->name }}</td> 
        <td>{{ $product->code }}</td>
        <td>{{ $product->stock_amount }}</td>
        <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100"></td>
        <td>{{ $product->status == 1 ? 'Published' : 'Unpublished' }}</td>
        <td>
            <a href="{{ route('product.detail',$product->id) }}" class="btn btn-info btn-sm">
                <i class="ti-reddit"></i>
            </a>


            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-success btn-sm">
                <i class="ti-reddit"></i>
            </a>
            <a href="{{ route('product.delete', $product->id) }}" 
               class="btn btn-danger btn-sm" 
               onclick="return confirm('Are you sure?')">
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