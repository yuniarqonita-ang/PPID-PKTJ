# 🚀 PANDUAN LENGKAP MIGRASI LARAVEL KE CPANEL (PPID PKTJ)

Panduan ini dibuat khusus untuk mempermudah migrasi website PPID PKTJ dari server lokal (Laragon/XAMPP) ke hosting cPanel agar website bisa online dan diakses publik.

---

## 📋 PRE-REQUISITES (YANG SUDAH DISIAPKAN)

1. **Database Export (`database.sql`)**: 
   Database lokal Anda (`db_ppid_final`) telah diekspor secara otomatis ke file [database.sql](database.sql) di direktori utama project. File ini siap di-import ke cPanel.
2. **Template File `.env` untuk Produksi**:
   Sebuah file khusus bernama [.env.production](.env.production) telah dibuat dengan parameter produksi yang aman (`APP_DEBUG=false`, dll.) dan siap digunakan sebagai referensi di server.
3. **Akun Admin PPID**:
   Akun administrator untuk login panel admin sudah terkonfirmasi aktif di database:
   * **Username (Email):** `admin@pktj.ac.id`
   * **Password:** `admin123`

---

## 🛠️ LANGKAH-LANGKAH MIGRASI KE CPANEL

Berikut adalah 5 langkah mudah untuk membuat website PPID PKTJ Anda online:

### 1. Ekspor & Impor Database ke phpMyAdmin cPanel

> **CATATAN**: Karena database lokal Anda sudah diekspor ke file `database.sql`, Anda tidak perlu melakukan ekspor lagi di lokal. Cukup unduh atau ambil file tersebut saat mengunggah.

1. **Masuk ke cPanel** akun hosting Anda.
2. Cari menu **MySQL® Database Wizard** (Wizard Database MySQL).
3. Buat database baru (misal: `pktjacid_db_ppid`). *Catatan: cPanel akan otomatis menambahkan prefix username cPanel di depan nama database Anda.*
4. Buat user database baru (misal: `pktjacid_user_ppid`) dan buat password yang kuat. Catat password ini!
5. Hubungkan user ke database tersebut dengan mencentang **ALL PRIVILEGES** (Semua Hak Akses).
6. Kembali ke dashboard cPanel, buka **phpMyAdmin**.
7. Pilih nama database yang baru Anda buat di menu sebelah kiri.
8. Klik tab **Import** di bagian atas, pilih file `database.sql` dari komputer Anda, lalu klik **Go** atau **Import**. Semua tabel dan data admin akan masuk.

---

### 2. Mempersiapkan File Project (Compress ke .ZIP)

Sebelum diunggah, compress file project di komputer Anda menjadi satu file `.zip`:
1. Buka folder `c:\laragon\www\PPID-PKTJ`.
2. Blok seluruh file di dalamnya, klik kanan, lalu pilih **Send to > Compressed (zipped) folder** atau gunakan WinRAR/7-Zip untuk membuat file zip (misal: `ppid-pktj.zip`).
   * **PENTING**: Pastikan Anda meng-compress **isi** dari folder `PPID-PKTJ`, bukan folder utamanya, agar struktur folder langsung berada di root zip.
   * Abaikan folder `node_modules` saat meng-zip untuk menghemat ukuran file (folder tersebut hanya digunakan di lokal untuk development).

---

### 3. Mengunggah File ke cPanel

Ada 2 metode yang bisa digunakan untuk struktur folder di cPanel:

#### 💡 METODE A: Metode Satu Folder (Termudah & Terpopuler)
Metode ini sangat mudah karena semua file ditaruh langsung di dalam folder web utama (`public_html`).

