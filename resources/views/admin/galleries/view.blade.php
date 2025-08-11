@extends('admin.layouts.master')

@section('meta')
    <meta name="linkGetProvince" content="{{ route('admin.provinces.active') }}" />
    <meta name="linkGetDistrict" content="{{ route('admin.districts.active', ['provinceCode' => '_provinceCode']) }}" />
    <meta name="linkGetWard" content="{{ route('admin.wards.active', ['districtCode' => '_districtCode']) }}" />
@endsection

@section('css')
@endSection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Date time range -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
 
    <style>
        /* CSS cho input file */
        .custom-file-input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .custom-file-label {
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .custom-file-label:hover {
            background-color: #0056b3;
        }

        .image-container {
            position: relative;
            width: 100%; /* Full width of the column */
            height: 300px; /* Fixed height for container */
            border: 2px dashed #ccc; /* Dashed border */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Light grey background */
            color: #ccc; /* Color of the placeholder text */
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .image-container .fa-times-circle {
            position: absolute;
            top: 10px; /* Khoảng cách từ đỉnh container */
            right: 10px; /* Khoảng cách từ cạnh phải của container */
            font-size: 24px; /* Kích thước của icon */
            color: red; /* Màu sắc của icon */
            cursor: pointer;
        }
        
        img {
            max-width: 100%; /* Ensures the image fits in the container */
            max-height: 100%;
        }
        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0; /* Hidden but functional */
            cursor: pointer;
            display: none;
        }

        .list-user {
            margin-top: 2em;
            margin-bottom: 1em;
        }

        .list-role {
            margin-bottom: 1em;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
@endpush

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($data) ? 'Cập nhật' : 'Tạo mới phòng ban' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Quản lý phân quyền</li>
                <li class="breadcrumb-item">Quản lý phòng ban</li>
                <li class="breadcrumb-item active">Tạo phòng ban</li>
                </ol>
            </div>
            </div>
        </div>
        </section>
        <!-- /. Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="card-title">Thông tin phòng ban</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- card-body -->
                            <form id="form-form" action="{{ isset($data) ? route('admin.departments.update', ['id' => $data->id ]) : route('admin.departments.store') }}" 
                                method="POST"
                                enctype="multipart/form-data"
                            >      
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    <!-- messages -->
                                    @include('admin.layouts.partials.messages')
                                    <!--- /. messages -->
                                    
                                    <!-- action button -->
                                    <div class="row">
                                        <div class="col-sm-12" style="padding-bottom: 10px;">
                                            <div class="form-group">
                                                <a type="button" href="{{ route('admin.departments.index') }}" class="btn btn-success float-left btn-table-ct">
                                                    <i class="fa-solid fa-arrow-left-long"></i>
                                                    Danh sách
                                                </a>
                                                <button type="submit" class="btn btn-info float-right"><i class="fa-solid fa-floppy-disk"></i></button>
                                                @if (isset($data))
                                                    <a href="{{ route('admin.departments.create') }}" type="button" class="btn btn-info float-left btn-table-ct"><i class="fa-solid fa-plus"></i></a>
                                                @endif 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /. action button -->

                                    <!-- information -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Tên <span class="span-requied">*</span></label>
                                                <input value="{{ isset($data) ? $data->name : old('name') }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập tên phòng ban" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group" style="margin-left: 30px;">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" {{ isset($data) ? ($data->active == 1 ? 'checked' : '') : 'checked' }} type="checkbox" id="active" name="active" value="1">
                                                    <label class="form-check-label" for="active">Kích hoạt</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /. information --> 

                                    @if (isset($data))
                                        @if ($data->users->count() > 0)
                                            <!-- table users -->
                                            <div class="list-user">
                                                <div class="col-12">
                                                    <label for="name"><i class="fa-solid fa-users"></i> Danh sách "Người Dùng" thuộc phòng ban</label>
                                                </div>
                                                <table id="user-datatables" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">No.</th>
                                                            <th>Tên</th>
                                                            <th>Role</th>
                                                            <th width="200">Trạng thái</th>
                                                            <th width="200">Ngày tạo</th>
                                                            <th width="100"><i class="fa-solid fa-gears"></i></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <!-- /. table users -->
                                        @endif

                                        @if ($data->roles->count() > 0)
                                            <!-- table roles -->
                                            <div class="list-role">
                                                <div class="col-12">
                                                    <label for="name"><i class="fa-solid fa-user-secret"></i> Danh sách "Role" thuộc phòng ban</label>
                                                </div>
                                                <table id="role-datatables" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">No.</th>
                                                            <th>Tên</th>
                                                            <th width="200">Trạng thái</th>
                                                            <th width="200">Ngày tạo</th>
                                                            <th width="100"><i class="fa-solid fa-gears"></i></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <!-- /. table roles -->
                                        @endif 
                                    @endif
                                </div>
                            </form>                        
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    @include('ckfinder::setup')

    <!-- url action -->
    <input type="hidden" value="{{ route('admin.users.datatables') }}" id="url-datatable-user" />
    <input type="hidden" value="{{ route('admin.users.edit', ['id' => '_id']) }}" id="url-edit-user" />
    <input type="hidden" value="{{ route('admin.roles.datatables') }}" id="url-datatable-role" />
    <input type="hidden" value="{{ route('admin.roles.edit', ['id' => '_id']) }}" id="url-edit-role" />
    <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="department-id">
    <!-- /. url action -->
@endSection

@section('js')
@endSection

@push('js')
    <!-- Validation -->
    <script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- /. Validation -->

    <!-- Summernote -->
    <script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- /. Summernote -->

    <!-- Date rangepicker -->
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    @if (isset($data))
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    @endif

    <!-- Main -->
    <script>
        function submitForm() {
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
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('input[name="name"]').on('keyup', function(){
                var title = $(this).val();
                var slug = slugify(title);
                $('input[name="slug"]').val(slug);
            });

            $('.btn-ckfinder').on('click', function (e) {
                e.preventDefault();
                selectFileWithCKFinder('avatar');
            });
        }

        function getDataUsers() {
            var _idDatatables = $('#user-datatables');
            var _actionURL = $('#url-datatable-user').val();
            var _actionEditURL = $('#url-edit-user').val();

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var _table = $(_idDatatables).DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: _actionURL,
                    mothod: "GET",
                    data: function (d) {
                        d.keyword = $('#keyword').val() ? $('#keyword').val() : '';
                        d.active = $('#active').val() ? $('#active').val() : '';
                    }
                },
                "columns": [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        searchable: false,
                        orderable: true
                    },
                    { 
                        "data": "name", 
                        "render": function (data, type, row) {
                            var _actionEditIdURL = _actionEditURL.replace('_id', row.id);
                            return `<a href="${_actionEditIdURL}" class="text-primary">${data}</a>`; 
                        }
                    },
                    { 
                        "data": "roles", 
                        "render": function (data, type, row) {
                            return data; 
                        }
                    },
                    { 
                        "data": "active",
                        "render": function (data, type, row) {
                            if (data !== 1) {
                                return '<span class="badge bg-danger">Không kích hoạt</span>';
                            } else {
                                return '<span class="badge bg-success">Kích hoạt</span>';
                            }
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function (data, type, row) {
                            var formattedDateTime = moment(data).format('DD/MM/YYYY HH:mm:ss');
                            return formattedDateTime;
                        }
                    },
                    {
                        "data": "action",
                        "render": function (data, type, row) {
                            return '<button type="button" class="btn bg-gradient-primary btn-table-ct btn-edit"><i class="fa-regular fa-pen-to-square"></i></button>';
                        }
                    }
                ],
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('#btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
            });

            $('#keyword').on('keyup', function() {
                _idDatatables.DataTable().ajax.reload();
            });

            $(_idDatatables).on('click', '.btn-edit', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                window.location.href = _actionURL;
            });
        }

        function getDataRoles() {
            var _idDatatables = $('#role-datatables');
            var _actionURL = $('#url-datatable-role').val();
            var _actionEditURL = $('#url-edit-role').val();

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var _table = $(_idDatatables).DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: _actionURL,
                    mothod: "GET",
                    data: function (d) {
                        d.keyword = $('#keyword').val() ? $('#keyword').val() : '';
                        d.active = $('#active').val() ? $('#active').val() : '';
                    }
                },
                "columns": [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        searchable: false,
                        orderable: true
                    },
                    { 
                        "data": "name", 
                        "render": function (data, type, row) {
                            var _actionEditIdURL = _actionEditURL.replace('_id', row.id);
                            return `<a href="${_actionEditIdURL}" class="text-primary">${data}</a>`; 
                        }
                    },
                    { 
                        "data": "active",
                        "render": function (data, type, row) {
                            if (data !== 1) {
                                return '<span class="badge bg-danger">Không kích hoạt</span>';
                            } else {
                                return '<span class="badge bg-success">Kích hoạt</span>';
                            }
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function (data, type, row) {
                            var formattedDateTime = moment(data).format('DD/MM/YYYY HH:mm:ss');
                            return formattedDateTime;
                        }
                    },
                    {
                        "data": "action",
                        "render": function (data, type, row) {
                            return '<button type="button" class="btn bg-gradient-primary btn-table-ct btn-edit"><i class="fa-regular fa-pen-to-square"></i></button>';
                        }
                    }
                ],
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('#btn-filter').on('click', function(e) {
                e.preventDefault();
                _idDatatables.DataTable().ajax.reload();
            });

            $('#keyword').on('keyup', function() {
                _idDatatables.DataTable().ajax.reload();
            });

            $(_idDatatables).on('click', '.btn-edit', function() {
                var data = _table.row($(this).parents('tr')).data();
                var _itemId = data.id;
                var _actionURL = $('#url-edit').val();
                _actionURL = _actionURL.replace('_id', _itemId);
                window.location.href = _actionURL;
            });
        }

        $(function () {
            submitForm();

            // -- Setup CKFinder & CkEditor
            allFunctionCkfinder();
            selectAllCKeditors();
 
            // -- Get data Relationship
            var _isData = $('#department-id').val();
            if (_isData) {
                getDataUsers();
                getDataRoles();
            }
        });
   </script>
   <!-- /. Main -->
@endpush