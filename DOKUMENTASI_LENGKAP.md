# 📋 DOKUMENTASI LENGKAP SISTEM PPID PKTJ

## 📌 Ringkasan Proyek

Sistem Portal PPID PKTJ adalah platform terintegrasi untuk pengelolaan dan publikasi informasi publik Politeknik Keselamatan Transportasi Jalan. Sistem ini terdiri dari:
- **Admin Panel** (Back Office) - Untuk pengelolaan konten
- **Public Website** - Untuk akses informasi publik
- **User Registration** - Untuk permohonan informasi

---

## 🗂️ Struktur File & Database

### Database Structure
```
profil_ppids table
├── id (Primary Key)
├── type (ENUM: profil, tugas, visi, struktur, regulasi, kontak) - UNIQUE
├── judul VARCHAR(255)
├── konten_pembuka LONGTEXT
├── konten_detail LONGTEXT
├── judul_sub VARCHAR(255) - NULLABLE
├── gambar VARCHAR(255) - NULLABLE
├── link_dokumen VARCHAR(255) - NULLABLE
├── created_at TIMESTAMP
└── updated_at TIMESTAMP
```

### File Storage
```
storage/app/public/profil/
├── [timestamp]_profil.jpg
├── [timestamp]_tugas.jpg
├── [timestamp]_visi.jpg
├── [timestamp]_struktur.jpg
├── [timestamp]_regulasi.jpg
└── [timestamp]_kontak.jpg
```

---

## 🎯 FITUR UTAMA

### 1. Admin Dashboard Profil PPID
**URL**: `/admin/profil`  
**Controller**: `ProfilPpidController@index`  
**View**: `resources/views/admin/profil/index.blade.php`

**Features**:
- Dashboard dengan 6 card yang mewakili setiap section
- Color-coded untuk identifikasi visual
- Status konten (Ada/Belum)
- Quick link ke edit form untuk masing-masing section

### 2. Admin Edit Form
**URL**: `/admin/profil/{type}` (profil, tugas, visi, struktur, regulasi, kontak)  
**Controller**: `ProfilPpidController@edit` & `@update`  
**View**: `resources/views/admin/profil/edit.blade.php`

**Features**:
- TinyMCE Rich Text Editor v6
- Upload gambar dengan preview
- Validasi form server-side
- Delete gambar dengan checkbox
- Tips & guidelines di sidebar

**Form Fields**:
```
Kolom Kiri (8/12):
├── Judul Halaman (required)
├── Konten Utama (TinyMCE)
├── Judul Bagian Tambahan (optional)
├── Konten Bagian Tambahan (TinyMCE)
└── Link Dokumen (untuk regulasi, optional)

Kolom Kanan (4/12):
├── Gambar Upload
├── Delete Checkbox
└── Tips Card
```

### 3. Public Pages
Semua halaman dinamis dan mengambil data dari database:

| Definisi | URL | View |
|----------|-----|------|
| Profil PPID | `/profil` | `profil-ppid.blade.php` |
| Tugas & Tanggung Jawab | `/profil/tugas` | `profil-tugas-tanggung-jawab.blade.php` |
| Visi & Misi | `/profil/visi` | `profil-visi-misi.blade.php` |
| Struktur Organisasi | `/profil/struktur` | `profil-struktur-organisasi.blade.php` |
| Regulasi | `/profil/regulasi` | `profil-regulasi.blade.php` |
| Kontak | `/profil/kontak` | `profil-kontak.blade.php` |

### 4. Document Preview Modal
**Lokasi**: `resources/views/profil-regulasi.blade.php`  

**Features**:
- Automatic Google Drive link conversion
- Inline preview (tidak buka tab baru)
- Modal overlay dengan close button
- Close dengan Escape key atau klik luar modal
- Support untuk PDF, Google Docs, dan format lainnya

**Contoh Usage**:
```blade
<button onclick="openDocumentPreview('https://drive.google.com/...')">
    Preview Dokumen
</button>
```

### 5. Permohonan Informasi
**URL**: `/permohonan`  
**View**: `resources/views/permohonan.blade.php`  

