@extends('layouts.app')
@section('header')
    @include('layouts.partials.header')
@endsection
@section('content')
    <div class="container p-5 mb-5">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-0 justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <p class="text-bistre mb-0 fw-700">Edit Category</p>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="name">Category Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               class="form-control text-secondary @error('name') is-invalid @enderror"
                                               name="name" id="name" required value="{{ $category->name }}">
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row mb-3 text-right">
                                    <div class="col">
                                        <a href="{{ route('admin.categories.index') }}"
                                           class="btn btn-outline-secondary">
                                            Back
                                        </a>

                                        <button class="btn btn-jh-primary" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
