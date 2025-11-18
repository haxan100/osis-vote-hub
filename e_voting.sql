-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2025 pada 10.58
-- Versi server: 8.0.30
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_voting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-11-18 09:50:22', '2025-11-18 09:50:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `candidate_number` int NOT NULL,
  `ketua_name` varchar(100) NOT NULL,
  `wakil_name` varchar(100) NOT NULL,
  `vision` text,
  `mission` text,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ketua_photo` varchar(255) DEFAULT NULL,
  `wakil_photo` varchar(255) DEFAULT NULL,
  `couple_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_number`, `ketua_name`, `wakil_name`, `vision`, `mission`, `photo`, `created_at`, `updated_at`, `ketua_photo`, `wakil_photo`, `couple_photo`) VALUES
(1, 1, 'Ahmad Rizki', 'Sari Dewi', 'Menjadikan OSIS sebagai wadah aspirasi siswa yang demokratis dan inovatif', 'Meningkatkan partisipasi siswa dalam kegiatan sekolah, Mengembangkan program kreatif dan edukatif, Memperkuat komunikasi antar siswa', NULL, '2025-11-18 09:48:41', '2025-11-18 09:51:45', 'candidates/foto/new_ketua.png', 'candidates/foto/new_ketua.jpeg', 'candidates/foto/new_ketua.jpeg'),
(2, 2, 'Siti Aisyah', 'Budi Hartono', 'Membangun OSIS yang transparan dan berorientasi pada prestasi siswa', 'Mengoptimalkan fasilitas sekolah, Mengadakan kompetisi akademik dan non-akademik, Meningkatkan kerjasama dengan pihak eksternal', NULL, '2025-11-18 09:48:41', '2025-11-18 09:48:41', NULL, NULL, NULL),
(3, 3, 'Muhammad Farhan', 'Rina Sari', 'Menciptakan lingkungan sekolah yang harmonis dan berprestasi', 'Mengembangkan program lingkungan hijau, Meningkatkan kegiatan sosial dan kemanusiaan, Memperkuat budaya literasi di sekolah', NULL, '2025-11-18 09:48:41', '2025-11-18 09:48:41', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pemilih','calon') NOT NULL,
  `candidate_number` int DEFAULT NULL,
  `has_voted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `password`, `role`, `candidate_number`, `has_voted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(2, 'calon1', 'Ahmad Rizki', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'calon', 1, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(3, 'calon2', 'Siti Aisyah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'calon', 2, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(4, 'calon3', 'Muhammad Farhan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'calon', 3, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(5, '081234567890', 'Ahmad Fauzi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pemilih', NULL, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(6, '089876543210', 'Siti Nurhaliza', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pemilih', NULL, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40'),
(7, '082345678901', 'Budi Santoso', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pemilih', NULL, 0, '2025-11-18 09:48:40', '2025-11-18 09:48:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `voter_id` varchar(50) NOT NULL,
  `candidate_number` int NOT NULL,
  `voted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voting_settings`
--

CREATE TABLE `voting_settings` (
  `id` int NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `voting_settings`
--

INSERT INTO `voting_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'voting_start', '2024-01-01 08:00:00', '2025-11-18 09:48:41'),
(2, 'voting_end', '2024-12-31 17:00:00', '2025-11-18 09:48:41'),
(3, 'quickcount_enabled', '1', '2025-11-18 09:48:41'),
(4, 'voting_active', '1', '2025-11-18 09:48:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidate_number` (`candidate_number`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voter_id` (`voter_id`),
  ADD KEY `candidate_number` (`candidate_number`);

--
-- Indeks untuk tabel `voting_settings`
--
ALTER TABLE `voting_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `voting_settings`
--
ALTER TABLE `voting_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidate_number`) REFERENCES `candidates` (`candidate_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
