@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                📊 Laporan Survey Kepuasan Layanan Informasi Publik
            </h1>
            <p class="text-slate-500 mt-1">Kelola laporan survey kepuasan layanan informasi publik yang tersedia</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-50 to-red-100 border-2 border-red-200 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-800 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-700">
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
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-50 to-green-100 border-2 border-green-200 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-800">✅ Berhasil!</h3>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-xl p-8 border border-slate-200">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ==================== INFORMASI DASAR ==================== -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Informasi Dasar</h2>
                        </div>

                        <!-- Tahun Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-sm"></i>
                                </span>
                                Tahun Laporan *
                            </label>
                            <select name="tahun_laporan" id="tahun_laporan" 
                                    class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm" required>
                                <option value="">Pilih Tahun</option>
                                @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Jenis Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-list text-sm"></i>
                                </span>
                                Jenis Laporan *
                            </label>
                            <select name="jenis_laporan" id="jenis_laporan" 
                                    class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white shadow-sm" required>
                                <option value="">Pilih Jenis Laporan</option>
                                <option value="tahunan">Laporan Tahunan</option>
                                <option value="semesteran">Laporan Semesteran</option>
                                <option value="triwulan">Laporan Triwulan</option>
                                <option value="bulanan">Laporan Bulanan</option>
                            </select>
                        </div>

                        <!-- Periode Laporan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="group">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt text-sm"></i>
                                    </span>
                                    Periode Mulai *
                                </label>
                                <input type="date" name="periode_mulai" id="periode_mulai" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 bg-white shadow-sm"
                                       required>
                            </div>
                            <div class="group">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-check text-sm"></i>
                                    </span>
                                    Periode Selesai *
                                </label>
                                <input type="date" name="periode_selesai" id="periode_selesai" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 bg-white shadow-sm"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== KONTEN LAPORAN ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Konten Laporan</h2>
                        </div>

                        <!-- Ringkasan Eksekutif -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Ringkasan Eksekutif *
                            </label>
                            <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                                <textarea id="editor_ringkasan" name="ringkasan_eksekutif" class="w-full p-6 border-0 outline-none resize-none" style="min-height: 250px;" required>
Tuliskan ringkasan eksekutif laporan survey kepuasan layanan informasi publik...
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan ringkasan eksekutif secara singkat dan padat
                            </p>
                        </div>

                        <!-- Isi Laporan Lengkap -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-invoice text-sm"></i>
                                </span>
                                Isi Laporan Lengkap *
                            </label>
                            <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                                <textarea id="editor_laporan" name="isi_laporan" class="w-full p-6 border-0 outline-none resize-none" style="min-height: 300px;" required>
Tuliskan isi laporan survey kepuasan layanan informasi publik secara lengkap dan detail...
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan isi laporan secara detail dan komprehensif
                            </p>
                        </div>
                    </div>

                    <!-- ==================== DOKUMEN PENDUKUNG ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">3</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Dokumen Pendukung</h2>
                        </div>

                        <!-- File Laporan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-teal-500 to-teal-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-pdf text-sm"></i>
                                </span>
                                File Laporan *
                            </label>
                            <div class="relative">
                                <input type="file" name="file_laporan" id="file_laporan" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 10MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-file-alt mr-1"></i>
                                Format: PDF, DOC, DOCX, XLS, XLSX
                            </p>
                        </div>

                        <!-- Lampiran Tambahan -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-paperclip text-sm"></i>
                                </span>
                                Lampiran Tambahan
                            </label>
                            <div class="relative">
                                <input type="file" name="lampiran" id="lampiran" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" multiple>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Multiple files
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-paperclip mr-1"></i>
                                Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Opsional)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-yellow-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-orange-800">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Informasi Dasar:</strong>
                                        <p class="text-orange-700">Tahun, jenis, dan periode laporan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Konten:</strong>
                                        <p class="text-orange-700">Ringkasan dan isi laporan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Dokumen:</strong>
                                        <p class="text-orange-700">File laporan dan lampiran</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-800">Tentang Survey Kepuasan</h3>
                            </div>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                Laporan Survey Kepuasan Layanan Informasi Publik adalah dokumen resmi yang memuat hasil evaluasi kepuasan masyarakat terhadap layanan informasi yang disediakan sesuai peraturan perundang-undangan.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">15</p>
                                <p class="text-xs text-white/80">Total Laporan</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">4</p>
                                <p class="text-xs text-white/80">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-200">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for Ringkasan Eksekutif
        ClassicEditor
            .create(document.querySelector('#editor_ringkasan'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .catch(error => console.error(error));

        // Initialize CKEditor for Isi Laporan
        ClassicEditor
            .create(document.querySelector('#editor_laporan'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .catch(error => console.error(error));
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
