<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Http\Request;
use Datatables;

class PageController extends Controller
{
    protected $pageRepository;
    protected $imageRepository;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        ImageRepositoryInterface $imageRepository
    )
    {
        $this->pageRepository = $pageRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $filter = [
            'active' => 1
        ];
        $images = $this->imageRepository->filter($filter);


        return view('admin.pages.index', $images);
    }

    public function create()
    {
        $filter = [
            'active' => 1
        ];

        return view('admin.pages.form');
    }

    public function show($id)
    {
        $data = $this->pageRepository->find($id);
        return view('admin.pages.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();

        $query = $this->pageRepository->datatables($params);

        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                return true;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = $this->pageRepository->find($id);
        $metaData = $data->meta;
        $images = $this->imageRepository->filter(['active' => 1]);
        $params = [
            'data' => $data,
            'images' => $images,
            'metaData' => $metaData
        ];

        return view('admin.pages.form', $data)
            ->with($params);
    }

    public function store(PrivacyPolicyStoreRequest $request)
    {
        $data = $request->input();
        $privacyPolicie = $this->pageRepository->create($data);
        $id = $privacyPolicie->id;
        
        return redirect()->route('admin.pages.edit', ['id' => $id])->with('success', 'Tạo thành công.');
    }

    public function update(PageUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->pageRepository->update($id, $data);

        return redirect()->route('admin.pages.edit', ['id' => $id])->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $this->pageRepository->delete($id);

        return response()->json(['message' => 'Xóa tài nguyên thành công'], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $privacyPolicies = $this->pageRepository->filter($filters);

        return view('admin.pages.index', compact('privacyPolicies'));
    }
}
