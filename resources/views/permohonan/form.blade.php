<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Informasi Publik - PPID PKTJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #004a99;
            --secondary: #0066cc;
            --accent: #ffc107;
            --bg: #f0f4f8;
            --dark: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--dark); }
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #0056b3 60%, var(--secondary) 100%);
            padding: 90px 0 130px;
            color: white;
            text-align: center;
            margin-bottom: -70px;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
        }
        .page-header h1 { font-family: 'Outfit', sans-serif; font-size: 40px; font-weight: 900; letter-spacing: -1px; }
        .page-header p { color: rgba(255,255,255,0.9); font-size: 1.05rem; max-width: 700px; margin: 0 auto; }
        .form-wrap { padding: 0 15px 80px; position: relative; z-index: 5; }
        .form-box {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 36px;
            box-shadow: 0 20px 60px rgba(0,74,153,0.09);
        }
        .section-card {
            background: #fafcff;
            border: 1.5px solid #e8f0fb;
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 30px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .section-card:hover { border-color: var(--primary); box-shadow: 0 8px 24px rgba(0,74,153,0.07); }
        .sec-title {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 17px; font-weight: 700;
            color: var(--primary); margin-bottom: 22px;
            text-transform: uppercase; letter-spacing: .5px;
        }
        .sec-title i { color: var(--accent); font-size: 19px; }
        label { font-size: 13px; font-weight: 600; color: var(--muted); margin-bottom: 6px; display: block; }
        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            transition: border-color .3s, box-shadow .3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0,74,153,0.1);
        }
        .radio-group { display: flex; gap: 12px; flex-wrap: wrap; }
        .radio-card {
            flex: 1; min-width: 130px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            cursor: pointer;
            transition: all .3s;
            display: flex; align-items: center; gap: 9px;
            font-size: 14px; font-weight: 500;
        }
        .radio-card input[type=radio] { accent-color: var(--primary); width: 16px; height: 16px; }
        .radio-card:has(input:checked) {
            border-color: var(--primary);
            background: #eef4ff;
            color: var(--primary);
        }
        .warning-box {
            background: #fff9f0;
            border-left: 5px solid var(--accent);
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 32px;
            display: flex; gap: 16px; align-items: flex-start;
        }
        .warning-box i { color: var(--accent); font-size: 26px; margin-top: 2px; }
        .warning-box h5 { font-weight: 800; color: #92400e; margin-bottom: 4px; }
        .warning-box p { color: #78350f; margin: 0; font-size: 13px; }
        .req { color: #ef4444; margin-left: 2px; }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700; font-size: 17px;
            padding: 16px 40px;
            border: none; border-radius: 14px; width: 100%;
            box-shadow: 0 10px 25px rgba(0,74,153,.25);
            transition: all .4s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,74,153,.35); filter: brightness(110%); }
        @media(max-width:768px) {
            .form-box { padding: 24px 16px; border-radius: 24px; }
            .page-header { padding: 60px 0 100px; }
            .page-header h1 { font-size: 26px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <div class="page-header">
        <div class="container">
            <h1>Permohonan Informasi Publik</h1>
            <p class="mt-3">Silakan isi formulir berikut dengan data yang benar untuk mengajukan permohonan informasi kepada PPID PKTJ Tegal.</p>
        </div>
    </div>

    <div class="form-wrap">
        <div class="form-box">

            @if($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                <strong><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan:</strong>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <script>
                Swal.fire({ icon:'success', title:'Permohonan Terkirim!', text:'{{ session("success") }}', confirmButtonColor:'#004a99' });
            </script>
            @endif

            <div class="warning-box">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <h5>Pernyataan & Pertanggungjawaban</h5>
                    <p>Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan perundang-undangan yang berlaku.</p>
                </div>
            </div>

            <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" id="mainForm">
                @csrf

                {{-- BAGIAN 1: DATA PEMOHON --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-user-circle"></i> Data Identitas Pemohon</div>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="tanggal_permohonan">Tanggal Permohonan <span class="req">*</span></label>
                            <input type="date" class="form-control @error('tanggal_permohonan') is-invalid @enderror"
                                id="tanggal_permohonan" name="tanggal_permohonan"
                                value="{{ old('tanggal_permohonan', date('Y-m-d')) }}" required>
                            @error('tanggal_permohonan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_pemohon">Nama Lengkap <span class="req">*</span></label>
                            <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror"
                                id="nama_pemohon" name="nama_pemohon"
                                placeholder="Nama sesuai identitas"
                                value="{{ old('nama_pemohon') }}" required>
                            @error('nama_pemohon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat">Alamat <span class="req">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" rows="2"
                                placeholder="Alamat lengkap domisili" required>{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control"
                                id="pekerjaan" name="pekerjaan"
                                placeholder="Sebutkan pekerjaan Anda"
                                value="{{ old('pekerjaan') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control"
                                id="npwp" name="npwp"
                                placeholder="Nomor NPWP (opsional)"
                                value="{{ old('npwp') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="nomor_telepon">No. Telepon <span class="req">*</span></label>
                            <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                id="nomor_telepon" name="nomor_telepon"
                                placeholder="cth: 08123456789"
                                value="{{ old('nomor_telepon') }}" required>
                            @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email">Alamat Email <span class="req">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email"
                                placeholder="email@domain.com"
                                value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>

                {{-- BAGIAN 2: RINCIAN INFORMASI --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-file-alt"></i> Rincian Informasi yang Dibutuhkan</div>
                    <div class="row g-3">

                        <div class="col-12">
                            <label for="rincian_informasi">Rincian Informasi yang Dibutuhkan <span class="req">*</span></label>
                            <textarea class="form-control @error('rincian_informasi') is-invalid @enderror"
                                id="rincian_informasi" name="rincian_informasi" rows="4"
                                placeholder="Jelaskan secara rinci informasi apa yang Anda butuhkan" required>{{ old('rincian_informasi') }}</textarea>
                            @error('rincian_informasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label for="tujuan_penggunaan">Tujuan Penggunaan Informasi <span class="req">*</span></label>
                            <textarea class="form-control @error('tujuan_penggunaan') is-invalid @enderror"
                                id="tujuan_penggunaan" name="tujuan_penggunaan" rows="3"
                                placeholder="Jelaskan tujuan Anda menggunakan informasi ini" required>{{ old('tujuan_penggunaan') }}</textarea>
                            @error('tujuan_penggunaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>

                {{-- BAGIAN 3: STATUS INFORMASI --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-info-circle"></i> Status Informasi</div>
                    <div class="row g-4">

                        <div class="col-12">
                            <label>Status Informasi di Bawah Penguasaan <span class="req">*</span></label>
                            <div class="radio-group mt-2">
                                <label class="radio-card">
                                    <input type="radio" name="status_informasi_dikuasai" value="ya"
                                        {{ old('status_informasi_dikuasai') == 'ya' ? 'checked' : '' }} required>
                                    <i class="fas fa-check-circle text-success"></i> Ya
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status_informasi_dikuasai" value="tidak"
                                        {{ old('status_informasi_dikuasai') == 'tidak' ? 'checked' : '' }}>
                                    <i class="fas fa-times-circle text-danger"></i> Tidak
                                </label>
                            </div>
                            @error('status_informasi_dikuasai')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label>Status Informasi Belum Didokumentasikan</label>
                            <div class="radio-group mt-2">
                                <label class="radio-card">
                                    <input type="radio" name="status_informasi_belum_didokumentasikan" value="ya"
                                        {{ old('status_informasi_belum_didokumentasikan') == 'ya' ? 'checked' : '' }}>
                                    <i class="fas fa-check-circle text-success"></i> Ya
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status_informasi_belum_didokumentasikan" value="tidak"
                                        {{ old('status_informasi_belum_didokumentasikan') == 'tidak' ? 'checked' : '' }}>
                                    <i class="fas fa-times-circle text-danger"></i> Tidak
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- BAGIAN 4: BENTUK & JENIS PERMOHONAN --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-copy"></i> Bentuk & Jenis Permohonan</div>
                    <div class="row g-4">

                        <div class="col-12">
                            <label>Bentuk Informasi yang Dikuasai <span class="req">*</span></label>
                            <div class="radio-group mt-2">
                                <label class="radio-card">
                                    <input type="radio" name="bentuk_informasi_salinan" value="Softcopy"
                                        {{ old('bentuk_informasi_salinan') == 'Softcopy' ? 'checked' : '' }} required>
                                    <i class="fas fa-laptop text-primary"></i> Softcopy
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="bentuk_informasi_salinan" value="Hardcopy"
                                        {{ old('bentuk_informasi_salinan') == 'Hardcopy' ? 'checked' : '' }}>
                                    <i class="fas fa-print text-secondary"></i> Hardcopy
                                </label>
                            </div>
                            @error('bentuk_informasi_salinan')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label>Jenis Permohonan <span class="req">*</span></label>
                            <div class="radio-group mt-2">
                                <label class="radio-card">
                                    <input type="radio" name="jenis_permohonan_salinan" value="Melihat"
                                        {{ old('jenis_permohonan_salinan') == 'Melihat' ? 'checked' : '' }} required>
                                    <i class="fas fa-eye text-info"></i> Melihat / Mendengar
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="jenis_permohonan_salinan" value="Meminta Salinan"
                                        {{ old('jenis_permohonan_salinan') == 'Meminta Salinan' ? 'checked' : '' }}>
                                    <i class="fas fa-file-download text-warning"></i> Meminta Salinan
                                </label>
                            </div>
                            @error('jenis_permohonan_salinan')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>

                {{-- BAGIAN 5: DOKUMEN PENDUKUNG --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-paperclip"></i> Dokumen Pendukung</div>
                    <div class="row g-3">

                        <div class="col-12">
                            <label>Scan / Foto KTP atau Identitas <span class="req">*</span></label>
                            <input type="file" class="form-control @error('foto_ktp') is-invalid @enderror"
                                name="foto_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                            <div class="text-muted small mt-1">Format: JPG, PNG, atau PDF (Maks. 5MB)</div>
                            @error('foto_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label>Berkas Pendukung Tambahan <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="file" class="form-control"
                                name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <div class="text-muted small mt-1">Format: PDF, DOC (Maks. 10MB)</div>
                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Kirim Permohonan
                    </button>
                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                            <i class="fas fa-chevron-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('mainForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
