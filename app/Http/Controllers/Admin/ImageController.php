<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageStoreRequest;
use App\Http\Requests\Admin\ImageUpdateRequest;
use App\Models\Image;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    protected $repository;
    protected $galleryRepository;

    public function __construct(
        ImageRepositoryInterface $repository,
        GalleryRepositoryInterface $galleryRepository,
    )
    {
        $this->repository = $repository;
        $this->galleryRepository = $galleryRepository;
    }

    public function index()
    {
        $filter = [
            'active' => 1
        ];
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();
        $data = [
            'permissions' => $permissions,
            'galleries' => $this->galleryRepository->all()
        ];
        return view('admin.images.index')
            ->with($data);
    }

    public function create()
    {
        $filter = [
            'active' => 1
        ];
        $data = [
            'galleries' => $this->galleryRepository->all()
        ];

        return view('admin.images.form', $data);
    }

    public function show($id)
    {
        $data = $this->repository->find($id);
        return view('admin.images.form', compact('data'));
    }

    public function datatables(Request $request)
    {
        $params = $request->input();

        $query = $this->repository->datatables($params);

        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                return true;
            })
            // ->addColumn('type_name', function ($data) {
            //     $types = Image::getAllType();
            //     return $types[$data->type] ?? 'Unknown';
            // })
            ->make(true);
    }



    public function edit($id)
    {
        $data = $this->repository->find($id);
        $filter = [
            'active' => 1
        ];
        $metaData = $data->meta;
        $permissions = Auth::user()->getAllCheckPermissions()->toArray();
        $params = [
            'data' => $data,
            'metaData' => $metaData,
            'galleries' => $this->galleryRepository->all(),
            'permissions' => $permissions,

        ];
        return view('admin.images.form')
            ->with($params);
    }

    public function store(ImageStoreRequest $request)
    {
        $data = $request->input();
        $frequentQuestion = $this->repository->create($data);
        $id = $frequentQuestion->id;
        return redirect()->route('admin.images.edit', ['id' => $id])->with('success', 'Tạo thành công.');
    }

    public function update(ImageUpdateRequest $request, $id)
    {
        $data = $request->input();
        $this->repository->update($id, $data);
        return redirect()->route('admin.images.edit', ['id' => $id])->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['message' => 'Xóa tài nguyên thành công'], 200);
    }

    public function filter(Request $request)
    {
        $filters = $request->all();
        $eduProDocuments = $this->repository->filter($filters);
        return view('admin.images.index', compact('eduProDocuments'));
    }
}
