-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Des 2024 pada 15.12
-- Versi server: 8.0.30
-- Versi PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activities`
--

INSERT INTO `activities` (`id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dokter', 'Dokter didi ditambahkan', '2024-12-10 23:14:12', '2024-12-10 23:14:12'),
(2, 'poli', 'Poli poli anak ditambahkan', '2024-12-10 23:24:55', '2024-12-10 23:24:55'),
(3, 'poli', 'Poli poli dewasa ditambahkan', '2024-12-11 04:19:21', '2024-12-11 04:19:21'),
(4, 'dokter', 'Dokter dewan ditambahkan', '2024-12-12 01:15:57', '2024-12-12 01:15:57'),
(5, 'pasien', 'Pasien mahe terdaftar', '2024-12-12 01:17:02', '2024-12-12 01:17:02'),
(6, 'poli', 'Poli poli umumm ditambahkan', '2024-12-12 01:18:24', '2024-12-12 01:18:24'),
(7, 'obat', 'Obat ACT (Artesunate tablet 100mg + Amodiaquine anhydrida tablet 200 mg) ditambahkan', '2024-12-12 01:19:27', '2024-12-12 01:19:27'),
(8, 'dokter', 'Dokter meme ditambahkan', '2024-12-18 23:33:25', '2024-12-18 23:33:25'),
(9, 'dokter', 'Dokter ddd ditambahkan', '2024-12-24 23:21:48', '2024-12-24 23:21:48'),
(10, 'dokter', 'Dokter aaa ditambahkan', '2024-12-24 23:22:16', '2024-12-24 23:22:16'),
(11, 'dokter', 'Dokter bb ditambahkan', '2024-12-24 23:22:37', '2024-12-24 23:22:37'),
(12, 'dokter', 'Dokter ccc ditambahkan', '2024-12-24 23:22:58', '2024-12-24 23:22:58'),
(13, 'dokter', 'Dokter ddd ditambahkan', '2024-12-24 23:23:18', '2024-12-24 23:23:18'),
(14, 'dokter', 'Dokter ee ditambahkan', '2024-12-24 23:23:36', '2024-12-24 23:23:36'),
(15, 'dokter', 'Dokter ff ditambahkan', '2024-12-24 23:24:02', '2024-12-24 23:24:02'),
(16, 'obat', 'Obat sss ditambahkan', '2024-12-24 23:27:55', '2024-12-24 23:27:55'),
(17, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:01', '2024-12-24 23:28:01'),
(18, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:13', '2024-12-24 23:28:13'),
(19, 'obat', 'Obat www ditambahkan', '2024-12-24 23:28:21', '2024-12-24 23:28:21'),
(20, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:29', '2024-12-24 23:28:29'),
(21, 'obat', 'Obat www ditambahkan', '2024-12-24 23:28:35', '2024-12-24 23:28:35'),
(22, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:41', '2024-12-24 23:28:41'),
(23, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:50', '2024-12-24 23:28:50'),
(24, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:28:57', '2024-12-24 23:28:57'),
(25, 'obat', 'Obat wwww ditambahkan', '2024-12-24 23:29:02', '2024-12-24 23:29:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_polis`
--

CREATE TABLE `daftar_polis` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pasien` bigint UNSIGNED NOT NULL,
  `id_jadwal` bigint UNSIGNED NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_antrian` int DEFAULT NULL,
  `status` enum('menunggu','diperiksa','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `daftar_polis`
--

INSERT INTO `daftar_polis` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 4, 'sakit kepala , puyenggg', 1, 'selesai', '2024-12-22 11:51:08', '2024-12-23 12:19:40'),
(2, 7, 4, 'gigi saya sakit', 1, 'diperiksa', '2024-12-23 12:18:26', '2024-12-23 17:05:12'),
(3, 7, 3, 'gigi berlubang', 1, 'selesai', '2024-12-23 12:38:11', '2024-12-23 17:49:12'),
(4, 7, 5, 'nyilu di bagian gusi', 1, 'selesai', '2024-12-23 17:57:23', '2024-12-23 22:23:49'),
(5, 7, 3, 'ddd', 1, 'diperiksa', '2024-12-23 22:17:09', '2024-12-23 23:06:24'),
(6, 7, 4, 'dwd', 1, 'menunggu', '2024-12-23 22:17:18', '2024-12-23 22:17:18'),
(7, 7, 5, 'dddd', 2, 'menunggu', '2024-12-23 22:17:27', '2024-12-23 22:17:27'),
(8, 7, 5, 'ddd', 3, 'menunggu', '2024-12-23 22:17:45', '2024-12-23 22:17:45'),
(9, 7, 3, 'dddd', 2, 'selesai', '2024-12-23 22:18:02', '2024-12-27 13:30:33'),
(10, 7, 3, 'ddwd', 3, 'menunggu', '2024-12-23 22:18:09', '2024-12-23 22:18:09'),
(11, 7, 3, 'dddd', 4, 'menunggu', '2024-12-23 22:18:16', '2024-12-23 22:18:16'),
(12, 7, 4, 'sakit gigi', 1, 'selesai', '2024-12-27 13:31:47', '2024-12-27 13:45:36'),
(13, 7, 6, 'gigi berlubang', 1, 'selesai', '2024-12-27 14:25:01', '2024-12-27 14:25:51'),
(14, 8, 6, 'gigi saya bengkak', 2, 'selesai', '2024-12-27 14:30:07', '2024-12-27 14:30:40'),
(15, 8, 6, 'dddd', 3, 'menunggu', '2024-12-27 14:42:33', '2024-12-27 14:42:33'),
(16, 7, 6, 'bbb', 4, 'menunggu', '2024-12-27 14:45:32', '2024-12-27 14:45:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksas`
--

CREATE TABLE `detail_periksas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_periksa` bigint UNSIGNED NOT NULL,
  `id_obat` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_periksas`
--

INSERT INTO `detail_periksas` (`id`, `id_periksa`, `id_obat`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2024-12-23 12:19:29', '2024-12-23 12:19:29'),
(7, 2, 1, '2024-12-23 12:19:40', '2024-12-23 12:19:40'),
(9, 4, 1, '2024-12-23 17:49:12', '2024-12-23 17:49:12'),
(10, 5, 1, '2024-12-23 22:23:49', '2024-12-23 22:23:49'),
(11, 7, 1, '2024-12-27 13:30:33', '2024-12-27 13:30:33'),
(12, 8, 1, '2024-12-27 13:45:36', '2024-12-27 13:45:36'),
(13, 9, 1, '2024-12-27 14:25:51', '2024-12-27 14:25:51'),
(14, 10, 1, '2024-12-27 14:30:40', '2024-12-27 14:30:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokters`
--

CREATE TABLE `dokters` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_poli` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokters`
--

INSERT INTO `dokters` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'dr.gullam', 'Jalan blok D4 semarang indah blok D2 no 08, tawangmas semarang barat', '0827262528', 1, 13, '2024-12-10 05:11:29', '2024-12-10 05:11:29'),
(5, 'fafa', 'sukamara', '02828292', 2, 15, '2024-12-10 23:14:12', '2024-12-27 13:31:05'),
(6, 'heruu', 'genuk', '082163738', 1, 18, '2024-12-12 01:15:57', '2024-12-12 01:16:26'),
(7, 'meme', 'semarang', '082158783230', 3, 20, '2024-12-18 23:33:25', '2024-12-18 23:33:25'),
(8, 'ddd', 'ddd', 'ddd', 2, 21, '2024-12-24 23:21:48', '2024-12-24 23:21:48'),
(9, 'aaa', 'aaa', '9999', 2, 22, '2024-12-24 23:22:16', '2024-12-24 23:22:16'),
(10, 'bb', 'bbb', 'bbb', 1, 23, '2024-12-24 23:22:37', '2024-12-24 23:22:37'),
(11, 'ccc', 'ccc', '9990', 2, 24, '2024-12-24 23:22:58', '2024-12-24 23:22:58'),
(12, 'ddd', 'dd', '000', 2, 25, '2024-12-24 23:23:18', '2024-12-24 23:23:18'),
(13, 'ee', 'ee', '000', 2, 26, '2024-12-24 23:23:36', '2024-12-24 23:23:36'),
(14, 'ff', 'ff', '000', 3, 27, '2024-12-24 23:24:02', '2024-12-24 23:24:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jadwal_periksas`
--

CREATE TABLE `jadwal_periksas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokter` bigint UNSIGNED NOT NULL,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('aktif','tidak aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_periksas`
--

INSERT INTO `jadwal_periksas` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `created_at`, `updated_at`) VALUES
(3, 5, 'Kamis', '07:00:00', '12:07:00', 'tidak aktif', '2024-12-22 04:07:52', '2024-12-27 14:52:35'),
(4, 5, 'Senin', '07:00:00', '10:30:00', 'tidak aktif', '2024-12-22 04:18:09', '2024-12-27 14:52:35'),
(5, 5, 'Selasa', '08:25:00', '10:25:00', 'tidak aktif', '2024-12-23 17:25:30', '2024-12-27 14:52:35'),
(6, 5, 'Rabu', '08:30:00', '10:30:00', 'aktif', '2024-12-27 13:29:07', '2024-12-27 14:52:35'),
(7, 5, 'Jumat', '08:30:00', '10:30:00', 'tidak aktif', '2024-12-27 14:52:01', '2024-12-27 14:52:35'),
(8, 5, 'Sabtu', '08:30:00', '10:30:00', 'tidak aktif', '2024-12-27 14:52:24', '2024-12-27 14:52:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_04_202523_create_polis_table', 1),
(5, '2024_12_04_202529_create_obats_table', 1),
(6, '2024_12_04_202534_create_dokters_table', 1),
(7, '2024_12_04_202558_create_pasiens_table', 1),
(8, '2024_12_04_202619_create_jadwal_periksas_table', 1),
(9, '2024_12_04_202643_create_daftar_polis_table', 1),
(10, '2024_12_04_202657_create_perikasas_table', 1),
(11, '2024_12_04_202719_create_detail_periksas_table', 1),
(12, '2024_12_09_140612_add_role_to_users_table', 2),
(13, '2024_12_10_100858_add_user_id_to_dokters_table', 3),
(14, '2024_12_10_111439_add_user_id_to_pasiens_table', 4),
(15, '2024_12_10_114850_add_on_delete_cascade_to_dokters_table', 5),
(16, '2024_12_10_115029_add_on_delete_cascade_to_pasiens_table', 6),
(17, '2024_12_11_060754_create_activities_table', 7),
(18, '2024_12_22_111454_add_status_to_jadwal_periksas_table', 8),
(19, '2024_12_22_172207_add_status_to_daftar_polis_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_obat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kemasan` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`id`, `nama_obat`, `kemasan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydrida tablet 200 mg)', '2 blister @ 12 tablet / kotak', 50000, '2024-12-10 05:03:06', '2024-12-10 05:03:06'),
(3, 'sss', 'sss', 111, '2024-12-24 23:27:55', '2024-12-24 23:27:55'),
(4, 'wwww', 'wwww', 1111, '2024-12-24 23:28:01', '2024-12-24 23:28:01'),
(5, 'wwww', '111', 1111, '2024-12-24 23:28:13', '2024-12-24 23:28:13'),
(6, 'www', 'www', 1111, '2024-12-24 23:28:21', '2024-12-24 23:28:21'),
(7, 'wwww', 'www', 222, '2024-12-24 23:28:29', '2024-12-24 23:28:29'),
(8, 'www', 'www', 1111, '2024-12-24 23:28:35', '2024-12-24 23:28:35'),
(9, 'wwww', 'wwww', 11111, '2024-12-24 23:28:41', '2024-12-24 23:28:41'),
(10, 'wwww', 'www', 1111, '2024-12-24 23:28:50', '2024-12-24 23:28:50'),
(11, 'wwww', 'www', 11111, '2024-12-24 23:28:57', '2024-12-24 23:28:57'),
(12, 'wwww', 'wwww', 1111, '2024-12-24 23:29:02', '2024-12-24 23:29:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rm` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `created_at`, `updated_at`, `user_id`) VALUES
(7, 'nanda', 'semarang indah', '7292929', '222222', '202412-001', '2024-12-10 05:11:01', '2024-12-27 13:32:23', 12),
(8, 'dewandra', 'poncowolo', '82929292', '0821334', '202412-002', '2024-12-10 08:18:32', '2024-12-10 08:18:32', 14),
(9, 'zalfa', 'Cirebon', '019192829292', '082148484', '202412-003', '2024-12-11 23:49:52', '2024-12-11 23:49:52', 16),
(10, 'babeh', 'tawangmas', '82927', '0821683737', '202412-004', '2024-12-12 01:14:11', '2024-12-12 01:14:11', 17),
(11, 'pere', 'genukk', '8269227', '082126392', '202412-005', '2024-12-12 01:17:02', '2024-12-12 01:17:15', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksas`
--

CREATE TABLE `periksas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_daftar_poli` bigint UNSIGNED NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya_periksa` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `periksas`
--

INSERT INTO `periksas` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`, `created_at`, `updated_at`) VALUES
(2, 1, '2024-12-23', 'tidur yang teratur', 200000, '2024-12-22 14:49:38', '2024-12-23 12:19:40'),
(3, 2, '2024-12-23', 'sikat gigi yang rajin', 200000, '2024-12-23 12:19:29', '2024-12-23 12:19:29'),
(4, 3, '2024-12-24', 'hehehe', 150000, '2024-12-23 17:01:16', '2024-12-23 17:49:12'),
(5, 4, '2024-12-24', 'dddd', 150000, '2024-12-23 17:57:48', '2024-12-23 22:23:49'),
(6, 5, '2024-12-24', '', NULL, '2024-12-23 23:06:24', '2024-12-23 23:06:24'),
(7, 9, '2024-12-27', 'kurangin makanan yang manis', 100000, '2024-12-23 23:06:29', '2024-12-27 13:30:33'),
(8, 12, '2024-12-27', 'hahaha', 200000, '2024-12-27 13:45:36', '2024-12-27 13:45:36'),
(9, 13, '2024-12-27', 'sikat gigi yang sering', 200000, '2024-12-27 14:25:51', '2024-12-27 14:25:51'),
(10, 14, '2024-12-27', 'gosok gigi', 200000, '2024-12-27 14:30:40', '2024-12-27 14:30:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polis`
--

CREATE TABLE `polis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_poli` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `polis`
--

INSERT INTO `polis` (`id`, `nama_poli`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'umum', 'poli umum', '2024-12-10 09:48:30', '2024-12-10 04:00:23'),
(2, 'gigi', 'poli gigi', '2024-12-10 04:00:03', '2024-12-10 04:00:03'),
(3, 'poli anak', 'poli anak', '2024-12-10 23:24:55', '2024-12-10 23:24:55'),
(4, 'poli dewasa', 'poli ini blalblalbla', '2024-12-11 04:19:21', '2024-12-11 04:19:21'),
(5, 'poli umumm', 'kosongg', '2024-12-12 01:18:24', '2024-12-12 01:18:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('X7Lg0jMOtkltjOrMSdoxrJ9w5vGN8LXwsfP6iyJI', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielhIVzlVMVJlc2I2YjE3bG1NbGpLWFNDMzBVWVFoRldBaGR1d3Y1eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYXNpZW4vcml3YXlhdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=', 1735311300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','dokter','pasien') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '2024-12-09 14:32:42', '$2y$12$UrIRhTKDhVkMUkkL4c05B.JALTaU0fNSGFsopGKb8bF7LvI9fczpu', NULL, '2024-12-09 14:32:42', '2024-12-09 07:39:01', 'admin'),
(2, 'dokter', 'doc@gmail', '2024-12-09 14:33:24', '$2y$12$5egZunSx7t1BDnGfbcG3s.OwKk.xlEm5VW2u.6FZ20/CgQVBy7p8e', NULL, '2024-12-09 14:33:24', '2024-12-09 12:19:39', 'dokter'),
(3, 'pasien', 'pasien@gmail.com', '2024-12-09 14:34:20', '$2y$12$5sxox.U271EEG0lW0ajDLeULxbQpvHxZGXw0qwFzLtS1C7Enj142S', NULL, '2024-12-09 14:34:20', '2024-12-09 12:20:26', 'pasien'),
(12, 'nanda', 'nanda@gmail.com', NULL, '$2y$12$pBy734rThS1lSOG7BcxUnOCa8kXKudMQBslz.YgOhTbfFG7W5vniq', NULL, '2024-12-10 05:11:01', '2024-12-27 13:32:23', 'pasien'),
(13, 'dr.gullam', 'gullam@gmail.com', NULL, '$2y$12$YgyoQuVKYv8xAZUZoOP1R.7/XNUysGHHuZ.0iiX51HWiy.UKLxvf.', NULL, '2024-12-10 05:11:29', '2024-12-10 05:11:29', 'dokter'),
(14, 'dewandra', 'andra@gmail.com', NULL, '$2y$12$FKf6b8AJ9IJ4UZlrlLVppeWfF2BgtZgUodWTsUBFYHmgc2.b3YqNa', NULL, '2024-12-10 08:18:32', '2024-12-10 08:18:32', 'pasien'),
(15, 'fafa', 'didi@gmail.com', NULL, '$2y$12$74nbPGsmdaGYsfamXKb7GeFydYms7H/8IXuGboHBTFjS1TM8UrS5a', NULL, '2024-12-10 23:14:12', '2024-12-27 13:31:05', 'dokter'),
(16, 'zalfa', 'zalfa@gmail.com', NULL, '$2y$12$HncKcAdZvaX/hi2UbveXSu/8p6ZA5hD15WoIO.pgCz6dQs.fnalD2', NULL, '2024-12-11 23:49:52', '2024-12-11 23:49:52', 'pasien'),
(17, 'babeh', 'babeh@gmail.com', NULL, '$2y$12$98ZNKX0HdomyM9D7Z4is0.ObFn6wQN1PyvaqDF13c5/d31P0RCNZ.', NULL, '2024-12-12 01:14:11', '2024-12-12 01:14:11', 'pasien'),
(18, 'heruu', 'dewan@gmail.com', NULL, '$2y$12$m7nRcbF43RI9sg3JcpjJ0e.iE1auxQsVd9IWLkUd6ZDURvs9CKOmm', NULL, '2024-12-12 01:15:57', '2024-12-12 01:16:26', 'dokter'),
(19, 'pere', 'mahe@gmail.com', NULL, '$2y$12$5BY30FH61.3JOL6cTmwBhuF8EkvX7crTAop5FACMpk6c785M5NPh6', NULL, '2024-12-12 01:17:02', '2024-12-12 01:17:15', 'pasien'),
(20, 'meme', 'meme@gmail.com', NULL, '$2y$12$uMkxA0Q0k00N0enhxGZsH.U1eanOIOp41VKAYhHwuFEN0VQnOrgTC', NULL, '2024-12-18 23:33:25', '2024-12-18 23:33:25', 'dokter'),
(21, 'ddd', 'bieee@gmail.com', NULL, '$2y$12$e7YCLnxOEPRg4g2PyV1qMONN3Z9qreFUlBL.n6.Xb38dikR0G1hem', NULL, '2024-12-24 23:21:48', '2024-12-24 23:21:48', 'dokter'),
(22, 'aaa', 'aa@gmail.com', NULL, '$2y$12$0m8i9BsC5nWweGbyNow7W.9aaUZvTtzfdaNr0H/5lUKfZtF2MQVpC', NULL, '2024-12-24 23:22:16', '2024-12-24 23:22:16', 'dokter'),
(23, 'bb', 'bb@gmail.com', NULL, '$2y$12$bgrfsP5iSryXGcrecNkZU.53mj9XeWYz34xpJWviuUrpa.Iw8Lh2a', NULL, '2024-12-24 23:22:37', '2024-12-24 23:22:37', 'dokter'),
(24, 'ccc', 'cc@gmail.com', NULL, '$2y$12$KxLHvXNseo/8GpINC7Z0QOuq9Nd6Ng1ejlD4WGqCRkFVTJBJ5wCJm', NULL, '2024-12-24 23:22:58', '2024-12-24 23:22:58', 'dokter'),
(25, 'ddd', 'd@gmail.com', NULL, '$2y$12$C2/4Di/uLTBCTir/CPezx.AkJFIEr5YPlL/pl4L0kiENlMfefwlu6', NULL, '2024-12-24 23:23:18', '2024-12-24 23:23:18', 'dokter'),
(26, 'ee', 'ee@gmail.com', NULL, '$2y$12$kr4d/mACV.2w4oHAZEXsWOD1BLdyIr9/CH4t40d4XpTpmpptLrOri', NULL, '2024-12-24 23:23:36', '2024-12-24 23:23:36', 'dokter'),
(27, 'ff', 'ff@gmail.com', NULL, '$2y$12$gb9tMbKlBZD5Y4cfTpv/IOn5gDNSNDs63xd.9XWLtZ85sxBNXbDIm', NULL, '2024-12-24 23:24:02', '2024-12-24 23:24:02', 'dokter');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `daftar_polis`
--
ALTER TABLE `daftar_polis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_polis_id_pasien_foreign` (`id_pasien`),
  ADD KEY `daftar_polis_id_jadwal_foreign` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_periksas_id_periksa_foreign` (`id_periksa`),
  ADD KEY `detail_periksas_id_obat_foreign` (`id_obat`);

--
-- Indeks untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokters_id_poli_foreign` (`id_poli`),
  ADD KEY `dokters_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_periksas_id_dokter_foreign` (`id_dokter`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasiens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `periksas`
--
ALTER TABLE `periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periksas_id_daftar_poli_foreign` (`id_daftar_poli`);

--
-- Indeks untuk tabel `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `daftar_polis`
--
ALTER TABLE `daftar_polis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `periksas`
--
ALTER TABLE `periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `polis`
--
ALTER TABLE `polis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_polis`
--
ALTER TABLE `daftar_polis`
  ADD CONSTRAINT `daftar_polis_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksas` (`id`),
  ADD CONSTRAINT `daftar_polis_id_pasien_foreign` FOREIGN KEY (`id_pasien`) REFERENCES `pasiens` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD CONSTRAINT `detail_periksas_id_obat_foreign` FOREIGN KEY (`id_obat`) REFERENCES `obats` (`id`),
  ADD CONSTRAINT `detail_periksas_id_periksa_foreign` FOREIGN KEY (`id_periksa`) REFERENCES `periksas` (`id`);

--
-- Ketidakleluasaan untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD CONSTRAINT `dokters_id_poli_foreign` FOREIGN KEY (`id_poli`) REFERENCES `polis` (`id`),
  ADD CONSTRAINT `dokters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD CONSTRAINT `jadwal_periksas_id_dokter_foreign` FOREIGN KEY (`id_dokter`) REFERENCES `dokters` (`id`);

--
-- Ketidakleluasaan untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD CONSTRAINT `pasiens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `periksas`
--
ALTER TABLE `periksas`
  ADD CONSTRAINT `periksas_id_daftar_poli_foreign` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_polis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
