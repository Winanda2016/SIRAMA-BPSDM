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

    public function store(Request $request)
    {
        $existingGedung = Gedung::where('nama_gedung', $request->nama_gedung)->first();

        if ($existingGedung) {
            return redirect()->route('gedung.index')
                ->with('error', 'Nama Gedung Tersebut Sudah Tersedia.');
        }

        Gedung::create($request->all());

        return redirect()->route('gedung.index')
            ->with('success', 'Nama Gedung Baru Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $existingGedungUpdate = Gedung::where('nama_gedung', $request->nama_gedung)->first();

        if ($existingGedungUpdate) {
            return redirect()->route('gedung.index')
                ->with('error', 'Nama Gedung Tersebut Sudah Tersedia.');
        }

        Gedung::where('id', $id)->update(['nama_gedung' => $request->nama_gedung]);

        return redirect()->route('gedung.index')
            ->with('success', 'Nama Gedung Berhasil Diubah');
    }
}
