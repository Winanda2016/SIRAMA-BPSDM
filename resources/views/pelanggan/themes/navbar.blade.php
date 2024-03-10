<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-and p-0">
            <!-- <h1 class="m-0">
                <img src="{{ asset('admin/assets/images/logo.png') }}" class="img-fluid" alt="Image" style="width: 10%;"></i>
                SIRAMA
            </h1> -->
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0"><img src="{{ asset('admin/assets/images/logo.png') }}" alt="Logo" style="margin-right: 10px; width:20%">SIRAMA</h1>
                
            </a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.html" class="nav-item nav-link active">Halaman Utama</a>
                <a href="about.html" class="nav-item nav-link">Tentang</a>
                <a href="services.html" class="nav-item nav-link">Servis</a>
                <a href="packages.html" class="nav-item nav-link">Booking</a>
                <a href="packages.html" class="nav-item nav-link">Riwayat</a>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Login</a>
        </div>
    </nav>

    <!-- Header Start -->
    @yield('header')
    <!-- Header End -->
</div>