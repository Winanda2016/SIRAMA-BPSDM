<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\JInstansiController;
use App\Http\Controllers\kelolaUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\transaksiKamarController;
use App\Http\Controllers\transaksiRuanganController;
use App\Http\Controllers\tamuTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\CetakDokumenController;
use Illuminate\Support\Facades\Route;

// ========================================================================================================================
//== Cetak Faktur ==
Route::get('/transaksi/{id}/faktur/download', [CetakDokumenController::class, 'downloadFaktur'])
->name('transaksi.faktur.download');

Route::middleware('guest')->group(function () {

    Route::get('/', [DashboardController::class, 'indexTamu'])->name('Tdashboard');

    //== Tamu==
    Route::get('/tentang-kami', function () {return view('tamu.tentangKami');})
        ->name('Ptentang');

    //== Kamar Tamu ==
    Route::post('/cek-ketersediaan-kamar', [transaksiKamarController::class, 'cekKetersediaan'])
        ->name('cek-ketersediaan-kamar');
    Route::get('/kamar', [transaksiKamarController::class, 'index'])
        ->name('kamar_tamu');

    //== Ruangan Tamu ==
    Route::get('/ruangan', [transaksiRuanganController::class, 'index'])
        ->name('ruangan_tamu');
    Route::get('/ruangan/detail/{id}', [transaksiRuanganController::class, 'show'])
        ->name('detail_ruangan_tamu');
    Route::post('/cek-ketersediaan-ruangan/{id}', [transaksiRuanganController::class, 'cekKetersediaan'])
        ->name('cek_ketersediaan_ruangan');

    //== Kontak ==
    Route::get('/kontak', function () {return view('tamu.kontak');})
        ->name('Pkontak');

});


//== Admin ==
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin-dashboard', [DashboardController::class, 'indexAdmin']);

    //== Gedung ==
    Route::resource('/gedung', GedungController::class);

    //== Intansi ==
    Route::resource('/jinstansi', JInstansiController::class);

    //== Kamar ==
    Route::get('/kelola-kamar', [KamarController::class, 'index'])
        ->name('kelola_kamar');
    Route::get('/kelola-kamar/tambah-kamar', [KamarController::class, 'create']);
    Route::post('/kelola-kamar', [KamarController::class, 'store'])
        ->name('kelola_kamar2');
    Route::get('/kelola-kamar/edit/{id}', [KamarController::class, 'edit'])
        ->name('edit_kamar');
    Route::put('/kelola-kamar/update/{id}', [KamarController::class, 'update'])
        ->name('update_kamar');

    //== Ruangan ==
    Route::get('/kelola-ruangan', [RuanganController::class, 'index'])
        ->name('kelola_ruangan');
    Route::get('/kelola-ruangan/tambah-ruangan', [RuanganController::class, 'create'])
        ->name('tambah_ruangan');
    Route::post('/kelola-ruangan', [RuanganController::class, 'store']);
    Route::get('/kelola-ruangan/detail/{id}', [RuanganController::class, 'showDetail'])
        ->name('detail_ruangan');
    Route::get('/kelola-ruangan/edit/{id}', [RuanganController::class, 'edit'])
        ->name('edit_ruangan');
    Route::put('/kelola-ruangan/update/{id}', [RuanganController::class, 'update'])
        ->name('update_ruangan');

    //== Kelola Users ==
    Route::resource('/kelola-users', kelolaUserController::class);

    //== Komentar ==
    Route::resource('/komentar', KomentarController::class);

    //Laporan
    Route::get('/laporan/cetak-pdf', [CetakDokumenController::class, 'laporanPDF'])
        ->name('laporan_pdf');
    Route::get('/laporan/cetak-excel', [CetakDokumenController::class, 'laporanExcel'])
        ->name('laporan_excel');
});

