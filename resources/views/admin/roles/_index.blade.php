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
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.css') }}">
    <!-- /. Vendors CSS -->

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
    <!-- /. Toastr -->

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
                                placeholder="yyyy/mm/dd">
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
                <table class="show-datatables table">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /. Table -->

            <!-- Offcanvas to Add -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="canvas-form" aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tạo mới phòng ban </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                    <div class="alert alert-danger mb-0 alert-dismissible dayone-alert d-none" role="alert">
                        <h5 class="alert-heading mb-2 dayone-alert-heading"><i class="ti ti-ban"></i> Thông tin dữ liệu
                            không hợp lệ</h5>
                        <div class="demo-inline-spacing">
                            <ul class="list-group list-group-flush dayone-errors">
                                <li class="list-group-item dayone-error-item">An item</li>
                                <li class="list-group-item dayone-error-item">A second item</li>
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form class="pt-0" id="form-form" method="POST" action="{{ route('admin.departments.store') }}"
                        enctype="multipart/form-data" onsubmit="return false">
                        @csrf
                        <div class="mb-6">
                            <label class="form-label" for="add-user-fullname">Tên phòng ban
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên phòng ban" aria-label="John Doe" />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="add-user-email">Mô tả</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Mô tả phòng ban" aria-label="Mô tả phòng ban" />
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
                        <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Huỷ</button>
                        <button type="submit" class="btn btn-primary me-3 data-submit">Lưu</button>
                    </form>
                </div>
            </div>
            <!-- /. Offcanvas to Add -->
        </div>
        <!-- /. Table & Filter -->
    </div>

    <!-- URL action -->
    <input type="hidden" value="{{ route('admin.roles.datatables') }}" id="url-datatable" />
    <input type="hidden" value="{{ route('admin.roles.show', ['id' => '_id']) }}" id="url-show" />
    <input type="hidden" value="{{ route('admin.roles.edit', ['id' => '_id']) }}" id="url-edit" />
    <input type="hidden" value="{{ route('admin.roles.destroy', ['id' => '_id']) }}" id="url-destroy" />
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
        function submitFormOld() {
            var _idForm = $('#form-form');
            $(_idForm).validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập thông đầy đủ",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('input[name="name"]').on('keyup', function() {
                var title = $(this).val();
                var slug = slugify(title);
                $('input[name="slug"]').val(slug);
            });

            $('.btn-ckfinder').on('click', function(e) {
                e.preventDefault();
                selectFileWithCKFinder('avatar');
            });
        }

        function validateForm() {

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

            const _form = document.getElementById('form-form');

            const fv = FormValidation.formValidation(_form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập tên phòng ban'
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

                fv.validate().then(function(status) {
                    if (status === 'Valid') {
                        var formData = $(_form).serialize();

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.departments.store') }}',
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                console.log('Success:', response);
                                toastr.success('Form đã được submit thành công!');
                                $('#canvas-form').offcanvas('hide');
                                $('.dayone-alert').addClass('d-none');
                                _form.reset();
                                // location.reload();
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
                                    toastr.error('Đã có lỗi xảy ra khi submit form.');
                                } else {
                                    toastr.error('Đã có lỗi xảy ra khi submit form.');
                                }
                            }
                        });
                    } else {
                        toastr.warning('Vui lòng điền đầy đủ thông tin cần thiết và đúng định dạng.');
                    }
                }).catch(function(error) {
                    console.error('Validation error:', error);
                    toastr.error('Đã có lỗi xảy ra trong quá trình validate form.');
                });
            });

        }

        function getData() {
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
                        return `<a href="${_actionEditIdURL}" class="text-primary">${data}</a>`;
                    }
                },
                {
                    "data": "active",
                    "render": function(data, type, row) {
                        var _active = '<span class="badge bg-label-success">Kích hoạt</span>';
                        var _inActive = '<span class="badge bg-label-danger">Không kích hoạt</span>';
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
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record btn-edit"><i class="ti ti-edit ti-md"></i></a>';

                        var _actionDelete =
                            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record btn-destroy"><i class="ti ti-trash ti-md"></i></a>';

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

            var _buttons = [
                // {
                //     extend: 'collection',
                //     className: 'btn btn-label-secondary dropdown-toggle mx-4 waves-effect waves-light',
                //     text: '<i class="ti ti-upload me-2 ti-xs"></i>Xuất bản',
                //     buttons: [{
                //             extend: 'print',
                //             text: '<i class="ti ti-printer me-2" ></i>Print',
                //             className: 'dropdown-item',
                //             exportOptions: {
                //                 columns: [1, 2, 3, 4, 5],
                //                 // prevent avatar to be print
                //                 format: {
                //                     body: function(inner, coldex, rowdex) {
                //                         if (inner.length <= 0) return inner;
                //                         var el = $.parseHTML(inner);
                //                         var result = '';
                //                         $.each(el, function(index, item) {
                //                             if (item.classList !== undefined && item
                //                                 .classList.contains('user-name')) {
                //                                 result = result + item.lastChild
                //                                     .firstChild
                //                                     .textContent;
                //                             } else if (item.innerText === undefined) {
                //                                 result = result + item.textContent;
                //                             } else result = result + item.innerText;
                //                         });
                //                         return result;
                //                     }
                //                 }
                //             },
                //             customize: function(win) {
                //                 //customize print view for dark
                //                 $(win.document.body)
                //                     .css('color', headingColor)
                //                     .css('border-color', borderColor)
                //                     .css('background-color', bodyBg);
                //                 $(win.document.body)
                //                     .find('table')
                //                     .addClass('compact')
                //                     .css('color', 'inherit')
                //                     .css('border-color', 'inherit')
                //                     .css('background-color', 'inherit');
                //             }
                //         },
                //         {
                //             extend: 'csv',
                //             text: '<i class="ti ti-file-text me-2" ></i>Csv',
                //             className: 'dropdown-item',
                //             exportOptions: {
                //                 columns: [1, 2, 3, 4, 5],
                //                 // prevent avatar to be display
                //                 format: {
                //                     body: function(inner, coldex, rowdex) {
                //                         if (inner.length <= 0) return inner;
                //                         var el = $.parseHTML(inner);
                //                         var result = '';
                //                         $.each(el, function(index, item) {
                //                             if (item.classList !== undefined && item
                //                                 .classList.contains('user-name')) {
                //                                 result = result + item.lastChild
                //                                     .firstChild
                //                                     .textContent;
                //                             } else if (item.innerText === undefined) {
                //                                 result = result + item.textContent;
                //                             } else result = result + item.innerText;
                //                         });
                //                         return result;
                //                     }
                //                 }
                //             }
                //         },
                //         {
                //             extend: 'excel',
                //             text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                //             className: 'dropdown-item',
                //             exportOptions: {
                //                 columns: [1, 2, 3, 4, 5],
                //                 // prevent avatar to be display
                //                 format: {
                //                     body: function(inner, coldex, rowdex) {
                //                         if (inner.length <= 0) return inner;
                //                         var el = $.parseHTML(inner);
                //                         var result = '';
                //                         $.each(el, function(index, item) {
                //                             if (item.classList !== undefined && item
                //                                 .classList.contains('user-name')) {
                //                                 result = result + item.lastChild
                //                                     .firstChild
                //                                     .textContent;
                //                             } else if (item.innerText === undefined) {
                //                                 result = result + item.textContent;
                //                             } else result = result + item.innerText;
                //                         });
                //                         return result;
                //                     }
                //                 }
                //             }
                //         },
                //         {
                //             extend: 'pdf',
                //             text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                //             className: 'dropdown-item',
                //             exportOptions: {
                //                 columns: [1, 2, 3, 4, 5],
                //                 // prevent avatar to be display
                //                 format: {
                //                     body: function(inner, coldex, rowdex) {
                //                         if (inner.length <= 0) return inner;
                //                         var el = $.parseHTML(inner);
                //                         var result = '';
                //                         $.each(el, function(index, item) {
                //                             if (item.classList !== undefined && item
                //                                 .classList.contains('user-name')) {
                //                                 result = result + item.lastChild
                //                                     .firstChild
                //                                     .textContent;
                //                             } else if (item.innerText === undefined) {
                //                                 result = result + item.textContent;
                //                             } else result = result + item.innerText;
                //                         });
                //                         return result;
                //                     }
                //                 }
                //             }
                //         },
                //         {
                //             extend: 'copy',
                //             text: '<i class="ti ti-copy me-2" ></i>Copy',
                //             className: 'dropdown-item',
                //             exportOptions: {
                //                 columns: [1, 2, 3, 4, 5],
                //                 // prevent avatar to be display
                //                 format: {
                //                     body: function(inner, coldex, rowdex) {
                //                         if (inner.length <= 0) return inner;
                //                         var el = $.parseHTML(inner);
                //                         var result = '';
                //                         $.each(el, function(index, item) {
                //                             if (item.classList !== undefined && item
                //                                 .classList.contains('user-name')) {
                //                                 result = result + item.lastChild
                //                                     .firstChild
                //                                     .textContent;
                //                             } else if (item.innerText === undefined) {
                //                                 result = result + item.textContent;
                //                             } else result = result + item.innerText;
                //                         });
                //                         return result;
                //                     }
                //                 }
                //             }
                //         }
                //     ]
                // },
                {
                    text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tạo mới</span>',
                    className: 'add-new btn btn-primary waves-effect waves-light',
                    attr: {
                        'data-bs-toggle': 'offcanvas',
                        'data-bs-target': '#canvas-form'
                    }
                }
            ];

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
                "responsive": _responsive,
                // "order": _order,
                "dom": _dom,
                "language": _language,
                "buttons": _buttons,
                "searching": false,
            });

            $('.btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
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

                $('.modal-title-destroy').html(`Hành động xoá dữ liệu ${data.name}`)
                $('.title-destroy').html(
                    `Bạn có chắc muốn xoá xoá dữ liệu ${data.name} ? <br><p class="text-danger"><b><i class="fa-solid fa-triangle-exclamation"></i> Lưu ý hành động này sẽ xoá các dữ liệu liên quan !</b></p>`
                );
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
                    success: function(response) {
                        $('#modal-destroy').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Xoá thành công dữ liệu !'
                        });
                        _idDatatables.DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        $('#modal-destroy').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: 'Xoá dữ liệu không thành công !'
                        });
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

            const _form = document.getElementById('form-form');

            const fv = FormValidation.formValidation(_form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập tên phòng ban'
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

                fv.validate().then(function(status) {
                    if (status === 'Valid') {
                        var formData = $(_form).serialize();

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.departments.store') }}',
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                console.log('Success:', response);
                                toastr.success('Form đã được submit thành công!');
                                $('#canvas-form').offcanvas('hide');
                                $('.dayone-alert').addClass('d-none');
                                _form.reset();
                                // location.reload();
                                _idDatatables.DataTable().ajax.reload();
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
                                    toastr.error('Đã có lỗi xảy ra khi submit form.');
                                } else {
                                    toastr.error('Đã có lỗi xảy ra khi submit form.');
                                }
                            }
                        });
                    } else {
                        toastr.warning('Vui lòng điền đầy đủ thông tin cần thiết và đúng định dạng.');
                    }
                }).catch(function(error) {
                    console.error('Validation error:', error);
                    toastr.error('Đã có lỗi xảy ra trong quá trình validate form.');
                });
            });
        }

        $(function() {
            getData();
            // validateForm();
        });
    </script>
    <!-- /. Index JS -->
@endpush
