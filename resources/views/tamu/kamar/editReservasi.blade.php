@extends('tamu.themes.app')
@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Transaksi</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/riwayat-transaksi') }}">Riwayat Transaksi</a>
                        <span>Detail Transaksi</span>
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
                        <h3>Detail Transaksi</h3>
                        <hr>
                        <form method="POST" action="{{ route('reservasi_kamar.update', ['id' => $data->detail_id]) }}" enctype="multipart/form-data" id="reservationForm">
                            @csrf
                            @method('PUT')
                            <div class="text-input">
                                <label for="tglReservasi">Tanggal Reservasi:</label>
                                <input type="date" id="tglReservasi" name="tgl_reservasi" value="{{ $data->tgl_reservasi }}" readonly>
                            </div>

                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" value="{{ $data->nama }}">
                            </div>

                            <div class="select-option">
                                <label for="instansi">Instansi:</label>
                                <select id="instansi" name="instansi_id">
                                    @foreach ($instansi as $in)
                                    <option value="{{ $in->id }}" data-price="{{ $in->harga }}" {{ $in->id == $data->instansi_id ? 'selected' : '' }}>
                                        {{ $in->nama_instansi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" name="nama_instansi" value="{{ $data->nama_instansi }}">
                            </div>

                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" name="nohp" value="{{ $data->nohp }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="date" name="tgl_checkin" id="tglCheckIn" value="{{ $data->tgl_checkin }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="date" name="tgl_checkout" id="tglCheckOut" value="{{ $data->tgl_checkout }}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-input" style="width: 40%;">
                                <label for="jumlahOrang">Jumlah Orang:</label>
                                <input type="number" id="jumlahOrang" name="jumlah_orang" value="{{ $data->jumlah_orang }}">
                            </div>

                            <div class="button-container">
                                <button type="submit" class="BPrimary">Simpan</button>
                                <button type="reset" class="BDanger">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <h4>Keterangan :</h4>
                <p>
                    1. Edit dan Hapus reservasi hanya dapat dilakukan selama reservasi masih dalam status "pending
                </p>
            </div>
        </div>
    </div>
</section>
@endsection