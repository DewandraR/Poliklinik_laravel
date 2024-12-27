<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;    
use Illuminate\Support\Facades\Log; 

class DokterController extends Controller
{
    public function dashboard()
    {
        $dokter = Dokter::with('jadwalPeriksa')
            ->where('user_id', Auth::id())
            ->first();
        
        if (!$dokter) {
            return redirect()->route('logout')
                ->with('error', 'Data dokter tidak ditemukan');
        }

        $today = now()->today();
        $currentDay = now()->format('l'); // Gets current day name in English
        
        // Convert day name to Indonesian
        $hariTranslation = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        
        $currentHari = $hariTranslation[$currentDay];
        
        // Get today's schedule
        $jadwalHariIni = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->where('hari', $currentHari)
            ->where('status', 'aktif')
            ->first();
        
        $daftarPasien = DaftarPoli::with(['pasien', 'jadwalperiksa'])
            ->whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereDate('created_at', $today)
            ->get();

        $totalMenungguHariIni = $daftarPasien->where('status', 'menunggu')->count();
        $totalDiperiksaHariIni = $daftarPasien->where('status', 'diperiksa')->count();
        $totalSelesaiHariIni = $daftarPasien->where('status', 'selesai')->count();

        $totalMenunggu = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'menunggu')
            ->count();

        $totalDiperiksa = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'diperiksa')
            ->count();

        $totalSelesai = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'selesai')
            ->count();

        return view('dokter.dashboard', compact(
            'dokter', 
            'daftarPasien',
            'totalMenungguHariIni', 
            'totalDiperiksaHariIni', 
            'totalSelesaiHariIni',
            'totalMenunggu', 
            'totalDiperiksa', 
            'totalSelesai',
            'jadwalHariIni' // Added this variable to the compact array
        ));
    }

    // Menampilkan daftar jadwal dokter
    public function manageJadwal()
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();

        if (!$dokter) {
            return redirect()->route('logout')->with('error', 'Data dokter tidak ditemukan. Silakan hubungi admin.');
        }

        $jadwals = JadwalPeriksa::where('id_dokter', $dokter->id)->get();

        return view('dokter.jadwal', compact('dokter', 'jadwals'));
    }

    // Menampilkan form untuk membuat jadwal baru
    public function createJadwal()
    {
        return view('dokter.jadwal-create');
    }

    // Menyimpan jadwal baru
    public function storeJadwal(Request $request)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();

        if (!$dokter) {
            return redirect()->route('logout')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Check for existing schedule
        $existingJadwal = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->where('hari', $validatedData['hari'])
            ->first();

        if ($existingJadwal) {
            return redirect()->back()->with('error', 'Jadwal untuk hari ini sudah ada.');
        }

        // Check if there's any active schedule
        $hasActiveSchedule = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->where('status', 'aktif')
            ->exists();

        DB::beginTransaction();
        try {
            JadwalPeriksa::create([
                'id_dokter' => $dokter->id,
                'hari' => $validatedData['hari'],
                'jam_mulai' => $validatedData['jam_mulai'] . ':00',
                'jam_selesai' => $validatedData['jam_selesai'] . ':00',
                'status' => 'tidak aktif'
            ]);

            DB::commit();
            return redirect()->route('dokter.jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan jadwal.');
        }
    }


    // Menampilkan form untuk mengedit jadwal
    public function editJadwal($id)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();

        if (!$dokter) {
            return redirect()->route('dokter.jadwal')->with('error', 'Data dokter tidak ditemukan.');
        }

        $jadwal = JadwalPeriksa::where('id', $id)->where('id_dokter', $dokter->id)->first();

        if (!$jadwal) {
            return redirect()->route('dokter.jadwal')->with('error', 'Jadwal tidak ditemukan.');
        }

        return view('dokter.jadwal-edit', compact('jadwal'));
    }

    public function updateJadwal(Request $request, $id)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();

        if (!$dokter) {
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        $request->validate([
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $jadwal = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        if (!$jadwal) {
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Jadwal tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            if ($request->status === 'aktif') {
                // Deactivate all other schedules first
                JadwalPeriksa::where('id_dokter', $dokter->id)
                    ->where('id', '!=', $id)
                    ->update(['status' => 'tidak aktif']);
            }
            
            $jadwal->update(['status' => $request->status]);
            DB::commit();

            return redirect()->route('dokter.jadwal')
                ->with('success', 'Status jadwal berhasil diperbarui menjadi ' . $request->status);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Gagal memperbarui status jadwal.');
        }
    }

    public function updateStatus($id)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();
        
        if (!$dokter) {
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        $jadwal = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        if (!$jadwal) {
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Jadwal tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            // If setting to active, deactivate all other schedules first
            if ($jadwal->status === 'tidak aktif') {
                JadwalPeriksa::where('id_dokter', $dokter->id)
                    ->where('id', '!=', $jadwal->id)
                    ->update(['status' => 'tidak aktif']);
                    
                $jadwal->status = 'aktif';
            } else {
                $jadwal->status = 'tidak aktif';
            }
            
            $jadwal->save();
            DB::commit();

            return redirect()->route('dokter.jadwal')
                ->with('success', 'Status jadwal berhasil diperbarui menjadi ' . $jadwal->status);
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('dokter.jadwal')
                ->with('error', 'Gagal memperbarui status jadwal.');
        }
    }

    //daftar periksa
    public function daftarPeriksa(Request $request)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();
        
        if (!$dokter) {
            return redirect()->route('logout')
                ->with('error', 'Data dokter tidak ditemukan');
        }

        // Query dasar
        $query = DaftarPoli::with(['pasien', 'periksa', 'jadwalperiksa'])
            ->whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            });

        // Handle pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('pasien', function($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', "%{$searchTerm}%")
                ->orWhere('no_rm', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Handle filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan berdasarkan prioritas
        $query->orderByRaw("CASE 
            WHEN status = 'menunggu' THEN 1 
            WHEN status = 'diperiksa' THEN 2
            WHEN status = 'selesai' THEN 3 
            END")
            ->orderBy('created_at', 'desc');

        // Pagination dengan append query parameters
        $daftarPasien = $query->paginate(10);
        $daftarPasien->appends($request->query());

        // Hitung total untuk hari ini (untuk card status)
        $today = now()->today();
        
        // Hitung status untuk hari ini
        $totalMenungguHariIni = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereDate('created_at', $today)
            ->where('status', 'menunggu')
            ->count();

        $totalDiperiksaHariIni = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereDate('created_at', $today)
            ->where('status', 'diperiksa')
            ->count();

        $totalSelesaiHariIni = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereDate('created_at', $today)
            ->where('status', 'selesai')
            ->count();

        // Hitung total keseluruhan
        $totalMenunggu = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'menunggu')
            ->count();

        $totalDiperiksa = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'diperiksa')
            ->count();

        $totalSelesai = DaftarPoli::whereHas('jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'selesai')
            ->count();

        $currentDate = now();

        return view('dokter.daftar-periksa', compact(
            'daftarPasien',
            'totalMenunggu',
            'totalDiperiksa',
            'totalSelesai',
            'totalMenungguHariIni',
            'totalDiperiksaHariIni',
            'totalSelesaiHariIni',
            'currentDate'
        ));
    }

    public function mulaiPeriksa($id) 
    {
    $daftarPoli = DaftarPoli::with(['pasien', 'jadwalPeriksa'])->findOrFail($id);
    
    $dokter = Dokter::where('user_id', Auth::id())->first();
    if (!$dokter || $daftarPoli->jadwalPeriksa->id_dokter != $dokter->id) {
        return back()->with('error', 'Anda tidak memiliki akses untuk memeriksa pasien ini');
    }

    // Update status ke diperiksa
    $daftarPoli->update(['status' => 'diperiksa']);

    // Buat record periksa jika belum ada
    if (!$daftarPoli->periksa) {
        Periksa::create([
            'id_daftar_poli' => $daftarPoli->id,
            'tgl_periksa' => now(),
            'catatan' => '',
            'biaya_periksa' => null
        ]);
    }

    return redirect()->route('dokter.periksa.form', ['id' => $daftarPoli->id]);
    }

    public function updateStatusPeriksa(Request $request, $id)
    {
        $daftarPoli = DaftarPoli::findOrFail($id);
        $dokter = Dokter::where('user_id', Auth::id())->first();
        
        if (!$dokter || $daftarPoli->jadwalPeriksa->id_dokter != $dokter->id) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        $request->validate([
            'status' => 'required|in:menunggu,diperiksa,selesai'
        ]);

        $daftarPoli->status = $request->status;
        $daftarPoli->save();

        if ($request->status === 'diperiksa' && !$daftarPoli->periksa) {
            Periksa::create([
                'id_daftar_poli' => $daftarPoli->id,
                'tgl_periksa' => now(),
                'catatan' => '',
                'biaya_periksa' => null,
            ]);
        }

        // Tambahkan redirect ke halaman daftar-periksa
        return redirect()->route('dokter.daftar-periksa');
    }
    

    public function detailPeriksa($id)
    {
        try {
            // Ambil data dengan eager loading
            $daftarPoli = DaftarPoli::with([
                'pasien', 
                'periksa', 
                'periksa.detail_periksa.obat',
                'jadwalperiksa'
            ])->findOrFail($id);

            // Validasi akses dokter
            $dokter = Dokter::where('user_id', Auth::id())->first();
            if (!$dokter || $daftarPoli->jadwalperiksa->id_dokter != $dokter->id) {
                return back()->with('error', 'Anda tidak memiliki akses untuk melihat data ini');
            }

            // Validasi status pemeriksaan
            if (!$daftarPoli->periksa) {
                return back()->with('error', 'Data pemeriksaan belum tersedia');
            }

            // Validasi status daftar poli
            if ($daftarPoli->status !== 'selesai') {
                return back()->with('error', 'Pemeriksaan belum selesai');
            }

            return view('dokter.detail-periksa', compact('daftarPoli'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Data pemeriksaan tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error pada detailPeriksa: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function formPeriksa($id)
    {
        $daftarPoli = DaftarPoli::with(['pasien', 'periksa', 'jadwalPeriksa'])
            ->findOrFail($id);
        
        // Validasi dokter
        $dokter = Dokter::where('user_id', Auth::id())->first();
        if (!$dokter || $daftarPoli->jadwalPeriksa->id_dokter != $dokter->id) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        // Ambil daftar obat
        $obatList = Obat::orderBy('nama_obat')->get();

        // Jika sudah ada periksa, ambil obat yang sudah diresepkan
        $selectedObat = [];
        if ($daftarPoli->periksa) {
            $selectedObat = $daftarPoli->periksa->detailperiksa()
                ->with('obat')
                ->get()
                ->map(function($detail) {
                    return [
                        'id' => $detail->obat->id,
                        'nama' => $detail->obat->nama_obat,
                        'harga' => $detail->obat->harga,
                        'kemasan' => $detail->obat->kemasan
                    ];
                });
        }

        // Mengubah path view sesuai nama file baru
        return view('dokter.form-periksa', compact('daftarPoli', 'obatList', 'selectedObat'));
    }

    public function simpanPeriksa(Request $request, $id)
    {
        try {
            $daftarPoli = DaftarPoli::with(['periksa'])->findOrFail($id);
            $dokter = Dokter::where('user_id', Auth::id())->first();

            if (!$dokter || $daftarPoli->jadwalPeriksa->id_dokter != $dokter->id) {
                return back()->with('error', 'Anda tidak memiliki akses');
            }

            // Validasi input
            $validated = $request->validate([
                'catatan' => 'required|string',
                'biaya_jasa' => 'required|numeric|min:0',
                'total_biaya_obat' => 'required|numeric|min:0',
                'total_biaya' => 'required|numeric|min:0',
                'obat_ids' => 'required|array',
                'obat_ids.*' => 'exists:obats,id'
            ]);

            DB::beginTransaction();
            try {
                // Simpan atau update data periksa
                $periksa = Periksa::updateOrCreate(
                    ['id_daftar_poli' => $daftarPoli->id],
                    [
                        'tgl_periksa' => now(),
                        'catatan' => $validated['catatan'],
                        'biaya_periksa' => $validated['total_biaya'], // Ubah bagian ini
                    ]
                );

                // Hapus detail periksa yang lama jika ada
                DetailPeriksa::where('id_periksa', $periksa->id)->delete();

                // Simpan detail periksa baru
                foreach ($validated['obat_ids'] as $obatId) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $obatId
                    ]);
                }

                // Update status daftar poli
                $daftarPoli->update(['status' => 'selesai']);

                DB::commit();

                return redirect()->route('dokter.daftar-periksa')
                    ->with('success', 'Pemeriksaan berhasil disimpan');

            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error saat menyimpan pemeriksaan: ' . $e->getMessage());
                return back()
                    ->with('error', 'Terjadi kesalahan saat menyimpan data')
                    ->withInput();
            }

        } catch (\Exception $e) {
            Log::error('Error pada simpanPeriksa: ' . $e->getMessage());
            return back()
                ->with('error', 'Terjadi kesalahan sistem')
                ->withInput();
        }
    }

    public function lanjutkanPeriksa($id)
    {
        $daftarPoli = DaftarPoli::with(['pasien', 'jadwalPeriksa'])->findOrFail($id);
        
        $dokter = Dokter::where('user_id', Auth::id())->first();
        if (!$dokter || $daftarPoli->jadwalPeriksa->id_dokter != $dokter->id) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        if (!$daftarPoli->periksa) {
            return back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }

        return redirect()->route('dokter.periksa.form', ['id' => $daftarPoli->id])
            ->with('info', 'Melanjutkan pemeriksaan');
    }

    // riwayat
    public function riwayatPeriksa(Request $request)
    {
        $dokter = Dokter::where('user_id', Auth::id())->first();
        
        if (!$dokter) {
            return redirect()->route('logout')->with('error', 'Data dokter tidak ditemukan');
        }

        $query = Pasien::with(['daftarpoli.periksa'])
            ->whereHas('daftarpoli.jadwalperiksa', function($query) use($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereHas('daftarpoli.periksa');

        $uniquePatients = $query->paginate(10);
        
        return view('dokter.riwayat-periksa', compact('uniquePatients'));
    }

    public function detailRiwayatPeriksa(Request $request, $id)
    {
        $periksa = Periksa::with(['daftarpoli.pasien', 'daftarpoli.jadwalperiksa.dokter'])->findOrFail($id);
        
        $dokter = Dokter::where('user_id', Auth::id())->first();
        if (!$dokter || $periksa->daftarpoli->jadwalperiksa->id_dokter != $dokter->id) {
            return back()->with('error', 'Anda tidak memiliki akses ke data ini');
        }

        $pasien = $periksa->daftarpoli->pasien;

        $query = Periksa::with(['daftarpoli', 'detail_periksa.obat'])
            ->whereHas('daftarpoli', function($query) use($pasien, $dokter) {
                $query->where('id_pasien', $pasien->id)
                    ->where('status', 'selesai')
                    ->whereHas('jadwalperiksa', function($q) use($dokter) {
                        $q->where('id_dokter', $dokter->id);
                    });
            });

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tgl_periksa', $request->tanggal);
        }
        elseif ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tgl_periksa', $request->bulan)
                ->whereYear('tgl_periksa', $request->tahun);
        }
        elseif ($request->filled('tahun')) {
            $query->whereYear('tgl_periksa', $request->tahun);
        }

        $riwayatPeriksa = $query->get();

        return view('dokter.detail-riwayat-periksa', compact('pasien', 'periksa', 'riwayatPeriksa'));
    }

    public function profile()
    {
        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();
        return view('dokter.profile', compact('dokter'));
    }

    public function updateProfile(Request $request)
    {
        // Start database transaction
        DB::beginTransaction();
        
        try {
            // Get dokter with associated user
            $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();
            
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'no_hp' => 'required|string',
            ]);

            // Update dokter table
            $dokter->update($validated);
            
            // Update users table name
            $dokter->user()->update([
                'name' => $validated['nama']
            ]);
            
            DB::commit();
            
            return redirect()->route('dokter.profile')
                ->with('success', 'Profil berhasil diperbarui');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('dokter.profile')
                ->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
    }
}
