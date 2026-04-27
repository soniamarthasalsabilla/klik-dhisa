<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ip_address', 'user_agent', 'browser', 'os', 'device',
        'page_url', 'route_name', 'referer', 'session_id', 'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public static function routeLabel(string $routeName): string
    {
        $labels = [
            'home'                 => 'Halaman Beranda',
            'profil.desa'          => 'Profil Desa',
            'struktur.organisasi'  => 'Struktur Organisasi',
            'galeri.desa'          => 'Galeri Foto',
            'berita.desa'          => 'Berita & Artikel',
            'berita.detail'        => 'Detail Berita',
            'aset.desa'            => 'Aset Desa',
            'peta.desa'            => 'Peta Desa',
            'umkm.desa'            => 'UMKM Desa',
            'informasi.publik'     => 'Informasi Publik',
            'transparansi.anggaran'=> 'Anggaran Desa',
            'arsip.artikel'        => 'Publikasi Desa',
            'layanan.desa'         => 'Layanan Desa',
            'stat.penduduk'        => 'Statistik Penduduk',
            'stat.keluarga'        => 'Statistik Keluarga',
            'stat.fasilitas'       => 'Statistik Fasilitas Umum',
            'agenda.desa'          => 'Agenda Kegiatan',
            'pengaduan.form'       => 'Form Pengaduan',
            'portal'               => 'Portal Desa',
        ];

        return $labels[$routeName] ?? ucwords(str_replace(['.', '-', '_'], ' ', $routeName));
    }
}
