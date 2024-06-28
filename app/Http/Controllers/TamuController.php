<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\detailTKamar;
use App\Models\Instansi;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        $instansi = Instansi::orderBy('id', 'desc')->get();
        $kamarTersedia = Kamar::where('status', 'kosong')->count();

        return view('tamu.detailKamar', compact('instansi', 'kamarTersedia'));
    }

    public function create()
    {
        $instansi = Instansi::all();
        return view('tamu.reservasiKamar', compact('instansi'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'noHP' => 'nullable|string|max:20',
            'instansi_id' => 'required|exists:instansis,id',
            'nama_instansi' => 'nullable|string|max:100',
            'tgl_checkin' => 'required|date',
            'tgl_checkout' => 'required|date',
            'jumlah_orang' => 'required|integer|min:1',
            'total_hari' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'dokumen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Jika ada field dokumen, tambahkan validasi sesuai kebutuhan
        ]);

        // Simpan data ke dalam database menggunakan model Transaksi
        $reservasi = new Transaksi();

        $reservasi->nama = $validatedData['nama'];
        $reservasi->noHP = $validatedData['noHP'];
        $reservasi->instansi_id = $validatedData['instansi_id'];
        $reservasi->nama_instansi = $validatedData['nama_instansi'];
        $reservasi->tgl_checkin = $validatedData['tgl_checkin'];
        $reservasi->tgl_checkout = $validatedData['tgl_checkout'];
        $reservasi->jumlah_orang = $validatedData['jumlah_orang'];
        $reservasi->total_hari = $validatedData['total_hari'];
        $reservasi->total_harga = $validatedData['total_harga'];
        // Jika ada field dokumen, tambahkan penyimpanan dokumen

        $reservasi->save();

        // Redirect atau response sesuai kebutuhan setelah berhasil menyimpan
        return redirect()->route('kamar_tamu')->with('success', 'Reservasi berhasil disimpan');
    }
}
