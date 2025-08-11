<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\GalleryStoreRequest;
use App\Http\Requests\Admin\GalleryUpdateRequest;
use App\Repositories\GalleryRepositoryInterface;
use DataTables;

class GalleryController extends Controller
{
    protected $repository;

    public function __construct(
        GalleryRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function index()
    {
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();

        $data = [
            'permissions' => $permissions
        ];

        return view('admin.galleries.index')
            ->with($data);
    }

    public function create()
    {
        $data = [
        ];

        return view('admin.galleries.form')
            ->with($data);
    }

    public function show($id)
    {
        $data = $this->repository->find($id);
        return view('admin.galleries.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();
        $query = $this->repository->datatables($params);
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
        $data = $this->repository->find($id);

        $params = [
            'data' => $data,
        ];

        return view('admin.galleries.form')
            ->with($params);
    }

    public function store(GalleryStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->repository->create($data);
        $id = $new->id;
        if ($request->ajax()) {
            return response()->json(['message' => NOTIFICATION_CREATED_SUCCESS, 'id' => $id], 200);
        }
        return redirect()->route('admin.galleries.edit', ['id' => $id])->with('success', NOTIFICATION_CREATED_SUCCESS);
    }

    public function update(GalleryUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->repository->update($id, $data);
        if ($request->ajax()) {
            return response()->json(['message' => NOTIFICATION_UPDATED_SUCCESS, 'id' => $id], 200);
        }
        return redirect()->route('admin.galleries.edit', ['id' => $id])->with('success', NOTIFICATION_UPDATED_SUCCESS);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['message' => NOTIFICATION_DELETED_SUCCESS], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $events = $this->repository->filter($filters);
        return view('admin.galleries.index', compact('events'));
    }

    public function permissions()
    {
        $data = $this->repository->permissions();
        return $data;
    }

    public function getAll(Request $request)
    {
        $filters = ['active' => 1];

        $data = $this->repository->filter(array_merge($filters, $request->all()));
        
        return response()->json($data);    
    }
}
