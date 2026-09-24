{{-- 
  Komponen Aturan & Petunjuk Pengisian Tautan Dokumen Standar BPSDM (Khusus Admin Panel)
--}}
<div class="bg-gradient-to-br from-blue-50 via-indigo-50/40 to-amber-50/40 rounded-3xl p-6 md:p-8 border-2 border-blue-200/80 shadow-md mb-8 relative overflow-hidden" x-data="{ open: true }">
    <!-- BACKGROUND ACCENT -->
    <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#004a99]/5 rounded-full blur-2xl pointer-events-none"></div>

    <!-- HEADER & TOGGLE -->
    <div class="flex items-center justify-between gap-4 border-b border-blue-200/70 pb-4 relative z-10">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-[#004a99] text-white flex items-center justify-center text-lg shadow-md shadow-blue-900/20 flex-shrink-0">
                <i class="fas fa-book-bookmark text-[#ffc107]"></i>
            </div>
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-0.5 bg-amber-100 text-amber-900 rounded-full text-[10px] font-black uppercase tracking-wider mb-1 border border-amber-300">
                    <i class="fas fa-certificate text-amber-600"></i> Pedoman Resmi PPID
                </div>
                <h3 class="text-base md:text-lg font-black text-[#002b5c] tracking-tight">
                    📌 Petunjuk Teknis & Aturan Pengisian Tautan Dokumen (Standar ATM BPSDM Kemenhub)
                </h3>
                <p class="text-xs text-slate-600 font-medium mb-0">
                    Panduan format pengisian URL dokumen agar tampilan di website publik otomatis rapi, interaktif, dan sesuai standar BPSDM.
                </p>
            </div>
        </div>
        <button type="button" @click="open = !open" class="px-3.5 py-2 bg-white/80 hover:bg-white text-[#004a99] font-bold text-xs rounded-xl border border-blue-200 shadow-2xs transition-all flex-shrink-0 flex items-center gap-1.5">
            <span x-text="open ? 'Sembunyikan' : 'Buka Petunjuk'"></span>
            <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
        </button>
    </div>

    <!-- CONTENT BODY (COLLAPSIBLE) -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-5 space-y-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- ATURAN 1: TAUTAN WEB EKSTERNAL -->
            <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-emerald-200 shadow-2xs space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-500 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fas fa-globe"></i>
                    </span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider mb-0">1. Tautan Web Resmi</h4>
                </div>
                <p class="text-[11.5px] text-slate-600 leading-relaxed mb-0">
                    Untuk portal website eksternal (misal: <code class="text-emerald-700 bg-emerald-50 px-1 py-0.5 rounded font-mono">pktj.ac.id</code>, <code class="text-emerald-700 bg-emerald-50 px-1 py-0.5 rounded font-mono">dephub.go.id</code>). Awali dengan <code class="font-bold text-slate-700">https://</code>.
                </p>
                <div class="pt-1.5 border-t border-slate-100">
                    <span class="text-[10px] text-slate-400 font-bold block mb-1">Hasil di Publik:</span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-[11px] font-bold bg-gradient-to-r from-emerald-500 to-teal-600 shadow-xs">
                        <i class="fas fa-globe text-[10px]"></i> 🌐 Nama Portal
                    </span>
                </div>
            </div>

            <!-- ATURAN 2: DOKUMEN / GOOGLE DRIVE -->
            <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-blue-200 shadow-2xs space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider mb-0">2. Dokumen / Drive</h4>
                </div>
                <p class="text-[11.5px] text-slate-600 leading-relaxed mb-0">
                    Masukkan URL Google Drive (set hak akses publik: <em>Siapa saja dengan link</em>) atau unggah file PDF langsung lewat form upload.
                </p>
                <div class="pt-1.5 border-t border-slate-100">
                    <span class="text-[10px] text-slate-400 font-bold block mb-1">Hasil di Publik:</span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-[11px] font-bold bg-gradient-to-r from-blue-600 to-indigo-600 shadow-xs">
                        <i class="fas fa-file-alt text-amber-400 text-[10px]"></i> 📄 Unduh Dokumen
                    </span>
                </div>
            </div>

            <!-- ATURAN 3: MULTI-DOKUMEN (FOLDER LIST) -->
            <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-amber-200 shadow-2xs space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-amber-500 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fas fa-folder-open"></i>
                    </span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider mb-0">3. Multi-Dokumen</h4>
                </div>
                <p class="text-[11.5px] text-slate-600 leading-relaxed mb-0">
                    Jika informasi memiliki 2 tautan atau lebih, gunakan tombol <strong>+ Tambah Link</strong>. Publik akan melihat container folder ala BPSDM.
                </p>
                <div class="pt-1.5 border-t border-slate-100">
                    <span class="text-[10px] text-slate-400 font-bold block mb-1">Hasil di Publik:</span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-amber-900 text-[11px] font-bold bg-amber-100 border border-amber-300">
                        📁 2+ Dokumen (Scroll List)
                    </span>
                </div>
            </div>

            <!-- ATURAN 4: DOKUMEN KOSONG / BELUM TERSEDIA -->
            <div class="bg-white/90 backdrop-blur rounded-2xl p-4 border border-sky-200 shadow-2xs space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-sky-500 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fas fa-phone-alt"></i>
                    </span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider mb-0">4. Belum Ada Tautan</h4>
                </div>
                <p class="text-[11.5px] text-slate-600 leading-relaxed mb-0">
                    Jika dokumen belum tersedia atau diisi <code class="font-bold text-slate-700">-</code>, sistem otomatis menyediakan tombol permohonan informasi.
                </p>
                <div class="pt-1.5 border-t border-slate-100">
                    <span class="text-[10px] text-slate-400 font-bold block mb-1">Hasil di Publik:</span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-[11px] font-bold bg-gradient-to-r from-blue-500 to-blue-600 shadow-xs">
                        <i class="fas fa-phone-alt text-[9px]"></i> Permohonan Informasi
                    </span>
                </div>
            </div>

        </div>

        <!-- TIPS BAR -->
        <div class="p-3 bg-white/70 rounded-xl border border-blue-200/60 flex items-center justify-between text-xs text-slate-600 gap-3 flex-wrap">
            <div class="flex items-center gap-2">
                <i class="fas fa-lightbulb text-amber-500 text-sm"></i>
                <span><strong>Tips Pengeditan Cepat:</strong> Anda dapat mengedit judul, deskripsi ringkasan, nama penguasa, tahun, maupun daftar tautan kapan saja melalui tombol <strong>Edit</strong> pada masing-masing baris tabel di bawah.</span>
            </div>
            <span class="text-[11px] font-mono text-slate-400 bg-slate-100 px-2 py-0.5 rounded border">Realtime Sync</span>
        </div>
    </div>
</div>
