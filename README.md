# 🗳️ E-Voting System OSIS

Sistem pemilihan elektronik (E-Voting) yang dirancang khusus untuk pemilihan Ketua dan Wakil Ketua OSIS di sekolah. Sistem ini menyediakan platform voting yang aman, transparan, dan mudah digunakan dengan fitur real-time quickcount.

## 🛠️ Teknologi yang Digunakan

### Backend
- **PHP 7.4+** - Server-side programming
- **CodeIgniter 3** - PHP Framework
- **MySQL 5.7+** - Database management
- **PhpSpreadsheet** - Excel import/export functionality

### Frontend
- **HTML5 & CSS3** - Structure dan styling
- **JavaScript (Vanilla)** - Client-side interactivity
- **jQuery** - DOM manipulation
- **DataTables** - Advanced table features
- **Chart.js** - Data visualization untuk quickcount

### Tools & Libraries
- **Composer** - PHP dependency management
- **MAMP/XAMPP** - Local development environment
- **Bootstrap-inspired CSS** - Responsive design

## 👥 Aktor Sistem

### 1. **Administrator** 
- **Role**: Mengelola seluruh sistem voting
- **Akses**: Dashboard admin lengkap
- **Tanggung Jawab**: Setup kandidat, manage pemilih, monitoring

### 2. **Pemilih (Siswa)**
- **Role**: Memberikan suara dalam pemilihan
- **Akses**: Interface voting sederhana
- **Tanggung Jawab**: Login dan memilih kandidat

### 3. **Kandidat**
- **Role**: Calon Ketua/Wakil yang dapat melihat perolehan suara
- **Akses**: Dashboard kandidat untuk monitoring
- **Tanggung Jawab**: Melihat progress voting real-time

## 📋 Fitur Utama

### 🔐 **Sistem Autentikasi**
- **Multi-role login** (Admin, Pemilih, Kandidat)
- **Password default** dengan paksa ganti password
- **Session management** yang aman
- **IP tracking** untuk audit trail

### 👨‍💼 **Panel Administrator**

#### **Dashboard Utama**
- **Statistik real-time**: Total pemilih, sudah voting, belum voting, persentase partisipasi
- **Grafik quickcount**: Pie chart dan bar chart perolehan suara
- **Dark/Light mode** toggle
- **Auto-refresh** data setiap 30 detik

#### **Manajemen Kandidat**
- ➕ **Tambah kandidat** baru
- ✏️ **Edit data kandidat** (nama, visi, misi, foto)
- 🗑️ **Hapus kandidat**
- 📸 **Upload foto** (ketua, wakil, foto bersama)
- 📝 **Kelola visi & misi**

#### **Manajemen Pemilih**
- 📊 **DataTable** dengan server-side processing
- 📥 **Import data** dari file Excel (.xlsx)
- 📄 **Download template** Excel
- ✏️ **Edit data pemilih** (nama, nomor, kelas)
- 🔄 **Reset password** ke default
- 🗑️ **Hapus pemilih**
- 🔍 **Search & filter** real-time
- 📄 **Pagination** otomatis

#### **Pengaturan Jadwal**
- ⏰ **Set waktu mulai** pemilihan
- ⏰ **Set waktu selesai** pemilihan
- ✅ **Validasi tanggal** (tidak boleh masa lalu)
- 📊 **Status pemilihan** real-time
- 🕐 **Format datetime** yang user-friendly

#### **Log Aktivitas Admin**
- 📝 **Pencatatan semua aktivitas** admin
- 🏷️ **Badge aksi** dengan warna berbeda
- 📊 **DataTable** dengan search dan filter
- 🕐 **Timestamp** detail setiap aksi
- 🌐 **IP address** tracking
- 📋 **Deskripsi lengkap** setiap aktivitas

### 🗳️ **Sistem Voting**
- **Interface sederhana** untuk pemilih
- **Konfirmasi pilihan** sebelum submit
- **One-time voting** (tidak bisa voting ulang)
- **Real-time update** hasil

### 📊 **Quickcount Real-time**
- **Grafik pie chart** persentase suara
- **Bar chart** jumlah suara per kandidat
- **Update otomatis** setiap ada voting baru
- **Responsive design** untuk semua device

## ⚙️ Pengaturan Sistem

### **Database Configuration**
```php
// application/config/database.php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'database' => 'e_voting',
    'dbdriver' => 'mysqli'
);
```

