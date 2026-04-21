@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-question-circle mr-2"></i> Kelola FAQ
                </h1>
                <p class="text-gray-500 font-medium mt-1">Daftar pertanyaan dan jawaban yang sering diajukan kepada PPID</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.faq.create') }}" class="px-6 py-3 bg-[#ffc107] text-[#004a99] font-bold rounded-xl shadow-lg hover:bg-yellow-400 transform hover:scale-[1.02] transition-all flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah FAQ Baru
                </a>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#004a99] flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total FAQ</p>
                    <p class="text-3xl font-black text-[#004a99]">{{ $faqs->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-list-ul"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Aktif / Publik</p>
                    <p class="text-3xl font-black text-green-600">{{ $faqs->where('aktif', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-500 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Non-Aktif</p>
                    <p class="text-3xl font-black text-orange-600">{{ $faqs->where('aktif', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-eye-slash"></i>
                </div>
            </div>
        </div>

        <!-- ALERTS -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#004a99]">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#004a99] text-white">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center w-16">#</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider w-1/3">Pertanyaan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jawaban Ringkas</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($faqs as $index => $faq)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-gray-400 text-center">
                                    {{ $faqs->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-[#004a99] group-hover:text-blue-700 transition-colors leading-relaxed">
                                        {{ Str::limit($faq->pertanyaan, 100) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-gray-500 leading-relaxed italic">
                                        {{ Str::limit(strip_tags($faq->jawaban), 120) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($faq->aktif)
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-green-100 text-green-600 border border-green-200">
                                            PUBLIK
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-gray-100 text-gray-400 border border-gray-200">
                                            DRAFT
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="p-2 w-10 h-10 rounded-lg bg-blue-50 text-[#004a99] hover:bg-[#004a99] hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit FAQ">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 w-10 h-10 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Hapus FAQ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 font-medium italic bg-gray-50">
                                    <i class="fas fa-question text-4xl mb-3 block opacity-20 text-[#004a99]"></i>
                                    Belum ada data FAQ.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($faqs->hasPages())
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $faqs->links() }}
                </div>
            @endif
        </div>

        <!-- INFO BOX -->
        <div class="bg-blue-100 rounded-2xl p-6 border-l-4 border-[#004a99]">
            <div class="flex">
                <i class="fas fa-info-circle text-[#004a99] text-xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-[#004a99] mb-1">Informasi Sinkronisasi</h4>
                    <p class="text-sm text-blue-800 leading-relaxed font-medium">
                        Seluruh data FAQ yang berstatus <strong>PUBLIK</strong> akan otomatis muncul di halaman depan website publik PPID-PKTJ secara real-time. Pastikan jawaban sudah akurat sebelum mengubah status menjadi publik.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
