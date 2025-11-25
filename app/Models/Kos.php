<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'name',
        'description',
        'address',
        'city',
        'price_start',
        'facilities',
        'thumbnail'
    ];

    // Relasi ke User (pengelola)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    // Relasi ke Rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}