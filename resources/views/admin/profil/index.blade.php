@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-th-large mr-2"></i> Pusat Kelola Halaman
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola konten statis, profil, regulasi, dan SOP dalam satu dashboard terpadu</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-home mr-2"></i> Ke Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- SECTION: PROFIL UTAMA -->
        <div class="space-y-4">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] flex items-center">
                <span class="w-8 h-[2px] bg-[#ffc107] mr-3"></span> Profil Lembaga
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['key' => 'profil', 'label' => 'Gambaran Umum', 'icon' => 'fa-university', 'color' => 'bg-blue-500'],
                    ['key' => 'tugas', 'label' => 'Tugas & Fungsi', 'icon' => 'fa-tasks', 'color' => 'bg-indigo-500'],
                    ['key' => 'visi', 'label' => 'Visi & Misi', 'icon' => 'fa-bullseye', 'color' => 'bg-emerald-500'],
                    ['key' => 'struktur', 'label' => 'Struktur Org', 'icon' => 'fa-sitemap', 'color' => 'bg-rose-500'],
                    ['key' => 'regulasi', 'label' => 'Dasar Hukum', 'icon' => 'fa-gavel', 'color' => 'bg-purple-500'],
                    ['key' => 'kontak', 'label' => 'Kontak PPID', 'icon' => 'fa-phone-alt', 'color' => 'bg-cyan-500'],
                ] as $item)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 {{ $item['color'] }} rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                                <i class="fas {{ $item['icon'] }}"></i>
                            </div>
                            @if($profilesData[$item['key']]->judul)
                                <span class="text-[10px] font-black text-green-500 bg-green-50 px-2 py-1 rounded-md border border-green-100">AKTIF</span>
                            @else
                                <span class="text-[10px] font-black text-gray-400 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">KOSONG</span>
                            @endif
                        </div>
                        <h3 class="text-sm font-bold text-[#004a99] mb-1">{{ $item['label'] }}</h3>
                        <p class="text-xs text-gray-400 mb-6 font-medium italic">
                            Update: {{ $profilesData[$item['key']]->updated_at ? $profilesData[$item['key']]->updated_at->diffForHumans() : 'Belum ada' }}
                        </p>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.profil.edit', $item['key']) }}" class="flex-1 py-2 bg-[#004a99] text-white text-[10px] font-black uppercase text-center rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION: SOP / PROSEDUR -->
        <div class="space-y-4">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] flex items-center">
                <span class="w-8 h-[2px] bg-[#004a99] mr-3"></span> Standar Operasional (SOP)
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach([
                    ['key'=>'sop-permintaan', 'label'=>'Permintaan', 'icon'=>'fa-file-signature'],
                    ['key'=>'sop-keberatan', 'label'=>'Keberatan', 'icon'=>'fa-exclamation-triangle'],
                    ['key'=>'sop-sengketa', 'label'=>'Sengketa', 'icon'=>'fa-balance-scale'],
                    ['key'=>'sop-penetapan', 'label'=>'Penetapan', 'icon'=>'fa-check-double'],
                    ['key'=>'sop-pengujian', 'label'=>'Pengujian', 'icon'=>'fa-microscope'],
                    ['key'=>'sop-pendokumentasian', 'label'=>'Dokumen', 'icon'=>'fa-archive'],
                ] as $sop)
                    <div class="bg-white rounded-xl border border-gray-200 p-4 hover:border-[#004a99] transition-all group">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-gray-50 text-[#004a99] flex items-center justify-center group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm border border-gray-100">
                                <i class="fas {{ $sop['icon'] }} text-xs"></i>
                            </div>
                            <h4 class="text-[10px] font-black text-gray-700 uppercase">{{ $sop['label'] }}</h4>
                        </div>
                        <div class="flex justify-between items-center">
                            @if($profilesData[$sop['key']]->judul)
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            @else
                                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                            @endif
                            <a href="{{ route('admin.profil.edit', $sop['key']) }}" class="text-[10px] font-bold text-[#004a99] hover:underline">
                                KELOLA <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION: LAYANAN INFORMASI -->
        <div class="space-y-4">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] flex items-center">
                <span class="w-8 h-[2px] bg-[#ffc107] mr-3"></span> Layanan & Laporan
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach([
                    ['key'=>'layanan-daftar', 'label'=>'Daftar Info Publik', 'icon'=>'fa-list-ol'],
                    ['key'=>'maklumat-pelayanan', 'label'=>'Maklumat Pelayanan', 'icon'=>'fa-award'],
                    ['key'=>'laporan-layanan', 'label'=>'Laporan Layanan', 'icon'=>'fa-file-invoice'],
                    ['key'=>'laporan-akses', 'label'=>'Laporan Akses', 'icon'=>'fa-chart-area'],
                    ['key'=>'laporan-survey', 'label'=>'Hasil Survey SKM', 'icon'=>'fa-star-half-alt'],
                ] as $layanan)
                    <a href="{{ route('admin.profil.edit', $layanan['key']) }}" class="bg-white p-4 rounded-xl border-l-4 border-gray-200 hover:border-[#ffc107] shadow-sm flex items-center justify-between group transition-all">
                        <div class="flex items-center gap-3">
                            <i class="fas {{ $layanan['icon'] }} text-gray-300 group-hover:text-[#ffc107] transition-colors"></i>
                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#004a99]">{{ $layanan['label'] }}</span>
                        </div>
                        <i class="fas fa-edit text-xs text-gray-100 group-hover:text-gray-300"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- SUMMARY INFO -->
        <div class="bg-[#004a99] rounded-2xl p-6 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="text-center md:text-left">
                    <p class="text-xs font-black text-blue-200 uppercase tracking-widest mb-1">Konten Terisi</p>
                    <p class="text-4xl font-black">
                        {{ collect($profilesData)->filter(function($item) { return $item->judul; })->count() }} 
                        <span class="text-lg opacity-50">/ 17</span>
                    </p>
                </div>
                <div class="h-12 w-[1px] bg-white/20 hidden md:block"></div>
                <div class="hidden md:block">
                    <p class="text-xs font-bold text-blue-200 leading-relaxed max-w-xs">
                        Seluruh perubahan pada halaman ini akan langsung berdampak pada menu profil di website publik.
                    </p>
                </div>
            </div>
            <div class="w-full md:w-auto">
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-full px-6 py-3 bg-white/10 hover:bg-white/20 rounded-xl text-xs font-black uppercase transition-all tracking-widest border border-white/20">
                    <i class="fas fa-arrow-up mr-2 text-[#ffc107]"></i> Kembali Ke Atas
                </button>
            </div>
        </div>

    </div>
</div>
@endsection
