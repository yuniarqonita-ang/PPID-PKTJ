@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 text-gray-800">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-plus-circle mr-2 text-[#ffc107] text-gray-800"></i> Buat Informasi <span class="text-gray-800">Setiap Saat</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Tambahkan dokumen yang wajib tersedia setiap saat</p>
            </div>
            <a href="{{ route('admin.informasi.setiapsaat.index') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-times mr-2"></i> Batalkan
            </a>
        </div>

        <form action="{{ route('admin.informasi.setiapsaat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-8">
                    
                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Informasi</label>
                        <input type="text" name="judul" required value="{{ old('judul') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                    </div>

                    <!-- Date Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                    </div>

                    <!-- Content/Description Field -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Deskripsi / Detail Informasi</label>
                        <div class="rounded-3xl overflow-hidden border-2 border-slate-100 text-gray-800">
                            <textarea name="deskripsi" id="editor" class="tinymce-editor text-gray-800">{{ old('deskripsi') }}</textarea>
                        </div>
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
                                        $tautanList = old('tautan_nama') ? array_map(function($n, $u) { return ['nama' => $n, 'url' => $u]; }, old('tautan_nama'), old('tautan_url', [])) : [];
                                        if (empty($tautanList)) {
                                            $tautanList = [['nama' => '', 'url' => '']];
                                        }
                                    @endphp

                                    @foreach($tautanList as $idx => $tItem)
                                        <tr class="tautan-row border-b border-blue-100 last:border-0">
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-400 row-number text-xs">{{ $idx + 1 }}</td>
                                            <td class="py-2.5 px-3">
                                                <input type="text" name="tautan_nama[]" value="{{ $tItem['nama'] ?? '' }}" placeholder="Contoh: Profil Lengkap / Dokumen Pedoman" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:border-[#004a99] outline-none">
                                            </td>
                                            <td class="py-2.5 px-3">
                                                <input type="url" name="tautan_url[]" value="{{ $tItem['url'] ?? '' }}" placeholder="https://drive.google.com/file/d/... atau /pedoman" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-mono text-slate-800 focus:border-[#004a99] outline-none">
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
                                <input type="text" name="jangka_waktu" value="{{ old('jangka_waktu', '10 Tahun') }}"
                                    placeholder="Contoh: 1 Tahun / 5 Tahun / 10 Tahun / Permanen"
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

                    <!-- File Upload -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Lampiran Dokumen (PDF/DOC/JPG)</label>
                        <div class="relative group">
                            <input type="file" name="file" id="file" class="hidden" onchange="updateFileName(this)">
                            <div onclick="document.getElementById('file').click()" 
                                class="w-full p-10 border-4 border-dashed border-slate-100 rounded-[2rem] flex flex-col items-center justify-center cursor-pointer group-hover:border-[#004a99]/20 group-hover:bg-blue-50/30 transition-all">
                                <i class="fas fa-cloud-upload-alt text-5xl text-slate-200 group-hover:text-[#004a99] mb-4 transition-all"></i>
                                <p id="file-name-display" class="text-sm font-black text-slate-400 uppercase tracking-widest text-center">Tarik file ke sini atau klik untuk memilih</p>
                            </div>
                        </div>
                    </div>

                    <!-- Google Drive Link (ATAU) -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] flex items-center">
                            <i class="fab fa-google-drive mr-2 text-blue-500"></i> ATAU Link Google Drive
                        </label>
                        <input type="url" name="gdrive_link" value="{{ old('gdrive_link') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-blue-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-[#002b5c]"
                            placeholder="https://drive.google.com/file/d/xxx/view">
                        <p class="text-[10px] text-blue-500 font-bold">
                            <i class="fas fa-info-circle mr-1"></i> Jika diisi, link ini digunakan sebagai dokumen preview (menggantikan upload file).
                        </p>
                    </div>

                    <!-- Status Toggle -->
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

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 text-gray-800">
                <button type="submit" class="px-16 py-6 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-[2rem] shadow-2xl shadow-blue-900/20 hover:bg-black hover:-translate-y-1 transition-all border-none cursor-pointer">
                    <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> Simpan Dokumen
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

    function addTautanRow(nama = '', url = '') {
        const tbody = document.getElementById('tautanRepeaterBody');
        if (!tbody) return;
        const rowCount = tbody.querySelectorAll('.tautan-row').length + 1;
        const tr = document.createElement('tr');
        tr.className = 'tautan-row border-b border-blue-100 last:border-0';
        tr.innerHTML = `
            <td class="py-2.5 px-3 text-center font-bold text-slate-400 row-number text-xs">${rowCount}</td>
            <td class="py-2.5 px-3">
                <input type="text" name="tautan_nama[]" value="${nama.replace(/"/g, '&quot;')}" placeholder="Contoh: Profil Lengkap / Dokumen Pedoman" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:border-[#004a99] outline-none">
            </td>
            <td class="py-2.5 px-3">
                <input type="url" name="tautan_url[]" value="${url.replace(/"/g, '&quot;')}" placeholder="https://drive.google.com/file/d/... atau /pedoman" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-mono text-slate-800 focus:border-[#004a99] outline-none">
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
@endsection
