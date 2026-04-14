# DHISA - Website Desa Tajungan Bangkalan

Website resmi Desa Tajungan, Bangkalan yang dibangun menggunakan Laravel 12. Sistem ini menyediakan informasi desa secara digital dan fitur administrasi untuk pengelolaan data desa.

---

## Fitur

- **Profil Desa** — Informasi umum, visi misi, dan pengaturan desa
- **Pamong Desa** — Data perangkat dan struktur pemerintahan desa
- **Artikel & Berita** — Publikasi informasi dan berita desa
- **Galeri** — Dokumentasi foto kegiatan desa
- **UMKM** — Direktori usaha mikro, kecil, dan menengah warga
- **APBDes** — Anggaran Pendapatan dan Belanja Desa
- **Aset Desa** — Inventaris aset desa beserta koordinat lokasi
- **Agenda** — Jadwal kegiatan desa
- **Pengaduan** — Layanan pengaduan masyarakat
- **Statistik** — Data statistik desa
- **Panel Admin** — Manajemen konten berbasis role admin

---

## Teknologi

| Komponen | Versi |
|----------|-------|
| PHP | ^8.2 |
| Laravel | ^12.0 |
| MySQL | - |
| Maatwebsite Excel | ^3.1 |
| Vite | - |

---

## Instalasi

### 1. Clone Repository

```bash
git clone <url-repository>
cd dhisa
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dhisa
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `dhisa` di MySQL, lalu jalankan migrasi:

```bash
php artisan migrate
```

### 5. Build Assets

```bash
npm run build
```

### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Akses di browser: `http://localhost:8000`

---

## Menjalankan Mode Development

```bash
composer dev
```

Perintah ini menjalankan secara bersamaan: Laravel server, queue listener, log viewer (Pail), dan Vite dev server.

---

## Struktur Modul

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── ArtikelController.php
│   │   ├── AgendaController.php
│   │   ├── ApbdesController.php
│   │   ├── AsetDesaController.php
│   │   ├── AuthController.php
│   │   ├── DesaController.php
│   │   ├── GaleriController.php
│   │   ├── PamongController.php
│   │   └── PengaduanController.php
│   └── Middleware/
│       └── EnsureAdmin.php
└── Models/
    ├── Agenda.php
    ├── Apbdes.php
    ├── Artikel.php
    ├── AsetDesa.php
    ├── DesaSetting.php
    ├── Galeri.php
    ├── PageContent.php
    ├── Pamong.php
    ├── Pengaduan.php
    ├── Statistic.php
    ├── Umkm.php
    └── User.php
```

---

## Akun Admin

Setelah migrasi, buat akun admin melalui:

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@dhisa.id',
    'password' => bcrypt('password'),
    'role' => 'admin',
]);
```

---

## Lisensi

Project ini dikembangkan untuk keperluan Desa Tajungan, Bangkalan.
