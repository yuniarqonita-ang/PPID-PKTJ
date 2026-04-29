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
        <button onclick="window.print()"
           class="px-6 py-3 bg-red-600 text-white rounded-xl text-sm font-black uppercase tracking-wider hover:bg-red-700 transition shadow-md flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Cetak / Simpan PDF
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
    <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden print-section">
        {{-- Print Header (hanya muncul saat print) --}}
        <div class="hidden print:block p-8 text-center border-b-2 border-slate-200">
            <p class="text-sm font-bold uppercase tracking-widest">KEMENTERIAN PERHUBUNGAN</p>
            <p class="text-sm font-bold">POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</p>
            <p class="text-xs text-slate-600">Jl. Semeru No.3, Tegal, Jawa Tengah</p>
            <h2 class="text-lg font-black uppercase mt-4 mb-1">LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h2>
            <p class="text-sm font-bold">
                @if(($periodeType ?? 'bulanan') == 'tahunan')
                    Periode: Tahun {{ $tahun ?? date('Y') }}
                @else
                    Periode: Bulan {{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan ?? date('m')] }} {{ $tahun ?? date('Y') }}
                @endif
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs" id="laporanTable">
                <thead>
                    <tr class="bg-[#004a99] text-white">
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">No</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Bulan</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Tgl Permohonan</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Tgl Selesai</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Waktu (Hari)</th>
                        <th rowspan="2" class="px-3 py-3 text-left border border-blue-700 font-black uppercase min-w-[140px]">Nama Pemohon / Instansi</th>
                        <th rowspan="2" class="px-3 py-3 text-left border border-blue-700 font-black uppercase min-w-[180px]">Rincian Informasi yang Dibutuhkan</th>
                        <th colspan="4" class="px-3 py-2 text-center border border-blue-700 font-black uppercase text-[#ffc107]">Jenis Informasi</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Keterangan<br>(Dipenuhi/Ditolak/<br>Proses)</th>
                        <th rowspan="2" class="px-3 py-3 text-center border border-blue-700 font-black uppercase">Metode<br>Pelayanan</th>
                        <th rowspan="2" class="px-3 py-3 text-left border border-blue-700 font-black uppercase">Alasan Penolakan<br>(Jika Ada)</th>
                    </tr>
                    <tr class="bg-blue-800 text-white">
                        <th class="px-2 py-2 text-center border border-blue-700 text-[10px] font-black uppercase">Berkala</th>
                        <th class="px-2 py-2 text-center border border-blue-700 text-[10px] font-black uppercase">Serta Merta</th>
                        <th class="px-2 py-2 text-center border border-blue-700 text-[10px] font-black uppercase">Setiap Saat</th>
                        <th class="px-2 py-2 text-center border border-blue-700 text-[10px] font-black uppercase">Dikecualikan</th>
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
                    <tr class="hover:bg-blue-50/30 transition {{ $index % 2 == 0 ? '' : 'bg-slate-50/50' }}">
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">{{ $index + 1 }}</td>
                        <td class="px-2 py-3 text-center font-bold border border-slate-200">{{ $bulanItem }}</td>
                        <td class="px-2 py-3 text-center border border-slate-200">{{ \Carbon\Carbon::parse($tglMinta)->format('d/m/Y') }}</td>
                        <td class="px-2 py-3 text-center border border-slate-200">{{ $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->format('d/m/Y') : '—' }}</td>
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">{{ $hariKerja }}</td>
                        <td class="px-3 py-3 border border-slate-200">
                            <div class="font-bold text-slate-800">{{ $item->nama_pemohon }}</div>
                            <div class="text-[10px] text-slate-400 uppercase truncate max-w-[130px]">{{ $item->perusahaan_instansi ?? $item->alamat }}</div>
                        </td>
                        <td class="px-3 py-3 border border-slate-200">
                            <div class="line-clamp-2 text-slate-700" title="{{ $item->deskripsi_permohonan }}">
                                {{ $item->deskripsi_permohonan }}
                            </div>
                        </td>
                        {{-- Jenis Informasi --}}
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">
                            {{ $item->kategori_laporan == 'berkala' ? '✓' : '' }}
                        </td>
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">
                            {{ $item->kategori_laporan == 'sertamerta' ? '✓' : '' }}
                        </td>
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">
                            {{ $item->kategori_laporan == 'setiapsaat' ? '✓' : '' }}
                        </td>
                        <td class="px-2 py-3 text-center font-black text-[#004a99] border border-slate-200">
                            {{ $item->kategori_laporan == 'dikecualikan' ? '✓' : '' }}
                        </td>
                        {{-- Keterangan --}}
                        <td class="px-2 py-3 text-center border border-slate-200">
                            <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        {{-- Metode Pelayanan --}}
                        <td class="px-2 py-3 text-center text-[10px] border border-slate-200">
                            {{ $item->jenis_permohonan_salinan ?? $item->bentuk_informasi_salinan ?? '—' }}
                        </td>
                        {{-- Alasan Penolakan --}}
                        <td class="px-3 py-3 text-[10px] text-slate-600 border border-slate-200">
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
    </div>

</div>

<style>
@media print {
    body * { visibility: hidden; }
    .print-section, .print-section * { visibility: visible; }
    .print-section { position: absolute; left: 0; top: 0; width: 100%; }
    table { font-size: 9px; }
    .hidden.print\:block { display: block !important; visibility: visible !important; }
}
</style>

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
            toggleSettings();
        }
    } catch (error) {
        alert('Terjadi kesalahan. Coba lagi.');
    }
}
</script>
@endsection
