# Auto Screenshot All Pages E-Mading
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Create screenshots directory
New-Item -ItemType Directory -Force -Path "screenshots" -ErrorAction SilentlyContinue

# Function to take screenshot
function Take-Screenshot {
    param($filename)
    Start-Sleep -Seconds 3
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size)
    $bitmap.Save("screenshots\$filename", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    Write-Host "Screenshot saved: $filename"
}

Write-Host "AUTO SCREENSHOT SEMUA HALAMAN E-MADING"
Write-Host "======================================"

# Start Laravel server
Write-Host "Starting Laravel server..."
Start-Process -FilePath "php" -ArgumentList "artisan", "serve" -WindowStyle Hidden
Start-Sleep -Seconds 5

# 1. Home Page
Write-Host "1. Screenshot Home Page..."
Start-Process "http://localhost:8000"
Take-Screenshot "01-home-page.png"

# 2. Login Page
Write-Host "2. Screenshot Login Page..."
Start-Process "http://localhost:8000/login"
Take-Screenshot "02-login-page.png"

# Manual login instruction
Write-Host ""
Write-Host "INSTRUKSI LOGIN:"
Write-Host "- Buka tab login yang sudah terbuka"
Write-Host "- Username: admin@smk.sch.id"
Write-Host "- Password: admin123"
Write-Host "- Klik Login"
Read-Host "Tekan Enter setelah berhasil login..."

# 3. Dashboard
Write-Host "3. Screenshot Dashboard..."
Start-Process "http://localhost:8000/dashboard"
Take-Screenshot "03-dashboard.png"

# 4. Create Article
Write-Host "4. Screenshot Create Article..."
Start-Process "http://localhost:8000/mading/create"
Take-Screenshot "04-create-article.png"

# 5. Manage Articles
Write-Host "5. Screenshot Manage Articles..."
Start-Process "http://localhost:8000/mading"
Take-Screenshot "05-manage-articles.png"

# 6. Search Results
Write-Host "6. Screenshot Search Results..."
Start-Process "http://localhost:8000?q=artikel"
Take-Screenshot "06-search-results.png"

# 7. Category Page
Write-Host "7. Screenshot Category Page..."
Start-Process "http://localhost:8000?kategori=1"
Take-Screenshot "07-category-page.png"

Write-Host ""
Write-Host "SELESAI! Screenshot tersimpan di folder screenshots/"
Write-Host ""

# List all screenshots
Get-ChildItem "screenshots\*.png" | ForEach-Object {
    $size = [math]::Round($_.Length/1KB, 1)
    Write-Host "- $($_.Name) - $size KB"
}

Read-Host "Tekan Enter untuk keluar"