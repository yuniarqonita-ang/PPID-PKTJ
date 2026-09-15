{{-- 
  Komponen Tampilan Link Dokumen ATM BPSDM (Amati, Tiru, Modifikasi)
  Sesuai Standar Tautan Portal PPID BPSDM Kemenhub
--}}
@props([
    'links' => [],
    'catatan' => null,
    'judul' => '',
])

@php
    $validLinks = [];
    if (!empty($links) && is_array($links)) {
        foreach ($links as $lnk) {
            $u = trim($lnk['url'] ?? '');
            $n = trim($lnk['nama'] ?? '');
            if (!empty($u) && !in_array(strtolower($u), ['#', '-', 'null', 'none', 'javascript:void(0)'])) {
                $validLinks[] = [
                    'nama' => !empty($n) ? $n : 'Lihat Dokumen',
                    'url'  => $u,
                    'is_external' => (str_starts_with($u, 'http://') || str_starts_with($u, 'https://')) && !str_contains($u, 'drive.google.com') && !str_contains($u, 'docs.google.com') && !str_ends_with(strtolower($u), '.pdf')
                ];
            }
        }
    }
    $total = count($validLinks);
@endphp

<div class="bpsdm-link-wrapper d-inline-flex flex-column align-items-center justify-content-center w-100 py-1" style="max-width: 260px; margin: 0 auto;">
    @if($total >= 2)
        {{-- KASUS 1: MULTI DOKUMEN (2 ATAU LEBIH) - FOLDER CONTAINER ALA BPSDM --}}
        <div class="bpsdm-folder-box w-100 text-start">
            <div class="bpsdm-folder-badge d-inline-flex align-items-center gap-1 mb-1 px-2 py-0.5 rounded text-[11px] fw-bold">
                <i class="fas fa-folder-open text-warning" style="font-size: 11px;"></i>
                <span>📁 {{ $total }} Dokumen</span>
            </div>
            <div class="bpsdm-scroll-list rounded-3 border p-1.5 shadow-2xs" style="max-height: 180px; overflow-y: auto; background: #f8fafc;">
                @foreach($validLinks as $item)
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer" 
                       class="bpsdm-doc-item d-flex align-items-center gap-1.5 px-2 py-1 rounded text-decoration-none mb-1 transition-all"
                       title="{{ $item['nama'] }} ({{ $item['url'] }})">
                        @if($item['is_external'])
                            <i class="fas fa-globe text-emerald-600 flex-shrink-0" style="color: #059669; font-size: 11px;"></i>
                        @else
                            <i class="fas fa-file-alt text-primary flex-shrink-0" style="color: #004a99; font-size: 11px;"></i>
                        @endif
                        <span class="text-truncate fw-semibold text-dark" style="font-size: 11.5px; line-height: 1.3;">
                            {{ $item['nama'] }}
                        </span>
                        <i class="fas fa-arrow-up-right-from-square ms-auto text-muted opacity-50 flex-shrink-0" style="font-size: 9px;"></i>
                    </a>
                @endforeach
            </div>
        </div>

    @elseif($total === 1)
        {{-- KASUS 2: SINGLE LINK DOKUMEN ATAU WEB EKSTERNAL --}}
        @php $single = $validLinks[0]; @endphp
        @if($single['is_external'])
            {{-- Tombol Gradien Hijau Emerald untuk Tautan Web Eksternal (ala BPSDM) --}}
            <a href="{{ $single['url'] }}" target="_blank" rel="noopener noreferrer"
               class="bpsdm-pill-btn bpsdm-pill-green d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-1.5 rounded-pill text-decoration-none text-white fw-bold shadow-xs transition-all"
               title="{{ $single['nama'] }} (Buka Portal Resmi)">
                <i class="fas fa-globe text-white" style="font-size: 11px;"></i>
                <span class="text-truncate" style="max-width: 170px; font-size: 11.5px;">{{ $single['nama'] }}</span>
                <i class="fas fa-external-link-alt ms-0.5" style="font-size: 9px; opacity: 0.85;"></i>
            </a>
        @else
            {{-- Tombol Gradien Biru-Indigo untuk Dokumen / Google Drive (ala BPSDM) --}}
            <a href="{{ $single['url'] }}" target="_blank" rel="noopener noreferrer"
               class="bpsdm-pill-btn bpsdm-pill-blue d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-1.5 rounded-pill text-decoration-none text-white fw-bold shadow-xs transition-all"
               title="{{ $single['nama'] }} (Buka / Unduh Dokumen)">
                <i class="fas fa-file-alt text-warning" style="font-size: 11px;"></i>
                <span class="text-truncate" style="max-width: 170px; font-size: 11.5px;">{{ $single['nama'] }}</span>
                <i class="fas fa-download ms-0.5" style="font-size: 9px; opacity: 0.85;"></i>
            </a>
        @endif

    @else
        {{-- KASUS 3: TIDAK ADA DOKUMEN / KOSONG - TOMBOL PERMOHONAN INFORMASI ALA BPSDM --}}
        <a href="{{ url('/layanan/permohonan-informasi') }}" 
           class="bpsdm-pill-btn bpsdm-pill-request d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-1.5 rounded-pill text-decoration-none text-white fw-bold shadow-xs transition-all"
           title="Ajukan Permohonan Informasi Publik Resmi">
            <i class="fas fa-phone-alt text-white" style="font-size: 10px;"></i>
            <span style="font-size: 11.5px; white-space: nowrap;">Permohonan Informasi</span>
        </a>
    @endif

    {{-- BADGE CATATAN TAMBAHAN (JIKA ADA) --}}
    @if(!empty($catatan))
        <div class="bpsdm-note-badge mt-1 text-center w-100">
            <span class="d-inline-flex align-items-center gap-1 px-2 py-0.5 rounded-pill text-[10.5px] fw-semibold" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; line-height: 1.3;" title="{{ $catatan }}">
                <i class="fas fa-info-circle text-warning flex-shrink-0" style="font-size: 10px;"></i>
                <span class="text-truncate" style="max-width: 200px;">{{ $catatan }}</span>
            </span>
        </div>
    @endif
</div>
