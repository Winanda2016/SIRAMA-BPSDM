<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentar = Komentar::orderBy('tanggal', 'desc')->get();
        return view('tamu.komentar.komentar', compact('komentar'));
    }
}
