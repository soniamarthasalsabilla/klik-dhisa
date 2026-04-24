<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetDesa extends Model
{
    protected $table = 'aset_desas';

    protected $fillable = [
        'nama', 'jenis', 'kondisi', 'lokasi', 'latitude', 'longitude', 'luas',
        'tahun_perolehan', 'nilai_perolehan', 'keterangan', 'foto', 'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'nilai_perolehan' => 'integer',
        'luas'            => 'float',
        'latitude'        => 'float',
        'longitude'       => 'float',
    ];

    public static array $jenisOptions = [
        'Tanah',
        'Bangunan',
        'Kendaraan',
        'Peralatan & Mesin',
        'Infrastruktur',
        'Aset Tetap Lainnya',
    ];

    public static array $kondisiOptions = [
        'Baik',
        'Rusak Ringan',
        'Rusak Sedang',
        'Rusak Berat',
    ];

    public function getKondisiBadgeClassAttribute(): string
    {
        return match ($this->kondisi) {
            'Baik'         => 'bg-success',
            'Rusak Ringan' => 'bg-warning text-dark',
            'Rusak Sedang' => 'bg-orange text-white',
            'Rusak Berat'  => 'bg-danger',
            default        => 'bg-secondary',
        };
    }
}
