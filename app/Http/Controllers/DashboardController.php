<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        $totalKTerisi = DB::table('kamar')
            ->where('status', 'terisi')
            ->count();
        $totalKKosong = DB::table('kamar')
            ->where('status', 'kosong')
            ->count();
        $totalKReservasi = DB::table('kamar')
            ->where('status', 'reservasi')
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

        //COLUMN CHART
        $columnChartData = DB::table(DB::raw('(
            SELECT 1 AS bulan UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
            SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
            SELECT 11 UNION ALL SELECT 12
        ) AS m'))
            ->leftJoin('transaksi as t', function ($join) {
                $join->on(DB::raw('MONTH(t.tgl_selesai)'), '=', 'm.bulan')
                    ->on(DB::raw('YEAR(t.tgl_selesai)'), '=', DB::raw('YEAR(CURRENT_DATE())'));
            })
            ->leftJoin('detail_transaksi_kamar as dt', 't.id', '=', 'dt.transaksi_id')
            ->leftJoin('kamar as k', 'dt.kamar_id', '=', 'k.id')
            ->leftJoin('gedung as g', 'k.gedung_id', '=', 'g.id')
            ->select(
                'g.nama_gedung',
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
                DB::raw('COALESCE(COUNT(t.id), 0) AS jumlah_transaksi')
            )
            ->groupBy('g.nama_gedung', 'bulan')
            ->orderBy('g.nama_gedung')
            ->orderBy('m.bulan')
            ->get();

        // Ubah data menjadi format yang sesuai untuk chart
        $chartData = [];
        foreach ($columnChartData as $data) {
            // Gunakan indeks bulan (1-12) sebagai kunci array
            $chartData[$data->nama_gedung][$data->bulan] = $data->jumlah_transaksi;
        }

        // Format data untuk categories (bulan) dan series (data per gedung)
        $categories = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        $series = [];
        foreach ($chartData as $gedung => $data) {
            $seriesData = [];
            // Loop melalui semua bulan
            foreach ($categories as $bulan) {
                // Jika data untuk bulan tertentu tidak tersedia, gunakan nilai 0
                $jumlah = isset($data[$bulan]) ? $data[$bulan] : 0;
                $seriesData[] = $jumlah;
            }
            $series[] = [
                'name' => $gedung,
                'data' => $seriesData
            ];
        }


        return view(
            'admin.dashboard',
            compact(
                'totalTransaksiKamar',
                'totalKTerisi',
                'totalKKosong',
                'totalKReservasi',
                'totalKPerbaikan',
                'totalTransaksiRuangan',
                'pieChartData', // pastikan variabel ini termasuk dengan benar
                'categories',
                'series'
            )
        );
    }
}
