<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- CSS files -->
    <link href="{{ asset('test/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @vite('resources/css/app.css')
    <!-- Custom CSS for specific page.  -->
    {{-- @stack('page-styles') --}}
    {{-- @livewireStyles --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
</head>

<body>

    <div class="page">

        @include('layouts.test.header')

        @include('layouts.test.navbar')

        <div class="page-wrapper">
            <div>
                @yield('content')
            </div>

            @include('layouts.test.footer')
        </div>
    </div>

    <!-- Tabler Core -->
    <script src="{{ asset('test/dist/js/tabler.min.js') }}" defer></script>
    {{-- - Page Scripts - --}}
    {{-- @stack('page-scripts') --}}

    {{-- @livewireScripts --}}
</body>

</html>
