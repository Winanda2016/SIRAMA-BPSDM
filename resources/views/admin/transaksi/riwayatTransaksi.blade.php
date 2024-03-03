@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="mb-sm-0">Riwayat Transaksi</h2>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Riwayat Transaksi</li>
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
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-4">
                                <button type="button" class="btn btn-success waves-effect btn-label waves-light" style="margin-right: 10px;">
                                    <i class="mdi mdi-file-excel-outline label-icon"></i>
                                    Excel
                                </button>
                                <button type="button" class="btn btn-danger waves-effect btn-label waves-light">
                                    <i class="bx bxs-file-pdf label-icon"></i>
                                    PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    <th style=" width: 1%;text-align: center;">No</th>
                                    <th style="text-align: center;">Tanggal Transaksi</th>
                                    <th style="text-align: center;">Nama Tamu</th>
                                    <th style="text-align: center;">Nomor Kamar</th>
                                    <th style="text-align: center;">Jumlah Tamu</th>
                                    <th style="text-align: center;">Jumlah Hari</th>
                                    <th style="text-align: center;">Total harga</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td>1</td>
                                    <td>5 Maret 2024</td>
                                    <td>Connie Franco</td>
                                    <td>101</td>
                                    <td>2 orang</td>
                                    <td>3 hari</td>
                                    <td>Rp. 250.000,00</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ url('#') }}">
                                            <i class="bx bx-file label-icon"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection