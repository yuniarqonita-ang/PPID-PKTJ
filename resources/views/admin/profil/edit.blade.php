@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil-editor.css') }}">
<style>
    * { box-sizing: border-box; }
    body { 
        background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* HEADER */
    .editor-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        position: relative;
        overflow: hidden;
        margin: -1rem -1rem 40px -1rem;
        padding: 60px 40px;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3), inset 0 1px 0 rgba(255,255,255,0.2);
    }
    
    .editor-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .editor-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        animation: float-reverse 8s ease-in-out infinite;
    }
    
    .header-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }
    
    .editor-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 4px 20px rgba(0,0,0,0.2);
        letter-spacing: -1px;
        line-height: 1.2;
    }
    
    .header-subtitle {
        font-size: 1.2rem;
        margin-top: 15px;
        opacity: 0.95;
        font-weight: 300;
        letter-spacing: 0.5px;
    }
    
    .header-icon {
        font-size: 4.5rem;
        margin-bottom: 20px;
        display: inline-block;
        animation: bounce 2.5s ease-in-out infinite;
        filter: drop-shadow(0 4px 15px rgba(0,0,0,0.2));
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(-30px) translateX(20px); }
    }
    
    @keyframes float-reverse {
        0%, 100% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(30px) translateX(-20px); }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* ALERTS */
    .alert-container {
        margin: 0 0 30px 0;
    }
    
    .alert-custom {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 20px 25px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        animation: slideDown 0.4s ease;
    }
    
    .alert-custom.alert-error {
        background: linear-gradient(135deg, rgba(255, 71, 87, 0.15) 0%, rgba(255, 71, 87, 0.05) 100%);
        border-color: rgba(255, 71, 87, 0.3);
    }
    
    .alert-custom.alert-success {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.15) 0%, rgba(76, 175, 80, 0.05) 100%);
        border-color: rgba(76, 175, 80, 0.3);
    }
    
    .alert-icon {
        font-size: 1.8rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .alert-custom.alert-error .alert-icon { color: #FF4757; }
    .alert-custom.alert-success .alert-icon { color: #4CAF50; }
    
    .alert-title {
        font-weight: 700;
        margin: 0 0 8px 0;
        font-size: 1.1rem;
    }
    
    .alert-message, .alert-list {
        margin: 0;
        font-size: 0.95rem;
        opacity: 0.9;
    }
    
    .btn-close-custom {
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
        padding: 0;
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .btn-close-custom:hover {
        opacity: 1;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* FORM SECTIONS */
    .form-editor-custom {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    .form-section-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .form-section-card:hover {
        box-shadow: 0 15px 50px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    
    .gradient-purple { border-top: 5px solid #667eea; }
    .gradient-blue { border-top: 5px solid #4facfe; }
    .gradient-green { border-top: 5px solid #43e97b; }
    .gradient-orange { border-top: 5px solid #fa709a; }
    .gradient-red { border-top: 5px solid #ff6b6b; }
    .gradient-cyan { border-top: 5px solid #00f2fe; }
    
    .section-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px 30px;
        background: linear-gradient(135deg, #f5f7fa 0%, #f9f9f9 100%);
        border-bottom: 1px solid #e8eaed;
    }
    
    .section-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }
    
    .section-title {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1a1a;
    }
    
    .section-subtitle {
        margin: 5px 0 0 0;
        font-size: 0.9rem;
        color: #666;
        font-weight: 400;
    }
    
    .section-body {
        padding: 30px;
    }
    
    /* INPUTS */
    .form-input-modern {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #e8eaed;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        font-family: inherit;
    }
    
    .form-input-modern:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fafbff;
    }
    
    .form-input-modern::placeholder {
        color: #999;
    }
    
    .input-helper {
        margin-top: 10px;
        font-size: 0.9rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .input-helper i {
        color: #667eea;
    }
    
    .error-message {
        margin-top: 10px;
        padding: 10px 15px;
        background: linear-gradient(135deg, rgba(255, 71, 87, 0.1) 0%, rgba(255, 71, 87, 0.05) 100%);
        border-left: 3px solid #FF4757;
        border-radius: 8px;
        color: #FF4757;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    /* EDITOR TOOLBAR */
    .editor-toolbar-custom {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .toolbar-label {
        color: #667eea;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-editor-textarea {
        width: 100%;
        min-height: 250px;
        padding: 18px;
        border: 2px solid #e8eaed;
        border-radius: 12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1rem;
        resize: vertical;
        transition: all 0.3s ease;
    }
    
    .form-editor-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fafbff;
    }
    
    /* IMAGE UPLOAD */
    .image-upload-zone {
        background: linear-gradient(135deg, #f5f7fa 0%, #f9f9f9 100%);
        border: 2px dashed #667eea;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .image-upload-zone:hover {
        border-color: #764ba2;
        background: linear-gradient(135deg, #fafbff 0%, #f5f7fa 100%);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
    }
    
    .empty-upload-state {
        padding: 30px 0;
    }
    
    .empty-upload-state i {
        font-size: 4rem;
        color: #667eea;
        margin-bottom: 15px;
        display: block;
        animation: bounce 2s ease-in-out infinite;
    }
    
    .empty-upload-state p {
        margin: 0;
        font-weight: 500;
        color: #333;
    }
    
    .image-preview-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .preview-img {
        max-width: 100%;
        max-height: 400px;
        border-radius: 12px;
        display: block;
        margin: 0 auto;
    }
    
    .image-overlay {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.5);
        padding: 8px 15px;
        border-radius: 20px;
    }
    
    .size-lg {
        font-size: 1rem !important;
        padding: 8px 15px !important;
    }
    
    .upload-specs {
        display: flex;
        gap: 15px;
        margin: 20px 0;
        flex-wrap: wrap;
    }
    
    .spec-badge {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(76, 175, 80, 0.05) 100%);
        border: 1px solid rgba(76, 175, 80, 0.3);
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #4CAF50;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .delete-checkbox-box {
        margin-top: 20px;
        padding: 15px;
        background: linear-gradient(135deg, rgba(255, 71, 87, 0.1) 0%, rgba(255, 71, 87, 0.05) 100%);
        border: 1px solid rgba(255, 71, 87, 0.2);
        border-radius: 10px;
    }
    
    .delete-checkbox-box label {
        margin: 0;
        color: #FF4757;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    
    /* ACTION BUTTONS */
    .form-actions-group {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 20px;
        padding-top: 30px;
        border-top: 2px solid #e8eaed;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 16px 32px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }
    
    .btn-icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    
    .btn-cancel {
        background: linear-gradient(135deg, #e8eaed 0%, #d8dadd 100%);
        color: #333;
        border: 2px solid #d8dadd;
    }
    
    .btn-cancel:hover {
        background: linear-gradient(135deg, #d8dadd 0%, #c8cacd 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-color: #c8cacd;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: 2px solid #667eea;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        border-color: #764ba2;
    }
    
    .btn-glow {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: -100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shine 3s infinite;
    }
    
    @keyframes shine {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* RESPONSIVE */
    @media (max-width: 768px) {
        .editor-header {
            padding: 40px 25px;
            border-radius: 0 0 20px 20px;
        }
        
        .editor-title {
            font-size: 2.5rem;
        }
        
        .header-subtitle {
            font-size: 1rem;
        }
        
        .header-icon {
            font-size: 3.5rem;
        }
        
        .section-header {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        
        .section-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }
        
        .form-actions-group {
            flex-direction: column-reverse;
        }
        
        .action-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="editor-header">
    <div class="header-content">
        <div class="header-icon">
            @switch($type)
                @case('profil')
                    <i class="fas fa-user-circle"></i>
                @break
                @case('tugas')
                    <i class="fas fa-tasks"></i>
                @break
                @case('visi')
                    <i class="fas fa-eye"></i>
                @break
                @case('struktur')
                    <i class="fas fa-sitemap"></i>
                @break
                @case('regulasi')
                    <i class="fas fa-gavel"></i>
                @break
                @case('kontak')
                    <i class="fas fa-phone-alt"></i>
                @break
            @endswitch
        </div>
        <h1 class="editor-title">
            @switch($type)
                @case('profil') Edit Profil PPID @endcase
                @case('tugas') Tugas & Tanggung Jawab @endcase
                @case('visi') Visi & Misi @endcase
                @case('struktur') Struktur Organisasi @endcase
                @case('regulasi') Panduan Regulasi @endcase
                @case('kontak') Informasi Kontak @endcase
            @endswitch
        </h1>
        <p class="header-subtitle">✨ Kelola konten dengan editor yang powerful & intuitif</p>
    </div>
</div>

<div style="padding: 0 20px;">
    @if($errors->any())
        <div class="alert-container">
            <div class="alert-custom alert-error">
                <div class="alert-icon"><i class="fas fa-times-circle"></i></div>
                <div class="alert-content">
                    <h5 class="alert-title">❌ Terjadi Kesalahan</h5>
                    <ul class="alert-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="btn-close-custom" data-bs-dismiss="alert"><i class="fas fa-times"></i></button>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-container">
            <div class="alert-custom alert-success">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-content">
                    <h5 class="alert-title">✅ Berhasil!</h5>
                    <p class="alert-message">{{ session('success') }}</p>
                </div>
                <button class="btn-close-custom" data-bs-dismiss="alert"><i class="fas fa-times"></i></button>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" class="form-editor-custom">
        @csrf
        @method('PUT')

        <!-- JUDUL SECTION -->
        <div class="form-section-card gradient-purple">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-heading"></i></div>
                <div><h3 class="section-title">Judul Halaman</h3><p class="section-subtitle">Masukkan judul utama</p></div>
            </div>
            <div class="section-body">
                <input type="text" class="form-input-modern @error('judul') is-invalid @enderror" 
                       id="judul" name="judul" value="{{ old('judul', $profil->judul) }}"
                       placeholder="Contoh: Profil Lembaga PPID Kami" required>
                <div class="input-helper"><i class="fas fa-info-circle"></i> Judul yang jelas membantu pengunjung</div>
                @error('judul')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- KONTEN PEMBUKA SECTION -->
        <div class="form-section-card gradient-blue">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-pen-fancy"></i></div>
                <div><h3 class="section-title">Konten Utama</h3><p class="section-subtitle">Isi konten utama dengan format menarik</p></div>
            </div>
            <div class="section-body">
                <div class="editor-toolbar-custom">
                    <span class="toolbar-label"><i class="fas fa-align-left"></i> Gunakan toolbar editor untuk format teks</span>
                </div>
                <textarea id="editor_pembuka" name="konten_pembuka" class="form-editor-textarea @error('konten_pembuka') is-invalid @enderror"
                          placeholder="Tuliskan konten di sini... Anda bisa bold, italic, heading, list, dan lebih banyak!">{{ old('konten_pembuka', $profil->konten_pembuka) }}</textarea>
                @error('konten_pembuka')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- JUDUL SUB SECTION -->
        <div class="form-section-card gradient-green">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-bookmark"></i></div>
                <div><h3 class="section-title">Judul Bagian Tambahan</h3><p class="section-subtitle">Opsional - untuk bagian tambahan</p></div>
            </div>
            <div class="section-body">
                <input type="text" class="form-input-modern @error('judul_sub') is-invalid @enderror" 
                       id="judul_sub" name="judul_sub" value="{{ old('judul_sub', $profil->judul_sub) }}"
                       placeholder="Contoh: Detail Lebih Lanjut, Informasi Tambahan">
                @error('judul_sub')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- KONTEN DETAIL SECTION -->
        <div class="form-section-card gradient-orange">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-file-alt"></i></div>
                <div><h3 class="section-title">Konten Bagian Tambahan</h3><p class="section-subtitle">Tabel, list, dan format kompleks</p></div>
            </div>
            <div class="section-body">
                <div class="editor-toolbar-custom">
                    <span class="toolbar-label"><i class="fas fa-table"></i> Gunakan tabel untuk data terstruktur</span>
                </div>
                <textarea id="editor_detail" name="konten_detail" class="form-editor-textarea @error('konten_detail') is-invalid @enderror"
                          placeholder="Konten detail dengan table, list, elemen panjang lainnya...">{{ old('konten_detail', $profil->konten_detail) }}</textarea>
                @error('konten_detail')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- REGULASI LINK SECTION -->
        @if($type === 'regulasi')
        <div class="form-section-card gradient-red">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-file-pdf"></i></div>
                <div><h3 class="section-title">Link Dokumen / Google Drive</h3><p class="section-subtitle">Sematkan dokumen dari Google Drive</p></div>
            </div>
            <div class="section-body">
                <input type="url" class="form-input-modern @error('link_dokumen') is-invalid @enderror" 
                       id="link_dokumen" name="link_dokumen" value="{{ old('link_dokumen', $profil->link_dokumen) }}"
                       placeholder="https://drive.google.com/file/d/...">
                <div class="input-helper"><i class="fas fa-cloud"></i> Dokumen akan tampil dalam preview modal</div>
                @error('link_dokumen')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>
        @endif

        <!-- IMAGE SECTION -->
        <div class="form-section-card gradient-cyan">
            <div class="section-header">
                <div class="section-icon"><i class="fas fa-image"></i></div>
                <div><h3 class="section-title">Gambar / Sampu l</h3><p class="section-subtitle">Upload gambar pendamping (700×350px recommended)</p></div>
            </div>
            <div class="section-body">
                <div class="image-upload-zone" onclick="document.getElementById('gambar').click()">
                    <input type="file" id="gambar" name="gambar" class="d-none" accept="image/*" onchange="previewImage(event)">
                    <div id="image-preview-wrapper">
                        @if($profil->gambar)
                            <div class="image-preview-container">
                                <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="preview-img">
                                <div class="image-overlay"><span class="badge bg-success size-lg">✓ Ada</span></div>
                            </div>
                        @else
                            <div class="empty-upload-state">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p><strong>Drag & drop atau klik untuk upload</strong></p>
                                <p class="text-muted">JPG, PNG, GIF (max 5MB)</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="upload-specs">
                    <div class="spec-badge"><i class="fas fa-check"></i> JPG, PNG, GIF</div>
                    <div class="spec-badge"><i class="fas fa-check"></i> Max 5MB</div>
                    <div class="spec-badge"><i class="fas fa-check"></i> Optimal 700×350px</div>
                </div>

                @if($profil->gambar)
                    <div class="delete-checkbox-box">
                        <input class="form-check-input" type="checkbox" name="hapus_gambar" value="1" id="hapus_gambar">
                        <label class="form-check-label" for="hapus_gambar">
                            <i class="fas fa-trash"></i> Hapus gambar yang ada
                        </label>
                    </div>
                @endif
                
                @error('gambar')<div class="error-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="form-actions-group">
            <a href="{{ route('admin.profil.index') }}" class="action-btn btn-cancel">
                <span class="btn-icon-wrapper"><i class="fas fa-arrow-left"></i></span>
                <span class="btn-text">Batal</span>
            </a>
            <button type="submit" class="action-btn btn-submit">
                <span class="btn-icon-wrapper"><i class="fas fa-save"></i></span>
                <span class="btn-text">Simpan Perubahan</span>
                <div class="btn-glow"></div>
            </button>
        </div>
    </form>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    function initializeCKEditor(selector) {
        ClassicEditor
            .create(document.querySelector(selector), {
                toolbar: {
                    items: [
                        'heading', '|', 'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|', 'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Normal', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                fontSize: { options: [ 10, 12, 14, 'default', 18, 20, 22 ] },
                fontFamily: { options: ['default', 'Arial, sans-serif', 'Georgia, serif', 'Courier New, monospace'] },
                table: { contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'] },
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
                    styles: ['full', 'side', 'alignLeft', 'alignCenter', 'alignRight']
                },
                link: { decorators: { addTargetToExternalLinks: true, defaultProtocol: 'https://' } }
            })
            .catch(error => console.error('CKEditor error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeCKEditor('#editor_pembuka');
        initializeCKEditor('#editor_detail');
    });

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let wrapper = document.getElementById('image-preview-wrapper');
                wrapper.innerHTML = `<div class="image-preview-container"><img src="${e.target.result}" alt="Preview" class="preview-img"><div class="image-overlay"><span class="badge bg-primary size-lg">✓ Preview</span></div></div>`;
                let checkbox = document.getElementById('hapus_gambar');
                if (checkbox) checkbox.checked = false;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<!-- Document Preview Modal -->
<div id="documentModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 15px; width: 95%; max-width: 1200px; height: 80vh; display: flex; flex-direction: column; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <div style="padding: 20px; border-bottom: 2px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #f5f7fa, #f9f9f9);">
            <h5 style="margin: 0; font-weight: 600;">📄 Preview Dokumen</h5>
            <button type="button" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;" onclick="closeDocumentPreview()"><i class="fas fa-times"></i></button>
        </div>
        <div style="flex: 1; overflow: auto; background: #f5f5f5;">
            <iframe id="documentFrame" src="" frameborder="0" allowfullscreen style="width: 100%; height: 100%; border: none;"></iframe>
        </div>
    </div>
</div>

<script>
    function previewDocument(url) {
        let embedUrl = url;
        if (url.includes('drive.google.com')) {
            let fileId = url.includes('/d/') ? url.split('/d/')[1].split('/')[0] : url.split('id=')[1].split('&')[0];
            if (fileId) embedUrl = `https://drive.google.com/file/d/${fileId}/preview`;
        }
        document.getElementById('documentFrame').src = embedUrl;
        document.getElementById('documentModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDocumentPreview() {
        document.getElementById('documentModal').style.display = 'none';
        document.getElementById('documentFrame').src = '';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeDocumentPreview();
    });
</script>

<!-- ALL MODALS -->
@include('admin.profil.modals.file-manager')
@include('admin.profil.modals.insert-media')
@include('admin.profil.modals.insert-image')
@include('admin.profil.modals.insert-link')
@include('admin.profil.modals.find-replace')
@include('admin.profil.modals.insert-character')
@include('admin.profil.modals.insert-anchor')
@include('admin.profil.modals.table-grid')
@include('admin.profil.modals.table-properties')
@include('admin.profil.modals.cell-properties')
@include('admin.profil.modals.row-properties')
@include('admin.profil.modals.source-code')
@include('admin.profil.modals.bullet-list')
@include('admin.profil.modals.numbered-list')

@push('scripts')
<script src="{{ asset('js/editor.js') }}"></script>
@endpush

@endsection
