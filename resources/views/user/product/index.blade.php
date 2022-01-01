@extends('layouts.app')
@section('content')
    <div class="container p-5 mb-5">
        <div class="row g-0">
            {{--left sidebar--}}
            <div class="col-md-4 ps-0 pe-5" style="border-right: 1px solid #F5F4F2;">
                <div style="position: sticky !important; top: 130px;">

                    <div class="d-flex flex-row mb-3">
                        {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('product-categories') }}
                    </div>

                    <div class="row g-0 mb-4">
                        <form action="{{ route('product.search') }}" class="d-flex p-0" method="GET">
                            <input class="form-control me-2" name="search_value" id="search_value" type="text" placeholder="Search" aria-label="Search" value="{{ old('search_value') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>


                    <div class="d-flex flex-row justify-content-between align-items-center g-0 mb-3">
                        <p class="mb-0 fw-bold text-start p-0" style="font-size: 30px">Product Categories</p>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-jh-primary">
                                <img src="{{ asset('placeholders/edit-white.png') }}" alt="..." class="mb-1">
                            </a>
                        @endif
                    </div>


                    <div class="row g-0 my-2 fs-7">
                        <a href="{{ route('product.index', ['category' => 'all_products']) }}"
                           class="list-group-item {{ ucwords(str_replace('_', ' ', request()->query('category'))) == 'All Products' ? 'active' : '' }} p-0"
                           aria-current="true">
                            <div class="d-flex flex-row justify-content-between">
                                <div class="col-md-auto text-start">All Products</div>
                                <div class="col-md-auto text-end">({{ $allProductCount }})</div>
                            </div>
                        </a>
                    </div>

                    @foreach($categories as $category)
                        <div class="row g-0 my-2 fs-7">
                            <a href="{{ route('product.index' , ['category' => $category->name]) }}"
                               class="list-group-item {{ request()->query('category') == $category->name ? 'active' : '' }} p-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="col-md-auto text-start">{{ $category->name }}</div>
                                    <div class="col-md-auto text-end">({{ $category->products_count }})</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-8 ps-5">
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

                <div class="d-flex flex-row justify-content-between align-items-center my-4" style="font-size: 14px; color: #A7A7A7;">
                    <div class="col-md-auto text-start">
                        @if(Route::is('product.search'))
                            @if($products->isNotEmpty())
                                Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} from search result
                            @endif
                        @else
                            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} in
                            @if(request()->query('category'))
                                {{ ucwords(str_replace('_', ' ', request()->query('category'))) }} Categories
                            @else
                                All Products
                            @endif
                        @endif

                    </div>

                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="col-md-auto ms-auto me-3">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-jh-primary btn-icon-split">
                                <div class="icon text-white">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="text">Add New Product</div>
                            </a>
                        </div>
                    @endif

                    <div class="col-md-auto">
                        <div class="dropdown text-end">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                               id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by
                                <i class="fas fa-sort ms-1"></i>
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

                <div class="d-flex flex-row flex-wrap justify-content-start">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-5 px-2">
                            <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: black;">

                                <div class="card p-4" style="border: 1px solid #e0e0e0; box-shadow: 0 0 19px -8px rgba(0, 0, 0, 0.29); border-radius: 15px; height: 200px;">
                                    @if(!$product->picture)
                                        <img class="m-auto" src="{{ asset('placeholders/products/product-placeholder.png') }}"
                                             style="max-width: 100%; max-height: 100%; object-fit: cover;" alt="..."/>
                                    @else
                                        <img class="m-auto" src="{{ asset('storage/products/' . $product->picture) }}"
                                             style="max-width: 100%; max-height: 100%; object-fit: cover;" alt="..."/>
                                    @endif
                                </div>

                                <div class="row g-0 mt-2">
                                    <p class="mb-0" style="font-weight: 500;">{{ $product->name }}</p>
                                </div>

                                <div class="d-flex flex-row">
                                    @if($product->discount != 0)
                                        <p class="mb-0 me-2" style="text-decoration: line-through; font-weight: 500;">
                                            {{ '$' . number_format($product->price) }}
                                        </p>
                                    @endif

                                    <h5 class="{{$product->discount != 0 ? 'text-danger' : 'text-bistre'}} mb-0"
                                        style="font-weight: 700;">
                                        {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                                    </h5>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col my-5 py-5">
                            <p class="mb-0 text-secondary fw-200 fs-30-px text-center">
                                You have nothing to show here...
                            </p>
                        </div>
                    @endforelse
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
