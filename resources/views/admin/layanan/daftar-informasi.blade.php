@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem DIP: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Daftar <span class="text-[#ffc107]">Informasi Publik</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Inventaris Daftar Informasi Publik — Kendali Penuh Terpusat.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('layanan.daftar-informasi') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Tambah Data DIP
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="p-6 bg-emerald-50 border-2 border-emerald-200 rounded-3xl flex items-center gap-5">
        <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg">
            <i class="fas fa-check"></i>
        </div>
        <p class="text-lg font-bold text-emerald-800">{{ session('success') }}</p>
    </div>
    @endif

    <!-- HERO CONFIG -->
    <div class="bg-white rounded-2xl shadow-lg border-2 border-slate-100 overflow-hidden">
        <div class="p-10 space-y-8">
            <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                <h3 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                    <span class="w-10 h-10 bg-[#ffc107] text-[#004a99] rounded-xl flex items-center justify-center mr-4 text-lg">
                        <i class="fas fa-desktop"></i>
                    </span>
                    Konfigurasi Halaman Publik
                </h3>
            </div>
            
            <form action="{{ route('admin.halaman-custom.store', 'layanan_daftar') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                <div class="space-y-3">
                    <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Judul Halaman Depan</label>
                    <input type="text" name="judul_hero" value="{{ $settings['layanan_daftar_judul_hero'] ?? 'Daftar Informasi Publik' }}"
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all font-bold text-[#004a99] text-lg">
                </div>
                <div class="space-y-3">
                    <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Tagline Deskripsi</label>
                    <input type="text" name="tagline_hero" value="{{ $settings['layanan_daftar_tagline_hero'] ?? '' }}"
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all font-bold text-[#004a99] text-lg">
                </div>
                
                <div class="md:col-span-2 space-y-4">
                    <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Background Hero (Gambar)</label>
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        @if(isset($settings['layanan_daftar_hero_image']))
                        <div class="w-full md:w-64 h-36 rounded-2xl overflow-hidden border-2 border-slate-100 shadow-md">
                            <img src="{{ asset('storage/halaman/' . $settings['layanan_daftar_hero_image']) }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="flex-1 w-full">
                            <input type="file" name="hero_image" class="w-full px-6 py-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 transition-all font-bold text-[#004a99]">
                            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-widest">Format: JPG, PNG, WEBP (Max 5MB). Rekomendasi: 1920x1080px</p>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-black transition-all border-none cursor-pointer">
                        Simpan Konfigurasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DATA TABLE AREA -->
    <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" style="min-width: 1500px;">
                <thead>
                    <tr class="bg-[#004a99] text-[#ffc107]">
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">No</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Penanggung Jawab</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest w-64">Informasi</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Jenis Info</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest w-64">Ringkasan Info</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Pejabat Penguasa</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Penerbit</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Bentuk</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Tempat</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Waktu</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Jangka Waktu</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-slate-50">
                    @forelse($items as $item)
                    <tr class="hover:bg-blue-50/30 transition-all text-sm">
                        <td class="px-6 py-4 font-bold">{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>
                        <td class="px-6 py-4 font-bold text-slate-700">{{ $item->penanggung_jawab ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <h4 class="text-sm font-black text-[#004a99]">{{ $item->judul_informasi }}</h4>
                            @if($item->file_informasi)
                                <span class="bg-[#004a99] text-white px-2 py-0.5 rounded text-[10px] font-bold mt-1 inline-block">ADA DOKUMEN</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 bg-[#ffc107] text-[#004a99] rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm">{{ str_replace('informasi-', '', $item->kategori ?? 'Umum') }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-600 line-clamp-2" title="{{ strip_tags($item->isi_informasi) }}">
                            {!! Str::limit(strip_tags($item->isi_informasi), 50) !!}
                        </td>
                        <td class="px-6 py-4 text-xs">{{ $item->pejabat_penguasa ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->penerbit_informasi ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->bentuk_informasi ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->tempat_pembuatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->waktu_pembuatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->jangka_waktu ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($item->aktif)
                                <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    <i class="fas fa-check-circle mr-1 text-emerald-600"></i> Tayang di Publik
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-900 rounded-full text-[10px] font-black uppercase tracking-wider" title="Tersimpan di Admin Panel, belum tayang di publik karena belum ada dokumen/link resmi">
                                    <i class="fas fa-clock mr-1 text-amber-600"></i> Draft (Menunggu Berkas)
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="showDetailDIP({{ json_encode($item) }})" class="w-8 h-8 bg-white text-amber-600 rounded-lg flex items-center justify-center border-2 border-slate-200 hover:bg-amber-600 hover:text-white transition-all shadow-md" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                @if($item->file_informasi)
                                <button type="button" 
                                        class="w-8 h-8 bg-white text-green-600 rounded-lg flex items-center justify-center border-2 border-slate-200 hover:bg-green-600 hover:text-white transition-all shadow-md cursor-pointer" 
                                        title="Pratinjau Dokumen"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#previewModal" 
                                        data-url="{{ route('preview.dokumen', ['file' => $item->file_informasi, 'title' => $item->judul_informasi, 'is_blurred' => $item->is_blurred ? 1 : 0]) }}">
                                    <i class="fas fa-file-pdf text-xs"></i>
                                </button>
                                @endif
                                <a href="{{ route('admin.layanan.daftar-informasi.edit', $item->id) }}" class="w-8 h-8 bg-white text-[#004a99] rounded-lg flex items-center justify-center border-2 border-slate-200 hover:bg-[#004a99] hover:text-white transition-all shadow-md">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <button onclick="confirmDeleteDIP('{{ $item->id }}')" class="w-8 h-8 bg-white text-red-600 rounded-lg flex items-center justify-center border-2 border-slate-200 hover:bg-red-600 hover:text-white transition-all shadow-md">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-folder-open text-gray-200 text-4xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest">Belum Ada Data</h3>
                                <p class="text-gray-400 text-sm mt-1">Klik "Tambah Data DIP" untuk menambahkan data pertama.</p>
                                <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="mt-6 px-6 py-2 bg-[#004a99] text-white font-bold rounded-xl text-xs uppercase tracking-widest">Tambah Sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
        <!-- PAGINATION DARI DATABASE -->
        <div class="p-8 bg-slate-50 border-t-2 border-slate-100">
            {{ $items->links() }}
        </div>
        @endif
    </div>
</div>

<!-- DETAIL MODAL -->
<div id="detailDIPModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] shadow-2xl p-10 max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col transform scale-95 transition-transform duration-300">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 class="text-2xl font-black text-[#004a99] uppercase truncate pr-8">Detail Informasi Publik</h3>
            <button onclick="closeDetailDIPModal()" class="text-gray-400 hover:text-red-500 transition-colors text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="detailDIPContent" class="flex-1 overflow-y-auto space-y-6 p-2">
            <!-- Content filled by JS -->
        </div>
        <div class="mt-8 pt-6 border-t flex justify-end">
            <button onclick="closeDetailDIPModal()" class="px-8 py-3 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-black transition-all">Tutup</button>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteDIPModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-black text-[#004a99] uppercase mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-sm mb-8 font-medium">Data informasi publik ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteDIPModal()" class="flex-1 py-3 bg-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-200 transition-all">Batal</button>
                <form id="deleteDIPForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition-all">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetailDIP(item) {
        const modal = document.getElementById('detailDIPModal');
        const content = document.getElementById('detailDIPContent');
        
        let html = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul Informasi</p>
                        <p class="text-lg font-black text-[#004a99]">${item.judul_informasi || '-'}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</p>
                        <p class="font-bold text-slate-700">${item.kategori || '-'}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tipe Informasi</p>
                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-black uppercase mt-1">${item.tipe_informasi || 'Umum'}</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pejabat Penguasa</p>
                        <p class="font-bold text-[#004a99] uppercase">${item.pejabat_penguasa || '-'}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penanggung Jawab</p>
                        <p class="font-bold text-slate-700">${item.penanggung_jawab || '-'}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Pembuatan</p>
                        <p class="font-bold text-slate-700">${item.waktu_pembuatan || '-'}</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t pt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bentuk Informasi</p>
                    <p class="font-bold text-slate-700">${item.bentuk_informasi || '-'}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jangka Waktu Penyimpanan</p>
                    <p class="font-bold text-slate-700">${item.jangka_waktu || '-'}</p>
                </div>
            </div>

            <div class="border-t pt-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ringkasan Isi Informasi</p>
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 text-sm leading-relaxed text-slate-600 italic">
                    ${item.isi_informasi || 'Tidak ada deskripsi tambahan.'}
                </div>
            </div>

            ${item.file_informasi ? `
            <div class="border-t pt-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Dokumen Terlampir</p>
                <a href="${item.file_informasi.startsWith('http') ? item.file_informasi : '/' + item.file_informasi}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-green-50 text-green-700 border-2 border-green-100 rounded-xl hover:bg-green-600 hover:text-white transition-all group font-bold">
                    <i class="fas fa-file-pdf text-xl"></i>
                    <span>Buka Lampiran Dokumen</span>
                </a>
            </div>
            ` : ''}

            ${item.image ? `
            <div class="border-t pt-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Gambar Pendukung</p>
                <div class="rounded-2xl overflow-hidden border-2 border-slate-100 shadow-lg mb-3">
                    <img src="${item.image.startsWith('http') ? item.image : '/' + item.image}" class="w-full h-auto object-cover max-h-96">
                </div>
                <a href="${item.image.startsWith('http') ? item.image : '/' + item.image}" target="_blank" class="inline-flex items-center gap-2 text-xs font-black text-[#004a99] uppercase hover:underline">
                    <i class="fas fa-external-link-alt"></i> Lihat Ukuran Penuh
                </a>
            </div>
            ` : ''}
        `;
        
        content.innerHTML = html;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDetailDIPModal() {
        const modal = document.getElementById('detailDIPModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function confirmDeleteDIP(id) {
        document.getElementById('deleteDIPForm').action = `{{ url('admin/layanan/daftar-informasi') }}/${id}`;
        const modal = document.getElementById('deleteDIPModal');
        modal.classList.remove('hidden');
    }

    function closeDeleteDIPModal() {
        document.getElementById('deleteDIPModal').classList.add('hidden');
    }
</script>
@endsection
