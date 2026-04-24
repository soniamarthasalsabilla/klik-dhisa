<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatasDusun extends Model
{
    protected $table = 'batas_dusun';

    protected $fillable = ['nama_dusun', 'tipe', 'warna', 'koordinat', 'is_active'];

    protected $casts = [
        'koordinat' => 'array',
        'is_active' => 'boolean',
    ];
}
