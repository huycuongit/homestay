<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_name',
        'password',
        'email',
        'phone',
        'type',
        'status',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id', 'password'];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'name' => 'string',
        'user_name' => 'string',
        'password' => 'string',
        'email' => 'string',
        'type' => 'integer',
        'status' => 'integer',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_admin')
            ->withTimestamps();
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'admin_branch', 'admin_id', 'branch_id')
            ->withTimestamps();
    }

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_user')
            ->withTimestamps();
    }

    public function getBranches()
    {
        if ($this->user_name == 'Admin') {
            return 'Admin';
        }
        return $this->branches()->pluck('branch_id')->toArray();
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($q) use ($permission) {
            $q->where('route', $permission);
        })->exists();
    }

    public function hasAnyPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($q) use ($permission) {
            $q->whereIn('route', $permission);
        })->exists();
    }

    public function getAllPermissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions.*.route')
            ->flatten()
            ->unique()
            ->reject(function ($permission) {
                return str_contains($permission, 'create') || str_contains($permission, 'destroy') || str_contains($permission, 'edit');
            });
    }

    public function getAllCheckPermissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions.*.route')
            ->flatten()
            ->unique();
    }

    public function getFirstPermissionRoute()
    {
        return $this->getAllPermissions()->first();
    }

    public function getRoleNamesAsString()
    {
        return $this->roles()->pluck('name')->implode(', ');
    }

    public function getRoleNamesAttribute()
    {
        return $this->roles()->pluck('name')->implode(', ');
    }


    /**
     * Scope a query to only include inactive contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeInActive($query)
    {
        $query->where('active', 0);
    }

    /**
     * Scope a query to only include active contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    /**
     * Scope a query to order results by multiple columns.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $columns
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByMultipleColumns($query, array $columns, $direction = 'asc')
    {
        foreach ($columns as $column) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }
}
