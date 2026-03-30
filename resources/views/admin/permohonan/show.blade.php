<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 74, 153, 0.1);
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #004a99;
            min-width: 200px;
        }
        .detail-value {
            color: #f8fafc; background: transparent;
            flex: 1;
        }
        .status-badge {
            display: inline-block;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
        }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-diproses { background-color: #17a2b8; color: white; }
        .status-selesai { background-color: #28a745; color: white; }
        .status-ditolak { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #004a99;">📋 Detail Permohonan Informasi</h2>
            <a href="{{ route('admin.permohonan.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{ session('success') }}
            </div>
        @endif

        <div class="detail-card">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 2px solid #004a99;">
                <h4 style="color: #004a99;"><i class="fas fa-user-check"></i> Informasi Pemohon</h4>
                <span class="status-badge status-{{ $permohonan->status }}">
                    {{ ucfirst($permohonan->status) }}
                </span>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nama Lengkap</div>
                <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value">
                    <a href="mailto:{{ $permohonan->email }}">{{ $permohonan->email }}</a>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nomor Identitas</div>
                <div class="detail-value">{{ $permohonan->nomor_identitas }}</div>
            </div>

            @if($permohonan->foto_ktp)
            <div class="detail-row">
                <div class="detail-label">Foto Identitas (KTP/dll)</div>
                <div class="detail-value">
                    <a href="{{ Storage::url($permohonan->foto_ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-id-card"></i> Lihat Dokumen Identitas
                    </a>
                </div>
            </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Nomor Telepon</div>
                <div class="detail-value">{{ $permohonan->nomor_telepon }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Alamat</div>
                <div class="detail-value">{{ $permohonan->alamat }}</div>
            </div>

            @if($permohonan->perusahaan_instansi)
                <div class="detail-row">
                    <div class="detail-label">Perusahaan/Instansi</div>
                    <div class="detail-value">{{ $permohonan->perusahaan_instansi }}</div>
                </div>
            @endif
        </div>

        <div class="detail-card">
            <div class="mb-4 pb-3" style="border-bottom: 2px solid #004a99;">
                <h4 style="color: #004a99;"><i class="fas fa-file-alt"></i> Detail Permohonan</h4>
            </div>

            <div class="detail-row">
                <div class="detail-label">Jenis Informasi</div>
                <div class="detail-value">{{ $permohonan->jenis_informasi }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Deskripsi/Uraian</div>
                <div class="detail-value">
                    <p style="white-space: pre-wrap;">{{ $permohonan->deskripsi_permohonan }}</p>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Format Informasi</div>
                <div class="detail-value">
                    @if($permohonan->format_informasi == 'digital')
                        <i class="fas fa-envelope-open-text"></i> Digital (PDF/Email)
                    @elseif($permohonan->format_informasi == 'cetak')
                        <i class="fas fa-file"></i> Cetak (Hardcopy)
                    @else
                        <i class="fas fa-copy"></i> Keduanya (Digital + Cetak)
                    @endif
                </div>
            </div>

            @if($permohonan->berkas_pendukung)
            <div class="detail-row">
                <div class="detail-label">Berkas Pendukung</div>
                <div class="detail-value">
                    <a href="{{ Storage::url($permohonan->berkas_pendukung) }}" target="_blank" class="btn btn-sm btn-outline-success shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-file-download"></i> Unduh Berkas Lampiran
                    </a>
                </div>
            </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Tanggal Permohonan</div>
                <div class="detail-value">{{ $permohonan->tanggal_permohonan ? $permohonan->tanggal_permohonan->format('d MMMM Y pukul H:i') : $permohonan->created_at->format('d M Y') }}</div>
            </div>

            @if($permohonan->custom_fields_data && is_array($permohonan->custom_fields_data) && count($permohonan->custom_fields_data) > 0)
            <div class="mt-4 pt-3 border-t border-slate-700/50">
                <div class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold" style="border-radius: 6px;"><i class="fas fa-star"></i> FIELD CUSTOM TAMBAHAN</div>
                
                @foreach($permohonan->custom_fields_data as $key => $value)
                <div class="detail-row">
                    <div class="detail-label" style="text-transform: capitalize; color: #f39c12;">
                        {{ str_replace('_', ' ', preg_replace('/^custom_|_\\d+$/', '', $key)) }}
                    </div>
                    <div class="detail-value">
                        @if(is_string($value) && str_starts_with($value, 'permohonan/custom'))
                            <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-outline-warning shadow-sm" style="border-radius: 8px;">
                                <i class="fas fa-file-download"></i> Unduh File
                            </a>
                        @else
                            {{ is_array($value) ? json_encode($value) : $value }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.permohonan.edit', $permohonan) }}" class="btn btn-warning fw-bold">
                <i class="fas fa-edit"></i> Ubah Status
            </a>
            <form action="{{ route('admin.permohonan.destroy', $permohonan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus permohonan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger fw-bold">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
