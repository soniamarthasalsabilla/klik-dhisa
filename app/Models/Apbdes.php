<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    protected $table = 'apbdes';
    protected $fillable = ['tahun', 'jenis', 'bidang', 'kegiatan', 'anggaran', 'realisasi', 'urutan'];

    public function getPersentaseAttribute(): float
    {
        if ($this->anggaran <= 0) return 0;
        return round(($this->realisasi / $this->anggaran) * 100, 1);
    }
}
