<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckExpiredTransactions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $today = Carbon::today();

        // Update transaksi yang masih pending dan sudah melewati tgl_checkin
        Transaksi::where('status_transaksi', 'pending')
            ->where('tgl_checkin', '<=', $today)
            ->update(['status_transaksi' => 'kadaluwarsa']);
            
        // Update transaksi yang masih checkin dan sudah melewati tgl_checkout
        Transaksi::where('status_transaksi', 'checkin')
        ->where('tgl_checkout', '=', $today)
        ->update(['status_transaksi' => 'kadaluwarsa']);

        return $next($request);
    }
}
