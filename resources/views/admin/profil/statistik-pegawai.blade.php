@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-8 md:p-10 shadow-xl text-white relative overflow-hidden mb-8">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[2px]">CMS Real-Time • Indikator AKIP E.8</h2>
                </div>
                
                <div>
                    <h1 class="text-2xl md:text-4xl font-black tracking-tight leading-tight text-white mb-2">
                        Kelola <span class="text-[#ffc107]">Statistik Kepegawaian</span> PKTJ
                    </h1>
                    <p class="text-blue-50 text-sm md:text-base font-semibold max-w-2xl opacity-90">
                        Sesuaikan seluruh angka statistik, persentase, kualifikasi pendidikan, kepangkatan, dan bukti otentik SIMPEG secara langsung.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ url('/profil/statistik-pegawai') }}" target="_blank" class="px-5 py-3.5 bg-white/10 border border-white/20 text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-white/20 transition-all flex items-center shadow-sm">
                    <i class="fas fa-external-link-alt mr-2 text-[#ffc107]"></i> Lihat Halaman Publik
                </a>
                <button type="submit" form="form-statistik-pegawai" class="px-6 py-3.5 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[2px] rounded-xl shadow-lg shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-save mr-2"></i> Simpan Data Statistik
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm animate-fade-in">
        <i class="fas fa-check-circle text-emerald-600 text-xl"></i>
        <div>
            <h6 class="font-bold text-sm mb-0">Berhasil Disimpan!</h6>
            <p class="text-xs mb-0">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <form id="form-statistik-pegawai" action="{{ route('admin.statistik-pegawai.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. HERO SECTION & IDENTITAS -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-heading"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">1. Hero Section & Identitas Halaman</h3>
                        <p class="text-xs text-slate-500 mb-0">Teks pembuka, judul besar, dan keterangan sumber data</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Pill Badge Hero</label>
                        <input type="text" name="hero_badge" value="{{ old('hero_badge', $data['hero_badge'] ?? '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white text-sm font-semibold text-slate-800 transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Tahun Anggaran (Badge)</label>
                        <input type="text" name="tahun_anggaran" value="{{ old('tahun_anggaran', $data['tahun_anggaran'] ?? '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white text-sm font-semibold text-slate-800 transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Judul Halaman (H1)</label>
                    <input type="text" name="hero_judul" value="{{ old('hero_judul', $data['hero_judul'] ?? '') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white text-base font-bold text-[#002b5c] transition">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Deskripsi / Subjudul Hero</label>
                    <textarea name="hero_subjudul" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white text-sm text-slate-700 transition">{{ old('hero_subjudul', $data['hero_subjudul'] ?? '') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Teks Sumber Data Resmi</label>
                    <input type="text" name="sumber_data" value="{{ old('sumber_data', $data['sumber_data'] ?? '') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white text-sm font-semibold text-slate-800 transition">
                </div>
            </div>
        </div>

        <!-- 2. KARTU STATISTIK KPI (4 CARDS) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-th-large"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">2. Kartu Ringkasan KPI (4 Kolom Utama)</h3>
                        <p class="text-xs text-slate-500 mb-0">Angka metrik utama yang tampil di atas halaman</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- KPI 1: Total SDM -->
                    <div class="p-5 rounded-xl border border-blue-200 bg-blue-50/50 space-y-3">
                        <div class="flex items-center gap-2 text-[#004a99] font-bold text-xs">
                            <i class="fas fa-users"></i> KPI 1: TOTAL SDM
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Jumlah Angka</label>
                            <input type="number" name="total_sdm" value="{{ old('total_sdm', $data['total_sdm'] ?? '174') }}"
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg font-black text-xl text-[#002b5c]">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Label Judul</label>
                            <input type="text" name="total_sdm_label" value="{{ old('total_sdm_label', $data['total_sdm_label'] ?? 'Total SDM Pegawai') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Sub-keterangan</label>
                            <input type="text" name="total_sdm_sub" value="{{ old('total_sdm_sub', $data['total_sdm_sub'] ?? 'SIMPEG Kemenhub') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                        </div>
                    </div>

                    <!-- KPI 2: PNS -->
                    <div class="p-5 rounded-xl border border-sky-200 bg-sky-50/50 space-y-3">
                        <div class="flex items-center gap-2 text-sky-700 font-bold text-xs">
                            <i class="fas fa-id-badge"></i> KPI 2: PNS
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Jumlah Angka</label>
                            <input type="number" name="pns_count" value="{{ old('pns_count', $data['pns_count'] ?? '115') }}"
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg font-black text-xl text-sky-700">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Label Judul</label>
                            <input type="text" name="pns_label" value="{{ old('pns_label', $data['pns_label'] ?? 'Pegawai Negeri Sipil') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Sub-keterangan</label>
                            <input type="text" name="pns_sub" value="{{ old('pns_sub', $data['pns_sub'] ?? '66.1% Dari Total SDM') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                        </div>
                    </div>

                    <!-- KPI 3: PPPK -->
                    <div class="p-5 rounded-xl border border-emerald-200 bg-emerald-50/50 space-y-3">
                        <div class="flex items-center gap-2 text-emerald-700 font-bold text-xs">
                            <i class="fas fa-user-check"></i> KPI 3: PPPK
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Jumlah Angka</label>
                            <input type="number" name="pppk_count" value="{{ old('pppk_count', $data['pppk_count'] ?? '41') }}"
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg font-black text-xl text-emerald-700">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Label Judul</label>
                            <input type="text" name="pppk_label" value="{{ old('pppk_label', $data['pppk_label'] ?? 'Pegawai PPPK') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Sub-keterangan</label>
                            <input type="text" name="pppk_sub" value="{{ old('pppk_sub', $data['pppk_sub'] ?? '23.6% Dari Total SDM') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                        </div>
                    </div>

                    <!-- KPI 4: Non-ASN & CPNS -->
                    <div class="p-5 rounded-xl border border-rose-200 bg-rose-50/50 space-y-3">
                        <div class="flex items-center gap-2 text-rose-700 font-bold text-xs">
                            <i class="fas fa-user-clock"></i> KPI 4: NON-ASN & CPNS
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Jumlah Angka</label>
                            <input type="number" name="nonasn_count" value="{{ old('nonasn_count', $data['nonasn_count'] ?? '18') }}"
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg font-black text-xl text-rose-700">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Label Judul</label>
                            <input type="text" name="nonasn_label" value="{{ old('nonasn_label', $data['nonasn_label'] ?? 'Non-ASN & CPNS') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Sub-keterangan</label>
                            <input type="text" name="nonasn_sub" value="{{ old('nonasn_sub', $data['nonasn_sub'] ?? '17 Non-ASN, 1 CPNS') }}"
                                class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3. KOMPOSISI STATUS PEGAWAI (DOUGHNUT CHART & TABEL STATUS) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-chart-pie"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">3. Komposisi Status Pegawai (Diagram Donut & Tabel Rincian 1)</h3>
                        <p class="text-xs text-slate-500 mb-0">Rincian PNS, PPPK, Non-ASN, dan CPNS</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-sky-700 uppercase tracking-wider block">Jumlah PNS</label>
                        <input type="number" name="status_pns" value="{{ old('status_pns', $data['status_pns'] ?? '115') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-base text-slate-800">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Jumlah PPPK</label>
                        <input type="number" name="status_pppk" value="{{ old('status_pppk', $data['status_pppk'] ?? '41') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-base text-slate-800">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-rose-700 uppercase tracking-wider block">Jumlah Non-ASN</label>
                        <input type="number" name="status_nonasn" value="{{ old('status_nonasn', $data['status_nonasn'] ?? '17') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-base text-slate-800">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-purple-700 uppercase tracking-wider block">Jumlah CPNS</label>
                        <input type="number" name="status_cpns" value="{{ old('status_cpns', $data['status_cpns'] ?? '1') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-base text-slate-800">
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. TINGKAT PENDIDIKAN (BAR CHART & TABEL RINCIAN 2) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-graduation-cap"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">4. Kualifikasi Pendidikan Pegawai (Grafik Batang & Tabel Rincian 2)</h3>
                        <p class="text-xs text-slate-500 mb-0">Kelola jenjang pendidikan, jumlah orang, dan keterangannya</p>
                    </div>
                </div>
                <button type="button" onclick="addPendidikanRow()" class="px-4 py-2 bg-emerald-600 text-white rounded-xl font-bold text-xs flex items-center gap-1.5 hover:bg-emerald-700 transition cursor-pointer border-none">
                    <i class="fas fa-plus"></i> Tambah Jenjang
                </button>
            </div>
            <div class="p-6 md:p-8">
                @php
                    $pendList = json_decode($data['pendidikan_list'] ?? '[]', true) ?: [];
                @endphp
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse" id="table-pendidikan">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-slate-600 font-bold text-xs uppercase">
                                <th class="py-3 px-4" style="width: 45%;">Jenjang Pendidikan</th>
                                <th class="py-3 px-4" style="width: 20%;">Jumlah (Orang)</th>
                                <th class="py-3 px-4" style="width: 25%;">Keterangan</th>
                                <th class="py-3 px-4 text-center" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-pendidikan" class="divide-y divide-slate-100">
                            @foreach($pendList as $idx => $p)
                            <tr>
                                <td class="py-3 px-4">
                                    <input type="text" name="pendidikan_jenjang[]" value="{{ $p['jenjang'] ?? '' }}" required
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-semibold text-slate-800">
                                </td>
                                <td class="py-3 px-4">
                                    <input type="number" name="pendidikan_jumlah[]" value="{{ $p['jumlah'] ?? 0 }}" required min="0"
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-bold text-[#004a99]">
                                </td>
                                <td class="py-3 px-4">
                                    <input type="text" name="pendidikan_keterangan[]" value="{{ $p['keterangan'] ?? '' }}"
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-600" placeholder="Keterangan">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <button type="button" onclick="removeRow(this)" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition border-none bg-transparent cursor-pointer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 5. KOMPOSISI GOLONGAN (BAR CHART GOLONGAN) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-layer-group"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">5. Komposisi Golongan / Ruang (Grafik Batang)</h3>
                        <p class="text-xs text-slate-500 mb-0">Kelola daftar pangkat/golongan pegawai untuk diagram batang</p>
                    </div>
                </div>
                <button type="button" onclick="addGolonganRow()" class="px-4 py-2 bg-sky-600 text-white rounded-xl font-bold text-xs flex items-center gap-1.5 hover:bg-sky-700 transition cursor-pointer border-none">
                    <i class="fas fa-plus"></i> Tambah Golongan
                </button>
            </div>
            <div class="p-6 md:p-8">
                @php
                    $golList = json_decode($data['golongan_list'] ?? '[]', true) ?: [];
                @endphp
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse" id="table-golongan">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-slate-600 font-bold text-xs uppercase">
                                <th class="py-3 px-4" style="width: 65%;">Nama Golongan / Ruang / Pangkat</th>
                                <th class="py-3 px-4" style="width: 25%;">Jumlah (Orang)</th>
                                <th class="py-3 px-4 text-center" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-golongan" class="divide-y divide-slate-100">
                            @foreach($golList as $idx => $g)
                            <tr>
                                <td class="py-3 px-4">
                                    <input type="text" name="golongan_nama[]" value="{{ $g['golongan'] ?? '' }}" required
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-semibold text-slate-800">
                                </td>
                                <td class="py-3 px-4">
                                    <input type="number" name="golongan_jumlah[]" value="{{ $g['jumlah'] ?? 0 }}" required min="0"
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-bold text-[#004a99]">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <button type="button" onclick="removeRow(this)" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition border-none bg-transparent cursor-pointer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 6. TANGKAPAN LAYAR BUKTI OTENTIK SIMPEG (AKIP E.8a, E.8b, E.8c) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-file-shield"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">6. Tangkapan Layar Resmi SIMPEG Kemenhub (Bukti AKIP 2026)</h3>
                        <p class="text-xs text-slate-500 mb-0">Unggah dan kelola tangkapan layar bukti otentik penilaian AKIP</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Bukti 1 -->
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-bold text-[11px]">Bukti Otentik 1</span>
                        </div>
                        <div class="aspect-video bg-slate-200 rounded-xl overflow-hidden border border-slate-300 relative group">
                            <img src="{{ asset($data['bukti_1_gambar'] ?? 'images/kepegawaian/E6a.jpg') }}" alt="Bukti 1" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Ganti Gambar (Upload File)</label>
                            <input type="file" name="bukti_1_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#004a99] file:text-white hover:file:bg-[#002b5c]">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Badge Indikator</label>
                            <input type="text" name="bukti_1_indikator" value="{{ old('bukti_1_indikator', $data['bukti_1_indikator'] ?? 'Indikator E.8a') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Judul Bukti</label>
                            <input type="text" name="bukti_1_judul" value="{{ old('bukti_1_judul', $data['bukti_1_judul'] ?? 'Data Pegawai Berdasarkan Jenis') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Deskripsi Singkat</label>
                            <textarea name="bukti_1_deskripsi" rows="2" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs text-slate-600">{{ old('bukti_1_deskripsi', $data['bukti_1_deskripsi'] ?? 'Tangkapan layar otentik data PNS, PPPK, dan Non-ASN SIMPEG.') }}</textarea>
                        </div>
                    </div>

                    <!-- Bukti 2 -->
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[11px]">Bukti Otentik 2</span>
                        </div>
                        <div class="aspect-video bg-slate-200 rounded-xl overflow-hidden border border-slate-300 relative group">
                            <img src="{{ asset($data['bukti_2_gambar'] ?? 'images/kepegawaian/E6b.jpg') }}" alt="Bukti 2" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Ganti Gambar (Upload File)</label>
                            <input type="file" name="bukti_2_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#004a99] file:text-white hover:file:bg-[#002b5c]">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Badge Indikator</label>
                            <input type="text" name="bukti_2_indikator" value="{{ old('bukti_2_indikator', $data['bukti_2_indikator'] ?? 'Indikator E.8b') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Judul Bukti</label>
                            <input type="text" name="bukti_2_judul" value="{{ old('bukti_2_judul', $data['bukti_2_judul'] ?? 'Data Tingkat Pendidikan Pegawai') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Deskripsi Singkat</label>
                            <textarea name="bukti_2_deskripsi" rows="2" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs text-slate-600">{{ old('bukti_2_deskripsi', $data['bukti_2_deskripsi'] ?? 'Komposisi jenjang pendidikan S-2, D-III, D-IV, dan S-1.') }}</textarea>
                        </div>
                    </div>

                    <!-- Bukti 3 -->
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full font-bold text-[11px]">Bukti Otentik 3</span>
                        </div>
                        <div class="aspect-video bg-slate-200 rounded-xl overflow-hidden border border-slate-300 relative group">
                            <img src="{{ asset($data['bukti_3_gambar'] ?? 'images/kepegawaian/E6c.jpg') }}" alt="Bukti 3" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Ganti Gambar (Upload File)</label>
                            <input type="file" name="bukti_3_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#004a99] file:text-white hover:file:bg-[#002b5c]">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Badge Indikator</label>
                            <input type="text" name="bukti_3_indikator" value="{{ old('bukti_3_indikator', $data['bukti_3_indikator'] ?? 'Indikator E.8c') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Judul Bukti</label>
                            <input type="text" name="bukti_3_judul" value="{{ old('bukti_3_judul', $data['bukti_3_judul'] ?? 'Data Golongan / Ruang Pegawai') }}" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-600 uppercase block mb-1">Deskripsi Singkat</label>
                            <textarea name="bukti_3_deskripsi" rows="2" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs text-slate-600">{{ old('bukti_3_deskripsi', $data['bukti_3_deskripsi'] ?? 'Komposisi pegawai dari Golongan II/c hingga IV/b dan PPPK.') }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 7. CALLOUT BOX & TOMBOL BAWAH -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-sm">
                        <i class="fas fa-bullhorn"></i>
                    </span>
                    <div>
                        <h3 class="font-black text-[#002b5c] text-base mb-0">7. Callout Box & Rujukan Profil Pejabat</h3>
                        <p class="text-xs text-slate-500 mb-0">Tautan rujukan kepatuhan LHKPN dan pimpinan di bagian bawah halaman</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Judul Callout</label>
                    <input type="text" name="callout_judul" value="{{ old('callout_judul', $data['callout_judul'] ?? '') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sm text-slate-800">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Deskripsi Callout</label>
                    <textarea name="callout_deskripsi" rows="2"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700">{{ old('callout_deskripsi', $data['callout_deskripsi'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Teks Tombol Aksi</label>
                        <input type="text" name="callout_btn_text" value="{{ old('callout_btn_text', $data['callout_btn_text'] ?? '') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-xs text-slate-800">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Tautan / URL Tombol</label>
                        <input type="text" name="callout_btn_url" value="{{ old('callout_btn_url', $data['callout_btn_url'] ?? '') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800">
                    </div>
                </div>
            </div>
        </div>

        <!-- SUBMIT ACTION BAR -->
        <div class="pt-4 pb-12 flex justify-end">
            <button type="submit" class="w-full md:w-auto px-10 py-5 bg-gradient-to-r from-[#004a99] to-[#006ccf] text-white font-black text-base uppercase tracking-[3px] rounded-2xl shadow-xl hover:scale-[1.01] active:scale-95 transition-all border-none cursor-pointer flex items-center justify-center gap-3">
                <i class="fas fa-save text-[#ffc107] text-xl"></i> SIMPAN PERUBAHAN STATISTIK SECARA REALTIME
            </button>
        </div>

    </form>
</div>

<script>
function addPendidikanRow() {
    const tbody = document.getElementById('tbody-pendidikan');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td class="py-3 px-4">
            <input type="text" name="pendidikan_jenjang[]" value="" required placeholder="Contoh: Sarjana (S-1)"
                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-semibold text-slate-800">
        </td>
        <td class="py-3 px-4">
            <input type="number" name="pendidikan_jumlah[]" value="0" required min="0"
                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-bold text-[#004a99]">
        </td>
        <td class="py-3 px-4">
            <input type="text" name="pendidikan_keterangan[]" value=""
                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-600" placeholder="Keterangan">
        </td>
        <td class="py-3 px-4 text-center">
            <button type="button" onclick="removeRow(this)" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition border-none bg-transparent cursor-pointer">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);
}

function addGolonganRow() {
    const tbody = document.getElementById('tbody-golongan');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td class="py-3 px-4">
            <input type="text" name="golongan_nama[]" value="" required placeholder="Contoh: Pembina (IV/a)"
                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-semibold text-slate-800">
        </td>
        <td class="py-3 px-4">
            <input type="number" name="golongan_jumlah[]" value="0" required min="0"
                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-bold text-[#004a99]">
        </td>
        <td class="py-3 px-4 text-center">
            <button type="button" onclick="removeRow(this)" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition border-none bg-transparent cursor-pointer">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);
}

function removeRow(btn) {
    const tr = btn.closest('tr');
    if (tr) tr.remove();
}
</script>
@endsection
