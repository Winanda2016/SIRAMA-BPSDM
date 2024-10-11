<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    protected $transaksi;

    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function collection()
    {
        // Ambil hanya kolom yang diperlukan
        return $this->transaksi->map(function ($item) {
            // Tentukan nama ruangan berdasarkan jenis transaksi
            $namaRuangan = $item->jenis_transaksi === 'kamar' ? 'Kamar' : $item->nama_ruangan;

            return [
                'nama' => $item->nama,
                'nohp' => $item->nohp,
                'nama_instansi' => $item->nama_instansi,
                'nama_ruangan' => $namaRuangan,
                'tgl_checkin' => $item->tgl_checkin,
                'tgl_checkout' => $item->tgl_checkout,
                'jumlah_orang' => $item->jumlah_orang.' Orang',
                'diskon' => $item->diskon.' %',
                'total_harga' => 'Rp. ' . number_format($item->total_harga, 0, ',', '.'),
                'status_transaksi' => $item->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Tamu',
            'Nomor HP',
            'Nama Instansi',
            'Nama Ruangan',
            'Tanggal Check In',
            'Tanggal Check Out',
            'Jumlah Orang',
            'Diskon',
            'Total Harga',
            'Status Transaksi',
        ];
    }
}
