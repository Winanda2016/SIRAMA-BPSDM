<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\detailTRuangan;
use App\Models\Transaksi;
use App\Models\Gedung;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class transaksiRuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('tamu.ruangan.ruangan', compact('ruangan'));
    }

    public function show(string $id)
    {
        $ruanganId = $id;
        $ruangan = Ruangan::select(
            'ruangan.id',
            'ruangan.nama_ruangan',
            'ruangan.harga',
            'ruangan.kapasitas',
            'ruangan.fasilitas',
            'ruangan.foto',
            'gedung.nama_gedung'
        )
            ->leftjoin('gedung', 'ruangan.gedung_id', '=', 'gedung.id')
            ->where('ruangan.id', $ruanganId)
            ->first();

        return view('tamu.ruangan.detailRuangan', compact('ruangan'));
    }

    public function create($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('tamu.ruangan.reservasiRuangan', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'nama_instansi' => 'nullable|string|max:100',
            'nohp' => 'required|string|max:20',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,id',
            'dokumen_reservasi' => 'nullable|file|max:255|mimes:pdf,doc,docx'
        ]);

        // Proses perhitungan total hari dan total harga
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

        $ruangan = Ruangan::findOrFail($validatedData['ruangan_id']);
        $total_harga = $ruangan->harga * $total_hari;

        // Simpan transaksi
        $transaksi = new Transaksi();
        $transaksi->users_id = auth()->user()->id;
        $transaksi->nama = $validatedData['nama'];
        $transaksi->nohp = $validatedData['nohp'];
        $transaksi->nama_instansi = $validatedData['nama_instansi'];
        $transaksi->tgl_reservasi = $validatedData['tgl_reservasi'];
        $transaksi->tgl_checkin = $validatedData['tgl_checkin'];
        $transaksi->tgl_checkout = $validatedData['tgl_checkout'];
        $transaksi->jumlah_orang = $validatedData['jumlah_orang'];
        $transaksi->total_hari = $total_hari;
        $transaksi->total_harga = $total_harga;
        $transaksi->jenis_transaksi = 'ruangan';
        $transaksi->status_transaksi = 'pending';
        // Upload dokumen jika ada
        if ($request->hasFile('dokumen_reservasi')) {
            $file = $request->file('dokumen_reservasi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/dokumen', $fileName); // Simpan di storage/app/public/dokumen
            $transaksi->dokumen_reservasi = $fileName;
        }
        $transaksi->save();

        // Simpan detail transaksi ruangan
        $detailTransaksi = new detailTRuangan();
        $detailTransaksi->transaksi_id = $transaksi->id;
        $detailTransaksi->ruangan_id = $ruangan->id;
        $detailTransaksi->save();

        return redirect()->route('ruangan_tamu')->with('success', 'Reservasi berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = DB::table('detail_transaksi_ruangan as dtr')
            ->leftJoin('ruangan as r', 'dtr.ruangan_id', '=', 'r.id')
            ->leftJoin('gedung as g', 'r.gedung_id', '=', 'g.id')
            ->leftJoin('transaksi as t', 'dtr.transaksi_id', '=', 't.id')
            ->where('dtr.id', $id)
            ->select(
                'r.nama_ruangan',
                'g.nama_gedung',
                'dtr.id As detail_id',
                't.*'
            )
            ->first();
        return view('tamu.ruangan.editReservasi', compact('data'));
    }
}
