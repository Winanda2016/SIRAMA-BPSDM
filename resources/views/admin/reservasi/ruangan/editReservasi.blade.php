@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Data Transaksi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/riwayat-transaksi') }}">Transaksi</a></li>
                        <li class="breadcrumb-item active">Edit Data</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 align="center">Formulir Edit Data</h4>
                    <hr>
                    <form method="POST" action="{{ route('pegawai_reservasiRuangan.update', ['id' => $data->transaksi_id]) }}" enctype="multipart/form-data" class="reservationForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="tglReservasi">Tanggal Reservasi</label>
                                    <input class="form-control" id="tglReservasi" name="tgl_reservasi" value="{{ $data->tgl_reservasi }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                                    <input class="form-control" type="text" id="namaRuangan" name="nama_ruangan" value="{{ $data->nama_ruangan }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input class="form-control" type="text" id="harga" name="nohp" value="Rp.{{ $data->harga }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="tglCheckIn" for="formrow-email-input">Tanggal Check In</label>
                                    <input class="form-control" type="date" name="tgl_checkin" id="tglCheckIn" value="{{ $data->tgl_checkin }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="tglCheckOut" for="formrow-password-input">Tanggal Check Out</label>
                                    <input class="form-control" type="date" name="tgl_checkout" id="tglCheckOut" value="{{ $data->tgl_checkout }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ $data->nama }}">
                                    @error('nama')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="noHP" class="form-label">Nomor Handphone</label>
                                    <input class="form-control @error('nohp') is-invalid @enderror" type="text" id="noHP" name="nohp" value="{{ $data->nohp }}">
                                    @error('nohp')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Instansi</label>
                                    <select class="form-select" name="jinstansi_id">
                                        @foreach ($jinstansi as $in)
                                        <option value="{{ $in->id }}" data-price="{{ $in->harga }}" {{ $in->id == $data->jinstansi_id ? 'selected' : '' }}>
                                            {{ $in->nama_instansi }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaInstansi" class="form-label">Nama Instansi</label>
                                    <input class="form-control @error('nama_instansi') is-invalid @enderror" type="text" id="namaInstansi" name="nama_instansi" value="{{ $data->nama_instansi }}">
                                    @error('nama_instansi')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                                    <input class="form-control @error('jumlah_orang') is-invalid @enderror" type="number" id="jumlahOrang" name="jumlah_orang" value="{{ $data->jumlah_orang }}">
                                    @error('jumlah_orang')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dokumen_reservasi" class="form-label">Foto</label>
                                    <div class="row">
                                        @if($data->dokumen_reservasi)
                                        @php
                                        $filePath = asset($data->dokumen_reservasi);
                                        $fileName = basename($data->dokumen_reservasi);
                                        @endphp
                                        <a href="{{ $filePath }}" download="{{ $fileName }}" style="font-size: 14px;">
                                            <i class="bx bxs-file-pdf font-size-20 align-middle" style="color: red;"></i> <u>{{ $fileName }}</u>
                                        </a>
                                        @else
                                        <span class="text-danger" style="font-size: 14px;"><u>dokumen reservasi tidak tersedia.</u></span>
                                        @endif
                                    </div><br>
                                    <input type="file" class="form-control @error('dokumen_reservasi') is-invalid @enderror" id="dokumen_reservasi" name="dokumen_reservasi">
                                    @error('dokumen_reservasi')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <p class="text-secondary">*upload dokumen reservasi baru jika perlu || ukuran file maksimal 2 mb || ekstensi file pdf/doc/docx</p>
                                </div>
                            </div>
                        </div><br>

                        <a type="reset" class="btn btn-danger waves-effect waves-light" onclick="kembali()"><b>Batal</b></a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('choices-multiple-remove-button');
        const choices = new Choices(selectElement, {
            removeItemButton: true // Mengaktifkan tombol hapus
        });
    });
</script>
@endsection