<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\Dashboard;
use App\Models\Permohonan;
use App\Models\Keberatan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics Data (real counts from DB)
        $stats = [
            'totalBerita'  => Schema::hasTable('beritas')   ? DB::table('beritas')->count()   : 0,
            'totalAgenda'  => Schema::hasTable('agendas')   ? DB::table('agendas')->count()   : 0,
            'totalFaq'     => Schema::hasTable('faqs')      ? DB::table('faqs')->count()      : 0,
            'totalGaleri'  => 0,
            'totalVideo'   => 0,
            'totalDokumen' => 0,
        ];

        // Top 5 Latest News — keep as DB objects so $news->judul / $news->created_at work in Blade
        $topNews = collect([]);
        if (Schema::hasTable('beritas')) {
            $topNews = DB::table('beritas')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Visitor Statistics by Month
        $currentYear = now()->year;
        $visitorData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        foreach (range(1, 12) as $month) {
            $visitorData[] = ['bulan' => $months[$month - 1], 'visitors' => 0];
        }

        $visitorMetrics = [
            'online' => 0, 'today' => 0, 'hits_today' => 0,
            'yesterday' => 0, 'hits_yesterday' => 0,
            'total_visitors' => 0, 'total_hits' => 0,
        ];

        // ── DATA MASUK: Permohonan ──
        $permohonanStats = ['total' => 0, 'pending' => 0, 'selesai' => 0, 'bulan_ini' => 0];
        $recentPermohonan = collect([]);
        if (Schema::hasTable('permohonan')) {
            $permohonanStats['total']     = Permohonan::count();
            $permohonanStats['pending']   = Permohonan::where('status', 'menunggu')->count();
            $permohonanStats['selesai']   = Permohonan::where('status', 'selesai')->count();
            $permohonanStats['bulan_ini'] = Permohonan::whereMonth('created_at', now()->month)
                                                        ->whereYear('created_at', now()->year)->count();
            $recentPermohonan = Permohonan::latest()->limit(5)->get();
        }

        // ── DATA MASUK: Keberatan ──
        $keberatanStats = ['total' => 0, 'pending' => 0, 'selesai' => 0, 'bulan_ini' => 0];
        $recentKeberatan = collect([]);
        if (Schema::hasTable('keberatans')) {
            $keberatanStats['total']     = Keberatan::count();
            $keberatanStats['pending']   = Keberatan::whereNull('tanggal_tanggapan_keberatan')->count();
            $keberatanStats['selesai']   = Keberatan::whereNotNull('tanggal_tanggapan_keberatan')->count();
            $keberatanStats['bulan_ini'] = Keberatan::whereMonth('created_at', now()->month)
                                                      ->whereYear('created_at', now()->year)->count();
            $recentKeberatan = Keberatan::latest()->limit(5)->get();
        }

        return view('admin.dashboard', [
            'stats'             => $stats,
            'topNews'           => $topNews,
            'visitorData'       => json_encode($visitorData),
            'visitorMetrics'    => $visitorMetrics,
            'currentYear'       => $currentYear,
            'last_update'       => date('d M Y H:i'),
            'permohonanStats'   => $permohonanStats,
            'recentPermohonan'  => $recentPermohonan,
            'keberatanStats'    => $keberatanStats,
            'recentKeberatan'   => $recentKeberatan,
        ]);
    }

    public function edit()
    {
        return view('admin.dashboard.edit');
    }

    public function update(Request $request)
    {
        $settings = [
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'bg_color' => $request->bg_color,
            'video_url' => $request->video_url,
            'video_title' => $request->video_title,
            'app_eppid' => $request->app_eppid,
            'app_lpse' => $request->app_lpse,
            'app_jdih' => $request->app_jdih,
            'app_sistem' => $request->app_sistem,
            'ppid_nama' => $request->ppid_nama,
            'ppid_deskripsi' => $request->ppid_deskripsi,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'twitter_link' => $request->twitter_link,
            'kontak_alamat' => $request->kontak_alamat,
            'kontak_telepon' => $request->kontak_telepon,
            'kontak_email' => $request->kontak_email,
            'youtube_link' => $request->youtube_link,
        ];

        // Handle Video Thumbnail Upload
        if ($request->hasFile('video_thumbnail')) {
            $file = $request->file('video_thumbnail');
            $filename = 'yt_thumb_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/dashboard', $filename);
            $settings['video_thumbnail'] = str_replace('public/', '', $path);
        }

        foreach ($settings as $key => $value) {
            Dashboard::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'type' => ($key === 'video_thumbnail' ? 'image' : 'text'),
                    'description' => $this->getDescription($key),
                    'aktif' => true
                ]
            );
        }

        return redirect()->route('dashboard.edit')->with('success', 'Dashboard berhasil diperbarui!');
    }

    private function getDescription($key)
    {
        $descriptions = [
            'hero_title' => 'Judul utama di hero section',
            'hero_subtitle' => 'Subjudul di hero section',
            'primary_color' => 'Warna primer tema',
            'secondary_color' => 'Warna sekunder tema',
            'bg_color' => 'Warna background halaman',
            'video_url' => 'URL video YouTube',
            'video_title' => 'Judul video layanan',
            'app_eppid' => 'Link aplikasi E-PPID Kemenhub',
            'app_lpse' => 'Link aplikasi LPSE PKTJ',
            'app_jdih' => 'Link aplikasi JDIH PKTJ',
            'app_sistem' => 'Link sistem informasi PKTJ',
            'ppid_nama' => 'Nama PPID',
            'ppid_deskripsi' => 'Deskripsi PPID',
            'facebook_link' => 'Link Facebook resmi',
            'instagram_link' => 'Link Instagram resmi',
            'twitter_link' => 'Link Twitter/X resmi',
            'youtube_link' => 'Link YouTube resmi',
            'kontak_alamat' => 'Alamat kantor resmi',
            'kontak_telepon' => 'Nomor telepon resmi',
            'kontak_email' => 'Email resmi',
        ];

        return $descriptions[$key] ?? 'Pengaturan dashboard';
    }

    public function users() { return "Halaman User Management"; }
    public function settings() { return "Halaman Settings"; }
}