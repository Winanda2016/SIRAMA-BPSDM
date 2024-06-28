@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Reservasi Ruangan</h2>
                    <div class="bt-option">
                        <a href="{{ url('/tamu-dashboard') }}">Halaman Utama</a>
                        <a href="{{ url('/ruangan') }}">Ruangan</a>
                        <a href="{{ url('/ruangan/detail') }}">Detail Ruangan</a>
                        <span>Reservasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="card p-4">
                    <div class="room-booking">
                        <h3>Formulir Reservasi Ruangan</h3>
                        <hr>
                        <form action="#">
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" placeholder="masukkan nama anda">
                            </div>
                            <div class="select-option">
                                <label for="instansi">Instansi:</label>
                                <select id="instansi">
                                    <option value="">Umum</option>
                                    <option value="">Pemerintahan Provinsi</option>
                                </select>
                            </div>
                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" placeholder="masukkan nama Instansi anda">
                            </div>
                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" placeholder="08...">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="check-date">
                                        <label for="date-in">Check In:</label>
                                        <input type="text" class="date-input" id="date-in">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="check-date">
                                        <label for="date-out">Check Out:</label>
                                        <input type="text" class="date-input" id="date-out">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="text-input">
                                <label for="number">Jumlah Orang:</label>
                                <input type="number" id="number" placeholder="0">
                            </div>
                            <div class="dokumen">
                                <label for="dokumen">Dokumen:</label>
                                <input type="file" class="form-control" id="dokumen" name="dokumen">
                                <p>*Masukkan Dokumen Permintaan Reservasi Jika Ada</p>
                            </div>
                            <div class="button-container">
                                <a type="submit" class="reservasi">Reservasi</a>
                                <button type="submit" class="batal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <h3 class="mb-2">Deskripsi</h3>
                <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
                    advantages and disadvantages of both, so you will be confident when purchasing an RV.
                    When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
                    wheeler? The advantages and disadvantages of both are studied so that you can make your
                    choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
                    achievement of a lifetime. It can be similar to sojourning with your residence as you
                    search the various sites of our great land, America.</p>
                <p>The two commonly known recreational vehicle classes are the motorized and towable.
                    Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                    wheel has the attraction of getting towed by a pickup or a car, thus giving the
                    adaptability of possessing transportation for you when you are parked at your campsite.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection