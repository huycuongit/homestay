@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <link rel="preload" href="{{ asset('assets/css/home.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/home.css') }}"></noscript>
    <style>
    </style>
@endpush

@section('content')
    <section id="banner-section">
        <div class="">
            <div class="align-items-center">
                <div class="col-md-12 image">
                    <img src="{{ asset('assets/imgs/banner-home.jpg') }}" alt="Banner" fetchpriority="high">
                </div>
            </div>
        </div>
    </section>
    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />


    <section id="gallery" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-4 mb-4" id="gallery-title-des">
                    <div class="gallery-title">
                        {!! checkValue($arrSetups, 'gallery_title') !!}

                    </div>
                    <div class="gallery-des">
                        {!! checkValue($arrSetups, 'gallery_description') !!}

                    </div>
                    <a href="{{ route('page.slug', 'thu-vien-anh') }}" class="mt-3 px-4 py-2 custom-button">
                        Xem thêm <i class="fa-regular fa-circle-right"></i>
                    </a>

                </div>

                <!-- Ảnh lớn -->
                <div class="col-lg-8" id="gallery-main-img">
                    <img src="{{ isset($arrSetups) && isset($arrSetups['gallery_img_1']) ? Storage::url($arrSetups['gallery_img_1']) : '' }}" alt="Ảnh hoạt động 1" class="img-fluid w-100 shadow-sm" >
                </div>
            </div>

            <!-- Ảnh nhỏ bên dưới -->
            <div class="row g-3" id="gallery-images">
                <div class="col-md-4">
                    <img src="{{ isset($arrSetups) && isset($arrSetups['gallery_img_2']) ? Storage::url($arrSetups['gallery_img_2']) : '' }}" alt="Ảnh hoạt động 2" class="img-fluid w-100 shadow-sm">
                </div>
                <div class="col-md-4">
                    <img src="{{ isset($arrSetups) && isset($arrSetups['gallery_img_3']) ? Storage::url($arrSetups['gallery_img_3']) : '' }}" alt="Ảnh hoạt động 3" class="img-fluid w-100 shadow-sm">
                </div>
                <div class="col-md-4">
                    <img src="{{ isset($arrSetups) && isset($arrSetups['gallery_img_4']) ? Storage::url($arrSetups['gallery_img_4']) : '' }}" alt="Ảnh hoạt động 4" class="img-fluid w-100 shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <section id="project" class="project-section">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h2 class="project-section-title">
                        {!! checkValue($arrSetups, 'project_title') !!}
                        
                    </h2>
                    <div class="project-des">
                        {!! checkValue($arrSetups, 'project_description') !!}
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('page.slug', 'thu-vien-anh') }}" id="project-button" class="mt-3 px-4 py-2 custom-button">
                        Xem thêm <i class="fa-regular fa-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <!-- Repeat each image item -->
                <div class="col-12 col-md-6">
                    <div class="image-wrapper">
                        <img src="{{ isset($arrSetups) && isset($arrSetups['project_img_1']) ? Storage::url($arrSetups['project_img_1']) : '' }}" class="img-fluid w-100 img-1" alt="Công trình 1">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="image-wrapper ">
                        <img src="{{ isset($arrSetups) && isset($arrSetups['project_img_2']) ? Storage::url($arrSetups['project_img_2']) : '' }}" class="img-fluid w-100 img-2" alt="Công trình 2">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="image-wrapper">
                        <img src="{{ isset($arrSetups) && isset($arrSetups['project_img_3']) ? Storage::url($arrSetups['project_img_3']) : '' }}" class="img-fluid w-100" alt="Công trình 3">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="image-wrapper">
                        <img src="{{ isset($arrSetups) && isset($arrSetups['project_img_4']) ? Storage::url($arrSetups['project_img_4']) : '' }}" class="img-fluid w-100" alt="Công trình 4">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="image-wrapper">
                        <img src="{{ isset($arrSetups) && isset($arrSetups['project_img_5']) ? Storage::url($arrSetups['project_img_5']) : '' }}" class="img-fluid w-100" alt="Công trình 5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="services-section py-5 bg-white">
        <div class="container">
            <div class="mb-5">
                <div class="services-title fw-bold">
                    {!! checkValue($arrSetups, 'service_title') !!}
                </div>
                <div class="services-des mt-3">
                    {!! checkValue($arrSetups, 'service_description') !!}
                </div>
            </div>

            <div class="row g-4">
                @foreach ($services as $service)
                <div class="col-md-4">
                    <div class="services-card card h-100 border-0 d-flex flex-column gap-3">
                        <img src="{{ Storage::url($service->avatar)}}" class="services-img card-img-top" alt="Thi công">
                        <div class="card-body px-0 d-flex flex-column gap-3">
                            <div class="services-card-title">
                                {{ checkValue($service, 'title') }}
                            </div>
                            <div class="services-card-des text-muted">
                                {{ checkValue($service, 'description') }}

                            </div>
                            <a href="{{ route('service.detail', $service['slug']) }}" class="services-link btn-link d-inline-flex align-items-center gap-2">
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

    <section id="brand" class="brand-section py-5">
        <div class="container">
          <div class="row align-items-center">
            <!-- Bên trái: Nội dung -->
            <div class="col-md-6 brand-content">
              <h2 class="brand-title mb-3">
                {!! checkValue($arrSetups, 'brand_title') !!}
              </h2>
              <p class="brand-description text-muted">
                {!! checkValue($arrSetups, 'brand_description') !!}
              </p>
      
              <ul class="brand-features list-unstyled mt-4 d-flex flex-column gap-2">
                {!! renderCleanList(checkValue($arrSetups, 'brand_content')) !!}
              </ul>
      
              <div class="mt-4">
                <a href="#footer" id="brand-button" class="mt-3 px-4 py-3 custom-button">
                    Liên hệ ngay <i class="fa-regular fa-circle-right"></i>
                </a>
              </div>
            </div>
      
            <!-- Bên phải: Hình ảnh -->
            <div class="col-md-6 text-center mt-4 mt-md-0">
              <div class="brand-image rounded overflow-hidden">
                <img src="{{ isset($arrSetups) && isset($arrSetups['brand_img_1']) ? Storage::url($arrSetups['brand_img_1']) : '' }}" alt="Cẩu điện" class="img-fluid rounded">
              </div>
            </div>
          </div>
        </div>
      </section>
      
@endSection

@section('js')
@endSection

@push('js')
    <script>
        $(function() {});
    </script>
@endpush
