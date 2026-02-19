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
    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="form-container">
        <div class="form-header">
            <h2>Registrasi User Pemohon Informasi</h2>
            <p>PPID Kementerian Perhubungan - Politeknik Keselamatan Transportasi Jalan Tegal</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>⚠️ Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="warning-box">
            <h5>⚠️ Peringatan!</h5>
            <p>Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan.</p>
            <p>Pastikan data yang diungkapkan telah sesuai dengan ketentuan yang berlaku.</p>
        </div>

        <form action="<?php echo e(route('permohonan.store')); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>

            <!-- BAGIAN 1: DATA AKUN -->
            <div class="form-section-title">📋 DATA AKUN</div>

            <div class="form-row">
                <div class="form-group">
                    <label for="username">
                        Username <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="username" name="username" placeholder="isi username"
                        value="<?php echo e(old('username')); ?>" required>
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="email">
                        Email <span class="required">*</span>
                    </label>
                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="email" name="email" placeholder="isi email"
                        value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">
                        Password <span class="required">*</span>
                    </label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="password" name="password" placeholder="isi password"
                        required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="password_confirmation" name="password_confirmation" placeholder="isi konfirmasi password"
                        required>
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- BAGIAN 2: DATA PRIBADI -->
            <div class="form-section-title">👤 DATA PRIBADI</div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="nama_pemohon">
                        Nama <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['nama_pemohon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="nama_pemohon" name="nama_pemohon" placeholder="isi nama lengkap sesuai identitas"
                        value="<?php echo e(old('nama_pemohon')); ?>" required>
                    <?php $__errorArgs = ['nama_pemohon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_identitas">
                        Jenis Identitas <span class="required">*</span>
                    </label>
                    <select class="form-select <?php $__errorArgs = ['jenis_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="jenis_identitas" name="jenis_identitas" required>
                        <option value="">-- Pilih jenis identitas --</option>
                        <option value="ktp" <?php echo e(old('jenis_identitas') == 'ktp' ? 'selected' : ''); ?>>KTP (Kartu Tanda Penduduk)</option>
                        <option value="paspor" <?php echo e(old('jenis_identitas') == 'paspor' ? 'selected' : ''); ?>>Paspor</option>
                        <option value="sim" <?php echo e(old('jenis_identitas') == 'sim' ? 'selected' : ''); ?>>SIM (Surat Izin Mengemudi)</option>
                        <option value="lainnya" <?php echo e(old('jenis_identitas') == 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                    </select>
                    <?php $__errorArgs = ['jenis_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="nomor_identitas">
                        Nomor Identitas <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['nomor_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="nomor_identitas" name="nomor_identitas" placeholder="isi nomor identitas"
                        value="<?php echo e(old('nomor_identitas')); ?>" required>
                    <?php $__errorArgs = ['nomor_identitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="alamat">
                        Alamat <span class="required">*</span>
                    </label>
                    <textarea class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="alamat" name="alamat" rows="3" placeholder="isi alamat"
                        required><?php echo e(old('alamat')); ?></textarea>
                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_telepon">
                        No. Telp/HP <span class="required">*</span>
                    </label>
                    <input type="tel" class="form-control <?php $__errorArgs = ['nomor_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="nomor_telepon" name="nomor_telepon" placeholder="isi no telp/hp"
                        value="<?php echo e(old('nomor_telepon')); ?>" required>
                    <?php $__errorArgs = ['nomor_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="pekerjaan">
                        Pekerjaan
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="pekerjaan" name="pekerjaan" placeholder="isi pekerjaan"
                        value="<?php echo e(old('pekerjaan')); ?>">
                    <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="perusahaan_instansi">
                        Instansi
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['perusahaan_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="perusahaan_instansi" name="perusahaan_instansi" placeholder="isi instansi"
                        value="<?php echo e(old('perusahaan_instansi')); ?>">
                    <?php $__errorArgs = ['perusahaan_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- BAGIAN 3: PERMOHONAN INFORMASI -->
            <div class="form-section-title">📄 DETAIL PERMOHONAN INFORMASI</div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="jenis_informasi">
                        Jenis Informasi yang Diminta <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['jenis_informasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="jenis_informasi" name="jenis_informasi" placeholder="Contoh: Laporan Keuangan, Struktur Organisasi"
                        value="<?php echo e(old('jenis_informasi')); ?>" required>
                    <?php $__errorArgs = ['jenis_informasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="deskripsi_permohonan">
                        Deskripsi/Uraian Permohonan <span class="required">*</span>
                    </label>
                    <textarea class="form-control <?php $__errorArgs = ['deskripsi_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="deskripsi_permohonan" name="deskripsi_permohonan" rows="4" 
                        placeholder="Jelaskan secara detail informasi apa yang Anda butuhkan dan untuk tujuan apa"
                        required><?php echo e(old('deskripsi_permohonan')); ?></textarea>
                    <?php $__errorArgs = ['deskripsi_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="format_informasi">
                        Format Informasi yang Diinginkan <span class="required">*</span>
                    </label>
                    <select class="form-select <?php $__errorArgs = ['format_informasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        id="format_informasi" name="format_informasi" required>
                        <option value="">-- Pilih Format --</option>
                        <option value="digital" <?php echo e(old('format_informasi') == 'digital' ? 'selected' : ''); ?>>Digital (PDF/Email)</option>
                        <option value="cetak" <?php echo e(old('format_informasi') == 'cetak' ? 'selected' : ''); ?>>Cetak (Hardcopy)</option>
                        <option value="keduanya" <?php echo e(old('format_informasi') == 'keduanya' ? 'selected' : ''); ?>>Keduanya (Digital + Cetak)</option>
                    </select>
                    <?php $__errorArgs = ['format_informasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- BUTTONS -->
            <div style="margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px;">
                <button type="submit" class="btn btn-simpan">
                    ✓ Simpan
                </button>
                <div style="margin-top: 15px; text-align: center;">
                    <p style="color: #666; font-size: 13px; margin-bottom: 10px;">Sudah Punya Akun?</p>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login">
                        🔐 Login
                    </a>
                </div>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="<?php echo e(route('home')); ?>" style="color: #004a99; text-decoration: none; font-size: 13px;">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/permohonan/form.blade.php ENDPATH**/ ?>