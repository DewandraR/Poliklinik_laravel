@extends('layouts.dokter')

@section('title', 'Detail Pemeriksaan')

@section('content')
<div class="container mx-auto py-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pemeriksaan</h1>
                <p class="text-sm text-gray-600 mt-1">Rincian pemeriksaan pasien</p>
            </div>
            <a href="{{ route('dokter.daftar-periksa') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Patient Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Basic Info -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pasien</h2>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-500">Nama Pasien</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->pasien->nama }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Nomor RM</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->pasien->no_rm }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">No. HP</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->pasien->no_hp }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Alamat</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->pasien->alamat }}</p>
                </div>
            </div>
        </div>

        <!-- Examination Details -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Kunjungan</h2>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-500">Tanggal Periksa</label>
                    <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($daftarPoli->periksa->tgl_periksa)->format('d F Y') }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Keluhan</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->keluhan }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Catatan Dokter</label>
                    <p class="font-medium text-gray-900">{{ $daftarPoli->periksa->catatan }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Biaya</h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Biaya Pemeriksaan</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($daftarPoli->periksa->biaya_periksa, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Prescribed Medicines -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Obat yang Diresepkan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Obat</th>
                        <th class="px-6 py-3">Kemasan</th>
                        <th class="px-6 py-3 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarPoli->periksa->detail_periksa as $index => $detail)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $detail->obat->nama_obat }}</td>
                        <td class="px-6 py-4">{{ $detail->obat->kemasan }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada obat yang diresepkan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($daftarPoli->periksa->detail_periksa->count() > 0)
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 font-semibold text-gray-900 text-right">Total Biaya Obat</td>
                        <td class="px-6 py-4 font-semibold text-gray-900 text-right">
                            Rp {{ number_format($daftarPoli->periksa->detail_periksa->sum('obat.harga'), 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection