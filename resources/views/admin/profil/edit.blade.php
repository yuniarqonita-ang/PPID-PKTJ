@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
* { font-family: 'Inter', sans-serif; }

.edit-page { padding: 24px; background: transparent; min-height:100vh; }

.card-container { position: relative; margin-bottom: 32px; }
.card-glow { position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px; background: linear-gradient(to right, #ec4899, #8b5cf6, #3b82f6); border-radius: 22px; filter: blur(15px); opacity: 0.3; transition: opacity 0.5s ease; z-index: 0; }
.card-container:hover .card-glow { opacity: 0.7; transform: scale(1.01); transition: all 0.5s ease; }

.card-glass { position: relative; background: rgba(30, 41, 59, 0.85); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5); overflow: hidden; z-index: 10; }

/* Header */
.page-header { background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.9) 100%); padding: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; position: relative; border-bottom: 1px solid rgba(255,255,255,0.05); }
.page-header h1 { color: #fff; font-size: 26px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 12px; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }
.page-header h1 i { color: #38bdf8; text-shadow: 0 0 15px rgba(56,189,248,0.5); }
.page-header p { color: #cbd5e1; margin: 6px 0 0; font-size: 14px; }

.btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: linear-gradient(135deg, #475569, #334155); color: #fff; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
.btn-back:hover { background: linear-gradient(135deg, #64748b, #475569); transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 25px rgba(0,0,0,0.4); border-color: rgba(255,255,255,0.3); color:#fff; }

.btn-view-pub { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: linear-gradient(135deg, #10b981, #059669); color: #fff; border: 1px solid rgba(16, 185, 129, 0.5); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
.btn-view-pub:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5); border-color: #34d399; color:#fff; }

/* Alert */
.alert-err { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 16px; padding: 18px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 14px; backdrop-filter: blur(10px); }
.alert-ok  { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 16px; padding: 18px; margin-bottom: 24px; display: flex; align-items: center; gap: 14px; backdrop-filter: blur(10px); }
.al-icon { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px; color: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }

/* Sections */
.sec-badge { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
.sec-badge .ib { width: 46px; height: 46px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
.sec-badge .st { font-size: 18px; font-weight: 800; color: #f8fafc; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
.sec-badge .ss { font-size: 13px; color: #94a3b8; margin-top: 2px; }

/* Form */
.form-card { background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 28px; margin-bottom: 24px; box-shadow: inset 0 2px 10px rgba(0,0,0,0.2); transition: all 0.3s; }
.form-card:hover { border-color: rgba(56, 189, 248, 0.3); background: rgba(15, 23, 42, 0.8); }

.flabel { display: flex; align-items: center; gap: 12px; font-weight: 700; font-size: 14px; color: #e2e8f0; margin-bottom: 12px; }
.flabel .li { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); }
.finput { width: 100%; padding: 16px 20px; font-size: 15px; color: #f8fafc; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 14px; background: rgba(0, 0, 0, 0.2); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); outline: none; box-sizing: border-box; font-weight:500; }
.finput::placeholder { color: #64748b; font-weight: 400; }
.finput:focus { border-color: #38bdf8; background: rgba(15, 23, 42, 0.9); box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15), 0 4px 20px rgba(0,0,0,0.3); transform: translateY(-2px); }

/* TinyMCE wrapper (Dark Theme Overrides) */
.tox-tinymce { border-radius: 16px !important; border: 2px solid rgba(255,255,255,0.1) !important; box-shadow: 0 4px 25px rgba(0,0,0,0.3) !important; overflow: hidden; background: rgba(0,0,0,0.2) !important; }
.tox .tox-toolbar__primary { background: linear-gradient(135deg, #1e293b, #0f172a) !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important;}
.tox .tox-toolbar, .tox .tox-toolbar__overflow { background: #1e293b !important; border-bottom: none !important; }
.tox .tox-tbtn { background: transparent !important; color: #cbd5e1 !important; border-radius: 8px !important; transition: all 0.2s !important; margin: 2px !important; }
.tox .tox-tbtn:hover { background: rgba(56, 189, 248, 0.2) !important; color: #38bdf8 !important; }
.tox .tox-tbtn svg { fill: #cbd5e1 !important; }
.tox .tox-tbtn:hover svg { fill: #38bdf8 !important; }
.tox .tox-tbtn--enabled, .tox .tox-tbtn--enabled:hover { background: rgba(56, 189, 248, 0.2) !important; color: #38bdf8 !important; }
.tox .tox-tbtn--enabled svg { fill: #38bdf8 !important; }
.tox-statusbar { border-top: 1px solid rgba(255,255,255,0.05) !important; background: #0f172a !important; color: #94a3b8 !important; }

/* Section item */
.section-item { background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 20px; padding: 28px; transition: all 0.3s; position: relative; overflow: hidden; }
.section-item:hover { border-color: rgba(139, 92, 246, 0.6); box-shadow: 0 10px 30px rgba(139, 92, 246, 0.1); background: rgba(15, 23, 42, 0.7); }
.sn { width: 36px; height: 36px; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); color: #fff; font-weight: 800; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4); border: 1px solid rgba(255,255,255,0.2); }
.btn-rm { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: linear-gradient(135deg, #ef4444, #b91c1c); color: #fff; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); border: 1px solid rgba(255,255,255,0.1); }
.btn-rm:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5); border-color: rgba(255,255,255,0.3); }
.btn-add { display: inline-flex; align-items: center; gap: 10px; padding: 14px 28px; border-radius: 14px; font-size: 15px; font-weight: 800; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); border: 1px solid rgba(255,255,255,0.1); }
.btn-add:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 10px 30px rgba(59, 130, 246, 0.5); border-color: rgba(255,255,255,0.3); }

/* Action bar */
.action-bar { background: rgba(30, 41, 59, 0.9); border-top: 1px solid rgba(255, 255, 255, 0.05); padding: 24px 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
.btn-cancel { display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; border-radius: 14px; font-size: 15px; font-weight: 800; border: 2px solid rgba(255,255,255,0.2); background: rgba(15,23,42,0.5); color: #cbd5e1; text-decoration: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(5px); }
.btn-cancel:hover { border-color: #fff; color: #fff; transform: translateY(-3px) scale(1.02); box-shadow: 0 10px 25px rgba(0,0,0,0.3); background: rgba(15,23,42,0.8); }
.btn-save { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; border-radius: 14px; font-size: 15px; font-weight: 800; border: none; background: linear-gradient(135deg, #10b981, #059669); color: #fff; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4); border: 1px solid rgba(255,255,255,0.1); }
.btn-save:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 12px 30px rgba(16, 185, 129, 0.6); border-color: rgba(255,255,255,0.3); }

/* Grid */
.g2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
.c2 { grid-column: span 2; }
@media(max-width:768px){ .g2{grid-template-columns:1fr;} .c2{grid-column:span 1;} }
</style>

<div class="edit-page min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
<div class="max-w-6xl mx-auto space-y-8">

{{-- HEADER --}}
<div class="card-container group">
    <div class="card-glow"></div>
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
</div>

{{-- ALERTS --}}
@if($errors->any())
<div class="alert-err">
    <span class="al-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);"><i class="fas fa-exclamation-triangle"></i></span>
    <div>
        <div style="font-weight:800;color:#fca5a5;margin-bottom:5px;">Ada kesalahan yang perlu diperbaiki:</div>
        <ul style="margin:0;padding-left:18px;color:#fecaca;font-size:13px;font-weight:500;">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
    </div>
</div>
@endif
@if(session('success'))
<div class="alert-ok border border-emerald-500/50">
    <span class="al-icon" style="background:linear-gradient(135deg,#10b981,#059669);"><i class="fas fa-check"></i></span>
    <div style="font-weight:700;color:#34d399;font-size:16px;">{{ session('success') }}</div>
</div>
@endif

<form id="edit-form" action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- HERO SECTION --}}
<div class="card-container group">
    <div class="card-glow"></div>
    <div class="card-glass" style="padding:0;">
        <div style="padding:32px;">
            <div class="sec-badge">
                <div class="ib" style="background:linear-gradient(135deg,#1e293b,#0f172a); border:1px solid rgba(255,255,255,0.1);"><i class="fas fa-star text-yellow-400"></i></div>
                <div><div class="st">Hero Section</div><div class="ss">Tampilan banner di bagian atas halaman</div></div>
            </div>
            
            <div class="form-card">
                <div class="g2">
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i class="fas fa-heading"></i></span> Tagline Hero</label>
                        <input type="text" name="tagline_hero" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" value="{{ old('tagline_hero', $profil->tagline_hero) }}" placeholder="Contoh: Terwujudnya layanan informasi yang transparan...">
                    </div>
                    <div>
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#a855f7,#9333ea);"><i class="fas fa-image"></i></span> Background Hero</label>
                        <input type="file" name="image_hero" accept="image/*" class="finput" style="padding:10px 14px;">
                        @if($profil->image_hero)
                        <div style="margin-top:14px;display:flex;align-items:center;gap:16px;background:rgba(0,0,0,0.2);padding:10px;border-radius:12px;border:1px solid rgba(255,255,255,0.05);">
                            <img src="{{ asset('storage/profil/'.$profil->image_hero) }}" style="height:70px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.3);">
                            <span style="font-size:13px;font-weight:600;color:#94a3b8;">Cover Saat Ini</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INFORMASI UTAMA --}}
<div class="card-container group relative">
    <div class="card-glow"></div>
    <div class="card-glass" style="padding:0;">
        <div style="padding:32px;">

            <div class="sec-badge">
                <div class="ib" style="background:linear-gradient(135deg,#3b82f6,#2563eb); border:1px solid rgba(255,255,255,0.1);"><i class="fas fa-info-circle text-cyan-300"></i></div>
                <div><div class="st">Informasi Utama</div><div class="ss">Data dasar konten halaman publik</div></div>
            </div>

            <div class="form-card">
                <div class="g2">
                    {{-- Judul --}}
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i class="fas fa-heading"></i></span> Judul Utama <span class="text-rose-400 ml-1">*</span></label>
                        <input type="text" name="judul" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" value="{{ old('judul',$profil->judul) }}" placeholder="Masukkan judul utama konten ini…" required>
                    </div>

                    {{-- Konten Pembuka --}}
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#6366f1,#4f46e5);"><i class="fas fa-align-left"></i></span> Konten Pembuka <span class="text-rose-400 ml-1">*</span></label>
                        <textarea id="editor-konten_pembuka" name="konten_pembuka" style="width:100%;">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                    </div>

                    {{-- Judul Sub --}}
                    <div>
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#06b6d4,#0891b2);"><i class="fas fa-heading"></i></span> Judul Sub <span style="font-weight:500;color:#64748b;margin-left:6px;">(Opsional)</span></label>
                        <input type="text" name="judul_sub" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" value="{{ old('judul_sub',$profil->judul_sub) }}" placeholder="Contoh: Lampiran Informasi...">
                    </div>

                    {{-- Link Dokumen --}}
                    <div>
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#f43f5e,#e11d48);"><i class="fas fa-link"></i></span> Tautan Lampiran <span style="font-weight:500;color:#64748b;margin-left:6px;">(Opsional)</span></label>
                        <input type="url" name="link_dokumen" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" value="{{ old('link_dokumen',$profil->link_dokumen) }}" placeholder="https://…">
                    </div>

                    {{-- Konten Detail --}}
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#14b8a6,#0d9488);"><i class="fas fa-align-justify"></i></span> Konten Detail <span style="font-weight:500;color:#64748b;margin-left:6px;">(Opsional)</span></label>
                        <textarea id="editor-konten_detail" name="konten_detail" style="width:100%;">{!! old('konten_detail',$profil->konten_detail) !!}</textarea>
                    </div>

                    {{-- Gambaran Singkat --}}
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#f59e0b,#d97706);"><i class="fas fa-file-alt"></i></span> Gambaran Singkat <span style="font-weight:500;color:#64748b;margin-left:6px;">(Opsional, Box Ke-2)</span></label>
                        <textarea id="editor-gambaran" name="gambaran" style="width:100%;">{!! old('gambaran',$profil->gambaran) !!}</textarea>
                    </div>

                    {{-- Gambar --}}
                    <div class="c2">
                        <label class="flabel"><span class="li" style="background:linear-gradient(135deg,#a855f7,#9333ea);"><i class="fas fa-image"></i></span> Gambar Pendukung <span style="font-weight:500;color:#64748b;margin-left:6px;">(Opsional)</span></label>
                        <input type="file" name="gambar" accept="image/*" class="finput" style="padding:10px 14px;">
                        @if($profil->gambar)
                        <div style="margin-top:14px;display:flex;align-items:center;gap:16px;background:rgba(0,0,0,0.2);padding:10px;border-radius:12px;border:1px solid rgba(255,255,255,0.05);">
                            <img src="{{ asset('storage/profil/'.$profil->gambar) }}" style="height:70px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.3);">
                            <span style="font-size:13px;font-weight:600;color:#94a3b8;">Gambar Saat Ini</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- BAGIAN TAMBAHAN --}}
            <div style="border-top:1.5px solid rgba(255,255,255,0.05);padding-top:28px;margin-top:8px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:10px;">
                    <div class="sec-badge" style="margin:0;">
                        <div class="ib" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); border:1px solid rgba(255,255,255,0.1);"><i class="fas fa-layer-group text-fuchsia-300"></i></div>
                        <div><div class="st">Sub-Bagian Tambahan</div><div class="ss">Tambahkan bagian ekstra sesuai kebutuhan</div></div>
                    </div>
                    <button type="button" onclick="addSection()" class="btn-add"><i class="fas fa-plus"></i> Tambah Seksi Misi/List</button>
                </div>
                <div id="sections-container" style="display:flex;flex-direction:column;gap:20px;">
                    @if($profil->additional_sections)
                        @foreach($profil->additional_sections as $index => $section)
                        <div class="section-item" id="si-{{ $index }}">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
                                <div style="display:flex;align-items:center;">
                                    <span class="sn">{{ $index + 1 }}</span>
                                    <span style="font-weight:800;font-size:18px;color:#e2e8f0;">Seksi Ke-{{ $index + 1 }}</span>
                                </div>
                                <button type="button" onclick="removeSection({{ $index }})" class="btn-rm"><i class="fas fa-trash"></i> Hapus Seksi</button>
                            </div>
                            <div style="margin-bottom:20px;">
                                <label class="flabel">Judul Seksi</label>
                                <input type="text" name="additional_title[]" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" value="{{ $section['title'] ?? '' }}" placeholder="Contoh: Misi 1...">
                            </div>
                            <div>
                                <label class="flabel">Konten Seksi</label>
                                <textarea id="editor-section-{{ $index }}" name="additional_content[]" class="section-editor bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">{!! $section['content'] ?? '' !!}</textarea>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
        
        {{-- Action bar --}}
        <div class="action-bar">
            <div style="font-size:14px;font-weight:500;color:#94a3b8;display:flex;align-items:center;gap:8px;">
                <i class="fas fa-info-circle" style="color:#38bdf8;font-size:16px;"></i>
                Semua perubahan akan langsung mengudara di situs publik!
            </div>
            <div style="display:flex;gap:16px;flex-wrap:wrap;">
                <a href="{{ route('admin.profil.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
                <button type="submit" class="btn-save"><i class="fas fa-save text-xl"></i> TERAPKAN PERUBAHAN</button>
            </div>
        </div>
    </div>
</div>
</form>

</div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
var TINYMCE_CONFIG = {
    license_key: 'gpl',
    height: 400,
    menubar: false,
    skin: 'oxide-dark',
    content_css: 'dark',
    plugins: ['advlist','autolink','lists','link','image','charmap','code','table','wordcount'],
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | removeformat code',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; color: #f8fafc; background: transparent; }'
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
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div style="display:flex;align-items:center;">
                    <span class="sn">${idx + 1}</span>
                    <span style="font-weight:800;font-size:18px;color:#e2e8f0;">Seksi Ke-${idx + 1}</span>
                </div>
                <button type="button" onclick="removeSection(${idx})" class="btn-rm"><i class="fas fa-trash"></i> Hapus Seksi</button>
            </div>
            <div style="margin-bottom:20px;">
                <label class="flabel">Judul Seksi</label>
                <input type="text" name="additional_title[]" class="finput bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" placeholder="Contoh: Misi 1...">
            </div>
            <div>
                <label class="flabel">Konten Seksi</label>
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
