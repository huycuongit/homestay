@extends('frontend.layouts.master')

@section('css')
@endSection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

@push('css')
    <style>
        @media (min-width: 1200px) {

            /***** Hero CSS *****/
            .director-wrapper {
                position: relative;
                min-height: 400px;
                /* đảm bảo khối đủ cao để chứa content */
            }

            .director-image {
                box-shadow: 0 4px 20px 6px #91D2FE;
                border-radius: 8px;
                max-width: 555px;
                width: 100%;
                position: relative;
                z-index: 1;
            }

            .director-image img {
                width: 100%;
                border-radius: 8px;
            }

            .director-content {
                position: absolute;
                top: 50%;
                left: 40%;
                transform: translateY(-50%);
                max-width: 650px;
                border-right: 6px solid var(--sub-color);
                background-color: var(--main-color);
                /* border-radius: 8px; */
                z-index: 2;
                width: 650px;
            }

            .director-name {
                font-weight: 700;
                font-style: Bold;
                font-size: 40px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 0%;
            }

            .director-description {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 32px;
                letter-spacing: 0%;
            }

            /***** Hero CSS *****/
            /***** Milestone CSS *****/
            .our-services-title {
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: font size/72;
                letter-spacing: 0%;
                color: var(--main-color);
            }
            .servicesSwiper {
                padding: 50px 0 80px !important;
                height: fit-content;
            }

            .custom-slide {
                border-radius: 10px;
                transition: transform 0.3s ease;
            }

            .swiper-slide.custom-slide.swiper-slide-active {
                box-shadow: 0px 20px 60px 0px #A8D5F4;
            }

            .swiper-slide:not(.swiper-slide-active) {
                transform: scale(0.9);
                opacity: 0.6;
            }

            .swiper-slide.custom-slide {
                width: 680px;
                height: fit-content;
            }

            .service-img {
                max-width: 200px;
                flex-shrink: 0;
            }

            .image-shadow {
                width: 100%;
                height: 100%;
                bottom: -10px;
                left: -11px;
                z-index: 0;
                background-color: #D9D9D9;
            }

            /* Đảm bảo ảnh nằm phía trên */
            .service-img img {
                position: relative;
                z-index: 1;
                max-width: 190px;
                max-height: 190px;
                width: 190px;
                height: 190px;
                object-fit: cover;
                /* border-radius: 10px; */
            }

            .service-title {
                font-family: Manrope;
                font-weight: 700;
                font-style: Bold;
                font-size: 32px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 0%;
                color: var(--sub-color);
                padding-right: 20px;
                border-bottom: solid 1px #000;
            }

            .service-slider-item {
                padding: 50px;
            }

            /***** Milestone CSS *****/

        }

        @media (min-width: 769px) and (max-width: 1199px) {

            /***** Hero CSS *****/
            .director-wrapper {
                position: relative;
                min-height: 400px;
                /* đảm bảo khối đủ cao để chứa content */
            }

            .director-image {
                box-shadow: 0 4px 20px 6px #91D2FE;
                border-radius: 8px;
                max-width: 555px;
                width: 100%;
                position: relative;
                z-index: 1;
            }

            .director-image img {
                width: 100%;
                border-radius: 8px;
            }

            .director-content {
                position: relative;
                top: auto;
                left: auto;
                transform: none;
                width: 100%;
                max-width: 100%;
                margin-top: 20px;
                border-right: none;
                border-left: 4px solid var(--sub-color);
                /* Nếu muốn vẫn có border */
            }

            .director-name {
                font-weight: 700;
                font-style: Bold;
                font-size: 40px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 0%;
            }

            .director-description {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 32px;
                letter-spacing: 0%;
            }

            /***** Hero CSS *****/
            /***** Milestone CSS *****/
            .servicesSwiper {
                padding: 50px !important;
            }

            .custom-slide {
                border-radius: 10px;
                transition: transform 0.3s ease;
            }

            .swiper-slide.custom-slide.swiper-slide-active {
                box-shadow: 0px 20px 60px 0px #A8D5F4;
            }

            .swiper-slide:not(.swiper-slide-active) {
                transform: scale(0.9);
                opacity: 0.6;
            }

            .swiper-slide.custom-slide {
                width: 680px;
                height: fit-content;
            }

            .service-img {
                max-width: 200px;
                flex-shrink: 0;
            }

            .image-shadow {
                width: 100%;
                height: 100%;
                bottom: -10px;
                left: -11px;
                z-index: 0;
                background-color: #D9D9D9;
            }

            /* Đảm bảo ảnh nằm phía trên */
            .service-img img {
                position: relative;
                z-index: 1;
                /* border-radius: 10px; */
            }

            .service-title {
                font-family: Manrope;
                font-weight: 700;
                font-style: Bold;
                font-size: 32px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 0%;
                color: var(--sub-color);
                padding-right: 20px;
                border-bottom: solid 1px #000;
            }

            .service-slider-item {
                padding: 50px;
            }

            /***** Milestone CSS *****/

        }

        @media (max-width: 768px) {

            /***** Hero CSS *****/
            .director-wrapper {
                position: relative;
                min-height: 400px;
                /* đảm bảo khối đủ cao để chứa content */
            }

            .director-image {
                box-shadow: 0 4px 20px 6px #91D2FE;
                border-radius: 8px;
                max-width: 555px;
                width: 100%;
                position: relative;
                z-index: 1;
            }

            .director-image img {
                width: 100%;
                border-radius: 8px;
            }

            .director-content {
                border-right: 6px solid var(--sub-color);
                background-color: var(--main-color);
                position: relative !important;
                top: auto !important;
                left: auto !important;
                transform: none !important;
                width: 100% !important;
                max-width: 100% !important;
                margin-top: 20px;
                border-right: none;
                border-left: 4px solid var(--sub-color);
            }

            .director-name {
                font-weight: 700;
                font-style: Bold;
                font-size: 40px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 0%;
            }

            .director-description {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 32px;
                letter-spacing: 0%;
            }

            /***** Hero CSS *****/
            .servicesSwiper {
                padding: 20px !important;
                height: fit-content;

            }

            .swiper-slide.custom-slide {
                width: 100% !important;
                transform: none !important;
                opacity: 1 !important;
            }

            .swiper-slide.custom-slide.swiper-slide-active {
                box-shadow: none !important;
            }

            .service-slider-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 30px 20px;
            }

            .service-img {
                max-width: 100%;
                margin-bottom: 20px;
                width: 100%;
            }

            .image-shadow {
                display: none;
                /* hoặc giữ lại tùy bạn */
            }

            .service-title {
                font-size: 24px;
                border-bottom: none;
                padding-bottom: 10px;
            }

            .service-content p {
                font-size: 14px;
            }

        }
    </style>
@endpush

@section('content')
    <section id="banner-section">
        <div class="">
            <div class="align-items-center">
                <div class="col-md-12 image">
                    <img src="{{ asset('assets/imgs/banner-home.jpg') }}" alt="Sự kiện cổ đông">
                </div>
            </div>
        </div>
    </section>

    <section id="director" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 mb-4 mb-md-0">
                    <div class="director-wrapper position-relative d-flex flex-wrap align-items-center">
                        <div class="director-image me-md-5 mb-3 mb-md-0">
                            <img src="{{ Storage::url($arrSetups['director_image']) }}" alt="Giám đốc Hoàng Giang"
                                class="img-fluid">
                        </div>
                        <div class="director-content text-white p-4 position-absolute">
                            <h3 class="director-name fw-bold mb-3">{!! $arrSetups['director_name'] !!}</h3>
                            <p class="director-description mb-0">
                                {!! $arrSetups['director_description'] !!}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="our-services" class="py-5">
        <div class="container">
            <h2 class="our-services-title mb-5">DỊCH VỤ CHÚNG TÔI MANG ĐẾN</h2>
            <div class="swiper servicesSwiper">
                <div class="swiper-wrapper">
                    @foreach ($services as $service)
                        <div class="swiper-slide custom-slide">
                            <div class="service-slider-item bg-white rounded d-flex">
                                <div class="service-img me-4 position-relative">
                                    <div class="image-shadow position-absolute"></div>
                                    <img src="{{ Storage::url($service['avatar']) }}" class="img-fluid  position-relative"
                                        alt="{{ $service['title'] }}">
                                </div>

                                <div class="service-content">
                                    <h5 class="service-title fw-bold pb-2">
                                        {{ $service['title'] }}</h5>
                                    <p class="text-muted mb-0">{{ $service['description'] }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>
    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />
@endSection

@push('js')
    <script>
        $(function() {
            const swiper = new Swiper(".servicesSwiper", {
                slidesPerView: 'auto', // Cho phép slide có width tùy chỉnh (VD: 680px)
                spaceBetween: 20,
                centeredSlides: true,
                loop: false, // Hoặc true nếu bạn muốn lặp vô hạn
                initialSlide: 0,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });


        });
    </script>
@endpush
