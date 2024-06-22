<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIRAMA | BPSDM</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pelanggan/assets/css/style.css') }}" type="text/css">
</head>

<body>

    @include('pelanggan.themes.preloder')

    @include('pelanggan.themes.offcanvas')

    @include('pelanggan.themes.header')

    @yield('content')
    
    @include('pelanggan.themes.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('pelanggan/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('pelanggan/assets/js/main.js') }}"></script>
</body>

</html>