**Form Fields**:
- Username, Nama Lengkap
- Jenis & Nomor Identitas
- Alamat, No. Telepon
- Pekerjaan, Instansi
- Email, Password, Konfirmasi Password
- CAPTCHA
- Checkbox pernyataan

---

## 🔧 TECHNOLOGY STACK

### Backend
- **Framework**: Laravel 12
- **Database**: MySQL
- **Authentication**: Laravel Built-in

### Frontend
- **CSS Framework**: Bootstrap 5.3
- **Rich Text Editor**: TinyMCE 6
- **Icons**: Font Awesome 6.4
- **HTTP Client**: Fetch API

### Backend Dependencies
- `composer.json` - PHP dependencies
- `package.json` - Node dependencies

---

## 📊 ROUTING STRUCTURE

```
Routes (web.php)
│
├── HOME
│   └── GET / → welcome (public landing page)
│
├── AUTH
│   ├── GET /login → login form
│   ├── POST /login → process login
│   └── POST /logout → process logout
│
├── ADMIN (middleware:auth)
│   └── /admin
│       ├── GET dashboard → DashboardController@index
│       ├── /profil
│       │   ├── GET / → ProfilPpidController@index (dashboard)
│       │   ├── GET /{type} → ProfilPpidController@edit
│       │   ├── PUT /{type} → ProfilPpidController@update
│       │   └── DELETE /{type} → ProfilPpidController@destroy
│       ├── /informasi
│       │   ├── /berkala, /sertamerta, /setiapsaat, /dikecualikan
│       ├── /berita (CRUD)
│       ├── /dokumen (CRUD)
│       ├── /prosedur (CRUD)
│       ├── /faq (CRUD)
│       └── /user-management
│
└── PUBLIC (Frontend)
    ├── GET / → welcome page
    ├── /profil
    │   ├── GET / → ProfilPublikController@showProfil
    │   ├── GET /tugas → ProfilPublikController@showTugas
    │   ├── GET /visi → ProfilPublikController@showVisi
    │   ├── GET /struktur → ProfilPublikController@showStruktur
    │   ├── GET /regulasi → ProfilPublikController@showRegulasi
    │   └── GET /kontak → ProfilPublikController@showKontak
    ├── GET /faq → FaqController@index
    └── GET /permohonan → permohonan form
```

---

## 💾 HOW TO SETUP

### Prerequisites
```
- PHP 8.2 atau lebih tinggi
- MySQL 8.0+
- Composer
- Node.js & npm
```

### Installation Steps

1. **Clone & Install Dependencies**
```bash
cd c:\laragon\www\PPID-PKTJ
composer install
npm install
```

2. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database Configuration**
Buka `.env` dan setup:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppid_pktj
DB_USERNAME=root
DB_PASSWORD=
```

4. **Run Migrations**
```bash
php artisan migrate --force
```

5. **Create Storage Link**
```bash
php artisan storage:link
```

6. **Seed Default Data** (Optional)
```bash
php artisan seed:run
```

7. **Start Development Server**
```bash
php artisan serve
npm run dev
```

8. **Access Application**
- Admin: `http://localhost:8000/admin`
- Public: `http://localhost:8000`

---

## 👤 USER AUTHENTICATION

### Login Credentials
```
Email: admin@pktj.ac.id
Password: password
```

(Setup user baru dapat dilakukan melalui artisan command atau database seeding)

### Commands
```bash
# Create new user
php artisan tinker
>>> App\Models\User::create(['name' => 'Admin', 'email' => 'admin@pktj.ac.id', 'password' => Hash::make('password')])

# Reset password
>>> $user = App\Models\User::find(1)
>>> $user->password = Hash::make('newpassword')
>>> $user->save()
```

---

## 📝 CONTENT MANAGEMENT

### Mengelola Profil PPID

1. **Login ke Admin Panel**
   - Go to `/login`
   - Enter credentials

2. **Navigate to Profil**
   - Click `/admin/profil` atau menu sidebar

3. **Select Section**
   - Klik salah satu dari 6 card (Profil, Tugas, Visi, Struktur, Regulasi, Kontak)

4. **Edit Content**
   - Fill form fields:
     - **Judul**: Main heading untuk halaman
     - **Konten Utama**: Main content dengan formatting
     - **Judul Sub**: Optional subtitle
     - **Konten Detail**: Additional content dengan formatting
     - **Gambar**: Upload image (auto resized)
     - **Link Dokumen**: (untuk Regulasi saja)

