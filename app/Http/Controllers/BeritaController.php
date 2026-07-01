<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sq) use ($q) {
                $sq->where('judul', 'like', "%{$q}%")
                   ->orWhere('konten', 'like', "%{$q}%");
            });
        }

        $beritas = $query->paginate(10)->withQueryString();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'konten'  => 'required',
            'gambar'  => 'nullable|image|max:5120',
            'tanggal' => 'nullable|date',
        ]);

        // Hanya kolom yang ada di tabel beritas
        $data = [
            'judul'    => $request->judul,
            'slug'     => Str::slug($request->judul) . '-' . time(),
            'konten'   => $request->konten,
            'kategori' => $request->kategori ?? 'Berita Utama',
            'tags'     => $request->tags,
            'aktif'    => 1,
            'is_blurred' => $request->has('is_blurred'),
            'tanggal'  => $request->input('tanggal', now()->format('Y-m-d')),
            'views'    => 0,
        ];

        if ($request->hasFile('gambar')) {
            $file     = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('berita')) {
                Storage::disk('public')->makeDirectory('berita');
            }
            $file->storeAs('berita', $filename, 'public');
            $data['gambar'] = 'berita/' . $filename;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan dan langsung tampil di beranda!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'konten'  => 'required',
            'gambar'  => 'nullable|image|max:5120',
            'tanggal' => 'nullable|date',
        ]);

        $berita = Berita::findOrFail($id);

        $berita->judul    = $request->judul;
        $berita->slug     = Str::slug($request->judul) . '-' . $berita->id;
        $berita->konten   = $request->konten;
        $berita->kategori = $request->kategori ?? $berita->kategori ?? 'Berita Utama';
        $berita->tags     = $request->tags;
        $berita->aktif    = 1; // selalu aktif/published
        $berita->is_blurred = $request->has('is_blurred');
        if ($request->filled('tanggal')) {
            $berita->tanggal = $request->tanggal;
        }

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $file     = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('berita')) {
                Storage::disk('public')->makeDirectory('berita');
            }
            $file->storeAs('berita', $filename, 'public');
            $berita->gambar = 'berita/' . $filename;
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Public: Daftar semua berita
     */
    public function publicIndex()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $beritas  = Berita::where('aktif', true)->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(9);
        return view('berita.index', compact('beritas', 'settings'));
    }

    /**
     * Public: Detail berita
     */
    public function publicShow($slug)
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $berita   = Berita::where('slug', $slug)->where('aktif', true)->firstOrFail();
        $berita->increment('views');
        
        // Apply Premium Blur logic to content
        $berita->konten = $this->processContent($berita->konten, $berita->is_blurred ?? false);
        
        $related = Berita::where('aktif', true)->where('id', '!=', $berita->id)->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->take(3)->get();
        return view('berita.show', compact('berita', 'related', 'settings'));
    }

    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }
}