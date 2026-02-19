<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <h1 class="text-3xl font-bold text-white">📝 Edit Profil PPID</h1>
                </div>

                <!-- Content -->
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.profil.update', $profil->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Judul Profil</label>
                            <input type="text" name="judul" value="{{ old('judul', $profil->judul ?? '') }}" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Konten Pembuka</label>
                            <textarea name="konten_pembuka" rows="4" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" required>{{ old('konten_pembuka', $profil->konten_pembuka ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Judul Sub Profil</label>
                            <input type="text" name="judul_sub" value="{{ old('judul_sub', $profil->judul_sub ?? '') }}" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Detail Konten</label>
                            <textarea id="editor" name="konten_detail" rows="8" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">{{ old('konten_detail', $profil->konten_detail ?? '') }}</textarea>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition">
                                💾 Simpan Perubahan
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition">
                                ← Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });
    </script>
</x-app-layout>