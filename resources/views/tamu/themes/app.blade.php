<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="SIRAMA BPSDM">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- DataTables -->
    <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>

    @include('tamu.themes.preloder')

    @include('tamu.themes.offcanvas')

    @include('tamu.themes.header')

    @yield('content')

    @include('tamu.themes.footer')

    <script>
        function kembali() {
            window.history.back();
        }
    </script>

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
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/invoices-list.init.js') }}"></script>

</body>

</html>