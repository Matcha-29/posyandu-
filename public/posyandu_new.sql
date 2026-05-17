-- Setup Database Posyandu New
CREATE DATABASE IF NOT EXISTS `posyandu_new` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `posyandu_new`;

-- 1. Struktur Tabel `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `users`
INSERT INTO `users` (`id`, `name`, `email`, `role`, `is_active`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@posyandu.id', 'admin', 1, '$2y$10$pGBycziW.eR6CggkualVm.NjNyC3vXXTih8VCiqk/NdpS7.h.33T2', NOW(), NOW()),
(2, 'Bidan Sari', 'petugas@posyandu.id', 'petugas', 1, '$2y$10$OIrTwlF7mUzb./vhrQvjFutjEet4sB.9GWiYJk9mUMmLiDngq79Wi', NOW(), NOW());


-- 2. Struktur Tabel `patients`
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `noHp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('ibu','balita','lansia') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anakKe` int(11) NOT NULL DEFAULT '1',
  `tglKunjungan` date DEFAULT NULL,
  `usiaHamil` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `patients`
INSERT INTO `patients` (`id`, `nama`, `nik`, `tglLahir`, `noHp`, `alamat`, `dusun`, `kecamatan`, `kategori`, `anakKe`, `tglKunjungan`, `usiaHamil`, `created_at`, `updated_at`) VALUES
(1, 'Siti Aminah', '3508010101980001', '1998-01-01', '081234567890', 'Jl. Mawar No. 12', 'Krajan', 'Sumbersari', 'ibu', 1, '2025-02-28', 28, NOW(), NOW()),
(2, 'Dewi Rahayu', '3508010202990002', '1999-02-02', '082345678901', 'Jl. Melati No. 5', 'Tegal Boto', 'Kaliwates', 'balita', 2, '2026-01-05', NULL, NOW(), NOW()),
(3, 'Nur Halimah', '3508010303000003', '2000-03-03', '083456789012', 'Jl. Kenanga No. 8', 'Patrang', 'Patrang', 'ibu', 1, '2025-11-20', 32, NOW(), NOW()),
(4, 'Fatimah Azzahra', '3508010505020005', '2002-05-05', '085678901234', 'Jl. Anggrek No. 17', 'Mojosari', 'Ajung', 'ibu', 1, '2026-02-28', 20, NOW(), NOW()),
(5, 'Bagas Pratama', '3508010606030006', '2023-06-06', '086789012345', 'Jl. Cempaka No. 4', 'Mangli', 'Kaliwates', 'balita', 1, '2026-03-10', NULL, NOW(), NOW());


-- 3. Struktur Tabel `pemeriksaans`
DROP TABLE IF EXISTS `pemeriksaans`;
CREATE TABLE `pemeriksaans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `tgl_periksa` date NOT NULL,
  `usia_hamil` int(11) DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `lila` decimal(5,2) DEFAULT NULL,
  `tekanan_darah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hb` decimal(4,2) DEFAULT NULL,
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `usia_balita` int(11) DEFAULT NULL,
  `imunisasi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_skrining` json DEFAULT NULL,
  `level_risiko` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skor_ya` int(11) DEFAULT NULL,
  `tindak_lanjut` json DEFAULT NULL,
  `petugas_id` bigint(20) unsigned DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemeriksaans_patient_id_foreign` (`patient_id`),
  KEY `pemeriksaans_petugas_id_foreign` (`petugas_id`),
  CONSTRAINT `pemeriksaans_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemeriksaans_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `pemeriksaans`
INSERT INTO `pemeriksaans` (`id`, `patient_id`, `tgl_periksa`, `usia_hamil`, `berat_badan`, `tinggi_badan`, `lila`, `tekanan_darah`, `hb`, `lingkar_kepala`, `usia_balita`, `imunisasi`, `jawaban_skrining`, `level_risiko`, `skor_ya`, `tindak_lanjut`, `petugas_id`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-28', 28, 62.50, 158.00, 25.00, '110/70', 11.80, NULL, NULL, NULL, '{"q1": "tidak", "q2": "tidak", "q3": "tidak", "q4": "ya", "q5": "tidak", "q6": "tidak", "q7": "tidak", "q8": "tidak", "q9": "tidak", "q10": "ya"}', 'sedang', 2, '["Pemberian TTD + pemantauan konsumsi rutin", "Konseling gizi ibu hamil lebih intensif", "Jadwal kontrol lebih sering (2 minggu sekali)"]', 2, 'Bengkak ringan pada kaki, dianjurkan kurangi garam.', NOW(), NOW()),
(2, 5, '2026-03-10', NULL, 9.80, 78.50, NULL, NULL, NULL, 44.00, 21, 'belum_lengkap', '{"p1": "tidak", "p2": "tidak", "p3": "tidak", "p4": "tidak", "p5": "tidak", "p6": "tidak", "s1": "ya", "s2": "ya", "s3": "tidak", "s4": "ya", "s5": "tidak", "s6": "ya"}', 'sedang', 4, '["Pemberian PMT (Pemberian Makanan Tambahan)", "Edukasi intensif pola makan (protein tinggi)", "Pemantauan berat badan tiap bulan", "Konsultasi ke Puskesmas"]', 2, 'BB kurang dari standar. Imunisasi belum lengkap.', NOW(), NOW();


-- 4. Struktur Tabel `password_reset_tokens`
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 5. Struktur Tabel `sessions`
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
