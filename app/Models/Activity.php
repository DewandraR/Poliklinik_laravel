<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'type',
        'description',
        'created_at'
    ];

    public function getTimeAgoAttribute()
    {
        $now = now();
        $created = $this->created_at;
        $diffInMinutes = $created->diffInMinutes($now);
        
        if ($diffInMinutes < 1) {
            return 'Baru saja';
        } elseif ($diffInMinutes < 60) {
            return $diffInMinutes . ' menit yang lalu';
        } elseif ($diffInMinutes < 1440) {
            $hours = floor($diffInMinutes / 60);
            return $hours . ' jam yang lalu';
        } else {
            $days = floor($diffInMinutes / 1440);
            return $days . ' hari yang lalu';
        }
    }
}