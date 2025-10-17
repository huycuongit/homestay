<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'name_slug',
        'full_name',
        'type',
    ];

    public function wards()
    {
        return $this->hasMany(Ward::class, 'province_id');
    }
}
