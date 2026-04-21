# Admin Profil PPID - Editor Documentation

## 🎨 Overview
Comprehensive admin editor interface untuk mengelola konten Profil PPID dengan desain modern, unique, dan fitur-fitur advanced.

**URL Akses:** `http://localhost/PPID-PKTJ/public/admin/profil/{type}`

### Profile Types
- `profil` - Edit Profil PPID
- `tugas` - Edit Tugas dan Tanggung Jawab
- `visi` - Edit Visi dan Misi
- `struktur` - Edit Struktur Organisasi  
- `regulasi` - Edit Regulasi
- `kontak` - Edit Kontak

---

## ✨ Features

### 1. **Modern Editor Header**
- Gradient background dengan animated circles
- Dynamic page title berdasarkan type
- Subtitle deskriptif "Kelola konten dan tampilan halaman dengan editor yang powerful"
- Responsive design dengan smooth animations

### 2. **CKEditor 5 Rich Text Editor**
Integrated professional rich text editor dengan:
- ✅ **Text Formatting:** Bold, Italic, Underline, Strikethrough
- ✅ **Headings:** H1-H3 support
- ✅ **Font Options:** Custom font family dan size selector
- ✅ **Alignment:** Left, Center, Right, Justify
- ✅ **Lists:** Bullet points dan Numbered lists
- ✅ **Tables:** Insert table dengan toolbar untuk column/row operations
- ✅ **Links:** Dengan auto-detection external links dan download option
- ✅ **Images:** Upload dengan styling options (align left/center/right)
- ✅ **Code:** Code block dengan syntax highlighting
- ✅ **Undo/Redo:** Complete undo/redo history

### 3. **Form Fields**

