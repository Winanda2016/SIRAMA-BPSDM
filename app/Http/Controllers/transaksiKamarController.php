<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\detailTKamar;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class transaksiKamarController extends Controller
{
    public function index()
    {

        $instansi = Instansi::orderBy('id', 'desc')->get();
        $kamarTersedia = Kamar::where('status', 'kosong')->count();

        return view('tamu.kamar.detailKamar', compact('kamarTersedia', 'instansi'));
    }

    public function create()
    {
        $instansi = Instansi::all();
        return view('tamu.kamar.reservasiKamar', compact('instansi'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called');
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'instansi_id' => 'required|exists:instansi,id',
            'nohp' => 'required|string|max:20',
            'nama_instansi' => 'nullable|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        $instansi = Instansi::find($validatedData['instansi_id']);
        if (!$instansi) {
            return redirect()->back()->withInput()->withErrors(['instansi_id' => 'Instansi tidak valid.']);
        }

        $total_harga = $instansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        $transaksi = new Transaksi();
        $transaksi->users_id = auth()->user()->id;
        $transaksi->nama = $validatedData['nama'];
        $transaksi->nohp = $validatedData['nohp'];
        $transaksi->nama_instansi = $validatedData['nama_instansi'];
        $transaksi->tgl_reservasi = $validatedData['tgl_reservasi'];
        $transaksi->tgl_checkin = $validatedData['tgl_checkin'];
        $transaksi->tgl_checkout = $validatedData['tgl_checkout'];
        $transaksi->jumlah_orang = $validatedData['jumlah_orang'];
        $transaksi->total_harga = $total_harga;
        $transaksi->jenis_transaksi = 'kamar';
        $transaksi->status_transaksi = 'pending';
        $transaksi->save();

        $detailTransaksi = new DetailTKamar();
        $detailTransaksi->transaksi_id = $transaksi->id;
        $detailTransaksi->instansi_id = $validatedData['instansi_id'];
        $detailTransaksi->save();

        return redirect()->route('store_RKamar')->with('success', 'Reservasi berhasil disimpan.');
    }

    public function edit($id)
    {
        $instansi = Instansi::all();
        $data = DB::table('detail_transaksi_kamar as dtk')
            ->leftJoin('kamar as k', 'dtk.kamar_id', '=', 'k.id')
            ->leftJoin('gedung as g', 'k.gedung_id', '=', 'g.id')
            ->leftJoin('transaksi as t', 'dtk.transaksi_id', '=', 't.id')
            ->leftJoin('instansi as i', 'dtk.instansi_id', '=', 'i.id')
            ->where('dtk.id', $id)
            ->select(
                'k.nomor_kamar',
                'g.nama_gedung',
                'i.id as instansi_id',
                'i.nama_instansi as instansi',
                'dtk.id As detail_id',
                't.*'
            )
            ->first();
        return view('tamu.kamar.editReservasi', compact('data', 'instansi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'instansi_id' => 'required|exists:instansi,id',
            'nohp' => 'required|string|max:20',
            'nama_instansi' => 'nullable|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        // Hitung total hari
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        // Cari instansi berdasarkan id
        $instansi = Instansi::find($validatedData['instansi_id']);
        if (!$instansi) {
            return redirect()->back()->withInput()->withErrors(['instansi_id' => 'Instansi tidak valid.']);
        }

        // Hitung total harga
        $total_harga = $instansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        // Ambil data detail transaksi kamar
        $detailTransaksi = DetailTKamar::findOrFail($id);

        // Update data detail transaksi kamar
        $detailTransaksi->instansi_id = $request->instansi_id;
        $detailTransaksi->save();

        // Update juga transaksi terkait jika perlu
        $transaksi = Transaksi::findOrFail($detailTransaksi->transaksi_id);
        $transaksi->tgl_reservasi = $request->tgl_reservasi;
        $transaksi->nama = $request->nama;
        $transaksi->nohp = $request->nohp;
        $transaksi->nama_instansi = $request->nama_instansi;
        $transaksi->tgl_checkin = $request->tgl_checkin;
        $transaksi->tgl_checkout = $request->tgl_checkout;
        $transaksi->jumlah_orang = $request->jumlah_orang;
        $transaksi->total_harga = $total_harga;
        $transaksi->save();

        // Redirect ke halaman detail riwayat transaksi
        return redirect()->route('detail_riwayat', [
            'jenis_transaksi' => $transaksi->jenis_transaksi,
            'id' => $detailTransaksi->id
        ])->with('success', 'Data Reservasi berhasil diperbarui!');
    }

    public function cekKetersediaan(Request $request)
    {
        $tglCheckin = $request->input('cek_tgl_checkin');
        $tglCheckout = $request->input('cek_tgl_checkout');

        $jumlah_kamar_tersedia = Kamar::where('status', 'kosong')
            ->whereNotIn('id', function ($query) use ($tglCheckin, $tglCheckout) {
                $query->select('dk.kamar_id')
                    ->from('detail_transaksi_kamar as dk')
                    ->join('transaksi as t', 'dk.transaksi_id', '=', 't.id')
                    ->where(function ($query) use ($tglCheckin, $tglCheckout) {
                        $query->where(function ($query) use ($tglCheckin, $tglCheckout) {
                            $query->where('t.tgl_checkin', '<=', $tglCheckout)
                                ->where('t.tgl_checkout', '>=', $tglCheckin);
                        })->orWhere(function ($query) use ($tglCheckin, $tglCheckout) {
                            $query->where('t.tgl_checkin', '<=', $tglCheckin)
                                ->where('t.tgl_checkout', '>=', $tglCheckin);
                        })->orWhere(function ($query) use ($tglCheckin, $tglCheckout) {
                            $query->where('t.tgl_checkin', '<=', $tglCheckout)
                                ->where('t.tgl_checkout', '>=', $tglCheckout);
                        })->orWhere(function ($query) use ($tglCheckin, $tglCheckout) {
                            $query->where('t.tgl_checkin', '>=', $tglCheckin)
                                ->where('t.tgl_checkout', '<=', $tglCheckout);
                        });
                    });
            })
            ->count();

        return response()->json(['jumlah_kamar_tersedia' => $jumlah_kamar_tersedia]);
    }
}
