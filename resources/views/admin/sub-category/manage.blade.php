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
        <th> Category</th> <th>Sub Category Name</th>
        <th>Sub Category Description</th>
        <th>Sub Category Image</th>
        <th>Publication Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($sub_categories as $sub_category)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $sub_category->category->name ?? 'No Parent' }}</td> 
        <td>{{ $sub_category->name }}</td>
        <td>{{ Str::limit($sub_category->description, 50) }}</td>
        <td>
            <img src="{{ asset($sub_category->image) }}" alt="" style="height: 50px; width: 50px;">
        </td>
        <td>{{ $sub_category->status == 1 ? 'Published' : 'Unpublished' }}</td>
        <td>
            <a href="{{ route('sub-category.edit', ['id' => $sub_category->id]) }}" class="btn btn-success btn-sm">Edit</a>
            <a href="{{ route('sub-category.delete', ['id' => $sub_category->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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