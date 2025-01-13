@extends('tamu.themes.app')
@php
$ar_judul = ['No','Jenis Instansi','Harga'];
$no = 1;
@endphp
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Kamar</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <span>Kamar</span>
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
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style=" height: 100%;">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox" style="height: 100%; display: flex;">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid w-100" src="{{ asset('tamu/assets/img/kamar/kamar-1.jpg') }}" alt="First slide" style="height: 100%; width: 100%; object-fit: cover;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid w-100" src="{{ asset('tamu/assets/img/kamar/kamar-2.jpg') }}" alt="Second slide" style="height: 100%; width: 100%; object-fit: cover;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid w-100" src="{{ asset('tamu/assets/img/kamar/kamar-3.jpg') }}" alt="Third slide" style="height: 100%; width: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div><!-- end carousel -->
                    </div>
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3><b>Asrama BPSDM Prov.Sumbar</b></h3>
                        </div><br>
                        <p>Berikut merupakan list harga penyewaan kamar asrama permalam</p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive table-check nowrap">
                                <thead>
                                    @foreach($ar_judul as $jdl)
                                    <td>{{ $jdl }}</td>
                                    @endforeach
                                </thead>
                                <tbody>
                                    @foreach($jinstansi as $jt)
                                    <tr>
                                        <td align="center" style="width: 10%;">{{ $no++ }}</td>
                                        <td style="width: 60%;">{{ $jt->nama_instansi }}</td>
                                        <td style="width: 30%;">Rp. {{ $jt->formatted_harga }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <h4 class="my-3">Deskripsi</h4>
                        <table>
                            <tbody style="width: 70%;color:#707079">
                                <tr>
                                    <td>Kapasitas</td>
                                    <td> : </td>
                                    <td>2 sampai 3 Orang Dewasa</td>
                                </tr>
                                <tr>
                                    <td>Fasilitas</td>
                                    <td> : </td>
                                    <td>2 atau 3 Tempat tidur (Single Bed), AC, TV, Water heater</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>

                        <h4 class="my-3">Catatan Reservasi</h4>
                        <p class="f-para" align="justify">Untuk melakukan reservasi, 
                            silakan cek terlebih dahulu ketersediaan kamar sesuai dengan tanggal yang diinginkan. 
                            Jika kamar tersedia, tombol "Reservasi" akan muncul. Klik tombol tersebut untuk melanjutkan dan mengisi 
                            formulir reservasi.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" style="padding: 20px 10px 20px 10px;">
                    <div class="room-booking">
                        <h4>Cek Ketersediaan Kamar</h4>
                        <hr>
                        <form action="{{ route('cek-ketersediaan-kamar') }}" method="POST" id="cek-ketersediaan-form">
                            @csrf
                            <div class="tanggal">
                                <label for="date-in">Check In:</label>
                                <input type="date" id="date-in" name="cek_tgl_checkin" placeholder="YYYY-MM-DD" required>
                            </div>
                            <div class="tanggal">
                                <label for="date-out">Check Out:</label>
                                <input type="date" id="date-out" name="cek_tgl_checkout" placeholder="YYYY-MM-DD" required>
                            </div>
                            <button type="submit" class="cek-ketersediaan">Cek Ketersediaan</button><br>
                            <h6 id="error-date" style="color: red; display: none; font-size:13px"></h6>
                            <h6 id="hasil-cek-ketersediaan"></h6>
                        </form><br>
                        <div class="rdt-right">
                            <button id="btn-reservasi">Reservasi</button>
                        </div>
                    </div>
                </div><br>
            </div>
        </div>

    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cek-ketersediaan-form').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var formData = form.serialize();
            var tglCheckin = $('#date-in').val();
            var tglCheckout = $('#date-out').val();
            var errorMessage = '';

            // Cek apakah tanggal check-in lebih kecil dari tanggal check-out
            if (new Date(tglCheckin) >= new Date(tglCheckout)) {
                errorMessage = '(Error) Kesalahan Inputan!<br>Tanggal Check-In harus "lebih kecil" dari Tanggal Check-Out!';
                $('#error-date').html(errorMessage).show();
                return;
            }

            // Cek apakah tanggal check-in dan check-out tidak lebih kecil dari hari ini
            var today = new Date();
            var checkinDate = new Date(tglCheckin);
            var checkoutDate = new Date(tglCheckout);

            if (checkinDate < today || checkoutDate < today) {
                errorMessage = '(Error) Kesalahan Inputan!<br>Tanggal tidak boleh lebih kecil dari hari ini!';
                $('#error-date').html(errorMessage).show();
                return;
            }

            // Hapus pesan error jika validasi berhasil
            $('#error-date').html('').hide();

            // Simpan tanggal ke local storage
            localStorage.setItem('tglCheckin', tglCheckin);
            localStorage.setItem('tglCheckout', tglCheckout);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#hasil-cek-ketersediaan').text('Jumlah kamar tersedia: ' + response.jumlah_kamar_tersedia);

                    // Tampilkan tombol reservasi jika ada kamar tersedia
                    if (response.jumlah_kamar_tersedia > 0) {
                        $('#btn-reservasi').show();
                    } else {
                        $('#btn-reservasi').hide();
                    }
                },
                error: function(xhr) {
                    $('#hasil-cek-ketersediaan').hide();
                    
                    $('#hasil-cek-ketersediaan').text('Terjadi kesalahan.');
                    $('#btn-reservasi').hide();
                }
            });
        });

        // Sembunyikan tombol reservasi secara default
        $('#btn-reservasi').hide();

        // Klik tombol reservasi
        $('#btn-reservasi').on('click', function() {
            // Redirect ke halaman formulir reservasi
            window.location.href = '/kamar/form-reservasi';
        });
    });
</script>

@endsection