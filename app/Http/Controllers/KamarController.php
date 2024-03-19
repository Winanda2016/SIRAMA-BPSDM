<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Gedung;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::select('kamar.nomor_kamar', 'kamar.kapasitas', 'kamar.status', 'gedung.nama_gedung')
            ->leftJoin('gedung', 'gedung.id', '=', 'kamar.gedung_id')
            ->orderBy('nomor_kamar', 'asc')
            ->get();
        return view('admin.kamar.kelolaKamar', compact('kamar'));
    }

    public function create()
    {
        $kamar = Kamar::all();
        $gedung = Gedung::all();
        return view('admin.kamar.tambahKamar', compact('kamar', 'gedung'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar|max:5',
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
        try {
            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = 'Kamar' . '_ No.' . $kamar->nomor_kamar . '.' . $extension;

                // Try to move the uploaded file
                $request->file('foto')->move(public_path('admin/assets/images/kamar'), $newFileName);

                // Save the file path to the 'foto' column
                $kamar->foto = 'admin/assets/images/kamar/' . $newFileName;
            }
        } catch (\Exception $e) {
            // If an error occurs during file processing, handle it here
            return back()->withError('Failed to upload image: ' . $e->getMessage())->withInput();
        }

        // Save the kamar instance to the database
        $kamar->save();

        // Redirect or return a response as needed
        return redirect()->route('kelola-kamar.index');
    }

    // public function edit(Kamar $kamar)
    // {
    //     // $kamar = Kamar::findOrFail($id);
    //     $gedung = Gedung::all();
    //     return view('admin.kamar.editKamar', compact('kamar', 'gedung'));
    // }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $gedung = Gedung::all();

        // Tampilkan formulir donasi
        return view('admin.kamar.editKamar', compact('kamar', 'gedung'));;
    }
}
