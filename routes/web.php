<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\kelolaUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TamuController;
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

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::get('/admin-dashboard', [DashboardController::class, 'indexAdmin']);

Route::get('/pegawai-dashboard', function () {
    return view('admin.dashboardPegawai');
});


// Route::get('/admin-dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('/tamu-dashboard', function () {
    return view('tamu.dashboard');
})->name('Pdashboard');;

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

//== Intansi ==
Route::resource('/instansi', InstansiController::class);

Route::get('/kelola-ruangan', [RuanganController::class, 'index'])->name('kelola_ruangan');

Route::get('/tambah-ruangan', function () {
    return view('admin.ruangan.tambahRuangan');
});
Route::get('/edit-ruangan', function () {
    return view('admin.ruangan.editRuangan');
});

// ===========================================================

//== Tamu==
Route::get('/tentang-kami', function () {
    return view('tamu.tentangKami');
})->name('Ptentang');

//== Kamar Tamu==
Route::get('/kamar', [TamuController::class, 'index'])->name('kamar_tamu');
Route::get('/kamar/form-reservasi', [TamuController::class, 'create']);
Route::post('/kamar', [TamuController::class, 'store']);

Route::get('/ruangan', function () {
    return view('tamu.ruangan');
})->name('Pruangan');

Route::get('/ruangan/reservasi', function () {
    return view('tamu.reservasiRuangan');
});

Route::get('/ruangan/detail', function () {
    return view('tamu.detailRuangan');
})->name('PRdetail');

Route::get('/kontak', function () {
    return view('tamu.kontak');
})->name('Pkontak');

// ===========================================================

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
