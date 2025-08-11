<?php

namespace App\Models;

use App\Traits\MetaDataTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\Sluggable;
use App\Traits\UploadsImageTrait;

class Service extends Authenticatable
{
    use Sluggable, UploadsImageTrait, MetaDataTrait;

    protected $fillable = [
        'title',
        'description',
        'avatar',
        'slug',
        'content',
        'is_active',
        'position',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'float',
        'position' => 'integer',
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if ($this->exists) {
            $this->attributes['slug'] = $this->makeUniqueSlug($value, $this->getTable(), 'slug', $this->id);
        } else {
            $this->attributes['slug'] = $this->makeUniqueSlug($value, $this->getTable(), 'slug');
        }
    }
    public function userCreated()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }

    public function userUpdated()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = $value;
        //  $this->attributes['username'] = $value;
    }

    public function setPasswordAttribute($value)
    {
        if (request()->has('is_default_password')) {
            $this->attributes['password'] = Hash::make(DAYONE_PASSWORD_DEFAULT);
        } else {
            $this->attributes['password'] = Hash::make($value);
        }
    }
    public function setIsDefaultPasswordAttribute($value)
    {
        if (request()->has('is_default_password')) {
            $this->attributes['password'] = Hash::make(DAYONE_PASSWORD_DEFAULT);
        }
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (!$this->exists) {
            $merge = encodeString();
            $slug = $this->makeUniqueSlug($merge, $this->getTable(), 'slug');
            $this->attributes['slug'] = $slug;
        }
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
