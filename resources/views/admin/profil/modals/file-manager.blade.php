<!-- Modal: File Manager untuk Upload Cover -->
<div class="modal fade modal-fullscreen" id="fileManagerModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title">
                        <i class="fas fa-folder-open"></i> Penyimpanan File
                    </h5>
                    <small class="text-white-50">Pilih atau upload sampul/cover untuk halaman Anda</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- TOOLBAR -->
                <div class="file-manager-toolbar">
                    <div class="toolbar-section">
                        <button class="toolbar-icon" title="Upload File" onclick="document.getElementById('fileUpload').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="tooltip-text">Upload</span>
                        </button>
                        <button class="toolbar-icon" title="Paste to Directory">
                            <i class="fas fa-paste"></i>
                            <span class="tooltip-text">Paste</span>
                        </button>
                        <button class="toolbar-icon" title="Clear Clipboard">
                            <i class="fas fa-eraser"></i>
                            <span class="tooltip-text">Clear</span>
                        </button>
                    </div>

                    <div class="view-options">
                        <button class="view-btn active" title="Box View">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                        <button class="view-btn" title="Columns View">
                            <i class="fas fa-columns"></i>
                        </button>
                    </div>

                    <div class="filter-section">
                        <label for="fileFilter">
                            <i class="fas fa-filter"></i> Filters:
                        </label>
                        <input type="text" id="fileFilter" class="filter-input" placeholder="Cari file...">
                    </div>
                </div>

                <div class="file-manager-divider"></div>

                <!-- BREADCRUMB & INFO -->
                <div class="breadcrumb-section">
                    <button class="breadcrumb-item">
                        <i class="fas fa-home"></i>
                    </button>
                    <span class="breadcrumb-info">
                        <span class="file-count">5 File</span>
                        <span class="separator">•</span>
                        <span class="folder-count">2 Folder</span>
                    </span>

                    <div class="right-section">
                        <div class="sort-menu">
                            <button class="sort-btn">
                                <i class="fas fa-sort"></i> Sorting
                            </button>
                            <div class="sort-dropdown">
                                <div class="sort-option">File Name</div>
                                <div class="sort-option">Date</div>
                                <div class="sort-option">Size</div>
                                <div class="sort-option">Type</div>
                            </div>
                        </div>

                        <button class="toolbar-icon" title="Refresh">
                            <i class="fas fa-sync-alt"></i>
                        </button>

                        <button class="toolbar-icon" title="Help" data-bs-toggle="tooltip">
                            <i class="fas fa-question-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="file-manager-divider"></div>

                <!-- FILE LIST AREA -->
                <div class="file-list-container">
                    <div class="file-item">
                        <div class="file-preview">
                            <img src="https://via.placeholder.com/150" alt="File">
                        </div>
                        <div class="file-info">
                            <p class="file-name">banner-profil.jpg</p>
                            <small class="file-size">2.4 MB</small>
                        </div>
                        <button class="file-select-btn" onclick="selectFile('banner-profil.jpg', 'https://via.placeholder.com/150')">
                            Pilih
                        </button>
                    </div>

                    <div class="file-item">
                        <div class="file-preview">
                            <img src="https://via.placeholder.com/150" alt="File">
                        </div>
                        <div class="file-info">
                            <p class="file-name">cover-organisasi.png</p>
                            <small class="file-size">1.8 MB</small>
                        </div>
                        <button class="file-select-btn" onclick="selectFile('cover-organisasi.png', 'https://via.placeholder.com/150')">
                            Pilih
                        </button>
                    </div>

                    <div class="file-item">
                        <div class="file-preview">
                            <img src="https://via.placeholder.com/150" alt="File">
                        </div>
                        <div class="file-info">
                            <p class="file-name">struktur-ppid.jpg</p>
                            <small class="file-size">3.1 MB</small>
                        </div>
                        <button class="file-select-btn" onclick="selectFile('struktur-ppid.jpg', 'https://via.placeholder.com/150')">
                            Pilih
                        </button>
                    </div>
                </div>

                <!-- HIDDEN FILE INPUT -->
                <input type="file" id="fileUpload" style="display:none;" accept="image/*" onchange="handleFileUpload(event)">
            </div>
        </div>
    </div>
</div>

<style>
.file-manager-toolbar {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px;
    background: linear-gradient(135deg, #f5f7fa 0%, #f9f9f9 100%);
    border-radius: 8px;
    flex-wrap: wrap;
}

.toolbar-section {
    display: flex;
    gap: 10px;
}

.toolbar-icon {
    width: 40px;
    height: 40px;
    border: none;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    position: relative;
    transition: all 0.3s ease;
    color: #333;
    font-size: 0.95rem;
}

.toolbar-icon:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.toolbar-icon .tooltip-text {
    position: absolute;
    bottom: -35px;
    background: #333;
    color: white;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 0.75rem;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
}

.toolbar-icon:hover .tooltip-text {
    opacity: 1;
}

.view-options {
    display: flex;
    gap: 8px;
    margin-left: auto;
}

.view-btn {
    width: 36px;
    height: 36px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #999;
    font-size: 0.9rem;
}

.view-btn.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.view-btn:hover {
    border-color: #667eea;
}

.filter-section {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-section label {
    font-weight: 600;
    color: #333;
    white-space: nowrap;
}

.filter-input {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    width: 150px;
    transition: all 0.3s ease;
}

.filter-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.file-manager-divider {
    height: 1px;
    background: #e0e0e0;
    margin: 15px 0;
}

.breadcrumb-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 0;
    flex-wrap: wrap;
}

.breadcrumb-item {
    width: 36px;
    height: 36px;
    border: none;
    background: #f0f0f0;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.breadcrumb-item:hover {
    background: #667eea;
    color: white;
}

.breadcrumb-info {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
    font-size: 0.9rem;
}

.separator {
    opacity: 0.5;
}

.right-section {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-left: auto;
}

.sort-menu {
    position: relative;
}

.sort-btn {
    padding: 8px 12px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sort-btn:hover {
    background: #f0f0f0;
    border-color: #667eea;
}

.sort-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: none;
    min-width: 150px;
    margin-top: 8px;
    z-index: 100;
}

.sort-menu:hover .sort-dropdown {
    display: block;
}

.sort-option {
    padding: 10px 15px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 0.9rem;
    color: #333;
}

.sort-option:hover {
    background: #f0f0f0;
}

.file-list-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    padding: 20px 0;
    max-height: 400px;
    overflow-y: auto;
}

.file-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 15px;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-item:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.file-preview {
    width: 100%;
    height: 100px;
    border-radius: 6px;
    overflow: hidden;
    background: #f0f0f0;
}

.file-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-info {
    width: 100%;
}

.file-name {
    margin: 0;
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.file-size {
    color: #999;
    font-size: 0.8rem;
}

.file-select-btn {
    width: 100%;
    padding: 8px 12px;
    background: var(--primary-gradient);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.file-select-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
}
</style>

<script>
function selectFile(filename, preview) {
    document.getElementById('gambar').value = filename;
    document.getElementById('coverPreview').src = preview;
    bootstrap.Modal.getInstance(document.getElementById('fileManagerModal')).hide();
}

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Add file to list and select it
            selectFile(file.name, e.target.result);
        };
        reader.readAsDataURL(file);
    }
}
</script>
