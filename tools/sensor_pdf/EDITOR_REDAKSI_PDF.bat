@echo off
chcp 65001 > nul
title Editor Redaksi PDF — PPID PKTJ

echo ================================================
echo   EDITOR REDAKSI PDF — PPID PKTJ
echo   Blok Teks + Gambar Kotak + Flatten
echo ================================================
echo.

echo [1/3] Mengecek Python...
python --version > nul 2>&1
if errorlevel 1 (
    echo [ERROR] Python tidak ditemukan!
    echo Unduh Python di: https://www.python.org/ftp/python/3.10.11/python-3.10.11-amd64.exe
    pause
    exit /b 1
)
echo Python OK.

echo [2/3] Mengecek library...
python -c "import fitz; from PIL import Image" > nul 2>&1
if errorlevel 1 (
    echo Menginstal library yang dibutuhkan...
    pip install PyMuPDF Pillow
)
echo Library OK.

echo [3/3] Membuka Editor Redaksi PDF...
python "%~dp0editor_redaksi_pdf.py"

if errorlevel 1 (
    echo.
    echo [ERROR] Aplikasi berhenti dengan error.
    pause
)
