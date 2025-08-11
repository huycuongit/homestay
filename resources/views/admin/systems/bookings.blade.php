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

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/editor.css') }}" />

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
                    <h3>shareholder</h3>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light float-end">Lưu</button>
                    <button type="button" data-url="{{ route('admin.systems.services') }}"
                        class="btn btn-label-secondary waves-effect float-end btn-cancel">
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_limit_day">Giới hạn book /
                                            ngày</label>
                                        <input type="text" class="form-control" id="shareholder_class_limit_day"
                                            name="shareholder_class_limit_day"
                                            value="{{ showValueSystem($data, 'shareholder_class_limit_day') }}"
                                            placeholder="Giới hạn book ngày" aria-label="Giới hạn book ngày" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_limit_week">Giới hạn book /
                                            tuần</label>
                                        <input type="text" class="form-control" id="shareholder_class_limit_week"
                                            name="shareholder_class_limit_week"
                                            value="{{ showValueSystem($data, 'shareholder_class_limit_week') }}"
                                            placeholder="Giới hạn book tuần" aria-label="Giới hạn book tuần" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_cancel_limit_month">Giới hạn huỷ /
                                            tháng</label>
                                        <input type="text" class="form-control" id="shareholder_class_cancel_limit_month"
                                            name="shareholder_class_cancel_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_class_cancel_limit_month') }}"
                                            placeholder="Giới hạn huỷ trên tháng" aria-label="Giới hạn huỷ trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_not_yet_limit_month">Giới hạn không
                                            đến
                                            lớp / tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_class_not_yet_limit_month"
                                            name="shareholder_class_not_yet_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_class_not_yet_limit_month') }}"
                                            placeholder="Giới hạn không đến lớp trên tháng"
                                            aria-label="Giới hạn không đến lớp trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_cancel_time">Thời gian được huỷ
                                            lớp
                                            (Tiếng)</label>
                                        <input type="text" class="form-control" id="shareholder_class_cancel_time"
                                            name="shareholder_class_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_class_cancel_time') }}"
                                            placeholder="Thời gian được huỷ lớp (Tiếng)"
                                            aria-label="Thời gian được huỷ lớp (Tiếng)" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_limit_cancel_time">Thời gian
                                            không
                                            được huỷ lớp
                                            (Phút)</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_class_limit_cancel_time"
                                            name="shareholder_class_limit_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_class_limit_cancel_time') }}"
                                            placeholder="Thời gian không được huỷ lớp (Phút)"
                                            aria-label="Thời gian không được huỷ lớp (Phút)" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label class="badge bg-success bg-glow">
                                shareholder Practice
                            </label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_practice_time_start">Giới hạn thời gian bắt
                                            đầu</label>
                                        <input type="text" class="form-control" id="book_practice_time_start"
                                            name="book_practice_time_start"
                                            value="{{ showValueSystem($data, 'book_practice_time_start') }}"
                                            placeholder="Giới hạn thời gian bắt đầu"
                                            aria-label="Giới hạn thời gian bắt đầu" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_practice_time_end">Giới hạn thời gian kết
                                            thúc</label>
                                        <input type="text" class="form-control" id="book_practice_time_end"
                                            name="book_practice_time_end"
                                            value="{{ showValueSystem($data, 'book_practice_time_end') }}"
                                            placeholder="Giới hạn thời gian kết thúc"
                                            aria-label="Giới hạn thời gian kết thúc" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_practice_time_step">Bước nhảy của phút</label>
                                        <input type="text" class="form-control" id="book_practice_time_step"
                                            name="book_practice_time_step"
                                            value="{{ showValueSystem($data, 'book_practice_time_step') }}"
                                            placeholder="Bước nhảy của phút" aria-label="Bước nhảy của phút" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="instrument_practice_row">Phần tử trên 1
                                            dòng</label>
                                        <input type="text" class="form-control" id="instrument_practice_row"
                                            name="instrument_practice_row"
                                            value="{{ showValueSystem($data, 'instrument_practice_row') }}"
                                            placeholder="Phần tử trên 1 dòng" aria-label="Phần tử trên 1 dòng" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_limit_day">Giới hạn book /
                                            ngày</label>
                                        <input type="text" class="form-control" id="shareholder_practice_limit_day"
                                            name="shareholder_practice_limit_day"
                                            value="{{ showValueSystem($data, 'shareholder_practice_limit_day') }}"
                                            placeholder="Giới hạn book ngày" aria-label="Giới hạn book ngày" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_limit_week">Giới hạn book /
                                            tuần</label>
                                        <input type="text" class="form-control" id="shareholder_practice_limit_week"
                                            name="shareholder_practice_limit_week"
                                            value="{{ showValueSystem($data, 'shareholder_practice_limit_week') }}"
                                            placeholder="Giới hạn book tuần" aria-label="Giới hạn book tuần" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_cancel_limit_month">Giới hạn
                                            huỷ /
                                            tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_practice_cancel_limit_month"
                                            name="shareholder_practice_cancel_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_practice_cancel_limit_month') }}"
                                            placeholder="Giới hạn huỷ trên tháng" aria-label="Giới hạn huỷ trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_not_yet_limit_month">Giới hạn
                                            không
                                            đến
                                            lớp / tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_practice_not_yet_limit_month"
                                            name="shareholder_practice_not_yet_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_practice_not_yet_limit_month') }}"
                                            placeholder="Giới hạn không đến lớp trên tháng"
                                            aria-label="Giới hạn không đến lớp trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_cancel_time">Thời gian không
                                            được
                                            huỷ
                                            lớp
                                            (Phút)</label>
                                        <input type="text" class="form-control" id="shareholder_practice_cancel_time"
                                            name="shareholder_practice_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_practice_cancel_time') }}"
                                            placeholder="Thời gian không được huỷ lớp (Phút)"
                                            aria-label="Thời gian không được huỷ lớp (Phút)" />
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <label class="badge bg-success bg-glow">
                                shareholder 1:1 General
                            </label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_general_time_start">Giới hạn thời gian bắt
                                            đầu</label>
                                        <input type="text" class="form-control" id="book_11_general_time_start"
                                            name="book_11_general_time_start"
                                            value="{{ showValueSystem($data, 'book_11_general_time_start') }}"
                                            placeholder="Giới hạn thời gian bắt đầu"
                                            aria-label="Giới hạn thời gian bắt đầu" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_general_time_end">Giới hạn thời gian kết
                                            thúc</label>
                                        <input type="text" class="form-control" id="book_11_general_time_end"
                                            name="book_11_general_time_end"
                                            value="{{ showValueSystem($data, 'book_11_general_time_end') }}"
                                            placeholder="Giới hạn thời gian kết thúc"
                                            aria-label="Giới hạn thời gian kết thúc" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_general_time_step">Bước nhảy của
                                            phút</label>
                                        <input type="text" class="form-control" id="book_11_general_time_step"
                                            name="book_11_general_time_step"
                                            value="{{ showValueSystem($data, 'book_11_general_time_step') }}"
                                            placeholder="Bước nhảy của phút" aria-label="Bước nhảy của phút" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_general_limit_show_day">Giới hạn
                                            hiển
                                            thị ngày
                                            book</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_general_limit_show_day"
                                            name="shareholder_11_general_limit_show_day"
                                            value="{{ showValueSystem($data, 'shareholder_11_general_limit_show_day') }}"
                                            placeholder="Phần tử trên 1 dòng" aria-label="Phần tử trên 1 dòng" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_general_not_yet_limit_month">Giới
                                            hạn
                                            không đến lớp / tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_general_not_yet_limit_month"
                                            name="shareholder_11_general_not_yet_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_11_general_not_yet_limit_month') }}"
                                            placeholder="Giới hạn không đến lớp trên tháng"
                                            aria-label="Giới hạn không đến lớp trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_general_cancel_time">Thời gian không
                                            được
                                            huỷ lớp (Phút)</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_general_cancel_time"
                                            name="shareholder_11_general_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_11_general_cancel_time') }}"
                                            placeholder="Thời gian không được huỷ lớp (Phút)"
                                            aria-label="Thời gian không được huỷ lớp (Phút)" />
                                    </div>
                                </div>
                            </div>
                            <hr>


                            <label class="badge bg-success bg-glow">
                                shareholder 1:1 Private
                            </label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_private_time_start">Giới hạn thời gian bắt
                                            đầu</label>
                                        <input type="text" class="form-control" id="book_11_private_time_start"
                                            name="book_11_private_time_start"
                                            value="{{ showValueSystem($data, 'book_11_private_time_start') }}"
                                            placeholder="Giới hạn thời gian bắt đầu"
                                            aria-label="Giới hạn thời gian bắt đầu" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_private_time_end">Giới hạn thời gian kết
                                            thúc</label>
                                        <input type="text" class="form-control" id="book_11_private_time_end"
                                            name="book_11_private_time_end"
                                            value="{{ showValueSystem($data, 'book_11_private_time_end') }}"
                                            placeholder="Giới hạn thời gian kết thúc"
                                            aria-label="Giới hạn thời gian kết thúc" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_private_time_step">Bước nhảy của
                                            phút</label>
                                        <input type="text" class="form-control" id="book_11_private_time_step"
                                            name="book_11_private_time_step"
                                            value="{{ showValueSystem($data, 'book_11_private_time_step') }}"
                                            placeholder="Bước nhảy của phút" aria-label="Bước nhảy của phút" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_limit_show_day">Giới hạn
                                            hiển
                                            thị ngày
                                            book</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_private_limit_show_day"
                                            name="shareholder_11_private_limit_show_day"
                                            value="{{ showValueSystem($data, 'shareholder_11_private_limit_show_day') }}"
                                            placeholder="Phần tử trên 1 dòng" aria-label="Phần tử trên 1 dòng" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_not_yet_limit_month">Giới
                                            hạn
                                            không đến lớp / tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_private_not_yet_limit_month"
                                            name="shareholder_11_private_not_yet_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_11_private_not_yet_limit_month') }}"
                                            placeholder="Giới hạn không đến lớp trên tháng"
                                            aria-label="Giới hạn không đến lớp trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_cancel_time">Thời gian không
                                            được
                                            huỷ lớp (Phút)</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_private_cancel_time"
                                            name="shareholder_11_private_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_11_private_cancel_time') }}"
                                            placeholder="Thời gian không được huỷ lớp (Phút)"
                                            aria-label="Thời gian không được huỷ lớp (Phút)" />
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <label class="badge bg-success bg-glow">
                                shareholder 1:1 P1P2
                            </label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_p1p2_time_start">Giới hạn thời gian bắt
                                            đầu</label>
                                        <input type="text" class="form-control" id="book_11_p1p2_time_start"
                                            name="book_11_p1p2_time_start"
                                            value="{{ showValueSystem($data, 'book_11_p1p2_time_start') }}"
                                            placeholder="Giới hạn thời gian bắt đầu"
                                            aria-label="Giới hạn thời gian bắt đầu" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_p1p2_time_end">Giới hạn thời gian kết
                                            thúc</label>
                                        <input type="text" class="form-control" id="book_11_p1p2_time_end"
                                            name="book_11_p1p2_time_end"
                                            value="{{ showValueSystem($data, 'book_11_p1p2_time_end') }}"
                                            placeholder="Giới hạn thời gian kết thúc"
                                            aria-label="Giới hạn thời gian kết thúc" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="book_11_p1p2_time_step">Bước nhảy của
                                            phút</label>
                                        <input type="text" class="form-control" id="book_11_p1p2_time_step"
                                            name="book_11_p1p2_time_step"
                                            value="{{ showValueSystem($data, 'book_11_p1p2_time_step') }}"
                                            placeholder="Bước nhảy của phút" aria-label="Bước nhảy của phút" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_p1p2_limit_show_day">Giới hạn hiển
                                            thị ngày
                                            book</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_p1p2_limit_show_day"
                                            name="shareholder_11_p1p2_limit_show_day"
                                            value="{{ showValueSystem($data, 'shareholder_11_p1p2_limit_show_day') }}"
                                            placeholder="Phần tử trên 1 dòng" aria-label="Phần tử trên 1 dòng" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_p1p2_not_yet_limit_month">Giới hạn
                                            không đến lớp / tháng</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_p1p2_not_yet_limit_month"
                                            name="shareholder_11_p1p2_not_yet_limit_month"
                                            value="{{ showValueSystem($data, 'shareholder_11_p1p2_not_yet_limit_month') }}"
                                            placeholder="Giới hạn không đến lớp trên tháng"
                                            aria-label="Giới hạn không đến lớp trên tháng" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_p1p2_cancel_time">Thời gian không
                                            được
                                            huỷ lớp (Phút)</label>
                                        <input type="text" class="form-control" id="shareholder_11_p1p2_cancel_time"
                                            name="shareholder_11_p1p2_cancel_time"
                                            value="{{ showValueSystem($data, 'shareholder_11_p1p2_cancel_time') }}"
                                            placeholder="Thời gian không được huỷ lớp (Phút)"
                                            aria-label="Thời gian không được huỷ lớp (Phút)" />
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <label class="badge bg-success bg-glow">
                                Chính sách chế tài
                            </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_suspend_days">Số ngày bị khoá tính năng
                                            shareholder class (kể
                                            từ thời điểm hiện tại)</label>
                                        <input type="text" class="form-control" id="shareholder_suspend_days"
                                            name="shareholder_suspend_days"
                                            value="{{ showValueSystem($data, 'shareholder_suspend_days') }}"
                                            placeholder="Số ngày bị khoá tính năng"
                                            aria-label="Số ngày bị khoá tính năng" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_suspend_days">Số ngày bị khoá
                                            tính
                                            năng shareholder practice (kể từ thời điểm hiện tại)</label>
                                        <input type="text" class="form-control" id="shareholder_practice_suspend_days"
                                            name="shareholder_practice_suspend_days"
                                            value="{{ showValueSystem($data, 'shareholder_practice_suspend_days') }}"
                                            placeholder="Số ngày bị khoá tính năng"
                                            aria-label="Số ngày bị khoá tính năng" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_general_suspend_days">Số ngày bị
                                            khoá
                                            tính năng shareholder 1:1 chung (kể từ thời điểm hiện tại)</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_general_suspend_days"
                                            name="shareholder_11_general_suspend_days"
                                            value="{{ showValueSystem($data, 'shareholder_11_general_suspend_days') }}"
                                            placeholder="Số ngày bị khoá tính năng"
                                            aria-label="Số ngày bị khoá tính năng" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_suspend_days">Số ngày bị
                                            khoá
                                            shareholder 1:1 riêng (kể từ thời điểm hiện tại)</label>
                                        <input type="text" class="form-control"
                                            id="shareholder_11_private_suspend_days"
                                            name="shareholder_11_private_suspend_days"
                                            value="{{ showValueSystem($data, 'shareholder_11_private_suspend_days') }}"
                                            placeholder="Số ngày bị khoá tính năng"
                                            aria-label="Số ngày bị khoá tính năng" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label class="badge bg-success bg-glow">
                                Thông báo trả về cho hệ thống app
                            </label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_cancel_text_show_student">Bạn có chắc
                                            muốn
                                            huỷ lịch đặt này</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__SPAN__</strong>: Bạn có chắc muốn huỷ lịch đặt này, lần huỷ
                                                    cuối cùng bị
                                                    khoá
                                                </li>
                                                <li>
                                                    <strong>__CANCELLED__</strong>: Số lần đã huỷ
                                                </li>
                                                <li>
                                                    <strong>__LIMIT__</strong>: Giới hạn huỷ lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__HOTLINE__</strong>: SĐT hotline của công ty
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_cancel_text_show_student" id="shareholder_cancel_text_show_student" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_cancel_text_show_student']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_cancel_text_show_student">{!! $data['shareholder_cancel_text_show_student']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_cancel_text_show_student"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_cancel_text_show_student" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_cancel_text_show_student">Insert
                                                HTML</button>
                                            <button id="cancelInsert_shareholder_cancel_text_show_student">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_cancel_exceeded_text_show_student">Bạn
                                            có
                                            chắc muốn
                                            huỷ lịch đặt này, lần huỷ cuối cùng bị khoá.</label>
                                        <textarea name="shareholder_cancel_exceeded_text_show_student" id="shareholder_cancel_exceeded_text_show_student"
                                            cols="30" rows="10" style="display: none">{!! $data['shareholder_cancel_exceeded_text_show_student']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_cancel_exceeded_text_show_student">
                                            {!! $data['shareholder_cancel_exceeded_text_show_student']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_cancel_exceeded_text_show_student"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_cancel_exceeded_text_show_student" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_cancel_exceeded_text_show_student">Insert
                                                HTML</button>
                                            <button
                                                id="cancelInsert_shareholder_cancel_exceeded_text_show_student">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_statistic_class">Thống kê CLASS</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__LIMIT__</strong>: Giới hạn huỷ lớp CLASS trên tháng
                                                </li>
                                                <li>
                                                    <strong>__CONDITION_TIME__</strong>: Điều kiện thời gian được phép huỷ
                                                </li>
                                                <li>
                                                    <strong>__BOM__</strong>: Số lần đặt lịch nhưng không đến lớp
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_statistic_class" id="shareholder_statistic_class" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_statistic_class']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_statistic_class">{!! $data['shareholder_statistic_class']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_statistic_class" style="display:none;">
                                            <textarea id="htmlInput_shareholder_statistic_class" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_statistic_class">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_statistic_class">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_statistic_practice">Thống kê
                                            PRACTICE</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__CONDITION_TIME__</strong>: Điều kiện thời gian được phép huỷ
                                                </li>
                                                <li>
                                                    <strong>__BOM__</strong>: Số lần đặt lịch nhưng không đến lớp
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_statistic_practice" id="shareholder_statistic_practice" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_statistic_practice']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_statistic_practice">{!! $data['shareholder_statistic_practice']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_statistic_practice" style="display:none;">
                                            <textarea id="htmlInput_shareholder_statistic_practice" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_statistic_practice">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_statistic_practice">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_general_statistics">Thống kê
                                            shareholder 1:1 Chung</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__CONDITION_TIME__</strong>: Điều kiện thời gian được phép huỷ
                                                </li>
                                                <li>
                                                    <strong>__BOM__</strong>: Số lần đặt lịch nhưng không đến lớp
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_general_statistics" id="shareholder_11_general_statistics" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_general_statistics']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_general_statistics">{!! $data['shareholder_11_general_statistics']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_general_statistics" style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_general_statistics" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_general_statistics">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_11_general_statistics">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_statistics">Thống kê
                                            shareholder 1:1 Riêng</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__CONDITION_TIME__</strong>: Điều kiện thời gian được phép huỷ
                                                </li>
                                                <li>
                                                    <strong>__BOM__</strong>: Số lần đặt lịch nhưng không đến lớp
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_private_statistics" id="shareholder_11_private_statistics" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_private_statistics']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_private_statistics">
                                            {!! $data['shareholder_11_private_statistics']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_private_statistics" style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_private_statistics" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_private_statistics">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_11_private_statistics">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_p1p2_statistics">Thống kê
                                            P1P2</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__CONDITION_TIME__</strong>: Điều kiện thời gian được phép huỷ
                                                </li>
                                                {{-- <li>
                                                    <strong>__BOM__</strong>: Số lần đặt lịch nhưng không đến lớp
                                                </li> --}}
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_p1p2_statistics" id="shareholder_p1p2_statistics" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_p1p2_statistics']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_p1p2_statistics">
                                            {!! $data['shareholder_p1p2_statistics']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_p1p2_statistics" style="display:none;">
                                            <textarea id="htmlInput_shareholder_p1p2_statistics" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_p1p2_statistics">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_p1p2_statistics">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_limit_exceeded">Thông báo giới
                                            hạn</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__EXPIRED__</strong>: Thời gian học viên được mở khoá
                                                    shareholder
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__HOTLINE__</strong>: SĐT hotline của công ty
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_limit_exceeded" id="shareholder_limit_exceeded" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_limit_exceeded']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_limit_exceeded">{!! $data['shareholder_limit_exceeded']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_limit_exceeded" style="display:none;">
                                            <textarea id="htmlInput_shareholder_limit_exceeded" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_limit_exceeded">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_limit_exceeded">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_limit_exceeded">Thông báo giới hạn
                                            shareholder 1-1 chung (General)</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__EXPIRED_1:1__</strong>: Thời gian học viên được mở khoá
                                                    shareholder
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND_1:1__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__HOTLINE_1:1__</strong>: SĐT hotline của công ty
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_limit_exceeded" id="shareholder_11_limit_exceeded" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_11_limit_exceeded']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_limit_exceeded">{!! $data['shareholder_11_limit_exceeded']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_limit_exceeded" style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_limit_exceeded" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_limit_exceeded">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_11_limit_exceeded">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_private_limit_exceeded">Thông báo
                                            giới
                                            hạn
                                            shareholder 1-1 riêng (Private)</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__EXPIRED_1:1__</strong>: Thời gian học viên được mở khoá
                                                    shareholder
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND_1:1__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__HOTLINE_1:1__</strong>: SĐT hotline của công ty
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_private_limit_exceeded" id="shareholder_11_private_limit_exceeded" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_private_limit_exceeded']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_private_limit_exceeded">{!! $data['shareholder_11_private_limit_exceeded']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_private_limit_exceeded"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_private_limit_exceeded" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_private_limit_exceeded">Insert
                                                HTML</button>
                                            <button id="cancelInsert_shareholder_11_private_limit_exceeded">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_11_p1p2_limit_exceeded">Thông báo giới
                                            hạn shareholder P1P2 </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__EXPIRED_1:1__</strong>: Thời gian học viên được mở khoá
                                                    shareholder
                                                </li>
                                                <li>
                                                    <strong>__SUSPEND_1:1__</strong>: Số ngày bị khoá lấy từ system
                                                </li>
                                                <li>
                                                    <strong>__HOTLINE_1:1__</strong>: SĐT hotline của công ty
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_p1p2_limit_exceeded" id="shareholder_11_p1p2_limit_exceeded" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_p1p2_limit_exceeded']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_p1p2_limit_exceeded">{!! $data['shareholder_11_p1p2_limit_exceeded']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_p1p2_limit_exceeded"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_p1p2_limit_exceeded" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_p1p2_limit_exceeded">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_11_p1p2_limit_exceeded">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_cancel_text_show_student">Thông
                                            báo huỷ shareholder lớp PRACTICE</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__CANCELLED__</strong>: Số lần đã huỷ
                                                </li>
                                                <li>
                                                    <strong>__LIMIT__</strong>: Giới hạn huỷ lấy từ system
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_practice_cancel_text_show_student" id="shareholder_practice_cancel_text_show_student"
                                            cols="30" rows="10" style="display: none">{!! $data['shareholder_practice_cancel_text_show_student']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_practice_cancel_text_show_student">
                                            {!! $data['shareholder_practice_cancel_text_show_student']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_practice_cancel_text_show_student"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_practice_cancel_text_show_student" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_practice_cancel_text_show_student">Insert
                                                HTML</button>
                                            <button
                                                id="cancelInsert_shareholder_practice_cancel_text_show_student">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="student_update_request_notice_text">Ghi chú yêu cầu
                                            cập nhật thông tin học viên</label>
                                        <textarea name="student_update_request_notice_text" id="student_update_request_notice_text" cols="30"
                                            rows="10" style="display: none">{!! $data['student_update_request_notice_text']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_student_update_request_notice_text">{!! $data['student_update_request_notice_text']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_student_update_request_notice_text"
                                            style="display:none;">
                                            <textarea id="htmlInput_student_update_request_notice_text" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_student_update_request_notice_text">Insert HTML</button>
                                            <button id="cancelInsert_student_update_request_notice_text">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_cancel_text_show_student">Message huỷ
                                            lớp
                                            trước thời gian băt đâu shareholder 1:1 chung (General) </label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__MINUTES_1:1__</strong>: Thời gian động lấy từ system (Phút)
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_cancel_text_show" id="shareholder_11_cancel_text_show" cols="30" rows="10"
                                            style="display: none">{!! $data['shareholder_11_cancel_text_show']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_cancel_text_show">{!! $data['shareholder_11_cancel_text_show']['content'] ?? '' !!}</div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_cancel_text_show" style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_cancel_text_show" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_cancel_text_show">Insert HTML</button>
                                            <button id="cancelInsert_shareholder_11_cancel_text_show">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label"
                                            for="shareholder_11_private_cancel_text_show_student">Message huỷ lớp
                                            trước thời gian băt đâu 1:1 riêng (Private)</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__MINUTES_1:1__</strong>: Thời gian động lấy từ system (Phút)
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_private_cancel_text_show" id="shareholder_11_private_cancel_text_show" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_private_cancel_text_show']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_private_cancel_text_show">{!! $data['shareholder_11_private_cancel_text_show']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_private_cancel_text_show"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_private_cancel_text_show" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_private_cancel_text_show">Insert
                                                HTML</button>
                                            <button
                                                id="cancelInsert_shareholder_11_private_cancel_text_show">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_cancel_text_show_student">Message huỷ
                                            lớp
                                            trước thời gian băt đâu shareholder P1P2</label>
                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__MINUTES_1:1__</strong>: Thời gian động lấy từ system (Phút)
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_11_p1p2_cancel_text_show" id="shareholder_11_p1p2_cancel_text_show" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_11_p1p2_cancel_text_show']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_11_p1p2_cancel_text_show">{!! $data['shareholder_11_p1p2_cancel_text_show']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_11_p1p2_cancel_text_show"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_11_p1p2_cancel_text_show" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_11_p1p2_cancel_text_show">Insert
                                                HTML</button>
                                            <button id="cancelInsert_shareholder_11_p1p2_cancel_text_show">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_class_cancel_time_message">Message huỷ
                                            lớp
                                            trước thời gian bắt đầu CLASS</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__MINUTES_CLASS__</strong>: Thời gian động lấy từ system (Phút)
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_class_cancel_time_message" id="shareholder_class_cancel_time_message" cols="30"
                                            rows="10" style="display: none">{!! $data['shareholder_class_cancel_time_message']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_class_cancel_time_message">{!! $data['shareholder_class_cancel_time_message']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_class_cancel_time_message"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_class_cancel_time_message" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_class_cancel_time_message">Insert
                                                HTML</button>
                                            <button id="cancelInsert_shareholder_class_cancel_time_message">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="shareholder_practice_cancel_time_message">Message
                                            huỷ
                                            lớp trước thời gian bắt đầu PRACTICE</label>

                                        <div class="notes-container">
                                            <h4 class="notes-title">Ghi chú:</h4>
                                            <ol>
                                                <li>
                                                    <strong>__MINUTES_PRACTICE__</strong>: Thời gian động lấy từ system
                                                    (Phút)
                                                </li>
                                            </ol>
                                        </div>
                                        <textarea name="shareholder_practice_cancel_time_message" id="shareholder_practice_cancel_time_message"
                                            cols="30" rows="10" style="display: none">{!! $data['shareholder_practice_cancel_time_message']['content'] ?? '' !!}</textarea>
                                        <div id="ckeditor_shareholder_practice_cancel_time_message">
                                            {!! $data['shareholder_practice_cancel_time_message']['content'] ?? '' !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_shareholder_practice_cancel_time_message"
                                            style="display:none;">
                                            <textarea id="htmlInput_shareholder_practice_cancel_time_message" rows="10" cols="50"
                                                placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_shareholder_practice_cancel_time_message">Insert
                                                HTML</button>
                                            <button
                                                id="cancelInsert_shareholder_practice_cancel_time_message">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="text_request_class_lesson">
                                            Tiêu đề ở button yêu cầu
                                        </label>
                                        <input type="text" class="form-control" id="text_request_class_lesson"
                                            name="text_request_class_lesson"
                                            value="{{ showValueSystem($data, 'text_request_class_lesson') }}"
                                            placeholder="Tiêu đề ở button yêu cầu"
                                            aria-label="Tiêu đề ở button yêu cầu" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="text_request_confirmation">
                                            Thông báo sau khi gửi thành công yêu cầu
                                        </label>
                                        <input type="text" class="form-control" id="text_request_confirmation"
                                            name="text_request_confirmation"
                                            value="{{ showValueSystem($data, 'text_request_confirmation') }}"
                                            placeholder="Thông báo sau khi gửi thành công yêu cầu"
                                            aria-label="Thông báo sau khi gửi thành công yêu cầu" />
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
    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <!-- /. Plugin Toastr -->

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


            const editorIds = [
                'shareholder_cancel_text_show_student',
                'shareholder_cancel_exceeded_text_show_student',
                'shareholder_statistic_class',
                'shareholder_statistic_practice',
                'shareholder_11_general_statistics',
                'shareholder_11_private_statistics',
                'shareholder_p1p2_statistics',
                'shareholder_limit_exceeded',
                // 'shareholder_practice_cancel_text_show_student',
                'student_update_request_notice_text',
                'shareholder_practice_cancel_time_message',
                'shareholder_class_cancel_time_message',
                'shareholder_11_cancel_text_show',
                'shareholder_11_limit_exceeded',
                'shareholder_11_private_limit_exceeded',
                'shareholder_11_p1p2_limit_exceeded',
                'shareholder_11_private_cancel_text_show',
                'shareholder_11_p1p2_cancel_text_show'
            ];

            const fullToolbar = [
                [{
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                        color: []
                    },
                    {
                        background: []
                    }
                ],
                [{
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [{
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [{
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [{
                    direction: 'rtl'
                }],
                ['link', 'image', 'video', 'formula'],
                ['clean'],
                ['insertHtml'] // Thêm nút "Insert HTML" vào toolbar
            ];

            // Hàm khởi tạo Quill editor
            function initializeQuillEditor(editorId) {
                const editor = new Quill(`#ckeditor_${editorId}`, {
                    bounds: `#ckeditor_${editorId}`,
                    placeholder: 'Type Something...',
                    modules: {
                        formula: true,
                        toolbar: {
                            container: fullToolbar,
                            handlers: {
                                // Hàm xử lý cho button "insertHtml"
                                'insertHtml': function() {
                                    // Hiện hộp nhập HTML
                                    $(`#htmlInputDialog_${editorId}`).show();
                                }
                            }
                        }
                    },
                    theme: 'snow'
                });

                editor.on('text-change', function(delta, oldDelta, source) {
                    console.log(editor.container.firstChild.innerHTML);
                    $(`#${editorId}`).val(editor.container.firstChild.innerHTML);
                });
            }

            // Khởi tạo Quill editor cho từng editorId
            editorIds.forEach(id => {
                initializeQuillEditor(id);
            });

            // Thêm sự kiện cho button "Insert HTML"
            editorIds.forEach(id => {
                $(`#insertHtml_${id}`).on('click', function() {
                    const htmlContent = $(`#htmlInput_${id}`)
                        .val(); // Lấy nội dung HTML từ textarea
                    const delta = editor.clipboard.convert(
                        htmlContent); // Chuyển đổi HTML thành delta
                    const editorInstance = Quill.find(`#ckeditor_${id}`); // Lấy instance của editor
                    editorInstance.setContents(delta); // Chèn nội dung vào editor
                    $(`#htmlInputDialog_${id}`).hide(); // Ẩn hộp thoại
                });

                // Thêm sự kiện cho button "Cancel"
                $(`#cancelInsert_${id}`).on('click', function() {
                    $(`#htmlInputDialog_${id}`).hide(); // Ẩn hộp thoại
                });
            });


            // const fullEditor = new Quill('#ckeditor_shareholder_cancel_text_show_student', {
            //     bounds: '#ckeditor_shareholder_cancel_text_show_student',
            //     placeholder: 'Type Something...',
            //     modules: {
            //         formula: true,
            //         toolbar: fullToolbar
            //     },
            //     theme: 'snow'
            // });

            // fullEditor.on('text-change', function(delta, oldDelta, source) {
            //     console.log(fullEditor.container.firstChild.innerHTML);
            //     $('#shareholder_cancel_text_show_student').val(fullEditor.container.firstChild.innerHTML);
            // });
        });
    </script>
    <!-- /. Index JS -->
@endpush
