<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{

    public function index()
    {
        $ar_gedung = Gedung::orderBy('updated_at', 'desc')->get();
        return view('admin.gedung.kelolaGedung', compact('ar_gedung'));
    }

    // public function create(){
    //     return view ('admin.gedung.kelolaGedung');
    // }

    public function store(Request $request)
    {
        $existingGedung = Gedung::where('nama_gedung', $request->nama_gedung)->first();

        if ($existingGedung) {
            // Tampilkan alert jika geudng sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Nama Gedung Tersebut Sudah Tersedia.');
        }

        // Lakukan penyimpanan jika tidak ada duplikat
        Gedung::create($request->all());

        // Redirect atau tindakan lain setelah penyimpanan berhasil
        return redirect()->route('gedung.index')
            ->with('success', 'Nama Gedung Baru Berhasil Ditambahkan');
    }

    public function destroy(string $id)
    {
        //elequent
        Gedung::find($id)->delete();
        return redirect()->route('gedung.index')
            ->with('success', 'Data Gedung Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $existingGedungUpdate = Gedung::where('nama_gedung', $request->nama_gedung)->first();

        if ($existingGedungUpdate) {
            // Tampilkan alert jika gedung tersebut sudah ada
            return redirect()->route('gedung.index')
                ->with('error', 'Nama Gedung Tersebut Sudah Tersedia.');
        }

        Gedung::where('id', $id)->update(['nama_gedung' => $request->nama_gedung]);

        return redirect()->route('gedung.index')
            ->with('success', 'Nama Gedung Berhasil Diubah');
    }
}
