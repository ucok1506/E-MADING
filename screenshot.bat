@echo off
echo Memulai auto screenshot...
echo.
echo Pastikan:
echo 1. Laravel server berjalan (php artisan serve)
echo 2. Chrome browser terinstall
echo 3. Python + Selenium terinstall
echo.
pause

REM Install selenium jika belum ada
pip install selenium

REM Jalankan script
python auto-screenshot.py

pause