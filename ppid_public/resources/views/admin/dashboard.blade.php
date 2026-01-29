@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard Admin PPID') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total Berita</div>
                    <div class="text-3xl font-bold">{{ $totalBerita }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total Dokumen</div>
                    <div class="text-3xl font-bold">{{ $totalDokumen }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total SOP</div>
                    <div class="text-3xl font-bold">{{ $totalProsedur }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total FAQ</div>
                    <div class="text-3xl font-bold">{{ $totalFaq }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang, Admin! Anda berhasil masuk ke sistem PPID PKTJ.") }}
                </div>
            </div>
        </div>
    </div>
@endsection