# 📊 FEATURE OVERVIEW & SYSTEM ARCHITECTURE

## 🏗️ SYSTEM ARCHITECTURE

```
┌─────────────────────────────────────────────────────────────────┐
│                        PPID PKTJ SYSTEM                          │
└─────────────────────────────────────────────────────────────────┘
                              │
                    ┌─────────┴──────────┐
                    ▼                    ▼
        ┌──────────────────┐  ┌─────────────────────┐
        │  PUBLIC WEBSITE  │  │  ADMIN PANEL        │
        │  (Frontend)      │  │  (Back Office)      │
        └──────────────────┘  └─────────────────────┘
                    │                    │
                    └─────────────┬──────┘
                                  ▼
                    ┌──────────────────────────┐
                    │  LARAVEL APPLICATION     │
                    │  (Business Logic)        │
                    └──────────────────────────┘
                                  │
                    ┌─────────────┴──────────────┐
                    ▼                            ▼
         ┌──────────────────┐      ┌──────────────────┐
         │  MySQL DATABASE  │      │  FILE STORAGE    │
         │  (profil_ppids)  │      │  (Images)        │
         └──────────────────┘      └──────────────────┘
```

---

## 🎯 FEATURE BREAKDOWN

### FEATURE 1: Dynamic Profile Content Management
```
Admin Inputs Content
        ↓
TinyMCE Rich Text Editor
        ↓
Database Storage (profil_ppids table)
        ↓
Auto-Update Public Pages
        ↓
Visitor sees latest content
```

**Related Files**:
- Controller: `ProfilPpidController.php` (Admin CRUD)
- Model: `ProfilPpid.php`
- Migration: `2026_02_18_033432_create_profil_ppids_table.php`
- Views: `admin/profil/*.blade.php`, `profil-*.blade.php`

---

### FEATURE 2: Rich Text Editing with TinyMCE
```
┌─────────────────────────────────┐
│    TinyMCE Editor Toolbar        │
├─────────────────────────────────┤
│ Bold | Italic | Lists | Tables  │
│ Link | Image | Alignment | ... │
├─────────────────────────────────┤
│                                 │
│   Editing Area                  │
│   (WYSIWYG - What you see       │
│    is what you get)             │
│                                 │
├─────────────────────────────────┤
│ Save | Cancel | Preview         │
└─────────────────────────────────┘
```

**Capabilities**:
- ✅ Text formatting (bold, italic, underline)
- ✅ Numbered & bulleted lists
- ✅ Tables (create, edit, delete)
- ✅ Links & images
- ✅ Alignment (left, center, right)
- ✅ Font sizes & colors
- ✅ Special characters & emoticons
- ✅ HTML preservation

**Related Files**:
- View: `resources/views/admin/profil/edit.blade.php` (TinyMCE initialization)
- Config: CDN URL in blade template

---

### FEATURE 3: Image Management
```
Desktop/Laptop File System
        ↓
Browser Upload
        ↓
Server Validation (size, type)
        ↓
Image Storage: storage/app/public/profil/
        ↓
Database Reference: `gambar` column
        ↓
Public Display via asset() helper
```

**Upload Process**:
1. User selects image (JPG, PNG, GIF)
2. Browser preview before save
3. Server validates (max 5MB)
4. File saved with timestamp prefix
5. Path stored in database
6. Public link generated automatically

**Delete Process**:
1. Check "Delete image" checkbox
2. Save form
3. Previous image deleted from storage
4. Database updated (NULL)

**Related Files**:
- Controller method: `ProfilPpidController@update()` (lines ~60-80)
- View: `edit.blade.php` (image upload section)

---

### FEATURE 4: Document Preview Modal
```
User clicks "Preview Dokumen" link
        ↓
JavaScript detects Google Drive URL
        ↓
Converts to /preview endpoint
        ↓
Display in Fullscreen Modal
        ├─ Embedded iframe
        ├─ Responsive sizing
        └─ Close buttons (X, Escape)
        ↓
No new tab opened ✓
```

**Supported Document Types**:
- Google Drive (Word, Excel, PowerPoint, PDF)
- PDF files
- Images
- Google Docs/Sheets/Slides

**URL Conversion Logic**:
```javascript
// Input: https://drive.google.com/file/d/FILE_ID/view
// Output: https://drive.google.com/file/d/FILE_ID/preview
// Display in <iframe src="OUTPUT_URL"></iframe>
```

**Related Files**:
- View: `resources/views/profil-regulasi.blade.php` (modal HTML + JS)

---

### FEATURE 5: Public Website
```
Visitor enters http://localhost:8000
        ↓
Laravel routes request
        ↓
ProfilPublikController fetches data
        ↓
Database query by type:
        ├─ SELECT * FROM profil_ppids WHERE type='profil'
        ├─ SELECT * FROM profil_ppids WHERE type='tugas'
        └─ etc...
        ↓
Blade template renders {!! $profil->content !!}
        ↓
Beautiful responsive page
```

**Pages**:
| Page | URL | Controller Method |
|------|-----|-------------------|
| Profil | `/profil` | `showProfil()` |
| Tugas | `/profil/tugas` | `showTugas()` |
| Visi | `/profil/visi` | `showVisi()` |
| Struktur | `/profil/struktur` | `showStruktur()` |
| Regulasi | `/profil/regulasi` | `showRegulasi()` |
| Kontak | `/profil/kontak` | `showKontak()` |

**Related Files**:
- Controller: `ProfilPublikController.php`
- Views: All `profil-*.blade.php` files
- Routes: `routes/web.php` (profil group)

---

### FEATURE 6: User Registration (Permohonan)
```
┌──────────────────────────────────┐
│   PERMOHONAN INFORMASI FORM       │
├──────────────────────────────────┤
│ Personal Information:             │
│  • Username                       │
│  • Nama Lengkap                   │
│  • Email                          │
│                                   │
│ Identity:                         │
│  • Jenis Identitas (dropdown)     │
│  • Nomor Identitas                │
│                                   │
│ Contact Info:                     │
│  • Alamat                         │
│  • No. Telepon                    │
│  • Pekerjaan                      │
│  • Instansi                       │
│                                   │
│ Security:                         │
│  • Password                       │
│  • Konfirmasi Password            │
│  • CAPTCHA                        │
│                                   │
│ Agreement Checkbox                │
│                                   │
│ [Submit] [Reset]                  │
└──────────────────────────────────┘
```

**Form Features**:
- Client-side validation (JS)
- Password strength check
- Password confirmation
- Required field indicators
- Success/Error messages
- CAPTCHA for spam prevention

**Related Files**:
- View: `resources/views/permohonan.blade.php`
- Route: `GET /permohonan` → show form

**TODO**: Backend processing (PermohonanController@store)

---

### FEATURE 7: Admin Dashboard
```
┌──────────────────────────────────────────────────────┐
│              ADMIN PROFIL DASHBOARD                  │
├──────────────────────────────────────────────────────┤
│                                                      │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐          │
│  │ PROFIL   │  │  TUGAS   │  │  VISI    │          │
│  │ [EDIT]   │  │  [EDIT]  │  │  [EDIT]  │          │
│  │ Status✓  │  │ Status✓  │  │ Status✓  │          │
│  └──────────┘  └──────────┘  └──────────┘          │
│                                                      │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐          │
│  │ STRUKTUR │  │ REGULASI │  │ KONTAK   │          │
│  │ [EDIT]   │  │  [EDIT]  │  │  [EDIT]  │          │
│  │ Status✓  │  │ Status✗  │  │ Status✓  │          │
│  └──────────┘  └──────────┘  └──────────┘          │
│                                                      │
│ Legend: Status✓ = Konten tersedia                   │
│         Status✗ = Belum ada konten                  │
└──────────────────────────────────────────────────────┘
```

**Dashboard Features**:
- 6 color-coded cards (one per section)
- Quick status check (content exists or not)
- Direct edit links
- Font Awesome icons
- Responsive grid layout
- Hover animations

**Related Files**:
- View: `resources/views/admin/profil/index.blade.php`
- Route: `GET /admin/profil` → `ProfilPpidController@index`
- CSS: Bootstrap 5.3 + custom styles

---

## 📈 DATA FLOW DIAGRAM

### CREATE/UPDATE Content Flow
```
┌─────────────────┐
│  Admin User     │
└────────┬────────┘
         │ 1. Login
         ▼
┌─────────────────┐
│  Auth Check     │
│  ✓ Authenticated│
└────────┬────────┘
         │ 2. Navigate to /admin/profil/{type}
         ▼
┌─────────────────┐
│  Edit Form      │
│  (TinyMCE +     │
│   Image Upload) │
└────────┬────────┘
         │ 3. Fill form
         │    Upload image
         │ 4. Submit (PUT)
         ▼
┌──────────────────────┐
│  ProfilPpidController│
│  @update($request)   │
└────────┬─────────────┘
         │ 5. Validate
         │    - judul required
         │    - images max 5MB
         │ 6. Process image
         │    - Delete old
         │    - Save new
         │ 7. Save to DB
         ▼
┌──────────────────────┐
│  MySQL Database      │
│  profil_ppids table  │
│  WHERE type = $type  │
│  UPDATE [all fields] │
└────────┬─────────────┘
         │ 8. Redirect to index
         ▼
┌──────────────────────┐
│  Dashboard           │
│  (refresh card)      │
│  Show success msg    │
└──────────────────────┘
```

