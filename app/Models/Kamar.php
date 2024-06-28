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
        'id', 'nomor_kamar', 'kapasitas', 'fasilitas', 'status',
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

    public function detailTKamar(){
        return $this->hasMany(detailTKamar::class);
    }

    // public function transaksi(){
    //     return $this->hasMany(Transaksi::class);
    // }

    // public function instansi(){
    //     return $this->hasMany(Instansi::class);
    // }
}
