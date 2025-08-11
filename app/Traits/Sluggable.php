<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait Sluggable
{
    protected function makeUniqueSlug($name, $table, $column, $id = null)
    {
        $slug = Str::slug($name);
        $count = 0;

        while ($this->slugExists($slug, $table, $column, $id)) {
            if ($count > 0) {
                $slug = Str::slug($name) . '-' . $count;
            }
            $count++;
        }
        return $slug;
    }

    protected function slugExists($slug, $table, $column, $id)
    {
        $query = DB::table($table)->where($column, $slug);
        if ($id !== null) {
            $query->where('id', '<>', $id);
        }
        return $query->exists();
    }
}
