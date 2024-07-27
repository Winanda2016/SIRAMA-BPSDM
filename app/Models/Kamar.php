<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $fillable = [
        'id', 'nomor_kamar', 'kapasitas', 'fasilitas', 'status',
        'deskripsi', 'gedung_id'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Ramsey\Uuid\Uuid::uuid4();
                Log::info('UUID generated: ' . $model->{$model->getKeyName()});
            }
        });
    }

    public function scopeFilter($query, array $filter)
    {

        $query->when($filter['search'] ?? false, function ($query, $search) {
            return $query->where('nomor_kamar', 'like', '%' . $search . '%');
        });
    }

    public function gedung(): BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'id');
    }

    public function detailTKamar()
    {
        return $this->hasMany(detailTKamar::class);
    }

    // public function transaksi(){
    //     return $this->hasMany(Transaksi::class);
    // }

    // public function instansi(){
    //     return $this->hasMany(Instansi::class);
    // }

}
