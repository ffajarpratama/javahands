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

        <div class="row g-0 justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-row justify-content-between mb-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-jh-primary btn-icon-split me-3">
                        <div class="icon text-white">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text">Dashboard</div>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-jh-primary btn-icon-split">
                        <div class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="text">Add New Category</div>
                    </a>
                </div>

                <div class="row row-cols-3 row-cols-md-4 g-4">
                    @foreach($categories as $category)
                        <div class="col">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            {{ $category->name }}
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle text-secondary" type="button"
                                                   id="categoryActionDropdown" data-bs-toggle="dropdown"
                                                   aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="categoryActionDropdown">
                                                    <div class="dropdown-header py-1">
                                                        <p class="mb-0 text-secondary fw-600 fs-7">Action</p>
                                                    </div>
                                                    <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer small text-right">
                                    {{ $category->products->count() }} Products
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
