-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2025 at 03:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dokter', 'Dokter saiful ditambahkan', '2025-08-15 02:08:24', '2025-08-15 02:08:24'),
(2, 'pasien', 'Pasien kurniadi terdaftar', '2025-08-15 02:14:23', '2025-08-15 02:14:23'),
(3, 'obat', 'Obat paramex ditambahkan', '2025-08-15 02:58:46', '2025-08-15 02:58:46'),
(4, 'pasien', 'Pasien kurniadi terdaftar', '2025-08-15 02:59:22', '2025-08-15 02:59:22'),
(5, 'dokter', 'Mengubah data Dokter: Elga elgi', '2025-08-15 03:29:00', '2025-08-15 03:29:00'),
(6, 'dokter', 'Menghapus data Dokter: Suzi', '2025-08-15 03:32:14', '2025-08-15 03:32:14'),
(7, 'pasien', 'Mengubah data Pasien: Bronnie bo', '2025-08-15 03:39:14', '2025-08-15 03:39:14'),
(8, 'pasien', 'Menghapus data Pasien: Bronnie bo', '2025-08-15 03:39:20', '2025-08-15 03:39:20'),
(9, 'poli', 'Mengubah data Poli: Bondy man', '2025-08-15 03:39:45', '2025-08-15 03:39:45'),
(10, 'obat', 'Mengubah data Obat: Olia ramlan', '2025-08-15 03:43:19', '2025-08-15 03:43:19'),
(11, 'obat', 'Mengubah data Obat: Davy', '2025-08-15 03:43:26', '2025-08-15 03:43:26'),
(12, 'obat', 'Menghapus data Obat: Adrien', '2025-08-15 03:43:42', '2025-08-15 03:43:42');

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
-- Table structure for table `daftar_polis`
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

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksas`
--

CREATE TABLE `detail_periksas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_periksa` bigint UNSIGNED NOT NULL,
  `id_obat` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokters`
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
-- Dumping data for table `dokters`
--

