@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                Dashboard Analytics
            </h1>
            <p class="text-slate-500 mt-1">Selamat datang kembali di Panel Admin PPID PKTJ</p>
        </div>
        <div class="text-right">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">LAST UPDATE</p>
            <p class="text-sm font-bold text-slate-600">{{ $last_update }}</p>
        </div>
    </div>

    <!-- ==================== STATISTICS CARDS ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Berita -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-5xl font-black opacity-20">📰</span>
                    <span class="text-3xl">📰</span>
                </div>
                <p class="text-sm font-bold text-white/80 uppercase tracking-wider mb-2">Total Berita</p>
                <p class="text-4xl font-black">{{ $stats['totalBerita'] }}</p>
                <p class="text-xs text-white/70 mt-3">Konten berita yang sudah dipublikasikan</p>
            </div>
            <div class="absolute bottom-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mb-10"></div>
        </div>

        <!-- Card 2: Total Galeri -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-400 to-rose-600 p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-5xl font-black opacity-20">🖼️</span>
                    <span class="text-3xl">🖼️</span>
                </div>
                <p class="text-sm font-bold text-white/80 uppercase tracking-wider mb-2">Total Galeri & Album</p>
                <p class="text-4xl font-black">{{ $stats['totalGaleri'] }}</p>
                <p class="text-xs text-white/70 mt-3">Album dan galeri yang tersedia</p>
            </div>
            <div class="absolute bottom-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mb-10"></div>
        </div>

        <!-- Card 3: Total Video -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-400 to-indigo-600 p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-5xl font-black opacity-20">🎬</span>
                    <span class="text-3xl">🎬</span>
                </div>
                <p class="text-sm font-bold text-white/80 uppercase tracking-wider mb-2">Video Upload</p>
                <p class="text-4xl font-black">{{ $stats['totalVideo'] }}</p>
                <p class="text-xs text-white/70 mt-3">Video yang sudah di-publish</p>
            </div>
            <div class="absolute bottom-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mb-10"></div>
        </div>

        <!-- Card 4: Total Agenda -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-5xl font-black opacity-20">📅</span>
                    <span class="text-3xl">📅</span>
                </div>
                <p class="text-sm font-bold text-white/80 uppercase tracking-wider mb-2">Agenda</p>
                <p class="text-4xl font-black">{{ $stats['totalAgenda'] }}</p>
                <p class="text-xs text-white/70 mt-3">Agenda dan acara mendatang</p>
            </div>
            <div class="absolute bottom-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mb-10"></div>
        </div>
    </div>

    <!-- ==================== GRAFIK PENGUNJUNG + DAFTAR PENGUNJUNG ==================== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Chart (2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">📊 Grafik Pengunjung Situs</h2>
                    <p class="text-sm text-slate-500 mt-1">Statistik kunjungan per bulan</p>
                </div>
                <select id="yearSelector" class="px-4 py-2 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:border-blue-400 transition cursor-pointer">
                    <option value="2024">Tahun 2024</option>
                    <option value="2025">Tahun 2025</option>
                    <option value="2026" selected>Tahun 2026</option>
                    <option value="2027">Tahun 2027</option>
                </select>
            </div>
            <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6">
                <canvas id="visitorChart"></canvas>
            </div>
            <div class="mt-4 p-4 background-gradient rounded-lg bg-blue-50 border border-blue-200">
                <p class="text-xs text-blue-800"><strong>📌 Info:</strong> Grafik menunjukkan rentang kunjungan dari 10.000 hingga 50.000 pengunjung per bulan. Pilih tahun untuk melihat data historis.</p>
            </div>
        </div>

        <!-- Visitor Metrics (1 column) -->
        <div class="space-y-4">
            <h3 class="text-2xl font-bold text-slate-800 mb-4">👥 Daftar Pengunjung</h3>

            <!-- Online -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Online Sekarang</p>
                        <p class="text-3xl font-black mt-2">{{ $visitorMetrics['online'] }}</p>
                    </div>
                    <span class="text-2xl animate-pulse">🟢</span>
                </div>
            </div>

            <!-- Today Visitors -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Hari Ini</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['today'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">📈</span>
                </div>
            </div>

            <!-- Today Hits -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-yellow-400 to-amber-600 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Hits Hari Ini</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['hits_today'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">⚡</span>
                </div>
            </div>

            <!-- Yesterday Visitors -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-400 to-red-600 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Kemarin</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['yesterday'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">📊</span>
                </div>
            </div>

            <!-- Yesterday Hits -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-pink-400 to-rose-600 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Hits Kemarin</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['hits_yesterday'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">⚡</span>
                </div>
            </div>

            <!-- Total Visitors -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-violet-700 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Total Pengunjung</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['total_visitors'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">🏆</span>
                </div>
            </div>

            <!-- Total Hits -->
            <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-indigo-500 to-blue-700 p-5 text-white shadow-lg hover:shadow-xl transition hover:scale-105 cursor-pointer">
                <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-8 -mr-8"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-white/80 uppercase tracking-wider">Total Hits</p>
                        <p class="text-3xl font-black mt-2">{{ number_format($visitorMetrics['total_hits'], 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl">💫</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== 5 BERITA TERPOPULER ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">🔥 5 Berita Terpopuler</h2>
                <p class="text-sm text-slate-500 mt-1">Berita dengan jumlah views tertinggi</p>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold text-sm hover:shadow-lg transition">
                Lihat Semua →
            </a>
        </div>

        <!-- News List -->
        <div class="space-y-4">
            @forelse($topNews as $index => $news)
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-slate-50 to-slate-100 p-5 border border-slate-200 hover:border-blue-300 hover:shadow-lg transition duration-300">
                    <div class="flex items-start gap-4">
                        <!-- Badge Ranking -->
                        <div class="flex-shrink-0">
                            @if($index == 0)
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white flex items-center justify-center font-black text-xl shadow-lg">
                                    🥇
                                </div>
                            @elseif($index == 1)
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 text-white flex items-center justify-center font-black text-xl shadow-lg">
                                    🥈
                                </div>
                            @elseif($index == 2)
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-700 to-amber-800 text-white flex items-center justify-center font-black text-xl shadow-lg">
                                    🥉
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 text-white flex items-center justify-center font-black text-lg shadow-lg">
                                    {{ $index + 1 }}
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                {{ $news['judul'] }}
                            </h3>
                            <div class="flex gap-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400">👁️ Views:</span>
                                    <span class="font-bold text-red-500">{{ number_format($news['views'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400">📅 Tanggal:</span>
                                    <span class="font-bold text-emerald-600">{{ $news['created'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow -->
                        <div class="flex-shrink-0 text-2xl group-hover:translate-x-1 transition">
                            →
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-slate-500">Belum ada berita yang dipublikasikan</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- ==================== CHART.JS SCRIPT ==================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Data Pengunjung
    const visitorData = {!! $visitorData !!};

    // Chart Configuration
    const ctx = document.getElementById('visitorChart').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: visitorData.map(d => d.bulan),
            datasets: [{
                label: 'Pengunjung',
                data: visitorData.map(d => d.visitors),
                borderWidth: 3,
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'rgb(99, 102, 241)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
                hoverBackgroundColor: 'rgba(99, 102, 241, 0.8)',
                shadowColor: 'rgba(99, 102, 241, 0.2)',
                shadowBlur: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 13,
                            weight: 'bold',
                            family: "'Segoe UI', sans-serif"
                        },
                        color: '#334155',
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 12 },
                    borderColor: 'rgb(99, 102, 241)',
                    borderWidth: 2,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Pengunjung: ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    min: 10000,
                    max: 50000,
                    ticks: {
                        font: { size: 11, weight: 'bold' },
                        color: '#64748b',
                        callback: function(value) {
                            return value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(100, 116, 139, 0.1)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: { size: 11, weight: 'bold' },
                        color: '#64748b'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // Year Selector Change Handler
    document.getElementById('yearSelector').addEventListener('change', function() {
        // Di sini nanti bisa call API untuk fetch data per tahun
        alert('📊 Data tahun ' + this.value + ' akan ditampilkan\n(Fitur akan diimplementasikan sepenuhnya nanti)');
    });
</script>

@endsection