@extends('admin.master')
@section('body')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Product Form</h4>
                <hr/>

                <h4 class="text-center text-success">{{ session('message') }}</h4>
                
                {{-- Added action, method, and enctype for image uploads --}}
                <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-20">
                  @csrf 

                                <div class="form-group row">
                        <label class="col-sm-3 control-label">Select Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category_id" class="form-control" id="categoryId" required>
                                <option value="" disabled selected>--- Select Category ---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="form-group row">
                    <label class="col-sm-3 control-label">Select Sub Category<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="sub_category_id" class="form-control" id="subCategoryId" required>
                            <option value="" disabled selected>--- Select Sub Category ---</option>
                            @foreach($sub_categories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                    <div class="form-group row">
                  <label class="col-sm-3 control-label">Select Brand Category<span class="text-danger">*</span></label>
                 <div class="col-sm-9">
                    <select name="brand_id" class="form-control" required>
                        <option value="" disabled selected>--- Select Brand ---</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                  </div>
                 </div>

                        <div class="form-group row">
                    <label class="col-sm-3 control-label">Select Unit Category<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="unit_id" class="form-control" required>
                            <option value="" disabled selected>--- Select Unit ---</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 </div>


                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Product Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="" placeholder="Product Name" required>
                            </div>
                        </div>
                    </div>

                   

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Product Code<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                                <input type="text" name="code" value="{{ $product->code }}" class="form-control" id="" placeholder="Product Code" required>
                            </div>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label"> Product Model</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="model" value="{{ $product->model }}" class="form-control" id="" placeholder="Product Model" required>{{ $product->model }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Product Stock Amount</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                                <input type="text" name="stock_amount" value="{{ $product->stock_amount }}" class="form-control" id="" placeholder="Product Stock Amount" required>
                            </div>
                        </div>
                    </div>

                    

                                <div class="form-group row">
                                <label for="" class="col-sm-3 control-label">Product Price <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <div class="input-group">

                                <input type="number" value="{{ $product->regular_price }}" class="form-control" name="regular_price" id="" placeholder="Regular Price"/>
                                <input type="number" value="{{ $product->selling_price }}" class="form-control" name="selling_price" id="" placeholder="Selling Price"/>


                                </div>
                                </div>
                                </div>

                     <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Short Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="short_description" value="{{ $product->short_description }}" class="form-control" id="exampleInputuname3" placeholder="Product Short Description" required>{{ $product->short_description }}</textarea> 
                            </div>
                        </div>
                     </div>

                      <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Long Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="long_description" value="{{ $product->long_description }}" class="form-control summernote" id="exampleInputuname3" placeholder="Product Long Description" required>{{ $product->long_description }}</textarea>
                            </div>
                        </div>
                     </div>


                    <div class="form-group row">
                        <label class="form-label col-sm-3 control-label" for="web"> Feature Image</label>
                        <div class="col-sm-9">
                            {{-- Added name="image" so you can catch it in the Controller --}}
                            <input type="file" name="image" id="input-file-now" class="dropify" />
                            <img src="{{ asset($product->image) }}" alt="Feature Image" width="130" height="100" class="mt-2">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label class="form-label col-sm-3 control-label" for="web"> Other Image</label>
                        <div class="col-sm-9">
                            {{-- Added name="image" so you can catch it in the Controller --}}
                            <input type="file" name="other_image[]" multiple id="input-file-now" class="dropify" accept="image/*" />
                            <div class="mt-2">
                                @foreach($product->other_images as $otherImage)  
                                    <img src="{{ asset($otherImage->image) }}" alt="Other Image" width="100" class="me-2 mb-2">
                                @endforeach
                        </div>
                     </div>


                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-3 control-label">Publication Status</label>
                        <div class="col-sm-9">
                            <label class="me-3"><input type="radio" {{ $product->status == 1 ? 'checked' : '' }} name="status" value="1" checked> Published </label>
                            <label><input type="radio" {{ $product->status == 2 ? 'checked' : '' }} name="status" value="2"> Unpublished </label>
                        </div>
                    </div>

                    <div class="form-group row m-b-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white"> Update Product </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoryId').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId, // You need to create this route
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subCategoryId').empty();
                        $('#subCategoryId').append('<option value="" disabled selected>--- Select Sub Category ---</option>');
                        $.each(data, function(key, value) {
                            $('#subCategoryId').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subCategoryId').empty();
            }
        });
    });
</script>

@endsection