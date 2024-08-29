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
                            <a href="javascript: void(0);"><i class="fa fa-facebook"></i></a>
                            <a href="javascript: void(0);"><i class="fa fa-twitter"></i></a>
                            <a href="javascript: void(0);"><i class="fa fa-tripadvisor"></i></a>
                            <a href="https://www.instagram.com/bpsdm.provsumbar"><i class="fa fa-instagram"></i></a>
                        </div>

                        @if (Route::has('login'))
                        @auth
                        <button type="button" class="btn header-item topbar-light bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium" style="text-transform: capitalize;">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="10" height="10" style="margin: 0px 5px 0px 5px;">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-right: 5px;">
                                    <path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z" />
                                </svg>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-right: 5px;">
                                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                    </svg>
                                    Logout
                                </a>
                            </form>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="bk-btn">
                            Log in
                        </a>
                        @endauth
                        @endif
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
                            <img src="{{ asset('tamu/assets/img/logo.png') }}" alt="" width="200" height="35">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ Route::currentRouteName() == 'Tdashboard' ? 'active' : '' }}"><a href="{{ url('/') }}">Beranda</a></li>
                                <li class="{{ Route::currentRouteName() == 'Ttentang' ? 'active' : '' }}"><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                                <li class="{{ Route::currentRouteName() == 'kamar_tamu' ? 'active' : '' }}"><a href="{{ url('/kamar') }}">Kamar</a></li>
                                <li class="{{ Route::currentRouteName() == 'Truangan' ? 'active' : '' }}"><a href="{{ url('/ruangan') }}">Ruangan</a></li>
                                <li class="{{ Route::currentRouteName() == 'Tkontak' ? 'active' : '' }}"><a href="{{ url('/kontak') }}">Kontak</a></li>
                                @if (Route::has('login'))
                                @auth
                                <li class="{{ Route::currentRouteName() == 'riwayat_tamu' ? 'active' : '' }}"><a href="{{ url('/tamu/riwayat-transaksi') }}">Riwayat Transaksi</a></li>
                                @else

                                @endauth
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>