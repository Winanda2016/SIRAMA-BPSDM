@extends('tamu.themes.app')
@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="hero-text">
                    <h1>ASRAMA BPSDM Prov.SUMBAR</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-1.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-2.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('tamu/assets/img/hero/hero-3.jpg') }}"></div>
    </div>
</section>
<!-- Hero Section End -->

<!-- About Us Section Begin -->
<section class="aboutus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text">
                    <div class="section-title">
                        <span>Tentang Kami</span>
                        <h3 class="mt-2">Sistem Informasi Asrama (SIRAMA) </h3>
                    </div>
                    <p class="f-para">Sona.com is a leading online accommodation site. We’re passionate about
                        travel. Every day, we inspire and reach millions of travelers across 90 local websites in 41
                        languages.</p>
                    <p class="s-para">So when it comes to booking the perfect hotel, vacation rental, resort,
                        apartment, guest house, or tree house, we’ve got you covered.</p>
                    <a href="#" class="primary-btn about-btn">Read More</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-pic">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('tamu/assets/img/about/about-1.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('tamu/assets/img/about/about-2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->

<!-- Home Room Section Begin -->
<section class="hp-room-section mb-5">
    <div class="container-fluid">
        <div class="section-title">
            <span>What We Do</span>
            <h2>Temukan Layanan Kami.</h2>
        </div>
        <div class="hp-room-items px-5">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" data-setbg="{{ asset('tamu/assets/img/room/room-b1.jpg') }}">
                        <div class="hr-text">
                            <h3>Kamar</h3>
                            <h2><span>Mulai</span> RP.65.000<span>/Malam</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Ukuran Kamar</td>
                                        <td>: 30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapasitas</td>
                                        <td>: Max 4 Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kasur</td>
                                        <td>: Singel Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Fasilitas</td>
                                        <td>: Wifi, Television, Bathroom,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" data-setbg="{{ asset('tamu/assets/img/room/room-b2.jpg') }}">
                        <div class="hr-text">
                            <h4>Ruang Komputer</h4>
                            <h2>RP.300.000<span>/Hari</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Ukuran Ruangan</td>
                                        <td>: 30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapasitas</td>
                                        <td>: 20 Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Jumlah Komputer</td>
                                        <td>: 25</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Fasilitas</td>
                                        <td>: Wifi, Television, Bathroom,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" data-setbg="{{ asset('tamu/assets/img/room/room-b2.jpg') }}">
                        <div class="hr-text">
                            <h4>Ruang ...</h4>
                            <h2>RP.....<span>/Hari</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Ukuran Ruangan</td>
                                        <td>: 30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapasitas</td>
                                        <td>: 20 Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Jumlah Komputer</td>
                                        <td>: 25</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Fasilitas</td>
                                        <td>: Wifi, Television, Bathroom,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Room Section End -->

@endsection