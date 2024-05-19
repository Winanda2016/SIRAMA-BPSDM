@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/tambah-reservasi') }}">Tambah Reservasi</a></li>
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
                    <h4 align="center">Formulir Tambah Reservasi</h4>
                    <hr>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Tamu</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option>umum</option>
                            <option>Dinas kota</option>
                            <option>Dinas provinsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama Instansi</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        <div class="text-muted" style="font-size: 11px;">*Jika umum silahkan dikosongkan</div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="formrow-email-input">Tanggal Reservasi</label>
                        <input class="form-control" type="date" value="2019-08-19" id="example-date-input" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-email-input">Tanggal Check In</label>
                                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-password-input">Tanggal Check Out</label>
                                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Jumlah Orang</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        <div class="text-muted" style="font-size: 11px;">*hitung berdasarkan kebutuhan tempat tidur</div>
                    </div>
                    <div class="mb-3">
                        <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">Nomor Kamar</label>
                        <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                            <option value="Choice 1" selected>Choice 1</option>
                            <option value="Choice 2">Choice 2</option>
                            <option value="Choice 3">Choice 3</option>
                            <option value="Choice 4">Choice 4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Keterangan</label>
                        <textarea id="fasilitas" name="keterangan" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-email-input">Jumlah Hari</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-password-input">Total Bayar</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
                            </div>
                        </div>
                    </div><br>

                    <a type="reset" class="btn btn-danger waves-effect waves-light" onclick="kembali()"><b>Batal</b></a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#simpan"><b>Simpan</b></button>
                    <div class="modal fade" id="simpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="simpanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="simpanLabel">Peringatan!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin akan menyimpan data yang telah diubah sebelumnya?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

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