#### Main Content Section (Left Column)
- **Judul Halaman** - Main title (required, max 255 chars)
- **Konten Utama** - Primary content dengan full editor (textarea #editor_pembuka)
- **Judul Bagian Tambahan** - Secondary section title (optional)
- **Konten Bagian Tambahan** - Secondary content (textarea #editor_detail)
- **Link Dokumen** - Only for 'regulasi' type (optional, URL validation)

#### Media Section (Right Column)
- **Image/Illustration Upload**
  - Drag & drop or click to upload
  - Supported formats: JPG, PNG, GIF
  - Max size: 5MB
  - Auto preview on upload
  - Delete option with checkbox

### 4. **Advanced Modals** (14 Modal Components)

1. **File Manager Modal** (`file-manager.blade.php`)
   - Upload file dengan drag & drop
   - Breadcrumb navigation
   - View options (box, list, columns)
   - Filter dan sort functionality
   - File grid dengan select buttons

2. **Insert Media Modal** (`insert-media.blade.php`)
   - Source URL input
   - Custom dimensions (width/height)
   - Embed code option
   - Advanced settings (alternative source, poster)

3. **Insert Image Modal** (`insert-image.blade.php`)
   - Image source/file manager button
   - Alt text input
   - Custom dimensions
   - Advanced styling options

4. **Insert Link Modal** (`insert-link.blade.php`)
   - URL input dengan file manager button
   - Link display text
   - Title attribute field
   - Target dropdown (none / new window)

5. **Find & Replace Modal** (`find-replace.blade.php`)
   - Find text input
   - Replace text input
   - Case sensitivity toggle
   - Replace one / Replace all buttons

6. **Insert Special Character Modal** (`insert-character.blade.php`)
   - 20 special characters grid
   - Easy copy-paste for symbols
   - 5-column layout

7. **Insert Anchor Modal** (`insert-anchor.blade.php`)
   - Anchor name input (untuk bookmark/internal links)
   - Auto format sanitization

8. **Table Operations Modals** (4 modals):
   - **Table Grid** (`table-grid.blade.php`) - 10×10 interactive grid selector
   - **Table Properties** (`table-properties.blade.php`) - Border, padding, spacing, alignment
   - **Cell Properties** (`cell-properties.blade.php`) - Cell type (data/header), dimensions
   - **Row Properties** (`row-properties.blade.php`) - Height, alignment settings

9. **Source Code Modal** (`source-code.blade.php`)
   - HTML source viewer
   - Code textarea dengan copy button
   - Full-size editing

10. **List Style Modals** (2 modals):
    - **Bullet List Styles** (`bullet-list.blade.php`) - 4 style options
    - **Numbered List Styles** (`numbered-list.blade.php`) - 5 enumeration types

### 5. **Custom Styling** (`public/css/profil-editor.css`)

#### Design Elements
- **Primary Gradient:** `#667eea → #764ba2` (Purple/Violet)
- **Success Gradient:** `#4facfe → #00f2fe` (Cyan/Blue)
- **Accent Colors:** Warning, Info, Danger
- **Shadows:** 3-level shadow system (sm, md, lg)
- **Animations:** Slideup, fadeIn, pulse, bounce transitions

#### Components Styled
```css
.editor-header              /* Main header with gradients */
.editor-title              /* Dynamic page title */
.header-subtitle           /* Subtitle text */
.profil-editor-container   /* Main container */
.form-section             /* Form sections with borders */
.btn:hover                /* Button hover effects */
.card                      /* Info cards with gradients */
.modal                     /* Modal styling with animations */
```

#### Responsive Design
- **Mobile** (< 576px): Single column layout
- **Tablet** (576px - 992px): 2-column stacked
- **Desktop** (> 992px): Full 2-column layout
- Smooth transitions pada semua breakpoints

### 6. **JavaScript Functionality** (`public/js/editor.js`)

#### Editor Functions
```javascript
// Basic formatting
editorFunctions.bold()
editorFunctions.italic()
editorFunctions.underline()
editorFunctions.strikethrough()

// Alignment
editorFunctions['align-left']()
editorFunctions['align-center']()
editorFunctions['align-right']()
editorFunctions['align-justify']()

// Lists & Tables
editorFunctions['bullet-list']()
editorFunctions['numbered-list']()
editorFunctions['insert-table']()

// Text operations
editorFunctions['clear-format']()
editorFunctions['undo']()
editorFunctions['redo']()
```

#### Keyboard Shortcuts
- `Ctrl + B` → Bold
- `Ctrl + I` → Italic
- `Ctrl + U` → Underline
- `Ctrl + Z` → Undo
- `Ctrl + Y` → Redo
- `Ctrl + H` → Find & Replace
- `F11` → Fullscreen mode

#### Modal Event Handlers
- File insertion handlers
- Character insertion handlers
- Media/Image insertion handlers
- Link insertion handlers
- List style selection handlers
- Table operations handlers

### 7. **Document Preview** 
For Regulasi type:
- Google Drive document preview dengan embedded viewer
- Auto-detect Google Drive URLs
- Full preview in modal window
- Keyboard shortcut: Escape to close

---

## 🚀 How to Use

### 1. Access Editor
```
Navigate to: /admin/profil/{type}
Example: http://localhost/PPID-PKTJ/public/admin/profil/profil
```

### 2. Edit Content
1. Fill in "Judul Halaman" (required)
2. Add content na "Konten Utama" editor
3. Upload gambar jika diperlukan
4. Click "Simpan Perubahan" button

### 3. Use Modals
- Click respective buttons di toolbar untuk open modals
- Fill in required fields
- Click button untuk insert/apply
- Modal akan auto-close setelah operation

### 4. Format Text
- Gunakan CKEditor toolbar untuk formatting
- Atau gunakan keyboard shortcuts
- Code blocks support syntax highlighting

### 5. Insert Media
- Drag & drop images ke editor
- Atau use file manager modal untuk browse
- Automatic image optimization

---

## 📁 File Structure

```
resources/views/admin/profil/
├── edit.blade.php                    # Main editor form
├── index.blade.php                   # Admin dashboard
├── modals/
│   ├── file-manager.blade.php       # File upload manager
│   ├── insert-media.blade.php       # Media embedding
│   ├── insert-image.blade.php       # Image insertion
│   ├── insert-link.blade.php        # Link creation
│   ├── find-replace.blade.php       # Find & replace
│   ├── insert-character.blade.php   # Special characters
│   ├── insert-anchor.blade.php      # Bookmarks
│   ├── table-grid.blade.php         # Table size selector
│   ├── table-properties.blade.php   # Table settings
│   ├── cell-properties.blade.php    # Cell settings
│   ├── row-properties.blade.php     # Row settings
│   ├── source-code.blade.php        # HTML viewer
│   ├── bullet-list.blade.php        # Bullet styles
│   └── numbered-list.blade.php      # Numbering styles

public/css/
└── profil-editor.css               # Custom styling (700+ lines)

public/js/
└── editor.js                       # Editor functionality (400+ lines)

app/Http/Controllers/
└── ProfilPpidController.php        # Backend controller
```

---

## 🔧 Technical Stack

- **Backend:** Laravel 12.50.0
- **Frontend:** Bootstrap 5.3.0
- **Rich Text Editor:** CKEditor 5 Community Edition
- **Icons:** Font Awesome 6.x
- **Database:** MySQL dengan table `profil_ppids`
- **Styling:** Custom CSS with CSS variables dan animations
- **JavaScript:** Vanilla JS dengan Bootstrap modal API

---

## 📋 Database Schema

```sql
CREATE TABLE profil_ppids (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    type ENUM('profil','tugas','visi','struktur','regulasi','kontak') UNIQUE,
    judul VARCHAR(255) NULLABLE,
    konten_pembuka LONGTEXT NULLABLE,
    judul_sub VARCHAR(255) NULLABLE,
    konten_detail LONGTEXT NULLABLE,
    gambar VARCHAR(255) NULLABLE,
    link_dokumen VARCHAR(255) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
)
```

---

## 🎯 Validation Rules

```php
'judul' => 'required|string|max:255'
'konten_pembuka' => 'nullable|string'
'konten_detail' => 'nullable|string'
'judul_sub' => 'nullable|string|max:255'
'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
'link_dokumen' => 'nullable|url'
```

---

## 🎨 Design Highlights

✨ **Unique Features:**
- Modern gradient backgrounds
- Smooth fade-in animations
- Hover effects dengan shadow transitions
- Responsive grid layout
- Icon integration (Font Awesome)
- Color-coded buttons dengan gradient
- Glass-morphism effect modals
- Pulse animations pada CTAs
- Professional typography
- Accessible form design

---

## 📝 Notes

1. **CKEditor 5:** Menggunakan Community Edition (gratis, no API key required)
2. **Storage:** Gambar disimpan di `storage/app/public/profil/`
3. **Responsive:** Tested pada mobile (320px), tablet (768px), desktop (1920px)
4. **Performance:** Optimized CSS dengan lazy-loading modals
5. **Security:** CSRF protection, input validation, file type checking

---

## 🔄 Workflow

1. User navigates ke `/admin/profil/{type}`
2. Controller loads existing profil atau creates new one
3. Form populated dengan current data
4. User edits content menggunakan CKEditor
5. Optional: Upload/change image
6. Optional: Use modals untuk advanced features
7. Click "Simpan Perubahan" untuk save
8. Controller validates input
9. Image processed dan stored
10. Database updated
11. Redirect dengan success message

---

## ⚙️ Configuration

Default CKEditor toolbar includes:
- Heading dan font options
- Basic formatting (bold, italic, underline, strikethrough)
- Alignment options
- List formatting
- Link insertion
- Image upload
- Table insertion
- Block quote dan code block
- Undo/Redo

**Custom dapat dimodifikasi di:** `resources/views/admin/profil/edit.blade.php` (lines 217-254)

---

## 🚨 Troubleshooting

### Editor tidak muncul
- Clear browser cache (Ctrl+Shift+Del)
- Verify CSS file loaded: `public/css/profil-editor.css`
- Check CKEditor CDN: `https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js`

### Gambar tidak upload
- Check folder permissions: `storage/app/public/profil/`
- Verify max file size: 5MB
- Check allowed extensions: jpg, jpeg, png, gif

### Modal tidak open
- Verify Bootstrap 5.3.0 loaded
- Check modal HTML di file-specific blade
- Verify JavaScript loaded: `public/js/editor.js`

---

## 📞 Support

Untuk maintenance atau customization lebih lanjut:
1. Reference CKEditor docs: https://ckeditor.com/
2. Check Bootstrap docs: https://getbootstrap.com/docs/5.3/
3. Review Laravel validation: https://laravel.com/docs/validation

---

**Version:** 1.0.0  
**Last Updated:** 2024-02-19  
**Status:** ✅ Production Ready
