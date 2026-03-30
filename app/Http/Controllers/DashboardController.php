<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics Data (real counts from DB)
        $stats = [
            'totalBerita'     => Schema::hasTable('beritas') ? DB::table('beritas')->count() : 0,
            'totalGaleri'     => 0,
            'totalVideo'      => 0,
            'totalAgenda'     => 0,
            'totalDokumen'    => 0,
            'totalFaq'        => 0,
        ];

        // Top 5 Latest News
        $topNews = collect([]);
        if (Schema::hasTable('beritas')) {
            $topNews = DB::table('beritas')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'id'       => $item->id ?? 0,
                        'judul'    => $item->judul ?? 'Untitled',
                        'views'    => 0,
                        'created'  => isset($item->created_at) ? Carbon::parse($item->created_at)->format('d M Y') : 'Unknown'
                    ];
                });
        }

        // Visitor Statistics by Month (all 0 — belum ada tracking pengunjung)
        $currentYear = now()->year;
        $visitorData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        foreach (range(1, 12) as $month) {
            $visitorData[] = [
                'bulan'    => $months[$month - 1],
                'visitors' => 0
            ];
        }

        // Visitor Website Metrics (all 0 — belum ada tracking pengunjung)
        $visitorMetrics = [
            'online'           => 0,
            'today'            => 0,
            'hits_today'       => 0,
            'yesterday'        => 0,
            'hits_yesterday'   => 0,
            'total_visitors'   => 0,
            'total_hits'       => 0,
        ];

        $data = [
            'stats'           => $stats,
            'topNews'         => $topNews,
            'visitorData'     => json_encode($visitorData),
            'visitorMetrics'  => $visitorMetrics,
            'currentYear'     => $currentYear,
            'last_update'     => date('d M Y H:i')
        ];

        return view('admin.dashboard', $data);
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
        ];

        foreach ($settings as $key => $value) {
            Dashboard::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => 'text',
                    'description' => $this->getDescription($key),
                    'aktif' => true
                ]
            );
        }

        return redirect()->route('admin.dashboard.edit')->with('success', 'Dashboard berhasil diperbarui!');
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
        ];

        return $descriptions[$key] ?? 'Pengaturan dashboard';
    }

    public function users() { return "Halaman User Management"; }
    public function settings() { return "Halaman Settings"; }
}