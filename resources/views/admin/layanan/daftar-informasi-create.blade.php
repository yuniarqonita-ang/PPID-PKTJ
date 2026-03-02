@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                📋 Daftar Informasi Publik
            </h1>
            <p class="text-slate-500 mt-1">Kelola daftar informasi publik yang tersedia untuk masyarakat</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.layanan.daftar-informasi') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
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
                    <!-- Informasi Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-heading text-sm"></i>
                            </span>
                            Informasi *
                        </label>
                        <input type="text" name="informasi" id="informasi" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                               placeholder="Masukkan judul informasi publik..." required>
                    </div>

                    <!-- Kategori Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-folder text-sm"></i>
                            </span>
                            Kategori Informasi *
                        </label>
                        <select name="kategori" id="kategori" 
                                class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white shadow-sm" required>
                            <option value="">Pilih Kategori</option>
                            <option value="informasi-berkala">Informasi Berkala</option>
                            <option value="informasi-serta-merta">Informasi Serta Merta</option>
                            <option value="informasi-setiap-saat">Informasi Setiap Saat</option>
                            <option value="informasi-dikecualikan">Informasi Dikecualikan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <!-- Konten Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-sm"></i>
                            </span>
                            Konten Lengkap *
                        </label>
                        <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                            <textarea id="editor" name="konten" class="w-full p-6 border-0 outline-none resize-none" style="min-height: 300px;" required>
Tuliskan deskripsi lengkap tentang informasi publik ini...
                            </textarea>
                        </div>
                        <p class="text-sm text-slate-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Jelaskan informasi secara detail dan mudah dipahami
                        </p>
                    </div>

                    <!-- File Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-file-upload text-sm"></i>
                            </span>
                            File Informasi *
                        </label>
                        <div class="relative">
                            <input type="file" name="file" id="file" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
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

                    <!-- Frekuensi Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-sync text-sm"></i>
                            </span>
                            Frekuensi Pembaruan
                        </label>
                        <select name="frekuensi" id="frekuensi" 
                                class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm">
                            <option value="">Pilih Frekuensi</option>
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="triwulan">Triwulan</option>
                            <option value="semester">Semester</option>
                            <option value="tahunan">Tahunan</option>
                            <option value="sesuai-kebutuhan">Sesuai Kebutuhan</option>
                        </select>
                    </div>

                    <!-- Kontak Person Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-user text-sm"></i>
                            </span>
                            Kontak Person
                        </label>
                        <input type="text" name="kontak" id="kontak" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 bg-white shadow-sm"
                               placeholder="Nama dan kontak person...">
                    </div>

                    <!-- Format Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-teal-500 to-teal-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-list text-sm"></i>
                            </span>
                            Format Informasi
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="format[]" value="digital" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-xl hover:border-teal-400 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-laptop text-2xl text-slate-400 peer-checked:text-teal-500 mb-2"></i>
                                        <p class="font-medium text-slate-700 peer-checked:text-teal-700">Digital</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="format[]" value="cetak" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-xl hover:border-teal-400 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-print text-2xl text-slate-400 peer-checked:text-teal-500 mb-2"></i>
                                        <p class="font-medium text-slate-700 peer-checked:text-teal-700">Cetak</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="format[]" value="hardcopy" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-xl hover:border-teal-400 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-file text-2xl text-slate-400 peer-checked:text-teal-500 mb-2"></i>
                                        <p class="font-medium text-slate-700 peer-checked:text-teal-700">Hard Copy</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="format[]" value="online" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-xl hover:border-teal-400 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-globe text-2xl text-slate-400 peer-checked:text-teal-500 mb-2"></i>
                                        <p class="font-medium text-slate-700 peer-checked:text-teal-700">Online</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Biaya Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-money-bill text-sm"></i>
                            </span>
                            Biaya Perolehan
                        </label>
                        <input type="text" name="biaya" id="biaya" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 bg-white shadow-sm"
                               placeholder="Contoh: Gratis, Rp. 5.000, sesuai ketentuan">
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
                                        <strong class="text-orange-800">Informasi:</strong>
                                        <p class="text-orange-700">Judul informasi publik</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Kategori:</strong>
                                        <p class="text-orange-700">Jenis informasi</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Konten:</strong>
                                        <p class="text-orange-700">Deskripsi lengkap</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">File:</strong>
                                        <p class="text-orange-700">Dokumen pendukung</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Frekuensi:</strong>
                                        <p class="text-orange-700">Periode update</p>
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
                                <h3 class="text-lg font-bold text-blue-800">Tentang Daftar Informasi Publik</h3>
                            </div>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                Daftar Informasi Publik adalah katalog lengkap semua informasi yang tersedia untuk diakses oleh masyarakat sesuai dengan keterbukaan informasi publik.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">15</p>
                                <p class="text-xs text-white/80">Total Item</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">7</p>
                                <p class="text-xs text-white/80">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-200">
                <a href="{{ route('admin.layanan.daftar-informasi') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
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
