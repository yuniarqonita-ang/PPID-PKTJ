@extends('layouts.app')

@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 w-full text-gray-800">
    <div class="w-full space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.informasi.berkala.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-file-upload mr-2 text-[#ffc107]"></i> Unggah Informasi Berkala
                </h1>
                <p class="text-gray-500 font-medium mt-1">Sediakan dokumen terbaru untuk akses informasi publik yang transparan</p>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4">
            <i class="fas fa-check-circle text-xl text-emerald-500"></i>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
        @endif

        @if(isset($errors) && $errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">
            <p class="font-bold mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Ada kesalahan, silakan periksa:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.informasi.berkala.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-8" id="create-berkala-form">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- MAIN FIELDS -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2 text-gray-800">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Judul Informasi / Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm"
                                placeholder="Contoh: Laporan Keuangan Semester I 2024">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Deskripsi Singkat (Opsional)
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm tinymce-editor"
                                placeholder="Jelaskan secara singkat isi dari dokumen ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- TANGGAL -->
                        <div class="space-y-2 text-gray-800">
                            <label for="tanggal" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Tanggal Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm">
                            @error('tanggal') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- KELOLA TAUTAN & DOKUMEN (MULTI-LINK ALA BPSDM) -->
                        <div class="bg-gradient-to-br from-blue-50/70 to-slate-50 rounded-3xl p-6 border-2 border-blue-200/90 shadow-sm space-y-4">
                            <div class="flex items-center justify-between flex-wrap gap-2 border-b border-blue-200 pb-3">
                                <div>
                                    <h3 class="text-xs font-black text-[#004a99] uppercase tracking-wider flex items-center">
                                        <i class="fas fa-link text-[#ffc107] mr-2 text-sm"></i> Pengisian Tautan / Link Dokumen (Multi-Link)
                                    </h3>
                                    <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                        Tambahkan tautan dokumen (Google Drive atau URL Halaman) dengan keterangan halaman/dokumen yang jelas (ala BPSDM).
                                    </p>
                                </div>
                                <button type="button" onclick="addTautanRow()" class="px-3.5 py-2 bg-[#004a99] hover:bg-[#003875] text-white font-bold text-xs rounded-xl shadow-sm transition-all inline-flex items-center">
                                    <i class="fas fa-plus mr-1.5"></i> Tambah Link
                                </button>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left" id="tautanRepeaterTable">
                                    <thead>
                                        <tr class="text-[10px] font-black uppercase text-slate-400 tracking-wider">
                                            <th class="py-2 px-3 w-10 text-center">No</th>
                                            <th class="py-2 px-3 w-5/12">Nama / Keterangan Dokumen / Halaman <span class="text-red-500">*</span></th>
                                            <th class="py-2 px-3 w-6/12">URL Link Google Drive / Halaman Web <span class="text-red-500">*</span></th>
                                            <th class="py-2 px-3 w-12 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tautanRepeaterBody">
                                        @php
                                        $oldNama = (array) old('tautan_nama', []);
                                        $oldUrl  = (array) old('tautan_url', []);
                                        $tautanList = [];
                                        if (!empty($oldNama)) {
                                            foreach ($oldNama as $i => $n) {
                                                $tautanList[] = ['nama' => $n, 'url' => $oldUrl[$i] ?? ''];
                                            }
                                        } elseif (isset($item) && !empty($item->tautan_links)) {
                                            $tautanList = is_string($item->tautan_links) ? json_decode($item->tautan_links, true) : (array)$item->tautan_links;
                                        }
                                        if (empty($tautanList) || !is_array($tautanList)) {
                                            $tautanList = [['nama' => '', 'url' => '']];
                                        }
                                    @endphp

                                        @foreach($tautanList as $idx => $tItem)
                                            <tr class="tautan-row border-b border-blue-100 last:border-0">
                                                <td class="py-2.5 px-3 text-center font-bold text-slate-400 row-number text-xs">{{ $idx + 1 }}</td>
                                                <td class="py-2.5 px-3">
                                                    <input type="text" name="tautan_nama[]" value="{{ $tItem['nama'] ?? '' }}" placeholder="Contoh: Profil Lengkap / Renstra 2020-2024" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:border-[#004a99] outline-none">
                                                </td>
                                                <td class="py-2.5 px-3">
                                                    <input type="url" name="tautan_url[]" value="{{ $tItem['url'] ?? '' }}" placeholder="https://drive.google.com/file/d/... atau /profil-organisasi" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-mono text-slate-800 focus:border-[#004a99] outline-none">
                                                </td>
                                                <td class="py-2.5 px-3 text-center">
                                                    <button type="button" onclick="removeTautanRow(this)" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Hapus Link">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pt-2 border-t border-blue-100 flex items-center justify-between flex-wrap gap-2">
                                <p class="text-[10px] text-slate-500 font-medium">
                                    <i class="fas fa-info-circle text-[#004a99] mr-1"></i> Setiap link yang diisi di atas akan muncul sebagai tombol pill tersendiri dengan label yang jelas di tabel publik.
                                </p>
                                <button type="button" onclick="addTautanRow()" class="text-xs text-[#004a99] hover:underline font-bold inline-flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i> + Tambah Baris Link Lagi
                                </button>
                            </div>
                        </div>

                        <!-- ATRIBUT & METADATA KOLOM TABEL DIP (9 KOLOM LENGKAP) -->
                        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-6">
                            <div class="border-b border-slate-100 pb-3">
                                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-wider flex items-center">
                                    <i class="fas fa-table text-[#ffc107] mr-2 text-sm"></i> Kolom Standar DIP (Daftar Informasi Publik)
                                </h3>
                                <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                    Kelola kolom-kolom tabel publik 9 kolom langsung dari form ini.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Pejabat yang Menguasai Informasi -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Pejabat yang Menguasai Informasi</label>
                                    <input type="text" name="pejabat_penguasa" value="{{ old('pejabat_penguasa', 'PPID Pelaksana UPT PKTJ Tegal') }}"
                                        placeholder="Contoh: PPID Pelaksana UPT PKTJ Tegal"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                </div>

                                <!-- Penanggung Jawab / Penerbit -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Penanggung Jawab / Penerbit Informasi</label>
                                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab', 'Bagian Keuangan dan Umum') }}"
                                        placeholder="Contoh: Bagian Keuangan dan Umum"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                </div>

                                <!-- Bentuk Informasi yang Tersedia -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Bentuk Informasi yang Tersedia</label>
                                    <select name="bentuk_informasi" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                        <option value="Hardcopy & Softcopy" {{ old('bentuk_informasi') == 'Hardcopy & Softcopy' ? 'selected' : '' }}>Hardcopy & Softcopy</option>
                                        <option value="Softcopy" {{ old('bentuk_informasi') == 'Softcopy' ? 'selected' : '' }}>Softcopy</option>
                                        <option value="Hardcopy" {{ old('bentuk_informasi') == 'Hardcopy' ? 'selected' : '' }}>Hardcopy</option>
                                    </select>
                                </div>

                                <!-- Jangka Waktu Penyimpanan / Retensi -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Jangka Waktu Penyimpanan / Retensi Arsip</label>
                                    <input type="text" name="jangka_waktu" value="{{ old('jangka_waktu', '1 Tahun') }}"
                                        placeholder="Contoh: 1 Tahun / 2 Tahun / 5 Tahun / Permanen"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                </div>

                                <!-- Tempat Pembuatan Informasi -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Tempat Pembuatan Informasi</label>
                                    <input type="text" name="tempat_pembuatan" value="{{ old('tempat_pembuatan', 'Tegal') }}"
                                        placeholder="Contoh: Tegal"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                </div>

                                <!-- Waktu Pembuatan (Tahun) -->
                                <div class="space-y-1.5">
                                    <label class="block text-[11px] font-bold text-slate-700 uppercase">Waktu / Tahun Pembuatan Informasi</label>
                                    <input type="text" name="waktu_pembuatan" value="{{ old('waktu_pembuatan', date('Y')) }}"
                                        placeholder="Contoh: 2025 / 2026"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:border-[#004a99] outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- GOOGLE DRIVE LINK (OPSI SINGKAT) -->
                        <div class="space-y-2">
                            <label for="gdrive_link" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fab fa-google-drive text-blue-500 mr-1"></i> Link Google Drive Utama (Opsi Singkat)
                            </label>
                            <input type="url" name="gdrive_link" id="gdrive_link" value="{{ old('gdrive_link') }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-blue-200 rounded-2xl text-gray-800 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:outline-none transition-all shadow-sm"
                                placeholder="https://drive.google.com/file/d/xxx/view">
                            <p class="text-[10px] text-blue-500 font-bold mt-1">
                                <i class="fas fa-info-circle mr-1"></i> Jika Anda mengisi baris-baris pada tabel multi-link di atas, tautan di atas akan diutamakan.
                            </p>
                            @error('gdrive_link') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR / UPLOAD -->
                    <div class="space-y-6">
                        
                        <!-- UPLOAD PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Lampiran Berkas Lokal
                            </h3>
                            <p class="text-[9px] text-gray-400 font-bold mb-3 uppercase">Opsional jika sudah isi Link Google Drive</p>
                            
                            <div class="space-y-4">
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" 
                                     onclick="document.getElementById('file-input').click()">
                                    <div class="space-y-2">
                                        <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center mx-auto transition-transform group-hover:scale-110">
                                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-700 uppercase">Pilih Berkas</p>
                                            <p class="text-[9px] text-gray-400 mt-1 font-medium">MAX: PDf, DOC, XLS (10MB)</p>
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
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center text-gray-800">
                                <i class="fas fa-cog mr-2 text-[#ffc107]"></i> Pengaturan
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-200 shadow-sm">
                                    <span class="text-[10px] font-black text-gray-700 uppercase">Status Publikasi</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="aktif" value="1" class="sr-only peer" checked>
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
                                        <input type="checkbox" name="bisa_download" value="1" class="sr-only peer">
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
                                        <input type="checkbox" name="is_blurred" value="1" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="history.back()" class="px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan & Publikasi
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

    function addTautanRow(nama = '', url = '') {
        const tbody = document.getElementById('tautanRepeaterBody');
        if (!tbody) return;
        const rowCount = tbody.querySelectorAll('.tautan-row').length + 1;
        const tr = document.createElement('tr');
        tr.className = 'tautan-row border-b border-blue-100 last:border-0';
        tr.innerHTML = `
            <td class="py-2.5 px-3 text-center font-bold text-slate-400 row-number text-xs">${rowCount}</td>
            <td class="py-2.5 px-3">
                <input type="text" name="tautan_nama[]" value="${nama.replace(/"/g, '&quot;')}" placeholder="Contoh: Profil Lengkap / Renstra 2020-2024" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:border-[#004a99] outline-none">
            </td>
            <td class="py-2.5 px-3">
                <input type="url" name="tautan_url[]" value="${url.replace(/"/g, '&quot;')}" placeholder="https://drive.google.com/file/d/... atau /profil-organisasi" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-mono text-slate-800 focus:border-[#004a99] outline-none">
            </td>
            <td class="py-2.5 px-3 text-center">
                <button type="button" onclick="removeTautanRow(this)" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Hapus Link">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    }

    function removeTautanRow(btn) {
        const row = btn.closest('.tautan-row');
        if (row) {
            row.remove();
            document.querySelectorAll('#tautanRepeaterBody .tautan-row').forEach((r, idx) => {
                const numEl = r.querySelector('.row-number');
                if (numEl) numEl.textContent = idx + 1;
            });
        }
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
