<?php

namespace App\Http\Controllers\Admin\Ward;

use App\Http\Controllers\Controller;
use App\Repositories\Ward\WardRepositoryInterface;
use App\Models\District;
use App\Models\Ward;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WardController extends Controller
{
    private $ward;

    public function __construct(
        WardRepositoryInterface $ward,
    )
    {
        $this->ward = $ward;
    }

    public function index()
    {
        return view('admin.wards.index');
    }

    public function datatables(Request $request)
    {
        $input = $request->all();
        $inputFilter = Arr::except($input, ['start', 'length']);

        $data = $this->ward->datatable($input);

        $recordsTotal = $this->ward->datatable();
        $recordsFiltered = $this->ward->datatable($inputFilter);
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
        return view('admin.wards.form');
    }

    public function store(Request $request)
    {
        $input = $request->only(
            'code',
            'name',
            'division_type',
            'codename',
            'district_code',
            'order',
            'active'
        );

        $existingWard = $this->ward->whereCodeNotId($input['code'], '');

        if ($existingWard) {
            session()->flash('error', 'Mã phường xã đã tồn tại.');
            return redirect()->back();
        }

        $status = $this->ward->create($input);

        if (!$status) {
            session()->flash('error', 'Mã quận không tồn tại.');
            return redirect()->back();
        }

        return redirect()->route('admin.wardss.index');
    }

    public function edit($id)
    {
        $ward = $this->ward->find($id);

        return view('admin.wards.form', compact('ward'));
    }

    public function view($id)
    {
        $ward = $this->ward->find($id);

        return view('admin.wards.view', compact('ward'));
    }

    public function update($id, Request $request)
    {
        $input = $request->only(
            'code',
            'name',
            'division_type',
            'codename',
            'district_code',
            'order',
            'active'
        );

        $ward = $this->ward->find($id);

        if (!$ward) {
            session()->flash('error', 'Không tìm thấy id cập nhật');
            return redirect()->back();
        }

        $existingWard = $this->ward->whereCodeNotId($input['code'], $id);

        if ($existingWard) {
            session()->flash('error', 'Mã phường xã đã tồn tại.');
            return redirect()->back();
        }

        $status = $this->ward->update($id, $input);

        if (!$status) {
            session()->flash('error', 'Mã quận không tồn tại.');
            return redirect()->back();
        }

        session()->flash('success', 'Cập nhật thành công');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->ward->destroy($id);

        $response = [
            'success' => true,
            'message' => 'Cập nhật thành công'
        ];

        return response()->json($response);
    }

    public function restore($id)
    {
        $this->ward->restore($id);

        $response = [
            'success' => true,
            'message' => 'Cập nhật thành công'
        ];

        return response()->json($response);
    }

    public function getWard($districtICode)
    {
        $districtICode = $districtICode ??  0;
        $data = $this->ward->getWardFromDistrict($districtICode);
        return response()->json($data);
    }
}
