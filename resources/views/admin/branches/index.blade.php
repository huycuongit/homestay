@extends('admin.layouts.master')

@section('css')
@endSection

@push('css')

@endpush

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('admin/branchs.title') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Quản lý địa điểm</li>
                    <li class="breadcrumb-item active">Danh sách địa điểm</li>
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
                                <h3 class="card-title">Danh sách trung tâm</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- card-body -->
                            <div class="card-body">
                                <!-- filter -->
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="keyword">Từ khoá</label>
                                            <input type="text" class="form-control" id="keyword" placeholder="Tên, mô tả, nội dung" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="active">Trạng thái</label>
                                            <select class="custom-select rounded-0" id="active">
                                                <option value="" selected>Tất cả</option>
                                                <option value="1">Kích hoạt</option>
                                                <option value="0">Không kích hoạt</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. filter -->

                                <!-- button action -->
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.branchs.create') }}" type="button" class="btn btn-info float-right btn-table-ct"><i class="fa-solid fa-plus"></i></i></a>
                                        <a href="{{ route('page.slug', ['slug' => 'he-thong-trung-tam']) }}" target="_blank" type="button" class="btn btn-primary float-right btn-table-ct" id="btn-view-website"><i class="fa-solid fa-up-right-from-square"></i></a>
                                        <a type="button" class="btn btn-success float-right btn-table-ct" id="btn-filter"><i class="fa-solid fa-filter"></i></a>
                                    </div> 
                                </div>
                                <!-- /. button action -->

                                <!-- table -->
                                <table id="datatables" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tên</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th width="100"><i class="fa-solid fa-gears"></i></th>
                                        </tr>
                                    </thead>
                                </table>
                                <!-- /. table -->
                            </div>
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

    <!-- url action -->
    <input type="hidden" value="{{ route('admin.branchs.datatables') }}" id="url-datatable" />
    <input type="hidden" value="{{ route('admin.branchs.show', ['id' => '_id']) }}" id="url-show" />
    <input type="hidden" value="{{ route('admin.branchs.edit', ['id' => '_id']) }}" id="url-edit" />
    <input type="hidden" value="{{ route('admin.branchs.destroy', ['id' => '_id']) }}" id="url-destroy" /> 
    <!-- /. url action -->

    <!-- modal deatail -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog">
        <div class="modal-content modal-detail-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin chi tiết</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                {{-- <button type="button" class="btn btn-default" >Thoát</button> --}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        </div>
        <!-- /.modal deatail-->
    </div>

    <!-- modal deatail -->
    <div class="modal fade" id="modal-destroy">
        <div class="modal-dialog">
        <div class="modal-content modal-detail-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-destroy"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-destroy" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <p class="title-destroy">Bạn có chắc muốn xoá</p>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ bỏ</button>
                <button type="button" class="btn btn-danger btn-destroy-modal">Đồng ý</button>
            </div>
        </div>
        </div>
        <!-- /.modal deatail-->
    </div>
@endSection

@section('js')
@endSection

@push('js')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
            function getData() {
                var _idDatatables = $('#datatables');
                var _actionURL = $('#url-datatable').val();
                var _actionEditURL = $('#url-edit').val();

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
                                return '<button type="button" class="btn bg-gradient-primary btn-table-ct btn-edit"><i class="fa-regular fa-pen-to-square"></i></button>'
                                + '<button type="button" class="btn bg-gradient-danger btn-table-ct btn-destroy"><i class="fa-regular fa-trash-can"></i></button>';
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

                $(_idDatatables).on('click', '.btn-seen', function() {
                    var data = _table.row($(this).parents('tr')).data();
                    var contactId = data.id;
                    var _actionURL = $('#url-show').val();
                    
                    $.ajax({
                        url: `${_actionURL}${contactId}`,
                        type: 'GET',
                        data: { contact_id: contactId },
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
                    $('.title-destroy').html(`Bạn có chắc muốn xoá xoá dữ liệu ${data.name} ? <br><p class="text-danger"><b><i class="fa-solid fa-triangle-exclamation"></i> Lưu ý hành động này sẽ xoá các dữ liệu liên quan !</b></p>`);
                    var _actionURL = $('#url-destroy').val();
                    _actionURL = _actionURL.replace('_id', _itemId);
                    $('#form-destroy').attr('action', _actionURL);
                    $('#modal-destroy').modal('show');
                });

                $('.btn-destroy-modal').on('click', function () {
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
            }

            $(function () {
                getData();
            });
    </script>
@endpush