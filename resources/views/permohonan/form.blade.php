<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
    @endphp
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
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

            {{-- PROFIL PEMOHON (RINGKASAN DATA IDENTITAS) --}}
            @if(isset($applicant))
            <div class="section-card" style="background: #f0f7ff; border-color: #c7d9ff;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #004a99, #0066cc); font-size: 18px;">
                            {{ strtoupper(substr($applicant->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h4 class="outfit fw-bold text-dark mb-0 fs-5">{{ $applicant->name }}</h4>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill text-xs px-2 py-1">
                                    <i class="fas fa-check-circle me-1"></i> Data Identitas Terverifikasi
                                </span>
                            </div>
                            <div class="text-muted small mt-0.5">
                                <span><i class="fas fa-id-card me-1 text-primary"></i> {{ $applicant->nomor_identitas }}</span> &bull; 
                                <span><i class="fas fa-envelope me-1 text-primary"></i> {{ $applicant->email }}</span> &bull;
                                <span><i class="fas fa-phone me-1 text-primary"></i> {{ $applicant->no_telp }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('permohonan.gateway') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold text-xs">
                        <i class="fas fa-user-edit me-1"></i> Ubah Identitas
                    </a>
                </div>
            </div>
            @endif

            <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" id="mainForm">
                @csrf

                @if(!isset($applicant))
                {{-- BAGIAN IDENTITAS PEMOHON (JIKA BELUM LOGIN) --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-id-card"></i> Data Identitas Pemohon</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_pemohon">Nama Lengkap Sesuai KTP <span class="req">*</span></label>
                            <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" value="{{ old('nama_pemohon') }}" required placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="col-md-6">
                            <label for="nomor_identitas">Nomor Identitas (NIK KTP / SIM / Paspor) <span class="req">*</span></label>
                            <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" value="{{ old('nomor_identitas') }}" required placeholder="Contoh: 3328xxxxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Alamat Email Aktif <span class="req">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required placeholder="nama@email.com">
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp">Nomor WhatsApp / HP <span class="req">*</span></label>
                            <input type="tel" class="form-control" name="no_telp" id="no_telp" value="{{ old('no_telp') }}" required placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label for="pekerjaan">Pekerjaan / Profesi</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Contoh: Wiraswasta / Mahasiswa / Karyawan">
                        </div>
                        <div class="col-md-6">
                            <label for="file_identitas">Upload Foto KTP / Identitas</label>
                            <input type="file" class="form-control" name="file_identitas" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="text-muted small mt-1" style="font-size: 11px;">Maks 5 MB (JPG, PNG, PDF)</div>
                        </div>
                        <div class="col-12">
                            <label for="alamat">Alamat Domisili Lengkap <span class="req">*</span></label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="2" required placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>
                @endif

                {{-- BAGIAN 1: JENIS PERMOHONAN --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-users"></i> Jenis Permohonan</div>
                    <p class="text-muted small mb-3">Silahkan pilih jenis permohonan untuk perorangan atau organisasi. Jika anda memerlukan informasi untuk keperluan pribadi silahkan memilih pilihan perorangan. Jika anda mewakili suatu organisasi/kelompok silahkan memilih pilihan organisasi/kelompok.</p>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="radio-group">
                                <label class="radio-card">
                                    <input type="radio" name="jenis_pemohon" value="Perorangan" 
                                        {{ old('jenis_pemohon', 'Perorangan') == 'Perorangan' ? 'checked' : '' }} required
                                        onclick="toggleAkta(false)">
                                    Perorangan
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="jenis_pemohon" value="Organisasi"
                                        {{ old('jenis_pemohon') == 'Organisasi' ? 'checked' : '' }}
                                        onclick="toggleAkta(true)">
                                    Organisasi / Kelompok
                                </label>
                            </div>
                        </div>

                        <div id="akta_wrap" class="col-12 {{ old('jenis_pemohon') == 'Organisasi' ? '' : 'd-none' }}">
                            <label for="berkas_pendukung">Akta Pendirian (Untuk Organisasi/Kelompok)</label>
                            <input type="file" class="form-control" name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="text-muted small mt-1">Maks 10 MB (JPG, PNG, PDF)</div>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 3: RINCIAN INFORMASI --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-file-alt"></i> Detail Permohonan</div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="rincian_informasi">Rincian Informasi yang Dibutuhkan <span class="req">*</span></label>
                            <textarea class="form-control @error('rincian_informasi') is-invalid @enderror"
                                id="rincian_informasi" name="rincian_informasi" rows="4" required>{{ old('rincian_informasi') }}</textarea>
                            @error('rincian_informasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label for="tujuan_penggunaan">Tujuan Penggunaan Informasi <span class="req">*</span></label>
                            <textarea class="form-control @error('tujuan_penggunaan') is-invalid @enderror"
                                id="tujuan_penggunaan" name="tujuan_penggunaan" rows="3" required>{{ old('tujuan_penggunaan') }}</textarea>
                            @error('tujuan_penggunaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 4: CARA MEMPEROLEH & MENDAPATKAN --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-hand-holding"></i> Cara Memperoleh & Mendapatkan Informasi</div>
                    <div class="row g-4">
                        <div class="col-12">
                            <label>Cara Memperoleh Informasi <span class="req">*</span></label>
                            <div class="radio-group mt-2">
                                <label class="radio-card">
                                    <input type="radio" name="jenis_permohonan_salinan" value="Melihat" required>
                                    Melihat/membaca/mendengarkan/mencatat
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="jenis_permohonan_salinan" value="Mendapatkan salinan">
                                    Mendapatkan salinan informasi (hardcopy/softcopy)
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Cara Mendapatkan Salinan Informasi <span class="req">*</span></label>
                            <div class="radio-group mt-2">
                                <label class="radio-card"><input type="radio" name="cara_mendapatkan" value="Mengambil Langsung" required> Mengambil Langsung</label>
                                <label class="radio-card"><input type="radio" name="cara_mendapatkan" value="Kurir"> Kurir</label>
                                <label class="radio-card"><input type="radio" name="cara_mendapatkan" value="Pos"> Pos</label>
                                <label class="radio-card"><input type="radio" name="cara_mendapatkan" value="Email"> Email</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 5: ADMINISTRASI --}}
                <div class="section-card">
                    <div class="sec-title"><i class="fas fa-clipboard-check"></i> Administrasi</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="petugas_penerima">Petugas meja Informasi (Penerima Permohonan) <span class="req">*</span></label>
                            <input type="text" class="form-control" name="petugas_penerima" placeholder="Nama Petugas (Jika Ada)" value="{{ old('petugas_penerima') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_permohonan">Tanggal Permohonan Informasi <span class="req">*</span></label>
                            <input type="date" class="form-control" name="tanggal_permohonan" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                {{-- HAK-HAK PEMOHON --}}
                <div class="section-card bg-light border-0 shadow-none">
                    <h5 class="fw-bold mb-3" style="color: var(--primary);">Hak-hak Pemohon Informasi</h5>
                    <div class="small text-muted" style="text-align: justify; line-height: 1.6;">
                        <p><strong>I. Pemohon Informasi</strong> berhak untuk meminta seluruh informasi yang berada di Badan Publik kecuali (a) informasi yang apabila dibuka dan diberikan kepada pemohon informasi dapat : Menghambat proses penegakan hukum; Mengganggu kepentingan perlindungan hak atas kekayaan intelektual dan perlindungan dari persaingan usaha tidak sehat; Membahayakan pertahanan dan keamanan Negara; Mengungkapkan kekayaan alam Indonesia; Merugikan ketahanan ekonomi nasional; Merugikan kepentingan hubungan luar negeri; Mengungkapkan isi akta otentik yang bersifat pribadi dan kemauan terakhir ataupun wasiat seseorang; Mengungkap rahasia pribadi; memorandum atau surat-surat antar Badan Publik atau intra Badan Publik, yang menurut sifatnya dirahasiakan kecuali atas putusan Komisi Informasi atau pengadilan; informasi yang tidak boleh diungkapkan berdasarkan Undang-Undang, (b) Badan Publik juga dapat tidak memberikan informasi yang belum dikuasai atau tidak didokumentasikan.</p>
                        <p><strong>II. Biaya</strong> yang dikenakan bagi permintaan atas salinan informasi berdasarkan Peraturan Pimpinan Badan Publik.</p>
                        <p><strong>III. Pemohon Informasi</strong> berhak untuk mendapatkan Pemberitahuan Tertulis atas diterima atau tidaknya permohonan informasi dalam jangka 10 (sepuluh) hari kerja sejak diterimanya permohonan informasi oleh Badan Publik. Badan Publik dapat memperpanjang waktu untuk memberi jawaban tertulis 1 x 7 hari kerja.</p>
                        <div class="alert alert-warning py-2 border-0">
                            <strong>PASTIKAN ANDA MENDAPATKAN TANDA TERIMA</strong> PERMINTAAN INFORMASI BERUPA NOMOR PENDAFTARAN KE PETUGAS INFORMASI/PPID.
                        </div>
                        <p><strong>IV. Apabila Pemohon Informasi</strong> tidak puas dengan keputusan Badan Publik (misal menolak permintaan anda atau memberikan hanya sebagian yang diminta), maka pemohon informasi dapat mengajukan keberatan kepada atasan PPID dalam jangka waktu 30 (tiga puluh) hari kerja sejak permohonan informasi ditolak. Atasan PPID wajib memberikan tanggapan tertulis atas keberatan yang diajukan Pemohon Informasi selambat-lambatnya 30 (tiga puluh) hari kerja sejak keberatan tertulis yang diajukan oleh Pemohon Informasi diterima.</p>
                        <p><strong>V. Apabila Pemohon Informasi</strong> tidak puas dengan keputusan Atasan PPID, maka pemohon informasi dapat mengajukan keberatan kepada Komisi Informasi dalam jangka waktu 14 (empat belas) hari kerja sejak tanggapan dari atasan PPID diterima oleh Pemohon Informasi Publik.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Kirim Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAkta(show) {
            const wrap = document.getElementById('akta_wrap');
            if (show) wrap.classList.remove('d-none');
            else wrap.classList.add('d-none');
        }

        document.getElementById('mainForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
            btn.disabled = true;
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
