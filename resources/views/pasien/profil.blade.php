@extends('layouts.pasien')
@section('title', 'Profil')
@section('content')
<div class="min-h-[calc(100vh-9rem)] p-2 sm:p-4 flex items-center justify-center">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg border-t-4 border-blue-500 p-4 sm:p-6">
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm sm:text-base">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="flex items-center mb-4 sm:mb-6">
            <i class="fas fa-user-edit text-2xl sm:text-3xl text-blue-500 mr-3"></i>
            <h2 class="text-xl sm:text-2xl font-bold text-blue-800">Edit Profil</h2>
        </div>

        <form action="{{ route('pasien.update-profil') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @csrf
            @method('PUT')
            
            <div class="col-span-1">
                <label class="text-sm font-medium text-gray-600">No. Rekam Medis</label>
                <input type="text" value="{{ $pasien->no_rm }}" readonly 
                    class="w-full mt-1 p-2 text-sm sm:text-base bg-gray-50 border border-gray-300 rounded-md">
            </div>

            <div class="col-span-1">
                <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" required 
                    class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md @error('nama') border-red-500 @enderror">
            </div>

            <div class="col-span-1">
                <label class="text-sm font-medium text-gray-600">No. KTP</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" required 
                    class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md @error('no_ktp') border-red-500 @enderror">
            </div>

            <div class="col-span-1">
                <label class="text-sm font-medium text-gray-600">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required 
                    class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md @error('no_hp') border-red-500 @enderror">
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label class="text-sm font-medium text-gray-600">Alamat</label>
                <textarea name="alamat" rows="2" required 
                    class="w-full mt-1 p-2 text-sm sm:text-base border border-gray-300 rounded-md @error('alamat') border-red-500 @enderror">{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>

            <div class="col-span-1 sm:col-span-2 text-center">
                <button type="submit" class="w-full sm:w-auto bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm sm:text-base">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
