<x-app-layout>
    <div class="max-w-6xl">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Kelola FAQ</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola pertanyaan dan jawaban yang sering diajukan</p>
            </div>
            <a href="{{ route('admin.faq.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
                ➕ Tambah FAQ Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($faqs->count())
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-slate-100 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-slate-700">#</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-slate-700">Pertanyaan</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-slate-700">Jawaban</th>
                            <th class="px-6 py-3 text-center text-sm font-bold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm font-bold text-blue-600">{{ $faq->id }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ Str::limit($faq->pertanyaan, 50) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ Str::limit(strip_tags($faq->jawaban), 60) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded text-xs transition">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded text-xs transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-slate-500 text-lg mb-4">Belum ada FAQ yang dibuat</p>
                <a href="{{ route('admin.faq.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg inline-block">
                    Buat FAQ Pertama
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
