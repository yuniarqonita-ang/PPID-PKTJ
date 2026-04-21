# PANDUAN IMPLEMENTASI DATABASE & CONTROLLER
**Untuk Semua Menu Admin PPID PKTJ**

---

## 📊 DATABASE SCHEMA YANG DIREKOMENDASIKAN

### 1. TABLE: Informasi Publik
```sql
CREATE TABLE informasi_publik (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tipe ENUM('berkala', 'serta_merta', 'setiap_saat', 'dikecualikan') NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    konten LONGTEXT NOT NULL,
    dokumen_path VARCHAR(255),
    tanggal_publikasi DATE,
    created_by BIGINT UNSIGNED,
    updated_by BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_tipe (tipe),
    INDEX idx_tanggal (tanggal_publikasi),
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (updated_by) REFERENCES users(id)
);
```

### 2. TABLE: Layanan Informasi
```sql
CREATE TABLE layanan_informasi (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    kategori VARCHAR(100) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    konten LONGTEXT,
    link_eksternal VARCHAR(500),
    dokumen_path VARCHAR(255),
    urutan INT DEFAULT 0,
    aktif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_kategori (kategori),
    INDEX idx_aktif (aktif)
);
```

### 3. TABLE: Prosedur
```sql
CREATE TABLE prosedur (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama_sop VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    konten LONGTEXT,
    dokumen_path VARCHAR(255),
    versi VARCHAR(10),
    tanggal_berlaku DATE,
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_urutan (urutan),
    INDEX idx_tanggal (tanggal_berlaku)
);
```

### 4. TABLE: LPSE Items
```sql
CREATE TABLE lpse_items (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    kategori VARCHAR(100) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    konten LONGTEXT,
    link_eksternal VARCHAR(500),
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_kategori (kategori),
    INDEX idx_urutan (urutan)
);
```

---

## 📝 MIGRATION FILES

### Contoh Migration untuk Informasi Publik
```php
<?php
// database/migrations/YYYY_MM_DD_create_informasi_publik_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['berkala', 'serta_merta', 'setiap_saat', 'dikecualikan']);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->longText('konten');
            $table->string('dokumen_path')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->index('tipe');
            $table->index('tanggal_publikasi');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_publik');
    }
};
```

---

## 🏗️ ELOQUENT MODEL EXAMPLES

### Model: InformasiPublik
```php
<?php
// app/Models/InformasiPublik.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPublik extends Model
{
    protected $table = 'informasi_publik';
    
    protected $fillable = [
        'tipe',
        'judul',
        'deskripsi',
        'konten',
        'dokumen_path',
        'tanggal_publikasi',
        'created_by',
        'updated_by'
    ];
    
    protected $casts = [
        'tanggal_publikasi' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    // Scopes
    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }
    
    public function scopePublished($query)
    {
        return $query->where('tanggal_publikasi', '<=', now());
    }
}
```

### Model: LayananInformasi
```php
<?php
// app/Models/LayananInformasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananInformasi extends Model
{
    protected $table = 'layanan_informasi';
    
    protected $fillable = [
        'kategori',
        'judul',
        'deskripsi',
        'konten',
        'link_eksternal',
        'dokumen_path',
        'urutan',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean'
    ];
    
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
    
    public function scopeOrderByUrutan($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
```

---

## 🎮 CONTROLLER EXAMPLES

### Controller: InformasiPublikController
```php
<?php
// app/Http/Controllers/InformasiPublikController.php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    // Display list view for admin
    public function index($tipe = 'berkala')
    {
        $informasi = InformasiPublik::byTipe($tipe)
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(15);
        
        return view('admin.informasi.' . $tipe, compact('informasi', 'tipe'));
    }
    
    // Show form for creating new record
    public function create()
    {
        return view('admin.informasi.create');
    }
    
    // Store new record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:berkala,serta_merta,setiap_saat,dikecualikan',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_publikasi' => 'nullable|date'
        ]);
        
        // Handle file upload
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $path = $dokumen->store('dokumen/informasi', 'public');
            $validated['dokumen_path'] = $path;
        }
        
        $validated['created_by'] = auth()->id();
        
        InformasiPublik::create($validated);
        
        return redirect()
            ->route('admin.informasi.' . $validated['tipe'])
            ->with('success', 'Informasi berhasil disimpan');
    }
    
    // Show form for editing
    public function edit($id)
    {
        $informasi = InformasiPublik::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }
    
    // Update record
    public function update(Request $request, $id)
    {
        $informasi = InformasiPublik::findOrFail($id);
        
        $validated = $request->validate([
            'tipe' => 'required|in:berkala,serta_merta,setiap_saat,dikecualikan',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_publikasi' => 'nullable|date'
        ]);
        
        // Handle file upload
        if ($request->hasFile('dokumen')) {
            // Delete old file
            if ($informasi->dokumen_path) {
                \Storage::disk('public')->delete($informasi->dokumen_path);
            }
            
            $dokumen = $request->file('dokumen');
            $path = $dokumen->store('dokumen/informasi', 'public');
            $validated['dokumen_path'] = $path;
        }
        
        $validated['updated_by'] = auth()->id();
        
        $informasi->update($validated);
        
        return redirect()
            ->back()
            ->with('success', 'Informasi berhasil diperbarui');
    }
    
    // Delete record
    public function destroy($id)
    {
        $informasi = InformasiPublik::findOrFail($id);
        
        // Delete file if exists
        if ($informasi->dokumen_path) {
            \Storage::disk('public')->delete($informasi->dokumen_path);
        }
        
        $tipe = $informasi->tipe;
        $informasi->delete();
        
        return redirect()
            ->route('admin.informasi.' . $tipe)
            ->with('success', 'Informasi berhasil dihapus');
    }
}
```

