# Screenshot untuk User Guide E-Mading
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Create screenshots directory
New-Item -ItemType Directory -Force -Path "screenshots" -ErrorAction SilentlyContinue

function Take-Screenshot {
    param($filename, $description)
    Write-Host "Screenshot: $description"
    Write-Host "Pastikan halaman sudah terbuka dan siap di-screenshot"
    Read-Host "Tekan Enter untuk mengambil screenshot..."
    
    Start-Sleep -Seconds 1
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size)
    $bitmap.Save("screenshots\$filename", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    Write-Host "✓ Tersimpan: $filename"
    Write-Host ""
}

Write-Host "========================================="
Write-Host "   SCREENSHOT USER GUIDE E-MADING"
Write-Host "========================================="
Write-Host ""

# Start Laravel server
Write-Host "Memulai Laravel server..."
Start-Process -FilePath "php" -ArgumentList "artisan", "serve" -WindowStyle Hidden
Start-Sleep -Seconds 3
Write-Host "Server berjalan di http://localhost:8000"
Write-Host ""

# 1. Pengenalan Aplikasi - Home Page
Write-Host "1. PENGENALAN APLIKASI"
Start-Process "http://localhost:8000"
Start-Sleep -Seconds 3
Take-Screenshot "01-pengenalan-aplikasi.png" "Halaman utama untuk pengenalan aplikasi"

# 2. Akses Aplikasi - URL Bar
Take-Screenshot "02-akses-aplikasi.png" "Tampilan URL dan akses aplikasi"

# 3. Login ke Sistem
Write-Host "3. LOGIN KE SISTEM"
Start-Process "http://localhost:8000/login"
Start-Sleep -Seconds 2
Take-Screenshot "03-login-sistem.png" "Halaman login dengan form dan demo accounts"

# Login manual
Write-Host "Silakan login dengan:"
Write-Host "Username: admin@smk.sch.id"
Write-Host "Password: admin123"
Read-Host "Tekan Enter setelah berhasil login..."

# 4. Halaman Beranda (setelah login)
Write-Host "4. HALAMAN BERANDA"
Start-Process "http://localhost:8000"
Start-Sleep -Seconds 2
Take-Screenshot "04-halaman-beranda.png" "Halaman beranda dengan artikel dan filter"

# 5. Dashboard Pengguna
Write-Host "5. DASHBOARD PENGGUNA"
Start-Process "http://localhost:8000/dashboard"
Start-Sleep -Seconds 2
Take-Screenshot "05-dashboard-pengguna.png" "Dashboard dengan statistik dan manajemen"

# 6. Membuat Artikel
Write-Host "6. MEMBUAT ARTIKEL"
Start-Process "http://localhost:8000/mading/create"
Start-Sleep -Seconds 2
Take-Screenshot "06-membuat-artikel.png" "Form pembuatan artikel"

# 7. Mengelola Artikel
Write-Host "7. MENGELOLA ARTIKEL"
Start-Process "http://localhost:8000/mading"
Start-Sleep -Seconds 2
Take-Screenshot "07-mengelola-artikel.png" "Halaman manajemen artikel"

# 8. Fitur Pencarian
Write-Host "8. FITUR PENCARIAN"
Start-Process "http://localhost:8000"
Start-Sleep -Seconds 2
Write-Host "Silakan gunakan fitur pencarian dan filter di halaman"
Take-Screenshot "08-fitur-pencarian.png" "Interface pencarian dan filter"

# 9. Sistem Like
Write-Host "9. SISTEM LIKE"
Write-Host "Fokus pada tombol like di artikel"
Take-Screenshot "09-sistem-like.png" "Tombol like pada artikel"

# 10. Notifikasi
Write-Host "10. NOTIFIKASI"
Start-Process "http://localhost:8000/dashboard"
Start-Sleep -Seconds 2
Write-Host "Klik icon notifikasi (bell) di navbar"
Take-Screenshot "10-notifikasi.png" "Dropdown notifikasi"

# 11. Tips dan Trik
Write-Host "11. TIPS DAN TRIK"
Write-Host "Screenshot halaman yang menunjukkan berbagai fitur"
Take-Screenshot "11-tips-trik.png" "Tampilan fitur-fitur aplikasi"

# 12. Troubleshooting
Write-Host "12. TROUBLESHOOTING"
Write-Host "Screenshot error page atau halaman bantuan"
Take-Screenshot "12-troubleshooting.png" "Contoh troubleshooting atau error handling"

Write-Host ""
Write-Host "========================================="
Write-Host "           SCREENSHOT SELESAI"
Write-Host "========================================="
Write-Host ""

# List hasil screenshot
Write-Host "File screenshot yang berhasil dibuat:"
Get-ChildItem "screenshots\*.png" | Sort-Object Name | ForEach-Object {
    $size = [math]::Round($_.Length/1KB, 1)
    Write-Host "✓ $($_.Name) ($size KB)"
}

Write-Host ""
Write-Host "Semua screenshot tersimpan di folder: screenshots\"
Read-Host "Tekan Enter untuk keluar"