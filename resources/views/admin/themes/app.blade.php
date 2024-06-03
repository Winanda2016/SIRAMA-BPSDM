<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>SIRAMA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo.png') }}">

    <!-- flatpickr css -->
    <link href="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">

    <!-- choices css -->
    <link href="{{ asset('admin/assets/libs/choices.js/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/%40simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/%40simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/%40simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- DataTables -->
    <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive Table css -->
    <!-- <link href="{{ asset('admin/assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" /> -->

    <!-- plugin css -->
    <link href="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div id="layout-wrapper">


        @include('admin.themes.navbar')

        @include('admin.themes.leftSidebar')

        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>

            @include('admin.themes.footer')

        </div>

    </div>

    @include('admin.themes.rightSidebar')

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <script>
        function kembali() {
            window.history.back();
        }
    </script>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- pace js -->
    <script src="{{ asset('admin/assets/libs/pace-js/pace.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admin/assets/libs/chart.js/chart.umd.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- choices js -->
    <script src="{{ asset('admin/assets/libs/choices.js/scripts/choices.min.js') }}"></script>

    <!-- color picker js -->
    <script src="{{ asset('admin/assets/libs/%40simonwep/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/%40simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- flatpickr js -->
    <script src="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('admin/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/invoices-list.init.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/form-advanced.init.js') }}"></script>
    <!-- <script src="{{ asset('admin/assets/js/pages/chartjs.init.js') }}"></script> -->
    <!-- <script src="{{ asset('admin/assets/js/pages/apexcharts.init.js') }}"></script> -->

    <!-- <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script> -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>


</body>

</html>