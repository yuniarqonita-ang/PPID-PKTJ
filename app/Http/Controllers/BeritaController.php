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
     * Admin: Sinkronkan berita langsung dari PKTJ.ac.id
     */
    public function syncPktjNews(Request $request)
    {
        $service = app(\App\Services\PktjNewsService::class);
        $result = $service->syncToDatabase();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Berhasil menyinkronkan {$result['new']} berita baru dan memperbarui {$result['updated']} berita dari PKTJ.ac.id!",
                'data'    => $result,
            ]);
        }

        return redirect()->route('admin.berita.index')->with(
            'success',
            "Sinkronisasi Berita PKTJ.ac.id Berhasil! ({$result['new']} berita baru ditambahkan, {$result['updated']} diperbarui pada {$result['timestamp']})."
        );
    }

    /**
     * Admin: Bersihkan berita dummy
     */
    public function cleanDummy(Request $request)
    {
        $service = app(\App\Services\PktjNewsService::class);
        $deleted = $service->cleanDummyNews();

        return redirect()->route('admin.berita.index')->with(
            'success',
            "Pembersihan selesai. Sebanyak {$deleted} data berita dummy/patrick berhasil dihapus."
        );
    }

    /**
     * Public: Daftar semua berita (Realtime PKTJ.ac.id + Kategori)
     */
    public function publicIndex(Request $request)
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $service = app(\App\Services\PktjNewsService::class);

        $kategoriAktif = $request->query('kategori', 'Semua');
        $searchQuery   = $request->query('search');

        // Ambil berita realtime dari PKTJ.ac.id
        $allNews = $service->getNewsByCategory($kategoriAktif, 40);

        if (!empty($searchQuery)) {
            $q = strtolower($searchQuery);
            $allNews = array_filter($allNews, function ($item) use ($q) {
                return str_contains(strtolower($item['judul'] ?? ''), $q) ||
                       str_contains(strtolower($item['konten'] ?? ''), $q);
            });
            $allNews = array_values($allNews);
        }

        // Pagination array manual
        $page = (int) $request->query('page', 1);
        $perPage = 9;
        $totalItems = count($allNews);
        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = array_slice($allNews, $offset, $perPage);

        $paginatedNews = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurrentPage,
            $totalItems,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $kategoriList = [
            'Semua',
            'Liputan/Berita',
            'Karir',
            'Pengumuman',
            'Pendidikan',
            'Seputar Kampus',
        ];

        return view('berita.index', compact('paginatedNews', 'kategoriList', 'kategoriAktif', 'searchQuery', 'settings'));
    }

    /**
     * Public: Detail berita
     */
    public function publicShow($slug)
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $berita   = Berita::where('slug', $slug)->where('aktif', true)->first();

        if (!$berita) {
            // Coba cari dari live feed jika baru
            $service = app(\App\Services\PktjNewsService::class);
            $liveNews = $service->getLiveNews(40);
            foreach ($liveNews as $item) {
                if ($item['slug'] === $slug || str_contains($item['link'], $slug)) {
                    return redirect()->away($item['link']);
                }
            }
            abort(404, 'Berita tidak ditemukan.');
        }

        // Jika berita adalah link eksternal ke PKTJ.ac.id
        if ($berita->is_external && $berita->link_sumber && filter_var($berita->link_sumber, FILTER_VALIDATE_URL)) {
            // Bisa langsung redirect ke official pktj.ac.id jika diinginkan, atau tampilkan halaman detail dengan tombol rujukan
        }

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