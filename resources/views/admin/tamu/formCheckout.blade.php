@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Check Out</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/daftar-tamu') }}">Daftar Tamu</a></li>
                        <li class="breadcrumb-item active">Form Check Out</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <div class="mb-4">
                                    <img src="{{ asset('admin/assets/images/users/avatar-9.jpg') }}" alt="" height="24"><span class="logo-txt">Raidhatul</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="mb-4">
                                    <h4 class="float-end font-size-16">K1004</h4>
                                </div>
                            </div>
                        </div>

                        <p class="mb-1">Umum</p>
                        <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> raidhatul@gmail.com</p>
                        <p><i class="mdi mdi-phone align-middle me-1"></i> 082258877654</p>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <h5 class="font-size-15 mb-3">Reservasi:</h5>
                                <h5 class="font-size-14 mb-2">Raidhatul</h5>
                                <p class="mb-1">Umum</p>
                                <p class="mb-1">082258877654</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Tanggal Reservasi:</h5>
                                    <p>03 Juli 2024</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check in:</h5>
                                    <p>04 Juli 2024</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check out:</h5>
                                    <p>05 Juli 2024</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Jumlah Orang:</h5>
                                    <p>2 Orang</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Nomor Kamar:</h5>
                                    <p>101</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Nama Gedung:</h5>
                                    <p>Gedung Utama</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-2">
                        <h5 class="font-size-15">Dokumen Reservasi :</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-pdf font-size-20 align-middle" style="color: red;"></i>
                            --
                        </a>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Ringkasan Reservasi</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Instansi</th>
                                        <th>Jumlah Orang</th>
                                        <th class="text-end" style="width: 120px;">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <h5 class="font-size-15 mb-1">Umum</h5>
                                            <p class="font-size-13 text-muted mb-0">Rp.75.000,00 / Orang</p>
                                        </td>
                                        <td>
                                            <h5 class="font-size-15 mb-1">2 orang</h5>
                                        </td>
                                        <td class="text-end">Rp.150.000,00</td>
                                    </tr>

                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">Sub Total</th>
                                        <td class="text-end">Rp.150.000,00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">
                                            Jumlah Hari</th>
                                        <td class="border-0 text-end">1 hari</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0">Rp.150.000,00</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="bx bxl-whatsapp font-size-20 align-middle"></i></a>
                            <a href="{{ url('/edit-reservasi') }}" class="btn btn-warning waves-effect waves-light me-1" title="edit"><i class="bx bx-edit-alt font-size-20 align-middle"></i></a>
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#checkin"><b>Check out</b></button>

                            <div class="modal fade" id="checkin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkinLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Peringatan Check In!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah yakin Check Out Reservasi atas nama Raidhatul?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ url('/riwayat-transaksi') }}" type="submit" class="btn btn-danger">Check Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-body">
                    <h4 align="center">Formulir Check Out</h4>
                    <hr>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Tamu</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option selected>umum</option>
                            <option>Dinas kota</option>
                            <option>Dinas provinsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama Instansi</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
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
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">Nomor Kamar</label>
                        <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                            <option value="Choice 1" selected>Choice 1</option>
                            <option value="Choice 2" selected>Choice 2</option>
                            <option value="Choice 4" selected>Choice 4</option>
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
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Bukti Bayar</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div><br>

                    <a type="reset" class="btn btn-secondary waves-effect waves-light" onclick="kembali()"><b>Batal</b></a>
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#checkout">Check Out</button>

                    <div class="modal fade" id="checkout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkoutLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="checkoutLabel">Peringatan Check Out!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" align="left">
                                    <p>Apakah yakin Check Out Tamu atas nama (..nama tamu..)?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Check Out</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> -->
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('choices-multiple-remove-button');
        const choices = new Choices(selectElement);
    });
</script>
@endsection