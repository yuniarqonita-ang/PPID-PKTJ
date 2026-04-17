@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" id="profil-form">
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto space-y-6">
            
            <!-- HEADER SECTION -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <a href="{{ route('halaman.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel Utama
                    </a>
                    <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                        <i class="fas fa-edit mr-2"></i> 
                        Edit {{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Fungsi' : ($type==='visi' ? 'Visi dan Misi' : ($type==='struktur' ? 'Struktur' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}
                    </h1>
                    <p class="text-gray-500 font-medium">Perbarui konten dinamis untuk halaman <strong>{{ $type }}</strong></p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" class="px-8 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center border-none cursor-pointer">
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
                                <div class="rounded-xl overflow-hidden border border-gray-300 shadow-inner">
                                    <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor text-gray-800">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DYNAMIC SECTIONS -->
                    <div id="additional-sections" class="space-y-8">
                        @if($profil->additional_sections)
                            @foreach($profil->additional_sections as $index => $section)
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden section-card animate-fade-in" id="section-{{ $index }}">
                                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b border-gray-100 font-sans">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-xs">{{ $index + 1 }}</span>
                                            <h4 class="text-sm font-black text-[#004a99] uppercase">Seksi Tambahan</h4>
                                        </div>
                                        <button type="button" onclick="removeSection({{ $index }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors border-none cursor-pointer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-sans">
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Judul Seksi</label>
                                                <input type="text" name="additional_title[]" value="{{ $section['title'] ?? '' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                            </div>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Layout Seksi</label>
                                                <select name="additional_layout[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                                    <option value="default" {{ ($section['layout'] ?? '') === 'default' ? 'selected' : '' }}>Default (Teks / List)</option>
                                                    <option value="diagram" {{ ($section['layout'] ?? '') === 'diagram' ? 'selected' : '' }}>Diagram Struktur</option>
                                                    <option value="cards" {{ ($section['layout'] ?? '') === 'cards' ? 'selected' : '' }}>Kartu Kompetensi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Konten Seksi</label>
                                            <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm font-sans">
                                                <textarea name="additional_content[]" class="tinymce-editor text-gray-800">{!! $section['content'] ?? '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="flex justify-center mt-8">
                        <button type="button" onclick="addSection()" class="px-8 py-3 bg-white border-2 border-dashed border-gray-300 text-gray-500 font-bold rounded-2xl hover:border-[#ffc107] hover:text-[#004a99] transition-all flex items-center cursor-pointer">
                            <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Seksi Konten Baru
                        </button>
                    </div>

                </div>

                <!-- SIDEBAR AREA -->
                <div class="space-y-6">
                    
                    <!-- GUIDE CARD -->
                    <div class="bg-[#004a99] rounded-2xl p-6 text-white shadow-xl relative overflow-hidden ring-1 ring-white/10">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <h3 class="text-md font-black uppercase mb-4 flex items-center">
                            <i class="fas fa-book-reader mr-2 text-[#ffc107]"></i> Panduan Editor
                        </h3>
                        <div class="space-y-4 text-xs font-medium opacity-90 leading-relaxed font-sans">
                            <p><strong class="text-[#ffc107]">1. Judul Utama:</strong> Akan muncul sebagai heading terbesar di halaman.</p>
                            <p><strong class="text-[#ffc107]">2. Konten Pembuka:</strong> Paragraf awal untuk memberikan konteks kepada pembaca.</p>
                            <p><strong class="text-[#ffc107]">3. Seksi Tambahan:</strong> Gunakan untuk memisahkan poin-poin penting agar informasi tidak menumpuk.</p>
                            <p><strong class="text-[#ffc107]">4. Layout:</strong> Pilih <i>Diagram</i> jika Anda ingin menampilkan struktur organisasi otomatis.</p>
                        </div>
                    </div>

                    <!-- META INFO -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-lg space-y-4 border-t-4 border-[#ffc107]">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest font-sans">Informasi Sistem</h4>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl font-sans">
                            <div class="w-10 h-10 bg-blue-50 text-[#004a99] rounded-full flex items-center justify-center">
                                <i class="fas fa-history"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Status Terakhir</p>
                                <p class="text-xs font-black text-gray-700">Aktif di Publik</p>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-4 bg-[#ffc107] text-[#004a99] font-black uppercase tracking-widest rounded-xl hover:bg-yellow-400 transition-all shadow-lg hover:shadow-yellow-400/20 border-none cursor-pointer">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>

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
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 350,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false,
        content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:14px }'
    };

    tinymce.init(tinymceConfig);

    let sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

    function addSection() {
        const id = sectionCount++;
        const container = document.getElementById('additional-sections');
        const sectionHtml = `
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden section-card animate-fade-in" id="section-${id}">
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-[#004a99] text-white flex items-center justify-center font-bold text-xs">${id + 1}</span>
                        <h4 class="text-sm font-black text-[#004a99] uppercase font-sans">Seksi Tambahan Baru</h4>
                    </div>
                    <button type="button" onclick="removeSection(${id})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors border-none cursor-pointer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1 font-sans">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Judul Seksi</label>
                            <input type="text" name="additional_title[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                        </div>
                        <div class="space-y-1 font-sans">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Layout Seksi</label>
                            <select name="additional_layout[]" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#004a99] focus:outline-none">
                                <option value="default">Default (Teks / List)</option>
                                <option value="diagram">Diagram Struktur</option>
                                <option value="cards">Kartu Kompetensi</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1 font-sans">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Konten Seksi</label>
                        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm">
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
    }
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
    .font-sans {
        font-family: 'Inter', sans-serif;
    }
</style>
@endsection
