@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 drop-shadow-lg">
                ❓ Kelola FAQ
            </h1>
            <p class="text-slate-400 mt-1 font-medium">Kelola pertanyaan dan jawaban yang sering diajukan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.faq.create') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105 shadow-lg shadow-pink-500/25">
                <i class="fas fa-plus mr-2"></i>Tambah FAQ Baru
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-900/20 to-green-900/30 border border-green-600/30 p-6 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-300">✅ Berhasil!</h3>
                        <p class="text-green-400">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== CONTENT SECTION ==================== -->
    @if($faqs->count())
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-900/80 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Pertanyaan</th>
                            <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Jawaban</th>
                            <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-cyan-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach($faqs as $faq)
                            <tr class="hover:bg-slate-700/50 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-slate-300">{{ $faq->id }}</td>
                                <td class="px-6 py-4 text-sm text-white font-medium group-hover:text-cyan-300 transition-colors">{{ Str::limit($faq->pertanyaan, 50) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-400">{{ Str::limit(strip_tags($faq->jawaban), 60) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($faq->aktif)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="p-2 rounded-lg bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500 hover:text-white transition shadow-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition shadow-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($faqs->hasPages())
            <div class="px-6 py-4 border-t border-slate-700/50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-400">
                        Menampilkan {{ $faqs->firstItem() }} - {{ $faqs->lastItem() }} dari {{ $faqs->total() }} FAQ
                    </div>
                    <div>{{ $faqs->links() }}</div>
                </div>
            </div>
            @endif
        </div>
    @else
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 p-16 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-r from-pink-500/20 to-purple-500/20 flex items-center justify-center">
                    <i class="fas fa-question-circle text-4xl text-pink-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Belum Ada FAQ</h3>
                <p class="text-slate-400 mb-8">Mulai dengan menambahkan FAQ pertama untuk membantu pengguna menemukan informasi yang dibutuhkan.</p>
                <a href="{{ route('admin.faq.create') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 inline-block shadow-lg shadow-pink-500/25">
                    <i class="fas fa-plus mr-2"></i>Buat FAQ Pertama
                </a>
            </div>
        </div>
    @endif

    <!-- ==================== STATS SECTION ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 to-pink-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">{{ $faqs->total() }}</p>
                        <p class="text-sm text-white/90 font-medium mt-1">Total FAQ</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fas fa-question text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 to-purple-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">{{ $faqs->where('aktif', true)->count() }}</p>
                        <p class="text-sm text-white/90 font-medium mt-1">FAQ Aktif</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-black">{{ $faqs->where('aktif', false)->count() }}</p>
                        <p class="text-sm text-white/90 font-medium mt-1">FAQ Nonaktif</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fas fa-eye-slash text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
