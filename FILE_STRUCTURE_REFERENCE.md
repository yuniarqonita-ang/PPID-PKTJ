# 📁 FILE STRUCTURE & REFERENCE GUIDE

> Quick reference for locating and understanding all project files

---

## 🗂️ ROOT LEVEL PROJECT FILES

```
c:\laragon\www\PPID-PKTJ\
├── README.md                           ← Project overview
├── QUICK_START.md                      ← 5-minute setup guide ⭐
├── DOKUMENTASI_LENGKAP.md              ← Complete documentation ⭐
├── STYLING_GUIDE.md                    ← Design system guide ⭐
├── IMPLEMENTATION_SUMMARY.md            ← Technical details ⭐
├── ARCHITECTURE_OVERVIEW.md             ← System design ⭐
├── PROJECT_COMPLETION_SUMMARY.md        ← Project completion status ⭐
├── FILE_STRUCTURE_REFERENCE.md          ← This file ⭐
│
├── artisan                              ← Laravel CLI tool
├── composer.json                        ← PHP dependencies
├── composer.lock                        ← Dependency lock file
├── package.json                         ← Node.js dependencies
├── package-lock.json                    ← Node lock file
├── phpunit.xml                          ← Testing configuration
├── vite.config.js                       ← Build configuration
│
├── app/                                 ← Application code
├── bootstrap/                           ← Bootstrap files
├── build/                               ← Build output
├── config/                              ← Configuration files
├── database/                            ← Database files
├── public/                              ← Public web root
├── resources/                           ← Views & assets
├── routes/                              ← Route definitions
├── storage/                             ← Storage directory
├── tests/                               ← Test files
└── vendor/                              ← Composer packages (not tracked)
```

---

## 📂 KEY DIRECTORIES & FILES

### `/app` - Application Code

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Controller.php               ← Base controller
│   │   ├── DashboardController.php      ← Admin dashboard
│   │   ├── ProfilPpidController.php     ← ⭐ CRITICAL - Admin CRUD for profiles
│   │   ├── ProfilPublikController.php   ← ⭐ CRITICAL - Public website content
│   │   ├── ProsedurController.php       ← Procedures controller
│   │   ├── FaqController.php            ← FAQ management
│   │   ├── DokumenController.php        ← Documents management
│   │   ├── BeritaController.php         ← News management
│   │   └── AuthController.php           ← Authentication
│   │
│   └── Requests/                        ← Form request validation
│       └── [validation classes]
│
├── Models/
│   ├── User.php                        ← User model (auth)
│   ├── ProfilPpid.php                  ← ⭐ CRITICAL - Profile model
│   ├── Dokumen.php                     ← Document model
│   ├── Berita.php                      ← News model
│   ├── Faq.php                         ← FAQ model
│   └── Permohonan.php                  ← Information request model
│
├── View/
│   └── Components/                     ← Reusable view components
│
└── Providers/
    ├── AppServiceProvider.php          ← Service provider
    └── RouteServiceProvider.php        ← Route service provider
```

**Key Files in `/app`**:
- **ProfilPpidController.php**: Admin panel CRUD operations
  - `index()`: Dashboard with 6 profile cards
  - `edit($type)`: Show edit form for specific section
  - `update($request, $type)`: Save form data
  - `destroy($type)`: Delete profile section
- **ProfilPublikController.php**: Public website content
  - `showProfil()`, `showTugas()`, `showVisi()`, etc.
  - Fetches data from database by type
- **ProfilPpid.php**: Eloquent model
  - Defines table, relationships, fillable fields

---

### `/database` - Database Files

```
database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 0001_01_01_000002_create_jobs_table.php
│   │
│   ├── 2026_01_29_081012_create_dokumens_table.php
│   ├── 2026_01_30_000000_create_permohonan_table.php
│   ├── 2026_01_30_000001_add_fields_to_permohonan_table.php
│   ├── 2026_02_18_000000_create_faqs_table.php
│   ├── 2026_02_18_033432_create_profil_ppids_table.php    ← ⭐ CRITICAL
│   └── 2026_02_18_033433_create_tugas_ppids_table.php
│
├── seeders/
│   └── DatabaseSeeder.php               ← Seed data script
│
├── factories/
│   └── UserFactory.php                  ← User factory
│
└── db_ppid_final.sql                    ← Database backup (optional)
```

**Key Migration**:
- **2026_02_18_033432_create_profil_ppids_table.php**: Creates profil_ppids table
  - Columns: id, type (enum), judul, konten_pembuka, konten_detail, judul_sub, gambar, link_dokumen, timestamps
  - Status: ✅ Executed (Batch 4)
  - Type values: profil, tugas, visi, struktur, regulasi, kontak

---

### `/routes` - Route Definitions

```
routes/
├── web.php                              ← ⭐ CRITICAL - Main route file
├── api.php                              ← API routes (if needed)
├── auth.php                             ← Authentication routes
└── console.php                          ← Console commands
```

**Key in `web.php`**:
```php
// Admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::name('profil.')->prefix('profil')->group(function () {
        Route::get('/', [ProfilPpidController::class, 'index'])->name('index');
        Route::get('/{type}', [ProfilPpidController::class, 'edit'])->name('edit');
        Route::put('/{type}', [ProfilPpidController::class, 'update'])->name('update');
        Route::delete('/{type}', [ProfilPpidController::class, 'destroy'])->name('destroy');
    });
});

