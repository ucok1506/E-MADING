# PowerShell Auto Screenshot Script
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Create screenshots directory
New-Item -ItemType Directory -Force -Path "screenshots"

# Function to take screenshot
function Take-Screenshot {
    param($filename)
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen($bounds.Location, [System.Drawing.Point]::Empty, $bounds.Size)
    $bitmap.Save("screenshots\$filename", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    Write-Host "Screenshot $filename saved"
}

# Function to open URL and wait
function Open-URL {
    param($url)
    Start-Process "chrome.exe" "--new-window $url"
    Start-Sleep -Seconds 4
}

Write-Host "Memulai auto screenshot..."
Write-Host "Pastikan Laravel server berjalan di localhost:8000"
Write-Host ""

# 1. Home page
Write-Host "Screenshot: Home page..."
Open-URL "http://localhost:8000"
Take-Screenshot "home-page.png"

# 2. Login page  
Write-Host "Screenshot: Login page..."
Open-URL "http://localhost:8000/login"
Take-Screenshot "login-page.png"

Write-Host ""
Write-Host "Sekarang login manual dengan:"
Write-Host "Username: admin@smk.sch.id"
Write-Host "Password: admin123"
Write-Host ""
Read-Host "Tekan Enter setelah login berhasil..."

# 3. Dashboard
Write-Host "Screenshot: Dashboard..."
Open-URL "http://localhost:8000/dashboard"
Take-Screenshot "dashboard.png"

# 4. Create article
Write-Host "Screenshot: Create article..."
Open-URL "http://localhost:8000/mading/create"
Take-Screenshot "create-article.png"

# 5. Manage articles
Write-Host "Screenshot: Manage articles..."
Open-URL "http://localhost:8000/mading"
Take-Screenshot "manage-articles.png"

# 6. Search feature
Write-Host "Screenshot: Search feature..."
Open-URL "http://localhost:8000"
Take-Screenshot "search-feature.png"

# 7. Like system
Take-Screenshot "like-system.png"

# 8. Notifications
Write-Host "Screenshot: Notifications..."
Open-URL "http://localhost:8000/dashboard"
Take-Screenshot "notifications.png"

Write-Host ""
Write-Host "Semua screenshot selesai!"
Write-Host "Cek folder screenshots untuk hasil"