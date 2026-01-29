<x-app-layout>
    <div class="container-fluid px-4 py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 shadow-sm rounded-xl border">
            <div>
                <h4 class="fw-bold m-0 text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h4>
                <small class="text-gray-500">Update Terakhir: {{ $last_update }}</small>
            </div>
            
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm fw-bold px-4 rounded-pill shadow-sm">
                    KELUAR (LOGOUT)
                </button>
            </form>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-primary text-white">
                    <small class="text-uppercase fw-bold opacity-75">Total Berita</small>
                    <h2 class="fw-bold m-0">{{ $totalBerita }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-success text-white">
                    <small class="text-uppercase fw-bold opacity-75">Dokumen Publik</small>
                    <h2 class="fw-bold m-0">{{ $totalDokumen }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-warning text-dark">
                    <small class="text-uppercase fw-bold opacity-75">User Terdaftar</small>
                    <h2 class="fw-bold m-0">{{ $totalUser }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-info text-white">
                    <small class="text-uppercase fw-bold opacity-75">Total FAQ</small>
                    <h2 class="fw-bold m-0">{{ $totalFaq }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-xl mb-4 border">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h6 class="fw-bold text-gray-700 m-0 text-uppercase">Publikasi Artikel Terkini</h6>
                    </div>
                    <div class="card-body p-5 text-center text-gray-400 italic font-medium">
                        @if($totalBerita > 0)
                            <p class="text-gray-700 not-italic">Sistem mendeteksi {{ $totalBerita }} artikel telah dipublikasikan.</p>
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm mt-2">Kelola Berita</a>
                        @else
                            Belum ada konten berita.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                <div class="card border-0 shadow-sm rounded-xl p-4 mb-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2">📂</span> MENU PROFIL PPID
                    </h6>
                    <div class="d-flex flex-wrap gap-2 text-sm text-gray-600">
                        <a href="{{ route('admin.profil.edit') }}" class="text-decoration-none hover:text-blue-600">● Profil</a>
                        <a href="{{ route('admin.profil.tugas') }}" class="text-decoration-none hover:text-blue-600">● Tugas</a>
                        <a href="{{ route('admin.profil.visi') }}" class="text-decoration-none hover:text-blue-600">● Visi Misi</a>
                        <a href="{{ route('admin.profil.struktur') }}" class="text-decoration-none hover:text-blue-600">● Struktur</a>
                        <a href="{{ route('admin.profil.regulasi') }}" class="text-decoration-none hover:text-blue-600">● Regulasi</a>
                        <a href="{{ route('admin.profil.kontak') }}" class="text-decoration-none hover:text-blue-600">● Kontak</a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-xl p-4 mb-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2 text-primary">📊</span> INFORMASI PUBLIK
                    </h6>
                    <div class="d-flex flex-wrap gap-2 text-sm text-gray-600">
                        <a href="{{ route('admin.informasi.berkala') }}" class="text-decoration-none">● Berkala</a>
                        <a href="{{ route('admin.informasi.sertamerta') }}" class="text-decoration-none">● Serta Merta</a>
                        <a href="{{ route('admin.informasi.setiapsaat') }}" class="text-decoration-none">● Setiap Saat</a>
                        <a href="{{ route('admin.informasi.dikecualikan') }}" class="text-decoration-none">● Dikecualikan</a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-xl p-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2 text-secondary">🔗</span> LAYANAN TERKAIT
                    </h6>
                    <div class="d-flex gap-3 text-xs fw-bold text-gray-500 text-uppercase">
                        <a href="{{ route('admin.lpse.index') }}" class="text-decoration-none text-primary">Data LPSE</a>
                        <a href="{{ route('admin.jdih.index') }}" class="text-decoration-none text-primary">JDIH</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>