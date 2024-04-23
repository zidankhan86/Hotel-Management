<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
