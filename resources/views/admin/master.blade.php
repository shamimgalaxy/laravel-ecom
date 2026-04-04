<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elite Admin - Dashboard</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png')}}">

    <link href="{{asset('admin/assets/node_modules/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/summernote/dist/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('admin/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/dist/css/pages/dashboard1.css')}}" rel="stylesheet">
</head>

<body class="skin-blue fixed-layout">
    
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
   
    <div id="main-wrapper">
        @include('admin.includes.header')
        @include('admin.includes.sidebar')
       
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('body')
            </div>
        </div>
        
        <footer class="footer">
            © {{ date('Y') }} Developed by Shamim Ahmed Shuvo
        </footer>
    </div>

    <script src="{{ asset('admin/assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ asset('admin/dist/js/waves.js')}}"></script>
    <script src="{{ asset('admin/dist/js/sidebarmenu.js')}}"></script>
    <script src="{{ asset('admin/dist/js/custom.min.js')}}"></script>

    <script src="{{ asset('admin/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/dropify/dist/js/dropify.min.js')}}"></script>
    
    <script src="{{ asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('admin/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // 1. Initialize Summernote
            $('.summernote').summernote({
                height: 350,
                focus: false 
            });

            // 2. Initialize Dropify
            $('.dropify').dropify();

            // 3. Initialize DataTable
            $('#myTable').DataTable();

            // 4. Dynamic Subcategory Ajax
            $('#categoryId').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: "{{ route('product.get-subcategory-by-category') }}",
                        type: "GET",
                        data: { category_id: categoryId },
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
                    $('#subCategoryId').append('<option value="" disabled selected>--- Select Sub Category ---</option>');
                }
            });
});
    </script>
</body>
</html>
</body>
</html>