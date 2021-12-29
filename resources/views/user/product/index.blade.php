@extends('layouts.app')
@section('content')
    <div class="container p-5 mb-5">
        <div class="row">
            {{--left sidebar--}}
            <div class="col-md-4 ps-0 pe-5" style="border-right: 1px solid #F5F4F2;">
                <div style="position: sticky !important; top: 130px;">

                    <div class="row">
                        {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('product-categories') }}
                    </div>

                    <div class="row mb-4">
                        <form class="d-flex p-0">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>

                    <div class="row mb-3">
                        <h1 class="fw-bold text-start p-0" style="font-size: 30px">Product Categories</h1>
                    </div>

                    <div class="row my-2">
                        <a href="{{ route('user.products.index', ['category' => 'all_products']) }}"
                           class="list-group-item {{ ucwords(str_replace('_', ' ', request()->query('category'))) == 'All Products' ? 'active' : '' }} p-0"
                           aria-current="true">
                            <div class="row justify-content-between">
                                <div class="col-md-4 text-start">All Products</div>
                                <div class="col-md-4 text-end">({{ $allProductCount }})</div>
                            </div>
                        </a>
                    </div>

                    @foreach($categories as $category)
                        <div class="row my-2">
                            <a href="{{ route('user.products.index' , ['category' => $category->name]) }}"
                               class="list-group-item {{ request()->query('category') == $category->name ? 'active' : '' }} p-0">
                                <div class="row justify-content-between">
                                    <div class="col-md-4 text-start">{{ $category->name }}</div>
                                    <div class="col-md-4 text-end">({{ $category->products->count() }})</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-8 ps-5">
                <div class="row justify-content-between my-4" style="font-size: 14px; color: #A7A7A7;">
                    <div class="col-md-auto text-start">
                        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                        in {{ ucwords(str_replace('_', ' ', request()->query('category'))) }} Categories
                    </div>
                    <div class="col">
                        <div class="dropdown text-end">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                               id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ url()->current() . '?category=' . request()->query('category') . '&sortBy=newest' }}">
                                        Newest
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ url()->current() . '?category=' . request()->query('category') . '&sortBy=rating' }}">
                                        Rating
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ url()->current() . '?category=' . request()->query('category') . '&sortBy=price' }}">
                                        Price
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between px-2">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-5 px-2">
                            <a href="" style="text-decoration: none; color: black;">
                                <div class="card p-4" style="border: 1px solid #e0e0e0; box-shadow: 0 0 19px -8px rgba(0, 0, 0, 0.29); border-radius: 15px; height: 200px;">
                                    <img class="m-auto" src="{{ asset('products/' . $product->picture) }}"
                                         style="max-width: 100%; max-height: 100%; object-fit: cover;" alt="..."/>
                                </div>
                                <div class="row mt-2 justify-content-start">
                                    <p class="mb-0" style="font-weight: 500;">{{ $product->name }}</p>
                                    <div class="col-md-auto">
                                        <p class="mb-0" style="text-decoration: line-through; font-weight: 500;">
                                            {{ '$' . number_format($product->price) }}
                                        </p>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <h5 class="{{$product->discount != 0 ? 'text-danger' : ''}} mb-0"
                                            style="font-weight: 700;">
                                            {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    {{ $products->render('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
