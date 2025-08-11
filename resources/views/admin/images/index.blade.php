@extends('admin.layouts.master')

@section('css')
@endSection

@push('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.css') }}">
    <!-- /. Vendors CSS -->

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/toastr/toastr.css') }}">
    <!-- /. Toastr -->

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

        .toast-success .toast-icon,
        .toast-info .toast-icon,
        .toast-warning .toast-icon,
        .toast-error .toast-icon {
            font-size: 14px;
            width: 14px;
            height: 14px;
            line-height: 14px;
        }

        .toast-message {
            padding-left: 20px;
        }

        .toast-success .toast-icon,
        .toast-info .toast-icon,
        .toast-warning .toast-icon,
        .toast-error .toast-icon {
            margin-right: 10px;
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
                                placeholder="Tìm kiếm tiêu đề">
                        </div>
                        <div class="col-md-3 mb-4">
                            <select class="form-select" id="filter_active" aria-label="Default select example">
                                <option value="" selected="">Tất cả trạng thái</option>
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <select class="form-select" id="filter_gallery" aria-label="Default select example">
                                <option value="" selected="">Tất cả trạng thái</option>
                                @foreach ($galleries as $gallery)
                                    <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <input class="form-control" type="date" id="filter_date" placeholder="yyyy/mm/dd">
                        </div>
                        <div class="col-md-3 mb-4">
                            <button type="button" class="btn btn-success waves-effect waves-light btn-filter">
                                <i class="ti ti-filter ti-md"></i> Lọc
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /. Filter -->

            <!-- Table -->
            <div class="card-datatable table-responsive">
                <table class="dt-fixedcolumns show-datatables table text-nowrap">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /. Table -->
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <input type="hidden" value="{{ route('admin.images.datatables') }}" id="url-datatable" />
    <input type="hidden" value="{{ route('admin.images.show', ['id' => '_id']) }}" id="url-show" />
    <input type="hidden" value="{{ route('admin.images.edit', ['id' => '_id']) }}" id="url-edit" />
    <input type="hidden" value="{{ route('admin.images.destroy', ['id' => '_id']) }}" id="url-destroy" />
    <input type="hidden" value="{{ route('admin.images.create') }}" id="url-create" />
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
            var _actionEditURL = $('#url-edit').val();
            var _actionDestroyURL = $('#url-destroy').val();

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
                    d.gallery_id = $('#filter_gallery').val() ? $('#filter_gallery').val() : '';
                    d.report_type_id = $('#filter_report_type').val() ? $('#filter_report_type').val() : '';

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

                        var _warningNow = '';
                        if (row.class_lesson_count_today > 0) {
                            _warningNow +=
                                `<p><label class="form-label text-danger">Có buổi học đang & sắp diễn ra</label></p>`;
                        }

                        return `<a href="#" class="btn-view text-primary">${data}</a> ${_warningNow}`;
                    }
                },
                {
                    "data": "url",
                    "render": function (data, type, row) {
                        if (!data) return '';
                        const fullUrl = `/storage/${data}`;
                        return `<img src="${fullUrl}" alt="image" style="max-width:100px;">`;
                    }
                },
                {
                    "data": "gallery_id",
                    "render": function (data, type, row) {
                        return row.gallery?.name || 'Không xác định';
                    }
                },

                {
                    "data": "active",
                    "render": function(data, type, row) {
                        _final = '<span class="badge bg-label-secondary">Không kích hoạt</span>';
                        if (data == 1) {
                            _final = '<span class="badge bg-label-success">Kích hoạt</span>';
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
                        var _actionEditIdURL = _actionEditURL.replace('_id', full.id);
                        var _actionDestroyIdURL = _actionDestroyURL.replace('_id', full.id);
                        var _actionEdit =
                        `<a href="${_actionEditIdURL}" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record btn-edit"><i class="ti ti-edit ti-md"></i></a>`;

                        var _actionDelete =
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record btn-destroy"><i class="ti ti-trash ti-md"></i></a>';



                        var _actionEnd = '</div>';

                        var _actionFull = _actionStart;
                        _actionFull += _actionDelete;
                        _actionFull += _actionEdit;

                        var _actionMoreDelete = '';
                        var _actionMoreEdit = '';
                        if (permissions.includes('admin.images.destroy')) {
                            _actionMoreDelete = `<a href="#" class="dropdown-item btn-destroy">Xoá</a>`;
                        }
                        if (permissions.includes('admin.images.edit')) {
                            _actionMoreEdit = `<a href="${_actionEditIdURL}" class="dropdown-item">Chỉnh sửa</a>`;
                        }
                        if (full.total_class_lesson > 0) {
                            _actionMoreDelete = '';
                        }

                        // if (full.class_lesson_count_today) {
                        //     _actionMoreEdit = '';
                        // }

                        var _actionMore = '';

                        if (_actionMoreEdit || _actionMoreDelete) {
                            _actionMore =
                                '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>' +
                                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                `${_actionMoreEdit}` +
                                `${_actionMoreDelete}` +
                                '</div>';
                        }


                        // _actionFull += _actionMore;

                        return (
                            _actionFull
                        )
                    }
                },
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
                searchPlaceholder: 'Tìm kiếm tên phòng ban',
                paginate: {
                    next: '<i class="ti ti-chevron-right ti-sm"></i>',
                    previous: '<i class="ti ti-chevron-left ti-sm"></i>'
                },
                emptyTable: "Không có dữ liệu phù hợp",
                zeroRecords: "Không tìm thấy bản ghi nào"
            };

            var _buttons = [{
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tạo mới</span>',
                className: 'add-new btn btn-primary waves-effect waves-light'
            }];

            var _buttons = [];

            if (permissions.includes('admin.images.create')) {
                _buttons.push({
                    text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tạo mới</span>',
                    className: 'add-new btn btn-primary waves-effect waves-light'
                });
            }

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
                // // "order": _order,
                "dom": _dom,
                "language": _language,
                "buttons": _buttons,
                "searching": false,
                scrollX: true,
                fixedColumns: true,
                fixedColumns: {
                    leftColumns: 4
                },
            });

            $('.btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
            });

            $('.add-new').on('click', function(e) {
                e.preventDefault();
                var _form = $('#form-form');
                var _actionURL = $('#url-create').val();
                window.location.href = _actionURL;
            });

            $('#keyword').on('keyup', function() {
                _idDatatables.DataTable().ajax.reload();
            });

            $(_idDatatables).on('click', '.btn-seen', function() {
                var data = _table.row($(this).parents('tr')).data();
                var contactId = data.id;
                var _actionURL = $('#url-show').val();

                $.ajax({
                    url: `${_actionURL}${contactId}`,
                    type: 'GET',
                    data: {
                        contact_id: contactId
                    },
                    success: function(response) {
                        $('#modalContent').html(response);
                        $('#modal-default').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $(_idDatatables).on('click', '.btn-edit', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                window.location.href = _actionURL;
            });

            $(_idDatatables).on('click', '.btn-view-website', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemSlug = data.slug;
                var _actionURL = $('#url-view-website').val();
                _actionURL = _actionURL.replace('_slug', _itemSlug);
                // window.location.href = _actionURL;
                window.open(_actionURL, '_blank');
            });

            $(_idDatatables).on('click', '.btn-destroy', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                $('.modal-title-destroy').html(`Bạn có chắc chắn muốn xóa báo cáo? <br> "${data.title}"`)
                $('.modal-title-warning').html('Lưu ý các dữ liệu liên quan sẽ bị xóa!');
                var _actionURL = $('#url-destroy').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                $('#form-destroy').attr('action', _actionURL);
                $('#modal-destroy').modal('show');
            });

            (_idDatatables).on('click', '.btn-view', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId) + '?is_view=true';
                window.location.href = _actionURL;
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
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            };
        }


        $(function() {
            getData();
            // validateForm();
        });
    </script>
    <!-- /. Index JS -->
@endpush
