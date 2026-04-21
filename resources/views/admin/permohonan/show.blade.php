@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800 uppercase">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.permohonan.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-file-invoice mr-2 text-[#ffc107]"></i> Detail Permohonan
                </h1>
                <p class="text-gray-500 font-medium mt-1 text-[10px] tracking-widest uppercase text-gray-800">Review pengajuan informasi publik dari masyarakat</p>
            </div>
            
            @php
                $statusColors = [
                    'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'MENUNGGU'],
                    'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'DISETUJUI'],
                    'completed' => ['bg' => 'bg-blue-600', 'text' => 'text-white', 'label' => 'SELESAI'],
                    'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'DITOLAK'],
                ];
                $st = $statusColors[$permohonan->status ?? 'pending'] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-400', 'label' => strtoupper($permohonan->status ?? 'pending')];
            @endphp
            <div class="px-6 py-3 {{ $st['bg'] }} {{ $st['text'] }} rounded-2xl font-black text-xs shadow-sm ring-1 ring-black/5 animate-pulse">
                STATUS: {{ $st['label'] }}
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-green-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-green-800 font-bold uppercase text-xs">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- MAIN CONTENT (Left) -->
            <div class="lg:col-span-2 space-y-6 text-gray-800">
                
                <!-- USER INFO CARD -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
                    <div class="p-8 space-y-6">
                        <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                            <i class="fas fa-user-circle mr-3 text-[#ffc107] text-gray-800"></i> Profil Pemohon
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                                <p class="text-sm font-bold text-gray-800">{{ $permohonan->nama_pemohon }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email & No. Telp</label>
                                <p class="text-sm font-bold text-gray-800">{{ $permohonan->email }}</p>
                                <p class="text-[10px] font-bold text-[#004a99]">{{ $permohonan->nomor_telepon }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Identitas ({{ strtoupper($permohonan->jenis_identitas) }})</label>
                                <p class="text-sm font-bold text-gray-800">{{ $permohonan->nomor_identitas }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pekerjaan</label>
                                <p class="text-sm font-bold text-gray-800">{{ $permohonan->pekerjaan ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                            <div class="flex-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat Domisili</label>
                                <p class="text-xs font-medium text-gray-600 mt-1 leading-relaxed">{{ $permohonan->alamat }}</p>
                            </div>
                            @if($permohonan->foto_ktp)
                            <a href="{{ Storage::url($permohonan->foto_ktp) }}" target="_blank" class="shrink-0 px-4 py-3 bg-blue-50 text-[#004a99] rounded-xl font-bold text-[10px] hover:bg-[#004a99] hover:text-white transition-all">
                                <i class="fas fa-id-card mr-2 text-gray-800"></i> CEK IDENTITAS
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- REQUEST INFO CARD -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#004a99]">
                    <div class="p-8 space-y-6">
                        <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                            <i class="fas fa-file-alt mr-3 text-[#ffc107]"></i> Uraian Permohonan
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest mb-2 block">Jenis Informasi Yang Diminta</label>
                                <h4 class="text-sm font-bold text-gray-800">{{ $permohonan->jenis_informasi }}</h4>
                            </div>

                            <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest mb-2 block">Tujuan Penggunaan Informasi</label>
                                <p class="text-xs font-medium text-gray-600 leading-relaxed">{{ $permohonan->deskripsi_permohonan }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="p-4 bg-blue-50/50 rounded-2xl flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#004a99] shadow-sm">
                                        <i class="fas fa-print"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase">Format</p>
                                        <p class="text-[10px] font-bold text-[#004a99]">{{ strtoupper($permohonan->format_informasi) }}</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-blue-50/50 rounded-2xl flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#004a99] shadow-sm">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase">Tgl Daftar</p>
                                        <p class="text-[10px] font-bold text-[#004a99]">{{ $permohonan->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CUSTOM FIELDS DATA -->
                        @if($permohonan->custom_fields_data && is_array($permohonan->custom_fields_data) && count($permohonan->custom_fields_data) > 0)
                        <div class="mt-10 space-y-4">
                            <h4 class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] border-b pb-2">Data Kuesioner Tambahan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($permohonan->custom_fields_data as $key => $value)
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <p class="text-[9px] font-black text-gray-400 uppercase truncate">{{ str_replace('_', ' ', preg_replace('/^custom_|_\\d+$/', '', $key)) }}</p>
                                    <div class="mt-1">
                                        @if(is_string($value) && str_starts_with($value, 'permohonan/custom'))
                                            <a href="{{ Storage::url($value) }}" target="_blank" class="text-[10px] font-black text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-paperclip mr-1"></i> LIHAT LAMPIRAN
                                            </a>
                                        @else
                                            <p class="text-xs font-bold text-gray-700">{{ is_array($value) ? json_encode($value) : $value }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ACTION SIDEBAR (Right) -->
            <div class="space-y-6">
                
                <!-- UPDATE STATUS CARD -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden text-gray-800">
                    <div class="p-6 space-y-6">
                        <h3 class="text-xs font-black text-[#004a99] uppercase tracking-widest">Update Progress</h3>
                        
                        <form action="{{ route('admin.permohonan.update', $permohonan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Ubah Status</label>
                                <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs font-bold text-[#004a99] focus:ring-4 focus:ring-blue-500/10 focus:outline-none appearance-none">
                                    <option value="pending" {{ ($permohonan->status ?? 'pending') == 'pending' ? 'selected' : '' }}>MENUNGGU</option>
                                    <option value="approved" {{ ($permohonan->status ?? 'pending') == 'approved' ? 'selected' : '' }}>SETUJUI</option>
                                    <option value="completed" {{ ($permohonan->status ?? 'pending') == 'completed' ? 'selected' : '' }}>SELESAIKAN</option>
                                    <option value="rejected" {{ ($permohonan->status ?? 'pending') == 'rejected' ? 'selected' : '' }}>TOLAK</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full py-4 bg-[#004a99] text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-lg hover:shadow-blue-500/20 transition-all flex items-center justify-center">
                                <i class="fas fa-save mr-2 text-[#ffc107]"></i> Update Status
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ATTACHMENTS CARD -->
                @if($permohonan->berkas_pendukung)
                <div class="bg-[#004a99] rounded-3xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] mb-4 flex items-center relative z-10 text-gray-800">
                        <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Berkas Pendukung
                    </h3>
                    <div class="relative z-10 bg-white/10 p-4 rounded-2xl backdrop-blur-sm flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                            <i class="fas fa-file-download text-gray-800"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold opacity-60 uppercase truncate">Lampiran Dokumen</p>
                            <a href="{{ Storage::url($permohonan->berkas_pendukung) }}" target="_blank" class="text-[10px] font-black hover:text-[#ffc107] truncate">DOWNLOAD FILE</a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- DANGER ZONE -->
                <div class="p-6 bg-red-50 rounded-3xl border border-red-100 space-y-4">
                    <h3 class="text-[10px] font-black text-red-500 uppercase tracking-widest flex items-center">
                        <i class="fas fa-biohazard mr-2"></i> Danger Zone
                    </h3>
                    <form action="{{ route('admin.permohonan.destroy', $permohonan->id) }}" method="POST" onsubmit="return confirm('Hapus data ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-white text-red-500 font-bold text-[10px] rounded-xl border border-red-200 hover:bg-red-500 hover:text-white transition-all uppercase tracking-widest">
                            Hapus Permohonan
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
