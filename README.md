# 📰 E-Mading SMK - Sistem Informasi Digital Sekolah

<p align="center">
  <img src="public/images/logo-smk.png" width="100" alt="Logo SMK">
</p>

<p align="center">
  <strong>Aplikasi E-Mading (Electronic Mading) untuk SMK</strong><br>
  Platform digital untuk berbagi informasi, artikel, dan kreativitas siswa
</p>

## 🎯 Tentang E-Mading

E-Mading adalah aplikasi berbasis web yang dirancang untuk menggantikan mading manual dengan sistem digital yang lebih interaktif, mudah diperbarui, dan bisa diakses kapan saja. Sistem ini memungkinkan siswa, guru, dan admin untuk berbagi informasi sekolah secara online.

### ✨ Fitur Utama

- 🔐 **Login Multiuser** - Admin, Guru, dan Siswa dengan hak akses berbeda
- 📊 **Dashboard Pengguna** - Statistik artikel, views, dan aktivitas
- 📝 **Manajemen Artikel** - CRUD artikel dengan kategori dan status
- 🏷️ **Kategori Artikel** - Prestasi, Opini, Kegiatan, Informasi, dll
- 🖼️ **Upload Gambar** - Setiap artikel bisa dilengkapi gambar
- ❤️ **Sistem Like** - Pengguna bisa memberikan like pada artikel
- 🔍 **Pencarian** - Cari artikel berdasarkan judul atau konten
- 🌐 **Halaman Publik** - Website dapat diakses tanpa login
- 📱 **Responsive Design** - Tampilan optimal di desktop dan mobile
- 🔒 **Keamanan** - Authentication, authorization, dan validasi input

## 🚀 Quick Start

### Persyaratan Sistem
- PHP 8.1+
- MySQL 5.7+
- Composer
- Web server (Apache/Nginx)

### Instalasi Cepat

1. **Clone project**
   ```bash
   git clone [repository-url]
   cd mading
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   - Buat database MySQL bernama `mading_db`
   - Update konfigurasi database di file `.env`
   - Import file `setup_database.sql` ke database

5. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

6. **Akses aplikasi**
   - Website: http://localhost:8000
   - Login: http://localhost:8000/login

### 👥 Akun Demo

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| Admin | admin@smk.sch.id | admin123 | Full access |
| Guru | guru@smk.sch.id | guru123 | Kelola artikel |
| Siswa | siswa@smk.sch.id | siswa123 | Buat artikel |

## 📋 Struktur Aplikasi

### Database Tables
- `users` - Data pengguna dengan role
- `categories` - Kategori artikel
- `madings` - Data artikel/posting
- `likes` - Data like artikel
- `activity_logs` - Log aktivitas pengguna

### Main Routes
- `/` - Halaman publik
- `/login` - Login page
- `/dashboard` - Dashboard pengguna
- `/mading` - Manajemen artikel
- `/category/{slug}` - Artikel per kategori
- `/search` - Pencarian artikel

## 🎨 Screenshots

### Halaman Publik
- Menampilkan artikel terbaru dan unggulan
- Navigasi kategori
- Fitur pencarian

### Dashboard Admin/User
- Statistik artikel dan aktivitas
- Manajemen artikel dengan tabel
- Form create/edit artikel yang lengkap

### Fitur Artikel
- Editor artikel dengan kategori
- Upload gambar
- Status draft/published
- Sistem like dan view counter

## 🛠️ Teknologi

- **Backend**: Laravel 11, PHP 8.1+
- **Frontend**: Bootstrap 5, JavaScript
- **Database**: MySQL
- **Icons**: Font Awesome
- **File Storage**: Laravel Storage

## 📚 Dokumentasi

Untuk dokumentasi lengkap, lihat file `DOKUMENTASI.md` yang berisi:
- Spesifikasi sistem lengkap
- Panduan penggunaan
- Struktur database detail
- Troubleshooting

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:
1. Fork repository ini
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail.

## 📞 Support

Jika ada pertanyaan atau butuh bantuan:
- Buat issue di repository ini
- Hubungi tim pengembang

---

<p align="center">
  <strong>Dibuat dengan ❤️ untuk pendidikan SMK</strong>
</p>
