@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
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
        </div>

        <div class="row">
            <div class="col-md-3" style="border-right: 1px solid rgba(86, 65, 52, 0.2);">
                <h5 class="font-weight-bold" style="color: black;">Product Categories</h5>
                <a href="{{ route('admin.products.index') }}" class="small">All Products ({{ $allProductCount }})</a> <br>
                @foreach($categories as $category)
                    <a href="{{ route('admin.products.get_by_category', $category->name) }}" class="small">{{ $category->name }} ({{ $category->products->count() }})</a> <br>
                @endforeach
            </div>

            <div class="col-md-9 ps-5">
{{--                <div class="row mb-4 d-flex justify-content-between">--}}
{{--                    <div class="col-md-auto">--}}
{{--                        <a href="{{ route('admin.products.create') }}" class="btn btn-jh-primary btn-icon-split">--}}
{{--                            <div class="icon text-white">--}}
{{--                                <i class="fas fa-plus"></i>--}}
{{--                            </div>--}}
{{--                            <div class="text">Add New Product</div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-auto">--}}
{{--                        <a href="{{ route('admin.products.create') }}" class="btn btn-jh-primary btn-icon-split">--}}
{{--                            <div class="icon text-white">--}}
{{--                                <i class="fas fa-plus"></i>--}}
{{--                            </div>--}}
{{--                            <div class="text">Add New Product</div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="row">
                    <div class="col-md-10">

                        <div class="row mb-4 d-flex justify-content-end">
                            <div class="col-md-auto">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-jh-primary btn-icon-split">
                                    <div class="icon text-white">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="text">Add New Product</div>
                                </a>
                            </div>
                            <div class="col-md-auto">
                                <div class="dropdown">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort by
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ url()->current() . '?sortBy=newest' }}">Newest</a></li>
                                        <li><a class="dropdown-item" href="{{ url()->current() . '?sortBy=rating' }}">Rating</a></li>
                                        <li><a class="dropdown-item" href="{{ url()->current() . '?sortBy=price' }}">Price</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-3 row-cols-md-auto g-4">
                            @foreach($products as $product)
                                <div class="col">
                                    <a href="{{ route('admin.products.show', $product->id) }}" style="text-decoration: none; color: black;">
                                        <div class="card mb-2 mx-auto" style="width: 180px; height: auto; border-radius: 15px; border: 1px solid #E0E0E0">
                                            <img src="{{ asset('products/' . $product->picture) }}" class="mx-auto" alt="..." style="width: 144px; height: auto;">
                                        </div>

                                        <p class="mb-1 text-center">{{ $product->name }}</p>
                                        <div class="row justify-content-sm-center">
                                            <div class="col-md-auto">
                                                <p class="card-text" style="text-decoration: line-through;">
                                                    {{ '$' . number_format($product->price) }}
                                                </p>
                                            </div>
                                            <div class="col-md-auto px-0">
                                                <h5 class="text-danger font-weight-bold mb-0">
                                                    {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{ $products->render('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
