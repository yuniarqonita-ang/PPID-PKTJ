<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Informasi Publik - PPID PKTJ</title>
    <!-- Google Fonts: Inter & Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --glass-bg: rgba(17, 25, 40, 0.75);
            --glass-border: rgba(255, 255, 255, 0.125);
            --primary-glow: rgba(0, 183, 255, 0.5);
            --accent-cyan: #06b6d4;
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --text-main: #e2e8f0;
            --text-dim: #94a3b8;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: radial-gradient(circle at top right, #1e293b, #0f172a, #020617);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        .form-container {
            max-width: 1000px;
            margin: 60px auto;
            background: var(--glass-bg);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .form-container::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue), var(--accent-purple));
            z-index: -1;
            border-radius: 26px;
            opacity: 0.15;
        }

        .form-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .form-header h1 {
            font-size: 38px;
            font-weight: 900;
            background: linear-gradient(to right, #67e8f9, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .form-header p {
            color: var(--text-dim);
            font-size: 16px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 35px;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 25px;
            position: relative;
        }

        .form-section-title i {
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 24px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dim);
            margin-bottom: 8px;
            display: block;
            transition: color 0.3s;
        }

        .form-group:focus-within label {
            color: var(--accent-cyan);
        }

        .form-control, .form-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px 16px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control:focus, .form-select:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.15);
            outline: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #475569;
        }

        .warning-banner {
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.02));
            border-left: 4px solid #ef4444;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 40px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .warning-banner i { color: #ef4444; font-size: 22px; }
        .warning-banner div h5 { color: #fecaca; font-weight: 700; margin-bottom: 5px; font-size: 16px; }
        .warning-banner div p { color: #f87171; margin: 0; font-size: 14px; }

        .btn-submit {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 16px;
            padding: 16px 40px;
            border: none;
            border-radius: 14px;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 30px -10px rgba(59, 130, 246, 0.6);
            color: white;
        }

        .btn-login {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-main);
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-cyan);
            color: #fff;
        }

        .required-star { color: #ef4444; margin-left: 2px; }

        .invalid-feedback { font-size: 12px; color: #f87171; margin-top: 5px; }

        .file-upload-wrapper {
            position: relative;
            background: rgba(15, 23, 42, 0.4);
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .file-upload-wrapper:hover {
            border-color: var(--accent-cyan);
            background: rgba(15, 23, 42, 0.6);
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-info { color: var(--text-dim); font-size: 13px; margin-top: 8px; }
        .file-upload-info i { margin-right: 5px; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }

        @media (max-width: 768px) {
            .form-container { padding: 30px 20px; margin: 20px 15px; }
            .form-header h1 { font-size: 28px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="outfit">Permohonan Informasi Publik</h1>
                <p>Silakan lengkapi formulir di bawah ini dengan data yang benar untuk mengajukan permohonan informasi ke PPID PKTJ Tegal.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 bg-red-900/20 text-red-300 rounded-xl mb-4" style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); color: #fca5a5;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Terjadi Kesalahan!</strong>
                    </div>
                    <ul class="mb-0 small ps-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        background: '#111928',
                        color: '#fff',
                        confirmButtonColor: '#3b82f6'
                    });
                </script>
            @endif

            <div class="warning-banner">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <h5>Pernyataan & Pertanggungjawaban</h5>
                    <p>Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.</p>
                </div>
            </div>

            <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" id="mainForm">
                @csrf

                <!-- BAGIAN 1: DATA AKUN -->
                <div class="section-card">
                    <h3 class="form-section-title"><i class="fas fa-key"></i> Kredensial Akun</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    id="username" name="username" placeholder="cth: budi_santo"
                                    value="{{ old('username') }}" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Alamat Email<span class="required-star">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" placeholder="email@domain.com"
                                    value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Kata Sandi<span class="required-star">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" placeholder="Minimal 8 karakter" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Sandi<span class="required-star">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: DATA PRIBADI -->
                <div class="section-card">
                    <h3 class="form-section-title"><i class="fas fa-user-circle"></i> Informasi Identitas</h3>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama_pemohon">Nama Lengkap<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror" 
                                    id="nama_pemohon" name="nama_pemohon" placeholder="Sesuai kartu identitas"
                                    value="{{ old('nama_pemohon') }}" required>
                                @error('nama_pemohon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_identitas">Jenis Identitas<span class="required-star">*</span></label>
                                <select class="form-select @error('jenis_identitas') is-invalid @enderror" id="jenis_identitas" name="jenis_identitas" required>
                                    <option value="" selected disabled>Pilih Identitas</option>
                                    <option value="ktp" {{ old('jenis_identitas') == 'ktp' ? 'selected' : '' }}>KTP (Kartu Tanda Penduduk)</option>
                                    <option value="paspor" {{ old('jenis_identitas') == 'paspor' ? 'selected' : '' }}>Paspor</option>
                                    <option value="sim" {{ old('jenis_identitas') == 'sim' ? 'selected' : '' }}>SIM</option>
                                    <option value="lainnya" {{ old('jenis_identitas') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_identitas">Nomor Rekening/ID<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" 
                                    id="nomor_identitas" name="nomor_identitas" placeholder="Nomor pada kartu identitas"
                                    value="{{ old('nomor_identitas') }}" required>
                                @error('nomor_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap Domisili<span class="required-star">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat pengiriman/korespondensi" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_telepon">No. Telepon / WhatsApp<span class="required-star">*</span></label>
                                <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                                    id="nomor_telepon" name="nomor_telepon" placeholder="cth: 0812xxxx"
                                    value="{{ old('nomor_telepon') }}" required>
                                @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan saat ini" value="{{ old('pekerjaan') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="perusahaan_instansi">Nama Instansi / Perusahaan</label>
                                <input type="text" class="form-control" id="perusahaan_instansi" name="perusahaan_instansi" placeholder="Isi jika mewakili lembaga" value="{{ old('perusahaan_instansi') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Unggah Foto Identitas (KTP/Paspor)<span class="required-star">*</span></label>
                                <div class="file-upload-wrapper">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-cyan-400 mb-2 d-block"></i>
                                    <span class="text-white fw-medium">Klik atau tarik file ke sini</span>
                                    <input type="file" name="foto_ktp" accept=".jpg,.jpeg,.png,.pdf" required onchange="updateFileName(this)">
                                    <div class="file-upload-info"><i class="fas fa-info-circle"></i> JPG, PNG, atau PDF (Maks. 5MB)</div>
                                    <div class="selected-file-name mt-2 text-cyan-400 fw-bold"></div>
                                </div>
                                @error('foto_ktp')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: DETAIL PERMOHONAN -->
                <div class="section-card">
                    <h3 class="form-section-title"><i class="fas fa-file-invoice"></i> Detail Permohonan</h3>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenis_informasi">Informasi yang Dibutuhkan<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('jenis_informasi') is-invalid @enderror" 
                                    id="jenis_informasi" name="jenis_informasi" placeholder="cth: Laporan Tahunan 2023, Dokumen SOP"
                                    value="{{ old('jenis_informasi') }}" required>
                                @error('jenis_informasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi_permohonan">Alasan & Deskripsi Permohonan<span class="required-star">*</span></label>
                                <textarea class="form-control @error('deskripsi_permohonan') is-invalid @enderror" 
                                    id="deskripsi_permohonan" name="deskripsi_permohonan" rows="4" 
                                    placeholder="Jelaskan kebutuhan Anda secara detail dan tujuan penggunaan informasi tersebut"
                                    required>{{ old('deskripsi_permohonan') }}</textarea>
                                @error('deskripsi_permohonan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="format_informasi">Format Output<span class="required-star">*</span></label>
                                <select class="form-select" id="format_informasi" name="format_informasi" required>
                                    <option value="" selected disabled>Pilih Format</option>
                                    <option value="digital">Digital (Email/Link Download)</option>
                                    <option value="cetak">Salinan Cetak (Hardcopy)</option>
                                    <option value="keduanya">Digital & Cetak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Berkas Pendukung (Opsional)</label>
                                <input type="file" class="form-control" name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                <div class="file-upload-info">PDF, DOC, atau Gambar (Maks. 10MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION: DYNAMIC CUSTOM FIELDS -->
                @if(isset($customFields) && count($customFields) > 0)
                <div class="section-card">
                    <h3 class="form-section-title"><i class="fas fa-plus-square"></i> {{ $sectionTitle ?? 'Informasi Tambahan' }}</h3>
                    <p class="text-dim small mb-4">Informasi berikut merupakan kolom khusus yang diperlukan oleh Admin PPID.</p>
                    <div class="row g-4">
                        @foreach($customFields as $field)
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="{{ $field['name'] }}">{{ $field['label'] }}<span class="required-star">*</span></label>
                                    
                                    @if($field['type'] == 'text')
                                        <input type="text" class="form-control" id="{{ $field['name'] }}" name="custom_fields[{{ $field['name'] }}]" placeholder="Ketik {{ $field['label'] }}..." required>
                                    @elseif($field['type'] == 'textarea')
                                        <textarea class="form-control" id="{{ $field['name'] }}" name="custom_fields[{{ $field['name'] }}]" rows="3" placeholder="Jelaskan {{ $field['label'] }}..." required></textarea>
                                    @elseif($field['type'] == 'file')
                                        <div class="file-upload-wrapper" style="padding: 10px;">
                                            <input type="file" id="{{ $field['name'] }}" name="custom_fields_file[{{ $field['name'] }}]" required onchange="updateFileName(this)">
                                            <div class="text-white small fw-bold">Pilih File {{ $field['label'] }}</div>
                                            <div class="selected-file-name text-cyan-400 x-small"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-5 text-center">
                    <button type="submit" class="btn-submit mb-4" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Kirim Permohonan Sekarang
                    </button>
                    
                    <div class="d-flex flex-column align-items-center gap-3">
                        <p class="text-dim mb-0">Sudah pernah mendaftar?</p>
                        <a href="{{ route('login') }}" class="btn-login shadow-sm">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Akun
                        </a>
                        <a href="{{ route('home') }}" class="text-cyan-500 text-decoration-none mt-2 small hover:underline">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Background Decoration -->
    <div style="position:fixed; top:10%; left:-10%; width:400px; height:400px; background:var(--accent-blue); filter:blur(150px); opacity:0.1; z-index:-1; pointer-events:none;"></div>
    <div style="position:fixed; bottom:10%; right:-10%; width:500px; height:500px; background:var(--accent-purple); filter:blur(180px); opacity:0.1; z-index:-1; pointer-events:none;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateFileName(input) {
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const container = input.closest('.file-upload-wrapper') || input.parentElement;
                const display = container.querySelector('.selected-file-name');
                if (display) {
                    display.innerText = 'Terpilih: ' + fileName;
                }
            }
        }

        document.getElementById('mainForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
