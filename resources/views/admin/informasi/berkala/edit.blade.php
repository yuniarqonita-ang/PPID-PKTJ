@extends('layouts.app')

@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 w-full text-gray-800">
    <div class="w-full space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4 text-gray-800">
            <div class="text-gray-800">
                <a href="{{ route('admin.informasi.berkala.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-edit mr-2 text-[#ffc107]"></i> Edit Informasi Berkala
                </h1>
                <p class="text-gray-500 font-medium mt-1">Perbarui detail dokumen informasi berkala</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.informasi.berkala.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-8" id="edit-berkala-form">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- MAIN FIELDS -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2 text-gray-800">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Judul Informasi / Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul) }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm"
                                placeholder="Contoh: Laporan Keuangan Semester I 2024">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2 text-gray-800">
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Deskripsi Singkat (Opsional)
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm tinymce-editor"
                                placeholder="Jelaskan secara singkat isi dari dokumen ini...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- GOOGLE DRIVE LINK -->
                        <div class="space-y-2 text-gray-800">
                            <label for="gdrive_link" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fab fa-google-drive text-blue-500 mr-1"></i> Link Google Drive (Opsional)
                            </label>
                            @if($item->file_path && str_starts_with($item->file_path, 'http'))
                            <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl mb-2 flex items-center gap-2">
                                <i class="fab fa-google-drive text-blue-500"></i>
                                <span class="text-[10px] font-bold text-blue-700 truncate flex-1">GDrive Aktif: {{ $item->file_path }}</span>
                            </div>
                            @endif
                            <input type="url" name="gdrive_link" id="gdrive_link"
                                value="{{ old('gdrive_link', str_starts_with($item->file_path ?? '', 'http') ? $item->file_path : '') }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-blue-200 rounded-2xl text-gray-800 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-none transition-all shadow-sm"
                                placeholder="https://drive.google.com/file/d/xxx/view">
                            <p class="text-[10px] text-blue-500 font-bold mt-1">
                                <i class="fas fa-info-circle mr-1"></i> Jika diisi, link ini akan digunakan sebagai dokumen preview (menggantikan upload file lokal).
                            </p>
                            @error('gdrive_link') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- TANGGAL -->
                        <div class="space-y-2 text-gray-800">
                            <label for="tanggal" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Tanggal Publikasi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal" id="tanggal" required
                                value="{{ old('tanggal', $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : date('Y-m-d')) }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm">
                            @error('tanggal') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR / UPLOAD -->
                    <div class="space-y-6">
                        
                        <!-- UPLOAD PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Berkas Terlampir
                            </h3>
                            
                            <div class="space-y-4">
                                @if($item->file_path || $item->file_informasi)
                                <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white text-red-500 rounded-xl flex items-center justify-center shadow-sm">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1">File Aktif</p>
                                            <p class="text-[11px] font-bold text-[#004a99] truncate">{{ $item->file_name ?? basename($item->file_path ?? $item->file_informasi) }}</p>
                                        </div>
                                        <a href="{{ asset($item->file_path ?? $item->file_informasi) }}" target="_blank" class="text-[#004a99] hover:text-blue-700 p-2">
                                            <i class="fas fa-external-link-alt text-xs"></i>
                                        </a>
                                    </div>
                                    <div class="mt-3 pt-3 border-t border-blue-200">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="hapus_file" value="1" class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500 cursor-pointer">
                                            <span class="text-[11px] font-black text-red-600 uppercase">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus Berkas PDF / Reset File
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                @endif

                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" 
                                     onclick="document.getElementById('file-input').click()">
                                    <div class="space-y-2">
                                        <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center mx-auto transition-transform group-hover:scale-110">
                                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-700 uppercase">Ganti Berkas</p>
                                            <p class="text-[9px] text-gray-400 mt-1 font-medium">Biarkan kosong jika tidak diubah</p>
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
                                        <button type="button" onclick="resetFileSelection()" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('file') <p class="text-red-500 text-[10px] font-bold mt-1 text-center">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- SETTINGS PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 text-gray-800">
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

                                <!-- BISA DOWNLOAD TOGGLE -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-emerald-50 to-white rounded-2xl border border-emerald-100 shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-600">
                                            <i class="fas fa-download text-xs"></i>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-black text-gray-800 uppercase block leading-none">Bisa Download</span>
                                            <span class="text-[8px] text-emerald-600 font-bold uppercase tracking-tighter">Direct Download Link</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="bisa_download" value="1" class="sr-only peer" {{ ($item->bisa_download ?? false) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                    </label>
                                </div>

                                <!-- PREMIUM BLUR TOGGLE -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-white rounded-2xl border border-blue-100 shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-[#004a99]/10 rounded-lg flex items-center justify-center text-[#004a99]">
                                            <i class="fas fa-eye-slash text-xs"></i>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-black text-gray-800 uppercase block leading-none">Premium Blur</span>
                                            <span class="text-[8px] text-blue-500 font-bold uppercase tracking-tighter">Document Protection</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_blurred" value="1" class="sr-only peer" {{ ($item->is_blurred ?? false) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
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
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const info = document.getElementById('file-selected-info');
            const nameEl = document.getElementById('selected-filename');
            const sizeEl = document.getElementById('selected-filesize');
            
            // Validate size (10MB)
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

    function resetFileSelection() {
        const input = document.getElementById('file-input');
        const info = document.getElementById('file-selected-info');
        input.value = '';
        info.classList.add('hidden');
    }
</script>
@endpush

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
