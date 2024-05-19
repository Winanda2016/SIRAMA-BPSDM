<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JPelanggan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pelanggan';
    protected $fillable = ['id', 'nama_jenis', 'harga'];

    public $timestamps = false;

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
