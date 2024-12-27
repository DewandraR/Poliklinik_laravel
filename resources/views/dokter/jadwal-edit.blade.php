@extends('layouts.dokter')

@section('title', 'Edit Jadwal')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Jadwal</h1>
        <a href="{{ route('dokter.jadwal') }}" class="text-blue-500 hover:underline">Kembali ke Kelola Jadwal</a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.jadwal.update', $jadwal->id) }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Hari</label>
            <div class="p-2 bg-gray-100 rounded-lg">{{ $jadwal->hari }}</div>
            <input type="hidden" name="hari" value="{{ $jadwal->hari }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
            <div class="p-2 bg-gray-100 rounded-lg">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</div>
            <input type="hidden" name="jam_mulai" value="{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
            <div class="p-2 bg-gray-100 rounded-lg">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</div>
            <input type="hidden" name="jam_selesai" value="{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Status Jadwal</label>
            <div class="flex items-center gap-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="aktif" 
                           {{ $jadwal->status === 'aktif' ? 'checked' : '' }}
                           class="form-radio text-blue-600">
                    <span class="ml-2">Aktif</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="status" value="tidak aktif"
                           {{ $jadwal->status === 'tidak aktif' ? 'checked' : '' }}
                           class="form-radio text-blue-600">
                    <span class="ml-2">Tidak Aktif</span>
                </label>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                Catatan: Mengaktifkan jadwal ini akan menonaktifkan jadwal lainnya secara otomatis
            </p>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Perbarui Status
        </button>
    </form>
</div>
@endsection