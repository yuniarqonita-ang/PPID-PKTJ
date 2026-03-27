@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-4xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">✏️ Edit Informasi Berkala</h1>
            <p class="text-slate-300 mt-1">Edit informasi berkala yang ada</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/informasi/berkala') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
            <a href="{{ route('admin.informasi.berkala') }}" class="px-4 py-2 text-slate-300 hover:text-white font-medium">
                Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <form action="{{ route('admin.informasi.berkala.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Judul *</label>
                    <input type="text" 
                           name="judul" 
                           value="{{ old('judul', $item->judul) }}"
                           class="w-full px-4 py-2 border border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500"
                           placeholder="Masukkan judul informasi"
                           required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" 
                              rows="4"
                              class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                              placeholder="Masukkan deskripsi informasi">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">File</label>
                    @if($item->file_path)
                        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file text-blue-600 mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-blue-300">{{ $item->file_name }}</p>
                                        <p class="text-xs text-blue-600">{{ $item->file_size }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset($item->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-300">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <div class="border-2 border-dashed border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-lg p-6 text-center">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-cloud-upload-alt text-4xl"></i>
                            <p class="mt-2">Ganti file (opsional)</p>
                            <p class="text-xs">PDF, DOC, DOCX, XLS, XLSX (Max 10MB)</p>
                        </div>
                        <input type="file" 
                               name="file" 
                               accept=".pdf,.doc,.docx,.xls,.xlsx" 
                               class="hidden" 
                               id="file-input"
                               onchange="handleFileSelect(this)">
                        <button type="button" 
                                onclick="document.getElementById('file-input').click()" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-upload mr-2"></i>Ganti File
                        </button>
                        <div id="file-preview" class="mt-4"></div>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="aktif" value="1" {{ $item->aktif ? 'checked' : '' }} class="mr-2">
                        <span class="text-sm font-medium text-slate-300">Tampilkan di halaman publik</span>
                    </label>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
                <a href="{{ route('admin.informasi.berkala') }}" class="px-6 py-2 text-slate-300 hover:text-white font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>

</div>
</div>

<script>
function handleFileSelect(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const preview = document.getElementById('file-preview');
        
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert('File terlalu besar. Maksimal 10MB.');
            input.value = '';
            return;
        }
        
        // Validate file type
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!allowedTypes.includes(file.type)) {
            alert('Tipe file tidak diizinkan. Hanya PDF, DOC, DOCX, XLS, XLSX.');
            input.value = '';
            return;
        }
        
        preview.innerHTML = `
            <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded">
                <i class="fas fa-file text-green-600 mr-2"></i>
                <div class="text-left">
                    <p class="text-sm font-medium text-green-300">${file.name}</p>
                    <p class="text-xs text-green-600">${(file.size / 1024).toFixed(2)} KB</p>
                </div>
            </div>
        `;
    }
}
</script>
@endsection
