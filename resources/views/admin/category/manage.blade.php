@extends('admin.master')
@section('body')

<div class="row mt-3">
   <div class="col-12">

    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Data table example</h6>
                                <div class="table-responsive m-t-40">
                                    <p class="text-center text-success">{{ session('message') }}</p>
                                    <table id="myTable" class="table table-striped border">
                                        <thead>
                                           
                                            
                                            
                                            <tr>
                                                <th>SL No</th>
                                                <th>Category Name</th>
                                                <th>Category Description</th>
                                                <th>Category Image</th>
                                                <th>Publication Status</th>
                                                <th>Action</th>
                                            </tr>

                                           
                                        </thead>
                                        <tbody>
                                             @foreach ($categories as $category)
                                            <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->description }}</td>
    <td><img src="{{ asset($category->image) }}" alt="Category Image" width="100"></td>
    <td>{{ $category->status == 1 ? 'Published' : 'Unpublished' }}</td>
    <td>
        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-success btn-sm">
            <i class="ti-reddit"></i>
        </a>
        <a href="{{ route('category.delete', $category->id) }}" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Are you sure you want to delete this category? This cannot be undone.')">
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