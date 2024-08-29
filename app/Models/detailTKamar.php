<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class detailTKamar extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_kamar';
    protected $fillable = [
        'id', 'kamar_id', 'transaksi_id', 'jinstansi_id'
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id');
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
