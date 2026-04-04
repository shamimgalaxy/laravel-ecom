@extends('admin.master')
@section('body')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Sub Category Form</h4>
                <hr/>

                <h4 class="text-center text-success">{{ session('message') }}</h4>
                
                {{-- Added action, method, and enctype for image uploads --}}
                <form action="{{ route('sub-category.create') }}" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-20">
               @csrf 

               <div class="form-group row">
    <label class="col-sm-3 control-label">Select Category</label>
    <div class="col-sm-9">
        <select name="category_id" class="form-control" required>
            <option value="" disabled selected>--- Select Category ---</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Sub Category Name</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                                <input type="text" name="name" class="form-control" id="" placeholder="Sub Category Name" required>
                            </div>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label"> Sub Category Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="description" class="form-control" id="exampleInputuname3" placeholder="Sub Category Description" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 control-label" for="web"> Sub Category Image</label>
                        <div class="col-sm-9">
                            {{-- Added name="image" so you can catch it in the Controller --}}
                            <input type="file" name="image" id="input-file-now" class="dropify" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-3 control-label">Publication Status</label>
                        <div class="col-sm-9">
                            <label class="me-3"><input type="radio" name="status" value="1" checked> Published </label>
                            <label><input type="radio" name="status" value="2"> Unpublished </label>
                        </div>
                    </div>

                    <div class="form-group row m-b-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">Create New Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection