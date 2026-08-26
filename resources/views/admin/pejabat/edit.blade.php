@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8 max-w-5xl mx-auto">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] tracking-tight">Edit Pejabat: {{ $pejabat->nama }}</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Perbarui foto, biografi, riwayat pendidikan, jabatan & LHKPN.</p>
        </div>
        <a href="{{ route('admin.pejabat.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="p-6 bg-rose-50 border-2 border-rose-200 rounded-3xl space-y-2">
        <p class="font-black text-rose-800 text-sm uppercase">Terjadi Kesalahan:</p>
        <ul class="list-disc list-inside text-xs text-rose-700 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.pejabat.update', $pejabat->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[2.5rem] p-10 shadow-xl border-2 border-slate-100 space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pejabat->nama) }}" required class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">NIP (Nomor Induk Pegawai)</label>
                <input type="text" name="nip" value="{{ old('nip', $pejabat->nip) }}" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Jabatan Struktural <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $pejabat->jabatan) }}" required class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Tempat, Tanggal Lahir</label>
                <input type="text" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $pejabat->tempat_tanggal_lahir) }}" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Urutan Tampilan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $pejabat->urutan) }}" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-bold text-slate-800 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Ganti Pas Foto Pejabat</label>
                <div class="flex items-center gap-4">
                    @if($pejabat->foto)
                        <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" class="w-12 h-16 object-cover rounded-xl shadow-md border border-slate-200 flex-shrink-0">
                    @endif
                    <input type="file" name="foto" accept="image/*" class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] text-xs font-medium text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#004a99] file:text-white hover:file:bg-[#003875] transition-all">
                </div>
            </div>
        </div>

        <!-- BIOGRAFI -->
        <div class="space-y-2">
            <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Biografi & Profil Singkat</label>
            <textarea name="biografi" rows="3" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-sm font-medium text-slate-800 transition-all">{{ old('biografi', $pejabat->biografi) }}</textarea>
        </div>

        <!-- RIWAYAT PENDIDIKAN & JABATAN -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Riwayat Pendidikan (1 Baris = 1 Jenjang)</label>
                <textarea name="pendidikan" rows="5" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-xs font-medium text-slate-800 transition-all font-mono">{{ old('pendidikan', is_array($pejabat->pendidikan) ? implode("\n", $pejabat->pendidikan) : $pejabat->pendidikan) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-[#004a99] uppercase tracking-wider">Riwayat Jabatan / Karir (1 Baris = 1 Jabatan)</label>
                <textarea name="riwayat_jabatan" rows="5" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:border-[#004a99] focus:bg-white text-xs font-medium text-slate-800 transition-all font-mono">{{ old('riwayat_jabatan', is_array($pejabat->riwayat_jabatan) ? implode("\n", $pejabat->riwayat_jabatan) : $pejabat->riwayat_jabatan) }}</textarea>
            </div>
        </div>

        <!-- LHKPN SECTION -->
        <div class="bg-amber-50/60 p-8 rounded-3xl border-2 border-amber-100 space-y-6">
            <h4 class="text-base font-black text-amber-900 flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-amber-600"></i> Informasi LHKPN Pejabat
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-black text-amber-900 uppercase">Tahun LHKPN</label>
                    <input type="text" name="lhkpn_tahun" value="{{ old('lhkpn_tahun', $pejabat->lhkpn_tahun ?? '2025/2026') }}" class="w-full px-4 py-3 bg-white border-2 border-amber-200 rounded-xl text-xs font-bold text-slate-800">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-black text-amber-900 uppercase">Link LHKPN (KPK / Google Drive)</label>
                    <input type="url" name="lhkpn_link" value="{{ old('lhkpn_link', $pejabat->lhkpn_link) }}" class="w-full px-4 py-3 bg-white border-2 border-amber-200 rounded-xl text-xs font-bold text-slate-800" placeholder="https://elhkpn.kpk.go.id/ atau link Google Drive">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ $pejabat->aktif ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-2 border-slate-300 text-[#004a99] focus:ring-0">
            <label for="aktif" class="text-sm font-bold text-slate-700 cursor-pointer">Tampilkan pejabat ini di halaman publik</label>
        </div>

        <div class="pt-6 border-t-2 border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.pejabat.index') }}" class="px-8 py-4 bg-slate-100 text-slate-700 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all">Batal</a>
            <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-blue-900/20 hover:bg-[#003875] transition-all">Perbarui Pejabat</button>
        </div>
    </form>

</div>
@endsection
