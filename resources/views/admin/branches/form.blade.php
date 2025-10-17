@extends('admin.layouts.master')

@push('meta')
@endpush

@section('css')
@endSection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" id="form-form"
            action="{{ isset($branch) ? route('admin.branches.update', $branch->id) : route('admin.branches.store') }}">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ isset($branch) ? (request()->has('is_view') ? 'Thông tin chi nhánh' : 'Cập nhật chi nhánh') : 'Tạo mới chi nhánh' }}
                    </h3>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary float-end">Lưu</button>
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-label-secondary float-end me-2">Huỷ</a>
                </div>
            </div>

            <div class="row mb-6" style="pointer-events: {{ request()->has('is_view') ? 'none' : 'unset' }}">
                @csrf
                @if (isset($branch))
                    @method('PUT')
                @endif

                @include('admin.layouts.partials.messages')

                <div class="col-12">
                    <div class="card mb-6">
                        <h5 class="card-header">Thông tin chi nhánh</h5>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Tên chi nhánh <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $branch->name ?? '') }}" placeholder="Tên chi nhánh" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', $branch->phone ?? '') }}" placeholder="Số điện thoại">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="province_id" class="form-label">Tỉnh / Thành <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="province_id" name="province_id">
                                        <option disabled selected>Chọn Tỉnh / Thành</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id', $branch->province_id ?? '') == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="ward_id" class="form-label">Phường / Xã <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="ward_id" name="ward_id">
                                        <option disabled selected>Chọn Phường / Xã</option>
                                        @if (isset($wards))
                                            @foreach ($wards as $ward)
                                                <option value="{{ $ward->id }}"
                                                    {{ old('ward_id', $branch->ward_id ?? '') == $ward->id ? 'selected' : '' }}>
                                                    {{ $ward->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- Địa chỉ cụ thể --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Địa chỉ cụ thể <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $branch->address ?? '') }}"
                                        placeholder="VD: 123 Nguyễn Trãi, Q.1, TP.HCM">
                                </div>
                            </div>

                            {{-- Link Google Map --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="google_map_link" class="form-label">Link Google Map</label>
                                    <input type="url" class="form-control" id="google_map_link" name="google_map_link"
                                        value="{{ old('google_map_link', $branch->google_map_link ?? '') }}"
                                        placeholder="https://maps.google.com/...">
                                </div>
                            </div>

                            {{-- Mô tả --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi nhánh...">{{ old('description', $branch->description ?? '') }}</textarea>
                                </div>
                            </div>

                            {{-- Active --}}
                            <div class="row mb-3 dayone-control-active">
                                <div class="col-md-6 p-3">
                                    <div class="text-light small fw-medium mb-2">Kích hoạt</div>
                                </div>
                                <div class="col-md-6 p-3">
                                    <div class="form-check form-switch mb-2 dayone-active">
                                        <input class="form-check-input" type="checkbox" id="active" name="active"
                                            value="1" {{ old('active', $branch->active ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="get-province-url" value="{{ route('admin.provinces.show', ['id' => '_province_id']) }}">

@endsection

@push('js')
    <script>
        $(function() {
            $('#province_id').change(function() {
                var provinceId = $(this).val();
                if (!provinceId) return;

                // Lấy base URL từ hidden input và thay placeholder
                var baseUrl = $('#get-province-url').val().replace('_province_id', provinceId);

                $.ajax({
                    url: baseUrl,
                    method: 'GET',
                    success: function(data) {
                        $('#ward_id').empty().append(
                            '<option disabled selected>Chọn Phường / Xã</option>');
                        if (data.wards && data.wards.length > 0) {
                            data.wards.forEach(function(ward) {
                                $('#ward_id').append('<option value="' + ward.id +
                                    '">' + ward.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
