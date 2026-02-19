@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600">Selamat datang kembali di Panel Admin PPID PKTJ.</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
            <i class="fas fa-newspaper text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Berita</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Berita::count() }}</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
            <i class="fas fa-file-pdf text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Dokumen Publik</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Dokumen::count() }}</p>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 flex items-center">
        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
            <i class="fas fa-users text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Permohonan Info</p>
            <p class="text-2xl font-bold text-gray-800">0</p> <!-- Nanti diganti real data -->
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 flex items-center">
        <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Pengajuan Keberatan</p>
            <p class="text-2xl font-bold text-gray-800">0</p>
        </div>
    </div>
</div>

@endsection