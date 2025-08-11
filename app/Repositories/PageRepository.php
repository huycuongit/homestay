<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    public function getBanners($key) {
        $page = $this->findByKey($key);
        if ($page && count($page->images) > 0) {
            $images = $page->images->sortBy('position');
            return [
                'desktop_banner' => $images->where('type', Image::DESKTOP_IMAGE)->first(),
                'tablet_banner' => $images->where('type', Image::TABLET_IMAGE)->first(),
                'mobile_banner' => $images->where('type', Image::MOBILE_IMAGE)->first()
            ];
        }

        return [];
    }

    public function create(array $data)
    {
        $data['active'] = isset($data['active']) ? 1 : 0;

        $newModel = $this->model->create($data);
        if (!empty($data['meta_data'])) {
            $newModel->metaCreateOrUpdate($data['meta_data']);
        }

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;
        $item->update($data);
 
        if (isset($data['image_ids'])) {
            $item->images()->sync($data['image_ids']);
        }
        if (!empty($data['meta_data'])) {
            $item->metaCreateOrUpdate($data['meta_data']);
        }

        return $item;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function filter(array $params)
    {
        $query = $this->model->query();

        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            });
        }

        if(isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        $query->orderByMultipleColumns(['position'], 'asc');
        
        return $query->get();
    }

    public function datatables(array $params)
    {
        $query = $this->model->query();
        
        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            });
        }

        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }

    public function lastUpdated()
    {
        return $this->model->getLastUpdatedDate();
    }
}
