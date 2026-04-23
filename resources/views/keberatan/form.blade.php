<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Keberatan Informasi Publik - PPID PKTJ</title>
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

        .required-star { color: #ef4444; margin-left: 2px; }
        .invalid-feedback { font-size: 13px; font-weight: 500; display: block; }

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

        .form-check-label {
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 500;
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
            <h1 class="outfit uppercase">Pengajuan Keberatan Informasi Publik</h1>
            <p>Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</p>
        </div>
    </div>

    <div class="form-wrapper">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4 p-4 shadow-sm" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-circle" style="font-size: 1.25rem;"></i>
                        <strong style="font-weight: 700;">Terjadi Kesalahan:</strong>
                    </div>
                    <ul class="mb-0 small" style="padding-left: 1.5rem; font-weight: 500;">
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
                        title: 'Keberatan Terkirim!',
                        text: '{{ session('success') }}',
                        background: '#fff',
                        confirmButtonColor: '#004a99'
                    });
                </script>
            @endif

            <form action="{{ route('keberatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- SECTION 1: REFERENSI PERMOHONAN -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-search"></i> Referensi Permohonan</h3>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nomor_registrasi_permohonan">ID Permohonan (Referensi)<span class="required-star">*</span></label>
                                <input type="number" class="form-control" name="nomor_registrasi_permohonan" placeholder="Masukkan ID permohonan yang diajukan keberatan..." required>
                                @error('nomor_registrasi_permohonan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: IDENTITAS PENGJU -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-user"></i> Identitas Pengaju Keberatan</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap<span class="required-star">*</span></label>
                                <input type="text" name="nama_pemohon" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan<span class="required-star">*</span></label>
                                <input type="text" name="pekerjaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat<span class="required-star">*</span></label>
                                <textarea name="alamat" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Telepon/WA<span class="required-star">*</span></label>
                                <input type="tel" name="nomor_telepon" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<span class="required-star">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: IDENTITAS KUASA -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-user-shield"></i> Identitas Kuasa (Bila Dikuasakan)</h3>
                    <p class="text-muted small mb-4" style="margin-top: -10px;">Kosongkan jika Anda mengajukan sendiri tanpa perwakilan.</p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kuasa</label>
                                <input type="text" name="nama_kuasa" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Telepon Kuasa</label>
                                <input type="tel" name="nomor_telepon_kuasa" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat Kuasa</label>
                                <textarea name="alamat_kuasa" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: ALASAN KEBERATAN -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-exclamation-triangle"></i> Alasan Pengajuan Keberatan</h3>
                    <p class="text-muted small mb-4" style="margin-top: -10px;">Pilih salah satu atau lebih alasan berikut yang sesuai dengan keluhan Anda.</p>
                    
                    <div class="form-group">
                        <div class="d-flex flex-column gap-3">
                            @php
                                $reasons = [
                                    'a' => 'Penolakan atas permintaan informasi',
                                    'b' => 'Tidak disediakannya informasi berkala',
                                    'c' => 'Tidak ditanggapinya permintaan informasi',
                                    'd' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                                    'e' => 'Tidak dipenuhinya permintaan informasi',
                                    'f' => 'Pengenaan biaya yang tidak wajar',
                                    'g' => 'Penyampaian informasi yang melebihi waktu yang diatur dalam undang-undang'
                                ];
                            @endphp

                            @foreach($reasons as $key => $reason)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="alasan_keberatan_list[]" value="{{ $key }}" id="reason_{{ $key }}">
                                    <label class="form-check-label" for="reason_{{ $key }}">
                                        <strong>{{ strtoupper($key) }}.</strong> {{ $reason }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label>Alasan Lainnya (Opsional)</label>
                        <textarea name="alasan_keberatan_lainnya" rows="3" class="form-control" placeholder="Jelaskan secara singkat jika ada alasan tambahan..."></textarea>
                    </div>

                    <div class="form-group mt-4">
                        <label>Kasus Posisi (Opsional)</label>
                        <textarea name="kasus_posisi" rows="3" class="form-control" placeholder="Jelaskan ringkasan kasus posisi yang terjadi..."></textarea>
                    </div>
                </div>

                <!-- SECTION 5: LAMPIRAN -->
                <div class="section-card">
                    <h3 class="form-section-title uppercase"><i class="fas fa-paperclip"></i> Dokumen Lampiran</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salinan/Foto KTP Pengaju<span class="required-star">*</span></label>
                                <div class="file-upload-wrapper">
                                    <i class="fas fa-id-card text-muted fs-3 mb-2"></i>
                                    <p class="mb-1" style="font-weight:600; color:var(--primary-blue);">Unggah KTP</p>
                                    <p class="small text-muted mb-0">Format: JPG, PNG, PDF (Max 2MB)</p>
                                    <input type="file" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Surat Kuasa (Bila Dikuasakan)</label>
                                <div class="file-upload-wrapper">
                                    <i class="fas fa-file-signature text-muted fs-3 mb-2"></i>
                                    <p class="mb-1" style="font-weight:600; color:var(--primary-blue);">Unggah Surat Kuasa</p>
                                    <p class="small text-muted mb-0">Format: PDF (Max 2MB)</p>
                                    <input type="file" name="file_surat_kuasa" accept=".pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="warning-banner shadow-sm mt-5">
                    <div class="bg-red-100 p-3 rounded-circle" style="background-color: #fecaca; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
                        <i class="fas fa-shield-alt" style="margin: 0;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Pernyataan & Pertanggungjawaban</h5>
                        <p>Demikian keberatan ini saya sampaikan, saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Pengajuan Keberatan
                    </button>
                </div>

            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update file input UI on select
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                if(this.files && this.files[0]) {
                    let wrapper = this.closest('.file-upload-wrapper');
                    let p = wrapper.querySelector('p:first-of-type');
                    p.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> ` + this.files[0].name;
                    p.style.color = '#10b981';
                    wrapper.style.borderColor = '#10b981';
                    wrapper.style.backgroundColor = '#ecfdf5';
                }
            });
        });
    </script>
</body>
</html>
