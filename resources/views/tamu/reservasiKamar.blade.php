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
                        <a href="{{ url('/tamu-dashboard') }}">Halaman Utama</a>
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
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" placeholder="masukkan nama anda">
                            </div>
                            <div class="select-option">
                                <label for="instansi">Instansi:</label>
                                <select id="instansi" name="instansi">
                                    @foreach ($instansi as $in)
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
                                <input type="text" id="noHP" name="noHP" placeholder="08...">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="text" class="date-input" name="tgl_checkin" id="tglCheckIn">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="text" class="date-input" name="tgl_checkout" id="tglCheckOut">
                                        <i class="icon_calendar"></i>
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
                                        <label for="totalHari">Total hari:</label>
                                        <input type="number" id="totalHari" name="total_hari" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="text-input" style="width: 60%;">
                                <label for="totalHarga">Total harga:</label>
                                <input type="text" id="totalHarga" name="total_harga" placeholder="0" disabled>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen">Dokumen:</label>
                                <input type="file" class="form-control" id="dokumen" name="dokumen">
                                <p>*Masukkan Dokumen Permintaan Reservasi Jika Ada</p>
                            </div>
                            <div class="button-container">
                                <button type="submit" class="reservasi">Reservasi</button>
                                <button type="reset" class="batal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <h3 class="my-3"><b>Keterangan</b></h3>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah bed singel</p>
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
        const tglCheckIn = $('#tglCheckIn');
        const tglCheckOut = $('#tglCheckOut');
        const jumlahOrang = $('#jumlahOrang');
        const totalHari = $('#totalHari');
        const totalHarga = $('#totalHarga');
        const instansi = $('#instansi');

        function kalkulatorHari() {
            const checkInDate = new Date(tglCheckIn.val());
            const checkOutDate = new Date(tglCheckOut.val());

            if (checkInDate && checkOutDate) {
                const diffTime = Math.abs(checkOutDate - checkInDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                totalHari.val(diffDays);

                kalkulatorHarga(diffDays);
            }
        }

        function kalkulatorHarga(days) {
            const orang = jumlahOrang.val();
            const hargaPerHariPerOrang = instansi.find('option:selected').data('price');

            if (days && orang && hargaPerHariPerOrang) {
                const total = days * orang * hargaPerHariPerOrang;
                totalHarga.val(total);
            }
        }

        // Event listener untuk setiap perubahan
        tglCheckIn.change(function() {
            kalkulatorHari();
        });

        tglCheckOut.change(function() {
            kalkulatorHari();
        });

        jumlahOrang.on('input', function() {
            kalkulatorHarga(totalHari.val());
        });

        instansi.change(function() {
            kalkulatorHarga(totalHari.val());
        });
    });
</script>

@endsection