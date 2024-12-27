@extends('layouts.dokter')

@section('title', 'Detail Riwayat Pemeriksaan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-200">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Riwayat Pemeriksaan</h1>
                <p class="mt-1 text-sm text-gray-600">Daftar riwayat pemeriksaan pasien</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 text-sm">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                    No. RM: {{ $pasien->no_rm }}
                </span>
            </div>
        </div>
    </div>

    <!-- Data Pasien -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Data Pasien</h2>
        </div>
        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-600">Nama Pasien</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $pasien->nama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-600">No. KTP</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $pasien->no_ktp }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-600">Nomor HP</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $pasien->no_hp }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-600">Alamat</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $pasien->alamat }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-200">
        <form action="{{ route('dokter.detail-riwayat-periksa', $periksa->id) }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="date" 
                       name="tanggal" 
                       value="{{ request('tanggal') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="flex-1 min-w-[200px]">
                <select name="bulan" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Pilih Bulan</option>
                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                        <option value="{{ $index + 1 }}" {{ request('bulan') == $index + 1 ? 'selected' : '' }}>
                            {{ $bulan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <select name="tahun" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Pilih Tahun</option>
                    @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Cari
                </button>
                @if(request()->hasAny(['tanggal', 'bulan', 'tahun']))
                    <a href="{{ route('dokter.detail-riwayat-periksa', $periksa->id) }}" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Riwayat Pemeriksaan -->
    @forelse($riwayatPeriksa->sortByDesc('tgl_periksa') as $periksa)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                Pemeriksaan Tanggal: {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d F Y') }}
            </h2>
        </div>
        <div class="p-6">
            <dl class="grid grid-cols-1 gap-y-4 mb-6">
                <div>
                    <dt class="text-sm font-medium text-gray-600">Keluhan</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $periksa->daftarpoli->keluhan }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-600">Catatan Pemeriksaan</dt>
                    <dd class="mt-1 text-base text-gray-900">{{ $periksa->catatan }}</dd>
                </div>
            </dl>

            <!-- Obat yang Diberikan -->
            <div class="border rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Nama Obat</th>
                            <th class="px-6 py-3">Kemasan</th>
                            <th class="px-6 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalObat = 0; @endphp
                        @forelse ($periksa->detail_periksa as $detail)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $detail->obat->nama_obat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $detail->obat->kemasan }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @php $totalObat += $detail->obat->harga; @endphp
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada obat yang diberikan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50 font-medium text-gray-900">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right">Total Biaya Obat:</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($totalObat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right">Biaya Jasa:</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($periksa->biaya_periksa - $totalObat, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-t-2 border-gray-200">
                            <td colspan="2" class="px-6 py-4 text-right">Total Biaya:</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm p-6 text-center border border-gray-200">
        <p class="text-gray-500">Tidak ada riwayat pemeriksaan untuk periode ini</p>
    </div>
    @endforelse

    <!-- Button Kembali -->
    <div class="flex justify-end">
        <a href="{{ route('dokter.riwayat-periksa') }}"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
            Kembali
        </a>
    </div>
</div>
@endsection