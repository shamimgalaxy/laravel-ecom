@extends('admin.master')
@section('body')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Product Category Form</h4>
                <hr/>

                <h4 class="text-center text-success">{{ session('message') }}</h4>
                
                {{-- Added action, method, and enctype for image uploads --}}
                <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-20">
                      @csrf 

                                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Select Category</label>
                                <div class="col-sm-9">

                                        <select name="category_id" class="form-control" required id="categoryId">
                                <option value="" disabled selected>--- Select Category ---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            </div>
                            </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Select Sub Category</label>
                                    <div class="col-sm-9">

                                <select name="sub_category_id" class="form-control" required>
                                    <option value="" disabled selected>--- Select Sub Category ---</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                    @endforeach
                                </select>

                                </div>
                                </div>

  

                                    <div class="form-group row">
                                    <label class="col-sm-3 control-label">Select Brand</label>
                                    <div class="col-sm-9">

                                <select name="brand_id" class="form-control" required>
                                    <option value="" disabled selected>--- Select Brand ---</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>

                                </div>
                                </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">Select Unit</label>
                                            <div class="col-sm-9">

                                        <select name="unit_id" class="form-control" required>
                                            <option value="" disabled selected>--- Select Unit ---</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>

                                        </div>
                                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="" placeholder="Product Name"/>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="" class="col-sm-3 control-label">Product Code <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="product_code" id="" placeholder="Product Code"/>
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Model <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="product_model" id="" placeholder="Product Model"/>
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Stock Amount <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stock_amount" id="" placeholder="Product Stock Amount"/>
                                </div>
                                </div>

                                <div class="form-group row">
                                <label for="" class="col-sm-3 control-label">Product Price <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <div class="input-group">

                                <input type="number" class="form-control" name="regular_price" id="" placeholder="Regular Price"/>
                                <input type="number" class="form-control" name="selling_price" id="" placeholder="Selling Price"/>


                                </div>
                                </div>
                                </div>



  

                     <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Short Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="short_description" class="form-control" id="exampleInputuname3" placeholder="Product Short Description" required></textarea>
                            </div>
                        </div>
                     </div>

                      <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Long Description</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                
                                <textarea type="text" name="long_description" class="form-control summernote" id="exampleInputuname3" placeholder="Product Long Description" required></textarea>
                            </div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label class="form-label col-sm-3 control-label" for="web">Feauture Image</label>
                        <div class="col-sm-9">
                            {{-- Added name="image" so you can catch it in the Controller --}}
                            <input type="file" name="image" id="input-file-now" class="dropify" />
                        </div>
                    </div>

                     <div class="form-group row">
                        <label class="form-label col-sm-3 control-label" for="web">Other Image</label>
                        <div class="col-sm-9">
                            {{-- Added name="image" so you can catch it in the Controller --}}
                            <input type="file" name="other_image[]" multiple id="input-file-now" class="dropify" accept="image/*" />
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
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">Create New Product</button>
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