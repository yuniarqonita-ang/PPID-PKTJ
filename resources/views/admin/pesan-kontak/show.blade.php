@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-xl font-black text-[#004a99] uppercase tracking-widest">Detail Pesan</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium">Membaca pesan dari form Hubungi Kami</p>
        </div>
        <a href="{{ route('admin.pesan-kontak.index') }}" class="px-6 py-2 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <div class="border-b border-gray-100 pb-6 mb-6">
                <h3 class="text-2xl font-black text-gray-800 mb-2">{{ $pesan->judul }}</h3>
                <div class="flex items-center text-sm text-gray-500 gap-4">
                    <span><i class="fas fa-calendar mr-1"></i> {{ optional($pesan->created_at)->format('d M Y H:i') ?? '-' }} WIB</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1 bg-gray-50 rounded-2xl p-6">
                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Informasi Pengirim</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase">Nama</div>
                            <div class="font-bold text-gray-800">{{ $pesan->nama }}</div>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase">Email</div>
                            <a href="mailto:{{ $pesan->email }}" class="font-bold text-[#004a99] hover:underline">{{ $pesan->email }}</a>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase">Telepon / HP</div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->telepon) }}" target="_blank" class="font-bold text-green-600 hover:underline">
                                <i class="fab fa-whatsapp mr-1"></i>{{ $pesan->telepon }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Isi Pesan</h4>
                    <div class="bg-blue-50/30 border border-blue-100 rounded-2xl p-6 text-gray-700 whitespace-pre-wrap leading-relaxed">
                        {{ $pesan->pesan }}
                    </div>

                    <div class="mt-8 flex justify-end">
                        <form action="{{ route('admin.pesan-kontak.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 bg-red-100 text-red-600 font-bold rounded-xl hover:bg-red-600 hover:text-white transition-all flex items-center">
                                <i class="fas fa-trash mr-2"></i> Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
