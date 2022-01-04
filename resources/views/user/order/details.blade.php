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
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('order-details', $order) }}
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
                                <p class="mb-0">{{ $user->getFullNameAttribute() }}</p>
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
                                @if($user->state)
                                    <p class="mb-0">
                                        {{ $user->address }}, {{ $user->state->name }}, {{ $user->getCountryName() }}
                                    </p>
                                @else
                                    <p class="mb-0">
                                        {{ $user->address }}
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
                                <p class="mb-0">{{ $user->email }}</p>
                                <p class="mb-0">{{ $user->phone_number }}</p>
                            </div>
                        </div>

                        <hr style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                        @if($order->payment_status === 'CREATED')
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <p class="mb-0 fs-24-px fw-700 text-bistre">
                                    Payment Method
                                </p>
                            </div>

                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <p class="mb-0 fs-7 text-bistre">
                                    please choose your payment method (All transactions are secure and confidential)
                                </p>
                            </div>

                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <div class="col-md-7">
                                    <form action="{{ route('user.order.payment', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-jh-secondary">
                                                Credit/Debit Card
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <img src="{{ asset('placeholders/visa.png') }}" alt="...">
                                        <img src="{{ asset('placeholders/mastercard.png') }}" alt="...">
                                        <img src="{{ asset('placeholders/american-express.png') }}" alt="...">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <div class="col-md-7">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-jh-secondary" disabled>
                                            PayPal
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <img src="{{ asset('placeholders/paypal.png') }}" alt="...">
                                        and more...
                                    </div>
                                </div>
                            </div>
                        @elseif($order->payment_status === 'PAID')
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <p class="mb-0 fs-24-px fw-700 text-bistre">
                                    Your Order Progress
                                </p>
                            </div>

                            @if($order->order_progress === 'IN_PACKAGING')
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <div class="fs-20-px fw-700 badge bg-warning text-dark">
                                        In Packaging
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <p class="mb-0 fs-7 text-bistre">
                                        Please wait, we are still packaging your products. When the process is complete, we
                                        will send it at once!
                                    </p>
                                </div>
                            @elseif($order->order_progress === 'ON_DELIVERY')
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <div class="fs-20-px fw-700 badge bg-info text-dark">
                                        On Delivery
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <p class="mb-0 fs-7 text-bistre">
                                        Sit tight! Your product is being sent to your address!
                                    </p>
                                </div>
                                <p class="mb-0 fs-7 text-bistre">
                                    Here is your shipping receipt number:
                                </p>
                                <strong class="fs-7 text-bistre">{{ $order->receipt_number }}</strong>

                                <div class="d-flex flex-row justify-content-between align-items-center mt-3">
                                    <div class="col-md-10 pe-3">
                                        <p class="mb-0 fs-7 text-bistre">
                                            Already receive the package?
                                        </p>
                                        <p class="mb-1 fs-7 text-bistre">
                                            Confirm to us by clicking the button below!
                                        </p>
                                        <form action="{{ route('user.order.received', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn fs-7 btn-jh-primary">
                                                    Package Received!
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @elseif($order->order_progress === 'RECEIVED')
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <div class="fs-20-px fw-700 badge bg-success">
                                        Received
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                    <div class="col-md-10">
                                        <p class="mb-1 fs-7 text-bistre">
                                            Thank you for your purchase! Ready for another? Let's start shopping!
                                        </p>
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('product.index') }}" class="btn fs-7 btn-jh-primary">
                                                Go to products
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-7 px-3">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0 fs-24-px fw-700 text-bistre">
                                Your Order
                            </p>
                            @if($order->payment_status === 'CREATED')
                                <div class="fs-20-px fw-700 badge bg-warning text-dark">
                                    Awaiting Payment
                                </div>
                            @elseif($order->payment_status === 'PENDING')
                                <div class="fs-20-px fw-700 badge bg-info text-dark">
                                    Payment Pending
                                </div>
                            @elseif($order->payment_status === 'PAID')
                                <div class="fs-20-px fw-700 badge bg-success">
                                    Payment Complete
                                </div>
                            @endif
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

                        {{--                        @if($carts->isNotEmpty())--}}
                        {{--                            --}}
                        {{--                        @else--}}
                        {{--                        @endif--}}
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
                                <p class="mb-0 fs-12-px fw-400 text-danger">
                                    *Our shipping cost are based on total weight and dimension of the products. For
                                    example, you can ship three rattan bags for the same shipping cost
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fs-7 fw-600 text-bistre">
                                    0.3 kg
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
@section('footer')
    @include('layouts.partials.footer')
@endsection
