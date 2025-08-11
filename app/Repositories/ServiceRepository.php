<?php

namespace App\Repositories;

 use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(Service $model)
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

        $avatar = '';
        if (isset($data['avatar'])) {
            $avatar = $data['avatar'];
            unset($data['avatar']);
        }

        $newModel = $this->model->create($data);

        if (!empty($data['meta_data'])) {
            $newModel->metaCreateOrUpdate($data['meta_data']);
        }

        if ($avatar) {
            $newModel->uploadImage($newModel, null, $avatar, 'avatar');
        }

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;
        $avatar = '';
        if (isset($data['avatar'])) {
            $avatar = $data['avatar'];
            unset($data['avatar']);
        }

        $item->update($data);
        if ($avatar) {
            $item->uploadImage($item, null, $avatar, 'avatar');
        }
        if (!empty($data['meta_data'])) {
            $item->metaCreateOrUpdate($data['meta_data']);
        }

        return $item;
    }

    public function delete($id)
    {
        $item = $this->find($id);
    
        $avatarPath = $item->avatar;
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
        if (isset($params['created_at'])) {
            $active = $params['created_at'];
            $query->where('created_at', $active);
        }

        $query->orderByMultipleColumns(['position'], 'asc');

        return $query->get();
    }

    public function lastUpdated()
    {
        return $this->model->getLastUpdatedDate();
    }

    public function bySlug($slug)
    {
        $item = $this->model
            ->where('slug', $slug)
            ->first();
        return $item;
    }

    public function filterFrontEnd(array $filters = [])
    {
        $query = $this->model->query();

        $now = Carbon::now()->format('Y-m-d H:i:s');
        if ($filters['active']) {
            $query =  $query->active();
        }

        if (isset($filters['not_in_id']) && $filters['not_in_id']) {
            $query =  $query->where('id', '!=', $filters['not_in_id']);
        }
        $columns = [
            'id'
        ];

        $query->orderByMultipleColumns($columns, 'DESC');

        return $query->get();
    }
}