1. Buka **File Manager** di cPanel, lalu masuk ke folder `public_html`.
2. Klik **Upload** di bagian atas, lalu pilih file `ppid-pktj.zip` yang telah Anda buat.
3. Setelah selesai diunggah, klik kanan file `.zip` tersebut di File Manager dan pilih **Extract**.
4. Di folder `public_html`, buat sebuah file bernama `.htaccess` di tingkat paling luar (sejajar dengan folder `app`, `bootstrap`, `public`).
5. Isi file `.htaccess` tersebut dengan kode pengalihan berikut agar URL otomatis mengarah ke folder `public`:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine on
       RewriteCond %{REQUEST_URI} !^/public
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```

#### 🛡️ METODE B: Metode Pemisahan Folder (Paling Aman untuk Laravel)
Metode ini adalah standar keamanan Laravel, memisahkan core program di luar folder publik agar kode program Anda aman dari akses browser luar.

1. Buka **File Manager** cPanel. Anda akan berada di direktori home Anda (di luar `public_html`, misal di `/home/username/`).
2. Buat folder baru bernama `laravel-core` sejajar dengan `public_html`.
3. Upload `ppid-pktj.zip` ke dalam folder `laravel-core` dan **Extract**.
4. Pindahkan **seluruh isi** yang ada di dalam folder `laravel-core/public/` ke dalam folder `public_html` cPanel Anda.
5. Edit file `public_html/index.php` yang baru dipindahkan tadi. Ubah baris berikut agar merujuk ke folder `laravel-core`:
   * **Baris 35**:
     ```diff
     - require __DIR__.'/../vendor/autoload.php';
     + require __DIR__.'/../laravel-core/vendor/autoload.php';
     ```
   * **Baris 48**:
     ```diff
     - $app = require_once __DIR__.'/../bootstrap/app.php';
     + $app = require_once __DIR__.'/../laravel-core/bootstrap/app.php';
     ```

---

### 4. Mengonfigurasi `.env` di cPanel

1. Di File Manager cPanel, cari file `.env` (jika menggunakan Metode A, letaknya di `public_html/.env`. Jika menggunakan Metode B, letaknya di `laravel-core/.env`).
   *Catatan: Jika file `.env` tidak terlihat, klik tombol **Settings** di kanan atas File Manager dan centang **Show Hidden Files (dotfiles)**.*
2. Edit file `.env` tersebut dan ubah konfigurasinya seperti template di `.env.production`:
   ```ini
   APP_NAME="PPID PKTJ"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://nama-domain-anda.com # Ganti dengan domain website Anda
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_cpanel_anda   # Sesuai yang Anda buat di Langkah 1
   DB_USERNAME=nama_user_database_cpanel  # Sesuai yang Anda buat di Langkah 1
   DB_PASSWORD=password_database_cpanel   # Sesuai yang Anda buat di Langkah 1
   ```
3. Simpan perubahan file `.env`.

---

### 5. Membuat Symbolic Link (`storage:link`) di cPanel

Di Laravel, file upload disimpan di folder `storage` dan membutuhkan shortcut (symbolic link) ke folder `public`. Karena Anda tidak memiliki terminal SSH di cPanel shared hosting biasa, gunakan trik **Cron Jobs** berikut:

1. Di cPanel, cari menu **Cron Jobs** (Tugas Cron).
2. Di bagian **Common Settings**, pilih **Once per minute** (`* * * * *`).
3. Pada kolom **Command**, masukkan perintah PHP berikut sesuai metode yang Anda pilih:
   * **Jika menggunakan Metode A (Satu Folder):**
     ```bash
     ln -s /home/usernamecpanel/public_html/storage/app/public /home/usernamecpanel/public_html/public/storage
     ```
   * **Jika menggunakan Metode B (Pemisahan Folder):**
     ```bash
     ln -s /home/usernamecpanel/laravel-core/storage/app/public /home/usernamecpanel/public_html/storage
     ```
     *(Ganti `usernamecpanel` dengan username cPanel hosting Anda yang asli, Anda bisa melihat username ini di dashboard utama cPanel sebelah kanan).*
4. Klik **Add New Cron Job**.
5. Tunggu 1 menit, setelah symlink terbentuk, segera **Hapus** cron job tersebut agar tidak terus berjalan.

---

## 🚀 OPTIMASI & VERIFIKASI AKHIR

Setelah semua terunggah dan terkonfigurasi, pastikan Anda melakukan hal berikut agar website berjalan sangat cepat dan tanpa kendala:

1. **Bersihkan Cache di Produksi**:
   Jika Anda melihat perubahan di web cPanel tidak muncul, Anda bisa membuat rute sementara di `routes/web.php` untuk membersihkan cache:
   ```php
   Route::get('/clear-cache', function() {
       Artisan::call('config:cache');
       Artisan::call('route:cache');
       Artisan::call('view:cache');
       return "Cache cleared successfully!";
   });
   ```
   Akses `https://domain-anda.com/clear-cache` di browser satu kali, lalu hapus kembali rute tersebut demi alasan keamanan.
2. **Uji Coba Login Admin**:
   Akses halaman admin di `https://domain-anda.com/admin/login` (atau `https://domain-anda.com/login`) dan gunakan kredensial berikut:
   * **Email:** `admin@pktj.ac.id`
   * **Password:** `admin123`
3. **Coba Upload Gambar / Dokumen**:
   Coba upload foto profil PPID atau regulasi di admin panel untuk memastikan symbolic link folder `storage` yang kita buat di Langkah 5 sudah bekerja dengan sempurna dan file bisa diakses publik.
