<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Informasi - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }
        .form-container { background-color: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .section-title { color: #004a99; font-size: 18px; font-weight: bold; margin-top: 30px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #ffc107; }
        .form-group label { font-weight: 600; color: #333; }
        .form-control:focus { border-color: #004a99; box-shadow: 0 0 0 0.2rem rgba(0, 74, 153, 0.25); }
        .btn-submit { background-color: #004a99; border-color: #004a99; color: white; font-weight: bold; padding: 12px 30px; }
        .btn-submit:hover { background-color: #003366; border-color: #003366; color: white; }
        .alert-warning { background-color: #fff3cd; border-color: #ffc107; }
        .required::after { content: " *"; color: red; }
        .form-text-small { font-size: 0.875rem; color: #666; }
    </style>
</head>
<body>
    @include('navigation')
    
    <div class="container py-5">
        <h1 class="page-title">Permohonan Informasi Publik</h1>
        
        <div class="form-container">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Selamat datang!</strong> Untuk mengajukan permohonan informasi publik, silakan lakukan registrasi terlebih dahulu atau login jika Anda sudah terdaftar.
            </div>

            <!-- Registrasi Pemohon -->
            <h3 class="section-title">
                <i class="fas fa-user-plus me-2"></i> Formulir Registrasi Pemohon Informasi
            </h3>
            
            <form action="#" method="POST" id="registrationForm">
                @csrf
                
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label required">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan nama pengguna" required>
                            <small class="form-text-small">Gunakan huruf, angka, dan underscore saja</small>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label required">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap Anda" required>
                        </div>

                        <!-- Jenis Identitas -->
                        <div class="mb-3">
                            <label for="jenis_identitas" class="form-label required">Jenis Identitas</label>
                            <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                                <option value="">-- Pilih Jenis Identitas --</option>
                                <option value="ktp">KTP (Kartu Tanda Penduduk)</option>
                                <option value="paspor">Paspor</option>
                                <option value="sim">SIM (Surat Izin Mengemudi)</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Nomor Identitas -->
                        <div class="mb-3">
                            <label for="nomor_identitas" class="form-label required">Nomor Identitas</label>
                            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" placeholder="Masukkan nomor identitas" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label required">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                        </div>

                        <!-- Nomor Telepon/HP -->
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label required">Nomor Telepon/HP</label>
                            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="Contoh: 08123456789" required>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label required">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan Anda" required>
                        </div>

                        <!-- Instansi/Organisasi -->
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi/Organisasi (Opsional)</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukkan nama instansi/organisasi">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label required">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email aktif Anda" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label required">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi yang kuat" required>
                            <small class="form-text-small">Minimal 8 karakter, terdiri dari huruf dan angka</small>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label required">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi Anda" required>
                        </div>

                        <!-- CAPTCHA (Simplified - biasanya gunakan Google reCAPTCHA) -->
                        <div class="mb-3">
                            <label for="captcha" class="form-label required">CAPTCHA</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Masukkan kode di samping">
                                <span class="input-group-text bg-light">12345</span>
                            </div>
                            <small class="form-text-small">Masukkan kode verifikasi untuk memastikan Anda manusia</small>
                        </div>
                    </div>
                </div>

                <!-- Pernyataan dan Notifikasi -->
                <div class="alert alert-light border border-warning mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pernyataan" name="pernyataan" required>
                        <label class="form-check-label" for="pernyataan">
                            <strong>Saya menyatakan</strong> bahwa data yang saya daftarkan adalah benar dan dapat dipertanggungjawabkan sesuai dengan peraturan perundang-undangan yang berlaku.
                        </label>
                    </div>
                </div>

                <div class="alert alert-light border border-info">
                    <strong><i class="fas fa-lightbulb me-2 text-warning"></i> Catatan Penting:</strong>
                    <p class="mb-0">Pastikan data yang Anda daftarkan telah sesuai dengan ketentuan yang berlaku. Data yang tidak sesuai dapat menyebabkan penolakan permohonan informasi Anda.</p>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2 justify-content-between align-items-center mt-5">
                    <div>
                        <p class="mb-0 text-muted small">Apakah Anda sudah memiliki akun? 
                            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk di sini
                            </a>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i> Simpan & Daftar
                    </button>
                </div>
            </form>

            <!-- Informasi Tambahan -->
            <div class="bg-light p-4 rounded mt-5">
                <h5 class="text-primary" style="color: #004a99;">
                    <i class="fas fa-question-circle me-2"></i> Bantuan & Informasi
                </h5>
                <p class="mb-2">Jika mengalami kesulitan dalam mendaftar, hubungi:</p>
                <ul class="mb-0">
                    <li><strong>Email:</strong> <a href="mailto:ppid@pktj.ac.id">ppid@pktj.ac.id</a></li>
                    <li><strong>Telepon:</strong> <a href="tel:+62283358001">(0283) 358 001</a></li>
                    <li><strong>Jam Layanan:</strong> Senin - Jumat, 08:00 - 16:00 WIB</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Client-side validation
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            
            if (password !== passwordConfirmation) {
                alert('Kata sandi dan konfirmasi kata sandi tidak cocok!');
                return;
            }
            
            if (password.length < 8) {
                alert('Kata sandi harus minimal 8 karakter!');
                return;
            }
            
            // If validation passes, you would normally submit the form
            alert('Registrasi berhasil! Silakan login dengan akun Anda.');
            // this.submit();
        });
    </script>
</body>
</html>
