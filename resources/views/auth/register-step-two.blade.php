@extends('layouts.app')
@section('header')
    @include('layouts.partials.header')
@endsection
@section('content')
    <div class="container py-5">
        <div class="row g-0 justify-content-center my-5">
            <div class="col-md-4">

                <div class="d-flex justify-content-center mb-5">
                    <img src="{{ asset('placeholders/logos/jh-logo-text-color.png') }}" alt="logo-text-color">
                </div>

                <form action="{{ route('register.second.step') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row g-0 mb-4">
                        <label for="country" class="fs-7 fw-600 mb-2">
                            Country <sup class="text-danger">*</sup>
                        </label>

                        <select
                            class="form-control countryDropdown fs-7 text-secondary @error('country') is-invalid @enderror"
                            name="country" id="country">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
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

                        <select class="form-control fs-7 text-secondary @error('state') is-invalid @enderror"
                                name="state" id="state">
                            <option value="">Select State/Province</option>
                        </select>

                        @error('state')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="row g-0 justify-content-between mb-1">
                        <div class="col-md-6 pe-1">
                            <label for="city" class="fs-7 fw-600">
                                City <sup class="text-danger">*</sup>
                            </label>

                            <input id="city" type="text"
                                   class="form-control fs-7 text-secondary @error('city') is-invalid @enderror"
                                   name="city"
                                   value="{{ old('city') }}" required autocomplete="city">

                            @error('city')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 ps-1">
                            <label for="zip_code" class="fs-7 fw-600">
                                Zip Code <sup class="text-danger">*</sup>
                            </label>
                            <input id="zip_code" type="text"
                                   class="form-control fs-7 text-secondary @error('zip_code') is-invalid @enderror"
                                   name="zip_code"
                                   value="{{ old('zip_code') }}" required autocomplete="zip_code">

                            @error('zip_code')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="row g-0 mb-4">

                    </div>

                    <div class="row g-0 mb-1">
                        <label for="address" class="fs-7 fw-600">
                            Address Detail <sup class="text-danger">*</sup>
                        </label>
                    </div>
                    <div class="row g-0 mb-4">
                        <textarea class="form-control fs-7 text-secondary @error('address') is-invalid @enderror"
                                  name="address" required id="address" cols="30" rows="5"
                                  style="resize: none;">{{ old('address') }}</textarea>

                        @error('address')
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
                        <input class="form-control fs-7 text-secondary  @error('phone_number') is-invalid @enderror"
                               id="phone_number"
                               type="tel" name="phone_number">

                        {{--                        <input id="phone_number" type="text"--}}
                        {{--                               class="form-control @error('phone_number') is-invalid @enderror"--}}
                        {{--                               name="phone_number" required value="{{ old('phone_number') }}">--}}

                        @error('phone_number')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-jh-secondary fs-7 fw-600" type="submit">
                            Register
                        </button>
                    </div>

                    <div class="d-flex flex-row justify-content-center my-3">
                        <p class="mb-0 text-secondary" style="font-size: 12px;">
                            Already have an account? <a href="{{ route('login') }}">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.countryDropdown').select2();

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

            const phone_field = document.querySelector('#phone_number');
            const phone_input = window.intlTelInput(phone_field, {
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.js'
            })
        });
    </script>
@endsection
