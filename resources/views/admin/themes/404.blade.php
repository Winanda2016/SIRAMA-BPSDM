<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/pages-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Apr 2023 04:23:43 GMT -->

<head>

    <meta charset="utf-8" />
    <title>SIRAMA</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo.png') }}">

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

    <!-- <body data-layout="horizontal"> -->

    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-1 fw-semibold">4<span class="text-primary mx-2">0</span>4</h1>
                        <h4 class="text-uppercase">Maaf, Halaman tidak ditemukan!</h4>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="
                               @if(Auth::check())
                                    @if(Auth::user()->hasRole('admin'))
                                        {{ route('admin-dashboard') }}
                                    @elseif(Auth::user()->hasRole('pegawai'))
                                        {{ route('dashboard_pegawai') }}
                                    @else
                                        {{ route('Tdashboard') }}
                                    @endif
                                @else
                                    {{ route('Tdashboard') }}
                                @endif">
                                Kembali Ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    <div>
                        <img src="{{ asset('admin/assets/images/error-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('admin/assets/libs/pace-js/pace.min.js') }}"></script>

</body>

<!-- Mirrored from themesbrand.com/minia/layouts/pages-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Apr 2023 04:23:44 GMT -->

</html>