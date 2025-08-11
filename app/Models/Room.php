<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'homestay_id',
        'name',
        'description',
        'price_per_night',
        'capacity',
        'active',
        'position',
    ];

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
