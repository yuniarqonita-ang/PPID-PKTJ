@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📰 DAFTAR BERITA</h1>
            <p class="text-gray-600 mt-1">Kelola semua konten berita yang ditampilkan di halaman publik</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
            <a href="{{ route('admin.berita.create') }}" class="px-4 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                <i class="fas fa-plus mr-2"></i>TAMBAH
            </a>
        </div>
    </div>

    <!-- ==================== SEARCH SECTION ==================== -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari berita..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Kategori</option>
                <option value="pengumuman">Pengumuman</option>
                <option value="artikel">Artikel</option>
                <option value="press-release">Press Release</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">10 per halaman</option>
                <option value="25">25 per halaman</option>
                <option value="50">50 per halaman</option>
                <option value="100">100 per halaman</option>
            </select>
        </div>
    </div>

    <!-- ==================== TABLE SECTION ==================== -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul Berita
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Berita
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Waktu Tambah
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Waktu Ubah
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Terbitkan
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($beritas as $index => $berita)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $berita->judul }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ Str::limit(strip_tags($berita->konten), 100) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $berita->created_at ? \Carbon\Carbon::parse($berita->created_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $berita->updated_at ? \Carbon\Carbon::parse($berita->updated_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($berita->is_published ?? true)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Y
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                N
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-newspaper text-4xl mb-4"></i>
                            <p class="text-lg font-medium">Belum ada data berita</p>
                            <p class="text-sm mt-1">Mulai dengan menambahkan berita baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==================== PAGINATION SECTION ==================== -->
    @if(isset($beritas) && $beritas->hasPages())
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan {{ $beritas->firstItem() }} hingga {{ $beritas->lastItem() }} dari {{ $beritas->total() }} hasil
        </div>
        <div class="flex items-center space-x-2">
            {{ $beritas->links() }}
        </div>
    </div>
    @endif

    </div>
</div>
@endsection