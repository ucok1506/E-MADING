# Auto Screenshot E-Mading - Fixed Version
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Create screenshots directory
New-Item -ItemType Directory -Force -Path "screenshots" -ErrorAction SilentlyContinue

# Function to capture browser window only
function Capture-BrowserWindow {
    param($filename, $description)
    
    Write-Host "Capturing: $description"
    
    # Wait for page to load
    Start-Sleep -Seconds 4
    
    # Get Chrome window handle
    $chromeProcess = Get-Process chrome -ErrorAction SilentlyContinue | Select-Object -First 1
    if ($chromeProcess) {
        # Bring Chrome to front
        Add-Type -TypeDefinition @"
            using System;
            using System.Runtime.InteropServices;
            public class Win32 {
                [DllImport("user32.dll")]
                public static extern bool SetForegroundWindow(IntPtr hWnd);
                [DllImport("user32.dll")]
                public static extern bool ShowWindow(IntPtr hWnd, int nCmdShow);
                [DllImport("user32.dll")]
                public static extern IntPtr FindWindow(string lpClassName, string lpWindowName);
            }
"@
        
        # Find Chrome window and bring to front
        $chromeWindow = [Win32]::FindWindow("Chrome_WidgetWin_1", $null)
        if ($chromeWindow -ne [IntPtr]::Zero) {
            [Win32]::ShowWindow($chromeWindow, 3) # SW_MAXIMIZE
            [Win32]::SetForegroundWindow($chromeWindow)
            Start-Sleep -Seconds 2
        }
    }
    
    # Take full screen screenshot (Chrome should be maximized)
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size)
    
    # Save screenshot
    $bitmap.Save("screenshots\$filename", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    
    Write-Host "✓ Saved: $filename"
}

# Function to open URL in Chrome
function Open-URL {
    param($url)
    
    # Close existing Chrome instances to start fresh
    Get-Process chrome -ErrorAction SilentlyContinue | Stop-Process -Force -ErrorAction SilentlyContinue
    Start-Sleep -Seconds 2
    
    # Start Chrome maximized
    Start-Process "chrome.exe" "--start-maximized --new-window $url"
    Start-Sleep -Seconds 5
}

Write-Host "============================================"
Write-Host "   AUTO SCREENSHOT E-MADING USER GUIDE"
Write-Host "============================================"
Write-Host ""

# Check if Laravel server is running
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8000" -TimeoutSec 5 -ErrorAction Stop
    Write-Host "✓ Laravel server is running"
} catch {
    Write-Host "Starting Laravel server..."
    Start-Process -FilePath "php" -ArgumentList "artisan", "serve" -WindowStyle Hidden
    Start-Sleep -Seconds 5
    Write-Host "✓ Laravel server started"
}

Write-Host ""

# 1. Pengenalan Aplikasi - Home Page
Write-Host "1. PENGENALAN APLIKASI"
Open-URL "http://localhost:8000"
Capture-BrowserWindow "01-pengenalan-aplikasi.png" "Halaman utama aplikasi E-Mading"

# 2. Akses Aplikasi - Same page with URL visible
Write-Host "2. AKSES APLIKASI"
Capture-BrowserWindow "02-akses-aplikasi.png" "Tampilan akses aplikasi dengan URL"

# 3. Login ke Sistem
Write-Host "3. LOGIN KE SISTEM"
Open-URL "http://localhost:8000/login"
Capture-BrowserWindow "03-login-sistem.png" "Halaman login dengan form dan demo accounts"

# Wait for manual login
Write-Host ""
Write-Host "MANUAL LOGIN REQUIRED:"
Write-Host "- Username: admin@smk.sch.id"
Write-Host "- Password: admin123"
Write-Host "- Click Login button"
Write-Host ""
Read-Host "Press Enter after successful login..."

# 4. Halaman Beranda (after login)
Write-Host "4. HALAMAN BERANDA"
Open-URL "http://localhost:8000"
Capture-BrowserWindow "04-halaman-beranda.png" "Halaman beranda dengan artikel dan navigasi"

# 5. Dashboard Pengguna
Write-Host "5. DASHBOARD PENGGUNA"
Open-URL "http://localhost:8000/dashboard"
Capture-BrowserWindow "05-dashboard-pengguna.png" "Dashboard dengan statistik dan manajemen"

# 6. Membuat Artikel
Write-Host "6. MEMBUAT ARTIKEL"
Open-URL "http://localhost:8000/mading/create"
Capture-BrowserWindow "06-membuat-artikel.png" "Form pembuatan artikel baru"

# 7. Mengelola Artikel
Write-Host "7. MENGELOLA ARTIKEL"
Open-URL "http://localhost:8000/mading"
Capture-BrowserWindow "07-mengelola-artikel.png" "Halaman manajemen artikel"

# 8. Fitur Pencarian
Write-Host "8. FITUR PENCARIAN"
Open-URL "http://localhost:8000?q=artikel`&kategori=1"
Capture-BrowserWindow "08-fitur-pencarian.png" "Interface pencarian dan filter"

# 9. Sistem Like
Write-Host "9. SISTEM LIKE"
Open-URL "http://localhost:8000"
Write-Host "Focus on like buttons in articles..."
Start-Sleep -Seconds 2
Capture-BrowserWindow "09-sistem-like.png" "Artikel dengan tombol like"

# 10. Notifikasi
Write-Host "10. NOTIFIKASI"
Open-URL "http://localhost:8000/dashboard"
Write-Host "Please click the notification bell icon in navbar"
Read-Host "Press Enter after opening notification dropdown..."
Capture-BrowserWindow "10-notifikasi.png" "Dropdown notifikasi"

# 11. Tips dan Trik
Write-Host "11. TIPS DAN TRIK"
Open-URL "http://localhost:8000/dashboard"
Capture-BrowserWindow "11-tips-trik.png" "Dashboard showing various features"

# 12. Troubleshooting
Write-Host "12. TROUBLESHOOTING"
Open-URL "http://localhost:8000/login"
Capture-BrowserWindow "12-troubleshooting.png" "Login page for troubleshooting example"

Write-Host ""
Write-Host "============================================"
Write-Host "         SCREENSHOT COMPLETED!"
Write-Host "============================================"
Write-Host ""

# List all screenshots
Write-Host "Screenshots created:"
Get-ChildItem "screenshots\*.png" | Sort-Object Name | ForEach-Object {
    $size = [math]::Round($_.Length/1KB, 1)
    Write-Host "✓ $($_.Name) - $size KB"
}

# Open screenshots folder
Write-Host ""
Write-Host "Opening screenshots folder..."
Start-Process "explorer" "screenshots"

Read-Host "Press Enter to exit"