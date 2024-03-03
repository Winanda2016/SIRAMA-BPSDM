@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/daftar-reservasi') }}">Daftar Reservasi</a></li>
                        <li class="breadcrumb-item active">List Daftar Reservasi</li>
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

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="bg-transparent">
                                    <th style="width: 120px;">ID Reservasi</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Nama</th>
                                    <th>Instansi</th>
                                    <th>Tanggal Check In</th>
                                    <th>Tanggal Check Out</th>
                                    <th>Status</th>
                                    <th style="width: 90px;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">#MN0215</a> </td>
                                    <td> 12 Oct, 2020 </td>
                                    <td>Connie Franco</td>
                                    <td>Umum</td>
                                    <td> 12 Oct, 2020 </td>
                                    <td> 12 Oct, 2020 </td>
                                    <td>
                                        <div class="badge badge-soft-success font-size-12">Terima</div>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect waves-light p-1" href="{{ url('/detail-reservasi') }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-file font-size-16 align-middle"></i>
                                        </a>
                                        <a type="button" href="{{ url('/form-checkin') }}" class="btn btn-info waves-effect waves-light p-1">Check In</a>
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