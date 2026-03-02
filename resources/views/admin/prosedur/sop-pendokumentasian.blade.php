@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-200 via-orange-100 to-amber-200 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-orange-800 drop-shadow-lg">
                📋 SOP Pendokumentasian Informasi
            </h1>
            <p class="text-slate-800 mt-1 font-medium">Kelola SOP pendokumentasian informasi publik yang tersedia</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-100 to-red-200 border-2 border-red-400 p-6 shadow-xl">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-300/40 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-900 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-800">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
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
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-100 to-green-200 border-2 border-green-400 p-6 shadow-xl">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-300/40 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center animate-pulse shadow-lg">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-900">✅ Berhasil!</h3>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-2xl p-8 border-2 border-orange-300">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ==================== GAMBAR SOP UTAMA ==================== -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-600 to-orange-700 text-white flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">Gambar SOP Utama</h2>
                        </div>

                        <!-- Upload Gambar SOP -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-800 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-600 to-orange-700 text-white flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-image text-sm"></i>
                                </span>
                                Gambar SOP (Full Page) *
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_sop" id="gambar_sop" 
                                       class="w-full px-6 py-4 text-lg border-2 border-orange-400 rounded-xl focus:ring-4 focus:ring-orange-500/30 focus:border-orange-600 transition-all duration-300 bg-white shadow-md file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-800 hover:file:bg-orange-200"
                                       accept=".jpg,.jpeg,.png" required>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-600 text-sm font-medium">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-700 mt-2 font-medium">
                                <i class="fas fa-info-circle mr-1 text-orange-600"></i>
                                Format: JPG, JPEG, PNG - Gambar akan ditampilkan full halaman di publik
                            </p>
                            
                            <!-- Preview Gambar -->
                            <div id="preview_gambar_sop" class="mt-4 hidden">
                                <div class="relative rounded-xl overflow-hidden border-2 border-orange-400 shadow-xl">
                                    <img id="img_preview_gambar_sop" src="" alt="Preview Gambar SOP" class="w-full h-auto">
                                    <div class="absolute top-2 right-2">
                                        <button type="button" onclick="removeImage('gambar_sop')" class="w-8 h-8 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors shadow-lg">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== GAMBAR PROSES ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-orange-300">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-amber-600 to-amber-700 text-white flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">Gambar Proses</h2>
                        </div>

                        <!-- Upload Gambar Proses -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-800 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 text-white flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-images text-sm"></i>
                                </span>
                                Gambar Proses (Full Page) *
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_proses" id="gambar_proses" 
                                       class="w-full px-6 py-4 text-lg border-2 border-amber-400 rounded-xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-600 transition-all duration-300 bg-white shadow-md file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200"
                                       accept=".jpg,.jpeg,.png" required>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-600 text-sm font-medium">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-700 mt-2 font-medium">
                                <i class="fas fa-info-circle mr-1 text-amber-600"></i>
                                Format: JPG, JPEG, PNG - Gambar akan ditampilkan full halaman di publik
                            </p>
                            
                            <!-- Preview Gambar -->
                            <div id="preview_gambar_proses" class="mt-4 hidden">
                                <div class="relative rounded-xl overflow-hidden border-2 border-amber-400 shadow-xl">
                                    <img id="img_preview_gambar_proses" src="" alt="Preview Gambar Proses" class="w-full h-auto">
                                    <div class="absolute top-2 right-2">
                                        <button type="button" onclick="removeImage('gambar_proses')" class="w-8 h-8 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors shadow-lg">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-100 to-amber-100 border-2 border-orange-400 p-6 shadow-xl">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-orange-300/30 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-orange-500 to-amber-600 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-orange-900">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-600 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-900">Gambar SOP:</strong>
                                        <p class="text-orange-800">Upload gambar SOP utama</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-600 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-900">Gambar Proses:</strong>
                                        <p class="text-orange-800">Upload gambar proses SOP</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 border-2 border-blue-400 p-6 shadow-xl">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-300/30 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-900">Tentang SOP Pendokumentasian</h3>
                            </div>
                            <p class="text-sm text-blue-800 leading-relaxed">
                                SOP Pendokumentasian Informasi Publik adalah standar operasional prosedur yang mengatur tata cara pendokumentasian informasi publik sesuai peraturan perundang-undangan yang berlaku.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-500 to-green-700 p-4 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">8</p>
                                <p class="text-xs text-white/90 font-medium">Total SOP</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 p-4 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">4</p>
                                <p class="text-xs text-white/90 font-medium">Bulan Ini</p>
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
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-orange-600 to-amber-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan SOP
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Preview -->
<script>
    // Image Preview Functions
    document.getElementById('gambar_sop').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img_preview_gambar_sop').src = e.target.result;
                document.getElementById('preview_gambar_sop').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('gambar_proses').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img_preview_gambar_proses').src = e.target.result;
                document.getElementById('preview_gambar_proses').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Remove Functions
    function removeImage(type) {
        if (type === 'gambar_sop') {
            document.getElementById('gambar_sop').value = '';
            document.getElementById('preview_gambar_sop').classList.add('hidden');
            document.getElementById('img_preview_gambar_sop').src = '';
        } else if (type === 'gambar_proses') {
            document.getElementById('gambar_proses').value = '';
            document.getElementById('preview_gambar_proses').classList.add('hidden');
            document.getElementById('img_preview_gambar_proses').src = '';
        }
    }
</script>

<style>
    .ck-editor__editable { 
        min-height: 250px; 
    }
</style>
</div>
</div>
@endsection
