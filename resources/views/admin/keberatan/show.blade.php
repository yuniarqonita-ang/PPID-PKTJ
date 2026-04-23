@extends('layouts.app')

@section('content')
<div class="container-fluid lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#004a99] uppercase tracking-tighter">DETAIL KEBERATAN PERMOHONAN INFORMASI</h2>
            <p class="text-slate-500 font-medium">Informasi lengkap pengajuan keberatan #{{ $keberatan->nomor_registrasi_keberatan }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.keberatan.index') }}" class="px-5 py-3 bg-slate-100 text-slate-600 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-slate-200 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('admin.keberatan.export.word', $keberatan->id) }}" class="px-5 py-3 bg-blue-600 text-white rounded-2xl font-black uppercase text-xs tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all flex items-center gap-2">
                <i class="fas fa-file-word"></i> Unduh Formulir (Word)
            </a>
            <a href="{{ route('admin.keberatan.edit', $keberatan->id) }}" class="px-5 py-3 bg-amber-500 text-white rounded-2xl font-black uppercase text-xs tracking-widest shadow-lg shadow-amber-200 hover:bg-amber-600 transition-all flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit / Proses
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- LEFT COLUMN: IDENTITAS -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-slate-200 p-8">
                <h3 class="text-lg font-black text-[#004a99] uppercase tracking-tight mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-user-tag text-sm"></i></span>
                    Identitas Pemohon
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nama Lengkap</label>
                        <p class="font-bold text-slate-800 uppercase">{{ $keberatan->nama_pemohon }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Pekerjaan</label>
                        <p class="font-bold text-slate-800">{{ $keberatan->pekerjaan }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Alamat</label>
                        <p class="font-bold text-slate-800 leading-relaxed">{{ $keberatan->alamat }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Kontak</label>
                        <p class="font-bold text-slate-800"><i class="fas fa-phone mr-2 text-slate-300"></i>{{ $keberatan->nomor_telepon }}</p>
                        <p class="font-bold text-slate-800"><i class="fas fa-envelope mr-2 text-slate-300"></i>{{ $keberatan->email }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-[2.5rem] shadow-xl p-8 text-white">
                <h3 class="text-lg font-black uppercase tracking-tight mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/10 text-white rounded-lg flex items-center justify-center"><i class="fas fa-info-circle text-sm"></i></span>
                    Status Pengajuan
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                        <span class="text-slate-400 text-xs font-bold uppercase">Status</span>
                        <span class="px-3 py-1 bg-blue-500 rounded-full text-[9px] font-black uppercase">{{ $keberatan->status }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                        <span class="text-slate-400 text-xs font-bold uppercase">Tgl Keberatan</span>
                        <span class="text-sm font-bold">{{ $keberatan->tanggal_keberatan->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-slate-400 text-xs font-bold uppercase">No. Registrasi</span>
                        <span class="text-sm font-bold text-amber-400">{{ $keberatan->nomor_registrasi_keberatan }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: RINCIAN & ALASAN -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-slate-200 p-8">
                <h3 class="text-lg font-black text-[#004a99] uppercase tracking-tight mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center"><i class="fas fa-exclamation-circle text-sm"></i></span>
                    Rincian Keberatan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Rincian Informasi</label>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $keberatan->rincian_informasi }}</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Tujuan Penggunaan</label>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $keberatan->tujuan_penggunaan }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Alasan Keberatan</label>
                    <div class="space-y-2">
                        @if(is_array($keberatan->alasan_keberatan_list))
                            @foreach($keberatan->alasan_keberatan_list as $reason)
                                <div class="flex items-center gap-3 p-3 bg-red-50 text-red-700 rounded-2xl border border-red-100">
                                    <i class="fas fa-times-circle text-xs opacity-50"></i>
                                    <span class="text-xs font-bold uppercase tracking-tight">{{ $reason }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-slate-400 italic">Tidak ada alasan terdaftar</p>
                        @endif
                    </div>
                </div>

                <div class="p-6 bg-[#004a99]/5 rounded-3xl border border-[#004a99]/10">
                    <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest block mb-2">Kasus Posisi</label>
                    <div class="text-sm font-medium text-slate-700 prose prose-slate max-w-none">
                        {!! nl2br(e($keberatan->kasus_posisi)) !!}
                    </div>
                </div>
            </div>

            <!-- TANGGAPAN ATASAN -->
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-slate-200 p-8">
                <h3 class="text-lg font-black text-[#004a99] uppercase tracking-tight mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center"><i class="fas fa-gavel text-sm"></i></span>
                    Tanggapan & Keputusan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Keputusan Atasan PPID</label>
                        <p class="font-bold text-slate-800">{{ $keberatan->keputusan_atasan ?: '-' }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Hari/Tgl Diputuskan</label>
                        <p class="font-bold text-slate-800">{{ $keberatan->tanggal_putusan ? $keberatan->tanggal_putusan->format('l, d M Y') : '-' }}</p>
                    </div>
                </div>

                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Catatan Tambahan / Biaya</label>
                    <p class="text-sm font-bold text-slate-700">Biaya: {{ $keberatan->biaya_yang_dikeluarkan ?: 'Gratis' }}</p>
                    <p class="text-sm font-medium text-slate-500 mt-2">Bentuk Pemberitahuan: {{ $keberatan->bentuk_pemberian_informasi ?: '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
