<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Ruangan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = [
        'id', 'nama_ruangan', 'harga', 'kapasitas','fasilitas', 'status',
        'foto', 'keterangan', 'gedung_id'
    ];

    public function scopeFilter($query, array $filter){

        $query->when($filter['search'] ?? false, function ($query, $search){
            return $query->where('nomor_kamar', 'like', '%' . $search . '%');
        });
    }

    public function gedung(): BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'id');
    }

    public function getFormattedHargaAttribute()
    {
        return number_format($this->harga, 0, ',', '.');
    }

    public $incrementing = false; // karena id tidak auto increment

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
