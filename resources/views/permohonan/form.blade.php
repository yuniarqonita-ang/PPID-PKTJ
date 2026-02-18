<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Informasi Publik - PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 74, 153, 0.15);
        }
        .form-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            padding-bottom: 20px;
        }
        .form-header h2 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-header p {
            color: #666;
            font-size: 14px;
        }
        .form-section-title {
            background-color: #004a99;
            color: white;
            padding: 12px 15px;
            border-radius: 6px;
            margin-top: 25px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 14px;
        }
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .form-group label .required {
            color: #dc3545;
        }
        .form-control, .form-select {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 13px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #004a99;
            box-shadow: 0 0 0 0.2rem rgba(0, 74, 153, 0.25);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-row.full {
            grid-template-columns: 1fr;
        }
        .warning-box {
            background-color: #fce4ec;
            border-left: 5px solid #e91e63;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 25px;
        }
        .warning-box h5 {
            color: #880e4f;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .warning-box p {
            color: #880e4f;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .warning-box ul {
            color: #880e4f;
            margin-left: 20px;
            font-size: 13px;
        }
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #004a99;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #333;
        }
        .btn-simpan {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-simpan:hover {
            background-color: #218838;
            color: white;
        }
        .btn-login {
            background-color: #ffc107;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 6px;
            display: inline-block;
            margin-top: 15px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: #e0a800;
            color: #000;
            text-decoration: none;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .alert {
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('navigation')

    <div class="form-container">
        <div class="form-header">
            <h2>Registrasi & Permohonan Informasi Publik</h2>
            <p>PPID Kementerian Perhubungan - Politeknik Keselamatan Transportasi Jalan Tegal</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>⚠️ Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="warning-box">
            <h5>⚠️ Peringatan!</h5>
            <p>Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan.</p>
            <p>Pastikan data yang diungkapkan telah sesuai dengan ketentuan yang berlaku.</p>
        </div>

        <form action="{{ route('permohonan.store') }}" method="POST" novalidate>
            @csrf

            <!-- BAGIAN 1: DATA AKUN -->
            <div class="form-section-title">📋 DATA AKUN</div>

            <div class="form-row">
                <div class="form-group">
                    <label for="username">
                        Username <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                        id="username" name="username" placeholder="isi username"
                        value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        Email <span class="required">*</span>
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        id="email" name="email" placeholder="isi email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">
                        Password <span class="required">*</span>
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                        id="password" name="password" placeholder="isi password"
                        required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                        id="password_confirmation" name="password_confirmation" placeholder="isi konfirmasi password"
                        required>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BAGIAN 2: DATA PRIBADI -->
            <div class="form-section-title">👤 DATA PRIBADI</div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="nama_pemohon">
                        Nama <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror" 
                        id="nama_pemohon" name="nama_pemohon" placeholder="isi nama lengkap sesuai identitas"
                        value="{{ old('nama_pemohon') }}" required>
                    @error('nama_pemohon')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_identitas">
                        Jenis Identitas <span class="required">*</span>
                    </label>
                    <select class="form-select @error('jenis_identitas') is-invalid @enderror" 
                        id="jenis_identitas" name="jenis_identitas" required>
                        <option value="">-- Pilih jenis identitas --</option>
                        <option value="ktp" {{ old('jenis_identitas') == 'ktp' ? 'selected' : '' }}>KTP (Kartu Tanda Penduduk)</option>
                        <option value="paspor" {{ old('jenis_identitas') == 'paspor' ? 'selected' : '' }}>Paspor</option>
                        <option value="sim" {{ old('jenis_identitas') == 'sim' ? 'selected' : '' }}>SIM (Surat Izin Mengemudi)</option>
                        <option value="lainnya" {{ old('jenis_identitas') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_identitas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nomor_identitas">
                        Nomor Identitas <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" 
                        id="nomor_identitas" name="nomor_identitas" placeholder="isi nomor identitas"
                        value="{{ old('nomor_identitas') }}" required>
                    @error('nomor_identitas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="alamat">
                        Alamat <span class="required">*</span>
                    </label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                        id="alamat" name="alamat" rows="3" placeholder="isi alamat"
                        required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_telepon">
                        No. Telp/HP <span class="required">*</span>
                    </label>
                    <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                        id="nomor_telepon" name="nomor_telepon" placeholder="isi no telp/hp"
                        value="{{ old('nomor_telepon') }}" required>
                    @error('nomor_telepon')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pekerjaan">
                        Pekerjaan
                    </label>
                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                        id="pekerjaan" name="pekerjaan" placeholder="isi pekerjaan"
                        value="{{ old('pekerjaan') }}">
                    @error('pekerjaan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="perusahaan_instansi">
                        Instansi
                    </label>
                    <input type="text" class="form-control @error('perusahaan_instansi') is-invalid @enderror" 
                        id="perusahaan_instansi" name="perusahaan_instansi" placeholder="isi instansi"
                        value="{{ old('perusahaan_instansi') }}">
                    @error('perusahaan_instansi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BAGIAN 3: PERMOHONAN INFORMASI -->
            <div class="form-section-title">📄 DETAIL PERMOHONAN INFORMASI</div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="jenis_informasi">
                        Jenis Informasi yang Diminta <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control @error('jenis_informasi') is-invalid @enderror" 
                        id="jenis_informasi" name="jenis_informasi" placeholder="Contoh: Laporan Keuangan, Struktur Organisasi"
                        value="{{ old('jenis_informasi') }}" required>
                    @error('jenis_informasi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="deskripsi_permohonan">
                        Deskripsi/Uraian Permohonan <span class="required">*</span>
                    </label>
                    <textarea class="form-control @error('deskripsi_permohonan') is-invalid @enderror" 
                        id="deskripsi_permohonan" name="deskripsi_permohonan" rows="4" 
                        placeholder="Jelaskan secara detail informasi apa yang Anda butuhkan dan untuk tujuan apa"
                        required>{{ old('deskripsi_permohonan') }}</textarea>
                    @error('deskripsi_permohonan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="format_informasi">
                        Format Informasi yang Diinginkan <span class="required">*</span>
                    </label>
                    <select class="form-select @error('format_informasi') is-invalid @enderror" 
                        id="format_informasi" name="format_informasi" required>
                        <option value="">-- Pilih Format --</option>
                        <option value="digital" {{ old('format_informasi') == 'digital' ? 'selected' : '' }}>Digital (PDF/Email)</option>
                        <option value="cetak" {{ old('format_informasi') == 'cetak' ? 'selected' : '' }}>Cetak (Hardcopy)</option>
                        <option value="keduanya" {{ old('format_informasi') == 'keduanya' ? 'selected' : '' }}>Keduanya (Digital + Cetak)</option>
                    </select>
                    @error('format_informasi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BUTTONS -->
            <div style="margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px;">
                <button type="submit" class="btn btn-simpan">
                    ✓ Simpan
                </button>
                <div style="margin-top: 15px; text-align: center;">
                    <p style="color: #666; font-size: 13px; margin-bottom: 10px;">Sudah Punya Akun?</p>
                    <a href="{{ route('login') }}" class="btn-login">
                        🔐 Login
                    </a>
                </div>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="{{ route('home') }}" style="color: #004a99; text-decoration: none; font-size: 13px;">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
