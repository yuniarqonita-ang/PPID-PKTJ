@extends('layouts.app')

@section('content')
<<<<<<< Updated upstream
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" id="profil-form">
=======
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
    <form id="edit-form" action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data">
>>>>>>> Stashed changes
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto space-y-6">
            
            <!-- HEADER SECTION -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <a href="{{ route('admin.profil.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel Utama
                    </a>
                    <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                        <i class="fas fa-edit mr-2"></i> 
                        Edit {{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Fungsi' : ($type==='visi' ? 'Visi dan Misi' : ($type==='struktur' ? 'Struktur' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}
                    </h1>
                    <p class="text-gray-500 font-medium">Perbarui konten dinamis untuk halaman <strong>{{ $type }}</strong></p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" class="px-8 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

            <!-- MAIN CONTENT AREA -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- BASIC INFO CARD -->
                    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
                        <div class="p-6 md:p-8 space-y-6">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest flex items-center">
                                <i class="fas fa-info-circle mr-2 text-[#004a99]"></i> Informasi Dasar
                            </h3>
                            
                            <!-- JUDUL UTAMA -->
                            <div class="space-y-2">
                                <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Judul Utama Halaman <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $profil->judul) }}" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:ring-2 focus:ring-[#004a99] focus:outline-none transition-all"
                                    placeholder="Masukkan judul halaman...">
                            </div>

                            <!-- TAGLINE HERO -->
                            <div class="space-y-2">
                                <label for="tagline_hero" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Tagline Hero (Opsional)</label>
                                <input type="text" name="tagline_hero" id="tagline_hero" value="{{ old('tagline_hero', $profil->tagline_hero) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:ring-2 focus:ring-[#004a99] focus:outline-none transition-all"
                                    placeholder="Slogan atau motivasi singkat di banner atas...">
                            </div>

                            <!-- KONTEN PEMBUKA -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Konten Pembuka (Teks Utama) <span class="text-red-500">*</span></label>
                                <div class="rounded-xl overflow-hidden border border-gray-300">
                                    <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor text-gray-800">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

