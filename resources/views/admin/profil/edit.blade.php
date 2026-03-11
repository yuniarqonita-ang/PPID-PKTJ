@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    ✏️ Edit {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}
                </h1>
                <p class="text-slate-600 mt-2">Edit konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} yang akan ditampilkan di halaman publik</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.profil.index') }}" 
                   class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <a href="{{ url('/profil/ppid') }}" target="_blank" 
                   class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                    <i class="fas fa-eye mr-2"></i>Lihat Publik
                </a>
            </div>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-300 rounded-2xl p-6 mb-6 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-red-800">Ada kesalahan!</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-6 mb-6 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-green-800">Berhasil!</h3>
                    <div class="mt-2 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <form id="edit-form" action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="p-8">
                
                <!-- ==================== INFORMASI UTAMA ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Informasi Utama</h2>
                            <p class="text-slate-600">Data dasar {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl p-6 border border-slate-200">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-heading text-sm"></i>
                                    </span>
                                    Judul {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} *
                                </label>
                                <input type="text" 
                                       name="judul" 
                                       value="{{ old('judul', $profil->judul) }}"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                                       placeholder="Masukkan judul {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}"
                                       required>
                            </div>

                            <!-- Konten Pembuka -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-align-left text-sm"></i>
                                    </span>
                                    Konten Pembuka *
                                </label>
                                <div class="custom-editor-container">
                                    <div class="custom-toolbar-extension">
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignLeft()" title="Align Left">
                                            <i class="fas fa-align-left"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignCenter()" title="Align Center">
                                            <i class="fas fa-align-center"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignRight()" title="Align Right">
                                            <i class="fas fa-align-right"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignJustify()" title="Align Justify">
                                            <i class="fas fa-align-justify"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertTable()" title="Insert Table">
                                            <i class="fas fa-table"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertHorizontalLine()" title="Horizontal Line">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertSpecialChar()" title="Special Character">
                                            <i class="fas fa-omega"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeFontSize()" title="Font Size">
                                            <i class="fas fa-text-height"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeFontFamily()" title="Font Family">
                                            <i class="fas fa-font"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeTextColor()" title="Text Color">
                                            <i class="fas fa-palette"></i>
                                        </button>
                                    </div>
                                    <input id="konten_pembuka" name="konten_pembuka" type="hidden" value="{{ old('konten_pembuka', $profil->konten_pembuka) }}">
                                    <trix-editor input="konten_pembuka" class="trix-content" placeholder="Masukkan konten pembuka..."></trix-editor>
                                    <div class="word-count">
                                        <span id="word-count-konten_pembuka">0 kata</span>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500 mt-2">Konten pembuka akan ditampilkan di bagian awal halaman</p>
                            </div>

                            <!-- Judul Sub -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-heading text-sm"></i>
                                    </span>
                                    Judul Sub (Opsional)
                                </label>
                                <input type="text" 
                                       name="judul_sub" 
                                       value="{{ old('judul_sub', $profil->judul_sub) }}"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white shadow-sm"
                                       placeholder="Masukkan judul sub {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}">
                            </div>

                            <!-- Konten Detail -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-align-justify text-sm"></i>
                                    </span>
                                    Konten Detail (Opsional)
                                </label>
                                <div class="custom-editor-container">
                                    <div class="custom-toolbar-extension">
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignLeft()" title="Align Left">
                                            <i class="fas fa-align-left"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignCenter()" title="Align Center">
                                            <i class="fas fa-align-center"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignRight()" title="Align Right">
                                            <i class="fas fa-align-right"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="trixEditor.alignJustify()" title="Align Justify">
                                            <i class="fas fa-align-justify"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertTable()" title="Insert Table">
                                            <i class="fas fa-table"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertHorizontalLine()" title="Horizontal Line">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="insertSpecialChar()" title="Special Character">
                                            <i class="fas fa-omega"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeFontSize()" title="Font Size">
                                            <i class="fas fa-text-height"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeFontFamily()" title="Font Family">
                                            <i class="fas fa-font"></i>
                                        </button>
                                        <button type="button" class="custom-btn" onclick="changeTextColor()" title="Text Color">
                                            <i class="fas fa-palette"></i>
                                        </button>
                                    </div>
                                    <input id="konten_detail" name="konten_detail" type="hidden" value="{{ old('konten_detail', $profil->konten_detail) }}">
                                    <trix-editor input="konten_detail" class="trix-content" placeholder="Masukkan konten detail..."></trix-editor>
                                    <div class="word-count">
                                        <span id="word-count-konten_detail">0 kata</span>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500 mt-2">Konten detail akan ditampilkan setelah judul sub</p>
                            </div>

                            <!-- Link Dokumen -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-rose-500 to-rose-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-link text-sm"></i>
                                    </span>
                                    Link Dokumen (Opsional)
                                </label>
                                <input type="url" 
                                       name="link_dokumen" 
                                       value="{{ old('link_dokumen', $profil->link_dokumen) }}"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-300 bg-white shadow-sm"
                                       placeholder="https://example.com/dokumen.pdf">
                                <p class="text-sm text-slate-500 mt-2">Link ke dokumen terkait (jika ada)</p>
                            </div>

                            <!-- Gambar -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-image text-sm"></i>
                                    </span>
                                    Gambar (Opsional)
                                </label>
                                <input type="file" 
                                       name="gambar" 
                                       accept="image/*"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                @if($profil->gambar)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $profil->gambar) }}" alt="Current image" class="h-20 rounded-lg shadow-sm">
                                        <p class="text-xs text-slate-500 mt-1">Gambar saat ini</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ==================== DYNAMIC SECTIONS ==================== -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-layer-group text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-slate-800">Bagian Konten Tambahan</h2>
                                <p class="text-slate-600">Tambahkan beberapa bagian konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="addSection()"
                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center">
                            <i class="fas fa-plus mr-2"></i>Tambah Bagian
                        </button>
                    </div>

                    <div id="sections-container" class="space-y-6">
                        <!-- Existing sections will be loaded here via JavaScript -->
                    </div>
                </div>

                @if($profil->konten_pembuka || $profil->konten_detail)
                <!-- ==================== CURRENT CONTENT ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Konten Saat Ini</h2>
                            <p class="text-slate-600">Preview konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} yang sedang aktif</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-200">
                        <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner p-6">
                            <div class="prose prose-lg max-w-none">
                                @if($profil->konten_pembuka)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-slate-500 mb-3">KONTEN PEMBUKA:</h4>
                                        {!! $profil->konten_pembuka !!}
                                    </div>
                                @endif
                                
                                @if($profil->judul_sub)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-slate-500 mb-3">JUDUL SUB:</h4>
                                        <h3 class="text-xl font-bold text-slate-800">{{ $profil->judul_sub }}</h3>
                                    </div>
                                @endif
                                
                                @if($profil->konten_detail)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-slate-500 mb-3">KONTEN DETAIL:</h4>
                                        {!! $profil->konten_detail !!}
                                    </div>
                                @endif
                                
                                @if($profil->link_dokumen)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-slate-500 mb-3">LINK DOKUMEN:</h4>
                                        <a href="{{ $profil->link_dokumen }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                            <i class="fas fa-download mr-2"></i>
                                            Download Dokumen
                                        </a>
                                    </div>
                                @endif
                                
                                @if($profil->gambar)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-slate-500 mb-3">GAMBAR:</h4>
                                        <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="rounded-lg shadow-md max-w-md">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- ==================== ACTION BUTTONS ==================== -->
            <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-8 py-6 border-t border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-600">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Perubahan akan langsung tersimpan dan ditampilkan di halaman publik
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.profil.index') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Publish Section -->
    <div class="publish-section">
        <div class="publish-header">
            <div class="publish-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <h3>Terbitkan Halaman</h3>
        </div>
        
        <div class="publish-options">
            <div class="radio-group">
                <input type="radio" id="publish-yes" name="publish_status" value="1" checked>
                <label for="publish-yes">Ya</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="publish-no" name="publish_status" value="0">
                <label for="publish-no">Tidak</label>
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" form="edit-form" class="btn-action btn-save">
                <i class="fas fa-save"></i> Simpan
            </button>
            <button type="button" onclick="previewDocument()" class="btn-action btn-preview">
                <i class="fas fa-eye"></i> Lihat
            </button>
            <button type="button" onclick="closeEditor()" class="btn-action btn-close">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Trix Editor - Free Rich Text Editor -->
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* Custom Trix Editor Styling */
.custom-editor-container {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.trix-button-row {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 10px 10px 0 0 !important;
    padding: 8px !important;
    border: none !important;
}

.trix-button {
    background: rgba(255, 255, 255, 0.9) !important;
    border: none !important;
    border-radius: 6px !important;
    margin: 1px !important;
    color: #4a5568 !important;
    transition: all 0.3s !important;
}

.trix-button:hover {
    background: white !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
    color: #667eea !important;
}

.trix-button.trix-active {
    background: #667eea !important;
    color: white !important;
}

.trix-editor {
    min-height: 400px !important;
    border: none !important;
    padding: 20px !important;
    font-size: 16px !important;
    line-height: 1.6 !important;
}

.trix-dialogs {
    background: white !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 8px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.trix-dialog {
    border: none !important;
    box-shadow: none !important;
}

.trix-dialog__link-fields {
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    padding: 16px !important;
}

.trix-dialog__link-fields .trix-button-group {
    display: flex !important;
    gap: 8px !important;
    margin-top: 12px !important;
}

.trix-input {
    border: 2px solid #e5e7eb !important;
    border-radius: 6px !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    transition: border-color 0.3s !important;
}

.trix-input:focus {
    outline: none !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
}

.word-count {
    background: #f8fafc;
    padding: 8px 16px;
    border-top: 1px solid #e5e7eb;
    text-align: right;
    font-size: 12px;
    color: #64748b;
    border-radius: 0 0 10px 10px;
}

.publish-section {
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
}

.publish-header {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.publish-header h3 {
    margin: 0;
    color: #1e293b;
    font-size: 18px;
    font-weight: bold;
}

.publish-icon {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    color: white;
}

.publish-options {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.radio-group {
    display: flex;
    align-items: center;
}

.radio-group input[type="radio"] {
    margin-right: 8px;
    width: 18px;
    height: 18px;
    accent-color: #667eea;
}

.radio-group label {
    color: #374151;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.btn-action {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-save {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.btn-preview {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.btn-close {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Custom Toolbar Extensions */
.custom-toolbar-extension {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 8px;
    border-radius: 10px 10px 0 0;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    border-bottom: 2px solid #e5e7eb;
}

.custom-btn {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    cursor: pointer;
    transition: all 0.3s;
    color: #4a5568;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.custom-btn:hover {
    background: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    color: #667eea;
}

.custom-btn i {
    font-size: 14px;
}

/* Responsive */
@media (max-width: 768px) {
    .publish-options {
        flex-direction: column;
        gap: 12px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<script>
let sectionCount = 0;

// Trix Editor Extensions
window.trixEditor = {
    getActiveEditor: function() {
        return document.activeElement.closest('trix-editor');
    },
    
    alignLeft: function() {
        const editor = this.getActiveEditor();
        if (editor) {
            document.execCommand('justifyLeft', false, null);
        }
    },
    
    alignCenter: function() {
        const editor = this.getActiveEditor();
        if (editor) {
            document.execCommand('justifyCenter', false, null);
        }
    },
    
    alignRight: function() {
        const editor = this.getActiveEditor();
        if (editor) {
            document.execCommand('justifyRight', false, null);
        }
    },
    
    alignJustify: function() {
        const editor = this.getActiveEditor();
        if (editor) {
            document.execCommand('justifyFull', false, null);
        }
    }
};

// Custom Toolbar Functions
function insertTable() {
    const rows = prompt('Jumlah baris:', '3');
    const cols = prompt('Jumlah kolom:', '3');
    
    if (rows && cols) {
        let table = '<table style="border-collapse: collapse; width: 100%; margin: 10px 0;">';
        for (let i = 0; i < parseInt(rows); i++) {
            table += '<tr>';
            for (let j = 0; j < parseInt(cols); j++) {
                const cellType = i === 0 ? 'th' : 'td';
                table += `<${cellType} style="border: 1px solid #ddd; padding: 8px; text-align: left;">${cellType.toUpperCase()} ${j + 1}</${cellType}>`;
            }
            table += '</tr>';
        }
        table += '</table>';
        
        const editor = document.activeElement.closest('trix-editor');
        if (editor) {
            editor.editor.insertHTML(table);
        }
    }
}

function insertHorizontalLine() {
    const editor = document.activeElement.closest('trix-editor');
    if (editor) {
        editor.editor.insertHTML('<hr style="margin: 20px 0; border: 1px solid #ddd;">');
    }
}

function insertSpecialChar() {
    const chars = ['©', '®', '™', '°', '±', '≤', '≥', '≠', '∞', '∑', '∏', 'π', 'Ω', 'α', 'β', 'γ', 'δ', 'ε', 'λ', 'μ', 'σ', 'τ', 'φ', 'χ', 'ψ', 'ω'];
    const char = prompt('Pilih karakter khusus:\n' + chars.join(', '), chars[0]);
    
    if (char && chars.includes(char)) {
        const editor = document.activeElement.closest('trix-editor');
        if (editor) {
            editor.editor.insertString(char);
        }
    }
}

function changeFontSize() {
    const sizes = ['8px', '10px', '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px', '48px'];
    const size = prompt('Pilih ukuran font:\n' + sizes.join(', '), '16px');
    
    if (size && sizes.includes(size)) {
        const editor = document.activeElement.closest('trix-editor');
        if (editor) {
            const selection = editor.editor.getSelectedRange();
            if (selection[0] !== selection[1]) {
                editor.editor.insertHTML(`<span style="font-size: ${size};">${editor.editor.getDocument().getStringAtRange(selection)}</span>`);
            }
        }
    }
}

function changeFontFamily() {
    const fonts = ['Arial', 'Times New Roman', 'Helvetica', 'Georgia', 'Verdana', 'Courier New', 'Comic Sans MS', 'Impact'];
    const font = prompt('Pilih jenis font:\n' + fonts.join(', '), 'Arial');
    
    if (font && fonts.includes(font)) {
        const editor = document.activeElement.closest('trix-editor');
        if (editor) {
            const selection = editor.editor.getSelectedRange();
            if (selection[0] !== selection[1]) {
                editor.editor.insertHTML(`<span style="font-family: '${font}';">${editor.editor.getDocument().getStringAtRange(selection)}</span>`);
            }
        }
    }
}

function changeTextColor() {
    const colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#FFA500', '#800080', '#FFC0CB'];
    const color = prompt('Pilih warna:\n' + colors.join(', '), '#000000');
    
    if (color && colors.includes(color)) {
        const editor = document.activeElement.closest('trix-editor');
        if (editor) {
            const selection = editor.editor.getSelectedRange();
            if (selection[0] !== selection[1]) {
                editor.editor.insertHTML(`<span style="color: ${color};">${editor.editor.getDocument().getStringAtRange(selection)}</span>`);
            }
        }
    }
}

// Word Count Function
function updateWordCount(editorId) {
    const editor = document.querySelector(`trix-editor[input="${editorId}"]`);
    const text = editor ? editor.textContent : '';
    const words = text.trim().split(/\s+/).filter(word => word.length > 0).length;
    const countElement = document.getElementById(`word-count-${editorId}`);
    if (countElement) {
        countElement.textContent = `${words} kata`;
    }
}

// Initialize word count for all editors
document.addEventListener('DOMContentLoaded', function() {
    ['konten_pembuka', 'konten_detail'].forEach(id => {
        const editor = document.querySelector(`trix-editor[input="${id}"]`);
        if (editor) {
            editor.addEventListener('trix-change', () => updateWordCount(id));
            updateWordCount(id);
        }
    });
});

function addSection() {
    const container = document.getElementById('sections-container');
    const sectionIndex = sectionCount;

    const sectionHTML = `
        <div class="section-item bg-gradient-to-r from-slate-50 to-purple-50 rounded-xl p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                    <span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm">
                        ${sectionCount + 1}
                    </span>
                    Bagian Tambahan ${sectionCount + 1}
                </h3>
                <button type="button" onclick="removeSection(this)"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-lg hover:shadow-md transition-all duration-300 transform hover:scale-105 flex items-center text-sm">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Judul Bagian -->
                <div class="lg:col-span-2">
                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-heading text-sm"></i>
                        </span>
                        Judul Bagian Tambahan *
                    </label>
                    <input type="text" name="additional_sections[${sectionIndex}][judul]" value=""
                           class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white shadow-sm"
                           placeholder="Masukkan judul bagian tambahan" required>
                </div>

                <!-- Konten Bagian -->
                <div class="lg:col-span-2">
                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-align-justify text-sm"></i>
                        </span>
                        Konten Bagian Tambahan *
                    </label>
                    <div id="ckeditor-section-${sectionIndex}" class="custom-editor-container">
                        <div class="custom-toolbar-extension">
                            <button type="button" class="custom-btn" onclick="trixEditor.alignLeft()" title="Align Left">
                                <i class="fas fa-align-left"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="trixEditor.alignCenter()" title="Align Center">
                                <i class="fas fa-align-center"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="trixEditor.alignRight()" title="Align Right">
                                <i class="fas fa-align-right"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="trixEditor.alignJustify()" title="Align Justify">
                                <i class="fas fa-align-justify"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="insertTable()" title="Insert Table">
                                <i class="fas fa-table"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="insertHorizontalLine()" title="Horizontal Line">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="insertSpecialChar()" title="Special Character">
                                <i class="fas fa-omega"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="changeFontSize()" title="Font Size">
                                <i class="fas fa-text-height"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="changeFontFamily()" title="Font Family">
                                <i class="fas fa-font"></i>
                            </button>
                            <button type="button" class="custom-btn" onclick="changeTextColor()" title="Text Color">
                                <i class="fas fa-palette"></i>
                            </button>
                        </div>
                        <input id="additional_sections_${sectionIndex}_konten" name="additional_sections[${sectionIndex}][konten]" type="hidden">
                        <trix-editor input="additional_sections_${sectionIndex}_konten" class="trix-content" placeholder="Tulis konten bagian tambahan ini..."></trix-editor>
                        <div class="word-count">
                            <span id="word-count-section-${sectionIndex}">0 kata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', sectionHTML);
    sectionCount++;

    setTimeout(() => {
        const editorId = `additional_sections_${sectionIndex}_konten`;
        const editor = document.querySelector(`trix-editor[input="${editorId}"]`);
        if (editor) {
            editor.addEventListener('trix-change', () => updateWordCount(`section-${sectionIndex}`));
            updateWordCount(`section-${sectionIndex}`);
        }
        updateSectionNumbers();
    }, 100);
}

function removeSection(button) {
    const sectionItem = button.closest('.section-item');
    sectionItem.remove();
    sectionCount--;
    updateSectionNumbers();
}

function updateSectionNumbers() {
    const sections = document.querySelectorAll('.section-item');
    sections.forEach((section, index) => {
        const numberSpan = section.querySelector('span');
        const title = section.querySelector('h3');
        if (numberSpan && title) {
            numberSpan.textContent = index + 1;
            title.innerHTML = title.innerHTML.replace(/Bagian Tambahan \d+/, `Bagian Tambahan ${index + 1}`);
        }
    });
}

function previewDocument() {
    const form = document.getElementById('edit-form');
    const formData = new FormData(form);
    
    // Create preview window
    const previewWindow = window.open('', '_blank');
    
    fetch(form.action.replace('/update', '/preview'), {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.text())
    .then(html => {
        previewWindow.document.write(html);
        previewWindow.document.close();
    })
    .catch(error => {
        console.error('Preview error:', error);
        previewWindow.close();
    });
}

function closeEditor() {
    if (confirm('Apakah Anda yakin ingin keluar? Perubahan yang belum disimpan akan hilang.')) {
        window.location.href = '{{ route('admin.profil.index') }}';
    }
}
</script>
@endpush
