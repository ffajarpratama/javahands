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
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('order') }}
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
                        <div class="row g-0 mb-3">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Your Orders
                            </p>
                        </div>


                        @if($orders->isNotEmpty())
                            @foreach($orders as $order)
                                <div class="row g-0 justify-content-between mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex flex-row justify-content-start">
                                                <div class="col-md-3">
                                                    @if($order->carts[0]->product->picture)
                                                        <img class="img-fluid"
                                                             src="{{ asset('storage/products/' . $order->carts[0]->product->picture) }}"
                                                             alt="..." style="max-width: 100px; height: auto;">
                                                    @else
                                                        <img class="img-fluid"
                                                             src="{{ asset('placeholders/products/product-placeholder.png') }}"
                                                             alt="..." style="max-width: 100px; height: auto;">
                                                    @endif
                                                </div>

                                                <div class="col-md-7">
                                                    @if(count($order->carts) > 1)
                                                        <p class="mb-0 text-bistre fs-20-px fw-700">
                                                            {{ $order->carts[0]->product->name }}
                                                        </p>
                                                        <small>and {{ $order->carts->count() - 1  }} more items</small>
                                                    @else
                                                        <p class="mb-0 text-bistre fs-20-px fw-700">
                                                            {{ $order->carts[0]->product->name }}
                                                        </p>
                                                    @endif
                                                    <p class="mb-0 fs-7 mt-auto fw-700">
                                                        {{ '$' . number_format($order->total_price) }}
                                                    </p>
                                                    @if($order->payment_status === 'CREATED')
                                                        <div class="badge bg-warning text-dark mt-auto">
                                                            Awaiting Payment
                                                        </div>
                                                    @elseif($order->payment_status === 'PENDING')
                                                        <div class="badge bg-info text-dark mt-auto">
                                                            Payment Pending
                                                        </div>
                                                    @elseif($order->payment_status === 'PAID')
                                                        <div class="badge bg-success mt-auto">
                                                            Payment Complete
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-white">
                                            <div class="d-flex flex-row justify-content-between align-items-center">
                                                <p class="mb-0 fs-12-px text-secondary">
                                                    Order placed at: {{ $order->created_at->setTimeZone('Asia/Jakarta')->isoFormat('LLLL') }}
                                                </p>
                                                @if($order->payment_status === 'PAID')
                                                    <a href="{{ route('user.order.details', $order->id) }}" class="btn btn-sm btn-jh-secondary">
                                                        Check Details
                                                    </a>
                                                @else
                                                    <a href="{{ route('user.order.details', $order->id) }}" class="btn btn-sm btn-jh-primary">
                                                        Continue to Payment
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex flex-row justify-content-center align-items-center my-5">
                                <p class="mb-0 text-black-50 fw-700">
                                    You haven't ordered anything..
                                </p>
                            </div>
                            <div class="d-flex flex-row justify-content-center align-items-center mb-5">
                                <a href="{{ route('product.index') }}" class="btn btn-jh-primary me-3">
                                    Go to products
                                </a>
                                <a href="{{ route('user.cart.index') }}" class="btn btn-jh-secondary">
                                    Check your carts
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