// Public routes
Route::name('profil.')->prefix('profil')->group(function () {
    Route::get('/', [ProfilPublikController::class, 'showProfil'])->name('index');
    Route::get('/tugas', [ProfilPublikController::class, 'showTugas'])->name('tugas');
    Route::get('/visi', [ProfilPublikController::class, 'showVisi'])->name('visi');
    Route::get('/struktur', [ProfilPublikController::class, 'showStruktur'])->name('struktur');
    Route::get('/regulasi', [ProfilPublikController::class, 'showRegulasi'])->name('regulasi');
    Route::get('/kontak', [ProfilPublikController::class, 'showKontak'])->name('kontak');
});
```

---

### `/resources/views` - Template Files

```
resources/views/
├── admin/                               ← Admin templates
│   ├── dashboard.blade.php              ← Admin main dashboard
│   └── profil/
│       ├── index.blade.php              ← ⭐ 6 profile cards dashboard
│       └── edit.blade.php               ← ⭐ Edit form with TinyMCE
│
├── auth/                                ← Authentication
│   └── login.blade.php                  ← ⭐ Login page with logo
│
├── layouts/
│   └── app.blade.php                    ← Main layout template
│
├── navigation.blade.php                 ← ⭐ Public navigation menu
│
├── profil-ppid.blade.php                ← ⭐ Public: Profil page
├── profil-visi-misi.blade.php           ← ⭐ Public: Visi & Misi page
├── profil-tugas-tanggung-jawab.blade.php ← ⭐ Public: Tasks & Responsibilities
├── profil-struktur-organisasi.blade.php ← ⭐ Public: Organization Structure
├── profil-regulasi.blade.php            ← ⭐ Public: Regulations with modal preview
├── profil-kontak.blade.php              ← ⭐ Public: Contact page
│
├── faq.blade.php                        ← Public: FAQ page
├── permohonan.blade.php                 ← ⭐ Public: Registration form
│
└── [other view files]
```

**Critical Public Pages**:
These files display dynamic content from database:
- **profil-ppid.blade.php**: Displays `$profil` data with type='profil'
- **profil-visi-misi.blade.php**: Displays `$profil` data with type='visi'
- **profil-tugas-tanggung-jawab.blade.php**: Displays `$profil` data with type='tugas'
- **profil-struktur-organisasi.blade.php**: Displays `$profil` data with type='struktur'
- **profil-regulasi.blade.php**: Displays `$profil` data with type='regulasi' + modal preview
- **profil-kontak.blade.php**: Displays `$profil` data with type='kontak'

**Admin Panels**:
- **admin/profil/index.blade.php**: 6 colorful cards showing all sections
- **admin/profil/edit.blade.php**: Form with TinyMCE editor and image upload

---

### `/resources/css` & `/resources/js` - Frontend Assets

```
resources/
├── css/
│   └── app.css                          ← Custom CSS
│
└── js/
    ├── app.js                           ← Main JS file
    ├── bootstrap.js                     ← Bootstrap initialization
    └── [other utility scripts]
