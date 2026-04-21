# 🚀 QUICK START GUIDE - PPID PKTJ

> Panduan singkat untuk memulai bekerja dengan sistem PPID PKTJ

---

## ⚡ 5 MENIT SETUP

### Step 1: Start the Application
```bash
cd c:\laragon\www\PPID-PKTJ

# Terminal 1 - Run Laravel
php artisan serve

# Terminal 2 - Run Frontend (di folder yang sama)
npm run dev
```

### Step 2: Access Admin
- **URL**: `http://localhost:8000/admin`
- **Email**: `admin@pktj.ac.id`
- **Password**: `password`

### Step 3: Go to Dashboard
- Click menu "Profil PPID"
- You'll see 6 colorful cards

---

## 💡 MOST COMMON TASKS

### 1️⃣ Add Content to Profil PPID

```
Admin → Profil PPID → Klik card "Profil PPID" → Edit
├─ Judul: Masukkan judul halaman
├─ Konten Utama: Ketik atau paste text (gunakan toolbar untuk format)
├─ Gambar: Drag & drop atau click upload
└─ Simpan
```

### 2️⃣ Edit Tugas & Tanggung Jawab

```
Admin → Profil PPID → Klik "Tugas & Tanggung Jawab" → Edit
├─ Buat daftar nomor: Tools → Lists → Numbered List
├─ Buat tabel: Tools → Insert Table
└─ Simpan
```

### 3️⃣ Upload Regulasi dengan Link

```
Admin → Profil PPID → Klik "Regulasi" → Edit
├─ Judul: "Regulasi PKTJ"
├─ Konten: Daftar peraturan
├─ Link Dokumen: Paste URL Google Drive atau PDF
├─ Upload Gambar: Thumbnail/icon peraturan
└─ Simpan
```

### 4️⃣ Lihat di Website Publik

```
Browser: http://localhost:8000
├─ Menu → Profil
│   ├─ Profil PPID
│   ├─ Tugas & Tanggung Jawab
│   ├─ Visi & Misi
│   ├─ Struktur Organisasi
│   ├─ Regulasi (dengan preview modal)
│   └─ Kontak
└─ Semua konten dari admin akan muncul otomatis
```

---

## 🎯 TOOLBAR DI RICH TEXT EDITOR

| Icon | Fungsi | Shortcut |
|------|--------|----------|
| **B** | Bold | Ctrl+B |
| *I* | Italic | Ctrl+I |
| U | Underline | Ctrl+U |
| ≡ | Lists | - |
| ⊞ | Table | - |
| 🔗 | Link | Ctrl+K |
| 🖼️ | Image | - |
| ≣ | Align | - |
| ○ | Format | Dropdown |

---

## 📁 FILE LOCATIONS

```
Browser                      File Location
─────────────────────────────────────────────────────────
Admin Dashboard              /admin                → admin/index.blade.php
Profil Edit Form             /admin/profil/{type} → admin/profil/edit.blade.php
Public Profil Page           /profil/             → profil-ppid.blade.php
Login Page                   /login               → auth/login.blade.php
Permohonan Form              /permohonan          → permohonan.blade.php
```

---

## 🐛 QUICK FIXES

### ❌ Upload gambar tidak berfungsi
```bash
php artisan storage:link
```

### ❌ Konten tidak muncul di public
```bash
# Cek database
php artisan tinker
>>> DB::table('profil_ppids')->get();
```

### ❌ "Route not found" error
```bash
php artisan route:clear
php artisan cache:clear
```

### ❌ TinyMCE tidak muncul
- Refresh browser (hard refresh: Ctrl+Shift+R)
- Check internet connection (CDN)
- Check browser F12 console for errors

---

## 📋 FORM FIELDS REFERENCE

### Profil PPID
- **Judul**: "Profil Politeknik Keselamatan..."
- **Konten Pembuka**: Executive summary / pengantar
- **Konten Detail**: Detail panjang tentang institusi
- **Gambar**: Logo atau foto gedung

