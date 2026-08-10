@extends('layouts.app')

@php
    $kategori = request('kategori');
    
    $sopCategoryPrefixMap = [
        'SOP Permintaan Informasi Publik' => 'sop_permintaan',
        'SOP Penanganan Keberatan' => 'sop_keberatan',
        'SOP Pengajuan Sengketa Informasi Publik' => 'sop_sengketa',
    ];
    
    $sopCategoryRoutes = [
        'SOP Permintaan Informasi Publik' => route('admin.prosedur.sop-permintaan'),
        'SOP Penanganan Keberatan' => route('admin.prosedur.sop-keberatan'),
        'SOP Pengajuan Sengketa Informasi Publik' => route('admin.prosedur.sop-sengketa'),
    ];

    $isSop = str_starts_with($kategori ?? '', 'SOP ');
    $sopPrefix = $sopCategoryPrefixMap[$kategori] ?? null;

    if ($kategori === 'Laporan Layanan') {
        $cancelUrl = route('admin.layanan.laporan-layanan');
        $title = 'Buat Laporan Layanan Informasi';
        $subtitle = 'Publikasikan arsip laporan pelayanan informasi publik baru';
    } elseif ($kategori === 'Laporan Akses') {
        $cancelUrl = route('admin.layanan.laporan-akses');
        $title = 'Buat Laporan Akses Informasi';
        $subtitle = 'Publikasikan rekapitulasi data akses informasi publik baru';
    } elseif ($kategori === 'Laporan Survey') {
        $cancelUrl = route('admin.layanan.laporan-survey');
        $title = 'Buat Laporan Survey Kepuasan';
        $subtitle = 'Publikasikan laporan survey kepuasan masyarakat baru';
    } elseif ($isSop && isset($sopCategoryRoutes[$kategori])) {
        $cancelUrl = $sopCategoryRoutes[$kategori];
        $title = 'Tambah Data - ' . $kategori;
        $subtitle = 'Unggah dokumen baru dan konfigurasi tampilan halaman SOP';
    } else {
        $cancelUrl = route('admin.dokumen.index');
        $title = 'Buat Dokumen / Laporan';
        $subtitle = 'Publikasikan dokumen atau laporan baru ke sistem';
    }
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 text-gray-800">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-file-upload mr-2 text-[#ffc107] text-gray-800"></i> {!! str_replace('Laporan', '<span class="text-gray-800">Laporan</span>', $title) !!}
                </h1>
                <p class="text-gray-500 font-medium mt-1">{{ $subtitle }}</p>
            </div>
            <a href="{{ $cancelUrl }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-times mr-2"></i> Batalkan
            </a>
        </div>

        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-8">
                    
                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Dokumen / Laporan</label>
                        <input type="text" name="judul" required value="{{ old('judul') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]"
                            placeholder="Masukkan judul dokumen yang jelas...">
                        @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Category Field (Hidden if preset, select dropdown if not) -->
                    @if($kategori)
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                    @else
                        <div class="space-y-3">
                            <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Kategori Dokumen</label>
                            <select name="kategori" required
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c] appearance-none cursor-pointer">
                                <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum / Lainnya</option>
                                <option value="Laporan Layanan" {{ old('kategori') == 'Laporan Layanan' ? 'selected' : '' }}>Laporan Layanan Informasi</option>
                                <option value="Laporan Akses" {{ old('kategori') == 'Laporan Akses' ? 'selected' : '' }}>Laporan Akses Informasi</option>
                                <option value="Laporan Survey" {{ old('kategori') == 'Laporan Survey' ? 'selected' : '' }}>Laporan Survey Kepuasan</option>
                                <option value="Regulasi" {{ old('kategori') == 'Regulasi' ? 'selected' : '' }}>Regulasi / Aturan</option>
                                <option value="SOP Permintaan Informasi Publik" {{ old('kategori') == 'SOP Permintaan Informasi Publik' ? 'selected' : '' }}>SOP Permintaan Informasi Publik</option>
                                <option value="SOP Penanganan Keberatan" {{ old('kategori') == 'SOP Penanganan Keberatan' ? 'selected' : '' }}>SOP Penanganan Keberatan</option>
                                <option value="SOP Pengajuan Sengketa Informasi Publik" {{ old('kategori') == 'SOP Pengajuan Sengketa Informasi Publik' ? 'selected' : '' }}>SOP Pengajuan Sengketa Informasi Publik</option>
                            </select>
                            @error('kategori') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    <!-- Date Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                        @error('tanggal') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description Field (untuk Laporan, bukan SOP) -->
                    @if(!$isSop)
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Deskripsi / Detail Laporan</label>
                        <div class="rounded-3xl overflow-hidden border-2 border-slate-100 text-gray-800">
                            <textarea name="deskripsi" id="editor" class="tinymce-editor text-gray-800">{{ old('deskripsi') }}</textarea>
                        </div>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                    @endif

                    <!-- File Upload -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Lampiran Dokumen (PDF/DOC/DOCX/JPG/PNG)</label>
                        <div class="relative group">
                            <input type="file" name="file" id="file" class="hidden" onchange="updateFileName(this)" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div onclick="document.getElementById('file').click()" 
                                class="w-full p-10 border-4 border-dashed border-slate-100 rounded-[2rem] flex flex-col items-center justify-center cursor-pointer group-hover:border-[#004a99]/20 group-hover:bg-blue-50/30 transition-all">
                                <i class="fas fa-cloud-upload-alt text-5xl text-slate-200 group-hover:text-[#004a99] mb-4 transition-all"></i>
                                <p id="file-name-display" class="text-sm font-black text-slate-400 uppercase tracking-widest text-center">Tarik file ke sini atau klik untuk memilih</p>
                                <p class="text-[10px] text-slate-300 font-bold mt-2 uppercase">Maksimal 10MB</p>
                            </div>
                        </div>
                        @error('file') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Google Drive Link (ATAU) -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] flex items-center">
                            <i class="fab fa-google-drive mr-2 text-blue-500"></i> ATAU Link Google Drive
                        </label>
                        <input type="url" name="gdrive_link" value="{{ old('gdrive_link') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-blue-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-[#002b5c]"
                            placeholder="https://drive.google.com/file/d/xxx/view">
                        <p class="text-[10px] text-blue-500 font-bold mt-1">
                            <i class="fas fa-info-circle mr-1"></i> Jika diisi, link ini digunakan sebagai dokumen preview (menggantikan upload file).
                        </p>
                        @error('gdrive_link') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    @if($isSop && $sopPrefix)
                        @php
                            $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
                            $judulHeroVal = $settings[$sopPrefix . '_judul_hero'] ?? $kategori;
                            $taglineHeroVal = $settings[$sopPrefix . '_tagline_hero'] ?? '';
                            $kontenVal = $settings[$sopPrefix . '_konten'] ?? '';
                        @endphp
                        
                        <div class="pt-8 border-t border-slate-100 space-y-8">
                            <div class="bg-gradient-to-r from-blue-50/50 to-indigo-50/30 p-8 rounded-3xl border border-blue-100/60 space-y-8">
                                <div>
                                    <h3 class="text-sm font-black text-[#004a99] uppercase tracking-[2px] flex items-center">
                                        <i class="fas fa-sliders-h mr-3 text-amber-500"></i> Pengaturan Halaman SOP
                                    </h3>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Konfigurasi judul, tagline, dan narasi untuk halaman publik SOP ini</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider block">Judul Banner Halaman</label>
                                        <input type="text" name="judul_hero" value="{{ $judulHeroVal }}"
                                            class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-4 focus:ring-[#004a99]/10 font-bold text-[#002b5c]">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider block">Tagline Banner Halaman</label>
                                        <input type="text" name="tagline_hero" value="{{ $taglineHeroVal }}"
                                            class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-4 focus:ring-[#004a99]/10 font-bold text-[#002b5c]">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block">Narasi / Deskripsi Halaman SOP</label>
                                    <textarea name="konten" class="tinymce-editor">{{ $kontenVal }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Status Publikasi Toggle -->
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between text-gray-800">
                        <div>
                            <h4 class="text-sm font-black text-[#002b5c] uppercase tracking-widest text-gray-800">Status Publikasi</h4>
                            <p class="text-xs text-gray-400 font-medium">Aktifkan agar langsung muncul di website publik</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" checked class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#004a99]"></div>
                        </label>
                    </div>

                    <!-- PREMIUM BLUR TOGGLE -->
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between p-6 bg-gradient-to-r from-blue-50 to-white rounded-3xl border border-blue-100 shadow-sm">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-[#004a99]/10 rounded-2xl flex items-center justify-center text-[#004a99]">
                                <i class="fas fa-eye-slash text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-800 uppercase tracking-widest leading-tight">Premium Blur</h4>
                                <p class="text-[10px] text-blue-500 font-bold uppercase tracking-tighter">Document Protection System</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_blurred" value="1" class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <!-- BISA DOWNLOAD TOGGLE -->
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between p-6 bg-gradient-to-r from-emerald-50 to-white rounded-3xl border border-emerald-100 shadow-sm">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600">
                                <i class="fas fa-download text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-800 uppercase tracking-widest leading-tight">Bisa Download</h4>
                                <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-tighter">Direct Download Link</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="bisa_download" value="1" class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 text-gray-800">
                <button type="submit" class="px-16 py-6 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-[2rem] shadow-2xl shadow-blue-900/20 hover:bg-black hover:-translate-y-1 transition-all border-none cursor-pointer">
                    <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> Publikasikan Sekarang
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const display = document.getElementById('file-name-display');
        if (input.files && input.files[0]) {
            display.innerText = input.files[0].name;
            display.classList.remove('text-slate-400');
            display.classList.add('text-[#004a99]');
        }
    }
</script>
@endsection
