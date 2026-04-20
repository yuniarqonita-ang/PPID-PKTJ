@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] drop-shadow-lg"><i class="fas fa-globe mr-2"></i>Kelola Halaman Publik</h1>
            <p class="text-gray-600 mt-1">Kelola konten halaman publik PPID PKTJ</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="http://ppid.pktj.ac.id" target="_blank" class="px-6 py-3 bg-emerald-600 text-white font-black hover:bg-emerald-700 transition rounded-xl shadow-lg flex items-center uppercase tracking-widest text-xs">
                <i class="fas fa-external-link-alt mr-2"></i>Lihat Portal Publik
            </a>
        </div>
    </div>

    <!-- ==================== PAGE CATEGORIES ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Dashboard Settings -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#004a99] to-blue-700 text-[#004a99] rounded-full flex items-center justify-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Dashboard</h3>
                        <p class="text-sm text-gray-500">Halaman utama</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Hero Section</p>
                        <p class="text-xs text-gray-500">Judul & subtitle</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Tema Warna</p>
                        <p class="text-xs text-gray-500">Warna primer & sekunder</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Video & Aplikasi</p>
                        <p class="text-xs text-gray-500">YouTube & links</p>
                    </div>
                    <a href="{{ route('dashboard.edit') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('dashboard.edit') }}" class="w-full block text-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30 text-[#004a99] rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
                    Edit Dashboard
                </a>
            </div>
        </div>

        <!-- Profil Pages -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Profil PPID</h3>
                        <p class="text-sm text-gray-500">{{ App\Models\ProfilPpid::count() }} halaman</p>
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
                    <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-[#004a99]">{{ $label }}</p>
                            <p class="text-xs text-gray-500">{{ $item ? 'Sudah ada' : 'Belum ada' }}</p>
                        </div>
                        <a href="{{ route('admin.profil.edit', $type) }}" class="text-[#004a99] hover:text-blue-300">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <p class="text-xs text-slate-500 mb-2 italic"><i class="fas fa-info-circle mr-1"></i> Klik ikon edit di atas untuk mengelola setiap bagian.</p>
                <div class="w-full flex items-center justify-center p-2 bg-purple-900/30 rounded-lg text-purple-300 text-sm font-medium border border-purple-500/30">
                    <i class="fas fa-check-circle mr-2"></i> Mode Kelola Aktif
                </div>
            </div>
        </div>

        <!-- Informasi Publik Pages -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Informasi Publik</h3>
                        <p class="text-sm text-gray-500">4 kategori</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Informasi Berkala</p>
                        <p class="text-xs text-gray-500">{{ App\Models\InformasiBerkala::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.berkala.index') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Informasi Serta Merta</p>
                        <p class="text-xs text-gray-500">{{ App\Models\InformasiSertaMerta::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.sertamerta') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Informasi Setiap Saat</p>
                        <p class="text-xs text-gray-500">{{ App\Models\InformasiSetiapSaat::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.setiapsaat') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Informasi Dikecualikan</p>
                        <p class="text-xs text-gray-500">{{ App\Models\InformasiDikecualikan::count() }} file</p>
                    </div>
                    <a href="{{ route('admin.informasi.dikecualikan') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('content.index') }}" class="w-full block text-center px-4 py-2 bg-amber-500 text-white font-black rounded-lg hover:bg-amber-600 transition uppercase tracking-widest text-xs">
                    Kelola Semua Data
                </a>
            </div>
        </div>

        <!-- Layanan Informasi Pages -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Layanan Informasi</h3>
                        <p class="text-sm text-gray-500">Form & Laporan</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Daftar Informasi</p>
                        <p class="text-xs text-gray-500">Daftar Informasi Publik</p>
                    </div>
                    <a href="{{ route('admin.layanan.daftar-informasi') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Maklumat Pelayanan</p>
                        <p class="text-xs text-gray-500">Info Layanan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'maklumat-pelayanan') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Laporan Layanan</p>
                        <p class="text-xs text-gray-500">Info Laporan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-layanan') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Laporan Akses</p>
                        <p class="text-xs text-gray-500">Info Akses</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-akses') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Laporan Survey</p>
                        <p class="text-xs text-gray-500">Survey Kepuasan</p>
                    </div>
                    <a href="{{ route('admin.profil.edit', 'laporan-survey') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.layanan.daftar-informasi') }}" class="w-full block text-center px-4 py-2 bg-orange-600 text-white font-black rounded-lg hover:bg-orange-700 transition uppercase tracking-widest text-xs">
                    Kelola Daftar Informasi (DIP)
                </a>
            </div>
        </div>

        <!-- Prosedur Pages -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Prosedur SOP</h3>
                        <p class="text-sm text-gray-500">{{ App\Models\Prosedur::count() }} file</p>
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
                    <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-[#004a99]">{{ $label }}</p>
                            <p class="text-xs text-gray-500">{{ $count }} file</p>
                        </div>
                        <a href="{{ route('admin.profil.edit', 'sop-' . $category) }}" class="text-[#004a99] hover:text-blue-300">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="w-full block text-center px-4 py-2 bg-emerald-600 text-white font-black rounded-lg hover:bg-emerald-700 transition uppercase tracking-widest text-xs">
                    Buka Modul Prosedur
                </a>
            </div>
        </div>

        <!-- FAQ Page -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">FAQ</h3>
                        <p class="text-sm text-gray-500">{{ App\Models\Faq::count() }} pertanyaan</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @php
                    $faqs = App\Models\Faq::latest()->take(3)->get();
                @endphp
                @forelse($faqs as $faq)
                    <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-[#004a99] truncate">{{ $faq->pertanyaan }}</p>
                            <p class="text-xs text-gray-500">{{ Str::limit($faq->jawaban, 50) }}</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.faq.edit', $faq) }}" class="text-[#004a99] hover:text-blue-300">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <button onclick="confirmDelete('faq', {{ $faq->id }})" class="text-red-600 hover:text-red-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada FAQ</p>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.faq.index') }}" class="w-full block text-center px-4 py-2 bg-indigo-600 text-[#004a99] rounded-lg hover:bg-indigo-700 transition">
                    Kelola FAQ
                </a>
            </div>
        </div>

        <!-- Permohonan Page -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#004a99]">Permohonan</h3>
                        <p class="text-sm text-gray-500">Form & Daftar</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Form Permohonan</p>
                        <p class="text-xs text-gray-500">Form builder</p>
                    </div>
                    <a href="{{ route('admin.permohonan.form') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                </div>
                <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-100 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[#004a99]">Daftar Permohonan</p>
                        <p class="text-xs text-gray-500">List permohonan</p>
                    </div>
                    <a href="{{ route('admin.permohonan.index') }}" class="text-[#004a99] hover:text-blue-300">
                        <i class="fas fa-list text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-600/30">
                <a href="{{ route('admin.permohonan.index') }}" class="w-full block text-center px-4 py-2 bg-cyan-600 text-[#004a99] rounded-lg hover:bg-cyan-700 transition">
                    Kelola Permohonan
                </a>
            </div>
        </div>

    </div>

    <!-- ==================== STATISTICS SECTION ==================== -->
    <div class="mt-8 bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
        <h2 class="text-xl font-semibold text-[#004a99] mb-6">📊 Statistik Halaman</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600">{{ App\Models\ProfilPpid::count() }}</div>
                <div class="text-sm text-gray-600">Halaman Profil</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-yellow-600">
                    {{ App\Models\InformasiBerkala::count() + App\Models\InformasiSertaMerta::count() + App\Models\InformasiSetiapSaat::count() + App\Models\InformasiDikecualikan::count() }}
                </div>
                <div class="text-sm text-gray-600">File Informasi</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">{{ App\Models\Prosedur::count() }}</div>
                <div class="text-sm text-gray-600">File Prosedur</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-indigo-600">{{ App\Models\Faq::count() }}</div>
                <div class="text-sm text-gray-600">Pertanyaan FAQ</div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-[#004a99] mt-4">Hapus Konten</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="items-center px-4 py-3">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-slate-200 rounded-md hover:bg-gray-400 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-[#004a99] rounded-md hover:bg-red-700">
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

