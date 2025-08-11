@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <style>
        @media (min-width: 1200px) {

            /***** Hero CSS *****/
            .service-list-title {
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;
                color: var(--main-color);
                padding-bottom: 30px;
            }
            .service-img {
                max-width: 372px;
                max-height: 255px;
                object-fit: cover;
                flex-shrink: 0;
                position: relative;
                overflow: hidden;
            }
            .service-img img{
                width: 372px;
                height: 255px;
                object-fit: cover;
            }

            .service-badge {
                background-color: #007BFF;
                /* hoặc sử dụng biến Bootstrap */
                border-top-right-radius: 4px;
                font-size: 0.75rem;
            }

            .service-item {
                transition: box-shadow 0.2s ease;
                border: solid 1px var(--main-color);
            }
            .service-content {
                padding: 30px;
            }
            .service-item:hover {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }
            .service-item-des {
                font-weight: 400;
                font-style: Regular;
                font-size: 20px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                color: var(--main-color);
            }
            .service-item-title {
                font-weight: Heading/Font Weight;
                font-style: SemiBold;
                font-size: 30px;
                leading-trim: NONE;
                line-height: 120%;
                letter-spacing: -2%;
                color: var(--main-color);
            }
            .service-view-more {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                color: var(--main-color);
            }
            .service-view-more:hover {
                color: var(--sub-color);
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

    <section id="service-list" class="py-5">
        <div class="container">
            <h2 class="service-list-title">Danh sách dịch vụ</h2>

            @foreach ($services as $service)
                <div class="service-item d-flex flex-column flex-md-row mb-4">
                    <div class="service-img position-relative mb-3 mb-md-0 me-md-4">
                        <img src="{{ Storage::url($service['avatar']) }}" class="img-fluid"
                            alt="{{ $service['title'] }}">
                    </div>
                    <div class="service-content">
                        <h5 class="service-item-title">{{ $service['title'] }}</h5>
                        <p class="service-item-des">{{ $service['description'] }}</p>
                        <a href="{{ route('service.detail', $service['slug']) }}"
                            class="service-view-more text-decoration-none fw-semibold d-inline-flex align-items-center gap-2">
                            Xem thêm <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />

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
