<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            Edit Dokumen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <form action="{{ route('admin.dokumen.update', $dokumen) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-slate-300 text-sm font-bold mb-2">Judul Dokumen</label>
                            <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" 
                                class="shadow border rounded w-full py-2 px-3 text-slate-300 @error('judul') border-red-500 @enderror" required>
                            @error('judul')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-slate-300 text-sm font-bold mb-2">Kategori</label>
                            <select name="kategori_id" class="shadow border rounded w-full py-2 px-3 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $dokumen->kategori_id == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-slate-300 text-sm font-bold mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="shadow border rounded w-full py-2 px-3 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-slate-300 text-sm font-bold mb-2">File Dokumen Saat Ini</label>
                            <p class="text-sm text-slate-300">{{ basename($dokumen->file_path) }} ({{ $dokumen->formatted_file_size }})</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-slate-300 text-sm font-bold mb-2">Ganti File (Opsional)</label>
                            <input type="file" name="file" class="shadow border rounded w-full py-2 px-3 text-slate-300" 
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                            <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti file</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                            <a href="{{ route('admin.dokumen.index') }}" class="font-bold text-sm text-blue-500 hover:text-blue-300">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>