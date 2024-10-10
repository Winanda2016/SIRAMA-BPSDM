<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Gedung;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $gedungId = $request->input('gedung_id');

        // Ambil semua gedung
        $gedung = Gedung::all();

        // Filter berdasarkan nama gedung jika nama gedung dipilih
        $ruangan = Ruangan::when($gedungId, function ($query, $gedungId) {
            return $query->whereHas('gedung', function ($query) use ($gedungId) {
                $query->where('id', $gedungId);
            });
        })
            ->select('ruangan.id as ruangan_id', 'ruangan.*', 'gedung.nama_gedung')
            ->leftJoin('gedung', 'gedung.id', '=', 'ruangan.gedung_id')
            ->orderBy('nama_ruangan', 'asc')
            ->filter(request(['search']))
            ->paginate(100)
            ->withQueryString();

        return view('admin.ruangan.kelolaRuangan', compact('gedung', 'ruangan'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        return view('admin.ruangan.tambahRuangan', compact('ruangan', 'gedung'));
    }

    public function store(Request $request)
    {
        $existingRuangan = Ruangan::where('nama_ruangan', $request->nama_ruangan)
            ->where('gedung_id', $request->gedung_id)
            ->first();

        if ($existingRuangan) {
            // Tampilkan alert jika ruangan dengan nama ruangan dan id gedung yang sama sudah ada
            return back()->with('error', 'Ruangan tersebut di gedung tersebut sudah tersedia.');
        }

        $validatedData = $request->validate([
            'nama_ruangan' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|min:1',
            'fasilitas' => 'nullable|string|max:255',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'deskripsi' => 'nullable|string|max:255',
            'gedung_id' => 'required|uuid',
        ]);

        // Create a new ruangan instance
        $ruangan = new Ruangan();

        // Assign values to the ruangan instance
        $ruangan->nama_ruangan = $validatedData['nama_ruangan'];
        $ruangan->harga = $validatedData['harga'];
        $ruangan->kapasitas = $validatedData['kapasitas'];
        $ruangan->fasilitas = $validatedData['fasilitas'];
        $ruangan->status = $validatedData['status'];
        $ruangan->deskripsi = $validatedData['deskripsi'];
        $ruangan->gedung_id = $validatedData['gedung_id'];

        // Handle file upload
        try {
            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = 'Ruangan' . '_ ' . $ruangan->nama_ruangan . '.' . $extension;

                $request->file('foto')->move(public_path('tamu/assets/img/ruangan'), $newFileName);

                $ruangan->foto = 'tamu/assets/img/ruangan/' . $newFileName;
            }
        } catch (\Exception $e) {
            return back()->withError('Failed to upload image: ' . $e->getMessage())->withInput();
        }


        // Save the ruangan instance to the database
        $ruangan->save();

        // Redirect or return a response as needed
        return redirect()->route('kelola_ruangan')
            ->with('success', 'Ruangan Berhasil Ditambahkan');
    }

    public function showDetail($id)
    {
        $ruangan = Ruangan::select('ruangan.id as ruangan_id', 'ruangan.*', 'gedung.*')
            ->leftJoin('gedung', 'ruangan.gedung_id', '=', 'gedung.id')
            ->where('ruangan.id', $id)
            ->first();

        // Tampilkan formulir donasi
        return view('admin.ruangan.detailRuangan', compact('ruangan'));
    }

    public function edit($id)
    {
        $gedung = Gedung::all();

        $ruangan = Ruangan::select('ruangan.id as ruangan_id', 'ruangan.*', 'gedung.id as gedung_id', 'gedung.*')
            ->leftJoin('gedung', 'ruangan.gedung_id', '=', 'gedung.id')
            ->where('ruangan.id', $id)
            ->first();

        // Tampilkan formulir donasi
        return view('admin.ruangan.editRuangan', compact('gedung', 'ruangan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_ruangan' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|min:1',
            'fasilitas' => 'nullable|string|max:255',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'deskripsi' => 'nullable|string|max:255',
            'gedung_id' => 'required|uuid',
        ]);

        // Cek apakah ada ruangan lain dengan nama ruangan dan gedung yang sama
        $existingRuangan = Ruangan::where('nama_ruangan', $request->nama_ruangan)
            ->where('gedung_id', $request->gedung_id)
            ->where('id', '!=', $id) // Mengecualikan ruangan yang sedang diedit
            ->first();

        if ($existingRuangan) {
            // Tampilkan alert jika ruangan dengan nama ruangan dan id gedung yang sama sudah ada
            return back()->with('error', 'Ruangan dengan nama tersebut di gedung tersebut sudah tersedia.');
        }

        // Find the Donasi record by ID
        $ruangan = Ruangan::findOrFail($id);

        // Assign values to the ruangan instance
        $ruangan->nama_ruangan = $validatedData['nama_ruangan'];
        $ruangan->harga = $validatedData['harga'];
        $ruangan->kapasitas = $validatedData['kapasitas'];
        $ruangan->fasilitas = $validatedData['fasilitas'];
        $ruangan->status = $validatedData['status'];
        $ruangan->deskripsi = $validatedData['deskripsi'];
        $ruangan->gedung_id = $validatedData['gedung_id'];

        // Handle file upload
        try {
            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = 'Ruangan' . '_ ' . $ruangan->nama_ruangan . '.' . $extension;

                $request->file('foto')->move(public_path('tamu/assets/img/ruangan'), $newFileName);

                $ruangan->foto = 'tamu/assets/img/ruangan/' . $newFileName;
            }
        } catch (\Exception $e) {
            return back()->withError('Failed to upload image: ' . $e->getMessage())->withInput();
        }


        // Save the ruangan instance to the database
        $ruangan->save();

        // Redirect or return a response as needed
        return redirect()->route('kelola_ruangan')
            ->with('success', 'Ruangan Berhasil Diubah');
    }

    // ------------------------------------------------------------
    public function cekRuangan(Request $request)
    {

        // Menampilkan semua ruangan
        $tgl_checkin = Carbon::parse($request->input('tgl_checkin'))->format('Y-m-d');
        $tgl_checkout = Carbon::parse($request->input('tgl_checkout'))->format('Y-m-d');

        // Menampilkan status ketersediaan ruangan
        $ruangan = Ruangan::select(
            'ruangan.id as ruangan_id',
            'ruangan.nama_ruangan',
            'ruangan.kapasitas',
            'ruangan.status as status_ruangan',
            'gedung.nama_gedung',
            DB::raw("COALESCE(transaksi.status_transaksi, 'kosong') as status_transaksi"),
            'transaksi.tgl_checkin',
            'transaksi.tgl_checkout'
        )
            ->leftJoin('gedung', 'gedung.id', '=', 'ruangan.gedung_id')
            ->leftJoin('detail_transaksi_ruangan', 'ruangan.id', '=', 'detail_transaksi_ruangan.ruangan_id')
            ->leftJoin('transaksi', function ($join) use ($tgl_checkin, $tgl_checkout) {
                $join->on('detail_transaksi_ruangan.transaksi_id', '=', 'transaksi.id')
                    ->where(function ($query) use ($tgl_checkin, $tgl_checkout) {
                        $query->where('transaksi.tgl_checkin', '<=', $tgl_checkout)
                            ->where('transaksi.tgl_checkout', '>=', $tgl_checkin);
                    });
            })
            ->orderBy('ruangan.nama_ruangan', 'asc')
            ->paginate(100)
            ->withQueryString();

        return view('admin.ruangan.cekKetersediaan', compact('ruangan'));
    }
}
