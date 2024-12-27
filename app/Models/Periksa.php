<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksas';
    
    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'status'

    ];

    protected $dates = [
        'tgl_periksa'
    ];

    // Relasi dengan Daftar Poli
    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    public function detail_periksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    // Relasi dengan Detail Periksa
    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}