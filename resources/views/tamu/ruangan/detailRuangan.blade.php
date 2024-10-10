@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Ruangan</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/ruangan') }}">Ruangan</a>
                        <span>Detail Ruangan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <div class="card p-2 mb-4" style=" width: 100%; height: 400px; overflow: hidden; display: flex; flex-direction: column;">
                        @if ($ruangan->foto)
                        <img src="{{ asset($ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}" style="height: 100%; width: 100%; object-fit: cover;">
                        @else
                        <img src="{{ asset('tamu/assets/img/ruangan/no_image.jpg') }}" alt="Default Image" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{ $ruangan->nama_ruangan }}</h3>
                        </div>
                        <h2>RP. {{ $ruangan->formatted_harga}}<span>/ Hari</span></h2>
                        <table style="font-size: 16px;">
                            <tbody>
                                <tr>
                                    <td class="r-o">Kapasitas</td>
                                    <td>: {{ $ruangan->kapasitas }} Orang</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Fasilitas:</td>
                                    <td>: {!! nl2br(e($ruangan->fasilitas)) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>

                <h4 class="my-4">Keterangan</h4>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah bed single</p>
                <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
                <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
                <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
                <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                    untuk anda menempati kamar yang sama dengan orang lain</p>
            </div>
            <div class="col-lg-4">
                <div class="card" style="padding: 44px 10px 50px 10px;">
                    <div class="room-booking">
                        <h4>Cek Ketersediaan Kamar</h4>
                        <hr>
                        <form action="{{ route('cek_ketersediaan_ruangan', ['id' => $ruangan->id]) }}" method="POST" id="cek-ketersediaan-form">
                            @csrf
                            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}"> <!-- Tambahkan ini -->
                            <div class="tanggal">
                                <label for="date-in">Check In:</label>
                                <input type="date" id="date-in" name="cek_tgl_checkin" placeholder="YYYY-MM-DD" required>
                            </div>
                            <div class="tanggal">
                                <label for="date-out">Check Out:</label>
                                <input type="date" id="date-out" name="cek_tgl_checkout" placeholder="YYYY-MM-DD" required>
                            </div>
                            <button type="submit" class="cek-ketersediaan">Cek Ketersediaan</button><br>
                            <h6 align="center" id="hasil-cek-ketersediaan"></h6>
                        </form><br>
                        <div class="rdt-right">
                            <button id="btn-reservasi">Reservasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Room Details Section End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cek-ketersediaan-form').on('submit', function(event) {
            event.preventDefault(); // Mencegah form dari pengiriman default

            var form = $(this);
            var formData = form.serialize();
            var ruanganId = form.find('input[name="ruangan_id"]').val(); // Ambil ID dari input tersembunyi
            var tglCheckin = $('#date-in').val();
            var tglCheckout = $('#date-out').val();

            
            // Simpan tanggal ke local storage
            localStorage.setItem('tglCheckin', tglCheckin);
            localStorage.setItem('tglCheckout', tglCheckout);

            $.ajax({
                url: "{{ route('cek_ketersediaan_ruangan', ':id') }}".replace(':id', ruanganId), // Gantikan :id dengan ID
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Menampilkan hasil di elemen <h6>
                    if (response.status === 'tersedia') {
                        $('#hasil-cek-ketersediaan').text('"Ruangan tersedia"');
                        $('#btn-reservasi').show();
                    } else {
                        $('#hasil-cek-ketersediaan').text('"Ruangan tidak tersedia"');
                        $('#btn-reservasi').hide();
                    }
                },
                error: function(xhr, status, error) {
                    $('#hasil-cek-ketersediaan').text('Terjadi kesalahan: ' + error);
                }
            });
        });

        // Sembunyikan tombol reservasi secara default
        $('#btn-reservasi').hide();

        // Klik tombol reservasi
        $('#btn-reservasi').on('click', function() {
            // Redirect ke halaman formulir reservasi
            window.location.href = '/ruangan/form-reservasi/{{ $ruangan->id }}';
        });
    });
</script>
@endsection