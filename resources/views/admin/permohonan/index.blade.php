@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Formulir: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Daftar <span class="text-[#ffc107]">Formulir</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola semua formulir permohonan informasi publik.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.permohonan.form') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Buat Formulir Baru
                </a>
            </div>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-300 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== CONTENT SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/80 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Judul Formulir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Jumlah Field</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-cyan-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-slate-700/50">
                    <tr class="hover:bg-gray-50 border border-gray-100 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#004a99]">1</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-[#004a99]">Formulir Permohonan Informasi Standar</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 field</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-300">
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 border border-gray-100 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#004a99]">2</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-[#004a99]">Formulir Permohonan Keberatan</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7 field</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-300">
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 border border-gray-100 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#004a99]">3</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-[#004a99]">Formulir Permohonan Dokumen</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8 field</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Draft
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==================== STATS SECTION ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Formulir</dt>
                        <dd class="text-lg font-medium text-[#004a99]">3</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-list text-green-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Field</dt>
                        <dd class="text-lg font-medium text-[#004a99]">20</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Aktif</dt>
                        <dd class="text-lg font-medium text-[#004a99]">2</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

