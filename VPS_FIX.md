# Fix VPS Upload - Index.html Problem

## Masalah:
- `index.html` React/Vite mengambil alih
- Server load `index.html` bukan `index.php`
- Aplikasi jadi blank karena load React

## Solusi:

### 1. **Hapus/Rename File React (PILIH SALAH SATU):**

#### Opsi A: Hapus File React
```bash
rm index.html
rm -rf src/
rm -rf node_modules/
rm package.json
rm vite.config.ts
rm tailwind.config.ts
```

#### Opsi B: Rename File React
```bash
mv index.html react-index.html
mv src/ react-src/
```

#### Opsi C: Redirect (Sudah dilakukan)
File `index.html` sudah diubah jadi redirect ke `index.php`

### 2. **Pastikan .htaccess Benar:**
```apache
DirectoryIndex index.php index.html
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

### 3. **Cek Apache/Nginx Config:**

#### Apache:
```apache
<Directory "/path/to/e-voting">
    DirectoryIndex index.php
    AllowOverride All
</Directory>
```

#### Nginx:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
    index index.php;
}
```

### 4. **Upload ke VPS - File yang Dibutuhkan:**

#### Upload HANYA file ini:
```
e-voting/
├── application/          # CodeIgniter app
├── system/              # CodeIgniter system  
├── candidates/          # Folder foto
├── index.php           # CodeIgniter entry point
├── .htaccess           # URL rewrite
├── database.sql        # Database structure
└── update_database.sql # Database update
```

#### JANGAN upload file ini:
```
❌ index.html (React)
❌ src/ (React source)
❌ node_modules/
❌ package.json
❌ vite.config.ts
❌ tailwind.config.ts
❌ bun.lockb
❌ application/config/database.php (Buat manual di VPS)
```

### 5. **Setup Database Config di VPS:**
```bash
# Di VPS, buat file database.php manual
cp application/config/database_vps.php application/config/database.php
# Edit sesuai kredensial VPS
nano application/config/database.php
```

### 5. **Test Setelah Upload:**
1. Akses: `https://yourdomain.com/`
2. Harus redirect ke login CodeIgniter
3. Jika masih blank, cek error log

### 6. **Debug Command:**
```bash
# Cek file apa yang diload
ls -la /path/to/website/
# Cek .htaccess
cat .htaccess
# Cek error log
tail -f /var/log/apache2/error.log
```