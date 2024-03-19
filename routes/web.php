<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
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


// Route::get('/admin-dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('/', function () {
//     return view('pelanggan.dashboard');
// });

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

// ===========================================================

//== TAMU ==
Route::get('/daftar-tamu', function () {
    return view('admin.tamu.daftarTamu');
});

// ===========================================================

//== TRANSAKSI ==
Route::get('/form-checkin', function () {
    return view('admin.transaksi.checkin');
});

Route::get('/riwayat-transaksi', function () {
    return view('admin.transaksi.riwayatTransaksi');
});

// ===========================================================

//== Gedun ==
Route::resource('/kelola-gedung', GedungController::class);

//== Kamar ==
Route::resource('/kelola-kamar', KamarController::class)->except(['show']);
Route::get('/kelola-kamar/tambah-kamar', [KamarController::class, 'create']);
Route::post('/kelola-kamar', [KamarController::class, 'store']);
Route::get('/kelola-kamar/{kamar}/edit', [KamarController::class, 'edit']);
Route::put('/kelola-kamar/{kamar}', [KamarController::class, 'update']);

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
