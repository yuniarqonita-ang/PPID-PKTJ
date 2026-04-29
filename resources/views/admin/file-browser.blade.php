<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Browser - PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8fafc; font-family: 'Inter', sans-serif; padding: 20px; }
        .file-card {
            background: white;
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            padding: 15px;
            transition: all 0.3s;
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .file-card:hover {
            border-color: #004a99;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        .file-preview {
            width: 100%;
            height: 120px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            overflow: hidden;
        }
        .file-preview img {
            width: 100%;
            height: 100%;
            object-contain: center;
        }
        .file-name {
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            word-break: break-all;
            margin-bottom: 5px;
        }
        .file-info {
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 600;
        }
        .badge-folder {
            font-size: 0.6rem;
            text-transform: uppercase;
            padding: 4px 8px;
            border-radius: 5px;
            margin-bottom: 8px;
        }
        .bg-editor { background: #dbeafe; color: #1e40af; }
        .bg-halaman { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="fw-bold text-dark mb-0">Pilih Asset / File</h5>
            <input type="text" id="fileSearch" class="form-control w-50" placeholder="Cari nama file...">
        </div>

        <div class="row g-3" id="fileList">
            @foreach($files as $file)
                <div class="col-6 col-md-4 col-lg-3 file-item" data-name="{{ strtolower($file['name']) }}">
                    <div class="file-card" onclick="selectFile('{{ $file['url'] }}')">
                        <div class="badge-folder {{ $file['folder'] == 'editor_uploads' ? 'bg-editor' : 'bg-halaman' }}">
                            {{ str_replace('_', ' ', $file['folder']) }}
                        </div>
                        <div class="file-preview">
                            @if(Str::startsWith($file['type'], 'image/'))
                                <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}">
                            @else
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            @endif
                        </div>
                        <div class="file-name">{{ $file['name'] }}</div>
                        <div class="file-info">{{ number_format($file['size'] / 1024, 1) }} KB</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function selectFile(url) {
            window.parent.postMessage({
                mceAction: 'fileSelected',
                data: { url: url }
            }, '*');
        }

        document.getElementById('fileSearch').addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.file-item').forEach(item => {
                const name = item.getAttribute('data-name');
                item.style.display = name.includes(query) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
