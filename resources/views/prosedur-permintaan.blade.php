<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosedur Permintaan Informasi Publik - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .dropdown-menu {
            z-index: 1050 !important;
        }
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
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .procedure-title {
            color: #004a99;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
            padding-left: 15px;
        }
        .step-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        .step-number {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            font-weight: bold;
            font-size: 18px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,74,153,0.3);
        }
        .step-content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        .highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .note-box {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            border: 1px solid #b8daff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }
        .note-box h4 {
            color: #0c5460;
            font-weight: bold;
            margin-bottom: 15px;
        }
        p {
            text-align: justify;
            line-height: 1.8;
            color: #333;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="container py-5">
        <h1 class="page-title">Prosedur Permintaan Informasi Publik</h1>
        
        <div class="content-box">
            <p style="text-align: center; font-size: 18px; margin-bottom: 30px;">
                <strong>Prosedur Permintaan Informasi Publik PPID PKTJ</strong><br>
                Berikut adalah alur dan prosedur permintaan informasi publik melalui website PPID PKTJ
            </p>
        </div>

        <!-- MELALUI WEBSITE -->
        <div class="content-box">
            <h2 class="procedure-title">Melalui Website</h2>
            
            <div class="step-box">
                <div class="step-number">01</div>
                <div class="step-content">
                    <strong>Pemohon informasi melakukan registrasi dan mengisi formulir permohonan informasi yang tersedia di <a href="https://ppid.kemenhub.go.id" target="_blank" style="color: #004a99; text-decoration: underline;">ppid.kemenhub.go.id</a></strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">02</div>
                <div class="step-content">
                    <strong>Melampirkan KTP/surat keterangan kependudukan bagi pemohon perorangan; sedangkan bagi pemohon berbadan hukum melampirkan akta pendirian yang disahkan oleh Kementerian Hukum</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">03</div>
                <div class="step-content">
                    <strong>Verifikasi akun melalui email yang telah didaftarkan dan klik tautan yang tersedia</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">04</div>
                <div class="step-content">
                    <strong>Setelah registrasi sukses, silahkan login dengan username dan password yang telah didaftarkan</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">05</div>
                <div class="step-content">
                    <strong>Ajukan permohonan informasi publik dengan mengisi rincian informasi dan tujuan penggunaannya</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">06</div>
                <div class="step-content">
                    <strong>Permohonan informasi telah tercatat didalam dashboard, selanjutnya dapat dilakukan pengecekan kembali sebelum dikirim</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">07</div>
                <div class="step-content">
                    <strong>Dashboard akan menampilkan status permohonan informasi yang telah diajukan</strong>
                </div>
            </div>

            <div class="step-box">
                <div class="step-number">08</div>
                <div class="step-content">
                    <strong>Jawaban akan dikirimkan melalui email terdaftar, paling lambat 10 hari kerja; jika diperlukan penambahan waktu dapat diperpanjang sebanyak 7 hari kerja dengan sebelumnya memberikan tanggapan terhadap pemohon</strong>
                </div>
            </div>

            <div class="highlight">
                <h4><i class="fas fa-info-circle"></i> Informasi Penting:</h4>
                <ul>
                    <li>Permohonan informasi dapat diajukan secara online melalui website resmi PPID PKTJ</li>
                    <li>Pastikan semua dokumen pendukung dilampirkan dengan lengkap</li>
                    <li>Periksa kembali data yang dimasukkan sebelum mengirimkan permohonan</li>
                    <li>Status permohonan dapat dipantau melalui dashboard pribadi</li>
                </ul>
            </div>
        </div>

        <div class="note-box">
            <h4><i class="fas fa-envelope"></i> Kontak PPID PKTJ</h4>
            <p>Jika memerlukan bantuan atau informasi lebih lanjut mengenai prosedur permintaan informasi, silakan hubungi:</p>
            <ul>
                <li><strong>Email:</strong> ppid@pktj.ac.id</li>
                <li><strong>Telepon:</strong> (021) 1234-5678</li>
                <li><strong>Alamat:</strong> Jl. Pendidikan No. 123, Jakarta</li>
            </ul>
        </div>

        <div class="content-box text-center">
            <a href="{{ route('permohonan.form') }}" class="btn btn-lg btn-primary px-5 py-3" style="background: linear-gradient(135deg, #004a99 0%, #0066cc 100%); border: none; font-weight: bold;">
                <i class="fas fa-file-alt"></i> Ajukan Permohonan Informasi
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.style.display = 'none';
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>
