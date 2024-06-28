<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansi';
    protected $fillable = ['id', 'nama_instansi', 'harga'];

    public $timestamps = false;


    public function detailTKamar()
    {
        return $this->hasMany(detailTKamar::class);
    }

    public function getFormattedHargaAttribute()
    {
        return number_format($this->harga, 0, ',', '.');
    }
}
