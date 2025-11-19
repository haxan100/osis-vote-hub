# Setup E-Voting di VPS

## 1. File yang WAJIB diedit:

### A. Database Configuration
**File: `application/config/database.php`**
```php
$db['default'] = array(
    'hostname' => 'localhost', // atau IP database server
    'username' => 'your_db_username', // username database VPS
    'password' => 'your_db_password', // password database VPS
    'database' => 'your_db_name',     // nama database di VPS
);
```

### B. Base URL Configuration  
**File: `application/config/config.php`**
```php
$config['base_url'] = 'https://yourdomain.com/'; // URL VPS Anda
```

### C. Environment Configuration
**File: `index.php` (root folder)**
```php
define('ENVIRONMENT', 'production'); // Ganti dari 'development'
```

## 2. Folder Permissions (PENTING):

```bash
chmod 755 application/
chmod 755 system/
chmod 777 candidates/foto/  # Untuk upload foto
chmod 644 .htaccess
```

## 3. Database Setup:

1. **Import database.sql** ke MySQL VPS
2. **Import update_database.sql** untuk kolom foto
3. **Cek koneksi database** di phpMyAdmin VPS

## 4. .htaccess untuk VPS:

**File: `.htaccess` (root folder)**
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
```

## 5. PHP Configuration:

**Cek php.ini di VPS:**
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
memory_limit = 256M
```

## 6. Troubleshooting Blank Page:

### A. Enable Error Reporting (sementara)
**File: `index.php`**
```php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

### B. Cek Error Logs
```bash
tail -f /var/log/apache2/error.log
# atau
tail -f /var/log/nginx/error.log
```

### C. Cek File Permissions
```bash
ls -la application/
ls -la system/
ls -la candidates/
```

## 7. Testing Checklist:

- [ ] Database connection berhasil
- [ ] Base URL sesuai domain
- [ ] Folder permissions benar
- [ ] .htaccess berfungsi
- [ ] PHP extensions (mysqli, gd, fileinfo)
- [ ] Error logs tidak ada fatal error

## 8. Login Credentials:

**Admin:**
- Username: `admin`
- Password: `admin123`

**Pemilih:**
- ID: `081234567890`
- Password: `pemilih123`

**Kandidat:**
- ID: `calon1`
- Password: `calon123`