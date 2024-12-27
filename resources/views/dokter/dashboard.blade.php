@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="py-6">
    <!-- DateTime Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Dokter</h1>
                <p class="text-sm text-gray-600 mt-1">Ringkasan aktivitas dan jadwal hari ini</p>
            </div>
            <div>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-blue-400">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>
    <!-- Top Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Today's Patients -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 bg-opacity-75">
                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Pasien Hari Ini</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalMenungguHariIni + $totalDiperiksaHariIni + $totalSelesaiHariIni }}</p>
                <p class="text-sm text-gray-500">Total: {{ $totalMenunggu + $totalDiperiksa + $totalSelesai }}</p>
            </div>
        </div>

        <!-- Waiting Patients -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 bg-opacity-75">
                <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Menunggu</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalMenungguHariIni }}</p>
                <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">{{ $totalMenunggu }} total</span>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 bg-opacity-75">
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Sedang Diperiksa</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalDiperiksaHariIni }}</p>
                <span class="text-xs px-2 py-1 rounded-full bg-indigo-100 text-indigo-800">{{ $totalDiperiksa }} total</span>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 flex items-center">
            <div class="p-3 rounded-full bg-green-100 bg-opacity-75">
                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Selesai</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalSelesaiHariIni }}</p>
                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">{{ $totalSelesai }} total</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Next Patient Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Pasien Berikutnya</h2>
            </div>
            <div class="p-6">
                @if($nextPatient = $daftarPasien->where('status', 'menunggu')->first())
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <span class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                {{ strtoupper(substr($nextPatient->pasien->nama, 0, 1)) }}
                            </span>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $nextPatient->pasien->nama }}</p>
                                <p class="text-sm text-gray-500">No. RM: {{ $nextPatient->pasien->no_rm }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu sejak {{ $nextPatient->created_at->format('H:i') }}
                        </div>
                        <a href="{{ route('dokter.periksa.mulai', $nextPatient->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Mulai Periksa
                            <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500">Tidak ada pasien yang menunggu</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Schedule Today -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h2>
            </div>
            <div class="p-6">
            @if($jadwalHariIni)
                <div class="space-y-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ substr($jadwalHariIni->jam_mulai, 0, 5) }} - {{ substr($jadwalHariIni->jam_selesai, 0, 5) }}
                    </div>
                    <div class="flex justify-center">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                            Aktif
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-gray-500">Tidak ada jadwal hari ini</p>
                </div>
            @endif
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Menu Cepat</h2>
            </div>
            <div class="p-6 space-y-4">
                <a href="{{ route('dokter.jadwal') }}" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="ml-3 text-gray-700">Kelola Jadwal</span>
                    </div>
                </a>
                <a href="{{ route('dokter.riwayat-periksa') }}" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-3 text-gray-700">Riwayat Pemeriksaan</span>
                    </div>
                </a>
                <a href="{{ route('dokter.daftar-periksa') }}" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="ml-3 text-gray-700">Daftar Periksa</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection