@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('css')
@endSection

@push('css')
    <style>
        @media (min-width: 1200px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;

                color: var(--main-color);
                padding: 50px 0;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                margin: auto;
                background-color: var(--main-color);
                color: #fff;

            }




            /***** End Job CSS *****/
        }
        @media (min-width: 769px) and (max-width: 1199px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;

                color: var(--main-color);
                padding: 50px 0;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                margin: auto;
                background-color: var(--main-color);
                color: #fff;

            }




            /***** End Job CSS *****/
        }
        @media (max-width: 768px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 40px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;

                color: var(--main-color);
                padding: 25px 0;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                margin: auto;
                background-color: var(--main-color);
                color: #fff;

            }




            /***** End Job CSS *****/
        }
    </style>
@endpush

@section('content')
    <section class="py-5 bg-light" id="contact">
        <div class="container">
            <h2 class="gallery-section-title">LIÊN HỆ VỚI CHÚNG TÔI</h2>

            <div class="row text-center mb-4">
                <div class="col-md-4 mb-4">
                    <div class="icon-circle d-flex justify-content-center align-items-center mb-3">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h6 class="text-uppercase fw-bold">Địa chỉ</h6>
                    <p class="mb-0">
                        {{ checkValue($arrSetups, 'company_address') }}
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon-circle d-flex justify-content-center align-items-center mb-3">
                        <i class="fa-solid fa-phone-volume fs-4"></i>
                    </div>

                    <h6 class="text-uppercase fw-bold">Số điện thoại</h6>
                    <p class="mb-0">{{ formatPhone(checkValue($arrSetups, 'company_hotline')) }}<br>0{{ formatPhone(checkValue($arrSetups, 'company_hotline_2')) }}</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon-circle d-flex justify-content-center align-items-center mb-3">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h6 class="text-uppercase fw-bold">Email</h6>
                    <p class="mb-0">{{ checkValue($arrSetups, 'company_email') }}</p>
                </div>
            </div>

            <div class="ratio ratio-16x9">
                {!! checkValue($arrSetups, 'company_map') !!}

            </div>
        </div>
    </section>

    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />


    <input type="hidden" value="{{ route('page.slug', ['thu-vien-anh']) }}" id="url-ajax" />
    <!-- /. URL action -->
    <!-- ======= End Job Section ======= -->
@endSection

@section('js')
@endSection

@push('js')
    <script>
        
        $(function() {
        });
    </script>
@endpush
