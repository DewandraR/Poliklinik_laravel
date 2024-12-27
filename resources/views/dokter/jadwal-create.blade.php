@extends('layouts.dokter')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-end items-center mb-6">
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

    <form action="{{ route('dokter.jadwal.store') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        <div class="mb-4">
            <label for="hari" class="block text-gray-700 font-semibold mb-2">Hari</label>
            <select name="hari" id="hari" class="w-full border-gray-300 rounded-lg" required>
                <option value="" selected disabled>Pilih Hari</option>
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="jam_mulai" class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
            <input type="time" 
                   name="jam_mulai" 
                   id="jam_mulai" 
                   class="w-full border-gray-300 rounded-lg" 
                   value="{{ old('jam_mulai') }}"
                   required>
        </div>
        <div class="mb-4">
            <label for="jam_selesai" class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
            <input type="time" 
                   name="jam_selesai" 
                   id="jam_selesai" 
                   class="w-full border-gray-300 rounded-lg" 
                   value="{{ old('jam_selesai') }}"
                   required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection