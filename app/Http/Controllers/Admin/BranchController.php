<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BranchRepositoryInterface;
use App\Http\Requests\Admin\BranchStoreRequest;
use App\Http\Requests\Admin\BranchUpdateRequest;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;


class BranchController extends Controller
{
    protected $branchRepository;

    public function __construct(
        BranchRepositoryInterface $branchRepository
    ) {
        $this->branchRepository = $branchRepository;
    }

    public function index()
    {
        $permissions = Auth::user()->getAllCheckPermissions()
            ->toArray();
        $data = [
            'permissions' => $permissions
        ];
        return view('admin.branchs.index')
            ->with($data);
    }

    public function create()
    {
        $data = [];
        return view('admin.branchs.form')
            ->with($data);
    }

    public function show($id)
    {
        $data = $this->branchRepository->find($id);
        return view('admin.branchs.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();
        $query = $this->branchRepository->datatables($params);
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
            ->addColumn('full_address', function ($data) {
                return $data->full_address ? $data->full_address : 'Đang cập nhật...';
            })
            ->addColumn('booking_exits', function ($data) {
                return $data->booking_exits ? $data->booking_exits : 0;
            })
            ->addColumn('booking_future', function ($data) {
                return $data->booking_future ? $data->booking_future : 0;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = $this->branchRepository->find($id);
        $metaData = $data->meta;
        $params = [
            'data' => $data,
            'metaData' => $metaData
        ];
        return view('admin.branchs.form')
            ->with($params);
    }

    public function store(BranchStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->branchRepository->create($data);
        $id = $new->id;
        if ($request->ajax()) {
            return response()->json([
                'message' => NOTIFICATION_CREATED_SUCCESS,
                'id' => $id
            ], 200);
        }
        return redirect()->route('admin.branchs.edit', [
            'id' => $id
        ])->with(
            'success',
            NOTIFICATION_CREATED_SUCCESS
        );
    }

    public function update(BranchUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->branchRepository->update($id, $data);
        if ($request->ajax()) {
            return response()->json([
                'message' => NOTIFICATION_UPDATED_SUCCESS,
                'id' => $id
            ], 200);
        }
        return redirect()->route(
            'admin.branchs.edit',
            [
                'id' => $id
            ]
        )->with('success', NOTIFICATION_UPDATED_SUCCESS);
    }

    public function destroy($id)
    {
        $this->branchRepository->delete($id);
        return response()->json(
            [
                'message' => NOTIFICATION_DELETED_SUCCESS
            ], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $events = $this->branchRepository->filter($filters);
        return view('admin.branchs.index', compact('events'));
    }

    public function getActive()
    {
        $filter = [
            'active' => ACTIVE
        ];
        $data = $this->branchRepository->getAllData($filter);
        return response()->json($data);
    }
}
