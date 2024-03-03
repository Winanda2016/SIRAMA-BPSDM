<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ url('/') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="phone-incoming"></i>
                        <span data-key="t-reservasi">Reservasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/daftar-reservasi') }}">
                                <span data-key="t-dreservasi">Daftar Reservasi</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/permintaan-reservasi') }}">
                                <span data-key="t-preservasi">Permintaan Reservasi</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('/daftar-tamu') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-dtamu">Daftar Tamu</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/kelola-gedung') }}">
                        <i data-feather="layers"></i>
                        <span data-key="t-gedung">Kelola Gedung</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/kelola-kamar') }}">
                        <i data-feather="slack" ></i>
                        <span data-key="t-kamar">Kelola Kamar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/kelola-ruangan') }}">
                        <i data-feather="cpu" ></i>
                        <span data-key="t-kamar">Kelola Ruangan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/riwayat-transaksi') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-riwayat">Riwayat</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar -->
    </div>
</div>