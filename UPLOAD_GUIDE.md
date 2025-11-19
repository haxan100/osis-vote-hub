# 🚀 Panduan Upload ke VPS

## ✅ File yang BOLEH diupload:

```
e-voting/
├── application/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   ├── config/ (KECUALI database.php)
│   ├── helpers/
│   ├── libraries/
│   └── ...
├── system/
├── candidates/
│   └── foto/ (folder kosong)
├── index.php
├── .htaccess
├── database.sql
├── update_database.sql
└── README.md
```

## ❌ File yang JANGAN diupload:

```
❌ index.html (React)
❌ src/ (React source)
❌ node_modules/
❌ package.json
❌ package-lock.json
❌ bun.lockb
❌ vite.config.ts
❌ tailwind.config.ts
❌ tsconfig.json
❌ eslint.config.js
❌ postcss.config.js
❌ components.json
❌ application/config/database.php
```

## 📋 Langkah Upload:

### 1. **Gunakan .gitignore**
File `.gitignore` sudah dibuat untuk mencegah upload file yang tidak perlu.

### 2. **Upload via Git (Recommended)**
```bash
# Di VPS
git clone https://github.com/username/e-voting.git
cd e-voting
```

### 3. **Upload via FTP/cPanel**
- Zip folder `e-voting` (akan otomatis skip file di .gitignore)
- Upload dan extract di VPS
- Pastikan tidak ada file React yang terupload

### 4. **Setup Database Config di VPS**
```bash
# Copy template
cp application/config/database_vps.php application/config/database.php

# Edit dengan kredensial VPS
nano application/config/database.php
```

### 5. **Edit Base URL**
```bash
nano application/config/config.php
# Ganti base_url dengan domain VPS
```

### 6. **Set Permissions**
```bash
chmod 755 application/
chmod 777 candidates/foto/
chmod 644 .htaccess
```

### 7. **Import Database**
```bash
mysql -u username -p database_name < database.sql
mysql -u username -p database_name < update_database.sql
```

## 🔍 Troubleshooting:

### Jika masih load React:
```bash
# Hapus file React yang mungkin terupload
rm -f index.html
rm -rf src/
rm -rf node_modules/
```

### Jika blank page:
```bash
# Cek error log
tail -f /var/log/apache2/error.log
# atau
tail -f /var/log/nginx/error.log
```

### Test koneksi database:
```php
// Buat file test.php
<?php
$conn = new mysqli('localhost', 'username', 'password', 'database');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
```