@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Buat Formulir Baru</h1>
            <p class="text-gray-600 mt-1">Desain formulir permohonan informasi sesuai kebutuhan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.permohonan.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                Batal
            </a>
            <button type="submit" form="form-builder" class="px-6 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                Simpan Formulir
            </button>
        </div>
    </div>

    <!-- ==================== FORM TITLE ==================== -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <input type="text" 
               name="form_title" 
               id="form-title"
               placeholder="Judul Formulir" 
               class="w-full text-2xl font-bold text-gray-900 border-0 focus:outline-none focus:ring-0 placeholder-gray-400"
               value="Formulir Permohonan Informasi">
        <p class="text-sm text-gray-500 mt-2">Masukkan judul formulir yang jelas dan deskriptif</p>
    </div>

    <!-- ==================== FORM BUILDER ==================== -->
    <form id="form-builder" action="{{ route('admin.permohonan.store') }}" method="POST">
        @csrf
        
        <div id="fields-container" class="space-y-4">
            <!-- Field 1: Nama Lengkap -->
            <div class="field-item bg-white rounded-lg shadow-sm border border-gray-200 p-6" data-field-id="1">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="cursor-move text-gray-400 hover:text-gray-600">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        <input type="text" 
                               name="fields[1][label]" 
                               placeholder="Pertanyaan" 
                               class="text-lg font-medium text-gray-900 border-0 focus:outline-none focus:ring-0 placeholder-gray-400"
                               value="Nama Lengkap">
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="toggleRequired(1)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-asterisk" id="required-icon-1"></i>
                        </button>
                        <button type="button" onclick="duplicateField(1)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button type="button" onclick="deleteField(1)" class="text-gray-400 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 mb-4">
                    <select name="fields[1][type]" onchange="updateFieldOptions(1)" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option value="text" selected>Jawaban Singkat</option>
                        <option value="paragraph">Paragraf</option>
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="checkboxes">Kotak Centang</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="file">Unggah File</option>
                        <option value="date">Tanggal</option>
                        <option value="time">Waktu</option>
                    </select>
                    <input type="hidden" name="fields[1][required]" value="1" id="required-1">
                </div>
                
                <div class="field-preview">
                    <input type="text" 
                           placeholder="Nama lengkap" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2" 
                           disabled>
                </div>
            </div>

            <!-- Field 2: Email -->
            <div class="field-item bg-white rounded-lg shadow-sm border border-gray-200 p-6" data-field-id="2">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="cursor-move text-gray-400 hover:text-gray-600">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        <input type="text" 
                               name="fields[2][label]" 
                               placeholder="Pertanyaan" 
                               class="text-lg font-medium text-gray-900 border-0 focus:outline-none focus:ring-0 placeholder-gray-400"
                               value="Email">
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="toggleRequired(2)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-asterisk" id="required-icon-2"></i>
                        </button>
                        <button type="button" onclick="duplicateField(2)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button type="button" onclick="deleteField(2)" class="text-gray-400 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 mb-4">
                    <select name="fields[2][type]" onchange="updateFieldOptions(2)" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option value="text">Jawaban Singkat</option>
                        <option value="paragraph">Paragraf</option>
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="checkboxes">Kotak Centang</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="file">Unggah File</option>
                        <option value="date">Tanggal</option>
                        <option value="time">Waktu</option>
                    </select>
                    <input type="hidden" name="fields[2][required]" value="1" id="required-2">
                </div>
                
                <div class="field-preview">
                    <input type="email" 
                           placeholder="email@example.com" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2" 
                           disabled>
                </div>
            </div>

            <!-- Field 3: Upload KTP -->
            <div class="field-item bg-white rounded-lg shadow-sm border border-gray-200 p-6" data-field-id="3">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="cursor-move text-gray-400 hover:text-gray-600">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        <input type="text" 
                               name="fields[3][label]" 
                               placeholder="Pertanyaan" 
                               class="text-lg font-medium text-gray-900 border-0 focus:outline-none focus:ring-0 placeholder-gray-400"
                               value="Upload KTP">
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="toggleRequired(3)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-asterisk" id="required-icon-3"></i>
                        </button>
                        <button type="button" onclick="duplicateField(3)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button type="button" onclick="deleteField(3)" class="text-gray-400 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 mb-4">
                    <select name="fields[3][type]" onchange="updateFieldOptions(3)" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option value="text">Jawaban Singkat</option>
                        <option value="paragraph">Paragraf</option>
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="checkboxes">Kotak Centang</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="file" selected>Unggah File</option>
                        <option value="date">Tanggal</option>
                        <option value="time">Waktu</option>
                    </select>
                    <input type="hidden" name="fields[3][required]" value="0" id="required-3">
                </div>
                
                <div class="field-preview">
                    <div class="w-full border-2 border-dashed border-gray-300 rounded-md p-4 text-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk mengunggah file atau seret file ke sini</p>
                        <p class="text-xs text-gray-500">PDF, JPG, PNG (maks. 10MB)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== ADD FIELD BUTTON ==================== -->
        <div class="mt-6">
            <button type="button" onclick="addNewField()" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-medium">
                <i class="fas fa-plus"></i>
                <span>Tambah Pertanyaan</span>
            </button>
        </div>
    </form>
