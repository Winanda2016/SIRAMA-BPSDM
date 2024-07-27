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
                        <a href="{{ url('/') }}">Halaman Utama</a>
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
                        <h4>Formulir Reservasi Ruangan</h4>
                        <h4>( {{ $ruangan->nama_ruangan }} )</h4>
                        <hr>
                        <form method="POST" action="{{ route('ruangan_tamu') }}" enctype="multipart/form-data" id="reservationForm">
                            @csrf
                            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">
                            <div class="text-input">
                                <label for="tglReservasi">Tanggal Reservasi:</label>
                                <input type="date" id="tglReservasi" name="tgl_reservasi" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" placeholder="masukkan nama anda">
                            </div>
                            <div class="text-input">
                                <label for="nama_instansi">Instansi:</label>
                                <input type="text" id="nama_instansi" name="nama_instansi" placeholder="masukkan nama Instansi anda">
                            </div>
                            <div class="text-input">
                                <label for="nohp">Nomor HP:</label>
                                <input type="text" id="nohp" name="nohp" placeholder="08...">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tgl_checkin">Check In:</label>
                                        <input type="date" name="tgl_checkin" id="tgl_checkin">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tgl_checkout">Check Out:</label>
                                        <input type="date" name="tgl_checkout" id="tgl_checkout">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="number">Jumlah Orang:</label>
                                        <input type="number" id="number" name="jumlah_orang" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="harga">Harga Ruangan:</label>
                                        <input type="text" id="harga" value="RP.{{ $ruangan->formatted_harga }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen_reservasi">Dokumen:</label>
                                <input type="file" class="form-control" id="dokumen_reservasi" name="dokumen_reservasi">
                                <p>*Jika dari Instansi maka wajib mengirim dokumen untuk reservasi </p>
                                <p>*Jika Umum tidak perlu dokumen reservasi </p>
                            </div>
                            <div class="button-container">
                                <button type="submit" class="BPrimary">Reservasi</button>
                                <button type="reset" class="BDanger" onclick="kembali()">Batal</button>
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