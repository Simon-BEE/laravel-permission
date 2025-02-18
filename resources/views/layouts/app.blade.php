<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} &mdash; @yield('meta-title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('extra-head')
</head>
<body class="bg-gray-200 min-h-screen font-base overflow-x-hidden relative" x-data="{ 'isDialogOpen': false }">
    <div id="app">

        @include('includes.nav')

        <header class="bg-white shadow">
            <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">@yield('header')</h1>
            </div>
        </header>

        <main>
            @if (session()->has('type'))
                <x-alert type="{{ session('type') }}">{{ session()->has('message') ? session('message') : '' }}</x-alert>
            @endif
            <div class="container mx-auto py-6 sm:px-6 lg:px-8 overflow-x-scroll md:overflow-x-hidden">
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">

                    @yield('content')
                </div>
                <!-- /End replace -->
            </div>
        </main>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.js"></script> --}}
        <script>
            const flashAlertElement = document.querySelector('.alert-flash');
            if (flashAlertElement) {
                setTimeout(() => {
                    flashAlertElement.style.transform = 'translateX(0)';
                }, 1000);
                setTimeout(() => {
                    flashAlertElement.style.transform = 'translateX(100%)';
                }, 5000);
            }
        </script>
        @yield('extra-js')
    </div>
</body>
</html>
