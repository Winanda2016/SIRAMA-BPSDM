<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\detailTRuangan;
use App\Models\Transaksi;
use App\Models\JInstansi;
use App\Models\Gedung;
use Illuminate\Support\Facades\Log;
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
        $jinstansi = JInstansi::all();
        $ruangan = Ruangan::findOrFail($id);
        return view('tamu.ruangan.reservasiRuangan', compact('ruangan', 'jinstansi'));
    }

    public function store(Request $request)
    {
        Log::info('Data yang diterima:', $request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nama_instansi' => 'nullable|string|max:100',
            'nohp' => 'required|string|max:20',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,id',
            'dokumen_reservasi' => 'required|file|max:1024|mimes:pdf,doc,docx'
        ]);

        Log::info('Data yang tervalidasi:', $validatedData);


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
        $transaksi->jinstansi_id = $validatedData['jinstansi_id'];
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;
        $transaksi->jenis_transaksi = 'ruangan';
        $transaksi->status_transaksi = 'pending';
        $transaksi->jumlah_ruangan = 1;
        $transaksi->diskon = 0;
        // Upload dokumen jika ada
        if ($request->hasFile('dokumen_reservasi')) {
            $file = $request->file('dokumen_reservasi');

            $datePrefix = now()->format('YmdHis');
            $fileName = $datePrefix . '_' . $file->getClientOriginalName();

            $file->storeAs('tamu/assets/dokumen_reservasi/ruangan/', $fileName); // Simpan di storage/app/public/dokumen
            $transaksi->dokumen_reservasi = $fileName;
            Log::info('File dokumen_reservasi diupload:', ['file_name' => $fileName]);
        }
        $transaksi->save();
        Log::info('Transaksi berhasil disimpan:', ['transaksi_id' => $transaksi->id]);


        // Simpan detail transaksi ruangan
        $detailTransaksi = new detailTRuangan();
        $detailTransaksi->transaksi_id = $transaksi->id;
        $detailTransaksi->ruangan_id = $ruangan->id;
        $detailTransaksi->save();

        Log::info('Detail transaksi ruangan berhasil disimpan:', ['detail_transaksi_id' => $detailTransaksi->id]);

        return redirect()->route('riwayat_tamu')->with('success', 'Reservasi berhasil disimpan.');
    }

    public function edit($id)
    {
        $jinstansi = JInstansi::all();
        $data = DB::table('detail_transaksi_ruangan as dtr')
            ->leftJoin('ruangan as r', 'dtr.ruangan_id', '=', 'r.id')
            ->leftJoin('gedung as g', 'r.gedung_id', '=', 'g.id')
            ->leftJoin('transaksi as t', 'dtr.transaksi_id', '=', 't.id')
            ->leftJoin('jenis_instansi as i', 't.jinstansi_id', '=', 'i.id')
            ->where('dtr.id', $id)
            ->select(
                'i.id as jinstansi_id',
                'i.nama_instansi as jinstansi',
                'r.nama_ruangan as nama_ruangan',
                'r.harga',
                'g.nama_gedung',
                'dtr.id As detail_id',
                't.*'
            )
            ->first();
        return view('tamu.ruangan.editReservasi', compact('data', 'jinstansi'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Request data:', $request->all());
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nama_instansi' => 'nullable|string|max:100',
            'nohp' => 'required|string|max:20',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1',
            'dokumen_reservasi' => 'nullable|file|max:1024|mimes:pdf,doc,docx'
        ]);

        // Debugging: Log validated data

        // Proses perhitungan total hari dan total harga
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

        // Ambil data detail transaksi ruangan
        $detailTransaksi = DetailTRuangan::findOrFail($id);

        // Ambil ID ruangan dari detail transaksi
        $ruanganId = $detailTransaksi->ruangan_id;

        // Ambil data ruangan
        $ruangan = Ruangan::findOrFail($ruanganId);
        $total_harga = $ruangan->harga * $total_hari;

        // Update detail transaksi ruangan
        $detailTransaksi->fill($validatedData);
        $detailTransaksi->save();

        // Update juga transaksi terkait jika perlu
        $transaksi = Transaksi::findOrFail($detailTransaksi->transaksi_id);
        $transaksi->tgl_reservasi = $request->tgl_reservasi;
        $transaksi->nama = $request->nama;
        $transaksi->nohp = $request->nohp;
        $transaksi->jinstansi_id = $request->jinstansi_id;
        $transaksi->nama_instansi = $request->nama_instansi;
        $transaksi->tgl_checkin = $request->tgl_checkin;
        $transaksi->tgl_checkout = $request->tgl_checkout;
        $transaksi->jumlah_orang = $request->jumlah_orang;
        $transaksi->harga = $total_harga;
        $transaksi->total_harga = $total_harga;

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
            $datePrefix = now()->format('YmdHis');
            $newFileName = $datePrefix . '_' . $file->getClientOriginalName();

            // Pindahkan file baru ke direktori penyimpanan
            $file->move(public_path('tamu/assets/dokumen_reservasi/ruangan'), $newFileName);

            // Perbarui path file baru di database
            $transaksi->dokumen_reservasi = 'tamu/assets/dokumen_reservasi/ruangan/' . $newFileName;
        }

        $transaksi->save();

        Log::info('Detail transaksi ruangan berhasil disimpan:', ['detail_transaksi_id' => $transaksi->id]);

        return redirect()->route('detail_riwayat', [
            'jenis_transaksi' => $transaksi->jenis_transaksi,
            'id' => $transaksi->id
        ])->with('success', 'Data Reservasi berhasil diperbarui!');
    }

    public function editReservasiAdmin($id)
    {
        $jinstansi = JInstansi::all();
        $data = Transaksi::select(
            'i.id as jinstansi_id',
            'i.nama_instansi AS jinstansi',
            'r.nama_ruangan',
            'r.harga AS harga',
            'g.nama_gedung',
            'transaksi.id AS transaksi_id',
            'transaksi.*'
        )
            ->leftJoin('detail_transaksi_ruangan AS dtr', 'transaksi.id', '=', 'dtr.transaksi_id')
            ->leftJoin('jenis_instansi AS i', 'transaksi.jinstansi_id', '=', 'i.id')
            ->leftJoin('ruangan AS r', 'dtr.ruangan_id', '=', 'r.id')
            ->leftJoin('gedung AS g', 'r.gedung_id', '=', 'g.id')
            ->first();

        return view('admin.reservasi.ruangan.editreservasi', compact('data', 'jinstansi'));
    }

    public function updateReservasiAdmin(Request $request, $id)
    {
        Log::info('Request data:', $request->all());

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jinstansi_id' => 'required|exists:jenis_instansi,id',
            'nama_instansi' => 'nullable|string|max:100',
            'nohp' => 'required|string|max:20',
            'tgl_reservasi' => 'required|date_format:Y-m-d',
            'tgl_checkin' => 'required|date_format:Y-m-d',
            'tgl_checkout' => 'required|date_format:Y-m-d',
            'jumlah_orang' => 'required|integer|min:1'
        ]);

        Log::info('Data yang tervalidasi:', $validatedData);

        // Proses perhitungan total hari dan total harga
        $tgl_checkin = Carbon::parse($validatedData['tgl_checkin']);
        $tgl_checkout = Carbon::parse($validatedData['tgl_checkout']);
        $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;

        // Ambil data transaksi
        $transaksi = Transaksi::findOrFail($id);

        // Ambil ID detail transaksi ruangan berdasarkan ID transaksi
        $detailTransaksi = DetailTRuangan::where('transaksi_id', $transaksi->id)->firstOrFail();

        // Ambil ID ruangan dari detail transaksi
        $ruanganId = $detailTransaksi->ruangan_id;

        // Ambil data ruangan
        $ruangan = Ruangan::findOrFail($ruanganId);
        $harga = $ruangan->harga * $total_hari;

        if ($transaksi->diskon > 0) {
            $total_harga = $harga - ($harga * ($transaksi->diskon / 100));
        } else {
            $total_harga = $harga; // Jika diskon 0, maka harga tidak berubah
        }

        // Update detail transaksi ruangan
        $detailTransaksi->fill($validatedData);
        $detailTransaksi->save();

        // Update transaksi terkait
        $transaksi->tgl_reservasi = $request->tgl_reservasi;
        $transaksi->nama = $request->nama;
        $transaksi->nohp = $request->nohp;
        $transaksi->jinstansi_id = $request->jinstansi_id;
        $transaksi->nama_instansi = $request->nama_instansi;
        $transaksi->tgl_checkin = $request->tgl_checkin;
        $transaksi->tgl_checkout = $request->tgl_checkout;
        $transaksi->jumlah_orang = $request->jumlah_orang;
        $transaksi->harga = $harga;
        $transaksi->total_harga = $total_harga;

        $transaksi->save();


        return redirect()->route('detail_transaksi', [
            'jenis_transaksi' => $transaksi->jenis_transaksi,
            'id' => $transaksi->id
        ])->with('success', 'Data Reservasi berhasil diperbarui!');
    }


    public function cekKetersediaan(Request $request, $id)
    {
        $tglCheckin = $request->input('cek_tgl_checkin');
        $tglCheckout = $request->input('cek_tgl_checkout');

        // Cek ketersediaan ruangan
        $ruanganTersedia = Ruangan::where('id', $id)
            ->where('status', 'kosong')
            ->whereNotIn('id', function ($query) use ($tglCheckin, $tglCheckout) {
                $query->select('dr.ruangan_id')
                    ->from('detail_transaksi_ruangan as dr')
                    ->join('transaksi as t', 'dr.transaksi_id', '=', 't.id')
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
            ->exists();

        if ($ruanganTersedia) {
            return response()->json(['status' => 'tersedia']);
        } else {
            return response()->json(['status' => 'tidak tersedia']);
        }
    }
}
