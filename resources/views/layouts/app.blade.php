<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
    <title>{{ config('app.name', 'JavaHands') }}</title>
</head>
<body>
<div id="app">
    @yield('header')
    <main>
        @yield('content')
    </main>
</div>
@yield('footer')
@yield('script')
@include('layouts.partials.script')
</body>
</html>
