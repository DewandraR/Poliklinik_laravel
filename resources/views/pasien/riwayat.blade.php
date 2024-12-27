@extends('layouts.pasien')
@section('title', 'Riwayat Pemeriksaan')
@section('content')
<div class="min-h-[calc(100vh-9rem)] p-2 sm:p-4">
    <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-500 h-full p-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 space-y-2 sm:space-y-0">
            <div class="flex items-center">
                <i class="fas fa-history text-2xl sm:text-3xl text-blue-500 mr-3"></i>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-800">Riwayat Pemeriksaan</h2>
            </div>
            <form action="{{ route('pasien.riwayat') }}" method="GET" class="w-full sm:w-auto">
                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="flex gap-2">
                        <select name="bulan" class="w-32 p-2 text-sm border border-gray-300 rounded-lg">
                            <option value="">Pilih Bulan</option>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                                <option value="{{ $index + 1 }}" {{ request('bulan') == $index + 1 ? 'selected' : '' }}>{{ $bulan }}</option>
                            @endforeach
                        </select>
                        <select name="tahun" class="w-28 p-2 text-sm border border-gray-300 rounded-lg">
                            <option value="">Pilih Tahun</option>
                            @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg flex-shrink-0 hover:bg-blue-600 transition-colors">
                            <i class="fas fa-search mr-1"></i>
                            <span>Cari</span>
                        </button>
                        @if(request()->has('bulan') || request()->has('tahun'))
                            <a href="{{ route('pasien.riwayat') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg flex-shrink-0 hover:bg-gray-600 transition-colors text-center">
                                <i class="fas fa-times mr-1"></i>
                                <span>Reset</span>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto -mx-4 sm:mx-0" style="max-height: calc(100vh - 20rem)">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500">
                    <tr>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white">Tanggal</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white hidden sm:table-cell">Poli</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white hidden sm:table-cell">Dokter</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white">No. Antrian</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white hidden sm:table-cell">Biaya</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white">Status</th>
                        <th class="p-2 sm:p-3 text-left text-xs sm:text-sm font-medium text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($riwayat as $r)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 sm:p-3 text-xs sm:text-sm text-gray-700">{{ $r->created_at->format('d/m/Y') }}</td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm text-gray-700 hidden sm:table-cell">{{ $r->jadwalPeriksa?->dokter?->poli?->nama_poli ?? '-' }}</td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm text-gray-700 hidden sm:table-cell">{{ $r->jadwalPeriksa?->dokter?->nama ?? '-' }}</td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm text-gray-700">{{ $r->no_antrian }}</td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm text-gray-700 hidden sm:table-cell">{{ $r->periksa ? 'Rp '.number_format($r->periksa->biaya_periksa, 0, ',', '.') : '-' }}</td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm">
                            <span class="inline-flex px-2 py-1 text-xs rounded-full {{ $r->getStatusColorClass() }}">
                                {{ $r->getStatusLabel() }}
                            </span>
                        </td>
                        <td class="p-2 sm:p-3 text-xs sm:text-sm">
                            <a href="{{ route('pasien.detail-pemeriksaan', $r->id) }}" 
                               class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-sm text-gray-500">Belum ada riwayat pemeriksaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayat->hasPages())
        <div class="mt-4 border-t border-gray-200 pt-4">
            {{ $riwayat->links() }}
        </div>
        @endif
    </div>
</div>
@endsection