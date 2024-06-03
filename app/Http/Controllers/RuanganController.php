<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $gedungId = $request->input('gedung_id');

        // Ambil semua gedung
        $gedung = Gedung::all();

        // Filter berdasarkan nama gedung jika nama gedung dipilih
        $ruangan = Ruangan::when($gedungId, function ($query, $gedungId) {
            return $query->whereHas('gedung', function ($query) use ($gedungId) {
                $query->where('id', $gedungId);
            });
        })
            ->select('ruangan.nama_ruangan', 'ruangan.harga', 'ruangan.kapasitas', 'ruangan.status', 'gedung.nama_gedung')
            ->leftJoin('gedung', 'gedung.id', '=', 'ruangan.gedung_id')
            ->orderBy('nama_ruangan', 'asc')
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('admin.ruangan.kelolaRuangan', compact('gedung', 'ruangan'));
    }
}
