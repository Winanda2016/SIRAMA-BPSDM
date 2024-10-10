@extends('admin.themes.app')
@php
$ar_judul = ['No','Jenis Transaksi','Nama','Instansi','Tanggal Check In','Tanggal Check Out','Total Bayar','Status','Aksi'];
$no = 1;
@endphp
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
                                @if( Auth::user()->role == 'admin')
                                <a href="{{ route('laporan_excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'jenis_transaksi' => request('jenis_transaksi'), 'status_transaksi' => request('status_transaksi', [])]) }}" class="btn btn-success waves-effect btn-label waves-light" style="margin-right: 10px;">
                                    <i class="mdi mdi-file-excel-outline label-icon"></i>
                                    Excel
                                </a>
                                <a href="{{ route('laporan_pdf', ['start_date' => request()->input('start_date'), 'end_date' => request()->input('end_date'), 'jenis_transaksi' => request()->input('jenis_transaksi'), 'status_transaksi' => request()->input('status_transaksi')]) }}" class="btn btn-danger waves-effect btn-label waves-light">
                                    <i class="bx bxs-file-pdf label-icon"></i>
                                    PDF
                                </a>
                                @endif
                                <!-- filter Data -->
                                <div class="btn-group dropend" style="margin: 5px;">
                                    <button type="button" class="btn btn-info waves-effect waves-light">
                                        Filter Data
                                    </button>
                                    <button type="button" class="btn btn-info waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-header noti-title">
                                            <h5 class="font-size-13 text-muted text-truncate mn-0"> filter berdasarkan:</h5>
                                        </div>
                                        <a href="{{ route('riwayat_transaksi') }}" class="dropdown-item" onclick="resetFilters()">
                                            Semua
                                        </a>
                                        <button type="button" class="dropdown-item" onclick="showFilter('filterTanggal')">
                                            Tanggal Check In - Check Out
                                        </button>
                                        <button type="button" class="dropdown-item" onclick="showFilter('filterJenisTransaksi')">
                                            Jenis Transaksi
                                        </button>
                                        <button type="button" class="dropdown-item" onclick="showFilter('filterStatusTransaksi')">
                                            Status Transaksi
                                        </button>
                                    </div>
                                </div>

                                <!-- filter berdasarkan jeni stransaksi -->
                                <div id="filterJenisTransaksi" class="btn-group dropend filter-data" style="margin: 5px; display: none;">
                                    <button type="button" class="btn btn-info waves-effect waves-light">
                                        Jenis Transaksi
                                    </button>
                                    <button type="button" class="btn btn-info waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('riwayat_transaksi', ['jenis_transaksi' => '']) }}">Semua</a>
                                        <a class="dropdown-item" href="{{ route('riwayat_transaksi', ['jenis_transaksi' => 'kamar']) }}">Kamar</a>
                                        <a class="dropdown-item" href="{{ route('riwayat_transaksi', ['jenis_transaksi' => 'ruangan']) }}">Ruangan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Filter berdasarkan tanggal checkin dan checkout -->
                    <div id="filterTanggal" class="filter-data mb-3" style="display: none; background-color: #f8f9fa; padding:10px;">
                        <h5>Fiter data berdasarkan Tanggal Check In dan Check Out</h5>
                        <form method="GET" action="{{ route('riwayat_transaksi') }}">
                            <div class="row mt-3">
                                <div class="col-sm-2">
                                    <label for="start_date" class="form-label mr-2">Tanggal Check In:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ request()->input('start_date') }}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="end_date" class="form-label mr-2">Tanggal Check Out:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ request()->input('end_date') }}">
                                </div>
                                <div class="col-sm-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light px-1 mt-2" style="width: 100px; height:28px;padding:0px">
                                        Filter Data
                                    </button>
                                </div>
                                <!-- <h6 class="mt-2" style="font-size: 11px;">Data hasil filter yang ditampilkan adalah data yang dibuat pada rentang tanggal yang di filter</h6> -->
                            </div>
                        </form>
                    </div>
                    <!-- End Filter -->

                    <!-- Filter berdasarkan sttaus transaksi -->
                    <div id="filterStatusTransaksi" class="filter-data mb-3" style="display: none; background-color: #f8f9fa; padding:10px;">
                        <h5>Fiter data berdasarkan Status Transaksi</h5>
                        <form method="GET" action="{{ route('riwayat_transaksi') }}">
                            <div class="row mt-3">
                                <div class="col-sm-2">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="pending" id="statusPending"
                                            {{ in_array('pending', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusPending">
                                            Pending
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="terima" id="statusTerima"
                                            {{ in_array('terima', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusTerima">
                                            Terima
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="tolak" id="statusTolak"
                                            {{ in_array('tolak', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusTolak">
                                            Tolak
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="batal" id="statusBatal"
                                            {{ in_array('batal', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusBatal">
                                            Batal
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="kadaluwarsa" id="statusKadaluwarsa"
                                            {{ in_array('kadaluwarsa', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusKadaluwarsa">
                                            Kadaluwarsa
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="checkin" id="statusCheckIn"
                                            {{ in_array('checkin', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusCheckIn">
                                            Check In
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="status_transaksi[]" value="checkout" id="statusCheckOut"
                                            {{ in_array('checkout', request()->input('status_transaksi', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusCheckOut">
                                            Check Out
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light px-1 mt-2" style="width: 100px; height:28px;padding:0px">
                                Filter Data
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    @foreach($ar_judul as $jdl)
                                    <th style="text-align: center;">{{ $jdl }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach($transaksi as $t)
                                <tr style="text-transform: capitalize;">
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    @if ($t->jenis_transaksi === 'ruangan')
                                    <td>Ruangan</td>
                                    @elseif ($t->jenis_transaksi === 'kamar')
                                    <td>Kamar</td>
                                    @endif
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->nama_instansi }}</td>
                                    <td>{{ $t->tgl_checkin }}</td>
                                    <td>{{ $t->tgl_checkout }}</td>
                                    <td>{{ $t->total_harga }}</td>
                                    <td>
                                        @if ($t->status_transaksi === 'pending')
                                        <div class="badge badge-soft-secondary font-size-12">pending</div>
                                        @elseif ($t->status_transaksi === 'checkin')
                                        <div class="badge badge-soft-info font-size-12">check in</div>
                                        @elseif ($t->status_transaksi === 'checkout')
                                        <div class="badge badge-soft-danger font-size-12">check out</div>
                                        @elseif ($t->status_transaksi === 'terima')
                                        <div class="badge badge-soft-success font-size-12">terima</div>
                                        @elseif ($t->status_transaksi === 'tolak')
                                        <div class="badge badge-soft-danger font-size-12">tolak</div>
                                        @elseif ($t->status_transaksi === 'batal')
                                        <div class="badge badge-soft-danger font-size-12">cancel</div>
                                        @elseif ($t->status_transaksi === 'kadaluwarsa')
                                        <div class="badge badge-soft-primary font-size-12">kadaluwarsa</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ route('detail_transaksi', ['jenis_transaksi' => $t->jenis_transaksi, 'id' => $t->transaksi_id]) }}">
                                            <i class="bx bx-file label-icon"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showFilter(filterId) {
        // Sembunyikan semua form filter
        $('.filter-data').hide();

        // Jika filterId bukan 'semua', tampilkan filter yang dipilih
        if (filterId !== 'semua') {
            $('#' + filterId).show();
            localStorage.setItem('activeFilter', filterId);
        }
    }

    function resetFilters() {
        // Sembunyikan semua form filter
        $('.filter-data').hide();

        // Hapus filter dari localStorage agar tidak ada filter yang aktif saat reload
        localStorage.removeItem('activeFilter');
    }

    // Tampilkan filter yang terakhir digunakan dari localStorage
    $(document).ready(function() {
        let activeFilter = localStorage.getItem('activeFilter');

        // Tampilkan filter jika ada filter yang tersimpan
        if (activeFilter) {
            showFilter(activeFilter);
        }
    });
</script>
@endsection