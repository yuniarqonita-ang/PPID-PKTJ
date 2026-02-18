<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Permohonan - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .edit-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 74, 153, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        .form-label {
            font-weight: bold;
            color: #004a99;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .status-info {
            background-color: #e7f3ff;
            border-left: 4px solid #004a99;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-card">
            <div class="mb-4 pb-3" style="border-bottom: 2px solid #004a99;">
                <h3 style="color: #004a99;"><i class="fas fa-edit"></i> Ubah Status Permohonan</h3>
                <p class="text-muted mb-0">Permohonan dari: <strong>{{ $permohonan->nama_pemohon }}</strong></p>
            </div>

            <div class="status-info">
                <i class="fas fa-info-circle"></i>
                <strong>Status Saat Ini:</strong> {{ ucfirst($permohonan->status) }}
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.permohonan.update', $permohonan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">Status Permohonan</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="pending" {{ $permohonan->status == 'pending' ? 'selected' : '' }}>
                            ⏱️ Pending (Menunggu Proses)
                        </option>
                        <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>
                            ⚙️ Diproses (Sedang Dikerjakan)
                        </option>
                        <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>
                            ✅ Selesai (Sudah Ditanggapi)
                        </option>
                        <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>
                            ❌ Ditolak (Tidak Dapat Diberikan)
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg fw-bold">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.permohonan.show', $permohonan) }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
