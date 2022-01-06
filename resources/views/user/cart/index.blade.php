@extends('layouts.app')
@section('header')
    @include('layouts.partials.header')
@endsection
@section('content')
    <div class="container p-5 mb-5">

        <div class="row g-0 mb-4">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @elseif(session()->has('danger'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('danger') }}</strong>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="d-flex flex-row mb-3">
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('cart') }}
        </div>

        <div class="row g-0 justify-content-between">
            <div class="col-md-5">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                {{ $user->getFullNameAttribute() }}
                            </p>
                            <a href="{{ route('user.profile.details', $user->id) }}" class="btn btn-jh-secondary">
                                Setting
                            </a>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-6">
                                <p class="my-4 text-secondary fw-400">
                                    {{ $user->phone_number }}
                                </p>
                                <p class="text-secondary fw-400">
                                    {{ $user->email }}
                                </p>

                            </div>
                        </div>

                        <p class="text-secondary fw-400">
                            @if($user->state)
                                {{ $user->address }}, {{ $user->state->name }}, {{ $user->getCountryName() }}
                            @else
                                {{ $user->address }}
                            @endif
                        </p>
                        <hr style="color: #C4C4C4; border-radius: 2px; height: 4px;">
                    </div>
                </div>
            </div>

            <div class="col-md-7 px-3">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <div class="row g-0">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Your Cart
                            </p>

                            <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">
                        </div>

                        <div class="d-flex flex-row justify-content-between mb-3">
                            <div class="col-md-4">
                                <p class="mb-0 fw-700 text-bistre">
                                    Products
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fw-700 text-bistre">
                                    Weight
                                </p>
                            </div><div class="col-md-2 text-center">
                                <p class="mb-0 fw-700 text-bistre">
                                    Price
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fw-700 text-bistre">
                                    Amounts
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fw-700 text-bistre">
                                    Subtotal
                                </p>
                            </div>
                        </div>

                        <hr style="color: #C4C4C4">

                        @if($carts->isNotEmpty())
                            @foreach($carts as $cart)
                                <div class="row g-0 justify-content-between align-items-center">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-row justify-content-start align-items-center">
                                            @if(!$cart->product->picture)
                                                <img class="cart-product-img"
                                                     src="{{ asset('placeholders/products/product-placeholder.png') }}"
                                                     alt="...">
                                            @else
                                                <img class="cart-product-img"
                                                     src="{{ asset('storage/products/' . $cart->product->picture) }}"
                                                     alt="...">
                                            @endif

                                            <p class="mb-0 fs-7 text-bistre fw-400 ms-3">
                                                {{ $cart->product->name }}
                                            </p>
                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center">
                                        <p class="mb-0 fs-7 text-bistre fw-400">
                                            {{ $cart->unit_weight .  ' kg' }}
                                        </p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p class="mb-0 fs-7 text-bistre fw-400">
                                            {{ '$' . number_format($cart->unit_price) }}
                                        </p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p class="mb-0 fs-7 text-bistre fw-400">
                                            {{ $cart->quantity }}
                                        </p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p class="mb-0 fs-7 text-bistre fw-600">
                                            {{ '$' . number_format($cart->sub_total) }}
                                        </p>
                                    </div>
                                </div>

                                <hr style="color: #C4C4C4">
                            @endforeach

                            <div class="d-flex flex-row justify-content-between mb-3">
                                <p class="mb-0 fw-700 text-bistre">
                                    Shipping
                                </p>
                            </div>

                            <hr style="color: #C4C4C4">

                            <div class="row g-0 justify-content-between mb-3">
                                <div class="col-md-10">
                                    <p class="mb-0 fs-12-px fw-400 text-danger">
                                        *Our shipping cost are based on total weight and dimension of the products. <br>
                                        Total weight less than 1kg be charged the base shipping price. <br>
                                        While any additional kilos will be charged $15 each.
                                    </p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-0 fs-7 fw-600 text-bistre">
                                        {{ $carts->sum('total_weight') . ' kg'}}
                                    </p>
                                </div>
                            </div>

                            <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                            <div class="row g-0 justify-content-end mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="mb-0 col text-jh-brown fw-400">
                                            Product Subtotal
                                        </p>
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fw-400">
                                            {{ '$' . number_format($carts->sum('sub_total')) }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="mb-0 col text-jh-brown fw-400">
                                            Taxes
                                        </p>
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fw-400">
                                            Free
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="mb-0 col text-jh-brown fw-400">
                                            Shipping Subtotal
                                        </p>
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fw-400">
                                            -
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                            <div class="row g-0 justify-content-end mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="mb-0 col text-jh-brown fs-20-px fw-700">
                                            Total
                                        </p>
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fs-20-px fw-700">
                                            {{ '$' . number_format($carts->sum('sub_total')) }}
                                        </p>
                                    </div>

                                    <div class="d-grid gap-2 mt-5">
                                        <a href="{{ route('user.order.create') }}" class="btn btn-jh-secondary fs-20-px fw-700">
                                            Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-row justify-content-center align-items-center my-5">
                                <p class="mb-0 text-black-50 fw-700">
                                    You haven't picked any product..
                                </p>
                            </div>
                            <div class="d-flex flex-row justify-content-center align-items-center mb-5">
                                <a href="{{ route('product.index') }}" class="btn btn-jh-primary me-3">
                                    Go to products
                                </a>
                                <a href="{{ route('user.order.index') }}" class="btn btn-jh-secondary">
                                    Check your orders
                                    <i class="fas fa-receipt ms-2"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
