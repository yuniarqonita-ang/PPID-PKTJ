@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 animate-fade-in lg:px-8">
    
    <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" id="profil-form">
        @csrf
        @method('PUT')

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('halaman.index') }}" class="inline-flex items-center text-slate-400 hover:text-[#004a99] transition-colors mb-3 text-xs font-bold uppercase tracking-widest">
                    <i class="fas fa-arrow-left mr-2 font-bold"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#002b5c] tracking-tight">
                    Edit <span class="text-[#004a99]">{{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Fungsi' : ($type==='visi' ? 'Visi dan Misi' : ($type==='struktur' ? 'Struktur' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Kustomisasi konten halaman dan aset digital secara dinamis</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-900/20 hover:bg-[#002b5c] hover:scale-105 active:scale-95 transition-all flex items-center border-none">
                    <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="space-y-8 mt-8">
            
            <div class="space-y-8">
                
                <!-- CONTENT CARD -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-8 md:p-10 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-50 pb-6">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                Konten Utama
                            </h3>
                            <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Required Fields</span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-8">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Utama Halaman</label>
                                <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" required
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tagline Hero Banner</label>
                                <input type="text" name="tagline_hero" value="{{ old('tagline_hero', $profil->tagline_hero) }}"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700"
                                    placeholder="Kalimat penarik yang muncul di bagian atas halaman...">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 block">Isi Konten Pembuka</label>
                                <div class="rounded-2xl overflow-hidden border border-slate-200">
                                    <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                </div>
                            </div>

                            @if($type === 'profil')
                            <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100/50 space-y-4">
                                <label class="text-xs font-bold text-[#004a99] uppercase tracking-widest flex items-center">
                                    <i class="fas fa-quote-left mr-2 text-gray-800"></i> Gambaran Singkat / Ringkasan Halaman
                                </label>
                                <p class="text-[10px] text-slate-500 font-medium italic mt-[-10px] ml-6">Ringkasan ini akan muncul di bagian awal halaman publik sebagai pengantar.</p>
                                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white">
                                    <textarea name="gambaran" id="editor_gambaran" class="tinymce-editor">{!! old('gambaran', $profil->gambaran) !!}</textarea>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ADDITIONAL SECTIONS -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between px-4">
                        <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Seksi Konten Tambahan</h3>
                        <button type="button" onclick="addSection()" class="px-5 py-2.5 bg-white border border-slate-200 text-[#004a99] font-bold text-xs rounded-xl hover:bg-slate-50 transition-all flex items-center">
                            <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Seksi
                        </button>
                    </div>

                    <div id="additional-sections" class="space-y-6">
                        @if($profil->additional_sections)
                            @foreach($profil->additional_sections as $index => $section)
                                <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden animate-fade-in group" id="section-{{ $index }}">
                                    <div class="bg-slate-50/50 px-8 py-5 flex justify-between items-center border-b border-slate-100">
                                        <div class="flex items-center gap-4">
                                            <div class="w-8 h-8 rounded-lg bg-[#002b5c] text-white flex items-center justify-center font-black text-[10px]">{{ $index + 1 }}</div>
                                            <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest">Seksi #{{ $index + 1 }}</h4>
                                        </div>
                                        <button type="button" onclick="removeSection({{ $index }})" class="w-8 h-8 flex items-center justify-center text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all border-none cursor-pointer">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                    <div class="p-8 space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul Seksi</label>
                                                <input type="text" name="additional_title[]" value="{{ $section['title'] ?? '' }}" 
                                                    class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-[#004a99] transition-all">
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Layout Penampilan</label>
                                                <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-[#004a99] transition-all">
                                                    <option value="default" {{ ($section['layout'] ?? '') === 'default' ? 'selected' : '' }}>Standar (Teks Berurutan)</option>
                                                    <option value="diagram" {{ ($section['layout'] ?? '') === 'diagram' ? 'selected' : '' }}>Diagram / Alur Proses</option>
                                                    <option value="cards" {{ ($section['layout'] ?? '') === 'cards' ? 'selected' : '' }}>Kompetensi (Grid Card)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konten Isi Seksi</label>
                                            <div class="rounded-xl overflow-hidden border border-slate-200 bg-white">
                                                <textarea name="additional_content[]" class="tinymce-editor">{!! $section['content'] ?? '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <!-- SIDEBAR SETTINGS (NOW MOVED BELOW) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- PREVIEW / ACTION CARD -->
                <div class="bg-[#002b5c] rounded-[2.5rem] p-8 text-white shadow-2xl shadow-blue-900/20 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-3 border-b border-white/10 pb-6">
                            <div class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-lg">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black uppercase tracking-widest">Status Publikasi</h4>
                                <p class="text-[10px] text-blue-200/60 font-bold uppercase tracking-widest mt-0.5">Siap diterbitkan</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-blue-200/80">Tipe Halaman:</span>
                                <span class="bg-blue-400/20 px-3 py-1 rounded-full font-black uppercase tracking-widest text-[9px]">{{ strtoupper($type) }}</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-blue-200/80">Terakhir Update:</span>
                                <span class="font-black text-[#ffc107] uppercase tracking-widest text-[9px]">{{ $profil->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[3px] rounded-2xl hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-amber-500/20 mt-4">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                <!-- DYNAMIC ASSETS CARD (Changes based on $type) -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 p-8 space-y-8">
                    <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest border-b border-slate-50 pb-6 flex items-center">
                        <span class="w-2 h-5 bg-[#ffc107] rounded-full mr-3"></span>
                        Aset Digital Halaman
                    </h4>

                    <div class="space-y-6">
                        <!-- YOUTUBE (Global) -->
                        <div class="p-5 bg-slate-50 rounded-3xl border border-slate-100 space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center">
                                <i class="fab fa-youtube mr-2 text-red-500"></i> YouTube Video Link
                            </label>
                            <input type="url" name="youtube_link" value="{{ $settings['youtube_link'] ?? '' }}" 
                                class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-red-500 transition-all"
                                placeholder="https://youtube.com/watch?v=...">
                        </div>

                        <!-- SOP SPECIFIC -->
                        @if(str_starts_with($type, 'sop-'))
                        <div class="p-5 bg-emerald-50/50 rounded-3xl border border-emerald-100 space-y-4">
                            <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center">
                                <i class="fas fa-file-image mr-2"></i> File Diagram SOP
                            </label>
                            <div class="space-y-3">
                                <input type="file" name="gambar_sop" class="text-[10px] font-bold text-emerald-800">
                                @if($settings['gambar_sop'] ?? null)
                                    <div class="p-2 bg-white rounded-lg border border-emerald-100 flex items-center text-[9px] text-emerald-600 font-bold overflow-hidden">
                                        <i class="fas fa-check-circle mr-2"></i> {{ Str::limit($settings['gambar_sop'], 20) }}
                                    </div>
                                @endif
                                <input type="file" name="gambar_proses" class="text-[10px] font-bold text-emerald-800 mt-2">
                            </div>
                        </div>
                        @endif

                        <!-- STRUCTURE SPECIFIC -->
                        @if($type === 'struktur')
                        <div class="p-5 bg-blue-50/50 rounded-3xl border border-blue-100 space-y-4">
                            <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest flex items-center">
                                <i class="fas fa-sitemap mr-2"></i> Role Struktur
                            </label>
                            <div class="space-y-4">
                                <input type="text" name="struktur_role_1" value="{{ $settings['struktur_role_1'] ?? '' }}" class="w-full px-4 py-2 bg-white border border-blue-100 rounded-xl text-xs font-bold" placeholder="Jabatan Utama">
                                <input type="text" name="struktur_sub_1" value="{{ $settings['struktur_sub_1'] ?? '' }}" class="w-full px-4 py-2 bg-white border border-blue-100 rounded-xl text-[10px] font-medium" placeholder="Sub-Jabatan">
                            </div>
                        </div>
                        @endif

                        <!-- REPORT SPECIFIC -->
                        @if(str_contains($type, 'laporan') || $type === 'maklumat-pelayanan' || $type === 'layanan-daftar')
                        <div class="p-5 bg-purple-50/50 rounded-3xl border border-purple-100 space-y-4">
                            <label class="text-[10px] font-black text-purple-600 uppercase tracking-widest flex items-center">
                                <i class="fas fa-file-pdf mr-2"></i> Download Laporan
                            </label>
                            <div class="space-y-3">
                                <input type="text" name="tahun_laporan" value="{{ $settings['tahun_laporan'] ?? '' }}" class="w-full px-4 py-2 bg-white border border-purple-100 rounded-xl text-xs" placeholder="Tahun Laporan">
                                <input type="file" name="file_laporan" class="text-[10px] font-bold text-purple-800">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- HELP CARD -->
                <div class="bg-indigo-50 rounded-3xl p-8 border border-indigo-100 space-y-4">
                    <h4 class="text-xs font-black text-indigo-900 uppercase tracking-widest flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-gray-800"></i> Tips Editor
                    </h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 mt-4 text-gray-800">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            <p class="text-xs text-indigo-800 font-medium leading-relaxed">Gunakan <strong class="text-gray-800">Tagline Hero</strong> untuk menyapa pengunjung di baris paling atas.</p>
                        </li>
                        <li class="flex items-start gap-3 mt-4 text-gray-800">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            <p class="text-xs text-indigo-800 font-medium leading-relaxed">Pilih layout <strong class="text-gray-800">Diagram</strong> pada seksi tambahan untuk menampilkan file gambar yang kamu upload.</p>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </form>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const tinymceConfig = {
        selector: '.tinymce-editor',
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | alignjustify | emoticons charmap | removeformat',
        height: 600,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false,
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #475569; text-align: justify; }'
    };

    tinymce.init(tinymceConfig);

    let sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

    function addSection() {
        const id = sectionCount++;
        const container = document.getElementById('additional-sections');
        const sectionHtml = `
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden animate-fade-in" id="section-${id}">
                <div class="bg-slate-50/50 px-8 py-5 flex justify-between items-center border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-[#002b5c] text-white flex items-center justify-center font-black text-[10px]">${id + 1}</div>
                        <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest">Seksi Tambahan Baru</h4>
                    </div>
                    <button type="button" onclick="removeSection(${id})" class="w-8 h-8 flex items-center justify-center text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all border-none">
                        <i class="fas fa-trash-alt text-xs"></i>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul Seksi</label>
                            <input type="text" name="additional_title[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-[#004a99] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Layout Penampilan</label>
                            <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-[#004a99] transition-all">
                                <option value="default">Standar (Teks Berurutan)</option>
                                <option value="diagram">Diagram / Alur Proses</option>
                                <option value="cards">Kompetensi (Grid Card)</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konten Isi Seksi</label>
                        <div class="rounded-xl overflow-hidden border border-slate-200 bg-white">
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
        if(confirm('Hapus seksi ini? Semua teks di dalamnya akan hilang.')) {
            const section = document.getElementById(`section-${id}`);
            section.classList.add('opacity-0', 'scale-95');
            setTimeout(() => section.remove(), 300);
        }
    }
</script>
@endsection
