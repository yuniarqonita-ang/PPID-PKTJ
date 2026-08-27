@extends('layouts.admin')

@section('title', 'Edit Regulasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('admin.regulasi.index') }}" class="text-xs font-bold text-[#004a99] hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Regulasi
                </a>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Edit Regulasi / Peraturan</h1>
            <p class="text-sm text-slate-500 font-medium mt-0.5">{{ $peraturan->judul }}</p>
        </div>
    </div>

    <form action="{{ route('admin.regulasi.update', $peraturan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl border border-slate-200 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul / Nama Peraturan <span class="text-rose-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $peraturan->judul) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium text-sm transition-all">
                @error('judul') <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Tahun Penerbitan</label>
                <input type="number" name="tahun" value="{{ old('tahun', $peraturan->tahun) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium text-sm transition-all">
                @error('tahun') <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kategori Peraturan <span class="text-rose-500">*</span></label>
                <select name="kategori" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium text-sm transition-all">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('kategori', $peraturan->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('kategori') <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Nomor Singkat / Kode</label>
                <input type="text" name="nomor" value="{{ old('nomor', $peraturan->nomor) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium text-sm transition-all">
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Deskripsi / Perihal</label>
            <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium text-sm transition-all">{{ old('deskripsi', $peraturan->deskripsi) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 bg-slate-50 rounded-2xl border border-slate-200">
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">File Dokumen PDF</label>
                @if($peraturan->file_path)
                    <div class="mb-2 p-2.5 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-xs text-emerald-800 font-semibold">
                        <span><i class="fas fa-file-pdf text-emerald-600 mr-1.5"></i> File saat ini tersimpan</span>
                        <a href="{{ asset($peraturan->file_path) }}" target="_blank" class="text-[#004a99] underline">Lihat</a>
                    </div>
                @endif
                <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx,.xls,.xlsx" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-600 focus:outline-none">
                <p class="text-[11px] text-slate-400">Pilih file baru jika ingin mengganti.</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">ATAU Tautan Eksternal (JDIH / Drive)</label>
                <input type="url" name="link_download" value="{{ old('link_download', $peraturan->link_download) }}" placeholder="https://jdih.dephub.go.id/..." class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#004a99] font-medium text-xs transition-all">
                <p class="text-[11px] text-slate-400">Jika file berada di portal JDIH Dephub / KIP.</p>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $peraturan->is_active) ? 'checked' : '' }} class="w-5 h-5 text-[#004a99] rounded border-slate-300 focus:ring-blue-500">
                <span class="text-sm font-bold text-slate-700">Publikasikan Regulasi</span>
            </label>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.regulasi.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold text-xs rounded-xl hover:bg-slate-200 transition-all">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-[#004a99] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-blue-500/20 hover:bg-[#003875] transition-all">
                    Perbarui Regulasi
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