</div>
</div>

<!-- ==================== JAVASCRIPT ==================== -->
<script>
let fieldCount = 3;

// Initialize drag and drop
document.addEventListener('DOMContentLoaded', function() {
    initializeDragAndDrop();
});

function initializeDragAndDrop() {
    const container = document.getElementById('fields-container');
    new Sortable(container, {
        animation: 150,
        handle: '.cursor-move',
        onEnd: function(evt) {
            // Reorder field IDs if needed
            console.log('Field reordered');
        }
    });
}

function addNewField() {
    fieldCount++;
    const container = document.getElementById('fields-container');
    
    const fieldHtml = `
        <div class="field-item bg-white rounded-lg shadow-sm border border-gray-200 p-6" data-field-id="${fieldCount}">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="cursor-move text-gray-400 hover:text-gray-600">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <input type="text" 
                           name="fields[${fieldCount}][label]" 
                           placeholder="Pertanyaan" 
                           class="text-lg font-medium text-gray-900 border-0 focus:outline-none focus:ring-0 placeholder-gray-400">
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="toggleRequired(${fieldCount})" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-asterisk" id="required-icon-${fieldCount}"></i>
                    </button>
                    <button type="button" onclick="duplicateField(${fieldCount})" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button type="button" onclick="deleteField(${fieldCount})" class="text-gray-400 hover:text-red-600">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center space-x-4 mb-4">
                <select name="fields[${fieldCount}][type]" onchange="updateFieldOptions(${fieldCount})" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                    <option value="text" selected>Jawaban Singkat</option>
                    <option value="paragraph">Paragraf</option>
                    <option value="multiple_choice">Pilihan Ganda</option>
                    <option value="checkboxes">Kotak Centang</option>
                    <option value="dropdown">Dropdown</option>
                    <option value="file">Unggah File</option>
                    <option value="date">Tanggal</option>
                    <option value="time">Waktu</option>
                </select>
                <input type="hidden" name="fields[${fieldCount}][required]" value="0" id="required-${fieldCount}">
            </div>
            
            <div class="field-preview">
                <input type="text" 
                       placeholder="Jawaban singkat" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2" 
                       disabled>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', fieldHtml);
}

function deleteField(fieldId) {
    if (confirm('Apakah Anda yakin ingin menghapus field ini?')) {
        const field = document.querySelector(`[data-field-id="${fieldId}"]`);
        field.remove();
    }
}

function duplicateField(fieldId) {
    const originalField = document.querySelector(`[data-field-id="${fieldId}"]`);
    const fieldClone = originalField.cloneNode(true);
    
    // Update field ID and names
    fieldCount++;
    fieldClone.setAttribute('data-field-id', fieldCount);
    
    // Update all name attributes
    fieldClone.querySelectorAll('[name]').forEach(element => {
        const name = element.getAttribute('name');
        element.setAttribute('name', name.replace(/\[\d+\]/, `[${fieldCount}]`));
    });
    
    // Update IDs and onclick handlers
    fieldClone.querySelectorAll('[id]').forEach(element => {
        const id = element.getAttribute('id');
        element.setAttribute('id', id.replace(/\d+/, fieldCount));
    });
    
    fieldClone.querySelectorAll('[onclick]').forEach(element => {
        const onclick = element.getAttribute('onclick');
        element.setAttribute('onclick', onclick.replace(/\d+/g, fieldCount));
    });
    
    // Insert after original field
    originalField.parentNode.insertBefore(fieldClone, originalField.nextSibling);
}

function toggleRequired(fieldId) {
    const requiredInput = document.getElementById(`required-${fieldId}`);
    const requiredIcon = document.getElementById(`required-icon-${fieldId}`);
    
    if (requiredInput.value === '1') {
        requiredInput.value = '0';
        requiredIcon.classList.remove('text-red-600');
        requiredIcon.classList.add('text-gray-400');
    } else {
        requiredInput.value = '1';
        requiredIcon.classList.remove('text-gray-400');
        requiredIcon.classList.add('text-red-600');
    }
}

function updateFieldOptions(fieldId) {
    const field = document.querySelector(`[data-field-id="${fieldId}"]`);
    const select = field.querySelector('select');
    const preview = field.querySelector('.field-preview');
    
    const fieldType = select.value;
    
    let previewHtml = '';
    
    switch(fieldType) {
        case 'text':
            previewHtml = '<input type="text" placeholder="Jawaban singkat" class="w-full border border-gray-300 rounded-md px-3 py-2" disabled>';
            break;
        case 'paragraph':
            previewHtml = '<textarea placeholder="Jawaban panjang" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2" disabled></textarea>';
            break;
        case 'multiple_choice':
            previewHtml = `
                <div class="space-y-2">
                    <label class="flex items-center"><input type="radio" name="preview-${fieldId}" disabled class="mr-2"> Pilihan 1</label>
                    <label class="flex items-center"><input type="radio" name="preview-${fieldId}" disabled class="mr-2"> Pilihan 2</label>
                    <button type="button" class="text-blue-600 text-sm">+ Tambah pilihan</button>
                </div>
            `;
            break;
        case 'checkboxes':
            previewHtml = `
                <div class="space-y-2">
                    <label class="flex items-center"><input type="checkbox" disabled class="mr-2"> Pilihan 1</label>
                    <label class="flex items-center"><input type="checkbox" disabled class="mr-2"> Pilihan 2</label>
                    <button type="button" class="text-blue-600 text-sm">+ Tambah pilihan</button>
                </div>
            `;
            break;
        case 'dropdown':
            previewHtml = `
                <select class="w-full border border-gray-300 rounded-md px-3 py-2" disabled>
                    <option>Pilih opsi</option>
                    <option>Pilihan 1</option>
                    <option>Pilihan 2</option>
                </select>
            `;
            break;
        case 'file':
            previewHtml = `
                <div class="w-full border-2 border-dashed border-gray-300 rounded-md p-4 text-center">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600">Klik untuk mengunggah file atau seret file ke sini</p>
                    <p class="text-xs text-gray-500">PDF, JPG, PNG (maks. 10MB)</p>
                </div>
            `;
            break;
        case 'date':
            previewHtml = '<input type="date" class="w-full border border-gray-300 rounded-md px-3 py-2" disabled>';
            break;
        case 'time':
            previewHtml = '<input type="time" class="w-full border border-gray-300 rounded-md px-3 py-2" disabled>';
            break;
    }
    
    preview.innerHTML = previewHtml;
}
</script>

<!-- Include Sortable.js for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</div>
</div>
@endsection
