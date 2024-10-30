<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Gedung;
use App\Models\detailTKamar;
use App\Models\detailTRuangan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class tamuTransaksiController extends Controller
{

    public function riwayatTransaksi()
    {
        $userId = auth()->user()->id;

        $transaksi = Transaksi::select(
            'transaksi.jenis_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.total_harga',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id',
            'transaksi.*'
        )
            ->where('transaksi.users_id', $userId)
            ->orderBy('tgl_reservasi', 'desc')
            ->get();

        return view('tamu.riwayat.riwayatTransaksi', compact('transaksi'));
    }

    public function showDetailRiwayat($jenis_transaksi, $id)
    {

        if ($jenis_transaksi == 'kamar') {

            $data = DB::table('transaksi as t')
                ->leftJoin('jenis_instansi as i', 't.jinstansi_id', '=', 'i.id')
                ->where('t.id', $id)
                ->select(
                    'i.nama_instansi as jinstansi',
                    't.id as transaksi_id',
                    't.*'
                )
                ->first();

            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

            return view('tamu.riwayat.detail', compact('data', 'jenis_transaksi', 'total_hari'));
        } elseif ($jenis_transaksi == 'ruangan') {
            $data = DB::table('detail_transaksi_ruangan as dtr')
                ->leftJoin('ruangan as r', 'dtr.ruangan_id', '=', 'r.id')
                ->leftJoin('gedung as g', 'r.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi as t', 'dtr.transaksi_id', '=', 't.id')
                ->leftJoin('jenis_instansi as i', 't.jinstansi_id', '=', 'i.id')
                ->where('t.id', $id)
                ->select(
                    'r.nama_ruangan',
                    'r.harga as harga_ruangan',
                    'g.nama_gedung',
                    'i.nama_instansi as jinstansi',
                    't.id as transaksi_id',
                    'dtr.id As detail_id',
                    't.tgl_checkin',
                    't.tgl_checkout',
                    't.*'
                )
                ->first();
                
            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

            return view('tamu.riwayat.detail', compact('data', 'jenis_transaksi', 'total_hari'));
        } else {
            abort(404);
        }
    }


    public function cancelReservasiTamu($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_transaksi = 'batal';
        $transaksi->save();

        return redirect()->route('riwayat_tamu')->with('success', 'Reservasi berhasil dibatalkan!');
    }

    public function tambahBuktiBayar(Request $request, $jenis_transaksi, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'Transaksi_' . time() . '.' . $extension;
                $file->move(public_path('public/dokumen/bukti_bayar'), $fileName);
                $transaksi->bukti_bayar = 'public/dokumen/bukti_bayar/' . $fileName;
            }
        } catch (\Exception $e) {
            return back()->withError('Gagal mengupload bukti pembayaran: ' . $e->getMessage())->withInput();
        }

        $transaksi->save();

        return redirect()->route('detail_riwayat', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id])
            ->with('success', 'Reservasi berhasil dibatalkan dan bukti bayar berhasil diunggah!');
    }
}
