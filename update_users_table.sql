-- Update table users untuk menambah kolom kelas dan default_password
ALTER TABLE `users` 
ADD COLUMN `kelas` varchar(20) DEFAULT NULL AFTER `name`,
ADD COLUMN `default_password` tinyint(1) DEFAULT 1 AFTER `password`;

-- Update existing data
UPDATE `users` SET `kelas` = 'XII IPA 1' WHERE `id` = 1;
UPDATE `users` SET `kelas` = 'XII IPS 2' WHERE `id` = 2;
UPDATE `users` SET `kelas` = 'XI IPA 3' WHERE `id` = 3;