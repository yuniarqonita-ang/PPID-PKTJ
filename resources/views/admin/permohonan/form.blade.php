@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0D1117] via-[#161B22] to-[#0D1117] p-6 text-slate-300">
    <div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 drop-shadow-md">Form Builder: Permohonan Informasi</h1>
            <p class="text-sm mt-2 text-slate-400">Atur dan modifikasi form registrasi yang tampil di halaman publik.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.permohonan.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-700 bg-slate-800 text-slate-300 hover:bg-slate-700 transition duration-300 flex items-center gap-2">
                <i class="fas fa-times"></i> Batal
            </a>
            <button class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-medium hover:from-blue-500 hover:to-cyan-500 transition duration-300 shadow-[0_0_15px_rgba(6,182,212,0.4)] flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Form
            </button>
        </div>
    </div>

    <!-- MAIN BUILDER WORKSPACE -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <!-- SIDEBAR TOOLS -->
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-5 shadow-xl">
                <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-toolbox text-cyan-400"></i> Komponen Form
                </h3>
                
                <div class="space-y-3">
                    <div class="p-3 border border-slate-700/50 bg-slate-800/50 rounded-lg cursor-not-allowed opacity-60 flex items-center gap-3">
                        <i class="fas fa-font text-slate-400 w-5"></i>
                        <span class="text-sm">Teks Singkat</span>
                    </div>
                    <div class="p-3 border border-slate-700/50 bg-slate-800/50 rounded-lg cursor-not-allowed opacity-60 flex items-center gap-3">
                        <i class="fas fa-align-left text-slate-400 w-5"></i>
                        <span class="text-sm">Paragraf</span>
                    </div>
                    <div class="p-3 border border-slate-700/50 bg-slate-800/50 rounded-lg cursor-not-allowed opacity-60 flex items-center gap-3">
                        <i class="fas fa-check-square text-slate-400 w-5"></i>
                        <span class="text-sm">Pilihan Ganda</span>
                    </div>
                    <div class="p-3 border border-slate-700/50 bg-slate-800/50 rounded-lg cursor-not-allowed opacity-60 flex items-center gap-3">
                        <i class="fas fa-upload text-slate-400 w-5"></i>
                        <span class="text-sm">Upload File</span>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-slate-700/50">
                    <p class="text-xs text-yellow-500/90 leading-relaxed">
                        <i class="fas fa-info-circle mr-1"></i> Form builder saat ini dalam mode <b>System Locked</b> untuk menjaga integritas database. Field dasar tidak dapat dihapus.
                    </p>
                </div>
            </div>
            
            <a href="http://ppid.pktj.ac.id/permohonan-informasi" target="_blank" class="w-full block text-center p-3 rounded-lg border border-cyan-500/30 bg-cyan-900/20 text-cyan-400 hover:bg-cyan-900/40 transition">
                <i class="fas fa-external-link-alt mr-2"></i> Preview Form Publik
            </a>
        </div>
        
        <!-- BUILDER CANVAS -->
        <div class="lg:col-span-3 space-y-4">
            
            <!-- SECTION: PERINGATAN -->
            <div class="bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 overflow-hidden shadow-xl transition hover:border-blue-500/30">
                <div class="bg-rose-900/20 border-l-4 border-rose-500 p-4 m-5 rounded flex justify-between items-start">
                    <div>
                        <input type="text" class="bg-transparent border-0 text-rose-400 font-bold text-lg focus:ring-0 p-0 w-full mb-2" value="⚠️ Peringatan!">
                        <textarea class="bg-transparent border border-transparent hover:border-slate-700 focus:border-blue-500 focus:bg-[#0D1117] focus:ring-0 text-sm text-rose-300 w-full rounded p-2 transition" rows="2">Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan. Pastikan data yang diungkapkan telah sesuai dengan ketentuan yang berlaku.</textarea>
                    </div>
                    <div class="text-slate-500 flex gap-2">
                        <button class="hover:text-blue-400"><i class="fas fa-edit"></i></button>
                    </div>
                </div>
            </div>

            <!-- SECTION: DATA AKUN -->
            <div class="bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-xl relative mt-8">
                <div class="absolute -top-3.5 left-6 bg-blue-600 text-white px-4 py-1 text-xs font-bold tracking-wider rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]">
                    DATA AKUN
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <!-- Username -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-blue-500 transition" value="Username *">
                        <div class="absolute right-3 top-9 text-slate-500 group-hover:text-blue-400 transition cursor-help" title="System Field - Cannot delete"><i class="fas fa-lock"></i></div>
                    </div>
                    
                    <!-- Email -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-blue-500 transition" value="Email *">
                        <div class="absolute right-3 top-9 text-slate-500 group-hover:text-blue-400 transition cursor-help" title="System Field - Cannot delete"><i class="fas fa-lock"></i></div>
                    </div>
                </div>
            </div>

            <!-- SECTION: DATA PRIBADI -->
            <div class="bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-xl relative mt-8">
                <div class="absolute -top-3.5 left-6 bg-cyan-600 text-white px-4 py-1 text-xs font-bold tracking-wider rounded-full shadow-[0_0_10px_rgba(8,145,178,0.5)]">
                    DATA PRIBADI
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <!-- Nama Lengkap -->
                    <div class="col-span-2 relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-cyan-500 transition" value="Nama Lengkap *">
                        <div class="absolute right-3 top-9 text-slate-500 group-hover:text-cyan-400 transition"><i class="fas fa-lock"></i></div>
                    </div>
                    
                    <!-- Jenis Identitas -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field (Dropdown)</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-cyan-500 transition" value="Jenis Identitas *">
                        <div class="absolute right-3 top-9 text-slate-500"><i class="fas fa-lock"></i></div>
                    </div>
                    
                    <!-- No Identitas -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-cyan-500 transition" value="Nomor Identitas *">
                        <div class="absolute right-3 top-9 text-slate-500"><i class="fas fa-lock"></i></div>
                    </div>

                    <!-- FOTO KTP TGL 27 MARET -->
                    <div class="col-span-2 relative group p-1 border border-dashed border-emerald-500/50 rounded-xl bg-emerald-900/10">
                        <div class="p-3">
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-xs font-semibold text-emerald-400">File Upload Field (Baru)</label>
                                <div class="flex gap-2">
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded">NEW</span>
                                    <i class="fas fa-cog text-slate-400 hover:text-emerald-400 cursor-pointer"></i>
                                </div>
                            </div>
                            <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-emerald-500 transition" value="Foto Identitas (KTP/Paspor/SIM) *">
                            <div class="mt-2 text-xs text-slate-500 flex items-center gap-2">
                                <i class="fas fa-file-image"></i> Diterima: JPG, PNG, PDF (Max 5MB)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: DETAIL PERMOHONAN -->
            <div class="bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-xl relative mt-8">
                <div class="absolute -top-3.5 left-6 bg-purple-600 text-white px-4 py-1 text-xs font-bold tracking-wider rounded-full shadow-[0_0_10px_rgba(147,51,234,0.5)]">
                    DETAIL PERMOHONAN
                </div>
                
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <!-- Jenis Informasi -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-purple-500 transition" value="Jenis Informasi yang Diminta *">
                    </div>
                    
                    <!-- Uraian -->
                    <div class="relative group">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field (Textarea)</label>
                        <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-purple-500 transition" value="Deskripsi/Uraian Permohonan *">
                    </div>

                    <!-- BERKAS PENDUKUNG -->
                    <div class="relative group p-1 border border-dashed border-emerald-500/50 rounded-xl bg-emerald-900/10 mt-2">
                        <div class="p-3">
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-xs font-semibold text-emerald-400">File Upload Field (Baru)</label>
                                <div class="flex gap-2">
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded">NEW</span>
                                    <i class="fas fa-cog text-slate-400 hover:text-emerald-400 cursor-pointer"></i>
                                </div>
                            </div>
                            <input type="text" class="w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-emerald-500 transition" value="Berkas Pendukung Permohonan (Opsional)">
                            <div class="mt-2 text-xs text-slate-500 flex items-center gap-2">
                                <i class="fas fa-file-pdf"></i> Diterima: JPG, PNG, PDF, DOCX (Max 10MB)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CONTANER CUSTOM FIELDS DISINI -->
            <div id="custom-fields-container" class="space-y-4 mt-8">
                @if(isset($customFields) && count($customFields) > 0)
                    @foreach($customFields as $index => $field)
                        <div class="custom-field bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-xl relative" data-id="{{ $index }}">
                            <div class="absolute -top-3.5 left-6 bg-orange-600 text-white px-4 py-1 text-xs font-bold tracking-wider rounded-full shadow-[0_0_10px_rgba(234,88,12,0.5)]">
                                FIELD CUSTOM
                            </div>
                            <div class="flex justify-between items-center mb-4 mt-2">
                                <div class="w-2/3">
                                    <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                                    <input type="text" class="field-label w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-orange-500 transition" value="{{ $field['label'] ?? '' }}">
                                </div>
                                <div class="w-1/4">
                                    <label class="block text-xs font-semibold text-slate-400 mb-1">Tipe Input</label>
                                    <select class="field-type w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-orange-500 transition">
                                        <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>Teks Pendek</option>
                                        <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>Paragraf</option>
                                        <option value="file" {{ ($field['type'] ?? '') == 'file' ? 'selected' : '' }}>Upload File</option>
                                    </select>
                                </div>
                                <button type="button" class="btn-delete-field text-rose-500 hover:text-rose-400 pt-5 transition">
                                    <i class="fas fa-trash-alt text-xl"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- ADD SECTION BUTTON -->
            <div id="btn-add-field" class="mt-6 border-2 border-dashed border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-800/30 hover:border-blue-500/50 transition cursor-pointer group">
                <i class="fas fa-plus-circle text-2xl text-slate-500 group-hover:text-blue-400 transition mb-2 block"></i>
                <span class="text-sm font-medium text-slate-400 group-hover:text-blue-300 transition">Tambah Field Custom Pilihan Admin</span>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Tombol Batal
        $('.fa-times').closest('a').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Batal mengubah form?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tinggalkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr('href');
                }
            });
        });

        // Add New Field
        $('#btn-add-field').click(function() {
            let id = new Date().getTime();
            let html = `
                <div class="custom-field bg-[#161B22]/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-xl relative" data-id="${id}" style="display:none;">
                    <div class="absolute -top-3.5 left-6 bg-orange-600 text-white px-4 py-1 text-xs font-bold tracking-wider rounded-full shadow-[0_0_10px_rgba(234,88,12,0.5)]">
                        FIELD CUSTOM
                    </div>
                    <div class="flex justify-between items-center mb-4 mt-2">
                        <div class="w-2/3">
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Label Field</label>
                            <input type="text" class="field-label w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-orange-500 transition" placeholder="Cth: Dokumen Tambahan" value="">
                        </div>
                        <div class="w-1/4">
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Tipe Input</label>
                            <select class="field-type w-full bg-[#0D1117] border border-slate-700 rounded-lg px-3 py-2 text-white outline-none focus:border-orange-500 transition">
                                <option value="text">Teks Pendek</option>
                                <option value="textarea">Paragraf</option>
                                <option value="file">Upload File</option>
                            </select>
                        </div>
                        <button type="button" class="btn-delete-field text-rose-500 hover:text-rose-400 pt-5 transition">
                            <i class="fas fa-trash-alt text-xl"></i>
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
            $el.slideUp(300, function() {
                $(this).remove();
            });
        });

        // Save Form Logic
        $('.fa-save').parent('button').click(function() {
            let schema = [];
            $('.custom-field').each(function() {
                let label = $(this).find('.field-label').val();
                let type = $(this).find('.field-type').val();
                if(label.trim() !== '') {
                    schema.push({
                        label: label.trim(),
                        type: type,
                        name: 'custom_' + label.toLowerCase().replace(/[^a-z0-9]/g, '_') + '_' + Math.floor(Math.random()*100)
                    });
                }
            });

            // Ganti Button Icon ke loading
            let $btn = $(this);
            let btnText = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            $btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.permohonan.save_form') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schema: schema
                },
                success: function(response) {
                    $btn.html(btnText);
                    $btn.prop('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: 'Skema custom fields berhasil disimpan dan langsung tayang di portal publik.',
                        background: '#161B22',
                        color: '#fff',
                        confirmButtonColor: '#0ea5e9'
                    });
                },
                error: function() {
                    $btn.html(btnText);
                    $btn.prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat menyimpan form.',
                        background: '#161B22',
                        color: '#fff'
                    });
                }
            });
        });
    });
</script>

        </div>
    </div>
</div>
@endsection
