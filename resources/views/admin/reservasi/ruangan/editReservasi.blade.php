@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/daftar-reservasi') }}">Daftar Reservasi</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/detail-reservasi') }}">Detail Reservasi</a></li>
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
                    <h4 align="center">Formulir Reservasi</h4>
                    <hr>
                    <form method="POST" action="{{ route('admin_reservasiRuangan.update', ['id' => $data->transaksi_id]) }}" enctype="multipart/form-data" class="reservationForm">
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
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="noHP" class="form-label">Nomor Handphone</label>
                                    <input class="form-control" type="text" id="noHP" name="nohp" value="{{ $data->nohp }}">
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
                                    <input class="form-control" type="text" id="namaInstansi" name="nama_instansi" value="{{ $data->nama_instansi }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                                    <input class="form-control" type="number" id="jumlahOrang" name="jumlah_orang" value="{{ $data->jumlah_orang }}">
                                </div>
                            </div>
                        </div><br>

                        <a type="reset" class="btn btn-danger waves-effect waves-light" onclick="kembali()"><b>Batal</b></a>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#simpan"><b>Simpan</b></button>
                        <div class="modal fade" id="simpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="simpanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-primary">
                                    <div class="modal-header bg-gradient bg-primary">
                                        <h5 class="modal-title text-white" id="simpanLabel">Peringatan!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"><br>
                                        <p align="center">Yakin akan menyimpan data yang telah diubah sebelumnya?</p><br>
                                        <div align="right">
                                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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