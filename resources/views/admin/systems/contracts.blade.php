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
                    <h3>Hợp đồng</h3>
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
                            {{-- <label class="badge bg-success bg-glow">
                                shareholder Class
                            </label> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="contract_reminder_days_remaining">Số ngày cập nhật
                                            trạng thái "Sắp hết hạn":</label>
                                        <input type="text" class="form-control" id="contract_reminder_days_remaining"
                                            name="contract_reminder_days_remaining"
                                            value="{{ showValueSystem($data, 'contract_reminder_days_remaining') }}"
                                            placeholder="Số ngày cập nhật trạng thái"
                                            aria-label="Số ngày cập nhật trạng thái" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-12 mb-6">
                                        <label class="form-label" for="contract_duration_1_1">Thời hạn buổi học 1-1:</label>
                                        <input type="text" class="form-control" id="contract_duration_1_1"
                                            name="contract_duration_1_1"
                                            value="{{ showValueSystem($data, 'contract_duration_1_1') }}"
                                            placeholder="Thời hạn buổi học 1-1" aria-label="Thời hạn buổi học 1-1" />
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

            // const fullToolbar = [
            //     [{
            //             font: []
            //         },
            //         {
            //             size: []
            //         }
            //     ],
            //     ['bold', 'italic', 'underline', 'strike'],
            //     [{
            //             color: []
            //         },
            //         {
            //             background: []
            //         }
            //     ],
            //     [{
            //             script: 'super'
            //         },
            //         {
            //             script: 'sub'
            //         }
            //     ],
            //     [{
            //             header: '1'
            //         },
            //         {
            //             header: '2'
            //         },
            //         'blockquote',
            //         'code-block'
            //     ],
            //     [{
            //             list: 'ordered'
            //         },
            //         {
            //             list: 'bullet'
            //         },
            //         {
            //             indent: '-1'
            //         },
            //         {
            //             indent: '+1'
            //         }
            //     ],
            //     [{
            //         direction: 'rtl'
            //     }],
            //     ['link', 'image', 'video', 'formula'],
            //     ['clean']
            // ];


            const editorIds = [
                'shareholder_cancel_text_show_student',
                'shareholder_cancel_exceeded_text_show_student',
                'shareholder_statistic_class',
                'shareholder_statistic_practice',
                'shareholder_limit_exceeded',
                // 'shareholder_practice_cancel_text_show_student',
                'student_update_request_notice_text',
                'shareholder_practice_cancel_time_message',
                'shareholder_class_cancel_time_message',
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
