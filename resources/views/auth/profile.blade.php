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
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('profile-details', $user) }}
        </div>

        <div class="row g-0 justify-content-start">
            <div class="col-md-6">
                <div class="card cart-cards">
                    <div class="card-body p-5">
                        <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <p class="mb-0 fs-24-px fw-700 text-bistre">
                                    Your Contact and Shipping Address
                                </p>
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

                            <div class="d-flex flex-row justify-content-end align-items-center">
                                <a href="{{ route('user.cart.index') }}" class="btn btn-jh-secondary me-2">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-jh-primary">
                                    Update
                                </button>
                            </div>

                        </form>
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
        $(document).ready(function () {
            $('.countryDropdown').select2({
                theme: "bootstrap-5",
            });

            //ON COUNTRY DROPDOWN CLICKED
            $('#country').on('change', function () {
                const country_id = $(this).val();
                const state = $('#state');

                //GET ALL STATES FROM THE COUNTRY
                axios.get('/getStates/' + country_id)
                    .then((response) => {
                        state.empty();
                        $.each(response.data, (id, name) => {
                            state.append(new Option(name, id));
                        });
                    }).catch((error) => {
                    state.empty();
                });
            });

            const input = $('#phone_number');
            input.intlTelInput({
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.js',
            });
        });
    </script>
@endsection
