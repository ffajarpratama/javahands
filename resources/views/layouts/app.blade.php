<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div id="app">
    @include('layouts.partials.header')
    <main>
        @yield('content')
    </main>
</div>
@yield('footer')
@yield('script')
@include('layouts.partials.script')
</body>
</html>
