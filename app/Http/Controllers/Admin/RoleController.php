<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Repositories\RoleRepositoryInterface;

use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;

use DataTables;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();

        $data = [
            'permissions' => $permissions
        ];

        return view('admin.roles.index')
            ->with($data);
    }

    public function create()
    {
        $data = [
        ];

        return view('admin.roles.form')
            ->with($data);
    }

    public function show($id)
    {
        $data = $this->roleRepository->find($id);
        return view('admin.roles.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();
        $query = $this->roleRepository->datatables($params);
        return DataTables::of($query)
            ->addColumn('created_name', function ($data) {
                return $data->userCreated ? $data->userCreated->name : 'Đang cập nhật...';
            })
            ->addColumn('updated_name', function ($data) {
                return $data->userUpdated ? $data->userUpdated->name : 'Đang cập nhật...';
            })
            ->addColumn('action', function ($data) {
                return true;
            })
            ->addColumn('created_name', function ($data) {
                return $data->userCreated ? $data->userCreated->name : 'Đang cập nhật...';
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = $this->roleRepository->find($id);

        $params = [
            'data' => $data,
        ];

        return view('admin.roles.form')
            ->with($params);
    }

    public function store(RoleStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->roleRepository->create($data);
        $id = $new->id;
        return redirect()->route('admin.roles.edit', ['id' => $id])->with('success', NOTIFICATION_CREATED_SUCCESS);
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->roleRepository->update($id, $data);
        return redirect()->route('admin.roles.edit', ['id' => $id])->with('success', NOTIFICATION_UPDATED_SUCCESS);
    }

    public function destroy($id)
    {
        $this->roleRepository->delete($id);
        return response()->json(['message' => NOTIFICATION_DELETED_SUCCESS], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $events = $this->roleRepository->filter($filters);
        return view('admin.roles.index', compact('events'));
    }

    public function permissions()
    {
        $data = $this->roleRepository->permissions();
        return $data;
    }

    public function getAll(Request $request)
    {
        $filters = ['active' => 1];

        $data = $this->roleRepository->filter(array_merge($filters, $request->all()));
        
        return response()->json($data);    
    }
}
