@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <style>
        @media screen and (max-width: 767px) {

            /***** hero CSS *****/
            #hero {
                padding: 100px 0 40px;
            }

            .hero-block {
                /* gap: 50px; */
            }

            .datetime-title {
                color: var(--Text-grey-1, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
                height: 30px;
            }

            .blog-type-title {
                color: var(--Text-grey-1, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 24px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .banner-title {
                color: var(--Main-color, #FF8B00);
                font-family: Unbounded;
                font-size: 32px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                max-width: 728px;
                padding: 16px 0;
                margin-bottom: 0px;
            }

            .banner {
                width: 100%;
                /* aspect-ratio: 440/280; */
                border-radius: 12px;
                max-height: 400px;
                object-fit: cover;
            }

            /***** End hero CSS *****/

            /***** Blog *****/
            .blog-detail-component {
                justify-content: space-between;
                gap: 40px;
                padding-bottom: 50px;
            }

            .blog-detail-content {
                font-family: "Be Vietnam Pro";
                /* font-size: 16px; */
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
            }

            .blog-detail-content img {
                width: 100% !important;
                /* height: 100%; */
                border-radius: 12px;
                display: block;
                height: auto !important;
            }

            .blog-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .blog-detail-related {
                /* max-width: 245px; */
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                align-self: stretch;
                border-radius: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
                color: var(--Text-color, #808080);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
                /* 21.76px */

                margin-bottom: 40px;
            }

            .blog-detail-social-icons {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .blog-detail-social-icons a {
                font-size: 29px;
                color: var(--Main-color);
            }

            .blog-related-block {
                display: flex;
                padding: 16px;
                flex-direction: column;
                border-radius: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
            }

            .blog-related-block-title {
                display: flex;
                padding-bottom: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                color: var(--Main-color, #FF8B00);
                font-family: "Be Vietnam Pro";
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .blog-related-name {
                color: var(--Text-color, #808080);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
            }

            .blog-related-title {
                color: var(--Text-grey-color, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
            }

            .blog-related {
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                padding: 20px 0;
                text-decoration: none;
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .blog-related:hover .blog-related-title {
                color: var(--Main-color, #FF8B00);
            }

            .blog-detail {
                width: 100%;
                max-width: 1440px;
                padding: 53px 146px 74px 144px;
            }

            .btn-view-all-blogs {
                display: flex;
                padding: 15px 24px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);

                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
                /* 150% */
                margin-top: 20px;
                max-width: 164px;
                text-decoration: none;
            }

            /***** End Blog *****/
        }

        @media screen and (min-width: 768px) and (max-width: 1199px) {

            /***** hero CSS *****/
            #hero {
                padding: 130px 0 20px;
            }

            .hero-block {
                /* gap: 50px; */
            }

            .datetime-title {
                color: var(--Text-grey-1, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
                height: 30px;
            }

            .blog-type-title {
                color: var(--Text-grey-1, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 24px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .banner-title {
                color: var(--Main-color, #FF8B00);
                font-family: Unbounded;
                font-size: 32px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                max-width: 728px;
                padding: 20px 0;
                margin-bottom: 0px;
            }

            .banner {
                width: 100%;
                border-radius: 12px;
                max-height: 400px;
                object-fit: cover;
            }

            /***** End hero CSS *****/

            /***** Blog *****/
            .blog-detail-component {
                justify-content: space-between;
                gap: 70px;
                padding-bottom: 50px;
            }

            .blog-detail-content {
                font-family: "Be Vietnam Pro";
                /* font-size: 16px; */
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
            }

            .blog-detail-content img {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 12px;
                display: block;
                height: auto !important;
            }

            .blog-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .blog-detail-related {
                /* max-width: 245px; */
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                align-self: stretch;
                border-radius: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
                color: var(--Text-color, #808080);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
                /* 21.76px */

                margin-bottom: 40px;
            }

            .blog-detail-social-icons {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .blog-detail-social-icons a {
                font-size: 29px;
                color: var(--Main-color);
            }

            .blog-related-block {
                display: flex;
                padding: 16px;
                flex-direction: column;
                border-radius: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
            }

            .blog-related-block-title {
                display: flex;
                padding-bottom: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                color: var(--Main-color, #FF8B00);
                font-family: "Be Vietnam Pro";
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .blog-related-name {
                color: var(--Text-color, #808080);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
            }

            .blog-related-title {
                color: var(--Text-grey-color, #363535);
                font-family: "Be Vietnam Pro";
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
            }

            .blog-related {
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                padding: 20px 0;
                text-decoration: none;
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .blog-related:hover .blog-related-title {
                color: var(--Main-color, #FF8B00);
            }

            .blog-detail {
                width: 100%;
                max-width: 1440px;
                padding: 53px 146px 74px 144px;
            }

            .btn-view-all-blogs {
                display: flex;
                padding: 15px 24px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);

                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 24px;
                /* 150% */
                margin-top: 20px;
                max-width: 164px;
                text-decoration: none;
            }

            /***** End Blog *****/
        }

        @media screen and (min-width: 1200px) {

            /***** hero CSS *****/
            .container {
                max-width: 1040px;
            }

            #hero {
                padding: 20px;
            }

            .hero-block {
                /* gap: 50px; */
            }

            .banner-title {
                color: var(--main-color, #FF8B00);
                font-size: 36px;
                font-style: normal;
                font-weight: 400;
                line-height: 135%;
                max-width: 580px;
                margin-bottom: 0px;
            }


            /***** End hero CSS *****/

            /***** Blog *****/
            .blog-detail-component {
                justify-content: space-between;
                padding: 30px;
                border: 1px solid var(--main-color);
            }

            .blog-detail-content {
                font-family: "Be Vietnam Pro";
                /* font-size: 16px; */
                font-style: normal;
                font-weight: 300;
                line-height: 136%;
                max-width: 740px;
            }

            .blog-detail-content img {
                width: 100% !important;
                /* height: 100%; */
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .blog-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .blog-detail-related {
                max-width: 245px;
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                align-self: stretch;
                border-radius: 20px;
                background: var(--Text-grey-color-5, #F7F7F7);
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 300;
                line-height: 136%;

                margin-bottom: 40px;
            }

            /***** End Blog *****/

            .services-related-title {
                font-family: Manrope;
                font-weight: 500;
                font-style: Medium;
                font-size: 25px;
                leading-trim: NONE;
                line-height: 130%;
                letter-spacing: 0%;
                color: var(--main-color);
            }

            /***** service CSS *****/
            #services {}

            .services-title {
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: 130%;
                letter-spacing: 0%;

                color: var(--main-color);
            }

            .services-des {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                color: var(--Grey-color);
            }

            .services-card-title {
                font-family: Manrope;
                font-weight: 700;
                font-style: Bold;
                font-size: 25px;
                leading-trim: NONE;
                line-height: 130%;
                letter-spacing: 0%;
                color: var(--main-color);

            }
            .services-card img {
                max-height: 262px;
                max-width: 367px;
                width: 100%;
                height: 100%;
                object-fit: cover;

            }

            .services-link {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;
                color: var(--main-color);
                text-decoration: none;
            }

            .services-arrow {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                font-size: 14px;
                transition: background 0.3s ease, transform 0.3s ease;
                background-color: var(--main-color);
                color: #fff;
            }

            .services-link:hover .services-arrow {
                transform: translateX(4px);
                background-color: var(--sub-color);
            }

            /***** End service CSS *****/
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/typography.css') }}" />
@endpush

@section('content')
    <input type="hidden" id="url-acivity-log" value="{{ route('page.activity.logs') }}" />
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
    <!-- ======= Hero Section ======= -->
    <section id="hero" style="padding-top: 50px;">
        <div class="container">
            <div class="row hero-block">
                <div class="col-xl-7 col-12 col-md-12">
                    {{-- <div class="datetime-title">
                        <span
                            class="">{{ !empty(checkValue($data, 'publish_time'))
                                ? ucfirst(\Carbon\Carbon::parse($data->publish_time)->translatedFormat('l, d/m/Y'))
                                : 'Đang cập nhật ...' }}</span>
                    </div>
                    <div class="blog-type-title">
                        Tin tức
                    </div> --}}
                    <h1 class="banner-title">
                        Dịch vụ > {!! checkValue($data, 'title', 'Đang cập nhật') !!}
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Hero Section ======= -->

    <!-- ======= Blog ======= -->
    <section id="blog-detail" style="">
        <div class="container ">
            <div class="row blog-detail-component">
                <div class="col-xl-12 col-md-12 blog-detail-content">
                    {!! checkValue($data, 'content') !!}
                </div>
                {{-- <div class="contact-block">
                        <div>
                            Liên hệ chúng tôi
                        </div>
                        <div>
                            <div class="blog-detail-social-icons">
                                <a href="{{ checkValue($arrSetups, 'facebook_link', '#') }}">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="{{ checkValue($arrSetups, 'instagram_link', '#') }}">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                {{-- <div class="blog-related-block">
                        <div class="blog-related-block-title">
                            Xem thêm bài viết
                        </div>
                        @if (isset($news))
                            @foreach ($news as $newsItem)
                                <a href="{{ route('news.detail', ['slug' => $newsItem->slug]) }}" class="blog-related">
                                    <div class="blog-related-name">
                                        Tin tức
                                    </div>
                                    <div class="blog-related-title">
                                        {{ $newsItem && $newsItem->name ? $newsItem->name : '' }}
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        <div class="">
                            <a href="{{ route('page.slug', ['tin-tuc']) }}" class="btn-submit btn-view-all-blogs"
                                role="button" aria-pressed="true">Tất
                                cả bài viết</a>
                        </div>
                    </div> --}}
            </div>
        </div>
    </section>
    <section id="service-relateds" class="services-section py-5 bg-white">
        <div class="container">
            <div class="mb-5">
                <div class="services-related-title fw-bold">
                    CÁC DỊCH VỤ KHÁC
                </div>
            </div>

            <div class="row g-4">
                @foreach ($news as $new)
                    <div class="col-md-4">
                        <div class="services-card card h-100 border-0 d-flex flex-column gap-3">
                            <img src="{{ Storage::url($new->avatar) }}" class="services-img card-img-top" alt="Thi công">
                            <div class="card-body px-0 d-flex flex-column gap-3">
                                <div class="services-card-title">
                                    {{ checkValue($new, 'title') }}
                                </div>
                                <a href="{{ route('service.detail', $new['slug']) }}" class="services-link btn-link d-inline-flex align-items-center gap-2">
                                    Xem thêm
                                    <div
                                        class="services-arrow circle-arrow d-inline-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />

    <!-- ======= End Blog ======= -->
@endSection

@section('js')
@endSection

@push('js')
    <script>
        $(function() {
            $('.view-file').click(function(e) {
                const nameFile = $(this).data('name') || '';
                const dataFileName = $(this).attr("href") || '';
                let csrfToken = document.getElementById('csrf_token').value;
                const pathUrl = window.location.href;
                const dataCreate = {
                    title: pathUrl?.split('/')?.pop() || "",
                    action: "view file",
                    name_file: nameFile,
                    path_file: dataFileName
                }
                var _actionURL = $('#url-acivity-log').val();

                $.ajax({
                    url: _actionURL,
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        ...dataCreate
                    },
                    success: function(response) {
                        if (response.status) {}
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            })
        });
    </script>
@endpush
