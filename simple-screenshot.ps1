# Simple Screenshot Script
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Create screenshots directory
New-Item -ItemType Directory -Force -Path "screenshots" -ErrorAction SilentlyContinue

# Function to take full screen screenshot
function Take-Screenshot {
    param($filename)
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size)
    $bitmap.Save("screenshots\$filename", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    Write-Host "Screenshot saved: $filename"
}

Write-Host "Screenshot Tool untuk E-Mading"
Write-Host "Buka http://localhost:8000 di browser"
Write-Host ""

# Open localhost:8000
Start-Process "http://localhost:8000"
Start-Sleep -Seconds 5

Write-Host "Mengambil screenshot dalam 3 detik..."
Write-Host "Pastikan browser terbuka dan halaman sudah load"
Start-Sleep -Seconds 3

Take-Screenshot "home-page.png"

Write-Host ""
Write-Host "Screenshot berhasil disimpan di folder screenshots/"
Read-Host "Tekan Enter untuk keluar"