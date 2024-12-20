<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                @if( Auth::user()->role == 'admin')
                <li>
                    <a href="{{ url('/admin-dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                @endif

                @if( Auth::user()->role == 'pegawai')
                <li>
                    <a href="{{ url('/pegawai-dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="search"></i>
                        <span data-key="t-cekketersediaan">Cek Ketersediaan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/cek/kamar') }}">
                                <span data-key="t-cekkamar">Kamar</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/cek/ruangan') }}">
                                <span data-key="t-cekruangan">Ruangan</span>
                            </a>
                        </li>
                    </ul>
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
                        <i data-feather="book-open"></i>
                        <span data-key="t-dtamu">Daftar Tamu</span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ url('/riwayat-transaksi') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-riwayat">Riwayat Transaksi</span>
                    </a>
                </li>

                <!-- Administrator -->
                @if( Auth::user()->role == 'admin')
                <li class="menu-title mt-2" data-key="t-menu">Kelola Data</li>

                <li class="@if (Route::currentRouteName() == 'gedung') active @endif">
                    <a href="{{ url('/gedung') }}">
                        <i data-feather="layers"></i>
                        <span data-key="t-gedung">Data Gedung</span>
                    </a>
                </li>

                <li class="@if (Route::currentRouteName() == 'kelola-kamar') active @endif">
                    <a href="{{ route('kelola_kamar') }}">
                        <i data-feather="slack"></i>
                        <span data-key="t-kamar">Data Kamar</span>
                    </a>
                </li>

                <li class="@if (Route::currentRouteName() == 'instansi') active @endif">
                    <a href="{{ url('/jinstansi') }}">
                        <i data-feather="tag"></i>
                        <span data-key="t-instansi">Data Instansi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/kelola-ruangan') }}">
                        <i data-feather="cpu"></i>
                        <span data-key="t-ruangan">Data Ruangan</span>
                    </a>
                </li>

                <li class="@if (Route::currentRouteName() == 'komentar') active @endif">
                    <a href="{{ url('/komentar') }}">
                        <i data-feather="message-circle"></i>
                        <span data-key="t-kkomen">Saran dan Pengadun</span>
                    </a>
                </li>

                <li class="@if (Route::currentRouteName() == 'kelola-users') active @endif">
                    <a href="{{ url('/kelola-users') }}">
                        <i data-feather="users" ></i>
                        <span data-key="t-kusers">Kelola Pengguna</span>
                    </a>
                </li>
                @endif
            </ul>
        </div><br><br>

        <!-- Sidebar -->
    </div>
</div>