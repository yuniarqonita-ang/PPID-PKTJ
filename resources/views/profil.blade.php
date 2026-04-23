<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil PPID - Politeknik Ketenagalistrikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- NAVBAR -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-bolt text-blue-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">PPID PKTJ</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="/profil" class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium border-b-2 border-blue-600">Profil</a>
                    <a href="/informasi" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Informasi</a>
                    <a href="/kontak" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    @if($profil && $profil->gambar)
    <div class="hero-gradient relative h-96 flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="Sampul" class="absolute inset-0 w-full h-full object-cover">
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $profil->judul ?? 'Profil PPID' }}</h1>
            <p class="text-xl md:text-2xl">Politeknik Ketenagalistrikan</p>
        </div>
    </div>
    @else
    <div class="hero-gradient relative h-96 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <i class="fas fa-building text-6xl mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $profil->judul ?? 'Profil PPID' }}</h1>
            <p class="text-xl md:text-2xl">Politeknik Ketenagalistrikan</p>
        </div>
    </div>
    @endif

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($profil && $profil->konten_pembuka)
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 card-hover">
            <div class="prose max-w-none">
                {!! $profil->konten_pembuka !!}
            </div>
        </div>
        @endif

        @if($profil && $profil->konten_detail)
        <div class="bg-white rounded-lg shadow-lg p-8 card-hover">
            <div class="prose max-w-none">
                {!! $profil->konten_detail !!}
            </div>
        </div>
        @endif

        @if(!$profil)
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <i class="fas fa-info-circle text-6xl text-blue-500 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Sedang Disiapkan</h2>
            <p class="text-gray-600">Informasi profil PPID akan segera tersedia. Silakan kembali lagi nanti.</p>
        </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="mb-2">&copy; 2024 PPID Politeknik Ketenagalistrikan. All rights reserved.</p>
                <p class="text-sm text-gray-400">Jl. Gajah Mada No. 2, Jakarta Pusat, 10130</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
