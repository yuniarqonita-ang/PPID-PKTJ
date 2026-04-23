@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] py-20 px-4 md:px-0">
    <div class="max-w-4xl mx-auto">
        <!-- HEADER -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-[#004a99] outfit uppercase tracking-tight mb-4">Pengajuan Keberatan Informasi</h1>
            <p class="text-gray-500 font-medium">Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</p>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-6 rounded-2xl shadow-sm mb-8 animate-fade-in">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-check text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-emerald-900 font-black uppercase text-sm">Berhasil Dikirim!</h4>
                        <p class="text-emerald-700 text-xs">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif


        <form action="{{ route('keberatan.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- SECTION 1: REFERENSI PERMOHONAN -->
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-blue-600">
                <div class="p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Referensi Permohonan</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Permohonan (Referensi)</label>
                            <input type="number" name="nomor_registrasi_permohonan" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all"
                                placeholder="Masukkan ID permohonan yang diajukan keberatan...">
                            @error('nomor_registrasi_permohonan') <p class="text-red-500 text-[10px] uppercase font-black mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: IDENTITAS PENGJU -->
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Identitas Pengaju Keberatan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1 col-span-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_pemohon" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none">
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Alamat</label>
                            <textarea name="alamat" required rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none"></textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Nomor Telepon/WA</label>
                            <input type="tel" name="nomor_telepon" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: ALASAN KEBERATAN -->
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-amber-500">
                <div class="p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Alasan Pengajuan Keberatan</h3>
                    </div>

                    <div class="space-y-4">
                        @php
                            $reasons = [
                                'a' => 'Penolakan atas permintaan informasi',
                                'b' => 'Tidak disediakannya informasi berkala',
                                'c' => 'Tidak ditanggapinya permintaan informasi',
                                'd' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                                'e' => 'Tidak dipenuhinya permintaan informasi',
                                'f' => 'Pengenaan biaya yang tidak wajar',
                                'g' => 'Penyampaian informasi yang melebihi waktu yang ditentukan'
                            ];
                        @endphp

                        @foreach($reasons as $key => $label)
                        <label class="flex items-start gap-3 p-4 bg-gray-50 rounded-2xl cursor-pointer hover:bg-amber-50 transition-colors border border-transparent hover:border-amber-100">
                            <input type="checkbox" name="alasan_keberatan_list[]" value="{{ $key }}" class="mt-1 w-4 h-4 text-amber-600 rounded focus:ring-amber-500">
                            <div class="text-xs font-bold text-gray-700 uppercase tracking-wide">
                                <span class="text-amber-600 mr-2">{{ $key }}.</span> {{ $label }}
                            </div>
                        </label>
                        @endforeach
                    </div>

                    <div class="space-y-1 pt-4">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tujuan Penggunaan & Kasus Posisi</label>
                        <textarea name="kasus_posisi" required rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none" placeholder="Jelaskan secara singkat alasan keberatan Anda..."></textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Rincian Informasi Yang Dibutuhkan</label>
                        <textarea name="rincian_informasi" required rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none"></textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tujuan Penggunaan Informasi</label>
                        <input type="text" name="tujuan_penggunaan" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold outline-none">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-[#004a99] text-white rounded-3xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-blue-200 hover:bg-blue-800 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                <i class="fas fa-paper-plane"></i> Kirim Keberatan Resmi
            </button>

            <!-- NEW: HAK-HAK PEMOHON INFO (Collapsible - Moved to Bottom Middle) -->
            @if(!empty($settings['permohonan_hak_hak']))
            <div class="mt-8 flex flex-col items-center">
                <div class="w-full" style="max-width: 500px;">
                    <button class="w-full text-center px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center gap-3 group hover:bg-emerald-100 transition-all shadow-sm" 
                            type="button" data-bs-toggle="collapse" data-bs-target="#hakPemohonInfo" aria-expanded="false">
                        <div class="w-8 h-8 bg-emerald-600 text-white rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-gavel text-xs"></i>
                        </div>
                        <div class="text-start">
                            <h6 class="mb-0 text-emerald-900 fw-bold outfit text-[11px] uppercase tracking-wider">Lihat Hak-hak Pemohon Informasi</h6>
                        </div>
                        <i class="fas fa-chevron-down text-emerald-400 group-hover:text-emerald-600 transition-transform text-xs"></i>
                    </button>
                    <div class="collapse" id="hakPemohonInfo">
                        <div class="mt-3 p-6 bg-white border border-emerald-100 rounded-3xl shadow-lg text-xs leading-relaxed law-text text-start">
                            {!! $settings['permohonan_hak_hak'] !!}
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .law-text p { margin-bottom: 0.8rem; }
                .law-text strong { color: #004a99; }
                #hakPemohonInfo.show + button i { transform: rotate(180deg); }
            </style>
            @endif
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
</style>
@endsection
