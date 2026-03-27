@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">🌐 Kelola Halaman Publik</h1>
            <p class="text-slate-300 mt-1">Kelola konten halaman publik PPID PKTJ</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
        </div>
    </div>

    <!-- ==================== PAGE CATEGORIES ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Dashboard Settings -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Dashboard</h3>
                        <p class="text-sm text-slate-400">Halaman utama</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Hero Section</p>
                        <p class="text-xs text-slate-400">Judul & subtitle</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Tema Warna</p>
                        <p class="text-xs text-slate-400">Warna primer & sekunder</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Video & Aplikasi</p>
                        <p class="text-xs text-slate-400">YouTube & links</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('dashboard.edit') }}" class="w-full block text-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
                    Edit Dashboard
                </a>
            </div>
        </div>

        <!-- Profil Pages -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Profil PPID</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\ProfilPpid::count() }} halaman</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $profilTypes = ['profil', 'tugas', 'visi', 'struktur', 'regulasi', 'kontak'];
                @endphp
                @foreach($profilTypes as $type)
                    @php
                        $item = App\Models\ProfilPpid::where('type', $type)->first();
                        $label = ucfirst($type);
                        if($type == 'profil') $label = 'Profil PPID';
                        if($type == 'tugas') $label = 'Tugas & Fungsi';
                        if($type == 'visi') $label = 'Visi & Misi';
                        if($type == 'struktur') $label = 'Struktur Organisasi';
                        if($type == 'regulasi') $label = 'Regulasi';
                        if($type == 'kontak') $label = 'Kontak';
                    @endphp
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white">{{ $label }}</p>
                            <p class="text-xs text-slate-400">{{ $item ? 'Sudah ada' : 'Belum ada' }}</p>
                        </div>
                        <a href="{{ route('admin.profil.edit', $type) }}" class="text-blue-600 hover:text-blue-300">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.profil.index') }}" class="w-full block text-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    Kelola Profil
                </a>
            </div>
        </div>

        <!-- Informasi Publik Pages -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Informasi Publik</h3>
                        <p class="text-sm text-slate-400">4 kategori</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Informasi Berkala</p>
                        <p class="text-xs text-slate-400">{{ App\Models\InformasiBerkala::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.berkala.index') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Informasi Serta Merta</p>
                        <p class="text-xs text-slate-400">{{ App\Models\InformasiSertaMerta::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.sertamerta') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Informasi Setiap Saat</p>
                        <p class="text-xs text-slate-400">{{ App\Models\InformasiSetiapSaat::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.setiapsaat') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Informasi Dikecualikan</p>
                        <p class="text-xs text-slate-400">{{ App\Models\InformasiDikecualikan::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.dikecualikan') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('content.index') }}" class="w-full block text-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                    Kelola Semua
                </a>
            </div>
        </div>

        <!-- Layanan Informasi Pages -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Layanan Informasi</h3>
                        <p class="text-sm text-slate-400">Form & Laporan</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Daftar Informasi</p>
                        <p class="text-xs text-slate-400">Daftar Informasi Publik</p>
                    </div>
                    <a href="{{ route('admin.layanan.daftar-informasi') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Maklumat Pelayanan</p>
                        <p class="text-xs text-slate-400">Info Layanan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'maklumat-pelayanan') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Laporan Layanan</p>
                        <p class="text-xs text-slate-400">Info Laporan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-layanan') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Laporan Akses</p>
                        <p class="text-xs text-slate-400">Info Akses</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-akses') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Laporan Survey</p>
                        <p class="text-xs text-slate-400">Survey Kepuasan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-survey') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.profil.edit', 'layanan-daftar') }}" class="w-full block text-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                    Kelola Daftar Informasi
                </a>
            </div>
        </div>

        <!-- Prosedur Pages -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Prosedur SOP</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\Prosedur::count() }} file</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $prosedurCategories = ['permintaan', 'keberatan', 'sengketa', 'penetapan', 'pengujian', 'pendokumentasian'];
                @endphp
                @foreach($prosedurCategories as $category)
                    @php
                        $count = App\Models\Prosedur::where('kategori', $category)->count();
                        $label = ucfirst($category);
                        if($category == 'permintaan') $label = 'SOP Permintaan';
                        if($category == 'keberatan') $label = 'SOP Keberatan';
                        if($category == 'sengketa') $label = 'SOP Sengketa';
                        if($category == 'penetapan') $label = 'SOP Penetapan';
                        if($category == 'pengujian') $label = 'SOP Pengujian';
                        if($category == 'pendokumentasian') $label = 'SOP Pendokumentasian';
                    @endphp
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white">{{ $label }}</p>
                            <p class="text-xs text-slate-400">{{ $count }} file</p>
                        </div>
                        <a href="{{ route('admin.profil.edit', 'sop-' . $category) }}" class="text-blue-600 hover:text-blue-300">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="w-full block text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Kelola Prosedur
                </a>
            </div>
        </div>

        <!-- FAQ Page -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">FAQ</h3>
                        <p class="text-sm text-slate-400">{{ App\Models\Faq::count() }} pertanyaan</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $faqs = App\Models\Faq::latest()->take(3)->get();
                @endphp
                @forelse($faqs as $faq)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white truncate">{{ $faq->pertanyaan }}</p>
                            <p class="text-xs text-slate-400">{{ Str::limit($faq->jawaban, 50) }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.faq.edit', $faq) }}" class="text-blue-600 hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('faq', {{ $faq->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada FAQ</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.faq.index') }}" class="w-full block text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Kelola FAQ
                </a>
            </div>
        </div>

        <!-- Permohonan Page -->
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Permohonan</h3>
                        <p class="text-sm text-slate-400">Form & Daftar</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Form Permohonan</p>
                        <p class="text-xs text-slate-400">Form builder</p>
                    </div>
                    <a href="{{ route('admin.permohonan.form') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white">Daftar Permohonan</p>
                        <p class="text-xs text-slate-400">List permohonan</p>
                    </div>
                    <a href="{{ route('admin.permohonan.index') }}" class="text-blue-600 hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.permohonan.index') }}" class="w-full block text-center px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
                    Kelola Permohonan
                </a>
            </div>
        </div>

    </div>

    <!-- ==================== STATISTICS SECTION ==================== -->
    <div class="mt-8 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <h2 class="text-xl font-semibold text-white mb-6">📊 Statistik Halaman</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600">{{ App\Models\ProfilPpid::count() }}</div>
                <div class="text-sm text-slate-300">Halaman Profil</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-yellow-600">
                    {{ App\Models\InformasiBerkala::count() + App\Models\InformasiSertaMerta::count() + App\Models\InformasiSetiapSaat::count() + App\Models\InformasiDikecualikan::count() }}
                </div>
                <div class="text-sm text-slate-300">File Informasi</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">{{ App\Models\Prosedur::count() }}</div>
                <div class="text-sm text-slate-300">File Prosedur</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-indigo-600">{{ App\Models\Faq::count() }}</div>
                <div class="text-sm text-slate-300">Pertanyaan FAQ</div>
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
