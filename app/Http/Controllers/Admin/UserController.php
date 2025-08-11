<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\BranchRepositoryInterface;

use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    protected $branchRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository,
        BranchRepositoryInterface $branchRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->branchRepository = $branchRepository;
    }

    public function index()
    {
        $userBranches = getBranches();
        $filterBranch = [
            'active' => ACTIVE,
            'branch_ids' => $userBranches
        ];
        $filter = [
            'active' => ACTIVE
        ];
        $roles = $this->roleRepository->filter($filter);
        $branches = $this->branchRepository->filterBranch($filterBranch);
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();

        // TODO Ajax
        $users = $this->userRepository->all()->count();
        $userActive = $this->userRepository->filter(['active' => 1])->count();
        $userInActive = $this->userRepository->filter(['active' => 0])->count();

        $data = [
            'roles' => $roles,
            'users' => $users,
            'branches' => $branches,
            'userActive' => $userActive,
            'userInActive' => $userInActive,
            'permissions' => $permissions
        ];

        return view('admin.users.index')
            ->with($data);
    }

    public function create()
    {
        $filter = [
            'active' => ACTIVE
        ];

        $roles = $this->roleRepository->filter($filter);
        $branches = $this->branchRepository->filter($filter);

        $data = [
            'departments' => $departments,
            'roles' => $roles,
            'branches' => $branches
        ];

        return view('admin.users.form')
            ->with($data);
    }

    public function show($id)
    {
        $data = $this->userRepository->find($id);
        return view('admin.users.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $filter = [
            'active' => ACTIVE
        ];
        $params = $request->input();
        $allBranches = $this->branchRepository->filter($filter);
        $query = $this->userRepository->datatables($params);
        return DataTables::of($query)
            ->addColumn('role_ids', function ($data) {
                $roleIds = $data->roles->pluck('id')->toArray();
                return $roleIds;
            })
            ->addColumn('roles', function ($data) {
                $roles = $data->roles->pluck('name')->toArray();
                return implode(', ', $roles);
            })
            ->addColumn('branch_ids', function ($data) {
                $branchIds = $data->branches->pluck('id')->toArray();
                return $branchIds;
            })
            ->addColumn('branches', function ($data) use ($allBranches) {
                if (count($data->branches) == count($allBranches)) {
                    $branches = 'Tất cả';
                } else {
                    $branches = $data->branches->pluck('name')->toArray();
                    $branches = implode(', ', $branches);
                }
                return $branches;
            })
            ->addColumn('department_name', function ($data) {
                return $data->department ? $data->department->name : '';
            })
            ->addColumn('action', function ($data) {
                return true;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $filter = [
            'active' => ACTIVE
        ];

        $data = $this->userRepository->find($id);
        $departments = $this->departmentRepository->filter($filter);
        $roles = $this->roleRepository->filter($filter);
        $branches = $this->branchRepository->filter($filter);

        $metaData = $data->meta;

        $params = [
            'data' => $data,
            'departments' => $departments,
            'roles' => $roles,
            'branches' => $branches,
            'metaData' => $metaData
        ];

        return view('admin.users.form')
            ->with($params);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->userRepository->create($data);
        $id = $new->id;
        if ($request->ajax()) {
            return response()->json(['message' => NOTIFICATION_CREATED_SUCCESS, 'id' => $id], 200);
        }

        return redirect()->route('admin.users.edit', ['id' => $id])->with('success', NOTIFICATION_CREATED_SUCCESS);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->userRepository->update($id, $data);
        if ($request->ajax()) {
            return response()->json(['message' => NOTIFICATION_UPDATED_SUCCESS, 'id' => $id], 200);
        }
        return redirect()->route('admin.users.edit', ['id' => $id])->with('success', NOTIFICATION_UPDATED_SUCCESS);
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return response()->json(['message' => NOTIFICATION_DELETED_SUCCESS], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $events = $this->userRepository->filter($filters);
        return view('admin.users.index', compact('events'));
    }

    public function getAll(Request $request)
    {
        $filters = ['active' => 1];
        $data = $this->userRepository->filter(array_merge($filters, $request->all()));

        return response()->json($data);
    }
}
