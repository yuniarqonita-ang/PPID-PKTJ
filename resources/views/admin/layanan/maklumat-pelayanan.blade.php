@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                Maklumat <span class="text-[#004a99]">Pelayanan</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Pernyataan Janji Layanan Publik PPID PKTJ</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest">
                <i class="fas fa-arrow-left mr-3"></i> DASHBOARD
            </a>
            <a href="http://ppid.pktj.ac.id/layanan-informasi/maklumat" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> LIHAT PUBLIK
            </a>
        </div>
    </div>

    <form action="{{ route('admin.halaman-custom.store', 'maklumat_pelayanan') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- IDENTITY & HERO -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-star"></i>
                        </span>
                        Visualitas Landing Page
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Banner Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['maklumat_pelayanan_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- LEFT: IMAGE UPLOAD -->
            <div class="lg:col-span-2 space-y-10">
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                            <i class="fas fa-image mr-4 text-[#ffc107]"></i> Gambar Maklumat (Poster)
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar').click()" class="px-6 py-2 bg-slate-100 text-[#002b5c] font-black text-sm uppercase tracking-widest rounded-xl hover:bg-[#002b5c] hover:text-white transition-all border-none cursor-pointer">UPLOAD BARU</button>
                    </div>

                    <div class="relative aspect-video bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">
                        @if(isset($settings['maklumat_pelayanan_gambar']))
                            <img id="preview" src="{{ asset('storage/halaman/'.$settings['maklumat_pelayanan_gambar']) }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-center">
                                <i class="fas fa-file-image text-6xl text-slate-200 mb-4"></i>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum Ada Gambar Terunggah</p>
                            </div>
                        @endif
                        <input type="file" name="gambar" id="gambar" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-center text-sm font-bold text-slate-700 mt-6 uppercase tracking-widest">Format: JPG, PNG, atau WEBP | Rekomendasi: 1200x800px</p>
                </div>
            </div>

            <!-- RIGHT: PREVIEW/INFO -->
            <div class="space-y-10">
                <div class="bg-indigo-900 rounded-[2.5rem] p-10 shadow-2xl text-white relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                    <i class="fas fa-quote-left text-4xl text-[#ffc107] mb-8"></i>
                    <h4 class="text-xl font-black uppercase tracking-widest mb-4">Maklumat Layanan</h4>
                    <p class="text-md font-medium text-indigo-100 leading-relaxed">
                        Maklumat adalah janji tertulis PPID PKTJ untuk memberikan pelayanan sesuai standar yang telah ditetapkan. Pastikan gambar terbaca dengan jelas oleh publik.
                    </p>
                </div>

                <button type="submit" class="w-full py-8 bg-[#002b5c] text-white font-black text-xl uppercase tracking-[3px] rounded-[2.5rem] shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                    <i class="fas fa-save mr-4 text-[#ffc107]"></i> SIMPAN MAKLUMAT
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                if(preview) {
                    preview.src = e.target.result;
                } else {
                    location.reload();
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
