@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📋 Informasi Setiap Saat
            </h1>
            <p class="text-slate-400 mt-1">Kelola informasi yang tersedia setiap saat</p>
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
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Judul Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-heading text-sm"></i>
                            </span>
                            Judul Informasi
                        </label>
                        <input type="text" name="judul" id="judul" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:border-cyan-500 focus:ring-cyan-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               placeholder="Contoh: Profil Lembaga PPID PKTJ" required>
                    </div>

                    <!-- Deskripsi Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-align-left text-sm"></i>
                            </span>
                            Deskripsi Singkat
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="6"
                                  class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                  placeholder="Penjelasan singkat tentang informasi ini"></textarea>
                    </div>

                    <!-- Konten Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-pen-fancy text-sm"></i>
                            </span>
                            Konten Lengkap
                        </label>
                        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
                            <textarea id="editor_setiapsaat_index" name="konten" class="w-full p-6 border-0 outline-none resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" style="min-height: 300px;">
Tulis konten lengkap informasi setiap saat di sini...
                            </textarea>
                        </div>
                        <p class="text-sm text-slate-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Gunakan formatting lengkap (bold, italic, list, tabel, dll)
                        </p>
                    </div>

                    <!-- Tanggal Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-sm"></i>
                            </span>
                            Tanggal Publikasi
                        </label>
                        <input type="date" name="tanggal" id="tanggal" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               required>
                    </div>

                    <!-- Frekuensi Update Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-sync text-sm"></i>
                            </span>
                            Frekuensi Update
                        </label>
                        <div class="grid grid-cols-4 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="frekuensi" value="harian" class="peer sr-only" required>
                                <div class="p-4 border-2 border-slate-600/30 rounded-xl hover:border-green-400 peer-checked:border-green-500 peer-checked:bg-green-900/30 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-calendar-day text-2xl text-slate-400 peer-checked:text-green-500 mb-2"></i>
                                        <p class="font-medium text-slate-200 peer-checked:text-green-300">Harian</p>
                                        <p class="text-xs text-slate-400">Setiap hari</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="frekuensi" value="mingguan" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-600/30 rounded-xl hover:border-blue-400 peer-checked:border-blue-500 peer-checked:bg-blue-900/30 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-calendar-week text-2xl text-slate-400 peer-checked:text-blue-500 mb-2"></i>
                                        <p class="font-medium text-slate-200 peer-checked:text-blue-300">Mingguan</p>
                                        <p class="text-xs text-slate-400">Seminggu sekali</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="frekuensi" value="bulanan" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-600/30 rounded-xl hover:border-purple-400 peer-checked:border-purple-500 peer-checked:bg-purple-900/30 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-calendar-alt text-2xl text-slate-400 peer-checked:text-purple-500 mb-2"></i>
                                        <p class="font-medium text-slate-200 peer-checked:text-purple-300">Bulanan</p>
                                        <p class="text-xs text-slate-400">Sebulan sekali</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="frekuensi" value="kapan-saja" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-600/30 rounded-xl hover:border-indigo-400 peer-checked:border-indigo-500 peer-checked:bg-indigo-900/30 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-infinity text-2xl text-slate-400 peer-checked:text-indigo-600 mb-2"></i>
                                        <p class="font-medium text-slate-200 peer-checked:text-indigo-300">Kapan Saja</p>
                                        <p class="text-xs text-slate-400">Fleksibel</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Dokumen Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-file text-sm"></i>
                            </span>
                            Dokumen Terkait (Opsional)
                        </label>
                        <div class="relative">
                            <input type="file" name="dokumen" id="dokumen" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-400 hover:file:bg-red-100">
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                Max 10MB
                            </div>
                        </div>
                        <p class="text-sm text-slate-400 mt-2">
                            <i class="fas fa-file-alt mr-1"></i>
                            Format: PDF, DOC, DOCX, XLS, XLSX
                        </p>
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
                                        <strong class="text-orange-300">Judul:</strong>
                                        <p class="text-orange-400">Singkat, jelas, dan deskriptif</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Deskripsi:</strong>
                                        <p class="text-orange-400">Ringkasan maksimal 100 kata</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Konten:</strong>
                                        <p class="text-orange-400">Uraian lengkap dengan formatting</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Tanggal:</strong>
                                        <p class="text-orange-400">Waktu publikasi informasi</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Frekuensi:</strong>
                                        <p class="text-orange-400">Pilih frekuensi update</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Dokumen:</strong>
                                        <p class="text-orange-400">File pendukung jika ada</p>
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
                                <h3 class="text-lg font-bold text-blue-300">Tentang Informasi Setiap Saat</h3>
                            </div>
                            <p class="text-sm text-blue-400 leading-relaxed">
                                Informasi Setiap Saat adalah informasi yang harus tersedia secara berkelanjutan dan dapat diakses oleh masyarakat kapan saja, seperti profil lembaga, struktur organisasi, atau layanan publik yang tersedia.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">8</p>
                                <p class="text-xs text-white/80">Total Item</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">4</p>
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
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>
<!-- TinyMCE Editor Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#editor_setiapsaat_index',
                license_key: 'gpl',
                height: 500,
                menubar: false,
                skin: 'oxide-dark',
                content_css: 'dark',
                plugins: [
                    'advlist','autolink','lists','link','image','charmap',
                    'searchreplace','visualblocks','code','fullscreen',
                    'insertdatetime','media','table','help','wordcount'
                ],
                toolbar:
                    'undo redo | styles | bold italic underline strikethrough | ' +
                    'fontfamily fontsize forecolor backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | ' +
                    'table link image charmap | removeformat code fullscreen',
                toolbar_mode: 'wrap',
                fontsize_formats: '8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 24pt 28pt 32pt 36pt 48pt 72pt',
                font_family_formats:
                    'Arial=arial,helvetica,sans-serif;' +
                    'Arial Black=arial black,avant garde;' +
                    'Comic Sans MS=comic sans ms,sans-serif;' +
                    'Courier New=courier new,courier;' +
                    'Georgia=georgia,palatino;' +
                    'Helvetica=helvetica;' +
                    'Impact=impact,chicago;' +
                    'Inter=inter,sans-serif;' +
                    'Tahoma=tahoma,arial,helvetica,sans-serif;' +
                    'Times New Roman=times new roman,times;' +
                    'Trebuchet MS=trebuchet ms,geneva;' +
                    'Verdana=verdana,geneva',
                style_formats: [
                    { title: 'Heading 1', block: 'h1' },
                    { title: 'Heading 2', block: 'h2' },
                    { title: 'Heading 3', block: 'h3' },
                    { title: 'Heading 4', block: 'h4' },
                    { title: 'Paragraph', block: 'p' },
                    { title: 'Blockquote', block: 'blockquote' }
                ],
                table_toolbar:
                    'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | ' +
                    'tableinsertcolbefore tableinsertcolafter tabledeletecol',
                content_style:
                    'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.75; color: #f8fafc; background: transparent; padding: 12px; padding: 12px; } ' +
                    'table { border-collapse: collapse; width: 100%; } ' +
                    'table td, table th { border: 1px solid #ddd; padding: 8px 12px; }' +
                    'table th { background: #f1f5f9; font-weight: 600; }'
            });

            // Auto-sync TinyMCE on form submit
            document.querySelector('form').addEventListener('submit', function() {
                tinymce.triggerSave();
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