### **Base URL Configuration**
```php
// application/config/config.php
$config['base_url'] = 'http://localhost/e-voting/';
```

### **Voting Settings**
- **voting_start**: Waktu mulai pemilihan
- **voting_end**: Waktu selesai pemilihan  
- **quickcount_enabled**: Enable/disable quickcount
- **voting_active**: Status aktif pemilihan

## 🔑 Kredensial Login Default

### **Administrator**
```
Username: admin
Password: password
```

### **Pemilih (Default untuk semua user)**
```
Nomor Telepon: [sesuai database]
Password: user123 (wajib ganti saat pertama login)
```

### **Kandidat**
```
User ID: calon1, calon2, calon3
Password: password
```

## 🏢 Penggunaan di Berbagai Institusi

### **🎓 Sekolah & Universitas**
- Pemilihan OSIS/BEM
- Pemilihan Ketua Kelas
- Pemilihan MPK/DPM
- Pemilihan Organisasi Mahasiswa

### **🏢 Perusahaan & Organisasi**
- Pemilihan Ketua Serikat Pekerja
- Voting internal perusahaan
- Pemilihan Board of Directors
- Employee of the Month

### **🏘️ Komunitas & Perkumpulan**
- Pemilihan Ketua RT/RW
- Voting komunitas online
- Pemilihan pengurus organisasi
- Event voting & polling

### **🎪 Event & Kompetisi**
- Voting kompetisi talent
- Pemilihan favorit audience
- Award ceremony voting
- Festival & lomba

## 📱 Ketentuan Login User

### **Format Nomor Telepon**
- Harus berupa **angka** (contoh: 081234567890)
- Disimpan sebagai **user_id** di database
- Digunakan sebagai **username** login

### **Password Default**
- Semua user baru: **"user123"**
- Status `default_password = 1`
- **Wajib ganti** saat pertama login

### **Proses Ganti Password**
1. Login dengan nomor telepon + "user123"
2. Sistem redirect ke halaman ganti password
3. Input password lama, password baru, konfirmasi
4. Validasi: minimal 6 karakter
5. Setelah berhasil, `default_password = 0`

### **Reset Password (Admin)**
- Admin dapat reset password user ke "user123"
- Status kembali ke `default_password = 1`
- User wajib ganti password lagi

## 📊 Quickcount & Monitoring

### **Real-time Updates**
- **Auto-refresh** setiap 30 detik
- **WebSocket-ready** architecture
- **Responsive charts** untuk mobile

### **Data Visualization**
- **Pie Chart**: Persentase perolehan suara
- **Bar Chart**: Jumlah suara absolut
- **Statistics Cards**: Ringkasan data voting
- **Progress Bars**: Tingkat partisipasi

### **Export & Reporting**
- Export hasil ke Excel
- Generate laporan PDF
- Backup database otomatis
- Audit trail lengkap

## 🔒 Keamanan & Audit

### **Security Features**
- **Password hashing** dengan bcrypt
- **Session management** yang aman
- **SQL injection** protection
- **XSS prevention**
- **CSRF protection** ready

### **Audit Trail**
- **Admin logs** semua aktivitas
- **IP address** tracking
- **Timestamp** detail
- **Action description** lengkap
- **User identification** jelas

## 🚀 Instalasi & Setup

### **Requirements**
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx web server
- Composer untuk dependency management

### **Langkah Instalasi**
1. Clone/download project
2. Import `database.sql` ke MySQL
3. Konfigurasi `database.php` dan `config.php`
4. Install dependencies: `composer install`
5. Set permissions untuk folder `uploads/` dan `candidates/`
6. Akses via browser: `http://localhost/e-voting/`

### **Default Data**
- 1 Admin account
- 3 Kandidat sample
- 6 User pemilih sample
- Voting settings default

## 📞 Support & Maintenance

### **Troubleshooting**
- Cek error logs di `application/logs/`
- Pastikan database connection
- Verify file permissions
- Clear browser cache

### **Backup Strategy**
- Database backup berkala
- File backup (photos, uploads)
- Configuration backup
- Log files archiving

---

**Developed with ❤️ for Democratic Digital Voting**

*Sistem ini dirancang untuk mendukung proses demokrasi digital yang transparan, aman, dan mudah digunakan di berbagai institusi.*