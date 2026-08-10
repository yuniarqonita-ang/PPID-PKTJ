@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    <div>
        <h1 class="text-3xl font-black text-[#004a99] tracking-tight uppercase">Edit Menu / Sub-Menu</h1>
        <p class="text-slate-500 text-sm font-semibold mt-1">Ubah konfigurasi menu navigasi "{{ $menu->nama }}" untuk website PPID PKTJ.</p>
    </div>

    @if($errors->any())
    <div class="bg-rose-50 border-2 border-rose-100 text-rose-800 p-6 rounded-[1.5rem] space-y-2">
        <div class="flex items-center gap-2 font-bold text-sm">
            <i class="fas fa-exclamation-circle text-rose-500"></i>
            <span>Ada beberapa kesalahan penginputan data:</span>
        </div>
        <ul class="list-disc ps-6 text-xs font-semibold">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Card -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2rem] shadow-xl border border-slate-200 p-8 space-y-6">
                    <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-100 pb-4">
                        <span class="w-8 h-8 bg-blue-50 text-[#004a99] rounded-lg flex items-center justify-center mr-3 text-xs">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        Detail Informasi Menu
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Nama Menu / Sub-Menu</label>
                            <input type="text" name="nama" value="{{ old('nama', $menu->nama) }}" required class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Pilih Induk Menu (Sub-Menu Dari)</label>
                                <select name="parent_id" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                                    <option value="">-- Menu Utama (Tidak ada Induk) --</option>
                                    @foreach($parentMenus as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->nama }}</option>
                                    @endforeach
                                </select>
                                <p class="text-[9px] text-slate-400 mt-1">Biarkan kosong jika menu ini akan menjadi menu utama di tingkat atas navigasi.</p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Custom URL / Redirect</label>
                                <input type="text" name="url" value="{{ old('url', $menu->url) }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]" placeholder="Contoh: https://dephub.go.id atau /layanan-informasi">
                                <p class="text-[9px] text-slate-400 mt-1">Kosongkan jika ingin membuat halaman konten dinamis di portal ini.</p>
                            </div>
                        </div>

                        <!-- Menu Layout Options / Features -->
                        <div class="bg-slate-50 p-6 rounded-2xl space-y-4">
                            <h4 class="text-xs font-black text-[#004a99] uppercase tracking-[2px]">Fitur & Layout Halaman</h4>
                            <p class="text-[10px] text-slate-500">Pilih komponen apa saja yang akan dirender di halaman publik menu ini nantinya:</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <label class="flex items-center gap-3 p-4 bg-white rounded-xl border border-slate-200/60 cursor-pointer select-none">
                                    <input type="checkbox" name="is_editor" value="1" {{ old('is_editor', $menu->is_editor) ? 'checked' : '' }} class="w-5 h-5 text-[#004a99] rounded border-slate-300">
                                    <span class="text-xs font-bold text-slate-700">Teks Editor</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 bg-white rounded-xl border border-slate-200/60 cursor-pointer select-none">
                                    <input type="checkbox" name="is_table" value="1" {{ old('is_table', $menu->is_table) ? 'checked' : '' }} class="w-5 h-5 text-[#004a99] rounded border-slate-300">
                                    <span class="text-xs font-bold text-slate-700">Tabel Data</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 bg-white rounded-xl border border-slate-200/60 cursor-pointer select-none">
                                    <input type="checkbox" name="is_chart" value="1" {{ old('is_chart', $menu->is_chart) ? 'checked' : '' }} class="w-5 h-5 text-[#004a99] rounded border-slate-300">
                                    <span class="text-xs font-bold text-slate-700">Bagan/Gambar</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 bg-white rounded-xl border border-slate-200/60 cursor-pointer select-none">
                                    <input type="checkbox" name="is_form" value="1" {{ old('is_form', $menu->is_form) ? 'checked' : '' }} class="w-5 h-5 text-[#004a99] rounded border-slate-300">
                                    <span class="text-xs font-bold text-slate-700">Form Kontak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Content Editor -->
                        <div class="space-y-2">
                            <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Isi Konten Halaman (Teks Editor)</label>
                            <div class="rounded-3xl overflow-hidden border-2 border-slate-100">
                                <textarea name="konten" id="editor_konten" class="tinymce-editor">{{ old('konten', $menu->konten) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Editor -->
            <div class="space-y-8">
                <div class="bg-[#002b5c] rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden ring-1 ring-white/10">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-3 border-b border-white/10 pb-6">
                            <div class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-lg">
                                <i class="fas fa-save"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-black uppercase tracking-widest">Aksi Menu</h4>
                                <p class="text-[10px] text-blue-200/60 font-bold uppercase mt-1">Perbarui menu</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-blue-200/60 uppercase tracking-[2px] block">Penempatan Menu</label>
                                <select name="penempatan" class="w-full px-4 py-3 bg-white/10 border-2 border-white/10 rounded-xl focus:ring-4 focus:ring-[#ffc107]/20 focus:bg-slate-800/90 transition-all font-bold text-white text-sm">
                                    <option value="header" class="text-slate-800" {{ old('penempatan', $menu->penempatan) === 'header' ? 'selected' : '' }}>Header (Navigasi Atas)</option>
                                    <option value="footer" class="text-slate-800" {{ old('penempatan', $menu->penempatan) === 'footer' ? 'selected' : '' }}>Footer (Navigasi Bawah)</option>
                                    <option value="both" class="text-slate-800" {{ old('penempatan', $menu->penempatan) === 'both' ? 'selected' : '' }}>Keduanya (Header & Footer)</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-blue-200/60 uppercase tracking-[2px] block">Urutan Menu</label>
                                <input type="number" name="urutan" value="{{ old('urutan', $menu->urutan) }}" class="w-full px-4 py-3 bg-white/10 border-2 border-white/10 rounded-xl focus:ring-4 focus:ring-[#ffc107]/20 focus:bg-white/20 transition-all font-bold text-white text-sm">
                            </div>

                            <label class="flex items-center gap-3 p-4 bg-white/5 rounded-xl border border-white/10 cursor-pointer select-none">
                                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $menu->aktif) ? 'checked' : '' }} class="w-5 h-5 text-[#ffc107] rounded border-white/20 bg-transparent">
                                <span class="text-xs font-bold text-white uppercase tracking-wider">Aktifkan Menu Ini</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[3px] rounded-2xl hover:bg-white hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-amber-500/20">
                            SIMPAN PERUBAHAN
                        </button>
                        <a href="{{ route('admin.menu.index') }}" class="block text-center w-full py-4 border border-white/20 font-black text-xs uppercase tracking-[3px] rounded-2xl text-white hover:bg-white/5 transition-all">
                            BATAL
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
