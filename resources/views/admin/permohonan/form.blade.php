@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.permohonan.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-tools mr-2 text-[#ffc107]"></i> Form Builder PPID
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Modifikasi formulir registrasi untuk pemohon informasi</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="btn-save-form" class="px-8 py-3 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg hover:bg-blue-800 transition-all flex items-center justify-center">
                    <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- TOOLBOX (Left) -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 p-6 border-t-4 border-[#ffc107]">
                    <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] mb-4 flex items-center text-gray-800">
                        <i class="fas fa-cube mr-2 text-gray-400"></i> Field Dasar
                    </h3>
                    <div class="space-y-2 opacity-60">
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-font"></i> Teks Singkat (Locked)
                        </div>
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-paragraph"></i> Paragraf (Locked)
                        </div>
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-file-upload"></i> Unggah File (Locked)
                        </div>
                    </div>
                </div>

                <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl font-bold"></div>
                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] mb-3 relative z-10 text-gray-800">
                        <i class="fas fa-info-circle mr-2 text-[#ffc107]"></i> Info Builder
                    </h3>
                    <p class="text-[10px] opacity-90 leading-relaxed font-medium relative z-10 text-gray-800">
                        Field inti seperti Nama, Email, dan Identitas tidak dapat dihapus untuk menjaga integritas sistem pengajuan.
                    </p>
                </div>

                <a href="{{ url('/permohonan-informasi') }}" target="_blank" class="w-full flex items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl text-[#004a99] font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 transition-all shadow-md">
                    <i class="fas fa-external-link-alt mr-2 text-gray-800"></i> Lihat Preview Publik
                </a>
            </div>

            <!-- CANVAS (Right) -->
            <div class="lg:col-span-3 space-y-8">
                
                <!-- SECTION: CORE FIELDS PREVIEW -->
                <div class="bg-gray-100/50 rounded-3xl p-8 border-2 border-dashed border-gray-200 space-y-8 opacity-70">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-white border border-gray-200 text-[#004a99] rounded-lg text-[9px] font-black tracking-widest">SYSTEM SECTION</span>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest text-gray-800">Data Pemohon (Wajib)</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <div class="w-full h-12 bg-white rounded-xl border border-gray-100 px-4 flex items-center gap-3 shadow-inner">
                                <i class="fas fa-user text-gray-200"></i>
                                <span class="text-[11px] font-bold text-gray-300">NAMA LENGKAP *</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="w-full h-12 bg-white rounded-xl border border-gray-100 px-4 flex items-center gap-3 shadow-inner">
                                <i class="fas fa-envelope text-gray-200"></i>
                                <span class="text-[11px] font-bold text-gray-300">EMAIL PEMOHON *</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DYNAMIC SECTION BUILDER -->
                <div class="space-y-6">
                    <!-- SECTION TITLE EDITOR -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
                        <div class="p-6 md:p-8 flex items-center gap-6">
                            <div class="w-16 h-16 bg-[#004a99] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shrink-0">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="flex-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block text-gray-800">Judul Bagian Tambahan (Kuesioner)</label>
                                <input type="text" id="section-title-input" value="{{ $sectionTitle ?? 'INFORMASI TAMBAHAN' }}" 
                                    class="w-full bg-transparent border-none p-0 text-xl md:text-2xl font-black text-[#004a99] focus:ring-0 uppercase placeholder-gray-200"
                                    placeholder="CONTOH: DATA PENUNJANG">
                            </div>
                        </div>
                    </div>

                    <!-- FIELDS LIST -->
                    <div id="custom-fields-container" class="space-y-4">
                        @if(isset($customFields) && count($customFields) > 0)
                            @foreach($customFields as $index => $field)
                            <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all animate-fade-in-down" data-id="{{ $index }}">
                                <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                                    <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                                        <i class="fas fa-grip-vertical text-xl"></i>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Label Kuesioner</label>
                                        <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" value="{{ $field['label'] ?? '' }}">
                                    </div>
                                    <div class="w-full md:w-1/4 space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Tipe Input</label>
                                        <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                                            <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>TEKS PENDEK</option>
                                            <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>PARAGRAF</option>
                                            <option value="file" {{ ($field['type'] ?? '') == 'file' ? 'selected' : '' }}>UNGGAH BERKAS</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn-delete-field p-4 text-red-200 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- ADD BUTTON -->
                    <button type="button" id="btn-add-field" class="w-full py-8 bg-white border-2 border-dashed border-gray-200 rounded-3xl text-gray-400 hover:border-[#004a99] hover:text-[#004a99] hover:bg-blue-50/50 transition-all flex flex-col items-center justify-center gap-3 group">
                        <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">Tambah Field Kuesioner Baru</span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Add New Field
        $('#btn-add-field').click(function() {
            let id = new Date().getTime();
            let html = `
                <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all animate-fade-in-down" data-id="${id}" style="display:none;">
                    <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                        <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                            <i class="fas fa-grip-vertical text-xl"></i>
                        </div>
                        <div class="flex-1 space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Label Kuesioner</label>
                            <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" placeholder="Masukkan Label Field...">
                        </div>
                        <div class="w-full md:w-1/4 space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Tipe Input</label>
                            <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="text">TEKS PENDEK</option>
                                <option value="textarea">PARAGRAF</option>
                                <option value="file">UNGGAH BERKAS</option>
                            </select>
                        </div>
                        <button type="button" class="btn-delete-field p-4 text-red-200 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </div>
            `;
            let $el = $(html);
            $('#custom-fields-container').append($el);
            $el.slideDown(300);
        });

        // Delete field
        $(document).on('click', '.btn-delete-field', function() {
            let $el = $(this).closest('.custom-field');
            $el.slideUp(300, function() { $(this).remove(); });
        });

        // Save Form
        $('#btn-save-form').click(function() {
            let sectionTitle = $('#section-title-input').val().trim().toUpperCase() || 'INFORMASI TAMBAHAN';
            let fields = [];
            $('.custom-field').each(function() {
                let label = $(this).find('.field-label').val().trim();
                let type = $(this).find('.field-type').val();
                if(label !== '') {
                    fields.push({
                        label: label,
                        type: type,
                        name: 'custom_' + label.toLowerCase().replace(/[^a-z0-9]/g, '_') + '_' + Math.floor(Math.random()*100)
                    });
                }
            });

            let $btn = $(this);
            let originalContent = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> MENYIMPAN...').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.permohonan.save_form') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    section_title: sectionTitle,
                    fields: fields
                },
                success: function(response) {
                    $btn.html(originalContent).prop('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL DISIMPAN!',
                        text: 'Skema formulir publik telah diperbarui.',
                        background: '#fff',
                        confirmButtonColor: '#004a99',
                        customClass: { title: 'text-[#004a99] font-black uppercase' }
                    });
                },
                error: function() {
                    $btn.html(originalContent).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL MENYIMPAN',
                        text: 'Terjadi kesalahan sistem, silakan coba lagi.',
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        });
    });
</script>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
