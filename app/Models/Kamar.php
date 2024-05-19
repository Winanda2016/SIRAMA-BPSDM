<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $fillable = [
        'id', 'nomor-kamar', 'kapasitas', 'fasilitas', 'status',
        'foto', 'keterangan'
    ];

    public function scopeFilter($query, array $filter){

        $query->when($filter['search'] ?? false, function ($query, $search){
            return $query->where('nomor_kamar', 'like', '%' . $search . '%');
        });
    }

    public function gedung(): BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }
}
