@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📝 Daftar Formulir
            </h1>
            <p class="text-gray-600 mt-1">Kelola semua formulir permohonan informasi</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.permohonan.form') }}" class="px-6 py-3 bg-blue-600 text-[#004a99] font-medium hover:bg-blue-700 transition rounded-lg">
                <i class="fas fa-plus mr-2"></i>Buat Formulir Baru
            </a>
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

