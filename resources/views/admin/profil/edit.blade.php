@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #ff0000 0%, #ff6600 100%); padding: 30px; margin: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(255,0,0,0.5);">
    <h1 style="color: white; font-size: 60px; text-align: center; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
        🚨 PERUBAHAN DRASTIS TEST 🚨
    </h1>
    <p style="color: yellow; font-size: 24px; text-align: center; font-weight: bold;">
        JIKA INI MUNCUL = FILE SUDAH TERUPDATE!
    </p>
    <p style="color: white; font-size: 18px; text-align: center;">
        Sidebar harusnya permanen di kiri seperti dashboard
    </p>
</div>

<div style="background: #000; padding: 20px; margin: 20px; border-radius: 10px;">
    <h2 style="color: #0f0; font-size: 30px;">TEST SIDEBAR</h2>
    <p style="color: #fff;">Jika sidebar tetap di kiri saat scroll ini, maka berhasil!</p>
</div>

<link rel="stylesheet" href="{{ asset('css/custom-editor-integrated.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- FORM ASLI -->
<form action="{{ route('admin.profil.update', $profil->type) }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 20px; margin: 20px; border-radius: 10px;">
    @csrf
    @method('PUT')
    
    <h3 style="color: #333; font-size: 24px; margin-bottom: 20px;">Edit Profil PPID</h3>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold;">Judul:</label>
        <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold;">Konten:</label>
        <textarea id="editor_pembuka" name="konten_pembuka" class="custom-editor" style="width: 100%; height: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('konten_pembuka', $profil->konten_pembuka) }}</textarea>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Simpan
        </button>
        <a href="{{ route('admin.profil.index') }}" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Kembali
        </a>
    </div>
</form>

<style>
/* FORM SECTION STYLES */
.form-section-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 24px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.section-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #e5e7eb;
}

.section-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.section-subtitle {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 4px 0 0 0;
    font-weight: 400;
}

.section-body {
    padding: 24px;
}

.form-input-modern {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #ffffff;
}

.form-input-modern:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: white;
}

.input-helper {
    margin-top: 8px;
    font-size: 0.875rem;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 6px;
}

.error-message {
    margin-top: 8px;
    padding: 12px 16px;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    border-left: 4px solid #ef4444;
    border-radius: 8px;
    color: #ef4444;
    font-size: 0.875rem;
    font-weight: 500;
}

/* UPLOAD STYLES */
.upload-zone {
    border: 2px dashed #3b82f6;
    border-radius: 12px;
    padding: 32px;
    text-align: center;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
    transition: all 0.3s ease;
}

.upload-zone:hover {
    border-color: #8b5cf6;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
}

.upload-preview {
    margin-bottom: 20px;
    min-height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-img {
    max-width: 100%;
    max-height: 240px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.empty-upload-state {
    text-align: center;
    color: #9ca3af;
}

.empty-upload-state i {
    font-size: 3rem;
    color: #3b82f6;
    margin-bottom: 12px;
    display: block;
}

.upload-controls {
    margin-bottom: 20px;
}

.upload-btn {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
}

.upload-specs {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.spec-badge {
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
    border: 1px solid rgba(34, 197, 94, 0.3);
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    color: #22c55e;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* PUBLISH OPTIONS */
.publish-options {
    padding: 20px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
    border-radius: 8px;
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.publish-title {
    font-weight: 600;
    color: #374151;
    margin-bottom: 16px;
    font-size: 0.95rem;
}

.radio-group {
    display: flex;
    gap: 20px;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 12px 16px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.radio-option:hover {
    background: rgba(59, 130, 246, 0.1);
}

.radio-option input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #3b82f6;
}

.radio-option label {
    margin: 0;
    cursor: pointer;
    font-weight: 500;
    color: #374151;
}

/* ACTION BUTTONS */
.form-actions-group {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 2px solid #e5e7eb;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border: none;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.btn-save {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    color: white;
    border: 2px solid #3b82f6;
}

.btn-save:hover {
    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(59, 130, 246, 0.4);
    border-color: #8b5cf6;
}

.btn-close {
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    color: #374151;
    border: 2px solid #f3f4f6;
}

.btn-close:hover {
    background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    border-color: #d1d5db;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .form-actions-group {
        flex-direction: column-reverse;
    }
    
    .action-btn {
        width: 100%;
        justify-content: center;
    }
    
    .upload-specs {
        flex-direction: column;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 12px;
    }
}
</style>

<script src="{{ asset('js/custom-editor.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize custom editor for both textareas
    const textareas = document.querySelectorAll('textarea.custom-editor');
    textareas.forEach((textarea, index) => {
        const editorId = textarea.id;
        if (editorId) {
            const editorInstance = new CustomEditor(editorId);
            window[`editor_${editorId}`] = editorInstance;
            
            // Store reference for backward compatibility
            if (index === 0) {
                window.editor = editorInstance;
            }
        }
    });
    
    // Preview sampul function
    window.previewSampul = function(input) {
        const preview = document.getElementById('sampulPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Sampul" class="preview-img">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    console.log('Edit Profil PPID - Custom Editor Loaded');
});
</script>

@push('scripts')
@endsection
