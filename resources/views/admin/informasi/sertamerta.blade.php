@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600">
                🚨 Informasi Serta Merta
            </h1>
            <p class="text-slate-500 mt-1">Kelola informasi yang harus segera disampaikan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.informasi.sertamerta.create') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Upload Informasi
            </a>
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== SEARCH & FILTER SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[300px]">
                <div class="relative">
                    <input type="text" placeholder="Cari informasi serta merta..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="">Semua Kategori</option>
                <option value="bencana">Bencana Alam</option>
                <option value="darurat">Keadaan Darurat</option>
                <option value="pengumuman">Pengumuman Penting</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="1">Dipublikasikan</option>
                <option value="0">Draft</option>
            </select>
        </div>
    </div>

    <!-- ==================== DATA TABLE ==================== -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-green-500 to-teal-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Judul Informasi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Tingkat Kesegeraan</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">File</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sertaMertaData ?? [] as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($item->konten, 100) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->tingkat_kesegeraan == 'sangat-penting' ? 'bg-red-100 text-red-800' : ($item->tingkat_kesegeraan == 'penting' ? 'bg-orange-100 text-orange-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $item->tingkat_kesegeraan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($item->file)
                                    <a href="{{ asset('storage/serta-merta/' . $item->file) }}" target="_blank" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-file-pdf"></i> {{ $item->file }}
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $item->status == 1 ? 'Dipublikasikan' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-green-500 text-6xl mb-4">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data Informasi Serta Merta</h3>
                                <p class="text-gray-500 mb-4">Belum ada informasi yang harus segera disampaikan saat ini.</p>
                                <a href="{{ route('admin.informasi.sertamerta.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                    <i class="fas fa-plus mr-2"></i>Upload Informasi Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- ==================== PAGINATION ==================== -->
        @if(isset($sertaMertaData) && $sertaMertaData->count() > 0)
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">1</span> hingga <span class="font-medium">10</span> dari <span class="font-medium">{{ $sertaMertaData->count() }}</span> hasil
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-green-50 border-green-500 text-green-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
