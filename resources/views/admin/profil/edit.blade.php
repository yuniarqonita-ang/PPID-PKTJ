@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 animate-fade-in">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-edit mr-2 text-[#ffc107]"></i> Edit <span class="text-gray-800">{{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Tanggung Jawab' : ($type==='visi' ? 'Visi & Misi' : ($type==='struktur' ? 'Struktur Organisasi' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Sesuaikan konten halaman {{ $type }} untuk ditampilkan di portal publik</p>
            </div>
            <a href="{{ route('halaman.index') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali Ke Pusat Kelola
            </a>
        </div>

        <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" id="profil-form" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- MAIN CONTENT AREA (Left 2/3) -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                Konten Utama Halaman
                            </h3>

                            <div class="grid grid-cols-1 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Halaman (H1)</label>
                                    <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" required
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Tagline Hero Banner</label>
                                    <input type="text" name="tagline_hero" value="{{ old('tagline_hero', $profil->tagline_hero) }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]"
                                        placeholder="Muncul di bawah judul besar di halaman publik...">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Isi Konten Utama (Editor)</label>
                                    <div class="rounded-3xl overflow-hidden border-2 border-slate-100">
                                        <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Sections Area -->
                    <div id="additional-sections" class="space-y-6">
                        <div class="flex items-center justify-between px-4">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest">Seksi Tambahan / Detail</h3>
                            <button type="button" onclick="addSection()" class="px-5 py-2 bg-white border border-slate-200 text-[#004a99] font-bold text-xs rounded-xl hover:bg-[#004a99] hover:text-white transition-all flex items-center shadow-sm">
                                <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Seksi Konten
                            </button>
                        </div>
                        
                        @if($profil->additional_sections)
                            @foreach($profil->additional_sections as $index => $section)
                                <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden" id="section-{{ $index }}">
                                    <div class="bg-slate-50 px-8 py-4 flex justify-between items-center border-b border-slate-100">
                                        <h4 class="text-[10px] font-black text-[#002b5c] uppercase tracking-widest">Seksi #{{ $index + 1 }}</h4>
                                        <button type="button" onclick="removeSection({{ $index }})" class="text-slate-300 hover:text-red-500 transition-colors border-none p-0 bg-transparent cursor-pointer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <div class="p-8 space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase">Judul Seksi</label>
                                                <input type="text" name="additional_title[]" value="{{ $section['title'] ?? '' }}" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase">Variasi Layout</label>
                                                <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                                    <option value="default" {{ ($section['layout'] ?? '') === 'default' ? 'selected' : '' }}>Standar (Teks)</option>
                                                    <option value="diagram" {{ ($section['layout'] ?? '') === 'diagram' ? 'selected' : '' }}>Diagram (Image Center)</option>
                                                    <option value="cards" {{ ($section['layout'] ?? '') === 'cards' ? 'selected' : '' }}>Grid Cards (Icons)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <textarea name="additional_content[]" class="tinymce-editor">{!! $section['content'] ?? '' !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- SIDEBAR AREA (Right 1/3) -->
                <div class="space-y-8">
                    <!-- Save Card -->
                    <div class="bg-[#002b5c] rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden ring-1 ring-white/10">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <div class="relative z-10 space-y-6">
                            <div class="flex items-center gap-3 border-b border-white/10 pb-6">
                                <div class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-save"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest">Aksi Editor</h4>
                                    <p class="text-[10px] text-blue-200/60 font-bold uppercase mt-1">Klik untuk simpan</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-5 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[3px] rounded-2xl hover:bg-white hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-amber-500/20">
                                SIMPAN PERUBAHAN
                            </button>
                            <div class="pt-4 space-y-3">
                                <div class="flex items-center justify-between text-[10px]">
                                    <span class="font-bold text-blue-200/50 uppercase">Update:</span>
                                    <span class="font-black text-[#ffc107] uppercase">{{ $profil->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assets Card -->
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 p-8 space-y-6">
                        <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                            <i class="fas fa-images mr-2 text-[#ffc107]"></i> ASET DINAMIS
                        </h4>
                        
                        <div class="space-y-4">
                            @if(str_starts_with($type, 'sop-'))
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase">Input Gambar SOP</label>
                                <input type="file" name="gambar_sop" class="text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700">
                            </div>
                            @endif

                            @if($type === 'struktur')
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase">Input Struktur (Role 1)</label>
                                <input type="text" name="struktur_role_1" value="{{ $settings['struktur_role_1'] ?? '' }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                            </div>
                            @endif

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase">Youtube Video Link</label>
                                <input type="url" name="youtube_link" value="{{ $settings['youtube_link'] ?? '' }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold" placeholder="https://youtube.com/watch?v=...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

    function addSection() {
        const id = sectionCount++;
        const container = document.getElementById('additional-sections');
        const html = `
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden animate-fade-in" id="section-${id}">
                <div class="bg-slate-50 px-8 py-4 flex justify-between items-center border-b border-slate-100">
                    <h4 class="text-[10px] font-black text-[#002b5c] uppercase tracking-widest">Seksi Tambahan Baru</h4>
                    <button type="button" onclick="removeSection(${id})" class="text-slate-300 hover:text-red-500 transition-colors border-none p-0 bg-transparent cursor-pointer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Judul Seksi</label>
                            <input type="text" name="additional_title[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Variasi Layout</label>
                            <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                <option value="default">Standar (Teks)</option>
                                <option value="diagram">Diagram (Image Center)</option>
                                <option value="cards">Grid Cards (Icons)</option>
                            </select>
                        </div>
                    </div>
                    <textarea id="mce-${id}" name="additional_content[]" class="tinymce-editor"></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        
        // Re-init TinyMCE for new element
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: `#mce-${id}`,
                license_key: 'gpl',
                height: 400,
                plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignjustify align | link image table | numlist bullist indent outdent | emoticons charmap | removeformat',
                branding: false,
                content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #1e293b; text-align: justify; }'
            });
        }
    }

    function removeSection(id) {
        if(confirm('Hapus seksi ini?')) {
            document.getElementById(`section-${id}`).remove();
        }
    }
</script>
@endpush
