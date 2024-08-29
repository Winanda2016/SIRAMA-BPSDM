<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentar = Komentar::select(
            'komentar.*',
            'u.nama as nama_user'
        )
            ->leftJoin('users AS u', 'komentar.users_id', '=', 'u.id')
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.komentar.kelolaKomentar', compact('komentar'));
    }
}
