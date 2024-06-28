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
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{ asset('tamu/assets/img/logo.png') }}" alt="" height="28">
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h3 class="mb-0">Selamat Datang !</h3>
                                        <p class="text-muted mt-2">Log In untuk melanjutkan ke SIRAMA.</p>
                                    </div>
                                    <form class="mt-4 pt-2" action="https://themesbrand.com/minia/layouts/index.html">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Enter username">
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Password</label>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="auth-recoverpw.html" class="text-muted">Lupa password?</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="mb-3">
                                            <a href="{{ url('/admin-dashboard') }}" class="btn btn-primary w-100 waves-effect waves-light" type="submit" style="background-color:#4c5c7e ;">Log In</a>
                                        </div>
                                    </form>
                                    <div class="mt-1 text-center">
                                        <p class="text-muted mb-0">Belum memiliki akun ? <a href="auth-register.html" class="fw-semibold" style="color:#4c5c7e ;"> Daftar disni </a> </p>
                                    </div>
                                </div>
                                <div class="mt-5 mt-md-5 text-center">
                                    <p class="mb-0">© 2024 - <script>
                                            document.write(new Date().getFullYear())
                                        </script> SIRAMA. by Winanda Afrilia Harisya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay" style="background-color:#4c5c7e ;"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- pace js -->
    <script src="{{ asset('admin/assets/libs/pace-js/pace.min.js') }}"></script>

    <!-- password addon init -->
    <script src="{{ asset('admin/assets/js/pages/pass-addon.init.js') }}"></script>

</body>

</html>