<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Sluggable;
use App\Traits\UploadsImageTrait;
use Carbon\Carbon;

class News extends Model
{
    use Sluggable, UploadsImageTrait;

    protected $fillable = [
        'news_category_id',
        'name',
        'slug',
        'avatar',
        'description',
        'content',
        'publish_time',
        'active',
        'position',
        // 'active_publish',
        // 'active_noti_student',
        // 'active_noti_coach',
        'views',
        'created_by_id',
        'updated_by_id',
        'created_at',
        'updated_at'
    ];

    public function userCreated()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }

    public function userUpdated()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (!isset($this->attributes['slug']) || !$this->attributes['slug']) {
            $this->attributes['slug'] = $this->makeUniqueSlug($value, $this->getTable(), 'slug');
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

    public function studentNotifications()
    {
        return $this->hasMany(StudentNotification::class, 'object_id')
            ->where('object_type', 'NEWS');
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
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
