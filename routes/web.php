<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JPelangganController;
use App\Http\Controllers\kelolaUserController;
use App\Models\JPelanggan;
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

// Route::get('/', function () {
//     return view('admin.themes.index');
// });

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/pegawai-dashboard', function () {
    return view('admin.dashboardPegawai');
});


// Route::get('/admin-dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('/db-pelanggan', function () {
    return view('pelanggan.dashboard');
});

//== RESERVASI ==
Route::get('/daftar-reservasi', function () {
    return view('admin.reservasi.daftarReservasi');
});

Route::get('/permintaan-reservasi', function () {
    return view('admin.reservasi.permintaanReservasi');
});

Route::get('/detail-permintaan-reservasi', function () {
    return view('admin.reservasi.detailPermintaan');
});

Route::get('/detail-reservasi', function () {
    return view('admin.reservasi.detailReservasi');
});

Route::get('/edit-reservasi', function () {
    return view('admin.reservasi.editReservasi');
});

Route::get('/tambah-reservasi', function () {
    return view('admin.reservasi.tambahReservasi');
});

// ===========================================================

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

// ===========================================================

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

// ===========================================================

//== Gedung ==
Route::resource('/gedung', GedungController::class);

//== Kamar ==
Route::get('/kelola-kamar', [KamarController::class, 'index'])->name('kelola_kamar');
Route::get('/kelola-kamar/tambah-kamar', [KamarController::class, 'create']);
Route::post('/kelola-kamar', [KamarController::class, 'store']);
Route::get('/edit-kamar/{id}', [KamarController::class, 'edit'])->name('edit_kamar');
Route::put('/update-kamar/{id}', [KamarController::class, 'update'])->name('update_kamar');

//== Jenis Pelanggan ==
Route::resource('/jenis-pelanggan', JPelangganController::class);

Route::get('/kelola-ruangan', function () {
    return view('admin.ruangan.kelolaRuangan');
});
Route::get('/tambah-ruangan', function () {
    return view('admin.ruangan.tambahRuangan');
});
Route::get('/edit-ruangan', function () {
    return view('admin.ruangan.editRuangan');
});

// ===========================================================

//== user ==
Route::resource('/kelola-users', kelolaUserController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
