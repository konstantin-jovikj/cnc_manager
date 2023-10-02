@echo off
cd /d %~dp0

@REM start /B cmd /C "npm run dev"
@REM timeout /t 5 >nul

start /min cmd /C "php artisan serve --port=8002"

timeout /t 5 >nul

@REM start chrome http://localhost:8002/
start chrome --user-data-dir="%TEMP%\chrome_temp_profile" --disable-extensions --disable-plugins http://localhost:8002/
