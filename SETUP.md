# Setup E-Voting System

## Langkah-langkah Setup:

### 1. Database Setup
1. Buka phpMyAdmin di `http://localhost/phpmyadmin`
2. Import file `database.sql` yang ada di root folder
3. Database `e_voting` akan otomatis terbuat dengan data dummy

### 2. Konfigurasi
- Database sudah dikonfigurasi untuk:
  - Host: localhost
  - Username: root
  - Password: (kosong)
  - Database: e_voting

### 3. Akses Aplikasi
- URL: `http://localhost/e-voting`
- Aplikasi akan redirect ke halaman login

### 4. Data Login Default

#### Admin:
- Username: `admin`
- Password: `admin123`

#### Calon:
- ID: `calon1`, Password: `calon123` (Ahmad Rizki - Calon 1)
- ID: `calon2`, Password: `calon123` (Siti Aisyah - Calon 2)  
- ID: `calon3`, Password: `calon123` (Muhammad Farhan - Calon 3)

#### Pemilih:
- ID: `081234567890`, Password: `pemilih123` (Ahmad Fauzi)
- ID: `089876543210`, Password: `pemilih123` (Siti Nurhaliza)
- ID: `082345678901`, Password: `pemilih123` (Budi Santoso)

### 5. Fitur yang Sudah Dibuat:
- ✅ Login multi-role (Admin, Calon, Pemilih)
- ✅ Dashboard Admin dengan tabs
- ✅ Responsive design
- ✅ Session management
- ✅ Database structure

### 6. Struktur File:
```
e-voting/
├── application/
│   ├── controllers/
│   │   ├── Auth.php (Login/Logout)
│   │   └── Admin.php (Dashboard Admin)
│   ├── models/
│   │   └── Auth_model.php (Validasi user)
│   └── views/
│       ├── login.php (Halaman login)
│       └── admin/
│           └── dashboard.php (Dashboard admin)
├── database.sql (Database structure)
└── .htaccess (URL rewriting)
```

### 7. Next Steps:
- Implementasi halaman voting untuk pemilih
- Dashboard untuk calon
- Fitur quickcount real-time
- Manajemen kandidat dan pemilih
- Export hasil voting