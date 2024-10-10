<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentar = Komentar::select(
            'komentar.*',
            'komentar.id as komentar_id',
            'u.name as nama_user'
        )
            ->leftJoin('users AS u', 'komentar.users_id', '=', 'u.id')
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.komentar.kelolaKomentar', compact('komentar'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'komentar' => 'required|string',
            'balasan' => 'nullable|string',
        ]);

        // Cari komentar berdasarkan ID
        $komentar = Komentar::find($id);

        if (!$komentar) {
            return response()->json(['error' => 'Komentar tidak ditemukan'], 404);
        }

        // Update data komentar dan balasan
        $komentar->komentar = $request->input('komentar');
        $komentar->balasan = $request->input('balasan');
        $komentar->save();

        return redirect()->route('komentar.index')
            ->with('success', 'Komentar / Balasan berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari komentar berdasarkan ID
        $komentar = Komentar::find($id);

        if (!$komentar) {
            return response()->json(['error' => 'Komentar tidak ditemukan'], 404);
        }

        // Hapus komentar
        $komentar->delete();

        return redirect()->route('komentar.index')
            ->with('success', 'Komentar berhasil dihapus');
    }
}
