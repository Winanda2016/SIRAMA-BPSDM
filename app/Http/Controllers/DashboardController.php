<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Gedung;
use App\Models\kamar;
use App\Models\Transaksi;
use App\Models\Komentar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexAdmin(Request $request)
    {
        // Ambil tahun dari request atau gunakan tahun sekarang sebagai default
        $year = $request->input('year', date('Y'));

        $totalKTerisi = DB::table('kamar')
            ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'terisi')
            ->where('transaksi.status_transaksi', 'checkin')
            ->count();

        $totalKReservasi = DB::table('kamar')
            ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'kosong')
            ->where('transaksi.status_transaksi', 'terima')
            ->whereDate('tgl_checkin', Carbon::today())
            ->count();

        // Total kamar kosong di luar kondisi terisi dan reservasi
        $totalKKosong = DB::table('kamar')
            ->leftJoin('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->leftJoin('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'kosong')
            ->whereNotIn('kamar.id', function ($query) {
                $query->select('kamar.id')
                    ->from('kamar')
                    ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
                    ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
                    ->where(function ($query) {
                        $query->where('kamar.status', 'terisi')
                            ->where('transaksi.status_transaksi', 'checkin')
                            ->orWhere(function ($query) {
                                $query->where('kamar.status', 'kosong')
                                    ->where('transaksi.status_transaksi', 'terima')
                                    ->whereDate('tgl_checkin', Carbon::today());
                            });
                    });
            })
            ->count();

        $totalKPerbaikan = DB::table('kamar')
            ->where('status', 'perbaikan')
            ->count();
        $totalTransaksiRuangan = DB::table('transaksi')
            ->where('jenis_transaksi', 'ruangan')
            ->count();
        $totalTransaksiKamar = DB::table('transaksi')
            ->where('jenis_transaksi', 'kamar')
            ->count();

        // PIE CHART
        $pieChartdata = DB::table('detail_transaksi_ruangan as detail')
            ->join('ruangan as r', 'detail.ruangan_id', '=', 'r.id')
            ->join('transaksi as t', 'detail.transaksi_id', '=', 't.id')
            ->whereIn('t.status_transaksi', ['terima', 'checkin', 'checkout'])
            ->select('r.nama_ruangan', DB::raw('COUNT(t.id) as total_transaksi'))
            ->groupBy('r.nama_ruangan')
            ->get();

        $labels = $pieChartdata->pluck('nama_ruangan');
        $dataset = $pieChartdata->pluck('total_transaksi');
        $pieChartData = [
            'labels' => $labels,
            'data' => $dataset,
            'backgroundColor' => ["#777aca", "#5156be", "#6f42c1", "#a8aada"]
        ];

        // COLUMN CHART: Transaksi Kamar dan Ruangan dengan status 'checkout'
        $columnChartData = DB::table(DB::raw('(
            SELECT 1 AS bulan UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
            SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
            SELECT 11 UNION ALL SELECT 12
        ) AS m'))
            ->leftJoin('transaksi as t', function ($join) use ($year) {
                $join->on(DB::raw('MONTH(t.tgl_checkout)'), '=', 'm.bulan')
                    ->where('t.status_transaksi', '=', 'checkout')
                    ->whereYear('t.tgl_checkout', '=', $year);
            })
            ->select(
                DB::raw('CASE
                    WHEN m.bulan = 1 THEN "Januari"
                    WHEN m.bulan = 2 THEN "Februari"
                    WHEN m.bulan = 3 THEN "Maret"
                    WHEN m.bulan = 4 THEN "April"
                    WHEN m.bulan = 5 THEN "Mei"
                    WHEN m.bulan = 6 THEN "Juni"
                    WHEN m.bulan = 7 THEN "Juli"
                    WHEN m.bulan = 8 THEN "Agustus"
                    WHEN m.bulan = 9 THEN "September"
                    WHEN m.bulan = 10 THEN "Oktober"
                    WHEN m.bulan = 11 THEN "November"
                    WHEN m.bulan = 12 THEN "Desember"
                END AS bulan'),
                DB::raw('SUM(CASE WHEN t.jenis_transaksi = "kamar" THEN 1 ELSE 0 END) AS total_transaksi_kamar'),
                DB::raw('SUM(CASE WHEN t.jenis_transaksi = "ruangan" THEN 1 ELSE 0 END) AS total_transaksi_ruangan')
            )
            ->groupBy('bulan')
            ->orderBy('m.bulan')
            ->get();

        $categories = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $series = [
            [
                'name' => 'Transaksi Kamar',
                'data' => $columnChartData->pluck('total_transaksi_kamar')->toArray()
            ],
            [
                'name' => 'Transaksi Ruangan',
                'data' => $columnChartData->pluck('total_transaksi_ruangan')->toArray()
            ]
        ];

        return view(
            'admin.dashboard',
            compact(
                'totalTransaksiKamar',
                'totalKTerisi',
                'totalKKosong',
                'totalKReservasi',
                'totalKPerbaikan',
                'totalTransaksiRuangan',
                'pieChartData',
                'categories',
                'series',
                'year'
            )
        );
    }

    public function indexPegawai(Request $request)
    {

        $totalKTerisi = DB::table('kamar')
            ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'terisi')
            ->where('transaksi.status_transaksi', 'checkin')
            ->count();

        $totalKReservasi = DB::table('kamar')
            ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'kosong')
            ->where('transaksi.status_transaksi', 'terima')
            ->whereDate('tgl_checkin', Carbon::today())
            ->count();

        // Total kamar kosong di luar kondisi terisi dan reservasi
        $totalKKosong = DB::table('kamar')
            ->leftJoin('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
            ->leftJoin('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
            ->where('kamar.status', 'kosong')
            ->whereNotIn('kamar.id', function ($query) {
                $query->select('kamar.id')
                    ->from('kamar')
                    ->join('detail_transaksi_kamar', 'kamar.id', '=', 'detail_transaksi_kamar.kamar_id')
                    ->join('transaksi', 'detail_transaksi_kamar.transaksi_id', '=', 'transaksi.id')
                    ->where(function ($query) {
                        $query->where('kamar.status', 'terisi')
                            ->where('transaksi.status_transaksi', 'checkin')
                            ->orWhere(function ($query) {
                                $query->where('kamar.status', 'kosong')
                                    ->where('transaksi.status_transaksi', 'terima')
                                    ->whereDate('tgl_checkin', Carbon::today());
                            });
                    });
            })
            ->count();

        $totalKPerbaikan = DB::table('kamar')
            ->where('status', 'perbaikan')
            ->count();

        $transaksiPending = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->where('transaksi.status_transaksi', 'pending')
            ->orderBy('tgl_reservasi', 'asc')
            ->get();

        $transaksiCheckIn = Transaksi::select(
            'transaksi.*',
            'transaksi.status_transaksi as status',
            'transaksi.id as transaksi_id'
        )
            ->where('transaksi.status_transaksi', 'checkin')
            ->orderBy('tgl_checkout', 'asc')
            ->get();


        return view(
            'admin.dashboardPegawai',
            compact(
                'totalKTerisi',
                'totalKKosong',
                'totalKReservasi',
                'totalKPerbaikan',
                'transaksiPending',
                'transaksiCheckIn'
            )
        );
    }

    public function indexTamu()
    {
        $ruangan = Ruangan::all();
        $komentar = Komentar::select(
            'komentar.*',
            'u.name as nama_user'
        )
            ->leftJoin('users AS u', 'komentar.users_id', '=', 'u.id')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        $totalKomentar = Komentar::count();

        return view('tamu.dashboard', compact('ruangan', 'komentar', 'totalKomentar'));
    }

}
