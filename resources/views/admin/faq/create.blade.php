<x-app-layout>
    <div class="max-w-3xl">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Tambah FAQ Baru</h1>

        <form action="{{ route('admin.faq.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf

            <div class="mb-6">
                <label for="pertanyaan" class="block text-sm font-bold text-slate-700 mb-2">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan') }}" placeholder="Masukkan pertanyaan FAQ" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('pertanyaan') border-red-500 @enderror">
                @error('pertanyaan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jawaban" class="block text-sm font-bold text-slate-700 mb-2">
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea name="jawaban" id="jawaban" rows="8" placeholder="Masukkan jawaban FAQ" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jawaban') border-red-500 @enderror">{{ old('jawaban') }}</textarea>
                @error('jawaban')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    ✅ Simpan FAQ
                </button>
                <a href="{{ route('admin.faq.index') }}" class="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-6 rounded-lg transition">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
