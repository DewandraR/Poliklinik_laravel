<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::where('user_id', Auth::id())->first();
        $riwayatDaftar = DaftarPoli::with(['jadwalPeriksa.dokter.poli']) 
                        ->where('id_pasien', $pasien->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
                        
        return view('pasien.dashboard', compact('pasien', 'riwayatDaftar'));
    }

    public function daftarPoli()
    {
        $polis = Poli::all();
        $dokters = Dokter::all();
        return view('pasien.daftar-poli', compact('polis', 'dokters'));
    }

    public function getDokterByPoli($id_poli)
    {
        $dokters = Dokter::where('id_poli', $id_poli)->get();
        return response()->json($dokters);
    }

    public function getJadwalDokter($id_dokter)
    {
        $jadwal = JadwalPeriksa::where('id_dokter', $id_dokter)
                ->where('status', 'aktif') 
                ->where('hari', '>=', now())
                ->get();
        return response()->json($jadwal);
    }

    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        $pasien = Pasien::where('user_id', Auth::id())->first();
        
        // Hitung no antrian
        $antrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
                  ->whereDate('created_at', now())
                  ->count() + 1;

        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $antrian
        ]);

        return redirect()->route('pasien.riwayat')
               ->with('success', 'Berhasil mendaftar dengan nomor antrian ' . $antrian);
    }

    public function riwayat(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::id())->first();
        $query = DaftarPoli::with(['jadwalPeriksa.dokter.poli', 'periksa'])
            ->where('id_pasien', $pasien->id);

        // Filter berdasarkan bulan dan tahun
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun)
                ->whereMonth('created_at', $request->bulan);
        } elseif ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        } elseif ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        $riwayat = $query->latest()->paginate(10);
        
        if ($request->has('bulan') || $request->has('tahun')) {
            $riwayat->appends([
                'bulan' => $request->bulan,
                'tahun' => $request->tahun
            ]);
        }

        return view('pasien.riwayat', compact('riwayat'));
    }

    public function profil()
    {
        $pasien = Pasien::where('user_id', Auth::id())->first();
        return view('pasien.profil', compact('pasien'));
    }

    public function updateProfil(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'alamat' => 'required|string'
        ]);

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Update data pasien
            $pasien = Pasien::where('user_id', Auth::id())->first();
            $pasien->update($request->only(['nama', 'no_ktp', 'no_hp', 'alamat']));

            // Update nama di tabel users
            $user = User::find(Auth::id());
            $user->name = $request->nama;
            $user->save();

            // Commit transaksi
            DB::commit();

            return redirect()->route('pasien.profil')
                ->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollback();

            return redirect()->route('pasien.profil')
                ->with('error', 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.');
        }
    }

    public function detailPemeriksaan($id)
    {
        $daftarPoli = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli',
            'periksa.detail_periksa.obat'
        ])->findOrFail($id);

        return view('pasien.detail-pemeriksaan', compact('daftarPoli'));
    }
}