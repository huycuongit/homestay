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

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/dropzone/dropzone.css') }}" />

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
            width: 14px;
            height: 14px;
            line-height: 14px;
        }

        /* Adjust the padding to align the text properly */
        .toast-message {
            padding-left: 20px;
        }

        /* Ensure the icons are aligned properly */
        .toast-success .toast-icon,
        .toast-info .toast-icon,
        .toast-warning .toast-icon,
        .toast-error .toast-icon {
            margin-right: 10px;
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

        .dropzone {
            text-align: center;
        }

        .dz-preview {
            margin-right: none;
        }

        .notes-container {
            background-color: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
        }

        .notes-title {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .notes-container ol {
            padding-left: 20px;
        }

        .notes-container ol li {
            margin: 5px 0;
            line-height: 1.6;
        }

        .notes-container ol li strong {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" id="form-form"
            action="{{ route('admin.systems.update') }}">
            <div class="row">
                <div class="col-md-8">
                    <h3>Notifications</h3>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light float-end">Lưu</button>
                    <button type="button" data-url=" " class="btn btn-label-secondary waves-effect float-end btn-cancel">
                        Huỷ
                    </button>
                </div>
            </div>
            <div class="row mb-6">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif

                <!-- Messages -->
                @include('admin.layouts.partials.messages')
                <!--- /. Messages -->

                <!-- Info -->
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                shareholder Class
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_remind">
                                            Thời gian nhắc lịch học tư động trước (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_class_remind"
                                            name="shareholder_class_remind"
                                            value="{{ showValueSystem($data, 'shareholder_class_remind') }}"
                                            placeholder="Thời gian nhắc hẹn lịch tập lớp CLASS"
                                            aria-label="Thời gian nhắc hẹn lịch tập lớp CLASS" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_route">Đường dẫn app đến chi tiết
                                            màn
                                            hình</label>
                                        <input type="text" class="form-control" id="shareholder_class_route"
                                            name="shareholder_class_route"
                                            value="{{ showValueSystem($data, 'shareholder_class_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết lớp Class"
                                            aria-label="Đường dẫn vào App chi tiết lớp Class" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_title">
                                            Tiêu đề thông báo
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_class_title"
                                            name="shareholder_class_title"
                                            value="{{ showValueSystem($data, 'shareholder_class_title') }}"
                                            placeholder="Tiêu đề dung nhắc hẹn buôi học"
                                            aria-label="Tiêu đề dung nhắc hẹn buôi học" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_body">
                                            Nội dung thông báo
                                        </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__shareholder__CODE__</strong>: Mã shareholder
                                                </li>
                                            </ol>
                                        </div>
                                        <input type="text" class="form-control" id="shareholder_class_body"
                                            name="shareholder_class_body"
                                            value="{{ showValueSystem($data, 'shareholder_class_body') }}"
                                            placeholder="Nội dung nhắc hẹn buôi học"
                                            aria-label="Nội dung nhắc hẹn buôi học" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                shareholder Practice
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_remind">
                                            Thời gian nhắc lịch học tự đông trước (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_practice_remind"
                                            name="shareholder_practice_remind"
                                            value="{{ showValueSystem($data, 'shareholder_practice_remind') }}"
                                            placeholder="Thời gian nhắc hẹn lịch tập lớp Practice"
                                            aria-label="Thời gian nhắc hẹn lịch tập lớp Practice" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_route">Đường dẫn app đến chi
                                            tiết
                                            màn hình</label>
                                        <input type="text" class="form-control" id="shareholder_practice_route"
                                            name="shareholder_practice_route"
                                            value="{{ showValueSystem($data, 'shareholder_practice_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết lớp Practice"
                                            aria-label="Đường dẫn vào App chi tiết lớp Practice" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_title">
                                            Tiêu đề thông báo
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_practice_title"
                                            name="shareholder_practice_title"
                                            value="{{ showValueSystem($data, 'shareholder_practice_title') }}"
                                            placeholder="Tiêu đề dung nhắc hẹn buôi tập"
                                            aria-label="Tiêu đề dung nhắc hẹn buôi tập" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_body">
                                            Nội dung thông báo
                                        </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__shareholder__CODE__</strong>: Mã shareholder
                                                </li>
                                            </ol>
                                        </div>
                                        <input type="text" class="form-control" id="shareholder_practice_body"
                                            name="shareholder_practice_body"
                                            value="{{ showValueSystem($data, 'shareholder_practice_body') }}"
                                            placeholder="Nội dung nhắc hẹn buôi tập"
                                            aria-label="Nội dung nhắc hẹn buôi tập" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                shareholder 1:1 Chung
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_general_remind">
                                            Thời gian nhắc lịch học tự đông trước (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_1_1_general_remind"
                                            name="shareholder_1_1_general_remind"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_general_remind') }}"
                                            placeholder="Thời gian nhắc hẹn lịch tập lớp shareholder 1:1 Chung"
                                            aria-label="Thời gian nhắc hẹn lịch tập lớp shareholder 1:1 Chung" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_general_route">Đường dẫn app đến
                                            chi tiết
                                            màn hình</label>
                                        <input type="text" class="form-control" id="shareholder_1_1_general_route"
                                            name="shareholder_1_1_general_route"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_general_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết lớp shareholder 1:1 Chung"
                                            aria-label="Đường dẫn vào App chi tiết lớp shareholder 1:1 Chung" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_general_title">
                                            Tiêu đề thông báo
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_1_1_general_title"
                                            name="shareholder_1_1_general_title"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_general_title') }}"
                                            placeholder="Tiêu đề dung nhắc hẹn buôi tập"
                                            aria-label="Tiêu đề dung nhắc hẹn buôi tập" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_general_body">
                                            Nội dung thông báo
                                        </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__shareholder__CODE__</strong>: Mã shareholder
                                                </li>
                                            </ol>
                                        </div>
                                        <input type="text" class="form-control" id="shareholder_1_1_general_body"
                                            name="shareholder_1_1_general_body"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_general_body') }}"
                                            placeholder="Nội dung nhắc hẹn buôi tập"
                                            aria-label="Nội dung nhắc hẹn buôi tập" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                shareholder 1:1 Riêng
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_private_remind">
                                            Thời gian nhắc lịch học tự đông trước (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_1_1_private_remind"
                                            name="shareholder_1_1_private_remind"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_private_remind') }}"
                                            placeholder="Thời gian nhắc hẹn lịch tập lớp shareholder 1:1 Riêng"
                                            aria-label="Thời gian nhắc hẹn lịch tập lớp shareholder 1:1 Riêng" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_private_route">Đường dẫn app đến
                                            chi tiết
                                            màn hình</label>
                                        <input type="text" class="form-control" id="shareholder_1_1_private_route"
                                            name="shareholder_1_1_private_route"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_private_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết lớp shareholder 1:1 Riêng"
                                            aria-label="Đường dẫn vào App chi tiết lớp shareholder 1:1 Riêng" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_private_title">
                                            Tiêu đề thông báo
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_1_1_private_title"
                                            name="shareholder_1_1_private_title"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_private_title') }}"
                                            placeholder="Tiêu đề dung nhắc hẹn buôi tập"
                                            aria-label="Tiêu đề dung nhắc hẹn buôi tập" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_1_1_private_body">
                                            Nội dung thông báo
                                        </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__shareholder__CODE__</strong>: Mã shareholder
                                                </li>
                                            </ol>
                                        </div>
                                        <input type="text" class="form-control" id="shareholder_1_1_private_body"
                                            name="shareholder_1_1_private_body"
                                            value="{{ showValueSystem($data, 'shareholder_1_1_private_body') }}"
                                            placeholder="Nội dung nhắc hẹn buôi tập"
                                            aria-label="Nội dung nhắc hẹn buôi tập" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                shareholder P1P2
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_p1p2_remind">
                                            Thời gian nhắc lịch học tự đông trước (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_p1p2_remind"
                                            name="shareholder_p1p2_remind"
                                            value="{{ showValueSystem($data, 'shareholder_p1p2_remind') }}"
                                            placeholder="Thời gian nhắc hẹn lịch tập lớp shareholder P1P2"
                                            aria-label="Thời gian nhắc hẹn lịch tập lớp shareholder P1P2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_p1p2_route">Đường dẫn app đến chi tiết
                                            màn hình</label>
                                        <input type="text" class="form-control" id="shareholder_p1p2_route"
                                            name="shareholder_p1p2_route"
                                            value="{{ showValueSystem($data, 'shareholder_p1p2_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết lớp shareholder P1P2"
                                            aria-label="Đường dẫn vào App chi tiết lớp shareholder P1P2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_p1p2_title">
                                            Tiêu đề thông báo
                                        </label>
                                        <input type="text" class="form-control" id="shareholder_p1p2_title"
                                            name="shareholder_p1p2_title"
                                            value="{{ showValueSystem($data, 'shareholder_p1p2_title') }}"
                                            placeholder="Tiêu đề dung nhắc hẹn buôi tập"
                                            aria-label="Tiêu đề dung nhắc hẹn buôi tập" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_p1p2_body">
                                            Nội dung thông báo
                                        </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__shareholder__CODE__</strong>: Mã shareholder
                                                </li>
                                            </ol>
                                        </div>
                                        <input type="text" class="form-control" id="shareholder_p1p2_body"
                                            name="shareholder_p1p2_body"
                                            value="{{ showValueSystem($data, 'shareholder_p1p2_body') }}"
                                            placeholder="Nội dung nhắc hẹn buôi tập"
                                            aria-label="Nội dung nhắc hẹn buôi tập" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                NEWS
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="noti_news_route">Đường dẫn app đến chi tiết
                                            màn hình</label>
                                        <input type="text" class="form-control" id="noti_news_route"
                                            name="noti_news_route"
                                            value="{{ showValueSystem($data, 'noti_news_route') }}"
                                            placeholder="Đường dẫn vào App chi tiết tin tức"
                                            aria-label="Đường dẫn vào App chi tiết tin tức" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6">
                        <div class="card-body">
                            <label class="badge bg-success bg-glow">
                                Personal
                            </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="student_remind_birthday">
                                            Thời gian nhắc sinh nhật tự động (Phút)
                                        </label>
                                        <input type="text" class="form-control" id="student_remind_birthday"
                                            name="student_remind_birthday"
                                            value="{{ showValueSystem($data, 'student_remind_birthday') }}"
                                            placeholder="Thời gian chúc mừng sinh nhật học viên"
                                            aria-label="Thời gian chúc mừng sinh nhật học viên" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. Info -->
            </div>
        </form>
    </div>
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

    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/vendor/libs/dropzone/dropzone.js') }}"></script>

    {{-- <script src="{{ asset('assets/admin/js/forms-file-upload.js') }}"></script> --}}

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
                                        message: 'Vui lòng nhập tên chi nhánh'
                                    }
                                }
                            },
                            province_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng chọn Tỉnh/Thành Phố'
                                    }
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
                                        message: 'Vui lòng chọn Xã/Phường'
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
            btnAll();

            const previewTemplate = `<div class="dz-preview dz-file-preview">
                <div class="dz-details">
                <div class="dz-thumbnail">
                    <img data-dz-thumbnail>
                    <span class="dz-nopreview">No preview</span>
                    <div class="dz-success-mark"></div>
                    <div class="dz-error-mark"></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="dz-filename" data-dz-name></div>
                <div class="dz-size" data-dz-size></div>
                 <a href="#" class="dz-remove" data-dz-remove>Xoá Ảnh</a>
                </div>
            </div>`;

            document.querySelectorAll('.dropzone').forEach(dropzoneElement => {
                const hiddenInputId = dropzoneElement.getAttribute('data-hidden-input-id');
                const hiddenInput = document.getElementById(hiddenInputId);
                const existingImageUrl = hiddenInput ? hiddenInput.value : '';

                const dropzone = new Dropzone(dropzoneElement, {
                    previewTemplate: previewTemplate,
                    parallelUploads: 1,
                    maxFilesize: 5,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    autoProcessQueue: false,
                    init: function() {
                        if (existingImageUrl) {
                            const mockFile = {
                                name: 'Ảnh',
                                size: 1234,
                                url: existingImageUrl
                            };

                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, existingImageUrl);
                            this.emit('complete', mockFile);

                            this.options.autoProcessQueue = false;
                        }



                        this.on('removedfile', function(file) {
                            console.log('File removed:', file);
                            hiddenInput.value = '';

                            dropzone.options.autoProcessQueue = false;
                        });

                        this.on('error', function(file, errorMessage) {
                            console.error('Error uploading file:', errorMessage);
                        });

                        this.on('maxfilesexceeded', function(file) {
                            console.log('Max files exceeded, removing the first file.');
                            this.removeFile(this.files[0]);
                            this.addFile(file);
                        });

                        this.on('addedfile', function(file) {
                            console.log('File added:', file);
                            if (this.files.length > 1) {
                                console.log(
                                    'More than one file, removing the first one.');
                                this.removeFile(this.files[0]);
                            }
                            this.options.autoProcessQueue = true;
                        });

                        // this.on('thumbnail', function(file, dataUrl) {
                        //     console.log('Thumbnail generated for file:', file);
                        //     if (existingImageUrl) {
                        //         this.emit('thumbnail', file, existingImageUrl);
                        //     }
                        // });

                        this.on('success', function(file, response) {
                            console.log('File uploaded successfully:', file);
                            console.log('Server response:', response);
                            if (response && response.dataURL) {
                                hiddenInput.value = response.dataURL;
                            } else if (file.dataURL) {
                                hiddenInput.value = file.dataURL;
                            } else {
                                console.warn('No dataURL in response or file.');
                            }
                        });
                    }
                });
            });
        });
    </script>
    <!-- /. Index JS -->
@endpush
