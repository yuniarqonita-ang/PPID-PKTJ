@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-200 via-pink-100 to-purple-200 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-pink-800 drop-shadow-lg">
                ❓ Kelola FAQ
            </h1>
            <p class="text-slate-800 mt-1 font-medium">Kelola pertanyaan dan jawaban yang sering diajukan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.faq.create') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-pink-600 to-purple-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Tambah FAQ Baru
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-100 to-green-200 border-2 border-green-400 p-6 shadow-xl">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-300/40 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center animate-pulse shadow-lg">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-900">✅ Berhasil!</h3>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== CONTENT SECTION ==================== -->
    @if($faqs->count())
        <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-2xl p-8 border-2 border-pink-300">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-pink-100 to-purple-100 border-b-2 border-pink-300">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">#</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">Pertanyaan</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">Jawaban</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-pink-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr class="border-b border-pink-200 hover:bg-pink-50/50 transition-all duration-200">
                                <td class="px-6 py-4 text-sm font-bold text-pink-600">{{ $faq->id }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700 font-medium">{{ Str::limit($faq->pertanyaan, 50) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ Str::limit(strip_tags($faq->jawaban), 60) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-2 px-4 rounded-lg text-xs transition-all duration-300 transform hover:scale-105 shadow-md">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-2 px-4 rounded-lg text-xs transition-all duration-300 transform hover:scale-105 shadow-md">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-2xl p-16 text-center border-2 border-pink-300">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-r from-pink-200 to-purple-200 flex items-center justify-center">
                    <i class="fas fa-question-circle text-4xl text-pink-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Belum Ada FAQ</h3>
                <p class="text-slate-600 mb-8">Mulai dengan menambahkan FAQ pertama untuk membantu pengguna menemukan informasi yang dibutuhkan.</p>
                <a href="{{ route('admin.faq.create') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 inline-block">
                    <i class="fas fa-plus mr-2"></i>Buat FAQ Pertama
                </a>
            </div>
        </div>
    @endif

    <!-- ==================== STATS SECTION ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 to-pink-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/20 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">{{ $faqs->count() }}</p>
                        <p class="text-sm text-white/90 font-medium mt-1">Total FAQ</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-question text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 to-purple-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/20 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">3</p>
                        <p class="text-sm text-white/90 font-medium mt-1">Bulan Ini</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-calendar text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/20 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">98%</p>
                        <p class="text-sm text-white/90 font-medium mt-1">Kepuasan</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-smile text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
