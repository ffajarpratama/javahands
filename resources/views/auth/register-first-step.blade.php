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

                <form action="{{ route('register.first.step') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-between g-0 mb-4">
                        <div class="col-md-6 pe-1">
                            <label for="first_name" class="fs-7 fw-600">
                                First Name <sup class="text-danger">*</sup>
                            </label>
                            <input id="first_name" type="text"
                                   class="fs-7 text-secondary form-control @error('first_name') is-invalid @enderror" name="first_name"
                                   value="{{ old('first_name') }}" required autocomplete="first_name">

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
                                   class="fs-7 text-secondary form-control @error('last_name') is-invalid @enderror" name="last_name"
                                   value="{{ old('last_name') }}" required autocomplete="last_name">

                            @error('last_name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-0 mb-1">
                        <label for="email" class="fs-7 fw-600">
                            Email <sup class="text-danger">*</sup>
                        </label>
                    </div>
                    <div class="row g-0 mb-4">
                        <input id="email" type="email"
                               class="fs-7 text-secondary form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="row g-0 mb-1">
                        <label for="password" class="fs-7 fw-600">
                            Password <sup class="text-danger">*</sup>
                        </label>
                    </div>
                    <div class="row g-0 mb-4">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required value="{{ old('password') }}">

                        @error('password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="row g-0 mb-1">
                        <label for="password_confirmation" class="fs-7 fw-600">
                            Confirm Password <sup class="text-danger">*</sup>
                        </label>
                    </div>
                    <div class="row g-0 mb-4">
                        <input id="password_confirmation" type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation" required value="{{ old('password_confirmation') }}">

                        @error('password_confirmation')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-jh-primary fs-7 fw-600" type="submit">
                            Continue
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
