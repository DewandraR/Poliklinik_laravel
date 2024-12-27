@extends('layouts.pasien')
@section('title', 'Dashboard')
@section('content')
<div class="min-h-[calc(100vh-9rem)] p-2 sm:p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center mb-4">
                <i class="fas fa-user-circle text-3xl sm:text-4xl text-blue-500 mr-3"></i>
                <h2 class="text-lg sm:text-xl font-bold text-blue-800">Profil Pasien</h2>
            </div>
            <div class="space-y-2 text-sm sm:text-base text-gray-600">
                <p class="flex justify-between"><span class="font-semibold">Nama:</span> {{ $pasien->nama }}</p>
                <p class="flex justify-between"><span class="font-semibold">No. RM:</span> {{ $pasien->no_rm }}</p>
                <p class="flex flex-col sm:flex-row sm:justify-between"><span class="font-semibold">Alamat:</span> <span class="sm:text-right sm:w-2/3">{{ $pasien->alamat }}</span></p>
            </div>
        </div>

        <!-- Recent History -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 space-y-2 sm:space-y-0">
                <h2 class="text-lg sm:text-xl font-bold text-blue-800">Riwayat Kunjungan</h2>
                <a href="{{ route('pasien.riwayat') }}" class="text-sm sm:text-base text-blue-500 hover:text-blue-700">
                    <i class="fas fa-external-link-alt"></i> Lihat Semua
                </a>
            </div>
            <div class="overflow-x-auto" style="max-height: calc(100vh - 20rem)">
                <table class="min-w-full whitespace-nowrap">
                    <thead class="bg-blue-500 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-3 text-left text-xs sm:text-sm">Tanggal</th>
                            <th class="py-2 px-3 text-left text-xs sm:text-sm">Poli</th>
                            <th class="py-2 px-3 text-left text-xs sm:text-sm hidden sm:table-cell">Dokter</th>
                            <th class="py-2 px-3 text-left text-xs sm:text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-xs sm:text-sm">
                        @forelse($riwayatDaftar as $daftar)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3">{{ $daftar->created_at->format('d/m/Y') }}</td>
                            <td class="py-2 px-3">{{ $daftar->jadwalPeriksa?->dokter?->poli?->nama_poli ?? '-' }}</td>
                            <td class="py-2 px-3 hidden sm:table-cell">{{ $daftar->jadwalPeriksa?->dokter?->nama ?? '-' }}</td>
                            <td class="py-2 px-3">
                                <span class="inline-flex px-2 py-1 text-xs rounded-full {{ $daftar->getStatusColorClass() }}">
                                    {{ $daftar->getStatusLabel() }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada riwayat kunjungan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($riwayatDaftar->hasPages())
            <div class="mt-4 px-2 sm:px-4 py-2 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
                    <div class="flex space-x-2 text-sm">
                        @if($riwayatDaftar->onFirstPage())
                            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Sebelumnya</span>
                        @else
                            <a href="{{ $riwayatDaftar->previousPageUrl() }}" class="px-3 py-1 text-blue-500 bg-blue-50 rounded-md hover:bg-blue-100">Sebelumnya</a>
                        @endif
                        @if($riwayatDaftar->hasMorePages())
                            <a href="{{ $riwayatDaftar->nextPageUrl() }}" class="px-3 py-1 text-blue-500 bg-blue-50 rounded-md hover:bg-blue-100">Selanjutnya</a>
                        @else
                            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Selanjutnya</span>
                        @endif
                    </div>
                    <div class="text-xs sm:text-sm text-gray-600">
                        Halaman {{ $riwayatDaftar->currentPage() }} dari {{ $riwayatDaftar->lastPage() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection