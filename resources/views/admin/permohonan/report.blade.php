@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Laporan: Aktif</h2>
                </div>
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Laporan <span class="text-[#ffc107]">Permohonan Informasi</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Format B1 s.d. B4 — Pelaksanaan Tugas Pelayanan Informasi Publik</p>
                </div>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('admin.permohonan.submissions') }}" class="px-6 py-3 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-list mr-2"></i> Semua Permohonan
                </a>
            </div>
        </div>
    </div>

    {{-- FILTER FORM --}}
    <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-8">
        <form action="{{ route('admin.permohonan.report') }}" method="GET" id="filterForm">
            <div class="flex flex-wrap items-end gap-6">

                {{-- Tipe Periode --}}
                <div class="space-y-2">
                    <label class="text-xs font-black text-[#004a99] uppercase tracking-widest">Tipe Periode</label>
                    <div class="flex gap-2">
                        <button type="button" onclick="setPeriod('bulanan')"
                            id="btn-bulanan"
                            class="px-5 py-2.5 text-sm font-black rounded-xl border-2 transition-all {{ ($periodeType ?? 'bulanan') == 'bulanan' ? 'bg-[#004a99] text-white border-[#004a99]' : 'bg-white text-[#004a99] border-[#004a99]' }}">
                            <i class="fas fa-calendar-alt mr-1"></i> Bulanan
                        </button>
                        <button type="button" onclick="setPeriod('tahunan')"
                            id="btn-tahunan"
                            class="px-5 py-2.5 text-sm font-black rounded-xl border-2 transition-all {{ ($periodeType ?? '') == 'tahunan' ? 'bg-[#004a99] text-white border-[#004a99]' : 'bg-white text-[#004a99] border-[#004a99]' }}">
                            <i class="fas fa-calendar mr-1"></i> Tahunan
                        </button>
                        <input type="hidden" name="periode_type" id="periode_type" value="{{ $periodeType ?? 'bulanan' }}">
                    </div>
                </div>

                {{-- Pilih Bulan (untuk bulanan) --}}
                <div id="filter-bulan" class="{{ ($periodeType ?? 'bulanan') == 'tahunan' ? 'hidden' : '' }} space-y-2">
                    <label class="text-xs font-black text-[#004a99] uppercase tracking-widest">Bulan</label>
                    <select name="bulan" class="px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-sm font-bold focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none">
                        @foreach(['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $num => $nama)
                            <option value="{{ $num }}" {{ ($bulan ?? date('m')) == $num ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Tahun --}}
                <div class="space-y-2">
                    <label class="text-xs font-black text-[#004a99] uppercase tracking-widest">Tahun</label>
                    <select name="tahun" class="px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-sm font-bold focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none">
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ ($tahun ?? date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="px-8 py-2.5 bg-[#004a99] text-white rounded-xl text-sm font-black uppercase tracking-wider hover:bg-blue-800 transition shadow-lg flex items-center gap-2">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    {{-- EXPORT BUTTONS --}}
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.permohonan.report.export', array_merge(request()->all(), ['format' => 'excel'])) }}"
           class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-sm font-black uppercase tracking-wider hover:bg-emerald-700 transition shadow-md flex items-center gap-2">
            <i class="fas fa-file-excel"></i> Unduh Excel (.xlsx)
        </a>
        <a href="{{ route('admin.permohonan.report.export_word', request()->all()) }}"
           class="px-6 py-3 bg-[#004a99] text-white rounded-xl text-sm font-black uppercase tracking-wider hover:bg-blue-800 transition shadow-md flex items-center gap-2">
            <i class="fas fa-file-word"></i> Unduh Word (.doc)
        </a>
        <button onclick="downloadPDF()"
           class="px-6 py-3 bg-red-600 text-white rounded-xl text-sm font-black uppercase tracking-wider hover:bg-red-700 transition shadow-md flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Unduh PDF (.pdf)
        </button>
    </div>

    {{-- PERIOD LABEL --}}
    <div class="flex items-center gap-3">
        <div class="h-1 flex-1 bg-gradient-to-r from-[#004a99] to-transparent rounded-full"></div>
        <span class="text-sm font-black text-[#004a99] uppercase tracking-widest whitespace-nowrap">
            @if(($periodeType ?? 'bulanan') == 'tahunan')
                Laporan Tahunan {{ $tahun ?? date('Y') }}
            @else
                Laporan Bulan {{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan ?? date('m')] }} {{ $tahun ?? date('Y') }}
            @endif
            — {{ $submissions->count() }} Permohonan
        </span>
        <div class="h-1 flex-1 bg-gradient-to-l from-[#004a99] to-transparent rounded-full"></div>
    </div>

    {{-- SIGNATORY SETTINGS --}}
    <div class="bg-blue-50 rounded-2xl border-2 border-blue-100 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#004a99] text-white rounded-xl flex items-center justify-center">
                    <i class="fas fa-signature text-[#ffc107]"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-blue-900 uppercase tracking-widest">Pengaturan Penandatangan</h4>
                    <p class="text-blue-700 text-xs font-bold">Nama & NIP yang muncul di bagian bawah laporan</p>
                </div>
            </div>
            <button onclick="toggleSettings()" class="text-[#004a99] text-xs font-black uppercase hover:underline">
                <i class="fas fa-cog mr-1"></i> Atur Penandatangan
            </button>
        </div>
        <div id="signatorySettings" class="hidden mt-4 pt-4 border-t border-blue-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-[10px] font-black text-blue-800 uppercase mb-1 block">Nama PPID</label>
                    <input type="text" id="report_ppid_name" value="{{ $settings['report_ppid_name'] ?? '' }}"
                        class="w-full px-3 py-2 bg-white border-2 border-blue-200 rounded-xl text-sm font-bold outline-none focus:border-[#004a99]"
                        placeholder="Nama PPID">
                </div>
                <div>
                    <label class="text-[10px] font-black text-blue-800 uppercase mb-1 block">NIP</label>
                    <input type="text" id="report_ppid_nip" value="{{ $settings['report_ppid_nip'] ?? '' }}"
                        class="w-full px-3 py-2 bg-white border-2 border-blue-200 rounded-xl text-sm font-bold outline-none focus:border-[#004a99]"
                        placeholder="NIP PPID">
                </div>
                <div>
                    <label class="text-[10px] font-black text-blue-800 uppercase mb-1 block">Nama Pimpinan</label>
                    <input type="text" id="report_menteri_name" value="{{ $settings['report_menteri_name'] ?? '' }}"
                        class="w-full px-3 py-2 bg-white border-2 border-blue-200 rounded-xl text-sm font-bold outline-none focus:border-[#004a99]"
                        placeholder="Nama Pimpinan/Menteri">
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <button onclick="saveSettings()" class="px-6 py-2.5 bg-[#004a99] text-white text-xs font-black uppercase rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- DATA TABLE FORMAT B1-B4 --}}
    <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden print-section" style="width: 100%; min-height: 200px;">
        {{-- Print Header (hanya muncul saat print/PDF) --}}
        <div class="hidden print:block p-4 border-b border-slate-300" style="display: none;" id="pdfHeader">
            @php 
                $logoPath = public_path('images/logo-pktj.png');
                $logoData = '';
                if(file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                }
            @endphp
            <table style="width: 100%; border: none; margin-bottom: 10px;">
                <tr>
                    <td style="width: 10%; text-align: left; border: none;">
                        @if($logoData)
                            <img src="data:image/png;base64,{{ $logoData }}" style="width: 60px;">
                        @endif
                    </td>
                    <td style="width: 80%; text-align: center; border: none; vertical-align: middle;">
                        <h1 style="font-size: 14pt; font-weight: 900; margin: 0; color: #000; text-transform: uppercase;">POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h1>
                        <h2 style="font-size: 11pt; font-weight: 800; margin: 2px 0; color: #333;">Sekretariat Pelayanan Informasi Publik</h2>
                        <p style="font-size: 7pt; margin: 0; color: #666;">Jl. Perintis Kemerdekaan No.17, Kel. Slerok, Kec. Tegal Timur, Kota Tegal, Jawa Tengah, 52125, (0283) 351061</p>
                    </td>
                    <td style="width: 10%; border: none;"></td>
                </tr>
            </table>
            <div style="border-bottom: 2pt solid #000; margin-bottom: 10px;"></div>
            <div style="text-align: center; margin-top: 15px;">
                <h2 style="font-size: 12pt; font-weight: 900; text-transform: uppercase; margin-bottom: 5px;">LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h2>
                <p style="font-size: 9pt; font-weight: 700;">
                    Periode: {{ ($periodeType ?? 'bulanan') == 'tahunan' ? 'Tahun ' . $tahun : 'Bulan ' . (['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan ?? date('m')]) . ' ' . $tahun }}
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs" id="laporanTable" style="width: 100%; table-layout: fixed; border: 1px solid #000;">
                <thead>
                    <tr style="background-color: #004a99; color: white;">
                        <th rowspan="2" style="width: 25px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">No</th>
                        <th rowspan="2" style="width: 40px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Bulan</th>
                        <th rowspan="2" style="width: 60px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Tgl Minta</th>
                        <th rowspan="2" style="width: 60px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Tgl Selesai</th>
                        <th rowspan="2" style="width: 35px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Waktu</th>
                        <th rowspan="2" style="width: 100px; padding: 4px; text-align: left; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Nama Pemohon</th>
                        <th rowspan="2" style="padding: 4px; text-align: left; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Rincian Informasi</th>
                        <th colspan="4" style="padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase; background-color: #003366;">Jenis Informasi</th>
                        <th rowspan="2" style="width: 60px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Ket</th>
                        <th rowspan="2" style="width: 60px; padding: 4px; text-align: center; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Metode</th>
                        <th rowspan="2" style="width: 80px; padding: 4px; text-align: left; border: 1px solid #000; font-weight: 900; text-transform: uppercase;">Alasan Ditolak</th>
                    </tr>
                    <tr style="background-color: #005bb5; color: white;">
                        <th style="width: 25px; font-size: 8px; border: 1px solid #000; text-align: center; padding: 2px;">B</th>
                        <th style="width: 25px; font-size: 8px; border: 1px solid #000; text-align: center; padding: 2px;">SM</th>
                        <th style="width: 25px; font-size: 8px; border: 1px solid #000; text-align: center; padding: 2px;">SS</th>
                        <th style="width: 25px; font-size: 8px; border: 1px solid #000; text-align: center; padding: 2px;">D</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($submissions as $index => $item)
                    @php
                        $tglMinta = $item->tanggal_permohonan ?? $item->created_at;
                        $tglSelesai = $item->tanggal_selesai;
                        $hariKerja = $tglSelesai ? \Carbon\Carbon::parse($tglMinta)->diffInDays(\Carbon\Carbon::parse($tglSelesai)) : '-';
                        $bulanNama = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agt','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        $bulanItem = $bulanNama[\Carbon\Carbon::parse($tglMinta)->format('m')] ?? '-';
                        $statusLabel = match($item->status) {
                            'selesai' => 'Dipenuhi',
                            'ditolak' => 'Ditolak',
                            'diproses' => 'Diproses',
                            default => 'Pending'
                        };
                        $statusColor = match($item->status) {
                            'selesai' => 'bg-emerald-100 text-emerald-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            'diproses' => 'bg-blue-100 text-blue-800',
                            default => 'bg-slate-100 text-slate-600'
                        };
                    @endphp
                    <tr style="border-bottom: 1px solid #000;">
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">{{ $index + 1 }}</td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">{{ $bulanItem }}</td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">{{ \Carbon\Carbon::parse($tglMinta)->format('d/m/Y') }}</td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">{{ $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->format('d/m/Y') : '—' }}</td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">{{ $hariKerja }}</td>
                        <td style="padding: 4px; border: 1px solid #000; font-weight: bold; font-size: 8px;">
                            {{ $item->nama_pemohon }}
                        </td>
                        <td style="padding: 4px; border: 1px solid #000; font-size: 8px; line-height: 1.1;">
                            {{ $item->deskripsi_permohonan }}
                        </td>
                        {{-- Jenis Informasi --}}
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">
                            {{ $item->kategori_laporan == 'berkala' ? '✓' : '' }}
                        </td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">
                            {{ $item->kategori_laporan == 'sertamerta' ? '✓' : '' }}
                        </td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">
                            {{ $item->kategori_laporan == 'setiapsaat' ? '✓' : '' }}
                        </td>
                        <td style="padding: 4px; text-align: center; border: 1px solid #000;">
                            {{ $item->kategori_laporan == 'dikecualikan' ? '✓' : '' }}
                        </td>
                        {{-- Keterangan --}}
                        <td style="padding: 4px; text-align: center; border: 1px solid #000; font-size: 8px;">
                            {{ $statusLabel }}
                        </td>
                        {{-- Metode Pelayanan --}}
                        <td style="padding: 4px; text-align: center; border: 1px solid #000; font-size: 7px;">
                            {{ $item->jenis_permohonan_salinan ?? $item->bentuk_informasi_salinan ?? '—' }}
                        </td>
                        {{-- Alasan Penolakan --}}
                        <td style="padding: 4px; border: 1px solid #000; font-size: 7px;">
                            {{ $item->alasan_penolakan_text ?? ($item->status == 'ditolak' ? 'Sesuai pasal ' . ($item->penolakan_pasal_uu ?? '—') : '') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="px-4 py-16 text-center">
                            <i class="fas fa-folder-open text-5xl text-slate-200 mb-4 block"></i>
                            <p class="text-slate-400 font-black uppercase tracking-widest text-sm">Tidak ada data permohonan dalam periode ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($submissions->count() > 0)
                <tfoot class="bg-slate-50 border-t-2 border-slate-200">
                    <tr>
                        <td colspan="14" class="px-4 py-3 text-right text-xs font-black text-slate-500 uppercase tracking-widest">
                            Total: {{ $submissions->count() }} Permohonan |
                            Dipenuhi: {{ $submissions->where('status', 'selesai')->count() }} |
                            Ditolak: {{ $submissions->where('status', 'ditolak')->count() }} |
                            Diproses: {{ $submissions->whereIn('status', ['pending', 'diproses'])->count() }}
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        {{-- Signature Section for Print --}}
        <div class="hidden print:block p-8 mt-4">
            <div class="grid grid-cols-2 gap-8">
                <div></div>
                <div class="text-center">
                    <p class="mb-16">Tegal, {{ date('d F Y') }}<br><strong>PPID PELAKSANA</strong></p>
                    <p class="font-bold underline">{{ $settings['report_ppid_name'] ?? '..........................' }}</p>
                    <p>NIP. {{ $settings['report_ppid_nip'] ?? '..........................' }}</p>
                </div>
                <div class="col-span-2 text-center mt-10">
                    <p class="mb-16 uppercase font-bold">Mengetahui,<br>Menteri Perhubungan Republik Indonesia</p>
                    <p class="font-bold underline">{{ $settings['report_menteri_name'] ?? 'BUDI KARYA SUMADI' }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
@media print {
    @page {
        size: landscape;
        margin: 0.5cm;
    }
    body {
        background: white !important;
        color: black !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .no-print { display: none !important; }
    .print-section {
        display: block !important;
        visibility: visible !important;
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        background: white !important;
    }
    #pdfHeader { display: block !important; }
    #laporanTable { border-collapse: collapse !important; width: 100% !important; border: 1.5pt solid #000 !important; }
    #laporanTable th, #laporanTable td { border: 1pt solid #000 !important; color: black !important; padding: 4px !important; }
    .bg-white { background-color: white !important; }
    .text-white { color: black !important; }
    
    .signature-wrapper {
        margin-top: 30px !important;
        display: flex !important;
        justify-content: flex-end !important;
        padding-right: 50px !important;
        page-break-inside: avoid !important;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function setPeriod(type) {
    document.getElementById('periode_type').value = type;
    const bulanDiv = document.getElementById('filter-bulan');
    const btnBulanan = document.getElementById('btn-bulanan');
    const btnTahunan = document.getElementById('btn-tahunan');

    if (type === 'bulanan') {
        bulanDiv.classList.remove('hidden');
        btnBulanan.classList.add('bg-[#004a99]', 'text-white');
        btnBulanan.classList.remove('bg-white');
        btnTahunan.classList.remove('bg-[#004a99]', 'text-white');
        btnTahunan.classList.add('bg-white');
    } else {
        bulanDiv.classList.add('hidden');
        btnTahunan.classList.add('bg-[#004a99]', 'text-white');
        btnTahunan.classList.remove('bg-white');
        btnBulanan.classList.remove('bg-[#004a99]', 'text-white');
        btnBulanan.classList.add('bg-white');
    }
}

function toggleSettings() {
    document.getElementById('signatorySettings').classList.toggle('hidden');
}

async function saveSettings() {
    const data = {
        report_ppid_name: document.getElementById('report_ppid_name').value,
        report_ppid_nip: document.getElementById('report_ppid_nip').value,
        report_menteri_name: document.getElementById('report_menteri_name').value,
    };
    try {
        const response = await fetch("{{ route('admin.permohonan.save_form') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify(data)
        });
        if (response.ok) {
            alert('Pengaturan penandatangan berhasil disimpan!');
            location.reload(); // Reload to apply settings to the print view
        }
    } catch (error) {
        alert('Terjadi kesalahan. Coba lagi.');
    }
}

function downloadPDF() {
    const element = document.querySelector('.print-section');
    
    // Show PDF Header and ensure visibility
    const pdfHeader = document.getElementById('pdfHeader');
    if(pdfHeader) {
        pdfHeader.style.setProperty('display', 'block', 'important');
        pdfHeader.style.setProperty('visibility', 'visible', 'important');
    }

    const opt = {
        margin:       [0.3, 0.3, 0.3, 0.3],
        filename:     'Laporan_PPID_{{ ($periodeType ?? "bulanan") == "tahunan" ? $tahun : ($bulan . "_" . $tahun) }}.pdf',
        image:        { type: 'jpeg', quality: 1.0 },
        html2canvas:  { 
            scale: 2, 
            useCORS: true, 
            letterRendering: true,
            scrollY: 0,
            windowWidth: 1400
        },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'landscape' }
    };

    const btn = event.currentTarget;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Generating...';
    btn.disabled = true;

    html2pdf().set(opt).from(element).save().then(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        // Reset header display
        if(pdfHeader) pdfHeader.style.display = 'none';
    }).catch(err => {
        console.error('PDF Error:', err);
        btn.innerHTML = originalText;
        btn.disabled = false;
        alert('Gagal mengunduh PDF. Silakan coba lagi.');
    });
}
</script>
@endsection
