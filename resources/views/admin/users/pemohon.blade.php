@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-8">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Verifikasi Pemohon Informasi</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Data <span class="text-[#ffc107]">Pemohon</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Verifikasi berkas identitas KTP/SIM pemohon sebelum mengajukan permohonan informasi.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-4 bg-white/15 hover:bg-white/25 text-white font-bold text-xs uppercase tracking-wider rounded-2xl backdrop-blur-md transition-all flex items-center">
                    <i class="fas fa-users-cog mr-2"></i> Kelola Admin
                </a>
            </div>
        </div>
    </div>

    <!-- FILTER & SEARCH TABS -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Status Tabs -->
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.pemohon.index') }}" class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all {{ empty($status) ? 'bg-[#004a99] text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.pemohon.index', ['status' => 'pending']) }}" class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all {{ $status === 'pending' ? 'bg-amber-500 text-white shadow-md' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                <i class="far fa-clock mr-1"></i> Menunggu Verifikasi ({{ $counts['pending'] }})
            </a>
            <a href="{{ route('admin.pemohon.index', ['status' => 'verified']) }}" class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all {{ $status === 'verified' ? 'bg-emerald-600 text-white shadow-md' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                <i class="fas fa-check mr-1"></i> Terverifikasi ({{ $counts['verified'] }})
            </a>
            <a href="{{ route('admin.pemohon.index', ['status' => 'rejected']) }}" class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all {{ $status === 'rejected' ? 'bg-rose-600 text-white shadow-md' : 'bg-rose-50 text-rose-700 hover:bg-rose-100' }}">
                <i class="fas fa-times mr-1"></i> Ditolak ({{ $counts['rejected'] }})
            </a>
        </div>

        <!-- Search Form -->
        <form action="{{ route('admin.pemohon.index') }}" method="GET" class="w-full md:w-auto flex gap-2">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="relative flex-1 md:w-64">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NIK, email..."
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#004a99]">
            </div>
            <button type="submit" class="px-4 py-2.5 bg-[#004a99] text-white rounded-xl font-bold text-xs">
                Cari
            </button>
        </form>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <p class="font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('warning'))
    <div class="bg-amber-50 border border-amber-100 text-amber-700 px-6 py-4 rounded-2xl flex items-center gap-3">
        <i class="fas fa-exclamation-triangle text-lg"></i>
        <p class="font-bold text-sm">{{ session('warning') }}</p>
    </div>
    @endif

    <!-- TABLE SECTION -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100">
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Pemohon</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Identitas &amp; Berkas</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Pekerjaan / Instansi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[2px] text-center">Status</th>
                        <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($pemohons as $pemohon)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Pemohon Info -->
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-[#004a99] to-[#0066cc] text-white flex items-center justify-center font-bold text-base shadow-sm flex-shrink-0">
                                        {{ strtoupper(substr($pemohon->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-slate-800 text-sm leading-tight">{{ $pemohon->name }}</div>
                                        <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $pemohon->email }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5"><i class="fas fa-phone text-[10px] text-slate-400 mr-1"></i>{{ $pemohon->no_telp ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Identitas & Berkas -->
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-slate-700">
                                    <span class="px-2 py-0.5 bg-slate-100 rounded text-[10px] text-[#004a99] font-mono mr-1">{{ strtoupper($pemohon->jenis_identitas ?? 'KTP') }}</span>
                                    {{ $pemohon->nomor_identitas ?? '-' }}
                                </div>
                                <div class="mt-2">
                                    @if($pemohon->file_identitas)
                                        <a href="{{ asset('storage/' . $pemohon->file_identitas) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-[#004a99] hover:bg-blue-100 rounded-lg text-xs font-bold transition-all">
                                            <i class="fas fa-file-image"></i> Lihat File KTP / Identitas
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Tidak ada file</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Pekerjaan / Instansi -->
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-slate-700">{{ $pemohon->pekerjaan ?? '-' }}</div>
                                <div class="text-xs text-slate-400">{{ $pemohon->instansi ?? 'Pribadi' }}</div>
                                <div class="text-[11px] text-slate-500 mt-1 max-w-xs truncate" title="{{ $pemohon->alamat }}"><i class="fas fa-map-marker-alt text-slate-300 mr-1"></i>{{ $pemohon->alamat ?? '-' }}</div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5 text-center">
                                @if($pemohon->status_verifikasi === 'verified')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-full text-xs font-black">
                                        <i class="fas fa-check-circle"></i> Terverifikasi
                                    </span>
                                @elseif($pemohon->status_verifikasi === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-full text-xs font-black">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 rounded-full text-xs font-black">
                                        <i class="far fa-clock"></i> Menunggu
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if($pemohon->status_verifikasi !== 'verified')
                                        <form action="{{ route('admin.pemohon.verify', $pemohon->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3.5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-sm transition-all flex items-center gap-1" title="Verifikasi Akun Ini">
                                                <i class="fas fa-check"></i> Verifikasi
                                            </button>
                                        </form>
                                    @endif

                                    @if($pemohon->status_verifikasi !== 'rejected')
                                        <form action="{{ route('admin.pemohon.reject', $pemohon->id) }}" method="POST" onsubmit="return confirm('Tolak verifikasi akun pemohon ini?')">
                                            @csrf
                                            <button type="submit" class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl font-bold text-xs border border-rose-200 transition-all flex items-center gap-1" title="Tolak Verifikasi">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <i class="fas fa-user-clock text-4xl mb-3 text-slate-200"></i>
                                <p class="font-bold text-sm">Tidak ada data pemohon yang cocok dengan filter saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pemohons->hasPages())
        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            {{ $pemohons->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
