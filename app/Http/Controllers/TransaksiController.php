<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Ruangan;
use App\Models\detailTKamar;
use App\Models\JInstansi;
use App\Models\detailTRuangan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //== Controller Reservasi Admin dan Pegawai ==
    public function showPReservasi()
    {
        $transaksi = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->where('transaksi.status_transaksi', 'pending')
            ->orderBy('tgl_reservasi', 'asc')
            ->get();

        return view('admin.reservasi.permintaanReservasi', compact('transaksi'));
    }

    public function detailTransaksi(Request $request, $jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {
            $data = Transaksi::select(
                'i.nama_instansi AS jinstansi',
                'i.harga AS jinstansi_harga',
                'transaksi.id AS transaksi_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                'transaksi.total_harga',
                'transaksi.*'
            )
                ->leftJoin('detail_transaksi_kamar AS dtk', 'transaksi.id', '=', 'dtk.transaksi_id')
                ->leftJoin('jenis_instansi AS i', 'transaksi.jinstansi_id', '=', 'i.id')
                ->leftJoin('kamar AS k', 'dtk.kamar_id', '=', 'k.id')
                ->leftJoin('gedung AS g', 'k.gedung_id', '=', 'g.id')
                ->leftJoin('users AS u', 'transaksi.users_id', '=', 'u.id')
                ->where('transaksi.id', $id)
                ->first();

            $kamar = detailTKamar::select(
                'detail_transaksi_kamar.id as detail_id',
                'kamar.nomor_kamar',
                'gedung.nama_gedung'
            )
                ->leftJoin('kamar', 'detail_transaksi_kamar.kamar_id', '=', 'kamar.id')
                ->leftJoin('gedung', 'kamar.gedung_id', '=', 'gedung.id')
                ->where('detail_transaksi_kamar.transaksi_id', $id)
                ->get();


            //ambil tanggal check in dan check out
            $tglCheckin = $data->tgl_checkin;
            $tglCheckout = $data->tgl_checkout;

            $AddKamar = Kamar::select(
                'kamar.id as kamar_id',
                'kamar.nomor_kamar',
                'kamar.status as status_kamar',
                'gedung.nama_gedung',
                DB::raw('COALESCE(transaksi.status_transaksi, "kosong") as status_transaksi')
            )
                ->leftJoin('gedung', 'gedung.id', '=', 'kamar.gedung_id')
                ->leftJoin('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
                ->leftJoin('transaksi', function ($join) use ($tglCheckin, $tglCheckout) {
                    $join->on('detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
                        ->where(function ($query) use ($tglCheckin, $tglCheckout) {
                            $query->where('transaksi.tgl_checkin', '<=', $tglCheckout)
                                ->where('transaksi.tgl_checkout', '>=', $tglCheckin);
                        });
                })
                ->orderBy('kamar.nomor_kamar')
                ->get();

            // Perhitungan total hari
            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

            return view('admin.transaksi.detailTransaksi', compact('data', 'kamar', 'AddKamar', 'jenis_transaksi', 'total_hari'));
        } elseif ($jenis_transaksi == 'ruangan') {
            $data = Transaksi::select(
                'i.nama_instansi AS jinstansi',
                'r.nama_ruangan',
                'r.harga AS ruangan_harga',
                'g.nama_gedung',
                'transaksi.id AS transaksi_id',
                'u.name AS nama_users',
                'u.email AS email_users',
                'u.no_hp AS nohp_users',
                'u.foto AS foto_users',
                'transaksi.*'
            )
                ->leftJoin('detail_transaksi_ruangan AS dtr', 'transaksi.id', '=', 'dtr.transaksi_id')
                ->leftJoin('jenis_instansi AS i', 'transaksi.jinstansi_id', '=', 'i.id')
                ->leftJoin('ruangan AS r', 'dtr.ruangan_id', '=', 'r.id')
                ->leftJoin('gedung AS g', 'r.gedung_id', '=', 'g.id')
                ->leftJoin('users AS u', 'transaksi.users_id', '=', 'u.id')
                ->where('transaksi.id', $id)
                ->first();

            // Perhitungan total hari
            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

            return view('admin.transaksi.detailTransaksi', compact('data', 'jenis_transaksi', 'total_hari'));
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }
    }

    public function terimaReservasiRuangan($jenis_transaksi, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'terima';
        $transaksi->save();

        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]);
    }

    public function tolakReservasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Ubah status transaksi menjadi batal
        $transaksi->status_transaksi = 'tolak'; // atau status sesuai kebutuhan
        $transaksi->save();

        return redirect()->route('riwayat_transaksi')->with('success', 'Reservasi ditolak!');
    }

    //terima reservasi kamar
    public function tambahKamar(Request $request, $jenis_transaksi, $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'kamar_ids' => 'required|array',
            'kamar_ids.*' => 'exists:kamar,id', // Validasi setiap ID kamar harus ada di tabel kamar
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Ubah status transaksi menjadi
        $transaksi->status_transaksi = 'terima'; // atau status sesuai kebutuhan
        $transaksi->save();

        // Simpan data baru
        foreach ($validatedData['kamar_ids'] as $kamarId) {
            $detailTransaksi = new DetailTKamar();
            $detailTransaksi->transaksi_id = $id; // Menggunakan $id sebagai transaksi_id
            $detailTransaksi->kamar_id = $kamarId;
            $detailTransaksi->save();
        }

        // Redirect ke route detail_transaksi dengan parameter yang diperlukan
        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]);
    }

    public function hapusKamar($jenis_transaksi, $id)
    {
        // Temukan detail transaksi kamar yang akan dihapus
        $detailTransaksi = DetailTKamar::findOrFail($id);

        // Temukan ID kamar dari detail transaksi
        $kamarId = $detailTransaksi->kamar_id;

        // Hapus detail transaksi kamar
        $detailTransaksi->delete();

        // Perbarui status kamar menjadi 'kosong'
        $statusKamar = Kamar::findOrFail($kamarId);
        $statusKamar->status = 'kosong'; // Atur status kamar sesuai kebutuhan
        $statusKamar->save();

        // Redirect ke halaman detail transaksi
        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $detailTransaksi->transaksi_id]);
    }

    public function CheckIn($jenis_transaksi, $id)
    {
        // Cek jenis transaksi dan ambil detail transaksi yang relevan
        if ($jenis_transaksi == 'kamar') {
            // Ambil ID kamar yang terkait dengan transaksi ini
            $kamarIds = DetailTKamar::where('transaksi_id', $id)
                ->pluck('kamar_id');

            // Perbarui status kamar menjadi 'terisi'
            Kamar::whereIn('id', $kamarIds)->update(['status' => 'terisi']);
        } elseif ($jenis_transaksi == 'ruangan') {
            // Ambil ID ruangan yang terkait dengan transaksi ini
            $ruanganIds = DetailTRuangan::where('transaksi_id', $id)
                ->pluck('ruangan_id');

            // Perbarui status ruangan menjadi 'terisi'
            Ruangan::whereIn('id', $ruanganIds)->update(['status' => 'terisi']);
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }

        // Temukan transaksi dan perbarui statusnya
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'checkin'; // Ubah status sesuai kebutuhan
        $transaksi->save();

        return redirect()->route('daftar_tamu');
    }

    public function CheckOut($jenis_transaksi, $id)
    {
        // Cek jenis transaksi dan ambil detail transaksi yang relevan
        if ($jenis_transaksi == 'kamar') {
            // Ambil ID kamar yang terkait dengan transaksi ini
            $kamarIds = DetailTKamar::where('transaksi_id', $id)
                ->pluck('kamar_id');

            Kamar::whereIn('id', $kamarIds)->update(['status' => 'kosong']);
        } elseif ($jenis_transaksi == 'ruangan') {
            // Ambil ID ruangan yang terkait dengan transaksi ini
            $ruanganIds = DetailTRuangan::where('transaksi_id', $id)
                ->pluck('ruangan_id');

            Ruangan::whereIn('id', $ruanganIds)->update(['status' => 'kosong']);
        } else {
            abort(404); // Tambahkan handle untuk jenis transaksi lainnya jika diperlukan
        }

        // Temukan transaksi dan perbarui statusnya
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'checkout'; // Ubah status sesuai kebutuhan
        $transaksi->save();

        return redirect()->route('riwayat_transaksi');
    }

    public function diskon(Request $request, $jenis_transaksi, $id)
    {
        // Validasi input diskon
        $validatedData = $request->validate([
            'diskon' => 'required|numeric|min:0|max:100' // Diskon dalam persen (0-100)
        ]);

        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        $harga = $transaksi->harga;

        // Hitung diskon
        $diskon = $validatedData['diskon'];
        $total_harga = $harga - ($harga * ($diskon / 100));

        // Update total harga transaksi dengan diskon
        $transaksi->total_harga = $total_harga;
        $transaksi->diskon = $diskon; // Simpan diskon jika perlu
        $transaksi->save();

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]);
    }

    public function showDReservasi()
    {
        // Query untuk transaksi kamar
        $transaksi = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->where('transaksi.status_transaksi', 'terima')
            ->orderBy('tgl_reservasi', 'asc')
            ->get();

        return view('admin.reservasi.daftarReservasi', compact('transaksi'));
    }

    public function riwayatTransaksi(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk transaksi dengan filter tanggal checkin dan checkout
        $query = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->orderBy('transaksi.tgl_checkout', 'asc');

        // Tambahkan filter jika parameter tanggal ada
        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tgl_checkin', [$startDate, $endDate])
                ->whereBetween('transaksi.tgl_checkout', [$startDate, $endDate]);
        }

        // Filter berdasarkan jenis transaksi
        if ($request->has('jenis_transaksi') && $request->input('jenis_transaksi') !== '') {
            $query->where('jenis_transaksi', $request->input('jenis_transaksi'));
        }

        $transaksi = $query->get();

        return view('admin.transaksi.riwayatTransaksi', compact('transaksi'));
    }

    public function daftarTamu()
    {
        // Query untuk transaksi kamar
        $transaksi = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->where('transaksi.status_transaksi', 'checkin')
            ->orderBy('tgl_checkout', 'asc')
            ->get();

        return view('admin.transaksi.daftarTamu', compact('transaksi'));
    }

    public function createReservasiKamar()
    {
        $jinstansi = JInstansi::all();
        return view('admin.reservasi.kamar.tambahReservasi', compact('jinstansi'));
    }
}
