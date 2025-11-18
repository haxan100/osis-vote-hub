-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 18 Nov 2025 pada 17.33
-- Versi server: 5.7.39
-- Versi PHP: 7.4.33

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
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$1Ur23oF4ZMzwSIUAzdYuI../ECsFANQrUaljHSkU.MuTuaypEET2u', '2025-11-18 15:29:09', '2025-11-18 16:29:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `admin_name`, `action`, `description`, `ip_address`, `created_at`) VALUES
(1, 'Administrator', 'RESET_PASSWORD', 'Reset password pemilih: Ahmad Fauzi (081234567890)', '::1', '2025-11-18 16:17:53'),
(2, 'Administrator', 'EDIT_CANDIDATE', 'Edit kandidat nomor 1: 1Ahmad Rizki & Sari Dewi', '::1', '2025-11-18 16:20:14'),
(3, 'Administrator', 'EDIT_CANDIDATE', 'Edit kandidat nomor 1: Ahmad Rizki2 & Sari Dewi', '::1', '2025-11-18 16:20:54'),
(4, 'Administrator', 'EDIT_CANDIDATE', 'Edit kandidat nomor 2: Siti Aisyahm66666 & Budi Hartono', '::1', '2025-11-18 16:21:27'),
(5, 'Administrator', 'RESET_PASSWORD', 'Reset password pemilih: Ahmad Fauzi (081234567890)', '::1', '2025-11-18 16:21:55'),
(6, 'Administrator', 'UPDATE_SCHEDULE', 'Update jadwal pemilihan: 19 Nov 2025 08:00 - 02 Jan 2026 17:50', '::1', '2025-11-18 16:22:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `candidate_number` int(11) NOT NULL,
  `ketua_name` varchar(100) NOT NULL,
  `wakil_name` varchar(100) NOT NULL,
  `vision` text,
  `mission` text,
  `ketua_photo` varchar(255) DEFAULT NULL,
  `wakil_photo` varchar(255) DEFAULT NULL,
  `couple_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_number`, `ketua_name`, `wakil_name`, `vision`, `mission`, `ketua_photo`, `wakil_photo`, `couple_photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ahmad Rizki2', 'Sari Dewi', 'Menjadikan OSIS sebagai wadah aspirasi siswa yang demokratis dan inovatifewfwef', 'Meningkatkan partisipasi siswa dalam kegiatan sekolah, Mengembangkan program kreatif dan edukatif, Memperkuat komunikasi antar siswa', 'candidates/foto/1_ketua.jpg', 'candidates/foto/1_wakil.jpg', 'candidates/foto/1_couple.jpg', '2025-11-18 15:29:09', '2025-11-18 16:20:54'),
(2, 2, 'Siti Aisyahm66666', 'Budi Hartono', 'Membangun OSIS yang transparan dan berorientasi pada prestasi siswa', 'Mengoptimalkan fasilitas sekolah, Mengadakan kompetisi akademik dan non-akademik, Meningkatkan kerjasama dengan pihak eksternal', 'candidates/foto/2_ketua.jpg', 'candidates/foto/2_wakil.jpg', 'candidates/foto/2_couple.jpg', '2025-11-18 15:29:09', '2025-11-18 16:21:27'),
(3, 3, 'Muhammad Farhan', 'Rina Sari', 'Menciptakan lingkungan sekolah yang harmonis dan berprestasi', 'Mengembangkan program lingkungan hijau, Meningkatkan kegiatan sosial dan kemanusiaan, Memperkuat budaya literasi di sekolah', 'candidates/foto/3_ketua.jpg', 'candidates/foto/3_wakil.jpg', 'candidates/foto/3_couple.jpg', '2025-11-18 15:29:09', '2025-11-18 15:29:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidate_users`
--

CREATE TABLE `candidate_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `candidate_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `candidate_users`
--

INSERT INTO `candidate_users` (`id`, `user_id`, `name`, `password`, `candidate_number`, `created_at`, `updated_at`) VALUES
(1, 'calon1', 'Ahmad Rizki', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '2025-11-18 15:29:09', '2025-11-18 15:29:09'),
(2, 'calon2', 'Siti Aisyah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, '2025-11-18 15:29:09', '2025-11-18 15:29:09'),
(3, 'calon3', 'Muhammad Farhan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '2025-11-18 15:29:09', '2025-11-18 15:29:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `default_password` tinyint(1) DEFAULT '1',
  `has_voted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `kelas`, `password`, `default_password`, `has_voted`, `created_at`, `updated_at`) VALUES
(1, '081234567890', 'Ahmad Fauzi', 'XII IPA 1', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 15:29:09', '2025-11-18 16:32:21'),
(2, '089876543210', 'Siti Nurhaliza', 'XII IPS 2', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 15:29:09', '2025-11-18 16:32:21'),
(3, '082345678901', 'Budi Santoso', 'XI IPA 3', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 15:29:09', '2025-11-18 16:32:21'),
(4, '86565654', 'abdul', 'XII IPA 1', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 16:04:25', '2025-11-18 16:32:21'),
(5, '654684684', 'bedul', 'XII IPS 2', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 16:04:25', '2025-11-18 16:32:21'),
(6, '845464', 'kidul', 'XI IPA 3', '$2y$10$MM9r3O7SuSh2w1Cy0vRghOWrh2ILVNV/7TqHC7liExYIOygZiDmOa', 1, 0, '2025-11-18 16:04:26', '2025-11-18 16:32:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` varchar(50) NOT NULL,
  `candidate_number` int(11) NOT NULL,
  `voted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voting_settings`
--

CREATE TABLE `voting_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `voting_settings`
--

INSERT INTO `voting_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'voting_start', '2025-11-19T08:00', '2025-11-18 16:13:29'),
(2, 'voting_end', '2026-01-02T17:50', '2025-11-18 16:22:19'),
(3, 'quickcount_enabled', '1', '2025-11-18 15:29:09'),
(4, 'voting_active', '1', '2025-11-18 15:29:09');

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
-- Indeks untuk tabel `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_name` (`admin_name`),
  ADD KEY `created_at` (`created_at`);

--
-- Indeks untuk tabel `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidate_number` (`candidate_number`);

--
-- Indeks untuk tabel `candidate_users`
--
ALTER TABLE `candidate_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `candidate_number` (`candidate_number`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `candidate_users`
--
ALTER TABLE `candidate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `voting_settings`
--
ALTER TABLE `voting_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `candidate_users`
--
ALTER TABLE `candidate_users`
  ADD CONSTRAINT `candidate_users_ibfk_1` FOREIGN KEY (`candidate_number`) REFERENCES `candidates` (`candidate_number`);

--
-- Ketidakleluasaan untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidate_number`) REFERENCES `candidates` (`candidate_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
