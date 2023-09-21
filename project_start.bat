@echo off
cd /d %~dp0

@REM start /B cmd /C "npm run dev"
@REM timeout /t 5 >nul

start /min cmd /C "php artisan serve --port=8001"

timeout /t 5 >nul

start microsoft-edge:http://localhost:8001/
