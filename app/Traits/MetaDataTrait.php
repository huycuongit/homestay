<?php namespace App\Traits;

use App\Models\MetaData;

trait MetaDataTrait
{
    public function meta()
    {
        $meta_key = $this->table;
        return $this->hasOne(MetaData::class, 'object_id')->where(function ($q) use ($meta_key) {
            return $q->where('meta_key', $meta_key);
        });
    }

    public function metaCreateOrUpdate($input)
    {
        $input['meta_key'] = $this->table;
        $input['object_id'] = $this->id;

        if ($this->meta) {
            return $this->meta->update($input);
        }
        return $this->meta()->create($input);
    }
}
