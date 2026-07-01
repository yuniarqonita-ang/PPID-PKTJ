@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Edit Data DIP</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Edit <span class="text-[#ffc107]">Informasi Publik</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Perbarui data informasi publik yang sudah tersimpan.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.layanan.daftar-informasi') }}" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-arrow-left mr-3"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="p-6 bg-emerald-50 border-2 border-emerald-200 rounded-3xl flex items-center gap-5 mb-6">
        <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg">
            <i class="fas fa-check"></i>
        </div>
        <div>
            <p class="text-sm font-black text-emerald-900 uppercase tracking-widest">Data Berhasil Diupdate</p>
            <p class="text-lg font-bold text-emerald-700 mt-1">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div class="p-6 bg-red-50 border-2 border-red-200 rounded-3xl mb-6">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li class="text-red-700 font-bold text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.layanan.daftar-informasi.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- CARD 1: INFORMASI DASAR -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        Klasifikasi & Judul Utama
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 gap-10">
                    <div class="space-y-4">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">JUDUL INFORMASI PUBLIK *</label>
                        <input type="text" name="judul_informasi" required value="{{ old('judul_informasi', $item->judul_informasi) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 focus:border-[#002b5c] outline-none transition-all font-bold text-[#002b5c] text-lg"
                            placeholder="Masukkan judul informasi...">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">KATEGORI INFORMASI</label>
                            <select name="kategori" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 appearance-none cursor-pointer font-black text-[#002b5c] text-md">
                                <option value="">PILIH KATEGORI</option>
                                <option value="informasi-berkala" {{ old('kategori', $item->kategori) == 'informasi-berkala' ? 'selected' : '' }}>INFORMASI BERKALA</option>
                                <option value="informasi-serta-merta" {{ old('kategori', $item->kategori) == 'informasi-serta-merta' ? 'selected' : '' }}>INFORMASI SERTA MERTA</option>
                                <option value="informasi-setiap-saat" {{ old('kategori', $item->kategori) == 'informasi-setiap-saat' ? 'selected' : '' }}>INFORMASI SETIAP SAAT</option>
                                <option value="informasi-dikecualikan" {{ old('kategori', $item->kategori) == 'informasi-dikecualikan' ? 'selected' : '' }}>INFORMASI DIKECUALIKAN</option>
                            </select>
                        </div>
                        <div class="space-y-4">
                            <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">TIPE ARSIP</label>
                            <select name="tipe_informasi" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 appearance-none cursor-pointer font-black text-[#002b5c] text-md">
                                <option value="berkala" {{ old('tipe_informasi', $item->tipe_informasi) == 'berkala' ? 'selected' : '' }}>BERKALA</option>
                                <option value="setiapsaat" {{ old('tipe_informasi', $item->tipe_informasi) == 'setiapsaat' ? 'selected' : '' }}>SETIAP SAAT</option>
                                <option value="sertamerta" {{ old('tipe_informasi', $item->tipe_informasi) == 'sertamerta' ? 'selected' : '' }}>SERTA MERTA</option>
                                <option value="dikecualikan" {{ old('tipe_informasi', $item->tipe_informasi) == 'dikecualikan' ? 'selected' : '' }}>DIKECUALIKAN</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: KONTEN DETAIL -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-8">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-align-left"></i>
                        </span>
                        Ringkasan Isi Informasi
                    </h3>
                </div>
                <div class="space-y-6">
                    <textarea id="editor_isi" name="isi_informasi" class="tinymce-editor">{{ old('isi_informasi', $item->isi_informasi) }}</textarea>
                </div>
            </div>
        </div>

        <!-- CARD 3: ADMINISTRATIF -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-user-shield"></i>
                        </span>
                        Otoritas & Tanggung Jawab
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">PEJABAT PENGUASA INFORMASI</label>
                        <input type="text" name="pejabat_penguasa" value="{{ old('pejabat_penguasa', $item->pejabat_penguasa) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]"
                            placeholder="Nama Pejabat/Kepala...">
                    </div>
                    <div class="space-y-4">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">PENERBIT INFORMASI</label>
                        <input type="text" name="penerbit_informasi" value="{{ old('penerbit_informasi', $item->penerbit_informasi) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]"
                            placeholder="Nama Instansi/Bidang Penerbit...">
                    </div>
                    <div class="space-y-4">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">TEMPAT PEMBUATAN</label>
                        <input type="text" name="tempat_pembuatan" value="{{ old('tempat_pembuatan', $item->tempat_pembuatan) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]"
                            placeholder="Lokasi pembuatan dokumen...">
                    </div>
                    <div class="space-y-4">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">PENANGGUNG JAWAB UNIT</label>
                        <select name="penanggung_jawab" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c] appearance-none cursor-pointer">
                            <option value="">PILIH PENANGGUNG JAWAB</option>
                            @php
                                $units = [
                                    "PPID UTAMA",
                                    "Inspektorat Jenderal Kementerian Perhubungan",
                                    "Direktorat Jenderal Perhubungan Darat",
                                    "Direktorat Jenderal Perhubungan Laut",
                                    "Direktorat Jenderal Perhubungan Udara",
                                    "Direktorat Jenderal Perkeretaapian",
                                    "Direktorat Jenderal Integrasi Transportasi dan Multimoda",
                                    "Badan Kebijakan Transportasi",
                                    "Badan Pengembangan Sumber Daya Manusia Perhubungan"
                                ];
                            @endphp
                            @foreach($units as $u)
                                <option value="{{ $u }}" {{ old('penanggung_jawab', $item->penanggung_jawab) == $u ? 'selected' : '' }}>{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- ATRIBUT TEKNIS -->
            <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10 space-y-8">
                <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-[3px] border-b-2 border-slate-50 pb-6 flex items-center">
                    <i class="fas fa-tags mr-3 text-[#ffc107]"></i> ATRIBUT TEKNIS
                </h3>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Waktu Pembuatan (Tahun)</label>
                        <select name="waktu_pembuatan" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c] appearance-none cursor-pointer">
                            <option value="">PILIH TAHUN</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2009;
                            @endphp
                            @for($i = $currentYear; $i >= $startYear; $i--)
                                <option value="{{ $i }}" {{ old('waktu_pembuatan', $item->waktu_pembuatan) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Bentuk Informasi</label>
                        <input type="text" name="bentuk_informasi" value="{{ old('bentuk_informasi', $item->bentuk_informasi) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c]"
                            placeholder="SOFTCOPY / PDF">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Jangka Penyimpanan</label>
                        <input type="text" name="jangka_waktu" value="{{ old('jangka_waktu', $item->jangka_waktu) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c]"
                            placeholder="5 TAHUN / SELAMA BERLAKU">
                    </div>
                </div>

                @php
                    $isGdrive = false;
                    $gdriveUrl = '';
                    if ($item->file_informasi && (strpos($item->file_informasi, 'drive.google.com') !== false || strpos($item->file_informasi, 'docs.google.com') !== false)) {
                        $isGdrive = true;
                        $gdriveUrl = $item->file_informasi;
                    }
                @endphp

                @if($item->file_informasi)
                <div class="p-4 bg-blue-50 border-2 border-blue-100 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if($isGdrive)
                            <i class="fab fa-google-drive text-2xl text-blue-500"></i>
                            <p class="text-xs font-bold text-slate-500 truncate max-w-xs">Link: Google Drive</p>
                        @else
                            <i class="fas fa-file-pdf text-2xl text-red-500"></i>
                            <p class="text-xs font-bold text-slate-500 truncate max-w-xs">File: {{ basename($item->file_informasi) }}</p>
                        @endif
                    </div>
                    <a href="{{ $isGdrive ? $item->file_informasi : asset($item->file_informasi) }}" target="_blank" class="text-xs font-black text-[#004a99] uppercase hover:underline">Lihat</a>
                </div>
                @endif

                <div class="relative group border-4 border-dashed border-slate-200 rounded-[2rem] p-8 hover:border-[#002b5c] transition-all bg-slate-50 text-center">
                    <input type="file" name="file_informasi" class="absolute inset-0 opacity-0 cursor-pointer z-10" accept=".pdf,.doc,.docx">
                    <i class="fas fa-file-pdf text-4xl text-[#002b5c] mb-3"></i>
                    <p class="text-xs font-black text-[#002b5c] uppercase tracking-widest">Ganti Dokumen (Opsional)</p>
                    <p class="text-xs text-slate-400 mt-1">Format: PDF, DOC, DOCX (Max 20MB)</p>
                </div>

                {{-- Google Drive Link --}}
                <div class="space-y-3 pt-2">
                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <i class="fab fa-google-drive mr-2 text-blue-500"></i> ATAU Link Google Drive
                    </label>
                    <input type="url" name="gdrive_link"
                        class="w-full px-8 py-5 bg-slate-50 border-2 border-blue-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-[#002b5c] text-lg"
                        placeholder="https://drive.google.com/file/d/xxx/view"
                        value="{{ old('gdrive_link', $gdriveUrl) }}">
                    <p class="text-[11px] text-blue-500 font-bold">
                        <i class="fas fa-info-circle mr-1"></i> Jika diisi, link Google Drive ini digunakan sebagai dokumen preview (menggantikan upload file lokal).
                    </p>
                </div>

                <!-- IMAGE UPLOAD -->
                <div class="space-y-4">
                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">GAMBAR PENDUKUNG (OPSIONAL)</label>
                    <div class="relative group border-4 border-dashed border-slate-200 rounded-[2rem] p-8 hover:border-[#002b5c] transition-all bg-slate-50 text-center">
                        <input type="file" name="image" id="image_input" class="absolute inset-0 opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(this)">
                        <div id="image_preview_container" class="mb-3 {{ $item->image ? '' : 'hidden' }}">
                            <img id="image_preview" src="{{ $item->image ? asset($item->image) : '#' }}" class="max-h-48 mx-auto rounded-xl shadow-md" onerror="this.parentElement.classList.add('hidden'); document.getElementById('image_placeholder').classList.remove('hidden');">
                        </div>
                        <div id="image_placeholder" class="{{ $item->image ? 'hidden' : '' }}">
                            <i class="fas fa-image text-4xl text-[#002b5c] mb-3"></i>
                            <p class="text-xs font-black text-[#002b5c] uppercase tracking-widest">Pilih Gambar</p>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP (Max 5MB)</p>
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-between border-t border-slate-100 pt-6">
                    <div>
                        <h4 class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Bisa Download</h4>
                        <p class="text-[10px] text-slate-400 font-bold">Izinkan publik mengunduh dokumen langsung tanpa permohonan.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="bisa_download" value="1" {{ ($item->bisa_download ?? false) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Premium View (Blurring)</h4>
                        <p class="text-[10px] text-slate-400 font-bold">Hanya halaman pertama yang terlihat, sisanya blur.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_blurred" value="1" {{ $item->is_blurred ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#ffc107]"></div>
                    </label>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Status Aktif</h4>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="aktif" value="1" {{ $item->aktif ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#002b5c]"></div>
                    </label>
                </div>

                <button type="submit" class="w-full py-6 bg-[#002b5c] text-white font-black text-md uppercase tracking-[3px] rounded-2xl shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                    <i class="fas fa-save mr-3 text-[#ffc107]"></i> SIMPAN PERUBAHAN
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_preview').src = e.target.result;
                document.getElementById('image_preview_container').classList.remove('hidden');
                document.getElementById('image_placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
