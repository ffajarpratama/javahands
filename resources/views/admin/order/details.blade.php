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

        <div class="d-flex flex-row justify-content-between mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-jh-primary btn-icon-split me-3">
                <div class="icon text-white">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="text">Dashboard</div>
            </a>
        </div>

        <div class="row g-0 justify-content-between">
            <div class="col-md-5">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Shipping Address
                            </p>
                        </div>

                        <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                        <div class="d-flex flex-row justify-content-start fs-7 text-bistre mb-3">
                            <div class="col-md-4">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-md-1">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-md-7">
                                <p class="mb-0">{{ $order->user->getFullNameAttribute() }}</p>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-start fs-7 text-bistre mb-3">
                            <div class="col-md-4">
                                <p class="mb-0">Shipping Address</p>
                            </div>
                            <div class="col-md-1">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-md-7">
                                @if($order->user->state)
                                    <p class="mb-0">
                                        {{ $order->user->address }}, {{ $order->user->state->name }}
                                        , {{ $order->user->getCountryName() }}
                                    </p>
                                @else
                                    <p class="mb-0">
                                        {{ $order->user->address }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-start fs-7 text-bistre mb-3">
                            <div class="col-md-4">
                                <p class="mb-0">Contact</p>
                            </div>
                            <div class="col-md-1">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-md-7">
                                <p class="mb-0">{{ $order->user->email }}</p>
                                <p class="mb-0">{{ $order->user->phone_number }}</p>
                            </div>
                        </div>

                        <hr style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                        <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Order Progress
                            </p>
                            @if($order->order_progress === 'IN_PACKAGING')
                                <div class="fs-20-px fw-700 badge bg-warning text-dark">
                                    In Packaging
                                </div>
                            @elseif($order->order_progress === 'ON_DELIVERY')
                                <div class="fs-20-px fw-700 badge bg-info text-dark">
                                    On Delivery
                                </div>
                            @elseif($order->order_progress === 'RECEIVED')
                                <div class="fs-20-px fw-700 badge bg-success">
                                    Received
                                </div>
                            @endif
                        </div>

                        @if($order->order_progress == 'IN_PACKAGING' || $order->order_progress == 'ON_DELIVERY')
                            <form action="{{ route('admin.order.update-progress', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex flex-row mb-2">
                                    <label for="order_progress" class="fs-7 fw-600">
                                        Update Order Progress
                                    </label>
                                </div>

                                <div class="d-flex flex-row mb-3">
                                    <select class="form-control fs-7 text-secondary" name="order_progress"
                                            id="order_progress" required>
                                        <option value="">Select Status</option>
                                        <option
                                            value="IN_PACKAGING" {{ $order->order_progress === 'IN_PACKAGING' ? 'selected' : '' }}>
                                            In Packaging
                                        </option>
                                        <option
                                            value="ON_DELIVERY" {{ $order->order_progress === 'ON_DELIVERY' ? 'selected' : '' }}>
                                            On Delivery
                                        </option>
                                    </select>
                                </div>

                                @if($order->order_progress === 'ON_DELIVERY')
                                    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                        <p class="mb-0 fs-7 text-bistre">
                                            Shipping receipt number sent!
                                        </p>
                                    </div>
                                @else
                                    <div class="d-flex flex-row mb-2">
                                        <label for="receipt_number" class="fs-7 fw-600">
                                            Shipping Receipt Number
                                        </label>
                                    </div>

                                    <div class="d-flex flex-row mb-3">
                                        <input type="text" class="form-control fs-7" name="receipt_number"
                                               id="receipt_number" placeholder="Shipping Receipt Number" required>
                                    </div>
                                @endif

                                <div class="d-flex flex-row">
                                    <button class="btn btn-jh-primary" type="submit">
                                        Update
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <p class="mb-0 fs-7 text-bistre">
                                    Package has been received!
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-7 px-3">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Order Details
                            </p>
                            @if($order->payment_status === 'CREATED')
                                <div class="fs-20-px fw-700 badge bg-warning text-dark">
                                    Awaiting Payment
                                </div>
                            @elseif($order->payment_status === 'PAID')
                                <div class="fs-20-px fw-700 badge bg-success">
                                    Payment Complete
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-row justify-content-start align-items-center">
                            <p class="mb-0 text-bistre">
                                Invoice Number: <strong>{{ $order->invoice_number }}</strong>
                            </p>
                        </div>

                        <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">

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
                            </div>
                            <div class="col-md-2 text-center">
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

                        @foreach($order->carts as $cart)
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
                                        {{ $cart->unit_weight . ' kg' }}
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
                                <p class="mb-1 fs-7 fw-400 text-bistre">
                                    Total Weight
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fs-7 fw-600 text-bistre">
                                    {{ $order->carts->sum('total_weight') . ' kg' }}
                                </p>
                            </div>
                        </div>

                        <div class="row g-0 justify-content-between align-items-center g-0 mb-3">
                            <div class="col-md-10">
                                <p class="fs-7 fw-600 text-bistre">
                                    FedEx (Regular) 7-10 Business Days
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="fs-7 fw-600 text-bistre">
                                    ({{ '$' . number_format($order->shipping_price) }})
                                </p>
                            </div>
                        </div>

                        <hr class="mt-4" style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                        <div class="row g-0 justify-content-end mb-3">
                            <div class="col-md-6">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <p class="mb-0 col text-jh-brown fw-400">
                                        Subtotal
                                    </p>
                                    <p class="mb-0 col-md-4 text-center text-jh-brown fw-400">
                                        {{ '$' . number_format($order->carts->sum('sub_total')) }}
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
                                        Shipping
                                    </p>
                                    <p class="mb-0 col-md-4 text-center text-jh-brown fw-400">
                                        {{ '$' . number_format($order->shipping_price) }}
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
                                        {{ '$' . number_format($order->total_price) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