```

---

### `/public` - Public Web Root

```
public/
├── index.php                            ← Entry point
├── robots.txt                           ← SEO robots file
├── tes.html                             ← Test file
│
├── images/
│   ├── logo-pktj.png                    ← ⭐ Logo used in login page
│   └── [other static images]
│
├── build/
│   ├── manifest.json                    ← Build manifest
│   └── assets/
│       ├── app-*.js                     ← Compiled JS
│       └── app-*.css                    ← Compiled CSS
│
└── [other public files]
```

**Note**: The `logo-pktj.png` file should be placed here at:
- Path: `public/images/logo-pktj.png`
- Referenced in: `resources/views/auth/login.blade.php`

---

### `/storage` - Storage Directory

```
storage/
├── app/
│   ├── public/
│   │   └── profil/
│   │       ├── [timestamp]_profil.jpg
│   │       ├── [timestamp]_tugas.jpg
│   │       ├── [timestamp]_visi.jpg
│   │       ├── [timestamp]_struktur.jpg
│   │       ├── [timestamp]_regulasi.jpg
│   │       └── [timestamp]_kontak.jpg
│   │
│   └── [other storage files]
│
├── framework/
│   ├── sessions/                        ← Session data
│   └── views/                           ← Compiled views
│
└── logs/
    └── laravel.log                      ← Error logs
```

**Note**: Must create symbolic link for public storage:
```bash
php artisan storage:link
```

---

### `/config` - Configuration Files

```
config/
├── app.php                              ← App configuration
├── auth.php                             ← Authentication settings
├── cache.php                            ← Cache settings
├── database.php                         ← Database connection
├── filesystems.php                      ← File storage settings
├── logging.php                          ← Logging configuration
├── mail.php                             ← Email settings
├── queue.php                            ← Queue settings
├── services.php                         ← Third-party services
└── session.php                          ← Session settings
```

**Important**: Edit `config/database.php` for MySQL connection settings if needed.

---

### `/tests` - Testing Files

```
tests/
├── TestCase.php                         ← Base test case
├── Feature/
│   └── [feature tests]
└── Unit/
    └── [unit tests]
