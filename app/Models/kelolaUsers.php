<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelolaUsers extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = ['id', 'username', 'email', 'password', 'role', 'nik', 'no_hp', 'foto'];

    public $timestamps = false;
}
