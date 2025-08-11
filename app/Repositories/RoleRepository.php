<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\Role;
use App\Models\Permission;


class RoleRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
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
        if (isset($data['permissions'])) {
            $newModel->permissions()->sync($data['permissions']);
        }
        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;
        
        $item->update($data);

        if (isset($data['permissions'])) {
            $item->permissions()->sync($data['permissions']);
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
        $query->withCount(['admins as total_employees']);
        
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

        if (isset($params['user_id'])) {
            $userId = $params['user_id'];
            $query->whereHas('admins', function($q) use ($userId) {
                $q->where('admin_id', $userId);
            });
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

    public function permissions()
    {
        $permissions = Permission::all()
            ->groupBy('module_name')
            ->map(function ($modulePermissions, $module) {
                return [
                    'module' => $module,
                    'permissions' => $modulePermissions->map(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'module' => $permission->module,
                            'method_name' => $permission->method_name,
                        ];
                    })
                ];
            })->values();
        return response()->json($permissions);
    }
}
