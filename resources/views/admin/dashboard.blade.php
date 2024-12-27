@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total Dokter Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h2 class="text-gray-600 text-sm font-medium">Total Dokter</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-gray-800">{{ $totalDokter }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-blue-50 px-6 py-3">
            <a href="{{ route('admin.dokter') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                Lihat Detail
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Total Pasien Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h2 class="text-gray-600 text-sm font-medium">Total Pasien</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPasien }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-green-50 px-6 py-3">
            <a href="{{ route('admin.pasien') }}" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                Lihat Detail
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Total Poli Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h2 class="text-gray-600 text-sm font-medium">Total Poli</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPoli }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-yellow-50 px-6 py-3">
            <a href="{{ route('admin.poli') }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium flex items-center">
                Lihat Detail
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Total Obat Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h2 class="text-gray-600 text-sm font-medium">Total Obat</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-gray-800">{{ $totalObat }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-purple-50 px-6 py-3">
            <a href="{{ route('admin.obat') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                Lihat Detail
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.dokter') }}" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium text-blue-600">Tambah Dokter</span>
                </div>
            </a>

            <a href="{{ route('admin.pasien') }}" class="p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium text-green-600">Tambah Pasien</span>
                </div>
            </a>

            <a href="{{ route('admin.poli') }}" class="p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium text-yellow-600">Tambah Poli</span>
                </div>
            </a>

            <a href="{{ route('admin.obat') }}" class="p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium text-purple-600">Tambah Obat</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <!-- Recent Activity yang sudah dimodifikasi -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                    <div class="p-2 rounded-full
                        {{ $activity->type === 'dokter' ? 'bg-blue-100' : '' }}
                        {{ $activity->type === 'pasien' ? 'bg-green-100' : '' }}
                        {{ $activity->type === 'poli' ? 'bg-yellow-100' : '' }}
                        {{ $activity->type === 'obat' ? 'bg-purple-100' : '' }}">
                        <svg class="w-4 h-4 
                            {{ $activity->type === 'dokter' ? 'text-blue-500' : '' }}
                            {{ $activity->type === 'pasien' ? 'text-green-500' : '' }}
                            {{ $activity->type === 'poli' ? 'text-yellow-500' : '' }}
                            {{ $activity->type === 'obat' ? 'text-purple-500' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ $activity->description }}</p>
                        <p class="text-xs text-gray-500">{{ $activity->time_ago }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">
                    Belum ada aktivitas terbaru
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection