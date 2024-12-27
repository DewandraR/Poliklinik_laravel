<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokters';
    
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp', 
        'id_poli',
        'user_id' 
    ];

    // Relasi dengan Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan Jadwal Periksa
    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    // Dalam model DaftarPoli
    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }
}