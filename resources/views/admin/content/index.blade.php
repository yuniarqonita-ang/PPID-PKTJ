@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">📂 Kelola Konten Publik</h1>
            <p class="text-slate-300 mt-1">Lihat dan kelola semua konten yang ditampilkan di halaman publik</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
        </div>
    </div>

    <!-- ==================== CONTENT CATEGORIES ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Informasi Berkala -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Informasi Berkala</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\InformasiBerkala::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $berkala = App\Models\InformasiBerkala::latest()->take(3)->get();
                @endphp
                @forelse($berkala as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->file_name }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.informasi-berkala.edit', $item->id) }}" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('informasi-berkala', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.informasi.berkala.index') }}" class="w-full block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Informasi Serta Merta -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Informasi Serta Merta</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\InformasiSertamerta::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $sertamerta = App\Models\InformasiSertamerta::latest()->take(3)->get();
                @endphp
                @forelse($sertamerta as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->file_name }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="#" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('informasi-sertamerta', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="#" class="w-full block text-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Informasi Setiap Saat -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Informasi Setiap Saat</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\InformasiSetiapsaat::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $setiapsaat = App\Models\InformasiSetiapsaat::latest()->take(3)->get();
                @endphp
                @forelse($setiapsaat as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->file_name }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="#" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('informasi-setiapsaat', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="#" class="w-full block text-center px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Informasi Dikecualikan -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Informasi Dikecualikan</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\InformasiDikecualikan::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $dikecualikan = App\Models\InformasiDikecualikan::latest()->take(3)->get();
                @endphp
                @forelse($dikecualikan as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->file_name }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="#" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('informasi-dikecualikan', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="#" class="w-full block text-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Prosedur -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Prosedur SOP</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\Prosedur::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $prosedur = App\Models\Prosedur::latest()->take(3)->get();
                @endphp
                @forelse($prosedur as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->kategori }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="#" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('prosedur', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="#" class="w-full block text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Profil PPID -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Profil PPID</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\Profil::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $profil = App\Models\Profil::latest()->take(3)->get();
                @endphp
                @forelse($profil as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $item->tipe }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.profil.edit', $item->tipe) }}" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.profil.index') }}" class="w-full block text-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- FAQ -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">FAQ</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\Faq::count() }} item</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $faq = App\Models\Faq::latest()->take(3)->get();
                @endphp
                @forelse($faq as $item)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $item->pertanyaan }}</p>
                            <p class="text-xs text-slate-400">{{ Str::limit($item->jawaban, 50) }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.faq.edit', $item->id) }}" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('faq', {{ $item->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.faq.index') }}" class="w-full block text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

    </div>

    <!-- ==================== STATISTICS SECTION ==================== -->
    <div class="mt-8 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <h2 class="text-xl font-semibold text-white mb-6">📊 Statistik Konten</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">{{ App\Models\InformasiBerkala::count() }}</div>
                <div class="text-sm text-slate-300">Informasi Berkala</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-yellow-600">{{ App\Models\InformasiSertamerta::count() }}</div>
                <div class="text-sm text-slate-300">Informasi Serta Merta</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-cyan-600">{{ App\Models\InformasiSetiapsaat::count() }}</div>
                <div class="text-sm text-slate-300">Informasi Setiap Saat</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-red-600">{{ App\Models\InformasiDikecualikan::count() }}</div>
                <div class="text-sm text-slate-300">Informasi Dikecualikan</div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-white mt-4">Hapus Konten</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-slate-400">Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="items-center px-4 py-3">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-slate-200 rounded-md hover:bg-gray-400 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(type, id) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    
    // Set form action
    let route = '';
    switch(type) {
        case 'informasi-berkala':
            route = '/admin/informasi-berkala/' + id;
            break;
        case 'informasi-sertamerta':
            route = '/admin/informasi-sertamerta/' + id;
            break;
        case 'informasi-setiapsaat':
            route = '/admin/informasi-setiapsaat/' + id;
            break;
        case 'informasi-dikecualikan':
            route = '/admin/informasi-dikecualikan/' + id;
            break;
        case 'prosedur':
            route = '/admin/prosedur/' + id;
            break;
        case 'faq':
            route = '/admin/faq/' + id;
            break;
    }
    
    form.action = route;
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection
