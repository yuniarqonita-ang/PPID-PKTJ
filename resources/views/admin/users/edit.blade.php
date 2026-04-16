@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-3xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar User
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-user-edit mr-2"></i> Edit Akun User
                </h1>
                <p class="text-gray-500 font-medium font-medium mt-1">Sesuaikan informasi akun untuk <strong>{{ $user->name }}</strong></p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 md:p-10">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    
                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#004a99]">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm">
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                            Email Instansi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#004a99]">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm">
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                            Hak Akses (Role) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#004a99]">
                                <i class="fas fa-user-shield text-gray-400"></i>
                            </div>
                            <select name="role" id="role" required
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 appearance-none focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm">
                                <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>OPERATOR (Kelola Konten)</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ADMINISTRATOR (Full Akses)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('role') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password Group (OPTIONAL IN EDIT) -->
                    <div class="pt-6 border-t border-gray-100">
                        <div class="bg-blue-50 border-l-4 border-[#004a99] p-4 rounded-r-xl mb-6">
                            <div class="flex">
                                <i class="fas fa-info-circle text-[#004a99] mt-1 mr-3"></i>
                                <p class="text-sm text-blue-800 font-medium">
                                    Kosongkan kolom password di bawah jika Anda tidak ingin mengubah password akun ini.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                    Password Baru (Opsional)
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#004a99]">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password" id="password" minlength="8"
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                        placeholder="Masukkan password baru">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                    Konfirmasi Password Baru
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-[#004a99]">
                                        <i class="fas fa-check-double text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                        placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                </div>

                <!-- FORM ACTIONS -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="window.location='{{ route('admin.users.index') }}'" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#004a99] to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan Akun
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
