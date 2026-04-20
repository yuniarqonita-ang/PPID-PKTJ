@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    <!-- WELCOME HEADER - MAXIMUM CLARITY -->
    <div class="bg-gradient-to-br from-[#002b5c] via-[#003d7a] to-[#004a99] rounded-[2.5rem] p-10 md:p-14 shadow-2xl text-white relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 space-y-6">
            <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#002b5c]">
                <span class="w-2.5 h-2.5 bg-[#002b5c] rounded-full animate-ping"></span>
                <h2 class="text-[13px] font-black uppercase tracking-[3px]">Status Sistem: Aktif</h2>
            </div>
            
            <div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight text-white">
                    Dashboard <span class="text-[#ffc107]">PPID PKTJ</span>
                </h1>
                <p class="text-blue-50 text-lg md:text-xl font-bold mt-4 max-w-2xl leading-relaxed">
                    Selamat datang di pusat kendali informasi publik. Semua data sinkron dan siap dikelola.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN STATISTICS - CLEAR FONTS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
            $statItems = [
                ['val' => $stats['totalBerita'], 'label' => 'Total Publikasi', 'icon' => 'fa-newspaper', 'color' => '#004a99', 'bg' => 'bg-blue-50'],
                ['val' => $stats['totalGallery'] ?? 0, 'label' => 'Visual Asset', 'icon' => 'fa-images', 'color' => '#b45309', 'bg' => 'bg-amber-50'],
                ['val' => $stats['totalVideo'] ?? 0, 'label' => 'Video Konten', 'icon' => 'fa-video', 'color' => '#1d4ed8', 'bg' => 'bg-sky-50'],
                ['val' => $stats['totalAgenda'] ?? 12, 'label' => 'Agenda Aktif', 'icon' => 'fa-calendar-check', 'color' => '#047857', 'bg' => 'bg-emerald-50'],
            ];
        @endphp

        @foreach($statItems as $item)
        <div class="bg-white rounded-[2rem] p-8 shadow-md border border-slate-200 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 {{ $item['bg'] }} rounded-2xl flex items-center justify-center text-2xl shadow-inner" style="color: {{ $item['color'] }}">
                    <i class="fas {{ $item['icon'] }}"></i>
                </div>
                <div>
                   <span class="text-[13px] font-black text-[#002b5c] uppercase tracking-widest">STATISTIK TERBARU</span>
                </div>
            </div>
            <h3 class="text-4xl font-black text-[#002b5c] tracking-tighter">{{ number_format($item['val'], 0, ',', '.') }}</h3>
            <p class="text-[14px] font-black text-slate-600 uppercase tracking-widest mt-2">{{ $item['label'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- ANALYTICS AREA -->
        <div class="lg:col-span-2 space-y-10">
            <div class="bg-white rounded-[2.5rem] shadow-md border border-slate-200 p-10">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-[#002b5c] tracking-tight flex items-center">
                            <span class="w-3 h-8 bg-[#ffc107] rounded-full mr-4"></span>
                            Visualisasi Pengunjung
                        </h3>
                        <p class="text-[13px] text-slate-500 font-black uppercase tracking-widest mt-2">Update terakhir: {{ date('d F Y') }}</p>
                    </div>
                </div>
                <div class="h-[400px]">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-md border border-slate-200 p-10">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-black text-[#002b5c] tracking-tight flex items-center">
                        <span class="w-3 h-8 bg-[#ffc107] rounded-full mr-4"></span>
                        Publikasi Terpopuler
                    </h3>
                    <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 bg-[#002b5c] text-[13px] font-black text-white uppercase tracking-widest rounded-xl hover:bg-black transition-all">Semua Publikasi</a>
                </div>
                
                <div class="grid grid-cols-1 gap-5">
                    @forelse($topNews as $index => $news)
                    <div class="flex items-center p-6 rounded-2xl bg-white border-2 border-slate-50 hover:border-[#ffc107] hover:bg-slate-50 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-[#002b5c] flex items-center justify-center font-black text-white mr-6 text-xl shadow-lg group-hover:bg-[#ffc107] group-hover:text-[#002b5c] transition-all">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-black text-[#002b5c] leading-tight">{{ $news->judul }}</h4>
                            <p class="text-[13px] text-slate-700 mt-2 uppercase font-black tracking-widest flex items-center gap-4">
                                <span class="bg-blue-50 px-3 py-1 rounded-md text-[#004a99]">{{ number_format($news->views ?? 0) }} VIEWS</span>
                                <span class="text-slate-500">{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d M Y') }}</span>
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="py-20 text-center">
                        <i class="fas fa-inbox text-5xl text-slate-200 mb-4"></i>
                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Data tidak ditemukan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="space-y-8">
            <!-- REALTIME METRICS -->
            <div class="bg-[#002b5c] rounded-[2.5rem] shadow-xl p-8 text-white">
                <h3 class="text-[13px] font-black text-[#ffc107] uppercase tracking-[3px] mb-8 border-b border-white/10 pb-6">Wawasan Realtime</h3>
                <div class="space-y-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[13px] font-black text-blue-200 uppercase tracking-widest">Online Saat Ini</p>
                            <p class="text-4xl font-black text-white mt-2">
                                {{ $visitorMetrics['online'] ?? 0 }} <span class="text-sm text-[#ffc107] ml-2">PENGGUNA</span>
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white/10 text-[#ffc107] rounded-2xl flex items-center justify-center text-2xl shadow-inner animate-pulse">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[13px] font-black text-blue-200 uppercase tracking-widest">Total Akses Portal</p>
                            <p class="text-4xl font-black text-white mt-2">
                                {{ number_format($visitorMetrics['total_visitors'] ?? 0) }}
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white/10 text-[#ffc107] rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DYNAMIC ACTIONS - MAXIMUM VISIBILITY -->
            <div class="bg-white rounded-[2.5rem] shadow-lg p-10 border-2 border-[#002b5c]">
                <h4 class="text-[13px] font-black text-[#002b5c] uppercase tracking-[3px] mb-8 border-b border-slate-100 pb-6">Aksi Cepat Admin</h4>
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-5 p-5 bg-[#002b5c] rounded-2xl hover:bg-black transition-all group">
                        <div class="w-12 h-12 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-xl">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-sm font-black uppercase text-white tracking-widest">Publikasi Baru</span>
                    </a>
                    <a href="{{ route('admin.permohonan.index') }}" class="flex items-center gap-5 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl hover:border-[#002b5c] transition-all group">
                        <div class="w-12 h-12 bg-white text-[#002b5c] border border-slate-200 rounded-xl flex items-center justify-center text-xl">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span class="text-sm font-black uppercase text-[#002b5c] tracking-widest">Pesan Masuk</span>
                    </a>
                </div>
            </div>

            <!-- SERVER BOX - CLEAR & BOLD -->
            <div class="bg-emerald-50 rounded-[2.5rem] p-8 border-2 border-emerald-100 flex flex-col items-center text-center">
                <p class="text-[13px] font-black text-emerald-800 uppercase tracking-widest mb-4">Keamanan Sistem</p>
                <div class="flex items-center gap-3 py-2 px-6 bg-emerald-500 text-white rounded-full mb-4">
                    <div class="w-2.5 h-2.5 bg-white rounded-full animate-pulse"></div>
                    <p class="text-xs font-black">TEROPTIMAL</p>
                </div>
                <p class="text-[13px] text-emerald-700 font-black">{{ date('d F Y | H:i') }} WIB</p>
            </div>
        </div>
    </div>
</div>

<!-- ANALYTICS ENGINE -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(0, 43, 92, 0.4)');
    gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'],
            datasets: [{
                label: 'Interaksi',
                data: [450, 620, 480, 850, 580, 750, 500, 800, 520, 680, 550, 900],
                borderColor: '#002b5c',
                backgroundColor: gradient,
                borderWidth: 6,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ffc107',
                pointBorderWidth: 4,
                pointRadius: 6,
                pointHoverRadius: 10
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
                    grid: { color: 'rgba(0,0,0,0.05)', borderDash: [5, 5] },
                    ticks: { color: '#002b5c', font: { weight: '900', size: 12, family: 'Inter' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#002b5c', font: { weight: '900', size: 12, family: 'Inter' } }
                }
            }
        }
    });
</script>
@endsection
