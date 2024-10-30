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
    
    public function storeKomentar(Request $request)
    {
        $validatedData = $request->validate([
            'komentar' => 'required|max:200',
            'tanggal' => 'required|date_format:Y-m-d'
        ]);

        $komentar = new Komentar();
        $komentar->komentar = $validatedData['komentar'];
        $komentar->tanggal = $validatedData['tanggal'];
        $komentar->users_id = auth()->user()->id;
        $komentar->status = 'tampil';
        $komentar->save();

        return redirect()->route('Tdashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string',
            'balasan' => 'nullable|string',
            'status' => 'required'
        ]);

        // Cari komentar berdasarkan ID
        $komentar = Komentar::find($id);

        if (!$komentar) {
            return response()->json(['error' => 'Komentar tidak ditemukan'], 404);
        }

        // Update data komentar dan balasan
        $komentar->komentar = $request->input('komentar');
        $komentar->balasan = $request->input('balasan');
        $komentar->status = $request->input('status');
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
