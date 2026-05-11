@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Form Builder: Keberatan</h2>
                </div>
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Kelola <span class="text-[#ffc107]">Form Keberatan</span>
                    </h1>
                    <p class="text-blue-50 text-base font-bold max-w-2xl opacity-90">Edit label, tambah, atau hapus field pada formulir Keberatan Informasi publik.</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.keberatan.index') }}" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-arrow-left mr-3"></i> Kembali
                </a>
                <button id="btn-save-form" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl hover:scale-[1.02] active:scale-95 transition-all flex items-center">
                    <i class="fas fa-save mr-3"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- TOOLBOX (Kiri) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 p-6 border-t-4 border-[#ffc107]">
                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-[#ffc107]"></i> Panduan Builder
                </h3>
                <ul class="space-y-3 text-[11px] text-gray-500 font-bold leading-relaxed">
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle text-green-400 mt-0.5"></i> Edit label field di sebelah kanan</li>
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle text-green-400 mt-0.5"></i> Toggle ON/OFF untuk field opsional</li>
                    <li class="flex items-start gap-2"><i class="fas fa-plus-circle text-blue-400 mt-0.5"></i> Klik "+ Tambah Field" untuk field baru</li>
                    <li class="flex items-start gap-2"><i class="fas fa-trash-alt text-red-400 mt-0.5"></i> Klik ikon hapus untuk menghapus field custom</li>
                    <li class="flex items-start gap-2"><i class="fas fa-lock text-gray-300 mt-0.5"></i> Field inti tidak bisa dihapus</li>
                </ul>
            </div>
            <a href="{{ url('/keberatan/ajukan') }}" target="_blank" class="w-full flex items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl text-[#004a99] font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 transition-all shadow-md">
                <i class="fas fa-external-link-alt mr-2"></i> Preview Form Publik
            </a>
        </div>

        {{-- CANVAS (Kanan) --}}
        <div class="lg:col-span-3 space-y-8">

            {{-- SECTION: LABEL FIELD INTI --}}
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-cyan-500">
                <div class="p-8 space-y-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center text-cyan-600">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-cyan-600 uppercase tracking-widest">Pengaturan Label Field Inti</h4>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Ubah teks label yang tampil di form publik</p>
                        </div>
                        <span class="ml-auto px-3 py-1 bg-cyan-50 text-cyan-600 rounded-lg text-[9px] font-black tracking-widest">LOCKED FIELDS</span>
                    </div>

                    {{-- Judul Halaman --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="col-span-2">
                            <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">1. Konten Halaman</label>
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Judul Utama Halaman</label>
                            <input type="text" id="keberatan-title-input" value="{{ $settings['keberatan_title'] ?? 'Formulir Keberatan Permohonan Informasi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Sub-judul Halaman</label>
                            <textarea id="keberatan-subtitle-input" rows="2" class="tinymce-editor w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">{{ $settings['keberatan_subtitle'] ?? 'Gunakan formulir ini untuk mengajukan keberatan atas permohonan informasi yang telah diajukan.' }}</textarea>
                        </div>
                    </div>

                    {{-- Identitas Pemohon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-4">
                        <div class="col-span-2">
                            <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">2. Bagian Identitas Pemohon</label>
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Nama Lengkap</label>
                            <input type="text" id="keberatan-label-nama" value="{{ $settings['keberatan_label_nama'] ?? 'Nama Lengkap Pemohon' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Pekerjaan</label>
                            <input type="text" id="keberatan-label-pekerjaan" value="{{ $settings['keberatan_label_pekerjaan'] ?? 'Pekerjaan / Profesi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label NPWP</label>
                            <input type="text" id="keberatan-label-npwp" value="{{ $settings['keberatan_label_npwp'] ?? 'Nomor NPWP (Opsional)' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Alamat</label>
                            <input type="text" id="keberatan-label-alamat" value="{{ $settings['keberatan_label_alamat'] ?? 'Alamat Domisili Pemohon' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label No. Telepon</label>
                            <input type="text" id="keberatan-label-telepon" value="{{ $settings['keberatan_label_telepon'] ?? 'Nomor Telepon / WhatsApp' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Email</label>
                            <input type="text" id="keberatan-label-email" value="{{ $settings['keberatan_label_email'] ?? 'Alamat Email Aktif' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Upload KTP</label>
                            <input type="text" id="keberatan-label-ktp" value="{{ $settings['keberatan_label_ktp'] ?? 'Unggah Foto/Scan KTP' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>

                        {{-- Field Opsional: Kuasa --}}
                        <div class="col-span-2 pt-4">
                            <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">3. Bagian Kuasa Pemohon (Opsional)</label>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                            <div>
                                <label class="text-[9px] font-black text-gray-400 uppercase block">Label Nama Kuasa</label>
                                <input type="text" id="keberatan-label-nama-kuasa" value="{{ $settings['keberatan_label_nama_kuasa'] ?? 'Nama Penerima Kuasa' }}" class="bg-transparent border-0 p-0 text-xs font-bold text-gray-700 focus:ring-0 mt-1">
                            </div>
                            <div>
                                <input type="checkbox" id="keberatan-show-kuasa" {{ ($settings['keberatan_show_kuasa'] ?? 'yes') == 'yes' ? 'checked' : '' }} class="w-5 h-5 cursor-pointer rounded">
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                            <div>
                                <label class="text-[9px] font-black text-gray-400 uppercase block">Label Surat Kuasa</label>
                                <input type="text" id="keberatan-label-surat-kuasa" value="{{ $settings['keberatan_label_surat_kuasa'] ?? 'Upload Surat Kuasa' }}" class="bg-transparent border-0 p-0 text-xs font-bold text-gray-700 focus:ring-0 mt-1">
                            </div>
                            <div>
                                <input type="checkbox" id="keberatan-show-surat-kuasa" {{ ($settings['keberatan_show_surat_kuasa'] ?? 'yes') == 'yes' ? 'checked' : '' }} class="w-5 h-5 cursor-pointer rounded">
                            </div>
                        </div>
                    </div>

                    {{-- Alasan Keberatan --}}
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 pt-4">
                        <div class="col-span-2">
                            <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">4. Bagian Alasan Keberatan</label>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label No. Registrasi Permohonan</label>
                            <input type="text" id="keberatan-label-no-registrasi" value="{{ $settings['keberatan_label_no_registrasi'] ?? 'Nomor Registrasi / ID Permohonan' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Tujuan Penggunaan</label>
                            <input type="text" id="keberatan-label-tujuan" value="{{ $settings['keberatan_label_tujuan'] ?? 'Tujuan Penggunaan Informasi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-gray-400 uppercase">Label Kasus Posisi</label>
                            <input type="text" id="keberatan-label-kasus-posisi" value="{{ $settings['keberatan_label_kasus_posisi'] ?? 'Uraian Kasus Posisi (Opsional)' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION: FIELD CUSTOM TAMBAHAN --}}
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
                <div class="p-6 md:p-8 flex items-center gap-6">
                    <div class="w-16 h-16 bg-[#004a99] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shrink-0">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="flex-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Judul Bagian Field Tambahan</label>
                        <input type="text" id="section-title-input" value="{{ $sectionTitle ?? 'INFORMASI TAMBAHAN' }}"
                            class="w-full bg-transparent border-none p-0 text-xl md:text-2xl font-black text-[#004a99] focus:ring-0 uppercase placeholder-gray-200"
                            placeholder="CONTOH: DATA PENUNJANG">
                    </div>
                </div>
            </div>

            {{-- FIELDS LIST --}}
            <div id="custom-fields-container" class="space-y-4">
                @if(isset($customFields) && count($customFields) > 0)
                    @foreach($customFields as $index => $field)
                    <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all" data-id="{{ $index }}">
                        <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                            <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                                <i class="fas fa-grip-vertical text-xl"></i>
                            </div>
                            <div class="flex-1 space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Label Field</label>
                                <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" value="{{ $field['label'] ?? '' }}">
                            </div>
                            <div class="w-full md:w-1/4 space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Tipe Data</label>
                                <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                                    <option value="text"     {{ ($field['type'] ?? '') == 'text'     ? 'selected' : '' }}>TEKS PENDEK</option>
                                    <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>PARAGRAF</option>
                                    <option value="file"     {{ ($field['type'] ?? '') == 'file'     ? 'selected' : '' }}>UNGGAH BERKAS</option>
                                    <option value="select"   {{ ($field['type'] ?? '') == 'select'   ? 'selected' : '' }}>PILIHAN (DROPDOWN)</option>
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

            {{-- TOMBOL TAMBAH FIELD --}}
            <button type="button" id="btn-add-field" class="w-full py-8 bg-white border-2 border-dashed border-gray-200 rounded-3xl text-gray-400 hover:border-[#004a99] hover:text-[#004a99] hover:bg-blue-50/50 transition-all flex flex-col items-center justify-center gap-3 group">
                <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="text-xs font-black uppercase tracking-widest">Tambah Field Custom Baru</span>
            </button>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {

    // Tambah field baru
    $('#btn-add-field').click(function() {
        let id = new Date().getTime();
        let html = `
            <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all" data-id="${id}" style="display:none;">
                <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                    <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                        <i class="fas fa-grip-vertical text-xl"></i>
                    </div>
                    <div class="flex-1 space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Label Field</label>
                        <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" placeholder="Masukkan label field baru...">
                    </div>
                    <div class="w-full md:w-1/4 space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tipe Input</label>
                        <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                            <option value="text">TEKS PENDEK</option>
                            <option value="textarea">PARAGRAF</option>
                            <option value="file">UNGGAH BERKAS</option>
                            <option value="select">PILIHAN (DROPDOWN)</option>
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
        $el.find('.field-label').focus();
    });

    // Hapus field
    $(document).on('click', '.btn-delete-field', function() {
        let $el = $(this).closest('.custom-field');
        $el.slideUp(300, function() { $(this).remove(); });
    });

    // Simpan form
    $('#btn-save-form').click(function() {
        let sectionTitle = $('#section-title-input').val().trim().toUpperCase() || 'INFORMASI TAMBAHAN';

        let coreSettings = {
            keberatan_title:               $('#keberatan-title-input').val().trim(),
            keberatan_subtitle:            (typeof tinymce !== 'undefined' && tinymce.get('keberatan-subtitle-input')) ? tinymce.get('keberatan-subtitle-input').getContent() : $('#keberatan-subtitle-input').val().trim(),
            keberatan_label_nama:          $('#keberatan-label-nama').val().trim(),
            keberatan_label_pekerjaan:     $('#keberatan-label-pekerjaan').val().trim(),
            keberatan_label_npwp:          $('#keberatan-label-npwp').val().trim(),
            keberatan_label_alamat:        $('#keberatan-label-alamat').val().trim(),
            keberatan_label_telepon:       $('#keberatan-label-telepon').val().trim(),
            keberatan_label_email:         $('#keberatan-label-email').val().trim(),
            keberatan_label_ktp:           $('#keberatan-label-ktp').val().trim(),
            keberatan_label_nama_kuasa:    $('#keberatan-label-nama-kuasa').val().trim(),
            keberatan_label_surat_kuasa:   $('#keberatan-label-surat-kuasa').val().trim(),
            keberatan_label_no_registrasi: $('#keberatan-label-no-registrasi').val().trim(),
            keberatan_label_tujuan:        $('#keberatan-label-tujuan').val().trim(),
            keberatan_label_kasus_posisi:  $('#keberatan-label-kasus-posisi').val().trim(),
            keberatan_show_kuasa:          $('#keberatan-show-kuasa').is(':checked') ? 'yes' : 'no',
            keberatan_show_surat_kuasa:    $('#keberatan-show-surat-kuasa').is(':checked') ? 'yes' : 'no',
        };

        let fields = [];
        $('.custom-field').each(function() {
            let label = $(this).find('.field-label').val().trim();
            let type  = $(this).find('.field-type').val();
            if (label !== '') {
                fields.push({
                    label: label,
                    type:  type,
                    name:  'custom_keb_' + label.toLowerCase().replace(/[^a-z0-9]/g, '_')
                });
            }
        });

        let $btn = $(this);
        let orig = $btn.html();
        $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> MENYIMPAN...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.keberatan.save_form') }}",
            type: 'POST',
            data: {
                _token:        "{{ csrf_token() }}",
                section_title: sectionTitle,
                core_settings: coreSettings,
                fields:        fields
            },
            success: function() {
                $btn.html(orig).prop('disabled', false);
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL DISIMPAN!',
                    text: 'Konfigurasi form Keberatan berhasil diperbarui.',
                    confirmButtonColor: '#004a99',
                });
            },
            error: function() {
                $btn.html(orig).prop('disabled', false);
                Swal.fire({ icon: 'error', title: 'GAGAL MENYIMPAN', text: 'Terjadi kesalahan, coba lagi.', confirmButtonColor: '#ef4444' });
            }
        });
    });
});
</script>
@endsection
