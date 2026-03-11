@extends('layouts.app')

@section('title', 'Daftar Informasi Publik')

@push('styles')
{{-- Jika ada CSS khusus untuk halaman ini --}}
<style>
    .table-responsive {
        overflow-x: auto;
    }
    .table th {
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-list-ul me-2"></i>
                Daftar Informasi Publik (DIP)
            </h5>
            <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>
                Tambah Informasi Baru
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari informasi...">
                        <button class="btn btn-outline-secondary" type="button" id="button-search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-light text-center align-middle">
                        <tr>
                            <th>#</th>
                            <th>PENANGGUNG JAWAB</th>
                            <th>INFORMASI</th>
                            <th>JENIS INFORMASI</th>
                            <th>RINGKASAN INFORMASI</th>
                            <th>PEJABAT YANG MENGUASAI INFORMASI</th>
                            <th>PENERBIT INFORMASI</th>
                            <th>BENTUK INFORMASI YANG TERSEDIA</th>
                            <th>TEMPAT PEMBUATAN</th>
                            <th>WAKTU PEMBUATAN</th>
                            <th>JANGKA WAKTU PENYIMPANAN / RETENSI WAKTU</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data Dummy. Data ini nantinya akan diisi dari database melalui controller. --}}
                        @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td>BPSDMP</td>
                            <td>Laporan Keuangan Tahunan {{ date('Y') - $i }}</td>
                            <td class="text-center">Berkala</td>
                            <td>Ringkasan laporan keuangan tahunan yang telah diaudit oleh auditor independen.</td>
                            <td>Kepala Pusat Pengembangan SDM Perhubungan Darat</td>
                            <td>PPID BPSDMP</td>
                            <td class="text-center">Softcopy (PDF)</td>
                            <td>Jakarta</td>
                            <td class="text-center">01-01-{{ date('Y') - $i + 1 }}</td>
                            <td class="text-center">10 Tahun</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing 1-5 of 670 items.
                </div>
                {{-- Di sini akan ditempatkan link pagination dari Laravel, contoh: {{ $items->links() }} --}}
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection