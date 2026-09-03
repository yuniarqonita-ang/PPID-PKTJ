<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::latest()->get();
        return view('admin.dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        $kategori = request('kategori');
        return view('admin.dokumen.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Check for PHP upload size errors
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $max_upload = ini_get('upload_max_filesize');
            $max_post = ini_get('post_max_size');
            if (empty($_POST) && empty($_FILES) && isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
                return back()->withErrors(['file' => "Ukuran upload melebihi batas server (post_max_size: {$max_post}). Silakan gunakan link Google Drive sebagai alternatif."])->withInput();
            }
            if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_OK && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errorCode = $_FILES['file']['error'];
                $errorMsg = "Gagal mengunggah file (PHP Error Code: {$errorCode}).";
                if ($errorCode == UPLOAD_ERR_INI_SIZE || $errorCode == UPLOAD_ERR_FORM_SIZE) {
                    $errorMsg = "Ukuran file melebihi batas server (upload_max_filesize: {$max_upload}). Silakan gunakan link Google Drive sebagai alternatif.";
                }
                return back()->withErrors(['file' => $errorMsg])->withInput();
            }
        }

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'file' => 'required_without:gdrive_link|nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'gdrive_link' => 'required_without:file|nullable|url',
            'kategori' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string'
        ], [
            'file.required_without' => 'Pilih file yang ingin diunggah ATAU masukkan link Google Drive.',
            'gdrive_link.required_without' => 'Masukkan link Google Drive ATAU pilih file yang ingin diunggah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.'
        ]);

        // Silently ensure all columns exist in database via Schema and raw SQL
        try {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `tanggal` date NULL AFTER `kategori`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `deskripsi` longtext NULL AFTER `tanggal`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `file_name` varchar(255) NULL AFTER `file_path`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `file_size` varchar(50) NULL AFTER `file_name`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `file_type` varchar(100) NULL AFTER `file_size`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `bisa_download` tinyint(1) NOT NULL DEFAULT 0 AFTER `aktif`");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dokumens` ADD COLUMN IF NOT EXISTS `is_blurred` tinyint(1) NOT NULL DEFAULT 0 AFTER `bisa_download`");
        } catch (\Throwable $e) {}

        $data = [
            'judul'         => $validated['judul'],
            'kategori'      => $validated['kategori'] ?? 'Umum',
            'aktif'         => $request->has('aktif'),
            'user_id'       => Auth::id(),
            'is_blurred'    => $request->has('is_blurred'),
            'bisa_download' => $request->has('bisa_download'),
            'tanggal'       => $request->input('tanggal') ?: date('Y-m-d'),
            'deskripsi'     => $request->input('deskripsi'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('dokumen', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $size = $file->getSize();
            if ($size >= 1048576) {
                $data['file_size'] = round($size / 1048576, 2) . ' MB';
            } elseif ($size >= 1024) {
                $data['file_size'] = round($size / 1024, 2) . ' KB';
            } else {
                $data['file_size'] = $size . ' Bytes';
            }
            $data['file_type'] = $file->getClientMimeType();
        } elseif ($request->filled('gdrive_link')) {
            $data['file_path'] = $request->gdrive_link;
            $data['file_name'] = 'Dokumen Google Drive';
            $data['file_size'] = 'Google Drive';
            $data['file_type'] = 'gdrive';
            $data['bisa_download'] = 1;
        } else {
            $data['file_path'] = '-';
        }

        $existingCols = [];
        try {
            $existingCols = Schema::getColumnListing('dokumens');
        } catch (\Throwable $e) {}

        $safeData = empty($existingCols) ? $data : array_intersect_key($data, array_flip($existingCols));

        try {
            Dokumen::create($safeData);
        } catch (\Throwable $e) {
            // Minimal fallback insert
            Dokumen::create([
                'judul' => $data['judul'],
                'file_path' => $data['file_path'] ?? '-',
                'kategori' => $data['kategori'] ?? 'Umum',
            ]);
        }

        $kategori = $validated['kategori'] ?? 'Umum';
        try {
            $this->saveSopPageSettings($request, $kategori);
        } catch (\Throwable $e) {}
        
        $redirectTo = $this->getRedirectUrl($kategori);

        return redirect($redirectTo)->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        // Check for PHP upload size errors
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $max_upload = ini_get('upload_max_filesize');
            $max_post = ini_get('post_max_size');
            if (empty($_POST) && empty($_FILES) && isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
                return back()->withErrors(['file' => "Ukuran upload melebihi batas server (post_max_size: {$max_post}). Silakan gunakan link Google Drive sebagai alternatif."])->withInput();
            }
            if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_OK && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errorCode = $_FILES['file']['error'];
                $errorMsg = "Gagal mengunggah file (PHP Error Code: {$errorCode}).";
                if ($errorCode == UPLOAD_ERR_INI_SIZE || $errorCode == UPLOAD_ERR_FORM_SIZE) {
                    $errorMsg = "Ukuran file melebihi batas server (upload_max_filesize: {$max_upload}). Silakan gunakan link Google Drive sebagai alternatif.";
                }
                return back()->withErrors(['file' => $errorMsg])->withInput();
            }
        }

        $dokumen = Dokumen::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'gdrive_link' => 'nullable|url',
            'kategori' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string'
        ], [
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.'
        ]);

        // Silently ensure all columns exist in database (bypasses shared hosting/cPanel permission locks on information_schema)
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->date('tanggal')->nullable()->after('kategori'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->longText('deskripsi')->nullable()->after('tanggal'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->string('file_name')->nullable()->after('file_path'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->string('file_size', 50)->nullable()->after('file_name'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->string('file_type', 100)->nullable()->after('file_size'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->boolean('bisa_download')->default(false)->after('aktif'); }); } catch (\Exception $e) {}
        try { Schema::table('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) { $table->boolean('is_blurred')->default(false)->after('bisa_download'); }); } catch (\Exception $e) {}

        $data = [
            'judul'         => $validated['judul'],
            'kategori'      => $validated['kategori'] ?? $dokumen->kategori,
            'aktif'         => $request->has('aktif'),
            'is_blurred'    => $request->has('is_blurred'),
            'bisa_download' => $request->has('bisa_download'),
            'tanggal'       => $request->input('tanggal') ?: ($dokumen->tanggal ? \Carbon\Carbon::parse($dokumen->tanggal)->format('Y-m-d') : date('Y-m-d')),
            'deskripsi'     => $request->input('deskripsi'),
        ];

        if ($request->has('hapus_file')) {
            if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'http') && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $data['file_path'] = null;
            $data['file_name'] = null;
            $data['file_size'] = null;
            $data['file_type'] = null;
        } elseif ($request->hasFile('file')) {
            if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'http') && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $file = $request->file('file');
            $data['file_path'] = $file->store('dokumen', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $size = $file->getSize();
            if ($size >= 1048576) {
                $data['file_size'] = round($size / 1048576, 2) . ' MB';
            } elseif ($size >= 1024) {
                $data['file_size'] = round($size / 1024, 2) . ' KB';
            } else {
                $data['file_size'] = $size . ' Bytes';
            }
            $data['file_type'] = $file->getClientMimeType();
        } elseif ($request->filled('gdrive_link')) {
            if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'http') && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $data['file_path'] = $request->gdrive_link;
            $data['file_name'] = 'Dokumen Google Drive';
            $data['file_size'] = 'Google Drive';
            $data['file_type'] = 'gdrive';
            $data['bisa_download'] = 1;
        }

        $existingCols = [];
        try {
            $existingCols = Schema::getColumnListing('dokumens');
        } catch (\Throwable $e) {}

        $safeData = empty($existingCols) ? $data : array_intersect_key($data, array_flip($existingCols));

        try {
            $dokumen->update($safeData);
        } catch (\Throwable $e) {
            $dokumen->update([
                'judul' => $data['judul'] ?? $dokumen->judul,
                'file_path' => $data['file_path'] ?? $dokumen->file_path,
                'kategori' => $data['kategori'] ?? $dokumen->kategori,
            ]);
        }

        $kategori = $validated['kategori'] ?? 'Umum';
        try {
            $this->saveSopPageSettings($request, $kategori);
        } catch (\Throwable $e) {}
        
        $redirectTo = $this->getRedirectUrl($kategori);

        return redirect($redirectTo)->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $kategori = $dokumen->kategori;
        
        if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'http') && Storage::disk('public')->exists($dokumen->file_path)) { 
            Storage::disk('public')->delete($dokumen->file_path); 
        }
        $dokumen->delete();

        $redirectTo = $this->getRedirectUrl($kategori);

        return redirect($redirectTo)->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Helper to map document categories to their respective admin redirect routes
     */
    private function getRedirectUrl($kategori)
    {
        $redirectMap = [
            'Laporan Layanan' => \Illuminate\Support\Facades\Route::has('admin.layanan.laporan-layanan') ? route('admin.layanan.laporan-layanan') : url('/admin/layanan/laporan-layanan'),
            'Laporan Akses' => \Illuminate\Support\Facades\Route::has('admin.layanan.laporan-akses') ? route('admin.layanan.laporan-akses') : url('/admin/layanan/laporan-akses'),
            'Laporan Survey' => \Illuminate\Support\Facades\Route::has('admin.layanan.laporan-survey') ? route('admin.layanan.laporan-survey') : url('/admin/layanan/laporan-survey'),
            'SOP Permintaan Informasi Publik' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-permintaan') ? route('admin.prosedur.sop-permintaan') : url('/admin/prosedur/sop-permintaan'),
            'SOP Penanganan Keberatan' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-keberatan') ? route('admin.prosedur.sop-keberatan') : url('/admin/prosedur/sop-keberatan'),
            'SOP Pengajuan Sengketa Informasi Publik' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-sengketa') ? route('admin.prosedur.sop-sengketa') : url('/admin/prosedur/sop-sengketa'),
            'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-penetapan') ? route('admin.prosedur.sop-penetapan') : url('/admin/prosedur/sop-penetapan'),
            'SOP Pengujian Konsekuensi' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-pengujian') ? route('admin.prosedur.sop-pengujian') : url('/admin/prosedur/sop-pengujian'),
            'SOP Pendokumentasian Informasi Publik' => \Illuminate\Support\Facades\Route::has('admin.prosedur.sop-pendokumentasian') ? route('admin.prosedur.sop-pendokumentasian') : url('/admin/prosedur/sop-pendokumentasian'),
        ];
        
        return $redirectMap[$kategori] ?? (\Illuminate\Support\Facades\Route::has('admin.dokumen.index') ? route('admin.dokumen.index') : url('/admin/dokumen'));
    }

    /**
     * Update SOP page settings directly from admin SOP settings form
     */
    public function updateSopSettings(Request $request)
    {
        $prefix = $request->input('prefix');
        if (!$prefix) {
            return back()->with('error', 'Prefix SOP tidak valid.');
        }

        // Handle text fields
        $fields = ['judul_hero', 'tagline_hero', 'konten', 'youtube_link'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field) ?? '';
                if ($field === 'konten') {
                    $val = $this->processBase64ImagesInHtml($val);
                }

                \App\Models\Dashboard::updateOrCreate(
                    ['key' => $prefix . '_' . $field],
                    [
                        'value'       => $val,
                        'type'        => 'text',
                        'description' => "Pengaturan $prefix $field"
                    ]
                );
            }
        }

        return back()->with('success', 'Pengaturan Halaman SOP berhasil diperbarui!');
    }

    /**
     * Helper to save SOP page settings to dashboards table
     */
    private function saveSopPageSettings(Request $request, $kategori)
    {
        $sopCategoryPrefixMap = [
            'SOP Permintaan Informasi Publik' => 'sop_permintaan',
            'SOP Penanganan Keberatan' => 'sop_keberatan',
            'SOP Pengajuan Sengketa Informasi Publik' => 'sop_sengketa',
            'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik' => 'sop_penetapan',
            'SOP Pengujian Konsekuensi' => 'sop_pengujian',
            'SOP Pendokumentasian Informasi Publik' => 'sop_pendokumentasian',
        ];

        if (!isset($sopCategoryPrefixMap[$kategori])) {
            return;
        }

        $type = $sopCategoryPrefixMap[$kategori];

        // Handle text fields
        $fields = ['judul_hero', 'tagline_hero', 'konten', 'youtube_link'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field) ?? '';
                if ($field === 'konten') {
                    $val = $this->processBase64ImagesInHtml($val);
                }

                \App\Models\Dashboard::updateOrCreate(
                    ['key' => $type . '_' . $field],
                    ['value' => $val, 'type' => 'text', 'description' => "Teks dinamis untuk $type $field"]
                );
            }
        }

        // Handle file uploads (gambar_sop, gambar_proses)
        $files = ['gambar_sop', 'gambar_proses'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                if ($file->isValid()) {
                    $settingKey = $type . '_' . $fileKey;
                    $filename = time() . '_' . $settingKey . '.' . $file->getClientOriginalExtension();

                    if (!Storage::disk('public')->exists('halaman')) {
                        Storage::disk('public')->makeDirectory('halaman');
                    }

                    $file->storeAs('halaman', $filename, 'public');

                    // Delete old file
                    $old = \App\Models\Dashboard::where('key', $settingKey)->first();
                    if ($old && $old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                        Storage::disk('public')->delete('halaman/' . $old->value);
                    }

                    \App\Models\Dashboard::updateOrCreate(
                        ['key' => $settingKey],
                        ['value' => $filename, 'type' => 'file', 'description' => "File untuk $type $fileKey"]
                    );
                }
            }
        }

        // Handle deletion of existing images
        if ($request->has('hapus_gambar_sop')) {
            $settingKey = $type . '_gambar_sop';
            $old = \App\Models\Dashboard::where('key', $settingKey)->first();
            if ($old) {
                if ($old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                    Storage::disk('public')->delete('halaman/' . $old->value);
                }
                $old->delete();
            }
        }

        if ($request->has('hapus_gambar_proses')) {
            $settingKey = $type . '_gambar_proses';
            $old = \App\Models\Dashboard::where('key', $settingKey)->first();
            if ($old) {
                if ($old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                    Storage::disk('public')->delete('halaman/' . $old->value);
                }
                $old->delete();
            }
        }
    }

    /**
     * PUBLIC: List dokumen untuk halaman publik
     */
    public function publicList()
    {
        $dokumen = Dokumen::latest()->paginate(12);
        $kategori = Dokumen::distinct('kategori')->pluck('kategori');
        return view('dokumen', compact('dokumen', 'kategori'));
    }

    /**
     * PUBLIC: Download dokumen
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if (str_starts_with($dokumen->file_path, 'http://') || str_starts_with($dokumen->file_path, 'https://')) {
            return redirect($dokumen->file_path);
        }
        return Storage::disk('public')->download($dokumen->file_path, $dokumen->judul . '.' . pathinfo($dokumen->file_path, PATHINFO_EXTENSION));
    }

    /**
     * PUBLIC: View dokumen (Premium Blur)
     */
    public function view($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $file_path = $dokumen->file_path;
        if (!str_starts_with($file_path, 'http') && !str_starts_with($file_path, 'storage/')) {
            $file_path = 'storage/' . $file_path;
        }
        return view('preview-dokumen', [
            'file_path' => $file_path,
            'title' => $dokumen->judul,
            'is_blurred' => $dokumen->is_blurred,
            'settings' => \App\Models\Dashboard::pluck('value', 'key')->toArray()
        ]);
    }

    /**
     * PUBLIC: Informasi Dikecualikan
     */
    public function dikecualikan()
    {
        $dokumen = Dokumen::latest()->get();
        return view('informasi-dikecualikan', compact('dokumen'));
    }

    /**
     * Process base64 images inside HTML string to real files
     */
    private function processBase64ImagesInHtml($html)
    {
        if (empty($html)) return $html;

        $pattern = '/src=["\']data:image\/(png|jpeg|jpg|gif|webp);base64,([^"\']+)["\']/i';

        return preg_replace_callback($pattern, function ($matches) {
            $ext = strtolower($matches[1]);
            $base64Data = $matches[2];
            $decodedData = base64_decode($base64Data);

            if ($decodedData === false) {
                return $matches[0];
            }

            $filename = time() . '_' . uniqid() . '.' . $ext;

            if (!Storage::disk('public')->exists('editor_uploads')) {
                Storage::disk('public')->makeDirectory('editor_uploads');
            }

            Storage::disk('public')->put('editor_uploads/' . $filename, $decodedData);
            $fileUrl = asset('storage/editor_uploads/' . $filename);

            return 'src="' . $fileUrl . '"';
        }, $html);
    }
}