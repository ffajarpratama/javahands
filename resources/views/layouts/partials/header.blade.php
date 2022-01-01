<nav class="navbar sticky-top navbar-expand-md navbar-light bg-white" aria-label="navbar">
    <div class="container">
        {{--BEGIN NAVBAR BRAND--}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('placeholders/logos/jh-logo-text-color.png') }}" alt="jh-logo-text-color"
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
                    <a href="" class="nav-link fs-7 {{ Route::is('home') ? 'text-bistre' : 'text-seal-brown-50' }}">
                        Home
                    </a>
                </div>
                {{--END HOME LINK--}}

                {{--PRODUCT DROPDOWN--}}
                <div class="nav-item dropdown mx-3 my-auto">
                    <a id="navbarDropdown"
                       class="nav-link fs-7 dropdown-toggle {{ Route::is('product.index') || Route::is('product.home') ? 'text-bistre' : 'text-seal-brown-50' }}"
                       href="" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Product
                        <i class="fas fa-chevron-down ps-2"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item fs-7 text-seal-brown-50" href="{{ route('product.home') }}" role="button">
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
                    <a href=""
                       class="nav-link fs-7 {{ Route::is('about') ? 'text-bistre' : 'text-seal-brown-50' }}">
                        About
                    </a>
                </div>
                {{--END ABOUT LINK--}}

                @if(!auth()->check() || auth()->check() && !auth()->user()->is_admin)
                    {{--CART LINK--}}
                    <div class="nav-item mx-3 my-auto">
                        <a href="{{ auth()->check() ? route('user.cart.index') : route('login') }}" class="nav-link fs-7">
                            @if(Route::is('user.cart.index'))
                                <img class="m-auto" src="{{ asset('placeholders/cart-fill.png') }}" alt="cart-logo" style="width: 46px; height: 46px;">
                            @else
                                <img class="m-auto cart-logo" src="{{ asset('placeholders/cart.png') }}" alt="cart-logo">
                            @endif
                        </a>
                    </div>
                    {{--END CART LINK--}}
                @elseif(auth()->check() && auth()->user()->is_admin)
                    {{--CART LINK--}}
                    <div class="nav-item mx-3 my-auto" style="display: none;">
                        <a href="{{ auth()->check() ? route('user.cart.index') : route('login') }}" class="nav-link fs-7">
                            @if(Route::is('user.cart.index'))
                                <img class="m-auto" src="{{ asset('placeholders/cart-fill.png') }}" alt="cart-logo" style="width: 46px; height: 46px;">
                            @else
                                <img class="m-auto cart-logo" src="{{ asset('placeholders/cart.png') }}" alt="cart-logo">
                            @endif
                        </a>
                    </div>
                    {{--END CART LINK--}}
                @endif

                @guest()
                    {{--NO-AUTH DROPDOWN LINKS--}}
{{--                    <div class="nav-item mx-3 my-auto">--}}
{{--                        <a href="{{ route('login') }}" class="nav-link fs-7 text-seal-brown-50">--}}
{{--                            Login--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="nav-item mx-3 my-auto">--}}
{{--                        <a href="{{ route('register') }}" class="nav-link fs-7 text-seal-brown-50">--}}
{{--                            Register--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    {{--NO-AUTH DROPDOWN LINKS--}}
                @else
                    {{--AUTH LINKS--}}
                    <div class="nav-item dropdown mx-3 my-auto">
                        <a id="navbarDropdown" class="nav-link fs-7 dropdown-toggle text-seal-brown-50" href="#"
                           role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                            <img class="ps-2" src="{{ asset('placeholders/profile.png') }}" alt="..."
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
