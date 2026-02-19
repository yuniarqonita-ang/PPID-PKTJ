# PANDUAN DOCUMENT PREVIEW MODAL
**In-Page Preview untuk Google Drive, PDF, dan File Lainnya**

---

## 🎯 OVERVIEW

User requirement yang PENTING: **Semua link dokumen harus di-preview dalam modal di halaman yang sama, BUKAN di-open di tab baru.**

Fitur ini sudah diimplementasikan di:
- ✅ Profil PPID sections (regulasi.blade.php)
- ✅ Admin form untuk Profil (edit.blade.php)

Panduan ini menjelaskan cara mengintegrasikan ke menu lainnya.

---

## 📌 IMPLEMENTASI MODAL

### 1. HTML STRUKTUR MODAL

Tambahkan ini di akhir setiap page/form yang membutuhkan document preview:

```blade
<!-- Document Preview Modal -->
<div id="documentModal" class="document-modal">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5>Preview Dokumen</h5>
            <button type="button" class="btn-close" onclick="closeDocumentPreview()"></button>
        </div>
        <div class="modal-body-custom">
            <iframe id="documentFrame" src="" frameborder="0" allowfullscreen="true"></iframe>
        </div>
    </div>
</div>
```

### 2. CSS STYLING

```css
/* Document Preview Modal Styles */
.document-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    animation: fadeIn 0.3s ease-in;
}

.document-modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content-custom {
    background-color: white;
    border-radius: 12px;
    width: 95%;
    max-width: 1200px;
    height: 80vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
}

.modal-header-custom {
    padding: 20px;
    border-bottom: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #f9f9f9 100%);
}

.modal-header-custom h5 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.modal-body-custom {
    flex: 1;
    overflow: auto;
    background-color: #f5f5f5;
}

.modal-body-custom iframe {
    width: 100%;
    height: 100%;
    border: none;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
```

### 3. JAVASCRIPT FUNCTIONS

```javascript
/**
 * Open document preview in modal
 * Supports: Google Drive, PDF, images, general embeds
 */
function previewDocument(url) {
    if (!url || url.trim() === '') {
        alert('URL dokumen tidak valid');
        return;
    }
    
    let embedUrl = convertUrlToEmbedFormat(url);
    
    const documentFrame = document.getElementById('documentFrame');
    const documentModal = document.getElementById('documentModal');
    
    if (documentFrame && documentModal) {
        documentFrame.src = embedUrl;
        documentModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}

/**
 * Close document preview modal
 */
function closeDocumentPreview() {
    const documentModal = document.getElementById('documentModal');
    const documentFrame = document.getElementById('documentFrame');
    
    if (documentModal && documentFrame) {
        documentModal.classList.remove('show');
        documentFrame.src = '';
        document.body.style.overflow = 'auto';
    }
}

/**
 * Convert various URL formats to embed format
 */
function convertUrlToEmbedFormat(url) {
    // Google Drive Links
    if (url.includes('drive.google.com')) {
        let fileId = '';
        
        if (url.includes('/d/')) {
            // Format: https://drive.google.com/file/d/{FILE_ID}/view
            fileId = url.split('/d/')[1].split('/')[0];
        } else if (url.includes('id=')) {
            // Format: https://drive.google.com/uc?id={FILE_ID}
            fileId = url.split('id=')[1].split('&')[0];
        }
        
        if (fileId) {
            return `https://drive.google.com/file/d/${fileId}/preview`;
        }
    }
    
    // PDF Files - langsung embed
    if (url.endsWith('.pdf') || url.includes('pdf')) {
        return url;
    }
    
    // Image Files - langsung embed
    if (url.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
        return url;
    }
    
    // YouTube Links
    if (url.includes('youtube.com') || url.includes('youtu.be')) {
        const videoId = extractYoutubeId(url);
        if (videoId) {
            return `https://www.youtube.com/embed/${videoId}`;
        }
    }
    
    // Default: return URL as-is
    return url;
}

/**
 * Extract YouTube video ID from various URL formats
 */
function extractYoutubeId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

/**
 * Event listeners untuk modal
 */
