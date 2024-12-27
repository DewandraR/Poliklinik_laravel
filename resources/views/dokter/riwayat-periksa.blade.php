@extends('layouts.dokter')

@section('title', 'Data Pasien')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800">Data Pasien</h1>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Pasien</th>
                        <th class="px-6 py-3">Alamat</th>
                        <th class="px-6 py-3">No. KTP</th>
                        <th class="px-6 py-3">No. Telepon</th>
                        <th class="px-6 py-3">No. RM</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($uniquePatients as $index => $patient)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $patient->nama }}</td>
                        <td class="px-6 py-4">{{ $patient->alamat }}</td>
                        <td class="px-6 py-4">{{ $patient->no_ktp }}</td>
                        <td class="px-6 py-4">{{ $patient->no_hp }}</td>
                        <td class="px-6 py-4">{{ $patient->no_rm }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('dokter.detail-riwayat-periksa', $patient->latest_periksa->first()->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-cyan-500 text-white rounded-lg hover:bg-cyan-600">
                                Detail Riwayat Periksa
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data riwayat pasien
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($uniquePatients->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $uniquePatients->links() }}
        </div>
        @endif
    </div>
</div>
@endsection