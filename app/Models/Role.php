<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'department_id',

        'name',

        'active',
        'position',

        'created_at',
        'updated_at',

        'created_by_id',
        'updated_by_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)
            ->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'role_admin')
            ->withTimestamps();
    }

    public function userCreated()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }

    public function userUpdated()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
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
