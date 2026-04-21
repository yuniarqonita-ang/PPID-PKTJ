@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-8 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-10 uppercase font-bold">

        <!-- HERO HEADER SECTION -->
        <div class="relative overflow-hidden bg-gradient-to-br from-[#004a99] to-blue-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-blue-900/40 text-white">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-[#ffc107]/10 rounded-full blur-3xl font-bold"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 font-bold">
                <div class="text-center md:text-left space-y-2 font-bold">
                    <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-black tracking-[0.2em] mb-4 text-[#ffc107]">SISTEM TERINTEGRASI PPID</span>
                    <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-none mb-2">
                        DASHBOARD <br><span class="text-[#ffc107]">ANALYTICS</span>
                    </h1>
                    <p class="text-blue-100/70 text-sm font-medium tracking-widest uppercase">Pusat Kendali Informasi Publik PKTJ Tegal</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-xl p-6 rounded-[2rem] border border-white/10 flex items-center gap-6 shadow-2xl font-bold text-gray-800">
                    <div class="text-center">
                        <p class="text-[9px] font-black opacity-60 mb-1 tracking-widest text-gray-800">ONLINE SEKARANG</p>
                        <div class="flex items-center gap-2 justify-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full animate-ping"></span>
                            <span class="text-3xl font-black text-[#ffc107]">{{ $visitorMetrics['online'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATISTICS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $statItems = [
                    ['val' => $stats['totalBerita'], 'label' => 'Total Berita', 'icon' => 'fa-newspaper', 'color' => '#004a99'],
                    ['val' => $stats['totalGallery'] ?? 0, 'label' => 'Album Gallery', 'icon' => 'fa-images', 'color' => '#ffc107'],
                    ['val' => $stats['totalVideo'] ?? 0, 'label' => 'Total Video', 'icon' => 'fa-video', 'color' => '#17a2b8'],
                    ['val' => $stats['totalAgenda'] ?? 0, 'label' => 'Total Agenda', 'icon' => 'fa-calendar-alt', 'color' => '#28a745'],
                ];
            @endphp

            @foreach($statItems as $item)
            <div class="bg-white rounded-[2rem] p-7 shadow-xl shadow-gray-200/50 ring-1 ring-gray-100 hover:scale-[1.03] transition-all duration-500 group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 text-7xl opacity-[0.03] group-hover:opacity-[0.08] transition-all text-gray-800">
                    <i class="fas {{ $item['icon'] }}"></i>
                </div>
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-gray-200" style="background: {{ $item['color'] }}20; color: {{ $item['color'] }};">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-[#004a99]">{{ number_format($item['val'], 0, ',', '.') }}</p>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $item['label'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- MAIN ANALYTICS SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-gray-800">
            
            <!-- LEFT: CHART & POPULAR -->
            <div class="lg:col-span-2 space-y-8 font-bold">
                
                <!-- TRAFFIC CHART -->
                <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-100 p-8 space-y-8 text-gray-800 uppercase font-bold">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-black text-[#004a99] tracking-widest flex items-center uppercase">
                                <i class="fas fa-chart-line mr-3 text-[#ffc107]"></i> Traffic Kunjungan 2026
                            </h3>
                            <p class="text-[9px] text-gray-400 font-bold tracking-widest mt-1 uppercase">GRAFIK PERBANDINGAN HITS PER BULAN</p>
                        </div>
                        <div class="px-5 py-2 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-black text-[#004a99]">TAHUN 2026</div>
                    </div>
                    <div class="h-80 w-full">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>

                <!-- POPULAR CONTENT -->
                <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-100 p-8 text-gray-800 uppercase font-bold">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-sm font-black text-[#004a99] tracking-widest flex items-center uppercase text-gray-800">
                            <i class="fas fa-fire mr-3 text-[#ffc107]"></i> Berita Terpopuler
                        </h3>
                        <a href="{{ route('admin.berita.index') }}" class="px-5 py-2 bg-blue-50 text-[9px] font-black text-[#004a99] rounded-xl hover:bg-[#004a99] hover:text-white transition-all">MANAJEMEN KONTEN</a>
                    </div>
                    
                    <div class="space-y-4 text-gray-800 uppercase font-bold">
                        @forelse($topNews as $index => $news)
                            <div class="group flex items-center gap-5 p-5 bg-gray-50 rounded-2xl border border-transparent hover:border-blue-100 hover:bg-blue-50/30 transition-all text-gray-800">
                                <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-lg font-black text-[#004a99] shadow-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0 font-bold text-gray-800">
                                    <h4 class="text-xs font-black text-gray-700 truncate group-hover:text-[#004a99] transition-all uppercase tracking-tight">{{ $news->judul }}</h4>
                                    <div class="flex items-center gap-4 mt-1">
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest"><i class="fas fa-eye mr-1 text-[#ffc107]"></i> {{ number_format($news->views ?? 0) }} VIEWS</span>
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest"><i class="fas fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($news->created_at ?? now())->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-gray-200 group-hover:text-[#004a99] transition-all"></i>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <i class="fas fa-folder-open text-3xl text-gray-200 mb-3 block"></i>
                                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Belum Ada Berita Populer</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- RIGHT: DETAILED METRICS -->
            <div class="space-y-6 text-gray-800 font-bold">
                
                <div class="bg-[#004a99] rounded-[2.5rem] shadow-2xl p-8 text-white relative overflow-hidden font-bold">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] mb-6 flex items-center text-[#ffc107] font-bold">
                        <i class="fas fa-tachometer-alt mr-2 text-gray-800"></i> Lifetime Metrics
                    </h3>

                    <div class="space-y-6 font-bold text-gray-800">
                        <div class="p-5 bg-white/10 rounded-2xl border border-white/10 text-gray-800">
                            <p class="text-[8px] font-black opacity-60 uppercase mb-1 tracking-widest text-gray-800">TOTAL PENGUNJUNG</p>
                            <p class="text-3xl font-black text-[#ffc107]">{{ number_format($visitorMetrics['total_visitors'], 0, ',', '.') }}</p>
                        </div>
                        <div class="p-5 bg-white/10 rounded-2xl border border-white/10 text-gray-800">
                            <p class="text-[8px] font-black opacity-60 uppercase mb-1 tracking-widest">TOTAL HITS KLIK</p>
                            <p class="text-3xl font-black">{{ number_format($visitorMetrics['total_hits'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-100 p-8 space-y-6 text-gray-800 font-bold uppercase">
                    <h3 class="text-[10px] font-black text-[#004a99] uppercase tracking-widest border-b pb-4 flex items-center font-bold">
                        <i class="fas fa-history mr-2 text-[#ffc107]"></i> Aktivitas Hari Ini
                    </h3>
                    
                    <div class="space-y-4 text-gray-800 font-bold">
                        <div class="flex items-center justify-between font-bold text-gray-800">
                            <div>
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">UNIQ VISITORS</p>
                                <p class="text-lg font-black text-gray-700">{{ number_format($visitorMetrics['today'], 0, ',', '.') }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#004a99] flex items-center justify-center">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="border-t border-gray-50 pt-4 flex items-center justify-between font-bold text-gray-800">
                            <div>
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">PAGE HITS</p>
                                <p class="text-lg font-black text-gray-700">{{ number_format($visitorMetrics['hits_today'], 0, ',', '.') }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#ffc107] flex items-center justify-center">
                                <i class="fas fa-mouse-pointer"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SYSTEM STATUS -->
                <div class="bg-emerald-50 rounded-[2rem] p-6 border border-emerald-100 font-bold text-gray-800 uppercase">
                    <div class="flex items-center gap-4 font-bold text-gray-800">
                        <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xl shadow-lg shadow-emerald-500/20">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-emerald-800 uppercase tracking-tight">SISTEM NORMAL</p>
                            <p class="text-[8px] font-black text-emerald-600/60 uppercase tracking-widest">SYNC READY: {{ $last_update }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ANALYTICS ENGINE -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    
    // Gradient definition
    let blueGradient = ctx.createLinearGradient(0, 0, 0, 300);
    blueGradient.addColorStop(0, 'rgba(0, 74, 153, 0.4)');
    blueGradient.addColorStop(1, 'rgba(0, 74, 153, 0)');

    const visitorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'],
            datasets: [{
                label: 'PENGUNJUNG HITS ',
                data: [45, 52, 38, 65, 48, 55, 40, 60, 42, 58, 45, 70], // Sample data, backend integration expected
                borderColor: '#004a99',
                backgroundColor: blueGradient,
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ffc107',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)' },
                    ticks: { font: { size: 9, weight: 'bold' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 9, weight: 'bold' } }
                }
            }
        }
    });
</script>

<style>
    canvas { filter: drop-shadow(0 10px 15px rgba(0, 74, 153, 0.1)); }
    .animate-fade-in-down { animation: fadeInDown 0.5s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
