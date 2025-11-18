-- Database: e_voting
CREATE DATABASE IF NOT EXISTS `e_voting` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `e_voting`;

-- Table structure for table `users` (pemilih only)
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `has_voted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert dummy data for users (pemilih)
INSERT INTO `users` (`user_id`, `name`, `password`, `has_voted`) VALUES
('081234567890', 'Ahmad Fauzi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0),
('089876543210', 'Siti Nurhaliza', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0),
('082345678901', 'Budi Santoso', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert dummy data for admins
INSERT INTO `admins` (`username`, `name`, `password`) VALUES
('admin', 'Administrator', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Table structure for table `candidates`
CREATE TABLE `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_number` int(11) NOT NULL,
  `ketua_name` varchar(100) NOT NULL,
  `wakil_name` varchar(100) NOT NULL,
  `vision` text,
  `mission` text,
  `ketua_photo` varchar(255) DEFAULT NULL,
  `wakil_photo` varchar(255) DEFAULT NULL,
  `couple_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_number` (`candidate_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert dummy data for candidates
INSERT INTO `candidates` (`candidate_number`, `ketua_name`, `wakil_name`, `vision`, `mission`, `ketua_photo`, `wakil_photo`, `couple_photo`) VALUES
(1, 'Ahmad Rizki', 'Sari Dewi', 'Menjadikan OSIS sebagai wadah aspirasi siswa yang demokratis dan inovatif', 'Meningkatkan partisipasi siswa dalam kegiatan sekolah, Mengembangkan program kreatif dan edukatif, Memperkuat komunikasi antar siswa', 'candidates/foto/1_ketua.jpg', 'candidates/foto/1_wakil.jpg', 'candidates/foto/1_couple.jpg'),
(2, 'Siti Aisyah', 'Budi Hartono', 'Membangun OSIS yang transparan dan berorientasi pada prestasi siswa', 'Mengoptimalkan fasilitas sekolah, Mengadakan kompetisi akademik dan non-akademik, Meningkatkan kerjasama dengan pihak eksternal', 'candidates/foto/2_ketua.jpg', 'candidates/foto/2_wakil.jpg', 'candidates/foto/2_couple.jpg'),
(3, 'Muhammad Farhan', 'Rina Sari', 'Menciptakan lingkungan sekolah yang harmonis dan berprestasi', 'Mengembangkan program lingkungan hijau, Meningkatkan kegiatan sosial dan kemanusiaan, Memperkuat budaya literasi di sekolah', 'candidates/foto/3_ketua.jpg', 'candidates/foto/3_wakil.jpg', 'candidates/foto/3_couple.jpg');

-- Table structure for table `candidate_users`
CREATE TABLE `candidate_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `candidate_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `candidate_number` (`candidate_number`),
  FOREIGN KEY (`candidate_number`) REFERENCES `candidates` (`candidate_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert dummy data for candidate users
INSERT INTO `candidate_users` (`user_id`, `name`, `password`, `candidate_number`) VALUES
('calon1', 'Ahmad Rizki', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('calon2', 'Siti Aisyah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('calon3', 'Muhammad Farhan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

-- Table structure for table `votes`
CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` varchar(50) NOT NULL,
  `candidate_number` int(11) NOT NULL,
  `voted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voter_id` (`voter_id`),
  KEY `candidate_number` (`candidate_number`),
  FOREIGN KEY (`candidate_number`) REFERENCES `candidates` (`candidate_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `voting_settings`
CREATE TABLE `voting_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default settings
INSERT INTO `voting_settings` (`setting_key`, `setting_value`) VALUES
('voting_start', '2024-01-01 08:00:00'),
('voting_end', '2024-12-31 17:00:00'),
('quickcount_enabled', '1'),
('voting_active', '1');