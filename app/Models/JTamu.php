<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JTamu extends Model
{
    use HasFactory;
    protected $table = 'jenis_tamu';
    protected $fillable = ['id', 'nama_jenis', 'harga'];

    public $timestamps = false;

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }

    public function getFormattedHargaAttribute()
    {
        return number_format($this->harga, 0, ',', '.');
    }
}
