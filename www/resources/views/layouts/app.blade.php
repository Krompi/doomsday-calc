<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            @include('layouts.navigation')


            <!-- Page Content -->
            <main class="max-w-6xl px-4 py-6 mx-auto">

                @hasSection('heading')
                <h1 class="text-2xl py-4 font-bold leading-7 text-gray-900 sm:text-3xl">@yield('heading')</h1>
                @endif

                @yield('content')
            </main>
        </div>
    </body>
</html>