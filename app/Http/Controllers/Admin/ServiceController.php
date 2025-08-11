<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Repositories\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    protected $repository;

    public function __construct(
        ServiceRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $filter = [
            'active' => 1
        ];
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();
        $data = [
            'permissions' => $permissions,
        ];
        return view('admin.services.index')
            ->with($data);
    }

    public function create()
    {
        $filter = [
            'active' => 1
        ];

        return view('admin.services.form');
    }

    public function show($id)
    {
        $data = $this->repository->find($id);
        return view('admin.services.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();

        $query = $this->repository->datatables($params);

        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                return true;
            })
            ->make(true);
    }



    public function edit($id)
    {
        $data = $this->repository->find($id);
        $metaData = $data->meta;

        $params = [
            'data' => $data,
            'metaData' => $metaData
        ];

        return view('admin.services.form')
            ->with($params);
    }

    public function store(ServiceStoreRequest $request)
    {
        $data = $request->input();
        $privacyPolicie = $this->repository->create($data);
        $id = $privacyPolicie->id;
        
        return redirect()->route('admin.services.edit', ['id' => $id])->with('success', 'Tạo thành công.');
    }

    public function update(ServiceUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->repository->update($id, $data);

        return redirect()->route('admin.services.edit', ['id' => $id])->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(['message' => 'Xóa tài nguyên thành công'], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $privacyPolicies = $this->repository->filter($filters);

        return view('admin.services.index', compact('privacyPolicies'));
    }
}
