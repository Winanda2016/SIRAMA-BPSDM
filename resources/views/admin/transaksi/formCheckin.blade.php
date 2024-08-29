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
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Instansi</label>
                            <select class="form-select" name="jinstansi_id">
                                @foreach ($jinstansi as $in)
                                <option value="{{ $in->id }}" data-price="{{ $in->harga }}">{{ $in->nama_instansi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="namaInstansi" class="form-label">Nama Instansi</label>
                            <input class="form-control" type="text" id="namaInstansi" name="nama_instansi">
                            <div class="text-muted" style="font-size: 11px;">*Jika umum isikan 'umum'</div>
                        </div>
                        <div class="mb-3">
                            <label for="noHP" class="form-label">Nomor HP</label>
                            <input class="form-control" type="text" id="noHP" name="nohp">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckIn">Tanggal Check In</label>
                                    <input class="form-control" type="date" name="tgl_checkin" id="tglCheckIn" placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckOu">Tanggal Check Out</label>
                                    <input class="form-control" type="date" name="tgl_checkout" id="tglCheckOut" placeholder="YYYY-MM-DD">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                                    <input class="form-control" type="number" id="jumlahOrang" name="jumlah_orang" placeholder="0">
                                    <div class="text-muted" style="font-size: 11px;">*hitung berdasarkan kebutuhan tempat tidur</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="jumlahKamar" class="form-label">Jumlah Kamar</label>
                                    <input class="form-control" type="number" id="jumlahKamar" name="jumlah_ruangan" placeholder="0">
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
                                    <div class="modal-body">
                                        <p>Kirim Formulir Transaksi?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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