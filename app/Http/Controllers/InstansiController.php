<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{

    public function index()
    {
        $instansi = Instansi::orderBy('id', 'desc')->get();
        return view('admin.instansi.kelolaInstansi', compact('instansi'));
    }

    public function store(Request $request)
    {
        $existingInstansi =  Instansi::where('nama_instansi', $request->nama_instansi)->first();

        if ($existingInstansi) {
            // Tampilkan alert jika nama instansi sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Instansi Tersebut Sudah Tersedia.');
        }

        // Validasi input
        $request->validate([
            'nama_instansi' => 'required|string|unique:instansi,nama_instansi',
            'harga' => 'required|numeric'
        ]);

        // // Jika data belum ada, simpan data baru
        Instansi::create($request->all());

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('instansi.index')
            ->with('success', 'Data Instansi baru berhasil ditambahkan.');
    }

    public function destroy(string $id)
    {
        //elequent
        Instansi::find($id)->delete();
        return redirect()->route('instansi.index')
            ->with('error', 'Data Instansi Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $existingInstansiUpdate = Instansi::where('nama_instansi', $request->nama_instansi)
                                           ->where('id', '!=', $id) // Exclude current record
                                            ->first();

        if ($existingInstansiUpdate) {
            // Tampilkan alert jika nama instansi sudah ada
            return redirect()->route('instansi.index')
                ->with('error', 'Data Instansi Tersebut Sudah Tersedia.');
        }

        Instansi::where('id', $id)
            ->update([
                'nama_instansi' => $request->nama_instansi,
                'harga' => $request->harga,
            ]);

        return redirect()->route('instansi.index')
            ->with('success', 'Data Instansi Berhasil Diubah');
    }

    public function InstansiTamu()
    {
        $instansi = Instansi::orderBy('id', 'desc')->get();
        return view('tamu.detailKamar', compact('instansi'));
    }
}
