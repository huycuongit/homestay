<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'name_with_type',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
