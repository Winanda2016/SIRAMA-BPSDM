<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class detailTRuangan extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_ruangan';
    protected $fillable = [
        'id', 'ruangan_id', 'transaksi_id'
    ];

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }


    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function getFormattedHargaAttribute()
    {
        return number_format($this->total_harga, 0, ',', '.');
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
