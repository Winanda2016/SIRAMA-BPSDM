<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fa fa-phone"></i> (0751) 72730</li>
                        <li><i class="fa fa-envelope"></i> diklat.provsumbar@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tripadvisor"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                        <a href="{{ url('/') }}" class="bk-btn">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="{{ asset('pelanggan/assets/img/logo.png') }}" alt=""  width="200" height="35">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ Route::currentRouteName() == 'Pdashboard' ? 'active' : '' }}"><a href="{{ url('/pelanggan-dashboard') }}">Home</a></li>
                                <li class="{{ Route::currentRouteName() == 'Ptentang' ? 'active' : '' }}"><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                                <li class="{{ Route::currentRouteName() == 'Pkamar' ? 'active' : '' }}"><a href="{{ url('/kamar') }}">Kamar</a></li>
                                <li class="{{ Route::currentRouteName() == 'Pruangan' ? 'active' : '' }}"><a href="{{ url('/ruangan') }}">Ruangan</a></li>
                                <li class="{{ Route::currentRouteName() == 'Pkontak' ? 'active' : '' }}"><a href="{{ url('/kontak') }}">Kontak</a></li>
                                <li><a href="./contact.html">Riwayat Transaksi</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>