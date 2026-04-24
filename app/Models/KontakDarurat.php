<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakDarurat extends Model
{
    protected $table = 'kontak_darurat';

    protected $fillable = ['nama', 'nomor', 'icon', 'warna_bg', 'warna_teks', 'urutan', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
