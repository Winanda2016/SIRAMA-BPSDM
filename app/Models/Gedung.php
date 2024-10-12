<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $fillable = ['id','nama_gedung'];

    public $timestamps = false;

    public function kamar(){
        return $this->hasMany(Kamar::class);
    }

    public function ruangan(){
        return $this->hasMany(Ruangan::class);
    }

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
