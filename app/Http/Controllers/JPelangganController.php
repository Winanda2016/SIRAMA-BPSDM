<?php

namespace App\Http\Controllers;

use App\Models\JPelanggan;
use Illuminate\Http\Request;

class JPelangganController extends Controller
{

    public function index()
    {
        $jpelanggan = JPelanggan::orderBy('id', 'desc')->get();
        return view('admin.jpelanggan.kelolaJPelanggan', compact('jpelanggan'));
    }


    public function store(Request $request)
    {
        $existingJPelanggan =  JPelanggan::where('nama_jenis', $request->nama_jenis)->first();

        if ($existingJPelanggan) {
            // Tampilkan alert jika nama jenis sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Nama Gedung Tersebut Sudah Tersedia.');
        }

        // Validasi input
        $request->validate([
            'nama_jenis' => 'required|string|unique:jenis_pelanggan,nama_jenis',
            'harga' => 'required|numeric'
        ]);

        // // Jika data belum ada, simpan data baru
        JPelanggan::create($request->all());

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('jenis-pelanggan.index')
            ->with('success', 'Data jenis pelanggan baru berhasil ditambahkan.');
    }

    public function destroy(string $id)
    {
        //elequent
        JPelanggan::find($id)->delete();
        return redirect()->route('jenis-pelanggan.index')
            ->with('error', 'Data Jenis Pelanggan Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $existingJPelangganUpdate = JPelanggan::where('nama_jenis', $request->nama_jenis)
                                           ->where('id', '!=', $id) // Exclude current record
                                            ->first();

        if ($existingJPelangganUpdate) {
            // Tampilkan alert jika nama jenis sudah ada
            return redirect()->route('jenis-pelanggan.index')
                ->with('error', 'Data Jenis Pelanggan Tersebut Sudah Tersedia.');
        }

        JPelanggan::where('id', $id)
            ->update([
                'nama_jenis' => $request->nama_jenis,
                'harga' => $request->harga,
            ]);

        return redirect()->route('jenis-pelanggan.index')
            ->with('success', 'Data Jenis Pelanggan Berhasil Diubah');
    }
}
