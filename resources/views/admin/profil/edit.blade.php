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
    
    /* MENU BAR & TOOLBAR */
    .editor-menu-bar {
        background: white;
        border-bottom: 1px solid #ddd;
        padding: 0;
        margin: 0;
        display: flex;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .menu-item {
        position: relative;
        padding: 12px 16px;
        cursor: pointer;
        user-select: none;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.95rem;
        color: #333;
    }
    
    .menu-item:hover {
        background: #f5f5f5;
        color: #667eea;
    }
    
    .menu-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid #ddd;
        border-top: none;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        z-index: 1000;
        min-width: 220px;
        animation: slideDown 0.2s ease;
    }
    
    .menu-item:hover .menu-dropdown {
        display: block;
    }
    
    .menu-submenu {
        padding: 8px 0;
    }
    
    .menu-subitem {
        padding: 10px 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        transition: all 0.2s ease;
        color: #333;
        font-size: 0.9rem;
    }
    
    .menu-subitem:hover {
        background: #f0f0ff;
        color: #667eea;
        padding-left: 25px;
    }
    
    .menu-icon {
        width: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
    }
    
    .menu-shortcut {
        font-size: 0.8rem;
        color: #999;
        margin-left: auto;
    }
    
    .menu-separator {
        height: 1px;
        background: #eee;
        margin: 6px 0;
    }
    
    .submenu-arrow {
        margin-left: auto;
        font-size: 0.8rem;
    }
    
    /* TOOLBAR */
    .editor-toolbar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        border-bottom: 1px solid #ddd;
        padding: 10px 15px;
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .toolbar-group {
        display: flex;
        gap: 4px;
        border-right: 1px solid #ddd;
        padding-right: 8px;
        margin-right: 8px;
    }
    
    .toolbar-btn {
        width: 38px;
        height: 38px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 1rem;
        color: #333;
        position: relative;
    }
    
    .toolbar-btn:hover {
        background: #f0f0ff;
        border-color: #667eea;
        color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }
    
    .toolbar-btn.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .toolbar-dropdown {
        position: relative;
    }
    
    .toolbar-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        z-index: 1000;
        min-width: 140px;
        animation: slideDown 0.2s ease;
    }
    
    .toolbar-btn.dropdown:hover .toolbar-dropdown-menu {
        display: block;
    }
    
    .dropdown-item {
        padding: 10px 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #333;
    }
    
    .dropdown-item:hover {
        background: #f0f0ff;
        color: #667eea;
        padding-left: 20px;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .toolbar-separator {
        width: 1px;
        height: 30px;
        background: #ddd;
    }
    
    .word-count {
        font-size: 0.85rem;
        color: #666;
        padding: 8px 12px;
        margin-left: auto;
        background: #f5f5f5;
        border-radius: 6px;
    }
    
    /* MODAL STYLES */
    .editor-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.2s ease;
    }
    
    .editor-modal.show {
        display: flex;
    }
    
    .modal-dialog {
        background: white;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: scaleIn 0.2s ease;
    }
    
    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px 12px 0 0;
    }
    
    .modal-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }
    
    .modal-close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .modal-close-btn:hover {
        transform: rotate(90deg);
        opacity: 0.8;
    }
    
    .modal-body {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 18px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        font-family: inherit;
        transition: all 0.2s ease;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: #fafbff;
    }
    
    .input-with-icon {
        position: relative;
        display: flex;
        gap: 8px;
    }
    
    .input-with-icon input {
        flex: 1;
    }
    
    .file-browser-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        transition: all 0.2s ease;
        font-size: 1rem;
    }
    
    .file-browser-btn:hover {
        background: #f0f0ff;
        border-color: #667eea;
    }
    
    .modal-tabs {
        display: flex;
        border-bottom: 2px solid #eee;
        margin-bottom: 20px;
        gap: 0;
    }
    
    .modal-tab {
        padding: 12px 16px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
        font-weight: 500;
        color: #666;
    }
    
    .modal-tab:hover {
        color: #667eea;
    }
    
    .modal-tab.active {
        color: #667eea;
        border-bottom-color: #667eea;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
    
    .modal-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
    
    .modal-btn {
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }
    
    .modal-btn-cancel {
        background: #f0f0f0;
        color: #333;
    }
    
    .modal-btn-cancel:hover {
        background: #e0e0e0;
    }
    
    .modal-btn-ok {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .modal-btn-ok:hover {
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
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

@endsection

@section('content')

<!-- MENU BAR -->
<nav class="editor-menu-bar">
    <!-- FILE MENU -->
    <div class="menu-item">
        <i class="fas fa-file me-1"></i> File
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="newDocument()">
                    <span><i class="menu-icon fas fa-file-circle-plus"></i> New Document</span>
                </div>
                <div class="menu-subitem" onclick="printDocument()">
                    <span><i class="menu-icon fas fa-print"></i> Print</span>
                    <span class="menu-shortcut">Ctrl+P</span>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MENU -->
    <div class="menu-item">
        <i class="fas fa-pen me-1"></i> Edit
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="execCommand('undo')">
                    <span><i class="menu-icon fas fa-undo"></i> Undo</span>
                    <span class="menu-shortcut">Ctrl+Z</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('redo')">
                    <span><i class="menu-icon fas fa-redo"></i> Redo</span>
                    <span class="menu-shortcut">Ctrl+Y</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem" onclick="execCommand('cut')">
                    <span><i class="menu-icon fas fa-cut"></i> Cut</span>
                    <span class="menu-shortcut">Ctrl+X</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('copy')">
                    <span><i class="menu-icon fas fa-copy"></i> Copy</span>
                    <span class="menu-shortcut">Ctrl+C</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('paste')">
                    <span><i class="menu-icon fas fa-paste"></i> Paste</span>
                    <span class="menu-shortcut">Ctrl+V</span>
                </div>
                <div class="menu-subitem" onclick="pasteAsText()">
                    <span><i class="menu-icon fas fa-file-lines"></i> Paste as Text</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem" onclick="execCommand('selectAll')">
                    <span><i class="menu-icon fas fa-object-group"></i> Select All</span>
                    <span class="menu-shortcut">Ctrl+A</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem" onclick="openFindReplace()">
                    <span><i class="menu-icon fas fa-magnifying-glass"></i> Find & Replace</span>
                    <span class="menu-shortcut">Ctrl+H</span>
                </div>
            </div>
        </div>
    </div>

    <!-- INSERT MENU -->
    <div class="menu-item">
        <i class="fas fa-plus me-1"></i> Insert
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="openInsertMedia()">
                    <span><i class="menu-icon fas fa-video"></i> Media</span>
                </div>
                <div class="menu-subitem" onclick="openInsertImage()">
                    <span><i class="menu-icon fas fa-image"></i> Image</span>
                </div>
                <div class="menu-subitem" onclick="openInsertLink()">
                    <span><i class="menu-icon fas fa-link"></i> Link</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem" onclick="insertSpecialChar()">
                    <span><i class="menu-icon fas fa-star"></i> Special Character</span>
                </div>
                <div class="menu-subitem" onclick="insertHorizontalLine()">
                    <span><i class="menu-icon fas fa-minus"></i> Horizontal Line</span>
                </div>
                <div class="menu-subitem" onclick="insertAnchor()">
                    <span><i class="menu-icon fas fa-anchor"></i> Anchor</span>
                </div>
                <div class="menu-subitem" onclick="insertPageBreak()">
                    <span><i class="menu-icon fas fa-copy"></i> Page Break</span>
                </div>
                <div class="menu-subitem" onclick="insertNbsp()">
                    <span><i class="menu-icon fas fa-space-shuttle"></i> Non-breaking Space</span>
                    <span class="menu-shortcut">Ctrl+Shift+Space</span>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW MENU -->
    <div class="menu-item">
        <i class="fas fa-eye me-1"></i> View
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="toggleInvisible()">
                    <span><i class="menu-icon fas fa-eye"></i> Show Invisible Characters</span>
                </div>
                <div class="menu-subitem" onclick="toggleBlocks()">
                    <span><i class="menu-icon fas fa-square"></i> Show Blocks</span>
                </div>
                <div class="menu-subitem" onclick="toggleVisualAids()">
                    <span><i class="menu-icon fas fa-wand-magic-sparkles"></i> Visual Aids</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem" onclick="previewContent()">
                    <span><i class="menu-icon fas fa-eye"></i> Preview</span>
                </div>
                <div class="menu-subitem" onclick="toggleFullscreen()">
                    <span><i class="menu-icon fas fa-expand"></i> Fullscreen</span>
                    <span class="menu-shortcut">F11</span>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMAT MENU -->
    <div class="menu-item">
        <i class="fas fa-palette me-1"></i> Format
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="execCommand('bold')">
                    <span><i class="menu-icon fas fa-bold"></i> Bold</span>
                    <span class="menu-shortcut">Ctrl+B</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('italic')">
                    <span><i class="menu-icon fas fa-italic"></i> Italic</span>
                    <span class="menu-shortcut">Ctrl+I</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('underline')">
                    <span><i class="menu-icon fas fa-underline"></i> Underline</span>
                    <span class="menu-shortcut">Ctrl+U</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('strikethrough')">
                    <span><i class="menu-icon fas fa-strikethrough"></i> Strikethrough</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('superscript')">
                    <span><i class="menu-icon fas fa-superscript"></i> Superscript</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('subscript')">
                    <span><i class="menu-icon fas fa-subscript"></i> Subscript</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem">
                    <span><i class="menu-icon fas fa-font"></i> Heading</span>
                    <span class="submenu-arrow">→</span>
                </div>
                <div class="menu-subitem" onclick="execCommand('clearFormatting')">
                    <span><i class="menu-icon fas fa-eraser"></i> Clear Formatting</span>
                    <span class="menu-shortcut">Ctrl+M</span>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE MENU -->
    <div class="menu-item">
        <i class="fas fa-table me-1"></i> Table
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="openInsertTable()">
                    <span><i class="menu-icon fas fa-table"></i> Insert Table</span>
                </div>
                <div class="menu-subitem" onclick="tableProperties()">
                    <span><i class="menu-icon fas fa-sliders"></i> Table Properties</span>
                </div>
                <div class="menu-subitem" onclick="deleteTable()">
                    <span><i class="menu-icon fas fa-trash"></i> Delete Table</span>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-subitem">
                    <span><i class="menu-icon fas fa-th"></i> Cell</span>
                    <span class="submenu-arrow">→</span>
                </div>
                <div class="menu-subitem">
                    <span><i class="menu-icon fas fa-bars"></i> Row</span>
                    <span class="submenu-arrow">→</span>
                </div>
                <div class="menu-subitem">
                    <span><i class="menu-icon fas fa-columns"></i> Column</span>
                    <span class="submenu-arrow">→</span>
                </div>
            </div>
        </div>
    </div>

    <!-- TOOLS MENU -->
    <div class="menu-item">
        <i class="fas fa-screwdriver me-1"></i> Tools
        <div class="menu-dropdown">
            <div class="menu-submenu">
                <div class="menu-subitem" onclick="openSourceCode()">
                    <span><i class="menu-icon fas fa-code"></i> Source Code</span>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- TOOLBAR -->
<div class="editor-toolbar">
    <!-- Undo/Redo -->
    <div class="toolbar-group">
        <button class="toolbar-btn" title="Undo (Ctrl+Z)" onclick="execCommand('undo')">
            <i class="fas fa-undo"></i>
        </button>
        <button class="toolbar-btn" title="Redo (Ctrl+Y)" onclick="execCommand('redo')">
            <i class="fas fa-redo"></i>
        </button>
    </div>

    <!-- Format Dropdown -->
    <div class="toolbar-group">
        <div class="toolbar-btn dropdown" title="Paragraph Format">
            <i class="fas fa-align-left"></i>
            <div class="toolbar-dropdown-menu">
                <div class="dropdown-item" onclick="execCommand('formatBlock', 'p')">
                    <i class="fas fa-font"></i> Paragraph
                </div>
                <div class="dropdown-item" onclick="execCommand('formatBlock', 'h1')">
                    <i class="fas fa-heading"></i> Heading 1
                </div>
                <div class="dropdown-item" onclick="execCommand('formatBlock', 'h2')">
                    <i class="fas fa-heading"></i> Heading 2
                </div>
                <div class="dropdown-item" onclick="execCommand('formatBlock', 'h3')">
                    <i class="fas fa-heading"></i> Heading 3
                </div>
            </div>
        </div>
    </div>

    <!-- Bold/Underline -->
    <div class="toolbar-group">
        <button class="toolbar-btn" title="Bold (Ctrl+B)" onclick="execCommand('bold')">
            <i class="fas fa-bold"></i>
        </button>
        <button class="toolbar-btn" title="Underline (Ctrl+U)" onclick="execCommand('underline')">
            <i class="fas fa-underline"></i>
        </button>
    </div>

    <!-- Alignment -->
    <div class="toolbar-group">
        <button class="toolbar-btn" title="Align Left" onclick="execCommand('justifyLeft')">
            <i class="fas fa-align-left"></i>
        </button>
        <button class="toolbar-btn" title="Align Center" onclick="execCommand('justifyCenter')">
            <i class="fas fa-align-center"></i>
        </button>
        <button class="toolbar-btn" title="Align Right" onclick="execCommand('justifyRight')">
            <i class="fas fa-align-right"></i>
        </button>
        <button class="toolbar-btn" title="Justify" onclick="execCommand('justifyFull')">
            <i class="fas fa-align-justify"></i>
        </button>
    </div>

    <!-- Lists -->
    <div class="toolbar-group">
        <div class="toolbar-btn dropdown" title="Bullet List">
            <i class="fas fa-list-ul"></i>
            <div class="toolbar-dropdown-menu">
                <div class="dropdown-item" onclick="execCommand('insertUnorderedList')">
                    <i class="fas fa-circle"></i> Default
                </div>
            </div>
        </div>
        <div class="toolbar-btn dropdown" title="Numbered List">
            <i class="fas fa-list-ol"></i>
            <div class="toolbar-dropdown-menu">
                <div class="dropdown-item" onclick="execCommand('insertOrderedList')">
                    <i class="fas fa-list"></i> Default
                </div>
            </div>
        </div>
    </div>

    <!-- Insert Link/Media -->
    <div class="toolbar-group">
        <button class="toolbar-btn" title="Insert Link" onclick="openInsertLink()">
            <i class="fas fa-link"></i>
        </button>
        <button class="toolbar-btn" title="Remove Link" onclick="execCommand('unlink')">
            <i class="fas fa-link-slash"></i>
        </button>
    </div>

    <!-- Media/Image -->
    <div class="toolbar-group">
        <button class="toolbar-btn" title="Insert Media" onclick="openInsertMedia()">
            <i class="fas fa-video"></i>
        </button>
        <button class="toolbar-btn" title="Insert Image" onclick="openInsertImage()">
            <i class="fas fa-image"></i>
        </button>
    </div>

    <!-- Word Count -->
    <div class="word-count">
        <span id="wordCount">Words: 0</span>
    </div>
</div>

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

<!-- INSERT MEDIA MODAL -->
<div id="insertMediaModal" class="editor-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-video me-2"></i> Insert/Edit Media</h2>
            <button class="modal-close-btn" onclick="closeModal('insertMediaModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="modal-tabs">
                <div class="modal-tab active" onclick="switchTab(event, 'media-general')">General</div>
                <div class="modal-tab" onclick="switchTab(event, 'media-embed')">Embed</div>
                <div class="modal-tab" onclick="switchTab(event, 'media-advanced')">Advanced</div>
            </div>

            <!-- General Tab -->
            <div id="media-general" class="tab-content active">
                <div class="form-group">
                    <label>Source</label>
                    <div class="input-with-icon">
                        <input type="text" id="mediaSource" placeholder="https://example.com/video.mp4">
                        <button class="file-browser-btn" onclick="openFileManager('media')"><i class="fas fa-folder-open"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dimensions</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="number" id="mediaWidth" placeholder="Width" value="100" style="flex: 1;">
                        <span>x</span>
                        <input type="number" id="mediaHeight" placeholder="Height" value="auto" style="flex: 1;">
                        <input type="checkbox" id="mediaConstrain" checked title="Constrain proportions">
                    </div>
                </div>
            </div>

            <!-- Embed Tab -->
            <div id="media-embed" class="tab-content">
                <div class="form-group">
                    <label>Paste your embed code below:</label>
                    <textarea id="mediaEmbed" placeholder="Paste embed code here..." style="min-height: 150px;"></textarea>
                </div>
            </div>

            <!-- Advanced Tab -->
            <div id="media-advanced" class="tab-content">
                <div class="form-group">
                    <label>Alternative Source</label>
                    <div class="input-with-icon">
                        <input type="text" id="mediaAltSource" placeholder="Alternative source URL">
                        <button class="file-browser-btn" onclick="openFileManager('media')"><i class="fas fa-folder-open"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Poster</label>
                    <div class="input-with-icon">
                        <input type="text" id="mediaPoster" placeholder="Poster image URL">
                        <button class="file-browser-btn" onclick="openFileManager('images')"><i class="fas fa-folder-open"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeModal('insertMediaModal')">Cancel</button>
            <button class="modal-btn modal-btn-ok" onclick="insertMedia()">OK</button>
        </div>
    </div>
</div>

<!-- INSERT IMAGE MODAL -->
<div id="insertImageModal" class="editor-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-image me-2"></i> Insert/Edit Image</h2>
            <button class="modal-close-btn" onclick="closeModal('insertImageModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="modal-tabs">
                <div class="modal-tab active" onclick="switchTab(event, 'img-general')">General</div>
                <div class="modal-tab" onclick="switchTab(event, 'img-advanced')">Advanced</div>
            </div>

            <!-- General Tab -->
            <div id="img-general" class="tab-content active">
                <div class="form-group">
                    <label>Source</label>
                    <div class="input-with-icon">
                        <input type="text" id="imageSource" placeholder="https://example.com/image.jpg">
                        <button class="file-browser-btn" onclick="openFileManager('images')"><i class="fas fa-folder-open"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Image Description</label>
                    <input type="text" id="imageAlt" placeholder="Describe this image">
                </div>
                <div class="form-group">
                    <label>Dimensions</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="number" id="imageWidth" placeholder="Width" value="100" style="flex: 1;">
                        <span>x</span>
                        <input type="number" id="imageHeight" placeholder="Height" value="auto" style="flex: 1;">
                        <input type="checkbox" id="imageConstrain" checked title="Constrain proportions">
                    </div>
                </div>
            </div>

            <!-- Advanced Tab -->
            <div id="img-advanced" class="tab-content">
                <div class="form-group">
                    <label>Style</label>
                    <input type="text" id="imageStyle" placeholder="CSS style">
                </div>
                <div class="form-group">
                    <label>Vertical Space</label>
                    <input type="number" id="imageVSpace" placeholder="pixels">
                </div>
                <div class="form-group">
                    <label>Border</label>
                    <input type="number" id="imageBorder" placeholder="pixels">
                </div>
                <div class="form-group">
                    <label>Horizontal Space</label>
                    <input type="number" id="imageHSpace" placeholder="pixels">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeModal('insertImageModal')">Cancel</button>
            <button class="modal-btn modal-btn-ok" onclick="insertImage()">OK</button>
        </div>
    </div>
</div>

<!-- INSERT LINK MODAL -->
<div id="insertLinkModal" class="editor-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-link me-2"></i> Insert Link</h2>
            <button class="modal-close-btn" onclick="closeModal('insertLinkModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>URL</label>
                <div class="input-with-icon">
                    <input type="text" id="linkUrl" placeholder="https://example.com">
                    <button class="file-browser-btn" onclick="openFileManager('all')"><i class="fas fa-folder-open"></i></button>
                </div>
                <small style="color: #999; margin-top: 5px; display: block;">
                    <i class="fas fa-icons"></i> Files • Images • Archives • Videos • Music
                </small>
            </div>
            <div class="form-group">
                <label>Text to Display</label>
                <input type="text" id="linkText" placeholder="Link text">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="linkTitle" placeholder="Hover text">
            </div>
            <div class="form-group">
                <label>Target</label>
                <select id="linkTarget">
                    <option value="">None</option>
                    <option value="_blank">New Window</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeModal('insertLinkModal')">Cancel</button>
            <button class="modal-btn modal-btn-ok" onclick="insertLink()">OK</button>
        </div>
    </div>
</div>

<!-- SOURCE CODE MODAL -->
<div id="sourceCodeModal" class="editor-modal">
    <div class="modal-dialog" style="max-width: 700px;">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-code me-2"></i> Source Code</h2>
            <button class="modal-close-btn" onclick="closeModal('sourceCodeModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <textarea id="sourceCode" style="width: 100%; min-height: 400px; font-family: monospace; padding: 12px; border: 1px solid #ddd; border-radius: 6px;"></textarea>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeModal('sourceCodeModal')">Cancel</button>
            <button class="modal-btn" style="background: #4CAF50; color: white;" onclick="copySourceCode()">
                <i class="fas fa-copy me-2"></i> Copy
            </button>
            <button class="modal-btn modal-btn-ok" onclick="updateSourceCode()">OK</button>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    function switchTab(event, contentId) {
        // Hide all tabs in parent
        const tabs = event.target.parentElement.querySelectorAll('.modal-tab');
        const contents = event.target.parentElement.parentElement.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => tab.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));
        
        // Show selected tab
        event.target.classList.add('active');
        document.getElementById(contentId).classList.add('active');
    }

    function openInsertMedia() { openModal('insertMediaModal'); }
    function openInsertImage() { openModal('insertImageModal'); }
    function openInsertLink() { openModal('insertLinkModal'); }
    function openSourceCode() {
        const editor = document.querySelector('[contenteditable], textarea[id*="editor"]');
        document.getElementById('sourceCode').value = editor?.innerHTML || '';
        openModal('sourceCodeModal');
    }

    function insertMedia() {
        const source = document.getElementById('mediaSource').value;
        if (source) {
            const html = `<video controls style="max-width: 100%; height: auto;"><source src="${source}"></video>`;
            insertHtmlToEditor(html);
            closeModal('insertMediaModal');
        }
    }

    function insertImage() {
        const source = document.getElementById('imageSource').value;
        const alt = document.getElementById('imageAlt').value;
        if (source) {
            const html = `<img src="${source}" alt="${alt}" style="max-width: 100%; height: auto;">`;
            insertHtmlToEditor(html);
            closeModal('insertImageModal');
        }
    }

    function insertLink() {
        const url = document.getElementById('linkUrl').value;
        const text = document.getElementById('linkText').value || 'Link';
        const title = document.getElementById('linkTitle').value;
        const target = document.getElementById('linkTarget').value;
        
        if (url) {
            const titleAttr = title ? ` title="${title}"` : '';
            const targetAttr = target ? ` target="${target}"` : '';
            const html = `<a href="${url}"${titleAttr}${targetAttr}>${text}</a>`;
            insertHtmlToEditor(html);
            closeModal('insertLinkModal');
        }
    }

    function insertHtmlToEditor(html) {
        const editors = document.querySelectorAll('.ck-editor__editable');
        if (editors.length > 0 && window.editor) {
            window.editor.model.insertContent(html);
        }
    }

    function copySourceCode() {
        const code = document.getElementById('sourceCode');
        code.select();
        document.execCommand('copy');
        alert('Code copied to clipboard!');
    }

    function updateSourceCode() {
        const newCode = document.getElementById('sourceCode').value;
        const editor = document.querySelector('[contenteditable]');
        if (editor) {
            editor.innerHTML = newCode;
        }
        closeModal('sourceCodeModal');
    }

    function execCommand(cmd, value = null) {
        document.execCommand(cmd, false, value);
    }

    function openFileManager(type) {
        alert('File Manager untuk: ' + type);
        // Implementasi file manager akan ditambahkan
    }

    function printDocument() {
        window.print();
    }

    function newDocument() {
        if (confirm('Apakah Anda yakin ingin membuat dokumen baru? Perubahan yang belum disimpan akan hilang.')) {
            location.reload();
        }
    }

    // Update word count
    document.addEventListener('input', function() {
        const editor = document.querySelector('[contenteditable], textarea[id*="editor"]');
        if (editor) {
            const text = editor.innerText || editor.value;
            const words = text.trim().split(/\s+/).length;
            document.getElementById('wordCount').textContent = 'Words: ' + words;
        }
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
