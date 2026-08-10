@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    $prefix = $prefix ?? 'sop_permintaan';
    $judulSop = $judulSop ?? 'SOP Permintaan Informasi Publik';
    $publicRoute = $publicRoute ?? route('prosedur.sop-permintaan');

    $valJudul   = $settings[$prefix . '_judul_hero']   ?? $judulSop;
    $valTagline = $settings[$prefix . '_tagline_hero'] ?? 'Alur dan Prosedur ' . $judulSop . ' PPID PKTJ';
    $valKonten  = $settings[$prefix . '_konten'] ?? ($settings[$prefix . '_isi_konten'] ?? '');

    // Enable diagram for all 3 SOP types
    $sopPrefixMap = [
        'sop_permintaan' => 'sop_perm',
        'sop_keberatan'  => 'sop_keb',
        'sop_sengketa'   => 'sop_seng',
    ];
    $isDiagramSop = array_key_exists($prefix, $sopPrefixMap);
    $pKey = $isDiagramSop ? $sopPrefixMap[$prefix] : 'sop_perm';

    $d = $settings;

    // Standard Default Content per SOP Type
    $allDefaults = [
        'sop_perm' => [
            'judul'    => 'Prosedur Permohonan Informasi Publik',
            'subtitle' => 'Langkah-langkah mengajukan permohonan informasi kepada PPID BPSDMP',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Permohonan Informasi','deskripsi'=>'Pemohon informasi mengajukan permohonan informasi melalui PPID BPSDMP','waktu'=>'10 Menit','aktor'=>'Masyarakat','icon'=>'fas fa-user','warna'=>'#004a99'],
                2 => ['nomor'=>'02','judul'=>'Registrasi dengan Mengisi Formulir Identitas','deskripsi'=>'Pemohon informasi melakukan registrasi dengan mengisi formulir identitas','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-id-card','warna'=>'#0284c7'],
                3 => ['nomor'=>'03','judul'=>'Mengajukan Permohonan Informasi Publik','deskripsi'=>'Setelah memenuhi persyaratan identitas, pemohon informasi mengajukan permohonan informasi publik dengan mengisi rincian informasi dan tujuan penggunaannya','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-file-pen','warna'=>'#0284c7'],
                4 => ['nomor'=>'04','judul'=>'Bukti Permohonan Informasi','deskripsi'=>'Petugas PPID memberikan bukti permohonan informasi (nomor pendaftaran) kepada pemohon informasi','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-receipt','warna'=>'#0284c7'],
                5 => ['nomor'=>'05','judul'=>'Penyampaian Jawaban','deskripsi'=>'Jawaban atas permohonan informasi akan disampaikan melalui email yang telah didaftarkan paling lambat 10 hari kerja. Jika diperlukan, waktu ini dapat diperpanjang hingga tambahan 7 hari kerja','waktu'=>'10 (+7) Hari Kerja','aktor'=>'PPID','icon'=>'fas fa-building-columns','warna'=>'#059669'],
                6 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
                7 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
            ],
            'legend' => [
                1 => 'Masyarakat',
                2 => 'Petugas Informasi',
                3 => 'PPID',
            ]
        ],
        'sop_keb' => [
            'judul'    => 'Prosedur Permohonan Keberatan Informasi',
            'subtitle' => 'Alur penanganan keberatan atas penolakan atau ketidakpuasan layanan informasi publik',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Penerimaan Surat Keberatan','deskripsi'=>'Petugas informasi menerima surat dan formulir pengajuan keberatan informasi dari masyarakat','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-file-circle-exclamation','warna'=>'#ef4444'],
                2 => ['nomor'=>'02','judul'=>'Verifikasi Syarat Pengajuan','deskripsi'=>'Petugas informasi memeriksa syarat-syarat pengajuan, seperti KTP / NPWP / Akta Pendirian Badan Hukum','waktu'=>'15 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-clipboard-check','warna'=>'#f59e0b'],
                3 => ['nomor'=>'03','judul'=>'Registrasi & Meneruskan Berkas','deskripsi'=>'Petugas melakukan registrasi keberatan dan meneruskan berkas permohonan keberatan untuk diproses','waktu'=>'15 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-paper-plane','warna'=>'#3b82f6'],
                4 => ['nomor'=>'04','judul'=>'Pemrosesan Keberatan','deskripsi'=>'Tim PPID memproses dan menelaah materi keberatan informasi publik dalam jangka waktu 10 hari kerja','waktu'=>'10 Hari Kerja','aktor'=>'PPID Pelaksana','icon'=>'fas fa-cogs','warna'=>'#8b5cf6'],
                5 => ['nomor'=>'05','judul'=>'Tanggapan & Keputusan Atasan','deskripsi'=>'Atasan PPID membuat tanggapan atas keberatan informasi dalam bentuk Surat Keputusan dalam jangka waktu 5 hari kerja','waktu'=>'5 Hari Kerja','aktor'=>'Atasan PPID','icon'=>'fas fa-gavel','warna'=>'#ec4899'],
                6 => ['nomor'=>'06','judul'=>'Pelaksanaan Keputusan Tertulis','deskripsi'=>'PPID Pelaksana PKTJ melaksanakan keputusan tertulis dari Atasan PPID dalam jangka waktu 1 hari kerja','waktu'=>'1 Hari Kerja','aktor'=>'PPID Pelaksana PKTJ','icon'=>'fas fa-file-signature','warna'=>'#06b6d4'],
                7 => ['nomor'=>'07','judul'=>'Penyerahan Informasi & Tanda Terima','deskripsi'=>'PPID Pelaksana memberikan informasi publik dan tanda terima dokumen resmi kepada pemohon informasi','waktu'=>'1 Hari Kerja','aktor'=>'Masyarakat / Pemohon','icon'=>'fas fa-circle-check','warna'=>'#10b981'],
            ],
            'legend' => [
                1 => 'Masyarakat / Pemohon',
                2 => 'Petugas Informasi / Tim PPID',
                3 => 'Atasan PPID / PPID Pelaksana',
            ]
        ],
        'sop_seng' => [
            'judul'    => 'Prosedur Pengajuan Sengketa Informasi Publik',
            'subtitle' => 'Tata cara penyelesaian sengketa informasi publik melalui Komisi Informasi',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Pengajuan Permohonan Sengketa','deskripsi'=>'Pemohon mengajukan permohonan penyelesaian sengketa ke Komisi Informasi paling lambat 14 hari kerja setelah tanggapan Atasan PPID','waktu'=>'14 Hari Kerja','aktor'=>'Pemohon Informasi','icon'=>'fas fa-scale-balanced','warna'=>'#ef4444'],
                2 => ['nomor'=>'02','judul'=>'Pemeriksaan Administrasi','deskripsi'=>'Kepaniteraan Komisi Informasi memeriksa kelengkapan berkas administrasi dan legal standing pemohon','waktu'=>'3 Hari Kerja','aktor'=>'Kepaniteraan KI','icon'=>'fas fa-file-shield','warna'=>'#f59e0b'],
                3 => ['nomor'=>'03','judul'=>'Registrasi Permohonan Sengketa','deskripsi'=>'Permohonan dicatat dalam Buku Register Sengketa Informasi Publik (BRSIP) dan diterbitkan nomor registrasi','waktu'=>'3 Hari Kerja','aktor'=>'Panitera Komisi Informasi','icon'=>'fas fa-book-bookmark','warna'=>'#3b82f6'],
                4 => ['nomor'=>'04','judul'=>'Proses Mediasi Sengketa','deskripsi'=>'Komisi Informasi memanggil para pihak untuk melakukan proses mediasi penyelesaian sengketa secara musyawarah','waktu'=>'14 Hari Kerja','aktor'=>'Mediator & Para Pihak','icon'=>'fas fa-handshake','warna'=>'#8b5cf6'],
                5 => ['nomor'=>'05','judul'=>'Sidang Ajudikasi Non-Litigasi','deskripsi'=>'Apabila mediasi tidak mencapai kesepakatan, proses dilanjutkan dengan persidangan ajudikasi pembuktian','waktu'=>'14 Hari Kerja','aktor'=>'Majelis Komisioner','icon'=>'fas fa-gavel','warna'=>'#ec4899'],
                6 => ['nomor'=>'06','judul'=>'Putusan Komisi Informasi','deskripsi'=>'Majelis Komisioner membacakan putusan sengketa informasi yang bersifat final dan mengikat bagi para pihak','waktu'=>'Maks. 100 Hari Kerja','aktor'=>'Majelis Komisioner','icon'=>'fas fa-stamp','warna'=>'#10b981'],
                7 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
            ],
            'legend' => [
                1 => 'Pemohon Informasi',
                2 => 'Kepaniteraan / Panitera KI',
                3 => 'Majelis Komisioner KI',
            ]
        ]
    ];

    $currentDefaults = $allDefaults[$pKey] ?? $allDefaults['sop_perm'];
    $diagJudul    = array_key_exists("{$pKey}_diagram_judul", $d)    ? $d["{$pKey}_diagram_judul"]    : $currentDefaults['judul'];
    $diagSubtitle = array_key_exists("{$pKey}_diagram_subtitle", $d) ? $d["{$pKey}_diagram_subtitle"] : $currentDefaults['subtitle'];

    $stepsData = [];
    for ($i = 1; $i <= 7; $i++) {
        $defStep = $currentDefaults['steps'][$i] ?? ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#004a99'];
        $stepsData[$i] = [
            'nomor'     => array_key_exists("{$pKey}_step_{$i}_nomor", $d)     ? $d["{$pKey}_step_{$i}_nomor"]     : $defStep['nomor'],
            'judul'     => array_key_exists("{$pKey}_step_{$i}_judul", $d)     ? $d["{$pKey}_step_{$i}_judul"]     : $defStep['judul'],
            'deskripsi' => array_key_exists("{$pKey}_step_{$i}_deskripsi", $d) ? $d["{$pKey}_step_{$i}_deskripsi"] : $defStep['deskripsi'],
            'waktu'     => array_key_exists("{$pKey}_step_{$i}_waktu", $d)     ? $d["{$pKey}_step_{$i}_waktu"]     : $defStep['waktu'],
            'aktor'     => array_key_exists("{$pKey}_step_{$i}_aktor", $d)     ? $d["{$pKey}_step_{$i}_aktor"]     : $defStep['aktor'],
            'icon'      => array_key_exists("{$pKey}_step_{$i}_icon", $d)      ? $d["{$pKey}_step_{$i}_icon"]      : $defStep['icon'],
            'warna'     => array_key_exists("{$pKey}_step_{$i}_warna", $d)     ? $d["{$pKey}_step_{$i}_warna"]     : $defStep['warna'],
        ];
    }

    $legend = [];
    for ($j = 1; $j <= 3; $j++) {
        $defLeg = $currentDefaults['legend'][$j] ?? "Aktor {$j}";
        $legend[$j] = array_key_exists("{$pKey}_legend_{$j}_nama", $d) ? $d["{$pKey}_legend_{$j}_nama"] : $defLeg;
    }
