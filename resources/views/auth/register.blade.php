@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row g-0 justify-content-center my-5">
            <div class="col-md-4">

                <div class="d-flex justify-content-center mb-5">
                    <img src="{{ asset('placeholders/logos/jh-logo-text-color.png') }}" alt="logo-text-color">
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row g-0 mb-1">
                        <label for="name" class="fs-7 fw-600">
                            Name <sup class="text-danger">*</sup>
                        </label>
                    </div>
                    <div class="row g-0 mb-4">
                        <input id="name" type="text"
                               class="fs-7 form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
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
                    <div class="row g-0 mb-4">
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
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
