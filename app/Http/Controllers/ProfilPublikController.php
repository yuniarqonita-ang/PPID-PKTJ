<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use App\Models\Peraturan;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ProfilPublikController extends Controller
{
    /**
     * Helper to process content and apply blur to embedded documents
     */
    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;

        // Append is_blurred=1 to any /preview-dokumen URLs in the content
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }

    public function showProfil()
    {
        $profil = ProfilPpid::where('type', 'profil')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
            $profil->gambaran = $this->processContent($profil->gambaran, $profil->is_blurred ?? false);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $profil->is_blurred ?? false);
                }
                $profil->additional_sections = $sections;
            }
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-ppid', compact('profil', 'settings'));
    }

    public function showTugas()
    {
        $profil = ProfilPpid::where('type', 'tugas')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $profil->is_blurred ?? false);
                }
                $profil->additional_sections = $sections;
            }
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-tugas-tanggung-jawab', compact('profil', 'settings'));
    }

    public function showVisi()
    {
        $profil = ProfilPpid::where('type', 'visi')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-visi-misi', compact('profil', 'settings'));
    }

    public function showStruktur()
    {
        $profil = ProfilPpid::where('type', 'struktur')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-struktur-organisasi', compact('profil', 'settings'));
    }

    public function showRegulasi()
    {
        $profil = ProfilPpid::where('type', 'regulasi')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $peraturan = Peraturan::where('is_active', true)->orderBy('created_at', 'desc')->get()->groupBy('kategori');
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-regulasi', compact('profil', 'peraturan', 'settings'));
    }

    public function showKontak()
    {
        $profil = ProfilPpid::where('type', 'kontak')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-kontak', compact('profil', 'settings'));
    }

    /**
     * Generic method for dynamic pages (SOP, Maklumat, Laporan)
     */
    public function showPage($type, $view = null)
    {
        $profil = ProfilPpid::where('type', $type)->first();
        $isBlurred = $profil->is_blurred ?? false;
        
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $isBlurred);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $isBlurred);
            $profil->gambaran = $this->processContent($profil->gambaran, $isBlurred);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $isBlurred);
                }
                $profil->additional_sections = $sections;
            }
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();
        
        // Process dashboard fields if they contain previews
        $dashboardFields = ['isi_maklumat', 'isi_standar', 'isi_konten', 'isi_laporan', 'ringkasan_eksekutif'];
        $pfx = str_replace('-', '_', $type);
        foreach ($dashboardFields as $field) {
            $key = $pfx . '_' . $field;
            if (isset($settings[$key])) {
                $settings[$key] = $this->processContent($settings[$key], $isBlurred);
            }
        }
        
        // If view is not provided, try to find a matching view or use a default
        $viewName = $view ?? $type;
        
        // Special case: Daftar Informasi Publik needs all info types
        $extraData = [];
        if ($type === 'layanan-daftar') {
            $query = \App\Models\DaftarInformasi::where('aktif', true);
            
            // Search filters
            if (request('informasi')) {
                $query->where('judul_informasi', 'like', '%' . request('informasi') . '%');
            }
            if (request('ringkasan')) {
                $query->where('isi_informasi', 'like', '%' . request('ringkasan') . '%');
            }
            if (request('tahun')) {
                $query->where('waktu_pembuatan', 'like', '%' . request('tahun') . '%');
            }
            if (request('penanggung_jawab')) {
                $query->where('penanggung_jawab', 'like', '%' . request('penanggung_jawab') . '%');
            }

            // Category filter
            if (request('kategori')) {
                $query->where('kategori', request('kategori'));
            }

            $items = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
            
            // Apply Premium Blur to Ringkasan Informasi (isi_informasi)
            foreach ($items as $di_item) {
                if ($di_item->isi_informasi) {
                    $di_item->isi_informasi = $this->processContent($di_item->isi_informasi, $di_item->is_blurred ?? false);
                }
            }
            
            $extraData['items'] = $items;
            
            // Get available years for dropdown
            $extraData['years'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(waktu_pembuatan) as tahun')
                ->whereNotNull('waktu_pembuatan')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');

            // Get available units for dropdown
            $extraData['units'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(penanggung_jawab) as unit')
                ->whereNotNull('penanggung_jawab')
                ->orderBy('unit', 'asc')
                ->pluck('unit');
        }

        // Fetch reports dynamically based on type
        if ($type === 'laporan-layanan') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Layanan')->latest()->get();
        } elseif ($type === 'laporan-akses') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Akses')->latest()->get();
        } elseif ($type === 'laporan-survey') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Survey')->latest()->get();
        }

        // Check if view exists, otherwise use a generic skeleton
        if (!view()->exists($viewName)) {
            $viewName = str_replace('-', '_', $viewName);
            if (!view()->exists($viewName)) {
                return view('profil-ppid', array_merge(compact('profil', 'settings'), $extraData));
            }
        }

        return view($viewName, array_merge(compact('profil', 'settings'), $extraData));
    }

    /**
     * Preview Document in-page
     */
    public function previewDokumen(\Illuminate\Http\Request $request)
    {
        $file_path = $request->query('file');
        $title = $request->query('title');

        if (!$file_path) {
            abort(404, 'File path is required');
        }

        // Search for is_blurred flag
        $isBlurred = false;
        
        // 1. Priority: Explicit flag from request (used by TinyMCE button)
        if ($request->has('is_blurred')) {
            $isBlurred = $request->query('is_blurred') == '1';
        } else {
            // 2. Secondary: Check database based on file path
            // Handle both with and without 'storage/' prefix for matching
            $pathWithStorage = str_starts_with($file_path, 'storage/') ? $file_path : 'storage/' . $file_path;
            $pathWithoutStorage = str_replace('storage/', '', $file_path);
            
            $di = \App\Models\DaftarInformasi::where('file_informasi', $pathWithStorage)
                ->orWhere('file_informasi', $pathWithoutStorage)
                ->orWhere('image', $pathWithStorage)
                ->orWhere('image', $pathWithoutStorage)
                ->first();

            if ($di) {
                $isBlurred = (bool)$di->is_blurred;
            }
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();

        return view('preview-dokumen', compact('file_path', 'title', 'settings', 'isBlurred'));
    }

    /**
     * Proxy to fetch GDrive file and serve it with proper CORS/PDF headers
     */
    public function proxyGdrive($id)
    {
        // Try multiple export/download URLs depending on the file type
        // 1. Direct download for PDFs
        // 2. Export for Google Docs/Sheets/Slides
        
        $urls = [
            "https://drive.google.com/uc?id={$id}&export=download",
            "https://drive.google.com/file/d/{$id}/view",
            "https://docs.google.com/document/d/{$id}/export?format=pdf",
            "https://docs.google.com/spreadsheets/d/{$id}/export?format=pdf",
            "https://docs.google.com/presentation/d/{$id}/export?format=pdf",
            "https://drive.google.com/viewer?id={$id}"
        ];

        foreach ($urls as $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
            
            $body = curl_exec($ch);
            $info = curl_getinfo($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($body !== false && $info['http_code'] === 200) {
                $contentType = strtolower($info['content_type'] ?? '');
                $isPdfHeader = strpos($body, '%PDF-') === 0;

                // Google Drive often returns application/octet-stream for downloads
                if (strpos($contentType, 'application/pdf') !== false || 
                    (strpos($contentType, 'application/octet-stream') !== false && $isPdfHeader) ||
                    $isPdfHeader) {
                    
                    return response($body, 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="document.pdf"',
                        'Cache-Control' => 'public, max-age=3600'
                    ]);
                }
            }
        }

        abort(404, 'Gagal mengambil dokumen dari Google Drive atau format tidak didukung');
    }

    /**
     * View PDF peraturan (Premium Blur)
     */
    public function viewPeraturan($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        return view('preview-dokumen', [
            'file' => 'storage/' . $peraturan->file_path,
            'title' => $peraturan->judul,
            'is_blurred' => 0 // Peraturan biasanya tidak blur
        ]);
    }
}
