<!DOCTYPE html>
<html>
<head>
    <title>Upload Test - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
        .upload-form { background: #f5f5f5; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .file-list { background: white; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #ddd; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        .preview { max-width: 100px; max-height: 100px; object-fit: cover; }
    </style>
</head>
<body>
    <h1>🗂️ Upload Test - Admin Panel</h1>
    <p>Test upload functionality untuk admin panel PPID.</p>

    <div class="upload-form">
        <h3>Upload File Baru</h3>

        <?php
        // Create uploads directory if it doesn't exist
        $uploadDir = __DIR__ . '/uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Handle file upload
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
            $file = $_FILES['test_file'];
            $description = trim($_POST['file_description'] ?? '');
            $category = trim($_POST['file_category'] ?? '');

            echo "<div style='margin: 10px 0; padding: 10px; border-radius: 5px;'>";

            if ($file['error'] === UPLOAD_ERR_OK) {
                $fileName = basename($file['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    // Save file info to a simple text file for demo
                    $fileInfo = date('Y-m-d H:i:s') . " | $fileName | $category | $description | " . $file['size'] . " bytes\n";
                    file_put_contents($uploadDir . 'uploaded_files.txt', $fileInfo, FILE_APPEND);

                    echo "<div class='success'>✅ File berhasil diupload!</div>";
                    echo "<strong>File:</strong> $fileName<br>";
                    echo "<strong>Ukuran:</strong> " . number_format($file['size']) . " bytes<br>";
                    echo "<strong>Kategori:</strong> $category<br>";
                    echo "<strong>Deskripsi:</strong> $description<br>";
                    echo "<strong>Path:</strong> uploads/$fileName<br>";
                } else {
                    echo "<div class='error'>❌ Gagal memindahkan file ke server</div>";
                }
            } else {
                $errorMsg = '';
                switch ($file['error']) {
                    case UPLOAD_ERR_INI_SIZE: $errorMsg = 'File terlalu besar (server limit)'; break;
                    case UPLOAD_ERR_FORM_SIZE: $errorMsg = 'File terlalu besar (form limit)'; break;
                    case UPLOAD_ERR_PARTIAL: $errorMsg = 'File hanya terupload sebagian'; break;
                    case UPLOAD_ERR_NO_FILE: $errorMsg = 'Tidak ada file yang dipilih'; break;
                    default: $errorMsg = 'Error upload tidak diketahui';
                }
                echo "<div class='error'>❌ Error: $errorMsg</div>";
            }

            echo "</div>";
        }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div style="margin: 10px 0;">
                <label><strong>Pilih File:</strong></label><br>
                <input type="file" name="test_file" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx,.ppt,.pptx">
                <small style="color: #666;">Maksimal 10MB. Format: PDF, DOC, XLS, PPT, JPG, PNG</small>
            </div>

            <div style="margin: 10px 0;">
                <label><strong>Kategori File:</strong></label><br>
                <select name="file_category" required style="width: 200px; padding: 5px;">
                    <option value="">Pilih Kategori</option>
                    <option value="document">Dokumen</option>
                    <option value="image">Gambar</option>
                    <option value="spreadsheet">Spreadsheet</option>
                    <option value="presentation">Presentasi</option>
                </select>
            </div>

            <div style="margin: 10px 0;">
                <label><strong>Deskripsi File:</strong></label><br>
                <textarea name="file_description" rows="3" cols="50" placeholder="Jelaskan isi file ini..."></textarea>
            </div>

            <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-upload" style="margin-right: 5px;"></i>Upload File
            </button>
        </form>
    </div>

    <div class="file-list">
        <h3>📁 File yang Sudah Diupload</h3>

        <?php
        $uploadedFiles = [];
        $logFile = $uploadDir . 'uploaded_files.txt';

        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (array_reverse($lines) as $line) {
                $parts = explode(' | ', $line);
                if (count($parts) >= 5) {
                    $uploadedFiles[] = [
                        'date' => $parts[0],
                        'name' => $parts[1],
                        'category' => $parts[2],
                        'description' => $parts[3],
                        'size' => $parts[4]
                    ];
                }
            }
        }

        if (empty($uploadedFiles)) {
            echo "<p class='info'>Belum ada file yang diupload.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Tanggal</th><th>Nama File</th><th>Kategori</th><th>Ukuran</th><th>Deskripsi</th><th>Download</th></tr>";

            foreach ($uploadedFiles as $file) {
                $filePath = $uploadDir . $file['name'];
                $downloadUrl = "uploads/" . $file['name'];

                echo "<tr>";
                echo "<td>" . $file['date'] . "</td>";
                echo "<td>" . $file['name'] . "</td>";
                echo "<td>" . $file['category'] . "</td>";
                echo "<td>" . $file['size'] . "</td>";
                echo "<td>" . $file['description'] . "</td>";
                echo "<td>";
                if (file_exists($filePath)) {
                    echo "<a href='$downloadUrl' target='_blank' style='color: #007bff;'>Download</a>";
                } else {
                    echo "<span style='color: red;'>File hilang</span>";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>

    <div style="margin: 20px 0; padding: 15px; background: #e9ecef; border-radius: 5px;">
        <h4>📋 Test Results:</h4>
        <ul>
            <li><strong>Upload Directory:</strong> <?php echo realpath($uploadDir); ?></li>
            <li><strong>Directory Writable:</strong> <?php echo is_writable($uploadDir) ? '<span class="success">YES</span>' : '<span class="error">NO</span>'; ?></li>
            <li><strong>PHP File Uploads:</strong> <?php echo ini_get('file_uploads') ? '<span class="success">ENABLED</span>' : '<span class="error">DISABLED</span>'; ?></li>
            <li><strong>Max Upload Size:</strong> <?php echo ini_get('upload_max_filesize'); ?></li>
            <li><strong>Post Max Size:</strong> <?php echo ini_get('post_max_size'); ?></li>
        </ul>
    </div>

    <div style="margin: 20px 0;">
        <a href="admin.php" style="color: #007bff;"><i class="fas fa-arrow-left"></i> Kembali ke Admin Dashboard</a>
    </div>
</body>
</html>
