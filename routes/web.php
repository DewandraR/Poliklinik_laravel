<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliFrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PoliFrontController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk dashboard umum dengan pengecekan role
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            } elseif (Auth::user()->role === 'pasien') {
                return redirect()->route('pasien.dashboard');
            }
        }
        return view('dashboard'); // Dashboard default
    })->name('dashboard');

    // Admin Routes
    Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        //dokter
        Route::get('/manage-dokter', [AdminController::class, 'manageDokter'])->name('admin.dokter');
        Route::post('/manage-dokter', [AdminController::class, 'storeDokter'])->name('admin.dokter.store');
        Route::get('/admin/dokter/{id}/edit', [AdminController::class, 'edit'])->name('admin.dokter.edit');
        Route::put('/admin/dokter/{id}', [AdminController::class, 'update'])->name('admin.dokter.update');
        Route::delete('/admin/dokter/{id}', [AdminController::class, 'destroy'])->name('admin.dokter.destroy');
        //pasien
        Route::get('/manage-pasien', [AdminController::class, 'managePasien'])->name('admin.pasien');
        Route::post('/admin/pasien', [AdminController::class, 'storePasien'])->name('admin.pasien.store');
        Route::get('/admin/pasien/{id}/edit', [AdminController::class, 'editPasien'])->name('admin.pasien.edit');
        Route::put('/admin/pasien/{id}', [AdminController::class, 'updatePasien'])->name('admin.pasien.update');
        Route::delete('/admin/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('admin.pasien.destroy');
        // poli
        Route::get('/manage-poli', [AdminController::class, 'managePoli'])->name('admin.poli');
        Route::post('/admin/poli', [AdminController::class, 'storePoli'])->name('admin.poli.store');
        Route::get('/admin/poli/{id}/edit', [AdminController::class, 'editPoli'])->name('admin.poli.edit');
        Route::put('/admin/poli/{id}', [AdminController::class, 'updatePoli'])->name('admin.poli.update');
        Route::delete('/admin/poli/{id}', [AdminController::class, 'destroyPoli'])->name('admin.poli.destroy');
        // obat
        Route::get('/manage-obat', [AdminController::class, 'manageObat'])->name('admin.obat');
        Route::post('/admin/obat', [AdminController::class, 'storeObat'])->name('admin.obat.store');
        Route::get('/admin/obat/{id}/edit', [AdminController::class, 'editObat'])->name('admin.obat.edit');
        Route::put('/admin/obat/{id}', [AdminController::class, 'updateObat'])->name('admin.obat.update');
        Route::delete('/admin/obat/{id}', [AdminController::class, 'destroyObat'])->name('admin.obat.destroy');
    });
    

    // Dokter Routes
    Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->name('dokter.')->group(function () {
        // Dashboard Dokter
        Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');
        
        // Kelola Jadwal
        Route::get('/jadwal', [DokterController::class, 'manageJadwal'])->name('jadwal');
        Route::get('/jadwal/create', [DokterController::class, 'createJadwal'])->name('jadwal.create');
        Route::post('/jadwal', [DokterController::class, 'storeJadwal'])->name('jadwal.store');
        Route::get('/jadwal/{id}/edit', [DokterController::class, 'editJadwal'])->name('jadwal.edit');
        Route::put('/jadwal/{id}', [DokterController::class, 'updateJadwal'])->name('jadwal.update');
        Route::delete('/jadwal/{id}', [DokterController::class, 'destroyJadwal'])->name('jadwal.destroy');
        Route::patch('/jadwal/{id}/status', [DokterController::class, 'updateStatus'])->name('jadwal.updateStatus');
    
        //daftar periksa
        Route::get('/daftar-periksa', [DokterController::class, 'daftarPeriksa'])->name('daftar-periksa');
        Route::get('/periksa/{id}/mulai', [DokterController::class, 'mulaiPeriksa'])->name('periksa.mulai');
        Route::get('/periksa/{id}/form', [DokterController::class, 'formPeriksa'])->name('periksa.form');
        Route::get('/periksa/{id}/detail', [DokterController::class, 'detailPeriksa'])->name('periksa.detail');
        Route::put('/periksa/{id}/update-status-periksa', [DokterController::class, 'updateStatusPeriksa'])
            ->name('periksa.update-status-periksa');
        Route::get('/periksa/{id}/lanjutkan', [DokterController::class, 'lanjutkanPeriksa'])
            ->name('periksa.lanjutkan');
        Route::post('/periksa/{id}/simpan', [DokterController::class, 'simpanPeriksa'])
            ->name('periksa.simpan');
            Route::get('/form-periksa/{id}', [DokterController::class, 'formPeriksa'])->name('form-periksa');
        Route::get('/detail-periksa/{id}', [DokterController::class, 'detailPeriksa'])->name('detail-periksa');

        //riwayat periksa
        Route::get('/riwayat-periksa', [DokterController::class, 'riwayatPeriksa'])
            ->name('riwayat-periksa'); // Hapus 'dokter.' karena sudah ada di group
        Route::get('/riwayat-periksa/{id}', [DokterController::class, 'detailRiwayatPeriksa'])
            ->name('detail-riwayat-periksa');

        // Profile 
        Route::get('/profile', [DokterController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [DokterController::class, 'updateProfile'])->name('profile.update');
    });


    // Pasien Routes
    Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [PasienController::class, 'index'])->name('pasien.dashboard');
        
        // Pendaftaran Poli
        Route::get('/daftar-poli', [PasienController::class, 'daftarPoli'])->name('pasien.daftar-poli');
        Route::get('/get-dokter/{id_poli}', [PasienController::class, 'getDokterByPoli']);
        Route::get('/get-jadwal/{id_dokter}', [PasienController::class, 'getJadwalDokter']);
        Route::post('/daftar-poli', [PasienController::class, 'storePendaftaran'])->name('pasien.store-pendaftaran');
    
        // Riwayat
        Route::get('/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
        Route::get('/riwayat/{id}/detail', [PasienController::class, 'detailPemeriksaan'])->name('pasien.detail-pemeriksaan');
    
        // Profil
        Route::get('/profil', [PasienController::class, 'profil'])->name('pasien.profil');
        Route::put('/profil', [PasienController::class, 'updateProfil'])->name('pasien.update-profil');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';