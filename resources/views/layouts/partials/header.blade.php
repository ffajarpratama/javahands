<nav class="navbar sticky-top navbar-expand-md navbar-light bg-white" aria-label="navbar">
    <div class="container-fluid px-5">
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
                    <a href="{{ route('landing') }}" class="nav-link fs-7 {{ Route::is('landing') ? 'text-bistre fw-600' : 'text-seal-brown-50' }}">
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
                        <a href="{{ auth()->check() ? route('user.cart.index') : route('login') }}" class="nav-link fs-7">
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
                            @if(!auth()->user()->is_admin)
                                <a class="dropdown-item text-seal-brown-50 fs-7" href="{{ route('user.profile.details', auth()->id()) }}">
                                    Your Profile
                                    <i class="fas fa-user ms-3"></i>
                                </a>

                                <a class="dropdown-item text-seal-brown-50 fs-7" href="{{ route('user.order.index') }}">
                                    Your Orders
                                    <i class="fas fa-receipt ms-3"></i>
                                </a>
                            @endif

                            <a class="dropdown-item text-seal-brown-50 fs-7" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <i class="fas fa-sign-out-alt ms-3"></i>
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
