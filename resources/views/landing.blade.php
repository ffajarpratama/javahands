@extends('layouts.app')
@section('header')
    <div class="d-flex flex-row justify-content-start">
        <div class="col-md-auto me-5">
            <header class="d-flex flex-row justify-content-center align-items-center">
                <div class="col-md-6 ms-5 ps-3">
                    <p class="mb-4 text-white fs-30-px fw-700">
                        Crafted from our finest hands to yours
                    </p>
                    <p class="mb-4 text-white">
                        Discover our handcrafted items with uniqueness and exquisiteness made by the finest artisans
                        from
                        Indonesia
                    </p>
                    <a href="{{ route('product.index') }}" class="btn btn-jh-white fw-600">
                        See Products
                    </a>
                </div>
            </header>
        </div>

        <div class="col-md-auto my-auto ms-3 pt-5">
            <div class="d-flex flex-row justify-content-center align-items-end mt-5">
                <div class="col-md-6">
                    <img src="{{ asset('placeholders/landing-image.png') }}" alt="...">
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar fixed-top navbar-expand-md navbar-light" aria-label="navbar">
        <div class="container">
            {{--BEGIN NAVBAR BRAND--}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('placeholders/logos/jh-logo-text-white.png') }}" alt="jh-logo-text-color"
                     class="d-inline-block align-text-top" style="width: 150px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{--END NAVBAR BRAND--}}

            {{--START NAVBAR ITEMS RIGHT--}}
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="navbar-nav ms-auto">
                    {{--HOME LINK--}}
                    <div class="nav-item mx-3 my-auto">
                        <a href="{{ route('landing') }}"
                           class="nav-link fs-7 {{ Route::is('landing') ? 'text-bistre fw-600' : 'text-seal-brown-50' }}">
                            Home
                        </a>
                    </div>
                    {{--END HOME LINK--}}

                    {{--PRODUCT DROPDOWN--}}
                    <div class="nav-item dropdown mx-3 my-auto">
                        <a id="navbarDropdown"
                           class="nav-link fs-7 dropdown-toggle {{ Route::is('product.index') || Route::is('product.home') ? 'text-bistre fw-600' : 'text-seal-brown-50' }}"
                           href="" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Product
                            <i class="fas fa-chevron-down ps-2"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item fs-7 text-seal-brown-50" href="{{ route('product.home') }}"
                               role="button">
                                Featured Products
                            </a>

                            <hr class="dropdown-divider">

                            <a class="dropdown-item fs-7 text-seal-brown-50"
                               href="{{ route('product.index', ['category' => 'all_products']) }}">
                                All Products
                            </a>
                            @foreach($categories as $category)
                                <a class="dropdown-item fs-7 text-seal-brown-50"
                                   href="{{ route('product.index', ['category' => $category->name]) }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{--END PRODUCT DROPDOWN--}}

                    {{--ABOUT LINK--}}
                    <div class="nav-item mx-3 my-auto">
                        <a href="{{ route('about') }}"
                           class="nav-link fs-7 {{ Route::is('about') ? 'text-bistre fw-600' : 'text-seal-brown-50' }}">
                            About
                        </a>
                    </div>
                    {{--END ABOUT LINK--}}

                    @if(!auth()->check() || auth()->check() && !auth()->user()->is_admin)
                        {{--CART LINK--}}
                        <div class="nav-item mx-3 my-auto position-relative">
                            <a href="{{ auth()->check() ? route('user.cart.index') : route('login') }}"
                               class="nav-link fs-7">
                                @if(Route::is('user.cart.index'))
                                    <img class="m-auto" src="{{ asset('placeholders/cart-fill.png') }}" alt="cart-logo"
                                         style="width: 46px; height: 46px;">
                                @else
                                    <img class="m-auto cart-logo" src="{{ asset('placeholders/cart.png') }}"
                                         alt="cart-logo">
                                @endif
                            </a>
                        </div>
                        {{--END CART LINK--}}
                    @elseif(auth()->check() && auth()->user()->is_admin)
                        {{--CART LINK--}}
                        <div class="nav-item mx-3 my-auto" style="display: none;">
                            <a href="{{ auth()->check() ? route('user.cart.index') : route('login') }}"
                               class="nav-link fs-7">
                                @if(Route::is('user.cart.index'))
                                    <img class="m-auto" src="{{ asset('placeholders/cart-fill.png') }}" alt="cart-logo"
                                         style="width: 46px; height: 46px;">
                                @else
                                    <img class="m-auto cart-logo" src="{{ asset('placeholders/cart.png') }}"
                                         alt="cart-logo">
                                @endif
                            </a>
                        </div>
                        {{--END CART LINK--}}
                    @endif

                    @guest()
                    @else
                        {{--AUTH LINKS--}}
                        <div class="nav-item dropdown mx-3 my-auto">
                            <a id="navbarDropdown" class="nav-link fs-7 dropdown-toggle text-bistre fw-600" href="#"
                               role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->first_name }}
                                <img class="ps-2" src="{{ asset('placeholders/profile-secondary.png') }}" alt="..."
                                     style="height: 2rem; width: auto;">
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-seal-brown-50 fs-7" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        {{--END AUTH LINKS--}}
                    @endguest
                </div>
            </div>
            {{--END NAVBAR ITEMS RIGHT--}}
        </div>
    </nav>
