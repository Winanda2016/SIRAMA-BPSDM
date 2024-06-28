<?php

namespace App\Http\Controllers;

use App\Models\JTamu;
use Illuminate\Http\Request;

class JTamuController extends Controller
{

    public function index()
    {
        $jtamu = JTamu::orderBy('id', 'desc')->get();
        return view('admin.jtamu.kelolaJTamu', compact('jtamu'));
    }

    public function store(Request $request)
    {
        $existingJTamu =  JTamu::where('nama_jenis', $request->nama_jenis)->first();

        if ($existingJTamu) {
            // Tampilkan alert jika nama jenis sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Jenis Tamu Tersebut Sudah Tersedia.');
        }

        // Validasi input
        $request->validate([
            'nama_jenis' => 'required|string|unique:jenis_tamu,nama_jenis',
            'harga' => 'required|numeric'
        ]);

        // // Jika data belum ada, simpan data baru
        JTamu::create($request->all());

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('jenis-tamu.index')
            ->with('success', 'Data jenis tamu baru berhasil ditambahkan.');
    }

    public function destroy(string $id)
    {
        //elequent
        JTamu::find($id)->delete();
        return redirect()->route('jenis-tamu.index')
            ->with('error', 'Data Jenis Tamu Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $existingJTamuUpdate = JTamu::where('nama_jenis', $request->nama_jenis)
                                           ->where('id', '!=', $id) // Exclude current record
                                            ->first();

        if ($existingJTamuUpdate) {
            // Tampilkan alert jika nama jenis sudah ada
            return redirect()->route('jenis-tamu.index')
                ->with('error', 'Data Jenis Tamu Tersebut Sudah Tersedia.');
        }

        JTamu::where('id', $id)
            ->update([
                'nama_jenis' => $request->nama_jenis,
                'harga' => $request->harga,
            ]);

        return redirect()->route('jenis-tamu.index')
            ->with('success', 'Data Jenis Tamu Berhasil Diubah');
    }

    public function JTTamu()
    {
        $jtamu = JTamu::orderBy('id', 'desc')->get();
        return view('tamu.detailKamar', compact('jtamu'));
    }
}
