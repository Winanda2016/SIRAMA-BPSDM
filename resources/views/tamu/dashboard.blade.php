@extends('tamu.themes.app')
@section('content')
<!-- Hero Section Begin -->
<!-- <section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>SIRAMA BPSDM</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h4>Cek Ketersediaan Kamar</h4>
                    <hr>
                    <form action="#">
                        <div class="row">
                            <div class="col-6">
                                <div class="check-date">
                                    <label for="date-in">Check In:</label>
                                    <input type="date" class="date-input" id="date-in" placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="check-date">
                                    <label for="date-out">Check Out:</label>
                                    <input type="date" class="date-input" id="date-out" placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="cek-ketersediaan">Cek Ketersediaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-2.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-2.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-3.jpg') }}"></div>
    </div>
</section> -->

<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>SIRAMA BPSDM</h1>
                    <p>Sistem Informasi Asrama (SIRAMA) adalah salah satu sistem informasi yang
                        bertujuan untuk meningkatkan pelayanan retribusi daerah...</p>
                    <a href="#about" class="primary-btn">Telusuri Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-1.png') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-1.png') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-1.png') }}"></div>
    </div>
</section>

<div class="p-2">
    <!-- About Us Section Begin -->
    <section class="aboutus-section spad" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>Tentang Kami</span>
                            <h3 class="mt-2">Sistem Informasi Asrama (SIRAMA) </h3>
                        </div>
                        <p class="f-para">SIRAMA adalah salah satu sistem informasi yang ada di Badan Pengembangan Sumber Daya Manusia
                            Provinsi Sumatera Barat yang bertujuan untuk meningkatkan pelayanan retribusi daerah pada Asrama Badan Pengembangan Sumber Daya
                            Manusia Provinsi Sumatera Barat.
                        </p>
                        <a href="#" class="primary-btn about-btn">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6" style=" width: 100%; height: 400px; overflow: hidden; display: flex; flex-direction: column;">
                                <img src="{{ asset('tamu/assets/img/about/about-1.png') }}" alt="" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('tamu/assets/img/about/about-2.png') }}" alt="" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <!-- About Us Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section mb-5 mt-5">
        <div class="container-fluid">
            <div class="section-title">
                <span>Apa Yang Kami Tawarkan</span>
                <h2>Temukan Layanan Kami</h2>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <section class="rooms-section spad mb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6" style="border-radius: 10px;">
                    <div class="room-item" style="box-shadow: 0px 9px 10px #4c5c7ed7;">
                        <div class="card" style="width: 100%; height: 250px; overflow: hidden; display: flex;">
                            <img src="{{ asset('tamu/assets/img/about/about-1.png') }}" alt="Default Image" style="height: 100%; width: 100%; object-fit: cover;">
                        </div>
                        <div class="ri-text">
                            <h4>Kamar</h4>
                            <span>Mulai</span>
                            <h3>Rp.65.000<span>/Hari</span></h3>
                            <p class="r-o">Kapasitas : 2 Orang</p>
                            <a href="{{ route('kamar_tamu') }}" class="primary-btn">Detail Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @foreach ($ruangan as $r)
                <div class="col-lg-3 col-md-6">
                    <div class="room-item" style="box-shadow: 0px 9px 10px #4c5c7ed7;">
                        <div class="card" style="width: 100%; height: 250px; overflow: hidden; display: flex;">
                            @if ($r->foto)
                            <img src="{{ asset($r->foto) }}" alt="{{ $r->nama_ruangan }}" style="height: 100%; width: 100%; object-fit: cover;">
                            @else
                            <img src="{{ asset('tamu/assets/img/ruangan/no_image.jpg') }}" alt="Default Image" style="height: 100%; width: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="ri-text">
                            <h4>{{ $r->nama_ruangan}}</h4><br>
                            <h3>Rp.{{ $r->formatted_harga }}<span>/Hari</span></h3>
                            <p class="r-o">Kapasitas : {{ $r->kapasitas }} Orang</p>
                            <a href="{{ route('detail_ruangan', $r->id) }}" class="primary-btn">Detail Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Saran dan Pengaduan</span>
                        <h2>Apa Yang Customers Katakan?</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-7">
                    <div class="card">
                        <div class="rd-reviews">
                            <h4>Saran dan Pengaduan</h4>
                            <div id="komentar-list">
                                @foreach ($komentar as $index => $km)
                                <div class="review-item">
                                    <div class="ri-text">
                                        <span>{{ $km->tanggal }}</span>
                                        <h5>{{ $km->nama_user }}</h5>
                                        <h6 class="text-komen">{{ $km->komentar }}.</h6>
                                    </div>
                                    @if (!empty($km->balasan))
                                    <div class="ri-text" style="margin-left: 80px; margin-top: 10px">
                                        <h6><b>*Balasan : Admin</b></h6>
                                        <h6 class="text-komen">{{ $km->balasan }}.</h6>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" style="border-left: 1px solid #4c5c7e;padding-left: 20px;">
                    <div class="review-add">
                        <h4>Tambah Saran/Pengaduan</h4>
                        <form class="ra-form" method="POST" action="{{ route('komentar.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Komentar Kamu" name="komentar"></textarea>
                                    <button type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection