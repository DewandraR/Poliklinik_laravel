@extends('layouts.admin')

@section('title', 'Kelola Poli')

@section('content')
<div class="container mx-auto py-6">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah/Edit Poli -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            {{ isset($editPoli) ? 'Edit Poli' : 'Tambah Poli Baru' }}
        </h2>
        <form action="{{ isset($editPoli) ? route('admin.poli.update', $editPoli->id) : route('admin.poli.store') }}" 
              method="POST" class="space-y-4">
            @csrf
            @if(isset($editPoli))
                @method('PUT')
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Poli -->
                <div>
                    <label for="nama_poli" class="block text-sm font-medium text-gray-600">Nama Poli</label>
                    <input type="text" name="nama_poli" id="nama_poli" required
                        value="{{ isset($editPoli) ? $editPoli->nama_poli : old('nama_poli') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-600">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ isset($editPoli) ? $editPoli->keterangan : old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
                    {{ isset($editPoli) ? 'Update Poli' : 'Tambah Poli' }}
                </button>
                @if(isset($editPoli))
                    <a href="{{ route('admin.poli') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 focus:outline-none ml-2">
                        Batal
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Poli -->
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Poli</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Poli</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($polis as $poli)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $poli->nama_poli }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $poli->keterangan }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('admin.poli.edit', $poli->id) }}" 
                                class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="{{ route('admin.poli.destroy', $poli->id) }}" 
                                  method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus poli ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada data poli</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        @if($polis->hasPages())
            <div class="mt-4 border-t border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $polis->firstItem() }} sampai {{ $polis->lastItem() }}
                        dari {{ $polis->total() }} data
                    </div>
                    <div class="flex space-x-2">
                        @if($polis->onFirstPage())
                            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $polis->previousPageUrl() }}" 
                            class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                Sebelumnya
                            </a>
                        @endif

                        @if($polis->hasMorePages())
                            <a href="{{ $polis->nextPageUrl() }}" 
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