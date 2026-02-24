@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                Edit Profil PPID
            </h1>
            <p class="text-slate-500 mt-1">Kelola informasi profil PPID dengan editor lengkap</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/profil', '_blank')" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="{{ route('admin.profil.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('admin.profil.update', $profil->type) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                
            <!-- JUDUL SECTION -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Profil</label>
                <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Masukkan judul profil" required>
            </div>

            <!-- SAMPUL SECTION -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampul / Cover</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    @if($profil->gambar)
                        <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="Sampul" class="mx-auto h-32 object-cover rounded mb-4">
                    @else
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    @endif
                    <input type="file" name="gambar" accept="image/*" class="hidden" id="gambar" onchange="previewSampul(this)">
                    <button type="button" onclick="document.getElementById('gambar').click()" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih Gambar
                    </button>
                </div>
            </div>

            <!-- KONTEN UTAMA SECTION -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Utama</label>
                <textarea id="editor_pembuka" name="konten_pembuka" class="custom-editor" 
                          style="width: 100%; height: 400px;">{{ old('konten_pembuka', $profil->konten_pembuka) }}</textarea>
            </div>

            <!-- KONTEN TAMBAHAN SECTION -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Tambahan</label>
                <textarea id="editor_detail" name="konten_detail" class="custom-editor" 
                          style="width: 100%; height: 400px;">{{ old('konten_detail', $profil->konten_detail) }}</textarea>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.profil.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/custom-editor-integrated.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize custom editor
    const textareas = document.querySelectorAll('textarea.custom-editor');
    textareas.forEach((textarea) => {
        if (textarea.id && typeof CustomEditor !== 'undefined') {
            new CustomEditor(textarea.id);
        }
    });
    
    // Preview function
    window.previewSampul = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = input.parentElement.querySelector('img');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'mx-auto h-32 object-cover rounded mb-4';
                    input.parentElement.insertBefore(img, input.parentElement.querySelector('.text-gray-400'));
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});
</script>
