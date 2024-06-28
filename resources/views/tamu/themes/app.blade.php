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
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('tamu/assets/css/style.css') }}" type="text/css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>

    @include('tamu.themes.preloder')

    @include('tamu.themes.offcanvas')

    @include('tamu.themes.header')

    @yield('content')

    @include('tamu.themes.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('tamu/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('tamu/assets/js/main.js') }}"></script>

    <!-- Tambahan dari Admin -->
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>