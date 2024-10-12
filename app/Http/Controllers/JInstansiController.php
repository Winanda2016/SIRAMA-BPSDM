<?php

namespace App\Http\Controllers;

use App\Models\JInstansi;
use Illuminate\Http\Request;

class JInstansiController extends Controller
{

    public function index()
    {
        $jinstansi = JInstansi::orderBy('id', 'desc')->get();
        return view('admin.jinstansi.kelolaJInstansi', compact('jinstansi'));
    }

    public function store(Request $request)
    {
        $existingJInstansi =  JInstansi::where('nama_instansi', $request->nama_instansi)->first();

        if ($existingJInstansi) {
            // Tampilkan alert jika nama jinstansi sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Jenis Instansi Tersebut Sudah Tersedia.');
        }

        // Validasi input
        $request->validate([
            'nama_instansi' => 'required|string|unique:jenis_instansi,nama_instansi',
            'harga' => 'required|numeric'
        ]);

        // // Jika data belum ada, simpan data baru
        JInstansi::create($request->all());

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('jinstansi.index')
            ->with('success', 'Data Jenis Instansi baru berhasil ditambahkan.');
    }

    public function destroy(string $id)
    {
        //elequent
        JInstansi::find($id)->delete();
        return redirect()->route('jinstansi.index')
            ->with('error', 'Data Jenis Instansi Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $existingJInstansiUpdate = JInstansi::where('nama_instansi', $request->nama_instansi)
                                           ->where('id', '!=', $id) // Exclude current record
                                            ->first();

        if ($existingJInstansiUpdate) {
            // Tampilkan alert jika nama jinstansi sudah ada
            return redirect()->route('jinstansi.index')
                ->with('error', 'Data Jenis Instansi Tersebut Sudah Tersedia.');
        }

        JInstansi::where('id', $id)
            ->update([
                'nama_instansi' => $request->nama_instansi,
                'harga' => $request->harga,
            ]);

        return redirect()->route('jinstansi.index')
            ->with('success', 'Data Jenis Instansi Berhasil Diubah');
    }

    public function JInstansiTamu()
    {
        $jinstansi = JInstansi::orderBy('id', 'desc')->get();
        return view('tamu.detailKamar', compact('jinstansi'));
    }
}
