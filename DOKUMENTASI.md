# Dokumentasi Sistem E-Mading SMK

## Deskripsi Sistem
E-Mading (Electronic Mading) adalah aplikasi berbasis web untuk mengelola papan informasi digital sekolah. Sistem ini memungkinkan siswa, guru, dan admin untuk berbagi artikel, pengumuman, dan informasi sekolah secara online.

## Fitur Utama

### A. Tujuan Utama Pembuatan Sistem E-Mading
1. **Digitalisasi mading** - Mengubah sistem mading manual menjadi digital
2. **Media informasi sekolah** - Pusat informasi bagi siswa, guru, dan admin
3. **Media kreativitas siswa** - Memberikan ruang bagi siswa untuk menulis artikel
4. **Transparansi dan aksesibilitas** - Semua informasi terdokumentasi dan bisa diakses kapan saja
5. **Pelatihan IT praktis** - Melatih siswa SMK agar mampu membangun sistem berbasis web

### B. Ruang Lingkup Aplikasi

| No | Fitur / Modul | Penjelasan Singkat | Tingkat Kesulitan |
|----|---------------|-------------------|-------------------|
| 1 | Login Multiuser (Admin, Guru, Siswa) | Masing-masing punya hak akses berbeda: Admin mengelola, Guru & Siswa mengirim artikel | ⭐⭐ |
| 2 | Dashboard Pengguna | Ringkasan jumlah artikel, komentar, dan status posting (draft/publish) | ⭐⭐ |
| 3 | Manajemen Artikel/Mading | CRUD artikel: judul, isi, kategori, tanggal, foto, penulis, status (draft/publish) | ⭐⭐⭐ |
| 4 | Kategori / Tema Mading | Artikel dikelompokkan (contoh: Prestasi, Opini, Kegiatan, Informasi Sekolah) | ⭐⭐ |
| 5 | Upload Gambar / Dokumen | Setiap posting bisa menampilkan foto atau file lampiran | ⭐⭐⭐ |
| 6 | Suka (Like) | Pengunjung (login) bisa memberi suka pada artikel | ⭐⭐ |
| 7 | Moderasi Konten | Admin atau guru dapat menyetujui artikel sebelum dipublikasikan | ⭐⭐⭐ |
| 8 | Pencarian Artikel | Fitur pencarian berdasarkan judul/kategori/tanggal | ⭐⭐ |
| 9 | Halaman Publik (Home Page) | Menampilkan artikel terbaru, terpopuler, dan galeri kegiatan | ⭐ |
| 10 | Laporan Aktivitas | Laporan artikel yang sudah tayang per bulan atau per kategori (PDF/Excel) | ⭐⭐⭐ |
| 11 | Notifikasi / Status Postingan | Penulis mendapat info jika artikel sudah disetujui/tayang | ⭐⭐ |
| 12 | Manajemen User | Admin dapat menambah/menghapus user guru/siswa | ⭐⭐ |

### C. Peran Aktor dan Interaksi Utama

| Aktor | Hak Akses / Aktivitas |
|-------|----------------------|
| Admin Sekolah | Login, kelola kategori, verifikasi artikel, kelola user, membuat laporan |
| Guru / Pembina Mading | Menulis artikel, mengedit, melihat komentar, menyetujui artikel siswa |
| Siswa | Membuat artikel, mengedit artikel miliknya, membaca & berkomentar |
| Publik / Pengunjung (opsional) | Membaca artikel tanpa login, tidak bisa menulis atau komentar |

## Struktur Database

### Tabel Utama:
- **users** - Data pengguna (admin, guru, siswa)
- **categories** - Kategori artikel
- **madings** - Data artikel/posting
- **likes** - Data suka/like artikel
- **activity_logs** - Log aktivitas pengguna

## Instalasi dan Setup

### 1. Persyaratan Sistem
- PHP 8.1+
- MySQL 5.7+
- Composer
- Laravel 11
- Web server (Apache/Nginx)

### 2. Langkah Instalasi
1. Clone atau download project
2. Install dependencies: `composer install`
3. Copy `.env.example` ke `.env`
4. Generate app key: `php artisan key:generate`
5. Setup database di `.env`
6. Jalankan script SQL: `setup_database.sql`
7. Jalankan server: `php artisan serve`

### 3. Akun Default
- **Admin**: admin@smk.sch.id / admin123
- **Guru**: guru@smk.sch.id / guru123  
- **Siswa**: siswa@smk.sch.id / siswa123

## Struktur Aplikasi

### Routes Utama:
- `/` - Halaman publik
- `/login` - Halaman login
- `/dashboard` - Dashboard pengguna
- `/mading` - Manajemen artikel
- `/category/{slug}` - Artikel per kategori
- `/search` - Pencarian artikel

### Controllers:
- `AuthController` - Autentikasi
- `HomeController` - Halaman publik
- `DashboardController` - Dashboard
- `MadingController` - Manajemen artikel

### Models:
- `User` - Model pengguna
- `Mading` - Model artikel
- `Category` - Model kategori
- `Like` - Model suka/like
- `ActivityLog` - Model log aktivitas

## Fitur Keamanan
- Authentication & Authorization
- CSRF Protection
- Input Validation
- File Upload Security
- Role-based Access Control

## Teknologi yang Digunakan
- **Backend**: Laravel 11, PHP 8.1+
- **Frontend**: Bootstrap 5, JavaScript
- **Database**: MySQL
- **Icons**: Font Awesome
- **File Storage**: Laravel Storage

## Pengembangan Selanjutnya
1. Sistem komentar artikel
2. Notifikasi real-time
3. Export laporan PDF/Excel
4. API untuk mobile app
5. Sistem moderasi otomatis
6. Integrasi media sosial

## Troubleshooting
1. **Error 500**: Cek log di `storage/logs/laravel.log`
2. **Database Error**: Pastikan konfigurasi database di `.env` benar
3. **File Upload Error**: Cek permission folder `storage/`
4. **Route Not Found**: Jalankan `php artisan route:cache`

## Kontak Support
Untuk bantuan teknis, hubungi tim pengembang atau buat issue di repository project.

---
*Dokumentasi ini dibuat untuk membantu implementasi sistem E-Mading sesuai spesifikasi yang diminta.*