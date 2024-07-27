<?php

namespace App\Http\Controllers;

use App\Models\detailTKamar;
use App\Models\detailTRuangan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //

    public function riwayatTransaksi()
    {
        $userId = auth()->user()->id;

        // Query untuk transaksi kamar
        $transaksiKamar = Transaksi::select(
            'transaksi.jenis_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.total_harga',
            'transaksi.status_transaksi as status',
            'dtk.id as detail_id' // Ambil id dari detail_transaksi_kamar
        )
            ->join('detail_transaksi_kamar as dtk', 'dtk.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.users_id', $userId);

        // Query untuk transaksi ruangan dengan union
        $transaksi = Transaksi::select(
            'transaksi.jenis_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.total_harga',
            'transaksi.status_transaksi as status',
            'dtr.id as detail_id' // Ambil id dari detail_transaksi_ruangan
        )
            ->join('detail_transaksi_ruangan as dtr', 'dtr.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.users_id', $userId)
            ->union($transaksiKamar)
            ->get();

        return view('tamu.riwayat.riwayatTransaksi', compact('transaksi'));
    }

    public function showDetailRiwayat($jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {

            $data = DB::table('detail_transaksi_kamar as dtk')
                ->leftJoin('kamar as k', 'dtk.kamar_id', '=', 'k.id')
                ->leftJoin('gedung as g', 'k.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi as t', 'dtk.transaksi_id', '=', 't.id')
                ->leftJoin('instansi as i', 'dtk.instansi_id', '=', 'i.id')
                ->where('dtk.id', $id)
                ->select(
                    'k.nomor_kamar',
                    'g.nama_gedung',
                    'i.nama_instansi as instansi',
                    'dtk.id As detail_id',
                    't.*'
                )
                ->first();

            // Perhitungan total hari
            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

            return view('tamu.riwayat.detail', compact('data', 'jenis_transaksi', 'total_hari'));
        } elseif ($jenis_transaksi == 'ruangan') {
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
            // Perhitungan total hari
            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

            return view('tamu.riwayat.detail', compact('data', 'jenis_transaksi', 'total_hari'));
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }
    }

    //== Controller Reservasi Admin dan Pegawai ==
    public function showPReservasi()
    {
        // Query untuk transaksi kamar
        $transaksiKamar = detailTKamar::select(
            'detail_transaksi_kamar.id as detail_id',
            'kamar.nomor_kamar as nama_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.nama',
            'transaksi.nama_instansi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.jenis_transaksi',
            'transaksi.status_transaksi'
        )
            ->leftjoin('kamar', 'detail_transaksi_kamar.kamar_id', '=', 'kamar.id')
            ->leftjoin('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.status_transaksi', 'pending');

        // Query untuk transaksi ruangan
        $transaksiRuangan = detailTRuangan::select(
            'detail_transaksi_ruangan.id as detail_id',
            'ruangan.nama_ruangan as nama_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.nama',
            'transaksi.nama_instansi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.jenis_transaksi',
            'transaksi.status_transaksi'
        )
            ->leftjoin('ruangan', 'detail_transaksi_ruangan.ruangan_id', '=', 'ruangan.id')
            ->leftjoin('transaksi', 'detail_transaksi_ruangan.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.status_transaksi', 'pending');

        // Union query untuk transaksi kamar dan ruangan
        $transaksi = $transaksiKamar
            ->union($transaksiRuangan)
            ->get();

        return view('admin.reservasi.permintaanReservasi', compact('transaksi'));
    }

    public function showDetailPReservasi($jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {
            $data = DetailTKamar::select(
                'k.nomor_kamar',
                'g.nama_gedung',
                'i.nama_instansi AS instansi',
                'i.harga AS harga',
                'detail_transaksi_kamar.id AS detail_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                't.total_harga',
                't.*'
            )
                ->leftJoin('kamar AS k', 'detail_transaksi_kamar.kamar_id', '=', 'k.id')
                ->leftJoin('gedung AS g', 'k.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi AS t', 'detail_transaksi_kamar.transaksi_id', '=', 't.id')
                ->leftJoin('instansi AS i', 'detail_transaksi_kamar.instansi_id', '=', 'i.id')
                ->leftJoin('users AS u', 't.users_id', '=', 'u.id')
                ->where('detail_transaksi_kamar.id', $id)
                ->first();

            return view('admin.reservasi.detailPermintaan', compact('data', 'jenis_transaksi'));
        } elseif ($jenis_transaksi == 'ruangan') {
            $data = DetailTRuangan::select(
                'r.nama_ruangan',
                'r.harga AS harga',
                'g.nama_gedung',
                'detail_transaksi_ruangan.id AS detail_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                't.total_harga',
                't.*'
            )
                ->leftJoin('ruangan AS r', 'detail_transaksi_ruangan.ruangan_id', '=', 'r.id')
                ->leftJoin('gedung AS g', 'r.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi AS t', 'detail_transaksi_ruangan.transaksi_id', '=', 't.id')
                ->leftJoin('users AS u', 't.users_id', '=', 'u.id')
                ->where('detail_transaksi_ruangan.id', $id)
                ->first();

            return view('admin.reservasi.detailPermintaan', compact('data', 'jenis_transaksi'));
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }
    }

    public function showDReservasi()
    {
        // Query untuk transaksi kamar
        $transaksiKamar = detailTKamar::select(
            'detail_transaksi_kamar.id as detail_id',
            'kamar.nomor_kamar as nama_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.nama',
            'transaksi.nama_instansi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.jenis_transaksi',
            'transaksi.status_transaksi'
        )
            ->leftjoin('kamar', 'detail_transaksi_kamar.kamar_id', '=', 'kamar.id')
            ->leftjoin('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.status_transaksi', 'terima');

        // Query untuk transaksi ruangan
        $transaksiRuangan = detailTRuangan::select(
            'detail_transaksi_ruangan.id as detail_id',
            'ruangan.nama_ruangan as nama_transaksi',
            'transaksi.tgl_reservasi',
            'transaksi.nama',
            'transaksi.nama_instansi',
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout',
            'transaksi.jenis_transaksi',
            'transaksi.status_transaksi'
        )
            ->leftjoin('ruangan', 'detail_transaksi_ruangan.ruangan_id', '=', 'ruangan.id')
            ->leftjoin('transaksi', 'detail_transaksi_ruangan.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.status_transaksi', 'terima');

        // Union query untuk transaksi kamar dan ruangan
        $transaksi = $transaksiKamar
            ->union($transaksiRuangan)
            ->get();

        return view('admin.reservasi.daftarReservasi', compact('transaksi'));
    }

    public function showDetailDReservasi($jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {
            $data = DetailTKamar::select(
                'k.nomor_kamar',
                'g.nama_gedung',
                'i.nama_instansi AS instansi',
                'i.harga AS harga',
                'detail_transaksi_kamar.id AS detail_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                't.total_harga',
                't.*'
            )
                ->leftJoin('kamar AS k', 'detail_transaksi_kamar.kamar_id', '=', 'k.id')
                ->leftJoin('gedung AS g', 'k.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi AS t', 'detail_transaksi_kamar.transaksi_id', '=', 't.id')
                ->leftJoin('instansi AS i', 'detail_transaksi_kamar.instansi_id', '=', 'i.id')
                ->leftJoin('users AS u', 't.users_id', '=', 'u.id')
                ->where('detail_transaksi_kamar.id', $id)
                ->first();

            return view('admin.reservasi.detailReservasi', compact('data', 'jenis_transaksi'));
        } elseif ($jenis_transaksi == 'ruangan') {
            $data = DetailTRuangan::select(
                'r.nama_ruangan',
                'r.harga AS harga',
                'g.nama_gedung',
                'detail_transaksi_ruangan.id AS detail_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                't.total_harga',
                't.*'
            )
                ->leftJoin('ruangan AS r', 'detail_transaksi_ruangan.ruangan_id', '=', 'r.id')
                ->leftJoin('gedung AS g', 'r.gedung_id', '=', 'g.id')
                ->leftJoin('transaksi AS t', 'detail_transaksi_ruangan.transaksi_id', '=', 't.id')
                ->leftJoin('users AS u', 't.users_id', '=', 'u.id')
                ->where('detail_transaksi_ruangan.id', $id)
                ->first();

            return view('admin.reservasi.detailReservasi', compact('data', 'jenis_transaksi'));
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }
    }

    public function cancelReservasi($id)
    {
        // Ambil detail transaksi berdasarkan ID
        $detailTransaksi = DetailTKamar::findOrFail($id);
        $transaksi = Transaksi::findOrFail($detailTransaksi->transaksi_id);

        // Ubah status transaksi menjadi batal
        $transaksi->status_transaksi = 'batal'; // atau status sesuai kebutuhan
        $transaksi->save();

        return redirect()->route('riwayat_tamu')->with('success', 'Reservasi berhasil dibatalkan!');
    }

    public function tambahBuktiBayar(Request $request, $id)
    {
        // Ambil detail transaksi berdasarkan ID
        $detailTransaksi = DetailTKamar::findOrFail($id);
        $transaksi = Transaksi::findOrFail($detailTransaksi->transaksi_id);
    
        // Validasi bukti_bayar
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Upload dokumen jika ada
        try {
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'Transaksi_' . time() . '.' . $extension;
                $file->move(public_path('tamu/assets/img/bukti_bayar'), $fileName);
                $transaksi->bukti_bayar = 'tamu/assets/img/bukti_bayar/' . $fileName;
            }
        } catch (\Exception $e) {
            return back()->withError('Gagal mengupload bukti pembayaran: ' . $e->getMessage())->withInput();
        }
    
        $transaksi->save();
    
        return redirect()->route('riwayat_tamu')->with('success', 'Reservasi berhasil dibatalkan dan bukti bayar berhasil diunggah!');
    }
}