<<<<<<< Updated upstream
                    <!-- DYNAMIC SECTIONS -->
                    <div id="additional-sections" class="space-y-8">
                        @if($profil->additional_sections)
                            @foreach($profil->additional_sections as $index => $section)
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden section-card animate-fade-in" id="section-{{ $index }}">
                                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b border-gray-100">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-xs">{{ $index + 1 }}</span>
                                            <h4 class="text-sm font-black text-[#004a99] uppercase">Seksi Tambahan</h4>
                                        </div>
                                        <button type="button" onclick="removeSection({{ $index }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-black text-gray-400 uppercase">Judul Seksi</label>
                                                <input type="text" name="additional_title[]" value="{{ $section['title'] ?? '' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                            </div>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-black text-gray-400 uppercase">Layout Seksi</label>
                                                <select name="additional_layout[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                                    <option value="default" {{ ($section['layout'] ?? '') === 'default' ? 'selected' : '' }}>Default (Teks / List)</option>
                                                    <option value="diagram" {{ ($section['layout'] ?? '') === 'diagram' ? 'selected' : '' }}>Diagram Struktur</option>
                                                    <option value="cards" {{ ($section['layout'] ?? '') === 'cards' ? 'selected' : '' }}>Kartu Kompetensi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[10px] font-black text-gray-400 uppercase">Konten Seksi</label>
                                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                                <textarea name="additional_content[]" class="tinymce-editor text-gray-800">{!! $section['content'] ?? '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
=======
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
                                    <div class="custom-toolbar bg-gradient-to-r from-slate-100 to-slate-200 p-2 border-b border-slate-300 flex flex-wrap gap-2 rounded-t-xl">
                                        <!-- Text Formatting -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="toggleBold()" title="Bold"><i class="fas fa-bold"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleItalic()" title="Italic"><i class="fas fa-italic"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleUnderline()" title="Underline"><i class="fas fa-underline"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleStrikethrough()" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                                        </div>
                                        
                                        <!-- Alignment -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="alignLeft()" title="Align Left"><i class="fas fa-align-left"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignCenter()" title="Align Center"><i class="fas fa-align-center"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignRight()" title="Align Right"><i class="fas fa-align-right"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignJustify()" title="Align Justify"><i class="fas fa-align-justify"></i></button>
                                        </div>

                                        <!-- Lists -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="bulletList()" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="numberedList()" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                        </div>

                                        <!-- Insert -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="insertLink()" title="Insert Link"><i class="fas fa-link"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertImage()" title="Insert Image"><i class="fas fa-image"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertTable()" title="Insert Table"><i class="fas fa-table"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertSpecialCharacter()" title="Special Character"><i class="fas fa-star"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertHorizontalRule()" title="Horizontal Line"><i class="fas fa-ruler-horizontal"></i></button>
                                        </div>

                                        <!-- Font Styles -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="changeFontSizePrompt()" title="Font Size"><i class="fas fa-text-height"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="changeFontFamilyPrompt()" title="Font Family"><i class="fas fa-font"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="changeTextColor()" title="Text Color"><i class="fas fa-palette"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="changeBackgroundColor()" title="Background Color"><i class="fas fa-fill-drip"></i></button>
                                        </div>

                                        <!-- Undo/Redo & Extras -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden ml-auto">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="undoAction()" title="Undo"><i class="fas fa-undo"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="redoAction()" title="Redo"><i class="fas fa-redo"></i></button>
                                        </div>
                                    </div>
                                    <div class="editor-content p-4 min-h-[300px] focus:outline-none bg-white rounded-b-xl" id="editor-konten_pembuka" contenteditable="true" data-name="konten_pembuka">{!! old('konten_pembuka', $profil->konten_pembuka) !!}</div>
                                    <input id="hidden-konten_pembuka" name="konten_pembuka" type="hidden" value="{{ old('konten_pembuka', $profil->konten_pembuka) }}">
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
                                    <div class="custom-toolbar bg-gradient-to-r from-slate-100 to-slate-200 p-2 border-b border-slate-300 flex flex-wrap gap-2 rounded-t-xl">
                                        <!-- Text Formatting -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="toggleBold()" title="Bold"><i class="fas fa-bold"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleItalic()" title="Italic"><i class="fas fa-italic"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleUnderline()" title="Underline"><i class="fas fa-underline"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="toggleStrikethrough()" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                                        </div>
                                        
                                        <!-- Alignment -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="alignLeft()" title="Align Left"><i class="fas fa-align-left"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignCenter()" title="Align Center"><i class="fas fa-align-center"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignRight()" title="Align Right"><i class="fas fa-align-right"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="alignJustify()" title="Align Justify"><i class="fas fa-align-justify"></i></button>
                                        </div>

                                        <!-- Lists -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="bulletList()" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="numberedList()" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                        </div>

                                        <!-- Insert -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="insertLink()" title="Insert Link"><i class="fas fa-link"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertImage()" title="Insert Image"><i class="fas fa-image"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="insertTable()" title="Insert Table"><i class="fas fa-table"></i></button>
                                        </div>

                                        <!-- Undo/Redo & Extras -->
                                        <div class="flex bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden ml-auto">
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 text-slate-600" onclick="undoAction()" title="Undo"><i class="fas fa-undo"></i></button>
                                            <button type="button" class="custom-btn px-3 py-2 hover:bg-slate-100 border-l border-slate-200 text-slate-600" onclick="redoAction()" title="Redo"><i class="fas fa-redo"></i></button>
                                        </div>
                                    </div>
                                    <div class="editor-content p-4 min-h-[300px] focus:outline-none bg-white rounded-b-xl" id="editor-konten_detail" contenteditable="true" data-name="konten_detail">{!! old('konten_detail', $profil->konten_detail) !!}</div>
                                    <input id="hidden-konten_detail" name="konten_detail" type="hidden" value="{{ old('konten_detail', $profil->konten_detail) }}">
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
>>>>>>> Stashed changes
                    </div>

                    <div class="flex justify-center">
                        <button type="button" onclick="addSection()" class="px-8 py-3 bg-white border-2 border-dashed border-gray-300 text-gray-500 font-bold rounded-2xl hover:border-[#ffc107] hover:text-[#004a99] transition-all flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Tambah Seksi Konten Baru
                        </button>
                    </div>

                </div>

                <!-- SIDEBAR AREA -->
                <div class="space-y-6">
                    
                    <!-- GUIDE CARD -->
                    <div class="bg-[#004a99] rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <h3 class="text-md font-black uppercase mb-4 flex items-center">
                            <i class="fas fa-book-reader mr-2 text-[#ffc107]"></i> Panduan Editor
                        </h3>
                        <div class="space-y-4 text-xs font-medium opacity-90 leading-relaxed">
                            <p><strong>1. Judul Utama:</strong> Akan muncul sebagai heading terbesar di halaman.</p>
                            <p><strong>2. Konten Pembuka:</strong> Paragraf awal untuk memberikan konteks kepada pembaca.</p>
                            <p><strong>3. Seksi Tambahan:</strong> Gunakan untuk memisahkan poin-poin penting agar informasi tidak menumpuk.</p>
                            <p><strong>4. Layout:</strong> Pilih <i>Diagram</i> jika Anda ingin menampilkan struktur organisasi otomatis.</p>
                        </div>
                    </div>

                    <!-- META INFO -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-4">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Informasi Update</h4>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-blue-50 text-[#004a99] rounded-full flex items-center justify-center">
                                <i class="fas fa-history"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">Terakhir Diperbarui</p>
                                <p class="text-xs font-black text-gray-700">{{ $profil->updated_at ? $profil->updated_at->diffForHumans() : 'Baru' }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('profil-form').submit()" class="w-full py-4 bg-[#ffc107] text-[#004a99] font-black uppercase tracking-widest rounded-xl hover:bg-yellow-400 transition-all shadow-lg hover:shadow-yellow-400/20">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </form>
</div>

<<<<<<< Updated upstream
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const tinymceConfig = {
        selector: '.tinymce-editor',
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 350,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    };

    tinymce.init(tinymceConfig);

    let sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

    function addSection() {
        const id = sectionCount++;
        const container = document.getElementById('additional-sections');
        const sectionHtml = `
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden section-card" id="section-${id}">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-xs">${id + 1}</span>
                        <h4 class="text-sm font-black text-[#004a99] uppercase">Seksi Tambahan Baru</h4>
                    </div>
                    <button type="button" onclick="removeSection(${id})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Judul Seksi</label>
                            <input type="text" name="additional_title[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Layout Seksi</label>
                            <select name="additional_layout[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                <option value="default">Default (Teks / List)</option>
                                <option value="diagram">Diagram Struktur</option>
                                <option value="cards">Kartu Kompetensi</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase">Konten Seksi</label>
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            <textarea id="temp-editor-${id}" name="additional_content[]" class="tinymce-editor"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', sectionHtml);
        tinymce.init({
            ...tinymceConfig,
            selector: `#temp-editor-${id}`
        });
    }

    function removeSection(id) {
        if(confirm('Hapus seksi ini?')) {
            const section = document.getElementById(`section-${id}`);
            section.classList.add('opacity-0', 'scale-95');
            setTimeout(() => section.remove(), 300);
        }
=======
@endsection

@push('scripts')
<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* Custom Editor Styling */
.custom-editor-container {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.editor-content {
    min-height: 400px;
    border: none;
    padding: 20px;
    font-size: 16px;
    line-height: 1.6;
}

.editor-content:focus {
    outline: none;
}

.editor-content p {
    margin-bottom: 1em;
}

.editor-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 10px 0;
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
let activeEditor = null;

// Track which editor is currently focused
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editor-content').forEach(function(el) {
        el.addEventListener('focus', function() { activeEditor = el; });
    });

    // Initialize hidden fields
    ['konten_pembuka', 'konten_detail'].forEach(function(id) {
        var editor = document.getElementById('editor-' + id);
        if (editor) {
            editor.addEventListener('focus', function() { activeEditor = editor; });
            editor.addEventListener('input', function() {
                updateWordCount(id);
                updateHiddenField(id);
            });
            updateWordCount(id);
            updateHiddenField(id);
        }
    });

    // Sync hidden fields before form submit
    var form = document.getElementById('profile-form');
    if (form) {
        form.addEventListener('submit', function() {
            document.querySelectorAll('.editor-content').forEach(function(editor) {
                var name = editor.dataset.name;
                if (!name) return;
                var hidden = form.querySelector('input[type="hidden"][name="' + name + '"]');
                if (hidden) hidden.value = editor.innerHTML;
            });
        });
    }
});

