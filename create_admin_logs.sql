-- Create admin_logs table
CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_name` (`admin_name`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;