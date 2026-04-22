@extends('layouts.app')

@section('content')
<div class="container-fluid lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#004a99] uppercase tracking-tighter">Proses Keberatan</h2>
            <p class="text-slate-500 font-medium">Update data dan tanggapan untuk pengajuan #{{ $keberatan->nomor_registrasi_keberatan }}</p>
        </div>
        <a href="{{ route('admin.keberatan.index') }}" class="px-5 py-3 bg-slate-100 text-slate-600 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-slate-200 transition-all">
            <i class="fas fa-times mr-2"></i> Batal
        </a>
    </div>

    <form action="{{ route('admin.keberatan.update', $keberatan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT: CORE INFO -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-slate-200 p-8">
                    <h3 class="text-lg font-black text-[#004a99] uppercase tracking-tight mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-cog text-sm"></i></span>
                        Status & Registrasi
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Status Proses</label>
                            <select name="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                                <option value="pending" {{ $keberatan->status == 'pending' ? 'selected' : '' }}>PENDING (BARU)</option>
                                <option value="processed" {{ $keberatan->status == 'processed' ? 'selected' : '' }}>DIPROSES</option>
                                <option value="completed" {{ $keberatan->status == 'completed' ? 'selected' : '' }}>SELESAI</option>
                                <option value="rejected" {{ $keberatan->status == 'rejected' ? 'selected' : '' }}>DITOLAK</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">No. Registrasi Keberatan</label>
                            <input type="text" name="nomor_registrasi_keberatan" value="{{ $keberatan->nomor_registrasi_keberatan }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">NPWP (Jika ada)</label>
                            <input type="text" name="npwp" value="{{ $keberatan->npwp }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: TANGGAPAN -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-slate-200 p-8">
                    <h3 class="text-lg font-black text-[#004a99] uppercase tracking-tight mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center"><i class="fas fa-edit text-sm"></i></span>
                        Tanggapan Atasan PPID
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Hari/Tgl Tanggapan</label>
                            <input type="date" name="tanggal_tanggapan_keberatan" value="{{ $keberatan->tanggal_tanggapan_keberatan ? $keberatan->tanggal_tanggapan_keberatan->format('Y-m-d') : '' }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Keputusan Atasan</label>
                            <input type="text" name="keputusan_atasan_ppid" value="{{ $keberatan->keputusan_atasan_ppid }}" placeholder="Contoh: Memberikan sebagian informasi" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Nama Atasan PPID</label>
                            <input type="text" name="nama_atasan_ppid" value="{{ $keberatan->nama_atasan_ppid }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Posisi/Jabatan Atasan</label>
                            <input type="text" name="posisi_atasan_ppid" value="{{ $keberatan->posisi_atasan_ppid }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Tanggapan/Kasus Posisi (Final)</label>
                        <textarea name="kasus_posisi" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700">{{ $keberatan->kasus_posisi }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-10 py-4 bg-[#004a99] text-white rounded-2xl font-black uppercase text-sm tracking-[2px] shadow-xl shadow-blue-200 hover:scale-[1.02] active:scale-95 transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
