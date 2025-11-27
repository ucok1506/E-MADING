@echo off
echo ========================================
echo    AUTO SCREENSHOT E-MADING
echo ========================================

REM Create screenshots folder
if not exist "screenshots" mkdir screenshots

REM Start Laravel server
echo Starting Laravel server...
start /B php artisan serve
timeout /t 3 /nobreak >nul

REM Take screenshots using PowerShell
echo Taking screenshots...

REM Home page
start http://localhost:8000
timeout /t 3 /nobreak >nul
powershell -Command "Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\01-home-page.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot 1: Home page saved'"

REM Login page
start http://localhost:8000/login
timeout /t 3 /nobreak >nul
powershell -Command "Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\02-login-page.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot 2: Login page saved'"

echo.
echo Manual login required:
echo Username: admin@smk.sch.id
echo Password: admin123
pause

REM Dashboard (after login)
start http://localhost:8000/dashboard
timeout /t 3 /nobreak >nul
powershell -Command "Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\03-dashboard.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot 3: Dashboard saved'"

REM Create article
start http://localhost:8000/mading/create
timeout /t 3 /nobreak >nul
powershell -Command "Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\04-create-article.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot 4: Create article saved'"

REM Manage articles
start http://localhost:8000/mading
timeout /t 3 /nobreak >nul
powershell -Command "Add-Type -AssemblyName System.Windows.Forms; Add-Type -AssemblyName System.Drawing; $bounds = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds; $bitmap = New-Object System.Drawing.Bitmap $bounds.Width, $bounds.Height; $graphics = [System.Drawing.Graphics]::FromImage($bitmap); $graphics.CopyFromScreen(0, 0, 0, 0, $bounds.Size); $bitmap.Save('screenshots\05-manage-articles.png', [System.Drawing.Imaging.ImageFormat]::Png); $graphics.Dispose(); $bitmap.Dispose(); Write-Host 'Screenshot 5: Manage articles saved'"

echo.
echo Screenshots completed!
echo Opening screenshots folder...

REM Open screenshots folder
start explorer screenshots

echo.
echo Files created:
dir screenshots\*.png /b

pause