---

## 🛣️ ROUTES CONFIGURATION

### Update routes/web.php
```php
// routes/web.php (di bagian admin routes)

Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // ... routes lainnya ...
    
    // Informasi Publik - Full CRUD
    Route::resource('informasi', InformasiPublikController::class);
    Route::get('informasi/tipe/{tipe}', [InformasiPublikController::class, 'index'])
        ->name('informasi.tipe');
    
    // Layanan Informasi
    Route::resource('layanan', LayananInformasiController::class);
    
    // Prosedur
    Route::resource('prosedur', ProsedurController::class);
    
    // LPSE
    Route::resource('lpse', LpseController::class);
    
});
```

---

## 📝 FORM REQUEST VALIDATION (Optional)

### Create FormRequest Class
```php
<?php
// app/Http/Requests/StoreInformasiPublikRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformasiPublikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'tipe' => 'required|in:berkala,serta_merta,setiap_saat,dikecualikan',
            'judul' => 'required|string|max:255|unique:informasi_publik,judul',
            'deskripsi' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal_publikasi' => 'nullable|date|before_or_equal:today',
        ];
    }
    
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul harus diisi',
            'judul.unique' => 'Judul sudah digunakan',
            'konten.required' => 'Konten harus diisi',
            'dokumen.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, atau XLSX',
            'dokumen.max' => 'Ukuran file maksimal 10MB',
        ];
    }
}
```

---

## 🔧 FILE STORAGE SETUP

### Configure Laravel File Storage
```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

### Create Symbolic Link
```bash
# Di terminal/command line
php artisan storage:link
```

---

## 📋 QUICK REFERENCE: IMPLEMENTASI STEPS

### Step 1: Database Setup
```bash
# Buat migration
php artisan make:migration create_informasi_publik_table

# Edit file migration di database/migrations/

# Run migration
php artisan migrate
```

### Step 2: Create Model
```bash
php artisan make:model InformasiPublik
```

### Step 3: Create Controller
```bash
php artisan make:controller InformasiPublikController --resource
```

### Step 4: Create Views
- Copy file `_TEMPLATE_FORM_GENERIC.blade.php`
- Paste menjadi `informasi/berkala.blade.php`
- Update form fields & styling

### Step 5: Update Routes
- Add routes ke `routes/web.php`
- Test routes dengan `php artisan route:list`

### Step 6: Update Sidebar
- Add menu links di `layouts/app.blade.php`
- Test navigation

### Step 7: Testing
```bash
# Clear caches
php artisan cache:clear
php artisan view:clear

# Test di browser
# http://localhost/admin/informasi
```

---

## 🧪 TESTING QUERY EXAMPLES

```php
// Tinker console
php artisan tinker

// Test create
InformasiPublik::create([
    'tipe' => 'berkala',
    'judul' => 'Test Informasi',
    'konten' => 'Isi konten di sini',
    'tanggal_publikasi' => now(),
    'created_by' => 1
]);

// Test read
InformasiPublik::all();
InformasiPublik::byTipe('berkala')->get();

// Test update
$info = InformasiPublik::find(1);
$info->update(['judul' => 'Judul Baru']);

// Test delete
InformasiPublik::destroy(1);
```

---

## 🚨 COMMON ISSUES & SOLUTIONS

### Issue 1: Column not found error
**Solusi**: Pastikan migration sudah dijalankan
```bash
php artisan migrate:fresh # ⚠️ Hati-hati, ini menghapus semua data!
php artisan migrate # Jalankan ulang
```

### Issue 2: File upload not working
**Solusi**: Cek file upload permissions
```bash
# Set correct permissions
chmod -R 755 storage/app/public
chmod -R 755 public/storage
```

### Issue 3: Relations error di view
**Solusi**: Eager load relations
```php
// Dalam controller
$informasi = InformasiPublik::with(['createdBy', 'updatedBy'])->get();
```

---

## 💾 SEEDING DATA (Untuk Development)

### Create Seeder
```php
<?php
// database/seeders/InformasiPublikSeeder.php

namespace Database\Seeders;

use App\Models\InformasiPublik;
use Illuminate\Database\Seeder;

class InformasiPublikSeeder extends Seeder
{
    public function run(): void
    {
        InformasiPublik::create([
            'tipe' => 'berkala',
            'judul' => 'Laporan Kinerja Tahunan 2024',
            'deskripsi' => 'Laporan kinerja rutin yang disampaikan setiap tahun',
            'konten' => '<p>Isi laporan kinerja tahunan...</p>',
            'tanggal_publikasi' => now(),
            'created_by' => 1
        ]);
        
        // Tambah data lainnya...
    }
}
```

### Run Seeder
```bash
php artisan db:seed --class=InformasiPublikSeeder
```

---

## 📚 NEXT RESOURCES

- Laravel Eloquent: https://laravel.com/docs/11.x/eloquent
- Database Migrations: https://laravel.com/docs/11.x/migrations
- Controllers: https://laravel.com/docs/11.x/controllers
- Forms & Validation: https://laravel.com/docs/11.x/validation

---

**Ready to implement? Contact system administrator for guidance!**