@endsection
@section('content')
    <div class="container p-5 my-5">
        <div class="row g-0 my-5 justify-content-center align-items-center">
            <div class="col-md-6 text-center mb-5">
                <img src="{{ asset('placeholders/material-1.png') }}" alt="...">
                <img src="{{ asset('placeholders/material-2.png') }}" alt="...">
                <img src="{{ asset('placeholders/material-3.png') }}" alt="...">
                <img src="{{ asset('placeholders/material-4.png') }}" alt="...">
                <img src="{{ asset('placeholders/material-5.png') }}" alt="...">
            </div>
            <div class="col-md-4 mx-auto mb-5">
                <p class="fs-30-px fw-700 text-black">
                    Crafted with excellent materials
                </p>
                <p class="fw-400 text-black">
                    We are using finest and authentic raw materials such rattan, bamboo, wood, hyacinth, leather and
                    other materials.
                </p>
            </div>
        </div>

        <div class="row g-0 justify-content-center p-5 mb-5">
            <p class="mb-0 fs-30-px fw-700 text-jh-brown text-center mb-5">
                Be acquanted with JavaHands
            </p>
        </div>

        <div class="d-flex flex-row justify-content-center align-items-center mb-5">
            <div class="col-md-4">
                <img class="d-flex mx-auto" src="{{ asset('placeholders/hand-icon.png') }}" alt="...">
            </div>
            <div class="col-md-4">
                <img class="d-flex mx-auto" src="{{ asset('placeholders/knit-icon.png') }}" alt="...">
            </div>
            <div class="col-md-4">
                <img class="d-flex mx-auto" src="{{ asset('placeholders/unlimited-icon.png') }}" alt="...">
            </div>
        </div>

        <div class="d-flex flex-row mb-5 justify-content-center">
            <div class="col-md-4 mb-5">
                <p class="fw-400 text-black text-center px-5">
                    Design created to keep up with the era
                </p>
            </div>
            <div class="col-md-4 mb-5">
                <p class="fw-400 text-black text-center px-5">
                    Using finest natural materials makes it unique and exquisite
                </p>
            </div>
            <div class="col-md-4 mb-5">
                <p class="fw-400 text-black text-center px-5">
                    Made by professionals to ensure quality and durability
                </p>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center mb-5">

            @foreach($landing_categories as $category)
                <div class="col-md-4 px-3">
                    <a href="{{ route('product.index', ['category' => $category->name]) }}">
                        <div class="card border-0 text-white" style="min-height: 411px;">
                            <img src="{{ asset('placeholders/products/landing-product-1.png') }}" class="card-img"
                                 alt="...">
                            <div class="card-img-overlay d-flex flex-column justify-content-end">
                                <p class="mb-0 fw-200">
                                    {{ $category->products_count }} products
                                </p>
                                <p class="fs-30-px fw-600 mb-0">
                                    {{ ucwords($category->name) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
@section('script')
    <script>
        $(window).scroll(() => {
            if ($('.navbar').offset().top > 100) {
                $('nav').addClass('bg-white').css({'transition': '0.25s ease'});
                $('.navbar-brand img').attr('src', `{!! asset('placeholders/logos/jh-logo-text-color.png') !!}`);
            } else {
                $('nav').removeClass('bg-white').css({'transition': '0.25s ease'});
                $('.navbar-brand img').attr('src', `{!! asset('placeholders/logos/jh-logo-text-white.png') !!}`);
            }
        })
    </script>
@endsection
