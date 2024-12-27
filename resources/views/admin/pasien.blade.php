@extends('layouts.admin')

@section('title', 'Kelola Pasien')

@section('content')
<div class="container mx-auto py-6">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Tambah/Edit Pasien -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            {{ isset($editPasien) ? 'Edit Pasien' : 'Tambah Pasien Baru' }}
        </h2>
        <form action="{{ isset($editPasien) ? route('admin.pasien.update', $editPasien->id) : route('admin.pasien.store') }}" 
              method="POST" class="space-y-4">
            @csrf
            @if(isset($editPasien))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- No RM -->
                <div>
                    <label for="no_rm" class="block text-sm font-medium text-gray-600">Nomor RM</label>
                    <input type="text" id="no_rm" readonly
                        value="{{ isset($editPasien) ? $editPasien->no_rm : $newNoRM ?? 'Auto Generate' }}"
                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm text-gray-600">
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-600">Nama</label>
                    <input type="text" name="nama" id="nama" required
                        value="{{ isset($editPasien) ? $editPasien->nama : old('nama') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required
                        value="{{ isset($editPasien) ? $editPasien->alamat : old('alamat') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No KTP -->
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-600">Nomor KTP</label>
                    <input type="text" name="no_ktp" id="no_ktp" required
                        value="{{ isset($editPasien) ? $editPasien->no_ktp : old('no_ktp') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('no_ktp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-600">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" required
                        value="{{ isset($editPasien) ? $editPasien->no_hp : old('no_hp') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('no_hp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" required
                        value="{{ isset($editPasien) && $editPasien->user ? $editPasien->user->email : old('email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" id="password" {{ isset($editPasien) ? '' : 'required' }}
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
                    {{ isset($editPasien) ? 'Update Pasien' : 'Tambah Pasien' }}
                </button>
                @if(isset($editPasien))
                    <a href="{{ route('admin.pasien') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 focus:outline-none ml-2">
                        Batal
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Pasien -->
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Pasien</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No RM</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No KTP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pasiens as $pasien)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pasien->no_rm }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pasien->nama }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pasien->alamat }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pasien->no_ktp }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $pasien->no_hp }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}" 
                                class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" 
                                  method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada data pasien</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        @if($pasiens->hasPages())
            <div class="mt-4 border-t border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $pasiens->firstItem() }} sampai {{ $pasiens->lastItem() }}
                        dari {{ $pasiens->total() }} data
                    </div>
                    <div class="flex space-x-2">
                        @if($pasiens->onFirstPage())
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $pasiens->previousPageUrl() }}" 
                            class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                Sebelumnya
                            </a>
                        @endif

                        @if($pasiens->hasMorePages())
                            <a href="{{ $pasiens->nextPageUrl() }}" 
                            class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                Selanjutnya
                            </a>
                        @else
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                Selanjutnya
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection