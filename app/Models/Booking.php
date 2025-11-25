<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kos_id',
        'room_id',
        'start_date',
        'end_date',
    ];

    // Relasi ke User (penyewa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}