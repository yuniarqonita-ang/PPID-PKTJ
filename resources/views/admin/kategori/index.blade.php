<div class="space-y-8 animate-fade-in lg:px-8 pt-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Kategori: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Kelola <span class="text-[#ffc107]">Kategori</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Manajemen kategori konten untuk PPID PKTJ.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.kategori.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Tambah Kategori
                </a>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-400 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <table class="min-w-full divide-y divide-slate-700/50">
                        <thead class="bg-slate-900/80">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y divide-slate-700/50">
                            @forelse ($kategoris as $index => $kategori)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $kategoris->firstItem() + $index }}</td>
                                    <td class="px-6 py-4">{{ $kategori->nama }}</td>
                                    <td class="px-6 py-4">{{ $kategori->slug }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($kategori->deskripsi, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-slate-400">Belum ada kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
