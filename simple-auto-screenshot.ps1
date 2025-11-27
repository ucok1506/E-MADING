# Simple Auto Screenshot
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

# Ensure screenshots directory exists
if (!(Test-Path "screenshots")) {
    New-Item -ItemType Directory -Path "screenshots"
    Write-Host "Created screenshots directory"
}

# Simple screenshot function
function Take-Screenshot {
    param($name)
    Write-Host "Taking screenshot: $name"
    Start-Sleep -Seconds 2
    
    $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size)
    $bitmap.Save("screenshots\$name", [System.Drawing.Imaging.ImageFormat]::Png)
    $graphics.Dispose()
    $bitmap.Dispose()
    
    Write-Host "Saved: screenshots\$name"
}

Write-Host "AUTO SCREENSHOT E-MADING"
Write-Host "========================"

# Start Laravel server
Write-Host "Starting server..."
Start-Process -FilePath "php" -ArgumentList "artisan", "serve" -WindowStyle Hidden
Start-Sleep -Seconds 3

# Open browser
Write-Host "Opening browser..."
Start-Process "http://localhost:8000"
Start-Sleep -Seconds 5

# Take screenshots
Write-Host "Taking screenshots..."

Take-Screenshot "01-pengenalan-aplikasi.png"
Start-Process "http://localhost:8000/login"
Start-Sleep -Seconds 3
Take-Screenshot "02-login-sistem.png"

Write-Host ""
Write-Host "Login manually with: admin@smk.sch.id / admin123"
Read-Host "Press Enter after login..."

Start-Process "http://localhost:8000/dashboard"
Start-Sleep -Seconds 3
Take-Screenshot "03-dashboard-pengguna.png"

Start-Process "http://localhost:8000/mading/create"
Start-Sleep -Seconds 3
Take-Screenshot "04-membuat-artikel.png"

Start-Process "http://localhost:8000/mading"
Start-Sleep -Seconds 3
Take-Screenshot "05-mengelola-artikel.png"

Write-Host ""
Write-Host "Screenshots completed!"

# List files
Write-Host "Files created:"
Get-ChildItem "screenshots\*.png" | ForEach-Object {
    Write-Host "- $($_.Name)"
}

# Open folder
Write-Host "Opening screenshots folder..."
Invoke-Item "screenshots"

Read-Host "Press Enter to exit"