```

---

## 🔑 CRITICAL FILES SUMMARY

### Must Know These Files ⭐

| File | Purpose | Action |
|------|---------|--------|
| `routes/web.php` | All route definitions | Define new routes here |
| `app/Http/Controllers/ProfilPpidController.php` | Admin backend | Edit for admin logic |
| `app/Http/Controllers/ProfilPublikController.php` | Public website | Edit for public logic |
| `app/Models/ProfilPpid.php` | Database model | Define relationships |
| `resources/views/admin/profil/index.blade.php` | Admin dashboard | Design admin panel |
| `resources/views/admin/profil/edit.blade.php` | Admin edit form | Design edit form |
| `resources/views/profil-*.blade.php` | Public pages | Display public content |
| `database/migrations/2026_02_18_033432_create_profil_ppids_table.php` | Database schema | Define tables |
| `.env` | Environment configuration | Set DB credentials |
| `resources/views/navigation.blade.php` | Navigation menu | Add menu items |

---

## 📋 FILE EDITING CHECKLIST

### When You Need to...

**Add a new profile section** (beyond 6 existing):
1. ✏️ Edit `database/migrations/*_create_profil_ppids_table.php`
2. ✏️ Edit `routes/web.php` - add new route
3. ✏️ Edit `ProfilPpidController.php` - update methods
4. ✏️ Edit `ProfilPublikController.php` - add show method
5. ✏️ Create new view file `resources/views/profil-*.blade.php`

**Change styling/design**:
1. ✏️ Edit `resources/css/app.css` for custom CSS
2. ✏️ Edit blade files for HTML structure
3. ✏️ Update `STYLING_GUIDE.md` for documentation

**Add new database table**:
1. ✏️ Create migration: `php artisan make:migration create_table_name`
2. ✏️ Edit migration file in `database/migrations/`
3. ✏️ Create model: `php artisan make:model ModelName`
4. ✏️ Edit model in `app/Models/`

**Change admin menu**:
1. ✏️ Edit `resources/views/navigation.blade.php` (public menu)
2. ✏️ Edit `resources/views/layouts/app.blade.php` (admin menu)
3. ✏️ Update `routes/web.php` if adding new routes

**Update documentation**:
1. ✏️ QUICK_START.md - for quick tasks
2. ✏️ DOKUMENTASI_LENGKAP.md - for detailed info
3. ✏️ STYLING_GUIDE.md - for design changes
4. ✏️ IMPLEMENTATION_SUMMARY.md - for technical details

---

## 🔍 FILE SEARCH TIPS

### When looking for...

| What | Look In | Search For |
|------|----------|------------|
| Admin controller logic | `ProfilPpidController.php` | Method names |
| Public content logic | `ProfilPublikController.php` | Method names |
| Database table definition | `database/migrations/2026_02_18_033432_*` | Schema |
| Admin form HTML | `resources/views/admin/profil/edit.blade.php` | Input fields |
| Public page content | `resources/views/profil-*.blade.php` | Template structure |
| Route definitions | `routes/web.php` | Route::get/post |
| Navigation menu | `resources/views/navigation.blade.php` | Links |
| Styling | `resources/css/app.css` | Class names |
| JavaScript | `resources/js/app.js` | Function names |
| Modal preview | `resources/views/profil-regulasi.blade.php` | openDocumentPreview |

---

## 📊 FILE DEPENDENCY MAP

```
Entry Point
    └── public/index.php
        └── bootstrap/app.php
            └── routes/web.php
                ├── ProfilPpidController.php
                │   └── Models/ProfilPpid.php
                │       └── database/migrations/*profil_ppids*
                │
                ├── ProfilPublikController.php
                │   └── Models/ProfilPpid.php
                │
                └── Views (blade templates)
                    ├── layouts/app.blade.php
                    ├── navigation.blade.php
                    ├── admin/profil/*.blade.php
                    └── profil-*.blade.php

CSS & JS
    ├── resources/css/app.css
    └── resources/js/app.js

Configuration
    ├── .env
    ├── config/app.php
    ├── config/database.php
    └── config/filesystems.php
```

---

## 🎯 COMMON FILE LOCATIONS

### I need to modify...

| Need | File Path |
|------|-----------|
| Admin form design | `/resources/views/admin/profil/edit.blade.php` |
| Admin dashboard design | `/resources/views/admin/profil/index.blade.php` |
| Public profil page | `/resources/views/profil-ppid.blade.php` |
| Database schema | `/database/migrations/2026_02_18_033432_create_profil_ppids_table.php` |
| Navigation menu | `/resources/views/navigation.blade.php` |
| Color scheme | `/resources/css/app.css` |
| Admin controller logic | `/app/Http/Controllers/ProfilPpidController.php` |
| Public controller logic | `/app/Http/Controllers/ProfilPublikController.php` |
| Model relationships | `/app/Models/ProfilPpid.php` |
| Routes | `/routes/web.php` |
| Login page | `/resources/views/auth/login.blade.php` |
| Registration form | `/resources/views/permohonan.blade.php` |
| Document preview modal | `/resources/views/profil-regulasi.blade.php` |

---

## ✅ FILE CHECKLIST

Before deployment, verify these files exist and are correct:

- ✅ `/routes/web.php` - All routes defined
- ✅ `/app/Http/Controllers/ProfilPpidController.php` - Admin CRUD
- ✅ `/app/Http/Controllers/ProfilPublikController.php` - Public display
- ✅ `/app/Models/ProfilPpid.php` - Model with relationships
- ✅ `/database/migrations/2026_02_18_033432_*` - Table schema
- ✅ `/resources/views/admin/profil/index.blade.php` - Admin dashboard
- ✅ `/resources/views/admin/profil/edit.blade.php` - Admin form
- ✅ `/resources/views/profil-ppid.blade.php` - Public profil
- ✅ `/resources/views/profil-visi-misi.blade.php` - Public visi
- ✅ `/resources/views/profil-tugas-tanggung-jawab.blade.php` - Public tugas
- ✅ `/resources/views/profil-struktur-organisasi.blade.php` - Public struktur
- ✅ `/resources/views/profil-regulasi.blade.php` - Public regulasi (with modal)
- ✅ `/resources/views/profil-kontak.blade.php` - Public kontak
- ✅ `/resources/views/permohonan.blade.php` - Registration form
- ✅ `/resources/views/navigation.blade.php` - Navigation menu
- ✅ `/resources/views/auth/login.blade.php` - Login with logo
- ✅ `/public/images/logo-pktj.png` - Logo file
- ✅ `/storage/app/public/profil/` - Image storage directory
- ✅ `.env` - Environment variables

---

**Last Updated**: 2026-02-19  
**File Count**: 25+  
**Critical Files**: 8  
**Status**: ✅ Complete

---

*Reference this guide when navigating the codebase or making modifications.*
