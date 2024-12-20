<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="/fixed/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/fixed/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/fixed/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/fixed/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MyWebSite" />
    <link rel="manifest" href="/fixed/favicon/site.webmanifest" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/portal.scss', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="flex flex-col min-h-screen">
<livewire:components.header/>
{{ $slot }}
<livewire:components.footer/>
@stack('page-js')
</body>
</html>
