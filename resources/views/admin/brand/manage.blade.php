@extends('admin.master')
@section('body')

<div class="row mt-3">
   <div class="col-12">

    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Brand Data table </h6>
                                <div class="table-responsive m-t-40">
                                    <p class="text-center text-success">{{ session('message') }}</p>
                                    <table id="myTable" class="table table-striped border">
                                        <thead>
                                           
                                            
                                            
                                            <tr>
                                                <th>SL No</th>
                                                <th>Brand Name</th>
                                                <th>Brand Description</th>
                                                <th>Brand Image</th>
                                                <th>Publication Status</th>
                                                <th>Action</th>
                                            </tr>

                                           
                                        </thead>
                                        <tbody>
                                            @foreach($brands as $brand)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $brand->name }}</td>
    <td>{{ $brand->description }}</td>
    <td>
        <img src="{{ asset($brand->image) }}" alt="" style="height: 50px; width: 50px;">
    </td>
    <td>{{ $brand->status == 1 ? 'Published' : 'Unpublished' }}</td>
    <td>
        <a href="{{ route('brand.edit', ['id' => $brand->id]) }}" class="btn btn-success btn-sm">Edit</a>
        <a href="{{ route('brand.delete', ['id' => $brand->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this brand?')">Delete</a>
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