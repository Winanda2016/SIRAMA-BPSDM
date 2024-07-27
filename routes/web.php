<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\kelolaUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\transaksiKamarController;
use App\Http\Controllers\transaksiRuanganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Instansi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'indexTamu'])->name('Tdashboard');

Route::get('/admin-dashboard', [DashboardController::class, 'indexAdmin']);

Route::get('/pegawai-dashboard', function () {
    return view('admin.dashboardPegawai');
});

// --------------------------------------------------------------------------------------------

//== RESERVASI ==







Route::get('/edit-reservasi', function () {
    return view('admin.reservasi.editReservasi');
});

Route::get('/tambah-reservasi', function () {
    return view('admin.reservasi.tambahReservasi');
});
// --------------------------------------------------------------------------------------------

//== TAMU ==
Route::get('/daftar-tamu', function () {
    return view('admin.tamu.daftarTamu');
});

Route::get('/tamu/detail', function () {
    return view('admin.tamu.detailTamu');
});

Route::get('/tamu/checkout', function () {
    return view('admin.tamu.formCheckout');
});
// --------------------------------------------------------------------------------------------

//== TRANSAKSI ==
Route::get('/form-checkin', function () {
    return view('admin.transaksi.formCheckin');
});

Route::get('/riwayat-transaksi', function () {
    return view('admin.transaksi.riwayatTransaksi');
});

Route::get('/detail-transaksi', function () {
    return view('admin.transaksi.detailTransaksi');
});
// --------------------------------------------------------------------------------------------
//== Admin & Pegawai ==
Route::middleware(['auth', 'role:admin,pegawai'])->group(function () {
    //== Gedung ==
    Route::resource('/gedung', GedungController::class);

    //== Intansi ==
    Route::resource('/instansi', InstansiController::class);

    //== Kamar ==
    Route::get('/kelola-kamar', [KamarController::class, 'index'])->name('kelola_kamar');
    Route::get('/kelola-kamar/tambah-kamar', [KamarController::class, 'create']);
    Route::post('/kelola-kamar', [KamarController::class, 'store'])->name('kelola_kamar');
    Route::get('/kelola-kamar/detail/{id}', [KamarController::class, 'showDetail'])->name('detail_kamar');
    Route::get('/kelola-kamar/edit/{id}', [KamarController::class, 'edit'])->name('edit_kamar');
    Route::put('/kelola-kamar/update/{id}', [KamarController::class, 'update'])->name('update_kamar');

    //== Ruangan ==
    Route::get('/kelola-ruangan', [RuanganController::class, 'index'])->name('kelola_ruangan');
    Route::get('/kelola-ruangan/tambah-ruangan', [RuanganController::class, 'create'])->name('tambah_ruangan');
    Route::post('/kelola-ruangan', [RuanganController::class, 'store']);
    Route::get('/kelola-ruangan/detail/{id}', [RuanganController::class, 'showDetail'])->name('detail_ruangan');
    Route::get('/kelola-ruangan/edit/{id}', [RuanganController::class, 'edit'])->name('edit_ruangan');
    Route::put('/kelola-ruangan/update/{id}', [RuanganController::class, 'update'])->name('update_ruangan');

    //Riwayat
    Route::get('/permintaan-reservasi', [TransaksiController::class, 'showPReservasi'])->name('permintaan_reservasi');
    Route::get('/permintaan-reservasi/detail/{jenis_transaksi}/{id}', [TransaksiController::class, 'showDetailPReservasi'])->name('detail_PReservasi');
    Route::get('/daftar-reservasi', [TransaksiController::class, 'showDReservasi'])->name('daftar_reservasi');
    Route::get('/daftar-reservasi/detail/{jenis_transaksi}/{id}', [TransaksiController::class, 'showDetailDReservasi'])->name('detail_DReservasi');
});
// ============================================================================================================================

//================================ CONTROLLER TAMU ================================
//== Tamu==
Route::get('/tentang-kami', function () {
    return view('tamu.tentangKami');
})->name('Ptentang');
// --------------------------------------------------------------------------------------------

//== Riwayat Transaksi Tamu ==
Route::middleware(['auth', 'role:tamu'])->group(function () {
    //Riwayat
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayatTransaksi'])->name('riwayat_tamu');
    Route::get('/riwayat-transaksi/detail/{jenis_transaksi}/{id}', [TransaksiController::class, 'showDetailRiwayat'])
        ->name('detail_riwayat');
    Route::put('/reservasi/cancel/{id}', [TransaksiController::class, 'cancelReservasi'])
        ->name('cancel_reservasi');
    Route::put('/reservasi/bukti-bayar/{id}', [TransaksiController::class, 'tambahBuktiBayar'])
        ->name('tambah_bbayar');

    //Kamar
    Route::get('/kamar/form-reservasi', [transaksiKamarController::class, 'create'])->name('reservasi_kamar.create');
    Route::post('/kamar', [transaksiKamarController::class, 'store'])->name('store_RKamar');
    Route::get('/kamar/reservasi/edit/{id}', [transaksiKamarController::class, 'edit'])->name('edit_RKamar');
    Route::put('/kamar/update-reservasi/{id}', [transaksiKamarController::class, 'update'])->name('reservasi_kamar.update');

    //Ruangan
    Route::get('/ruangan/form-reservasi/{id}', [transaksiRuanganController::class, 'create'])->name('reservasi_ruangan');
    Route::post('/ruangan', [transaksiRuanganController::class, 'store'])->name('ruangan_tamu');
    Route::get('/ruangan/reservasi/{id}', [transaksiRuanganController::class, 'edit'])->name('edit_RRuangan');
});


// --------------------------------------------------------------------------------------------

//== Kamar Tamu ==
Route::post('/cek-ketersediaan-kamar', [transaksiKamarController::class, 'cekKetersediaan'])->name('cek-ketersediaan-kamar');
Route::get('/kamar', [transaksiKamarController::class, 'index'])->name('kamar_tamu');
// Route::post('/kamar', [transaksiKamarController::class, 'checkAvailability'])->name('cek-kamar.check');
// --------------------------------------------------------------------------------------------

//== Ruangan Tamu ==
Route::get('/ruangan', [transaksiRuanganController::class, 'index'])->name('ruangan_tamu');
Route::get('/ruangan/detail/{id}', [transaksiRuanganController::class, 'show'])->name('detail_ruangan_tamu');

// --------------------------------------------------------------------------------------------

//== Kontak ==
Route::get('/kontak', function () {
    return view('tamu.kontak');
})->name('Pkontak');

// --------------------------------------------------------------------------------------------


//== user ==
Route::resource('/kelola-users', kelolaUserController::class);

// Route::resource('/form-login', AuthenticatedSessionController::class, 'crete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
