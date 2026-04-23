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
                        <option value="pending" {{ $permohonan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                  <!-- Laporan Kategori -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-file-invoice text-blue-500"></i>
                    <h5 class="text-xs font-black text-blue-900 uppercase">Data Registrasi & Laporan (Kemenhub)</h5>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">NPWP Pemohon</label>
                        <input type="text" name="npwp" value="{{ $permohonan->npwp }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Kategori Laporan Bulanan</label>
                        <select name="kategori_laporan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                            <option value="">Pilih Kategori</option>
                            <option value="berkala" {{ $permohonan->kategori_laporan == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                            <option value="sertamerta" {{ $permohonan->kategori_laporan == 'sertamerta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                            <option value="setiapsaat" {{ $permohonan->kategori_laporan == 'setiapsaat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                            <option value="dikecualikan" {{ $permohonan->kategori_laporan == 'dikecualikan' ? 'selected' : '' }}>Informasi Dikecualikan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Status Informasi</label>
                        <select name="status_informasi_dikuasai" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700">
                            <option value="1" {{ $permohonan->status_informasi_dikuasai ? 'selected' : '' }}>Di Bawah Penguasaan PPID</option>
                            <option value="0" {{ !$permohonan->status_informasi_dikuasai ? 'selected' : '' }}>Tidak Di Bawah Penguasaan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Bentuk Salinan</label>
                        <select name="bentuk_informasi_salinan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700">
                            <option value="Softcopy" {{ $permohonan->bentuk_informasi_salinan == 'Softcopy' ? 'selected' : '' }}>Softcopy (Digital)</option>
                            <option value="Hardcopy" {{ $permohonan->bentuk_informasi_salinan == 'Hardcopy' ? 'selected' : '' }}>Hardcopy (Salinan Cetak)</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Penolakan (Pasal UU / Alasan Teknis)</label>
                        <input type="text" name="penolakan_pasal_uu" value="{{ $permohonan->penolakan_pasal_uu }}" placeholder="Cth: Pasal 17 Huruf a UU KIP" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Biaya Salinan (Hanya jika berbayar)</label>
                        <input type="number" name="biaya_salinan" value="{{ $permohonan->biaya_salinan }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Cara Pembayaran</label>
                        <input type="text" name="cara_pembayaran" value="{{ $permohonan->cara_pembayaran }}" placeholder="Cth: Tunai / Transfer Bank" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700">
                    </div>
                </div>
            </div>
<small class="text-muted"><i class="fas fa-info-circle"></i> Pilih kategori ini agar permohonan muncul di kolom yang benar pada laporan bulanan.</small>
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