function getActiveEditor() {
    return activeEditor || document.querySelector('.editor-content:focus') || document.querySelector('.editor-content');
}

function updateActiveEditor() {
    var editor = getActiveEditor();
    if (editor) {
        var name = editor.dataset.name;
        if (name) {
            var hidden = document.querySelector('input[type="hidden"][name="' + name + '"]');
            if (hidden) hidden.value = editor.innerHTML;
        }
    }
}

function updateHiddenField(editorId) {
    var editor = document.getElementById('editor-' + editorId);
    var hidden = document.getElementById('hidden-' + editorId);
    if (editor && hidden) { hidden.value = editor.innerHTML; }
}

// Document Functions
function newDocument() {
    var editor = getActiveEditor();
    if (editor && confirm('Hapus semua konten editor ini?')) {
        editor.innerHTML = '';
        updateActiveEditor();
    }
}
function printDocument() { window.print(); }

// Edit Functions
function undoAction() { document.execCommand('undo'); updateActiveEditor(); }
function redoAction() { document.execCommand('redo'); updateActiveEditor(); }

// Clipboard Functions
function cutText() { document.execCommand('cut'); updateActiveEditor(); }
function copyText() { document.execCommand('copy'); }
function pasteText() { document.execCommand('paste'); updateActiveEditor(); }

// Text Formatting Functions
function toggleBold() { document.execCommand('bold'); updateActiveEditor(); }
function toggleItalic() { document.execCommand('italic'); updateActiveEditor(); }
function toggleUnderline() { document.execCommand('underline'); updateActiveEditor(); }
function toggleStrikethrough() { document.execCommand('strikeThrough'); updateActiveEditor(); }
function toggleSuperscript() { document.execCommand('superscript'); updateActiveEditor(); }
function toggleSubscript() { document.execCommand('subscript'); updateActiveEditor(); }
function clearFormatting() { document.execCommand('removeFormat'); updateActiveEditor(); }
function removeFormat() { document.execCommand('unlink'); updateActiveEditor(); }

// Color Functions
function changeTextColor() {
    var color = prompt('Masukkan warna (contoh: #FF0000 atau red):', '#000000');
    if (color) { document.execCommand('foreColor', false, color); updateActiveEditor(); }
}
function changeBackgroundColor() {
    var color = prompt('Masukkan warna background (contoh: #FFFF00 atau yellow):', '#FFFF00');
    if (color) { document.execCommand('hiliteColor', false, color); updateActiveEditor(); }
}

// Font Functions
function changeFontSizePrompt() { 
    var size = prompt('Masukkan ukuran font (1-7):', '3');
    if (size) { document.execCommand('fontSize', false, size); updateActiveEditor(); } 
}
function changeFontFamilyPrompt() { 
    var font = prompt('Masukkan nama font (contoh: Arial, sans-serif):', 'Arial');
    if (font) { document.execCommand('fontName', false, font); updateActiveEditor(); } 
}
function changeHeading(heading) { if (heading) { document.execCommand('formatBlock', false, heading); updateActiveEditor(); } }

// Alignment Functions
function setAlignment(alignText) {
    var editor = getActiveEditor();
    if (!editor) return;
    
    // Gunakan execCommand fallback dulu, jika gagal/tidak efek, ubah DOM
    document.execCommand('justify' + (alignText === 'left' ? 'Left' : alignText === 'center' ? 'Center' : alignText === 'right' ? 'Right' : 'Full'));
    
    // Perkuat dengan block wrapper agar tailwind / css reset tidak menggagalkan
    var selection = window.getSelection();
    if (selection.rangeCount > 0) {
        var range = selection.getRangeAt(0);
        var container = range.commonAncestorContainer;
        if (container.nodeType === 3) container = container.parentNode; // kalo text node, ambil parent
        
        // Jangan align seluruh editor, tapi paragraph/div spesifik di dalamnya
        if (container === editor || container.classList.contains('editor-content')) {
             document.execCommand('formatBlock', false, 'div');
             container = window.getSelection().getRangeAt(0).commonAncestorContainer;
             if (container.nodeType === 3) container = container.parentNode;
        }
        
        if (container !== editor && !container.classList.contains('editor-content')) {
            container.style.textAlign = alignText;
        }
    }
    updateActiveEditor();
}
function alignLeft() { setAlignment('left'); }
function alignCenter() { setAlignment('center'); }
function alignRight() { setAlignment('right'); }
function alignJustify() { setAlignment('justify'); }

