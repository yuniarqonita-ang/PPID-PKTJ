@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📋 Daftar Permohonan Informasi
            </h1>
            <p class="text-slate-300 mt-1">Kelola semua permohonan informasi yang masuk</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.permohonan.export') }}" class="px-6 py-3 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </a>
            <a href="{{ route('admin.permohonan.form') }}" class="px-6 py-3 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                <i class="fas fa-plus mr-2"></i>Buat Formulir Baru
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="rounded-2xl bg-gradient-to-r from-green-900/20 to-green-900/30 border border-green-600/30 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-300 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== STATS SECTION ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-400 truncate">Total Permohonan</dt>
                        <dd class="text-lg font-medium text-white">{{ $permohonan->total() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-400 truncate">Menunggu</dt>
                        <dd class="text-lg font-medium text-white">{{ $permohonan->where('status', 'pending')->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-400 truncate">Disetujui</dt>
                        <dd class="text-lg font-medium text-white">{{ $permohonan->where('status', 'approved')->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-times text-red-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-400 truncate">Ditolak</dt>
                        <dd class="text-lg font-medium text-white">{{ $permohonan->where('status', 'rejected')->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== CONTENT SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/80 border-b border-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Nama Pemohon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Judul Permohonan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-cyan-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-slate-700/50">
                    @forelse($permohonan as $item)
                        <tr class="hover:bg-slate-700/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $item->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $item->nama_pemohon }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ $item->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ $item->nomor_telepon }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $item->jenis_informasi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($item->status ?? 'pending')
                                    @case('pending')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                            Menunggu
                                        </span>
                                    @break
                                    @case('approved')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                                            Disetujui
                                        </span>
                                    @break
                                    @case('completed')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                            Selesai
                                        </span>
                                    @break
                                    @case('rejected')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                                            Ditolak
                                        </span>
                                    @break
                                    @default
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-500/20 text-slate-400 border border-slate-500/30">
                                            {{ $item->status }}
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('admin.permohonan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                @if($item->dokumen)
                                    <a href="{{ route('admin.permohonan.download', $item->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                @endif
                                <form action="{{ route('admin.permohonan.update', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="text-sm border border-slate-600 text-white placeholder-slate-500 rounded px-2 py-1 mr-2 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" onchange="this.form.submit()">
                                        <option value="pending" {{ ($item->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="approved" {{ ($item->status ?? 'pending') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="completed" {{ ($item->status ?? 'pending') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="rejected" {{ ($item->status ?? 'pending') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-400">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium">Belum ada permohonan informasi</p>
                                    <p class="text-sm text-gray-400 mt-1">Permohonan yang masuk akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==================== PAGINATION ==================== -->
    @if($permohonan->hasPages())
        <div class="bg-slate-800/80 px-4 py-3 flex items-center justify-between border-t border-slate-600/30 sm:px-6 rounded-b-2xl">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="{{ $permohonan->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-slate-600/50 bg-slate-900/50 text-white placeholder-slate-500 text-sm font-medium rounded-md text-slate-300 bg-slate-900/60 border border-slate-600 hover:bg-slate-700/50 transition-colors group shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400 transition-all">
                    Previous
                </a>
                <a href="{{ $permohonan->nextPageUrl() }}" class="relative ml-3 inline-flex items-center px-4 py-2 border border-slate-600/50 bg-slate-900/50 text-white placeholder-slate-500 text-sm font-medium rounded-md text-slate-300 bg-slate-900/60 border border-slate-600 hover:bg-slate-700/50 transition-colors group shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400 transition-all">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-300">
                        Showing
                        <span class="font-medium">{{ $permohonan->firstItem() }}</span>
                        to
                        <span class="font-medium">{{ $permohonan->lastItem() }}</span>
                        of
                        <span class="font-medium">{{ $permohonan->total() }}</span>
                        results
                    </p>
                </div>
                <div>
                    {{ $permohonan->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
</div>

@endsection