### Tugas & Tanggung Jawab
- **Judul**: "Tugas dan Tanggung Jawab PPID"
- **Konten Pembuka**: Intro tentang tugas
- **Konten Detail**: Daftar tugas-tugas lengkap (gunakan Numbered List)
- **Gambar**: Optional

### Visi & Misi
- **Judul**: "Visi dan Misi PKTJ"
- **Konten Pembuka**: Visi
- **Konten Detail**: Misi point-by-point
- **Gambar**: Optional

### Struktur Organisasi
- **Judul**: "Struktur Organisasi"
- **Konten Pembuka**: Intro
- **Konten Detail**: Daftar dengan link ke profil/kontak
- **Gambar**: Diagram organisasi

### Regulasi
- **Judul**: "Peraturan & Regulasi"
- **Konten Pembuka**: Daftar peraturan
- **Konten Detail**: Detail teknis
- **Gambar**: Badge/icon
- **Link Dokumen**: URL Google Drive atau PDF

### Kontak
- **Judul**: "Hubungi Kami"
- **Konten Pembuka**: Alamat lengkap
- **Konten Detail**: Email, telepon, jam operasional
- **Gambar**: Foto kantor atau map

---

## 🔄 WORKFLOW DIAGRAM

```
Admin User
    ↓
Login (/login)
    ↓
Admin Dashboard (/admin)
    ↓
Pilih Section → Edit Form
    ↓
Fill Fields + Rich Text Editor
    ↓
Upload Image + Set Document Link
    ↓
Save (PUT request)
    ↓
Database Updated ✅
    ↓
Public Website Auto Updates
    ↓
Visitors see latest content
```

---

## 💾 IMPORT/EXPORT DATA

### Import konten lama ke database
```bash
php artisan tinker
>>> ProfilPpid::create([
    'type' => 'profil',
    'judul' => 'Profil PKTJ',
    'konten_pembuka' => 'Politeknik...',
    'konten_detail' => 'Detail...'
])
```

### Export semua konten
```bash
php artisan tinker
>>> $data = ProfilPpid::all();
>>> json_encode($data); // copy ke file untuk backup
```

---

## 🎨 QUICK STYLING TIPS

### Warna-warna yang digunakan:
- **Blue**: #004a99 (brand primary)
- **Yellow**: #ffc107 (accent)
- **Green**: #28a745 (success)
- **Red**: #dc3545 (danger)
- **Purple**: #6f42c1 (info)
- **Cyan**: #17a2b8 (secondary)

### Mengubah warna card di dashboard:
Edit: `resources/views/admin/profil/index.blade.php`
```html
<!-- Cari line yang berisi border-top: 4px solid -->
<div class="card border-top" style="border-top-color: #004a99;">
```

---

## 📞 HELP COMMANDS

```bash
# Lihat semua routes
php artisan route:list

# Lihat database migrations status
php artisan migrate:status

# Lihat installed packages
composer show
npm list

# Check for errors
php artisan tinker
>>> \Log::get()

# Database query in tinker
php artisan tinker
>>> DB::select("SELECT * FROM profil_ppids");
>>> ProfilPpid::all();
>>> ProfilPpid::where('type', 'profil')->first();
```

---

## ✅ CHECKLIST SEBELUM GO LIVE

- [ ] Semua 6 section sudah punya konten
- [ ] Gambar sudah di-upload
- [ ] Link dokumen sudah ditest
- [ ] Logo muncul di login page
- [ ] Public website terlihat bagus
- [ ] Mobile responsive
- [ ] Database sudah dibackup
- [ ] Admin user password sudah diganti
- [ ] Error log di-check (storage/logs/)

---

## 🎓 LEARNING RESOURCES

- Read: `DOKUMENTASI_LENGKAP.md` (comprehensive guide)
- Read: `STYLING_GUIDE.md` (UI/design details)
- Read: `IMPLEMENTATION_SUMMARY.md` (technical deep dive)

---

**Status**: ✅ Ready to Use  
**Last Updated**: 2026-02-19  
**Questions?** Check DOKUMENTASI_LENGKAP.md section "SUPPORT & MAINTENANCE"
