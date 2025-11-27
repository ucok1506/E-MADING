@echo off
echo Clearing Laravel cache...
cd /d "c:\xampp\htdocs\mading"

php artisan cache:clear
php artisan config:clear  
php artisan route:clear
php artisan view:clear

echo.
echo Cache cleared!
echo Now:
echo 1. Close ALL browser tabs
echo 2. Clear browser cache (Ctrl+Shift+Delete)
echo 3. Open browser in Incognito mode (Ctrl+Shift+N)
echo 4. Access: http://localhost/mading/public/home
echo.
pause
