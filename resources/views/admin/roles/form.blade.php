@extends('admin.layouts.master')

@push('meta')
@endpush

@section('css')
@endSection

@push('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/spinkit/spinkit.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- /. Vendors CSS -->

    <!-- Fixedcolumns && Fixedheader -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
    <!-- /. Fixedcolumns && Fixedheader -->

    <style>
        .dayone-active {
            float: right;
        }

        .dayone-control-active {
            border-top: 1px solid #d7d5d5;
        }

        .dt-action-buttons {
            margin-top: 1.5em !important;
        }

        .alert-danger {
            margin-bottom: 10px !important;
        }

        .dayone-alert {}

        .dayone-alert-heading {
            font-size: 13px;
        }

        .dayone-error-item {
            font-size: 13px;
        }

        .dayone-modal-body {
            text-align: center;
        }

        .modal-title-destroy .dayone-modal-footer {
            justify-content: center;
        }

        .dayone-offcanvas {
            /* position: relative; */
        }

        .dayone-form {
            position: relative;
        }

        .dayone-spinner-border {
            position: absolute;
            top: 50%;
            right: 50%;
        }

        .dayone-blur-effect {
            filter: blur(5px);
            pointer-events: none;
        }

        .dayone-badge-center {
            height: 4rem;
            width: 4rem;
        }

        .dayone-badge-center i {
            font-size: 3.5rem;
        }

        /* Adjust icon size for Toastr notifications */
        .toast-success .toast-icon,
        .toast-info .toast-icon,
        .toast-warning .toast-icon,
        .toast-error .toast-icon {
            font-size: 14px;
            /* Điều chỉnh kích thước icon */
            width: 14px;
            /* Điều chỉnh chiều rộng của icon */
            height: 14px;
            /* Điều chỉnh chiều cao của icon */
            line-height: 14px;
            /* Điều chỉnh dòng của icon */
        }

        /* Adjust the padding to align the text properly */
        .toast-message {
            padding-left: 20px;
            /* Điều chỉnh khoảng cách padding trái */
        }

        /* Ensure the icons are aligned properly */
        .toast-success .toast-icon,
        .toast-info .toast-icon,
        .toast-warning .toast-icon,
        .toast-error .toast-icon {
            margin-right: 10px;
            /* Điều chỉnh khoảng cách bên phải của icon */
        }

        .dayone-left {
            min-height: 100vh;
        }

        .dayone-left .card {
            min-height: 100vh;
        }

        .permissions-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .permission-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }

        .dayone-alert-page {
            margin-bottom: 25px !important;
            width: calc(100% - 20px);
            margin: auto;
        }

        .dataTables_info {
            display: block;
        }

        .btn-cancel {
            margin-right: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" id="form-form"
            action="{{ isset($data) ? route('admin.roles.update', ['id' => $data->id]) : route('admin.roles.store') }}">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ isset($data) ? (request()->has('is_view') ? 'Thông tin role' : 'Cập nhật role') : 'Tạo mới role' }}
                    </h3>
                </div>
                @if (!request()->has('is_view'))
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-end">Lưu</button>
                        <button type="button" data-url="{{ route('admin.roles.index') }}"
                            class="btn btn-label-secondary waves-effect float-end btn-cancel">
                            Huỷ
                        </button>
                    </div>
                @else
                    <div class="col-md-4">
                        <button type="button" data-url="{{ route('admin.roles.edit', ['id' => $data->id]) }}"
                            class="btn btn-primary waves-effect waves-light float-end btn-edit">
                            Chỉnh sửa
                        </button>
                    </div>
                @endif
            </div>
            <div class="row mb-6" style="pointer-events: {{ request()->has('is_view') ? 'none' : 'unset' }}">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif
                <!-- Messages -->
                @include('admin.layouts.partials.messages')
                <!--- /. Messages -->

                <!-- Info Role -->
                <div class="col-md-4 mb-4 mb-md-0 dayone-left">
                    <div class="card">
                        <h5 class="card-header">Thông tin Role</h5>
                        <div class="card-body">

                            <div class="mb-6">
                                <label class="form-label" for="bs-validation-name">Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="John Doe" value="{{ isset($data) ? $data->name : old('name') }}" />
                            </div>
                            {{-- <div class="mb-6">
                                <label class="form-label" for="bs-validation-country">Phòng ban <span class="text-danger">*</span></label>
                                <select class="form-select" id="department_id" name="department_id">
                                    <option value="">Vui lòng lòng chọn phòng ban</option>
                                    @if (isset($departments))
                                        @foreach ($departments as $kD => $vD)
                                            <option value="{{ $vD->id }}"
                                                {{ isset($data) && $data->department_id == $vD->id ? 'selected' : '' }}>
                                                {{ $vD->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="mb-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="active" name="active"
                                        {{ isset($data) ? ($data->active == 1 ? 'checked' : '') : 'checked' }} required />
                                    <label class="form-check-label" for="active">Kích hoạt</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. Info Role -->

                <!-- Info Permission -->
                <div class="col-md-8 dayone-left">
                    <div class="card">
                        <h5 class="card-header">Phân quyền</h5>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-12">
                                    <label for="department_id"><i class="fa-solid fa-user-secret"></i> Danh sách
                                        quyền</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="search"
                                            placeholder="Tìm kiếm phân quyền ...">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <label><input type="checkbox" id="select-all" name="full_permission" value="1">
                                        Toàn quyền tính năng <i class="fa-solid fa-shield-virus"></i></label>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="permissions-table" class="table table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="100">Toàn quyền tính năng
                                                    <i class="menu-icon tf-icons ti ti-info-square-rounded"></i>
                                                </th>
                                                <th>
                                                    <label>
                                                        <input type="checkbox" class="form-check-input" id="select-all"
                                                            name="full_permission" value="1">
                                                        Chọn tất cả
                                                    </label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="mb-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="bs-validation-checkbox" required />
                                    <label class="form-check-label" for="bs-validation-checkbox">Agree to our terms and
                                        conditions</label>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- /. Info Permission -->
            </div>
        </form>
    </div>

    <!-- Default Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="mt-4">
            <!-- Modal -->
            <div class="modal fade" id="modal-destroy" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body dayone-modal-body">
                            <form id="form-destroy" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <span class="badge badge-center rounded-pill bg-danger bg-glow dayone-badge-center"><i
                                        class="ti ti-trash"></i></span>
                                <p class="modal-title-destroy fs-4 fw-bold"></p>
                                <p class="modal-title-warning"></p>
                            </form>
                        </div>
                        <div class="modal-footer dayone-modal-footer justify-content-center">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Huỷ
                            </button>
                            <button type="button" class="btn btn-danger btn-destroy-modal">
                                Xoá
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- url action -->
    <input type="hidden" value="{{ route('admin.roles.permissions') }}" id="url-datatable-permission" />
    <input type="hidden" value="{{ route('admin.users.datatables') }}" id="url-datatable-user" />
    <input type="hidden" value="{{ route('admin.users.edit', ['id' => '_id']) }}" id="url-edit-user" />
    <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="role-id">
    <input type="hidden" id="user-permissions" value="{{ isset($data) ? json_encode($data->permissions->pluck('id')->toArray()) : '' }}">
    <!-- /. url action -->
@endSection

@section('js')
@endSection

@push('js')
    <!-- Vendor in page -->
    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <!-- /. Vendor in page -->

    <!-- Plugin Toastr -->
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <!-- /. Plugin Toastr -->

    <!-- Index JS -->
    <script>
        function submitForm() {
            const _form = document.getElementById('form-form');
            let fv;

            $(_form).on('submit', function(event) {
                if (!fv) {
                    fv = FormValidation.formValidation(_form, {
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng nhập tên role'
                                    }
                                }
                            },
                            department_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng chọn phòng ban'
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                eleValidClass: '',
                                rowSelector: function(field, ele) {
                                    return '.mb-6';
                                }
                            }),
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        }
                    });
                }
                event.preventDefault();

                fv.validate().then(function(status) {
                    if (status === 'Valid') {
                        _form.submit();
                    }
                }).catch(function(error) {
                    console.error('Validation error:', error);
                });
            });
        }

        function getPermissions() {
            var _actionURL = $('#url-datatable-permission').val();
            var dataPermissions = $('#user-permissions').val() ? JSON.parse($('#user-permissions').val()) : [];
            console.log(dataPermissions);

            var table = $('#permissions-table').DataTable({
                ajax: {
                    url: _actionURL,
                    dataSrc: function(json) {
                        var data = [];
                        json.forEach(function(moduleData) {
                            var permissionsHtml = '<div class="permissions-container">';
                            permissionsHtml +=
                                '<div><label><input type="checkbox" class="check-all-module form-check-input" data-module="' +
                                moduleData.permissions[0].module + '"> Tất cả </label></div>';
                            moduleData.permissions.forEach(function(permission) {
                                var isChecked = dataPermissions.includes(permission.id);
                                permissionsHtml +=
                                    '<div class="permission-item"><label><input type="checkbox" name="permissions[]" value="' +
                                    permission.id +
                                    '" class="module-children form-check-input module-' +
                                    permission.module +
                                    '"' +
                                    'data-module="' +
                                    permission.module +
                                    '"' +
                                    (isChecked ? ' checked' : '') +
                                    '> ' +
                                    permission.method_name +
                                    '</label></div>';
                            });
                            permissionsHtml += '</div>';
                            data.push({
                                module: `<span class="text-primary">${moduleData.module}</span>`,
                                permissions: permissionsHtml
                            });
                        });
                        return data;
                    }
                },
                columns: [{
                        data: 'module',
                        name: 'module',
                        width: '300px'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                paging: false,
                autoWidth: false,
                dom: 'rtip',
                search: 'true',
                initComplete: function() {
                    // Gắn sự kiện change cho các checkbox module và check-all
                    $(document).on('change', '.check-all-module', function() {
                        var module = $(this).data('module');
                        $('.module-children.module-' + module).prop('checked', $(this).prop('checked'));
                        checkSelectAll();
                    });

                    $(document).on('change', '.module-children', function() {
                        var module = $(this).data('module');
                        var anyUnchecked = $('.module-children[data-module="' + module +
                            '"]:not(:checked)').length > 0;
                        $('.check-all-module[data-module="' + module + '"]').prop('checked', !
                            anyUnchecked);
                        checkSelectAll();
                    });

                    // Thiết lập trạng thái của checkbox "Tất cả" khi bảng được tải lại
                    $('.check-all-module').each(function() {
                        var module = $(this).data('module');
                        var allChecked = $('.module-children[data-module="' + module +
                            '"]:not(:checked)').length === 0;
                        $(this).prop('checked', allChecked);
                    });

                    // Gọi hàm checkSelectAll để kiểm tra trạng thái của checkbox "Toàn quyền tính năng"
                    checkSelectAll();
                }
            });

            $('#search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Sự kiện thay đổi cho checkbox của mỗi module
            $(document).on('change', '.check-all-module', function() {
                var module = $(this).data('module');
                $('.module-' + module).prop('checked', $(this).prop('checked'));
                checkSelectAll();
            });

            // Sự kiện thay đổi cho checkbox con trong module
            $(document).on('change', '.module-children', function() {
                var module = $(this).data('module');
                var anyUnchecked = $('.module-children[data-module="' + module + '"]:not(:checked)').length > 0;
                $('.check-all-module[data-module="' + module + '"]').prop('checked', !anyUnchecked);
                checkSelectAll();
            });

            // Sự kiện thay đổi cho tất cả các checkbox của quyền
            $(document).on('change', 'input[type="checkbox"][name^="permissions"]', function() {
                checkSelectAll();
            });

            // Sự kiện thay đổi cho checkbox "Toàn quyền tính năng"
            $(document).on('change', '#select-all', function() {
                var isChecked = $(this).prop('checked');
                $('input[type="checkbox"][name^="permissions"]').prop('checked', isChecked);
                $('.check-all-module').prop('checked', isChecked);
            });

            // Hàm kiểm tra trạng thái của checkbox "Toàn quyền tính năng"
            function checkSelectAll() {
                var allChecked = $('input[type="checkbox"][name^="permissions"]').length === $(
                    'input[type="checkbox"][name^="permissions"]:checked').length;
                $('#select-all').prop('checked', allChecked);
            }

            // Gọi hàm checkSelectAll khi trang được tải
            checkSelectAll();
        }

        function btnAll() {
            $('.btn-cancel').on('click', function(e) {
                e.preventDefault();
                var _actionURL = $(this).attr('data-url');
                window.location.href = _actionURL;
            });

            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var _actionURL = $(this).attr('data-url');
                window.location.href = _actionURL;
            });
        }

        $(function() {
            submitForm();
            getPermissions();
            btnAll();
        });
    </script>
    <!-- /. Index JS -->
@endpush