// List Functions
function bulletList() { document.execCommand('insertUnorderedList'); updateActiveEditor(); }
function numberedList() { document.execCommand('insertOrderedList'); updateActiveEditor(); }
function outdent() { document.execCommand('outdent'); updateActiveEditor(); }
function indent() { document.execCommand('indent'); updateActiveEditor(); }

// Insert Functions
function insertTable() {
    var rows = prompt('Jumlah baris:', '3');
    var cols = prompt('Jumlah kolom:', '3');
    if (rows && cols) {
        var table = '<table style="border-collapse:collapse;width:100%;margin:15px 0;border:1px solid #cbd5e1;" border="1">';
        for (var i = 0; i < parseInt(rows); i++) {
            table += '<tr>';
            for (var j = 0; j < parseInt(cols); j++) {
                var tag = i === 0 ? 'th' : 'td';
                var cellText = i === 0 ? 'Header ' + (j+1) : 'Data';
                var bg = i === 0 ? 'background-color:#f8fafc;' : '';
                var align = i === 0 ? 'text-align:center;' : 'text-align:left;';
                table += '<' + tag + ' style="border:1px solid #cbd5e1;padding:10px;' + bg + align + '">' + cellText + '</' + tag + '>';
            }
            table += '</tr>';
        }
        table += '</table><p><br></p>'; // Tambah <br> agar bisa mengetik setelah tabel
        
        var editor = getActiveEditor();
        if (editor) {
            editor.focus();
            document.execCommand('insertHTML', false, table);
            updateActiveEditor();
        }
    }
}

function insertImage() {
    var url = prompt('URL Gambar:');
    if (url) {
        var alt = prompt('Teks Alt:') || '';
        document.execCommand('insertHTML', false, '<img src="' + url + '" alt="' + alt + '" style="max-width:100%;margin:10px 0;border:1px solid #ddd;padding:5px;">');
        updateActiveEditor();
    }
}

function insertLink() {
    var url = prompt('URL Link:');
    if (url) {
        document.execCommand('createLink', false, url);
        updateActiveEditor();
    }
}

function insertHorizontalRule() { document.execCommand('insertHorizontalRule'); updateActiveEditor(); }

function insertSpecialCharacter() {
    var chars = ['\u00a9','\u00ae','\u2122','\u00b0','\u00b1','\u2264','\u2265','\u2260','\u221e','\u2211','\u03c0','\u03b1','\u03b2'];
    var char = prompt('Pilih karakter:\n' + chars.join(' '), chars[0]);
    if (char) { document.execCommand('insertText', false, char); updateActiveEditor(); }
}

// Toggle Functions
function toggleSourceCode() {
    var editor = getActiveEditor();
    if (editor) {
        if (editor.dataset.source === 'true') {
            editor.innerHTML = editor.textContent;
            editor.dataset.source = 'false';
            editor.contentEditable = 'true';
        } else {
            editor.textContent = editor.innerHTML;
            editor.dataset.source = 'true';
            editor.contentEditable = 'true';
        }
        updateActiveEditor();
    }
}

function toggleFullscreen() {
    var editor = getActiveEditor();
    if (editor) {
        if (editor.requestFullscreen) editor.requestFullscreen();
        else if (editor.webkitRequestFullscreen) editor.webkitRequestFullscreen();
        else if (editor.msRequestFullscreen) editor.msRequestFullscreen();
    }
}

// Word Count
function updateWordCount(editorId) {
    var editor = document.getElementById('editor-' + editorId);
    if (!editor) return;
    var text = editor.textContent || editor.innerText || '';
    var words = text.trim().split(/\s+/).filter(function(w) { return w.length > 0; }).length;
    var el = document.getElementById('word-count-' + editorId);
    if (el) el.textContent = words + ' kata';
}

