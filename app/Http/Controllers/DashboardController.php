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
        $currentYear = date('Y');
        // Statistics Data (real counts from DB)
        $stats = [
            'totalBerita'  => Schema::hasTable('beritas')   ? DB::table('beritas')->count()   : 0,
            'totalAgenda'  => Schema::hasTable('agendas')   ? DB::table('agendas')->count()   : 0,
            'totalFaq'     => Schema::hasTable('faqs')      ? DB::table('faqs')->count()      : 0,
            'totalGaleri'  => Schema::hasTable('galeris')   ? DB::table('galeris')->count()   : 0,
            'totalVideo'   => Schema::hasTable('videos')    ? DB::table('videos')->count()    : 0,
            'totalDokumen' => Schema::hasTable('dokumens')  ? DB::table('dokumens')->count()  : 0,
        ];

        // Top 5 Latest News
        $topNews = collect([]);
        if (Schema::hasTable('beritas')) {
            $topNews = DB::table('beritas')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Visitor Statistics by Day (Last 30 Days Daily Trend)
        $visitorData = [];
        if (Schema::hasTable('visitors')) {
            $startDate = now()->subDays(29)->toDateString();
            $dailyCounts = DB::table('visitors')
                ->selectRaw('tanggal, count(*) as count')
                ->where('tanggal', '>=', $startDate)
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->pluck('count', 'tanggal')
                ->toArray();
            
            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();
                $label = now()->subDays($i)->translatedFormat('d M');
                $count = $dailyCounts[$date] ?? 0;
                $visitorData[] = ['bulan' => $label, 'count' => $count];
            }
        } else {
            // Fallback empty data
            for ($i = 29; $i >= 0; $i--) {
                $label = now()->subDays($i)->translatedFormat('d M');
                $visitorData[] = ['bulan' => $label, 'count' => 0];
            }
        }

        $visitorMetrics = [
            'online' => 1, 
            'today' => 0, 
            'hits_today' => 0,
            'yesterday' => 0, 
            'hits_yesterday' => 0,
            'total_visitors' => 0, 
            'total_hits' => 0,
        ];

        if (Schema::hasTable('visitors')) {
            $visitorMetrics['today'] = DB::table('visitors')->whereDate('tanggal', Carbon::today())->count();
            $visitorMetrics['yesterday'] = DB::table('visitors')->whereDate('tanggal', Carbon::yesterday())->count();
            $visitorMetrics['total_visitors'] = DB::table('visitors')->count();
            
            // Calculate active online users in last 10 minutes (based on distinct IP addresses)
            $onlineCount = DB::table('visitors')
                ->where('created_at', '>=', now()->subMinutes(10))
                ->distinct('ip')
                ->count();
            $visitorMetrics['online'] = max(1, $onlineCount); // minimum 1 (current user)
        }

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
            'hero_content' => $request->hero_content,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'bg_color' => $request->bg_color,
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
            'list_penanggung_jawab' => $request->list_penanggung_jawab,
            'hero_video_link' => $request->hero_video_link,
        ];

        // Handle Hero Background Video Upload
        if ($request->hasFile('hero_video_file')) {
            $file = $request->file('hero_video_file');
            $filename = 'hero_vid_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/dashboard', $filename);
            $settings['hero_video_file'] = str_replace('public/', '', $path);
        }

        foreach ($settings as $key => $value) {
            Dashboard::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'type' => (in_array($key, ['video_thumbnail', 'hero_video_file']) ? 'file' : 'text'),
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
            'hero_content' => 'Konten kustom editor teks / HTML di hero banner',
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
            'premium_view_enabled' => 'Aktifkan fitur blur dokumen premium',
            'premium_view_blur_text' => 'Teks yang muncul di atas blur dokumen',
            'premium_view_button_text' => 'Teks tombol di atas blur',
            'premium_view_button_link' => 'Link tujuan tombol di atas blur',
            'list_penanggung_jawab' => 'Daftar penanggung jawab (Pisahkan dengan baris baru)',
            'hero_video_link' => 'Link YouTube atau direct MP4 video background hero',
            'hero_video_file' => 'File video background hero (.mp4)',
        ];

        return $descriptions[$key] ?? 'Pengaturan dashboard';
    }

    public function users() { return "Halaman User Management"; }
    public function settings() { return "Halaman Settings"; }
}