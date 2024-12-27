@extends('layouts.admin')

@section('title', 'Kelola Dokter')

@section('content')
<div class="container mx-auto py-6">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah/Edit Dokter -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            {{ isset($editDokter) ? 'Edit Dokter' : 'Tambah Dokter Baru' }}
        </h2>
        <form action="{{ isset($editDokter) ? route('admin.dokter.update', $editDokter->id) : route('admin.dokter.store') }}" 
              method="POST" class="space-y-4">
            @csrf
            @if(isset($editDokter))
                @method('PUT')
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-600">Nama</label>
                    <input type="text" name="nama" id="nama" required
                        value="{{ isset($editDokter) ? $editDokter->nama : old('nama') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat</label>
                    <input type="text" name="alamat" id="alamat"
                        value="{{ isset($editDokter) ? $editDokter->alamat : old('alamat') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-600">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" required
                        value="{{ isset($editDokter) ? $editDokter->no_hp : old('no_hp') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Poli -->
                <div>
                    <label for="id_poli" class="block text-sm font-medium text-gray-600">Poli</label>
                    <select name="id_poli" id="id_poli" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Poli</option>
                        @foreach ($polis as $poli)
                            <option value="{{ $poli->id }}" 
                                {{ (isset($editDokter) && $editDokter->id_poli == $poli->id) || old('id_poli') == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama_poli }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" 
                        {{ isset($editDokter) ? '' : 'required' }}
                        value="{{ isset($editDokter) ? $editDokter->user->email : old('email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">
                        Password {{ isset($editDokter) ? '(Kosongkan jika tidak ingin mengubah)' : '' }}
                    </label>
                    <input type="password" name="password" id="password" 
                        {{ isset($editDokter) ? '' : 'required' }}
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
                    {{ isset($editDokter) ? 'Update Dokter' : 'Tambah Dokter' }}
                </button>
                @if(isset($editDokter))
                    <a href="{{ route('admin.dokter') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 focus:outline-none ml-2">
                        Batal
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Dokter -->
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Dokter</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($dokters as $dokter)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $dokter->nama }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $dokter->alamat }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $dokter->no_hp }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $dokter->poli->nama_poli }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}" 
                                class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" 
                                  method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada data dokter</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        @if($dokters->hasPages())
            <div class="mt-4 border-t border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $dokters->firstItem() }} sampai {{ $dokters->lastItem() }}
                        dari {{ $dokters->total() }} data
                    </div>
                    <div class="flex space-x-2">
                        @if($dokters->onFirstPage())
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $dokters->previousPageUrl() }}" 
                            class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                Sebelumnya
                            </a>
                        @endif

                        @if($dokters->hasMorePages())
                            <a href="{{ $dokters->nextPageUrl() }}" 
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