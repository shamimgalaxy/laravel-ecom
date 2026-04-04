@extends('admin.master')
@section('body')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Unit Form</h4>
                <hr/>

                <h4 class="text-center text-success">{{ session('message') }}</h4>
                
                {{-- Added action, method, and enctype for image uploads --}}
                <form action="{{ route('unit.update', $unit->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-20">

    @csrf
    
                
                   {{-- Essential for security --}}

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Unit Name</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                                <input type="text" name="name" value="{{ $unit->name }}" class="form-control" id="exampleInputuname3" placeholder="Unit Name" required>
                            </div>
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Unit Code</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <input type="text" name="code" value="{{ $unit->code }}" class="form-control" id="" placeholder="Unit Code" required>
                            </div>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Unit Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="description" class="form-control" id="exampleInputuname3" placeholder="Unit Description" required>{{ $unit->description }}</textarea>
                            </div>
                        </div>
                    </div>

                  

                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-3 control-label">Publication Status</label>
                        <div class="col-sm-9">
                            <label class="me-3"><input type="radio" name="status" value="1" {{ $unit->status == 1 ? 'checked' : '' }}> Published </label>
                            <label><input type="radio" name="status" value="2" {{ $unit->status == 2 ? 'checked' : '' }}> Unpublished </label>
                        </div>
                    </div>

                    <div class="form-group row m-b-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">Edit Unit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection