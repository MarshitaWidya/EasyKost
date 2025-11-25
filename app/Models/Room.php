<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'kos_id',
        'room_name',
        'price_per_month',
        'size',
        'description',
    ];

    // Relasi ke Kos
    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
    // Relasi ke RoomImages
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
    // Relasi ke Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}