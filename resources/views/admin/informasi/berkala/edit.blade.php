@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 w-full text-gray-800">
    <div class="w-full space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.informasi.berkala.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-edit mr-2 text-[#ffc107]"></i> Perbarui Informasi Berkala
                </h1>
                <p class="text-gray-500 font-medium mt-1">Ubah detail atau ganti dokumen pendukung secara realtime</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.informasi.berkala.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- MAIN FIELDS -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Judul Informasi / Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul) }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm"
                                placeholder="Masukkan judul informasi">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Deskripsi Singkat (Opsional)
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm tinymce-editor"
                                placeholder="Jelaskan isi dokumen...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR / UPLOAD -->
                    <div class="space-y-6">
                        
                        <!-- FILE CURRENT & UPLOAD PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Berkas Terlampir
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- CURRENT FILE -->
                                <div class="p-4 bg-white rounded-2xl border border-blue-100 shadow-sm flex items-center mb-4">
                                    <div class="w-10 h-10 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-black text-[#004a99] uppercase truncate">Berkas Sekarang</p>
                                        <p class="text-[9px] text-gray-500 font-medium truncate italic">{{ $item->file_name }}</p>
                                    </div>
                                </div>

                                <!-- UPLOAD NEW -->
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" 
                                     onclick="document.getElementById('file-input').click()">
                                    <div class="space-y-2">
                                        <div class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center mx-auto transition-transform group-hover:scale-110">
                                            <i class="fas fa-sync-alt"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-700 uppercase leading-tight">Ganti Berkas?</p>
                                            <p class="text-[8px] text-gray-400 mt-1 font-medium italic">Kosongkan jika tidak ingin ganti</p>
                                        </div>
                                    </div>
                                    <input type="file" name="file" id="file-input" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden" onchange="handleFileSelect(this)">
                                </div>

                                <div id="file-selected-info" class="hidden animate-fade-in-down">
                                    <div class="flex items-center p-3 bg-white rounded-xl border border-green-200 shadow-sm">
                                        <div class="w-8 h-8 bg-green-50 text-green-500 rounded-lg flex items-center justify-center mr-3 text-xs">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p id="selected-filename" class="text-[10px] font-bold text-gray-700 truncate"></p>
                                            <p id="selected-filesize" class="text-[9px] text-green-500 font-bold uppercase"></p>
                                        </div>
                                    </div>
                                </div>
                                @error('file') <p class="text-red-500 text-[10px] font-bold mt-1 text-center">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- SETTINGS PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center text-gray-800">
                                <i class="fas fa-cog mr-2 text-[#ffc107]"></i> Pengaturan
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-200 shadow-sm">
                                    <span class="text-[10px] font-black text-gray-700 uppercase">Status Publikasi</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="aktif" value="1" class="sr-only peer" {{ $item->aktif ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#004a99]"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 text-gray-800">
                    <button type="button" onclick="history.back()" class="px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center text-gray-800">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Update Informasi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const info = document.getElementById('file-selected-info');
            const nameEl = document.getElementById('selected-filename');
            const sizeEl = document.getElementById('selected-filesize');
            
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 10MB.');
                input.value = '';
                return;
            }

            nameEl.innerText = file.name;
            sizeEl.innerText = (file.size / 1024).toFixed(1) + ' KB';
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