function addSection() {
    var container = document.getElementById('sections-container');
    var idx = sectionCount;
    var html = '<div class="section-item bg-gradient-to-r from-slate-50 to-purple-50 rounded-xl p-6 border border-slate-200">'
        + '<div class="flex items-center justify-between mb-4">'
        + '<h3 class="text-lg font-bold text-slate-800 flex items-center">'
        + '<span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm">' + (idx+1) + '</span>'
        + 'Bagian Tambahan ' + (idx+1) + '</h3>'
        + '<button type="button" onclick="removeSection(this)" class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-lg hover:shadow-md transition-all text-sm"><i class="fas fa-trash mr-2"></i>Hapus</button>'
        + '</div>'
        + '<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">'
        + '<div class="lg:col-span-2"><label class="block text-lg font-bold text-slate-700 mb-3">Judul Bagian *</label>'
        + '<input type="text" name="additional_sections[' + idx + '][judul]" class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl bg-white shadow-sm" placeholder="Judul bagian" required></div>'
        + '<div class="lg:col-span-2"><label class="block text-lg font-bold text-slate-700 mb-3">Konten Bagian *</label>'
        + '<div class="custom-editor-container">'
        + '<div class="custom-toolbar"><div class="toolbar-section">'
        + '<button type="button" class="toolbar-btn" onclick="toggleBold()" title="Bold"><i class="fas fa-bold"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="toggleItalic()" title="Italic"><i class="fas fa-italic"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="toggleUnderline()" title="Underline"><i class="fas fa-underline"></i></button>'
        + '</div><div class="toolbar-divider"></div><div class="toolbar-section">'
        + '<button type="button" class="toolbar-btn" onclick="alignLeft()" title="Left"><i class="fas fa-align-left"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="alignCenter()" title="Center"><i class="fas fa-align-center"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="alignRight()" title="Right"><i class="fas fa-align-right"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="alignJustify()" title="Justify"><i class="fas fa-align-justify"></i></button>'
        + '</div><div class="toolbar-divider"></div><div class="toolbar-section">'
        + '<button type="button" class="toolbar-btn" onclick="insertTable()" title="Table"><i class="fas fa-table"></i></button>'
        + '<button type="button" class="toolbar-btn" onclick="insertLink()" title="Link"><i class="fas fa-link"></i></button>'
        + '</div></div>'
        + '<div class="editor-content" id="editor-section-' + idx + '" contenteditable="true" data-name="additional_sections[' + idx + '][konten]"></div>'
        + '<input type="hidden" name="additional_sections[' + idx + '][konten]" id="hidden-section-' + idx + '">'
        + '<div class="word-count"><span id="word-count-section-' + idx + '">0 kata</span></div>'
        + '</div></div></div></div>';

    container.insertAdjacentHTML('beforeend', html);
    sectionCount++;

    setTimeout(function() {
        var editor = document.getElementById('editor-section-' + idx);
        if (editor) {
            editor.addEventListener('focus', function() { activeEditor = editor; });
            editor.addEventListener('input', function() {
                updateWordCount('section-' + idx);
                updateHiddenField('section-' + idx);
            });
        }
    }, 100);
}

function removeSection(btn) {
    var section = btn.closest('.section-item');
    if (section) section.remove();
}

function previewDocument() {
    var konten = document.getElementById('editor-konten_pembuka');
    var preview = window.open('', '_blank');
    if (preview) {
        preview.document.write('<html><head><title>Preview</title><style>body{font-family:sans-serif;padding:30px;max-width:800px;margin:auto;}</style></head><body>');
        preview.document.write('<h2>Preview Konten</h2>');
        if (konten) preview.document.write(konten.innerHTML);
        preview.document.write('</body></html>');
        preview.document.close();
    }
}

function closeEditor() {
    if (confirm('Keluar? Perubahan yang belum disimpan akan hilang.')) {
        window.location.href = document.querySelector('a[href*="admin/profil"]') ? document.querySelector('a[href*="admin/profil"]').href : '/admin/profil';
>>>>>>> Stashed changes
    }
</script>

<style>
    .animate-fade-in { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
