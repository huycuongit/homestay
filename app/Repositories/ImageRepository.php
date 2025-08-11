<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
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

    public function create(array $data)
    {
        $data['active'] = isset($data['active']) ? 1 : 0;

        $url = '';
        if (isset($data['url'])) {
            $url = $data['url'];
            unset($data['url']);
        }

        $newModel = $this->model->create($data);
        if ($url) {
            $newModel->uploadImage($newModel, null, $url, 'url');
        }
        if (!empty($data['meta_data'])) {
            $newModel->metaCreateOrUpdate($data['meta_data']);
        }

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;
        $url = '';
        if (isset($data['url'])) {
            $url = $data['url'];
            unset($data['url']);
        }

        $item->update($data);
        if ($url) {
            $item->uploadImage($item, null, $url, 'url');
        }
        if (!empty($data['meta_data'])) {
            $item->metaCreateOrUpdate($data['meta_data']);
        }

        return $item;
    }

    public function delete($id)
    {
        $item = $this->find($id);
    
        $avatarPath = $item->url;
        if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
            Storage::disk('public')->delete($avatarPath);
        }
    
        return $item->delete();
    }

    public function filter(array $params)
    {
        $query = $this->model->query();

        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            });
        }

        if(isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }
        if(isset($params['gallery_id']) && $params['gallery_id'] != 'all') {
            $gallery_id = $params['gallery_id'];
            $query->where('gallery_id', $gallery_id);
        }

        $query->orderByMultipleColumns(['position'], 'asc');
        
        return $query->get();
    }

    public function datatables(array $params)
    {
        $query = $this->model->query()->with('gallery');
        
        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            });
        }

        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        if (isset($params['gallery_id'])) {
            $gallery_id = $params['gallery_id'];
            $query->where('gallery_id', $gallery_id);
        }

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }

    public function lastUpdated()
    {
        return $this->model->getLastUpdatedDate();
    }
}
