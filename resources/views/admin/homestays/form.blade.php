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
        <input type="hidden" id="booking-future"
            value={{ isset($data) && $data->booking_future ? $data->booking_future : 0 }}>
        <input type="hidden" id="booking-exits"
            value={{ isset($data) && $data->booking_exits ? $data->booking_exits : 0 }}>

        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" id="form-form"
            action="{{ isset($data) ? route('admin.services.update', ['id' => $data->id]) : route('admin.services.store') }}">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ isset($data) ? (request()->has('is_view') ? 'Thông tin dịch vụ' : 'Cập nhật dịch vụ') : 'Tạo mới dịch vụ' }}
                    </h3>
                </div>
                @if (!request()->has('is_view'))
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-end">Lưu</button>
                        <button type="button" data-url="{{ route('admin.services.index') }}"
                            class="btn btn-label-secondary waves-effect float-end btn-cancel">
                            Huỷ
                        </button>
                    </div>
                @else
                    @if ($data->booking_future <= 0)
                        <div class="col-md-4">
                            <button type="button" data-url="{{ route('admin.services.edit', ['id' => $data->id]) }}"
                                class="btn btn-primary waves-effect waves-light float-end btn-edit">
                                Chỉnh sửa
                            </button>
                        </div>
                    @endif
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

                <!-- Info Branch -->
                <div class="col-12" style="pointer-events: {{ request()->has('is_view') ? 'none' : 'unset' }}">
                    <div class="card mb-6">
                        <h5 class="card-header">Hình ảnh</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- Dropzone container -->
                                    <div action="/upload" class="dropzone needsclick" id="dropzone-avatar"
                                        data-hidden-input-id="avatar"
                                        style="">
                                        <div class="dz-message needsclick">
                                            Kéo file hoặc click để upload
                                            <span class="note needsclick">(Đây chỉ là một vùng thả demo. Các tập tin được
                                                chọn
                                                là
                                                <span class="fw-medium">không</span> thực sự đã được tải lên.)
                                            </span>
                                        </div>
                                        <!-- Fallback input for browsers that don't support Dropzone -->
                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>
                                    </div>
                                    <!-- Hidden input to store file URLs -->
                                    <input type="hidden" id="avatar" name="avatar" value="{{ old('avatar', isset($data) && $data->avatar ? Storage::url($data->avatar) : '') }}" />

                                </div>
                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-6">
                                                <label class="form-label" for="title">
                                                    Tên dịch vụ
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ isset($data) && $data->title ? $data->title : old('title') }}"
                                                    placeholder="Tên dịch vụ" aria-label="Tên dịch vụ" />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 mb-6">
                                                <label for="description" class="form-label">Mô tả</label>
                                                <textarea class="form-control" id="description" rows="4" name="description" placeholder="Mô tả">{{ old('description', isset($data) ? checkValue($data, 'description') : '') }}</textarea>
                                            </div>
                                            <div class="col-md-4 mb-6 mt-6">
                                                <div class="row dayone-control-active">
                                                    <div class="col-sm-6 p-3">
                                                        <div class="text-light small fw-medium mb-4">Kích hoạt</div>
                                                    </div>
                                                    <div class="col-sm-6 p-3">
                                                        <div class="form-check form-switch mb-2 dayone-active">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="active" name="active" value="1"
                                                                {{ isset($data) ? ($data->active ? 'checked' : '') : 'checked' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-md-12">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="content">Nội dung</label>
                                        <span class="text-danger">*</span>
                                        <textarea name="content" id="content" cols="30" rows="10" style="display: none">{!! old('content', $data['content'] ?? '') !!}</textarea>
                                        <div id="ckeditor_content">{!! old('content', $data['content'] ?? '') !!}
                                        </div>

                                        <!-- Hộp nhập HTML cho editor này -->
                                        <div id="htmlInputDialog_content" style="display:none;">
                                            <textarea id="htmlInput_content" rows="10" cols="50" placeholder="Paste your HTML here..."></textarea>
                                            <button id="insertHtml_content">Insert
                                                HTML</button>
                                            <button id="cancelInsert_content">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SEO -->
                            <x-admin.admin-meta-data :metaData="isset($metaData) ? $metaData : null"/>
                            <!-- /. SEO -->
                        </div>
                    </div>
                </div>
                <!-- /. Info Branch -->
            </div>
        </form>
    </div>

    <!-- url action -->
    <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="branch-id">
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

    <!-- Plugin Toastr -->
    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
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
                    const methodField = _form.querySelector('input[name="_method"]');
                    const isEditMode = methodField && methodField.value === 'PUT';
                    console.log("🚀 ~ $ ~ isEditMode:", isEditMode)

                    fv = FormValidation.formValidation(_form, {
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng nhập tên dịch vụ'
                                    }
                                }
                            },
                            avatar: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng chọn hình ảnh'
                                    }
                                }
                            },
                            content: {
                                validators: {
                                    notEmpty: {
                                        message: 'Vui lòng nhập nội dung'
                                    },
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

        function disableInputs() {
            if (window.location.search.includes('is_view=true')) {
                $('input, textarea, select, button').not('.btn-edit').prop('disabled', true);
                $('.dropzone').addClass('disabled');
            }
        }

        function disablePublishTime() {
            const isView = window.location.search.includes('is_view=true');
            const isCreatePath = window.location.pathname.includes('create');

            if (!isView && !isCreatePath) {
                checkPublishTimeAndStatus();
            }
        }

        function checkPublishTimeAndStatus() {
            const publishTime = $('#publish_time').val();
            const active = $('#active').is(':checked') ? 1 : 0;

            const currentTime = moment();
            const publishDateTime = moment(publishTime);

            if (publishDateTime.isSameOrBefore(currentTime, 'second')) {
                if (active === 1) {
                    $('#publish_time').prop('disabled', true);
                } else {
                    $('#publish_time').prop('disabled', false);
                }
            } else {
                $('#publish_time').prop('disabled', false);
            }
        }


        $(function() {
            submitForm();
            btnAll();
            disableInputs();
            disablePublishTime();

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
                                name: 'Ảnh dịch vụ',
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
                'content',
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
