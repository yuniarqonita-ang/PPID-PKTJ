<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use App\Models\ProfilPpid;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class RegulasiController extends Controller
{
    /**
     * Auto-migration fail-safe for cPanel/production.
     */
    private function ensureSchema()
    {
        if (!Schema::hasColumn('peraturans', 'tahun')) {
            try {
                Schema::table('peraturans', function ($table) {
                    if (!Schema::hasColumn('peraturans', 'tahun')) $table->integer('tahun')->nullable();
                    if (!Schema::hasColumn('peraturans', 'link_download')) $table->string('link_download', 1000)->nullable();
                    if (!Schema::hasColumn('peraturans', 'file_name')) $table->string('file_name')->nullable();
                    if (!Schema::hasColumn('peraturans', 'urutan')) $table->integer('urutan')->default(0);
                });
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Tampilan Publik Regulasi (/profil-regulasi.html & /regulasi)
     */
    public function publicIndex(Request $request)
    {
        $this->ensureSchema();

        $profil = ProfilPpid::where('type', 'regulasi')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();

        $query = Peraturan::where('is_active', true);

        // Search filter
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($w) use ($q) {
                $w->where('judul', 'like', "%{$q}%")
                  ->orWhere('nomor', 'like', "%{$q}%")
                  ->orWhere('deskripsi', 'like', "%{$q}%")
                  ->orWhere('tahun', 'like', "%{$q}%");
            });
        }

        // Category filter
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        $allRegulasi = $query->orderBy('urutan', 'asc')->orderBy('tahun', 'desc')->orderBy('id', 'asc')->get();
        $peraturanGrouped = $allRegulasi->groupBy('kategori');

        $categories = Peraturan::where('is_active', true)->select('kategori')->distinct()->pluck('kategori');

        return view('profil-regulasi', compact('profil', 'settings', 'allRegulasi', 'peraturanGrouped', 'categories'));
    }

    /**
     * Admin Index (/admin/regulasi)
     */
    public function index(Request $request)
    {
        $this->ensureSchema();

        $query = Peraturan::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($w) use ($q) {
                $w->where('judul', 'like', "%{$q}%")
                  ->orWhere('nomor', 'like', "%{$q}%")
                  ->orWhere('deskripsi', 'like', "%{$q}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        $peraturans = $query->orderBy('urutan', 'asc')->orderBy('tahun', 'desc')->paginate(20)->withQueryString();
        $categories = Peraturan::select('kategori')->distinct()->pluck('kategori');

        return view('admin.regulasi.index', compact('peraturans', 'categories'));
    }

    /**
     * Admin Create Form
     */
    public function create()
    {
        $this->ensureSchema();
        $categories = ['Undang-Undang', 'Komisi Informasi Pusat', 'Kementerian Perhubungan', 'PKTJ Tegal', 'Peraturan Pemerintah', 'Umum'];
        return view('admin.regulasi.create', compact('categories'));
    }

    /**
     * Admin Store
     */
    public function store(Request $request)
    {
        $this->ensureSchema();

        $request->validate([
            'judul' => 'required|string|max:500',
            'kategori' => 'required|string|max:100',
            'tahun' => 'nullable|integer',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        $data = $request->only(['judul', 'nomor', 'tahun', 'deskripsi', 'kategori', 'link_download', 'urutan']);
        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $request->input('urutan', 0);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('regulasi', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
            $data['file_name'] = $file->getClientOriginalName();
        }

        Peraturan::create($data);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil ditambahkan ke database!');
    }

    /**
     * Admin Edit Form
     */
    public function edit($id)
    {
        $this->ensureSchema();
        $peraturan = Peraturan::findOrFail($id);
        $categories = ['Undang-Undang', 'Komisi Informasi Pusat', 'Kementerian Perhubungan', 'PKTJ Tegal', 'Peraturan Pemerintah', 'Umum'];
        return view('admin.regulasi.edit', compact('peraturan', 'categories'));
    }

    /**
     * Admin Update
     */
    public function update(Request $request, $id)
    {
        $this->ensureSchema();
        $peraturan = Peraturan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:500',
            'kategori' => 'required|string|max:100',
            'tahun' => 'nullable|integer',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        $data = $request->only(['judul', 'nomor', 'tahun', 'deskripsi', 'kategori', 'link_download', 'urutan']);
        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $request->input('urutan', 0);

        if ($request->hasFile('file_dokumen')) {
            if ($peraturan->file_path && !str_starts_with($peraturan->file_path, 'http')) {
                $oldPath = str_replace('storage/', '', $peraturan->file_path);
                Storage::disk('public')->delete($oldPath);
            }
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('regulasi', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
            $data['file_name'] = $file->getClientOriginalName();
        }

        $peraturan->update($data);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil diperbarui!');
    }

    /**
     * Admin Destroy
     */
    public function destroy($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        if ($peraturan->file_path && !str_starts_with($peraturan->file_path, 'http')) {
            $oldPath = str_replace('storage/', '', $peraturan->file_path);
            Storage::disk('public')->delete($oldPath);
        }
        $peraturan->delete();

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil dihapus dari database!');
    }
}
