<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_polis';
    
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
        'status' // Menambahkan status ke fillable
    ];

    // Konstanta untuk status
    const STATUS_MENUNGGU = 'menunggu';
    const STATUS_DIPERIKSA = 'diperiksa';
    const STATUS_SELESAI = 'selesai';

    // Daftar status yang valid
    public static $statusList = [
        self::STATUS_MENUNGGU => 'Menunggu',
        self::STATUS_DIPERIKSA => 'Diperiksa',
        self::STATUS_SELESAI => 'Selesai'
    ];

    // Method helper untuk status
    public function isMenunggu()
    {
        return $this->status === self::STATUS_MENUNGGU;
    }

    public function isDiperiksa()
    {
        return $this->status === self::STATUS_DIPERIKSA;
    }

    public function isSelesai()
    {
        return $this->status === self::STATUS_SELESAI;
    }

    // Method untuk mendapatkan warna badge berdasarkan status
    public function getStatusColorClass()
    {
        return [
            self::STATUS_MENUNGGU => 'bg-yellow-100 text-yellow-800 border-yellow-400',
            self::STATUS_DIPERIKSA => 'bg-blue-100 text-blue-800 border-blue-400',
            self::STATUS_SELESAI => 'bg-green-100 text-green-800 border-green-400',
        ][$this->status] ?? 'bg-gray-100 text-gray-800 border-gray-400';
    }

    // Method untuk mendapatkan label status yang ditampilkan
    public function getStatusLabel()
    {
        return self::$statusList[$this->status] ?? 'Tidak Diketahui';
    }

    // Relasi dengan Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    // Relasi dengan Jadwal Periksa
    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    // Relasi dengan Periksa
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }

    // Boot method untuk set default status
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($daftarPoli) {
            if (!$daftarPoli->status) {
                $daftarPoli->status = self::STATUS_MENUNGGU;
            }
        });
    }
}