document.addEventListener('DOMContentLoaded', function() {
    const documentModal = document.getElementById('documentModal');
    
    if (documentModal) {
        // Close modal on outside click
        documentModal.addEventListener('click', function(event) {
            if (event.target === this) {
                closeDocumentPreview();
            }
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDocumentPreview();
            }
        });
    }
});
```

---

## 🔗 CARA MENGGUNAKAN DI BERBAGAI SKENARIO

### Skenario 1: Button untuk Preview (Paling Umum)

```blade
<!-- Tombol Preview di admin form -->
<div class="input-group">
    <input type="url" name="link_dokumen" value="{{ $profil->link_dokumen }}">
    @if($profil->link_dokumen)
        <button type="button" class="btn btn-outline-info" 
                onclick="previewDocument('{{ $profil->link_dokumen }}')">
            <i class="fas fa-eye me-2"></i> Preview
        </button>
    @endif
</div>
```

### Skenario 2: Link di Public Page

```blade
<!-- Di halaman public yang menampilkan dokumen -->
<a href="javascript:void(0)" 
   onclick="previewDocument('{{ $document->link }}')"
   class="document-link">
    <i class="fas fa-file-pdf me-2"></i> 
    {{ $document->judul }}
</a>
```

### Skenario 3: Table dengan Action Preview

```blade
<!-- Dalam table di admin -->
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documents as $doc)
            <tr>
                <td>{{ $doc->judul }}</td>
                <td>{{ Str::limit($doc->link, 50) }}</td>
                <td>
                    <button class="btn btn-sm btn-info" 
                            onclick="previewDocument('{{ $doc->link }}')">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
```

### Skenario 4: Lightbox Gallery Preview

```blade
<!-- Multiple documents dengan quick preview -->
<div class="row">
    @foreach($files as $file)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $file->name }}</h5>
                    <button class="btn btn-primary" 
                            onclick="previewDocument('{{ $file->url }}')">
                        Lihat Preview
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
```

---

## 📊 SUPPORTED FILE TYPES

| File Type | Support | Preview Method |
|-----------|---------|-----------------|
| Google Drive Docs | ✅ Full | `https://drive.google.com/file/d/{ID}/preview` |
| Google Drive Sheets | ✅ Full | `https://drive.google.com/file/d/{ID}/preview` |
| Google Drive Slides | ✅ Full | `https://drive.google.com/file/d/{ID}/preview` |
| PDF Files | ✅ Full | Direct PDF URL atau Google Docs Viewer |
| Images (JPG, PNG, GIF) | ✅ Full | Direct image URL |
| Excel Files (.xlsx, .xls) | ✅ Partial | Google Drive atau Excel Online |
| Word Documents (.docx) | ✅ Partial | Google Drive atau Office Online |
| YouTube Videos | ✅ Full | Embed format |
| Text Files | ⚠️ Limited | Google Docs Viewer |

---

## 🔧 ADVANCED: CUSTOM FILE HANDLERS

### Jika ingin custom handling untuk file tertentu:

```javascript
/**
 * Extended preview function dengan custom handlers
 */
function previewDocumentAdvanced(url, fileType) {
    let embedUrl = url;
    
    switch(fileType) {
        case 'spreadsheet':
            // Handle Excel files
            embedUrl = transformExcelUrl(url);
            break;
        case 'word':
            // Handle Word documents
            embedUrl = transformWordUrl(url);
            break;
        case 'presentation':
            // Handle PowerPoint
            embedUrl = transformPptUrl(url);
            break;
        default:
            embedUrl = convertUrlToEmbedFormat(url);
    }
    
    previewDocument(embedUrl);
}

/**
 * Transform Excel URLs untuk preview
 */
function transformExcelUrl(url) {
    if (url.includes('drive.google.com')) {
        const fileId = url.split('/d/')[1].split('/')[0];
        return `https://docs.google.com/spreadsheets/d/${fileId}/edit?usp=sharing`;
    }
    return url;
}

/**
 * Transform Word Document URLs
 */
function transformWordUrl(url) {
    if (url.includes('drive.google.com')) {
        const fileId = url.split('/d/')[1].split('/')[0];
        return `https://drive.google.com/file/d/${fileId}/preview`;
    }
    // Atau gunakan Office Online
    return `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(url)}`;
}

