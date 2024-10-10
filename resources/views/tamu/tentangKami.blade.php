@extends('tamu.themes.app')
@section('content')
<!-- Blog Details Hero Section Begin -->
<section class="blog-details-hero set-bg" data-setbg="{{ asset('tamu/assets/img/tentang-hero.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bd-hero-text">
                    <h2>Sistem Informasi Asrama</h2>
                    <h3>Badan Pengembangan Sumber Daya Manusia Provinsi Sumatera Barat</h3>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <span>Tentang Kami</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->
<!-- Breadcrumb Section Begin -->

<!-- Breadcrumb Section End -->

<section class="blog-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="blog-details-text">
                    <!-- <div class="bd-title" align="justify">
                    </div> -->
                    <div class="bd-more-text" align="justify">
                        <div class="bm-item">
                            <h4>Badan Pengembangan Sumber Daya Manusia (BPSDM)</h4>
                            <p>Badan Pengembangan Sumber Daya Manusia (BPSDM) Provinsi Sumatera Barat, merupakan salah satu Organisasi Perangkat Daerah (OPD)
                                Provinsi Sumatera Barat yang merupakan unsur penunjang urusan pemerintahan di bidang pengembangan sumber daya manusia yang
                                menjadi kewenangan daerah provinsi.
                            </p>
                            <p>
                                Berdasarkan dokumen Rencana Strategis (RENSTRA) BPSDM Perubahan tahun 2016-2021, Salah satu tugas atau kinerja BPSDM
                                Provinsi Sumatera Barat adalah Peningkatan Kualitas SDM Penyelenggara melalui pendidikan dan pelatihan (diklat).
                                Pada RENSTRA BPSDM Perubahaan 2016-2021 juga dijelaskan bahwa, untuk meningkatkan kuantitas dan kualitas sarana dan prasarana
                                baik untuk proses belajar-mengajar maupun untuk penyelenggaraan, salah satunya dibangun Asrama penginapan peserta diklat dan
                                peningkatan kualitas Aula.
                            </p>
                        </div>
                        <div class="bm-item">
                            <h4>Sistem Informasi Asrama (SIRAMA)</h4>
                            <p>SIRAMA atau Sistem Informasi Asrama Badan Pengmbangan Sumber Daya Manusia Provinsi Sumtaera Barat
                                adalah salah satu sistem informasi yang ada di Badan Pengembangan Sumber Daya Manusia
                                Provinsi Sumatera Barat yang bertujuan untuk meningkatkan pelayanan retribusi daerah pada Asrama Badan Pengembangan Sumber Daya
                                Manusia Provinsi Sumatera Barat.
                            </p>
                            <p>Selain untuk meningkatkan pelayanan retribusi daerah, SIRAMA juga bertujuan untuk mempermudah tamu atau pengunjung yang ingin 
                                melakukan reservasi pada kamar asrama dan ruangan pada BPSDM Prov.Sumbar. Dengan tersedianya Sistem Informasi Asrama ini pengunjung atau tamu
                                tidak perlu lagi untuk datang ke kantor langsung untuk melakukan reservsi, dan juga dengan adanya SIRAMA ini pengunjung atau tamu 
                                dapat dengan mudah melihat informasi mengenai kamar atau layanan lainnya yang ada di BPSDM Prov.Sumbar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section Begin -->
<section class="gallery-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Galeri Kami</span>
                    <h2>Temukan Layanan Kami</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="gallery-item set-bg" data-setbg="{{ asset('tamu/assets/img/gallery/gallery-1.jpg') }}">
                    <div class="gi-text">
                        <h3>Ruang Aula</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="gallery-item set-bg" data-setbg="{{ asset('tamu/assets/img/gallery/gallery-3.jpeg') }}">
                            <div class="gi-text">
                                <h3>Ruang Komputer</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="gallery-item set-bg" data-setbg="{{ asset('tamu/assets/img/gallery/gallery-4.jpg') }}">
                            <div class="gi-text">
                                <h3>Kamar Asrama</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="gallery-item large-item set-bg" data-setbg="{{ asset('tamu/assets/img/gallery/gallery-2.png') }}">
                    <div class="gi-text">
                        <h3>Asrama BPSDM</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Gallery Section End -->

@endsection