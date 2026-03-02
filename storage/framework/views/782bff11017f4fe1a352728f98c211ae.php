<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Penyelesaian Sengketa - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block !important; 
                margin-top: 0; 
            } 
        }
        .dropdown-menu { z-index: 1050 !important; }
        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }
        .content-box {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #004a99;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -23px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #004a99;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #004a99;
        }
        .timeline-marker {
            position: absolute;
            left: -35px;
            top: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            color: white;
        }
        .timeline-content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #004a99;
        }
        .step-visual {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .step-number {
            font-size: 48px;
            font-weight: bold;
            color: #004a99;
            margin-right: 20px;
            min-width: 60px;
            text-align: center;
        }
        .step-content {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            flex: 1;
            box-shadow: 0 4px 15px rgba(0, 74, 153, 0.3);
        }
        .step-content h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .step-content p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <h1 class="page-title">SOP Penyelesaian Sengketa</h1>
        
        <!-- SOP Penyelesaian Sengketa -->
        <div class="visual-summary">
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            
            <h2>Alur Proses</h2>
            
            <!-- Step 1 -->
            <div class="step-visual">
                <div class="step-number">1</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>Apabila tidak mendapatkan tanggapan atas keberatan yang telah diajukan kepada atasan PPID dalam jangka waktu 30 hari kerja sejak keberatan diterima oleh Atasan PPID atau merasa tidak puas terhadap informasi yang diberikan, pemohon informasi dapat mengajukan sengketa</h3>
                    <p><strong>Kelengkapan:</strong> Surat Keberatan</p>
                    <p><strong>Waktu:</strong> 30 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-visual">
                <div class="step-number">2</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>Pengajuan sengketa dari pemohon ditujukan kepada Komisi Informasi Pusat</h3>
                    <p><strong>Kelengkapan:</strong> Surat Gugatan Sengketa</p>
                    <p><strong>Waktu:</strong> 1 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-visual">
                <div class="step-number">3</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>Komisi Informasi Pusat menerima pengajuan sengketa pemohon lalu memberikan surat kepada Atasan PPID terkait Sengketa tersebut</h3>
                    <p><strong>Kelengkapan:</strong> Surat Pengajuan Sengketa</p>
                    <p><strong>Waktu:</strong> 14 Hari Kerja / Paling Lambat 100 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-visual">
                <div class="step-number">4</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>Atasan PPID menerima pemberitahuan Sengketa, Atasan PPID dapat mewakilkan sengketa atau memberikan kuasa Kepada PPID Utama, PPID Pelaksana atau PPID Pelaksana UPT</h3>
                    <p><strong>Kelengkapan:</strong> Surat Pemberitahuan kepada Atasan PPID</p>
                    <p><strong>Waktu:</strong> 1 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="step-visual">
                <div class="step-number">5</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>PPID Pelaksana UPT dan PPID Pelaksana dibantu oleh PPID Utama melakukan rapat Koordinasi mengenai penyelesaian sengketa</h3>
                    <p><strong>Kelengkapan:</strong> Surat Pemberitahuan Rapat</p>
                    <p><strong>Waktu:</strong> 1 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="step-visual">
                <div class="step-number">6</div>
                <div class="step-content" style="background: #786c3b;">
                    <h3>Setelah ditemukan apakah pemohon ingin menyelesaikan sengketa melalui proses mediasi atau ajudikasi barulah komisi informasi dapat berwenang memutuskan hasil penyelesaian sengketa</h3>
                    <p><strong>Kelengkapan:</strong> Putusan sengketa informasi</p>
                    <p><strong>Waktu:</strong> 1 Hari Kerja</p>
                </div>
            </div>
        </div>

        <!-- SOP Pengajuan Sengketa -->
        <div class="content-box">
            <h2 class="h3 fw-bold mb-4" style="color: #004a99;">
                <i class="fas fa-file-alt me-2"></i>SOP Pengajuan Sengketa
            </h2>
            
            <div class="alert alert-warning mb-4" role="alert">
                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Prosedur Pengajuan Sengketa</h5>
                <p class="mb-0">Berikut adalah tahapan dalam pengajuan sengketa informasi:</p>
            </div>
            
            <!-- Step 1 -->
            <div class="step-visual">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Pemohon mengajukan keberatan atas jawaban permohonan informasi kepada Atasan PPID</h3>
                    <p><strong>Kelengkapan:</strong> Surat keberatan yang ditujukan kepada Atasan PPID</p>
                    <p><strong>Waktu:</strong> 10 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-visual">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Atasan PPID menerima dan memeriksa keberatan yang diajukan oleh pemohon</h3>
                    <p><strong>Kelengkapan:</strong> Surat keberatan dan dokumen pendukung</p>
                    <p><strong>Waktu:</strong> 3 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-visual">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Atasan PPID memberikan tanggapan atas keberatan pemohon</h3>
                    <p><strong>Kelengkapan:</strong> Surat tanggapan atas keberatan</p>
                    <p><strong>Waktu:</strong> 7 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-visual">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Jika tidak puas dengan tanggapan, pemohon dapat mengajukan sengketa ke Komisi Informasi</h3>
                    <p><strong>Kelengkapan:</strong> Dokumen sengketa dan bukti pendukung</p>
                    <p><strong>Waktu:</strong> 14 Hari Kerja</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="step-visual">
                <div class="step-number">5</div>
                <div class="step-content">
                    <h3>Komisi Informasi memeriksa dan memutus sengketa informasi yang diajukan</h3>
                    <p><strong>Kelengkapan:</strong> Putusan sengketa informasi</p>
                    <p><strong>Waktu:</strong> 30 Hari Kerja</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    if (dropdownMenu.style.display === 'block') { 
                        dropdownMenu.style.display = 'none'; 
                    } else { 
                        document.querySelectorAll('.dropdown-menu').forEach(menu => { 
                            menu.style.display = 'none'; 
                        }); 
                        dropdownMenu.style.display = 'block'; 
                    }
                });
            });
            document.addEventListener('click', function(e) { 
                if (!e.target.closest('.dropdown')) { 
                    document.querySelectorAll('.dropdown-menu').forEach(menu => { 
                        menu.style.display = 'none'; 
                    }); 
                } 
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/sop-sengketa.blade.php ENDPATH**/ ?>