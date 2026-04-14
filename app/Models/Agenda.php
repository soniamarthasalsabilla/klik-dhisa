<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'lokasi', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'kategori', 'is_active'];

    protected $casts = [
        'tanggal'  => 'date',
        'is_active'=> 'boolean',
    ];

    public function getIsMendatangAttribute(): bool
    {
        return $this->tanggal->isFuture() || $this->tanggal->isToday();
    }

    public function scopeMendatang($query)
    {
        return $query->where('tanggal', '>=', Carbon::today())->orderBy('tanggal');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
}
