<!DOCTYPE html>
<html x-data="{ darkMode: Alpine.store('darkMode') }" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-bind:data-theme="darkMode.isDarkMode ? 'forest' : 'cupcake'">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Social Meta Tags -->
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="Track your habits and improve your life with {{ config('app.name') }}">
    <meta property="og:image" content="{{ url(asset('social.png')) }}">
    <meta property="og:thumbnail" content="{{ url(asset('social.png')) }}">
    <meta property="og:url" content="{{ url('/') }}">

    <!-- X/Twitter Meta tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta name="twitter:description" content="Track your habits and improve your life with {{ config('app.name') }}">
    <meta name="twitter:image" content="{{ url(asset('social.png')) }}">
    <meta name="twitter:url" content="{{ url('/') }}">

    @hasSection('title')

    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dancing Script Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rouge+Script&family=Jost:wght@400..700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @yield('body')

    @if(config('services.google.analytics.enabled'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics.id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ config('services.google.analytics.id') }}');
    </script>
    @endif
</body>

</html>