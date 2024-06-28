<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Gedung;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{

    public function index(Request $request)
    {
        $gedungId = $request->input('gedung_id');

        // Ambil semua gedung
        $gedung = Gedung::all();

        // Filter berdasarkan nama gedung jika nama gedung dipilih
        $kamar = Kamar::when($gedungId, function ($query, $gedungId) {
            return $query->whereHas('gedung', function ($query) use ($gedungId) {
                $query->where('id', $gedungId);
            });
        })
            ->select('kamar.nomor_kamar', 'kamar.kapasitas', 'kamar.status', 'gedung.nama_gedung')
            ->leftJoin('gedung', 'gedung.id', '=', 'kamar.gedung_id')
            ->orderBy('nomor_kamar', 'asc')
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('admin.kamar.kelolaKamar', compact('gedung', 'kamar'));
    }

    public function create()
    {
        $kamar = Kamar::all();
        $gedung = Gedung::all();
        return view('admin.kamar.tambahKamar', compact('kamar', 'gedung'));
    }

    public function store(Request $request)
    {
        $existingKamar = Kamar::where('nomor_kamar', $request->nomor_kamar)
            ->where('gedung_id', $request->gedung_id)
            ->first();

        if ($existingKamar) {
            // Tampilkan alert jika kamar dengan nomor kamar dan id gedung yang sama sudah ada
            return back()->with('error', 'Kamar dengan nomor tersebut di gedung tersebut sudah tersedia.');
        }

        $validatedData = $request->validate([
            'nomor_kamar' => 'required|max:5',
            'status' => 'required',
            'kapasitas' => 'required|min:1',
            'fasilitas' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string|max:255',
            'gedung_id' => 'required|numeric',
        ]);

        // Create a new kamar instance
        $kamar = new Kamar();

        // Assign values to the kamar instance
        $kamar->status = $validatedData['status'];
        $kamar->nomor_kamar = $validatedData['nomor_kamar'];
        $kamar->kapasitas = $validatedData['kapasitas'];
        $kamar->fasilitas = $validatedData['fasilitas'];
        $kamar->keterangan = $validatedData['keterangan'];
        $kamar->gedung_id = $validatedData['gedung_id'];

        // Handle file upload
        // try {
        //     if ($request->hasFile('foto')) {
        //         $extension = $request->file('foto')->getClientOriginalExtension();
        //         $newFileName = 'Kamar' . '_ No.' . $kamar->nomor_kamar . '.' . $extension;

        //         $request->file('foto')->move(public_path('admin/assets/images/kamar'), $newFileName);

        //         $kamar->foto = 'admin/assets/images/kamar/' . $newFileName;
        //     }
        // } catch (\Exception $e) {
        //     return back()->withError('Failed to upload image: ' . $e->getMessage())->withInput();
        // }


        // Save the kamar instance to the database
        $kamar->save();

        // Redirect or return a response as needed
        return redirect()->route('kelola_kamar')
            ->with('success', 'Nama Gedung Berhasil Ditambahkan');
    }


    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $gedung = Gedung::all();

        // Tampilkan formulir donasi
        return view('admin.kamar.editKamar', compact('kamar', 'gedung'));
    }

    // public function edit(kamar $kamar)
    // {
    //     $tipe = Gedung::all();
    //     return view('kamar.edit', compact('kamar', 'tipe'));
    // }

    public function update(Request $request, $id)
    {

        $existingKamar = Kamar::where('nomor_kamar', $request->nomor_kamar)
            ->where('gedung_id', $request->gedung_id)
            ->first();

        if ($existingKamar) {
            // Tampilkan alert jika kamar dengan nomor kamar dan id gedung yang sama sudah ada
            return back()->with('error', 'Kamar dengan nomor tersebut di gedung tersebut sudah tersedia.');
        }

        $validatedData = $request->validate([
            'nomor_kamar' => 'required|max:5',
            'status' => 'required',
            'kapasitas' => 'required|min:1',
            'fasilitas' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string|max:255',
            'gedung_id' => 'required|numeric',
        ]);

        // Find the Donasi record by ID
        $kamar = Kamar::findOrFail($id);

        // Assign values to the kamar instance
        $kamar->status = $validatedData['status'];
        $kamar->nomor_kamar = $validatedData['nomor_kamar'];
        $kamar->kapasitas = $validatedData['kapasitas'];
        $kamar->fasilitas = $validatedData['fasilitas'];
        $kamar->keterangan = $validatedData['keterangan'];
        $kamar->gedung_id = $validatedData['gedung_id'];

        // Handle file upload
        // try {
        //     if ($request->hasFile('foto')) {
        //         $extension = $request->file('foto')->getClientOriginalExtension();
        //         $newFileName = 'Kamar' . '_ No.' . $kamar->nomor_kamar . '.' . $extension;

        //         $request->file('foto')->move(public_path('admin/assets/images/kamar'), $newFileName);

        //         $kamar->foto = 'admin/assets/images/kamar/' . $newFileName;
        //     }
        // } catch (\Exception $e) {
        //     return back()->withError('Failed to upload image: ' . $e->getMessage())->withInput();
        // }

        // Save the updated Donasi instance to the database
        $kamar->save();

        // Redirect or return a response as needed
        return redirect()->route('kelola_kamar')
            ->with('success', 'Nama Gedung Berhasil Diubah');
    }

    
}
