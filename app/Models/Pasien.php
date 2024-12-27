<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens';
    
    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
        'user_id'
    ];

   
    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function latest_periksa()
    {
    return $this->hasManyThrough(
        Periksa::class,
        DaftarPoli::class,
        'id_pasien',
        'id_daftar_poli'
    )->latest('tgl_periksa')->limit(1);
    }
}