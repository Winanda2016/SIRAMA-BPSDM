<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'id', 'nama', 'nohp', 'nama_instansi', 'tgl_reservasi',
        'tgl_mulai', 'tgl_selesai', 'jumlah_hari', 'jumlah_orang',
        'dokumen_reservasi', 'jenis_transaksi', 'status_reservasi', 
        'catatan', 'total_harga', 'status_transaksi', 'diskon',
        'bukti_bayar', 'user_id'
    ];
    
    public function detailTKamar(){
        return $this->hasMany(detailTKamar::class);
    }
}
