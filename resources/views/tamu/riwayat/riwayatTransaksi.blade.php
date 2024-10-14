@extends('tamu.themes.app')
@php
$ar_judul = ['No','Nama','Jenis Transaksi','Tanggal Reservasi','Tanggal Check In','Tanggal Check Out','Total Harga','Status','Aksi'];
$no = 1;
@endphp
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Riwayat Transaksi</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <span>Riwayat Transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<section class="room-details-section spad">
    <div class="container">
        <div class="room-details-item">
            <div class="rd-text">
                <div class="card p-4">
                    <div>
                        @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable dt-responsive table-check nowrap" style="width: 100%;">
                            <thead>
                                @foreach($ar_judul as $jdl)
                                <td>{{ $jdl }}</td>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach($transaksi as $t)
                                <tr align="center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->jenis_transaksi }}</td>
                                    <td>{{ $t->tgl_reservasi }}</td>
                                    <td>{{ $t->tgl_checkin }}</td>
                                    <td>{{ $t->tgl_checkout }}</td>
                                    <td>{{ $t->formatted_harga }}</td>
                                    <td>
                                        @if ($t->status === 'pending')
                                        <span style="background-color: #b1b1b1;color: #e5e5e5;font-size:12px;">Pending</span>
                                        @elseif ($t->status === 'terima')
                                        <span style="background-color: #28a745;color: #ffffff;font-size:12px;">diterima</span>
                                        @elseif ($t->status === 'tolak')
                                        <span style="background-color: #fd625e;color: #ffffff;font-size:12px;">ditolak</span>
                                        @elseif ($t->status === 'batal')
                                        <span style="background-color: #fd625e;color: #ffffff;font-size:12px;">cancel</span>
                                        @elseif ($t->status === 'kadaluwarsa')
                                        <span style="background-color: #4c5c7e;color: #ffffff;font-size:12px;">kadaluwarsa</span>
                                        @elseif ($t->status === 'checkin')
                                        <span style="background-color: #17a2b8;color: #ffffff;font-size:12px;">Berlangsung</span>
                                        @elseif ($t->status === 'checkout')
                                        <span style="background-color: #4c5c7e;color: #ffffff;font-size:12px;">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('detail_riwayat', ['jenis_transaksi' => $t->jenis_transaksi, 'id' => $t->transaksi_id]) }}">
                                            <span style="background-color: #4c5c7e;color: #ffffff;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16">
                                                    <path fill="#ffffff" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                                </svg>
                                                detail
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection