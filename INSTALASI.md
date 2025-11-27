# 🚀 Panduan Instalasi E-Mading SMK

## Langkah-langkah Instalasi

### 1. Persiapan Environment

#### A. Install XAMPP
1. Download XAMPP dari https://www.apachefriends.org/
2. Install XAMPP dengan komponen:
   - Apache
   - MySQL
   - PHP 8.1+
3. Start Apache dan MySQL dari XAMPP Control Panel

#### B. Install Composer
1. Download Composer dari https://getcomposer.org/
2. Install Composer secara global
3. Verifikasi dengan command: `composer --version`

### 2. Setup Project

#### A. Extract/Clone Project
1. Extract file project ke folder `c:\xampp\htdocs\mading`
2. Atau clone dari repository jika tersedia

#### B. Install Dependencies
```bash
cd c:\xampp\htdocs\mading
composer install
```

#### C. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 3. Setup Database

#### A. Buat Database
1. Buka phpMyAdmin di http://localhost/phpmyadmin
2. Buat database baru dengan nama `mading_db`
3. Set collation ke `utf8mb4_unicode_ci`

#### B. Konfigurasi Database
Edit file `.env` dan sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mading_db
DB_USERNAME=root
DB_PASSWORD=
```

#### C. Import Database
1. Buka phpMyAdmin
2. Pilih database `mading_db`
3. Import file `setup_database.sql`
4. Atau jalankan script SQL yang ada di file tersebut

### 4. Konfigurasi Storage
```bash
php artisan storage:link
```

### 5. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di: http://localhost:8000

## 🔑 Akun Default

Setelah instalasi berhasil, gunakan akun berikut untuk login:

| Role | Email | Password | Keterangan |
|------|-------|----------|------------|
| **Admin** | admin@smk.sch.id | admin123 | Akses penuh sistem |
| **Guru** | guru@smk.sch.id | guru123 | Kelola artikel |
| **Siswa** | siswa@smk.sch.id | siswa123 | Buat artikel |

## 📱 Akses Aplikasi

- **Website Publik**: http://localhost:8000
- **Login Dashboard**: http://localhost:8000/login
- **phpMyAdmin**: http://localhost/phpmyadmin

## 🔧 Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Error Database Connection
1. Pastikan MySQL service berjalan di XAMPP
2. Cek konfigurasi database di file `.env`
3. Pastikan database `mading_db` sudah dibuat

### Error Permission Storage
```bash
# Windows (run as administrator)
icacls storage /grant Everyone:F /T
icacls bootstrap/cache /grant Everyone:F /T
```

### Error 500 Internal Server
1. Cek log error di `storage/logs/laravel.log`
2. Pastikan semua dependencies terinstall
3. Pastikan file `.env` sudah dikonfigurasi dengan benar

### Error Route Not Found
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

## 📋 Checklist Instalasi

- [ ] XAMPP terinstall dan berjalan
- [ ] Composer terinstall
- [ ] Project di folder `c:\xampp\htdocs\mading`
- [ ] Dependencies terinstall (`composer install`)
- [ ] File `.env` sudah dikonfigurasi
- [ ] Database `mading_db` sudah dibuat
- [ ] Script SQL sudah diimport
- [ ] Storage link sudah dibuat
- [ ] Aplikasi berjalan di http://localhost:8000
- [ ] Bisa login dengan akun admin

## 🎯 Langkah Selanjutnya

Setelah instalasi berhasil:

1. **Login sebagai Admin**
   - Email: admin@smk.sch.id
   - Password: admin123

2. **Explore Fitur**
   - Buat artikel baru
   - Kelola kategori
   - Lihat dashboard statistik

3. **Kustomisasi**
   - Ganti logo sekolah di `public/images/logo-smk.png`
   - Sesuaikan nama sekolah di views
   - Tambah data siswa dan guru

4. **Testing**
   - Test semua fitur utama
   - Test responsive design
   - Test upload gambar

## 📞 Bantuan

Jika mengalami kesulitan:
1. Cek file `DOKUMENTASI.md` untuk panduan lengkap
2. Lihat log error di `storage/logs/laravel.log`
3. Hubungi tim pengembang

---

**Selamat! Sistem E-Mading SMK siap digunakan! 🎉**