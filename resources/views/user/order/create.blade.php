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
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('checkout') }}
        </div>

        <div class="row g-0 justify-content-between">
            <div class="col-md-5">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <p class="mb-0 fs-24-px fw-700 text-bistre">
                                    Shipping Address
                                </p>
                                <button type="submit" class="btn btn-jh-secondary">
                                    Update
                                </button>
                            </div>

                            <hr style="color: #C4C4C4; border-radius: 2px; height: 4px;">

                            <div class="row g-0 mb-4 justify-content-between align-items-center">
                                <div class="col-md-6 pe-1">
                                    <label for="first_name" class="fs-7 fw-600">
                                        First Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input id="first_name" type="text"
                                           class="fs-7 text-secondary form-control @error('first_name') is-invalid @enderror"
                                           name="first_name"
                                           value="{{ $user->first_name }}" required autocomplete="first_name">

                                    @error('first_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 ps-1">
                                    <label for="last_name" class="fs-7 fw-600">
                                        Last Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input id="last_name" type="text"
                                           class="fs-7 text-secondary form-control @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ $user->last_name }}" required autocomplete="last_name">

                                    @error('last_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-0 mb-1">
                                <label for="address" class="fs-7 fw-600">
                                    Address Detail <sup class="text-danger">*</sup>
                                </label>
                            </div>
                            <div class="row g-0 mb-3">
                            <textarea class="form-control fs-7 text-secondary @error('address') is-invalid @enderror"
                                      name="address" required id="address" cols="30" rows="5"
                                      style="resize: none;"
                                      placeholder="Street, House number, Apartment, etc.">{{ $user->address }}</textarea>

                                @error('address')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-4">
                                <label for="country" class="fs-7 fw-600 mb-2">
                                    Country <sup class="text-danger">*</sup>
                                </label>

                                <select
                                    class="form-select countryDropdown fs-7 text-secondary @error('country') is-invalid @enderror"
                                    name="country" id="country">
                                    <option value="">Select Country</option>
                                    @if(!$user->state)
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id }}" {{ $country->id == $user->getCountryId() ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('country')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-4">
                                <label for="state" class="fs-7 fw-600 mb-2">
                                    State/Province <sup class="text-danger">*</sup>
                                </label>

                                <select class="form-select fs-7 text-secondary @error('state') is-invalid @enderror"
                                        name="state" id="state">
                                    <option value="">Select State/Province</option>
                                    @if($user->state)
                                        @foreach($states as $state)
                                            <option
                                                value="{{ $state->id }}" {{ $state->id == $user->state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('state')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-1">
                                <label for="city" class="fs-7 fw-600">
                                    City <sup class="text-danger">*</sup>
                                </label>
                            </div>
                            <div class="row g-0 mb-3">
                                <input id="city" type="text"
                                       class="form-control fs-7 text-secondary @error('city') is-invalid @enderror"
                                       name="city"
                                       value="{{ $user->city }}" required placeholder="City">

                                @error('city')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-1">
                                <label for="zip_code" class="fs-7 fw-600">
                                    Zip Code <sup class="text-danger">*</sup>
                                </label>
                            </div>
                            <div class="row mb-3 g-0">
                                <input id="zip_code" type="text"
                                       class="form-control fs-7 text-secondary @error('zip_code') is-invalid @enderror"
                                       name="zip_code"
                                       value="{{ $user->zip_code }}" required placeholder="Zip Code">

                                @error('zip_code')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-1">
                                <label for="email" class="fs-7 fw-600">
                                    Email <sup class="text-danger">*</sup>
                                </label>
                            </div>
                            <div class="row g-0 mb-3">
                                <input id="email" type="email"
                                       class="fs-7 text-secondary form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="row g-0 mb-1">
                                <label for="phone_number" class="fs-7 fw-600">
                                    Phone Number <sup class="text-danger">*</sup>
                                </label>
                            </div>
                            <div class="row g-0 mb-4">
                                <input
                                    class="form-control fs-7 text-secondary  @error('phone_number') is-invalid @enderror"
                                    id="phone_number" value="{{ $user->phone_number }}"
                                    type="tel" name="phone_number" placeholder="Phone Number">

                                @error('phone_number')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </form>
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
                                    <p class="mb-1 fs-7 fw-400 text-bistre">
                                        Total Weight
                                    </p>
                                    <p class="mb-0 fs-12-px fw-400 text-danger">
                                        *Our shipping cost are based on total weight and dimension of the products. <br>
                                        Total weight less than 1kg be charged the base shipping price. <br>
                                        While any additional kilos will be charged $15 each.
                                    </p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-0 fs-7 fw-600 text-bistre">
                                        {{ $carts->sum('total_weight') . ' kg' }}
                                    </p>
                                </div>
                            </div>

                            <form id="order-form" action="{{ route('user.order.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row g-0 mb-3">
                                    <select
                                        class="form-select fs-7 text-bistre @error('shipping_price') is-invalid @enderror"
                                        name="shipping_price" id="shipping_price" aria-label="shipping_price"
                                        onchange="getShippingPrice()"
                                        style="border: 1px solid #2E190D; box-sizing: border-box; border-radius: 8px;">
                                        <option value="">Select Shipping Option</option>
                                        <option value="45">FedEx (Regular) 7-10 Business Days ($45)</option>
                                    </select>

                                    @error('shipping_price')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </form>


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
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fw-400"
                                           id="shipping_price_text">
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
                                        <p class="mb-0 col-md-4 text-center text-jh-brown fs-20-px fw-700"
                                           id="total_order_price_text">
                                            {{ '$' . number_format($carts->sum('sub_total')) }}
                                        </p>
                                    </div>

                                    <div class="d-grid gap-2 mt-5">
                                        <button class="btn btn-jh-secondary fs-20-px fw-700"
                                                onclick="event.preventDefault(); document.getElementById('order-form').submit();">
                                            Checkout
                                        </button>
                                    </div>
                                </div>
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
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/intlTelInput-jquery.js"
            integrity="sha512-xo8nGg61671g6gPcRbOfQnoL+EP5SofzlUHdZ/ciHev4ZU/yeRFf+TM5dhBnv/fl05vveHNmqr+PFtIbPFQ6jw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //set countryDropdown buat make package select2
        $(document).ready(function () {
            $('.countryDropdown').select2({
                theme: "bootstrap-5",
            });

            //ON COUNTRY DROPDOWN CLICKED
            //saat dropdown country diklik, jalankan function
            $('#country').on('change', function () {
                //ambil country id dari value option
                const country_id = $(this).val();
                //ambil dropdown state
                const state = $('#state');

                //GET ALL STATES FROM THE COUNTRY
                //kirim request axios dengan method GET ke url: /getStates/{id country}
                //url: /getStates/{id country} make method getStates($id) di AuthController
                axios.get('/getStates/' + country_id)
                    //jalankan function saat response diberikan url
                    .then((response) => {
                        //kosongkan isi dropdown state
                        state.empty();
                        //ganti isi dropdown state dengan value = id state
                        $.each(response.data, (id, name) => {
                            state.append(new Option(name, id));
                        });
                    }).catch((error) => {
                    //jika ada error kosongkan dropdown state
                    state.empty();
                });
            });

            //set input dengan id phone_number buat pake package intlTelInput
            const input = $('#phone_number');
            input.intlTelInput({
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.js',
            });
        });

        //script buat nentuin shipping_price
        //function setiap kali option di shipping_price dropdown berubah/dipilih
        function getShippingPrice() {
            //bikin variable shipping_price sama order_price
            let shipping_price = 0;
            let order_price = 0;
            //ambil selected value dari dropdown shipping_option
            const selected_shipping_option = document.forms['order-form'].elements['shipping_price']
                .options[document.forms['order-form'].elements['shipping_price'].selectedIndex].value;
            //ubah selected value ke integer
            const base_shipping_price = parseInt(selected_shipping_option);
            //set additional_charge per kilo
            const additional_charge = 15;

            //ambil sum dari total_weight di carts
            let total_weight = Math.round({!! $carts->sum('total_weight') !!});
            //ambil sum dari sub_total di carts
            const sub_total = {!! $carts->sum('sub_total') !!};

            //jika total weight > 1
            if (total_weight > 1) {
                //total weight - 1
                total_weight = total_weight - 1;
                //shipping price = base shipping price + (total weight yang sudah dikurangi 1 * 15)
                shipping_price = base_shipping_price + (total_weight * additional_charge);
            } else {
                //jika total weight kurang dari sama dengan 1
                //shipping price = base shipping price;
                shipping_price = base_shipping_price;
            }

            //order price = shipping price + sub_total
            order_price = shipping_price + sub_total;
            //ambil tag p dengan id shipping_price_text, set textnya jadi shipping_price yang baru
            $('#shipping_price_text').text('$' + shipping_price);
            //ambil tag p dengan id total_order_price_text, set textnya jadi order_price yang baru
            $('#total_order_price_text').text('$' + order_price);
        }
    </script>
@endsection
