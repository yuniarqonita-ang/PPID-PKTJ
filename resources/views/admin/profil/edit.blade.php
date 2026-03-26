@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
* { font-family: 'Inter', sans-serif; }

.edit-page { padding: 24px; background: #f0f4ff; min-height:100vh; }
.card-glass { background:#fff; border-radius:20px; border:1px solid #e2e8f0; box-shadow:0 4px 24px rgba(102,126,234,.10); overflow:hidden; margin-bottom:24px; }

/* Header */
.page-header { background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); padding:28px 32px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; }
.page-header h1 { color:#fff; font-size:21px; font-weight:800; margin:0; display:flex; align-items:center; gap:10px; }
.page-header p { color:rgba(255,255,255,.8); margin:4px 0 0; font-size:13px; }
.btn-back  { display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:11px;font-weight:600;font-size:13px;text-decoration:none;transition:all .2s;background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.35); }
.btn-back:hover { background:rgba(255,255,255,.35);transform:translateY(-1px);color:#fff; }
.btn-view-pub { display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:11px;font-weight:600;font-size:13px;text-decoration:none;transition:all .2s;background:#10b981;color:#fff; }
.btn-view-pub:hover { background:#059669;transform:translateY(-1px);color:#fff; }

/* Alert */
.alert-err { background:linear-gradient(135deg,#fff5f5,#ffe0e0);border:1.5px solid #fc8181;border-radius:14px;padding:18px;margin-bottom:20px;display:flex;align-items:flex-start;gap:14px; }
.alert-ok  { background:linear-gradient(135deg,#f0fff4,#dcfce7);border:1.5px solid #6ee7b7;border-radius:14px;padding:18px;margin-bottom:20px;display:flex;align-items:center;gap:14px; }
.al-icon { width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:16px;color:#fff; }

/* Sections */
.sec-badge { display:flex;align-items:center;gap:12px;margin-bottom:18px; }
.sec-badge .ib { width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff; }
.sec-badge .st { font-size:17px;font-weight:700;color:#1e293b; }
.sec-badge .ss { font-size:12px;color:#64748b; }

/* Form */
.form-card { background:linear-gradient(135deg,#f8faff,#eef2ff);border:1.5px solid #e0e7ff;border-radius:16px;padding:24px;margin-bottom:20px; }
.flabel { display:flex;align-items:center;gap:10px;font-weight:700;font-size:14px;color:#334155;margin-bottom:10px; }
.flabel .li { width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;color:#fff; }
.finput { width:100%;padding:14px 18px;font-size:14px;color:#1e293b;border:2px solid #e2e8f0;border-radius:12px;background:#fff;transition:border-color .25s,box-shadow .25s;outline:none;box-sizing:border-box; }
.finput:focus { border-color:#667eea;box-shadow:0 0 0 4px rgba(102,126,234,.12); }

/* TinyMCE wrapper */
.tox-tinymce { border-radius:14px !important; border:2px solid #e0e7ff !important; box-shadow:0 2px 16px rgba(102,126,234,.08) !important; }
.tox .tox-toolbar__primary { background:linear-gradient(135deg,#667eea,#764ba2) !important; }
.tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary { background:linear-gradient(135deg,#667eea,#764ba2) !important; border-bottom:none !important; }
.tox .tox-tbtn { background:rgba(255,255,255,.9) !important; border-radius:7px !important; color:#374151 !important; margin:2px !important; border:none !important; }
.tox .tox-tbtn:hover { background:#fff !important; color:#667eea !important; }
.tox .tox-tbtn svg { fill:#374151 !important; }
.tox .tox-tbtn:hover svg { fill:#667eea !important; }
.tox .tox-tbtn--enabled, .tox .tox-tbtn--enabled:hover { background:#fff !important; color:#667eea !important; }
.tox .tox-tbtn--enabled svg, .tox .tox-tbtn--enabled:hover svg { fill:#667eea !important; }
.tox-statusbar { border-top:1px solid #e2e8f0 !important; background:#f8fafc !important; }

/* Section item */
.section-item { background:linear-gradient(135deg,#fdf4ff,#f3e8ff);border:1.5px solid #e9d5ff;border-radius:18px;padding:24px; }
.sn { width:32px;height:32px;border-radius:10px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);color:#fff;font-weight:700;font-size:14px;display:inline-flex;align-items:center;justify-content:center;margin-right:10px; }
.btn-rm { display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:10px;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:all .2s;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff; }
.btn-rm:hover { transform:translateY(-1px);box-shadow:0 4px 12px rgba(239,68,68,.3); }
.btn-add { display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:12px;font-size:14px;font-weight:700;border:none;cursor:pointer;transition:all .2s;background:linear-gradient(135deg,#10b981,#059669);color:#fff; }
.btn-add:hover { transform:translateY(-2px);box-shadow:0 6px 16px rgba(16,185,129,.35); }

/* Info item */
.info-item { background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:16px; display:flex; align-items:center; gap:16px; }
.info-icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; color:#fff; }

/* Action bar */
.action-bar { background:linear-gradient(135deg,#f8faff,#eef2ff);border-top:1.5px solid #e0e7ff;padding:20px 32px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px; }
.btn-cancel { display:inline-flex;align-items:center;gap:7px;padding:12px 24px;border-radius:12px;font-size:14px;font-weight:700;border:2px solid #cbd5e1;background:#fff;color:#64748b;text-decoration:none;cursor:pointer;transition:all .2s; }
.btn-cancel:hover { border-color:#94a3b8;color:#475569;transform:translateY(-1px); }
.btn-save { display:inline-flex;align-items:center;gap:7px;padding:12px 28px;border-radius:12px;font-size:14px;font-weight:700;border:none;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;cursor:pointer;transition:all .2s;box-shadow:0 4px 14px rgba(102,126,234,.35); }
.btn-save:hover { transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.5); }

/* Grid */
.g2 { display:grid;grid-template-columns:1fr 1fr;gap:20px; }
.c2 { grid-column:span 2; }
@media(max-width:768px){ .g2{grid-template-columns:1fr;} .c2{grid-column:span 1;} }
</style>

<div class="edit-page">

{{-- HEADER --}}
<div class="card-glass">
    <div class="page-header">
        <div>
            <h1><i class="fas fa-edit"></i>
                Edit {{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Tanggung Jawab' : ($type==='visi' ? 'Visi dan Misi PPID' : ($type==='struktur' ? 'Struktur Organisasi' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}
            </h1>
            <p>Kelola konten yang tampil di halaman publik</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('admin.profil.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a href="{{ url('/profil/ppid') }}" target="_blank" class="btn-view-pub"><i class="fas fa-external-link-alt"></i> Lihat Publik</a>
        </div>
    </div>
</div>

{{-- ALERTS --}}
@if($errors->any())
<div class="alert-err">
    <span class="al-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);"><i class="fas fa-exclamation-triangle"></i></span>
    <div>
        <div style="font-weight:700;color:#9b1c1c;margin-bottom:5px;">Ada kesalahan yang perlu diperbaiki:</div>
        <ul style="margin:0;padding-left:18px;color:#9b1c1c;font-size:13px;">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
    </div>
</div>
@endif
@if(session('success'))
<div class="alert-ok">
    <span class="al-icon" style="background:linear-gradient(135deg,#10b981,#059669);"><i class="fas fa-check"></i></span>
    <div style="font-weight:600;color:#065f46;">{{ session('success') }}</div>
</div>
@endif

<form id="edit-form" action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- HERO SECTION --}}
<div class="card-glass">
    <div style="padding:28px 32px;">
        <div class="sec-badge">
            <div class="ib" style="background:linear-gradient(135deg,#1e293b,#0f172a);"><i class="fas fa-star"></i></div>
            <div><div class="st">Hero Section</div><div class="ss">Tampilan banner di bagian atas halaman</div></div>
        </div>
        
        <div class="form-card">
            <div class="g2">
                <div class="c2">
                    <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i class="fas fa-heading"></i></span> Tagline Hero</label>
                    <input type="text" name="tagline_hero" class="finput" value="{{ old('tagline_hero', $profil->tagline_hero) }}" placeholder="Contoh: Terwujudnya layanan informasi yang transparan...">
                </div>
                <div>
                    <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#a855f7,#9333ea);"><i class="fas fa-image"></i></span> Background Hero</label>
                    <input type="file" name="image_hero" accept="image/*" class="finput" style="padding:10px 14px;">
                    @if($profil->image_hero)
                    <div style="margin-top:10px;display:flex;align-items:center;gap:12px;">
                        <img src="{{ asset('storage/profil/'.$profil->image_hero) }}" style="height:64px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.12);">
                        <span style="font-size:12px;color:#64748b;">Hero saat ini</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INFORMASI UTAMA --}}
<div class="card-glass">
<div style="padding:28px 32px;">

    <div class="sec-badge">
        <div class="ib" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i class="fas fa-info-circle"></i></div>
        <div><div class="st">Informasi Utama</div><div class="ss">Data dasar konten halaman</div></div>
    </div>

    <div class="form-card">
        <div class="g2">

            {{-- Judul --}}
            <div class="c2">
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i class="fas fa-heading"></i></span> Judul *</label>
                <input type="text" name="judul" class="finput" value="{{ old('judul',$profil->judul) }}" placeholder="Masukkan judul halaman…" required>
            </div>

            {{-- Konten Pembuka --}}
            <div class="c2">
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#6366f1,#4f46e5);"><i class="fas fa-align-left"></i></span> Konten Pembuka *</label>
                <textarea id="editor-konten_pembuka" name="konten_pembuka" style="width:100%;">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
            </div>

            {{-- Judul Sub --}}
            <div>
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#06b6d4,#0891b2);"><i class="fas fa-heading"></i></span> Judul Sub <span style="font-weight:400;color:#94a3b8;margin-left:4px;">(Opsional)</span></label>
                <input type="text" name="judul_sub" class="finput" value="{{ old('judul_sub',$profil->judul_sub) }}" placeholder="Masukkan judul sub…">
            </div>

            {{-- Link Dokumen --}}
            <div>
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#f43f5e,#e11d48);"><i class="fas fa-link"></i></span> Link Dokumen <span style="font-weight:400;color:#94a3b8;margin-left:4px;">(Opsional)</span></label>
                <input type="url" name="link_dokumen" class="finput" value="{{ old('link_dokumen',$profil->link_dokumen) }}" placeholder="https://…">
            </div>

            {{-- Konten Detail --}}
            <div class="c2">
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#14b8a6,#0d9488);"><i class="fas fa-align-justify"></i></span> Konten Detail <span style="font-weight:400;color:#94a3b8;margin-left:4px;">(Opsional)</span></label>
                <textarea id="editor-konten_detail" name="konten_detail" style="width:100%;">{!! old('konten_detail',$profil->konten_detail) !!}</textarea>
            </div>

            {{-- Gambaran Singkat --}}
            <div class="c2">
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#f59e0b,#d97706);"><i class="fas fa-file-alt"></i></span> Gambaran Singkat <span style="font-weight:400;color:#94a3b8;margin-left:4px;">(Kotak ke-2 di halaman publik)</span></label>
                <textarea id="editor-gambaran" name="gambaran" style="width:100%;">{!! old('gambaran',$profil->gambaran) !!}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="c2">
                <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#a855f7,#9333ea);"><i class="fas fa-image"></i></span> Gambar <span style="font-weight:400;color:#94a3b8;margin-left:4px;">(Opsional)</span></label>
                <input type="file" name="gambar" accept="image/*" class="finput" style="padding:10px 14px;">
                @if($profil->gambar)
                <div style="margin-top:10px;display:flex;align-items:center;gap:12px;">
                    <img src="{{ asset('storage/profil/'.$profil->gambar) }}" style="height:64px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.12);">
                    <span style="font-size:12px;color:#64748b;">Gambar saat ini</span>
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- BAGIAN TAMBAHAN --}}
    <div style="border-top:1.5px solid #e2e8f0;padding-top:28px;margin-top:8px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
            <div class="sec-badge" style="margin:0;">
                <div class="ib" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);"><i class="fas fa-layer-group"></i></div>
                <div><div class="st">Bagian Konten Tambahan</div><div class="ss">Tambahkan bagian konten ekstra</div></div>
            </div>
            <button type="button" onclick="addSection()" class="btn-add"><i class="fas fa-plus"></i> Tambah Bagian</button>
        </div>
        <div id="sections-container" style="display:flex;flex-direction:column;gap:16px;">
            @if($profil->additional_sections)
                @foreach($profil->additional_sections as $index => $section)
                <div class="section-item" id="si-{{ $index }}">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;flex-wrap:wrap;gap:10px;">
                        <div style="display:flex;align-items:center;">
                            <span class="sn">{{ $index + 1 }}</span>
                            <span style="font-weight:700;font-size:16px;color:#4c1d95;">Bagian Tambahan {{ $index + 1 }}</span>
                        </div>
                        <button type="button" onclick="removeSection({{ $index }})" class="btn-rm"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                    <div style="margin-bottom:16px;">
                        <label class="flabel">Judul Bagian</label>
                        <input type="text" name="additional_title[]" class="finput" value="{{ $section['title'] ?? '' }}">
                    </div>
                    <div>
                        <label class="flabel">Konten Bagian</label>
                        <textarea id="editor-section-{{ $index }}" name="additional_content[]" class="section-editor">{!! $section['content'] ?? '' !!}</textarea>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

</div>

{{-- Action bar --}}
<div class="action-bar">
    <div style="font-size:13px;color:#64748b;display:flex;align-items:center;gap:6px;">
        <i class="fas fa-info-circle" style="color:#6366f1;"></i>
        Perubahan langsung tampil di publik setelah disimpan.
    </div>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('admin.profil.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
        <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
    </div>
</div>
</div>
</form>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
var TINYMCE_CONFIG = {
    license_key: 'gpl',
    height: 400,
    menubar: false,
    plugins: ['advlist','autolink','lists','link','image','charmap','code','table','wordcount'],
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | removeformat code',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; }'
};

document.addEventListener('DOMContentLoaded', function() {
    tinymce.init(Object.assign({}, TINYMCE_CONFIG, { selector: '#editor-konten_pembuka' }));
    tinymce.init(Object.assign({}, TINYMCE_CONFIG, { selector: '#editor-konten_detail' }));
    tinymce.init(Object.assign({}, TINYMCE_CONFIG, { selector: '#editor-gambaran' }));
    
    @if($profil->additional_sections)
        @foreach($profil->additional_sections as $index => $section)
            tinymce.init(Object.assign({}, TINYMCE_CONFIG, { selector: '#editor-section-{{ $index }}' }));
        @endforeach
    @endif
});

var sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

function addSection() {
    var idx = sectionCount;
    var html = `
        <div class="section-item" id="si-${idx}">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                <div style="display:flex;align-items:center;">
                    <span class="sn">${idx + 1}</span>
                    <span style="font-weight:700;">Bagian Tambahan ${idx + 1}</span>
                </div>
                <button type="button" onclick="removeSection(${idx})" class="btn-rm"><i class="fas fa-trash"></i> Hapus</button>
            </div>
            <div style="margin-bottom:16px;">
                <label class="flabel">Judul Bagian</label>
                <input type="text" name="additional_title[]" class="finput">
            </div>
            <div>
                <label class="flabel">Konten Bagian</label>
                <textarea id="editor-section-${idx}" name="additional_content[]"></textarea>
            </div>
        </div>`;
    
    document.getElementById('sections-container').insertAdjacentHTML('beforeend', html);
    tinymce.init(Object.assign({}, TINYMCE_CONFIG, { selector: '#editor-section-' + idx }));
    sectionCount++;
}

function removeSection(idx) {
    var ed = tinymce.get('editor-section-' + idx);
    if (ed) ed.remove();
    document.getElementById('si-' + idx).remove();
}
</script>
@endpush
