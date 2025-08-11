<?php

namespace App\Repositories;

use App\Models\Commit;
use Illuminate\Support\Facades\Storage;

class CommitRepository implements CommitRepositoryInterface
{
    protected $model;

    public function __construct(Commit $model)
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
        $news = '';
        if (isset($data['icon'])) {
            $news = $data['icon'];
            unset($data['icon']);
        }

        $newModel = $this->model->create($data);

        if (!empty($data['meta_data'])) {
            $newModel->metaCreateOrUpdate($data['meta_data']);
        }

        if ($news) {
            $newModel->uploadImage($newModel, null, $news, 'icon');
        }
        if (!empty($data['meta_data'])) {
            $newModel->metaCreateOrUpdate($data['meta_data']);
        }
        return $newModel;
    }

    public function update($id, array $data)
    {
        $event = $this->find($id);
        $news = '';
        if (isset($data['icon'])) {
            $news = $data['icon'];
            unset($data['icon']);
        }
        $data['active'] = isset($data['active']) ? 1 : 0;
        $event->update($data);
        if ($news) {
            $event->uploadImage($event, null, $news, 'icon');
        }
        if (!empty($data['meta_data'])) {
            $event->metaCreateOrUpdate($data['meta_data']);
        }
        return $event;
    }

    public function delete($id)
    {
        $item = $this->find($id);
    
        $avatarPath = $item->icon;
        if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
            Storage::disk('public')->delete($avatarPath);
        }
    
        return $item->delete();
    }

    public function filter(array $filters)
    {
        $query = $this->model->query();

        if($filters['active']) {
            $active = $filters['active'];
            $query->where('active', $active);
        }
        
        return $query->get();
    }

    public function datatables(array $params)
    {
        $query = $this->model->query();

        $this->_filter($query, $params);

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }

    public function filterFrontEnd(array $filters = [])
    {
        $query = $this->model->query();
        $this->_filter($query, $filters);

        $columns = [
            'position'
        ];

        $query->orderByMultipleColumns($columns, 'ASC');
        
        return $query->get();
    }

    public function filterFrontEndPagination(array $filters = [], $perPage = 6)
    {
        $query = $this->model->query();
        $query->active();
        
        return $query->paginate($perPage);
    }

    private function _filter(&$query, $params) {
                
        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            });
        }
        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }
        if (isset($params['created_at'])) {
            $createdAt = $params['created_at'];
            $query->where('created_at', $createdAt);
        }
    }
}
