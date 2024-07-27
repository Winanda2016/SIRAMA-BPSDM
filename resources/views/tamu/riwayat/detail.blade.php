@extends('tamu.themes.app')
@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Transaksi</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/riwayat-transaksi') }}">Riwayat Transaksi</a>
                        <span>Detail Transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="card p-4">
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
                    <div class="room-booking">
                        <div class="reservationForm">
                            <h3>Detail Transaksi</h3>
                            <hr>
                            @if ($jenis_transaksi === 'kamar')
                            <div class="text-input">
                                <label for="instansi">Instansi:</label>
                                <input type="text" id="namaInstansi" name="instansi" value="{{ $data->instansi }}" readonly>
                            </div>
                            @elseif ($jenis_transaksi === 'ruangan')
                            <div class="text-input">
                                <label for="nama_ruangan">Nama Ruangan:</label>
                                <input type="text" id="namRuangan" name="nama_ruangan" value="{{ $data->nama_ruangan }}" readonly>
                            </div>
                            @endif
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" value="{{ $data->nama }}" readonly>
                            </div>
                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" name="nama_instansi" value="{{ $data->nama_instansi }}" readonly>
                            </div>
                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" name="nohp" value="{{ $data->nohp }}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="tglCheckIn">Check In:</label>
                                        <input type="date" name="tgl_checkin" id="tglCheckIn" value="{{ $data->tgl_checkin }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="tglCheckOut">Check Out:</label>
                                        <input type="date" name="tgl_checkout" id="tglCheckOut" value="{{ $data->tgl_checkout }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="jumlahOrang">Jumlah Orang:</label>
                                        <input type="number" id="jumlahOrang" name="jumlah_orang" value="{{ $data->jumlah_orang }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="totalHari">Total hari:</label>
                                        <input type="number" id="totalHari" name="total_hari" value="{{ $total_hari }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-input" style="width: 40%;">
                                <label for="totalHarga">Total harga:</label>
                                <input type="text" id="totalHarga" name="total_harga" value="Rp. {{ $data->total_harga }}" readonly>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen">Bukti Pembayaran:</label>
                                @if($data->bukti_bayar)
                                @php
                                $filePath = asset($data->bukti_bayar);
                                $fileName = basename($data->bukti_bayar);
                                @endphp
                                <a href="{{ $filePath }}" download="{{ $fileName }}" style="font: 12px;">{{ $fileName }}</a>
                                @else
                                <span class="text-danger"><u>bukti bayar tidak tersedia.</u></span>
                                @endif
                            </div>
                            @if ($data->status_transaksi === 'pending')
                            <div class="button-container">
                                @if ($jenis_transaksi === 'kamar')
                                <a href="{{ route('edit_RKamar', $data->detail_id) }}" class="BWarning">Edit</a>
                                @elseif ($jenis_transaksi === 'ruangan')
                                <a href="{{ route('edit_RRuangan', ['id' => $data->detail_id]) }}" class="BWarning">Edit</a>
                                @endif
                                <!-- Tombol Batalkan -->
                                <button type="button" class="BDanger" data-toggle="modal" data-target="#cancelModal">
                                    Batalkan
                                </button>

                                <!-- Modal Konfirmasi -->
                                <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel">Konfirmasi Pembatalan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin membatalkan reservasi ini?
                                                <form id="cancelForm" action="{{ route('cancel_reservasi', ['id' => $data->detail_id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="button-container">
                                                        <button type="button" class="BSecondary" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="BDanger">Iya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('/riwayat-transaksi') }}" class="BSecondary">Kembali</a>
                            </div>
                            @else
                            <hr>
                            <div class="button-container">
                                <a href="" title="hubungi admin">
                                    <svg fill="#36aa51" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="42" height="42">
                                        <path d="M92.1 254.6c0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6L152 365.2l4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8c0-35.2-15.2-68.3-40.1-93.2c-25-25-58-38.7-93.2-38.7c-72.7 0-131.8 59.1-131.9 131.8zM274.8 330c-12.6 1.9-22.4 .9-47.5-9.9c-36.8-15.9-61.8-51.5-66.9-58.7c-.4-.6-.7-.9-.8-1.1c-2-2.6-16.2-21.5-16.2-41c0-18.4 9-27.9 13.2-32.3c.3-.3 .5-.5 .7-.8c3.6-4 7.9-5 10.6-5c2.6 0 5.3 0 7.6 .1c.3 0 .5 0 .8 0c2.3 0 5.2 0 8.1 6.8c1.2 2.9 3 7.3 4.9 11.8c3.3 8 6.7 16.3 7.3 17.6c1 2 1.7 4.3 .3 6.9c-3.4 6.8-6.9 10.4-9.3 13c-3.1 3.2-4.5 4.7-2.3 8.6c15.3 26.3 30.6 35.4 53.9 47.1c4 2 6.3 1.7 8.6-1c2.3-2.6 9.9-11.6 12.5-15.5c2.6-4 5.3-3.3 8.9-2s23.1 10.9 27.1 12.9c.8 .4 1.5 .7 2.1 1c2.8 1.4 4.7 2.3 5.5 3.6c.9 1.9 .9 9.9-2.4 19.1c-3.3 9.3-19.1 17.7-26.7 18.8zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM148.1 393.9L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5c29.9 30 47.9 69.8 47.9 112.2c0 87.4-72.7 158.5-160.1 158.5c-26.6 0-52.7-6.7-75.8-19.3z" />
                                    </svg>
                                </a>
                                @if (!empty($data->bukti_bayar))
                                <a href="" class="BPrimary p-2" title="cetak faktur" style="width: fit-content;">
                                    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                                        <path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                    </svg>
                                    <span style="margin-left: 5px;">Faktur</span>
                                </a>
                                @elseif ($data->status_transaksi === 'checkout')
                                <button type="button" class="BPrimary p-2" data-toggle="modal" data-target="#bbayarModal" title="tambah bukti bayar" style="width: fit-content;">
                                    Bukti Bayar
                                </button>
                                <!-- Modal Konfirmasi -->
                                <div class="modal fade" id="bbayarModal" tabindex="-1" role="dialog" aria-labelledby="bbayarModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bbayarModalLabel">Tambah Bukti Bayar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="bbayarForm" action="{{ route('tambah_bbayar', ['id' => $data->detail_id]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="dokumen">
                                                        <label for="bbayar">Bukti Bayar:</label>
                                                        <input type="file" class="form-control" id="bbayar" name="bukti_bayar">
                                                        <span>*file foto berupa JPEG/PNG/JPG/dan sebagainya. </span>
                                                    </div>
                                                    <div class="button-container">
                                                        <button type="button" class="BSecondary" data-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="BDanger">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <a href="{{ url('/riwayat-transaksi') }}" class="BSecondary">Kembali</a>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <h4>Keterangan :</h4>
                <p>
                    1. Edit dan Hapus reservasi hanya dapat dilakukan selama reservasi masih dalam status "pending
                </p>
            </div>
        </div>
    </div>
</section>
@endsection