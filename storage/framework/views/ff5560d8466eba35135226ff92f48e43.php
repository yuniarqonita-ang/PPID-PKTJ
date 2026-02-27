<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- HEADER SECTION - ANIMATED -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-black text-white drop-shadow-lg">
                🚀 Dashboard Analytics PPID PKTJ
            </h1>
            <p class="text-cyan-300 text-lg mt-2 font-semibold">Selamat datang di Panel Admin PPID PKTJ 🎯</p>
            <div class="flex justify-center items-center gap-2 mt-3">
                <span class="w-3 h-3 bg-green-400 rounded-full animate-bounce"></span>
                <span class="text-xs text-green-400 font-bold uppercase tracking-wider">⏰ Last Update: <?php echo e($last_update); ?></span>
            </div>
        </div>

        <!-- STATISTICS CARDS - CREATIVE DESIGN WITH GLOW -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- CARD 1: TOTAL BERITA -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl p-3 shadow-lg">
                            <span class="text-3xl">📰</span>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-white drop-shadow-lg"><?php echo e($stats['totalBerita']); ?></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-bold text-white uppercase tracking-wider">Total Berita</p>
                        <p class="text-sm text-pink-300 mt-1">Berita yang telah dipublikasikan 🔥</p>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-green-400 font-semibold">Live Update</span>
                    </div>
                </div>
            </div>

            <!-- CARD 2: TOTAL GALLERY -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl p-3 shadow-lg">
                            <span class="text-3xl">🖼️</span>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-white drop-shadow-lg"><?php echo e($stats['totalGallery'] ?? 0); ?></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-bold text-white uppercase tracking-wider">Total Album Gallery</p>
                        <p class="text-sm text-blue-300 mt-1">Album foto yang tersimpan 📸</p>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-blue-400 font-semibold">Photo Storage</span>
                    </div>
                </div>
            </div>

            <!-- CARD 3: TOTAL VIDEO -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="bg-gradient-to-br from-red-500 to-orange-600 rounded-xl p-3 shadow-lg">
                            <span class="text-3xl">🎬</span>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-white drop-shadow-lg"><?php echo e($stats['totalVideo'] ?? 0); ?></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-bold text-white uppercase tracking-wider">Total Video</p>
                        <p class="text-sm text-red-300 mt-1">Video yang telah diupload 🎥</p>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-purple-400 font-semibold">Video Library</span>
                    </div>
                </div>
            </div>

            <!-- CARD 4: TOTAL AGENDA -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-600 to-amber-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl p-3 shadow-lg">
                            <span class="text-3xl">📅</span>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-white drop-shadow-lg"><?php echo e($stats['totalAgenda'] ?? 0); ?></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-bold text-white uppercase tracking-wider">Total Agenda</p>
                        <p class="text-sm text-yellow-300 mt-1">Jadwal & kegiatan 📋</p>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-orange-400 font-semibold">Event Schedule</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- LEFT SIDE: CHART & POPULAR NEWS (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- VISITOR CHART SECTION -->
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl blur opacity-25"></div>
                    <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h2 class="text-2xl font-black text-white drop-shadow-lg">
                                    📊 Grafik Pengunjung Situs
                                </h2>
                                <p class="text-sm text-cyan-300 mt-1">Statistik kunjungan per bulan 📈</p>
                            </div>
                            <select id="yearSelector" class="px-4 py-2 rounded-xl border border-cyan-600 bg-slate-700 text-cyan-400 font-bold hover:border-cyan-400 transition cursor-pointer">
                                <option value="2024">Tahun 2024</option>
                                <option value="2025">Tahun 2025</option>
                                <option value="2026" selected>Tahun 2026</option>
                                <option value="2027">Tahun 2027</option>
                            </select>
                        </div>
                        
                        <div class="bg-slate-900 rounded-xl p-4 shadow-inner">
                            <canvas id="visitorChart" height="120"></canvas>
                        </div>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="bg-slate-700 rounded-lg p-3 border border-cyan-600/30">
                                <p class="text-xs font-bold text-cyan-400">📈 Range Pengunjung</p>
                                <p class="text-sm text-white font-semibold">10.000 - 50.000/bulan</p>
                            </div>
                            <div class="bg-slate-700 rounded-lg p-3 border border-cyan-600/30">
                                <p class="text-xs font-bold text-cyan-400">📅 Periode</p>
                                <p class="text-sm text-white font-semibold">Januari - Desember</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5 BERITA TERPOPULER -->
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl blur opacity-25"></div>
                    <div class="relative bg-slate-800 rounded-2xl p-6 ring-1 ring-gray-700 shadow-2xl">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-3xl font-black text-white drop-shadow-lg">
                                    🔥 5 Berita Terpopuler
                                </h2>
                                <p class="text-sm text-orange-300 mt-1">Berita dengan jumlah views tertinggi ⭐</p>
                            </div>
                            <a href="<?php echo e(route('admin.berita.index')); ?>" class="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-600 to-red-600 text-white font-bold text-sm hover:from-orange-500 hover:to-red-500 transition transform hover:scale-105 shadow-lg">
                                Lihat Semua →
                            </a>
                        </div>

                        <!-- News List -->
                        <div class="space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $topNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-700 to-slate-800 p-5 border border-slate-600 hover:border-orange-400 hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                                    <div class="flex items-center gap-4">
                                        <!-- Ranking Badge -->
                                        <div class="flex-shrink-0">
                                            <?php if($index == 0): ?>
                                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center font-black text-2xl text-white shadow-lg animate-bounce">
                                                    🥇
                                                </div>
                                            <?php elseif($index == 1): ?>
                                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center font-black text-2xl text-white shadow-lg">
                                                    🥈
                                                </div>
                                            <?php elseif($index == 2): ?>
                                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center font-black text-2xl text-white shadow-lg">
                                                    🥉
                                                </div>
                                            <?php else: ?>
                                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center font-black text-xl text-white shadow-lg">
                                                    <?php echo e($index + 1); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- News Content -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-orange-300 transition-colors">
                                                <?php echo e($news->judul ?? 'Judul berita tidak tersedia'); ?>

                                            </h3>
                                            
                                            <!-- Meta Info with Different Colors -->
                                            <div class="flex items-center justify-between text-sm">
                                                <div class="flex items-center gap-4">
                                                    <!-- Views Count (BLUE) -->
                                                    <div class="flex items-center gap-1 bg-blue-600/20 px-3 py-1 rounded-full border border-blue-500/30">
                                                        <span class="text-blue-400 font-bold">👁️</span>
                                                        <span class="text-blue-300 font-bold"><?php echo e(number_format($news->views ?? 0, 0, ',', '.')); ?>x</span>
                                                    </div>
                                                    
                                                    <!-- Category (PURPLE) -->
                                                    <?php if($news->category ?? false): ?>
                                                        <div class="bg-purple-600/20 px-3 py-1 rounded-full border border-purple-500/30">
                                                            <span class="text-purple-300 font-bold">📁 <?php echo e($news->category); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <!-- Date (GREEN) -->
                                                <div class="flex items-center gap-1 bg-green-600/20 px-3 py-1 rounded-full border border-green-500/30">
                                                    <span class="text-green-400 font-bold">📅</span>
                                                    <span class="text-green-300 font-bold"><?php echo e(\Carbon\Carbon::parse($news->created_at ?? now())->format('d M Y')); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <div class="flex-shrink-0">
                                            <a href="<?php echo e(route('admin.berita.edit', $news->id)); ?>" class="w-10 h-10 rounded-xl bg-slate-600 hover:bg-orange-500 flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                                                <span class="text-sm text-white">✏️</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center py-12">
                                    <div class="text-orange-400 text-6xl mb-4 animate-bounce">
                                        📰
                                    </div>
                                    <h3 class="text-lg font-medium text-white mb-2">Belum Ada Data Berita</h3>
                                    <p class="text-white mb-4">Belum ada berita yang tersedia saat ini.</p>
                                    <a href="<?php echo e(route('admin.berita.create')); ?>" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl hover:from-orange-500 hover:to-red-500 transition transform hover:scale-105 shadow-lg">
                                        <span class="mr-2">+</span> Buat Berita Pertama
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: DAFTAR PENGUNJUNG (1 column) -->
            <div class="space-y-4">
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur opacity-25"></div>
                    <div class="relative bg-slate-800 rounded-2xl p-5 ring-1 ring-gray-700 shadow-2xl">
                        <h3 class="text-2xl font-black text-white drop-shadow-lg mb-4">
                            👥 Daftar Pengunjung
                        </h3>

                        <!-- Online Now -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">🟢 Online Sekarang</p>
                                    <p class="text-3xl font-black text-white"><?php echo e($visitorMetrics['online']); ?></p>
                                    <p class="text-xs text-white mt-1">Sedang aktif 🔥</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">👤</span>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 w-3 h-3 bg-green-400 rounded-full animate-ping"></div>
                        </div>

                        <!-- Today Visitors -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">📅 Pengunjung Hari Ini</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['today'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Hari ini ⭐</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">🌟</span>
                                </div>
                            </div>
                        </div>

                        <!-- Today Hits -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">⚡ Hits Hari Ini</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['hits_today'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Total klik 🔥</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">💥</span>
                                </div>
                            </div>
                        </div>

                        <!-- Yesterday Visitors -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">📊 Pengunjung Kemarin</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['yesterday'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Kemarin 📈</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">📈</span>
                                </div>
                            </div>
                        </div>

                        <!-- Yesterday Hits -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">⚡ Hits Kemarin</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['hits_yesterday'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Klik kemarin 🎯</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">🎯</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Visitors -->
                        <div class="group relative overflow-hidden rounded-xl bg-slate-700 p-4 border border-slate-600 hover:border-white transition-all duration-300 transform hover:scale-105 cursor-pointer mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">🏆 Total Pengunjung</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['total_visitors'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Semua waktu 👑</p>
                                </div>
                                <div class="bg-slate-600 rounded-xl p-2">
                                    <span class="text-2xl">👑</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Hits -->
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-pink-600/20 to-rose-600/20 p-4 border border-pink-500/30 hover:border-pink-400 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-white uppercase tracking-wider mb-1">🚀 Total Hits</p>
                                    <p class="text-3xl font-black text-white"><?php echo e(number_format($visitorMetrics['total_hits'], 0, ',', '.')); ?></p>
                                    <p class="text-xs text-white mt-1">Semua klik ⚡</p>
                                </div>
                                <div class="bg-pink-600/30 rounded-xl p-2">
                                    <span class="text-2xl">⚡</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART.JS SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Visitor Chart Configuration
        const ctx = document.getElementById('visitorChart').getContext('2d');
        
        // Gradient for chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(34, 197, 94, 0.3)');
        gradient.addColorStop(1, 'rgba(34, 197, 94, 0.05)');

        const visitorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [15000, 22000, 18000, 35000, 28000, 42000, 38000, 45000, 32000, 28000, 35000, 40000],
                    borderColor: '#22c55e',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#22c55e',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 10000,
                        max: 50000,
                        ticks: {
                            color: '#94a3b8',
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#94a3b8'
                        },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Year selector functionality
        document.getElementById('yearSelector').addEventListener('change', function() {
            // Simulate data update based on year
            const year = this.value;
            const newData = year === '2024' ? 
                [12000, 18000, 15000, 28000, 22000, 35000, 30000, 38000, 25000, 22000, 28000, 32000] :
                year === '2025' ?
                [14000, 20000, 17000, 32000, 26000, 40000, 35000, 42000, 29000, 26000, 32000, 38000] :
                [15000, 22000, 18000, 35000, 28000, 42000, 38000, 45000, 32000, 28000, 35000, 40000];
            
            visitorChart.data.datasets[0].data = newData;
            visitorChart.update();
        });
    </script>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>