@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <style>
        body {
            background: var(--White-color, #FFFFFF);
        }

        @media screen and (min-width: 1200px) {
            .container {
                max-width: 1040px;
            }

            /***** Job Deatail CSS *****/
            #job-detail {
                padding: 177px 0 40px;
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 20px;
            }

            .job-title {
                color: var(--Main-color, #FF8B00);
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                text-transform: capitalize;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(4, 1fr);
                /* 2 columns on tablets */
                gap: 20px 90px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%;
            }

            .item {
                border-right: 0.5px solid var(--Grey-color-3, #9B9B9B);
                ;
                max-width: 182px;
                width: 182px;
            }

            /***** End Job Deatail CSS *****/

            /***** End Form apply CSS *****/
            #form-apply {
                padding-bottom: 90px;
            }

            .main-input {
                display: flex;
                flex-direction: column;
                gap: 27px;
                padding-bottom: 20px;
            }

            .form-label {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .form-control::placeholder {
                color: #C4C4C4;
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
            }

            .form-select {
                /* color: #C4C4C4; */
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                padding: 9px;
            }

            .required-icon {
                color: #F87171;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-input-component {
                display: flex;
                gap: 20px;
                flex-direction: column;
            }

            .form-group-file {
                padding: 20px;
                border-radius: 12px;
                background: var(--Grey-color-6, #F7F7F7);
                display: flex;
                justify-content: space-between;
            }

            .file-info-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }

            .file-upload-label {
                color: var(--Grey-color-1, #363535);
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                margin-bottom: 0;
            }

            .file-upload-instructions {
                color: var(--Grey-color-3, #9B9B9B);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-upload-input {
                position:absolute;
                opacity: 0;
                z-index: -9999;
                width: 0px;
            }

            .file-upload-button {
                width: 130px;
                padding: 15px 25px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                color: var(--Main-color, #FF8B00);

                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
            }

            .file-upload-button:hover {
                background-color: var(--Main-color, #FF8B00);
                color: #fff;
            }

            #another-file-name,
            #cv-file-name {
                display: none;
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 136%;
            }

            .apply-form-button {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background-color: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;

                margin: 60px auto 52px;
            }
            .apply-note {
                color: var(--Grey-color-3, #9B9B9B);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin: 0 auto;
            }
            /***** End Form apply CSS *****/
            /***** Apply success modal CSS *****/
            .model-apply-success {
                padding: 45px 70px;
            }
            .apply-success-title-block {
                padding-bottom: 40px;
                border-bottom: 1px solid #D3D3D3;
            }
            .apply-success-title {
                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 42px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;
                text-transform: uppercase;
            }
            .apply-success-description {
                color: var(--Grey-color-1, #363535);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }
            .apply-success-icon {
                color: var(--Main-color, #FF8B00);
                font-size: 65px;
                padding-bottom: 20px;
            }
            .apply-success-info-block {
                padding: 48px 0 40px;
            }
            .apply-success-info-title-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                padding-bottom: 48px;
            }

            .form-label-modal-success {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 8px;
            }
            .btn-view-more-modal {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);


                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
                text-decoration: none;

                margin: 0 auto;
            }

            .modal-footer {
                border-top:none;
            }

            .modal-success-input {
                color: var(--Grey-color-2, #6A6A6A);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%; 
            }
            /***** End Apply success modal CSS *****/
        }
        @media screen and (min-width: 768px) and (max-width: 1199px) {
            /***** Job Deatail CSS *****/
            #job-detail {
                padding: 130px 0 50px;
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 50px;
            }

            .job-title {
                color: var(--Main-color, #FF8B00);
                text-transform: capitalize;
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%; 
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px 20px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%;
            }

            .item {
                border-right: 0.5px solid var(--Grey-color-3, #9B9B9B);
                max-width: 239px;
                width: 100%;
            }

            /***** End Job Deatail CSS *****/

            /***** End Form apply CSS *****/
            #form-apply {
                padding-bottom: 90px;
            }

            .main-input {
                display: flex;
                flex-direction: column;
                gap: 27px;
                padding-bottom: 27px;
            }

            .form-label {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }
            .main-input-row {
                gap: 20px;
            }
            .form-control::placeholder {
                color: #C4C4C4;
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
            }

            .form-select {
                /* color: #C4C4C4; */
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                padding: 9px;
            }

            .required-icon {
                color: #F87171;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-input-component {
                display: flex;
                gap: 20px;
                flex-direction: column;
            }

            .form-group-file {
                padding: 20px;
                border-radius: 12px;
                background: var(--Grey-color-6, #F7F7F7);
                display: flex;
                justify-content: space-between;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .file-info-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }

            .file-upload-label {
                color: var(--Grey-color-1, #363535);
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                margin-bottom: 0;
            }

            .file-upload-instructions {
                color: var(--Grey-color-3, #9B9B9B);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-upload-input {
                position:absolute;
                opacity: 0;
                z-index: -9999;
                width: 0px;
            }

            .file-upload-button {
                width: 130px;
                padding: 15px 25px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                color: var(--Main-color, #FF8B00);

                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
            }

            .file-upload-button:hover {
                background-color: var(--Main-color, #FF8B00);
                color: #fff;
            }

            #another-file-name,
            #cv-file-name {
                display: none;
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 136%;
            }

            .apply-form-button {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background-color: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;

                margin: 20px auto 50px;
            }
            .apply-note {
                color: var(--Grey-color-3, #9B9B9B);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin: 0 auto;
            }
            /***** End Form apply CSS *****/
            /***** Apply success modal CSS *****/
            .model-apply-success {
                padding: 45px 70px;
            }
            .apply-success-title-block {
                padding-bottom: 40px;
                border-bottom: 1px solid #D3D3D3;
            }
            .apply-success-title {
                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 42px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;
                text-transform: uppercase;
            }
            .apply-success-description {
                color: var(--Grey-color-1, #363535);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }
            .apply-success-icon {
                color: var(--Main-color, #FF8B00);
                font-size: 65px;
                padding-bottom: 20px;
            }
            .apply-success-info-block {
                padding: 48px 0 40px;
            }
            .apply-success-info-title-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                padding-bottom: 48px;
            }

            .form-label-modal-success {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 8px;
            }
            .btn-view-more-modal {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);


                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
                text-decoration: none;

                margin: 0 auto;
            }

            .modal-footer {
                border-top:none;
            }
            /***** End Apply success modal CSS *****/
        }
        @media screen and (max-width: 767px) {
            /***** Job Deatail CSS *****/
            #job-detail {
                padding: 100px 0 40px;
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 40px;
            }

            .job-title {
                color: var(--Main-color, #FF8B00);
                text-transform: capitalize;
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%; 
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px 20px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%;
            }

            .item {
                border-right: 0.5px solid var(--Grey-color-3, #9B9B9B);
                max-width: 361px;
            }

            /***** End Job Deatail CSS *****/

            /***** End Form apply CSS *****/
            #form-apply {
                padding-bottom: 90px;
            }

            .main-input {
                display: flex;
                flex-direction: column;
                gap: 27px;
                padding-bottom: 27px;
            }

            .form-label {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }
            .main-input-row {
                gap: 20px;
            }
            .form-control::placeholder {
                color: #C4C4C4;
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
            }

            .form-select {
                /* color: #C4C4C4; */
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                padding: 9px;
            }

            .required-icon {
                color: #F87171;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-input-component {
                display: flex;
                gap: 20px;
                flex-direction: column;
            }

            .form-group-file {
                padding: 20px;
                border-radius: 12px;
                background: var(--Grey-color-6, #F7F7F7);
                display: flex;
                justify-content: space-between;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .file-info-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }

            .file-upload-label {
                color: var(--Grey-color-1, #363535);
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                margin-bottom: 0;
            }

            .file-upload-instructions {
                color: var(--Grey-color-3, #9B9B9B);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .file-upload-input {
                position:absolute;
                opacity: 0;
                z-index: -9999;
                width: 0px;
            }

            .file-upload-button {
                width: 130px;
                padding: 15px 25px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                color: var(--Main-color, #FF8B00);

                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
            }

            .file-upload-button:hover {
                background-color: var(--Main-color, #FF8B00);
                color: #fff;
            }

            #another-file-name,
            #cv-file-name {
                display: none;
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 136%;
            }

            .apply-form-button {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background-color: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;

                margin: 20px auto 40px;
            }
            .apply-note {
                color: var(--Grey-color-3, #9B9B9B);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin: 0 auto;
                max-width: 340px;
            }
            /***** End Form apply CSS *****/
            /***** Apply success modal CSS *****/
            .model-apply-success {
                padding: 45px 70px;
            }
            .apply-success-title-block {
                padding-bottom: 40px;
                border-bottom: 1px solid #D3D3D3;
            }
            .apply-success-title {
                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 42px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;
                text-transform: uppercase;
            }
            .apply-success-description {
                color: var(--Grey-color-1, #363535);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }
            .apply-success-icon {
                color: var(--Main-color, #FF8B00);
                font-size: 65px;
                padding-bottom: 20px;
            }
            .apply-success-info-block {
                padding: 48px 0 40px;
            }
            .apply-success-info-title-block {
                display: flex;
                flex-direction: column;
                gap: 8px;
                padding-bottom: 48px;
            }

            .form-label-modal-success {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 8px;
            }
            .btn-view-more-modal {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);


                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
                text-decoration: none;

                margin: 0 auto;
            }

            .modal-footer {
                border-top:none;
            }
            /***** End Apply success modal CSS *****/
        }
    </style>
@endpush

@section('content')
    <!-- ======= Job Detail ======= -->
    <section id="job-detail">
        <div class="container ">
            <div class="row">
                <div class="job-info-component">
                    @if (isset($data) > 0)
                        <div class="job-info">
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="d-flex title-block">
                                        <h1 class="job-title">{{ checkValue($data, 'title') }}</h1>
                                        <div class="expired-date d-flex align-items-center">
                                            Hạn nhận hồ sơ: {{ checkValue($data, 'apply_expired_formatted') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="info-content">
                                    <div class="item">
                                        <div class="item-name">Thu nhập</div>
                                        <div class="item-value">{{ checkValue($data, 'salary_text') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Khối làm việc</div>
                                        <div class="item-value">{{ checkValue($data->jobType->workUnit, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Phòng ban</div>
                                        <div class="item-value">{{ checkValue($data->jobType, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Nơi làm việc</div>
                                        <div class="item-value">{{ checkValue($data->branch, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Hình thức</div>
                                        <div class="item-value">{{ checkValue($data->form, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Cấp bậc</div>
                                        <div class="item-value">{{ checkValue($data->level, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Kinh nghiệm</div>
                                        <div class="item-value">{{ checkValue($data->experience, 'name') }}</div>
                                    </div>
                                    <div class="item">
                                        <div class="item-name">Số lượng</div>
                                        <div class="item-value">{{ checkValue($data, 'quantity') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Job Detail ======= -->

    <!-- ======= Apply Form ======= -->
    <section id="form-apply">
        <div class="container">
            <form class="apply-form" action="{{ route('candidate.storeCandidate') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="g-recaptcha-response-apply" name="g-recaptcha-response">
                <div class="main-input">
                    <div class="row main-input-row">
                        <div class="form-group col-xl-6">
                            <label for="last_name" class="form-label">Tên <span class="required-icon">*</span></label>
                            <div class="label-message">
                                <input type="text" class="form-control" name="last_name" placeholder="Tên">
                            </div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="first_name" class="form-label">Họ và chữ lót <span
                                    class="required-icon">*</span></label>
                            <div class="label-message">
                                <input type="text" class="form-control" name="first_name" placeholder="Họ và chữ lót">
                            </div>
                        </div>
                    </div>
                    <div class="row main-input-row">
                        <div class="form-group col-xl-6">
                            <label for="email" class="form-label">Email <span class="required-icon">*</span></label>
                            <div class="label-message">
                                <input type="email" class="form-control" name="email" placeholder="Email@gmail.com">
                            </div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="phone" class="form-label">Số điện thoại liên hệ  <span class="required-icon">*</span></label>
                            <div class="label-message">
                                <input type="text" class="form-control" name="phone" placeholder="+84">
                            </div>
                        </div>
                    </div>
                    <div class="row main-input-row">
                        <div class="form-group col-xl-6">
                            <label for="dob" class="form-label">Ngày sinh <span class="required-icon">*</span></label>
                            <div class="label-message">
                                <input type="text" class="form-control" name="dob" placeholder="08/04/2024">
                            </div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="gender" class="form-label">Giới tính <span class="required-icon">*</span></label>
                            <div class="label-message">
                                <select class="form-select" name="gender">
                                    <option value="" disabled selected>Chọn giới tính</option>
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
                <div class="file-input-component">
                    <div class="form-group-file">
                        <div class="file-info-block">
                            <label for="cv-file-input" class="form-label file-upload-label">
                                Cập nhật hồ sơ ứng viên
                            </label>
                            <div class="file-upload-instructions">
                                Cho phép tệp pdf và lên đến 3mb
                            </div>
                            <span id="cv-file-name">Chưa có tệp nào được chọn</span>
                            <div id="cv-error-message" style="color: red;"></div>

                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" id="cv-file-input" name="cv" class="file-upload-input" />
                            <label for="cv-file-input" class="file-upload-button">Chọn tệp</label>
                        </div>
                    </div>
                    <div class="form-group-file">
                        <div class="file-info-block">
                            <label for="another_file" class="form-label file-upload-label">
                                Tệp tin đính kèm khác
                            </label>
                            <div class="file-upload-instructions">
                                Cho phép tệp doc, docx, xls, xlsx, ppt, pptx, pdf và lên đến 3mb
                            </div>
                            <span id="another-file-name">Chưa có tệp nào được chọn</span>
                            <div id="another-file-error-message" style="color: red;"></div>
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" id="another-file-input" name="another_file"
                                class="file-upload-input" />
                            <label for="another-file-input" class="file-upload-button">Chọn tệp</label>
                        </div>
                    </div>
                    <div class="form-group-file">
                        <div class="file-info-block">
                            <label for="cover_letter" class="form-label">Nhập thư giới thiệu</label>
                            <textarea class="form-control" name="cover_letter" rows="5" placeholder="Tối đa 2000 từ"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <label for="portfolio_url" class="form-label">Liên kết của portfolio và hồ sơ mạng xã
                            hội</label>
                        <input type="text" class="form-control" name="portfolio_url"
                            placeholder="LinkedIn / Facebook / Github / Design profile...">
                    </div>
                </div>
                <div class="">
                    <button class="apply-form-button">
                        <div class="apply-form-button-text">Gửi</div>
                    </button>
                    <div class="apply-note">
                        {{ checkValue($arrSetups, 'apply_form_note', '') }}
                    </div>
                </div>
                <div class="">
                    <input type="hidden" class="form-control" name="career_id" value="{{ $data->id }}">
                </div>
            </form>
        </div>

    </section>
    <!-- ======= End Apply Form ======= -->

    <!-- =======  Modal for Apply Success ======= -->
    <div class="modal fade" id="applySuccessModal" tabindex="-1" role="dialog" aria-labelledby="applySuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content model-apply-success">
                <div class="modal-body">
                    <div class="text-center apply-success-title-block">
                        <i class="fa-solid fa-circle-check apply-success-icon"></i>
                        <div class="apply-success-title">Ứng Tuyển Thành Công</div>
                        <div class="apply-success-description">
                            {{ checkValue($arrSetups, 'apply_form_success_content') }}</div>
                    </div>
                    <div class="apply-success-info-block">
                        <div class="d-flex apply-success-info-title-block">
                            <div class="job-title">{{ checkValue($data, 'title') }}</div>
                            <div class="expired-date d-flex align-items-center">
                                Hạn nhận hồ sơ: {{ checkValue($data, 'apply_expired_formatted') }}
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label-modal-success">Tên</label>
                                <input type="text" class="form-control modal-success-input lastname-modal-success" placeholder="An" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modal-success">Họ và chữ lót</label>
                                <input type="text" class="form-control modal-success-input firstname-modal-success" placeholder="Nguyễn Văn" readonly disabled>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-md-6">
                                <label class="form-label-modal-success">Email</label>
                                <input type="email" class="form-control modal-success-input email-modal-success" placeholder="Email@gmail.com" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modal-success">Số điện thoại liên hệ</label>
                                <input type="text" class="form-control modal-success-input phone-modal-success" placeholder="0354 55 4151" readonly disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cv-filename-modal">CV.PPT</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('page.slug', ['danh-sach-viec-lam']) }}" class="btn-submit btn-view-more-modal"
                        role="button" aria-pressed="true">Xem thêm việc làm</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End  Modal for Apply Success ======= -->

@endsection

@section('js')
@endSection

@push('js')
    <script>
        function applyForm() {
            var _idContactForm = $('.apply-form');
            $.validator.addMethod("filesize", function(value, element, param) {
                if (element.files.length === 0) {
                    return true;
                }
                var size = element.files[0].size / 1024;
                return this.optional(element) || (size <= param);
            });
            $.validator.addMethod("extension", function(value, element, param) {
                var fileExtension = value.split('.').pop().toLowerCase();
                return this.optional(element) || param.indexOf(fileExtension) !== -1;
            }, "Vui lòng nhập tệp có phần mở rộng hợp lệ.");
            $.validator.addMethod("dateFormat", function(value, element) {
                return this.optional(element) || /^\d{2}\/\d{2}\/\d{4}$/.test(value);
            }, "Vui lòng nhập ngày sinh đúng định dạng dd/mm/yyyy.");

            $(_idContactForm).validate({
                rules: {
                    cv: {
                        extension: "pdf",
                        filesize: 3072
                    },
                    another_file: {
                        filesize: 3072,
                        extension: "pdf,doc,docx,xls,xlsx,ppt,pptx",
                    },
                    first_name: {
                        required: true,
                        maxlength: 255
                    },
                    last_name: {
                        required: true,
                        maxlength: 255
                    },
                    dob: {
                        required: true,
                        maxlength: 10,
                        dateFormat: true
                    },
                    gender: {
                        required: true,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100
                    },
                    phone: {
                        required: true,
                        maxlength: 11,
                        minlength: 10
                    }
                },
                messages: {
                    first_name: {
                        required: "Vui lòng nhập thông tin họ và tên lót",
                        maxlength: "Trường họ tên không quá 255 ký tự"
                    },
                    last_name: {
                        required: "Vui lòng nhập thông tin tên",
                        maxlength: "Trường họ tên không quá 255 ký tự"
                    },
                    dob: {
                        required: "Vui lòng nhập thông tin ngày sinh",
                        dateFormat: "Ngày sinh phải ở định dạng dd/mm/yyyy."
                    },
                    gender: {
                        required: "Vui lòng chọn giới tính",
                    },
                    email: {
                        required: "Vui lòng nhập thông tin email",
                        email: "Vui lòng nhập địa chỉ email hợp lệ",
                        maxlength: "Trường số email không vượt quá 100 ký tự",
                    },
                    phone: {
                        required: "Vui lòng nhập thông tin số điện thoại",
                        maxlength: "Trường số điện thoại không vượt quá 11 ký tự",
                        minlength: "Trường số điện thoại không ít hơn 10 ký tự"
                    },
                    cv: {
                        filesize: "Vui lòng sử dụng file có kích thước < 3MB"
                    },
                    another_file: {
                        filesize: "Vui lòng sử dụng file có kích thước < 3MB"
                    },
                },

                errorPlacement: function(error, element) {
                    if (element.attr("name") === "cv") {
                        $('#cv-error-message').html(error); 
                        $('#cv-file-name').hide();
                    } else if (element.attr("name") === "another_file") {
                        $('#another-file-error-message').html(error); 
                        $('#another-file-name').hide();
                    } else {
                        error.insertAfter(element);
                    }
                },

                submitHandler: function(form) {
                    grecaptcha.ready(function() {
                        var _reCaptChaKeySite = $('meta[name="reCapCha-site-key"]').attr('content');
                        grecaptcha.execute(_reCaptChaKeySite, {
                            action: 'submit'
                        }).then(function(token) {
                            $('#g-recaptcha-response-apply').val(token);
                            submitapplyFormWithAjax(form);
                        });
                    });
                }
            });
        }
        
        function submitapplyFormWithAjax(form) {
            var successImageUrl = $('.success-popup').val();
            console.log(successImageUrl);
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#applySuccessModal').modal('show');
                    $('.apply-form-button').css("pointer-events", "none");
                    $('#another-file-name').hide();
                    $('#cv-file-name').hide();

                    var firstName = $('input[name="first_name"]').val();
                    var lastName = $('input[name="last_name"]').val();
                    var email = $('input[name="email"]').val();
                    var phone = $('input[name="phone"]').val();
                    var cvFileName = $('input[name="cv"]').val().split('\\').pop();
                    $('.firstname-modal-success').val(firstName);
                    $('.lastname-modal-success').val(lastName);
                    $('.email-modal-success').val(email);
                    $('.phone-modal-success').val(phone);
                    $('#cv-filename-modal').text(cvFileName || '');
                    $('.apply-form').each(function() {
                        this.reset();
                    });
                    // var successImageUrl = $('.success-popup').val();
                    // Swal.fire({
                    //     imageUrl: successImageUrl,
                    //     imageWidth: 1000,
                    //     imageHeight: 500,
                    //     timerProgressBar: true,
                    //     showConfirmButton: false,
                    //     customClass: {
                    //         popup: 'swal-success-popup', 
                    //         image: 'swal-success-image'
                    //     }
                    // }).then((result) => {});
                },
                error: function(xhr, status, error) {
                    $('#back-drop').hide();
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $('.error-message').hide();
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                $('#error-' + key).text(errors[key][0]).show();
                            }
                        }

                        var errors = xhr.responseJSON.errors;
                        var errorKeys = Object.keys(errors);
                        var errorsString = errorKeys.map(function(key) {
                            $('#error-' + key).text(errors[key][0]).show();
                            return key.toUpperCase() + ": " + errors[key][0];
                        }).join('\n');

                        Swal.fire({
                            icon: 'error',
                            title: 'Đăng ký không thành công',
                            text: 'Thông tin của bạn đã gửi không hợp lệ: \n' + errorsString
                        });
                    }
                }
            });
        }
        $(function() {
            applyForm();

            //Call function from master
            handleFileInputChange('#cv-file-input', '#cv-error-message', '#cv-file-name', '#cv-filename');
            handleFileInputChange('#another-file-input', '#another-file-error-message', '#another-file-name');
        });
    </script>
@endpush
