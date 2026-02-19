<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics Data
        $stats = [
            'totalBerita'     => Schema::hasTable('beritas') ? DB::table('beritas')->count() : 0,
            'totalGaleri'     => rand(12, 25),  // Demo data - akan diganti dengan real data nanti
            'totalVideo'      => rand(8, 18),   // Demo data - akan diganti dengan real data nanti
            'totalAgenda'     => rand(5, 15),   // Demo data - akan diganti dengan real data nanti
            'totalDokumen'    => Schema::hasTable('dokumens') ? DB::table('dokumens')->count() : 0,
            'totalFaq'        => Schema::hasTable('faqs') ? DB::table('faqs')->count() : 0,
        ];

        // Top 5 Popular News - Safe query (order by created_at desc)
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
                        'views'    => rand(100, 5000),  // Demo - views column tidak ada di table
                        'created'  => isset($item->created_at) ? Carbon::parse($item->created_at)->format('d M Y') : 'Unknown'
                    ];
                });
        }

        // Visitor Statistics by Month (Current Year)
        $currentYear = now()->year;
        $visitorData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        foreach (range(1, 12) as $month) {
            $visitorData[] = [
                'bulan'    => $months[$month - 1],
                'visitors' => rand(15000, 45000) // Demo data - ganti dengan real data nanti
            ];
        }

        // Visitor Website Metrics
        $visitorMetrics = [
            'online'           => rand(50, 200),
            'today'            => rand(2000, 5000),
            'hits_today'       => rand(10000, 30000),
            'yesterday'        => rand(2000, 5000),
            'hits_yesterday'   => rand(10000, 30000),
            'total_visitors'   => rand(500000, 1000000),
            'total_hits'       => rand(5000000, 10000000),
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

    public function users() { return "Halaman User Management"; }
    public function settings() { return "Halaman Settings"; }
}