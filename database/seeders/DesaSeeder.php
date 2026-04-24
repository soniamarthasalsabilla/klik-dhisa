<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;
use App\Models\Umkm;
use App\Models\PageContent;
use App\Models\DesaSetting;
use App\Models\Pamong;
use App\Models\Artikel;
use App\Models\Apbdes;
use App\Models\Agenda;
use App\Models\AsetDesa;
use App\Models\Galeri;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        // Isi data Statistik Pendidikan
        foreach ([
            ['Tidak/Belum Sekolah', 120], ['Belum Tamat SD/Sederajat', 85],
            ['Tamat SD/Sederajat', 310],  ['SMP/Sederajat', 220],
            ['SMA/Sederajat', 185],        ['Diploma I/II/III', 45],
            ['S1/S2/S3', 72],
        ] as [$label, $jumlah]) {
            Statistic::create(['label' => $label, 'jumlah' => $jumlah, 'kategori' => 'Pendidikan']);
        }

        // Isi data Statistik Rentang Umur (per 5 tahun)
        foreach ([
            ['0–4 Tahun',35],  ['5–9 Tahun',42],  ['10–14 Tahun',48], ['15–19 Tahun',55],
            ['20–24 Tahun',62],['25–29 Tahun',58], ['30–34 Tahun',65], ['35–39 Tahun',70],
            ['40–44 Tahun',63],['45–49 Tahun',55], ['50–54 Tahun',48], ['55–59 Tahun',40],
            ['60–64 Tahun',32],['65–69 Tahun',25], ['70–74 Tahun',18], ['75+ Tahun',14],
        ] as [$label, $jumlah]) {
            Statistic::create(['label' => $label, 'jumlah' => $jumlah, 'kategori' => 'Rentang Umur']);
        }

        // Isi data Statistik Pekerjaan
        Statistic::create(['label' => 'Petani', 'jumlah' => 200, 'kategori' => 'Pekerjaan']);
        Statistic::create(['label' => 'Buruh', 'jumlah' => 100, 'kategori' => 'Pekerjaan']);
        Statistic::create(['label' => 'Pedagang', 'jumlah' => 80, 'kategori' => 'Pekerjaan']);
        Statistic::create(['label' => 'PNS', 'jumlah' => 30, 'kategori' => 'Pekerjaan']);
        Statistic::create(['label' => 'Wiraswasta', 'jumlah' => 50, 'kategori' => 'Pekerjaan']);

        // Isi data Statistik Agama
        Statistic::create(['label' => 'Islam', 'jumlah' => 400, 'kategori' => 'Agama']);
        Statistic::create(['label' => 'Kristen', 'jumlah' => 50, 'kategori' => 'Agama']);
        Statistic::create(['label' => 'Hindu', 'jumlah' => 20, 'kategori' => 'Agama']);
        Statistic::create(['label' => 'Budha', 'jumlah' => 10, 'kategori' => 'Agama']);

        // Isi data Statistik Status Perkawinan
        Statistic::create(['label' => 'Belum Kawin', 'jumlah' => 150, 'kategori' => 'Status Perkawinan']);
        Statistic::create(['label' => 'Kawin', 'jumlah' => 300, 'kategori' => 'Status Perkawinan']);
        Statistic::create(['label' => 'Cerai Hidup', 'jumlah' => 20, 'kategori' => 'Status Perkawinan']);
        Statistic::create(['label' => 'Cerai Mati', 'jumlah' => 10, 'kategori' => 'Status Perkawinan']);

        // Isi data Statistik Kepala Keluarga
        Statistic::create(['label' => 'Laki-laki', 'jumlah' => 350, 'kategori' => 'Kepala Keluarga']);
        Statistic::create(['label' => 'Perempuan', 'jumlah' => 50, 'kategori' => 'Kepala Keluarga']);

        // Isi data Statistik Kesejahteraan
        Statistic::create(['label' => 'Sejahtera', 'jumlah' => 100, 'kategori' => 'Kesejahteraan']);
        Statistic::create(['label' => 'Kurang Sejahtera', 'jumlah' => 200, 'kategori' => 'Kesejahteraan']);
        Statistic::create(['label' => 'Tidak Sejahtera', 'jumlah' => 100, 'kategori' => 'Kesejahteraan']);

        // Isi data Statistik Jaminan Kesehatan
        Statistic::create(['label' => 'BPJS Kesehatan', 'jumlah' => 300, 'kategori' => 'Jaminan Kesehatan']);
        Statistic::create(['label' => 'Tidak Ada', 'jumlah' => 100, 'kategori' => 'Jaminan Kesehatan']);

        // PKH — per komponen
        foreach ([
            ['Ibu Hamil / Nifas',                              12],
            ['Anak Usia Dini (0-6 tahun)',                     35],
            ['Anak SD / Sederajat',                            45],
            ['Anak SMP / Sederajat',                           28],
            ['Anak SMA / Sederajat',                           15],
            ['Lansia (70+ tahun)',                             10],
            ['Disabilitas Berat',                               5],
        ] as [$label, $jumlah]) {
            Statistic::create(['kategori' => 'PKH', 'label' => $label, 'jumlah' => $jumlah]);
        }

        // BPNT — per status
        foreach ([
            ['Aktif Menerima',    242],
            ['Dalam Verifikasi',   18],
            ['Diusulkan Hapus',    10],
        ] as [$label, $jumlah]) {
            Statistic::create(['kategori' => 'BPNT', 'label' => $label, 'jumlah' => $jumlah]);
        }

        // BLT Dana Desa — per kategori penerima
        foreach ([
            ['Miskin Ekstrem (belum terdata bantuan lain)',    30],
            ['Anggota Keluarga Sakit / Disabilitas',          15],
            ['Lansia Tunggal Tanpa Penanggung',               10],
            ['Kehilangan Mata Pencaharian',                    5],
        ] as [$label, $jumlah]) {
            Statistic::create(['kategori' => 'BLT Dana Desa', 'label' => $label, 'jumlah' => $jumlah]);
        }

        // Data Kepala Desa
        PageContent::create([
            'section'   => 'kades',
            'title'     => 'H. Ahmad Fauzi, S.Sos',
            'excerpt'   => 'Mewujudkan Desa Tajungan yang transparan dan berbasis digital melalui program Desa Cantik (Cinta Statistik). Kami berkomitmen melayani warga dengan data yang akurat.',
            'body'      => 'Kepala Desa Tajungan',
            'category'  => 'profil',
            'is_active' => true,
        ]);

        // Isi data UMKM contoh
        Umkm::create([
            'nama_usaha' => 'Batik Tajungan',
            'pemilik' => 'Hj. Aminah',
            'kategori' => 'Kerajinan',
            'no_hp' => '628123456789',
            'latitude' => -7.0863,
            'longitude' => 112.5135
        ]);

        // Profil Desa Settings
        $profilData = [
            'visi'            => 'Terwujudnya Desa Tajungan yang Maju, Sejahtera, dan Berdaya Saing Berbasis Statistik pada tahun 2030',
            'misi'            => "1. Meningkatkan kualitas pelayanan publik berbasis data dan teknologi informasi\n2. Mengembangkan potensi ekonomi lokal melalui UMKM dan sektor pertanian\n3. Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan\n4. Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel\n5. Mengembangkan infrastruktur desa yang merata dan berkelanjutan",
            'sejarah'         => "Desa Tajungan merupakan salah satu desa yang berada di Kecamatan Kamal, Kabupaten Bangkalan, Madura. Desa ini memiliki sejarah panjang yang erat kaitannya dengan perkembangan Kabupaten Bangkalan.\n\nBerdiri sejak era kolonial Belanda, Desa Tajungan telah mengalami berbagai transformasi sosial dan ekonomi. Nama \"Tajungan\" sendiri berasal dari bahasa Madura yang bermakna area tempat berkumpul para nelayan tradisional.\n\nSeiring berjalannya waktu, Desa Tajungan berkembang menjadi desa yang produktif dengan keberadaan berbagai UMKM, khususnya di bidang batik, kuliner, dan kerajinan tangan khas Madura.",
            'luas_wilayah'    => '145',
            'jumlah_penduduk' => '2450',
            'jumlah_kk'       => '650',
            'jumlah_dusun'    => '2',
            'jumlah_rt'       => '12',
            'jumlah_rw'       => '4',
            'tahun_berdiri'   => '1945',
            'jarak_kecamatan' => '3',
            'jarak_kabupaten' => '14',
            'jarak_provinsi'  => '120',
            'kontak_ambulans' => '118',
            'kontak_polisi'   => '110',
            'kontak_pemadam'  => '113',
            'kontak_hotline'  => '0812-3456-7890',
            'batas_utara'     => 'Selat Madura',
            'batas_selatan'   => 'Desa Gili Anyar',
            'batas_timur'     => 'Desa Banyuajuh',
            'batas_barat'     => 'Desa Kamal',
        ];
        foreach ($profilData as $key => $value) {
            DesaSetting::create(['key' => $key, 'value' => $value]);
        }

        // Struktur Pamong
        $pamongs = [
            ['nama' => 'H. Ahmad Fauzi, S.Sos',  'jabatan' => 'Kepala Desa',           'no_hp' => '6281234560001', 'urutan' => 1],
            ['nama' => 'Siti Rahmah, S.Pd',       'jabatan' => 'Sekretaris Desa',       'no_hp' => '6281234560002', 'urutan' => 2],
            ['nama' => 'Moh. Iqbal',               'jabatan' => 'Kasi Pemerintahan',     'no_hp' => '6281234560003', 'urutan' => 3],
            ['nama' => 'Farida Hanum',             'jabatan' => 'Kasi Kesejahteraan',    'no_hp' => '6281234560004', 'urutan' => 4],
            ['nama' => 'Abdul Rohim',              'jabatan' => 'Kaur Keuangan',         'no_hp' => '6281234560005', 'urutan' => 5],
            ['nama' => 'Nurul Hidayah',            'jabatan' => 'Kaur Perencanaan',      'no_hp' => null,            'urutan' => 6],
            ['nama' => 'Sulaiman',                 'jabatan' => 'Kepala Dusun Barat',    'no_hp' => null,            'urutan' => 7],
            ['nama' => 'Ahmad Zaini',              'jabatan' => 'Kepala Dusun Timur',    'no_hp' => null,            'urutan' => 8],
        ];
        foreach ($pamongs as $p) {
            Pamong::create(array_merge($p, ['is_active' => true]));
        }

        // Contoh Artikel
        Artikel::create([
            'judul'        => 'Program Desa Cantik Bangkalan Resmi Diluncurkan',
            'slug'         => 'program-desa-cantik-bangkalan-resmi-diluncurkan',
            'ringkasan'    => 'Kabupaten Bangkalan resmi meluncurkan program Desa Cantik (Cinta Statistik) untuk meningkatkan kualitas data dan transparansi desa.',
            'isi'          => "Pemerintah Kabupaten Bangkalan bersama BPS Bangkalan resmi meluncurkan program Desa Cantik (Cinta Statistik) yang bertujuan meningkatkan kualitas pendataan dan transparansi di tingkat desa.\n\nProgram ini menyasar seluruh desa di Kabupaten Bangkalan, termasuk Desa Tajungan, yang menjadi salah satu desa percontohan dalam program ini.\n\nDengan adanya program Desa Cantik, diharapkan setiap desa memiliki sistem informasi yang lengkap, akurat, dan dapat diakses oleh seluruh lapisan masyarakat.",
            'kategori'     => 'Pembangunan',
            'is_active'    => true,
            'published_at' => now(),
        ]);

        Artikel::create([
            'judul'        => 'Posyandu Gratis untuk Balita dan Ibu Hamil',
            'slug'         => 'posyandu-gratis-untuk-balita-dan-ibu-hamil',
            'ringkasan'    => 'Pemerintah Desa Tajungan mengadakan posyandu gratis setiap minggu pertama dan ketiga setiap bulannya.',
            'isi'          => "Dalam rangka meningkatkan kesehatan masyarakat, Pemerintah Desa Tajungan bekerja sama dengan Puskesmas Kamal mengadakan kegiatan Posyandu gratis bagi balita dan ibu hamil.\n\nKegiatan ini diadakan setiap minggu pertama dan ketiga setiap bulan di Balai Desa Tajungan mulai pukul 08.00 hingga 12.00 WIB.\n\nLayanan yang tersedia meliputi: penimbangan berat badan, pemeriksaan kesehatan dasar, pemberian vitamin, dan konsultasi gizi.",
            'kategori'     => 'Kesehatan',
            'is_active'    => true,
            'published_at' => now()->subDays(7),
        ]);

        // APBDes 2024
        $apbdes2024 = [
            // Pendapatan
            ['tahun' => 2024, 'jenis' => 'pendapatan', 'bidang' => 'Dana Desa',               'kegiatan' => null,                                'anggaran' => 780000000, 'realisasi' => 780000000, 'urutan' => 1],
            ['tahun' => 2024, 'jenis' => 'pendapatan', 'bidang' => 'Alokasi Dana Desa (ADD)',  'kegiatan' => null,                                'anggaran' => 310000000, 'realisasi' => 310000000, 'urutan' => 2],
            ['tahun' => 2024, 'jenis' => 'pendapatan', 'bidang' => 'Pendapatan Asli Desa',    'kegiatan' => 'Sewa Tanah Kas Desa',               'anggaran' =>  20000000, 'realisasi' =>  20000000, 'urutan' => 3],
            ['tahun' => 2024, 'jenis' => 'pendapatan', 'bidang' => 'Bagi Hasil Pajak',        'kegiatan' => 'Pajak & Retribusi Daerah',          'anggaran' =>  12000000, 'realisasi' =>  11200000, 'urutan' => 4],
            // Belanja
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemerintahan',         'kegiatan' => 'Operasional & Gaji Perangkat Desa', 'anggaran' => 250000000, 'realisasi' => 248000000, 'urutan' => 5],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',          'kegiatan' => 'Pembangunan & Perbaikan Jalan Desa','anggaran' => 295000000, 'realisasi' => 293500000, 'urutan' => 6],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',          'kegiatan' => 'Pembangunan Drainase & Irigasi',    'anggaran' => 120000000, 'realisasi' => 118000000, 'urutan' => 7],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',       'kegiatan' => 'Posyandu & Kesehatan Warga',        'anggaran' =>  70000000, 'realisasi' =>  69500000, 'urutan' => 8],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',       'kegiatan' => 'Bantuan Sosial & PKH Desa',         'anggaran' =>  55000000, 'realisasi' =>  55000000, 'urutan' => 9],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemberdayaan',         'kegiatan' => 'Pelatihan UMKM & Wirausaha',        'anggaran' =>  35000000, 'realisasi' =>  34000000, 'urutan' => 10],
            ['tahun' => 2024, 'jenis' => 'belanja', 'bidang' => 'Bidang Tak Terduga',          'kegiatan' => 'Dana Cadangan & Darurat',           'anggaran' =>  25000000, 'realisasi' =>  22000000, 'urutan' => 11],
        ];
        foreach ($apbdes2024 as $row) {
            Apbdes::create($row);
        }

        // APBDes 2025
        $apbdes2025 = [
            // Pendapatan
            ['tahun' => 2025, 'jenis' => 'pendapatan', 'bidang' => 'Dana Desa',               'kegiatan' => null,                                'anggaran' => 820000000, 'realisasi' => 820000000, 'urutan' => 1],
            ['tahun' => 2025, 'jenis' => 'pendapatan', 'bidang' => 'Alokasi Dana Desa (ADD)',  'kegiatan' => null,                                'anggaran' => 330000000, 'realisasi' => 330000000, 'urutan' => 2],
            ['tahun' => 2025, 'jenis' => 'pendapatan', 'bidang' => 'Pendapatan Asli Desa',    'kegiatan' => 'Sewa Tanah Kas Desa',               'anggaran' =>  22000000, 'realisasi' =>  22000000, 'urutan' => 3],
            ['tahun' => 2025, 'jenis' => 'pendapatan', 'bidang' => 'Bagi Hasil Pajak',        'kegiatan' => 'Pajak & Retribusi Daerah',          'anggaran' =>  13500000, 'realisasi' =>  13000000, 'urutan' => 4],
            // Belanja
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemerintahan',         'kegiatan' => 'Operasional & Gaji Perangkat Desa', 'anggaran' => 265000000, 'realisasi' => 265000000, 'urutan' => 5],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',          'kegiatan' => 'Pembangunan & Perbaikan Jalan Desa','anggaran' => 310000000, 'realisasi' => 308000000, 'urutan' => 6],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',          'kegiatan' => 'Pembangunan Gedung Serbaguna Desa', 'anggaran' => 180000000, 'realisasi' => 178500000, 'urutan' => 7],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',       'kegiatan' => 'Posyandu & Kesehatan Warga',        'anggaran' =>  75000000, 'realisasi' =>  74000000, 'urutan' => 8],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',       'kegiatan' => 'Bantuan Sosial & PKH Desa',         'anggaran' =>  60000000, 'realisasi' =>  60000000, 'urutan' => 9],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemberdayaan',         'kegiatan' => 'Pelatihan UMKM & Wirausaha',        'anggaran' =>  40000000, 'realisasi' =>  39000000, 'urutan' => 10],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemberdayaan',         'kegiatan' => 'Digitalisasi & Website Desa',       'anggaran' =>  15000000, 'realisasi' =>  15000000, 'urutan' => 11],
            ['tahun' => 2025, 'jenis' => 'belanja', 'bidang' => 'Bidang Tak Terduga',          'kegiatan' => 'Dana Cadangan & Darurat',           'anggaran' =>  28000000, 'realisasi' =>  25000000, 'urutan' => 12],
        ];
        foreach ($apbdes2025 as $row) {
            Apbdes::create($row);
        }

        // APBDes 2026
        $apbdes = [
            // Pendapatan
            ['tahun' => 2026, 'jenis' => 'pendapatan', 'bidang' => 'Dana Desa',              'kegiatan' => null,                                'anggaran' => 850000000, 'realisasi' => 850000000, 'urutan' => 1],
            ['tahun' => 2026, 'jenis' => 'pendapatan', 'bidang' => 'Alokasi Dana Desa (ADD)', 'kegiatan' => null,                               'anggaran' => 350000000, 'realisasi' => 320000000, 'urutan' => 2],
            ['tahun' => 2026, 'jenis' => 'pendapatan', 'bidang' => 'Pendapatan Asli Desa',   'kegiatan' => 'Sewa Tanah Kas Desa',               'anggaran' =>  25000000, 'realisasi' =>  25000000, 'urutan' => 3],
            ['tahun' => 2026, 'jenis' => 'pendapatan', 'bidang' => 'Bagi Hasil Pajak',       'kegiatan' => 'Pajak & Retribusi Daerah',          'anggaran' =>  15000000, 'realisasi' =>  12500000, 'urutan' => 4],
            // Belanja
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemerintahan',        'kegiatan' => 'Operasional & Gaji Perangkat Desa', 'anggaran' => 280000000, 'realisasi' => 260000000, 'urutan' => 5],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',         'kegiatan' => 'Pembangunan & Perbaikan Jalan Desa','anggaran' => 320000000, 'realisasi' => 290000000, 'urutan' => 6],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Pembangunan',         'kegiatan' => 'Pembangunan Sarana Air Bersih',     'anggaran' => 150000000, 'realisasi' =>  95000000, 'urutan' => 7],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',      'kegiatan' => 'Posyandu & Kesehatan Warga',        'anggaran' =>  80000000, 'realisasi' =>  72000000, 'urutan' => 8],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Kemasyarakatan',      'kegiatan' => 'Bantuan Sosial & PKH Desa',         'anggaran' =>  65000000, 'realisasi' =>  65000000, 'urutan' => 9],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemberdayaan',        'kegiatan' => 'Pelatihan UMKM & Wirausaha',        'anggaran' =>  45000000, 'realisasi' =>  30000000, 'urutan' => 10],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Pemberdayaan',        'kegiatan' => 'Digitalisasi & Website Desa',       'anggaran' =>  20000000, 'realisasi' =>  17500000, 'urutan' => 11],
            ['tahun' => 2026, 'jenis' => 'belanja', 'bidang' => 'Bidang Tak Terduga',         'kegiatan' => 'Dana Cadangan & Darurat',           'anggaran' =>  30000000, 'realisasi' =>   8000000, 'urutan' => 12],
        ];
        foreach ($apbdes as $row) {
            Apbdes::create($row);
        }

        // Agenda Kegiatan
        $agendas = [
            [
                'judul'         => 'Musyawarah Desa Penyusunan RKPDes 2027',
                'tanggal'       => now()->addDays(5)->toDateString(),
                'waktu_mulai'   => '09:00',
                'waktu_selesai' => '13:00',
                'lokasi'        => 'Balai Desa Tajungan',
                'kategori'      => 'Musyawarah',
                'deskripsi'     => 'Musyawarah desa untuk menyusun Rencana Kerja Pemerintah Desa (RKPDes) tahun anggaran 2027. Dihadiri oleh perangkat desa, BPD, tokoh masyarakat, dan perwakilan warga.',
                'is_active'     => true,
            ],
            [
                'judul'         => 'Posyandu Balita & Ibu Hamil',
                'tanggal'       => now()->addDays(10)->toDateString(),
                'waktu_mulai'   => '08:00',
                'waktu_selesai' => '12:00',
                'lokasi'        => 'Balai Desa Tajungan',
                'kategori'      => 'Kesehatan',
                'deskripsi'     => 'Kegiatan posyandu rutin bulanan untuk balita dan ibu hamil. Tersedia layanan penimbangan, pemeriksaan kesehatan dasar, dan pembagian vitamin.',
                'is_active'     => true,
            ],
            [
                'judul'         => 'Pelatihan Wirausaha UMKM Batik Madura',
                'tanggal'       => now()->addDays(18)->toDateString(),
                'waktu_mulai'   => '08:30',
                'waktu_selesai' => '15:00',
                'lokasi'        => 'Gedung Serba Guna Desa Tajungan',
                'kategori'      => 'Ekonomi',
                'deskripsi'     => 'Pelatihan wirausaha bagi pelaku UMKM Desa Tajungan dengan fokus pada pengembangan batik khas Madura, pemasaran digital, dan manajemen usaha.',
                'is_active'     => true,
            ],
            [
                'judul'         => 'Gotong Royong Bersih Desa',
                'tanggal'       => now()->addDays(25)->toDateString(),
                'waktu_mulai'   => '07:00',
                'waktu_selesai' => '10:00',
                'lokasi'        => 'Seluruh Wilayah Desa Tajungan',
                'kategori'      => 'Sosial',
                'deskripsi'     => 'Kegiatan gotong royong membersihkan lingkungan desa, perbaikan fasilitas umum, dan penanaman pohon di area publik.',
                'is_active'     => true,
            ],
            [
                'judul'         => 'Sosialisasi Program Bantuan Sosial 2026',
                'tanggal'       => now()->subDays(15)->toDateString(),
                'waktu_mulai'   => '09:00',
                'waktu_selesai' => '11:30',
                'lokasi'        => 'Balai Desa Tajungan',
                'kategori'      => 'Sosial',
                'deskripsi'     => 'Sosialisasi program bantuan sosial PKH, BPNT, dan BLT Dana Desa tahun 2026 kepada warga penerima manfaat.',
                'is_active'     => true,
            ],
            [
                'judul'         => 'Musyawarah Penetapan APBDes 2026',
                'tanggal'       => now()->subDays(60)->toDateString(),
                'waktu_mulai'   => '09:00',
                'waktu_selesai' => '14:00',
                'lokasi'        => 'Balai Desa Tajungan',
                'kategori'      => 'Musyawarah',
                'deskripsi'     => 'Musyawarah desa untuk menetapkan Anggaran Pendapatan dan Belanja Desa (APBDes) tahun 2026.',
                'is_active'     => true,
            ],
        ];
        foreach ($agendas as $ag) {
            Agenda::create($ag);
        }

        // Aset Desa (dengan koordinat untuk aset fisik)
        $asets = [
            // Tanah
            ['nama' => 'Tanah Kas Desa Blok A',  'jenis' => 'Tanah', 'kondisi' => 'Baik',        'lokasi' => 'Dusun Barat',       'latitude' => -7.1575, 'longitude' => 112.6855, 'luas' => 2500, 'tahun_perolehan' => 1985, 'nilai_perolehan' => 0,         'keterangan' => 'Tanah milik desa untuk pertanian kas desa'],
            ['nama' => 'Tanah Makam Umum',        'jenis' => 'Tanah', 'kondisi' => 'Baik',        'lokasi' => 'Dusun Timur',       'latitude' => -7.1610, 'longitude' => 112.7020, 'luas' => 1200, 'tahun_perolehan' => 1970, 'nilai_perolehan' => 0,         'keterangan' => 'Tanah pemakaman umum warga Desa Tajungan'],
            ['nama' => 'Tanah Lapangan Desa',     'jenis' => 'Tanah', 'kondisi' => 'Baik',        'lokasi' => 'Pusat Desa',        'latitude' => -7.1510, 'longitude' => 112.6965, 'luas' => 3000, 'tahun_perolehan' => 1990, 'nilai_perolehan' => 0,         'keterangan' => 'Lapangan olahraga dan kegiatan warga'],
            // Bangunan
            ['nama' => 'Kantor Desa Tajungan',    'jenis' => 'Bangunan', 'kondisi' => 'Baik',     'lokasi' => 'Jl. Raya Tajungan', 'latitude' => -7.1544, 'longitude' => 112.6961, 'luas' => 250,  'tahun_perolehan' => 2015, 'nilai_perolehan' => 450000000, 'keterangan' => 'Gedung kantor pemerintahan desa 2 lantai'],
            ['nama' => 'Balai Desa',              'jenis' => 'Bangunan', 'kondisi' => 'Baik',     'lokasi' => 'Pusat Desa',        'latitude' => -7.1522, 'longitude' => 112.6942, 'luas' => 400,  'tahun_perolehan' => 2018, 'nilai_perolehan' => 380000000, 'keterangan' => 'Aula pertemuan warga kapasitas 300 orang'],
            ['nama' => 'Pos Kamling RW 01',       'jenis' => 'Bangunan', 'kondisi' => 'Rusak Ringan', 'lokasi' => 'RW 01 Dusun Barat', 'latitude' => -7.1512, 'longitude' => 112.6920, 'luas' => 12, 'tahun_perolehan' => 2010, 'nilai_perolehan' => 15000000,  'keterangan' => 'Perlu pengecatan ulang'],
            ['nama' => 'Pos Kamling RW 02',       'jenis' => 'Bangunan', 'kondisi' => 'Baik',     'lokasi' => 'RW 02 Dusun Timur', 'latitude' => -7.1558, 'longitude' => 112.6988, 'luas' => 12,  'tahun_perolehan' => 2012, 'nilai_perolehan' => 18000000,  'keterangan' => null],
            ['nama' => 'Gedung PAUD Melati',      'jenis' => 'Bangunan', 'kondisi' => 'Baik',     'lokasi' => 'Dusun Barat RT 02', 'latitude' => -7.1505, 'longitude' => 112.6935, 'luas' => 80,  'tahun_perolehan' => 2020, 'nilai_perolehan' => 120000000, 'keterangan' => 'Gedung PAUD dibangun dengan Dana Desa'],
            // Kendaraan (tidak ada koordinat)
            ['nama' => 'Motor Dinas Kepala Desa', 'jenis' => 'Kendaraan', 'kondisi' => 'Baik',   'lokasi' => 'Kantor Desa', 'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2022, 'nilai_perolehan' => 28000000, 'keterangan' => 'Honda Beat tahun 2022'],
            ['nama' => 'Motor Dinas Sekdes',      'jenis' => 'Kendaraan', 'kondisi' => 'Baik',   'lokasi' => 'Kantor Desa', 'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2021, 'nilai_perolehan' => 22000000, 'keterangan' => 'Yamaha Mio tahun 2021'],
            // Peralatan & Mesin (tidak ada koordinat)
            ['nama' => 'Komputer PC Admin',       'jenis' => 'Peralatan & Mesin', 'kondisi' => 'Baik',        'lokasi' => 'Kantor Desa',  'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2023, 'nilai_perolehan' => 8500000,  'keterangan' => null],
            ['nama' => 'Laptop Sekretaris',       'jenis' => 'Peralatan & Mesin', 'kondisi' => 'Baik',        'lokasi' => 'Kantor Desa',  'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2023, 'nilai_perolehan' => 9800000,  'keterangan' => null],
            ['nama' => 'Printer Multifungsi',     'jenis' => 'Peralatan & Mesin', 'kondisi' => 'Baik',        'lokasi' => 'Kantor Desa',  'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2022, 'nilai_perolehan' => 3200000,  'keterangan' => null],
            ['nama' => 'Mesin Pompa Air Desa',    'jenis' => 'Peralatan & Mesin', 'kondisi' => 'Rusak Ringan','lokasi' => 'Pos Air RW 03','latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2018, 'nilai_perolehan' => 12000000, 'keterangan' => 'Perlu servis rutin'],
            ['nama' => 'Sound System Balai Desa', 'jenis' => 'Peralatan & Mesin', 'kondisi' => 'Baik',        'lokasi' => 'Balai Desa',   'latitude' => null, 'longitude' => null, 'luas' => null, 'tahun_perolehan' => 2021, 'nilai_perolehan' => 15000000, 'keterangan' => null],
            // Infrastruktur
            ['nama' => 'Jalan Paving Blok Dusun Barat','jenis' => 'Infrastruktur','kondisi' => 'Baik',        'lokasi' => 'Dusun Barat',      'latitude' => -7.1565, 'longitude' => 112.6875, 'luas' => 600, 'tahun_perolehan' => 2023, 'nilai_perolehan' => 180000000, 'keterangan' => 'Paving block sepanjang 300m'],
            ['nama' => 'Drainase Jalan Utama',    'jenis' => 'Infrastruktur', 'kondisi' => 'Baik',           'lokasi' => 'Jl. Raya Tajungan','latitude' => -7.1540, 'longitude' => 112.6950, 'luas' => null,'tahun_perolehan' => 2022, 'nilai_perolehan' => 95000000,  'keterangan' => 'Saluran drainase 450m'],
            ['nama' => 'Sumur Bor Komunal RW 01', 'jenis' => 'Infrastruktur', 'kondisi' => 'Baik',           'lokasi' => 'RW 01',            'latitude' => -7.1500, 'longitude' => 112.6945, 'luas' => null,'tahun_perolehan' => 2020, 'nilai_perolehan' => 45000000,  'keterangan' => 'Melayani 60 KK'],
            ['nama' => 'MCK Umum RW 03',          'jenis' => 'Infrastruktur', 'kondisi' => 'Rusak Ringan',   'lokasi' => 'RW 03 Dusun Timur','latitude' => -7.1585, 'longitude' => 112.6975, 'luas' => 30,  'tahun_perolehan' => 2015, 'nilai_perolehan' => 35000000,  'keterangan' => 'Perlu renovasi atap'],
        ];
        foreach ($asets as $a) {
            AsetDesa::create(array_merge($a, ['is_active' => true]));
        }

        // Layanan Desa Digital
        $layanans = [
            // Administrasi
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Domisili',
                'excerpt'   => 'Surat keterangan tempat tinggal/domisili warga yang diperlukan untuk berbagai keperluan administratif.',
                'body'      => 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW',
                'category'  => 'Administrasi',
                'order'     => 1,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Pindah',
                'excerpt'   => 'Surat resmi pindah domisili ke alamat baru di dalam maupun luar desa.',
                'body'      => 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW, Alasan kepindahan',
                'category'  => 'Administrasi',
                'order'     => 2,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Pengantar Pembuatan KTP / KK',
                'excerpt'   => 'Surat pengantar dari desa untuk pembuatan atau perubahan data KTP dan Kartu Keluarga di Disdukcapil.',
                'body'      => 'Syarat: Kartu Keluarga (KK) lama, Surat pengantar RT/RW, Akta lahir (untuk pemula), Pas foto 3×4 (2 lembar)',
                'category'  => 'Administrasi',
                'order'     => 3,
                'is_active' => true,
            ],
            // Keterangan
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Tidak Mampu (SKTM)',
                'excerpt'   => 'Surat keterangan kondisi ekonomi warga, digunakan untuk keperluan beasiswa, kesehatan, dan bantuan sosial.',
                'body'      => 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW, Bukti tagihan listrik/air (jika ada)',
                'category'  => 'Keterangan',
                'order'     => 4,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Usaha',
                'excerpt'   => 'Surat keterangan untuk warga yang memiliki usaha atau UMKM, digunakan untuk keperluan permodalan dan perizinan.',
                'body'      => 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK), Surat pengantar RT/RW, Deskripsi jenis usaha',
                'category'  => 'Keterangan',
                'order'     => 5,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Kelahiran',
                'excerpt'   => 'Surat keterangan kelahiran anak dari desa sebagai dokumen pendukung pengurusan akta lahir di Disdukcapil.',
                'body'      => 'Syarat: KTP kedua orang tua, Kartu Keluarga (KK), Surat keterangan bidan/dokter, Surat nikah orang tua',
                'category'  => 'Keterangan',
                'order'     => 6,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Surat Keterangan Kematian',
                'excerpt'   => 'Surat keterangan kematian warga dari desa sebagai dokumen pendukung pengurusan akta kematian.',
                'body'      => 'Syarat: KTP almarhum/almarhumah, Kartu Keluarga (KK), Surat keterangan dokter atau surat pernyataan saksi, Surat pengantar RT/RW',
                'category'  => 'Keterangan',
                'order'     => 7,
                'is_active' => true,
            ],
            // Perizinan
            [
                'section'   => 'layanan',
                'title'     => 'Izin Keramaian / Hajatan',
                'excerpt'   => 'Surat izin penyelenggaraan kegiatan keramaian, hajatan, atau acara yang melibatkan banyak warga.',
                'body'      => 'Syarat: KTP pemohon, Surat permohonan tertulis, Persetujuan tetangga sekitar, Jadwal dan rencana acara',
                'category'  => 'Perizinan',
                'order'     => 8,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Izin Mendirikan Bangunan (Rekomendasi)',
                'excerpt'   => 'Surat rekomendasi dari desa untuk pengurusan Izin Mendirikan Bangunan (IMB) di tingkat kecamatan/kabupaten.',
                'body'      => 'Syarat: KTP pemohon, Kartu Keluarga (KK), Bukti kepemilikan tanah (sertifikat/SPPT), Denah/gambar bangunan, Surat pengantar RT/RW',
                'category'  => 'Perizinan',
                'order'     => 9,
                'is_active' => true,
            ],
            // Bantuan Sosial
            [
                'section'   => 'layanan',
                'title'     => 'Pendaftaran Penerima PKH',
                'excerpt'   => 'Pendaftaran dan verifikasi data calon penerima Program Keluarga Harapan (PKH) bagi keluarga kurang mampu.',
                'body'      => 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Buku tabungan (jika ada), Dokumen pendukung (akta lahir anak, kartu sekolah)',
                'category'  => 'Bantuan Sosial',
                'order'     => 10,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'Pendaftaran BPNT / Sembako',
                'excerpt'   => 'Verifikasi dan pendaftaran warga sebagai penerima Bantuan Pangan Non Tunai (BPNT) / Program Sembako.',
                'body'      => 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Foto rumah tampak depan',
                'category'  => 'Bantuan Sosial',
                'order'     => 11,
                'is_active' => true,
            ],
            [
                'section'   => 'layanan',
                'title'     => 'BLT Dana Desa',
                'excerpt'   => 'Pengajuan dan verifikasi penerima Bantuan Langsung Tunai (BLT) yang bersumber dari Dana Desa.',
                'body'      => 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Surat pengantar RT/RW, Tidak sedang menerima bansos lain',
                'category'  => 'Bantuan Sosial',
                'order'     => 12,
                'is_active' => true,
            ],
        ];
        foreach ($layanans as $l) {
            PageContent::create($l);
        }

        // Informasi Publik
        $infos = [
            ['section'=>'informasi','title'=>'Peraturan Desa Tajungan No. 1 Tahun 2026 tentang RKPDes','excerpt'=>'Rencana Kerja Pemerintah Desa Tajungan tahun anggaran 2026 yang memuat prioritas program dan kegiatan pembangunan desa.','category'=>'Peraturan Desa','year'=>'2026','order'=>1,'is_active'=>true],
            ['section'=>'informasi','title'=>'Peraturan Desa Tajungan No. 2 Tahun 2026 tentang APBDes','excerpt'=>'Anggaran Pendapatan dan Belanja Desa Tajungan tahun anggaran 2026 beserta rincian program dan kegiatan.','category'=>'Peraturan Desa','year'=>'2026','order'=>2,'is_active'=>true],
            ['section'=>'informasi','title'=>'Peraturan Desa Tajungan No. 1 Tahun 2025 tentang RPJMDes','excerpt'=>'Rencana Pembangunan Jangka Menengah Desa Tajungan periode 2025–2030 sebagai acuan pembangunan desa.','category'=>'Peraturan Desa','year'=>'2025','order'=>3,'is_active'=>true],
            ['section'=>'informasi','title'=>'RKPDes Desa Tajungan Tahun 2026','excerpt'=>'Dokumen Rencana Kerja Pemerintah Desa memuat daftar usulan kegiatan prioritas yang akan dilaksanakan pada tahun 2026.','category'=>'Dokumen Perencanaan','year'=>'2026','order'=>4,'is_active'=>true],
            ['section'=>'informasi','title'=>'RPJMDes Desa Tajungan 2025–2030','excerpt'=>'Dokumen perencanaan pembangunan desa jangka menengah selama 6 tahun sebagai pedoman arah pembangunan Desa Tajungan.','category'=>'Dokumen Perencanaan','year'=>'2025','order'=>5,'is_active'=>true],
            ['section'=>'informasi','title'=>'Profil Desa Tajungan 2025','excerpt'=>'Data profil desa mencakup kondisi geografis, demografis, ekonomi, dan sosial budaya Desa Tajungan per tahun 2025.','category'=>'Dokumen Perencanaan','year'=>'2025','order'=>6,'is_active'=>true],
            ['section'=>'informasi','title'=>'Laporan Realisasi APBDes Semester I Tahun 2026','excerpt'=>'Laporan realisasi anggaran pendapatan dan belanja desa periode Januari–Juni 2026.','category'=>'Laporan Keuangan','year'=>'2026','order'=>7,'is_active'=>true,'link'=>'/transparansi-anggaran'],
            ['section'=>'informasi','title'=>'Laporan Pertanggungjawaban APBDes Tahun 2025','excerpt'=>'Laporan pertanggungjawaban pelaksanaan APBDes Desa Tajungan tahun anggaran 2025 yang telah diaudit.','category'=>'Laporan Keuangan','year'=>'2025','order'=>8,'is_active'=>true],
            ['section'=>'informasi','title'=>'Laporan Dana Desa Tahun 2025','excerpt'=>'Laporan penggunaan Dana Desa tahun 2025 sesuai Peraturan Menteri Keuangan dan Peraturan Menteri Desa.','category'=>'Laporan Keuangan','year'=>'2025','order'=>9,'is_active'=>true],
            ['section'=>'informasi','title'=>'SK Kepala Desa tentang Tim Pengelola Kegiatan (TPK) 2026','excerpt'=>'Surat Keputusan Kepala Desa Tajungan tentang penetapan Tim Pengelola Kegiatan pelaksana program Dana Desa tahun 2026.','category'=>'SK & Berita Acara','year'=>'2026','order'=>10,'is_active'=>true],
            ['section'=>'informasi','title'=>'Berita Acara Musyawarah Desa Penetapan APBDes 2026','excerpt'=>'Berita acara pelaksanaan musyawarah desa dalam rangka penetapan APBDes Tajungan tahun anggaran 2026.','category'=>'SK & Berita Acara','year'=>'2026','order'=>11,'is_active'=>true],
            ['section'=>'informasi','title'=>'SK Kepala Desa tentang BPD Desa Tajungan Periode 2024–2030','excerpt'=>'Surat Keputusan tentang pengangkatan dan susunan anggota Badan Permusyawaratan Desa (BPD) Tajungan masa jabatan 2024–2030.','category'=>'SK & Berita Acara','year'=>'2024','order'=>12,'is_active'=>true],
        ];
        foreach ($infos as $i) {
            PageContent::create($i);
        }

        // Arsip Dokumen
        $arsips = [
            [
                'section'   => 'arsip',
                'title'     => 'Perdes No.1/2026 – RKPDes 2026',
                'excerpt'   => 'Peraturan Desa Tajungan tentang Rencana Kerja Pemerintah Desa Tahun Anggaran 2026.',
                'body'      => "PERATURAN DESA TAJUNGAN\nNOMOR 1 TAHUN 2026\nTENTANG RENCANA KERJA PEMERINTAH DESA (RKPDes) TAHUN ANGGARAN 2026\n\nDengan Rahmat Tuhan Yang Maha Esa,\nKEPALA DESA TAJUNGAN,\n\nMenimbang:\na. Bahwa dalam rangka penyelenggaraan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyarakatan, dan pemberdayaan masyarakat, perlu disusun Rencana Kerja Pemerintah Desa;\nb. Bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, perlu menetapkan Peraturan Desa tentang RKPDes Tahun Anggaran 2026.\n\nMengingat:\n1. Undang-Undang Nomor 6 Tahun 2014 tentang Desa;\n2. Peraturan Pemerintah Nomor 43 Tahun 2014 tentang Peraturan Pelaksanaan Undang-Undang Desa;\n3. Peraturan Menteri Dalam Negeri Nomor 114 Tahun 2014 tentang Pedoman Pembangunan Desa.\n\nMEMUTUSKAN:\nMenetapkan: PERATURAN DESA TENTANG RENCANA KERJA PEMERINTAH DESA TAJUNGAN TAHUN ANGGARAN 2026.\n\nBAB I – KETENTUAN UMUM\nPasal 1\nRKPDes Desa Tajungan Tahun 2026 adalah dokumen perencanaan desa untuk periode 1 (satu) tahun yang memuat prioritas program, kegiatan, dan anggaran yang dibutuhkan untuk penyelenggaraan pemerintahan desa.\n\nBAB II – PRIORITAS PROGRAM\nPasal 2\nPrioritas program pembangunan desa tahun 2026 meliputi:\n1. Bidang Pemerintahan: Peningkatan kapasitas perangkat desa dan digitalisasi administrasi;\n2. Bidang Pembangunan: Pembangunan sarana air bersih dan perbaikan jalan desa;\n3. Bidang Kemasyarakatan: Posyandu, bantuan sosial, dan pemberdayaan perempuan;\n4. Bidang Pemberdayaan: Pelatihan UMKM dan pengembangan website desa.\n\nDitetapkan di Desa Tajungan\nPada tanggal 15 Januari 2026\nKEPALA DESA TAJUNGAN,\n\nH. AHMAD FAUZI, S.Sos",
                'category'  => 'Peraturan Desa',
                'year'      => '2026',
                'order'     => 1,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Perdes No.2/2026 – APBDes 2026',
                'excerpt'   => 'Peraturan Desa Tajungan tentang Anggaran Pendapatan dan Belanja Desa Tahun Anggaran 2026.',
                'category'  => 'Peraturan Desa',
                'year'      => '2026',
                'order'     => 2,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Perdes No.1/2025 – RPJMDes 2025–2030',
                'excerpt'   => 'Peraturan Desa Tajungan tentang Rencana Pembangunan Jangka Menengah Desa periode 2025–2030.',
                'category'  => 'Peraturan Desa',
                'year'      => '2025',
                'order'     => 3,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Laporan Realisasi APBDes Semester I 2026',
                'excerpt'   => 'Laporan realisasi anggaran pendapatan dan belanja desa periode Januari–Juni 2026.',
                'category'  => 'Laporan Keuangan',
                'year'      => '2026',
                'link'      => '/transparansi-anggaran?tahun=2026',
                'order'     => 4,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Laporan Pertanggungjawaban APBDes 2025',
                'excerpt'   => 'Laporan pertanggungjawaban pelaksanaan APBDes Desa Tajungan tahun anggaran 2025.',
                'category'  => 'Laporan Keuangan',
                'year'      => '2025',
                'link'      => '/transparansi-anggaran?tahun=2025',
                'order'     => 5,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Berita Acara Musdes Penetapan APBDes 2026',
                'excerpt'   => 'Berita acara pelaksanaan musyawarah desa penetapan APBDes Tajungan tahun anggaran 2026.',
                'body'      => "BERITA ACARA\nMUSYAWARAH DESA PENETAPAN APBDes TAHUN ANGGARAN 2026\n\nPada hari Rabu, tanggal 15 Januari 2026, bertempat di Balai Desa Tajungan, Kecamatan Kamal, Kabupaten Bangkalan, telah diselenggarakan Musyawarah Desa dalam rangka Penetapan Anggaran Pendapatan dan Belanja Desa (APBDes) Tahun Anggaran 2026.\n\nPESERTA MUSYAWARAH:\n1. Kepala Desa dan Perangkat Desa Tajungan\n2. Badan Permusyawaratan Desa (BPD) Tajungan\n3. Tokoh Masyarakat dan Tokoh Agama\n4. Perwakilan Kelompok Perempuan\n5. Perwakilan Kelompok Pemuda\nTotal peserta yang hadir: 47 orang\n\nHASIL MUSYAWARAH:\n1. Musyawarah menyetujui Rancangan APBDes Desa Tajungan Tahun Anggaran 2026;\n2. Total Pendapatan Desa disepakati sebesar Rp 1.240.000.000,-;\n3. Total Belanja Desa disepakati sebesar Rp 1.210.000.000,-;\n4. Sisa Lebih Pembiayaan Anggaran (SILPA) sebesar Rp 30.000.000,-;\n5. Musyawarah berjalan dengan lancar, tertib, dan demokratis.\n\nDemikian Berita Acara ini dibuat untuk digunakan sebagaimana mestinya.\n\nKetua BPD Desa Tajungan,\n\nMOH. SYAIFULLAH\n\nKepala Desa Tajungan,\n\nH. AHMAD FAUZI, S.Sos",
                'category'  => 'Berita Acara',
                'year'      => '2026',
                'order'     => 6,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'SK Kades – Tim Pengelola Kegiatan (TPK) 2026',
                'excerpt'   => 'Surat Keputusan Kepala Desa tentang penetapan Tim Pengelola Kegiatan pelaksana program Dana Desa 2026.',
                'category'  => 'SK Kepala Desa',
                'year'      => '2026',
                'order'     => 7,
                'is_active' => true,
            ],
            [
                'section'   => 'arsip',
                'title'     => 'Data Pokok Desa Tajungan 2025',
                'excerpt'   => 'Dokumen data pokok yang memuat informasi dasar Desa Tajungan per tahun 2025.',
                'category'  => 'Profil & Data',
                'year'      => '2025',
                'link'      => '/profil-desa',
                'order'     => 8,
                'is_active' => true,
            ],
        ];
        foreach ($arsips as $a) {
            PageContent::create($a);
        }

        // Galeri Foto Desa
        $galeris = [
            // Kegiatan
            ['judul' => 'Musyawarah Desa Penyusunan RKPDes', 'kategori' => 'Kegiatan', 'deskripsi' => 'Musyawarah desa bersama perangkat, BPD, dan tokoh masyarakat dalam penyusunan RKPDes tahun anggaran 2027.', 'foto' => 'https://picsum.photos/seed/mkdes1/800/600'],
            ['judul' => 'Posyandu Balita Rutin Bulanan',      'kategori' => 'Kegiatan', 'deskripsi' => 'Kegiatan posyandu balita dan ibu hamil setiap bulan di Balai Desa Tajungan bersama kader posyandu.', 'foto' => 'https://picsum.photos/seed/posyandu2/800/600'],
            ['judul' => 'Pelatihan UMKM Batik Madura',        'kategori' => 'Kegiatan', 'deskripsi' => 'Pelatihan wirausaha dan pengembangan batik khas Madura bagi pelaku UMKM Desa Tajungan.', 'foto' => 'https://picsum.photos/seed/batik3/800/600'],
            ['judul' => 'Gotong Royong Bersih Desa',          'kategori' => 'Kegiatan', 'deskripsi' => 'Kegiatan gotong royong warga membersihkan lingkungan desa dan memperbaiki fasilitas umum.', 'foto' => 'https://picsum.photos/seed/goro4/800/600'],
            ['judul' => 'Sosialisasi Bansos PKH & BPNT',      'kategori' => 'Kegiatan', 'deskripsi' => 'Sosialisasi program bantuan sosial PKH, BPNT, dan BLT Dana Desa kepada warga penerima manfaat.', 'foto' => 'https://picsum.photos/seed/bansos5/800/600'],
            ['judul' => 'Rapat Koordinasi Perangkat Desa',    'kategori' => 'Kegiatan', 'deskripsi' => 'Rapat koordinasi rutin mingguan seluruh perangkat desa di Kantor Desa Tajungan.', 'foto' => 'https://picsum.photos/seed/rapat6/800/600'],
            // Infrastruktur
            ['judul' => 'Pembangunan Jalan Paving Dusun Barat',  'kategori' => 'Infrastruktur', 'deskripsi' => 'Pembangunan jalan paving block sepanjang 300 meter di Dusun Barat menggunakan Dana Desa 2023.', 'foto' => 'https://picsum.photos/seed/jalan7/800/600'],
            ['judul' => 'Sumur Bor Komunal RW 01',               'kategori' => 'Infrastruktur', 'deskripsi' => 'Sumur bor komunal yang melayani kebutuhan air bersih 60 KK di RW 01 Desa Tajungan.', 'foto' => 'https://picsum.photos/seed/sumur8/800/600'],
            ['judul' => 'Gedung PAUD Melati',                    'kategori' => 'Infrastruktur', 'deskripsi' => 'Gedung PAUD Melati yang dibangun dengan Dana Desa tahun 2020 untuk pendidikan anak usia dini.', 'foto' => 'https://picsum.photos/seed/paud9/800/600'],
            ['judul' => 'Renovasi Drainase Jalan Utama',         'kategori' => 'Infrastruktur', 'deskripsi' => 'Pengerjaan saluran drainase sepanjang 450 meter di sepanjang Jalan Raya Tajungan.', 'foto' => 'https://picsum.photos/seed/drainase10/800/600'],
            // Alam & Potensi
            ['judul' => 'Pesisir Selat Madura Desa Tajungan',  'kategori' => 'Alam & Potensi', 'deskripsi' => 'Keindahan pesisir Selat Madura di wilayah utara Desa Tajungan yang menjadi potensi wisata lokal.', 'foto' => 'https://picsum.photos/seed/pantai11/800/600'],
            ['judul' => 'Lahan Pertanian Kas Desa',            'kategori' => 'Alam & Potensi', 'deskripsi' => 'Lahan pertanian kas desa seluas 2.500 m² di Dusun Barat yang dikelola untuk pendapatan asli desa.', 'foto' => 'https://picsum.photos/seed/sawah12/800/600'],
            ['judul' => 'Produksi Batik Tajungan',             'kategori' => 'Alam & Potensi', 'deskripsi' => 'Proses produksi batik khas Tajungan oleh pengrajin lokal yang menjadi unggulan UMKM desa.', 'foto' => 'https://picsum.photos/seed/batik13/800/600'],
            // Sosial Budaya
            ['judul' => 'Peringatan HUT RI ke-80',             'kategori' => 'Sosial Budaya', 'deskripsi' => 'Upacara dan berbagai perlombaan dalam rangka memperingati Hari Kemerdekaan RI ke-80 di lapangan desa.', 'foto' => 'https://picsum.photos/seed/hut14/800/600'],
            ['judul' => 'Pengajian Rutin Warga',               'kategori' => 'Sosial Budaya', 'deskripsi' => 'Kegiatan pengajian rutin bulanan warga Desa Tajungan yang diikuti ratusan jamaah.', 'foto' => 'https://picsum.photos/seed/ngaji15/800/600'],
            ['judul' => 'Karapan Sapi Tradisional',            'kategori' => 'Sosial Budaya', 'deskripsi' => 'Tradisi karapan sapi khas Madura yang diselenggarakan di Desa Tajungan sebagai warisan budaya lokal.', 'foto' => 'https://picsum.photos/seed/karapan16/800/600'],
        ];
        foreach ($galeris as $g) {
            Galeri::create(array_merge($g, ['is_active' => true]));
        }
    }
}