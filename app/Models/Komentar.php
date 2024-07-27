<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $fillable = ['id','tanggal', 'isi_komentar', 'users_id'];

    public $incrementing = false; // karena id tidak auto increment

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

}
