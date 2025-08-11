<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\NewsRepositoryInterface;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Http\Requests\Admin\NewsUpdateRequest;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;


class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    ) {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $filter = [
            'active' => ACTIVE
        ];


        $permissions = Auth::user()->getAllCheckPermissions()->toArray();
        $data = [
            'permissions' => $permissions,
            'newsCategories' => []
        ];
        return view('admin.news.index')
            ->with($data);
    }

    public function create()
    {
        $filter = [
            'active' => ACTIVE
        ];

        $data = [
            'newsCategories' => []
        ];

        return view('admin.news.form')
            ->with($data);
    }

    public function show($id)
    {
        $data = $this->newsRepository->find($id);
        return view('admin.news.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();
        $query = $this->newsRepository->datatables($params);
        return DataTables::of($query)
            ->addColumn('created_name', function ($data) {
                return $data->userCreated ? $data->userCreated->name : 'Đang cập nhật...';
            })
            ->addColumn('updated_name', function ($data) {
                return $data->userUpdated ? $data->userUpdated->name : 'Đang cập nhật...';
            })
            ->addColumn('news_category', function ($data) {
                return $data->category ? $data->category->name : 'Đang cập nhật...';
            })
            ->addColumn('action', function ($data) {
                return true;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = $this->newsRepository->find($id);
        $filter = [
            'active' => ACTIVE
        ];


        $metaData = $data->meta;
        $params = [
            'data' => $data,
            'metaData' => $metaData,
            'newsCategories' => []
        ];
        return view('admin.news.form')
            ->with($params);
    }

    public function store(NewsStoreRequest $request)
    {
        $data = $request->input();
        $new = $this->newsRepository->create($data);
        $id = $new->id;
        if ($request->ajax()) {
            return response()->json([
                'message' => NOTIFICATION_CREATED_SUCCESS,
                'id' => $id
            ], 200);
        }
        return redirect()->route('admin.news.edit', [
            'id' => $id
        ])->with(
            'success',
            NOTIFICATION_CREATED_SUCCESS
        );
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->newsRepository->update($id, $data);
        if ($request->ajax()) {
            return response()->json([
                'message' => NOTIFICATION_UPDATED_SUCCESS,
                'id' => $id
            ], 200);
        }
        return redirect()->route(
            'admin.news.edit',
            [
                'id' => $id
            ]
        )->with('success', NOTIFICATION_UPDATED_SUCCESS);
    }

    public function destroy($id)
    {
        $this->newsRepository->delete($id);
        return response()->json(
            [
                'message' => NOTIFICATION_DELETED_SUCCESS
            ],
            200
        );
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $events = $this->newsRepository->filter($filters);
        return view('admin.news.index', compact('events'));
    }

    public function getActive()
    {
        $filter = [
            'active' => ACTIVE
        ];
        $data = $this->newsRepository->getAllData($filter);
        return response()->json($data);
    }
}
