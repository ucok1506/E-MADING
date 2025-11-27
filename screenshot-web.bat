@echo off
echo ========================================
echo    AUTO SCREENSHOT E-MADING WEB
echo ========================================
echo.

REM Create screenshots folder
if not exist "screenshots" mkdir screenshots

echo Membuka browser dan mengambil screenshot...
echo.

REM Start Laravel server in background
echo Starting Laravel server...
start /B php artisan serve

REM Wait for server to start
timeout /t 5 /nobreak >nul

REM Open browser and take screenshots using built-in Windows tools
echo Membuka halaman web...

REM Use PowerShell to open browser and take screenshot
powershell -Command "& {Start-Process 'http://localhost:8000'; Start-Sleep 3; Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\home-page.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot home-page.png berhasil disimpan'}"

echo.
echo Screenshot berhasil diambil!
echo Cek folder screenshots/
echo.
pause