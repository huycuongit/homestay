<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use Carbon\Carbon;

class BranchRepository implements BranchRepositoryInterface
{
    protected $model;

    public function __construct(Branch $model)
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
        $data['created_by_id'] = Auth::user()->id;

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
            $directoryParts = [
                'branches',
                "branch-{$newModel->id}",
                'avatar'
            ];
            $newModel->uploadImage($newModel, $directoryParts, $avatar, 'avatar');
        }

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['updated_by_id'] = Auth::user()->id;

        $avatar = '';
        if (isset($data['avatar'])) {
            $avatar = $data['avatar'];
            unset($data['avatar']);
        }

        $item->update($data);
        if ($avatar) {
            $directoryParts = [
                'branches',
                "branch-{$item->id}",
                'avatar'
            ];
            $item->uploadImage($item, $directoryParts, $avatar, 'avatar');
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

    public function filter(array $filters)
    {
        $query = $this->model->query();

        if (isset($filters['active'])) {
            $active = $filters['active'];
            $query->where('active', $active);
        }

        return $query->get();
    }

    public function filterBranch(array $filters)
    {
        $query = $this->model->query();

        if (isset($filters['active'])) {
            $active = $filters['active'];
            $query->where('active', $active);
        }

        if (isset($filters['branch_ids'])) {
            $branchIds = $filters['branch_ids'];
            if ($branchIds != 'Admin') {
                $query->whereIn('id', $branchIds);
            }
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
                    ->orWhere("sort_name", "like", "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%")
                    ->orWhere('slug', 'like', "%$keyword%");
            });
        }

        if (isset($params['created_at'])) {
            $createdAt = Carbon::parse($params['created_at'])->format('Y-m-d');
            $query->whereDate('created_at', $createdAt);
        }

        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        if (isset($params['created_at'])) {
            $createdAt = Carbon::parse($params['created_at'])->format('Y-m-d');
            $query->whereDate('created_at', $createdAt);
        }

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }

    public function filterFrontEnd(array $filters = [])
    {
        $query = $this->model->query();
        $query->active();

        if (isset($filters['province_id'])) {
            $provinceId = $filters['province_id'];
            $query->where('province_id', $provinceId);
        }

        if (isset($filters['district_id'])) {
            $districtId = $filters['district_id'];
            $query->where('district_id', $districtId);
        }

        if (isset($filters['ward_id'])) {
            $wardId = $filters['ward_id'];
            $query->where('ward_id', $wardId);
        }

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

        if (isset($filters['event_type'])) {
            $isOnline = $filters['event_type'] == 'online' ? 1 : 2;
            $query->where('is_online', $isOnline);

            if ($isOnline == 2) {
                if (isset($filters['province_id'])) {
                    $provinceId = $filters['province_id'];
                    $query->where('province_id', $provinceId);
                }

                if (isset($filters['district_id'])) {
                    $districtId = $filters['district_id'];
                    $query->where('district_id', $districtId);
                }

                if (isset($filters['ward_id'])) {
                    $wardId = $filters['ward_id'];
                    $query->where('ward_id', $wardId);
                }
            }
        }

        if (isset($filters['start_time']) && isset($filters['end_time'])) {
            $startTime = $filters['start_time'];
            $endTime = $filters['end_time'];

            $startTimeFormatted = Carbon::createFromFormat('d/m/Y', $startTime)->startOfDay()->toDateTimeString();
            $endTimeFormatted = Carbon::createFromFormat('d/m/Y', $endTime)->endOfDay()->toDateTimeString();

            $query->where(function ($queryChildren) use ($startTimeFormatted, $endTimeFormatted) {
                // $queryChildren->where('start_time', '>=', $startTimeFormatted)
                //       ->where('start_time', '<=', $endTimeFormatted);
                $queryChildren->whereBetween('start_time', [$startTimeFormatted, $endTimeFormatted]);
            });
        }

        return $query->paginate($perPage);
    }

    public function getAllData(array $filter)
    {
        $query = $this->model->select('*')
            ->where('active',  $filter['active']);
        $admin = Auth::user();
        $branchByAdmin = getBranches();

        if ($branchByAdmin) {
            if ($admin->user_name != "Admin") {
                $query->whereIn('id', $branchByAdmin);
            }
        }

        $data = $query->orderBy('id', 'asc')->get();
        return $data ?? false;
    }

    public function filterSelect(array $filters = [])
    {
        $query = $this->model->query();

        $admin = Auth::user();
        $branchByAdmin = getBranches();

        if ($branchByAdmin) {
            if ($admin->user_name != "Admin") {
                $query->whereIn('id', $branchByAdmin);
            }
        }
        if (isset($filters['is_classroom'])) {
            $query->withCount([
                'classrooms as total_classroom' => function ($q5) {
                    $q5->where('active', 1)
                    ->whereHas('classType', function ($q6) {
                        $q6->whereIn('key', [ONE_PRIVATE, ONE_GENERAL]);
                        $q6->where('active', 1);
                    });
                }
            ]);
        }
        
        if (isset($filters['is_instruments'])) {
            $query->withCount([
                'classrooms as total_instruments' => function ($q5) {
                    $q5->whereHas('classType', function ($q6) {
                    $q6->whereIn('key', [ONE_PRIVATE, ONE_GENERAL]);
                        $q6->where('active', 1);
                    })
                    ->whereHas('instruments', function ($q7) {
                        $q7->where('active', 1);
                    });
                }
            ]);
        }
        

        if (isset($filters['active'])) {
            $active = $filters['active'];
            $query->where('active', $active);
        }

        if (isset($filters['branch_ids'])) {
            $branchIds = $filters['branch_ids'];
            if ($branchIds != 'Admin') {
                $query->whereIn('id', $branchIds);
            }
        }

        return $query->get();
    }
}
