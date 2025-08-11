<head>
    {{-- <title>{{ isset($data->title) ? $data->title : '' }}</title> --}}
    <title>
        {{ isset($metaData) ? checkValue($metaData, 'title', 'Xây lắp điện Hoàng Giang') : 'Xây lắp điện Hoàng Giang' }}
    </title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}">

    @include('frontend.layouts.partials.meta_seo')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" async defer>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Asynchronously load Date Range Picker CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" defer/> -->

    <!-- Asynchronously load Select2 CSS -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"></noscript>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" async defer>

    <meta name="reCapCha-site-key" content="{!! isset($arrSetups) && isset($arrSetups['google_recaptcha_site_key']) ? $arrSetups['google_recaptcha_site_key'] : '' !!}"/>
    @yield('css')
    @stack('css')

    <!-- Google tag (gtag.js) -->
    {!! isset($arrSetups) && isset($arrSetups['google_analytics_site_tag']) ? $arrSetups['google_analytics_site_tag'] : '' !!}
    {!! isset($arrSetups) && isset($arrSetups['google_analytics_script']) ? $arrSetups['google_analytics_script'] : '' !!}
    
</head>