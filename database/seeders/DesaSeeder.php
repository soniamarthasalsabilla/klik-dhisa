<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;
use App\Models\Umkm;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        // Isi data Statistik Pendidikan
        Statistic::create(['label' => 'SD', 'jumlah' => 150, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'SMP', 'jumlah' => 100, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'SMA', 'jumlah' => 80, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'S1', 'jumlah' => 30, 'kategori' => 'Pendidikan']);

        // Isi data UMKM contoh
        Umkm::create([
            'nama_usaha' => 'Batik Tajungan',
            'pemilik' => 'Hj. Aminah',
            'kategori' => 'Kerajinan',
            'no_hp' => '628123456789',
            'latitude' => -7.0863,
            'longitude' => 112.5135
        ]);
    }
}