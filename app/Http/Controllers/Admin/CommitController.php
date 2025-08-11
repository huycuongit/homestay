<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommitStoreRequest;
use App\Http\Requests\Admin\CommitUpdateRequest;
use App\Repositories\CommitRepositoryInterface;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;

class CommitController extends Controller
{
    protected $commitRepository;

    public function __construct(
        CommitRepositoryInterface $commitRepository,
    )
    {
        $this->commitRepository = $commitRepository;
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
        return view('admin.commits.index')
            ->with($data);
    }

    public function datatables(Request $request)
    {
        $params = $request->input();
        $query = $this->commitRepository->datatables($params);
        
        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                return true;
            })
            ->addColumn('created_by_name', function ($data) {
                return isset($data->admin) ? $data->admin->name : null;
            })
            ->addColumn('updated_by_name', function ($data) {
                return isset($data->adminUpdate) ? $data->adminUpdate->name : null;
            })
            
            ->make(true);
    }

     /**
     * Show the profile for a given user.
     *
     * @param
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $filter = [
            'active' => 1
        ];
        $data = [
        ];

        return view('admin.commits.form')
            ->with($data);
    }

     /**
     * Show the profile for a given user.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function store(CommitStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->commitRepository->create($data);
        
        $id = $new->id;
        return redirect()->route('admin.commits.edit', ['id' => $id])->with('success', 'Tạo thành công.');
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data = $this->commitRepository->find($id);

        return view('admin.commits.partials.detail', compact('data'))->render();

    }

     /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->commitRepository->find($id);
        $metaData = $data->meta;
        $filter = [
            'active' => 1
        ];

        $params = [
            'data' => $data,
            'metaData' => $metaData
        ];

        return view('admin.commits.form')
            ->with($params);
    }

     /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function update($id, CommitUpdateRequest $request)
    {
        $data = $request->input();
        $this->commitRepository->update($id, $data);
        return redirect()->route(
            'admin.commits.edit',
            [
                'id' => $id
            ]
        )->with('success', 'Cập nhật thành công.');
    }

     /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $this->commitRepository->delete($id);
        return response()->json(['message' => 'Xóa tài nguyên thành công'], 200);
    }
}
