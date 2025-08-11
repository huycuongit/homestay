<!DOCTYPE html>
<html lang="vi">
    @include('frontend.layouts.partials.head')
	<body class="" style="">
		@include('frontend.layouts.partials.header')
		
        @yield('content')
        
    	@include('frontend.layouts.partials.modals')

        @include('frontend.layouts.partials.footer')
	</body>
	
	<!-- Bootstrap JS for responsive components -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- jQuery for DOM manipulation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- jQuery UI for additional UI widgets -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Moment.js for date manipulation -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<!-- Select2 for enhanced select boxes -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- Date Range Picker for selecting date ranges -->
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->

	<!-- SweetAlert2 for alerts -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Google reCAPTCHA for spam protection -->
	<script src="https://www.google.com/recaptcha/api.js?render={!! isset($arrSetups) && isset($arrSetups['google_recaptcha_site_key']) ? $arrSetups['google_recaptcha_site_key'] : '' !!}"></script>

	<!-- jQuery Validate for form validation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

	<!-- Tabler icon -->
	<!-- {{-- <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script> --}} -->

	<!-- <script type="text/javascript" src="{{ asset('assets/g2NGR9bO4SHoGfq/g2NGR9bO4SHoGfq.js') }} "></script> -->
    <input type="hidden" id="url-logout" value="{{ route('auth.logout') }}" />

    <script>
        // //-- Func contact
		// function quickApplyModal() {
		// 	var _quickApplyModal = $('#quickApplyModal');
		// 	var _idContactForm = $('#quick-apply-form');
		// 	$('.btn-quick-apply').on("click", function (e) {
				
		// 		e.preventDefault();
        //         $(_idContactForm)[0].reset();
        //         $(_idContactForm).validate().resetForm();
        //         $(_idContactForm).find('select.error').removeClass('error');
        //         $(_idContactForm).find('input.error').removeClass('error');

		// 		_quickApplyModal.modal('show');
		// 	});
        //     $.validator.addMethod("filesize", function(value, element, param) {
        //         if (element.files.length === 0) {
        //             return true;
        //         }
        //         var size = element.files[0].size / 1024;
        //         return this.optional(element) || (size <= param);
        //     });
        //     $.validator.addMethod("extension", function(value, element, param) {
        //         var fileExtension = value.split('.').pop().toLowerCase();
        //         return this.optional(element) || param.indexOf(fileExtension) !== -1;
        //     }, "Vui lòng nhập tệp có phần mở rộng hợp lệ.");

        //     $.validator.addMethod("dateFormat", function(value, element) {
        //         return this.optional(element) || /^\d{2}\/\d{2}\/\d{4}$/.test(value);
        //     }, "Vui lòng nhập ngày sinh đúng định dạng dd/mm/yyyy.");
		// 	$(_idContactForm).validate({
        //         rules: {
        //             cv: {
        //                 extension: "pdf",
        //                 filesize: 3072
        //             },
        //             another_file: {
        //                 filesize: 3072,
        //                 extension: "pdf,doc,docx,xls,xlsx,ppt,pptx",
        //             },
        //             first_name: {
        //                 required: true,
        //                 maxlength: 255
        //             },
        //             last_name: {
        //                 required: true,
        //                 maxlength: 255
        //             },
        //             dob: {
        //                 required: true,
        //                 dateFormat: true,
        //             },
        //             gender: {
        //                 required: true,
        //                 maxlength: 10
        //             },
        //             email: {
        //                 required: true,
        //                 email: true,
        //                 maxlength: 100
        //             },
        //             phone: {
        //                 required: true,
        //                 maxlength: 11,
        //                 minlength: 10
        //             },
		// 			career_id: {
        //                 required: true
        //             },
        //             job_type: {
        //                 required: true
        //             },
        //             work_unit: {
        //                 required: true
        //             }
        //         },
        //         messages: {
        //             first_name: {
        //                 required: "Vui lòng nhập thông tin họ và tên lót",
        //                 maxlength: "Trường họ tên không quá 255 ký tự"
        //             },
        //             last_name: {
        //                 required: "Vui lòng nhập thông tin tên",
        //                 maxlength: "Trường họ tên không quá 255 ký tự"
        //             },
        //             dob: {
        //                 required: "Vui lòng nhập thông tin ngày sinh",
        //             },
        //             gender: {
        //                 required: "Vui lòng chọn giới tính",
        //             },
        //             email: {
        //                 required: "Vui lòng nhập thông tin email",
        //                 email: "Vui lòng nhập địa chỉ email hợp lệ",
        //                 maxlength: "Trường số email không vượt quá 100 ký tự",
        //             },
        //             phone: {
        //                 required: "Vui lòng nhập thông tin số điện thoại",
        //                 maxlength: "Trường số điện thoại không vượt quá 11 ký tự",
        //                 minlength: "Trường số điện thoại không ít hơn 10 ký tự"
        //             },
        //             cv: {
        //                 extension: "Vui lòng file đúng định dạng.",
        //                 filesize: "Vui lòng sử dụng file có kích thước < 3MB"
        //             },
        //             another_file: {
        //                 filesize: "Vui lòng sử dụng file có kích thước < 3MB"
        //             },
        //             career_id: {
        //                 required: "Vui lòng chọn vị trí làm việc",
        //             },
        //             job_type: {
        //                 required: "Vui lòng chọn phòng ban",
        //             },
        //             work_unit: {
        //                 required: "Vui lòng chọn khối làm việc",
        //             }
        //         },

        //         errorPlacement: function(error, element) {
        //             if (element.attr("name") === "cv") {
        //                 $('#modal-cv-error-message').html(error); 
        //                 $('#modal-cv-file-name').hide();
        //             } else if (element.attr("name") === "another_file") {
        //                 $('#modal-another-file-error-message').html(error); 
        //                 $('#modal-another-file-name').hide();
        //             } else {
        //                 error.insertAfter(element);
        //             }
        //         },

        //         submitHandler: function(form) {
        //             grecaptcha.ready(function() {
        //                 var _reCaptChaKeySite = $('meta[name="reCapCha-site-key"]').attr('content');
        //                 grecaptcha.execute(_reCaptChaKeySite, {
        //                     action: 'submit'
        //                 }).then(function(token) {
        //                     $('#g-recaptcha-response-quick-apply').val(token);
        //                     submitApplyFormWithAjax(form);
        //                 });
        //             });
        //         }
        //     });
		// }

		// // -- Func Form submit
		// function submitApplyFormWithAjax(form) {
		// 	$('#modalBackdrop').show();
		// 	$('#modalBackdrop').css('display', 'flex');
        //     $.ajax({
        //         type: 'POST',
        //         url: $(form).attr('action'),
        //         data: new FormData(form),
        //         processData: false,
        //         contentType: false,
        //         success: function(data) {
		// 			$('#quickApplyModal').modal('hide');
        //             $('#modal-another-file-name').hide();
        //             $('#modal-cv-file-name').hide();
        //             $('.apply-form-button').css("pointer-events", "none");
		// 			$('#modalBackdrop').hide();
		// 			$('#modalBackdrop').css('display', 'none');
		// 			$('#quickApplySuccessModal').modal('show');
        //         },
        //         error: function(xhr, status, error) {
        //             // $('#modalBackdrop').hide();
        //             // $('#modalBackdrop').css('display', 'none');
        //             // if (xhr.status === 422) {
        //             //     var errors = xhr.responseJSON.errors;
        //             //     $('.error-message').hide();
        //             //     for (var key in errors) {
        //             //         if (errors.hasOwnProperty(key)) {
        //             //             $('#error-' + key).text(errors[key][0]).show();
        //             //         }
        //             //     }

        //             //     var errors = xhr.responseJSON.errors;
        //             //     var errorKeys = Object.keys(errors);
        //             //     var errorsString = errorKeys.map(function(key) {
        //             //         $('#error-' + key).text(errors[key][0]).show();
        //             //         return key.toUpperCase() + ": " + errors[key][0];
        //             //     }).join('\n');

        //             //     Swal.fire({
        //             //         icon: 'error',
        //             //         title: 'Đăng ký không thành công',
        //             //         text: 'Thông tin của bạn đã gửi không hợp lệ: \n' + errorsString
        //             //     });
        //             // }
        //         }
        //     });
        // }

		function hideMenu() {
			$(document).click(function(event) {
				var clickover = $(event.target);
				var _opened = $(".navbar-collapse").hasClass("show");
				if (_opened === true && !clickover.hasClass("navbar-toggler") && !clickover.closest(
						".navbar-collapse").length) {
					$(".navbar-collapse").collapse('hide');
				}
			});
		}

		function dropdownArrow() {
			$('#dropdownToggleIcon').on('click', function(e) {
				e.preventDefault();
            
				// Tìm dropdown-menu bên trong li.nav-item
				var dropdownMenu = $(this).closest('.nav-item').find('.dropdown-menu');
				if (dropdownMenu.length) {
					dropdownMenu.toggleClass('show');
				}
				
				e.stopPropagation();
			});
		}


		// function reloadPage() {
		// 	if ('scrollRestoration' in history) {
		// 		history.scrollRestoration = 'manual';
		// 	}
		// }

        function submitLogout() {
            let logoutUrl = $('#url-logout').val();

            $.ajax({
                type: 'POST',
                url: logoutUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đăng xuất thành công',
                        text: 'Bạn đã đăng xuất thành công!'
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi đăng xuất',
                        text: 'Có lỗi xảy ra, vui lòng thử lại!'
                    });
                }
            });
        }
        // -- Func Ready
		$(function () {
			hideMenu();
			dropdownArrow();
			// reloadPage();
			// warningRejectHacker();
			// detectDevTools();
		});

    </script>
    @yield('js')
    @stack('js')
</html>