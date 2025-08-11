@extends('admin.layouts.master')

@push('meta')
    <meta name="linkGetProvince" content="{{ route('admin.provinces.active') }}" />
    <meta name="linkGetDistrict" content="{{ route('admin.districts.active', ['provinceCode' => '_provinceCode']) }}" />
    <meta name="linkGetWard" content="{{ route('admin.wards.active', ['districtCode' => '_districtCode']) }}" />
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
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Table & Filter -->
        <div class="card">
            <!-- Filter -->
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Tìm kiếm</h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <input class="form-control" type="text" value="" id="keyword"
                                placeholder="Tìm kiếm theo tên, mô tả,..">
                        </div>
                        {{-- <div class="col-md-3 mb-4">
                            <select class="form-select" id="filter_news_category_id" aria-label="Default select example">
                                <option value="" selected="">Tất cả danh mục bài viết</option>
                                viết
                                @if (isset($newsCategories) && count($newsCategories) > 0)
                                    @foreach ($newsCategories as $keyB => $valueB)
                                        <option value="{{ $valueB->id }}">{{ $valueB->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div> --}}
                        <div class="col-md-3 mb-4">
                            <select class="form-select" id="filter_active" aria-label="Default select example">
                                <option value="" selected="">Trạng thái</option>
                                <option value="0">Không Kích hoạt</option>
                                <option value="1">Kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <input class="form-control" type="date" value="" id="filter_date"
                                placeholder="dd/mm/yyyy">
                        </div>
                        <div class="col-md-3 mb-4">
                            <button type="button" class="btn btn-success waves-effect waves-light btn-filter">
                                <i class="ti ti-filter ti-md"></i> Lọc
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /. Filter -->

            <!-- Table -->
            <div class="card-datatable table-responsive">
                <table class="dt-fixedcolumns show-datatables table text-nowrap">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            {{-- <th>Tên danh mục</th> --}}
                            <th>Ngày đăng bài</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /. Table -->

            <!-- Offcanvas to Add -->
            <div class="offcanvas offcanvas-end dayone-offcanvas" tabindex="-1" id="canvas-form"
                aria-labelledby="offcanvasFormLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasFormLabel" class="offcanvas-title ">Tạo mới bài viết </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100 dayone-form">
                    <div class="spinner-border text-primary dayone-spinner-border d-none" role="status"
                        style="position: absolute;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="alert alert-danger mb-0 alert-dismissible dayone-alert d-none" role="alert">
                        <h5 class="alert-heading mb-2 dayone-alert-heading ">
                            <i class="ti ti-ban"></i>
                            Thông tin dữ liệu không hợp lệ
                        </h5>
                        <div class="demo-inline-spacing">
                            <ul class="list-group list-group-flush dayone-errors">
                                <li class="list-group-item dayone-error-item">An item</li>
                                <li class="list-group-item dayone-error-item">A second item</li>
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form class="pt-0" id="form-form" method="POST" action="" enctype="multipart/form-data"
                        onsubmit="return false">
                        @csrf
                        <div class="mb-6">
                            <label class="form-label" for="name">
                                Tên bài viết
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên bài viết" aria-label="Tên bài viết" />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="province_id">
                                Tỉnh/Thành
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="province_id" name="province_id"
                                aria-label="Default select example">
                                <option value="" disabled>Chọn Tỉnh/Thành</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="district_id">
                                Quận/Huyện
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="district_id" name="district_id"
                                aria-label="Default select example">
                                <option value="" disabled>Chọn Quận/Huyện</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="ward_id">
                                Phường/Xã
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="ward_id" name="ward_id"
                                aria-label="Default select example">
                                <option value="" disabled>Chọn Phường/Xã</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="address">Địa chỉ chi tiết
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="Nhập địa chỉ chi tiết" aria-label="Nhập địa chỉ chi tiế" />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="sort_name">Tên viết tắt</label>
                            <input type="text" id="sort_name" name="sort_name" class="form-control"
                                placeholder="Nhập tên viết tắt" aria-label="Nhập tên viết tắt" />
                        </div>
                        <div class="row dayone-control-active">
                            <div class="col-sm-6 p-6">
                                <div class="text-light small fw-medium mb-4">Kích hoạt</div>
                            </div>
                            <div class="col-sm-6 p-6">
                                <div class="form-check form-switch mb-2 dayone-active">
                                    <input class="form-check-input" type="checkbox" id="active" name="active"
                                        checked>
                                </div>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-label-secondary btn-dayone-close"
                            data-bs-dismiss="offcanvas">Huỷ</button>
                        <button type="submit" class="btn btn-primary me-3 data-submit btn-dayone-submit">Lưu</button>
                        @if (in_array('admin.news.edit', $permissions))
                            <button type="button" class="btn btn-primary me-3 move-edit d-none">Chỉnh sửa</button>
                        @endif
                    </form>
                </div>
            </div>
            <!-- /. Offcanvas to Add -->
        </div>
        <!-- /. Table & Filter -->
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

    <!-- URL action -->
    <input type="hidden" value="{{ route('admin.news.datatables') }}" id="url-datatable" />
    <input type="hidden" value="{{ route('admin.news.show', ['id' => '_id']) }}" id="url-show" />
    <input type="hidden" value="{{ route('admin.news.create') }}" id="url-create" />
    <input type="hidden" value="{{ route('admin.news.edit', ['id' => '_id']) }}" id="url-edit" />
    <input type="hidden" value="{{ route('admin.news.update', ['id' => '_id']) }}" id="url-update" />
    <input type="hidden" value="{{ route('admin.news.store') }}" id="url-store" />
    <input type="hidden" value="{{ route('admin.news.destroy', ['id' => '_id']) }}" id="url-destroy" />
    <input hidden id="province_load" value="{{ isset($data) ? $data->province_id : '' }}" />
    <input hidden id="district_load" value="{{ isset($data) ? $data->district_id : '' }}" />
    <input hidden id="ward_load" value="{{ isset($data) ? $data->ward_id : '' }}" />
    <input type="hidden" id="user-permissions" value="{{ json_encode($permissions) }}">
    <!-- /. URL action -->
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
        function getData() {
            var permissions = JSON.parse($('#user-permissions').val());
            let borderColor, bodyBg, headingColor;

            if (isDarkStyle) {
                borderColor = config.colors_dark.borderColor;
                bodyBg = config.colors_dark.bodyBg;
                headingColor = config.colors_dark.headingColor;
            } else {
                borderColor = config.colors.borderColor;
                bodyBg = config.colors.bodyBg;
                headingColor = config.colors.headingColor;
            }

            var _idDatatables = $('.show-datatables');
            var _actionURL = $('#url-datatable').val();
            var _actionEditURL = $('#url-update').val();

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var _ajax = {
                url: _actionURL,
                mothod: "GET",
                data: function(d) {
                    d.keyword = $('#keyword').val() ? $('#keyword').val() : '';
                    d.active = $('#filter_active').val() ? $('#filter_active').val() : '';
                    d.news_category_id = $('#filter_news_category_id').val() ? $('#filter_news_category_id').val() :
                        '';
                    d.created_at = $('#filter_date').val() ? $('#filter_date').val() : '';
                }
            };

            var _columns = [{
                    data: "id",
                    orderable: false,
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    },
                    render: function() {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input" >';
                    },
                    searchable: false
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    },
                    searchable: false,
                    orderable: true
                },
                {
                    "data": "name",
                    "render": function(data, type, row) {
                        var _warningNow = '';
                        if (row.booking_future > 0) {
                            _warningNow +=
                                `<p><label class="form-label text-danger">Có buổi học đang và sắp diễn ra.</label></p>`;
                        }
                        return `<a href="#" class="text-primary btn-view">${data}</a> ${_warningNow}`;
                    }
                },
                // {
                //     "data": "news_category"
                // },
                {
                    "data": "publish_time",
                    "render": function(data, type, row) {
                        var _formatFullTime = 'DD/MM/YYYY HH:mm:ss';
                        var _formattedDateTime = moment(data).format(_formatFullTime);
                        return _formattedDateTime;
                    }
                },
                {
                    "data": "created_name"
                },
                {
                    "data": "created_at",
                    "render": function(data, type, row) {
                        var _formatFullTime = 'DD/MM/YYYY HH:mm:ss';
                        var _formatDay = 'DD/MM/YYYY';
                        var _formattedDateTime = moment(data).format(_formatDay);
                        return _formattedDateTime;
                    }
                },
                {
                    "data": "active",
                    "render": function(data, type, row) {
                        var _active = '<span class="badge bg-label-success">Kích hoạt</span>';
                        var _inActive = '<span class="badge bg-label-secondary">Không kích hoạt</span>';
                        var _final = _active;
                        if (data !== 1) {
                            _final = _inActive;
                        }
                        return _final;
                    }
                },
                {
                    data: 'action',
                    render: function(data, type, full, meta) {
                        var _actionStart = '<div class="d-flex align-items-center">';

                        var _actionEdit =
                            permissions.includes('admin.news.edit') ?
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record btn-edit"><i class="ti ti-edit ti-md"></i></a>' :
                            '';

                        var _actionDelete =
                            permissions.includes('admin.news.destroy') ?
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record btn-destroy"><i class="ti ti-trash ti-md"></i></a>' :
                            '';

                        var _actionMore =
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<a href="javascript:;"" class="dropdown-item">Edit</a>' +
                            '<a href="javascript:;" class="dropdown-item">Suspend</a>' +
                            '</div>';

                        var _actionEnd = '</div>';

                        var _actionFull = _actionStart;
                        _actionFull += _actionDelete;
                        _actionFull += _actionEdit;
                        _actionFull += _actionEnd;

                        return (
                            _actionFull
                        )
                    }
                }
            ];

            var _responsive = {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            return col.title !==
                                '' // ? Do not show row in modal popup if title is blank (for check box)
                                ?
                                '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            };

            // var _order = [
            //     [2, 'desc']
            // ];

            var _dom = '<"row"' +
                '<"col-md-2"<"ms-n2"l>>' +
                '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"fB>>' +
                '>t' +
                '<"row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>';

            var _language = {
                sLengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Tìm kiếm tên bài viết',
                paginate: {
                    next: '<i class="ti ti-chevron-right ti-sm"></i>',
                    previous: '<i class="ti ti-chevron-left ti-sm"></i>'
                },
                emptyTable: "Không có dữ liệu phù hợp",
                zeroRecords: "Không tìm thấy bản ghi nào"
            };

            var _buttons = [];

            if (permissions.includes('admin.news.create')) {
                _buttons.push({
                    text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tạo mới</span>',
                    className: 'add-new btn btn-primary waves-effect waves-light btn-add',
                });
            }

            var dt_fixedcolumns_table = $('.dt-fixedcolumns');
            var _table = $(_idDatatables).DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": _ajax,
                "columns": _columns,
                "paging": true,
                "lengthChange": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                // "order": _order,
                "dom": _dom,
                "language": _language,
                "buttons": _buttons,
                "searching": false,
                "fixedColumns": true,
                "fixedColumns": {
                    leftColumns: 3
                },
                // scrollY: 300,
                "scrollX": true,
                // scrollCollapse: true,
                // "initComplete": function(settings, json) {
                //     // dt_fixedcolumns_table.find('tbody tr:second').addClass('border-top-0');
                // }
            });

            $('.btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
            });

            $('#keyword').on('keyup', function() {
                _idDatatables.DataTable().ajax.reload();
            });

            toastr.options = {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                showDuration: 300,
                hideDuration: 1000,
                timeOut: 3000,
                extendedTimeOut: 1000,
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut',
                positionClass: 'toast-top-right',
                rtl: true
            };

            const _form = document.getElementById('form-form');

            const fv = FormValidation.formValidation(_form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập tên bài viết'
                            },
                        }
                    },
                    province_id: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn Tỉnh/Thành'
                            },
                        }
                    },
                    district_id: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn Quận/Huyện'
                            }
                        }
                    },
                    ward_id: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng chọn Phường/Xã'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập địa chỉ chi tiết'
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
                    autoFocus: new FormValidation.plugins.AutoFocus()
                }
            });

            $(_form).on('submit', function(event) {
                event.preventDefault();
                $('.dayone-alert').addClass('d-none');

                fv.validate().then(function(status) {
                    $('.dayone-spinner-border').removeClass('d-none');
                    if (status === 'Valid') {
                        $('#canvas-form').addClass('dayone-blur-effect');
                        var _formData = $(_form).serialize();
                        console.log(_formData);
                        var _actionURL = $(_form).attr('action');
                        $.ajax({
                            type: 'POST',
                            url: _actionURL,
                            data: _formData,
                            dataType: 'json',
                            success: function(response) {
                                console.log('Success:', response);
                                toastr.success(response.message);
                                $('.dayone-alert').addClass('d-none');
                                $('.dayone-spinner-border').addClass('d-none');
                                $('#canvas-form').removeClass('dayone-blur-effect');
                                _form.reset();
                                _idDatatables.DataTable().ajax.reload();
                                setTimeout(() => {
                                    $('#canvas-form').offcanvas('hide');
                                }, 1000);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    var errors = xhr.responseJSON.errors;
                                    var errorHtml = '';

                                    $('.dayone-errors').empty();
                                    $.each(errors, function(key, value) {
                                        errorHtml +=
                                            '<li class="list-group-item dayone-error-item">' +
                                            value + '</li>';
                                    });

                                    $('.dayone-errors').append(errorHtml);
                                    $('.dayone-alert').removeClass('d-none');
                                    $('.dayone-spinner-border').addClass('d-none');
                                    $('#canvas-form').removeClass('dayone-blur-effect');
                                    toastr.success(response.message);
                                } else {
                                    toastr.success(response.message);
                                }
                            }
                        });
                    } else {
                        toastr.success(response.message);
                        $('.dayone-spinner-border').addClass('d-none');
                        $('#canvas-form').removeClass('dayone-blur-effect');
                    }
                }).catch(function(error) {
                    console.error('Validation error:', error);
                    // toastr.error('Đã có lỗi xảy ra trong quá trình validate form.');
                    $('.dayone-spinner-border').addClass('d-none');
                    $('#canvas-form').removeClass('dayone-blur-effect');
                });
            });

            $('.btn-add').on('click', function(e) {
                e.preventDefault();
                var _form = $('#form-form');
                var _actionURL = $('#url-create').val();
                window.location.href = _actionURL;
            });

            (_idDatatables).on('click', '.btn-view', function() {
                var _form = $('#form-form');
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId) + '?is_view=true';
                window.location.href = _actionURL;
            });

            $(_idDatatables).on('click', '.btn-edit', function() {
                var _form = $('#form-form');
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                window.location.href = _actionURL;
            });

            $(_idDatatables).on('click', '.btn-destroy', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                $('.modal-title-destroy').html(`Bạn có chắc chắn muốn xóa bài viết? <br> "${data.name}"`)
                $('.modal-title-warning').html('Lưu ý các dữ liệu liên quan sẽ bị xóa!');
                var _actionURL = $('#url-destroy').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                $('#form-destroy').attr('action', _actionURL);
                $('#modal-destroy').modal('show');
            });

            $('.btn-destroy-modal').on('click', function() {
                var _formDestroy = $('#form-destroy');
                var _actionURL = _formDestroy.attr('action');
                var method = _formDestroy.attr('method');
                $.ajax({
                    url: `${_actionURL}`,
                    type: 'DELETE',
                    data: _formDestroy.serialize(),
                    success: function(data) {
                        $('#modal-destroy').modal('hide');
                        toastr.success(data.message);
                        _idDatatables.DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        $('#modal-destroy').modal('hide');
                        toastr.error(data.message);
                        console.error(error);
                    }
                });
            });

            setTimeout(() => {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 300);
        }

        function selectAddress(provinceId, districtId, wardId, callback) {
            // Load Provinces when view - edit
            var _linkGetProvince = $('meta[name="linkGetProvince"]').attr('content');
            $.ajax({
                url: _linkGetProvince,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#province_id').empty();
                    $('#province_id').append(
                        '<option value="" selected="" disabled>Chọn Tỉnh / Thành</option>');
                    data.forEach(function(province) {
                        var selected = (provinceId && provinceId == province.id) ? 'selected' : '';
                        $('#province_id').append(
                            `<option value="${province.id}" data-code="${province.code}" ${selected}>${province.name}</option>`
                        );
                    });
                    // Trigger Change
                    if (provinceId) {
                        $('#province_id').change();
                    }
                    loadDistricts();
                },
                error: function() {
                    alert('Error loading provinces');
                }
            });

            // Load Districts when view - edit Provinces change
            function loadDistricts() {
                var provinceCode = $('#province_id').find(':selected').data('code');
                var _linkGetDistrict = $('meta[name="linkGetDistrict"]').attr('content').replace('_provinceCode',
                    provinceCode);
                $.ajax({
                    url: _linkGetDistrict,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district_id').empty();
                        $('#district_id').append(
                            '<option value="" selected="" disabled>Chọn Quận / Huyện</option>');
                        data.forEach(function(district) {
                            var selected = (districtId && districtId == district.id) ? 'selected' :
                                '';
                            $('#district_id').append(
                                `<option value="${district.id}" data-code="${district.code}" ${selected}>${district.name}</option>`
                            );
                        });
                        if (districtId) {
                            $('#district_id').change();
                        }
                        loadWards();
                    },
                    error: function() {
                        alert('Error loading districts');
                    }
                });
            }

            // Load Wards when view - edit Districts change
            function loadWards() {
                if (districtId) {
                    var districtCode = $('#district_id').find(':selected').data('code');
                    var _linkGetWard = $('meta[name="linkGetWard"]').attr('content').replace('_districtCode',
                        districtCode);
                    $.ajax({
                        url: _linkGetWard,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward_id').empty();
                            $('#ward_id').append(
                                '<option value="" selected="" disabled>Chọn Phường / Xã</option>');
                            data.forEach(function(ward) {
                                var selected = (wardId && wardId == ward.id) ? 'selected' : '';
                                $('#ward_id').append(
                                    `<option value="${ward.id}" data-code="${ward.code}" ${selected}>${ward.name}</option>`
                                );
                            });
                            if (callback) {
                                callback();
                            }
                        },
                        error: function() {
                            alert('Error loading wards');
                        }
                    });
                } else {
                    if (callback) {
                        callback();
                    }
                }
            }

            // Load districts when Province on Change 
            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                var provinceCode = $(this).find(':selected').data('code');
                var _linkGetDistrict = $('meta[name="linkGetDistrict"]').attr('content').replace(
                    '_provinceCode',
                    provinceCode);
                $.ajax({
                    url: _linkGetDistrict,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district_id').empty();
                        $('#district_id').append(
                            '<option value="" selected="" disabled>Chọn Quận / Huyện</option>');
                        data.forEach(function(district) {
                            var selected = (districtId && districtId == district.id) ?
                                'selected' : '';
                            $('#district_id').append(
                                `<option value="${district.id}" data-code="${district.code}" ${selected}>${district.name}</option>`
                            );
                        });
                        // Trigger Change
                        if (districtId) {
                            $('#district_id').change();
                        }
                    },
                    error: function() {
                        alert('Error loading districts');
                    }
                });
            });

            // load wards when District on Change
            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                var districtCode = $(this).find(':selected').data('code');
                var _linkGetWard = $('meta[name="linkGetWard"]').attr('content').replace('_districtCode',
                    districtCode);
                $.ajax({
                    url: _linkGetWard,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ward_id').empty();
                        $('#ward_id').append(
                            '<option value="" selected="" disabled>Chọn Phường / Xã</option>'
                        );
                        data.forEach(function(ward) {
                            var selected = (wardId && wardId == ward.id) ? 'selected' : '';
                            $('#ward_id').append(
                                `<option value="${ward.id}" data-code="${ward.code}" ${selected}>${ward.name}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Error loading wards');
                    }
                });
            });
        }

        $(function() {
            getData();
        });
    </script>
    <!-- /. Index JS -->
@endpush
