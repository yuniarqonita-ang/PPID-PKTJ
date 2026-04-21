@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-users mr-2"></i> User Management
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola akun administrator dan operator panel PPID PKTJ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-[#ffc107] text-[#004a99] font-bold rounded-xl shadow-lg hover:bg-yellow-400 transform hover:scale-[1.02] transition-all flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Tambah User Baru
                </a>
            </div>
        </div>

        <!-- ALERTS -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                <p class="text-red-800 font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#004a99]">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#004a99] text-white">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center w-16">#</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Informasi User</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Role / Hak Akses</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Terdaftar Pada</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $index => $user)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-gray-400 text-center">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-[#004a99] flex items-center justify-center font-black text-lg border-2 border-white shadow-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-[#004a99] group-hover:text-blue-700 transition-colors">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-red-100 text-red-600 border border-red-200">
                                            <i class="fas fa-shield-alt mr-1"></i> ADMIN
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-blue-100 text-[#004a99] border border-blue-200">
                                            <i class="fas fa-user-edit mr-1"></i> OPERATOR
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                    {{ $user->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-2 w-10 h-10 rounded-lg bg-blue-50 text-[#004a99] hover:bg-[#004a99] hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Akun yang dihapus tidak bisa dikembalikan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 w-10 h-10 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Hapus Akun">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 font-medium italic bg-gray-50">
                                    <i class="fas fa-user-slash text-4xl mb-3 block opacity-20"></i>
                                    Belum ada data user terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
