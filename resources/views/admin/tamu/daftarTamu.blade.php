@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="mb-sm-0">Daftar Tamu</h2>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Daftar Tamu</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-body">
                    <h6>Filter Tanggal</h6>
                    <input type="date" id="date" name="start_date" value="{{request('start_date')}}">
                    {{-- <input type="date" id="date" name="tanggal_masuk" value="{{ now()->format('Y-m-d') }}" hidden> --}}
                    <button class="btn btn-primary " type="submit" style="margin-left:5px; width:80px; height:30px;padding:0px">Cari Data</button>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    <th style="width: 1%;text-align: center;">Nomor Kamar</th>
                                    <th style="width: 20%;text-align: center;">Nama Tamu</th>
                                    <th style="width: 20%;text-align: center;">Tanggal Check In</th>
                                    <th style="width: 20%;text-align: center;">Tanggal Check Out</th>
                                    <th style="width: 30%;text-align: center;">Instansi</th>
                                    <th style="width: 9%;text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td>101</td>
                                    <td>Raidhatul</td>
                                    <td>4 Juli 2024</td>
                                    <td>5 Juli 2024</td>
                                    <td>Umum</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect waves-light p-1" href="{{ url('/tamu/detail') }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-file font-size-16 align-middle"></i>
                                        </a>
                                        <a type="button" class="btn btn-danger waves-effect waves-light p-1" href="{{ url('/tamu/checkout') }}">Check Out</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table responsive -->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection