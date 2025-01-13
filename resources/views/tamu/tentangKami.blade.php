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
                            <p>Badan Pengembangan Sumber Daya Manusia (BPSDM) Provinsi Sumatera Barat,
                                merupakan salah satu Organisasi Perangkat Daerah (OPD) Provinsi Sumatera Barat yang merupakan unsur
                                penunjang urusan pemerintahan di bidang pengembangan sumber daya manusia yang menjadi kewenangan daerah provinsi.
                                Sebagai unsur penunjang tentu BPSDM harus bisa mempersiapkan segala sesuatu yang berkaitan dengan kebutuhan kompetensi
                                ASN yang akan digunakan oleh unsur pelaksana urusan pemerintahan daerah dan unsur penunjang lainnya. Keberadaan BPSDM harus
                                bisa mendukung penyelenggaraan urusan daerah dengan mempersiapkan kebutuhan kompetensi SDM.
                            </p>
                            <p>
                                Badan pengembangan sumber daya manusia
                                memiliki luas sekitar 2 Hektar yang terdiri dari gedung kantor, asrama dan fasilitas – fasilitas lainnya.
                                Jumlah kamar yang tersedia sebanyak 78 (tujuh puluh delapan) kamar dengan kapasitas sebanyak 250 orang.
                            </p>
                        </div>
                        <div class="bm-item">
                            <h4>Sistem Informasi Asrama (SIRAMA)</h4>
                            <p>SIRAMA atau Sistem Informasi Asrama Badan Pengmbangan Sumber Daya Manusia Provinsi Sumtaera Barat
                                adalah salah satu sistem informasi yang ada di Badan Pengembangan Sumber Daya Manusia
                                Provinsi Sumatera Barat yang bertujuan untuk meningkatkan pelayanan dan transparansi dalam pemungutan retribusi daerah pada Badan 
                                Pengembangan Sumber daya Manusia Provinsi Sumatera Barat.
                            </p>
                            <p>Selain bertujuan untuk meningkatkan pelayanan retribusi daerah, SIRAMA juga dirancang untuk mempermudah 
                                calon tamu yang ingin melakukan reservasi kamar asrama atau ruangan di BPSDM Provinsi Sumatera Barat. 
                                Dengan adanya SIRAMA ini, calon tamu tidak perlu lagi datang langsung ke kantor untuk 
                                melakukan reservasi. Proses reservasi dapat dilakukan secara online melalui SIRAMA, yang telah dilengkapi 
                                dengan informasi lengkap mengenai kamar asrama maupun ruangan yang tersedia di BPSDM. Hal ini memberikan 
                                kemudahan bagi calon tamu dalam memperoleh informasi yang dibutuhkan secara praktis dan efisien.
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