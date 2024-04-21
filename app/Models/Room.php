<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function features()
    {
        return $this->belongsToMany(Features::class, 'room_features');
    }

    public function facilities()
    {
        return $this->belongsToMany(facilities::class, 'room_facilities');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