// ========================================================================================================================
//== Pegawai ==
Route::middleware(['auth', 'role:pegawai'])->group(function () {

    Route::get('/pegawai-dashboard', [DashboardController::class, 'indexPegawai'])
        ->name('dashboard_pegawai');

    Route::get('/cek/kamar', [KamarController::class, 'cekKamar'])
        ->name('cek_kamar');
    Route::get('/cek/ruangan', [RuanganController::class, 'cekRuangan'])
        ->name('cek_ruangan');

    Route::get('/permintaan-reservasi', [TransaksiController::class, 'showPReservasi'])
        ->name('permintaan_reservasi')
        ->middleware('check.expired.transactions');
    Route::post('/tambah-kamar-transaksi/{jenis_transaksi}/{id}', [TransaksiController::class, 'tambahKamar'])
        ->name('tambah_kamar_transaksi');
    Route::delete('/hapus-kamar-transaksi/{jenis_transaksi}/{id}', [TransaksiController::class, 'hapusKamar'])
        ->name('hapus_kamar_transaksi');

    Route::get('/daftar-reservasi', [TransaksiController::class, 'showDReservasi'])
        ->name('daftar_reservasi')
        ->middleware('check.expired.transactions');
    Route::get('/tambah-reservasi/{jenis_transaksi}', [TransaksiController::class, 'createReservasi'])
        ->name('pegawai_reservasi.create');
    Route::post('/simpan-reservasi/{jenis_transaksi}', [TransaksiController::class, 'storeReservasi'])
        ->name('pegawai_reservasi.store');

    Route::get('/reservasi/kamar/edit/{id}', [transaksiKamarController::class, 'editReservasiPegawai'])
        ->name('pegawai_reservasiKamar.edit');
    Route::put('/update-reservasi/kamar/{id}', [transaksiKamarController::class, 'updateReservasiPegawai'])
        ->name('pegawai_reservasiKamar.update');

    Route::get('/reservasi/ruangan/edit/{id}', [transaksiRuanganController::class, 'editReservasiPegawai'])
        ->name('pegawai_reservasiRuangan.edit');
    Route::put('/update-reservasi/ruangan/{id}', [transaksiRuanganController::class, 'updateReservasiPegawai'])
        ->name('pegawai_reservasiRuangan.update');

    Route::put('/reservasi/tolak/{id}', [TransaksiController::class, 'tolakReservasi'])
        ->name('tolak_reservasi');
    Route::put('/reservasi/terima/{jenis_transaksi}/{id}', [TransaksiController::class, 'terimaReservasiRuangan'])
        ->name('terima_reservasiRuangan');
    Route::put('/reservasi/cancel/{id}', [TransaksiController::class, 'cancelReservasi'])
        ->name('cancel_reservasi');

    Route::put('/checkin/{jenis_transaksi}/{id}', [TransaksiController::class, 'CheckIn'])
        ->name('checkin');
    Route::put('/checkout/{jenis_transaksi}/{id}', [TransaksiController::class, 'CheckOut'])
        ->name('checkout');
    Route::put('/diskon/{jenis_transaksi}/{id}', [TransaksiController::class, 'diskon'])
        ->name('diskon_transaksi');

    Route::get('/checkin/kamar', [transaksiKamarController::class, 'createCheckIn'])
        ->name('kamar_checkin.create');
    Route::post('/checkin', [transaksiKamarController::class, 'storeCheckIn'])
        ->name('kamar_checkin_store');

    Route::put('/bukti-bayar/{jenis_transaksi}/{id}', [TransaksiController::class, 'tambahBuktiBayar'])
        ->name('bukti_bayar');
        Route::delete('/bukti-bayar/{jenis_transaksi}/{id}', [TransaksiController::class, 'hapusBuktiBayar'])
        ->name('hapus_bukti_bayar');

    //== Daftar Tamu ==
    Route::get('/daftar-tamu', [TransaksiController::class, 'daftarTamu'])
        ->name('daftar_tamu')
        ->middleware('check.expired.transactions');
});

// ========================================================================================================================
//== Admin & Pegawai ==
Route::middleware(['auth', 'role:admin,pegawai'])->group(function () {
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayatTransaksi'])
        ->name('riwayat_transaksi')
        ->middleware('check.expired.transactions');
    Route::get('/detail/{jenis_transaksi}/{id}', [TransaksiController::class, 'detailTransaksi'])
        ->name('detail_transaksi')
        ->middleware('check.expired.transactions');
    Route::get('/faktur/kirim-wa/{id}', [CetakDokumenController::class, 'fakturWhatsApp'])
        ->name('faktur_wa');
});

// ========================================================================================================================
//== Tamu ==
Route::middleware(['auth', 'role:tamu'])->group(function () {

    //Riwayat
    Route::get('/tamu/riwayat-transaksi', [tamuTransaksiController::class, 'riwayatTransaksi'])
        ->name('riwayat_tamu');
    Route::get('/riwayat-transaksi/detail/{jenis_transaksi}/{id}', [tamuTransaksiController::class, 'showDetailRiwayat'])
        ->name('detail_riwayat');
    Route::put('/tamu/reservasi/cancel/{id}', [tamuTransaksiController::class, 'cancelReservasiTamu'])
        ->name('cancel_reservasi_tamu');
    Route::put('/reservasi/bukti-bayar/{jenis_transaksi}/{id}', [tamuTransaksiController::class, 'tambahBuktiBayar'])
        ->name('tambah_bbayar');

    //Kamar
    Route::get('/kamar/form-reservasi', [transaksiKamarController::class, 'create'])
        ->name('reservasi_kamar.create');
    Route::post('/kamar', [transaksiKamarController::class, 'store'])
        ->name('store_RKamar');
    Route::get('/kamar/reservasi/edit/{id}', [transaksiKamarController::class, 'edit'])
        ->name('edit_RKamar');
    Route::put('/kamar/update-reservasi/{id}', [transaksiKamarController::class, 'update'])
        ->name('reservasi_kamar.update');

    //Ruangan
    Route::get('/ruangan/form-reservasi/{id}', [transaksiRuanganController::class, 'create'])
        ->name('reservasi_ruangan');
    Route::post('/ruangan', [transaksiRuanganController::class, 'store'])
        ->name('store_ruangan_tamu');
    Route::get('/ruangan/reservasi/edit/{id}', [transaksiRuanganController::class, 'edit'])
        ->name('edit_RRuangan');
    Route::put('/ruangan/update-reservasi/{id}', [transaksiRuanganController::class, 'update'])
        ->name('reservasi_ruangan.update');

    Route::post('/komentar/tambah', [KomentarController::class, 'storeKomentar'])
        ->name('komentar.store');
});

require __DIR__ . '/auth.php';
