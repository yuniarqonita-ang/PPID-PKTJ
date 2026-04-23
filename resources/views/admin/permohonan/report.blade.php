@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 uppercase tracking-tight">Laporan Bulanan</h2>
            <p class="text-slate-500 text-sm">Pelaksanaan Tugas Pelayanan Informasi Publik</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.permohonan.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-bold uppercase transition hover:bg-slate-50">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
        <form action="{{ route('admin.permohonan.report') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-bold uppercase tracking-wider hover:bg-blue-700 transition shadow-md shadow-blue-200">
                    <i class="fas fa-search me-2"></i> Filter
                </button>
                <a href="{{ route('admin.permohonan.report.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-bold uppercase tracking-wider hover:bg-emerald-700 transition shadow-md shadow-emerald-200">
                    <i class="fas fa-file-excel me-2"></i> Ekspor Excel (CSV)
                </a>
            </div>
        </form>
    </div>

    <!-- Signatory Configuration -->
    <div class="bg-blue-50 rounded-xl border border-blue-100 p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-signature"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 uppercase">Pengaturan Tanda Tangan</h4>
                    <p class="text-blue-700 text-xs">Atur nama Pejabat dan NIP yang akan muncul di bawah laporan.</p>
                </div>
            </div>
            <button onclick="toggleSettings()" class="text-blue-600 text-xs font-bold uppercase hover:underline">
                <i class="fas fa-cog me-1"></i> Buka Pengaturan
            </button>
        </div>
        
        <div id="signatorySettings" class="hidden mt-4 pt-4 border-t border-blue-200">
            <form id="settingsForm" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-blue-800 uppercase mb-1">Nama PPID</label>
                    <input type="text" id="report_ppid_name" value="{{ $settings['report_ppid_name'] ?? '' }}" class="w-full px-3 py-2 bg-white border border-blue-200 rounded text-sm outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-blue-800 uppercase mb-1">NIP PPID</label>
                    <input type="text" id="report_ppid_nip" value="{{ $settings['report_ppid_nip'] ?? '' }}" class="w-full px-3 py-2 bg-white border border-blue-200 rounded text-sm outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-blue-800 uppercase mb-1">Nama Menteri</label>
                    <input type="text" id="report_menteri_name" value="{{ $settings['report_menteri_name'] ?? 'BUDI KARYA SUMADI' }}" class="w-full px-3 py-2 bg-white border border-blue-200 rounded text-sm outline-none">
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <button type="button" onclick="saveSettings()" class="px-4 py-2 bg-blue-700 text-white text-xs font-bold uppercase rounded hover:bg-blue-800 transition">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">No</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">Tanggal Minta</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">Tanggal Jawab</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">Waktu (Hari)</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">Nama & Alamat</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase border-r">Permohonan Informasi</th>
                        <th colspan="4" class="px-4 py-2 text-center text-xs font-bold text-slate-500 uppercase border-b border-r">Jenis Informasi</th>
                        <th rowspan="2" class="px-4 py-4 text-left text-xs font-bold text-slate-500 uppercase">Keterangan/Status</th>
                    </tr>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-2 py-2 text-center text-[10px] font-bold text-slate-400 border-r uppercase">Berkala</th>
                        <th class="px-2 py-2 text-center text-[10px] font-bold text-slate-400 border-r uppercase">Serta Merta</th>
                        <th class="px-2 py-2 text-center text-[10px] font-bold text-slate-400 border-r uppercase">Setiap Saat</th>
                        <th class="px-2 py-2 text-center text-[10px] font-bold text-slate-400 border-r uppercase">Dikecualikan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($submissions as $index => $item)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-4 py-4 text-sm text-slate-600 font-medium border-r">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-sm text-slate-600 border-r">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-4 text-sm text-slate-600 border-r">{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-4 text-center text-sm font-bold text-blue-600 border-r">
                            @if($item->tanggal_selesai)
                                {{ $item->created_at->diffInDays($item->tanggal_selesai) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 border-r">
                            <div class="font-bold">{{ $item->nama_pemohon }}</div>
                            <div class="text-[10px] text-slate-400 uppercase truncate max-w-[150px]">{{ $item->alamat }}</div>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 border-r">
                            <div class="truncate max-w-[200px]" title="{{ $item->deskripsi_permohonan }}">
                                {{ $item->deskripsi_permohonan }}
                            </div>
                        </td>
                        <td class="px-2 py-4 text-center border-r font-black text-blue-500">
                            {{ $item->kategori_laporan == 'berkala' ? 'V' : '' }}
                        </td>
                        <td class="px-2 py-4 text-center border-r font-black text-blue-500">
                            {{ $item->kategori_laporan == 'sertamerta' ? 'V' : '' }}
                        </td>
                        <td class="px-2 py-4 text-center border-r font-black text-blue-500">
                            {{ $item->kategori_laporan == 'setiapsaat' ? 'V' : '' }}
                        </td>
                        <td class="px-2 py-4 text-center border-r font-black text-blue-500">
                            {{ $item->kategori_laporan == 'dikecualikan' ? 'V' : '' }}
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                {{ $item->status == 'selesai' ? 'bg-emerald-100 text-emerald-700' : 
                                   ($item->status == 'diproses' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="px-4 py-12 text-center text-slate-400 italic">
                            <i class="fas fa-folder-open text-4xl mb-3 block opacity-20"></i>
                            Tidak ada data permohonan dalam rentang tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
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
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert('Pengaturan tanda tangan berhasil disimpan!');
                toggleSettings();
            } else {
                alert('Gagal menyimpan pengaturan.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi.');
        }
    }
</script>
@endsection
