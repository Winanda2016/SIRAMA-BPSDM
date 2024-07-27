<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'id', 'nama', 'nohp', 'nama_instansi', 'tgl_reservasi',
        'tgl_checkin', 'tgl_checkout', 'jumlah_hari', 'jumlah_orang',
        'dokumen_reservasi', 'jenis_transaksi',
        'catatan', 'total_harga', 'status_transaksi', 'diskon',
        'bukti_bayar', 'users_id'
    ];

    public function getFormattedHargaAttribute()
    {
        return 'Rp. ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function detailTKamar()
    {
        return $this->hasMany(detailTKamar::class);
    }

    public function detailTRuangan()
    {
        return $this->hasMany(detailTRuangan::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public $incrementing = false; // karena id tidak auto increment
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
