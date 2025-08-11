<?php

namespace App\Models;

use App\Traits\UploadsImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Gallery;

class Image extends Model
{
    use UploadsImageTrait;

    protected $fillable = [
        'url',
        'gallery_id',
        'name',

        'active',
        'position',

        'created_at',
        'updated_at'
    ];


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

        /**
     * Scope a query to only include not seen contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeInActive($query)
    {
        $query->where('active', 1);
    }

    /**
     * Scope a query to only include seen contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('active', 0);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
    
}
