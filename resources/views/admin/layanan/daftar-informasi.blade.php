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
            
            <form action="{{ route('admin.halaman-custom.store', 'layanan_daftar') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#004a99] text-[#ffc107]">
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest">Detail Informasi</th>
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest">Otoritas</th>
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest text-center">Tipe</th>
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest text-center">Status</th>
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-slate-50">
                    @forelse($items as $item)
                    <tr class="hover:bg-blue-50/30 transition-all">
                        <td class="px-8 py-6">
                            <h4 class="text-base font-black text-[#004a99] mb-1">{{ $item->judul_informasi }}</h4>
                            <div class="flex items-center gap-3 mt-1">
                                @if($item->file_informasi)
                                    <span class="bg-[#004a99] text-white px-2 py-0.5 rounded text-xs font-bold">PDF</span>
                                @endif
                                @if($item->waktu_pembuatan)
                                    <span class="text-slate-500 text-xs font-bold">{{ $item->waktu_pembuatan }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-[#004a99] uppercase">{{ $item->pejabat_penguasa ?? '-' }}</p>
                            @if($item->penanggung_jawab)
                            <p class="text-xs font-bold text-slate-500 mt-1">{{ $item->penanggung_jawab }}</p>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex px-3 py-1 bg-[#ffc107] text-[#004a99] rounded-full text-xs font-black uppercase tracking-widest shadow-sm">{{ $item->tipe_informasi ?? 'Umum' }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($item->aktif)
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-black uppercase">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1 animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-black uppercase">Draft</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-end gap-2">
                                @if($item->file_informasi)
                                <a href="{{ asset($item->file_informasi) }}" target="_blank" class="w-10 h-10 bg-white text-green-600 rounded-xl flex items-center justify-center border-2 border-slate-200 hover:bg-green-600 hover:text-white transition-all shadow-md" title="Buka File">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @endif
                                <a href="{{ route('admin.layanan.daftar-informasi.edit', $item->id) }}" class="w-10 h-10 bg-white text-[#004a99] rounded-xl flex items-center justify-center border-2 border-slate-200 hover:bg-[#004a99] hover:text-white transition-all shadow-md">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDeleteDIP('{{ $item->id }}')" class="w-10 h-10 bg-white text-red-600 rounded-xl flex items-center justify-center border-2 border-slate-200 hover:bg-red-600 hover:text-white transition-all shadow-md">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
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
    function confirmDeleteDIP(id) {
        document.getElementById('deleteDIPForm').action = `{{ url('admin/layanan/daftar-informasi') }}/${id}`;
        document.getElementById('deleteDIPModal').classList.remove('hidden');
    }
    function closeDeleteDIPModal() {
        document.getElementById('deleteDIPModal').classList.add('hidden');
    }
</script>
@endsection
