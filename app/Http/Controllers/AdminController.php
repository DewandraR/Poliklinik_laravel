<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();
        $totalPoli = Poli::count();
        $totalObat = Obat::count();
        
        // Ambil 4 aktivitas terbaru
        $recentActivities = Activity::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalDokter', 
            'totalPasien', 
            'totalPoli', 
            'totalObat',
            'recentActivities'
        ));
    }

    private function logActivity($type, $description)
    {
        Activity::create([
            'type' => $type,
            'description' => $description,
            'created_at' => now()
        ]);
    }

    public function manageDokter()
    {
        $dokters = Dokter::with(['poli'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $polis = Poli::all();

        return view('admin.dokter', compact('dokters', 'polis'));
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:50',
            'id_poli' => 'required|exists:polis,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            // Buat user baru
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'dokter',
            ]);

            // Buat dokter baru dengan user_id
            Dokter::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_poli' => $request->id_poli,
                'user_id' => $user->id,
            ]);

            $this->logActivity('dokter', 'Dokter ' . $request->nama . ' ditambahkan');

            DB::commit();
            return redirect()->route('admin.dokter')->with('success', 'Dokter berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat menambahkan dokter: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $editDokter = Dokter::with(['poli', 'user'])->findOrFail($id);
        $dokters = Dokter::with(['poli'])->get();
        $polis = Poli::all();
        
        return view('admin.dokter', compact('dokters', 'polis', 'editDokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:50',
            'id_poli' => 'required|exists:polis,id',
            'email' => 'required|email|unique:users,email,' . Dokter::findOrFail($id)->user_id,
            'password' => 'nullable|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            $dokter = Dokter::findOrFail($id);
            
            // Update user if email or password changed
            if ($request->filled('email') || $request->filled('password')) {
                $userData = [
                    'name' => $request->nama,
                    'email' => $request->email,
                ];
                
                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }
                
                $dokter->user->update($userData);
            }

            // Update dokter
            $dokter->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_poli' => $request->id_poli,
            ]);

            DB::commit();
            return redirect()->route('admin.dokter')->with('success', 'Dokter berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat memperbarui dokter: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $dokter = Dokter::findOrFail($id);
            
            // Delete associated user
            if ($dokter->user) {
                $dokter->user->delete();
            }
            
            // Delete dokter
            $dokter->delete();

            DB::commit();
            return redirect()->route('admin.dokter')->with('success', 'Dokter berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokter: ' . $e->getMessage());
        }
    }


    // kelola pasien
    public function managePasien()
    {
        // Generate nomor RM untuk form tambah
        $tahun = date('Y');
        $bulan = date('m');
        $prefix = $tahun . $bulan . '-';
        
        // Cari nomor RM terakhir dengan prefix tahun dan bulan yang sama
        $lastRM = Pasien::where('no_rm', 'like', $prefix . '%')
                        ->orderBy('no_rm', 'desc')
                        ->first();

        if ($lastRM) {
            // Jika sudah ada, ambil 3 digit terakhir dan tambahkan 1
            $lastNumber = intval(substr($lastRM->no_rm, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada, mulai dari 001
            $newNumber = '001';
        }

        $newNoRM = $prefix . $newNumber;
        $pasiens = Pasien::latest()->paginate(10);

        return view('admin.pasien', compact('pasiens', 'newNoRM'));
    }

    public function storePasien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:pasiens',
            'no_hp' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            // Buat user baru
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Generate nomor RM
            $tahun = date('Y');
            $bulan = date('m');
            $prefix = $tahun . $bulan . '-';
            
            $lastRM = Pasien::where('no_rm', 'like', $prefix . '%')
                            ->orderBy('no_rm', 'desc')
                            ->first();

            if ($lastRM) {
                $lastNumber = intval(substr($lastRM->no_rm, -3));
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            $no_rm = $prefix . $newNumber;

            // Buat pasien baru dengan relasi ke user
            $pasien = Pasien::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'no_rm' => $no_rm,
                'user_id' => $user->id,
            ]);

            $this->logActivity('pasien', 'Pasien ' . $request->nama . ' terdaftar');

            DB::commit();
            return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat menambahkan pasien: ' . $e->getMessage());
        }
    }

    public function editPasien($id)
    {
        $editPasien = Pasien::with('user')->findOrFail($id);
        $pasiens = Pasien::latest()->get();
        
        // Generate nomor RM untuk form tambah (tetap diperlukan untuk form tambah)
        $tahun = date('Y');
        $bulan = date('m');
        $prefix = $tahun . $bulan . '-';
        
        $lastRM = Pasien::where('no_rm', 'like', $prefix . '%')
                        ->orderBy('no_rm', 'desc')
                        ->first();

        if ($lastRM) {
            $lastNumber = intval(substr($lastRM->no_rm, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $newNoRM = $prefix . $newNumber;

        return view('admin.pasien', compact('editPasien', 'pasiens', 'newNoRM'));
    }

    public function updatePasien(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:pasiens,no_ktp,' . $id,
            'no_hp' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . Pasien::findOrFail($id)->user_id,
            'password' => 'nullable|string|min:6',
        ]);

        try {
            DB::beginTransaction();

            $pasien = Pasien::findOrFail($id);
            
            // Update user if email or password changed
            if ($request->filled('email') || $request->filled('password')) {
                $userData = [
                    'name' => $request->nama,
                    'email' => $request->email,
                ];
                
                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }
                
                $pasien->user->update($userData);
            }

            // Update pasien
            $pasien->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit();
            return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat memperbarui pasien: ' . $e->getMessage());
        }
    }

    public function destroyPasien($id)
    {
        try {
            DB::beginTransaction();

            $pasien = Pasien::with('user')->findOrFail($id);
            $pasien->user()->delete(); // Menghapus data pengguna (user)
            $pasien->delete(); // Menghapus data pasien

            DB::commit();
            return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pasien: ' . $e->getMessage());
        }
    }

    // poli
    public function managePoli()
    {
        $polis = Poli::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.poli', compact('polis'));
    }

    public function storePoli(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            Poli::create([
                'nama_poli' => $request->nama_poli,
                'keterangan' => $request->keterangan,
            ]);

            $this->logActivity('poli', 'Poli ' . $request->nama_poli . ' ditambahkan');

            DB::commit();
            return redirect()->route('admin.poli')->with('success', 'Poli berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat menambahkan poli: ' . $e->getMessage());
        }
    }

    public function editPoli($id)
    {
        $editPoli = Poli::findOrFail($id);
        $polis = Poli::all();
        return view('admin.poli', compact('editPoli', 'polis'));
    }

    public function updatePoli(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $poli = Poli::findOrFail($id);
            $poli->update([
                'nama_poli' => $request->nama_poli,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();
            return redirect()->route('admin.poli')->with('success', 'Poli berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat memperbarui poli: ' . $e->getMessage());
        }
    }

    public function destroyPoli($id)
    {
        try {
            DB::beginTransaction();

            $poli = Poli::findOrFail($id);
            $poli->delete();

            DB::commit();
            return redirect()->route('admin.poli')->with('success', 'Poli berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus poli: ' . $e->getMessage());
        }
    }

    // obat
    public function manageObat()
    {
        $obats = Obat::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.obat', compact('obats'));
    }

    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:100',
            'kemasan' => 'nullable|string|max:35',
            'harga' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            Obat::create([
                'nama_obat' => $request->nama_obat,
                'kemasan' => $request->kemasan,
                'harga' => $request->harga,
            ]);

            $this->logActivity('obat', 'Obat ' . $request->nama_obat . ' ditambahkan');

            DB::commit();
            return redirect()->route('admin.obat')->with('success', 'Obat berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat menambahkan obat: ' . $e->getMessage());
        }
    }

    public function editObat($id)
    {
        $editObat = Obat::findOrFail($id);
        $obats = Obat::all();
        return view('admin.obat', compact('editObat', 'obats'));
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'nullable|string|max:35',
            'harga' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            $obat = Obat::findOrFail($id);
            $obat->update([
                'nama_obat' => $request->nama_obat,
                'kemasan' => $request->kemasan,
                'harga' => $request->harga,
            ]);

            DB::commit();
            return redirect()->route('admin.obat')->with('success', 'Obat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan saat memperbarui obat: ' . $e->getMessage());
        }
    }

    public function destroyObat($id)
    {
        try {
            DB::beginTransaction();

            $obat = Obat::findOrFail($id);
            $obat->delete();

            DB::commit();
            return redirect()->route('admin.obat')->with('success', 'Obat berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus obat: ' . $e->getMessage());
        }
    }
}