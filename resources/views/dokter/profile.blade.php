@extends('layouts.dokter')

@section('title', 'Profil Dokter')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profil Dokter</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola informasi profil anda</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form action="{{ route('dokter.profile.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text" 
                           name="nama" 
                           value="{{ old('nama', $dokter->nama) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        No. HP
                    </label>
                    <input type="text" 
                           name="no_hp" 
                           value="{{ old('no_hp', $dokter->no_hp) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" 
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $dokter->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

// Add these methods to DokterController.php

public function konsultasi()
{
    $dokter = Dokter::where('user_id', Auth::id())->first();
    
    if (!$dokter) {
        return redirect()->route('logout')
            ->with('error', 'Data dokter tidak ditemukan');
    }

    // Get consultations with eager loading
    $konsultasi = Konsultasi::with(['pasien'])
        ->where('id_dokter', $dokter->id)
        ->orderBy('tgl_konsultasi', 'desc')
        ->paginate(10);

    // Get stats
    $belumDijawab = Konsultasi::where('id_dokter', $dokter->id)
        ->whereNull('jawaban')
        ->count();
    
    $sudahDijawab = Konsultasi::where('id_dokter', $dokter->id)
        ->whereNotNull('jawaban')
        ->count();

    return view('dokter.konsultasi.index', compact(
        'konsultasi',
        'belumDijawab',
        'sudahDijawab'
    ));
}

public function detailKonsultasi($id)
{
    $dokter = Dokter::where('user_id', Auth::id())->first();
    
    if (!$dokter) {
        return redirect()->route('logout')
            ->with('error', 'Data dokter tidak ditemukan');
    }

    $konsultasi = Konsultasi::with(['pasien'])
        ->where('id_dokter', $dokter->id)
        ->findOrFail($id);

    return view('dokter.konsultasi.detail', compact('konsultasi'));
}

public function jawabKonsultasi(Request $request, $id)
{
    $dokter = Dokter::where('user_id', Auth::id())->first();
    
    if (!$dokter) {
        return redirect()->route('logout')
            ->with('error', 'Data dokter tidak ditemukan');
    }

    $konsultasi = Konsultasi::where('id_dokter', $dokter->id)
        ->findOrFail($id);

    $request->validate([
        'jawaban' => 'required|string'
    ]);

    try {
        DB::beginTransaction();

        $konsultasi->update([
            'jawaban' => $request->jawaban,
            'tgl_konsultasi' => now()
        ]);

        DB::commit();

        return redirect()->route('dokter.konsultasi')
            ->with('success', 'Konsultasi berhasil dijawab');

    } catch (\Exception $e) {
        DB::rollback();
        return back()
            ->with('error', 'Terjadi kesalahan saat menyimpan jawaban')
            ->withInput();
    }
}

public function filterKonsultasi(Request $request)
{
    $dokter = Dokter::where('user_id', Auth::id())->first();
    
    if (!$dokter) {
        return redirect()->route('logout')
            ->with('error', 'Data dokter tidak ditemukan');
    }

    $query = Konsultasi::with(['pasien'])
        ->where('id_dokter', $dokter->id);

    // Filter by status
    if ($request->filled('status')) {
        if ($request->status === 'belum_dijawab') {
            $query->whereNull('jawaban');
        } elseif ($request->status === 'sudah_dijawab') {
            $query->whereNotNull('jawaban');
        }
    }

    // Filter by date
    if ($request->filled('tanggal')) {
        $query->whereDate('tgl_konsultasi', $request->tanggal);
    }

    // Filter by search term
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('subject', 'LIKE', "%{$searchTerm}%")
              ->orWhere('pertanyaan', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('pasien', function($q) use ($searchTerm) {
                  $q->where('nama', 'LIKE', "%{$searchTerm}%");
              });
        });
    }

    $konsultasi = $query->orderBy('tgl_konsultasi', 'desc')
        ->paginate(10)
        ->appends($request->query());

    $belumDijawab = Konsultasi::where('id_dokter', $dokter->id)
        ->whereNull('jawaban')
        ->count();
    
    $sudahDijawab = Konsultasi::where('id_dokter', $dokter->id)
        ->whereNotNull('jawaban')
        ->count();

    return view('dokter.konsultasi.index', compact(
        'konsultasi',
        'belumDijawab',
        'sudahDijawab'
    ));
}
