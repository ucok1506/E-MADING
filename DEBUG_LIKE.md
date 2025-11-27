# Panduan Debugging Fitur Like

## Langkah-langkah untuk mengecek masalah:

### 1. Cek apakah sudah login
- Pastikan Anda sudah login sebagai user
- Tombol like hanya muncul jika sudah login (@auth)

### 2. Test dengan halaman khusus
- Akses: http://localhost/mading/test-like
- Klik tombol "Toggle Like"
- Lihat Debug Log untuk melihat apa yang terjadi

### 3. Cek console browser
- Tekan F12 untuk membuka Developer Tools
- Buka tab "Console"
- Lihat apakah ada error JavaScript
- Lihat tab "Network" untuk melihat request/response

### 4. Cek log Laravel
- Buka file: storage/logs/laravel.log
- Lihat error terbaru (paling bawah)
- Cari log dengan kata "handleLike" atau "Like"

### 5. Error umum yang mungkin terjadi:

#### Error 419 (CSRF Token Mismatch)
- Solusi: Clear cache browser (Ctrl+Shift+Del)
- Atau: Restart server Laravel

#### Error 401 (Unauthorized)
- Solusi: Pastikan sudah login
- Atau: Session expired, login ulang

#### Error 500 (Server Error)
- Solusi: Cek log Laravel di storage/logs/laravel.log
- Atau: Cek database apakah tabel 'likes' ada

#### Button tidak respond
- Solusi: Cek console browser untuk error JavaScript
- Atau: Pastikan meta tag csrf-token ada di halaman

### 6. Cek database
Jalankan query di MySQL/phpMyAdmin:
```sql
-- Cek apakah tabel likes ada
SHOW TABLES LIKE 'likes';

-- Cek struktur tabel likes
DESCRIBE likes;

-- Cek data likes
SELECT * FROM likes;

-- Cek madings
SELECT id, title FROM madings LIMIT 5;
```

### 7. Clear cache Laravel
Jalankan di terminal/command prompt:
```bash
cd c:\xampp\htdocs\mading
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 8. Restart server
- Stop Apache di XAMPP
- Start lagi Apache
- Atau restart service MySQL juga

## Informasi yang dibutuhkan untuk debugging:
Jika masih bermasalah, berikan informasi berikut:
1. Error message yang muncul (screenshot atau copy paste)
2. Response status dari Network tab (contoh: 200, 401, 419, 500)
3. Isi Debug Log dari halaman test-like
4. Error dari storage/logs/laravel.log (bagian paling bawah)
5. Apakah sudah dalam keadaan login?
