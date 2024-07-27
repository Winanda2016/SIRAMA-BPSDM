@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Transaksi</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/tamu/riwayat-transaksi') }}">Riwayat Transaksi</a>
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
                        <h3>Formulir Reservasi</h3>
                        <hr>
                        <form method="POST" action="{{ route('kamar_tamu') }}" enctype="multipart/form-data" id="reservationForm">
                            @csrf
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" placeholder="Raidhatul" disabled>
                            </div>
                            <div class="text-input">
                                <label for="instansi">Instansi:</label>
                                <input type="text" id="namaInstansi" name="instansi" placeholder="Umum" disabled>
                            </div>
                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" name="nama_instansi" placeholder="Umum" disabled>
                            </div>
                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" name="nohp" placeholder="082258877654">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="text" class="date-input" name="tgl_checkin" id="tglCheckIn" placeholder="04 Juli 2024" disabled>
                                        <!-- <input type="text" class="date-input" name="tgl_checkin" id="tglCheckIn" placeholder="YYYY-MM-DD"> -->
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="text" class="date-input" name="tgl_checkout" id="tglCheckOut" placeholder="05 Juli 2024" disabled>
                                        <!-- <input type="text" class="date-input" name="tgl_checkout" id="tglCheckOut" placeholder="YYYY-MM-DD"> -->
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="jumlahOrang">Jumlah Orang:</label>
                                        <input type="number" id="jumlahOrang" name="jumlah_orang" placeholder="2 Orang" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="totalHari">Total hari:</label>
                                        <input type="number" id="totalHari" name="total_hari" placeholder="1" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="text-input" style="width: 60%;">
                                <label for="totalHarga">Total harga:</label>
                                <input type="text" id="totalHarga" name="total_harga" placeholder="Rp. 150.000,00" disabled>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen">Bukti Pembayaran:</label>
                                <input type="file" class="form-control" id="dokumen" name="dokumen">
                            </div>
                            <div class="button-container">
                                <a href="{{ url('/tamu/riwayat-transaksi') }}" class="reservasi">Submit</a>
                                <button type="reset" class="batal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <!-- <h3 class="my-3"><b>Keterangan</b></h3>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah kasur (single bed)</p>
                <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
                <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
                <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
                <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                    untuk anda menempati kamar yang sama dengan orang lain</p> -->
            </div>
        </div>
    </div>
</section>
@endsection