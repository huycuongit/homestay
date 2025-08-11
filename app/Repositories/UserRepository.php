<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Admin;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
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

    public function bySlug($slug)
    {
        $item = $this->model
            ->where('slug', $slug)
            ->first();
        return $item;
    }

    public function create(array $data)
    {
        $data['active'] = isset($data['active']) ? 1 : 0;
        $newModel = $this->model->create($data);

        if (isset($data['roles'])) {
            $newModel->roles()->sync($data['roles']);
        }

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;

        if (empty($data['password'])) {
            unset($data['password']);
        }
        $item->update($data);

        if (isset($data['roles'])) {
            $item->roles()->sync($data['roles']);
        }

        return $item;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function filter(array $filters)
    {
        $query = $this->model->query();

        if ($filters['active']) {
            $active = $filters['active'];
            $query->where('active', $active);
        }

        return $query->get();
    }

    public function datatables(array $params)
    {
        $query = $this->model->query();

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('user_name', 'like', "%$keyword%");
            });
        }

        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        if (isset($params['department_id']) && $params['department_id']) {
            $departmentId = $params['department_id'];
            $query->where('department_id', $departmentId);
        }

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }

    public function filterFrontEnd(array $filters = [])
    {
        $query = $this->model->query();
        $query->active();

        $columns = [
            'id'
        ];

        $query->orderByMultipleColumns($columns, 'DESC');

        return $query->get();
    }

    public function filterFrontEndPagination(array $filters = [], $perPage = 6)
    {
        $query = $this->model->query();
        $query->active();

        return $query->paginate($perPage);
    }
}
