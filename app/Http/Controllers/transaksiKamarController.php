<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\detailTKamar;
use App\Models\JInstansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class transaksiKamarController extends Controller
{
    public function index()
    {
        $jinstansi = JInstansi::orderBy('id', 'desc')->get();
        $kamarTersedia = Kamar::where('status', 'kosong')->count();

        return view('tamu.kamar.detailKamar', compact('kamarTersedia', 'jinstansi'));
    }

    public function create()
    {
        $jinstansi = JInstansi::all();
        return view('tamu.kamar.reservasiKamar', compact('jinstansi'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called');
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nohp' => 'required|string|max:20',
            'nama_instansi' => 'required|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1',
            'dokumen_reservasi' => 'nullable|file|max:2024|mimes:pdf,doc,docx'
        ]);

        Log::info('Data yang tervalidasi:', $validatedData);

        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        $jinstansi = JInstansi::find($validatedData['jinstansi_id']);
        if (!$jinstansi) {
            return redirect()->back()->withInput()->withErrors(['jinstansi_id' => 'Jenis Instansi tidak valid.']);
        }

        $total_harga = $jinstansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        $transaksi = new Transaksi();
        $transaksi->users_id = auth()->user()->id;
        $transaksi->nama = $validatedData['nama'];
        $transaksi->nohp = $validatedData['nohp'];
        $transaksi->nama_instansi = $validatedData['nama_instansi'];
        $transaksi->tgl_reservasi = $validatedData['tgl_reservasi'];
        $transaksi->tgl_checkin = $validatedData['tgl_checkin'];
        $transaksi->tgl_checkout = $validatedData['tgl_checkout'];
        $transaksi->jumlah_orang = $validatedData['jumlah_orang'];
        $transaksi->jumlah_ruangan = $validatedData['jumlah_ruangan'];
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jinstansi_id = $validatedData['jinstansi_id'];
        $transaksi->jenis_transaksi = 'kamar';
        $transaksi->status_transaksi = 'pending';
        $transaksi->diskon = 0;
        // Handle file upload
        if ($request->hasFile('dokumen_reservasi')) {
            // Cek apakah ada file lama
            if ($transaksi->dokumen_reservasi && file_exists(public_path($transaksi->dokumen_reservasi))) {
                // Hapus file lama
                unlink(public_path($transaksi->dokumen_reservasi));
            }

            $file = $request->file('dokumen_reservasi');
            $file->getClientOriginalExtension();

            // Format tanggal saat ini
            $datePrefix = now()->format('Ymd');
            $newFileName = $datePrefix . '_' . 'Reservasi kamar' . '_' . $file->getClientOriginalName();

            // Pindahkan file baru ke direktori penyimpanan
            $file->move(public_path('dokumen/reservasi'), $newFileName);

            // Perbarui path file baru di database
            $transaksi->dokumen_reservasi = 'dokumen/reservasi/' . $newFileName;
        }

        $transaksi->save();

        return redirect()->route('riwayat_tamu')->with('success', 'Reservasi berhasil dilakukan.');
    }

    public function edit($id)
    {
        $jinstansi = JInstansi::all();
        $data = DB::table('transaksi as t')
            ->leftJoin('jenis_instansi as i', 't.jinstansi_id', '=', 'i.id')
            ->where('t.id', $id)
            ->select(
                'i.id as jinstansi_id',
                'i.nama_instansi as jinstansi',
                't.id As transaksi_id',
                't.*'
            )
            ->first();
        return view('tamu.kamar.editReservasi', compact('data', 'jinstansi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nohp' => 'required|string|max:20',
            'nama_instansi' => 'nullable|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1',
            'dokumen_reservasi' => 'nullable|file|max:2024|mimes:pdf,doc,docx'
        ]);

        // Hitung total hari
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        // Cari jinstansi berdasarkan id
        $jinstansi = JInstansi::find($validatedData['jinstansi_id']);
        if (!$jinstansi) {
            return redirect()->back()->withInput()->withErrors(['jinstansi_id' => 'Jenis Instansi tidak valid.']);
        }

        // Hitung total harga
        $total_harga = $jinstansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        // Update juga transaksi terkait jika perlu
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->tgl_reservasi = $request->tgl_reservasi;
        $transaksi->nama = $request->nama;
        $transaksi->nohp = $request->nohp;
        $transaksi->nama_instansi = $request->nama_instansi;
        $transaksi->tgl_checkin = $request->tgl_checkin;
        $transaksi->tgl_checkout = $request->tgl_checkout;
        $transaksi->jumlah_orang = $request->jumlah_orang;
        $transaksi->jumlah_ruangan = $request->jumlah_ruangan;
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jinstansi_id = $request->jinstansi_id;
        // Handle file upload
        if ($request->hasFile('dokumen_reservasi')) {
            // Cek apakah ada file lama
            if ($transaksi->dokumen_reservasi && file_exists(public_path($transaksi->dokumen_reservasi))) {
                // Hapus file lama
                unlink(public_path($transaksi->dokumen_reservasi));
            }

            $file = $request->file('dokumen_reservasi');
            $file->getClientOriginalExtension();

            // Format tanggal saat ini
            $datePrefix = now()->format('Ymd');
            $newFileName = $datePrefix . '_' . 'Reservasi kamar' . '_' . $file->getClientOriginalName();

            // Pindahkan file baru ke direktori penyimpanan
            $file->move(public_path('dokumen/reservasi'), $newFileName);

            // Perbarui path file baru di database
            $transaksi->dokumen_reservasi = 'dokumen/reservasi/' . $newFileName;
        }

        $transaksi->save();

        // Redirect ke halaman detail riwayat transaksi
        return redirect()->route('detail_riwayat', [
            'jenis_transaksi' => $transaksi->jenis_transaksi,
            'id' => $transaksi->id
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

    // == PEGAWAI ==
    public function editReservasiPegawai($id)
    {
        $jinstansi = JInstansi::all();
        $data = DB::table('transaksi as t')
            ->leftJoin('jenis_instansi as i', 't.jinstansi_id', '=', 'i.id')
            ->where('t.id', $id)
            ->select(
                'i.id as jinstansi_id',
                'i.nama_instansi as jinstansi',
                't.id As transaksi_id',
                't.*'
            )
            ->first();
        return view('admin.reservasi.kamar.editReservasi', compact('data', 'jinstansi'));
    }

    public function updateReservasiPegawai(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nohp' => 'required|string|max:12',
            'nama_instansi' => 'nullable|string|max:100',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1',
            'dokumen_reservasi' => 'nullable|file|max:2024|mimes:pdf,doc,docx'
        ]);

        // Hitung total hari
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        // Cari jinstansi berdasarkan id
        $jinstansi = JInstansi::find($validatedData['jinstansi_id']);
        if (!$jinstansi) {
            return redirect()->back()->withInput()->withErrors(['jinstansi_id' => 'Jenis Instansi tidak valid.']);
        }

        // Hitung total harga
        $total_harga = $jinstansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        // Update juga transaksi terkait jika perlu
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->tgl_reservasi = $request->tgl_reservasi;
        $transaksi->nama = $request->nama;
        $transaksi->nohp = $request->nohp;
        $transaksi->nama_instansi = $request->nama_instansi;
        $transaksi->tgl_checkin = $request->tgl_checkin;
        $transaksi->tgl_checkout = $request->tgl_checkout;
        $transaksi->jumlah_orang = $request->jumlah_orang;
        $transaksi->jumlah_ruangan = $request->jumlah_ruangan;
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jinstansi_id = $request->jinstansi_id;
        $transaksi->save();

        // Redirect ke halaman detail riwayat transaksi
        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $transaksi->jenis_transaksi, 'id' => $id]
        )->with('success', 'Data Reservasi berhasil diperbarui!');
    }

    public function createCheckIn()
    {
        $jinstansi = JInstansi::all();
        return view('admin.transaksi.formCheckin', compact('jinstansi'));
    }

    public function storeCheckIn(Request $request)
    {
        Log::info('Store method called');
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nohp' => 'required|string|max:20',
            'nama_instansi' => 'required|string|max:100',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1' // Pastikan nama ini konsisten dengan nama field di form
        ]);

        Log::info('Data yang tervalidasi:', $validatedData);

        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout);

        $jinstansi = JInstansi::find($validatedData['jinstansi_id']);
        if (!$jinstansi) {
            return redirect()->back()->withInput()->withErrors(['jinstansi_id' => 'Jenis Instansi tidak valid.']);
        }

        $total_harga = $jinstansi->harga * $validatedData['jumlah_orang'] * $total_hari;

        $transaksi = new Transaksi();
        $transaksi->users_id = auth()->user()->id;
        $transaksi->nama = $validatedData['nama'];
        $transaksi->nohp = $validatedData['nohp'];
        $transaksi->nama_instansi = $validatedData['nama_instansi'];
        $transaksi->tgl_checkin = $validatedData['tgl_checkin'];
        $transaksi->tgl_checkout = $validatedData['tgl_checkout'];
        $transaksi->jumlah_orang = $validatedData['jumlah_orang'];
        $transaksi->jumlah_ruangan = $validatedData['jumlah_ruangan']; // Sesuaikan nama ini dengan field di form
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jinstansi_id = $validatedData['jinstansi_id'];
        $transaksi->tgl_reservasi = Carbon::now()->toDateString();
        $transaksi->jenis_transaksi = 'kamar';
        $transaksi->status_transaksi = 'checkin';
        $transaksi->diskon = 0;
        $transaksi->save();

        Log::info('Transaksi berhasil disimpan:', ['transaksi_id' => $transaksi->id]);

        return redirect()->route(
            'detail_transaksi',
            ['jenis_transaksi' => $transaksi->jenis_transaksi, 'id' => $transaksi->id]
        )->with('success', 'Data Reservasi berhasil diperbarui!');
    }
}
