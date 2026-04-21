@php
    if(!isset($settings)) {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    }
@endphp

<footer class="mt-5 pt-5 pb-4" style="background-color: #1a1c2e; color: #cbd5e1;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ" style="height: 50px; margin-right: 15px;">
                    <h5 class="fw-bold mb-0 text-white">PPID PKTJ</h5>
                </div>
                <p class="small opacity-75">
                    {{ $settings['deskripsi'] ?? 'Pejabat Pengelola Informasi dan Dokumentasi (PPID) Politeknik Keselamatan Transportasi Jalan (PKTJ) berkomitmen memberikan layanan informasi publik yang transparan dan akuntabel.' }}
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $settings['youtube_link'] ?? '#' }}" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h6 class="fw-bold text-white mb-4">Akses Cepat</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/" class="text-decoration-none text-reset opacity-75">Beranda</a></li>
                    <li class="mb-2"><a href="/profil-ppid.html" class="text-decoration-none text-reset opacity-75">Profil PPID</a></li>
                    <li class="mb-2"><a href="/informasi-publik/berkala" class="text-decoration-none text-reset opacity-75">Informasi Publik</a></li>
                    <li class="mb-2"><a href="/prosedur/sop-permintaan-informasi" class="text-decoration-none text-reset opacity-75">Prosedur SOP</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold text-white mb-4">Layanan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/layanan-informasi/maklumat" class="text-decoration-none text-reset opacity-75">Maklumat Pelayanan</a></li>
                    <li class="mb-2"><a href="/layanan-informasi/laporan" class="text-decoration-none text-reset opacity-75">Laporan Tahunan</a></li>
                    <li class="mb-2"><a href="/faq" class="text-decoration-none text-reset opacity-75">FAQ</a></li>
                    <li class="mb-2"><a href="/permohonan-informasi" class="text-decoration-none text-reset opacity-75">Permohonan Informasi</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold text-white mb-4">Hubungi Kami</h6>
                <ul class="list-unstyled small opacity-75">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-warning"></i>
                        <span>{{ $settings['kontak_alamat'] ?? 'Jl. Semeru No.3, Tegal, Jawa Tengah 52131' }}</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-phone me-3 text-warning"></i>
                        <span>{{ $settings['kontak_telepon'] ?? '(0283) 351061' }}</span>
                    </li>
                    <li class="mb-0 d-flex align-items-center">
                        <i class="fas fa-envelope me-3 text-warning"></i>
                        <span>{{ $settings['kontak_email'] ?? 'ppid@pktj.ac.id' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0 opacity-50">&copy; {{ date('Y') }} PPID PKTJ. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <p class="small mb-0 opacity-50">Standardized by Antigravity AI</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-opacity-100:hover { opacity: 1 !important; transform: translateY(-2px); }
    .transition { transition: all 0.3s ease; }
    footer a:hover { color: var(--secondary-gold) !important; opacity: 1 !important; }
</style>
