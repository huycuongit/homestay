    {{-- <input type="hidden" value="{{ route('careers.active') }}" id="url-careers">
    <div class="modal-backdrop-loading" id="modalBackdrop">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- ======= Modal Section ======= -->
    <div id="quickApplyModal" class="modal " aria-hidden="true" data-backdrop="true" data-keyboard="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content quick-apply-modal">
                <div class="modal-logo-block">
                    <img alt="sunny-days-the-piano-project_logo ngang trang_1.png"
                        src="{{ isset($arrSetups) && isset($arrSetups['logo']) ? $arrSetups['logo'] : asset('assets/imgs/logo.png') }}" loading="lazy"
                        class="modal-logo" />
                    <img alt="sunny-days-the-piano-project_logo ngang trang_1.png"
                        src="{{ isset($arrSetups) && isset($arrSetups['dayone_logo']) ? $arrSetups['dayone_logo'] : asset('assets/imgs/logo.png') }}" loading="lazy"
                        class="modal-logo" />
                </div>
                <div class="modal-header quick-apply-modal-header text-center">
                    <div class="quick-apply-modal-title">Ứng tuyển công việc
                    </div>
                </div>
                <div class="modal-body quick-apply-modal-body">
                    <form id="quick-apply-form" action="{{ route('candidate.storeCandidate') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="g-recaptcha-response-quick-apply" name="g-recaptcha-response">
                        <div class="main-select">
                            <div class="row main-select-row">
                                <div class="form-group col-xl-6">
                                    <label for="last_name" class="form-label">Khối làm việc <span
                                            class="required-icon">*</span></label>
                                    <select class="form-control" name="work_unit" id="work_unit">
                                        <option value="">Chọn</option>
                                        @if (isset($gWorkUnits) && count($gWorkUnits) > 0)
                                            @foreach ($gWorkUnits as $workUnit)
                                                <option value="{{ $workUnit->id }}">{{ checkValue($workUnit, 'name') }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="first_name" class="form-label">Phòng ban ứng tuyển <span
                                            class="required-icon">*</span></label>
                                    <select class="form-control" name="job_type" id="job_type">
                                        <option value="">Chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row main-input-row">
                                <div class="form-group col-xl-12">
                                    <label for="career_id" class="form-label">Vị trí làm việc <span
                                            class="required-icon">*</span></label>
                                    <select class="form-control" name="career_id" id="career_id">
                                        <option value="">Chọn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-main-input">
                            <div class="row main-input-row">
                                <div class="form-group col-xl-6">
                                    <label for="last_name" class="form-label">Tên <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <input type="text" class="form-control" name="last_name" placeholder="Tên">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="first_name" class="form-label">Họ và chữ lót <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="Họ và chữ lót">
                                    </div>
                                </div>
                            </div>
                            <div class="row main-input-row">
                                <div class="form-group col-xl-6">
                                    <label for="email" class="form-label">Email <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email@gmail.com">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="phone" class="form-label">Số điện thoại liên hệ <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <input type="text" class="form-control" name="phone" placeholder="+84">
                                    </div>
                                </div>
                            </div>
                            <div class="row main-input-row">
                                <div class="form-group col-xl-6">
                                    <label for="dob" class="form-label">Ngày sinh <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <input type="text" class="form-control" name="dob"
                                            placeholder="08/04/2024">
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="gender" class="form-label">Giới tính <span
                                            class="required-icon">*</span></label>
                                    <div class="label-message">
                                        <select class="form-select" name="gender">
                                            <option value="">Chọn</option>
                                            @if (isset($allGenders))
                                                @foreach ($allGenders as $kGender => $allGender)
                                                    <option value="{{ $kGender }}">{{ $allGender }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-file-input-component">
                            <div class="modal-form-group-file">
                                <div class="modal-file-info-block">
                                    <label for="cv-file-input" class="form-label modal-file-upload-label">
                                        Cập nhật hồ sơ ứng viên
                                    </label>
                                    <div class="modal-file-upload-instructions">
                                        Cho phép tệp pdf và lên đến 3mb
                                    </div>
                                    <span id="modal-cv-file-name">Chưa có tệp nào được chọn</span>
                                    <div id="modal-cv-error-message" style="color: red;"></div>

                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="modal-cv-file-input" name="cv"
                                        class="modal-file-upload-input" />
                                    <label for="modal-cv-file-input" class="modal-file-upload-button">Chọn tệp</label>
                                </div>
                            </div>
                            <div class="modal-form-group-file">
                                <div class="file-info-block">
                                    <label for="another_file" class="form-label file-upload-label">
                                        Tệp tin đính kèm khác
                                    </label>
                                    <div class="modal-file-upload-instructions">
                                        Cho phép tệp doc, docx, xls, xlsx, ppt, pptx, pdf và lên đến 3mb
                                    </div>
                                    <span id="modal-another-file-name">Chưa có tệp nào được chọn</span>
                                    <div id="modal-another-file-error-message" style="color: red;"></div>

                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="modal-another-file-input" name="another_file"
                                        class="modal-file-upload-input" />
                                    <label for="modal-another-file-input" class="modal-file-upload-button">Chọn tệp</label>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button class="modal-apply-form-button">
                                <div class="apply-form-button-text">Gửi hồ sơ</div>
                            </button>
                            <div class="quick-apply-note">
                                {{ checkValue($arrSetups, 'apply_form_note', '') }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Modal Section ======= -->

    <!-- =======  Modal for Apply Success ======= -->
    <div class="modal fade" id="quickApplySuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="quickApplySuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content model-quick-apply-success">
                <div class="modal-body">
                    <div class="text-center quick-apply-success-title-block">
                        <i class="fa-solid fa-circle-check quick-apply-success-icon"></i>
                        <div class="quick-apply-success-title">Ứng Tuyển Thành Công</div>
                        <div class="quick-apply-success-description">{{ checkValue($arrSetups, 'apply_form_success_content') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End  Modal for Apply Success ======= -->

    <!-- ======= Ballon Section ======= -->
    <div class="ballon-block">
        <div class="ballon-content">
            Bạn cần hỗ trợ!
        </div>
        <a href="{{ checkValue($arrSetups, 'support_url') }}" class="ballon-icon-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="ballon-icon" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <g filter="url(#filter0_ii_3464_3730)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 0C10.4801 0 0 9.90336 0 23.28C0 30.2769 2.86752 36.3229 7.53734 40.499C7.92936 40.8499 8.166 41.3414 8.18208 41.8675L8.31278 46.1366C8.35454 47.4984 9.76114 48.3845 11.0072 47.8344L15.7709 45.7315C16.1747 45.5534 16.6272 45.5203 17.0527 45.6374C19.2418 46.2394 21.5716 46.56 24 46.56C37.5199 46.56 48 36.6566 48 23.28C48 9.90336 37.5199 0 24 0Z" fill="#F7F6F2"/>
                </g>
                <path d="M7.60464 40.4239L7.60461 40.4238C2.95619 36.2669 0.100903 30.2482 0.100903 23.28C0.100903 9.9627 10.5321 0.100903 24 0.100903C37.4679 0.100903 47.8991 9.9627 47.8991 23.28C47.8991 36.5973 37.4679 46.4591 24 46.4591C21.5805 46.4591 19.2597 46.1396 17.0795 45.5402C16.6316 45.4169 16.1553 45.4517 15.7302 45.6392L15.7301 45.6392L10.9665 47.7421C9.78588 48.2633 8.45321 47.4238 8.41364 46.1336L8.28294 41.8644C8.26598 41.3097 8.01648 40.7925 7.60464 40.4239Z" stroke="#ACACAC" stroke-opacity="0.1" stroke-width="0.201805"/>
                <defs>
                <filter id="filter0_ii_3464_3730" x="0" y="0" width="48" height="48" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                    <feOffset/>
                    <feGaussianBlur stdDeviation="0.807222"/>
                    <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.1 0"/>
                    <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3464_3730"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                    <feOffset/>
                    <feGaussianBlur stdDeviation="0.807222"/>
                    <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.1 0"/>
                    <feBlend mode="normal" in2="effect1_innerShadow_3464_3730" result="effect2_innerShadow_3464_3730"/>
                </filter>
                </defs>
                <svg xmlns="http://www.w3.org/2000/svg" width="43" height="36" viewBox="0 0 43 36" fill="none"  x="5" y="10">
                    <g style="mix-blend-mode:overlay" filter="url(#filter0_df_3454_3733)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.58763 18.6664L11.6376 7.48144C12.7591 5.70208 15.1605 5.25904 16.8431 6.52096L22.4503 10.7264C22.9648 11.1123 23.6727 11.1102 24.185 10.7214L31.7578 4.97416C32.7686 4.20712 34.0879 5.41672 33.4115 6.49014L26.3615 17.6752C25.24 19.4545 22.8386 19.8976 21.156 18.6356L15.5487 14.4301C15.0343 14.0442 14.3263 14.0463 13.8141 14.4351L6.24123 20.1824C5.23049 20.9494 3.91107 19.7398 4.58763 18.6664Z" fill="black" fill-opacity="0.5"/>
                    </g>
                    <g opacity="0.1" filter="url(#filter1_f_3454_3733)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.58763 18.0883L11.6376 6.90331C12.7591 5.12395 15.1605 4.68091 16.8431 5.94283L22.4503 10.1483C22.9648 10.5342 23.6727 10.5321 24.185 10.1433L31.7578 4.39603C32.7686 3.62899 34.0879 4.83859 33.4115 5.91202L26.3615 17.0971C25.24 18.8763 22.8386 19.3195 21.156 18.0575L15.5487 13.8519C15.0343 13.4661 14.3263 13.4682 13.8141 13.857L6.24123 19.6043C5.23049 20.3713 3.91107 19.1616 4.58763 18.0883Z" fill="url(#paint0_linear_3454_3733)"/>
                    </g>
                    <g filter="url(#filter2_di_3454_3733)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.58763 18.0883L11.6376 6.90331C12.7591 5.12395 15.1605 4.68091 16.8431 5.94283L22.4503 10.1483C22.9648 10.5342 23.6727 10.5321 24.185 10.1433L31.7578 4.39603C32.7686 3.62899 34.0879 4.83859 33.4115 5.91202L26.3615 17.0971C25.24 18.8763 22.8386 19.3195 21.156 18.0575L15.5487 13.8519C15.0343 13.4661 14.3263 13.4682 13.8141 13.857L6.24123 19.6043C5.23049 20.3713 3.91107 19.1617 4.58763 18.0883Z" fill="url(#paint1_linear_3454_3733)"/>
                    <path d="M11.8083 7.01092L11.8084 7.01091C12.8669 5.33131 15.1337 4.91309 16.7221 6.10428L22.3293 10.3097C22.3293 10.3097 22.3293 10.3097 22.3293 10.3097C22.9158 10.7497 23.7229 10.7473 24.307 10.3041L31.8798 4.55678C32.7116 3.92554 33.7975 4.92099 33.2408 5.80441C33.2408 5.80442 33.2408 5.80442 33.2408 5.80443L26.1908 16.9895C25.1322 18.669 22.8653 19.0873 21.2771 17.896L21.156 18.0575L21.2771 17.896L15.6697 13.6905C15.0832 13.2506 14.2761 13.253 13.6921 13.6962L6.11924 19.4435C6.11923 19.4435 6.11923 19.4435 6.11923 19.4435C5.28739 20.0747 4.20158 19.0792 4.75835 18.1959L11.8083 7.01092Z" stroke="white" stroke-opacity="0.1" stroke-width="0.403611"/>
                    </g>
                    <g filter="url(#filter3_f_3454_3733)">
                    <path d="M48.2763 38.25C48.2763 38.25 45.6529 39.4608 44.2402 41.0753C42.8276 42.6898 23.4541 73.5662 23.4541 73.5662L24.4631 74.777" stroke="white" stroke-opacity="0.8" stroke-width="0.403611"/>
                    </g>
                    <defs>
                    <filter id="filter0_df_3454_3733" x="0.366236" y="0.696314" width="37.2666" height="25.3786" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="4.03611"/>
                        <feGaussianBlur stdDeviation="0.807222"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3454_3733"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3454_3733" result="shape"/>
                        <feGaussianBlur stdDeviation="2.01805" result="effect2_foregroundBlur_3454_3733"/>
                    </filter>
                    <filter id="filter1_f_3454_3733" x="1.17346" y="0.925411" width="35.6521" height="22.1497" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                        <feGaussianBlur stdDeviation="1.61444" result="effect1_foregroundBlur_3454_3733"/>
                    </filter>
                    <filter id="filter2_di_3454_3733" x="3.19151" y="3.75069" width="31.616" height="18.1136" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="0.807222"/>
                        <feGaussianBlur stdDeviation="0.605416"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3454_3733"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3454_3733" result="shape"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset/>
                        <feGaussianBlur stdDeviation="1.61444"/>
                        <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.2 0"/>
                        <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3454_3733"/>
                    </filter>
                    <filter id="filter3_f_3454_3733" x="20.7834" y="35.6452" width="29.9996" height="41.6827" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                        <feGaussianBlur stdDeviation="1.21083" result="effect1_foregroundBlur_3454_3733"/>
                    </filter>
                    <linearGradient id="paint0_linear_3454_3733" x1="4.39726" y1="19.8073" x2="33.602" y2="4.19288" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#2771E9"/>
                        <stop offset="0.302083" stop-color="#792EE7"/>
                        <stop offset="0.640221" stop-color="#A82ACC"/>
                        <stop offset="1" stop-color="#D5504B"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_3454_3733" x1="4.39726" y1="19.8073" x2="31.0719" y2="6.0724" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF8B00"/>
                        <stop offset="0.302083" stop-color="#F47A00"/>
                        <stop offset="0.640221" stop-color="#F47A00"/>
                        <stop offset="1" stop-color="#FF8B00"/>
                    </linearGradient>
                    </defs>
                </svg>
            </svg>
        </a>
    </div>
    <!-- ======= Ballon Section ======= --> --}}
