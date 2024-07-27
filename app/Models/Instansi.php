<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
