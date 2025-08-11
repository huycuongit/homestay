<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = [
        'module',
        'module_name',
        'method',
        'method_name',
        'route',
        'order'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }
}
