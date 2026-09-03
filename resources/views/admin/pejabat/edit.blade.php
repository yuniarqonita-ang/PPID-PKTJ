@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8 max-w-5xl mx-auto">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] tracking-tight">Edit Pejabat: {{ $pejabat->nama }}</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Perbarui foto, biografi, riwayat pendidikan, jabatan & LHKPN.</p>
        </div>
        <a href="{{ route('admin.informasi.berkala.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Informasi Berkala
        </a>
    </div>

    @if($errors->any())
    <div class="p-6 bg-rose-50 border-2 border-rose-200 rounded-3xl space-y-2">
        <p class="font-black text-rose-800 text-sm uppercase">Terjadi Kesalahan:</p>
        <ul class="list-disc list-inside text-xs text-rose-700 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.pejabat.update', $pejabat->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[2.5rem] p-10 shadow-xl border-2 border-slate-100 space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pejabat->nama) }}" required class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Jabatan Struktural <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $pejabat->jabatan) }}" required class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Tempat, Tanggal Lahir</label>
                <input type="text" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $pejabat->tempat_tanggal_lahir) }}" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all" placeholder="Contoh: Magelang, 25 September 1966">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Urutan Tampilan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $pejabat->urutan ?? 1) }}" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <!-- MODUL PENGATURAN FOTO & UKURAN GAMBAR (IN-FORM CUSTOMIZER) -->
            <div class="space-y-6 md:col-span-2 bg-gradient-to-br from-slate-50 via-blue-50/20 to-amber-50/20 p-8 rounded-3xl border-2 border-blue-100">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-4 border-b border-slate-200 gap-3">
                    <div>
                        <h3 class="text-base font-black text-[#004a99] flex items-center gap-2">
                            <i class="fas fa-crop-alt text-amber-500"></i> Pas Foto & Penyesuaian Ukuran Gambar
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Unggah foto dan atur dimensi tampilan pas foto pejabat ini secara kustom.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-[10px] font-black uppercase tracking-wider">
                        <i class="fas fa-magic"></i> Live Size Customizer
                    </div>
                </div>

                @php
                    $fWidth  = old('foto_width', $pejabat->foto_width ?? 160);
                    $fHeight = old('foto_height', $pejabat->foto_height ?? 240);
                    $fCardH  = old('foto_card_height', $pejabat->foto_card_height ?? 390);
                    $fPos    = old('foto_position', $pejabat->foto_position ?? 'top center');
                    $fRad    = old('foto_radius', $pejabat->foto_radius ?? '14px');
                    $currentPhoto = $pejabat->foto ? asset($pejabat->foto) : asset('img/pejabat/direktur_bambang.png');
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- CONTROLS -->
                    <div class="lg:col-span-7 space-y-5">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Unggah Pas Foto Baru:</label>
                            <input type="file" name="foto" id="inputFotoPejabat" accept="image/*" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-2xl focus:border-[#004a99] text-xs font-medium text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#004a99] file:text-white hover:file:bg-[#003875] transition-all" onchange="previewNewUploadPhoto(this)">
                        </div>

                        <div>
                            <label class="text-[11px] font-black uppercase tracking-wider text-slate-600 block mb-2">Preset Ukuran Cepat:</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <button type="button" onclick="setFormPhotoPreset(160, 240, 390, 'top center', '14px')" class="p-2.5 bg-amber-500/15 hover:bg-amber-500/25 border-2 border-amber-400 rounded-xl text-left transition-all">
                                    <span class="block text-[#004a99] text-[11px] font-black">⭐ 4x6 Standar</span>
                                    <span class="text-[10px] text-slate-500">160 x 240 px</span>
                                </button>
                                <button type="button" onclick="setFormPhotoPreset(170, 230, 390, 'top center', '16px')" class="p-2.5 bg-white hover:bg-slate-100 border border-slate-300 rounded-xl text-left transition-all">
                                    <span class="block text-[#004a99] text-[11px] font-black">BPSDMP Gaya</span>
                                    <span class="text-[10px] text-slate-500">170 x 230 px</span>
                                </button>
                                <button type="button" onclick="setFormPhotoPreset(130, 175, 340, 'top center', '12px')" class="p-2.5 bg-white hover:bg-slate-100 border border-slate-300 rounded-xl text-left transition-all">
                                    <span class="block text-[#004a99] text-[11px] font-black">3x4 Sedang</span>
                                    <span class="text-[10px] text-slate-500">130 x 175 px</span>
                                </button>
                                <button type="button" onclick="setFormPhotoPreset(190, 275, 430, 'top center', '16px')" class="p-2.5 bg-white hover:bg-slate-100 border border-slate-300 rounded-xl text-left transition-all">
                                    <span class="block text-[#004a99] text-[11px] font-black">Jumbo 5x7</span>
                                    <span class="text-[10px] text-slate-500">190 x 275 px</span>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="space-y-1">
                                <label class="text-[11px] font-black uppercase text-slate-600">Lebar Tabel (px):</label>
                                <input type="number" id="formInpW" name="foto_width" value="{{ $fWidth }}" min="80" max="350" class="w-full px-3 py-2.5 bg-white border-2 border-slate-200 rounded-xl font-bold text-xs text-slate-800" oninput="updateFormLivePreview()">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-black uppercase text-slate-600">Tinggi Tabel (px):</label>
                                <input type="number" id="formInpH" name="foto_height" value="{{ $fHeight }}" min="100" max="450" class="w-full px-3 py-2.5 bg-white border-2 border-slate-200 rounded-xl font-bold text-xs text-slate-800" oninput="updateFormLivePreview()">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-black uppercase text-slate-600">Tinggi Kartu (px):</label>
                                <input type="number" id="formInpCardH" name="foto_card_height" value="{{ $fCardH }}" min="250" max="600" class="w-full px-3 py-2.5 bg-white border-2 border-slate-200 rounded-xl font-bold text-xs text-slate-800">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="text-[11px] font-black uppercase text-slate-600">Fokus / Posisi Pas Foto:</label>
                                <select id="formInpPos" name="foto_position" class="w-full px-3 py-2.5 bg-white border-2 border-slate-200 rounded-xl font-bold text-xs text-slate-800" onchange="updateFormLivePreview()">
                                    <option value="top center" {{ $fPos === 'top center' ? 'selected' : '' }}>Atas (Fokus Wajah & Dasi)</option>
                                    <option value="center center" {{ $fPos === 'center center' ? 'selected' : '' }}>Tengah (Center)</option>
                                    <option value="bottom center" {{ $fPos === 'bottom center' ? 'selected' : '' }}>Bawah</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-black uppercase text-slate-600">Kelengkungan Sudut:</label>
                                <select id="formInpRad" name="foto_radius" class="w-full px-3 py-2.5 bg-white border-2 border-slate-200 rounded-xl font-bold text-xs text-slate-800" onchange="updateFormLivePreview()">
                                    <option value="14px" {{ $fRad === '14px' ? 'selected' : '' }}>Melengkung Elegan (14px)</option>
                                    <option value="8px" {{ $fRad === '8px' ? 'selected' : '' }}>Sedang (8px)</option>
                                    <option value="0px" {{ $fRad === '0px' ? 'selected' : '' }}>Kotak Pas Foto Klasik (0px)</option>
                                    <option value="24px" {{ $fRad === '24px' ? 'selected' : '' }}>Sangat Bulat (24px)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- LIVE PREVIEW BOX -->
                    <div class="lg:col-span-5 bg-white p-5 rounded-2xl border-2 border-slate-200 text-center flex flex-col items-center justify-center shadow-sm">
                        <span class="text-[10px] font-black uppercase text-[#004a99] tracking-wider mb-2">Pratinjau Langsung Pas Foto</span>
                        <div class="bg-slate-100 p-3 rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden" style="min-height: 250px; min-width: 170px; max-width: 100%;">
                            <img id="formPreviewImg" src="{{ $currentPhoto }}" alt="Preview" class="shadow-md border-2 border-white transition-all duration-200" style="width: {{ $fWidth }}px; height: {{ $fHeight }}px; object-fit: cover; object-position: {{ $fPos }}; border-radius: {{ $fRad }};">
                        </div>
                        <span id="formPreviewDimText" class="text-[11px] font-mono text-slate-600 mt-2.5 font-bold">{{ $fWidth }}px x {{ $fHeight }}px</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function setFormPhotoPreset(w, h, cardH, pos, rad) {
                document.getElementById('formInpW').value = w;
                document.getElementById('formInpH').value = h;
                document.getElementById('formInpCardH').value = cardH;
                document.getElementById('formInpPos').value = pos;
                document.getElementById('formInpRad').value = rad;
                updateFormLivePreview();
            }

            function updateFormLivePreview() {
                const w = document.getElementById('formInpW').value || 160;
                const h = document.getElementById('formInpH').value || 240;
                const pos = document.getElementById('formInpPos').value || 'top center';
                const rad = document.getElementById('formInpRad').value || '14px';

                const img = document.getElementById('formPreviewImg');
                const text = document.getElementById('formPreviewDimText');

                if (img) {
                    img.style.width = w + 'px';
                    img.style.height = h + 'px';
                    img.style.objectPosition = pos;
                    img.style.borderRadius = rad;
                }
                if (text) {
                    text.textContent = w + 'px x ' + h + 'px';
                }
            }

            function previewNewUploadPhoto(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('formPreviewImg').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- BIOGRAFI (FORMAT 1 PARAGRAF GAYA POLTRADA BALI) -->
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Biografi & Profil Pejabat (1 Paragraf Ringkas Gaya Poltrada Bali)</label>
                <span class="text-[11px] text-slate-400 font-bold"><i class="fas fa-align-left mr-1"></i> Format 1 Paragraf Padat</span>
            </div>
            <textarea name="biografi" rows="5" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-medium text-slate-800 transition-all leading-relaxed" placeholder="Alamat kantor... Lahir di... Menempuh pendidikan... Pernah menjabat sebagai... dan saat ini menjabat sebagai...">{{ old('biografi', $pejabat->biografi) }}</textarea>
            <p class="text-[11px] text-slate-400 font-medium">Tuliskan narasi dalam 1 paragraf mengalir yang mencakup alamat kantor, pendidikan, riwayat jabatan, dan tanda kehormatan/penghargaan.</p>
        </div>

        <!-- RIWAYAT PENDIDIKAN & JABATAN (ARSIP / DATA DUKUNG) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Riwayat Pendidikan (Data Dukung / Arsip)</label>
                <textarea name="pendidikan" rows="4" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-xs font-medium text-slate-800 transition-all font-mono">{{ old('pendidikan', is_array($pejabat->pendidikan) ? implode("\n", $pejabat->pendidikan) : $pejabat->pendidikan) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Riwayat Jabatan / Karir (Data Dukung / Arsip)</label>
                <textarea name="riwayat_jabatan" rows="4" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-xs font-medium text-slate-800 transition-all font-mono">{{ old('riwayat_jabatan', is_array($pejabat->riwayat_jabatan) ? implode("\n", $pejabat->riwayat_jabatan) : $pejabat->riwayat_jabatan) }}</textarea>
            </div>
        </div>

        <!-- LHKPN SECTION (KHUSUS DIREKTUR & INPUT LINK GOOGLE DRIVE) -->
        <div class="bg-amber-50/60 p-8 rounded-3xl border-2 border-amber-100 space-y-6">
            <div class="flex items-center justify-between flex-wrap gap-2 pb-3 border-b border-amber-200">
                <h4 class="text-base font-black text-amber-900 flex items-center gap-2">
                    <i class="fab fa-google-drive text-amber-600 text-lg"></i> Kolom Pengisian Link Google Drive LHKPN (Khusus Direktur)
                </h4>
                <span class="px-3 py-1 bg-amber-200 text-amber-900 rounded-full text-[10px] font-black uppercase tracking-wider">
                    Khusus Direktur
                </span>
            </div>

            @php
                $isDirekturEdit = ($pejabat->urutan == 1) || (stripos($pejabat->jabatan, 'direktur') !== false && stripos($pejabat->jabatan, 'wakil') === false);
            @endphp

            @if($isDirekturEdit)
                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                    Sesuai ketentuan, dokumen LHKPN di portal PPID dikhususkan untuk <strong>Direktur PKTJ</strong>. Tempelkan tautan Google Drive dokumen LHKPN resmi di bawah ini. <br><em class="text-amber-800">Catatan: Jika link dikosongkan dan tidak ada file diunggah, tombol LHKPN di halaman publik otomatis tidak akan dimunculkan.</em>
                </p>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-amber-900 uppercase flex items-center gap-2">
                            <i class="fab fa-google-drive text-emerald-600"></i> Link Google Drive LHKPN Resmi Direktur
                        </label>
                        <div class="relative">
                            <input type="url" name="lhkpn_link" value="{{ old('lhkpn_link', $pejabat->lhkpn_link) }}" 
                                   class="w-full px-5 py-4 bg-white border-2 border-amber-300 rounded-2xl text-sm font-bold text-slate-800 placeholder-slate-400 focus:border-[#004a99] focus:outline-none transition-all" 
                                   placeholder="https://drive.google.com/file/d/xxxxxx/view?usp=sharing">
                        </div>
                        <p class="text-[11px] text-slate-500"><i class="fas fa-info-circle mr-1"></i> Pastikan akses tautan Google Drive diatur ke <strong>"Siapa saja yang memiliki link"</strong> (Anyone with the link can view).</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-amber-900 uppercase">Tahun Lapor LHKPN</label>
                            <input type="text" name="lhkpn_tahun" value="{{ old('lhkpn_tahun', $pejabat->lhkpn_tahun ?? '2025/2026') }}" 
                                   class="w-full px-4 py-3 bg-white border-2 border-amber-200 rounded-xl text-xs font-bold text-slate-800" 
                                   placeholder="Contoh: 2025/2026">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-amber-900 uppercase">Atau Unggah Berkas PDF LHKPN (Opsional)</label>
                            <input type="file" name="lhkpn_file" accept=".pdf" 
                                   class="w-full px-4 py-2.5 bg-white border-2 border-amber-200 rounded-xl text-xs font-bold text-slate-800 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-amber-600 file:text-white">
                        </div>
                    </div>
                </div>
            @else
                <div class="p-4 bg-white/80 rounded-2xl border border-amber-200 text-slate-600 text-xs flex items-center gap-3">
                    <i class="fas fa-info-circle text-amber-500 text-base flex-shrink-0"></i>
                    <div>
                        <span class="font-bold text-slate-800">LHKPN Dikhususkan Untuk Direktur PKTJ.</span>
                        <p class="text-slate-500 text-[11px] mt-0.5 mb-0">Sesuai instrumen Monev KIP, publikasi dokumen LHKPN di website resmi difokuskan untuk Direktur PKTJ. Pengisian LHKPN untuk pejabat ini tidak diperlukan.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ $pejabat->aktif ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-2 border-slate-300 text-[#004a99] focus:ring-0">
            <label for="aktif" class="text-sm font-bold text-slate-700 cursor-pointer">Tampilkan pejabat ini di halaman publik</label>
        </div>

        <div class="pt-6 border-t-2 border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.informasi.berkala.index') }}" class="px-8 py-4 bg-slate-100 text-slate-700 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all">Batal</a>
            <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-blue-900/20 hover:bg-[#003875] transition-all">Perbarui Pejabat</button>
        </div>
    </form>

</div>
@endsection
