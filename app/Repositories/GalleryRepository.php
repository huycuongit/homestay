<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use COM;
use Illuminate\Support\Facades\DB;

class GalleryRepository implements GalleryRepositoryInterface
{
    protected $model;

    public function __construct(Gallery $model)
    {
        $this->model = $model;
    }

    public function filterList(array $filters)
    {
        $query = $this->model->query();
        $query->active();

        return $query->get();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $query = $this->model->query();
        return $query->findOrFail($id);
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

        $avatar = '';
        $newModel = $this->model->create($data);

        return $newModel;
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $data['active'] = isset($data['active']) ? 1 : 0;

        $item->update($data);

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

        if (isset($filters['status_account'])) {
            $statusAccount = $filters['status_account'];
            $query->where('status_account', $statusAccount);
        }

        if (isset($filters['coach_type'])) {
            $coachType = $filters['coach_type'];
            $query->whereHas('coachType', function ($q) use ($coachType) {
                $q->whereIn('key', $coachType);
            });
        }
        $reports = $query->get();

        return $reports;
    }


    public function datatables(array $params)
    {
        $query = $this->model->query();

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            });
        }

        if (isset($params['active'])) {
            $active = $params['active'];
            $query->where('active', $active);
        }

        if (isset($params['created_at'])) {
            $createdAt = Carbon::parse($params['created_at'])->format('Y-m-d');
            $query->whereDate('report_date', $createdAt);
        }

        if (isset($params['quarter'])) {
            $quarter = $params['quarter'];
            $query->where('quarter', $quarter);
        }


        if (isset($params['report_type_id'])) {
            $report_type_id = $params['report_type_id'];
            $query->where('report_type_id', $report_type_id);
        }

        $query->orderByMultipleColumns(['id'], 'desc');

        return $query->get();
    }
}