@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📝 Edit Profil PPID</h1>
            <p class="text-gray-600 mt-1">Kelola informasi {{ ucfirst($type) }} PPID</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/profil/' . $type) }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
            <a href="{{ route('admin.profil.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form action="{{ route('admin.profil.update', $profil->tipe) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-8">
                
                <!-- Judul Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" 
                           name="judul" 
                           value="{{ old('judul', $profil->judul) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Masukkan judul {{ $type }}"
                           required>
                </div>

                <!-- Gambar Section (for struktur) -->
                @if($type === 'struktur')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Struktur Organisasi</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        @if($profil->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="Struktur" class="mx-auto h-48 object-contain">
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="hapus_gambar" value="1" class="mr-2">
                                        <span class="text-sm text-red-600">Hapus gambar</span>
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="text-gray-400 mb-4">
                                <i class="fas fa-image text-4xl"></i>
                                <p class="mt-2">Belum ada gambar</p>
                            </div>
                        @endif
                        <input type="file" 
                               name="gambar" 
                               accept="image/*" 
                               class="hidden" 
                               id="gambar-input"
                               onchange="previewImage(this)">
                        <button type="button" 
                                onclick="document.getElementById('gambar-input').click()" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-upload mr-2"></i>Pilih Gambar
                        </button>
                        <div id="image-preview" class="mt-4"></div>
                    </div>
                </div>
                @endif

                <!-- Konten Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                    <div class="border border-gray-300 rounded-lg">
                        <textarea id="editor" 
                                  name="konten" 
                                  rows="10"
                                  class="w-full px-4 py-2 border-0 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Tulis konten {{ $type }} di sini...">{{ old('konten', $profil->konten) }}</textarea>
                    </div>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
                <a href="{{ route('admin.profil.index') }}" class="px-6 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Simple Editor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'imageUpload', 'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ],
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            placeholder: 'Tulis konten {{ $type }} di sini...'
        })
        .catch(error => {
            console.error(error);
        });

    // Image preview function
    window.previewImage = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.innerHTML = `
                    <div class="mt-4">
                        <img src="${e.target.result}" alt="Preview" class="mx-auto h-48 object-contain rounded border">
                        <p class="text-sm text-gray-600 mt-2">Preview gambar baru</p>
                    </div>
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
});
</script>
@endsection
