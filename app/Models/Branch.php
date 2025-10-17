<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'province_id',
        'ward_id',
        'address',
        'google_map_link',
        'description',
        'active'
    ];

    // Quan hệ
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    // Tự động tạo slug từ name nếu chưa có
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($branch) {
            if (empty($branch->slug) && !empty($branch->name)) {
                $branch->slug = Str::slug($branch->name);
            }
        });
    }
}
