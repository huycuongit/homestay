<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/admin/assets" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login HoangGiang | ADMIN</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />

    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-auth.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/animate-css/animate.css') }}" />

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <style>
        .input-error {
            border: 1px solid red;
            outline: red;
        }

        .grecaptcha-badge {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="app-brand auth-cover-brand">
            <span class="app-brand-logo demo">
                <img width="40" height="40" src="{{ asset('assets/admin/img/logo.png') }}"
                    alt="logo-admin">

                {{-- <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#1993E6" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#1993E6" />
                </svg> --}}
            </span>
            <span class="app-brand-text demo text-heading fw-bold">HoangGiang | ADMIN</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-8 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/admin/img/illustrations/auth-login-illustration-light.png') }}"
                        alt="auth-login-cover" class="my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                    <img src="{{ asset('assets/admin/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-login-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Welcome to Admin! 👋</h4>
                    <p class="mb-6">Vui lòng đăng nhập tài khoản và bắt đầu quản trị</p>

                    <form id="form-form" class="mb-6" action="" method="POST">
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <div class="mb-6">
                            <label for="email" class="form-label">Tài khoản (Email)</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email or username" autofocus />
                        </div>
                        <div class="mb-6 form-password-toggle">
                            <label class="form-label" for="password">Mật Khẩu</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="my-8">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Ghi nhớ đăng nhập </label>
                                </div>
                                <a href="auth-forgot-password-cover.html">
                                    <p class="mb-0">Quên mật khẩu?</p>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100 btn-login">Đăng nhập</button>
                    </form>

                    {{-- <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="auth-register-cover.html">
                            <span>Create an account</span>
                        </a>
                    </p>

                    <div class="divider my-6">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                            <i class="tf-icons ti ti-brand-facebook-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                            <i class="tf-icons ti ti-brand-twitter-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                            <i class="tf-icons ti ti-brand-github-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
                            <i class="tf-icons ti ti-brand-google-filled"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login -->

            <input type="hidden" value="{{ route('admin.save.login') }}" id="oSVPPhgRiSSPp6D">
            <input type="hidden" value="{{ route('admin.dashboard.index') }}" id="oSVPPhgRiSSPp6D-dashboard">
            <input type="hidden"
                value="{{ showSetting($arrSetups, 'google_recaptcha_site_key', '6Ldt3v8pAAAAAEiFTCf9ku-YeOppS4qWMP41aUNN') }}"
                id="recaptcha-key">
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/admin/js/pages-auth.js') }}"></script>


    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- /. jQuery -->

    <!-- Recaptcha -->
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ showSetting($arrSetups, 'google_recaptcha_site_key', '6Ldt3v8pAAAAAEiFTCf9ku-YeOppS4qWMP41aUNN') }}">
    </script>
    <!-- /. Recaptcha -->

    <!-- Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- /. Validate -->

    <!-- Toastr -->
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <!-- /. Toastr -->

    <script>
        //-- Func form login
        function fomrLogin() {
            var _idForm = $('#form-form');
            $(_idForm).validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 255
                    },
                    password: {
                        required: true,
                        maxlength: 255
                    }
                },
                messages: {
                    email: {
                        required: "Vui lòng nhập thông tin email",
                        maxlength: "Trường email không quá 255 ký tự"
                    },
                    password: {
                        required: "Vui lòng nhập thông tin mật khẩu",
                        maxlength: "Trường mật khẩu không vượt quá 20 ký tự"
                    }
                },
                highlight: function(input) {
                    $(input).addClass("input-error");
                },
                unhighlight: function(input) {
                    $(input).removeClass("input-error");
                },
                errorPlacement: function(error, input) {
                    $(input).parents('.form-group').append(error);
                },
                submitHandler: function(form) {
                    var _recaptchaKey = $('#recaptcha-key').val();
                    grecaptcha.ready(function() {
                        try {
                            grecaptcha.execute(_recaptchaKey, {
                                    action: 'submit'
                                })
                                .then(function(token) {
                                    $('#g-recaptcha-response').val(token);
                                    funcLogin(form);
                                });
                        } catch (error) {
                            toastr.error('Lỗi xác thực Google reCAPTCHA. Kiểm tra site key hoặc mạng.');
                            console.error('reCAPTCHA error:', error);
                        }
                    });
                }
            });

            $(_idForm).keypress((e) => {
                if (e.which === 13) {
                    _idForm.submit();
                }
            });
        }

        function getResponseMessage(resp, form_name = "", url = "") {
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

            if (resp.status == '200') {
                toastr.success(resp.success);
                if (form_name != "") {
                    document.getElementById(form_name).reset();
                }
                if (url != "") {
                    setTimeout(function() {
                        window.location.replace(url);
                    }, 500);
                }
            } else {
                var obj = resp.errors;
                if (typeof obj === 'string') {
                    toastr.error(obj);
                } else {
                    $.each(obj, function(i, e) {
                        toastr.error(e);
                    });
                }
            }
        }

        //-- Func submit
        function funcLogin() {
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

            $("#dvloader").show();
            var _idContactForm = $('#form-form');
            var _actionURL = $('#oSVPPhgRiSSPp6D').val();
            var _actionDashboardURL = $('#oSVPPhgRiSSPp6D-dashboard').val();
            var _formData = $(_idContactForm).serialize();

            console.log('dữ liệu');
            console.log(_formData);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: _actionURL,
                data: _formData,
                success: function(resp) {
                    $("#dvloader").hide();
                    getResponseMessage(resp, 'form-form', _actionDashboardURL);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#dvloader").hide();
                    toastr.error(errorThrown.msg, 'failed');
                }
            });
        }

        function initPasswordToggle() {
            const toggler = document.querySelectorAll('.form-password-toggle i')
            if (typeof toggler !== 'undefined' && toggler !== null) {
                toggler.forEach(el => {
                    el.addEventListener('click', e => {
                        e.preventDefault()
                        const formPasswordToggle = el.closest('.form-password-toggle')
                        const formPasswordToggleIcon = formPasswordToggle.querySelector('i')
                        const formPasswordToggleInput = formPasswordToggle.querySelector('input')

                        if (formPasswordToggleInput.getAttribute('type') === 'text') {
                            formPasswordToggleInput.setAttribute('type', 'password')
                            formPasswordToggleIcon.classList.replace('ti-eye', 'ti-eye-off')
                        } else if (formPasswordToggleInput.getAttribute('type') === 'password') {
                            formPasswordToggleInput.setAttribute('type', 'text')
                            formPasswordToggleIcon.classList.replace('ti-eye-off', 'ti-eye')
                        }
                    })
                })
            }
        }

        $(function() {
            fomrLogin();
            $('.btn-login').on('click', function(e) {
                e.preventDefault();
                $('#form-form').submit();
            });
            initPasswordToggle();
        });
    </script>
</body>

</html>
