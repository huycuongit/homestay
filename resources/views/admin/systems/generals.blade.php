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

        .dropzone {
            text-align: center;
        }

        .dz-preview {
            margin-right: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" id="form-form"
            action="{{ route('admin.systems.update') }}">
            <div class="row">
                <div class="col-md-8">
                    <h3>Thông tin chung</h3>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light float-end">Lưu</button>
                    <button type="button" data-url="" class="btn btn-label-secondary waves-effect float-end btn-cancel">
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
                    <div class="nav-align-top nav-tabs-shadow mb-6">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect active" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#navs-top-general" aria-controls="navs-top-general"
                                    aria-selected="true">
                                    General
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="false"
                                    tabindex="-1">
                                    Trang chủ
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-top-about" aria-controls="navs-top-about" aria-selected="false"
                                    tabindex="-1">
                                    Giới thiệu
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-top-messages" aria-controls="navs-top-messages"
                                    aria-selected="false" tabindex="-1">
                                    Messages
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-top-general" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="logo_app">
                                            Logo
                                        </label>
                                        <div action="/upload" class="dropzone needsclick" id="dropzone-logo_app"
                                            data-hidden-input-id="logo_app">
                                            <div class="dz-message needsclick">
                                                Kéo file hoặc click để upload
                                                <span class="note needsclick">(Đây chỉ là một vùng thả demo. Các tập tin
                                                    được
                                                    chọn là
                                                    <span class="fw-medium">không</span> thực sự đã được tải lên.)
                                                </span>
                                            </div>
                                            <div class="fallback">
                                                <div class="fallback">
                                                    <input name="c_logo_app" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <input name="logo_app" type="hidden" id="logo_app"
                                            value="{{ isset($data) && isset($data['logo_app']) ? Storage::url($data['logo_app']['content']) : '' }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="banner_app">
                                            Banner
                                        </label>
                                        <div action="/upload" class="dropzone needsclick" id="dropzone-banner_app"
                                            data-hidden-input-id="banner_app">
                                            <div class="dz-message needsclick">
                                                Kéo file hoặc click để upload
                                                <span class="note needsclick">(Đây chỉ là một vùng thả demo. Các tập tin
                                                    được
                                                    chọn là
                                                    <span class="fw-medium">không</span> thực sự đã được tải lên.)
                                                </span>
                                            </div>
                                            <div class="fallback">
                                                <input name="c_banner_app" type="file" />
                                            </div>
                                        </div>
                                        <input name="banner_app" type="hidden" id="banner_app"
                                            value="{{ isset($data) && isset($data['banner_app']) ? Storage::url($data['banner_app']['content']) : '' }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_name">Tên công ty</label>
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name" value="{{ showValueSystem($data, 'company_name') }}"
                                                placeholder="Tên công ty" aria-label="Tên công ty" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_address">Địa chỉ công ty</label>
                                            <input type="text" class="form-control" id="company_address"
                                                name="company_address"
                                                value="{{ showValueSystem($data, 'company_address') }}"
                                                placeholder="Địa chỉ công ty" aria-label="Địa chỉ công ty" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_copyright">Copy right</label>
                                            <input type="text" class="form-control" id="company_copyright"
                                                name="company_copyright"
                                                value="{{ showValueSystem($data, 'company_copyright') }}"
                                                placeholder="Copy right" aria-label="Copy right" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_email">Email công ty</label>
                                            <input type="text" class="form-control" id="company_email"
                                                name="company_email"
                                                value="{{ showValueSystem($data, 'company_email') }}"
                                                placeholder="Email công ty" aria-label="Email công ty" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_hotline">Hotline công ty 1</label>
                                            <input type="text" class="form-control" id="company_hotline"
                                                name="company_hotline"
                                                value="{{ showValueSystem($data, 'company_hotline') }}"
                                                placeholder="Hotline công ty" aria-label="Hotline công ty" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_hotline_2">Hotline công ty 2</label>
                                            <input type="text" class="form-control" id="company_hotline_2"
                                                name="company_hotline_2"
                                                value="{{ showValueSystem($data, 'company_hotline_2') }}"
                                                placeholder="Hotline công ty" aria-label="Hotline công ty" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_introduce">Giới thiệu Footer</label>
                                            <textarea class="form-control" id="company_introduce"
                                                name="company_introduce"
                                                rows="4"
                                                placeholder="Giới thiệu"
                                                aria-label="Giới thiệu">{{ showValueSystem($data, 'company_introduce') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-12 mb-6">
                                            <label class="form-label" for="company_map">Iframe map</label>
                                            <input type="text" class="form-control" id="company_map"
                                                name="company_map"
                                                value="{{ showValueSystem($data, 'company_map') }}"
                                                placeholder="Iframe map" aria-label="Iframe map" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-home" role="tabpanel">
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Cam kết
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="commit_title">
                                                        Tiêu đề
                                                    </label>
                                                    <textarea name="commit_title" id="commit_title" cols="30" rows="10" style="display: none">{!! $data['commit_title']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_commit_title">{!! $data['commit_title']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_commit_title" style="display:none;">
                                                    <textarea id="htmlInput_commit_title" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_commit_title">Insert HTML</button>
                                                    <button id="cancelInsert_commit_title">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="commit_description">
                                                        Mô tả
                                                    </label>
                                                    <textarea name="commit_description" id="commit_description" cols="30" rows="10" style="display: none">{!! $data['commit_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_commit_description">{!! $data['commit_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_commit_description" style="display:none;">
                                                    <textarea id="htmlInput_commit_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_commit_description">Insert HTML</button>
                                                    <button id="cancelInsert_commit_description">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Hình ảnh hoạt động
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="gallery_title">
                                                        Tiêu đề
                                                    </label>
                                                    <textarea name="gallery_title" id="gallery_title" cols="30" rows="10" style="display: none">{!! $data['gallery_title']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_gallery_title">{!! $data['gallery_title']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_gallery_title" style="display:none;">
                                                    <textarea id="htmlInput_gallery_title" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_gallery_title">Insert HTML</button>
                                                    <button id="cancelInsert_gallery_title">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="gallery_description">
                                                        Mô tả
                                                    </label>
                                                    <textarea name="gallery_description" id="gallery_description" cols="30" rows="10" style="display: none">{!! $data['gallery_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_gallery_description">{!! $data['gallery_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_gallery_description" style="display:none;">
                                                    <textarea id="htmlInput_gallery_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_gallery_description">Insert HTML</button>
                                                    <button id="cancelInsert_gallery_description">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-gallery_img_1"
                                                            data-hidden-input-id="gallery_img_1">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_gallery_img_1" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="gallery_img_1" type="hidden" id="gallery_img_1"
                                                            value="{{ isset($data) && isset($data['gallery_img_1']) ? Storage::url($data['gallery_img_1']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-gallery_img_2"
                                                            data-hidden-input-id="gallery_img_2">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_gallery_img_2" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="gallery_img_2" type="hidden" id="gallery_img_2"
                                                            value="{{ isset($data) && isset($data['gallery_img_2']) ? Storage::url($data['gallery_img_2']['content']) : '' }}" />
                                                    </div>


                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-gallery_img_3"
                                                            data-hidden-input-id="gallery_img_3">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_gallery_img_3" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="gallery_img_3" type="hidden" id="gallery_img_3"
                                                            value="{{ isset($data) && isset($data['gallery_img_3']) ? Storage::url($data['gallery_img_3']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-gallery_img_4"
                                                            data-hidden-input-id="gallery_img_4">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_gallery_img_4" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="gallery_img_4" type="hidden" id="gallery_img_4"
                                                            value="{{ isset($data) && isset($data['gallery_img_4']) ? Storage::url($data['gallery_img_4']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-gallery_img_5"
                                                            data-hidden-input-id="gallery_img_5">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_gallery_img_5" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="gallery_img_5" type="hidden" id="gallery_img_5"
                                                            value="{{ isset($data) && isset($data['gallery_img_5']) ? Storage::url($data['gallery_img_5']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Công trình đã thi công
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="project_title">
                                                        Tiêu đề
                                                    </label>
                                                    <textarea name="project_title" id="project_title" cols="30" rows="10" style="display: none">{!! $data['project_title']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_project_title">{!! $data['project_title']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_project_title" style="display:none;">
                                                    <textarea id="htmlInput_project_title" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_project_title">Insert HTML</button>
                                                    <button id="cancelInsert_project_title">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="project_description">
                                                        Mô tả
                                                    </label>
                                                    <textarea name="project_description" id="project_description" cols="30" rows="10" style="display: none">{!! $data['project_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_project_description">{!! $data['project_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_project_description" style="display:none;">
                                                    <textarea id="htmlInput_project_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_project_description">Insert HTML</button>
                                                    <button id="cancelInsert_project_description">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-project_img_1"
                                                            data-hidden-input-id="project_img_1">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_project_img_1" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="project_img_1" type="hidden" id="project_img_1"
                                                            value="{{ isset($data) && isset($data['project_img_1']) ? Storage::url($data['project_img_1']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-project_img_2"
                                                            data-hidden-input-id="project_img_2">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_project_img_2" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="project_img_2" type="hidden" id="project_img_2"
                                                            value="{{ isset($data) && isset($data['project_img_2']) ? Storage::url($data['project_img_2']['content']) : '' }}" />
                                                    </div>


                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-project_img_3"
                                                            data-hidden-input-id="project_img_3">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_project_img_3" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="project_img_3" type="hidden" id="project_img_3"
                                                            value="{{ isset($data) && isset($data['project_img_3']) ? Storage::url($data['project_img_3']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-project_img_4"
                                                            data-hidden-input-id="project_img_4">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_project_img_4" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="project_img_4" type="hidden" id="project_img_4"
                                                            value="{{ isset($data) && isset($data['project_img_4']) ? Storage::url($data['project_img_4']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-project_img_5"
                                                            data-hidden-input-id="project_img_5">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_project_img_5" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="project_img_5" type="hidden" id="project_img_5"
                                                            value="{{ isset($data) && isset($data['project_img_5']) ? Storage::url($data['project_img_5']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Dịch vụ
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="service_title">
                                                        Tiêu đề
                                                    </label>
                                                    <textarea name="service_title" id="service_title" cols="30" rows="10" style="display: none">{!! $data['service_title']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_service_title">{!! $data['service_title']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_service_title" style="display:none;">
                                                    <textarea id="htmlInput_service_title" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_service_title">Insert HTML</button>
                                                    <button id="cancelInsert_service_title">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="service_description">
                                                        Mô tả
                                                    </label>
                                                    <textarea name="service_description" id="service_description" cols="30" rows="10" style="display: none">{!! $data['service_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_service_description">{!! $data['service_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_service_description" style="display:none;">
                                                    <textarea id="htmlInput_service_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_service_description">Insert HTML</button>
                                                    <button id="cancelInsert_service_description">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Thương hiệu
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="brand_title">
                                                        Tiêu đề
                                                    </label>
                                                    <textarea name="brand_title" id="brand_title" cols="30" rows="10" style="display: none">{!! $data['brand_title']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_brand_title">{!! $data['brand_title']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_brand_title" style="display:none;">
                                                    <textarea id="htmlInput_brand_title" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_brand_title">Insert HTML</button>
                                                    <button id="cancelInsert_brand_title">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="brand_description">
                                                        Mô tả
                                                    </label>
                                                    <textarea name="brand_description" id="brand_description" cols="30" rows="10" style="display: none">{!! $data['brand_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_brand_description">{!! $data['brand_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_brand_description" style="display:none;">
                                                    <textarea id="htmlInput_brand_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_brand_description">Insert HTML</button>
                                                    <button id="cancelInsert_brand_description">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="col-md-12">
                                                        <div action="/upload" class="dropzone needsclick"
                                                            id="dropzone-brand_img_1" data-hidden-input-id="brand_img_1">
                                                            <div class="dz-message needsclick">
                                                                Kéo file hoặc click để upload
                                                                <span class="note needsclick">(Đây chỉ là một vùng thả
                                                                    demo. Các
                                                                    tập tin
                                                                    được
                                                                    chọn là
                                                                    <span class="fw-medium">không</span> thực sự đã được
                                                                    tải lên.)
                                                                </span>
                                                            </div>
                                                            <div class="fallback">
                                                                <div class="fallback">
                                                                    <input name="c_brand_img_1" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input name="brand_img_1" type="hidden" id="brand_img_1"
                                                            value="{{ isset($data) && isset($data['brand_img_1']) ? Storage::url($data['brand_img_1']['content']) : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="col-12 mb-6">
                                                        <label class="form-label" for="brand_content">
                                                            Nội dung
                                                        </label>
                                                        <textarea name="brand_content" id="brand_content" cols="30" rows="10" style="display: none">{!! $data['brand_content']['content'] ?? '' !!}</textarea>
                                                        <div id="ckeditor_brand_content">{!! $data['brand_content']['content'] ?? '' !!}</div>
                                                    </div>
                                                    <div id="htmlInputDialog_brand_content" style="display:none;">
                                                        <textarea id="htmlInput_brand_content" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                        <button id="insertHtml_brand_content">Insert HTML</button>
                                                        <button id="cancelInsert_brand_content">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-about" role="tabpanel">
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <label class="badge bg-success bg-glow">
                                            Giám đốc
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="director_name">
                                                        Tên giám đốc
                                                    </label>
                                                    <textarea name="director_name" id="director_name" cols="30" rows="10" style="display: none">{!! $data['director_name']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_director_name">{!! $data['director_name']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_director_name" style="display:none;">
                                                    <textarea id="htmlInput_director_name" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_director_name">Insert HTML</button>
                                                    <button id="cancelInsert_director_name">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-12 mb-6">
                                                    <label class="form-label" for="director_description">
                                                        Trích dẫn
                                                    </label>
                                                    <textarea name="director_description" id="director_description" cols="30" rows="10"
                                                        style="display: none">{!! $data['director_description']['content'] ?? '' !!}</textarea>
                                                    <div id="ckeditor_director_description">{!! $data['director_description']['content'] ?? '' !!}</div>
                                                </div>
                                                <div id="htmlInputDialog_director_description" style="display:none;">
                                                    <textarea id="htmlInput_director_description" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                                    <button id="insertHtml_director_description">Insert HTML</button>
                                                    <button id="cancelInsert_director_description">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div action="/upload" class="dropzone needsclick"
                                                    id="dropzone-director_image" data-hidden-input-id="director_image">
                                                    <div class="dz-message needsclick">
                                                        Kéo file hoặc click để upload
                                                        <span class="note needsclick">(Đây chỉ là một vùng thả demo. Các
                                                            tập tin
                                                            được
                                                            chọn là
                                                            <span class="fw-medium">không</span> thực sự đã được tải lên.)
                                                        </span>
                                                    </div>
                                                    <div class="fallback">
                                                        <div class="fallback">
                                                            <input name="c_director_image" type="file" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="director_image" type="hidden" id="director_image"
                                                    value="{{ isset($data) && isset($data['director_image']) ? Storage::url($data['director_image']['content']) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                                <p>
                                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon
                                    gummies
                                    cupcake gummi bears cake chocolate.
                                </p>
                                <p class="mb-0">
                                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                                    Sweet
                                    roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding
                                    jelly
                                    jelly-o tart brownie jelly.
                                </p>
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

    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>

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
                'service_title',
                'service_description',
                'brand_title',
                'brand_description',
                'brand_content',
                'gallery_title',
                'gallery_description',
                'project_title',
                'project_description',
                'commit_title',
                'commit_description',
                'director_name',
                'director_description',
                'core_value',
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
        });
    </script>
    <!-- /. Index JS -->
@endpush