INSERT INTO `dokters` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'saiful rahman', 'JL. CAKRA ADIWIJAYA NO05', '435345564654', 1, 2, '2025-08-15 02:08:24', '2025-08-15 02:51:34'),
(2, 'Elga elgi', '8 Hauk Hill', '8971708972', 1, 1, '0000-00-00 00:00:00', '2025-08-15 03:29:00'),
(3, 'Godard', '50699 Bay Hill', '2094233448', 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Kathie', '25525 Helena Circle', '4070466797', 4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Bertina', '66 Eastwood Avenue', '4463897416', 5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Debi', '0 Rockefeller Crossing', '7838511712', 6, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Sutherland', '1758 Mosinee Park', '9572602365', 7, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Beilul', '5543 Schlimgen Trail', '7508017404', 9, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Fannie', '0 Rieder Point', '1722330864', 11, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Gratiana', '2 Bowman Hill', '0140384731', 12, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Rafaello', '8 Memorial Trail', '4811244915', 13, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Yulma', '55584 Oak Court', '3060253161', 14, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Audrye', '7078 Texas Park', '6877152425', 15, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Rosabelle', '66768 Bluestem Terrace', '6020059073', 16, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Claudio', '83274 Miller Point', '6599093043', 17, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Vitia', '51833 2nd Trail', '3061204598', 18, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Grange', '41656 Bultman Avenue', '4006737459', 19, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Patty', '055 Harbort Junction', '8531719674', 20, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Bibbie', '495 Coleman Street', '8881141620', 21, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Daisey', '5 Talmadge Court', '7395150287', 22, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Grace', '96 Kim Trail', '9808580335', 23, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Trumaine', '1857 Kings Parkway', '8973164341', 24, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Julia', '29648 Scofield Pass', '9169322090', 25, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Rafe', '3458 Farragut Terrace', '8976458001', 26, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Karilynn', '29 Elka Court', '5793569707', 27, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Emmalyn', '3 Magdeline Crossing', '2443811085', 28, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Forest', '56 Algoma Junction', '0125506104', 29, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Dyan', '1370 Fairfield Place', '2301681769', 30, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Artair', '9552 Manufacturers Lane', '9578400543', 31, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Octavius', '72 Stone Corner Park', '8177450670', 32, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Nevil', '2 Carberry Lane', '4746410267', 33, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Michal', '427 Erie Plaza', '9763557577', 34, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Leighton', '84700 Stone Corner Park', '2628728435', 35, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Olympie', '6 Stuart Road', '6287581638', 36, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Susy', '7647 Northport Hill', '0191421944', 37, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Nicholle', '9165 Lyons Place', '9318794908', 38, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Pat', '2024 Caliangt Terrace', '2854347846', 39, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Mychal', '665 Scoville Circle', '0428539181', 40, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Kimberli', '133 Green Ridge Road', '9865243733', 41, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Tybie', '940 Melby Parkway', '8987233871', 42, 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Calli', '0 School Center', '5699049932', 43, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Fayre', '92241 Ridgeview Point', '1208407600', 44, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Bobbi', '5303 Springs Terrace', '6367041354', 45, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Ynes', '6899 Golf Street', '9225377908', 46, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Lenette', '2586 Mccormick Point', '0902253948', 47, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Dylan', '24519 Autumn Leaf Pass', '7201901907', 48, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Ev', '7534 International Junction', '5650670706', 49, 49, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Priscella', '169 Ohio Hill', '2427060089', 50, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
-- Table structure for table `jadwal_periksas`
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
(4, '2024_12_04_202523_create_polis_table', 1),
(5, '2024_12_04_202529_create_obats_table', 1),
(6, '2024_12_04_202534_create_dokters_table', 1),
(7, '2024_12_04_202558_create_pasiens_table', 1),
(8, '2024_12_04_202619_create_jadwal_periksas_table', 1),
(9, '2024_12_04_202643_create_daftar_polis_table', 1),
(10, '2024_12_04_202657_create_perikasas_table', 1),
(11, '2024_12_04_202719_create_detail_periksas_table', 1),
(12, '2024_12_09_140612_add_role_to_users_table', 1),
(13, '2024_12_10_100858_add_user_id_to_dokters_table', 1),
(14, '2024_12_10_111439_add_user_id_to_pasiens_table', 1),
(15, '2024_12_10_114850_add_on_delete_cascade_to_dokters_table', 1),
(16, '2024_12_10_115029_add_on_delete_cascade_to_pasiens_table', 1),
(17, '2024_12_11_060754_create_activities_table', 1),
(18, '2024_12_22_111454_add_status_to_jadwal_periksas_table', 1),
(19, '2024_12_22_172207_add_status_to_daftar_polis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obats`
--

CREATE TABLE `obats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_obat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kemasan` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obats`
--

INSERT INTO `obats` (`id`, `nama_obat`, `kemasan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'paramex', 'saset', 750000, '2025-08-15 02:58:46', '2025-08-15 02:58:53'),
(2, 'Audrye', 'sed magna at nunc commodo placerat ', 70, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Olia ramlan', 'penatibus et magnis dis parturient', 8, '0000-00-00 00:00:00', '2025-08-15 03:43:19'),
(4, 'Lawrence', 'at lorem integer tincidunt ante vel', 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Lucienne', 'sodales sed tincidunt eu felis fusc', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Davy', 'posuere nonummy integer non velit d', 12, '0000-00-00 00:00:00', '2025-08-15 03:43:26'),
(8, 'Arther', 'turpis sed ante vivamus tortor duis', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Jessy', 'mauris enim leo rhoncus sed vestibu', 55, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Margaret', 'ligula in lacus curabitur at ipsum ', 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Idalia', 'lacus at velit vivamus vel nulla eg', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Alfred', 'justo morbi ut odio cras mi pede ma', 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Deloria', 'at vulputate vitae nisl aenean lect', 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Izaak', 'lectus suspendisse potenti in eleif', 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Lonny', 'nulla neque libero convallis eget e', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Shanan', 'lacus curabitur at ipsum ac tellus ', 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Clarence', 'ipsum dolor sit amet consectetuer a', 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Noel', 'dictumst etiam faucibus cursus urna', 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Cory', 'metus sapien ut nunc vestibulum ant', 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Lynsey', 'blandit ultrices enim lorem ipsum d', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Seth', 'vel ipsum praesent blandit lacinia ', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Gwyn', 'quis tortor id nulla ultrices aliqu', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Demetria', 'in ante vestibulum ante ipsum primi', 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Tess', 'ac tellus semper interdum mauris ul', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Mame', 'sit amet turpis elementum ligula ve', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Jeffrey', 'in hac habitasse platea dictumst mo', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Demetris', 'enim leo rhoncus sed vestibulum sit', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Ambros', 'morbi a ipsum integer a nibh in qui', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Avram', 'etiam pretium iaculis justo in hac ', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Kalli', 'curabitur at ipsum ac tellus semper', 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Jesse', 'vehicula condimentum curabitur in l', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Caye', 'ut at dolor quis odio consequat var', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Maggi', 'erat fermentum justo nec condimentu', 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Quinn', 'dolor quis odio consequat varius in', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Dennis', 'vel accumsan tellus nisi eu orci ma', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Frank', 'posuere cubilia curae donec pharetr', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Edwina', 'amet turpis elementum ligula vehicu', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Chicky', 'quisque arcu libero rutrum ac lobor', 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Fiann', 'vestibulum sit amet cursus id turpi', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Byrom', 'nullam varius nulla facilisi cras n', 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Humbert', 'quisque ut erat curabitur gravida n', 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Lisabeth', 'id nisl venenatis lacinia aenean si', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Wayne', 'platea dictumst morbi vestibulum ve', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Romain', 'pede ullamcorper augue a suscipit n', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Aluin', 'amet consectetuer adipiscing elit p', 90, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Aurie', 'curae donec pharetra magna vestibul', 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Marsiella', 'nulla nunc purus phasellus in felis', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Fabiano', 'varius integer ac leo pellentesque ', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Neall', 'lacus curabitur at ipsum ac tellus ', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Gary', 'vehicula consequat morbi a ipsum in', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Jamil', 'sociis natoque penatibus et magnis ', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
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
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Mankyau', 'poncowolo', '5467535', '1234567890', '202508-001', '2025-08-15 02:06:56', '2025-08-15 02:06:56', 1),
(2, 'Hilly fini', '6th Floor', '053110303', '071900786', 'AI7743', '0000-00-00 00:00:00', '2025-08-15 03:16:03', 2),
(3, 'kurniadi stiawan', 'mimimi', '53546563', '82334958739', '202508-002', '2025-08-15 02:59:22', '2025-08-15 03:06:11', 4),
(4, 'Ned', 'PO Box 96679', '061104136', '042103460', 'NZ8857', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(5, 'Ryon', 'Suite 32', '061204654', '114916019', 'EK1492', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5),
(6, 'Nels', 'Room 241', '091901862', '104908082', 'KE4306', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(7, 'Paddy', '14th Floor', '081904808', '071121963', 'ET7092', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7),
(9, 'Tim', 'Room 933', '101001911', '063104668', 'LH6269', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9),
(11, 'Isidor', 'Suite 61', '111101377', '323070380', 'AV9464', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11),
(12, 'Sharity', 'Apt 734', '072404142', '064203021', 'UA8466', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12),
(13, 'Elicia', '10th Floor', '075901354', '263190812', 'CX5205', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13),
(14, 'Wally', 'Apt 1682', '082901101', '063112825', 'KE5876', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14),
(15, 'Roy', '7th Floor', '072413706', '061101294', 'BA4656', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 15),
(16, 'Nadine', 'Room 1493', '053207533', '283972162', 'KE3850', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 16),
(17, 'Andris', 'Room 1422', '091501204', '053208040', 'LA8222', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17),
(18, 'Corinne', 'Room 309', '325171740', '021202719', 'AV6156', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18),
(19, 'Edythe', 'PO Box 14755', '107004381', '113024915', 'AC4052', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19),
(20, 'Cara', 'Suite 82', '253185002', '103102290', 'AM4751', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 20),
(21, 'Adeline', 'Suite 94', '064008637', '091201232', 'SQ6943', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 21),
(22, 'Brendin', 'Apt 1417', '251472542', '064008637', 'WN4492', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 22),
(23, 'Delia', 'Room 360', '081204126', '065403875', 'LA2475', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23),
(24, 'Rozalin', 'PO Box 16220', '107006392', '114907387', 'AV7683', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 24),
(25, 'Tersina', 'PO Box 93009', '221672851', '071925839', 'AZ8140', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 25),
(26, 'Elayne', 'PO Box 1177', '062203269', '026013673', 'DL2385', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 26),
(27, 'Sherwynd', 'Suite 71', '122041523', '111302587', 'UA9030', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 27),
(28, 'Penn', '1st Floor', '091407793', '101213204', 'SQ3948', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 28),
(29, 'Jourdain', 'Apt 399', '275071408', '075908658', 'SA4862', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 29),
(30, 'Gusta', 'Apt 973', '275071314', '041202113', 'NZ7265', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 30),
(31, 'Yorker', 'Suite 65', '082901091', '121201814', 'AM5336', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 31),
(32, 'Samantha', 'Suite 83', '083903690', '111910380', 'AF9202', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 32),
(33, 'Julita', 'PO Box 89639', '071108669', '103109840', 'BA9466', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 33),
(34, 'Aubry', 'Suite 82', '122240764', '042103363', 'NZ8729', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 34),
(35, 'Erik', 'Room 921', '221270758', '071916408', 'IB5567', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35),
(36, 'Lissy', '9th Floor', '073921569', '321170444', 'UA1324', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 36),
(37, 'Natalie', 'PO Box 18231', '111104879', '044002679', 'AA8928', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 37),
(38, 'Stanleigh', '6th Floor', '075904115', '026007508', 'KL4223', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38),
(39, 'Dolley', 'PO Box 14960', '011601443', '243373222', 'SA4189', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 39),
(40, 'Anatola', '14th Floor', '081512371', '055002558', 'TG3757', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 40),
(41, 'Reinaldo', 'Apt 1781', '113102138', '075011888', 'BA3245', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 41),
(42, 'Lukas', 'Suite 56', '275071408', '122241831', 'QF1731', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 42),
(43, 'Yolanthe', '18th Floor', '081519002', '074905173', 'ET2018', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 43),
(44, 'Stace', 'Room 571', '084107055', '011201490', 'NZ7014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 44),
(45, 'Isaiah', 'PO Box 43053', '061103218', '292977831', 'SK5087', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45),
(46, 'Shaylyn', 'Room 1348', '021109935', '065305478', 'QF2364', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 46),
(47, 'Pascal', 'Apt 631', '065506222', '101102836', 'AC8993', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 47),
(48, 'Dion', '17th Floor', '071925169', '063102204', 'KL6095', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 48),
(49, 'Mort', 'Apt 948', '071103473', '104902127', 'CX5044', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 49),
(50, 'Twila', 'Apt 1820', '064003768', '231374961', 'AI1476', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 50);

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
-- Table structure for table `periksas`
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

-- --------------------------------------------------------

--
-- Table structure for table `polis`
--

CREATE TABLE `polis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_poli` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polis`
--

INSERT INTO `polis` (`id`, `nama_poli`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Bondy man', 'lalala', '0000-00-00 00:00:00', '2025-08-15 03:39:45'),
(2, 'Hort', '6.1997228312', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Olivero', '1.2253250055', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Alejandro', '0.2746041408', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Anett', '0.2349581319', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Jackie', '0.0942308366', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Tallie', '2.2660021984', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Maridel', '0.6043901261', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Aubry', '0.2417241248', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Queenie', '0.4404794292', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Kerk', '2.9593781187', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Electra', '0.298282562', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Darya', '0.7580334978', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Julieta', '0.3111016269', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Laverna', '0.008152341', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Lil', '1.437430131', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Ethe', '2.8862617919', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Denver', '1.566295544', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Constance', '0.2635691144', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Quintin', '1.6972078532', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Ker', '0.1062275335', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Abigail', '1.3225297538', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Lee', '5.361372471', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Philomena', '0.9209376585', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Nikolas', '1.1067503089', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Kylie', '0.0384471153', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Paulita', '0.1429717729', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Cara', '0.1604188558', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Valentin', '0.0146021723', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Leia', '1.0116095309', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Fayina', '0.3709937926', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Torie', '2.7711759738', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Amalea', '0.3666579607', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Axe', '0.0074356967', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Rikki', '0.1352341997', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Edie', '1.5154678458', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Ethelda', '1.1123224625', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Corey', '0.1062117245', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Juliette', '0.0631847126', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Johnna', '1.1789079066', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Wendell', '0.0552462468', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Willem', '1.9296431331', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Rania', '3.844497875', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Sauveur', '0.0573472834', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Stacy', '1.9436195133', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Bibby', '0.9023263732', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Angelica', '0.9546468651', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Tamar', '0.4442790454', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Corinna', '1.1754369161', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Othello', '1.221657387', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
('1MAWSnfZJk6eKGwWdAiFMPk2jddPFPOVOfsroEHq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjRBMDIwZGxNVUxINFJPVjNyS0hTYkJBdGlrVHZMYlBzaE9VeHJPcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1755229648);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Mankyau', 'mankyau@gmail.com', NULL, '$2y$12$qU0CtpRVohVj89BXUKrzi.y5XsnNJddvTowd0Zg94imlpPJLruGZK', NULL, '2025-08-15 02:06:56', '2025-08-15 03:29:00', 'admin'),
(2, 'Hilly fini', 'hily@gmail.com', NULL, '$2y$12$U1wf5dvpfHjQuOgtC2gt5.uIFhJos9olNkWMiLOvox5P0dSv2kEmO', NULL, '2025-08-15 02:08:24', '2025-08-15 03:16:03', 'dokter'),
(4, 'kurniadi stiawan', 'kurniadi@gmail.com', NULL, '$2y$12$zYwH7yBl6CL4uoP.T4eSzuP0KlnA3X8bPxvoqLQiwtq/mjoTyCfEi', NULL, '2025-08-15 02:59:22', '2025-08-15 03:06:11', 'pasien'),
(5, 'Kennett', 'kmilburne0@webs.com', '0000-00-00 00:00:00', 'United States', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(6, 'Cynthy', 'cschulken1@blog.com', '0000-00-00 00:00:00', 'Sweden', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(7, 'Callie', 'cdrinkhall2@t.co', '0000-00-00 00:00:00', 'Thailand', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(9, 'Penelope', 'pmcgeachie4@weebly.com', '0000-00-00 00:00:00', 'Poland', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(11, 'Stephen', 'sfolca6@google.cn', '0000-00-00 00:00:00', 'United States', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(12, 'Scarlett', 'sbaiyle7@google.ca', '0000-00-00 00:00:00', 'Vietnam', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(13, 'Milzie', 'mmanach8@51.la', '0000-00-00 00:00:00', 'Syria', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(14, 'Eldin', 'ewattingham9@google.nl', '0000-00-00 00:00:00', 'Portugal', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(15, 'Jordon', 'jpepperilla@istockphoto.com', '0000-00-00 00:00:00', 'Indonesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(16, 'Wendall', 'wgriptonb@cisco.com', '0000-00-00 00:00:00', 'Indonesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(17, 'Felipa', 'ffarrinc@va.gov', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(18, 'Hagen', 'hgiovannid@1688.com', '0000-00-00 00:00:00', 'Russia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(19, 'Sheffield', 'sraffine@senate.gov', '0000-00-00 00:00:00', 'Chad', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(20, 'Gardner', 'gannwylf@multiply.com', '0000-00-00 00:00:00', 'Russia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(21, 'Maxy', 'mvandecasteleg@nytimes.com', '0000-00-00 00:00:00', 'Indonesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(22, 'Alvie', 'afrankomh@youtube.com', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(23, 'Faustine', 'fridholei@wordpress.org', '0000-00-00 00:00:00', 'Peru', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(24, 'Analiese', 'ayakushkevj@washingtonpost.com', '0000-00-00 00:00:00', 'Bolivia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(25, 'Dolli', 'dbackhousek@irs.gov', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(26, 'Jojo', 'jcarrattl@addthis.com', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(27, 'Ernie', 'egaspardm@yellowpages.com', '0000-00-00 00:00:00', 'Russia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(28, 'Lucinda', 'lmellenbyn@howstuffworks.com', '0000-00-00 00:00:00', 'Portugal', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(29, 'Lissie', 'lagglioo@prweb.com', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(30, 'Kelci', 'khullerp@google.cn', '0000-00-00 00:00:00', 'Brazil', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(31, 'Rheta', 'rshearaq@fc2.com', '0000-00-00 00:00:00', 'French Polynesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(32, 'Margarette', 'moffinr@hostgator.com', '0000-00-00 00:00:00', 'Russia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(33, 'Holly-anne', 'hlewins@jugem.jp', '0000-00-00 00:00:00', 'Estonia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(34, 'Augustine', 'aricardint@skyrock.com', '0000-00-00 00:00:00', 'Greece', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(35, 'Ximenes', 'xandrysiaku@pbs.org', '0000-00-00 00:00:00', 'Ukraine', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(36, 'Sile', 'sannicev@newsvine.com', '0000-00-00 00:00:00', 'Armenia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(37, 'Demetria', 'dluffw@dedecms.com', '0000-00-00 00:00:00', 'Indonesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(38, 'Heindrick', 'hfidgeonx@csmonitor.com', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(39, 'Merry', 'mdyery@virginia.edu', '0000-00-00 00:00:00', 'Bolivia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(40, 'Doy', 'drubinivitzz@marketwatch.com', '0000-00-00 00:00:00', 'France', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(41, 'Babbie', 'bpassmore10@ezinearticles.com', '0000-00-00 00:00:00', 'Poland', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(42, 'Batholomew', 'bcodrington11@purevolume.com', '0000-00-00 00:00:00', 'Sweden', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(43, 'Antonietta', 'ayukhnini12@forbes.com', '0000-00-00 00:00:00', 'Japan', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(44, 'Laurena', 'lpowder13@so-net.ne.jp', '0000-00-00 00:00:00', 'Ukraine', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(45, 'Helenelizabeth', 'hrodnight14@google.ca', '0000-00-00 00:00:00', 'United States', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(46, 'Mikael', 'mlornsen15@shop-pro.jp', '0000-00-00 00:00:00', 'Ireland', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(47, 'Bobbie', 'bburnip16@over-blog.com', '0000-00-00 00:00:00', 'Brazil', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(48, 'Lexie', 'lhissett17@irs.gov', '0000-00-00 00:00:00', 'Indonesia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(49, 'Heida', 'hbraisher18@economist.com', '0000-00-00 00:00:00', 'Netherlands', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(50, 'Kellia', 'kstovell19@rediff.com', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(51, 'Darcey', 'dricciardo1a@washington.edu', '0000-00-00 00:00:00', 'Ukraine', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(52, 'Boothe', 'bfehners1b@privacy.gov.au', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(53, 'Sara-ann', 'sbirkinshaw1c@washington.edu', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(54, 'Scottie', 'selleyne1d@cbsnews.com', '0000-00-00 00:00:00', 'Croatia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(55, 'Latashia', 'lallain1e@nhs.uk', '0000-00-00 00:00:00', 'Peru', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(56, 'Wallache', 'wgore1f@ftc.gov', '0000-00-00 00:00:00', 'Brazil', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(57, 'Kinna', 'kbuckston1g@smugmug.com', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(58, 'Iggy', 'ialdwich1h@github.io', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(59, 'Chip', 'cjachimak1i@howstuffworks.com', '0000-00-00 00:00:00', 'Russia', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(60, 'Andie', 'achadbourne1j@fastcompany.com', '0000-00-00 00:00:00', 'Bulgaria', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(61, 'Jeannette', 'jkohn1k@timesonline.co.uk', '0000-00-00 00:00:00', 'Poland', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(62, 'Maxy', 'mkettleson1l@google.com.hk', '0000-00-00 00:00:00', 'Belarus', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(63, 'Adolphe', 'arelfe1m@mozilla.org', '0000-00-00 00:00:00', 'Tanzania', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(64, 'Valentin', 'vstockau1n@amazon.de', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(65, 'Maurizio', 'mbygott1o@marketwatch.com', '0000-00-00 00:00:00', 'Brazil', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(66, 'Leigh', 'lcarlens1p@time.com', '0000-00-00 00:00:00', 'Brazil', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(67, 'Chery', 'cpummell1q@vinaora.com', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(68, 'Aurelea', 'alayland1r@dot.gov', '0000-00-00 00:00:00', 'Poland', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(69, 'Nelia', 'nmoan1s@vistaprint.com', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(70, 'Tish', 'tbaxster1t@ameblo.jp', '0000-00-00 00:00:00', 'Myanmar', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(71, 'Ruthe', 'rblakebrough1u@nps.gov', '0000-00-00 00:00:00', 'China', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(72, 'Francine', 'fdahill1v@imageshack.us', '0000-00-00 00:00:00', 'Honduras', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(73, 'Dasya', 'ddwane1w@google.com', '0000-00-00 00:00:00', 'Greece', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(74, 'Kanya', 'khulcoop1x@harvard.edu', '0000-00-00 00:00:00', 'Democratic Republic of the Congo', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(75, 'Antonina', 'adismore1y@time.com', '0000-00-00 00:00:00', 'Japan', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(76, 'Florella', 'fblowfield1z@nytimes.com', '0000-00-00 00:00:00', 'Portugal', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(77, 'Rafferty', 'rmccadden20@imdb.com', '0000-00-00 00:00:00', 'Sweden', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(78, 'Roshelle', 'rstallwood21@abc.net.au', '0000-00-00 00:00:00', 'Philippines', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien'),
(79, 'Othella', 'ousher22@blogger.com', '0000-00-00 00:00:00', 'Nigeria', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `daftar_polis`
--
ALTER TABLE `daftar_polis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_polis_id_pasien_foreign` (`id_pasien`),
  ADD KEY `daftar_polis_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_periksas_id_periksa_foreign` (`id_periksa`),
  ADD KEY `detail_periksas_id_obat_foreign` (`id_obat`);

--
-- Indexes for table `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokters_id_poli_foreign` (`id_poli`),
  ADD KEY `dokters_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_periksas_id_dokter_foreign` (`id_dokter`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasiens_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periksas`
--
ALTER TABLE `periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periksas_id_daftar_poli_foreign` (`id_daftar_poli`);

--
-- Indexes for table `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `daftar_polis`
--
ALTER TABLE `daftar_polis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_periksas`
--
ALTER TABLE `detail_periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `periksas`
--
ALTER TABLE `periksas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polis`
--
ALTER TABLE `polis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_polis`
--
ALTER TABLE `daftar_polis`
  ADD CONSTRAINT `daftar_polis_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksas` (`id`),
  ADD CONSTRAINT `daftar_polis_id_pasien_foreign` FOREIGN KEY (`id_pasien`) REFERENCES `pasiens` (`id`);

--
-- Constraints for table `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD CONSTRAINT `detail_periksas_id_obat_foreign` FOREIGN KEY (`id_obat`) REFERENCES `obats` (`id`),
  ADD CONSTRAINT `detail_periksas_id_periksa_foreign` FOREIGN KEY (`id_periksa`) REFERENCES `periksas` (`id`);

--
-- Constraints for table `dokters`
--
ALTER TABLE `dokters`
  ADD CONSTRAINT `dokters_id_poli_foreign` FOREIGN KEY (`id_poli`) REFERENCES `polis` (`id`),
  ADD CONSTRAINT `dokters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD CONSTRAINT `jadwal_periksas_id_dokter_foreign` FOREIGN KEY (`id_dokter`) REFERENCES `dokters` (`id`);

--
-- Constraints for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD CONSTRAINT `pasiens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `periksas`
--
ALTER TABLE `periksas`
  ADD CONSTRAINT `periksas_id_daftar_poli_foreign` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_polis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
