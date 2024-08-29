@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Reservasi Kamar</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/kamar') }}">Kamar</a>
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
                        <form method="POST" action="{{ url('/kamar') }}" enctype="multipart/form-data" id="reservationForm">
                            @csrf
                            <div class="text-input">
                                <label for="tglReservasi">Tanggal Reservasi:</label>
                                <input type="date" id="tglReservasi" name="tgl_reservasi" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" placeholder="masukkan nama anda">
                            </div>
                            <div class="select-option">
                                <label for="jinstansi">Jenis Instansi:</label>
                                <select id="jinstansi" name="jinstansi_id">
                                    @foreach ($jinstansi as $in)
                                    <option value="{{ $in->id }}" data-price="{{ $in->harga }}">{{ $in->nama_instansi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" name="nama_instansi" placeholder="Badan Pengembangan Sumber Daya Manusia">
                            </div>
                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" name="nohp" placeholder="08...">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="date" name="tgl_checkin" id="tglCheckIn" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="date" name="tgl_checkout" id="tglCheckOut" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="jumlahOrang">Jumlah Orang:</label>
                                        <input type="number" id="jumlahOrang" name="jumlah_orang" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="jumlahKamar">Jumlah Kamar:</label>
                                        <input type="number" id="jumlahKamar" name="jumlah_ruangan" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen_reservasi">Dokumen:</label>
                                <input type="file" class="form-control" id="dokumen_reservasi" name="dokumen_reservasi">
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
                <h3 class="my-3"><b>Keterangan</b></h3>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah kasur (single bed)</p>
                <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
                <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
                <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
                <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                    untuk anda menempati kamar yang sama dengan orang lain</p>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // Ambil tanggal dari local storage dan isi ke input tanggal
        var tglCheckin = localStorage.getItem('tglCheckin');
        var tglCheckout = localStorage.getItem('tglCheckout');

        if (tglCheckin && tglCheckout) {
            $('#tglCheckIn').val(tglCheckin).prop('readonly', true);
            $('#tglCheckOut').val(tglCheckout).prop('readonly', true);
        }

        // Hapus tanggal dari local storage jika klik batal
        $('#reservationForm').on('reset', function() {
            localStorage.removeItem('tglCheckin');
            localStorage.removeItem('tglCheckout');
            $('#tglCheckIn').prop('readonly', false);
            $('#tglCheckOut').prop('readonly', false);
        });
    });
</script>
@endsection