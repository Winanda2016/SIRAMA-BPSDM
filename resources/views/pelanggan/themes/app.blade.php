<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Travela - Tourism Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('pelanggan/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('pelanggan/assets/lib/lightbox/css/lightbox.min.css') }}"" rel=" stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('pelanggan/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('pelanggan/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    @include('pelanggan.themes.spinner')

    @include('pelanggan.themes.topbar')

    @include('pelanggan.themes.navbar')

    @yield('content')

    @include('pelanggan.themes.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('pelanggan/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/lib/lightbox/js/lightbox.min.js') }}"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('pelanggan/assets/js/main.js') }}"></script>
</body>

</html>