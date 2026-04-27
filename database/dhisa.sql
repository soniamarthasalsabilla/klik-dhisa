-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2026 at 02:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `subject_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `type`, `subject_type`, `subject_id`, `subject_label`, `description`, `old_values`, `new_values`, `ip_address`, `created_at`) VALUES
(1, 1, 'login', NULL, NULL, NULL, 'Admin login ke sistem', NULL, NULL, '127.0.0.1', '2026-04-23 06:49:43'),
(2, 1, 'updated', 'BatasDusun', 3, 'BatasDusun #3', 'Mengubah Batas Dusun', '{\"koordinat\": [[-7.153324798627817, 112.6916771080886], [-7.153580286425331, 112.6925776910579], [-7.15343125189416, 112.69289932783268], [-7.153537705135681, 112.69317807970415], [-7.153644158352369, 112.6934782740272], [-7.153771902179641, 112.69349971647888], [-7.153942227227048, 112.6938427957053], [-7.154027389726934, 112.69463616641636], [-7.154389330174147, 112.69508645790104], [-7.1545722964460925, 112.69513994306358], [-7.154769234431106, 112.69546157983834], [-7.155290853548402, 112.69533828574134], [-7.155466500668005, 112.69536508880591], [-7.155567630797123, 112.69527931899933], [-7.156770545351062, 112.69498449289932], [-7.156988772872814, 112.69449667712432], [-7.156674738113428, 112.69347816067088], [-7.156270218443863, 112.6928874734791], [-7.155759245717135, 112.69226028176833], [-7.154833106191789, 112.691750353841], [-7.154141161641744, 112.69165922342152], [-7.154130516332781, 112.69149304442118], [-7.1539655140121186, 112.69140191400172], [-7.153497120002708, 112.69160021862832], [-7.153321472125293, 112.6916859884349]]}', '{\"koordinat\": \"[[-7.156849719413145,112.69493983100635],[-7.156093906345235,112.69566887436243],[-7.1547738917878965,112.69621565687953],[-7.154348079825999,112.69635503281526],[-7.154348079825999,112.695818971524],[-7.154273562691827,112.69489694610304],[-7.154145819004959,112.69407141171448],[-7.153698715819356,…\"}', '127.0.0.1', '2026-04-23 06:51:30'),
(3, 1, 'created', 'BatasDusun', 4, 'BatasDusun #4', 'Menambahkan Batas Dusun', NULL, '{\"id\": 4, \"tipe\": \"dusun\", \"warna\": \"#dc3545\", \"is_active\": true, \"koordinat\": \"[[-7.1541764242259065,112.6940802912636],[-7.155411278285415,112.69427327332846],[-7.15600741353217,112.6946806799098],[-7.156497095473742,112.69536683836263],[-7.154346749122389,112.69635319113857],[-7.154138722118874,112.69407320011958]]\", \"nama_dusun\": \"Dusun Barat\"}', '127.0.0.1', '2026-04-23 06:53:49'),
(4, 1, 'created', 'BatasDusun', 5, 'BatasDusun #5', 'Menambahkan Batas Dusun', NULL, '{\"id\": 5, \"tipe\": \"dusun\", \"warna\": \"#fd7e14\", \"is_active\": true, \"koordinat\": \"[[-7.15404868051185,112.693994521457],[-7.155389987726484,112.69423038842514],[-7.154304167904226,112.6926007620997],[-7.1528138227663085,112.6926007620997],[-7.15404868051185,112.69395163655372]]\", \"nama_dusun\": \"Dusun Utara\"}', '127.0.0.1', '2026-04-23 06:54:35'),
(5, 1, 'created', 'BatasDusun', 6, 'BatasDusun #6', 'Menambahkan Batas Dusun', NULL, '{\"id\": 6, \"tipe\": \"dusun\", \"warna\": \"#6f42c1\", \"is_active\": true, \"koordinat\": \"[[-7.152835113445388,112.69257931964809],[-7.155922251401736,112.69253643474478],[-7.154346749122389,112.69142142725894],[-7.1538996461335875,112.69116411783916],[-7.152920276151795,112.6916144093238],[-7.1526222066098875,112.69208614326013],[-7.152771241405172,112.69253643474478]]\", \"nama_dusun\": \"Dusun Timur\"}', '127.0.0.1', '2026-04-23 06:55:21'),
(6, 1, 'created', 'BatasDusun', 7, 'BatasDusun #7', 'Menambahkan Batas Dusun', NULL, '{\"id\": 7, \"tipe\": \"dusun\", \"warna\": \"#1E5A52\", \"is_active\": true, \"koordinat\": \"[[-7.15639064292245,112.6953025110077],[-7.156965486404425,112.69446625539332],[-7.15598612300105,112.69253643474478],[-7.154290195981764,112.69257643616645],[-7.155386661117169,112.69423822616936],[-7.15634806189498,112.69525615583751]]\", \"nama_dusun\": \"Dusun Selatan\"}', '127.0.0.1', '2026-04-23 06:55:59'),
(7, 1, 'created', 'AsetDesa', 20, 'Musholla Tajungan', 'Menambahkan Aset Desa', NULL, '{\"id\": 20, \"luas\": null, \"nama\": \"Musholla Tajungan\", \"jenis\": \"Bangunan\", \"lokasi\": null, \"kondisi\": \"Baik\", \"is_active\": true, \"keterangan\": null, \"nilai_perolehan\": null, \"tahun_perolehan\": null}', '127.0.0.1', '2026-04-23 07:28:54'),
(8, 1, 'updated', 'AsetDesa', 8, 'PAUD Nurul Hidayat', 'Mengubah Aset Desa', '{\"nama\": \"Gedung PAUD Melati\"}', '{\"nama\": \"PAUD Nurul Hidayat\"}', '127.0.0.1', '2026-04-23 07:31:13'),
(9, 1, 'deleted', 'Umkm', 1, 'Batik Tajungan', 'Menghapus UMKM', '{\"id\": 1, \"foto\": null, \"no_hp\": \"628123456789\", \"pemilik\": \"Hj. Aminah\", \"kategori\": \"Kerajinan\", \"nama_usaha\": \"Batik Tajungan\"}', NULL, '127.0.0.1', '2026-04-23 07:46:06'),
(10, 1, 'updated', 'Umkm', 8, 'rujak depl', 'Mengubah UMKM', '{\"foto\": \"umkm/1776402976.jpeg\"}', '{\"foto\": \"umkm/1776955756.jpeg\"}', '127.0.0.1', '2026-04-23 07:49:16'),
(11, 1, 'updated', 'PageContent', 1, 'H. Ahmad Fauzi, S.Sos', 'Mengubah Konten', '{\"image\": \"kades/kades_1776609271.jpeg\"}', '{\"image\": \"kades/kades_1776955954.jpeg\"}', '127.0.0.1', '2026-04-23 07:52:34'),
(12, 1, 'updated', 'Umkm', 8, 'rujak depl', 'Mengubah UMKM', '{\"dusun\": null, \"alamat\": null}', '{\"dusun\": \"Dusun Utara\", \"alamat\": \"RT 03 RW 01\"}', '127.0.0.1', '2026-04-23 07:57:16'),
(13, 1, 'login', NULL, NULL, NULL, 'Admin login ke sistem', NULL, NULL, '127.0.0.1', '2026-04-23 11:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `judul`, `deskripsi`, `lokasi`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `kategori`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Musyawarah Desa Penyusunan RKPDes 2027', 'Musyawarah desa untuk menyusun Rencana Kerja Pemerintah Desa (RKPDes) tahun anggaran 2027. Dihadiri oleh perangkat desa, BPD, tokoh masyarakat, dan perwakilan warga.', 'Balai Desa Tajungan', '2026-04-19', '09:00:00', '13:00:00', 'Musyawarah', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(2, 'Posyandu Balita & Ibu Hamil', 'Kegiatan posyandu rutin bulanan untuk balita dan ibu hamil. Tersedia layanan penimbangan, pemeriksaan kesehatan dasar, dan pembagian vitamin.', 'Balai Desa Tajungan', '2026-04-24', '08:00:00', '12:00:00', 'Kesehatan', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(3, 'Pelatihan Wirausaha UMKM Batik Madura', 'Pelatihan wirausaha bagi pelaku UMKM Desa Tajungan dengan fokus pada pengembangan batik khas Madura, pemasaran digital, dan manajemen usaha.', 'Gedung Serba Guna Desa Tajungan', '2026-05-02', '08:30:00', '15:00:00', 'Ekonomi', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(4, 'Gotong Royong Bersih Desa', 'Kegiatan gotong royong membersihkan lingkungan desa, perbaikan fasilitas umum, dan penanaman pohon di area publik.', 'Seluruh Wilayah Desa Tajungan', '2026-05-09', '07:00:00', '10:00:00', 'Sosial', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(5, 'Sosialisasi Program Bantuan Sosial 2026', 'Sosialisasi program bantuan sosial PKH, BPNT, dan BLT Dana Desa tahun 2026 kepada warga penerima manfaat.', 'Balai Desa Tajungan', '2026-03-30', '09:00:00', '11:30:00', 'Sosial', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(6, 'Musyawarah Penetapan APBDes 2026', 'Musyawarah desa untuk menetapkan Anggaran Pendapatan dan Belanja Desa (APBDes) tahun 2026.', 'Balai Desa Tajungan', '2026-02-13', '09:00:00', '14:00:00', 'Musyawarah', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `apbdes`
--

CREATE TABLE `apbdes` (
  `id` bigint UNSIGNED NOT NULL,
  `tahun` year NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belanja',
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggaran` bigint NOT NULL DEFAULT '0',
  `realisasi` bigint NOT NULL DEFAULT '0',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apbdes`
--

INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `kegiatan`, `anggaran`, `realisasi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, '2026', 'pendapatan', 'Dana Desa', NULL, 850000000, 850000000, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(2, '2026', 'pendapatan', 'Alokasi Dana Desa (ADD)', NULL, 350000000, 320000000, 2, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(3, '2026', 'pendapatan', 'Pendapatan Asli Desa', 'Sewa Tanah Kas Desa', 25000000, 25000000, 3, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(4, '2026', 'pendapatan', 'Bagi Hasil Pajak', 'Pajak & Retribusi Daerah', 15000000, 12500000, 4, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(5, '2026', 'belanja', 'Bidang Pemerintahan', 'Operasional & Gaji Perangkat Desa', 280000000, 260000000, 5, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(6, '2026', 'belanja', 'Bidang Pembangunan', 'Pembangunan & Perbaikan Jalan Desa', 320000000, 290000000, 6, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(7, '2026', 'belanja', 'Bidang Pembangunan', 'Pembangunan Sarana Air Bersih', 150000000, 95000000, 7, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(8, '2026', 'belanja', 'Bidang Kemasyarakatan', 'Posyandu & Kesehatan Warga', 80000000, 72000000, 8, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(9, '2026', 'belanja', 'Bidang Kemasyarakatan', 'Bantuan Sosial & PKH Desa', 65000000, 65000000, 9, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(10, '2026', 'belanja', 'Bidang Pemberdayaan', 'Pelatihan UMKM & Wirausaha', 45000000, 30000000, 10, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(11, '2026', 'belanja', 'Bidang Pemberdayaan', 'Digitalisasi & Website Desa', 20000000, 17500000, 11, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(12, '2026', 'belanja', 'Bidang Tak Terduga', 'Dana Cadangan & Darurat', 30000000, 8000000, 12, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(13, '2024', 'pendapatan', 'Dana Desa', NULL, 780000000, 780000000, 1, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(14, '2024', 'pendapatan', 'Alokasi Dana Desa (ADD)', NULL, 310000000, 310000000, 2, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(15, '2024', 'pendapatan', 'Pendapatan Asli Desa', 'Sewa Tanah Kas Desa', 20000000, 20000000, 3, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(16, '2024', 'pendapatan', 'Bagi Hasil Pajak', 'Pajak & Retribusi Daerah', 12000000, 11200000, 4, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(17, '2024', 'belanja', 'Bidang Pemerintahan', 'Operasional & Gaji Perangkat Desa', 250000000, 248000000, 5, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(18, '2024', 'belanja', 'Bidang Pembangunan', 'Pembangunan & Perbaikan Jalan Desa', 295000000, 293500000, 6, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(19, '2024', 'belanja', 'Bidang Pembangunan', 'Pembangunan Drainase & Irigasi', 120000000, 118000000, 7, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(20, '2024', 'belanja', 'Bidang Kemasyarakatan', 'Posyandu & Kesehatan Warga', 70000000, 69500000, 8, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(21, '2024', 'belanja', 'Bidang Kemasyarakatan', 'Bantuan Sosial & PKH Desa', 55000000, 55000000, 9, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(22, '2024', 'belanja', 'Bidang Pemberdayaan', 'Pelatihan UMKM & Wirausaha', 35000000, 34000000, 10, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(23, '2024', 'belanja', 'Bidang Tak Terduga', 'Dana Cadangan & Darurat', 25000000, 22000000, 11, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(24, '2025', 'pendapatan', 'Dana Desa', NULL, 820000000, 820000000, 1, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(25, '2025', 'pendapatan', 'Alokasi Dana Desa (ADD)', NULL, 330000000, 330000000, 2, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(26, '2025', 'pendapatan', 'Pendapatan Asli Desa', 'Sewa Tanah Kas Desa', 22000000, 22000000, 3, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(27, '2025', 'pendapatan', 'Bagi Hasil Pajak', 'Pajak & Retribusi Daerah', 13500000, 13000000, 4, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(28, '2025', 'belanja', 'Bidang Pemerintahan', 'Operasional & Gaji Perangkat Desa', 265000000, 265000000, 5, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(29, '2025', 'belanja', 'Bidang Pembangunan', 'Pembangunan & Perbaikan Jalan Desa', 310000000, 308000000, 6, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(30, '2025', 'belanja', 'Bidang Pembangunan', 'Pembangunan Gedung Serbaguna Desa', 180000000, 178500000, 7, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(31, '2025', 'belanja', 'Bidang Kemasyarakatan', 'Posyandu & Kesehatan Warga', 75000000, 74000000, 8, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(32, '2025', 'belanja', 'Bidang Kemasyarakatan', 'Bantuan Sosial & PKH Desa', 60000000, 60000000, 9, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(33, '2025', 'belanja', 'Bidang Pemberdayaan', 'Pelatihan UMKM & Wirausaha', 40000000, 39000000, 10, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(34, '2025', 'belanja', 'Bidang Pemberdayaan', 'Digitalisasi & Website Desa', 15000000, 15000000, 11, '2026-04-15 11:08:14', '2026-04-15 11:08:14'),
(35, '2025', 'belanja', 'Bidang Tak Terduga', 'Dana Cadangan & Darurat', 28000000, 25000000, 12, '2026-04-15 11:08:14', '2026-04-15 11:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikels`
--

INSERT INTO `artikels` (`id`, `judul`, `slug`, `ringkasan`, `isi`, `foto`, `kategori`, `is_active`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Program Desa Cantik Bangkalan Resmi Diluncurkan', 'program-desa-cantik-bangkalan-resmi-diluncurkan', 'Kabupaten Bangkalan resmi meluncurkan program Desa Cantik (Cinta Statistik) untuk meningkatkan kualitas data dan transparansi desa.', 'Pemerintah Kabupaten Bangkalan bersama BPS Bangkalan resmi meluncurkan program Desa Cantik (Cinta Statistik) yang bertujuan meningkatkan kualitas pendataan dan transparansi di tingkat desa.\n\nProgram ini menyasar seluruh desa di Kabupaten Bangkalan, termasuk Desa Tajungan, yang menjadi salah satu desa percontohan dalam program ini.\n\nDengan adanya program Desa Cantik, diharapkan setiap desa memiliki sistem informasi yang lengkap, akurat, dan dapat diakses oleh seluruh lapisan masyarakat.', NULL, 'Pembangunan', 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(2, 'Posyandu Gratis untuk Balita dan Ibu Hamil', 'posyandu-gratis-untuk-balita-dan-ibu-hamil', 'Pemerintah Desa Tajungan mengadakan posyandu gratis setiap minggu pertama dan ketiga setiap bulannya.', 'Dalam rangka meningkatkan kesehatan masyarakat, Pemerintah Desa Tajungan bekerja sama dengan Puskesmas Kamal mengadakan kegiatan Posyandu gratis bagi balita dan ibu hamil.\n\nKegiatan ini diadakan setiap minggu pertama dan ketiga setiap bulan di Balai Desa Tajungan mulai pukul 08.00 hingga 12.00 WIB.\n\nLayanan yang tersedia meliputi: penimbangan berat badan, pemeriksaan kesehatan dasar, pemberian vitamin, dan konsultasi gizi.', NULL, 'Kesehatan', 1, '2026-04-07 00:56:37', '2026-04-14 00:56:37', '2026-04-14 00:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `aset_desas`
--

CREATE TABLE `aset_desas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baik',
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `luas` decimal(12,2) DEFAULT NULL,
  `tahun_perolehan` smallint DEFAULT NULL,
  `nilai_perolehan` bigint DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aset_desas`
--

INSERT INTO `aset_desas` (`id`, `nama`, `jenis`, `kondisi`, `lokasi`, `latitude`, `longitude`, `luas`, `tahun_perolehan`, `nilai_perolehan`, `keterangan`, `foto`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tanah Kas Desa Blok A', 'Tanah', 'Baik', 'Dusun Barat', -7.1559624, 112.6954473, 2500.00, 1985, 0, 'Tanah milik desa untuk pertanian kas desa', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:38:16'),
(2, 'Tanah Makam Umum', 'Tanah', 'Baik', 'Dusun Timur', -7.1548130, 112.6918343, 1200.00, 1970, 0, 'Tanah pemakaman umum warga Desa Tajungan', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:39:20'),
(3, 'Tanah Lapangan Desa', 'Tanah', 'Baik', 'Pusat Desa', -7.1549526, 112.6936769, 3000.00, 1990, 0, 'Lapangan olahraga dan kegiatan warga', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:38:46'),
(4, 'Kantor Desa Tajungan', 'Bangunan', 'Baik', 'Jl. Raya Tajungan', -7.1544683, 112.6961124, 250.00, 2015, 450000000, 'Gedung kantor pemerintahan desa 2 lantai', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 00:20:05'),
(5, 'Balai Desa', 'Bangunan', 'Baik', 'Pusat Desa', -7.1546557, 112.6957700, 400.00, 2018, 380000000, 'Aula pertemuan warga kapasitas 300 orang', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 00:22:21'),
(6, 'Pos Kamling RW 01', 'Bangunan', 'Rusak Ringan', 'RW 01 Dusun Barat', -7.1545805, 112.6944823, 12.00, 2010, 15000000, 'Perlu pengecatan ulang', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:31:36'),
(7, 'Pos Kamling RW 02', 'Bangunan', 'Baik', 'RW 02 Dusun Timur', -7.1541542, 112.6922395, 12.00, 2012, 18000000, NULL, NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:34:58'),
(8, 'PAUD Nurul Hidayat', 'Bangunan', 'Baik', 'Dusun Barat RT 02', -7.1543222, 112.6944870, 80.00, 2020, 120000000, 'Gedung PAUD dibangun dengan Dana Desa', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:35:15'),
(9, 'Motor Dinas Kepala Desa', 'Kendaraan', 'Baik', 'Kantor Desa', -7.1544615, 112.6961477, NULL, 2022, 28000000, 'Honda Beat tahun 2022', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:37:19'),
(10, 'Motor Dinas Sekdes', 'Kendaraan', 'Baik', 'Kantor Desa', -7.1545215, 112.6961134, NULL, 2021, 22000000, 'Yamaha Mio tahun 2021', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:37:35'),
(11, 'Komputer PC Admin', 'Peralatan & Mesin', 'Baik', 'Kantor Desa', NULL, NULL, NULL, 2023, 8500000, NULL, NULL, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(12, 'Laptop Sekretaris', 'Peralatan & Mesin', 'Baik', 'Kantor Desa', NULL, NULL, NULL, 2023, 9800000, NULL, NULL, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(13, 'Printer Multifungsi', 'Peralatan & Mesin', 'Baik', 'Kantor Desa', NULL, NULL, NULL, 2022, 3200000, NULL, NULL, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(14, 'Mesin Pompa Air Desa', 'Peralatan & Mesin', 'Rusak Ringan', 'Pos Air RW 03', NULL, NULL, NULL, 2018, 12000000, 'Perlu servis rutin', NULL, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(15, 'Sound System Balai Desa', 'Peralatan & Mesin', 'Baik', 'Balai Desa', NULL, NULL, NULL, 2021, 15000000, NULL, NULL, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(16, 'Jalan Paving Blok Dusun Barat', 'Infrastruktur', 'Baik', 'Dusun Barat', -7.1546831, 112.6947874, 600.00, 2023, 180000000, 'Paving block sepanjang 300m', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:36:00'),
(17, 'Drainase Jalan Utama', 'Infrastruktur', 'Baik', 'Jl. Raya Tajungan', -7.1544781, 112.6937896, NULL, 2022, 95000000, 'Saluran drainase 450m', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:35:38'),
(18, 'Sumur Bor Komunal RW 01', 'Infrastruktur', 'Baik', 'RW 01', -7.1561760, 112.6931514, NULL, 2020, 45000000, 'Melayani 60 KK', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:36:53'),
(19, 'MCK Umum RW 03', 'Infrastruktur', 'Rusak Ringan', 'RW 03 Dusun Timur', -7.1545604, 112.6918823, 30.00, 2015, 35000000, 'Perlu renovasi atap', NULL, 1, '2026-04-14 00:56:37', '2026-04-23 07:36:21'),
(20, 'Musholla Tajungan', 'Bangunan', 'Baik', NULL, -7.1539937, 112.6916394, NULL, NULL, NULL, NULL, NULL, 1, '2026-04-23 07:28:54', '2026-04-23 07:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `batas_dusun`
--

CREATE TABLE `batas_dusun` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_dusun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dusun',
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3A9A8C',
  `koordinat` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batas_dusun`
--

INSERT INTO `batas_dusun` (`id`, `nama_dusun`, `tipe`, `warna`, `koordinat`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Batas Desa', 'desa', '#1E5A52', '[[-7.156849719413145, 112.69493983100637], [-7.156093906345235, 112.69566887436244], [-7.1547738917878965, 112.69621565687952], [-7.154348079825999, 112.69635503281526], [-7.154348079825999, 112.695818971524], [-7.154273562691827, 112.69489694610304], [-7.154145819004959, 112.69407141171448], [-7.153698715819356, 112.69363184145564], [-7.152793862794375, 112.69257044009896], [-7.152644828006482, 112.69206654248516], [-7.1529003161845175, 112.69159480854884], [-7.153304838840661, 112.69157336609716], [-7.153720006457164, 112.69142326893564], [-7.153911622152825, 112.69118740196748], [-7.1541351736960985, 112.69128389299992], [-7.154294853302843, 112.69150903874228], [-7.154869699424588, 112.69161625100048], [-7.155316801463206, 112.69189500287196], [-7.1558597104926855, 112.6922380820984], [-7.156083261081818, 112.69264548867974], [-7.156530361931545, 112.69320299242264], [-7.156807138428511, 112.69384626597214], [-7.156849719413145, 112.69490766732886]]', 1, '2026-04-21 07:07:44', '2026-04-23 06:51:30'),
(4, 'Dusun Barat', 'dusun', '#dc3545', '[[-7.1541764242259065, 112.6940802912636], [-7.155411278285415, 112.69427327332846], [-7.15600741353217, 112.6946806799098], [-7.156497095473742, 112.69536683836265], [-7.154346749122389, 112.69635319113856], [-7.154138722118874, 112.69407320011958]]', 1, '2026-04-23 06:53:49', '2026-04-23 06:53:49'),
(5, 'Dusun Utara', 'dusun', '#fd7e14', '[[-7.15404868051185, 112.693994521457], [-7.155389987726484, 112.69423038842514], [-7.154304167904226, 112.6926007620997], [-7.1528138227663085, 112.6926007620997], [-7.15404868051185, 112.69395163655372]]', 1, '2026-04-23 06:54:35', '2026-04-23 06:54:35'),
(6, 'Dusun Timur', 'dusun', '#6f42c1', '[[-7.152835113445388, 112.69257931964808], [-7.155922251401736, 112.69253643474478], [-7.154346749122389, 112.69142142725894], [-7.1538996461335875, 112.69116411783916], [-7.152920276151795, 112.6916144093238], [-7.1526222066098875, 112.69208614326013], [-7.152771241405172, 112.69253643474478]]', 1, '2026-04-23 06:55:20', '2026-04-23 06:55:20'),
(7, 'Dusun Selatan', 'dusun', '#1E5A52', '[[-7.15639064292245, 112.6953025110077], [-7.156965486404425, 112.69446625539332], [-7.15598612300105, 112.69253643474478], [-7.154290195981764, 112.69257643616643], [-7.155386661117169, 112.69423822616936], [-7.15634806189498, 112.69525615583753]]', 1, '2026-04-23 06:55:59', '2026-04-23 06:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `desa_settings`
--

CREATE TABLE `desa_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desa_settings`
--

INSERT INTO `desa_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'visi', 'Terwujudnya Desa Tajungan yang Maju, Sejahtera, dan Berdaya Saing Berbasis Statistik pada tahun 2030', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(2, 'misi', '1. Meningkatkan kualitas pelayanan publik berbasis data dan teknologi informasi\n2. Mengembangkan potensi ekonomi lokal melalui UMKM dan sektor pertanian\n3. Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan\n4. Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel\n5. Mengembangkan infrastruktur desa yang merata dan berkelanjutan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(3, 'sejarah', 'Desa Tajungan merupakan salah satu desa yang berada di Kecamatan Kamal, Kabupaten Bangkalan, Madura. Desa ini memiliki sejarah panjang yang erat kaitannya dengan perkembangan Kabupaten Bangkalan.\n\nBerdiri sejak era kolonial Belanda, Desa Tajungan telah mengalami berbagai transformasi sosial dan ekonomi. Nama \"Tajungan\" sendiri berasal dari bahasa Madura yang bermakna area tempat berkumpul para nelayan tradisional.\n\nSeiring berjalannya waktu, Desa Tajungan berkembang menjadi desa yang produktif dengan keberadaan berbagai UMKM, khususnya di bidang batik, kuliner, dan kerajinan tangan khas Madura.', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(4, 'luas_wilayah', '145', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(5, 'jumlah_penduduk', '2450', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(6, 'jumlah_kk', '650', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(7, 'jumlah_rt', '12', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(8, 'jumlah_rw', '4', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(9, 'tahun_berdiri', '1945', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(10, 'batas_utara', 'Selat Madura', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(11, 'batas_selatan', 'Desa Gili Anyar', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(12, 'batas_timur', 'Desa Banyuajuh', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(13, 'batas_barat', 'Desa Kamal', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(14, 'jumlah_dusun', '2', '2026-04-14 06:47:05', '2026-04-14 06:47:05'),
(15, 'jarak_kecamatan', '3', '2026-04-14 06:47:05', '2026-04-14 06:47:05'),
(16, 'jarak_kabupaten', '14', '2026-04-14 06:47:05', '2026-04-14 06:47:05'),
(17, 'jarak_provinsi', '120', '2026-04-14 06:47:05', '2026-04-14 06:47:05'),
(18, 'kontak_ambulans', '118', '2026-04-14 06:49:05', '2026-04-14 06:49:05'),
(19, 'kontak_polisi', '110', '2026-04-14 06:49:05', '2026-04-14 06:49:05'),
(20, 'kontak_pemadam', '113', '2026-04-14 06:49:05', '2026-04-14 06:49:05'),
(21, 'kontak_hotline', '0812-3456-7890', '2026-04-14 06:49:05', '2026-04-14 06:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `deskripsi`, `foto`, `kategori`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Musyawarah Desa Penyusunan RKPDes', 'Musyawarah desa bersama perangkat, BPD, dan tokoh masyarakat dalam penyusunan RKPDes tahun anggaran 2027.', 'https://picsum.photos/seed/mkdes1/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(2, 'Posyandu Balita Rutin Bulanan', 'Kegiatan posyandu balita dan ibu hamil setiap bulan di Balai Desa Tajungan bersama kader posyandu.', 'https://picsum.photos/seed/posyandu2/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(3, 'Pelatihan UMKM Batik Madura', 'Pelatihan wirausaha dan pengembangan batik khas Madura bagi pelaku UMKM Desa Tajungan.', 'https://picsum.photos/seed/batik3/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(4, 'Gotong Royong Bersih Desa', 'Kegiatan gotong royong warga membersihkan lingkungan desa dan memperbaiki fasilitas umum.', 'https://picsum.photos/seed/goro4/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(5, 'Sosialisasi Bansos PKH & BPNT', 'Sosialisasi program bantuan sosial PKH, BPNT, dan BLT Dana Desa kepada warga penerima manfaat.', 'https://picsum.photos/seed/bansos5/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(6, 'Rapat Koordinasi Perangkat Desa', 'Rapat koordinasi rutin mingguan seluruh perangkat desa di Kantor Desa Tajungan.', 'https://picsum.photos/seed/rapat6/800/600', 'Kegiatan', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(7, 'Pembangunan Jalan Paving Dusun Barat', 'Pembangunan jalan paving block sepanjang 300 meter di Dusun Barat menggunakan Dana Desa 2023.', 'https://picsum.photos/seed/jalan7/800/600', 'Infrastruktur', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(8, 'Sumur Bor Komunal RW 01', 'Sumur bor komunal yang melayani kebutuhan air bersih 60 KK di RW 01 Desa Tajungan.', 'https://picsum.photos/seed/sumur8/800/600', 'Infrastruktur', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(9, 'Gedung PAUD Melati', 'Gedung PAUD Melati yang dibangun dengan Dana Desa tahun 2020 untuk pendidikan anak usia dini.', 'https://picsum.photos/seed/paud9/800/600', 'Infrastruktur', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(10, 'Renovasi Drainase Jalan Utama', 'Pengerjaan saluran drainase sepanjang 450 meter di sepanjang Jalan Raya Tajungan.', 'https://picsum.photos/seed/drainase10/800/600', 'Infrastruktur', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(11, 'Pesisir Selat Madura Desa Tajungan', 'Keindahan pesisir Selat Madura di wilayah utara Desa Tajungan yang menjadi potensi wisata lokal.', 'https://picsum.photos/seed/pantai11/800/600', 'Alam & Potensi', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(12, 'Lahan Pertanian Kas Desa', 'Lahan pertanian kas desa seluas 2.500 m2 di Dusun Barat yang dikelola untuk pendapatan asli desa.', 'https://picsum.photos/seed/sawah12/800/600', 'Alam & Potensi', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(13, 'Produksi Batik Tajungan', 'Proses produksi batik khas Tajungan oleh pengrajin lokal yang menjadi unggulan UMKM desa.', 'https://picsum.photos/seed/batik13/800/600', 'Alam & Potensi', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(14, 'Peringatan HUT RI ke-80', 'Upacara dan berbagai perlombaan dalam rangka memperingati Hari Kemerdekaan RI ke-80 di lapangan desa.', 'https://picsum.photos/seed/hut14/800/600', 'Sosial Budaya', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(15, 'Pengajian Rutin Warga', 'Kegiatan pengajian rutin bulanan warga Desa Tajungan yang diikuti ratusan jamaah.', 'https://picsum.photos/seed/ngaji15/800/600', 'Sosial Budaya', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38'),
(16, 'Karapan Sapi Tradisional', 'Tradisi karapan sapi khas Madura yang diselenggarakan di Desa Tajungan sebagai warisan budaya lokal.', 'https://picsum.photos/seed/karapan16/800/600', 'Sosial Budaya', 1, '2026-04-14 01:01:38', '2026-04-14 01:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak_darurat`
--

CREATE TABLE `kontak_darurat` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fa-phone-alt',
  `warna_bg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#E8F5F0',
  `warna_teks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1E5A52',
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontak_darurat`
--

INSERT INTO `kontak_darurat` (`id`, `nama`, `nomor`, `icon`, `warna_bg`, `warna_teks`, `urutan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ambulans', '118', 'fa-ambulance', '#fce4e4', '#dc3545', 1, 1, '2026-04-23 11:05:21', '2026-04-23 11:05:21'),
(2, 'Polisi', '110', 'fa-shield-alt', '#cfe2ff', '#0d6efd', 2, 1, '2026-04-23 11:05:21', '2026-04-23 11:05:21'),
(3, 'Pemadam Kebakaran', '113', 'fa-fire', '#fff3cd', '#856404', 3, 1, '2026-04-23 11:05:21', '2026-04-23 11:05:21'),
(4, 'Hotline Desa', '-', 'fa-home', '#E8F5F0', '#1E5A52', 4, 1, '2026-04-23 11:05:21', '2026-04-23 11:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_02_020955_create_umkms_table', 1),
(5, '2026_03_02_042414_create_statistics_table', 1),
(6, '2026_04_08_000001_add_foto_to_umkms_table', 1),
(7, '2026_04_08_000002_create_page_contents_table', 1),
(8, '2026_04_08_032958_add_file_to_page_contents_table', 1),
(9, '2026_04_08_044656_add_role_to_users_table', 1),
(10, '2026_04_09_000001_create_desa_settings_table', 1),
(11, '2026_04_09_000002_create_pamongs_table', 1),
(12, '2026_04_09_000003_create_galeris_table', 1),
(13, '2026_04_09_000004_create_artikels_table', 1),
(14, '2026_04_09_000005_create_apbdes_table', 1),
(15, '2026_04_09_000006_create_pengaduans_table', 1),
(16, '2026_04_09_000007_create_agendas_table', 1),
(17, '2026_04_09_100000_create_aset_desas_table', 1),
(18, '2026_04_09_200000_add_coordinates_to_aset_desas_table', 1),
(19, '2026_04_14_135027_create_batas_dusun_table', 2),
(20, '2026_04_17_044848_change_kategori_and_nohp_in_umkms_table', 3),
(21, '2026_04_21_133707_add_tipe_to_batas_dusun_table', 4),
(22, '2026_04_23_000001_create_visitor_logs_table', 5),
(23, '2026_04_23_000002_create_activity_logs_table', 5),
(24, '2026_04_23_145050_add_alamat_dusun_to_umkms_table', 6),
(25, '2026_04_23_180459_create_kontak_darurat_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `section`, `title`, `excerpt`, `body`, `category`, `year`, `link`, `image`, `file`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'kades', 'H. Ahmad Fauzi, S.Sos', 'Mewujudkan Desa Tajungan yang transparan dan berbasis digital melalui program Desa Cantik (Cinta Statistik). Kami berkomitmen melayani warga dengan data yang akurat.', 'Kepala Desa Tajungan', 'profil', NULL, NULL, 'kades/kades_1776955954.jpeg', NULL, 0, 1, '2026-04-14 00:56:37', '2026-04-23 07:52:34'),
(2, 'layanan', 'Surat Keterangan Domisili', 'Surat keterangan tempat tinggal/domisili warga yang diperlukan untuk berbagai keperluan administratif.', 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW', 'Administrasi', NULL, NULL, NULL, NULL, 1, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(3, 'layanan', 'Surat Keterangan Pindah', 'Surat resmi pindah domisili ke alamat baru di dalam maupun luar desa.', 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW, Alasan kepindahan', 'Administrasi', NULL, NULL, NULL, NULL, 2, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(4, 'layanan', 'Pengantar Pembuatan KTP / KK', 'Surat pengantar dari desa untuk pembuatan atau perubahan data KTP dan Kartu Keluarga di Disdukcapil.', 'Syarat: Kartu Keluarga (KK) lama, Surat pengantar RT/RW, Akta lahir (untuk pemula), Pas foto 3x4 (2 lembar)', 'Administrasi', NULL, NULL, NULL, NULL, 3, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(5, 'layanan', 'Surat Keterangan Tidak Mampu (SKTM)', 'Surat keterangan kondisi ekonomi warga, digunakan untuk keperluan beasiswa, kesehatan, dan bantuan sosial.', 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK) asli dan fotokopi, Surat pengantar RT/RW, Bukti tagihan listrik/air (jika ada)', 'Keterangan', NULL, NULL, NULL, NULL, 4, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(6, 'layanan', 'Surat Keterangan Usaha', 'Surat keterangan untuk warga yang memiliki usaha atau UMKM, digunakan untuk keperluan permodalan dan perizinan.', 'Syarat: KTP asli dan fotokopi, Kartu Keluarga (KK), Surat pengantar RT/RW, Deskripsi jenis usaha', 'Keterangan', NULL, NULL, NULL, NULL, 5, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(7, 'layanan', 'Surat Keterangan Kelahiran', 'Surat keterangan kelahiran anak dari desa sebagai dokumen pendukung pengurusan akta lahir di Disdukcapil.', 'Syarat: KTP kedua orang tua, Kartu Keluarga (KK), Surat keterangan bidan/dokter, Surat nikah orang tua', 'Keterangan', NULL, NULL, NULL, NULL, 6, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(8, 'layanan', 'Surat Keterangan Kematian', 'Surat keterangan kematian warga dari desa sebagai dokumen pendukung pengurusan akta kematian.', 'Syarat: KTP almarhum/almarhumah, Kartu Keluarga (KK), Surat keterangan dokter atau surat pernyataan saksi, Surat pengantar RT/RW', 'Keterangan', NULL, NULL, NULL, NULL, 7, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(9, 'layanan', 'Izin Keramaian / Hajatan', 'Surat izin penyelenggaraan kegiatan keramaian, hajatan, atau acara yang melibatkan banyak warga.', 'Syarat: KTP pemohon, Surat permohonan tertulis, Persetujuan tetangga sekitar, Jadwal dan rencana acara', 'Perizinan', NULL, NULL, NULL, NULL, 8, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(10, 'layanan', 'Izin Mendirikan Bangunan (Rekomendasi)', 'Surat rekomendasi dari desa untuk pengurusan Izin Mendirikan Bangunan (IMB) di tingkat kecamatan/kabupaten.', 'Syarat: KTP pemohon, Kartu Keluarga (KK), Bukti kepemilikan tanah, Denah/gambar bangunan, Surat pengantar RT/RW', 'Perizinan', NULL, NULL, NULL, NULL, 9, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(11, 'layanan', 'Pendaftaran Penerima PKH', 'Pendaftaran dan verifikasi data calon penerima Program Keluarga Harapan (PKH) bagi keluarga kurang mampu.', 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Buku tabungan (jika ada), Dokumen pendukung anak', 'Bantuan Sosial', NULL, NULL, NULL, NULL, 10, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(12, 'layanan', 'Pendaftaran BPNT / Sembako', 'Verifikasi dan pendaftaran warga sebagai penerima Bantuan Pangan Non Tunai (BPNT) / Program Sembako.', 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Foto rumah tampak depan', 'Bantuan Sosial', NULL, NULL, NULL, NULL, 11, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(13, 'layanan', 'BLT Dana Desa', 'Pengajuan dan verifikasi penerima Bantuan Langsung Tunai (BLT) yang bersumber dari Dana Desa.', 'Syarat: KTP kepala keluarga, Kartu Keluarga (KK), Surat Keterangan Tidak Mampu (SKTM), Surat pengantar RT/RW, Tidak sedang menerima bansos lain', 'Bantuan Sosial', NULL, NULL, NULL, NULL, 12, 1, '2026-04-14 00:59:24', '2026-04-14 00:59:24'),
(14, 'informasi', 'Peraturan Desa Tajungan No. 1 Tahun 2026 tentang RKPDes', 'Rencana Kerja Pemerintah Desa Tajungan tahun anggaran 2026 yang memuat prioritas program dan kegiatan pembangunan desa.', NULL, 'Peraturan Desa', '2026', NULL, NULL, NULL, 1, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(15, 'informasi', 'Peraturan Desa Tajungan No. 2 Tahun 2026 tentang APBDes', 'Anggaran Pendapatan dan Belanja Desa Tajungan tahun anggaran 2026 beserta rincian program dan kegiatan.', NULL, 'Peraturan Desa', '2026', NULL, NULL, NULL, 2, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(16, 'informasi', 'Peraturan Desa Tajungan No. 1 Tahun 2025 tentang RPJMDes', 'Rencana Pembangunan Jangka Menengah Desa Tajungan periode 2025–2030 sebagai acuan pembangunan desa.', NULL, 'Peraturan Desa', '2025', NULL, NULL, NULL, 3, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(17, 'informasi', 'RKPDes Desa Tajungan Tahun 2026', 'Dokumen Rencana Kerja Pemerintah Desa memuat daftar usulan kegiatan prioritas yang akan dilaksanakan pada tahun 2026.', NULL, 'Dokumen Perencanaan', '2026', NULL, NULL, NULL, 4, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(18, 'informasi', 'RPJMDes Desa Tajungan 2025–2030', 'Dokumen perencanaan pembangunan desa jangka menengah selama 6 tahun sebagai pedoman arah pembangunan Desa Tajungan.', NULL, 'Dokumen Perencanaan', '2025', NULL, NULL, NULL, 5, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(19, 'informasi', 'Profil Desa Tajungan 2025', 'Data profil desa mencakup kondisi geografis, demografis, ekonomi, dan sosial budaya Desa Tajungan per tahun 2025.', NULL, 'Dokumen Perencanaan', '2025', NULL, NULL, NULL, 6, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(20, 'informasi', 'Laporan Realisasi APBDes Semester I Tahun 2026', 'Laporan realisasi anggaran pendapatan dan belanja desa periode Januari–Juni 2026.', NULL, 'Laporan Keuangan', '2026', '/transparansi-anggaran', NULL, NULL, 7, 1, '2026-04-14 06:45:34', '2026-04-19 10:26:23'),
(21, 'informasi', 'Laporan Pertanggungjawaban APBDes Tahun 2025', 'Laporan pertanggungjawaban pelaksanaan APBDes Desa Tajungan tahun anggaran 2025 yang telah diaudit.', NULL, 'Laporan Keuangan', '2025', NULL, NULL, NULL, 8, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(22, 'informasi', 'Laporan Dana Desa Tahun 2025', 'Laporan penggunaan Dana Desa tahun 2025 sesuai Peraturan Menteri Keuangan dan Peraturan Menteri Desa.', NULL, 'Laporan Keuangan', '2025', NULL, NULL, NULL, 9, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(23, 'informasi', 'SK Kepala Desa tentang Tim Pengelola Kegiatan (TPK) 2026', 'Surat Keputusan Kepala Desa Tajungan tentang penetapan Tim Pengelola Kegiatan pelaksana program Dana Desa tahun 2026.', NULL, 'SK & Berita Acara', '2026', NULL, NULL, NULL, 10, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(24, 'informasi', 'Berita Acara Musyawarah Desa Penetapan APBDes 2026', 'Berita acara pelaksanaan musyawarah desa dalam rangka penetapan APBDes Tajungan tahun anggaran 2026.', NULL, 'SK & Berita Acara', '2026', NULL, NULL, NULL, 11, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(25, 'informasi', 'SK Kepala Desa tentang BPD Desa Tajungan Periode 2024–2030', 'Surat Keputusan tentang pengangkatan dan susunan anggota Badan Permusyawaratan Desa (BPD) Tajungan masa jabatan 2024–2030.', NULL, 'SK & Berita Acara', '2024', NULL, NULL, NULL, 12, 1, '2026-04-14 06:45:34', '2026-04-14 06:45:34'),
(26, 'arsip', 'Perdes No.1/2026 – RKPDes 2026', 'Peraturan Desa tentang Rencana Kerja Pemerintah Desa Tajungan Tahun 2026.', 'PERATURAN DESA TAJUNGAN\nNOMOR 1 TAHUN 2026\nTENTANG RENCANA KERJA PEMERINTAH DESA (RKPDes) TAHUN ANGGARAN 2026\n\nDengan Rahmat Tuhan Yang Maha Esa,\nKEPALA DESA TAJUNGAN,\n\nMenimbang:\na. Bahwa dalam rangka penyelenggaraan pemerintahan desa, pelaksanaan pembangunan, pembinaan kemasyarakatan, dan pemberdayaan masyarakat, perlu disusun Rencana Kerja Pemerintah Desa;\nb. Bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, perlu menetapkan Peraturan Desa tentang RKPDes Tahun Anggaran 2026.\n\nMengingat:\n1. Undang-Undang Nomor 6 Tahun 2014 tentang Desa;\n2. Peraturan Pemerintah Nomor 43 Tahun 2014 tentang Peraturan Pelaksanaan Undang-Undang Desa;\n3. Peraturan Menteri Dalam Negeri Nomor 114 Tahun 2014 tentang Pedoman Pembangunan Desa.\n\nMEMUTUSKAN:\nMenetapkan: PERATURAN DESA TENTANG RENCANA KERJA PEMERINTAH DESA TAJUNGAN TAHUN ANGGARAN 2026.\n\nBAB I – KETENTUAN UMUM\nPasal 1\nRKPDes Desa Tajungan Tahun 2026 adalah dokumen perencanaan desa untuk periode 1 (satu) tahun yang memuat prioritas program, kegiatan, dan anggaran yang dibutuhkan untuk penyelenggaraan pemerintahan desa.\n\nBAB II – PRIORITAS PROGRAM\nPasal 2\nPrioritas program pembangunan desa tahun 2026 meliputi:\n1. Bidang Pemerintahan: Peningkatan kapasitas perangkat desa dan digitalisasi administrasi;\n2. Bidang Pembangunan: Pembangunan sarana air bersih dan perbaikan jalan desa;\n3. Bidang Kemasyarakatan: Posyandu, bantuan sosial, dan pemberdayaan perempuan;\n4. Bidang Pemberdayaan: Pelatihan UMKM dan pengembangan website desa.\n\nDitetapkan di Desa Tajungan\nPada tanggal 15 Januari 2026\nKEPALA DESA TAJUNGAN,\n\nH. AHMAD FAUZI, S.Sos', 'Peraturan Desa', '2026', NULL, NULL, NULL, 1, 1, '2026-04-14 06:58:54', '2026-04-19 10:30:03'),
(27, 'arsip', 'Perdes No.2/2026 – APBDes 2026', 'Peraturan Desa tentang Anggaran Pendapatan dan Belanja Desa Tajungan Tahun 2026.', NULL, 'Peraturan Desa', '2026', NULL, NULL, NULL, 2, 1, '2026-04-14 06:58:54', '2026-04-14 06:58:54'),
(28, 'arsip', 'Perdes No.1/2025 – RPJMDes 2025–2030', 'Peraturan Desa tentang Rencana Pembangunan Jangka Menengah Desa Tajungan periode 2025–2030.', NULL, 'Peraturan Desa', '2025', NULL, NULL, NULL, 3, 1, '2026-04-14 06:58:54', '2026-04-14 06:58:54'),
(29, 'arsip', 'Laporan Realisasi APBDes Semester I 2026', 'Laporan realisasi anggaran pendapatan dan belanja desa periode Januari–Juni 2026.', NULL, 'Laporan Keuangan', '2026', '/transparansi-anggaran?tahun=2026', NULL, NULL, 4, 1, '2026-04-14 06:58:54', '2026-04-19 10:30:03'),
(30, 'arsip', 'Laporan Pertanggungjawaban APBDes 2025', 'Laporan pertanggungjawaban realisasi APBDes Tajungan tahun anggaran 2025.', NULL, 'Laporan Keuangan', '2025', NULL, NULL, NULL, 5, 1, '2026-04-14 06:58:54', '2026-04-14 06:58:54'),
(31, 'arsip', 'Berita Acara Musdes Penetapan APBDes 2026', 'Berita acara musyawarah desa dalam rangka penetapan APBDes Tajungan Tahun 2026.', 'BERITA ACARA\nMUSYAWARAH DESA PENETAPAN APBDes TAHUN ANGGARAN 2026\n\nPada hari Rabu, tanggal 15 Januari 2026, bertempat di Balai Desa Tajungan, Kecamatan Kamal, Kabupaten Bangkalan, telah diselenggarakan Musyawarah Desa dalam rangka Penetapan Anggaran Pendapatan dan Belanja Desa (APBDes) Tahun Anggaran 2026.\n\nPESERTA MUSYAWARAH:\n1. Kepala Desa dan Perangkat Desa Tajungan\n2. Badan Permusyawaratan Desa (BPD) Tajungan\n3. Tokoh Masyarakat dan Tokoh Agama\n4. Perwakilan Kelompok Perempuan\n5. Perwakilan Kelompok Pemuda\nTotal peserta yang hadir: 47 orang\n\nHASIL MUSYAWARAH:\n1. Musyawarah menyetujui Rancangan APBDes Desa Tajungan Tahun Anggaran 2026;\n2. Total Pendapatan Desa disepakati sebesar Rp 1.240.000.000,-;\n3. Total Belanja Desa disepakati sebesar Rp 1.210.000.000,-;\n4. Sisa Lebih Pembiayaan Anggaran (SILPA) sebesar Rp 30.000.000,-;\n5. Musyawarah berjalan dengan lancar, tertib, dan demokratis.\n\nDemikian Berita Acara ini dibuat untuk digunakan sebagaimana mestinya.\n\nKetua BPD Desa Tajungan,\n\nMOH. SYAIFULLAH\n\nKepala Desa Tajungan,\n\nH. AHMAD FAUZI, S.Sos', 'Berita Acara', '2026', NULL, NULL, NULL, 6, 1, '2026-04-14 06:58:54', '2026-04-19 10:30:03'),
(32, 'arsip', 'SK Kades – Tim Pengelola Kegiatan (TPK) 2026', 'Surat Keputusan Kepala Desa tentang penetapan Tim Pengelola Kegiatan Dana Desa 2026.', NULL, 'SK Kepala Desa', '2026', NULL, NULL, NULL, 7, 1, '2026-04-14 06:58:54', '2026-04-14 06:58:54'),
(33, 'arsip', 'Data Pokok Desa Tajungan 2025', 'Rekap data pokok desa mencakup kependudukan, sosial, ekonomi, dan infrastruktur per tahun 2025.', NULL, 'Profil & Data', '2025', '/profil-desa', NULL, NULL, 8, 1, '2026-04-14 06:58:54', '2026-04-19 10:30:03'),
(34, 'kades', 'H. Ahmad Fauzi, S.Sos', 'Mewujudkan Desa Tajungan yang transparan dan berbasis digital melalui program Desa Cantik (Cinta Statistik). Kami berkomitmen melayani warga dengan data yang akurat.', 'Kepala Desa Tajungan', 'profil', NULL, NULL, NULL, NULL, 0, 1, '2026-04-15 11:04:00', '2026-04-15 11:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `pamongs`
--

CREATE TABLE `pamongs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pamongs`
--

INSERT INTO `pamongs` (`id`, `nama`, `jabatan`, `foto`, `no_hp`, `urutan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'H. Ahmad Fauzi, S.Sos', 'Kepala Desa', NULL, '6281234560001', 1, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(2, 'Siti Rahmah, S.Pd', 'Sekretaris Desa', NULL, '6281234560002', 2, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(3, 'Moh. Iqbal', 'Kasi Pemerintahan', NULL, '6281234560003', 3, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(4, 'Farida Hanum', 'Kasi Kesejahteraan', NULL, '6281234560004', 4, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(5, 'Abdul Rohim', 'Kaur Keuangan', NULL, '6281234560005', 5, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(6, 'Nurul Hidayah', 'Kaur Perencanaan', NULL, NULL, 6, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(7, 'Sulaiman', 'Kepala Dusun Barat', NULL, NULL, 7, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(8, 'Ahmad Zaini', 'Kepala Dusun Timur', NULL, NULL, 8, 1, '2026-04-14 00:56:37', '2026-04-14 00:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWFl2aTEyNENEMTNxMmlsSk1VZldKOXRrY3pqbXVCM1BTUkFRMWJvViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdW1rbS1kZXNhIjtzOjU6InJvdXRlIjtzOjk6InVta20uZGVzYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1776956245),
('yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYkwwSGVtSktSQXVxeEpqMTBDRG5kajNjZzhUZUFobjNOeG0yanZScCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXRhLWRlc2EiO3M6NToicm91dGUiO3M6OToicGV0YS5kZXNhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1776968741);

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `label`, `jumlah`, `kategori`, `created_at`, `updated_at`) VALUES
(11, 'Petani', 200, 'Pekerjaan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(12, 'Buruh', 100, 'Pekerjaan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(13, 'Pedagang', 80, 'Pekerjaan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(14, 'PNS', 30, 'Pekerjaan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(15, 'Wiraswasta', 50, 'Pekerjaan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(16, 'Islam', 400, 'Agama', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(17, 'Kristen', 50, 'Agama', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(18, 'Hindu', 20, 'Agama', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(19, 'Budha', 10, 'Agama', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(20, 'Belum Kawin', 150, 'Status Perkawinan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(21, 'Kawin', 300, 'Status Perkawinan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(22, 'Cerai Hidup', 20, 'Status Perkawinan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(23, 'Cerai Mati', 10, 'Status Perkawinan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(24, 'Laki-laki', 350, 'Kepala Keluarga', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(25, 'Perempuan', 50, 'Kepala Keluarga', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(26, 'Sejahtera', 100, 'Kesejahteraan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(27, 'Kurang Sejahtera', 200, 'Kesejahteraan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(28, 'Tidak Sejahtera', 100, 'Kesejahteraan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(29, 'BPJS Kesehatan', 300, 'Jaminan Kesehatan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(30, 'Tidak Ada', 100, 'Jaminan Kesehatan', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(31, 'Ibu Hamil / Nifas', 12, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(32, 'Anak Usia Dini (0-6 tahun)', 35, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(33, 'Anak SD / Sederajat', 45, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(34, 'Anak SMP / Sederajat', 28, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(35, 'Anak SMA / Sederajat', 15, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(36, 'Lansia (70+ tahun)', 10, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(37, 'Disabilitas Berat', 5, 'PKH', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(38, 'Aktif Menerima', 242, 'BPNT', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(39, 'Dalam Verifikasi', 18, 'BPNT', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(40, 'Diusulkan Hapus', 10, 'BPNT', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(41, 'Miskin Ekstrem (belum terdata bantuan lain)', 30, 'BLT Dana Desa', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(42, 'Anggota Keluarga Sakit / Disabilitas', 15, 'BLT Dana Desa', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(43, 'Lansia Tunggal Tanpa Penanggung', 10, 'BLT Dana Desa', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(44, 'Kehilangan Mata Pencaharian', 5, 'BLT Dana Desa', '2026-04-14 00:56:37', '2026-04-14 00:56:37'),
(45, '0–4 Tahun', 35, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(46, '5–9 Tahun', 42, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(47, '10–14 Tahun', 48, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(48, '15–19 Tahun', 55, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(49, '20–24 Tahun', 62, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(50, '25–29 Tahun', 58, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(51, '30–34 Tahun', 65, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(52, '35–39 Tahun', 70, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(53, '40–44 Tahun', 63, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(54, '45–49 Tahun', 55, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(55, '50–54 Tahun', 48, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(56, '55–59 Tahun', 40, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(57, '60–64 Tahun', 32, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(58, '65–69 Tahun', 25, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(59, '70–74 Tahun', 18, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(60, '75+ Tahun', 14, 'Rentang Umur', '2026-04-14 06:46:29', '2026-04-14 07:08:03'),
(61, 'Tidak/Belum Sekolah', 120, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(62, 'Belum Tamat SD/Sederajat', 85, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(63, 'Tamat SD/Sederajat', 310, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(64, 'SMP/Sederajat', 220, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(65, 'SMA/Sederajat', 185, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(66, 'Diploma I/II/III', 45, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(67, 'S1/S2/S3', 72, 'Pendidikan', '2026-04-14 06:46:29', '2026-04-14 06:46:29'),
(68, 'Tidak/Belum Sekolah', 120, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(69, 'Belum Tamat SD/Sederajat', 85, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(70, 'Tamat SD/Sederajat', 310, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(71, 'SMP/Sederajat', 220, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(72, 'SMA/Sederajat', 185, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(73, 'Diploma I/II/III', 45, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(74, 'S1/S2/S3', 72, 'Pendidikan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(75, '0–4 Tahun', 35, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(76, '5–9 Tahun', 42, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(77, '10–14 Tahun', 48, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(78, '15–19 Tahun', 55, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(79, '20–24 Tahun', 62, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(80, '25–29 Tahun', 58, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(81, '30–34 Tahun', 65, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(82, '35–39 Tahun', 70, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(83, '40–44 Tahun', 63, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(84, '45–49 Tahun', 55, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(85, '50–54 Tahun', 48, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(86, '55–59 Tahun', 40, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(87, '60–64 Tahun', 32, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(88, '65–69 Tahun', 25, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(89, '70–74 Tahun', 18, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(90, '75+ Tahun', 14, 'Rentang Umur', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(91, 'Petani', 200, 'Pekerjaan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(92, 'Buruh', 100, 'Pekerjaan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(93, 'Pedagang', 80, 'Pekerjaan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(94, 'PNS', 30, 'Pekerjaan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(95, 'Wiraswasta', 50, 'Pekerjaan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(96, 'Islam', 400, 'Agama', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(97, 'Kristen', 50, 'Agama', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(98, 'Hindu', 20, 'Agama', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(99, 'Budha', 10, 'Agama', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(100, 'Belum Kawin', 150, 'Status Perkawinan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(101, 'Kawin', 300, 'Status Perkawinan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(102, 'Cerai Hidup', 20, 'Status Perkawinan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(103, 'Cerai Mati', 10, 'Status Perkawinan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(104, 'Laki-laki', 350, 'Kepala Keluarga', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(105, 'Perempuan', 50, 'Kepala Keluarga', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(106, 'Sejahtera', 100, 'Kesejahteraan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(107, 'Kurang Sejahtera', 200, 'Kesejahteraan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(108, 'Tidak Sejahtera', 100, 'Kesejahteraan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(109, 'BPJS Kesehatan', 300, 'Jaminan Kesehatan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(110, 'Tidak Ada', 100, 'Jaminan Kesehatan', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(111, 'Ibu Hamil / Nifas', 12, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(112, 'Anak Usia Dini (0-6 tahun)', 35, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(113, 'Anak SD / Sederajat', 45, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(114, 'Anak SMP / Sederajat', 28, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(115, 'Anak SMA / Sederajat', 15, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(116, 'Lansia (70+ tahun)', 10, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(117, 'Disabilitas Berat', 5, 'PKH', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(118, 'Aktif Menerima', 242, 'BPNT', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(119, 'Dalam Verifikasi', 18, 'BPNT', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(120, 'Diusulkan Hapus', 10, 'BPNT', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(121, 'Miskin Ekstrem (belum terdata bantuan lain)', 30, 'BLT Dana Desa', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(122, 'Anggota Keluarga Sakit / Disabilitas', 15, 'BLT Dana Desa', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(123, 'Lansia Tunggal Tanpa Penanggung', 10, 'BLT Dana Desa', '2026-04-15 11:04:00', '2026-04-15 11:04:00'),
(124, 'Kehilangan Mata Pencaharian', 5, 'BLT Dana Desa', '2026-04-15 11:04:00', '2026-04-15 11:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `umkms`
--

CREATE TABLE `umkms` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umkms`
--

INSERT INTO `umkms` (`id`, `nama_usaha`, `pemilik`, `kategori`, `no_hp`, `alamat`, `dusun`, `foto`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(8, 'rujak depl', 'Martha', 'Makanan', '6274593398', 'RT 03 RW 01', 'Dusun Utara', 'umkm/1776955756.jpeg', -7.15491510, 112.69405890, '2026-04-16 22:16:17', '2026-04-23 07:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Desa Tajungan', 'admin@desatajungan.id', 'admin', '2026-04-14 00:56:37', '$2y$12$L1TI09UoxpZnyyimJlEeR.Ry5R9Kgo8.GuWW8xZSr4VouSYAlc7Ai', 'MjjF1Q3b5l', '2026-04-14 00:56:37', '2026-04-14 00:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `browser` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Desktop',
  `page_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visited_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `user_agent`, `browser`, `os`, `device`, `page_url`, `route_name`, `referer`, `session_id`, `visited_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/aset-desa', 'aset.desa', 'http://127.0.0.1:8000/home', '10bsgu424mdZLU4HZG4aUuhAbmor2ZQeJNcnJELI', '2026-04-23 02:58:42'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/aset-desa', '10bsgu424mdZLU4HZG4aUuhAbmor2ZQeJNcnJELI', '2026-04-23 03:14:47'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/home', '10bsgu424mdZLU4HZG4aUuhAbmor2ZQeJNcnJELI', '2026-04-23 03:15:25'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/peta-desa', '10bsgu424mdZLU4HZG4aUuhAbmor2ZQeJNcnJELI', '2026-04-23 03:18:34'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/informasi-publik', 'informasi.publik', 'http://127.0.0.1:8000/home', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:56:44'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/profil-desa', 'profil.desa', 'http://127.0.0.1:8000/informasi-publik', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:56:48'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/aset-desa', 'aset.desa', 'http://127.0.0.1:8000/profil-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:57:15'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/informasi-publik', 'informasi.publik', 'http://127.0.0.1:8000/aset-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:57:29'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/layanan-desa', 'layanan.desa', 'http://127.0.0.1:8000/informasi-publik', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:57:38'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/statistik-penduduk', 'stat.penduduk', 'http://127.0.0.1:8000/layanan-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:57:50'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/statistik-keluarga', 'stat.keluarga', 'http://127.0.0.1:8000/statistik-penduduk', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:58:06'),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/statistik-bantuan', 'stat.bantuan', 'http://127.0.0.1:8000/statistik-keluarga', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:58:19'),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/galeri-foto', 'galeri.desa', 'http://127.0.0.1:8000/statistik-bantuan', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:58:47'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/agenda', 'agenda.desa', 'http://127.0.0.1:8000/galeri-foto', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:58:49'),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/pengaduan', 'pengaduan.form', 'http://127.0.0.1:8000/agenda', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 06:58:51'),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/pengaduan', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:09:40'),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:09:48'),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/profil-desa', 'profil.desa', 'http://127.0.0.1:8000/umkm-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:13:48'),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/profil-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:14:19'),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:14:43'),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/umkm-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:39:41'),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/umkm-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:44:41'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/peta-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:44:54'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/home', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:52:45'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/profil-desa', 'profil.desa', 'http://127.0.0.1:8000/home', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:52:51'),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/profil-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:52:58'),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:55:51'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'ghCOSaq4hBdlkaNjxVIK4tGYTBpGH2gVBxz2odt2', '2026-04-23 07:57:25'),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '//', '', '', 'VzJ8XFejWKAAdXmMtHl72bnJt8txev9TFAQvQOSm', '2026-04-23 11:01:19'),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/portal', 'VzJ8XFejWKAAdXmMtHl72bnJt8txev9TFAQvQOSm', '2026-04-23 11:01:28'),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/profil-desa', 'profil.desa', 'http://127.0.0.1:8000/home', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:06:23'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/profil-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:07:07'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/profil-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:09:05'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/transparansi-anggaran', 'transparansi.anggaran', 'http://127.0.0.1:8000/home', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:14'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/transparansi-anggaran', 'transparansi.anggaran', 'http://127.0.0.1:8000/transparansi-anggaran', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:19'),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/transparansi-anggaran', 'transparansi.anggaran', 'http://127.0.0.1:8000/transparansi-anggaran?tahun=2025', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:22'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/transparansi-anggaran', 'transparansi.anggaran', 'http://127.0.0.1:8000/transparansi-anggaran?tahun=2024', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:26'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/transparansi-anggaran?tahun=2026', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:36'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:11:58'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/umkm-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:12:09'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/peta-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:20:00'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/home', 'home', 'http://127.0.0.1:8000/peta-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:22:36'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/home', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:22:44'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/umkm-desa', 'umkm.desa', 'http://127.0.0.1:8000/peta-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:23:31'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'Edge', 'Windows', 'Desktop', '/peta-desa', 'peta.desa', 'http://127.0.0.1:8000/umkm-desa', 'yoWrf2LFLy50tSzU0CwQIwhFUcFhqeCVwyIE3ANB', '2026-04-23 11:25:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `activity_logs_type_created_at_index` (`type`,`created_at`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikels_slug_unique` (`slug`);

--
-- Indexes for table `aset_desas`
--
ALTER TABLE `aset_desas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batas_dusun`
--
ALTER TABLE `batas_dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `desa_settings`
--
ALTER TABLE `desa_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desa_settings_key_unique` (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_darurat`
--
ALTER TABLE `kontak_darurat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pamongs`
--
ALTER TABLE `pamongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umkms`
--
ALTER TABLE `umkms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `apbdes`
--
ALTER TABLE `apbdes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aset_desas`
--
ALTER TABLE `aset_desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `batas_dusun`
--
ALTER TABLE `batas_dusun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `desa_settings`
--
ALTER TABLE `desa_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontak_darurat`
--
ALTER TABLE `kontak_darurat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pamongs`
--
ALTER TABLE `pamongs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `umkms`
--
ALTER TABLE `umkms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