5. **Use TinyMCE Editor**
   - **Bold/Italic**: Toolbar buttons
   - **Lists**: Numbered atau bulleted lists
   - **Tables**: Insert table dengan customize
   - **Links**: Tambah hyperlink
   - **Images**: Upload atau embed image
   - **Alignment**: Left, Center, Right align

6. **Save Changes**
   - Click "Simpan Perubahan" button

---

## 🎨 CUSTOMIZATION GUIDE

### Mengubah Color Scheme
Edit file `STYLING_GUIDE.md` untuk detail lengkap. Warna-warna utama:
- Primary: `#004a99` (di resources/views/*)
- Secondary: `#ffc107`

### Menambah TinyMCE Plugins
Edit `resources/views/admin/profil/edit.blade.php`:
```javascript
plugins: 'anchor autolink ...newplugin...',
// Tambah ke toolbar seperlunya
```

### Custom Validation Rules
Edit `ProfilPpidController@update()`:
```php
$validated = $request->validate([
    'judul' => 'required|string|custom_rule',
    // ... add more rules
]);
```

---

## 🐛 TROUBLESHOOTING

### 1. File upload tidak berfungsi
```bash
# Check storage link
php artisan storage:link

# Check permissions
chmod -R 775 storage/app/public
```

### 2. Database connection error
```bash
# Check .env DB settings
php artisan tinker
>>> DB::connection()->getPdo()
```

### 3. Routes not working
```bash
# Clear route cache
php artisan route:clear
php artisan cache:clear

# Test routes
php artisan route:list
```

### 4. TinyMCE not loading
- Check internet connection (CDN)
- Check browser console for errors
- Try different browser

---

## 📱 RESPONSIVE DESIGN

### Breakpoints
- **Mobile**: < 576px
- **Tablet**: 576px - 992px
- **Desktop**: > 992px

### Mobile Optimization
- Sidebar collapses pada mobile
- Cards stack vertically
- Form fields full width
- Touch-friendly button sizes

---

## 🔐 SECURITY CONSIDERATIONS

### CSRF Protection
- Laravel CSRF token included in all forms
- `@csrf` directive in Blade templates

### SQL Injection Prevention
- Using Eloquent ORM (no raw queries)
- Prepared statements automatically

### File Upload Security
- File type validation (images only for gambar)
- File size limits (5MB)
- Files stored outside public directory

### Password Security
- Minimum 8 characters required
- Hash using bcrypt
- Confirm password field

---

## 📈 PERFORMANCE TIPS

1. **Enable Query Caching**
   ```php
   Cache::remember('profil-' . $type, 60*24, function() {
       return ProfilPpid::where('type', $type)->first();
   });
   ```

2. **Image Optimization**
   - Use `php artisan tinker` untuk resize images
   - Recommend: WebP format for web

3. **Minify Assets**
   ```bash
   npm run build  # Production build
   ```

4. **Database Indexing**
   - `type` column should be indexed (unique already)

---

## 📞 SUPPORT & MAINTENANCE

### Regular Maintenance
- Check error logs: `storage/logs/laravel.log`
- Monitor database size
- Backup database regularly
- Update dependencies

### Backup Strategy
```bash
# Database backup
mysqldump -u root ppid_pktj > backup_ppid_$(date +%Y%m%d).sql

# File backup
zip -r backup_ppid_$(date +%Y%m%d).zip .
```

### Updates
```bash
# Update dependencies
composer update
npm update

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [TinyMCE Documentation](https://www.tiny.cloud/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)

---

## ✨ CHANGELOG

### Version 1.0 - 2026-02-19
- ✅ Initial setup dengan 6 profil sections
- ✅ Admin panel dengan rich text editor
- ✅ Public pages dengan dynamic content
- ✅ Document preview modal
- ✅ User registration form
- ✅ Login page dengan logo

---

## 📄 LICENSE

© 2026 PPID PKTJ. All rights reserved.

---

**Last Updated**: 2026-02-19  
**Status**: ✅ Production Ready  
**Questions?** Hubungi tim IT PKTJ
