@extends('layouts.pasien')
@section('title', 'Daftar Poli')
@section('content')
<div class="min-h-[calc(100vh-9rem)] p-2 sm:p-4 flex items-center justify-center">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg border-t-4 border-blue-500 p-4 sm:p-6">
        <div class="flex items-center mb-4 sm:mb-6">
            <i class="fas fa-clipboard-list text-2xl sm:text-3xl text-blue-500 mr-3"></i>
            <h2 class="text-xl sm:text-2xl font-bold text-blue-800">Pendaftaran Poli</h2>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('pasien.store-pendaftaran') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @csrf
            <div class="sm:col-span-1">
                <label class="text-sm font-medium text-gray-600">Pilih Poli</label>
                <select name="id_poli" required class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Poli</option>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-1">
                <label class="text-sm font-medium text-gray-600">Pilih Dokter</label>
                <select name="id_dokter" required disabled class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md">
                    <option value="">Pilih Dokter</option>
                </select>
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label class="text-sm font-medium text-gray-600">Pilih Jadwal</label>
                <select name="id_jadwal" required disabled class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md">
                    <option value="">Pilih Jadwal</option>
                </select>
                <p class="text-sm text-gray-500 mt-1 hidden" id="no-schedule-message">
                    Tidak ada jadwal aktif untuk dokter ini
                </p>
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label class="text-sm font-medium text-gray-600">Keluhan</label>
                <textarea name="keluhan" rows="3" required class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md"></textarea>
            </div>

            <div class="col-span-1 sm:col-span-2 text-center">
                <button type="submit" class="w-full sm:w-auto bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm sm:text-base">
                    <i class="fas fa-paper-plane mr-2"></i>Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const poliSelect = document.querySelector('select[name="id_poli"]');
    const dokterSelect = document.querySelector('select[name="id_dokter"]');
    const jadwalSelect = document.querySelector('select[name="id_jadwal"]');
    const noScheduleMessage = document.getElementById('no-schedule-message');

    poliSelect.addEventListener('change', async function() {
        dokterSelect.disabled = true;
        jadwalSelect.disabled = true;
        dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
        jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
        noScheduleMessage.classList.add('hidden');

        if (this.value) {
            const response = await fetch(`/pasien/get-dokter/${this.value}`);
            const dokters = await response.json();
            
            dokters.forEach(dokter => {
                const option = new Option(dokter.nama, dokter.id);
                dokterSelect.add(option);
            });
            
            dokterSelect.disabled = false;
        }
    });

    dokterSelect.addEventListener('change', async function() {
        jadwalSelect.disabled = true;
        jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
        noScheduleMessage.classList.add('hidden');

        if (this.value) {
            const response = await fetch(`/pasien/get-jadwal/${this.value}`);
            const jadwals = await response.json();
            
            if (jadwals.length === 0) {
                noScheduleMessage.classList.remove('hidden');
                return;
            }

            jadwals.forEach(jadwal => {
                const waktu = `${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}`;
                const option = new Option(waktu, jadwal.id);
                jadwalSelect.add(option);
            });
            
            jadwalSelect.disabled = false;
        }
    });
});
</script>
@endsection