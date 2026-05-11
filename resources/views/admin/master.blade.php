<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Fix 1: CSRF meta tag — required for all AJAX/fetch requests --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Elite Admin - Dashboard</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Fix 2: dropify 0.9.0 does not exist on cdnjs — correct version is 0.2.2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">

    <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/pages/dashboard1.css') }}" rel="stylesheet">

    @stack('styles')
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
            &copy; {{ date('Y') }} Developed by Shamim Ahmed Shuvo
        </footer>
    </div>

    {{-- 1. jQuery first — everything depends on this --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- 2. Bootstrap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    {{-- 3. Admin theme scripts --}}
    <script src="{{ asset('admin/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/waves.js') }}"></script>
    <script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>

    {{-- 4. Raphael + Morris --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    {{-- 5. jQuery Toast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    {{-- 6. Dropify — fix: correct version 0.2.2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    {{-- 7. DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    {{-- 8. Summernote --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

    {{-- 9. Pusher --}}
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    {{-- Fix 3: setup jQuery AJAX to always send CSRF token --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function () {

            if ($('.summernote').length) {
                $('.summernote').summernote({
                    height: 350,
                    focus:  false
                });
            }

            if ($('.dropify').length) {
                $('.dropify').dropify();
            }

            if ($('#myTable').length) {
                $('#myTable').DataTable({
                    responsive: true
                });
            }

            $('#categoryId').on('change', function () {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url:  "{{ route('product.get-subcategory-by-category') }}",
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function (data) {
                            $('#subCategoryId').empty();
                            $('#subCategoryId').append('<option value="" disabled selected>--- Select Sub Category ---</option>');
                            $.each(data, function (key, value) {
                                $('#subCategoryId').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function () {
                            console.error('Failed to load subcategories.');
                        }
                    });
                } else {
                    $('#subCategoryId').empty();
                    $('#subCategoryId').append('<option value="" disabled selected>--- Select Sub Category ---</option>');
                }
            });

        });
    </script>

    {{-- Page-specific scripts load AFTER all libraries are ready --}}
    @stack('scripts')

</body>
</html>