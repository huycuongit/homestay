<?php

namespace App\Models;

use App\Traits\UploadsImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    use UploadsImageTrait;
    protected $fillable = [
        'name',
        'icon',
        'description',
        'active',
        'position',
        'created_at',
        'updated_at'
    ];

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

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
