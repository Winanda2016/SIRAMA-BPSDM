@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Transaksi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/riwayat-transaksi') }}">Riwayat Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
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
                                    <img src="{{ asset('admin/assets/images/users/avatar-9.jpg') }}" alt="" height="24"><span class="logo-txt">(nama users)</span>
                                    <button type="button" class="btn btn-soft-success btn-rounded waves-effect waves-light" style="width:50px; height:17px; font-size:8px; padding:2px">Terima</button>
                                </div>
                            </div>
                        </div>

                        <p class="mb-1">(asal instansi users)</p>
                        <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> (email users)</p>
                        <p><i class="mdi mdi-phone align-middle me-1"></i> (nomor hp users)</p>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <h5 class="font-size-15 mb-3">Transaksi:</h5>
                                <h5 class="font-size-14 mb-2">(namatamu)</h5>
                                <p class="mb-1">(asal instansi)</p>
                                <p class="mb-1">(nomor hp)</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Tanggal Reservasi:</h5>
                                    <p>February 16, 2020 (tanggal reservasi)</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check in:</h5>
                                    <p>February 16, 2020 (tanggal check in)</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check out:</h5>
                                    <p>February 16, 2020 (tanggal check out)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Jumlah Orang:</h5>
                                    <p>3 orang (jumlah orang)</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Nomor Kamar:</h5>
                                    <p>103 (nomor kamar)</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Nama Gedung:</h5>
                                    <p>Tuan sakato (nama gedung)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-2">
                        <h5 class="font-size-15">Dokumen Reservasi :</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-pdf font-size-20 align-middle" style="color: red;"></i>
                            (nama dokumen reservasi || NULL).pdf
                        </a>
                    </div>

                    <div class="py-2">
                        <h5 class="font-size-15">Bukti Pembayaran:</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-jpg font-size-20 align-middle" style="color:mediumslateblue;"></i>
                            (bukti pembayaran || NULL).jpg
                        </a>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Ringkasan transaksi</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Jenis Tamu</th>
                                        <th>Jumlah Orang</th>
                                        <th class="text-end" style="width: 120px;">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <h5 class="font-size-15 mb-1">Umum</h5>
                                            <p class="font-size-13 text-muted mb-0">Rp.50.000,00 / Orang</p>
                                        </td>
                                        <td>
                                            <h5 class="font-size-15 mb-1">2 orang</h5>
                                        </td>
                                        <td class="text-end">Rp.100.000,00</td>
                                    </tr>

                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">Sub Total</th>
                                        <td class="text-end">Rp.100.000,00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">
                                            Jumlah Hari</th>
                                        <td class="border-0 text-end">2 hari</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0">Rp.200.000,00</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a type="button" class="btn btn-secondary waves-effect waves-light m-2" onclick="kembali()">Kembali</a>
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light m-2"><i class="bx bx-printer font-size-20 align-middle"></i></a>
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light m-2"><i class="bx bxl-whatsapp font-size-20 align-middle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection