<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pamong extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'foto', 'no_hp', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
