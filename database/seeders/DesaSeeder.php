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

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        // Isi data Statistik Pendidikan
        Statistic::create(['label' => 'SD', 'jumlah' => 150, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'SMP', 'jumlah' => 100, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'SMA', 'jumlah' => 80, 'kategori' => 'Pendidikan']);
        Statistic::create(['label' => 'S1', 'jumlah' => 30, 'kategori' => 'Pendidikan']);

        // Isi data Statistik Rentang Umur
        Statistic::create(['label' => '0-5 Tahun', 'jumlah' => 50, 'kategori' => 'Rentang Umur']);
        Statistic::create(['label' => '6-12 Tahun', 'jumlah' => 80, 'kategori' => 'Rentang Umur']);
        Statistic::create(['label' => '13-18 Tahun', 'jumlah' => 70, 'kategori' => 'Rentang Umur']);
        Statistic::create(['label' => '19-30 Tahun', 'jumlah' => 120, 'kategori' => 'Rentang Umur']);
        Statistic::create(['label' => '31-50 Tahun', 'jumlah' => 150, 'kategori' => 'Rentang Umur']);
        Statistic::create(['label' => '51+ Tahun', 'jumlah' => 60, 'kategori' => 'Rentang Umur']);

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
            'jumlah_rt'       => '12',
            'jumlah_rw'       => '4',
            'tahun_berdiri'   => '1945',
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
    }
}