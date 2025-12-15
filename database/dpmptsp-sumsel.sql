-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 06:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpmptsp-sumsel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('provinsi','kab_kota') NOT NULL,
  `kab_kota_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`, `kab_kota_id`, `created_at`, `updated_at`) VALUES
(1, 'admin-sumsel@gmail.com', '$2y$12$ItLEY36PaBLyOVvBg0SVnOD6dIxHM0bOHojIvkYQVop8Be9/c8D.6', 'provinsi', NULL, '2025-07-30 22:45:43', '2025-07-30 22:45:43'),
(2, 'admin-palembang@gmail.com', '$2y$12$dkyKfQ5.b2LWJcefla/o0uvmvE0L9kydgXKgtyzp9CE6xjUJOntOe', 'kab_kota', 1, '2025-07-30 22:45:43', '2025-07-30 22:45:43'),
(3, 'admin-pagaralam@gmail.com', '$2y$12$uVlXKMs/QKPhqjn/ebqMUe/1nzcqN0GHtELdaD5exUCsNB165JpTy', 'kab_kota', 2, '2025-07-30 22:45:43', '2025-07-30 22:45:43'),
(4, 'admin-lubuklinggau@gmail.com', '$2y$12$C5p8egWLh/w7f6bVliUc0eNBEm9NcbHTI8fnwPYRe1jaSLezh6QzS', 'kab_kota', 3, '2025-07-30 22:45:43', '2025-07-30 22:45:43'),
(5, 'admin-prabumulih@gmail.com', '$2y$12$W2J5YjlgFSFIDMPtpyypKeA6yXdSlau.6YLYxWaqRV983nErDNGfC', 'kab_kota', 4, '2025-07-30 22:45:43', '2025-07-30 22:45:43'),
(6, 'admin-banyuasin@gmail.com', '$2y$12$JcL74Oj1yD3iDQquYL1fnOSSpjaf6arGCGXcYSbzUQXh0a5Z02BZq', 'kab_kota', 5, '2025-07-30 22:45:44', '2025-07-30 22:45:44'),
(7, 'admin-empatlawang@gmail.com', '$2y$12$YdLGiPhyU/kanoWlcMvWlOkkbnjTT33eIxYiZzOHk2.10gxJq2nta', 'kab_kota', 6, '2025-07-30 22:45:44', '2025-07-30 22:45:44'),
(8, 'admin-lahat@gmail.com', '$2y$12$qmbn9NJkiJqnwF834wpZa.DNECXClPUPH0RzfOVxCBSiu.0AGzI9i', 'kab_kota', 7, '2025-07-30 22:45:44', '2025-07-30 22:45:44'),
(9, 'admin-muaraenim@gmail.com', '$2y$12$HCasfbWypfgVqD0vAOoz/OFkDqRszs1mdPeMuvL6HpvYaLRWwHrw6', 'kab_kota', 8, '2025-07-30 22:45:44', '2025-07-30 22:45:44'),
(10, 'admin-muba@gmail.com', '$2y$12$i7w4fKlym.qb2vM5jl0AZ.aTlSgeu3UyXCXg7kjjn1.dt90rKpGaC', 'kab_kota', 9, '2025-07-30 22:45:44', '2025-07-30 22:45:44'),
(11, 'admin-musirawas@gmail.com', '$2y$12$bhe/V0kZZPIGm5ToFNnfRODSeC4xIit3CpN3DSjOyjwGc5Y8im8Qq', 'kab_kota', 10, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(12, 'admin-muratara@gmail.com', '$2y$12$tiB78UHbHC.ycEqk0kL3h.EATQYNcU9GqfO2Z9i5VvW.yqMOoQ3VC', 'kab_kota', 11, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(13, 'admin-oganilir@gmail.com', '$2y$12$F7iRp5xWm26BLYF9/T7sve6GlGq6gl5qWsFq3N/A/Mkt1INCwq6Zq', 'kab_kota', 12, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(14, 'admin-oki@gmail.com', '$2y$12$.IIK2Y54N5/.1mtmv.efWuwjZ6ECFccCpJimEJFi81hWH.RyN36Fa', 'kab_kota', 13, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(15, 'admin-oku@gmail.com', '$2y$12$cgn42wCSW3nuIV7qatVfEutc6wvEn0YisMCjehGYwWNeqVxGixDvi', 'kab_kota', 14, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(16, 'admin-okuselatan@gmail.com', '$2y$12$RNokn5XUtFAw666.yvQ5F.NkEyoGoiQA.ZPNHQrs6ytdq//aEqD5e', 'kab_kota', 15, '2025-07-30 22:45:45', '2025-07-30 22:45:45'),
(17, 'admin-okutimur@gmail.com', '$2y$12$nzildPddensOxo8DrY4CoOINxfnDguzrTF9GI22BfasIFNhQ.9UiS', 'kab_kota', 16, '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(18, 'admin-pali@gmail.com', '$2y$12$XQXDKRkkDBAyARPmGvgmOOYuBQrEFLnJ70w1nwXuZkxGPhDbBrqfK', 'kab_kota', 17, '2025-07-30 22:45:46', '2025-07-30 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_verifikator`
--

CREATE TABLE `admin_verifikator` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','petugas','madya_1','madya_2','madya_3','kabid') NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_verifikator`
--

INSERT INTO `admin_verifikator` (`id`, `username`, `password`, `role`, `nama_petugas`, `nip`, `created_at`, `updated_at`) VALUES
(11, 'superadmin@gmail.com', '$2y$12$mR7cNRP.j1eavO51M.10L.UyIOjMzndDSlCMbrZbJL1m6qQX697f2', 'super_admin', 'Super Admin', '000000000', '2025-11-28 02:35:58', '2025-11-28 02:35:58'),
(12, 'madya1@gmail.com', '$2y$12$ocE7V8NJjKMLxxI/aIIlguH4nZQr8Gr6k0XYRMk1PIrFuRcne8O4.', 'madya_1', 'Madya One', '111111111', '2025-11-28 02:35:58', '2025-11-28 02:35:58'),
(13, 'madya2@gmail.com', '$2y$12$UTVYhlYoqyVlNVV4pAQVj.BPEQOkn81qrNrUQ8A9P6ocy4ku.N9oK', 'madya_2', 'Madya Two', '222222222', '2025-11-28 02:35:59', '2025-11-28 02:35:59'),
(14, 'madya3@gmail.com', '$2y$12$7ztJKzNZItM5z1xko9NlbuiJSQRrEC5wDG7xo96LfQFII21tzdXqy', 'madya_3', 'Madya Three', '333333333', '2025-11-28 02:35:59', '2025-11-28 02:35:59'),
(15, 'kabid@gmail.com', '$2y$12$8kd/SWSx/9o7oGQadsiN3.dIdJIYxjhKj4LzxKtPxzeE2WXIHXaTe', 'kabid', 'Kabid', '444444444', '2025-11-28 02:35:59', '2025-11-28 02:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('captcha_0590a3d9a94b095d4263c877a7ab1151', 'a:6:{i:0;s:1:\"a\";i:1;s:1:\"t\";i:2;s:1:\"2\";i:3;s:1:\"q\";i:4;s:1:\"q\";i:5;s:1:\"j\";}', 1764598133),
('captcha_07d0e205a3c2acdb6703b1c5feda4084', 'a:6:{i:0;s:1:\"t\";i:1;s:1:\"h\";i:2;s:1:\"x\";i:3;s:1:\"f\";i:4;s:1:\"2\";i:5;s:1:\"j\";}', 1764513341),
('captcha_118e69dc29605ffcba68c15dff8f2380', 'a:6:{i:0;s:1:\"n\";i:1;s:1:\"x\";i:2;s:1:\"u\";i:3;s:1:\"b\";i:4;s:1:\"u\";i:5;s:1:\"d\";}', 1764510298),
('captcha_1f11be8a74183e29291c65a9a4272aa0', 'a:6:{i:0;s:1:\"r\";i:1;s:1:\"r\";i:2;s:1:\"m\";i:3;s:1:\"g\";i:4;s:1:\"y\";i:5;s:1:\"n\";}', 1764491043),
('captcha_3bd8be7878c3015e04a6ac8ddee7e27c', 'a:6:{i:0;s:1:\"g\";i:1;s:1:\"x\";i:2;s:1:\"j\";i:3;s:1:\"x\";i:4;s:1:\"2\";i:5;s:1:\"y\";}', 1764505162),
('captcha_59f7fbb21d713fc10fe89b99060c8512', 'a:6:{i:0;s:1:\"m\";i:1;s:1:\"a\";i:2;s:1:\"p\";i:3;s:1:\"p\";i:4;s:1:\"z\";i:5;s:1:\"h\";}', 1764510177),
('captcha_5ec064c09aa8f42a9e03026cc5008579', 'a:6:{i:0;s:1:\"e\";i:1;s:1:\"x\";i:2;s:1:\"m\";i:3;s:1:\"q\";i:4;s:1:\"d\";i:5;s:1:\"n\";}', 1764491044),
('captcha_6f69c3d94b949e37484f3a2c2414c170', 'a:6:{i:0;s:1:\"g\";i:1;s:1:\"t\";i:2;s:1:\"q\";i:3;s:1:\"u\";i:4;s:1:\"x\";i:5;s:1:\"h\";}', 1764510297),
('captcha_746d8be4f64829d9154fd35d20ee7753', 'a:6:{i:0;s:1:\"t\";i:1;s:1:\"g\";i:2;s:1:\"r\";i:3;s:1:\"m\";i:4;s:1:\"n\";i:5;s:1:\"q\";}', 1764510178),
('captcha_7b3f165f69ccba04efcb1cc006508464', 'a:6:{i:0;s:1:\"7\";i:1;s:1:\"m\";i:2;s:1:\"f\";i:3;s:1:\"t\";i:4;s:1:\"4\";i:5;s:1:\"q\";}', 1764488842),
('captcha_87f1b0cbe10406710d78c9543cf6734b', 'a:6:{i:0;s:1:\"y\";i:1;s:1:\"n\";i:2;s:1:\"j\";i:3;s:1:\"p\";i:4;s:1:\"z\";i:5;s:1:\"r\";}', 1764567255),
('captcha_8937772f4c2a582ab37bac998223b023', 'a:6:{i:0;s:1:\"c\";i:1;s:1:\"u\";i:2;s:1:\"f\";i:3;s:1:\"c\";i:4;s:1:\"4\";i:5;s:1:\"p\";}', 1764567487),
('captcha_9283f236bf93eb1508ba1ec79c96f840', 'a:6:{i:0;s:1:\"y\";i:1;s:1:\"h\";i:2;s:1:\"j\";i:3;s:1:\"y\";i:4;s:1:\"b\";i:5;s:1:\"f\";}', 1764653381),
('captcha_c1203693bccbc7f5f8a7711257d49d8c', 'a:6:{i:0;s:1:\"6\";i:1;s:1:\"2\";i:2;s:1:\"g\";i:3;s:1:\"y\";i:4;s:1:\"3\";i:5;s:1:\"b\";}', 1764432744),
('captcha_c165aa63cb7ea57e849d57aa52941a41', 'a:6:{i:0;s:1:\"u\";i:1;s:1:\"q\";i:2;s:1:\"t\";i:3;s:1:\"p\";i:4;s:1:\"b\";i:5;s:1:\"q\";}', 1764567267),
('captcha_d2eedb6937b132e14ba3051d27d98a6f', 'a:6:{i:0;s:1:\"c\";i:1;s:1:\"h\";i:2;s:1:\"x\";i:3;s:1:\"4\";i:4;s:1:\"3\";i:5;s:1:\"4\";}', 1764567308),
('captcha_dd5937683ff7f408aa0c0d71ad1c19f0', 'a:6:{i:0;s:1:\"d\";i:1;s:1:\"d\";i:2;s:1:\"j\";i:3;s:1:\"z\";i:4;s:1:\"q\";i:5;s:1:\"8\";}', 1764513336),
('captcha_e7b63f0730e8c2d5d662f84dab140572', 'a:6:{i:0;s:1:\"b\";i:1;s:1:\"x\";i:2;s:1:\"x\";i:3;s:1:\"j\";i:4;s:1:\"j\";i:5;s:1:\"g\";}', 1764491296),
('captcha_ef2d64d25c8a5f2103b2d1e29ed20078', 'a:6:{i:0;s:1:\"m\";i:1;s:1:\"e\";i:2;s:1:\"h\";i:3;s:1:\"j\";i:4;s:1:\"u\";i:5;s:1:\"n\";}', 1764490675),
('captcha_fe97106fa77fd529bffc01d33005a13f', 'a:6:{i:0;s:1:\"j\";i:1;s:1:\"r\";i:2;s:1:\"n\";i:3;s:1:\"g\";i:4;s:1:\"q\";i:5;s:1:\"f\";}', 1764598143),
('captcha_ff6a17af3ccca5765bb41f8543a96524', 'a:6:{i:0;s:1:\"d\";i:1;s:1:\"y\";i:2;s:1:\"8\";i:3;s:1:\"p\";i:4;s:1:\"c\";i:5;s:1:\"p\";}', 1764567210);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `identitas_petugas`
--

CREATE TABLE `identitas_petugas` (
  `id_petugas` int NOT NULL,
  `petugas` varchar(255) DEFAULT NULL,
  `nip` varchar(100) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investasi`
--

CREATE TABLE `investasi` (
  `id` bigint UNSIGNED NOT NULL,
  `kab_kota_id` bigint UNSIGNED NOT NULL,
  `kategori_sektor_id` bigint UNSIGNED NOT NULL,
  `sektor_investasi_id` bigint UNSIGNED NOT NULL,
  `lkpm_pma` int NOT NULL DEFAULT '0',
  `realisasi_pma` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tki_pma` int NOT NULL DEFAULT '0',
  `tka_pma` int NOT NULL DEFAULT '0',
  `lkpm_pmdn` int NOT NULL DEFAULT '0',
  `realisasi_pmdn` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tki_pmdn` int NOT NULL DEFAULT '0',
  `tka_pmdn` int NOT NULL DEFAULT '0',
  `tahun` int NOT NULL,
  `triwulan` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kab_kota`
--

CREATE TABLE `kab_kota` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kab_kota`
--

INSERT INTO `kab_kota` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Kota Palembang', NULL, NULL),
(2, 'Kota Pagar Alam', NULL, NULL),
(3, 'Kota Lubuk Linggau', NULL, NULL),
(4, 'Kota Prabumulih', NULL, NULL),
(5, 'Kabupaten Banyuasin', NULL, NULL),
(6, 'Kabupaten Empat Lawang', NULL, NULL),
(7, 'Kabupaten Lahat', NULL, NULL),
(8, 'Kabupaten Muara Enim', NULL, NULL),
(9, 'Kabupaten Musi Banyuasin', NULL, NULL),
(10, 'Kabupaten Musi Rawas', NULL, NULL),
(11, 'Kabupaten Musi Rawas Utara', NULL, NULL),
(12, 'Kabupaten Ogan Ilir', NULL, NULL),
(13, 'Kabupaten Ogan Komering Ilir', NULL, NULL),
(14, 'Kabupaten Ogan Komering Ulu', NULL, NULL),
(15, 'Kabupaten Ogan Komering Ulu Selatan', NULL, NULL),
(16, 'Kabupaten Ogan Komering Ulu Timur', NULL, NULL),
(17, 'Kabupaten Penukal Abab Lematang Ilir', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_sektor`
--

CREATE TABLE `kategori_sektor` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_sektor`
--

INSERT INTO `kategori_sektor` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Sektor Primer', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(2, 'Sektor Sekunder', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(3, 'Sektor Tersier', '2025-07-30 22:45:46', '2025-07-30 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_09_032131_create_kab_kota_table', 2),
(5, '2025_07_03_072343_create_admin_table', 3),
(6, '2025_07_10_032215_create_kategori_sektor_table', 4),
(7, '2025_07_10_031915_create_sektor_investasi_table', 5),
(8, '2025_07_10_032408_create_investasi_table', 6),
(9, '2025_07_09_032245_create_sektor_perizinan_table', 7),
(10, '2025_07_09_032320_create_perizinan_table', 7),
(11, '2025_08_22_162051_create_visitors_table', 8),
(12, '2025_11_23_084414_create_identitas_petugas_table', 8),
(13, '2025_11_23_084557_create_users_2_table', 8),
(14, '2025_11_23_084713_create_validasi_table', 9),
(15, '2025_11_23_084937_create_non_perizinan_table', 10),
(16, '2025_11_23_085140_create_perizinan_2_table', 11),
(17, '2025_11_28_083044_create_admin_verifikator_table', 12),
(18, '2025_11_28_083235_create_validasi_table', 13),
(19, '2025_11_28_083243_create_validasi_log_table', 13),
(20, '2025_11_28_093357_rename_email_to_username_in_admin_verifikator', 14),
(21, '2025_11_28_115312_create_perizinan2s_table', 15),
(22, '2025_11_29_123017_add_perizinan_id_to_validasi_table', 16),
(23, '2025_11_30_090557_create_non_perizinan_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `non_perizinan`
--

CREATE TABLE `non_perizinan` (
  `id` int NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tanggal_proses` date DEFAULT NULL,
  `petugas` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_agenda` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_surat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_izin` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_izin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_kapal` varchar(150) DEFAULT NULL,
  `nib` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_izin` varchar(100) DEFAULT NULL,
  `tgl_pmh` date DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `jenis_pmh` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cek_fisik` varchar(100) DEFAULT NULL,
  `id_oss` varchar(100) DEFAULT NULL,
  `id_proyek` varchar(100) DEFAULT NULL,
  `nama_pemilik` varchar(150) DEFAULT NULL,
  `no_usaha` varchar(100) DEFAULT NULL,
  `tgl_izin` date DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `npwp` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `jenis_pers` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_keg` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sektor` varchar(150) DEFAULT NULL,
  `skala` varchar(50) DEFAULT NULL,
  `risiko` varchar(50) DEFAULT NULL,
  `kbli` varchar(255) DEFAULT NULL,
  `alamat_lokasi` text,
  `kab` varchar(150) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `investasi` decimal(18,2) DEFAULT NULL,
  `dokumen` varchar(50) DEFAULT NULL,
  `jumlah_dok` varchar(255) DEFAULT NULL,
  `jenis_dok` varchar(255) DEFAULT NULL,
  `no_verif` varchar(100) DEFAULT NULL,
  `tgl_verif` date DEFAULT NULL,
  `dok_verif` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','disetujui','dikembalikan','ditolak') NOT NULL DEFAULT 'menunggu',
  `catatan` text,
  `tgl_terbit` date DEFAULT NULL,
  `ket_status` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `non_perizinan`
--

INSERT INTO `non_perizinan` (`id`, `kepada`, `perihal`, `tanggal_proses`, `petugas`, `nip`, `jabatan`, `no_agenda`, `no_surat`, `jenis_izin`, `no_izin`, `nama_kapal`, `nib`, `id_izin`, `tgl_pmh`, `tgl_terima`, `jenis_pmh`, `cek_fisik`, `id_oss`, `id_proyek`, `nama_pemilik`, `no_usaha`, `tgl_izin`, `alamat`, `npwp`, `nik`, `jenis_pers`, `jenis_keg`, `sektor`, `skala`, `risiko`, `kbli`, `alamat_lokasi`, `kab`, `no_telp`, `email`, `investasi`, `dokumen`, `jumlah_dok`, `jenis_dok`, `no_verif`, `tgl_verif`, `dok_verif`, `status`, `catatan`, `tgl_terbit`, `ket_status`, `pdf_file`, `created_at`) VALUES
(4, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha', NULL, 'Madya One', '111111111', 'madya_1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-11-30 12:55:45'),
(5, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'menunggu', NULL, NULL, NULL, NULL, '2025-11-30 12:57:51'),
(6, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'menunggu', NULL, NULL, NULL, NULL, '2025-11-30 13:03:46'),
(7, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-11-30 13:04:54'),
(10, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-12-01 06:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `id` bigint UNSIGNED NOT NULL,
  `kab_kota_id` bigint UNSIGNED NOT NULL,
  `sektor_perizinan_id` bigint UNSIGNED NOT NULL,
  `jenis_input` enum('OSS RBA','NON OSS RBA') NOT NULL,
  `jumlah` int NOT NULL,
  `triwulan` tinyint NOT NULL,
  `tahun` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perizinan2s`
--

CREATE TABLE `perizinan2s` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perizinan_2`
--

CREATE TABLE `perizinan_2` (
  `id` int UNSIGNED NOT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `tanggal_proses` date DEFAULT NULL,
  `petugas` varchar(255) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `no_pmh` varchar(100) DEFAULT NULL,
  `no_keg` varchar(100) DEFAULT NULL,
  `tgl_pmh` date DEFAULT NULL,
  `jenis_pmh` varchar(100) DEFAULT NULL,
  `nama_pers` varchar(255) DEFAULT NULL,
  `jenis_pers` varchar(255) DEFAULT NULL,
  `jenis_keg` varchar(255) DEFAULT NULL,
  `nib` varchar(100) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `sektor` varchar(100) DEFAULT NULL,
  `luas` varchar(100) DEFAULT NULL,
  `skala` varchar(100) DEFAULT NULL,
  `risiko` varchar(100) DEFAULT NULL,
  `kbli` varchar(100) DEFAULT NULL,
  `nama_izin` varchar(255) DEFAULT NULL,
  `pj_pers` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kab` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `modal` varchar(100) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `jumlah_dok` text,
  `jenis_dok` varchar(255) DEFAULT NULL,
  `no_verif` varchar(100) DEFAULT NULL,
  `tgl_verif` varchar(100) DEFAULT NULL,
  `dok_verif` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','disetujui','dikembalikan','ditolak') NOT NULL DEFAULT 'menunggu',
  `catatan` text,
  `tgl_terbit` date DEFAULT NULL,
  `ket_status` text,
  `pdf_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validator_ke` int NOT NULL DEFAULT '0',
  `tgl_validasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `perizinan_2`
--

INSERT INTO `perizinan_2` (`id`, `kepada`, `perihal`, `tanggal_proses`, `petugas`, `nip`, `jabatan`, `no_pmh`, `no_keg`, `tgl_pmh`, `jenis_pmh`, `nama_pers`, `jenis_pers`, `jenis_keg`, `nib`, `npwp`, `sektor`, `luas`, `skala`, `risiko`, `kbli`, `nama_izin`, `pj_pers`, `alamat`, `kab`, `no_telp`, `email`, `modal`, `dokumen`, `jumlah_dok`, `jenis_dok`, `no_verif`, `tgl_verif`, `dok_verif`, `status`, `catatan`, `tgl_terbit`, `ket_status`, `pdf_file`, `created_at`, `validator_ke`, `tgl_validasi`) VALUES
(56, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-11-30 12:56:21', 0, NULL),
(57, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-11-30 12:56:26', 0, NULL),
(58, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-12-01 06:02:43', 0, NULL),
(60, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-12-01 06:26:54', 0, NULL),
(61, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', NULL, 'Super Admin', '000000000', 'super_admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'menunggu', NULL, NULL, NULL, NULL, '2025-12-01 06:27:06', 0, NULL),
(63, 'Pejabat Fungsional Penata Perizinan Ahli Madya', 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA', '1981-05-07', 'Super Admin', '000000000', 'super_admin', 'Illo cumque nesciunt', 'Inventore aperiam so', '1988-05-17', 'perpanjang', 'Sit quisquam invento', 'perorangan', 'pendukung', 'Dignissimos minim ea', 'Cumque ea earum quis', '13', 'Sit similique volup', 'besar', 'tinggi', 'Mollitia totam tempo', 'Veritatis excepturi', 'Numquam iure quidem', 'Autem amet consequa', '10', 'Assumenda incidunt', 'cujibu@mailinator.com', 'Aliquip fugiat dist', 'Mollit sit corporis', 'In consequatur aliq', NULL, 'Voluptate molestiae', '2020-04-06', NULL, 'disetujui', NULL, NULL, NULL, NULL, '2025-12-02 05:36:37', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sektor_investasi`
--

CREATE TABLE `sektor_investasi` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_sektor_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sektor_investasi`
--

INSERT INTO `sektor_investasi` (`id`, `kategori_sektor_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pertambangan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(2, 1, 'Kehutanan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(3, 1, 'Tanaman Pangan, Perkebunan, Peternakan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(4, 1, 'Perikanan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(5, 2, 'Industri Karet dan Plastik', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(6, 2, 'Industri Kayu', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(7, 2, 'Industri Kertas dan Percetakan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(8, 2, 'Industri Kimia dan Farmasi', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(9, 2, 'Industri Makanan', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(10, 2, 'Industri Mesin, Elektronik, Instrumen Kedokteran, Peralatan Listrik, Presisi, Optik dan Jam', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(11, 2, 'Industri Mineral non Logam', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(12, 2, 'Industri Logam Dasar, Barang Logam, Bukan Mesin dan Peralatannya', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(13, 2, 'Industri Kendaraan Bermotor dan Alat Transportasi Lain', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(14, 2, 'Industri Lainnya', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(15, 2, 'Industri Tekstil', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(16, 3, 'Hotel dan Restoran', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(17, 3, 'Konstruksi', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(18, 3, 'Listrik, Gas dan Air', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(19, 3, 'Perdagangan dan Reparasi', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(20, 3, 'Perumahan, Kawasan Industri dan Perkantoran', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(21, 3, 'Transportasi, Gudang dan Telekomunikasi', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(22, 3, 'Jasa Lainnya', '2025-07-30 22:45:46', '2025-07-30 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `sektor_perizinan`
--

CREATE TABLE `sektor_perizinan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sektor_perizinan`
--

INSERT INTO `sektor_perizinan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'ESDM (Energi dan Sumber Daya Mineral', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(2, 'KELAUTAN DAN PERIKANAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(3, 'KESEHATAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(4, 'KEBUDAYAAN DAN PARIWISATA', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(5, 'PSDA (Pekerjaan Umum dan Perumahan Rakyat', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(6, 'PERDAGANGAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(7, 'TRANSPORTASI (PERHUBUNGAN)', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(8, 'PERINDUSTRIAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(9, 'PERTANIAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(10, 'LINGKUNGAN HIDUP DAN KEHUTANAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(11, 'PENDIDIKAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(12, 'KETENAGAKERJAAN', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(13, 'KOMUNIKASI DAN INFORMATIKA', '2025-07-30 22:45:46', '2025-07-30 22:45:46'),
(14, 'SOSIAL', '2025-07-30 22:45:46', '2025-07-30 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('14bkmgF15Xzm5bmJRFMu7Un4HRvOhximxYOQ7ny3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSVRJUjd4RmlOak1wYkhGc1RoWG8wYWJvUEFEbkROTDFIUmRoSkhmZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToibGFzdF92aXNpdF90aW1lIjtPOjEzOiJDYXJib25cQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjUtMTItMDIgMDU6NTI6NDguNTI2MjEwIjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czozOiJVVEMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cDovL2RwbXB0c3Atc3Vtc2VsLnRlc3QiO319', 1764654768);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-07-30 22:45:47', '$2y$12$BHELQZHNmG.ITKqwZ9xDL.8ipCzXT6CfV3gPMM/uDkyJYNn4P80GS', 'qSH7IdtHhi', '2025-07-30 22:45:47', '2025-07-30 22:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `users_2`
--

CREATE TABLE `users_2` (
  `id` int NOT NULL,
  `id_petugas` int DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('petugas','ahli_madya','kepala_bidang','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `level_validator` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE `validasi` (
  `id` bigint UNSIGNED NOT NULL,
  `perizinan_id` bigint UNSIGNED DEFAULT NULL,
  `non_perizinan_id` bigint UNSIGNED DEFAULT NULL,
  `jenis_permohonan` enum('permohonan','non_permohonan') NOT NULL,
  `status` enum('menunggu','disetujui','dikembalikan','ditolak') NOT NULL DEFAULT 'menunggu',
  `current_level` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `last_action_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `validasi`
--

INSERT INTO `validasi` (`id`, `perizinan_id`, `non_perizinan_id`, `jenis_permohonan`, `status`, `current_level`, `last_action_at`, `created_at`, `updated_at`) VALUES
(33, 52, 0, 'permohonan', 'menunggu', 1, '2025-11-30 00:52:11', '2025-11-29 23:33:09', '2025-11-30 00:52:11'),
(34, 53, 0, 'permohonan', 'menunggu', 1, '2025-11-30 00:52:16', '2025-11-29 23:41:52', '2025-11-30 00:52:16'),
(35, 54, 0, 'permohonan', 'disetujui', 4, '2025-11-30 01:26:57', '2025-11-30 00:27:05', '2025-11-30 01:26:57'),
(37, 55, 0, 'permohonan', 'menunggu', 2, '2025-11-30 06:53:28', '2025-11-30 05:34:30', '2025-11-30 06:53:28'),
(43, 56, NULL, 'permohonan', 'disetujui', 4, '2025-12-01 21:44:16', '2025-11-30 05:56:21', '2025-12-01 21:44:16'),
(44, 57, NULL, 'permohonan', 'disetujui', 4, '2025-12-01 21:44:04', '2025-11-30 05:56:26', '2025-12-01 21:44:04'),
(47, NULL, 7, 'permohonan', 'disetujui', 4, '2025-11-30 06:43:54', '2025-11-30 06:04:54', '2025-11-30 06:43:54'),
(48, NULL, 8, 'permohonan', 'menunggu', 2, '2025-11-30 06:52:29', '2025-11-30 06:45:09', '2025-11-30 06:52:29'),
(49, NULL, 9, 'permohonan', 'menunggu', 2, '2025-11-30 06:52:17', '2025-11-30 06:50:56', '2025-11-30 06:52:17'),
(50, 58, NULL, 'permohonan', 'disetujui', 1, '2025-11-30 23:02:43', '2025-11-30 23:02:43', '2025-11-30 23:02:43'),
(51, 59, NULL, 'permohonan', 'menunggu', 1, '2025-11-30 23:03:01', '2025-11-30 23:03:01', '2025-11-30 23:03:01'),
(52, 60, NULL, 'permohonan', 'disetujui', 4, '2025-12-01 21:44:00', '2025-11-30 23:26:54', '2025-12-01 21:44:00'),
(53, 61, NULL, 'permohonan', 'menunggu', 1, '2025-11-30 23:49:27', '2025-11-30 23:27:06', '2025-11-30 23:49:27'),
(54, 62, NULL, 'permohonan', 'menunggu', 1, '2025-11-30 23:48:16', '2025-11-30 23:48:16', '2025-11-30 23:48:16'),
(55, NULL, 10, 'permohonan', 'disetujui', 4, '2025-12-01 21:43:53', '2025-11-30 23:56:31', '2025-12-01 21:43:53'),
(56, NULL, 11, 'permohonan', 'menunggu', 1, '2025-12-01 07:09:59', '2025-12-01 07:09:59', '2025-12-01 07:09:59'),
(57, NULL, 12, 'permohonan', 'menunggu', 1, '2025-12-01 07:10:45', '2025-12-01 07:10:38', '2025-12-01 07:10:45'),
(58, NULL, 4, 'permohonan', 'disetujui', 4, '2025-12-01 21:43:49', '2025-12-01 07:35:43', '2025-12-01 21:43:49'),
(59, 63, NULL, 'permohonan', 'disetujui', 4, '2025-12-01 22:43:04', '2025-12-01 22:36:37', '2025-12-01 22:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `validasi_log`
--

CREATE TABLE `validasi_log` (
  `id` bigint UNSIGNED NOT NULL,
  `validasi_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `role` enum('madya_1','madya_2','madya_3','kabid','super_admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('menunggu','disetujui','dikembalikan','ditolak') NOT NULL,
  `catatan` text,
  `validated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `validasi_log`
--

INSERT INTO `validasi_log` (`id`, `validasi_id`, `admin_id`, `role`, `status`, `catatan`, `validated_at`, `created_at`, `updated_at`) VALUES
(129, 44, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-11-30 06:53:10', '2025-11-30 06:53:10', '2025-11-30 06:53:10'),
(130, 43, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-11-30 06:53:14', '2025-11-30 06:53:14', '2025-11-30 06:53:14'),
(131, 37, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-11-30 06:53:28', '2025-11-30 06:53:28', '2025-11-30 06:53:28'),
(132, 50, 11, 'super_admin', 'disetujui', 'Permohonan baru masuk', '2025-11-30 23:02:43', '2025-11-30 23:02:43', '2025-11-30 23:02:43'),
(133, 51, 11, 'super_admin', 'menunggu', 'Permohonan baru masuk', '2025-11-30 23:03:01', '2025-11-30 23:03:01', '2025-11-30 23:03:01'),
(134, 52, 11, 'super_admin', 'menunggu', 'Permohonan baru masuk', '2025-11-30 23:26:54', '2025-11-30 23:26:54', '2025-11-30 23:26:54'),
(135, 53, 11, 'super_admin', 'menunggu', 'Permohonan baru masuk', '2025-11-30 23:27:06', '2025-11-30 23:27:06', '2025-11-30 23:27:06'),
(136, 53, 11, 'super_admin', 'menunggu', 'Permohonan diperbarui dan kembali masuk validasi', '2025-11-30 23:27:16', '2025-11-30 23:27:16', '2025-11-30 23:27:16'),
(137, 53, 11, 'super_admin', 'menunggu', 'Permohonan diperbarui dan kembali masuk validasi', '2025-11-30 23:27:25', '2025-11-30 23:27:25', '2025-11-30 23:27:25'),
(138, 54, 11, 'super_admin', 'menunggu', 'Permohonan baru masuk', '2025-11-30 23:48:16', '2025-11-30 23:48:16', '2025-11-30 23:48:16'),
(139, 53, 11, 'super_admin', 'menunggu', 'Permohonan diperbarui dan kembali masuk validasi', '2025-11-30 23:49:27', '2025-11-30 23:49:27', '2025-11-30 23:49:27'),
(140, 55, 11, 'super_admin', 'menunggu', 'Non perizinan baru masuk', '2025-11-30 23:56:31', '2025-11-30 23:56:31', '2025-11-30 23:56:31'),
(141, 56, 12, 'madya_1', 'menunggu', 'Non perizinan baru masuk', '2025-12-01 07:09:59', '2025-12-01 07:09:59', '2025-12-01 07:09:59'),
(142, 57, 12, 'madya_1', 'menunggu', 'Non perizinan baru masuk', '2025-12-01 07:10:38', '2025-12-01 07:10:38', '2025-12-01 07:10:38'),
(143, 57, 12, 'madya_1', 'menunggu', 'Data diperbarui dan kembali masuk proses validasi', '2025-12-01 07:10:45', '2025-12-01 07:10:45', '2025-12-01 07:10:45'),
(144, 58, 12, 'madya_1', 'menunggu', 'Data diperbarui dan kembali masuk proses validasi', '2025-12-01 07:35:43', '2025-12-01 07:35:43', '2025-12-01 07:35:43'),
(145, 58, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:36:54', '2025-12-01 21:36:54', '2025-12-01 21:36:54'),
(146, 55, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:38:10', '2025-12-01 21:38:10', '2025-12-01 21:38:10'),
(147, 55, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:38:27', '2025-12-01 21:38:27', '2025-12-01 21:38:27'),
(148, 52, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:39:23', '2025-12-01 21:39:23', '2025-12-01 21:39:23'),
(149, 58, 13, 'madya_2', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:41:19', '2025-12-01 21:41:19', '2025-12-01 21:41:19'),
(150, 52, 13, 'madya_2', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:41:24', '2025-12-01 21:41:24', '2025-12-01 21:41:24'),
(151, 43, 13, 'madya_2', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:41:36', '2025-12-01 21:41:36', '2025-12-01 21:41:36'),
(152, 58, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:42:29', '2025-12-01 21:42:29', '2025-12-01 21:42:29'),
(153, 55, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:42:38', '2025-12-01 21:42:38', '2025-12-01 21:42:38'),
(154, 52, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:42:42', '2025-12-01 21:42:42', '2025-12-01 21:42:42'),
(155, 44, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:42:47', '2025-12-01 21:42:47', '2025-12-01 21:42:47'),
(156, 43, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:43:06', '2025-12-01 21:43:06', '2025-12-01 21:43:06'),
(157, 58, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:43:49', '2025-12-01 21:43:49', '2025-12-01 21:43:49'),
(158, 55, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:43:53', '2025-12-01 21:43:53', '2025-12-01 21:43:53'),
(159, 52, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:44:00', '2025-12-01 21:44:00', '2025-12-01 21:44:00'),
(160, 44, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:44:04', '2025-12-01 21:44:04', '2025-12-01 21:44:04'),
(161, 43, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 21:44:16', '2025-12-01 21:44:16', '2025-12-01 21:44:16'),
(162, 59, 11, 'super_admin', 'menunggu', 'Permohonan baru masuk', '2025-12-01 22:36:37', '2025-12-01 22:36:37', '2025-12-01 22:36:37'),
(163, 59, 12, 'madya_1', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 22:38:53', '2025-12-01 22:38:53', '2025-12-01 22:38:53'),
(164, 59, 13, 'madya_2', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 22:40:34', '2025-12-01 22:40:34', '2025-12-01 22:40:34'),
(165, 59, 14, 'madya_3', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 22:41:03', '2025-12-01 22:41:03', '2025-12-01 22:41:03'),
(166, 59, 15, 'kabid', 'disetujui', 'Sudah disetujui, lanjut level berikutnya', '2025-12-01 22:43:04', '2025-12-01 22:43:04', '2025-12-01 22:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `visited_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 10:08:48'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-27 11:58:39'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-27 12:03:58'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-27 12:06:14'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-27 12:07:03'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 08:53:43'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 09:01:59'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 09:39:19'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 09:53:53'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-29 05:18:45'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-29 15:22:08'),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 05:14:23'),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 05:40:14'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 05:42:12'),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 05:43:50'),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 05:58:02'),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:09:31'),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:10:18'),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:14:46'),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:33:35'),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:34:14'),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:35:13'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:42:26'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 06:43:08'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:20:47'),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:26:32'),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:27:13'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:46:30'),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:49:25'),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:51:36'),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 07:52:36'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:17:01'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:23:25'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:23:53'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:24:30'),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:25:06'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 08:27:22'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:05:08'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:42:01'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:42:34'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:43:11'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:44:24'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:45:33'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:46:36'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 13:51:49'),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 14:36:05'),
(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 14:39:11'),
(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 15:27:49'),
(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 15:28:58'),
(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 15:30:26'),
(51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:27:37'),
(52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:29:44'),
(53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 13:53:57'),
(54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 13:54:10'),
(55, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 14:06:19'),
(56, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 14:43:24'),
(57, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 14:56:32'),
(58, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 14:56:59'),
(59, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 14:57:39'),
(60, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 15:03:25'),
(61, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 03:45:50'),
(62, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 03:53:13'),
(63, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 03:55:22'),
(64, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:35:15'),
(65, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:40:19'),
(66, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:41:58'),
(67, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:43:16'),
(68, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:44:22'),
(69, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:45:36'),
(70, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 04:55:03'),
(71, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:32:53'),
(72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:37:22'),
(73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:39:15'),
(74, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:39:56'),
(75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:40:38'),
(76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:41:08'),
(77, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:41:45'),
(78, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:43:15'),
(79, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 05:52:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`),
  ADD KEY `admin_kab_kota_id_foreign` (`kab_kota_id`);

--
-- Indexes for table `admin_verifikator`
--
ALTER TABLE `admin_verifikator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_verifikator_email_unique` (`username`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `identitas_petugas`
--
ALTER TABLE `identitas_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investasi_kab_kota_id_foreign` (`kab_kota_id`),
  ADD KEY `investasi_kategori_sektor_id_foreign` (`kategori_sektor_id`),
  ADD KEY `investasi_sektor_investasi_id_foreign` (`sektor_investasi_id`);

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
-- Indexes for table `kab_kota`
--
ALTER TABLE `kab_kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_sektor`
--
ALTER TABLE `kategori_sektor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `non_perizinan`
--
ALTER TABLE `non_perizinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perizinan_kab_kota_id_foreign` (`kab_kota_id`),
  ADD KEY `perizinan_sektor_perizinan_id_foreign` (`sektor_perizinan_id`);

--
-- Indexes for table `perizinan2s`
--
ALTER TABLE `perizinan2s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perizinan_2`
--
ALTER TABLE `perizinan_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sektor_investasi`
--
ALTER TABLE `sektor_investasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sektor_investasi_kategori_sektor_id_foreign` (`kategori_sektor_id`);

--
-- Indexes for table `sektor_perizinan`
--
ALTER TABLE `sektor_perizinan`
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
-- Indexes for table `users_2`
--
ALTER TABLE `users_2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_2_username_unique` (`username`),
  ADD KEY `users_2_id_petugas_foreign` (`id_petugas`);

--
-- Indexes for table `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `validasi_log`
--
ALTER TABLE `validasi_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `validasi_log_validasi_id_foreign` (`validasi_id`),
  ADD KEY `validasi_log_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_visited_at_index` (`visited_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_verifikator`
--
ALTER TABLE `admin_verifikator`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identitas_petugas`
--
ALTER TABLE `identitas_petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kab_kota`
--
ALTER TABLE `kab_kota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kategori_sektor`
--
ALTER TABLE `kategori_sektor`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `non_perizinan`
--
ALTER TABLE `non_perizinan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perizinan2s`
--
ALTER TABLE `perizinan2s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perizinan_2`
--
ALTER TABLE `perizinan_2`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sektor_investasi`
--
ALTER TABLE `sektor_investasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sektor_perizinan`
--
ALTER TABLE `sektor_perizinan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_2`
--
ALTER TABLE `users_2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `validasi_log`
--
ALTER TABLE `validasi_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_kab_kota_id_foreign` FOREIGN KEY (`kab_kota_id`) REFERENCES `kab_kota` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investasi`
--
ALTER TABLE `investasi`
  ADD CONSTRAINT `investasi_kab_kota_id_foreign` FOREIGN KEY (`kab_kota_id`) REFERENCES `kab_kota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investasi_kategori_sektor_id_foreign` FOREIGN KEY (`kategori_sektor_id`) REFERENCES `kategori_sektor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investasi_sektor_investasi_id_foreign` FOREIGN KEY (`sektor_investasi_id`) REFERENCES `sektor_investasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD CONSTRAINT `perizinan_kab_kota_id_foreign` FOREIGN KEY (`kab_kota_id`) REFERENCES `kab_kota` (`id`),
  ADD CONSTRAINT `perizinan_sektor_perizinan_id_foreign` FOREIGN KEY (`sektor_perizinan_id`) REFERENCES `sektor_perizinan` (`id`);

--
-- Constraints for table `sektor_investasi`
--
ALTER TABLE `sektor_investasi`
  ADD CONSTRAINT `sektor_investasi_kategori_sektor_id_foreign` FOREIGN KEY (`kategori_sektor_id`) REFERENCES `kategori_sektor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_2`
--
ALTER TABLE `users_2`
  ADD CONSTRAINT `users_2_id_petugas_foreign` FOREIGN KEY (`id_petugas`) REFERENCES `identitas_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `validasi_log`
--
ALTER TABLE `validasi_log`
  ADD CONSTRAINT `validasi_log_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin_verifikator` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `validasi_log_validasi_id_foreign` FOREIGN KEY (`validasi_id`) REFERENCES `validasi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
