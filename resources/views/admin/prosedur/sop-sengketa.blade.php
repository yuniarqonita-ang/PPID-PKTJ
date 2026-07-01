@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem SOP: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        SOP <span class="text-[#ffc107]">Pengajuan Sengketa</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola dokumen Prosedur Operasional Standar Pengajuan Sengketa Informasi Publik.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('prosedur.sop-sengketa') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-2 border-emerald-200 text-emerald-900 px-8 py-5 rounded-[2rem] flex items-center gap-5 shadow-sm">
        <i class="fas fa-check-circle text-3xl text-emerald-500"></i>
        <p class="font-black uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    @include('admin.components.dokumen-list-admin', ['kategori' => 'SOP Pengajuan Sengketa Informasi Publik'])
</div>
@endsection
