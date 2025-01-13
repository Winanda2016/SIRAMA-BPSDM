<?php

namespace App\Http\Controllers;

use App\Models\SaranPengaduan;
use Illuminate\Http\Request;

class SaranPengaduanController extends Controller
{
    public function index()
    {
        $saran_pengaduan = SaranPengaduan::select(
            'saran_pengaduan.*',
            'saran_pengaduan.id as saran_pengaduan_id',
            'u.name as nama_user'
        )
            ->leftJoin('users AS u', 'saran_pengaduan.users_id', '=', 'u.id')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.saran_pengaduan.kelolaSaranPengaduan', compact('saran_pengaduan'));
    }
    
    public function storeSaranPengaduan(Request $request)
    {
        $validatedData = $request->validate([
            'saran_pengaduan' => 'required|max:200',
            'tanggal' => 'required|date_format:Y-m-d'
        ]);

        $saran_pengaduan = new SaranPengaduan();
        $saran_pengaduan->saran_pengaduan = $validatedData['saran_pengaduan'];
        $saran_pengaduan->tanggal = $validatedData['tanggal'];
        $saran_pengaduan->users_id = auth()->user()->id;
        $saran_pengaduan->status = 'tampil';
        $saran_pengaduan->save();

        return redirect()->route('Tdashboard')->with('success', 'Saran dan Pengaduan berhasil dikirim');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'saran_pengaduan' => 'required|string',
            'balasan' => 'nullable|string',
            'status' => 'required'
        ]);

        // Cari saran_pengaduan berdasarkan ID
        $saran_pengaduan = SaranPengaduan::find($id);

        if (!$saran_pengaduan) {
            return response()->json(['error' => 'Saran dan Pengaduan tidak ditemukan'], 404);
        }

        // Update data saran_pengaduan dan balasan
        $saran_pengaduan->saran_pengaduan = $request->input('saran_pengaduan');
        $saran_pengaduan->balasan = $request->input('balasan');
        $saran_pengaduan->status = $request->input('status');
        $saran_pengaduan->save();

        return redirect()->route('saran-pengaduan.index')
            ->with('success', 'Data Saran dan Pengaduan berhasil ditambahkan / diperbarui');
    }

    public function destroy($id)
    {
        // Cari saran_pengaduan berdasarkan ID
        $saran_pengaduan = SaranPengaduan::find($id);

        if (!$saran_pengaduan) {
            return response()->json(['error' => 'Saran dan Pengaduan tidak ditemukan'], 404);
        }

        // Hapus saran_pengaduan
        $saran_pengaduan->delete();

        return redirect()->route('saran-pengaduan.index')
            ->with('success', 'Saran dan Pengaduan berhasil dihapus');
    }
}
