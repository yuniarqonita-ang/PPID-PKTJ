@extends('layouts.admin')

@section('title', 'Hasil Survei Kepuasan & Indeks Pelayanan (IKM)')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">Evaluasi Pelayanan</span>
                <span class="text-xs text-slate-400">•</span>
                <span class="text-xs font-medium text-slate-500">Live Dynamic IKM</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Hasil Survei Kepuasan Layanan</h1>
            <p class="text-sm text-slate-500 font-medium mt-0.5">Monitoring rekapitulasi nilai Indeks Kepuasan Masyarakat (IKM) dari pemohon informasi publik.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('layanan.laporan-survey') }}" target="_blank" class="px-4 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-200 transition-all flex items-center shadow-sm">
                <i class="fas fa-external-link-alt mr-2 text-slate-500"></i> Halaman Publik Survei
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 text-sm font-semibold shadow-sm">
        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-[#004a99] flex items-center justify-center text-2xl font-black">
                <i class="fas fa-star text-amber-500"></i>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nilai Rata-Rata IKM</div>
                <div class="text-3xl font-black text-slate-900 mt-0.5">{{ number_format($stats['avg_rating'], 1) }} <span class="text-sm font-semibold text-slate-400">/ 5.0</span></div>
                <span class="inline-block mt-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                    Tingkat Kepuasan: {{ number_format($stats['kepuasan_percent'], 1) }}%
                </span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl font-black">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Responden</div>
                <div class="text-3xl font-black text-slate-900 mt-0.5">{{ $stats['total_responses'] }} <span class="text-sm font-semibold text-slate-400">Orang</span></div>
                <span class="inline-block mt-1 text-[11px] font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-md">
                    Live dari Database
                </span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-black">
                <i class="fas fa-award"></i>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Predikat Mutu Pelayanan</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5">Sangat Baik (A)</div>
                <span class="inline-block mt-1 text-[11px] font-bold text-slate-500">
                    Standar Kepuasan Kemenhub
                </span>
            </div>
        </div>
    </div>

    <!-- RESPONSES TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-black text-slate-900 text-base">Daftar Respon Masuk Responden</h3>
            <span class="text-xs text-slate-400 font-bold">Total: {{ $responses->total() }} Respon</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs font-black text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-4 text-center w-12">No</th>
                        <th class="py-4 px-4">Tanggal</th>
                        <th class="py-4 px-4">Saluran</th>
                        <th class="py-4 px-4">Identitas / No. Registrasi</th>
                        <th class="py-4 px-4 text-center">Rating</th>
                        <th class="py-4 px-4">Penilaian UI/UX</th>
                        <th class="py-4 px-4">Saran & Masukan</th>
                        <th class="py-4 px-4 text-center w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($responses as $res)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-4 text-center text-slate-400 font-bold text-xs">
                            {{ $loop->iteration + ($responses->currentPage() - 1) * $responses->perPage() }}
                        </td>
                        <td class="py-4 px-4 text-xs font-bold text-slate-600 whitespace-nowrap">
                            {{ $res->created_at ? $res->created_at->translatedFormat('d M Y H:i') : '-' }}
                        </td>
                        <td class="py-4 px-4">
                            @if($res->sumber_informasi == 'website')
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-lg bg-blue-50 text-[#004a99] border border-blue-200">
                                    <i class="fas fa-globe mr-1.5"></i> Website PPID
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                    <i class="fas fa-share-alt mr-1.5"></i> Media Sosial
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-xs font-semibold text-slate-700">
                            @if($res->sumber_informasi == 'website')
                                <span class="font-mono font-bold text-[#004a99]">{{ $res->nomor_registrasi ?? '-' }}</span>
                            @else
                                <div>{{ $res->nama ?? '-' }}</div>
                                <div class="text-[11px] text-slate-400 font-normal">Usia: {{ $res->usia ?? '-' }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center gap-1 font-black text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg text-xs border border-amber-200">
                                <i class="fas fa-star text-amber-500"></i> {{ $res->rating }} / 5
                            </span>
                        </td>
                        <td class="py-4 px-4 text-xs text-slate-600 max-w-xs">
                            <span class="line-clamp-2">{{ $res->ui_ux ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-4 text-xs text-slate-600 max-w-xs">
                            <span class="line-clamp-2 italic text-slate-500">{{ $res->saran_masukan ?: 'Tidak ada catatan.' }}</span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <form action="{{ route('admin.survey.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Hapus data respon survei ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center text-xs transition-all shadow-sm border-none cursor-pointer mx-auto" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-400 font-medium text-sm">
                            <i class="fas fa-poll text-3xl mb-2 block opacity-40"></i>
                            Belum ada data respon survei yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($responses->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $responses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
