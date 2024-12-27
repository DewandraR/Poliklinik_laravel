@extends('layouts.dokter')

@section('title', 'Form Pemeriksaan Pasien')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-200">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Form Pemeriksaan Pasien</h1>
                <p class="mt-1 text-sm text-gray-600">Lengkapi data pemeriksaan untuk pasien</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 text-sm">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                    No. RM: {{ $daftarPoli->pasien->no_rm }}
                </span>
                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                    {{ $daftarPoli->created_at->format('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('dokter.periksa.simpan', $daftarPoli->id) }}" method="POST" class="space-y-6" id="formPeriksa">
        @csrf
        
        <!-- Informasi Pasien -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Informasi Pasien</h2>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-600">Nama Pasien</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $daftarPoli->pasien->nama }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-600">Nomor HP</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $daftarPoli->pasien->no_hp }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-600">Keluhan</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $daftarPoli->keluhan }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Catatan Pemeriksaan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Catatan Pemeriksaan</h2>
            </div>
            <div class="p-6">
                <textarea name="catatan" rows="4" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan hasil pemeriksaan...">{{ old('catatan', $daftarPoli->periksa->catatan ?? '') }}</textarea>
            </div>
        </div>

        <!-- Resep Obat -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Resep Obat</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Search Bar -->
                <div class="mb-4">
                    <input type="text" 
                           id="searchObat" 
                           placeholder="Cari obat..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pilih</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Obat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kemasan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="obatTableBody">
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-3 flex items-center justify-between border-t border-gray-200 bg-gray-50">
                        <button type="button" id="prevPage" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 disabled:opacity-50">
                            Sebelumnya
                        </button>
                        <span id="pageInfo" class="text-sm text-gray-700"></span>
                        <button type="button" id="nextPage" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 disabled:opacity-50">
                            Selanjutnya
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biaya Pemeriksaan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Biaya Pemeriksaan</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biaya Jasa</label>
                        <input type="number" name="biaya_jasa" id="biaya_jasa" readonly
                            class="w-full rounded-lg bg-gray-50 border-gray-300"
                            value="150000">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Biaya Obat</label>
                        <input type="number" name="total_biaya_obat" id="total_biaya_obat" readonly
                            class="w-full rounded-lg bg-gray-50 border-gray-300"
                            value="0">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Biaya Pemeriksaan</label>
                        <input type="number" name="total_biaya" id="total_biaya" readonly
                            class="w-full rounded-lg bg-gray-50 border-gray-300 text-lg font-semibold text-blue-600"
                            value="150000">
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('dokter.daftar-periksa') }}"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-100">
                Kembali
            </a>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200">
                Simpan Pemeriksaan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
const obatList = {!! json_encode($obatList) !!};
const selectedObatIds = {!! json_encode(collect($selectedObat)->pluck('id')) !!};

let currentPage = 1;
const itemsPerPage = 5;
let filteredObat = [];

function filterObat(searchTerm) {
    return obatList.filter(obat => 
        obat.nama_obat.toLowerCase().includes(searchTerm.toLowerCase()) ||
        obat.kemasan.toLowerCase().includes(searchTerm.toLowerCase())
    );
}

function renderTable() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = filteredObat.slice(startIndex, endIndex);
    
    const tbody = document.getElementById('obatTableBody');
    tbody.innerHTML = pageData.map(obat => `
        <tr>
            <td class="px-6 py-4">
                <input type="checkbox" 
                       name="obat_ids[]" 
                       value="${obat.id}"
                       class="obat-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       data-harga="${obat.harga}"
                       ${selectedObatIds.includes(obat.id) ? 'checked' : ''}>
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">${obat.nama_obat}</td>
            <td class="px-6 py-4 text-sm text-gray-600">${obat.kemasan}</td>
            <td class="px-6 py-4 text-sm text-gray-900 text-right">Rp ${obat.harga.toLocaleString('id-ID')}</td>
        </tr>
    `).join('');

    // Update pagination
    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = endIndex >= filteredObat.length;
    document.getElementById('pageInfo').textContent = `Halaman ${currentPage} dari ${Math.ceil(filteredObat.length / itemsPerPage)}`;
    
    // Reattach event listeners
    document.querySelectorAll('.obat-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', hitungTotal);
    });
}

function hitungTotal() {
    let totalObat = 0;
    document.querySelectorAll('.obat-checkbox:checked').forEach(function(checkbox) {
        totalObat += parseInt(checkbox.dataset.harga);
    });

    const biayaJasa = 150000; // Fixed consultation fee
    const totalBiaya = totalObat + biayaJasa;

    document.getElementById('total_biaya_obat').value = totalObat;
    document.getElementById('total_biaya').value = totalBiaya;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    filteredObat = [...obatList];
    renderTable();
    hitungTotal();

    document.getElementById('searchObat').addEventListener('input', function(e) {
        currentPage = 1;
        filteredObat = filterObat(e.target.value);
        renderTable();
    });

    document.getElementById('prevPage').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    document.getElementById('nextPage').addEventListener('click', function() {
        if ((currentPage * itemsPerPage) < filteredObat.length) {
            currentPage++;
            renderTable();
        }
    });
});
</script>
@endpush

@endsection