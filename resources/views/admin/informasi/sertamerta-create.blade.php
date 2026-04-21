@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.informasi.sertamerta') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-bolt mr-2 text-[#ffc107]"></i> Buat Pengumuman Serta Merta
                </h1>
                <p class="text-gray-500 font-medium mt-1">Sediakan informasi penting yang harus segera diketahui publik</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.informasi.sertamerta.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- MAIN FIELDS -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Judul Pengumuman <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm"
                                placeholder="Contoh: Pemberitahuan Penutupan Jalur Utama">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2">
                            <label for="deskripsi_singkat" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Deskripsi Singkat
                            </label>
                            <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm resize-none"
                                placeholder="Tuliskan ringkasan informasi di sini...">{{ old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- KONTEN LENGKAP -->
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Konten Lengkap / Detail <span class="text-red-500">*</span>
                            </label>
                            <div class="rounded-2xl overflow-hidden border border-gray-300">
                                <textarea name="konten" id="editor_sertamerta" class="tinymce-editor">{{ old('konten') }}</textarea>
                            </div>
                            @error('konten') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR / SETTINGS -->
                    <div class="space-y-6">
                        
                        <!-- URGENCY SELECTOR -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-exclamation-circle mr-2 text-[#ffc107]"></i> Tingkat Urgensi
                            </h3>
                            
                            <div class="space-y-3">
                                @foreach([
                                    ['val' => 'normal', 'label' => 'Normal', 'icon' => 'fa-info-circle', 'color' => 'blue'],
                                    ['val' => 'segera', 'label' => 'Segera', 'icon' => 'fa-exclamation-triangle', 'color' => 'orange'],
                                    ['val' => 'darurat', 'label' => 'Darurat', 'icon' => 'fa-bolt', 'color' => 'red'],
                                ] as $urgency)
                                    <label class="relative flex items-center p-3 bg-white rounded-xl border border-gray-200 cursor-pointer hover:border-blue-400 transition-all group">
                                        <input type="radio" name="tingkat" value="{{ $urgency['val'] }}" {{ old('tingkat', 'normal') == $urgency['val'] ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 flex items-center justify-center mr-3 peer-checked:bg-{{ $urgency['color'] }}-500 peer-checked:text-white transition-all">
                                            <i class="fas {{ $urgency['icon'] }} text-xs"></i>
                                        </div>
                                        <span class="text-xs font-black uppercase text-gray-500 peer-checked:text-[#004a99] transition-all">{{ $urgency['label'] }}</span>
                                        <div class="ml-auto opacity-0 peer-checked:opacity-100 text-[#004a99]">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- TIME PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-clock mr-2 text-[#ffc107]"></i> Waktu Publikasi
                            </h3>
                            <input type="datetime-local" name="tanggal_publikasi" required
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:ring-2 focus:ring-[#004a99] focus:outline-none shadow-sm"
                                value="{{ old('tanggal_publikasi', now()->format('Y-m-d\TH:i')) }}">
                        </div>

                        <!-- DOCUMENTS PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Berkas Pendukung
                            </h3>
                            <div class="space-y-3">
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" 
                                     onclick="document.getElementById('dokumenInput').click()">
                                    <div class="w-10 h-10 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center mx-auto mb-2 transition-transform group-hover:scale-110">
                                        <i class="fas fa-file-upload"></i>
                                    </div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase">Klik Untuk Unggah</p>
                                    <input type="file" name="dokumen" id="dokumenInput" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden" onchange="handleFileSelect(this)">
                                </div>
                                <div id="dokumen-info" class="hidden animate-fade-in-down">
                                    <div class="flex items-center p-3 bg-white rounded-xl border border-green-200 text-green-600">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span id="dokumen-name" class="text-[9px] font-black truncate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 text-gray-800">
                    <button type="button" onclick="history.back()" class="px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2 text-[#ffc107]"></i> Publikasikan Informasi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const info = document.getElementById('dokumen-info');
            const nameEl = document.getElementById('dokumen-name');
            
            if (file.size > 15 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 15MB.');
                input.value = '';
                return;
            }

            nameEl.innerText = file.name;
            info.classList.remove('hidden');
        }
    }
</script>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
