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
                        <a href="{{ url('/tamu/riwayat-transaksi') }}">Riwayat Transaksi</a>
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
                        <form method="POST" action="{{ route('reservasi_kamar.update', ['id' => $data->transaksi_id]) }}" enctype="multipart/form-data" class="reservationForm">
                            @csrf
                            @method('PUT')
                            <div class="text-input mb-3">
                                <label for="tglReservasi">Tanggal Reservasi:</label>
                                <input type="date" id="tglReservasi" name="tgl_reservasi" value="{{ $data->tgl_reservasi }}" readonly>
                            </div>

                            <div class="text-input mb-3">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $data->nama }}" required>
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
                                    <option value="{{ $in->id }}" data-price="{{ $in->harga }}" {{ $in->id == $data->jinstansi_id ? 'selected' : '' }}>
                                        {{ $in->nama_instansi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-input mb-3">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="namaInstansi" name="nama_instansi" value="{{ $data->nama_instansi }}">
                                @error('nama_instansi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="text-input mb-3">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="noHP" name="nohp" value="{{ $data->nohp }}">
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
                                        <input type="date" class="form-control @error('tgl_checkin') is-invalid @enderror" name="tgl_checkin" id="tglCheckIn" value="{{ $data->tgl_checkin }}" readonly>
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
                                        <input type="date" class="form-control @error('tgl_checkout') is-invalid @enderror" name="tgl_checkout" id="tglCheckOut" value="{{ $data->tgl_checkout }}" readonly>
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
                                        <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlahOrang" name="jumlah_orang" value="{{ $data->jumlah_orang }}">
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
                                        <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlahKamar" name="jumlah_ruangan" value="{{ $data->jumlah_ruangan }}">
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
                                @php
                                $filePath = asset($data->dokumen_reservasi);
                                $fileName = basename($data->dokumen_reservasi);
                                @endphp
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
                                    <path fill="#4c5c7e" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" />
                                </svg>
                                @if($data->dokumen_reservasi)
                                <span class="mb-3" style="font-size: 12px;"><u>{{ $fileName }}</u></span>
                                @else
                                <span class="text-danger mb-3" style="font-size: 12px;"><u>dokumen reservasi tidak tersedia.</u></span>
                                @endif

                                <input type="file"  class="form-control mt-2 @error('dokumen_reservasi') is-invalid @enderror" id="dokumen_reservasi" name="dokumen_reservasi">
                                <p class="keterangan_input">
                                    *upload file baru jika perlu <br>
                                    *ukuran file maksimal 2 mb || ekstensi file pdf/doc/docx
                                </p>
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
@endsection