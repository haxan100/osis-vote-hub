-- Update database untuk menambahkan kolom foto
USE `e_voting`;

-- Tambahkan kolom foto ke tabel candidates
ALTER TABLE `candidates` 
ADD COLUMN `ketua_photo` varchar(255) DEFAULT NULL AFTER `mission`,
ADD COLUMN `wakil_photo` varchar(255) DEFAULT NULL AFTER `ketua_photo`,
ADD COLUMN `couple_photo` varchar(255) DEFAULT NULL AFTER `wakil_photo`;

-- Update data dummy dengan path foto
UPDATE `candidates` SET 
`ketua_photo` = 'candidates/foto/1_ketua.jpg',
`wakil_photo` = 'candidates/foto/1_wakil.jpg', 
`couple_photo` = 'candidates/foto/1_couple.jpg'
WHERE `candidate_number` = 1;

UPDATE `candidates` SET 
`ketua_photo` = 'candidates/foto/2_ketua.jpg',
`wakil_photo` = 'candidates/foto/2_wakil.jpg',
`couple_photo` = 'candidates/foto/2_couple.jpg' 
WHERE `candidate_number` = 2;

UPDATE `candidates` SET 
`ketua_photo` = 'candidates/foto/3_ketua.jpg',
`wakil_photo` = 'candidates/foto/3_wakil.jpg',
`couple_photo` = 'candidates/foto/3_couple.jpg'
WHERE `candidate_number` = 3;