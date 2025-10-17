<?php

namespace App\Repositories\Ward;

use App\Models\Ward;
use  App\Models\District;
use Carbon\Carbon;

class WardRepository implements WardRepositoryInterface
{

    protected $model;

    public function __construct(Ward $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return Ward::class;
    }

    public function getAllData()
    {
        $sql = $this->model->select('*')->get();
        return $sql ?? false;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function datatable($input = array())
    {
        $sql = $this->model;

        if (empty($input)) {
            return Ward::count();
        }

        $start = array_key_exists('start', $input) ? $input['start'] : 0;
        $limit = array_key_exists('length', $input) ? $input['length'] : 0;

        $sql = $sql->select('*')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($limit > 0) {
            $sql = $sql->skip($start)->take($limit);
        }

        if (array_key_exists('keyword', $input)) {
            $keyword = $input['keyword'];
            $sql = $sql->where(function ($subKey) use ($keyword) {
                $subKey->orWhere('name', 'LIKE', "%$keyword%")
                    ->orWhere('division_type', 'LIKE', "%$keyword%")
                    ->orWhere('district_code', 'LIKE', "%$keyword%");
            });
        }

        if (array_key_exists('active', $input)) {
            if (!is_null($input['active']) && $input['active'] != 'all') {
                $active = $input['active'];
                $sql = $sql->where('active', $active);
            }
        }

        $data = $sql->get();
        return $limit > 0 ? $data : count($data);
    }

    public function create(array $input)
    {
        $isCheck = District::where('code', $input['district_code'])->first();
        if ($isCheck) {
            $input['active'] = !empty($input['active']) ? 1 : 0;
            return $this->model->create($input);
        }
        return false;
    }

    public function update($id, array $input)
    {
        $isCheck = District::where('code', $input['district_code'])->first();

        if ($isCheck) {
            $model = $this->model->find($id);
            return $model->update($input);
        }
        return false;
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        $input['active'] = 0;
        return $model->update($input);
    }

    public function restore($id)
    {
        $model = $this->model->find($id);
        $input['active'] = 1;
        $now = Carbon::now();
        $input['active_at'] = $now;
        return $model->update($input);
    }

    public function whereCodeNotId($code, $id)
    {
        return $this->model->where('code', $code)
            ->where('id', '<>', $id)
            ->first();
    }

    public function getWardFromDistrict($district_code = 0)
    {
        $data = $this->model
                ->where('district_code', $district_code)
                ->get();
        return $data;
    }
}
