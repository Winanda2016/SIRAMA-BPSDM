@extends('tamu.themes.app')
@php
$ar_judul = ['No','Nama Instansi','Harga'];
$no = 1;
@endphp
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Kamar</h2>
                    <div class="bt-option">
                        <a href="{{ url('/tamu-dashboard') }}">Halaman Utama</a>
                        <span>Kamar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="card p-2">
            <div class="row">
                <div class="col-lg-6" style=" width: 100%; height: 400px; overflow: hidden; display: flex; flex-direction: column; margin-right:20px;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style=" height: 100%;">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox" style="height: 100%; display: flex;">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid w-100" src="{{ asset('tamu/assets/img/logo.png') }}" alt="First slide" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" src="{{ asset('admin/assets/images/small/img-2.jpg') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" src="{{ asset('admin/assets/images/small/img-1.jpg') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div><!-- end carousel -->
                </div>

                <div class="col-lg-5">
                    <div class="room-details-item">
                        <div class="rd-text">
                            <div class="rd-title">
                                <div class="rdt-left">
                                    <a href="{{ url('/kamar/reservasi') }}">Reservasi</a>
                                </div>
                            </div>
                            <table class="table table-bordered" style="width: 100%;">
                                <thead>
                                    @foreach($ar_judul as $jdl)
                                    <td>{{ $jdl }}</td>
                                    @endforeach
                                </thead>
                                <tbody>
                                    @foreach($jtamu as $jt)
                                    <tr>
                                        <td align="center" style="width: 10%;">{{ $no++ }}</td>
                                        <td style="width: 60%;">{{ $jt->nama_jenis }}</td>
                                        <td style="width: 30%;">Rp. {{ $jt->formatted_harga }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="my-3"><b>Deskripsi</b></h3>
        <table>
            <tbody  style="width: 70%;color:#707079">
                <tr>
                    <td style="width: 30%;">Kamar Tersedia</td>
                    <td style="width: 1%;"> : </td>
                    <td  style="width: 54%;">{{ $kamarTersedia }}</td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td> : </td>
                    <td>2 Orang Dewasa</td>
                </tr>
                <tr>
                    <td>Fasilitas</td>
                    <td> : </td>
                    <td>King Beds</td>
                </tr>
                <tr>
                    <td>Lainnya</td>
                    <td> : </td>
                    <td>Wifi, Television, Bathroom,...</td>
                </tr>
            </tbody>
        </table><hr>

        <h3 class="my-3"><b>Keterangan</b></h3>
        <p class="f-para">1. Setiap kamar terdiri dari 2 buah bed singel</p>
        <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
        <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
        <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
        <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                            untuk anda menempati kamar yang sama dengan orang lain</p>
    </div>
</section>
<!-- Room Details Section End -->

@endsection