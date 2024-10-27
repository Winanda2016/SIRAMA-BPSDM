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

            $no_hp = $data->nohp;
            if (!preg_match('/^\+\d+/', $no_hp)) {
                $no_hp = '+62' . ltrim($no_hp, '0');
            }

            $kamar = detailTKamar::select(
                'detail_transaksi_kamar.id as detail_id',
                'kamar.nomor_kamar',
                'gedung.nama_gedung'
            )
                ->leftJoin('kamar', 'detail_transaksi_kamar.kamar_id', '=', 'kamar.id')
                ->leftJoin('gedung', 'kamar.gedung_id', '=', 'gedung.id')
                ->where('detail_transaksi_kamar.transaksi_id', $id)
                ->get();

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

            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

            return view(
                'admin.transaksi.detailTransaksi',
                compact('data', 'kamar', 'AddKamar', 'jenis_transaksi', 'total_hari', 'no_hp')
            );
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
                'transaksi.*'
            )
                ->leftJoin('detail_transaksi_ruangan AS dtr', 'transaksi.id', '=', 'dtr.transaksi_id')
                ->leftJoin('jenis_instansi AS i', 'transaksi.jinstansi_id', '=', 'i.id')
                ->leftJoin('ruangan AS r', 'dtr.ruangan_id', '=', 'r.id')
                ->leftJoin('gedung AS g', 'r.gedung_id', '=', 'g.id')
                ->leftJoin('users AS u', 'transaksi.users_id', '=', 'u.id')
                ->where('transaksi.id', $id)
                ->first();


            $no_hp = $data->nohp;

            if (!preg_match('/^\+\d+/', $no_hp)) {
                $no_hp = '+62' . ltrim($no_hp, '0');
            }

            $tgl_checkin = \Carbon\Carbon::parse($data->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($data->tgl_checkout);
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

            return view(
                'admin.transaksi.detailTransaksi',
                compact('data', 'jenis_transaksi', 'total_hari', 'no_hp')
            );
        } else {
            abort(404);
        }
    }

    public function terimaReservasiRuangan($jenis_transaksi, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'terima';
        $transaksi->save();

        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]
        );
    }

    public function tolakReservasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_transaksi = 'tolak';
        $transaksi->save();

        return redirect()->route('riwayat_transaksi')
            ->with('success', 'Reservasi ditolak!');
    }

    public function cancelReservasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_transaksi = 'batal';
        $transaksi->save();

        return redirect()->route('riwayat_transaksi')
            ->with('success', 'Reservasi berhasil dibatalkan!');
    }

    //terima reservasi kamar
    public function tambahKamar(Request $request, $jenis_transaksi, $id)
    {
        $validatedData = $request->validate([
            'kamar_ids' => 'required|array',
            'kamar_ids.*' => 'exists:kamar,id',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_transaksi = 'terima';
        $transaksi->save();

        foreach ($validatedData['kamar_ids'] as $kamarId) {
            $detailTransaksi = new DetailTKamar();
            $detailTransaksi->transaksi_id = $id;
            $detailTransaksi->kamar_id = $kamarId;
            $detailTransaksi->save();
        }

        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]
        );
    }

    public function hapusKamar($jenis_transaksi, $id)
    {
        $detailTransaksi = DetailTKamar::findOrFail($id);

        $kamarId = $detailTransaksi->kamar_id;

        $detailTransaksi->delete();

        $statusKamar = Kamar::findOrFail($kamarId);
        $statusKamar->status = 'kosong';
        $statusKamar->save();

        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $jenis_transaksi, 'id' => $detailTransaksi->transaksi_id]
        );
    }

    public function CheckIn($jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {
            $kamarIds = DetailTKamar::where('transaksi_id', $id)
                ->pluck('kamar_id');
            Kamar::whereIn('id', $kamarIds)->update(['status' => 'terisi']);
        } elseif ($jenis_transaksi == 'ruangan') {
            $ruanganIds = DetailTRuangan::where('transaksi_id', $id)
                ->pluck('ruangan_id');
            Ruangan::whereIn('id', $ruanganIds)->update(['status' => 'terisi']);
        } else {
            abort(404);
        }

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'checkin';
        $transaksi->save();

        return redirect()->route('daftar_tamu');
    }

    public function CheckOut($jenis_transaksi, $id)
    {
        if ($jenis_transaksi == 'kamar') {
            $kamarIds = DetailTKamar::where('transaksi_id', $id)
                ->pluck('kamar_id');

            Kamar::whereIn('id', $kamarIds)->update(['status' => 'kosong']);
        } elseif ($jenis_transaksi == 'ruangan') {
            $ruanganIds = DetailTRuangan::where('transaksi_id', $id)
                ->pluck('ruangan_id');

            Ruangan::whereIn('id', $ruanganIds)->update(['status' => 'kosong']);
        } else {
            abort(404);
        }

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'checkout';
        $transaksi->save();

        return redirect()->route('riwayat_transaksi');
    }

    public function diskon(Request $request, $jenis_transaksi, $id)
    {
        $validatedData = $request->validate([
            'diskon' => 'required|numeric|min:0|max:100'
        ]);

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
        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]
        );
    }

    public function showDReservasi()
    {
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
        $jenisTransaksi = $request->input('jenis_transaksi');
        $statusTransaksi = $request->input('status_transaksi');

        $query = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->orderBy('transaksi.updated_at', 'desc');

        // Filter berdasarkan tanggal jika ada
        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tgl_checkin', [$startDate, $endDate])
                ->whereBetween('transaksi.tgl_checkout', [$startDate, $endDate]);
        }

        // Filter berdasarkan jenis transaksi jika ada
        if ($jenisTransaksi && $jenisTransaksi !== '') {
            $query->where('jenis_transaksi', $jenisTransaksi);
        }

        // Filter berdasarkan status transaksi jika ada
        if ($statusTransaksi && is_array($statusTransaksi)) {
            $query->whereIn('status_transaksi', $statusTransaksi);
        }

        $transaksi = $query->get();

        return view('admin.transaksi.riwayatTransaksi', compact('transaksi'));
    }

    public function daftarTamu()
    {
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

    public function tambahBuktiBayar(Request $request, $jenis_transaksi, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload dokumen jika ada
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

        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]);
    }

    public function hapusBuktiBayar($jenis_transaksi, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Hapus file dari storage
        $filePath = public_path($transaksi->bukti_bayar);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Update field bukti_bayar menjadi null
        $transaksi->bukti_bayar = null;
        $transaksi->save();

        return redirect()->route('detail_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $id]);
    }

    //== Transaksi langsung ==
    public function createReservasi($jenis_transaksi)
    {
        $jinstansi = JInstansi::all();
        $ruangan = Ruangan::all();
        return view('admin.reservasi.tambahReservasi', compact('jinstansi', 'ruangan', 'jenis_transaksi'));
    }

    public function storeReservasi(Request $request, $jenis_transaksi)
    {
        Log::info('Store method called');
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'ruangan_id' => 'nullable|exists:ruangan,id',
            'nohp' => 'required|string|max:15',
            'nama_instansi' => 'required|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'dokumen_reservasi' => 'nullable|file|max:2024|mimes:pdf,doc,docx',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // Jika jenis transaksi adalah kamar, tambahkan validasi jumlah_ruangan
        if ($jenis_transaksi == 'kamar') {
            $request->validate([
                'jumlah_ruangan' => 'required|integer|min:1',
            ]);
            $validatedData['jumlah_ruangan'] = $request->input('jumlah_ruangan');
        }
        Log::info('Data yang tervalidasi:', $validatedData);

        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        if ($jenis_transaksi == 'kamar') {
            $jinstansi = JInstansi::findOrFail($validatedData['jinstansi_id']);
            $total_harga = $jinstansi->harga * $validatedData['jumlah_orang'] * $total_hari;
        } elseif ($jenis_transaksi == 'ruangan') {
            $ruangan = Ruangan::findOrFail($validatedData['ruangan_id']);
            $total_harga = $ruangan->harga * ($total_hari + 1);
        }

        // Cek jumlah ruangan jika jenis transaksi adalah kamar
        $jumlah_ruangan = isset($validatedData['jumlah_ruangan']) ? $validatedData['jumlah_ruangan'] : 1;

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
        $transaksi->jumlah_ruangan = $jumlah_ruangan;
        $transaksi->jinstansi_id = $validatedData['jinstansi_id'];
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jenis_transaksi = $jenis_transaksi;
        $transaksi->status_transaksi = 'pending';
        $transaksi->diskon = 0;
        // Upload dokumen jika ada
        if ($request->hasFile('dokumen_reservasi')) {
            $file = $request->file('dokumen_reservasi');

            $datePrefix = now()->format('Ymd');
            $fileName = $datePrefix . '_' . 'Reservasi' . $jenis_transaksi . '_' . $file->getClientOriginalName();

            $file->storeAs('tamu/assets/dokumen_reservasi/', $fileName);
            $transaksi->dokumen_reservasi = $fileName;
            Log::info('File dokumen_reservasi diupload:', ['file_name' => $fileName]);
        }

        if ($jenis_transaksi == 'kamar') {
            $transaksi->jumlah_ruangan = $validatedData['jumlah_ruangan'];
            $transaksi->save();
        } elseif ($jenis_transaksi == 'ruangan') {
            $transaksi->jumlah_ruangan = 1;
            $transaksi->save();
            // Simpan detail transaksi ruangan
            $detailTransaksi = new detailTRuangan();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->ruangan_id = $ruangan->id;
            $detailTransaksi->save();
        }

        return redirect()->route('permintaan_reservasi')
            ->with('success', 'Reservasi berhasil ditambahkan.');
    }
}
