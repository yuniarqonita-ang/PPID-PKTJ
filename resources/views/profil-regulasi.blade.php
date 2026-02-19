<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }
        .content-box { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); line-height: 1.8; }
        .document-link { display: inline-block; margin: 10px 0; padding: 15px 20px; background-color: #f0f0f0; border-radius: 6px; text-decoration: none; color: #004a99; border-left: 4px solid #ffc107; transition: 0.3s; cursor: pointer; }
        .document-link:hover { background-color: #e8e8e8; transform: translateX(5px); }
        .document-modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); }
        .document-modal.show { display: flex; align-items: center; justify-content: center; }
        .modal-content-custom { background-color: white; border-radius: 8px; width: 90%; max-width: 1200px; height: 80vh; display: flex; flex-direction: column; box-shadow: 0 8px 32px rgba(0,0,0,0.2); }
        .modal-header-custom { padding: 15px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .modal-body-custom { flex: 1; overflow: auto; }
        .modal-body-custom iframe { width: 100%; height: 100%; border: none; }
    </style>
</head>
<body>
    @include('navigation')
    <div class="container py-5">
        <h1 class="page-title">{{ $profil->judul ?? 'Regulasi' }}</h1>
        <div class="content-box">
            @if($profil)
                @if($profil->konten_pembuka)
                    <div class="mb-4">{!! $profil->konten_pembuka !!}</div>
                @endif
                
                @if($profil->konten_detail)
                    <div>{!! $profil->konten_detail !!}</div>
                @endif
                
                @if($profil->link_dokumen)
                    <div class="mt-4">
                        <button class="document-link" onclick="openDocumentPreview('{{ $profil->link_dokumen }}')">
                            <i class="fas fa-file-pdf me-2"></i> Buka Dokumen Regulasi (Preview)
                        </button>
                    </div>
                @endif
            @else
                <p class="text-muted">Konten regulasi belum tersedia.</p>
            @endif
        </div>
    </div>

    <!-- Document Preview Modal -->
    <div id="documentModal" class="document-modal">
        <div class="modal-content-custom">
            <div class="modal-header-custom">
                <h5 class="m-0">Preview Dokumen</h5>
                <button type="button" class="btn-close" onclick="closeDocumentPreview()"></button>
            </div>
            <div class="modal-body-custom">
                <iframe id="documentFrame" src="" frameborder="0" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openDocumentPreview(url) {
            // Convert Google Drive link to embedded preview URL
            let embedUrl = url;
            
            // If it's a Google Drive link, convert it to preview URL
            if (url.includes('drive.google.com')) {
                // Extract file ID from Google Drive URL
                let fileId = '';
                if (url.includes('/d/')) {
                    fileId = url.split('/d/')[1].split('/')[0];
                } else if (url.includes('id=')) {
                    fileId = url.split('id=')[1].split('&')[0];
                }
                
                if (fileId) {
                    embedUrl = `https://drive.google.com/file/d/${fileId}/preview`;
                }
            }
            
            document.getElementById('documentFrame').src = embedUrl;
            document.getElementById('documentModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDocumentPreview() {
            document.getElementById('documentModal').classList.remove('show');
            document.getElementById('documentFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside of it
        document.getElementById('documentModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeDocumentPreview();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDocumentPreview();
            }
        });
    </script>
</body>
</html>

