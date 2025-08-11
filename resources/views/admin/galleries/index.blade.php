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

        .dayone-size {
            font-size: 13px;
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
                        <div class="col-md-3 mb-4">
                            <select class="form-select" id="filter_active" aria-label="Default select example">
                                <option value="" selected="">Tất cả trạng thái</option>
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
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
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
                    <h5 id="offcanvasFormLabel" class="offcanvas-title ">Tạo mới danh mục</h5>
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
                                Tên danh mục
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên danh mục" aria-label="Tên danh mục" />
                        </div>
                        <div class="mb-6">
                            <div>
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Mô tả"></textarea>
                            </div>
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
                        @if (in_array('admin.galleries.edit', $permissions))
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
    <input type="hidden" value="{{ route('admin.galleries.datatables') }}" id="url-datatable" />
    <input type="hidden" value="{{ route('admin.galleries.show', ['id' => '_id']) }}" id="url-show" />
    <input type="hidden" value="{{ route('admin.galleries.edit', ['id' => '_id']) }}" id="url-edit" />
    <input type="hidden" value="{{ route('admin.galleries.update', ['id' => '_id']) }}" id="url-update" />
    <input type="hidden" value="{{ route('admin.galleries.store') }}" id="url-store" />
    <input type="hidden" value="{{ route('admin.galleries.destroy', ['id' => '_id']) }}" id="url-destroy" />
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
                        var _actionEditIdURL = _actionEditURL.replace('_id', row.id);
                        return `<a href="#" class="text-primary btn-view">${data}</a>`;
                    }
                },
                {
                    "data": "description",
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
                    "data": "created_at",
                    "render": function(data, type, row) {
                        var _formatFullTime = 'DD/MM/YYYY HH:mm:ss';
                        var _formatDay = 'DD/MM/YYYY';
                        var _formattedDateTime = moment(data).format(_formatDay);
                        return _formattedDateTime;
                    }
                },
                {
                    data: 'action',
                    render: function(data, type, full, meta) {
                        var _actionStart = '<div class="d-flex align-items-center">';

                        var _actionEdit =
                            permissions.includes('admin.galleries.edit') ?
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record btn-edit"><i class="ti ti-edit ti-md"></i></a>' :
                            '';

                        var _actionDelete =
                            permissions.includes('admin.galleries.destroy') ?
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record btn-destroy"><i class="ti ti-trash ti-md"></i></a>' :
                            '';

                        var _actionMore =
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<a href="javascript:;"" class="dropdown-item">Edit</a>' +
                            '<a href="javascript:;" class="dropdown-item">Suspend</a>' +
                            '</div>';

                        var _actionEnd = '</div>';

                        var _keyAdmin = full.name_key;

                        var _actionFull = _actionStart;
                        if (full.total_employees > 0 || full.total_coaches > 0) {
                            _actionFull += _actionEdit;
                        } else {
                            _actionFull += _actionEdit;
                            _actionFull += _actionDelete;
                        }
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

            var _order = [
                [2, 'desc']
            ];

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
                searchPlaceholder: 'Tìm kiếm tên danh mục',
                paginate: {
                    next: '<i class="ti ti-chevron-right ti-sm"></i>',
                    previous: '<i class="ti ti-chevron-left ti-sm"></i>'
                },
                emptyTable: "Không có dữ liệu phù hợp",
                zeroRecords: "Không tìm thấy bản ghi nào"
            };

            var _buttons = [];

            if (permissions.includes('admin.galleries.create')) {
                _buttons.push({
                    text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tạo mới</span>',
                    className: 'add-new btn btn-primary waves-effect waves-light btn-add',
                    attr: {
                        'data-bs-toggle': 'offcanvas',
                        'data-bs-target': '#canvas-form'
                    }
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
                "dom": _dom,
                "language": _language,
                "buttons": _buttons,
                "searching": false,
                "fixedColumns": true,
                "fixedColumns": {
                    leftColumns: 3
                },
                "scrollX": true,
            });

            $('.btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
            });

            $('#keyword').on('keyup', function() {
                _idDatatables.DataTable().ajax.reload();
            });

            $('.btn-add').on('click', function() {
                var _form = $('#form-form');
                var _actionURL = $('#url-store').val();
                _form.attr('action', _actionURL);
                $(_form).trigger('reset');
                $('#form-form input[name="_method"]').remove();
                $('#offcanvasFormLabel').text('Tạo mới danh mục');

                $('.btn-dayone-close').text('Huỷ');

                $('.move-edit').addClass('d-none');
                $('.dayone-alert').addClass('d-none');

                $('#form-form').find('input, textarea, checkbox, select').removeAttr('readonly');
                $('#form-form').find('input, textarea, checkbox, select').removeAttr('disabled');
                $('.btn-dayone-submit').removeClass('d-none');
                $('.text-danger').removeClass('d-none');
            });

            (_idDatatables).on('click', '.btn-view', function() {
                // $('#form-form').find('input, textarea').removeAttr('readonly');
                var _form = $('#form-form');
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-update').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                _form.attr('action', _actionURL);

                if ($('#form-form input[name="_method"]').length === 0) {
                    $('#form-form').append('<input type="hidden" name="_method" value="PUT">');
                }

                $('#name').val(data.name);
                $('#name').attr('readonly');
                $('#sort_name').val(data.sort_name);
                $('#description').val(data.description);

                $('#active').prop('checked', false);
                if (data.active === 1) {
                    $('#active').prop('checked', true);
                }


                $('#form-form').find('input, textarea, checkbox, select').attr('readonly', true);
                $('#form-form').find('input, textarea, checkbox, select').attr('disabled', true);
                $('.move-edit').removeClass('d-none');

                $('.text-danger').addClass('d-none');
                $('.dayone-alert').addClass('d-none');
                $('.btn-dayone-submit').addClass('d-none');

                $('#offcanvasFormLabel').text('Thông tin danh mục');
                $('.btn-dayone-close').text('Đóng');

                $('#canvas-form').offcanvas('show');
                $('.btn-dayone-submit').hide();
            });

            $('.move-edit').on('click', function(e) {
                e.preventDefault();
                $('#form-form').find('input, textarea, checkbox, select').removeAttr('readonly');
                $('#form-form').find('input, textarea, checkbox, select').removeAttr('disabled');
                $('.btn-dayone-submit').removeClass('d-none');
                $('.text-danger').removeClass('d-none');

                $('#offcanvasFormLabel').text('Chỉnh sửa thông tin danh mục');
                $('.move-edit').addClass('d-none');
            });

            $(_idDatatables).on('click', '.btn-edit', function() {
                var _form = $('#form-form');
                $('.dayone-spinner-border').addClass('d-none');
                $('#canvas-form').removeClass('dayone-blur-effect');

                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-update').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                _form.attr('action', _actionURL);

                if ($('#form-form input[name="_method"]').length === 0) {
                    $('#form-form').append('<input type="hidden" name="_method" value="PUT">');
                }

                $('.move-edit').addClass('d-none');

                $('#form-form').find('input, textarea, checkbox, select').removeAttr('readonly');
                $('#form-form').find('input, textarea, checkbox, select').removeAttr('disabled');
                $('.btn-dayone-submit').removeClass('d-none');
                $('.text-danger').removeClass('d-none');

                $('#name').val(data.name);
                $('#sort_name').val(data.sort_name);
                $('#description').val(data.description);
                $('#active').prop('checked', data.active);
                $('#offcanvasFormLabel').text('Chỉnh sửa danh mục');

                $('#canvas-form').offcanvas('show');
                $('.btn-dayone-close').text('Huỷ');
            });

            $(_idDatatables).on('click', '.btn-destroy', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                $('.modal-title-destroy').html(`Bạn có chắc chắn muốn xóa danh mục? <br> "${data.name}"`)
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
                                message: 'Vui lòng nhập tên danh mục'
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
                                    toastr.error("Lỗi thông tin form");
                                } else {
                                    toastr.error("Lỗi hệ thống");
                                }
                            }
                        });
                    } else {
                        $('.dayone-spinner-border').addClass('d-none');
                        $('#canvas-form').removeClass('dayone-blur-effect');
                    }
                }).catch(function(error) {
                    $('.dayone-spinner-border').addClass('d-none');
                    $('#canvas-form').removeClass('dayone-blur-effect');
                });
            });
        }

        $(function() {
            getData();
        });
    </script>
    <!-- /. Index JS -->
@endpush
