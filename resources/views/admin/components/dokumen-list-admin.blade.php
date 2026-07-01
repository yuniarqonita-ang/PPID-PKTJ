@php
    $items = \App\Models\Dokumen::where('kategori', $kategori)->latest()->get();
@endphp

<div class="bg-white rounded-3xl shadow-xl border-2 border-slate-100 overflow-hidden mt-10">
    <!-- Header -->
    <div class="p-8 border-b-2 border-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h4 class="text-lg font-black text-[#004a99] uppercase tracking-widest flex items-center">
            <span class="w-10 h-10 bg-amber-500/10 text-amber-600 rounded-xl flex items-center justify-center mr-4 text-sm">
                <i class="fas fa-folder-open"></i>
            </span>
            Daftar Lampiran Dokumen
        </h4>
        <a href="{{ route('admin.dokumen.create', ['kategori' => $kategori]) }}" 
           class="px-6 py-3 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-black transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-900/10 border-none cursor-pointer text-center">
            <i class="fas fa-plus"></i> Tambah Dokumen
        </a>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest w-20">No</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Dokumen</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tipe File</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Ukuran</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest w-36">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($items as $key => $item)
                    @php
                        $isGDrive = str_starts_with($item->file_path, 'http://') || str_starts_with($item->file_path, 'https://');
                        $ext = $isGDrive ? 'GDRIVE' : pathinfo($item->file_path, PATHINFO_EXTENSION);
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-5">
                            <span class="text-xs font-black text-slate-300">#{{ $key + 1 }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#004a99] flex items-center justify-center text-sm flex-shrink-0">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="text-xs font-black text-[#002b5c] group-hover:text-[#004a99] transition-colors leading-tight">
                                    {{ $item->judul }}
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-2.5 py-1 bg-slate-100 text-[9px] font-black text-slate-500 rounded uppercase tracking-widest">
                                {{ $ext ?: 'FILE' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="text-xs text-slate-500 font-bold">
                                {{ $item->file_size ?: '-' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            @if($item->aktif)
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[9px] font-black rounded uppercase">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase">Draf</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center items-center gap-2">
                                <button type="button" 
                                        class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-amber-500 hover:border-amber-200 hover:bg-amber-50 transition-all flex items-center justify-center group/btn shadow-sm"
                                        title="Pratinjau"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#previewModal" 
                                        data-url="{{ route('preview.dokumen', ['file' => ($isGDrive ? $item->file_path : 'storage/' . $item->file_path), 'title' => $item->judul]) }}">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                <a href="{{ route('admin.dokumen.edit', $item->id) }}" 
                                   class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-[#004a99] hover:border-blue-200 hover:bg-blue-50 transition-all flex items-center justify-center group/btn shadow-sm"
                                   title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all flex items-center justify-center group/btn shadow-sm border-none cursor-pointer"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center bg-slate-50/30">
                            <div class="max-w-xs mx-auto space-y-2 opacity-30 text-gray-500">
                                <i class="fas fa-folder-open text-4xl"></i>
                                <p class="text-[10px] font-black uppercase tracking-widest">Belum ada dokumen yang diunggah</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
