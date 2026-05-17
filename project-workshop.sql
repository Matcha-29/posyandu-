-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2026 at 06:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
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
(4, '2026_05_06_233135_create_patients_table', 1),
(5, '2026_05_16_000001_update_patients_table', 1),
(6, '2026_05_16_000002_create_pemeriksaans_table', 1),
(7, '2026_05_16_000003_add_role_to_users_table', 1);

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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `noHp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('ibu','balita','lansia') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anakKe` int NOT NULL DEFAULT '1',
  `tglKunjungan` date DEFAULT NULL,
  `usiaHamil` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `nama`, `nik`, `tglLahir`, `noHp`, `alamat`, `dusun`, `kecamatan`, `kategori`, `anakKe`, `tglKunjungan`, `usiaHamil`, `created_at`, `updated_at`) VALUES
(1, 'Siti Aminah', '3508010101980001', '1998-01-01', '081234567890', 'Jl. Mawar No. 12', 'Krajan', 'Sumbersari', 'ibu', 1, '2025-02-28', 28, '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(2, 'Dewi Rahayu', '3508010202990002', '1999-02-02', '082345678901', 'Jl. Melati No. 5', 'Tegal Boto', 'Kaliwates', 'balita', 2, '2026-01-05', NULL, '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(3, 'Nur Halimah', '3508010303000003', '2000-03-03', '083456789012', 'Jl. Kenanga No. 8', 'Patrang', 'Patrang', 'ibu', 1, '2025-11-20', 32, '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(4, 'Fatimah Azzahra', '3508010505020005', '2002-05-05', '085678901234', 'Jl. Anggrek No. 17', 'Mojosari', 'Ajung', 'ibu', 1, '2026-02-28', 20, '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(5, 'Bagas Pratama', '3508010606030006', '2023-06-06', '086789012345', 'Jl. Cempaka No. 4', 'Mangli', 'Kaliwates', 'balita', 1, '2026-03-10', NULL, '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(6, 'Alfi Aziz', '1211212121212121', NULL, '12121212121212121', 'jl.ndkiqiq', 'kakakas', 'ksaskmska', 'balita', 1, NULL, NULL, '2026-05-16 03:22:31', '2026-05-16 03:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaans`
--

CREATE TABLE `pemeriksaans` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `tgl_periksa` date NOT NULL,
  `usia_hamil` int DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `lila` decimal(5,2) DEFAULT NULL,
  `tekanan_darah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hb` decimal(4,2) DEFAULT NULL,
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `usia_balita` int DEFAULT NULL,
  `imunisasi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_skrining` json DEFAULT NULL,
  `level_risiko` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skor_ya` int DEFAULT NULL,
  `tindak_lanjut` json DEFAULT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemeriksaans`
--

INSERT INTO `pemeriksaans` (`id`, `patient_id`, `tgl_periksa`, `usia_hamil`, `berat_badan`, `tinggi_badan`, `lila`, `tekanan_darah`, `hb`, `lingkar_kepala`, `usia_balita`, `imunisasi`, `jawaban_skrining`, `level_risiko`, `skor_ya`, `tindak_lanjut`, `petugas_id`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-28', 28, '62.50', '158.00', '25.00', '110/70', '11.80', NULL, NULL, NULL, '{\"q1\": \"tidak\", \"q2\": \"tidak\", \"q3\": \"tidak\", \"q4\": \"ya\", \"q5\": \"tidak\", \"q6\": \"tidak\", \"q7\": \"tidak\", \"q8\": \"tidak\", \"q9\": \"tidak\", \"q10\": \"ya\"}', 'sedang', 2, '[\"Pemberian TTD + pemantauan konsumsi rutin\", \"Konseling gizi ibu hamil lebih intensif\", \"Jadwal kontrol lebih sering (2 minggu sekali)\"]', 2, 'Bengkak ringan pada kaki, dianjurkan kurangi garam.', '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(2, 5, '2026-03-10', NULL, '9.80', '78.50', NULL, NULL, NULL, '44.00', 21, 'belum_lengkap', '{\"p1\": \"tidak\", \"p2\": \"tidak\", \"p3\": \"tidak\", \"p4\": \"tidak\", \"p5\": \"tidak\", \"p6\": \"tidak\", \"s1\": \"ya\", \"s2\": \"ya\", \"s3\": \"tidak\", \"s4\": \"ya\", \"s5\": \"tidak\", \"s6\": \"ya\"}', 'sedang', 4, '[\"Pemberian PMT (Pemberian Makanan Tambahan)\", \"Edukasi intensif pola makan (protein tinggi)\", \"Pemantauan berat badan tiap bulan\", \"Konsultasi ke Puskesmas\"]', 2, 'BB kurang dari standar. Imunisasi belum lengkap.', '2026-05-16 02:55:38', '2026-05-16 02:55:38'),
(3, 6, '2026-05-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"p1\": \"ya\", \"p2\": \"ya\", \"p3\": \"ya\", \"p4\": \"ya\", \"p5\": \"ya\", \"p6\": \"tidak\", \"s1\": \"tidak\", \"s2\": \"tidak\", \"s3\": \"tidak\", \"s4\": \"tidak\", \"s5\": \"tidak\", \"s6\": \"tidak\"}', 'darurat', NULL, '[\"RUJUK SEGERA ke Puskesmas / Rumah Sakit\", \"Pemberian PMT intensif (tinggi kalori & protein)\", \"Penanganan penyakit penyerta (diare, infeksi)\", \"Monitoring ketat pertumbuhan\", \"Pendampingan keluarga (edukasi langsung)\"]', 3, 'Skrining otomatis: DARURAT', '2026-05-16 03:23:12', '2026-05-16 03:23:12');

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
('2imHZDFyWLmBmu9YBvOR8lJDJVGsZq1iKBzyIddG', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ2dk1xWXRVckx4SjV1V2Jmb1NuR0E5VUc3bThRUllDMlgydG03Q0piIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xpc3RfZGF0YV9wYXNpZW4ifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYW5na2FoLTEiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjR9', 1778983442),
('qM6NnpE7pFb6fFEmdJZl0mI3fmPVpyQpOD4YqpR4', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJhYWJ5YTgzc2VtUU1tRW9STmtodkYxS3JrMmI1eG1mcmU1aTF1VWMxIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xpc3RfZGF0YV9wYXNpZW4ifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wYXRpZW50c1wvNiIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=', 1778984637),
('Y57tlbq3gn49Ie3S1s5cyJNnZM5FeiWOIaDbzPmS', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ4aEcybldMNGc4UHZQdEJvRFV0dmpGV0lRVkJGUG1BYmk4WW9xRTBQIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xpc3RfZGF0YV9wYXNpZW4ifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYW5na2FoLTEiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9', 1778997972);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@posyandu.id', 'admin', 1, NULL, '$2y$12$Yfbo1KOL8BMOTrGExoXsAOWQvWpoP/UDhdERUFxT9VWCOivCKU3ra', NULL, '2026-05-16 02:55:37', '2026-05-16 02:55:37'),
(2, 'Bidan Sari', 'petugas@posyandu.id', 'petugas', 1, NULL, '$2y$12$4pRc9zPrs5BEVk2j5RsSw.GK112tj2/juvcTkkBFAzE0PhOxH8Lbm', NULL, '2026-05-16 02:55:37', '2026-05-16 02:55:37'),
(3, 'Alfi Aziz', 'alfiaziz2023@gmail.com', 'petugas', 1, NULL, '$2y$12$g4yTt3tY4j5qas78hcp7o.rDI8a5sLmzYcAV/huQhnp2H4C3huphu', NULL, '2026-05-16 03:21:55', '2026-05-16 03:21:55'),
(4, 'Test Admin', 'test@example.com', 'petugas', 1, NULL, '$2y$12$0Is.Uigyrw.io0FVF4dC0.xcV1CCKVRUsqBKSQ8Tb5wzqQvsFWA.u', NULL, '2026-05-16 17:51:23', '2026-05-16 17:51:23');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_nik_unique` (`nik`);

--
-- Indexes for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaans_patient_id_foreign` (`patient_id`),
  ADD KEY `pemeriksaans_petugas_id_foreign` (`petugas_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD CONSTRAINT `pemeriksaans_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemeriksaans_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
