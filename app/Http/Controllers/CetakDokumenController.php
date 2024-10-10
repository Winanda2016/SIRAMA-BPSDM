<?php

namespace App\Http\Controllers;

use App\Models\JInstansi;
use App\Models\Transaksi;
use App\Exports\TransaksiExport;

use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CetakDokumenController extends Controller
{
    // Method untuk kirim detail transaksi ke WhatsApp
    public function fakturWhatsApp($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        // Ambil nomor telepon dari data transaksi
        $no_hp = $transaksi->nohp;

        // Cek apakah nomor sudah memiliki kode negara
        if (!preg_match('/^\+\d+/', $no_hp)) {
            // Tambahkan kode negara jika belum ada
            $no_hp = '+62' . ltrim($no_hp, '0'); // Misalnya +62 untuk Indonesia
        }

        // Ambil data jenis instansi berdasarkan ID dari transaksi
        $jinstansi = JInstansi::find($transaksi->jinstansi_id);
        $harga_per_hari = $jinstansi ? $jinstansi->harga : 0;

        // Perhitungan total hari
        $tgl_checkin = \Carbon\Carbon::parse($transaksi->tgl_checkin);
        $tgl_checkout = \Carbon\Carbon::parse($transaksi->tgl_checkout);

        if ($transaksi->jenis_transaksi == 'kamar') {
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);
        } elseif ($transaksi->jenis_transaksi == 'ruangan') {
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;
        }

        // Generate PDF
        $pdf = Pdf::loadView('admin.cetak_dokumen.faktur.faktur', [
            'transaksi' => $transaksi,
            'total_hari' => $total_hari,
            'harga_per_hari' => $harga_per_hari
        ]);
        $datePrefix = now()->format('Ymd');
        $pdfPath = 'faktur_transaksi_' . $transaksi->nama . '_' . $datePrefix . '.pdf';
        $fullPath = public_path('dokumen/faktur/' . $pdfPath);

        // Simpan PDF
        $pdf->save($fullPath);

        // URL PDF
        $pdfUrl = url('dokumen/faktur/' . $pdfPath);

        // Siapkan pesan WhatsApp
        $pesan = 'Silakan unduh faktur transaksi Anda di sini: ' . $pdfUrl;

        // Generate WhatsApp URL
        $waUrl = 'https://wa.me/' . urlencode($no_hp) . '?text=' . urlencode($pesan);

        return redirect()->away($waUrl);
    }

    public function downloadFaktur($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $jinstansi = $transaksi->jinstansi;
        $harga_per_hari = $jinstansi ? $jinstansi->harga : 0;

        // Perhitungan total hari
        $tgl_checkin = \Carbon\Carbon::parse($transaksi->tgl_checkin);
        $tgl_checkout = \Carbon\Carbon::parse($transaksi->tgl_checkout);

        if ($transaksi->jenis_transaksi == 'kamar') {
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout);
        } elseif ($transaksi->jenis_transaksi == 'ruangan') {
            $total_hari = $tgl_checkin->diffInDays($tgl_checkout) + 1;
        }

        $pdf = PDF::loadView('admin.cetak_dokumen.faktur.faktur', [
            'transaksi' => $transaksi,
            'total_hari' => $total_hari,
            'harga_per_hari' => $harga_per_hari,
            'total_harga' => $total_hari * $harga_per_hari,
        ]);

        $datePrefix = now()->format('Ymd');
        $pdfPath = 'faktur_transaksi_' . $transaksi->nama . '_' . $datePrefix . '.pdf';

        // Unduh PDF dengan nama file
        return $pdf->download($pdfPath);
    }

    public function laporanPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisTransaksi = $request->input('jenis_transaksi');
        $statusTransaksi = $request->input('status_transaksi', []);

        // Query untuk transaksi dengan filter yang diterapkan
        $query = Transaksi::select(
            'r.nama_ruangan',
            'transaksi.id as transaksi_id',
            'transaksi.status_transaksi as status',
            'transaksi.*'
        )
            ->leftJoin('detail_transaksi_ruangan AS dtr', 'transaksi.id', '=', 'dtr.transaksi_id')
            ->leftJoin('ruangan AS r', 'dtr.ruangan_id', '=', 'r.id')
            ->orderBy('transaksi.tgl_checkout', 'asc');

        // Filter berdasarkan tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tgl_checkin', [$startDate, $endDate])
                ->whereBetween('transaksi.tgl_checkout', [$startDate, $endDate]);
        }

        // Filter berdasarkan jenis transaksi
        if ($jenisTransaksi) {
            $query->where('jenis_transaksi', $jenisTransaksi);
        }

        // Filter berdasarkan status transaksi jika ada
        if (!empty($statusTransaksi)) {
            $query->whereIn('status_transaksi', $statusTransaksi);
        }

        // Ambil hasil query
        $transaksis = $query->get();

        // Array untuk menyimpan total hari
        $total_hari = [];

        // Loop melalui setiap transaksi untuk menghitung total hari
        foreach ($transaksis as $transaksi) {
            $tgl_checkin = \Carbon\Carbon::parse($transaksi->tgl_checkin);
            $tgl_checkout = \Carbon\Carbon::parse($transaksi->tgl_checkout);

            if ($transaksi->jenis_transaksi == 'kamar') {
                $total_hari[$transaksi->transaksi_id] = $tgl_checkin->diffInDays($tgl_checkout);
            } elseif ($transaksi->jenis_transaksi == 'ruangan') {
                $total_hari[$transaksi->transaksi_id] = $tgl_checkin->diffInDays($tgl_checkout) + 1;
            }
        }

        $datePrefix = now()->format('Ymd');
        $pdfPath = 'laporan_transaksi_' . $datePrefix . '.pdf';

        // Load view untuk PDF dan pass data transaksi
        $pdf = PDF::loadView('admin.cetak_dokumen.laporan.laporanPDF', compact('transaksis', 'total_hari'));
        return $pdf->download($pdfPath);
    }

    public function laporanExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisTransaksi = $request->input('jenis_transaksi');
        $statusTransaksi = $request->input('status_transaksi', []);

        // Query untuk transaksi dengan filter yang diterapkan
        $query = Transaksi::select(
            'r.nama_ruangan',
            'transaksi.id as transaksi_id',
            'transaksi.status_transaksi as status',
            'transaksi.*'
        )
            ->leftJoin('detail_transaksi_ruangan AS dtr', 'transaksi.id', '=', 'dtr.transaksi_id')
            ->leftJoin('ruangan AS r', 'dtr.ruangan_id', '=', 'r.id')
            ->orderBy('transaksi.tgl_checkout', 'asc');

        // Filter berdasarkan tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tgl_checkin', [$startDate, $endDate])
                ->whereBetween('transaksi.tgl_checkout', [$startDate, $endDate]);
        }

        // Filter berdasarkan jenis transaksi
        if ($jenisTransaksi) {
            $query->where('jenis_transaksi', $jenisTransaksi);
        }

        // Filter berdasarkan status transaksi jika ada
        if (!empty($statusTransaksi)) {
            $query->whereIn('status_transaksi', $statusTransaksi);
        }

        $transaksi = $query->get();

        // Mengembalikan file Excel
        return Excel::download(new TransaksiExport($transaksi), 'riwayat_transaksi.xlsx');
    }
}
