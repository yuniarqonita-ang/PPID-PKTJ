<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Permohonan - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            background-color: #004a99;
            color: white;
        }
        .status-badge {
            font-size: 12px;
            font-weight: bold;
            padding: 5px 10px;
        }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-diproses { background-color: #17a2b8; color: white; }
        .status-selesai { background-color: #28a745; color: white; }
        .status-ditolak { background-color: #dc3545; color: white; }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold" style="color: #004a99;">📋 Kelola Permohonan Informasi</h2>
                            <p class="text-muted">Total: {{ $permohonan->total() }} permohonan</p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali Dashboard</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background-color: #004a99; color: white;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Email</th>
                                        <th>Jenis Informasi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permohonan as $item)
                                        <tr>
                                            <td>{{ ($permohonan->currentPage() - 1) * $permohonan->perPage() + $loop->iteration }}</td>
                                            <td><strong>{{ $item->nama_pemohon }}</strong></td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->jenis_informasi }}</td>
                                            <td>{{ $item->tanggal_permohonan->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $item->status }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.permohonan.show', $item) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.permohonan.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit Status">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.permohonan.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                Belum ada permohonan informasi.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $permohonan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
