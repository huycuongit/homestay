<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">

<meta name="title"
    content="{{ isset($metaData) ? checkValue($metaData, 'title', 'Xây lắp điện Hoàng Giang') : 'Xây lắp điện Hoàng Giang' }}">
<meta name="description"
    content="{{ isset($metaData) ? checkValue($metaData, 'title', 'Xây lắp điện Hoàng Giang') : 'Xây lắp điện Hoàng Giang' }}">
<meta name="keywords"
    content="{{ isset($metaData) ? checkValue($metaData, 'key_words', 'Xây lắp điện Hoàng Giang') : 'Xây lắp điện Hoàng Giang' }}">

@if (isset($arrSetups['no_index']))
    {!! $arrSetups['no_index'] !!}
@else
    <meta name="robots" content="all" />
@endif

<meta name="theme-color" content="#ffffff">

<meta name="copyright" content="CÔNG TY TNHH XÂY DỰNG DỊCH VỤ KỸ THUẬT HOÀNG GIANG">
<meta name="author" content="CÔNG TY TNHH XÂY DỰNG DỊCH VỤ KỸ THUẬT HOÀNG GIANG">
<link rel="canonical" href="{{ request()->url() }}">


<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ checkValue($arrSetups, 'website_og_title', 'Xây lắp điện Hoàng Giang') }}">
<meta property="og:image" content="{{ checkValue($arrSetups, 'website_og_image', '') }}">
<meta property="og:description"
    content="{{ checkValue($arrSetups, 'website_og_description', 'Xây lắp điện Hoàng Giang') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Xây lắp điện Hoàng Giang">
<meta property="og:locale" content="en_US">

<!-- YouTube Meta Tags -->
{{-- <meta name="og:video" content="https://www.youtube.com/embed/videoid"> --}}
<meta name="og:video:type" content="text/html">
<meta name="og:video:width" content="1280">
<meta name="og:video:height" content="720">
{{-- <meta name="og:video:secure_url" content="https://www.youtube.com/embed/videoid"> --}}

<!-- TikTok Meta Tags (Custom Implementation) -->
{{-- <meta property="og:video" content="https://www.tiktok.com/embed/videoid"> --}}
<meta property="og:video:type" content="video/mp4">
<meta property="og:video:width" content="640">
<meta property="og:video:height" content="360">

<!-- Zalo Meta Tags -->
<meta property="og:title" content="{{ checkValue($arrSetups, 'zalo_og_title', 'Xây lắp điện Hoàng Giang') }}">
<meta property="og:description"
    content="{{ checkValue($arrSetups, 'website_og_description', 'Xây lắp điện Hoàng Giang') }}">
<meta property="og:image" content="{{ checkValue($arrSetups, 'zalo_og_image', '') }}">
<meta property="og:url" content="{{ checkValue($arrSetups, 'zalo_og_url', '') }}">

@yield('meta')
