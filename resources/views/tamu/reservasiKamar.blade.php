@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Reservasi Kamar</h2>
                    <div class="bt-option">
                        <a href="{{ url('/tamu-dashboard') }}">Halaman Utama</a>
                        <a href="{{ url('/kamar') }}">Kamar</a>
                        <span>Reservasi</span>
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
                    <div class="room-booking">
                        <h3>Formulir Reservasi</h3>
                        <hr>
                        <form action="#" id="reservationForm">
                            <div class="text-input">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" placeholder="masukkan nama anda">
                            </div>
                            <div class="select-option">
                                <label for="instansi">Instansi:</label>
                                <select id="instansi">
                                    <option value="">Umum</option>
                                    <option value="">Pemerintahan Provinsi</option>
                                </select>
                            </div>
                            <div class="text-input">
                                <label for="namaInstansi">Nama Instansi:</label>
                                <input type="text" id="namaInstansi" placeholder="masukkan nama Instansi anda">
                            </div>
                            <div class="text-input">
                                <label for="noHP">Nomor HP:</label>
                                <input type="text" id="noHP" placeholder="08...">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="date-in">Check In:</label>
                                        <input type="text" class="date-input" id="date-in">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="check-date">
                                        <label for="date-out">Check Out:</label>
                                        <input type="text" class="date-input" id="date-out">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="numberPeople">Jumlah Orang:</label>
                                        <input type="number" id="numberPeople" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-input">
                                        <label for="totalDays">Total hari:</label>
                                        <input type="number" id="totalDays" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="text-input" style="width: 60%;">
                                <label for="totalPrice">Total harga:</label>
                                <input type="text" id="totalPrice" placeholder="0" disabled>
                            </div>
                            <div class="dokumen">
                                <label for="dokumen">Dokumen:</label>
                                <input type="file" class="form-control" id="dokumen" name="dokumen">
                                <p>*Masukkan Dokumen Permintaan Reservasi Jika Ada</p>
                            </div>
                            <div class="button-container">
                                <button type="submit" class="reservasi">Reservasi</button>
                                <button type="reset" class="batal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="description" class="col-lg-6 mx-3">
                <h3 class="my-3"><b>Keterangan</b></h3>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah bed singel</p>
                <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
                <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
                <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
                <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                    untuk anda menempati kamar yang sama dengan orang lain</p>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('date-in');
        const checkOutInput = document.getElementById('date-out');
        const numberPeopleInput = document.getElementById('numberPeople');
        const totalDaysInput = document.getElementById('totalDays');
        const totalPriceInput = document.getElementById('totalPrice');

        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function calculateDaysAndPrice() {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(checkOutInput.value);
            const numberOfPeople = numberPeopleInput.value;

            if (checkInDate && checkOutDate && numberOfPeople) {
                const timeDifference = checkOutDate - checkInDate;
                const daysDifference = timeDifference / (1000 * 3600 * 24);

                if (daysDifference > 0) {
                    totalDaysInput.value = daysDifference;
                    const totalPrice = daysDifference * numberOfPeople * 100; // Replace 100 with your price per day per person
                    totalPriceInput.value = formatNumberWithCommas(totalPrice);
                } else {
                    totalDaysInput.value = 0;
                    totalPriceInput.value = 0;
                }
            }
        }

        checkInInput.addEventListener('change', calculateDaysAndPrice);
        checkOutInput.addEventListener('change', calculateDaysAndPrice);
        numberPeopleInput.addEventListener('input', calculateDaysAndPrice);
    });
</script>

@endsection