### READ Content Flow (Public)
```
┌──────────────┐
│  Visitor     │
│  Browser     │
└────────┬─────┘
         │ 1. Visit http://localhost:8000/profil
         ▼
┌──────────────────────┐
│  Laravel Routing     │
│  routes/web.php      │
└────────┬─────────────┘
         │ 2. Match route: /profil
         │    Call: ProfilPublikController@showProfil
         ▼
┌──────────────────────┐
│  ProfilPublikController│
│  @showProfil()       │
│  Query: WHERE type = │
│  'profil'            │
└────────┬─────────────┘
         │ 3. Database query
         ▼
┌──────────────────────┐
│  MySQL Database      │
│  SELECT *            │
│  FROM profil_ppids   │
│  WHERE type='profil' │
└────────┬─────────────┘
         │ 4. Return $profil object
         ▼
┌──────────────────────┐
│  Blade Template      │
│  profil-ppid.blade   │
│  {!! $profil->      │
│   konten_pembuka !!} │
└────────┬─────────────┘
         │ 5. Render HTML
         ▼
┌──────────────────────┐
│  Browser displays    │
│  beautiful page      │
└──────────────────────┘
```

---

## 🔐 SECURITY MEASURES

### Input Validation
```
Admin Form Input
        ↓
Laravel Validation Rules
├─ String type check
├─ File size limit (5MB)
├─ File type check (image/jpeg, image/png, image/gif)
└─ CSRF token verification
        ↓
Sanitization (HTML allowed for content)
        ↓
Database Storage
```

### File Upload Security
```
Uploaded File
        ↓
Server-side validation
├─ Check MIME type
├─ Check file size
├─ Generate unique name (timestamp_filename)
└─ Store outside public_html
        ↓
Served via Laravel asset() helper
        ↓
No direct file access
```

### Authentication
```
All admin routes protected by:
├─ middleware:auth
├─ auth/login check
└─ Session verification
```

---

## ⚙️ TECHNOLOGY DETAILS

### Database Schema
```sql
CREATE TABLE profil_ppids (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type ENUM('profil','tugas','visi','struktur','regulasi','kontak') UNIQUE,
    judul VARCHAR(255),
    konten_pembuka LONGTEXT,
    konten_detail LONGTEXT,
    judul_sub VARCHAR(255),
    gambar VARCHAR(255),
    link_dokumen VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tech Stack
```
Backend:
├─ Framework: Laravel 12.50.0
├─ Language: PHP 8.3.28
├─ Database: MySQL 8.0
└─ Server: Laragon

Frontend:
├─ CSS: Bootstrap 5.3.0
├─ Icons: Font Awesome 6.4.0
├─ Editor: TinyMCE 6 (Cloud)
└─ Utilities: Font Awesome, Custom CSS

DevOps:
├─ Package Manager: Composer, npm
├─ Build Tool: Vite
└─ File Storage: Storage::disk('public')
```

---

## 🎨 Visual Hierarchy

### Color System
```
Primary (Brand Blue):  #004a99 (Navy)
Secondary (Gold):      #ffc107 (Yellow)
Success:              #28a745 (Green)
Danger:               #dc3545 (Red)
Info:                 #17a2b8 (Cyan)
Warning:              #ff9800 (Orange)
```

### Component Colors
```
Dashboard Cards:
├─ Profil:      Blue   (#004a99)
├─ Tugas:       Yellow (#ffc107)
├─ Visi:        Green  (#28a745)
├─ Struktur:    Red    (#dc3545)
├─ Regulasi:    Purple (#6f42c1)
└─ Kontak:      Cyan   (#17a2b8)
```

---

## 📊 Database Relationships

```
┌─────────────────────────────────┐
│        profil_ppids             │
├─────────────────────────────────┤
│ id (PK)                         │
│ type (ENUM) - UNIQUE            │
│ judul                           │
│ konten_pembuka (LONGTEXT)       │
│ konten_detail (LONGTEXT)        │
│ judul_sub                       │
│ gambar (filename)               │
│ link_dokumen (URL)              │
│ created_at                      │
│ updated_at                      │
└─────────────────────────────────┘
         ↑
         │
    Contains
         │
   (1) record per type
```

---

## 🔄 Migration Path

```
2026_02_18_033432_create_profil_ppids_table.php
├─ Status: ✅ Executed (Batch 4)
├─ Execution time: 94.53ms
└─ Database: ppid_pktj
```

---

## 📞 SUPPORT MATRIX

| Issue | Solution | File |
|-------|----------|------|
| Image upload fails | `php artisan storage:link` | ProfilPpidController.php |
| TinyMCE not showing | Check CDN, clear cache | edit.blade.php |
| Routes not working | `php artisan route:clear` | routes/web.php |
| Database errors | Check .env DB settings | config/database.php |
| Modal not working | Check JavaScript console | profil-regulasi.blade.php |

---

**Last Updated**: 2026-02-19  
**Status**: ✅ Production Ready  
**Version**: 1.0.0
