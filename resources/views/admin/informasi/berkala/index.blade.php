@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Informasi Berkala: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Informasi <span class="text-[#ffc107]">Berkala</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola daftar dokumen yang disediakan secara rutin kepada publik.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ url('/informasi/berkala') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <a href="{{ route('admin.informasi.berkala.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-green-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- 1. SECTION PROFIL PEJABAT PUBLIK & LHKPN (SLIDE 25 KEMENHUB) -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden mb-10">
            <div class="p-8 md:p-10 border-b-2 border-slate-50 flex flex-col md:flex-row items-center justify-between gap-6 bg-gradient-to-r from-blue-50/50 via-white to-amber-50/30">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-[10px] font-black uppercase tracking-wider">
                        <i class="fas fa-certificate text-amber-600"></i> Standar PPID Kemenhub: Slide 25
                    </div>
                    <h3 class="text-2xl font-black text-[#004a99] tracking-tight">1. Profil Pejabat Publik & LHKPN PKTJ</h3>
                    <p class="text-slate-500 font-medium text-xs">Kelola pas foto, teks biografi, riwayat pendidikan/karir, dan link LHKPN jajaran Pimpinan PKTJ.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pejabat.create') }}" class="px-6 py-3 bg-[#004a99] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-md hover:bg-[#003875] transition-all flex items-center">
                        <i class="fas fa-user-plus mr-2"></i> Tambah Pejabat
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[#004a99] font-black text-[11px] uppercase tracking-widest">
                            <th class="py-4 px-5 text-center w-16">No</th>
                            <th class="py-4 px-5 text-center w-36">Pas Foto</th>
                            <th class="py-4 px-5">Nama Lengkap</th>
                            <th class="py-4 px-5">Jabatan Struktural</th>
                            <th class="py-4 px-5 hidden md:table-cell">Riwayat Singkat</th>
                            <th class="py-4 px-5">LHKPN</th>
                            <th class="py-4 px-5 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pejabats as $p)
                        <tr class="hover:bg-blue-50/20 transition-all text-xs">
                            <td class="py-4 px-5 text-center font-black text-slate-400">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 rounded-lg text-slate-700 font-bold text-xs">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-center">
                                @if($p->foto)
                                    <img src="{{ asset($p->foto) }}" alt="{{ $p->nama }}" class="object-cover shadow-md border-2 border-white mx-auto transition-all" style="height: 120px; width: auto; max-width: 110px; object-position: {{ $p->foto_position ?? 'top center' }}; border-radius: {{ $p->foto_radius ?? '14px' }};">
                                    <span class="inline-block text-[9.5px] font-mono text-slate-400 mt-1 font-bold">{{ $p->foto_width ?? 160 }}x{{ $p->foto_height ?? 240 }} px</span>
                                @else
                                    <div class="bg-slate-100 flex items-center justify-center text-slate-400 mx-auto border border-slate-200" style="height: 120px; width: 80px; border-radius: {{ $p->foto_radius ?? '14px' }};">
                                        <i class="fas fa-user-tie fa-2x opacity-40"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <h4 class="font-bold text-slate-900 text-sm">{{ $p->nama }}</h4>
                                <span class="inline-block text-[11px] text-slate-500 mt-0.5">{{ $p->tempat_tanggal_lahir ?? 'PKTJ Tegal' }}</span>
                            </td>
                            <td class="py-4 px-5">
                                <span class="inline-block px-2.5 py-1 bg-blue-50 text-[#004a99] font-bold text-[11px] rounded-lg border border-blue-100">
                                    {{ $p->jabatan }}
                                </span>
                            </td>
                            <td class="py-4 px-5 hidden md:table-cell text-slate-500 max-w-xs">
                                <p class="line-clamp-2 italic text-[11px]">{{ $p->biografi ?? 'Belum ada biografi singkat.' }}</p>
                            </td>
                            <td class="py-4 px-5">
                                @if($p->lhkpn_link || $p->lhkpn_file)
                                    <a href="{{ $p->lhkpn_link ?? asset($p->lhkpn_file) }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 font-bold text-[11px] rounded-lg hover:bg-emerald-100 transition-all">
                                        <i class="fas fa-file-invoice-dollar"></i> LHKPN ({{ $p->lhkpn_tahun ?? '2025/2026' }})
                                    </a>
                                @else
                                    <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-400 font-bold text-[10px] rounded-lg">Belum Ada</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.pejabat.edit', $p->id) }}" class="p-2 bg-blue-50 text-[#004a99] rounded-lg hover:bg-[#004a99] hover:text-white transition-all shadow-sm" title="Edit Data & Ukuran Foto">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pejabat.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pejabat ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition-all shadow-sm" title="Hapus Pejabat">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400 font-medium text-xs">
                                Belum ada data pejabat publik.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. SECTION DOKUMEN & INFORMASI BERKALA LAINNYA -->
        <div class="p-4 md:p-6 bg-slate-50 rounded-2xl border border-slate-200 mb-4 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black text-[#004a99] tracking-tight">2. Daftar Dokumen & Informasi Berkala Lainnya</h3>
                <p class="text-slate-500 font-medium text-xs">LAKIP, DIPA, SOP, Laporan Keuangan, dan Dokumen Berkala Resmi PKTJ.</p>
            </div>
            <a href="{{ route('admin.informasi.berkala.create') }}" class="px-5 py-2.5 bg-[#004a99] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow hover:bg-[#003875] transition-all flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Dokumen Berkala
            </a>
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#004a99] text-white">
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Informasi / Dokumen</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest hidden lg:table-cell">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors group {{ !$item->file_path ? 'bg-red-50/30' : '' }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 {{ $item->file_path ? 'bg-blue-50 text-[#004a99]' : 'bg-red-50 text-red-400' }} rounded-xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                                        <i class="fas {{ $item->file_path ? 'fa-file-pdf' : 'fa-exclamation-triangle' }}"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $item->judul }}</h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            @if($item->file_path)
                                                <span class="inline-flex items-center px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-[9px] font-black uppercase">
                                                    <i class="fas fa-check-circle mr-1"></i> Ada Dokumen
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 bg-red-100 text-red-600 rounded-full text-[9px] font-black uppercase">
                                                    <i class="fas fa-times-circle mr-1"></i> Belum Ada Link/File
                                                </span>
                                            @endif
                                            <span class="text-[10px] text-gray-400 font-bold uppercase">
                                                <i class="fas fa-calendar-day mr-1"></i> {{ $item->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                @if(!$item->file_path)
                                    <div class="flex items-center gap-2 p-2 bg-red-50 border border-red-200 rounded-xl">
                                        <i class="fas fa-exclamation-circle text-red-400 text-sm"></i>
                                        <p class="text-[11px] text-red-500 font-bold">Klik Edit untuk menambahkan Link Google Drive atau Upload File agar tombol "Lihat Dokumen" muncul di halaman publik.</p>
                                    </div>
                                @else
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 max-w-xs italic font-medium">
                                        {{ $item->deskripsi ? strip_tags($item->deskripsi) : 'Tidak ada deskripsi singkat.' }}
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->aktif)
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2 animate-pulse"></span> AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black uppercase">
                                        DRAFT
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="showDetail('{{ $item->judul }}', '{{ addslashes($item->deskripsi) }}')" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-600 hover:text-white transition-all shadow-sm" title="Lihat Deskripsi">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    @if($item->file_path)
                                    <button type="button" 
                                            class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all shadow-sm" 
                                            title="Pratinjau File"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#previewModal" 
                                            data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? 1 : 0]) }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                    @else
                                    <a href="{{ route('admin.informasi.berkala.edit', $item->id) }}" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Tambah Link/File Dokumen">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.informasi.berkala.edit', $item->id) }}" class="p-2 bg-blue-50 text-[#004a99] rounded-lg hover:bg-[#004a99] hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('{{ $item->id }}')" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-gray-200 text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest">Belum Ada Data</h3>
                                    <p class="text-gray-400 text-sm mt-1">Silahkan tambahkan informasi berkala pertama Anda</p>
                                    <a href="{{ route('admin.informasi.berkala.create') }}" class="mt-6 px-6 py-2 bg-[#004a99] text-white font-bold rounded-xl text-xs uppercase tracking-widest">Tambah Data</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- DETAIL MODAL -->
<div id="detailModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] shadow-2xl p-10 max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col transform scale-95 transition-transform duration-300">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 id="detailTitle" class="text-2xl font-black text-[#004a99] uppercase truncate pr-8">Detail Informasi</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-red-500 transition-colors text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="detailContent" class="flex-1 overflow-y-auto prose max-w-none text-gray-700 p-2">
            <!-- Content filled by JS -->
        </div>
        <div class="mt-8 pt-6 border-t flex justify-end">
            <button onclick="closeDetailModal()" class="px-8 py-3 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-black transition-all">Tutup</button>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg shadow-red-500/10">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-black text-[#004a99] uppercase mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-sm mb-8 font-medium">Apakah Anda yakin ingin menghapus informasi ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 py-3 bg-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-200 transition-all">Batal</button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/20">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(title, content) {
        const modal = document.getElementById('detailModal');
        document.getElementById('detailTitle').innerText = title;
        document.getElementById('detailContent').innerHTML = content;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/informasi/berkala/${id}`;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }
</script>
@endsection
