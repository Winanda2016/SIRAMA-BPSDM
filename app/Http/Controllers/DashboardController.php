<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexAdmin(){

        $totalTransaksi = DB::table('transaksi')->count();

        return view(
            'admin.dashboard',
            compact('totalTransaksi'));
    }
}
