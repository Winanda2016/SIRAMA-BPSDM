<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
