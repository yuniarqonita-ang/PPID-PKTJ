@echo off
title Sensor PDF Otomatis - PPID PKTJ
color 0A
echo.
echo  =====================================================
echo    SENSOR PDF OTOMATIS - PPID PKTJ
echo    Installer dan Peluncur Aplikasi
echo  =====================================================
echo.
echo  [1/3] Mengecek Python...
python --version >nul 2>&1
if errorlevel 1 (
    color 0C
    echo  [ERROR] Python tidak ditemukan!
    echo  Silakan install Python dari: https://www.python.org/downloads/
    echo  Pastikan centang "Add Python to PATH" saat install!
    pause
    exit
)
python --version
echo  Python ditemukan! OK.
echo.

echo  [2/3] Menginstall library yang dibutuhkan...
pip install pymupdf pillow -q
if errorlevel 1 (
    color 0C
    echo  [ERROR] Gagal install library!
    echo  Pastikan komputer terhubung ke internet.
    pause
    exit
)
echo  Library OK!
echo.

echo  [3/3] Menjalankan Aplikasi Sensor PDF...
echo.
python "%~dp0sensor_pdf.py"

if errorlevel 1 (
    color 0C
    echo.
    echo  [ERROR] Aplikasi berhenti dengan error.
    echo  Pastikan file sensor_pdf.py ada di folder yang sama.
    pause
)
