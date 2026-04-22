<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['permohonan_title'] ?? 'Permohonan Informasi Publik' }} - {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</title>
    <!-- Google Fonts: Inter & Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-blue: #0066cc;
            --accent-yellow: #ffc107;
            --bg-light: #f8f9fa;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        .page-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0056b3 50%, var(--secondary-blue) 100%);
            padding: 100px 0 140px;
            color: white;
            text-align: center;
            margin-bottom: -80px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .form-header h1 {
            font-size: 42px;
            font-weight: 900;
            color: white;
            margin-bottom: 20px;
            letter-spacing: -1px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-header p {
            color: rgba(255,255,255,0.95);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 500;
        }

        .section-card {
            background: #fdfdfd;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 35px;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.05);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 25px;
        }

        .form-section-title i {
            color: var(--accent-yellow);
            font-size: 22px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: block;
        }

        .form-control, .form-select {
            background: #fff;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            color: var(--text-dark);
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
            outline: none;
        }

        .warning-banner {
            background: #fff5f5;
            border-left: 5px solid #ef4444;
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 40px;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .warning-banner i { color: #ef4444; font-size: 28px; }
        .warning-banner h5 { color: #b91c1c; font-weight: 800; margin-bottom: 4px; font-size: 17px; }
        .warning-banner p { color: #7f1d1d; margin: 0; font-size: 14px; line-height: 1.6; }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 17px;
            padding: 18px 45px;
            border: none;
            border-radius: 16px;
            width: 100%;
            transition: all 0.4s;
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.25);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 74, 153, 0.35);
            filter: brightness(110%);
            color: white;
        }

        .btn-login {
            background: #fff;
            border: 1.5px solid var(--border-color);
            color: var(--text-dark);
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s;
        }

        .btn-login:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            background: #f8fafc;
        }

        .required-star { color: #ef4444; margin-left: 2px; }
        .invalid-feedback { font-size: 13px; font-weight: 500; }

        .file-upload-wrapper {
            position: relative;
            background: #f8fafc;
            border: 2px dashed var(--border-color);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s;
        }

        .file-upload-wrapper {
            position: relative;
            background: #f8fafc;
            border: 2px dashed var(--border-color);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s;
        }

        .file-upload-wrapper:hover {
            border-color: var(--primary-blue);
            background: #f1f5f9;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;
        }

        .form-wrapper {
            padding: 0 20px 80px;
            background-color: var(--bg-light);
            position: relative;
            z-index: 5;
        }

        .form-container { 
            max-width: 900px; 
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0, 74, 153, 0.08);
            border: 1px solid rgba(0, 74, 153, 0.05);
        }

        @media (max-width: 768px) {
            .form-container { padding: 30px 20px; border-radius: 30px; }
            .form-header h1 { font-size: 26px; }
            .page-header { padding: 60px 0 100px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <div class="page-header">
        <div class="container form-header text-center">
            <h1 class="outfit uppercase">{{ $settings['permohonan_title'] ?? 'Permohonan Informasi Publik' }}</h1>
            <p>{{ $settings['permohonan_subtitle'] ?? 'Silakan lengkapi formulir di bawah ini dengan data yang benar untuk mengajukan permohonan informasi ke PPID PKTJ Tegal.' }}</p>
        </div>
    </div>

    <div class="form-wrapper">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-xl mb-4 p-4 shadow-sm" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-circle text-lg"></i>
                        <strong class="font-bold">Terjadi Kesalahan Sinkronisasi:</strong>
                    </div>
                    <ul class="mb-0 small ps-4 font-medium">
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
                        title: 'Permohonan Terkirim!',
                        text: '{{ session('success') }}',
                        background: '#fff',
                        confirmButtonColor: '#004a99'
                    });
                </script>
            @endif


            <div class="warning-banner shadow-sm">
                <div class="bg-red-100 p-3 rounded-circle">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h5 class="fw-bold">{{ $settings['permohonan_warning_title'] ?? 'Pernyataan & Pertanggungjawaban' }}</h5>
                    <p>{{ $settings['permohonan_warning_text'] ?? 'Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.' }}</p>
                </div>
            </div>

            <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" id="mainForm">
                @csrf

                <!-- BAGIAN 1: DATA AKUN -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-id-badge"></i> {{ $settings['permohonan_label_title_akun'] ?? 'Kredensial Akun' }}</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">{{ $settings['permohonan_label_username'] ?? 'Username Akses' }}<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    id="username" name="username" placeholder="cth: budi_santo"
                                    value="{{ old('username') }}" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ $settings['permohonan_label_email'] ?? 'Alamat Kontak Email' }}<span class="required-star">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" placeholder="email@domain.com"
                                    value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">{{ $settings['permohonan_label_password'] ?? 'Kata Sandi Baru' }}<span class="required-star">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" placeholder="Minimal 8 karakter" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">{{ $settings['permohonan_label_password_confirmation'] ?? 'Ulangi Kata Sandi' }}<span class="required-star">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi ulang" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: DATA PRIBADI -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-user-check"></i> {{ $settings['permohonan_label_title_identitas'] ?? 'Data Identitas Pemohon' }}</h3>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama_pemohon">{{ $settings['permohonan_label_nama'] ?? 'Nama Lengkap (Sesuai Identitas)' }}<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror" 
                                    id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan nama lengkap"
                                    value="{{ old('nama_pemohon') }}" required>
                                @error('nama_pemohon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_identitas">{{ $settings['permohonan_label_jenis_identitas'] ?? 'Jenis Kartu Identitas' }}<span class="required-star">*</span></label>
                                <select class="form-select @error('jenis_identitas') is-invalid @enderror" id="jenis_identitas" name="jenis_identitas" required>
                                    <option value="" selected disabled>Pilih Identitas</option>
                                    <option value="ktp" {{ old('jenis_identitas') == 'ktp' ? 'selected' : '' }}>KTP (Kartu Tanda Penduduk)</option>
                                    <option value="paspor" {{ old('jenis_identitas') == 'paspor' ? 'selected' : '' }}>Paspor Nasional</option>
                                    <option value="sim" {{ old('jenis_identitas') == 'sim' ? 'selected' : '' }}>SIM (Surat Izin Mengemudi)</option>
                                    <option value="lainnya" {{ old('jenis_identitas') == 'lainnya' ? 'selected' : '' }}>Identitas Lainnya</option>
                                </select>
                                @error('jenis_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_identitas">{{ $settings['permohonan_label_nomor_identitas'] ?? 'Nomor ID Card / NIK' }}<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" 
                                    id="nomor_identitas" name="nomor_identitas" placeholder="Masukkan nomor identitas"
                                    value="{{ old('nomor_identitas') }}" required>
                                @error('nomor_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">{{ $settings['permohonan_label_alamat'] ?? 'Alamat Domisili Sekarang' }}<span class="required-star">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap korespondensi" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_telepon">{{ $settings['permohonan_label_telepon'] ?? 'Nomor WhatsApp Aktif' }}<span class="required-star">*</span></label>
                                <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                                    id="nomor_telepon" name="nomor_telepon" placeholder="cth: 0812xxxx"
                                    value="{{ old('nomor_telepon') }}" required>
                                @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        @if(($settings['permohonan_show_pekerjaan'] ?? 'yes') === 'yes')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan">{{ $settings['permohonan_label_pekerjaan'] ?? 'Pekerjaan Utama' }}</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Sebutkan pekerjaan" value="{{ old('pekerjaan') }}">
                            </div>
                        </div>
                        @endif
                        @if(($settings['permohonan_show_lembaga'] ?? 'yes') === 'yes')
                        <div class="col-12">
                            <div class="form-group">
                                <label for="perusahaan_instansi">{{ $settings['permohonan_label_lembaga'] ?? 'Nama Lembaga (Opsional)' }}</label>
                                <input type="text" class="form-control" id="perusahaan_instansi" name="perusahaan_instansi" placeholder="Isi jika mewakili instansi tertentu" value="{{ old('perusahaan_instansi') }}">
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ $settings['permohonan_label_ktp'] ?? 'Unggah Scan/Foto Identitas Resmi' }}<span class="required-star">*</span></label>
                                <div class="file-upload-wrapper">
                                    <i class="fas fa-file-invoice fa-2x text-blue-500 mb-2 d-block"></i>
                                    <span class="text-dark fw-bold">Pilih file identitas Anda</span>
                                    <input type="file" name="foto_ktp" accept=".jpg,.jpeg,.png,.pdf" required onchange="updateFileName(this)">
                                    <div class="text-muted small mt-2">Format: JPG, PNG, atau PDF (Maks. 5MB)</div>
                                    <div class="selected-file-name mt-2 text-blue-600 fw-black"></div>
                                </div>
                                @error('foto_ktp')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: DETAIL PERMOHONAN -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-file-signature"></i> {{ $settings['permohonan_label_title_permohonan'] ?? 'Rincian Informasi Yang Dimohon' }}</h3>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenis_informasi">{{ $settings['permohonan_label_judul_informasi'] ?? 'Nama / Judul Informasi' }}<span class="required-star">*</span></label>
                                <input type="text" class="form-control @error('jenis_informasi') is-invalid @enderror" 
                                    id="jenis_informasi" name="jenis_informasi" placeholder="cth: Laporan Anggaran Semester 1 2024"
                                    value="{{ old('jenis_informasi') }}" required>
                                @error('jenis_informasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi_permohonan">{{ $settings['permohonan_label_tujuan'] ?? 'Tujuan Penggunaan Informasi' }}<span class="required-star">*</span></label>
                                <textarea class="form-control @error('deskripsi_permohonan') is-invalid @enderror" 
                                    id="deskripsi_permohonan" name="deskripsi_permohonan" rows="4" 
                                    placeholder="Jelaskan secara spesifik mengapa Anda membutuhkan informasi ini"
                                    required>{{ old('deskripsi_permohonan') }}</textarea>
                                @error('deskripsi_permohonan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="format_informasi">{{ $settings['permohonan_label_metode'] ?? 'Metode Perolehan Informasi' }}<span class="required-star">*</span></label>
                                <select class="form-select" id="format_informasi" name="format_informasi" required>
                                    <option value="" selected disabled>Pilih Metode</option>
                                    <option value="digital">Digital (Email/Cloud Link)</option>
                                    <option value="cetak">Softcopy & Salinan Cetak (Kantor)</option>
                                    <option value="keduanya">Digital & Salinan Fisik</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $settings['permohonan_label_pendukung'] ?? 'Dokumen Pendukung Tambahan' }}</label>
                                <input type="file" class="form-control" name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                <div class="text-muted small mt-1">Format: PDF atau DOC (Maks. 10MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION: DYNAMIC CUSTOM FIELDS -->
                @if(isset($customFields) && count($customFields) > 0)
                <div class="section-card border-blue-100 bg-blue-50/10">
                    <h3 class="form-section-title uppercase"><i class="fas fa-clipboard-list"></i> {{ $sectionTitle ?? 'KELENGKAPAN BERKAS KHUSUS' }}</h3>
                    <p class="text-muted small mb-4">Informasi berikut merupakan kuesioner tambahan yang diwajibkan oleh tim Admin PPID.</p>
                    <div class="row g-4">
                        @foreach($customFields as $field)
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="uppercase font-black text-[11px] tracking-widest" for="{{ $field['name'] }}">{{ $field['label'] }}<span class="required-star">*</span></label>
                                    
                                    @if($field['type'] == 'text')
                                        <input type="text" class="form-control" id="{{ $field['name'] }}" name="custom_fields[{{ $field['name'] }}]" placeholder="Masukkan data sesuai label..." required>
                                    @elseif($field['type'] == 'textarea')
                                        <textarea class="form-control" id="{{ $field['name'] }}" name="custom_fields[{{ $field['name'] }}]" rows="3" placeholder="Berikan penjelasan lengkap..." required></textarea>
                                    @elseif($field['type'] == 'file')
                                        <div class="file-upload-wrapper py-3">
                                            <input type="file" id="{{ $field['name'] }}" name="custom_fields_file[{{ $field['name'] }}]" required onchange="updateFileName(this)">
                                            <div class="text-blue-700 small fw-bold">Pilih Dokumen [{{ $field['label'] }}]</div>
                                            <div class="selected-file-name text-blue-500 small mt-1"></div>
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
                        <i class="fas fa-check-circle"></i> Submit Permohonan Resmi
                    </button>
                    
                    <div class="d-flex flex-column align-items-center gap-3">
                        <p class="text-muted mb-0">Atau sudah memiliki akun pemohon?</p>
                        <a href="{{ route('login') }}" class="btn-login shadow-sm">
                            <i class="fas fa-lock-open me-2"></i> Klik Disini Untuk Login
                        </a>
                        
                        <!-- NEW: HAK-HAK PEMOHON INFO (Collapsible - Moved to Bottom Middle) -->
                        @if(!empty($settings['permohonan_hak_hak']))
                        <div class="mt-4 w-100" style="max-width: 500px;">
                            <button class="w-full text-center px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center gap-3 group hover:bg-emerald-100 transition-all shadow-sm" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#hakPemohonInfo" aria-expanded="false">
                                <div class="w-8 h-8 bg-emerald-600 text-white rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-gavel text-xs"></i>
                                </div>
                                <div class="text-start">
                                    <h6 class="mb-0 text-emerald-900 fw-bold outfit text-[11px] uppercase tracking-wider">Lihat Hak-hak Pemohon Informasi</h6>
                                </div>
                                <i class="fas fa-chevron-down text-emerald-400 group-hover:text-emerald-600 transition-transform text-xs"></i>
                            </button>
                            <div class="collapse" id="hakPemohonInfo">
                                <div class="mt-3 p-5 bg-white border border-emerald-100 rounded-2xl shadow-inner text-xs leading-relaxed law-text text-start">
                                    {!! $settings['permohonan_hak_hak'] !!}
                                </div>
                            </div>
                        </div>

                        <style>
                            .law-text p { margin-bottom: 0.8rem; }
                            .law-text strong { color: var(--primary-blue); }
                            #hakPemohonInfo.show + button i { transform: rotate(180deg); }
                        </style>
                        @endif

                        <a href="{{ route('home') }}" class="text-blue-600 text-decoration-none mt-3 small fw-bold uppercase tracking-widest hover:text-blue-800 transition-all">
                            <i class="fas fa-chevron-left me-2"></i> Kembali ke Beranda PPID
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateFileName(input) {
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const container = input.closest('.file-upload-wrapper') || input.parentElement;
                const display = container.querySelector('.selected-file-name');
                if (display) {
                    display.innerText = 'Dipilih: ' + fileName;
                }
            }
        }

        document.getElementById('mainForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> SEDANG MENGIRIM...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
