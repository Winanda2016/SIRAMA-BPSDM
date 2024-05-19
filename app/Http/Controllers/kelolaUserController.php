<?php

namespace App\Http\Controllers;

use App\Models\kelolaUsers;
use Illuminate\Http\Request;

class kelolaUserController extends Controller
{
    public function index()
    {
        $kuser = kelolaUsers::orderBy('id', 'asc')->get();
        return view('admin.user.kelolaUser', compact('kuser'));
    }
}
