<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($peraturan->judul); ?> - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f2f2f2; 
            margin: 0;
            padding: 0;
        }
        
        .viewer-toolbar {
            background-color: #004a99;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .viewer-title {
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 60%;
        }
        
        .viewer-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .viewer-actions a, .viewer-actions button {
            padding: 8px 15px;
            background-color: #ffc107;
            color: #333;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 14px;
        }
        
        .viewer-actions a:hover, .viewer-actions button:hover {
            background-color: #e0a800;
        }
        
        .viewer-actions button {
            background-color: #6c757d;
            color: white;
        }
        
        .viewer-actions button:hover {
            background-color: #5a6268;
        }
        
        #pdf-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: calc(100vh - 80px);
            background-color: #f2f2f2;
            overflow: auto;
        }
        
        #pdf-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: white;
        }
        
        .no-pdf {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: calc(100vh - 80px);
            background-color: #f2f2f2;
        }
        
        .no-pdf-content {
            text-align: center;
            color: #6c757d;
        }
        
        .no-pdf-content i {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .viewer-title {
                max-width: 40%;
                font-size: 14px;
            }
            
            .viewer-actions {
                gap: 5px;
            }
            
            .viewer-actions a, .viewer-actions button {
                padding: 6px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="viewer-toolbar">
        <div class="viewer-title">
            <i class="fas fa-file-pdf"></i> <?php echo e($peraturan->judul); ?>

        </div>
        <div class="viewer-actions">
            <a href="<?php echo e(route('profil.regulasi')); ?>" title="Kembali">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div id="pdf-container">
        <?php if($peraturan->file_path && pathinfo($peraturan->file_path, PATHINFO_EXTENSION) === 'pdf'): ?>
            <iframe src="<?php echo e(asset('storage/' . $peraturan->file_path)); ?>" allowfullscreen></iframe>
        <?php else: ?>
            <div class="no-pdf-content">
                <i class="fas fa-exclamation-triangle"></i>
                <h5>File PDF Tidak Tersedia</h5>
                <p class="text-muted">Dokumen untuk peraturan ini belum di-upload.</p>
                <a href="<?php echo e(route('profil.regulasi')); ?>" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Regulasi
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/peraturan-view.blade.php ENDPATH**/ ?>