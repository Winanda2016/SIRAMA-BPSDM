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
                            <div class="text-input mb-3">
                                <label for="tglReservasi">Tanggal Reservasi:</label>
                                <input type="date" id="tglReservasi" name="tgl_reservasi" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="text-input mb-3">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="masukkan nama anda">
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="select-option">
                                <label for="jinstansi">Jenis Instansi:</label>
                                <select id="jinstansi" name="jinstansi_id">
                                    @foreach ($jinstansi as $in)
                                    <option value="{{ $in->id }}" data-price="{{ $in->harga }}">{{ $in->nama_instansi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-input mb-3">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="namaInstansi" name="nama_instansi" value="{{ old ('nama_instansi') }}">
                                @error('nama_instansi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="text-input mb-3">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="noHP" name="nohp" value="{{ old ('nohp') }}">
                                @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="date" class="form-control @error('tgl_checkin') is-invalid @enderror" name="tgl_checkin" id="tglCheckIn">
                                        @error('tgl_checkin')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="date" class="form-control @error('tgl_checkout') is-invalid @enderror" name="tgl_checkout" id="tglCheckOut">
                                        @error('tgl_checkout')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input mb-3">
                                        <label for="jumlahOrang">Jumlah Orang:</label>
                                        <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlahOrang" name="jumlah_orang" value="{{ old ('jumlah_orang') }}">
                                        @error('jumlah_orang')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input mb-3">
                                        <label for="jumlahKamar">Jumlah Kamar:</label>
                                        <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlahKamar" name="jumlah_ruangan" value="{{ old ('jumlah_ruangan') }}">
                                        @error('jumlah_ruangan')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen_reservasi">Dokumen:</label>
                                <input type="file" class="form-control mt-2 @error('dokumen_reservasi') is-invalid @enderror" id="dokumen_reservasi" name="dokumen_reservasi">
                                @error('dokumen_reservasi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                                <p class="keterangan_input">
                                    *upload file baru jika perlu <br>
                                    *ukuran file maksimal 2 mb || ekstensi file pdf/doc/docx
                                </p>
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
                <p class="f-para">1. Setiap kamar terdiri dari 2 kasur (single bed)</p>
                <p class="f-para">2. Jumlah orang, hitung berdasarkan kebutuhan bed</p>
                <p class="f-para">3.Jumlah kamar, hitung berdasarkan berapa kamar yang diinginkan</p>
                <p class="f-para">4. Harga yang tertera merupakan harga per orang atau per bed</p>
                <p class="f-para">5. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
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