@extends('layouts.admin')

@section('title', 'Kelola Obat')

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

    <!-- Form Tambah/Edit Obat -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            {{ isset($editObat) ? 'Edit Obat' : 'Tambah Obat Baru' }}
        </h2>
        <form action="{{ isset($editObat) ? route('admin.obat.update', $editObat->id) : route('admin.obat.store') }}" 
              method="POST" class="space-y-4">
            @csrf
            @if(isset($editObat))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Obat -->
                <div>
                    <label for="nama_obat" class="block text-sm font-medium text-gray-600">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" required
                        value="{{ isset($editObat) ? $editObat->nama_obat : old('nama_obat') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_obat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kemasan -->
                <div>
                    <label for="kemasan" class="block text-sm font-medium text-gray-600">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan"
                        value="{{ isset($editObat) ? $editObat->kemasan : old('kemasan') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('kemasan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-600">Harga</label>
                    <input type="number" name="harga" id="harga" required
                        value="{{ isset($editObat) ? $editObat->harga : old('harga') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
                    {{ isset($editObat) ? 'Update Obat' : 'Tambah Obat' }}
                </button>
                @if(isset($editObat))
                    <a href="{{ route('admin.obat') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 focus:outline-none ml-2">
                        Batal
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Obat -->
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Obat</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Obat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kemasan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($obats as $obat)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $obat->nama_obat }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $obat->kemasan }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('admin.obat.edit', $obat->id) }}" 
                                class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="{{ route('admin.obat.destroy', $obat->id) }}" 
                                  method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada data obat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        @if($obats->hasPages())
            <div class="mt-4 border-t border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $obats->firstItem() }} sampai {{ $obats->lastItem() }}
                        dari {{ $obats->total() }} data
                    </div>
                    <div class="flex space-x-2">
                        @if($obats->onFirstPage())
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $obats->previousPageUrl() }}" 
                            class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                Sebelumnya
                            </a>
                        @endif

                        @if($obats->hasMorePages())
                            <a href="{{ $obats->nextPageUrl() }}" 
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