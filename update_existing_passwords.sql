-- Update password untuk user existing dengan format nomor telepon tanpa 0
UPDATE `users` SET 
    `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    `default_password` = 1
WHERE `user_id` = '081234567890';

UPDATE `users` SET 
    `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    `default_password` = 1  
WHERE `user_id` = '089876543210';

UPDATE `users` SET 
    `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    `default_password` = 1
WHERE `user_id` = '082345678901';

-- Update password admin juga
UPDATE `admins` SET 
    `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
WHERE `username` = 'admin';