@endphp

<div class="bg-white rounded-3xl shadow-xl border-2 border-slate-100 overflow-hidden mt-6">
    <!-- Header Form -->
    <div class="p-8 bg-gradient-to-r from-slate-900 via-[#003875] to-[#004a99] text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400 text-blue-950 font-black text-[10px] uppercase rounded-full tracking-widest mb-2">
                <i class="fas fa-sliders-h"></i> PENGATURAN HALAMAN SOP
            </div>
            <h3 class="text-xl font-black text-white uppercase tracking-wider">{{ $judulSop }}</h3>
            <p class="text-xs text-blue-100 font-medium mt-1">Kelola judul banner, narasi teks SOP, dan pengaturan diagram alur interaktif.</p>
        </div>
        @if($publicRoute)
        <a href="{{ $publicRoute }}" target="_blank" class="px-5 py-3 bg-white/10 border border-white/20 text-white hover:bg-white/20 font-black text-xs uppercase tracking-widest rounded-xl transition-all flex items-center justify-center gap-2">
            <i class="fas fa-external-link-alt text-amber-400"></i> Pratinjau Publik
        </a>
        @endif
    </div>

    <!-- Body Form -->
    <form action="{{ route('admin.prosedur.save-sop-settings') }}" method="POST" class="p-8 md:p-10 space-y-8">
        @csrf
        <input type="hidden" name="prefix" value="{{ $prefix }}">

        <!-- Section 1: Banner Header -->
        <div class="space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#004a99]/10 text-[#004a99] font-black text-[10px] uppercase rounded-full tracking-widest mb-3">
                <i class="fas fa-heading"></i> Bagian Banner Halaman
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-200">
                <div class="space-y-2">
                    <label class="text-xs font-black text-[#004a99] uppercase tracking-wider block">Judul Banner Halaman</label>
                    <input type="text" name="judul_hero" value="{{ old('judul_hero', $valJudul) }}"
                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none" required>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black text-[#004a99] uppercase tracking-wider block">Tagline / Subtitle Banner</label>
                    <input type="text" name="tagline_hero" value="{{ old('tagline_hero', $valTagline) }}"
                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none">
                </div>
            </div>
        </div>

        <!-- Section 2: Konten Narasi -->
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-100 text-emerald-800 font-black text-[10px] uppercase rounded-full tracking-widest mb-3">
                <i class="fas fa-align-left"></i> Narasi & Gambar SOP (Teks Editor)
            </div>
            <textarea name="konten" id="editor_sop" rows="8"
                      class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-slate-800 focus:border-[#004a99] outline-none">{{ old('konten', $valKonten) }}</textarea>
            <p class="text-[11px] text-slate-400 font-bold"><i class="fas fa-info-circle mr-1"></i> Gambar SOP yang Anda unggah di teks editor akan muncul di bagian atas halaman publik, di atas diagram interaktif.</p>
        </div>

        @if($isDiagramSop)
        {{-- ============================================================ --}}
        {{-- PENGATURAN DIAGRAM SOP INTERAKTIF — (PERMINTAAN/KEBERATAN/SENGKETA) --}}
        {{-- ============================================================ --}}

        <!-- Section 3: Diagram Header -->
        <div class="border-t-2 border-slate-100 pt-8 space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-violet-100 text-violet-800 font-black text-[10px] uppercase rounded-full tracking-widest mb-4">
                <i class="fas fa-diagram-project"></i> Pengaturan Diagram Interaktif
            </div>
            <p class="text-xs text-slate-500 font-bold mb-4"><i class="fas fa-lightbulb text-amber-500 mr-1"></i> Tips: Kosongkan Judul & Deskripsi pada langkah tertentu untuk menyembunyikan langkah tersebut dari diagram publik secara otomatis.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-200 mb-6">
                <div class="space-y-2">
                    <label class="text-xs font-black text-violet-700 uppercase tracking-wider block">Judul Diagram</label>
                    <input type="text" name="{{ $pKey }}_diagram_judul" value="{{ $diagJudul }}"
                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-violet-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black text-violet-700 uppercase tracking-wider block">Subtitle / Keterangan Diagram</label>
                    <input type="text" name="{{ $pKey }}_diagram_subtitle" value="{{ $diagSubtitle }}"
                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-violet-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Section 4: 7 Langkah -->
        @for ($i = 1; $i <= 7; $i++)
        @php $step = $stepsData[$i]; @endphp
        <div class="bg-slate-50 border-2 border-slate-200 rounded-2xl p-6 space-y-4 mb-4" style="border-left: 5px solid {{ $step['warna'] ?: '#004a99' }};">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-sm" style="background: {{ $step['warna'] ?: '#004a99' }};">
                    {{ $step['nomor'] ?: $i }}
                </div>
                <span class="font-black text-slate-700 uppercase tracking-widest text-xs">Langkah {{ $i }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Nomor Tampil</label>
                    <input type="text" name="{{ $pKey }}_step_{{ $i }}_nomor" value="{{ $step['nomor'] }}"
                           placeholder="0{{ $i }}"
                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Judul Langkah</label>
                    <input type="text" name="{{ $pKey }}_step_{{ $i }}_judul" value="{{ $step['judul'] }}"
                           placeholder="Nama langkah..."
                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none text-sm">
                </div>
                <div class="space-y-1 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Deskripsi Singkat</label>
                    <textarea name="{{ $pKey }}_step_{{ $i }}_deskripsi" rows="2"
                              placeholder="Deskripsi alur prosedur..."
                              class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl text-slate-800 focus:border-[#004a99] outline-none text-sm resize-none">{{ $step['deskripsi'] }}</textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Durasi / Waktu</label>
                    <input type="text" name="{{ $pKey }}_step_{{ $i }}_waktu" value="{{ $step['waktu'] }}"
                           placeholder="mis: 10 Menit / 10 Hari Kerja"
                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Aktor / Pelaksana</label>
                    <input type="text" name="{{ $pKey }}_step_{{ $i }}_aktor" value="{{ $step['aktor'] }}"
                           placeholder="mis: Masyarakat / Petugas PPID"
                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Ikon (FontAwesome Class)</label>
                    <div class="flex gap-2 items-center">
                        <i class="{{ $step['icon'] ?: 'fas fa-circle-check' }} text-xl" style="color: {{ $step['warna'] ?: '#004a99' }};"></i>
                        <input type="text" name="{{ $pKey }}_step_{{ $i }}_icon" value="{{ $step['icon'] }}"
                               class="flex-1 px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-mono text-slate-700 focus:border-[#004a99] outline-none text-sm">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Warna Aksen (HEX)</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" name="{{ $pKey }}_step_{{ $i }}_warna_picker" value="{{ $step['warna'] ?: '#004a99' }}"
                               class="w-10 h-10 border-0 rounded-lg cursor-pointer p-0"
                               oninput="document.querySelector('[name={{ $pKey }}_step_{{ $i }}_warna]').value=this.value">
                        <input type="text" name="{{ $pKey }}_step_{{ $i }}_warna" value="{{ $step['warna'] }}"
                               class="flex-1 px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-mono text-slate-700 focus:border-[#004a99] outline-none text-sm">
                    </div>
                </div>
            </div>
        </div>
        @endfor

        <!-- Section 5: Legend Aktor -->
        <div class="bg-slate-50 border-2 border-slate-200 rounded-2xl p-6 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-800 font-black text-[10px] uppercase rounded-full tracking-widest mb-3">
                <i class="fas fa-tags"></i> Keterangan Legend Aktor
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @for ($j = 1; $j <= 3; $j++)
                <div class="space-y-1">
                    <label class="text-[11px] font-black text-slate-600 uppercase tracking-wider block">Legend {{ $j }}</label>
                    <input type="text" name="{{ $pKey }}_legend_{{ $j }}_nama" value="{{ $legend[$j] }}"
                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-xl font-bold text-slate-800 focus:border-[#004a99] outline-none text-sm">
                </div>
                @endfor
            </div>
        </div>
        @endif
        {{-- END DIAGRAM SECTION --}}

        <!-- Submit Button -->
        <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-10 py-5 bg-[#004a99] text-white font-black text-xs uppercase tracking-[2px] rounded-2xl hover:bg-black hover:-translate-y-1 transition-all shadow-xl shadow-blue-900/20 border-none cursor-pointer">
                <i class="fas fa-check-circle mr-2 text-amber-400"></i> Simpan Pengaturan SOP
            </button>
        </div>
    </form>
</div>
