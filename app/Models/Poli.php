<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'polis';
    
    protected $fillable = [
        'nama_poli',
        'keterangan'
    ];

    // Relasi dengan Dokter
    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
}