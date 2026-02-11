<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin PPID PKTJ</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom Scrollbar untuk Sidebar agar tetap estetik */
            .sidebar-scroll::-webkit-scrollbar { width: 4px; }
            .sidebar-scroll::-webkit-scrollbar-track { background: #0f172a; }
            .sidebar-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen">
            <div class="w-80 bg-slate-900 text-white hidden md:block shadow-xl sticky top-0 h-screen flex flex-col">
                <div class="p-6 text-xl font-bold border-b border-slate-800 text-blue-400 flex-shrink-0">
                    PPID BACK OFFICE
                </div>
                
                <nav class="flex-1 overflow-y-auto sidebar-scroll px-4 py-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-slate-800 mb-6 {{ request()->routeIs('dashboard') ? 'bg-blue-600' : '' }}">
                        <span class="font-bold text-sm">🏠 DASHBOARD UTAMA</span>
                    </a>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">1. Profil PPID</div>
                    <div class="space-y-1 mb-6">
                        @foreach(['edit' => 'Profil PPID', 'tugas' => 'Tugas & Fungsi', 'visi' => 'Visi & Misi', 'struktur' => 'Struktur Organisasi', 'regulasi' => 'Regulasi PPID', 'kontak' => 'Kontak'] as $key => $label)
                            <a href="{{ route('admin.profil.'.$key) }}" class="block py-1.5 px-6 text-xs text-slate-400 hover:text-white hover:bg-slate-800 rounded">• {{ $label }}</a>
                        @endforeach
                    </div>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">2. Informasi Publik</div>
                    <div class="space-y-1 mb-6">
                        @foreach(['berkala' => 'Informasi Berkala', 'sertamerta' => 'Informasi Serta Merta', 'setiapsaat' => 'Informasi Setiap Saat', 'dikecualikan' => 'Informasi Dikecualikan'] as $key => $label)
                            <a href="{{ route('admin.informasi.'.$key) }}" class="block py-1.5 px-6 text-xs text-slate-400 hover:text-white hover:bg-slate-800 rounded">• {{ $label }}</a>
                        @endforeach
                    </div>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">3. Layanan Informasi</div>
                    <div class="space-y-1 mb-6 text-xs text-slate-400">
                        <a href="#" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Daftar Informasi Publik</a>
                        <a href="#" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Maklumat Pelayanan</a>
                        <a href="#" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Laporan Layanan Informasi</a>
                        <a href="#" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Laporan Akses Informasi</a>
                        <a href="#" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Survey Kepuasan Layanan</a>
                    </div>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">4. Prosedur / SOP</div>
                    <div class="space-y-1 mb-6 text-xs text-slate-400">
                        <a href="{{ route('admin.prosedur.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded font-bold text-blue-300">⚙️ KELOLA SEMUA SOP</a>
                        <div class="border-l border-slate-700 ml-6 mt-1 space-y-1">
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Permintaan Informasi</a>
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Penanganan Keberatan</a>
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Sengketa Informasi</a>
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Penetapan & Mutakhir</a>
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Pengujian Konsekuensi</a>
                            <a href="#" class="block py-1 px-4 hover:text-white italic">- Pendokumentasian</a>
                        </div>
                    </div>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">5. LPSE & JDIH</div>
                    <div class="space-y-1 mb-6 text-xs text-slate-400">
                        <a href="{{ route('admin.lpse.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• Pengadaan Barang & Jasa</a>
                        <a href="{{ route('admin.jdih.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">• JDIH Kemenhub</a>
                    </div>

                    <div class="text-[11px] font-bold text-blue-500 uppercase px-4 mb-2 tracking-widest">6. Update Konten</div>
                    <div class="space-y-1 mb-10 text-xs text-slate-400">
                        <a href="{{ route('admin.berita.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">📰 Berita Terkini</a>
                        <a href="{{ route('admin.dokumen.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">📁 File Dokumen</a>
                        <a href="{{ route('admin.faq.index') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">❓ FAQ</a>
                        <a href="{{ route('admin.users') }}" class="block py-1.5 px-6 hover:text-white hover:bg-slate-800 rounded">👥 User Management</a>
                    </div>
                </nav>
            </div>

            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center sticky top-0 z-20">
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Administrator</span>
                        <h2 class="text-lg font-bold text-slate-700 leading-tight">{{ Auth::user()->name }}</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full text-xs transition shadow-lg shadow-red-200">
                            KELUAR (LOGOUT)
                        </button>
                    </form>
                </header>

                <main class="p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>