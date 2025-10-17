<?php

namespace App\Http\Controllers\Admin\Province;

use App\Http\Controllers\Controller;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Models\Province;
// use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DataTables;

class ProvinceController extends Controller
{
    protected $province;

    public function __construct(
        ProvinceRepositoryInterface $province,
    )
    {
        $this->province = $province;
    }

    public function index()
    {
        return view('admin.provinces.index');
    }

    public function datatables(Request $request)
    {
        $input = $request->all();
        $inputFilter = Arr::except($input, ['start', 'length']);

        $data = $this->province->datatable($input);

        $recordsTotal = $this->province->datatable();
        $recordsFiltered = $this->province->datatable($inputFilter);
        return [
            'length' => $request->length,
            'start' => $request->start,
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ];
    }

    public function create()
    {
        return view('admin.provinces.form');
    }

    public function store(Request $request)
    {
        $input = $request->only(
            'code',
            'name',
            'division_type',
            'codename',
            'phone_code',
            'order',
            'active'
        );

        $existingProvince = $this->province->whereCodeNotId($input['code'], '');

        if ($existingProvince) {
            session()->flash('error', 'Mã tỉnh đã tồn tại.');
            return redirect()->back();
        }

        $phoneCodes = (array)$input['phone_code'];
        $existingPhoneCode = $this->province->wherePhoneNotIn($phoneCodes, '');
        if ($existingPhoneCode) {
            session()->flash('error', 'Mã điện thoại tồn tại.');
            return redirect()->back();
        }

        $this->province->create($input);

        return redirect()->route('admin.provincess.index');
    }

    public function edit($id)
    {
        $province = $this->province->find($id);

        return view('admin.provinces.form', compact('province'));
    }

    public function view($id)
    {
        $province = $this->province->find($id);

        return view('admin.provinces.view', compact('province'));
    }

    public function update($id, Request $request)
    {
        $input = $request->only(
            'code',
            'name',
            'division_type',
            'codename',
            'phone_code',
            'order',
            'active'
        );

        $existingProvince = $this->province->whereCodeNotId($input['code'], $id);

        if ($existingProvince) {
            session()->flash('error', 'Mã tỉnh đã tồn tại.');
            return redirect()->back();
        }

        $phoneCodes = (array)$input['phone_code'];

        $existingPhoneCode = $this->province->wherePhoneNotIn($phoneCodes, $id);
        if ($existingPhoneCode) {
            session()->flash('error', 'Mã điện thoại tồn tại.');
            return redirect()->back();
        }

        $province = $this->province->find($id);
        if ($province) {
            $this->province->update($id, $input);
            session()->flash('success', 'Cập nhật thành công');
        } else {
            session()->flash('success', 'Không tìm thấy tỉnh.');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->province->destroy($id);

        $response = [
            'success' => true,
            'message' => 'Cập nhật thành công'
        ];

        return response()->json($response);
    }

    public function restore($id)
    {
        $this->province->restore($id);

        $response = [
            'success' => true,
            'message' => 'Cập nhật thành công'
        ];

        return response()->json($response);
    }

    public function getActive()
    {
        $data = $this->province->getAllData();
        return response()->json($data);
    }

    public function show($id)
    {
        $province = Province::with('wards')->findOrFail($id);
        return response()->json($province);
    }
}
