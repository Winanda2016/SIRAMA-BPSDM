<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class kelolaUsers extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = ['id', 'username', 'email', 'password', 'role', 'nik', 'no_hp', 'foto'];

    public $timestamps = false;

    public $incrementing = false; // karena id tidak auto increment

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
