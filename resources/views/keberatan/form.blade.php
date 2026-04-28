<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Keberatan Informasi Publik - PPID PKTJ</title>
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
            --danger: #dc2626;
        }

        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--dark); }

        .page-header {
            background: linear-gradient(135deg, #7c2020 0%, #991b1b 50%, #b91c1c 100%);
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
        .page-header h1 { font-family: 'Outfit', sans-serif; font-size: 38px; font-weight: 900; letter-spacing: -1px; }
        .page-header p { color: rgba(255,255,255,0.9); font-size: 1rem; max-width: 680px; margin: 12px auto 0; }

        .form-wrap { padding: 0 15px 80px; position: relative; z-index: 5; }
        .form-box {
            max-width: 920px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }

        /* Section label style (A, B, C, D) */
        .section-block { margin-bottom: 32px; }
        .section-label {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
        }
        .section-letter {
            background: var(--primary);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 800;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .section-title-text {
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-top: 6px;
        }
        .section-body {
            background: #fafcff;
            border: 1.5px solid #e8f0fb;
            border-radius: 16px;
            padding: 24px 28px;
        }

        /* Sub-group label dalam section */
        .sub-group-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e8f0fb;
        }

        label { font-size: 13px; font-weight: 600; color: var(--muted); margin-bottom: 5px; display: block; }
        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            transition: border-color .3s, box-shadow .3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0,74,153,0.1);
        }

        /* Checkbox alasan keberatan */
        .alasan-list { display: flex; flex-direction: column; gap: 10px; }
        .alasan-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            transition: all .25s;
        }
        .alasan-item:hover { border-color: var(--primary); background: #f0f6ff; }
        .alasan-item input[type=checkbox] { 
            width: 18px; height: 18px; 
            accent-color: var(--primary); 
            margin-top: 2px; 
            flex-shrink: 0;
            cursor: pointer;
        }
        .alasan-item:has(input:checked) { border-color: var(--primary); background: #eef4ff; }
        .alasan-item label { 
            font-size: 14px; font-weight: 500; 
            color: var(--dark); margin: 0; cursor: pointer; 
            line-height: 1.5;
        }
        .alasan-item:has(input:checked) label { color: var(--primary); font-weight: 600; }

        .req { color: var(--danger); margin-left: 2px; }

        .warning-box {
            background: #fff7ed;
            border-left: 5px solid var(--accent);
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 36px;
            display: flex; gap: 16px; align-items: flex-start;
        }
        .warning-box i { color: var(--accent); font-size: 24px; margin-top: 2px; }
        .warning-box h5 { font-weight: 800; color: #92400e; margin-bottom: 4px; }
        .warning-box p { color: #78350f; margin: 0; font-size: 13px; }

        .btn-submit {
            background: linear-gradient(135deg, #991b1b, #b91c1c);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700; font-size: 17px;
            padding: 16px 40px;
            border: none; border-radius: 14px; width: 100%;
            box-shadow: 0 10px 25px rgba(153,27,27,.25);
            transition: all .4s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(153,27,27,.35); filter: brightness(110%); }

        .divider { border: none; border-top: 2px solid #e8f0fb; margin: 32px 0; }

        @media(max-width:768px){
            .form-box { padding: 24px 16px; border-radius: 24px; }
            .page-header { padding: 60px 0 100px; }
            .page-header h1 { font-size: 26px; }
            .section-body { padding: 18px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-gavel me-3"></i>Pengajuan Keberatan Informasi Publik</h1>
            <p>Pernyataan Keberatan Atas Permohonan Informasi — berdasarkan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</p>
        </div>
    </div>

    <div class="form-wrap">
        <div class="form-box">

            {{-- Alert error --}}
            @if($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                <strong><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan:</strong>
                <ul class="mb-0 mt-2 ps-3 small">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Keberatan Terkirim!',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#991b1b'
                });
            </script>
            @endif

            <div class="warning-box">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <h5>Pernyataan & Pertanggungjawaban</h5>
                    <p>Demikian keberatan ini saya sampaikan. Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.</p>
                </div>
            </div>

            <form action="{{ route('keberatan.store') }}" method="POST" enctype="multipart/form-data" id="keberatanForm">
                @csrf

                {{-- ============================== --}}
                {{-- A. INFORMASI PENGAJU KEBERATAN --}}
                {{-- ============================== --}}
                <div class="section-block">
                    <div class="section-label">
                        <div class="section-letter">A</div>
                        <div class="section-title-text">Informasi Pengaju Keberatan</div>
                    </div>
                    <div class="section-body">

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>Nomor Pendaftaran Pemohon Informasi <span class="req">*</span></label>
                                <input type="number" class="form-control @error('nomor_registrasi_permohonan') is-invalid @enderror"
                                    name="nomor_registrasi_permohonan"
                                    value="{{ old('nomor_registrasi_permohonan') }}"
                                    placeholder="ID permohonan yang diajukan keberatan" required>
                                @error('nomor_registrasi_permohonan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Tujuan Penggunaan Informasi <span class="req">*</span></label>
                                <input type="text" class="form-control @error('tujuan_penggunaan_informasi') is-invalid @enderror"
                                    name="tujuan_penggunaan_informasi"
                                    value="{{ old('tujuan_penggunaan_informasi') }}"
                                    placeholder="cth: Penelitian, pengawasan, dll" required>
                                @error('tujuan_penggunaan_informasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="divider">

                        {{-- Identitas Pemohon --}}
                        <div class="sub-group-label"><i class="fas fa-user me-2"></i>Identitas Pemohon</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>Nama Lengkap <span class="req">*</span></label>
                                <input type="text" name="nama_pemohon"
                                    class="form-control @error('nama_pemohon') is-invalid @enderror"
                                    value="{{ old('nama_pemohon') }}"
                                    placeholder="Nama sesuai identitas" required>
                                @error('nama_pemohon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Pekerjaan <span class="req">*</span></label>
                                <input type="text" name="pekerjaan"
                                    class="form-control @error('pekerjaan') is-invalid @enderror"
                                    value="{{ old('pekerjaan') }}"
                                    placeholder="Pekerjaan saat ini" required>
                                @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label>Alamat <span class="req">*</span></label>
                                <textarea name="alamat" rows="2"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Alamat lengkap domisili" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label>NPWP</label>
                                <input type="text" name="npwp"
                                    class="form-control"
                                    value="{{ old('npwp') }}"
                                    placeholder="Nomor NPWP (opsional)">
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Telepon <span class="req">*</span></label>
                                <input type="tel" name="nomor_telepon"
                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    value="{{ old('nomor_telepon') }}"
                                    placeholder="cth: 08123456789" required>
                                @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label>E-mail <span class="req">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="email@domain.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="divider">

                        {{-- Identitas Kuasa Pemohon --}}
                        <div class="sub-group-label"><i class="fas fa-user-shield me-2"></i>Identitas Kuasa Pemohon <span class="text-muted fw-normal ms-1" style="font-size:12px;">(Kosongkan jika tidak dikuasakan)</span></div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Nama Kuasa</label>
                                <input type="text" name="nama_kuasa"
                                    class="form-control"
                                    value="{{ old('nama_kuasa') }}"
                                    placeholder="Nama perwakilan / kuasa">
                            </div>
                            <div class="col-md-6">
                                <label>Alamat Kuasa</label>
                                <input type="text" name="alamat_kuasa"
                                    class="form-control"
                                    value="{{ old('alamat_kuasa') }}"
                                    placeholder="Alamat perwakilan / kuasa">
                            </div>
                        </div>

                    </div>{{-- end section-body A --}}
                </div>

                {{-- ============================== --}}
                {{-- B. ALASAN PENGAJUAN KEBERATAN --}}
                {{-- ============================== --}}
                <div class="section-block">
                    <div class="section-label">
                        <div class="section-letter">B</div>
                        <div class="section-title-text">Alasan Pengajuan Keberatan</div>
                    </div>
                    <div class="section-body">
                        <p class="text-muted small mb-3">Pilih <strong>satu atau lebih</strong> alasan yang sesuai dengan keberatan Anda:</p>
                        <div class="alasan-list">
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="a"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('a', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Permohonan Informasi ditolak</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="b"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('b', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Informasi berkala tidak disediakan</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="c"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('c', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Permintaan informasi tidak ditanggapi</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="d"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('d', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Permintaan informasi ditanggapi tidak sebagaimana diminta</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="e"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('e', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Permintaan informasi tidak dipenuhi</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="f"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('f', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Biaya yang dikenakan tidak wajar</label>
                            </label>
                            <label class="alasan-item">
                                <input type="checkbox" name="alasan_keberatan_list[]" value="g"
                                    {{ is_array(old('alasan_keberatan_list')) && in_array('g', old('alasan_keberatan_list')) ? 'checked' : '' }}>
                                <label>Informasi disampaikan melebihi jangka waktu yang ditentukan</label>
                            </label>
                        </div>

                        <div class="mt-3">
                            <label class="mt-1">Lainnya (jika tidak ada di atas)</label>
                            <input type="text" name="alasan_keberatan_lainnya"
                                class="form-control"
                                value="{{ old('alasan_keberatan_lainnya') }}"
                                placeholder="Tuliskan alasan lainnya...">
                        </div>

                        @error('alasan_keberatan_list')
                        <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ============================== --}}
                {{-- C. KASUS POSISI               --}}
                {{-- ============================== --}}
                <div class="section-block">
                    <div class="section-label">
                        <div class="section-letter">C</div>
                        <div class="section-title-text">Kasus Posisi</div>
                    </div>
                    <div class="section-body">
                        <label>Jelaskan ringkasan kasus posisi yang terjadi <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="kasus_posisi" rows="4"
                            class="form-control"
                            placeholder="Uraikan kronologi dan posisi kasus secara singkat...">{{ old('kasus_posisi') }}</textarea>
                    </div>
                </div>

                {{-- ============================== --}}
                {{-- LAMPIRAN (tambahan web form)   --}}
                {{-- ============================== --}}
                <div class="section-block">
                    <div class="section-label">
                        <div class="section-letter" style="background:#64748b;"><i class="fas fa-paperclip" style="font-size:13px;"></i></div>
                        <div class="section-title-text" style="color:#64748b;">Lampiran Dokumen</div>
                    </div>
                    <div class="section-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Foto / Scan KTP Pengaju <span class="req">*</span></label>
                                <input type="file" name="file_ktp"
                                    class="form-control @error('file_ktp') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="text-muted small mt-1">Format: JPG, PNG, PDF (Maks. 2MB)</div>
                                @error('file_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Surat Kuasa <span class="text-muted fw-normal">(Jika dikuasakan)</span></label>
                                <input type="file" name="file_surat_kuasa"
                                    class="form-control"
                                    accept=".pdf">
                                <div class="text-muted small mt-1">Format: PDF (Maks. 2MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Kirim --}}
                <div class="mt-4">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Kirim Pengajuan Keberatan
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
        document.getElementById('keberatanForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
