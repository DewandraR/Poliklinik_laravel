@extends('layouts.dokter')

@section('title', 'Daftar Periksa Pasien')

@section('content')
<div class="container mx-auto">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Periksa Pasien</h1>
                <p class="text-sm text-gray-600 mt-1">Daftar pasien yang perlu diperiksa hari ini</p>
            </div>
            <div>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full border border-blue-400">
                    {{ $currentDate->format('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Menunggu -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 bg-opacity-75">
                    <svg class="h-8 w-8 text-yellow-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Menunggu</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ $totalMenungguHariIni }}</p>
                    <p class="text-xs text-gray-500">Total: {{ $totalMenunggu }}</p>
                </div>
            </div>
        </div>

        <!-- Sedang Diperiksa -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 bg-opacity-75">
                    <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Sedang Diperiksa</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ $totalDiperiksaHariIni }}</p>
                    <p class="text-xs text-gray-500">Total: {{ $totalDiperiksa }}</p>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 bg-opacity-75">
                    <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Selesai</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ $totalSelesaiHariIni }}</p>
                    <p class="text-xs text-gray-500">Total: {{ $totalSelesai }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
        <form action="{{ route('dokter.daftar-periksa') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama pasien atau no.RM..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <select name="status" 
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diperiksa" {{ request('status') == 'diperiksa' ? 'selected' : '' }}>Sedang Diperiksa</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Pasien -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No. Antrian</th>
                        <th scope="col" class="px-6 py-3">Pasien</th>
                        <th scope="col" class="px-6 py-3">No. RM</th>
                        <th scope="col" class="px-6 py-3">Keluhan</th>
                        <th scope="col" class="px-6 py-3">Waktu Daftar</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPasien as $pasien)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $pasien->no_antrian }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $pasien->pasien->nama }}</div>
                            <div class="text-sm text-gray-500">{{ $pasien->pasien->no_hp }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $pasien->pasien->no_rm }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900 max-w-[200px] truncate">{{ $pasien->keluhan }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($pasien->created_at)->format('H:i') }}</div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pasien->created_at)->format('d/m/Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('dokter.periksa.update-status-periksa', $pasien->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" 
                                        onchange="this.form.submit()"
                                        class="text-xs font-medium px-2.5 py-1 rounded-full border
                                        {{ $pasien->status === 'menunggu' ? 'bg-yellow-100 text-yellow-800 border-yellow-400' : 
                                           ($pasien->status === 'diperiksa' ? 'bg-blue-100 text-blue-800 border-blue-400' : 
                                            'bg-green-100 text-green-800 border-green-400') }}">
                                    <option value="menunggu" {{ $pasien->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diperiksa" {{ $pasien->status === 'diperiksa' ? 'selected' : '' }}>Sedang Diperiksa</option>
                                    <option value="selesai" {{ $pasien->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($pasien->status === 'menunggu')
                                <a href="{{ route('dokter.form-periksa', $pasien->id) }}" 
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Mulai Periksa
                                </a>
                            @elseif($pasien->status === 'diperiksa')
                                <a href="{{ route('dokter.form-periksa', $pasien->id) }}" 
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Lanjutkan
                                </a>
                            @else
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('dokter.detail-periksa', $pasien->id) }}" 
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('dokter.form-periksa', $pasien->id) }}" 
                                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5">
                                        Edit Periksa
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pasien yang perlu diperiksa hari ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($daftarPasien->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        @if($daftarPasien->currentPage() > 1)
                            <a href="{{ $daftarPasien->previousPageUrl() }}" 
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 mr-2">
                                Sebelumnya
                            </a>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600">
                        Halaman {{ $daftarPasien->currentPage() }} dari {{ $daftarPasien->lastPage() }}
                    </div>
                    <div>
                        @if($daftarPasien->hasMorePages())
                            <a href="{{ $daftarPasien->nextPageUrl() }}" 
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 ml-2">
                                Selanjutnya
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
    </div>
</div>
@endsection
