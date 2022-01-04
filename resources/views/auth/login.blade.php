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

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row g-0 mb-1">
                        <label for="email" class="fs-7 fw-600">Email</label>
                    </div>
                    <div class="row g-0 mb-4">
                        <input type="text" class="fs-7 form-control @error('email') is-invalid @enderror" name="email"
                               id="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row justify-content-between mb-1">
                        <label for="password" class="fs-7 fw-600">Password</label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-secondary" style="font-size: 12px;">
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                    <div class="row g-0 mb-4">
                        <input type="password" class="fs-7 form-control @error('password') is-invalid @enderror" name="password"
                               id="password" value="{{ old('password') }}" required autocomplete="password">

                        @error('password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-jh-secondary fs-7 fw-600" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="d-flex flex-row justify-content-center my-3">
                        <p class="mb-0 text-secondary" style="font-size: 12px;">
                            Don't have an account yet? <a href="{{ route('register') }}">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
