@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Maklumat: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Maklumat <span class="text-[#ffc107]">Pelayanan</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Pernyataan Janji Layanan Publik PPID PKTJ.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="http://ppid.pktj.ac.id/layanan-informasi/maklumat" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <button type="submit" form="maklumat-form" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-save mr-3"></i> Simpan Maklumat
                </button>
            </div>
        </div>
    </div>

    <form id="maklumat-form" action="{{ route('admin.halaman-custom.store', 'maklumat_pelayanan') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#004a99] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-star"></i>
                        </span>
                        Visualitas Landing Page
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Judul Banner Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['maklumat_pelayanan_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                </div>

                <!-- MAKLUMAT CONTENT -->
                <div class="grid grid-cols-1 gap-8 mt-10">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Judul Maklumat (Teks Utama)</label>
                        <input type="text" name="judul_maklumat" value="{{ $settings['maklumat_pelayanan_judul_maklumat'] ?? 'Maklumat Pelayanan PPID PKTJ' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Isi Pernyataan Maklumat</label>
                        <textarea name="isi_maklumat" class="tinymce-editor">{{ $settings['maklumat_pelayanan_isi_maklumat'] ?? '' }}</textarea>
                    </div>
                </div>

                <!-- STANDAR BIAYA CONTENT -->
                <div class="grid grid-cols-1 gap-8 mt-10 pt-10 border-t-2 border-slate-50">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#d4af37] uppercase tracking-widest">Judul Standar Biaya</label>
                        <input type="text" name="judul_standar" value="{{ $settings['maklumat_pelayanan_judul_standar'] ?? 'Standar Biaya' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#d4af37]/10 text-lg font-bold text-[#d4af37]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#d4af37] uppercase tracking-widest">Isi Standar Biaya</label>
                        <textarea name="isi_standar" class="tinymce-editor">{{ $settings['maklumat_pelayanan_isi_standar'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- LEFT: MAKLUMAT IMAGE -->
            <div class="space-y-10">
                <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fas fa-image mr-4 text-[#ffc107]"></i> Gambar Maklumat
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_maklumat').click()" class="px-6 py-2 bg-slate-100 text-[#004a99] font-black text-sm uppercase tracking-widest rounded-xl hover:bg-[#004a99] hover:text-white transition-all border-none cursor-pointer">UPLOAD BARU</button>
                    </div>

                    <div class="relative aspect-video bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">
                        @if(isset($settings['maklumat_pelayanan_gambar_maklumat']) && !empty($settings['maklumat_pelayanan_gambar_maklumat']))
                            <img id="preview_maklumat" src="{{ asset('storage/halaman/'.$settings['maklumat_pelayanan_gambar_maklumat']) }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-center" id="placeholder_maklumat">
                                <i class="fas fa-file-image text-6xl text-slate-200 mb-4"></i>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum Ada Gambar Maklumat</p>
                            </div>
                        @endif
                        <input type="file" name="gambar_maklumat" id="gambar_maklumat" class="hidden" onchange="previewImage(this, 'preview_maklumat', 'placeholder_maklumat')">
                    </div>
                </div>
            </div>

            <!-- RIGHT: STANDAR BIAYA IMAGE -->
            <div class="space-y-10">
                <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#d4af37] uppercase tracking-widest flex items-center">
                            <i class="fas fa-image mr-4 text-[#ffc107]"></i> Gambar Standar Biaya
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_standar').click()" class="px-6 py-2 bg-slate-100 text-[#d4af37] font-black text-sm uppercase tracking-widest rounded-xl hover:bg-[#d4af37] hover:text-white transition-all border-none cursor-pointer">UPLOAD BARU</button>
                    </div>

                    <div class="relative aspect-video bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">
                        @if(isset($settings['maklumat_pelayanan_gambar_standar']) && !empty($settings['maklumat_pelayanan_gambar_standar']))
                            <img id="preview_standar" src="{{ asset('storage/halaman/'.$settings['maklumat_pelayanan_gambar_standar']) }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-center" id="placeholder_standar">
                                <i class="fas fa-file-image text-6xl text-slate-200 mb-4"></i>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum Ada Gambar Standar Biaya</p>
                            </div>
                        @endif
                        <input type="file" name="gambar_standar" id="gambar_standar" class="hidden" onchange="previewImage(this, 'preview_standar', 'placeholder_standar')">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <button type="submit" class="w-full py-8 bg-gradient-to-r from-[#004a99] to-[#006ccf] text-white font-black text-2xl uppercase tracking-[5px] rounded-[2rem] shadow-2xl hover:scale-[1.01] active:scale-95 transition-all border-none cursor-pointer flex items-center justify-center gap-4">
                <i class="fas fa-save text-[#ffc107]"></i> SIMPAN PERUBAHAN LAYANAN
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById(previewId);
                let placeholder = document.getElementById(placeholderId);
                const container = input.parentElement;
                
                if (placeholder) placeholder.classList.add('hidden');
                
                if(!preview) {
                    container.insertAdjacentHTML('afterbegin', `<img id="${previewId}" src="${e.target.result}" class="w-full h-full object-contain">`);
                } else {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
