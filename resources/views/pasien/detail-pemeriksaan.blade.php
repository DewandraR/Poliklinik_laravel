@extends('layouts.pasien')
@section('title', 'Detail Pemeriksaan')
@section('content')
<div class="min-h-[calc(100vh-9rem)] p-2 sm:p-4">
    <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-500 h-full p-4">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <i class="fas fa-file-medical text-2xl sm:text-3xl text-blue-500 mr-3"></i>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-800">Detail Pemeriksaan</h2>
            </div>
            <a href="{{ route('pasien.riwayat') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali
            </a>
        </div>

        <!-- Status Badge -->
        <div class="mb-6">
            <span class="inline-flex px-3 py-1 text-sm rounded-full {{ $daftarPoli->getStatusColorClass() }}">
                {{ $daftarPoli->getStatusLabel() }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Kunjungan -->
            <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-3">Informasi Kunjungan</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Tanggal:</span> {{ $daftarPoli->created_at->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Poli:</span> {{ $daftarPoli->jadwalPeriksa->dokter->poli->nama_poli }}</p>
                    <p><span class="font-medium">Dokter:</span> {{ $daftarPoli->jadwalPeriksa->dokter->nama }}</p>
                    <p><span class="font-medium">No. Antrian:</span> {{ $daftarPoli->no_antrian }}</p>
                    <p><span class="font-medium">Jadwal:</span> {{ $daftarPoli->jadwalPeriksa->hari }}, {{ substr($daftarPoli->jadwalPeriksa->jam_mulai, 0, 5) }} - {{ substr($daftarPoli->jadwalPeriksa->jam_selesai, 0, 5) }}</p>
                    <p><span class="font-medium">Keluhan:</span> {{ $daftarPoli->keluhan }}</p>
                </div>
            </div>

            <!-- Hasil Pemeriksaan -->
            <div class="{{ $daftarPoli->periksa ? 'bg-green-50' : 'bg-gray-50' }} p-4 rounded-lg">
                <h3 class="text-lg font-semibold {{ $daftarPoli->periksa ? 'text-green-800' : 'text-gray-800' }} mb-3">
                    Hasil Pemeriksaan
                </h3>
                @if($daftarPoli->periksa)
                    <div class="space-y-2">
                        <p><span class="font-medium">Tanggal Periksa:</span> {{ \Carbon\Carbon::parse($daftarPoli->periksa->tgl_periksa)->format('d/m/Y') }}</p>
                        <p><span class="font-medium">Catatan:</span> {{ $daftarPoli->periksa->catatan }}</p>
                        <p><span class="font-medium">Biaya Pemeriksaan:</span> Rp {{ number_format($daftarPoli->periksa->biaya_periksa, 0, ',', '.') }}</p>
                    </div>
                @else
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            Menunggu pemeriksaan dari dokter
                        </p>
                        @if($daftarPoli->status === 'menunggu')
                            <p class="text-sm text-gray-500 mt-2">
                                Silakan menunggu nomor antrian Anda dipanggil
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Obat yang Diberikan -->
            <div class="{{ $daftarPoli->periksa ? 'bg-purple-50' : 'bg-gray-50' }} p-4 rounded-lg md:col-span-2">
                <h3 class="text-lg font-semibold {{ $daftarPoli->periksa ? 'text-purple-800' : 'text-gray-800' }} mb-3">
                    Obat yang Diberikan
                </h3>
                @if($daftarPoli->periksa && !$daftarPoli->periksa->detail_periksa->isEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($daftarPoli->periksa->detail_periksa as $detail)
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <p class="font-medium text-purple-700">{{ $detail->obat->nama_obat }}</p>
                            <p class="text-sm text-gray-600">{{ $detail->obat->kemasan }}</p>
                            <p class="text-sm text-gray-600">Harga: Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-gray-600">
                            <i class="fas fa-prescription-bottle-alt mr-2"></i>
                            Belum ada obat yang diberikan
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection