@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Check In</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Check In</a></li>
                        <li class="breadcrumb-item active">Form Check In</li>
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
                    <h4 align="center">Formulir Check In</h4>
                    <hr>
                    <form method="POST" action="{{ route('kamar_checkin_store') }}" enctype="multipart/form-data" id="reservationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="noHP" class="form-label">Nomor HP</label>
                                    <input class="form-control @error('nohp') is-invalid @enderror" type="text" id="noHP" name="nohp" value="{{ old('nohp') }}" placeholder="08...">
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
                                        @if (old('jinstansi_id') == $in->id)
                                        <option value="{{ $in->id }}" data-price="{{ $in->harga }}" selected>{{ $in->nama_instansi }}</option>
                                        @else
                                        <option value="{{ $in->id }}" data-price="{{ $in->harga }}">{{ $in->nama_instansi }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('jinstansi_id')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaInstansi" class="form-label">Nama Instansi</label>
                                    <input class="form-control @error('nama_instansi') is-invalid @enderror" value="{{ old('nama_instansi') }}" type="text" id="namaInstansi" name="nama_instansi">
                                    @error('nama_instansi')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                    <div class="text-muted" style="font-size: 11px;">*Jika umum isikan 'umum'</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckIn">Tanggal Check In</label>
                                    <input class="form-control @error('tgl_checkin') is-invalid @enderror" value="{{ old('tgl_checkin') }}" type="date" name="tgl_checkin" id="tglCheckIn" placeholder="YYYY-MM-DD">
                                    @error('tgl_checkin')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckOu">Tanggal Check Out</label>
                                    <input class="form-control @error('tgl_checkin') is-invalid @enderror" value="{{ old('tgl_checkout') }}" type="date" name="tgl_checkout" id="tglCheckOut" placeholder="YYYY-MM-DD">
                                    @error('tgl_checkout')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                                    <input class="form-control @error('jumlah_orang') is-invalid @enderror" value="{{ old('jumlah_orang') }}" type="number" id="jumlahOrang" name="jumlah_orang" placeholder="0">
                                    @error('jumlah_orang')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="jumlahRuangan" class="form-label">Jumlah Kamar</label>
                                    <input class="form-control @error('jumlah_ruangan') is-invalid @enderror" type="number" id="jumlahRuangan" name="jumlah_ruangan" placeholder="0">
                                    @error('jumlah_ruangan')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Keterangan</label>
                            <textarea id="fasilitas" value="{{ old('keterangan') }}" name="keterangan" class="form-control" rows="5"></textarea>
                        </div><br>

                        <button type="reset" class="btn btn-danger waves-effect waves-light" onclick="kembali()"><b>Batal</b></button>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#simpan"><b>Simpan</b></button>
                        <div class="modal fade" id="simpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="simpanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-primary">
                                    <div class="modal-header bg-gradient bg-primary">
                                        <h5 class="modal-title text-white" id="simpanLabel">Peringatan!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <br>
                                        <p align="center"><b>Simpan Data Check In?</b></p>
                                        <div align="right">
                                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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