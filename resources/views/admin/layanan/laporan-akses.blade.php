@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📊 Laporan Akses Informasi Publik
            </h1>
            <p class="text-slate-400 mt-1">Kelola laporan akses informasi publik yang tersedia</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-900/20 to-red-900/30 border border-red-600/30 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-300 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-400">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-900/20 to-green-900/30 border border-green-600/30 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-300">✅ Berhasil!</h3>
                        <p class="text-green-400">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm border border-slate-600/30 p-8">
        <form action="{{ route('admin.halaman-custom.store', 'laporan_akses') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ==================== HERO & LANDING PAGE SECTION ==================== -->
            <div class="mb-12 space-y-8 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden p-8 rounded-2xl border-2 border-blue-100 shadow-sm">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30 text-white flex items-center justify-center shadow-lg">
                        <i class="fas fa-rocket text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-200">Hero & Landing Page</h2>
                        <p class="text-slate-400">Sesuaikan tampilan awal halaman Laporan Akses di publik</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-bold text-slate-200 mb-2">Judul Hero</label>
                        <input type="text" name="judul_hero" 
                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-600/30 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-4 focus:ring-blue-500/10 transition-all bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               value="{{ $settings['laporan_akses_judul_hero'] ?? 'Laporan Akses Informasi Publik' }}">
                    </div>
                    <div class="group">
                        <label class="block text-sm font-bold text-slate-200 mb-2">Tagline Hero</label>
                        <input type="text" name="tagline_hero" 
                               class="w-full px-4 py-3 rounded-xl border-2 border-slate-600/30 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-4 focus:ring-blue-500/10 transition-all bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               value="{{ $settings['laporan_akses_tagline_hero'] ?? 'Statistik akses informasi publik yang diminta oleh masyarakat' }}">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ==================== INFORMASI DASAR ==================== -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-200">Informasi Dasar</h2>
                        </div>

                        <!-- Tahun Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-sm"></i>
                                </span>
                                Tahun Laporan *
                            </label>
                            <select name="tahun_laporan" id="tahun_laporan" 
                                    class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:border-cyan-500 focus:ring-cyan-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" required>
                                <option value="">Pilih Tahun</option>
                                @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                    <option value="{{ $year }}" {{ isset($settings['laporan_akses_tahun_laporan']) && $settings['laporan_akses_tahun_laporan'] == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Jenis Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-list text-sm"></i>
                                </span>
                                Jenis Laporan *
                            </label>
                            <select name="jenis_laporan" id="jenis_laporan" 
                                    class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" required>
                                @php $jenis = $settings['laporan_akses_jenis_laporan'] ?? ''; @endphp
                                <option value="">Pilih Jenis Laporan</option>
                                <option value="tahunan" {{ $jenis == 'tahunan' ? 'selected' : '' }}>Laporan Tahunan</option>
                                <option value="semesteran" {{ $jenis == 'semesteran' ? 'selected' : '' }}>Laporan Semesteran</option>
                                <option value="triwulan" {{ $jenis == 'triwulan' ? 'selected' : '' }}>Laporan Triwulan</option>
                                <option value="bulanan" {{ $jenis == 'bulanan' ? 'selected' : '' }}>Laporan Bulanan</option>
                            </select>
                        </div>

                        <!-- Periode Laporan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="group">
                                <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt text-sm"></i>
                                    </span>
                                    Periode Mulai *
                                </label>
                                <input type="date" name="periode_mulai" id="periode_mulai" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       value="{{ $settings['laporan_akses_periode_mulai'] ?? '' }}" required>
                            </div>
                            <div class="group">
                                <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-check text-sm"></i>
                                    </span>
                                    Periode Selesai *
                                </label>
                                <input type="date" name="periode_selesai" id="periode_selesai" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       value="{{ $settings['laporan_akses_periode_selesai'] ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== KONTEN LAPORAN ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-600/30">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-200">Konten Laporan</h2>
                        </div>

                        <!-- Ringkasan Eksekutif -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Ringkasan Eksekutif *
                            </label>
                            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
                                <textarea id="editor_ringkasan" name="ringkasan_eksekutif" class="w-full p-6 border-0 outline-none resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" style="min-height: 250px;" required>
{!! $settings['laporan_akses_ringkasan_eksekutif'] ?? 'Tuliskan ringkasan eksekutif laporan akses informasi publik...' !!}
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan ringkasan eksekutif secara singkat dan padat
                            </p>
                        </div>

                        <!-- Isi Laporan Lengkap -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-invoice text-sm"></i>
                                </span>
                                Isi Laporan Lengkap *
                            </label>
                            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
                                <textarea id="editor_laporan" name="isi_laporan" class="w-full p-6 border-0 outline-none resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" style="min-height: 300px;" required>
{!! $settings['laporan_akses_isi_laporan'] ?? 'Tuliskan isi laporan akses informasi publik secara lengkap dan detail...' !!}
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan isi laporan secara detail dan komprehensif
                            </p>
                        </div>
                    </div>

                    <!-- ==================== DOKUMEN PENDUKUNG ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-600/30">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">3</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-200">Dokumen Pendukung</h2>
                        </div>

                        <!-- File Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-teal-500 to-teal-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-pdf text-sm"></i>
                                </span>
                                File Laporan *
                            </label>
                            <div class="relative">
                                <input type="file" name="file_laporan" id="file_laporan" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 10MB
                                </div>
                            </div>
                            @if(isset($settings['laporan_akses_file_laporan']) && $settings['laporan_akses_file_laporan'])
                                <div class="mt-3">
                                    <p class="text-sm font-semibold text-slate-300 mb-2">File Terlampir:</p>
                                    <a href="{{ asset('storage/halaman/' . $settings['laporan_akses_file_laporan']) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-100 border border-slate-600/30 rounded-lg text-slate-200 hover:bg-slate-200 transition">
                                        <i class="fas fa-file-download mr-2 text-teal-600"></i> Download / Lihat File
                                    </a>
                                </div>
                            @endif
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-file-alt mr-1"></i>
                                Format: PDF, DOC, DOCX, XLS, XLSX
                            </p>
                        </div>

                        <!-- Lampiran Tambahan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-paperclip text-sm"></i>
                                </span>
                                Lampiran Tambahan
                            </label>
                            <div class="relative">
                                <input type="file" name="lampiran" id="lampiran" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" multiple>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Multiple files
                                </div>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-paperclip mr-1"></i>
                                Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Opsional)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-900/20 to-orange-900/20 border border-yellow-600/30 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-yellow-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-orange-300">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Informasi Dasar:</strong>
                                        <p class="text-orange-400">Tahun, jenis, dan periode laporan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Konten:</strong>
                                        <p class="text-orange-400">Ringkasan dan isi laporan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Dokumen:</strong>
                                        <p class="text-orange-400">File laporan dan lampiran</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-900/20 to-indigo-900/20 border border-blue-600/30 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-300">Tentang Laporan Akses</h3>
                            </div>
                            <p class="text-sm text-blue-400 leading-relaxed">
                                Laporan Akses Informasi Publik adalah dokumen resmi yang memuat informasi statistik dan evaluasi tentang akses informasi yang diminta oleh masyarakat sesuai peraturan perundang-undangan.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">8</p>
                                <p class="text-xs text-white/80">Total Laporan</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">2</p>
                                <p class="text-xs text-white/80">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-600/30">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote for Ringkasan Eksekutif
            $('#editor_ringkasan').summernote({
                height: 300,
                placeholder: 'Tuliskan ringkasan eksekutif laporan akses informasi publik secara singkat dan padat...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
            
            // Initialize Summernote for Isi Laporan
            $('#editor_laporan').summernote({
                height: 300,
                placeholder: 'Tuliskan isi laporan akses informasi publik secara lengkap dan detail...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
        });
    </script>

<style>
    .form-control.form-editor {
        min-height: 250px;
    }
    .display-5 {
        font-size: 2rem;
        font-weight: 600;
    }
    .ck-editor__editable { min-height: 250px; }
</style>
</div>
</div>
@endsection
