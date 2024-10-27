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
                    <h4 align="center">Formulir Tambah Reservasi <br> ( {{ $jenis_transaksi }} )</h4>
                    <hr>
                    <form method="POST" action="{{ route('pegawai_reservasi.store', ['jenis_transaksi' => $jenis_transaksi]) }}" enctype="multipart/form-data" id="reservationForm">
                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="{{ $jenis_transaksi }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglReservasi">Tanggal Reservasi</label>
                                    <input class="form-control" type="date" id="tglReservasi" name="tgl_reservasi" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if ( $jenis_transaksi == 'ruangan')
                                <div class="mb-3">
                                    <label class="form-label">Ruangan</label>
                                    <select class="form-select" name="ruangan_id">
                                        @foreach ($ruangan as $r)
                                        <option value="{{ $r->id }}" data-price="{{ $r->harga }}">{{ $r->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="noHP" class="form-label">Nomor HP</label>
                                    <input class="form-control @error('nohp') is-invalid @enderror" type="text" id="noHP" name="nohp" value="{{ old('nohp') }}" placeholder="08...">
                                    @error('nohp')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Instansi</label>
                                    <select class="form-select" name="jinstansi_id">
                                        @foreach ($jinstansi as $in)
                                        @if (old('jinstansi_id') == $in->id)
                                        <option value="{{ $in->id }}" data-price="{{ $in->harga }}" selected>{{ $in->nama_instansi }}</option>
                                        @else
                                        <option value="{{ $in->id }}" data-price="{{ $in->harga }}">{{ $in->nama_instansi }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('jinstansi_id')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaInstansi" class="form-label">Nama Instansi</label>
                                    <input class="form-control @error('nama_instansi') is-invalid @enderror" value="{{ old('nama_instansi') }}" type="text" id="namaInstansi" name="nama_instansi">
                                    @error('nama_instansi')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                    <div class="text-muted" style="font-size: 11px;">*Jika umum isikan 'umum'</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckIn">Tanggal Check In</label>
                                    <input class="form-control @error('tgl_checkin') is-invalid @enderror" value="{{ old('tgl_checkin') }}" type="date" name="tgl_checkin" id="tglCheckIn" placeholder="YYYY-MM-DD">
                                    @error('tgl_checkin')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tglCheckOu">Tanggal Check Out</label>
                                    <input class="form-control @error('tgl_checkin') is-invalid @enderror" value="{{ old('tgl_checkout') }}" type="date" name="tgl_checkout" id="tglCheckOut" placeholder="YYYY-MM-DD">
                                    @error('tgl_checkout')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                                    <input class="form-control @error('jumlah_orang') is-invalid @enderror" value="{{ old('jumlah_orang') }}" type="number" id="jumlahOrang" name="jumlah_orang" placeholder="0">
                                    @error('jumlah_orang')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                @if ( $jenis_transaksi == 'kamar')
                                <div class="mb-3">
                                    <label for="jumlahRuangan" class="form-label">Jumlah Kamar</label>
                                    <input class="form-control @error('jumlah_ruangan') is-invalid @enderror" type="number" id="jumlahRuangan" name="jumlah_ruangan" placeholder="0">
                                    @error('jumlah_ruangan')
                                    <p class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dokumenReservasi" class="form-label">Dokumen Reservasi</label>
                                    <input type="file" class="form-control" id="dokumenReservasi" name="dokumen_reservasi">
                                    <div class="text-muted" style="font-size: 11px;">*dokumen berupa PDF/DOC/DOCS, ukuran file maksimal 2 mb</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Keterangan</label>
                            <textarea id="fasilitas" value="{{ old('keterangan') }}" name="keterangan" class="form-control" rows="5"></textarea>
                        </div><br>

                        <a type="reset" class="btn btn-danger waves-effect waves-light" onclick="kembali()"><b>Batal</b></a>
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><b>Simpan</b></button>
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