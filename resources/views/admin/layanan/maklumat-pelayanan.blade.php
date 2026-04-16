@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2 font-black"></i> Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-bullhorn mr-2 text-[#ffc107]"></i> Maklumat & Standar Biaya
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Pusat Kendali Maklumat Pelayanan dan Transparansi Biaya</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/maklumat-pelayanan') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2 text-gray-800"></i> Lihat Publik
                </a>
            </div>
        </div>

        <form action="{{ route('admin.halaman-custom.store', 'maklumat') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- MAIN EDITORS (Left) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- MAKLUMAT SECTION -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-8 border-[#004a99]">
                        <div class="p-8 space-y-6">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                                <i class="fas fa-signature mr-3 text-[#ffc107]"></i> Konten Maklumat Pelayanan
                            </h3>
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Maklumat</label>
                                <input type="text" name="judul_maklumat" value="{{ $settings['maklumat_judul_maklumat'] ?? '' }}" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase placeholder-gray-200">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Detail Isi Maklumat</label>
                                <div class="rounded-2xl overflow-hidden border border-gray-100">
                                    <textarea name="isi_maklumat" id="editor_maklumat" class="tinymce-editor">{!! $settings['maklumat_isi_maklumat'] ?? '' !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STANDAR BIAYA SECTION -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-8 border-[#ffc107]">
                        <div class="p-8 space-y-6">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                                <i class="fas fa-coins mr-3 text-[#ffc107]"></i> Informasi Standar Biaya
                            </h3>
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Standar Biaya</label>
                                <input type="text" name="judul_standar" value="{{ $settings['maklumat_judul_standar'] ?? '' }}" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#ffc107]/5 focus:border-[#ffc107] outline-none transition-all uppercase placeholder-gray-200 font-bold">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Rincian Biaya Informasi</label>
                                <div class="rounded-2xl overflow-hidden border border-gray-100">
                                    <textarea name="isi_standar" id="editor_standar" class="tinymce-editor">{!! $settings['maklumat_isi_standar'] ?? '' !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SIDEBAR / VISUALS (Right) -->
                <div class="space-y-8">
                    
                    <!-- UPLOAD IMAGES -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 p-8 space-y-8">
                        <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center border-b pb-4 text-gray-800">
                            <i class="fas fa-images mr-3 text-[#ffc107]"></i> Aset Visual
                        </h3>
                        
                        <div class="space-y-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Gambar Maklumat</label>
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-100 rounded-2xl p-4 hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" onclick="document.getElementById('img_maklumat').click()">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-200 mb-2 group-hover:text-[#004a99] transition-colors"></i>
                                    <p class="text-[9px] font-bold text-gray-300 group-hover:text-[#004a99]">UPLOAD IMAGE</p>
                                    <input type="file" name="gambar_maklumat" id="img_maklumat" class="hidden">
                                </div>
                                @if(isset($settings['maklumat_gambar_maklumat']))
                                <div class="relative rounded-xl overflow-hidden shadow-md group">
                                    <img src="{{ Storage::url($settings['maklumat_gambar_maklumat']) }}" class="w-full h-32 object-cover opacity-80 group-hover:opacity-100 transition-all">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                        <span class="text-[8px] font-black text-white uppercase tracking-widest">AKTIF</span>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Gambar Standar Biaya</label>
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-100 rounded-2xl p-4 hover:border-[#ffc107] hover:bg-yellow-50/50 transition-all text-center" onclick="document.getElementById('img_standar').click()">
                                    <i class="fas fa-file-invoice-dollar text-2xl text-gray-200 mb-2 group-hover:text-[#ffc107] transition-colors"></i>
                                    <p class="text-[9px] font-bold text-gray-300 group-hover:text-[#ffc107]">UPLOAD STANDAR BIAYA</p>
                                    <input type="file" name="gambar_standar" id="img_standar" class="hidden">
                                </div>
                                @if(isset($settings['maklumat_gambar_standar']))
                                <div class="relative rounded-xl overflow-hidden shadow-md group">
                                    <img src="{{ Storage::url($settings['maklumat_gambar_standar']) }}" class="w-full h-32 object-cover opacity-80 group-hover:opacity-100 transition-all">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                        <span class="text-[8px] font-black text-white uppercase tracking-widest">AKTIF</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- TIPS -->
                    <div class="bg-gradient-to-br from-[#004a99] to-blue-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <h4 class="text-xs font-black uppercase tracking-widest mb-4 flex items-center text-gray-800">
                            <i class="fas fa-lightbulb mr-2 text-[#ffc107]"></i> Tips Admin
                        </h4>
                        <p class="text-[10px] leading-relaxed opacity-80 font-medium text-gray-800">
                            Gunakan bahasa yang inklusif dan pastikan standar biaya yang diinput sesuai dengan Peraturan Pemerintah terbaru mengenai PNBP.
                        </p>
                    </div>

                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="bg-white h-24 rounded-3xl shadow-2xl ring-1 ring-gray-200 px-8 flex items-center justify-between sticky bottom-6 z-50 animate-fade-in-up">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-green-50 text-green-500 rounded-full flex items-center justify-center animate-pulse shadow-sm">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Draft Terverifikasi</p>
                </div>
                <div class="flex gap-4 uppercase font-bold text-gray-800">
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-gray-100 text-gray-500 font-black text-[10px] rounded-xl hover:bg-gray-200 transition-all tracking-widest">BATAL</a>
                    <button type="submit" class="px-10 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest">
                        <i class="fas fa-rocket mr-2 text-[#ffc107]"></i> PUBLIKASIKAN PERUBAHAN
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 350,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });
</script>

<style>
    .animate-fade-in-up { animation: fadeInUp 0.5s ease-out; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