/**
 * Transform PowerPoint URLs
 */
function transformPptUrl(url) {
    if (url.includes('drive.google.com')) {
        const fileId = url.split('/d/')[1].split('/')[0];
        return `https://drive.google.com/file/d/${fileId}/preview`;
    }
    return url;
}
```

---

## 🎨 STYLING CUSTOMIZATION

### Ubah ukuran modal:

```css
.modal-content-custom {
    width: 90%;        /* Default: 95% */
    max-width: 1400px; /* Default: 1200px */
    height: 90vh;      /* Default: 80vh */
}
```

### Ubah warna header:

```css
.modal-header-custom {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); /* Blue theme */
    /* Atau sesuaikan dengan brand color Anda */
}
```

### Ubah overlay opacity:

```css
.document-modal {
    background-color: rgba(0, 0, 0, 0.8); /* Default: 0.7, lebih gelap = 0.8+ */
}
```

---

## 🚨 TROUBLESHOOTING

### Problem 1: Modal tidak muncul
**Check**:
- Apakah modal HTML sudah ada di page?
- Apakah CSS file sudah di-include?
- Apakah JavaScript loaded dengan benar?

**Solution**:
```blade
<!-- Pastikan di akhir file blade -->
<!-- Sebelum </body> tag -->
@endsection
```

### Problem 2: Document tidak bisa di-preview
**Possible Causes**:
- URL tidak valid atau expired
- Server meblokir embed
- Format file tidak didukung

**Solution**:
```javascript
// Add error handler
function previewDocument(url) {
    try {
        let embedUrl = convertUrlToEmbedFormat(url);
        // proceed...
    } catch (error) {
        console.error('Error previewing document:', error);
        alert('Gagal membuka preview dokumen. Link mungkin tidak valid.');
    }
}
```

### Problem 3: Memory issue (Page slow)
**Solution**: Lazy load modal hanya ketika dibutuhkan
```javascript
// Option 1: Delay modal creation
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('preview-btn')) {
        createModalIfNotExists();
    }
});

function createModalIfNotExists() {
    if (!document.getElementById('documentModal')) {
        const modalHTML = `<!-- Modal HTML here -->`;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }
}
```

---

## 📝 IMPLEMENTATION CHECKLIST

- [ ] Copy modal HTML ke file blade
- [ ] Include CSS styling (atau tambahkan ke stylesheet)
- [ ] Include JavaScript functions
- [ ] Test dengan Google Drive link
- [ ] Test dengan PDF file
- [ ] Test dengan image file
- [ ] Test dengan YouTube link (jika diperlukan)
- [ ] Test modal close di berbagai device (mobile, tablet, desktop)
- [ ] Test Escape key functionality
- [ ] Test outside click to close
- [ ] Verify z-index tidak bentrok dengan elemen lain

---

## 🔐 SECURITY NOTES

1. **URL Validation**: Pastikan URL di-validate sebelum display
   ```php
   if (!filter_var($url, FILTER_VALIDATE_URL)) {
       // Reject invalid URLs
   }
   ```

2. **Whitelist Domains**: Hanya allow trusted domains
   ```javascript
   const allowedDomains = ['drive.google.com', 'youtube.com', 'yourdomain.com'];
   function isUrlAllowed(url) {
       return allowedDomains.some(domain => url.includes(domain));
   }
   ```

3. **Sanitize URLs**: Remove potentially malicious code
   ```php
   $url = strip_tags($url);
   $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
   ```

---

## 💡 BEST PRACTICES

1. ✅ Always show preview button next to URL input
2. ✅ Provide clear feedback on preview success/failure
3. ✅ Support multiple file types seamlessly
4. ✅ Make modal keyboard-accessible (Escape to close)
5. ✅ Show loading indicator while preview loads
6. ✅ Provide fallback if embed not supported
7. ✅ Test with actual content before deployment
8. ✅ Document supported file types for users

---

## 📚 RESOURCES

- Google Drive API: https://developers.google.com/drive
- Embedded Viewer for Google Drive: https://drive.google.com/viewerng/viewer
- PDF.js: https://mozilla.github.io/pdf.js
- Office Online Viewer: https://view.officeapps.live.com

---

**Ready to implement document preview across your entire application!**
