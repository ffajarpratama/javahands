@extends('layouts.app')
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
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('product-details', $product) }}
        </div>

        @if(auth()->check() && auth()->user()->is_admin)
            <div class="d-flex flex-row justify-content-end mx-5 px-5 mb-5">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-jh-primary me-2">
                    Edit this product
                </a>

                <button type="button" class="btn btn-outline-danger"
                        id="deleteButton"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteProductModal">
                    Delete
                </button>
            </div>
        @endif

        <div class="d-flex flex-row justify-content-center mx-5 px-5">
            <div class="col-md-7">
                <div class="card mb-3 product-details-card">
                    @if(!$product->picture)
                        <img src="{{ asset('placeholders/products/product-placeholder.png') }}"
                             class="m-auto product-details-img"
                             alt="...">
                    @else
                        <img src="{{ asset('storage/products/' . $product->picture) }}"
                             class="m-auto product-details-img"
                             alt="...">
                    @endif
                </div>
            </div>

            <div class="col-md-5">
                <div class="row g-0">
                    <p class="mb-0 fs-4 fw-400 text-jh-dark">{{ $newProductName }}</p>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <div class="col-md-auto">
                        <p class="mb-0 fw-700 fs-0 text-jh-dark">{{ $productLastName }}</p>
                    </div>

                    <div class="d-flex flex-row align-items-center">
                        @if($product->discount != 0)
                            <div class="col-md-auto me-2">
                                <p class="fs-24-px text-strikethrough fw-600 text-black mb-0">
                                    {{ '$' . number_format($product->price) }}
                                </p>
                            </div>
                        @endif

                        <div class="col-md-auto">
                            <p class="{{ $product->discount != 0 ? 'text-danger' : 'text-gray-900' }} mb-0 fw-600 fs-40-px">
                                {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                            </p>
                        </div>
                    </div>
                </div>

                @if(auth()->check() && !auth()->user()->is_admin)
                    <div class="row g-0 my-5">
                        <div class="d-grid gap-2">
                            <button class="btn cart-button text-bistre py-3" type="button">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @else
                    <div class="my-5"></div>
                @endif

                <div class="row g-0">
                    <div class="product-short-description-card text-center text-white p-4">
                        <p class="fw-light fs-7">
                            “Handmade in Yogyakarta”
                        </p>

                        <p class="mb-0 fw-light fs-7">
                            By shopping with us, you’re supporting traditional Javanese
                            artisans and bringing home a beautiful products made from premium materials.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-0 mt-5 justify-content-center">
            <div class="card mb-5 text-white p-5 product-description-card">
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-7 product-description-line-tabs-divider">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-description" type="button" role="tab"
                                            aria-controls="nav-description" aria-selected="true">
                                        Description
                                    </button>
                                    <button class="nav-link" id="nav-confidence-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-confidence" type="button" role="tab"
                                            aria-controls="nav-confidence"
                                            aria-selected="false">
                                        Buy with confidence
                                    </button>
                                    <button class="nav-link" id="nav-impact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-impact"
                                            type="button" role="tab" aria-controls="nav-impact" aria-selected="false">
                                        Impact
                                    </button>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between fs-7 fw-200">
                        <div class="col-md-7">
                            <div class="tab-content pt-3 pr-5 pb-3 pl-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                     aria-labelledby="nav-description-tab">
                                    <div class="d-flex flex-row justify-content-start">
                                        <div class="col-md-3">
                                            <p class="mb-0">Material</p>
                                        </div>
                                        <div class="col-md-1">
                                            <p class="mb-0">:</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="mb-0">{{ $product->description->material }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-start mb-3">
                                        <div class="col-md-3">
                                            <p>Measurements</p>
                                        </div>
                                        <div class="col-md-1">
                                            <p class="mb-0">:</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $product->description->measurement }}</p>
                                        </div>
                                    </div>

                                    <p>{{ $product->description->description }}</p>

                                    <p>
                                        <strong class="fw-bold">Please
                                            Note:</strong> {{ $product->description->additional_note }}</p>
                                </div>

                                <div class="tab-pane fade" id="nav-confidence" role="tabpanel"
                                     aria-labelledby="nav-confidence-tab">
                                    <ul>
                                        <li>
                                            All of our products are 100% hand-crafted directly from artisans
                                        </li>
                                        <li>
                                            Highest quality products
                                        </li>
                                        <li>
                                            Best prices: 100% online-based we have significantly fewer costs than
                                            traditional companies.
                                        </li>
                                        <li>
                                            100% Secure Payments. We accept PayPal and all major credit cards.
                                        </li>
                                        <li>
                                            Outstanding customer service. Happy customers are our biggest asset.
                                        </li>
                                        <li>
                                            Not happy? Return it and get a refund.
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="nav-impact" role="tabpanel"
                                     aria-labelledby="nav-impact-tab">
                                    <p>
                                        We supporting some of Indonesia’s most talented artisans. Our product deserve to
                                        be seen and to be appreciated beyond the world not only in tourist attraction in
                                        Yogyakarta. The artisans behind them deserve to be properly compensated for
                                        their incredible work. It brings us the greatest joy to know that we are
                                        empowering Javanese artisans to take control of their future, but also
                                        connecting them with buyers who feel a true affinity for their magical work.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card mb-3 ms-auto product-details-card-md">
                                @if(!$product->picture)
                                    <img src="{{ asset('placeholders/products/product-placeholder.png') }}"
                                         class="m-auto product-details-img" alt="...">
                                @else
                                    <img src="{{ asset('storage/products/' . $product->picture) }}"
                                         class="m-auto product-details-img" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <hr style="color: black;">
        <div class="row g-0 justify-content-between align-items-center my-5">

            <div class="col-md-4">
                <div class="card product-rating-card">

                    <div class="d-flex flex-row justify-content-between px-4 align-items-center">
                        <p class="mb-0 fs-1 font-weight-bold me-2">
                            {{ round($product->comments->average('rating'), 1) }}
                        </p>

                        <div class="fs-5 mx-2 text-star">
                            @for ($i = 0; $i < 5; $i++)
                                @if (floor(round($product->comments->average('rating'), 1)) - $i >= 1)
                                    <i class="fas fa-star"></i>
                                @elseif (round($product->comments->average('rating'), 1) - $i > 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>

                        <p class="mb-0 fs-6 ms-2">
                            ({{ $product->comments->count() }} reviews)
                        </p>
                    </div>

                </div>
            </div>

            @if(auth()->check() && !auth()->user()->is_admin)
                <div class="col-md-4 d-flex flex-column align-items-end">
                    <p class="mb-1">
                        How do you rate this product?
                    </p>
                    <button type="button" class="btn btn-comment text-bistre fw-600"
                            id="commentButton"
                            data-bs-toggle="modal"
                            data-bs-target="#addCommentModal"
                            data-bs-url="{{ route('user.comments.store', [$product->id, auth()->id()]) }}">
                        Add Comment
                        <i class="fas fa-comment ms-1"></i>
                    </button>
                </div>
            @endif
        </div>

        <hr style="color: black;">
        <div class="d-flex flex-row justify-content-center">
            <p class="mb-0 me-1 fs-30-px text-jh-darker fw-700">
                Reviews
            </p>

            <p class="mb-0 align-self-center text-jh-darker fs-24-px fw-400">
                ({{ $product->comments_count }})
            </p>

            <div class="dropdown ms-auto align-self-center"
                 style="display: {{ $comments->count() != 0 ? '' : 'none' }};">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                   id="dropdownMenuLink"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by
                    <i class="fas fa-sort ms-1"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('products.show', $product->id) . '?sortCommentBy=newest' }}">
                            Newest
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('products.show', $product->id) . '?sortCommentBy=popular' }}">
                            Popular
                        </a>
                    </li>
                    <li><a class="dropdown-item"
                           href="{{ route('products.show', $product->id) . '?sortCommentBy=rating' }}">
                            Rating
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="mb-5" style="color: black;">

        @foreach($comments as $comment)
            <div class="mb-5">
                <div class="row g-0 justify-content-center mx-5 px-5 mb-3">
                    <div class="col-md-auto me-4">
                        <img src="{{ asset('placeholders/dummy-profile-picture.png') }}" alt="...">
                    </div>

                    <div class="col">
                        <div class="d-flex flex-row justify-content-between align-items-center mb-1">
                            <p class="mb-0 text-jh-brown fs-24-px fw-400">
                                {{ $comment->user->name }}
                            </p>

                            <p class="mb-0 text-secondary ms-auto">
                                {{ date('d/m/y', strtotime($comment->created_at)) }}
                            </p>

                            @if(auth()->id() == $comment->user_id)
                                <div class="dropdown ms-2">
                                    <a class="dropdown-toggle text-secondary" type="button"
                                       id="userCommentActionDropdown" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userCommentActionDropdown">
                                        <div class="dropdown-header py-1">
                                            <p class="mb-0 text-secondary fw-600 fs-7">Action</p>
                                        </div>
                                        <button class="dropdown-item fw-200 fs-7" id="editButton"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateCommentModal"
                                                data-bs-rating="{{ $comment->rating }}"
                                                data-bs-title="{{ $comment->title }}"
                                                data-bs-description="{{ $comment->description }}"
                                                data-bs-picture="{{ $comment->picture }}"
                                                data-bs-url="{{ route('user.comments.update', $comment->id) }}">
                                            Edit
                                        </button>
                                        <button class="dropdown-item fw-200 fs-7" id="deleteButton"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteCommentModal"
                                                data-bs-url="{{ route('user.comments.delete', $comment->id) }}">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <div class="d-flex flex-row text-star">
                            @for ($i = 0; $i < 5; $i++)
                                @if (floor($comment->rating) - $i >= 1)
                                    <i class="fas fa-star"></i>
                                @elseif ($comment->rating - $i > 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="row g-0 mx-5 px-5">
                    <p class="mb-0 text-jh-brown fs-20-px fw-700">
                        {{ $comment->title }}
                    </p>
                </div>

                <div class="row g-0 mx-5 px-5">
                    <p class="text-secondary fw-400">
                        {{ $comment->description }}
                    </p>
                    @if(!$comment->picture)
                        <img class="mb-3 comment-img" src="{{ asset('placeholders/products/review-1.png') }}"
                             alt="...">
                    @else
                        <img class="mb-3 comment-img" src="{{ asset('storage/comments/' . $comment->picture) }}"
                             alt="...">
                    @endif
                </div>

                <div class="d-flex flex-row mb-3 mx-5 px-5 align-items-center fs-7 fw-400">
                    <p class="mb-0 me-4 text-secondary">
                        Was this review helpful?
                    </p>

                    <a href="" class="text-secondary me-1" style="text-decoration: none">
                        <i class="far fa-thumbs-up"></i>
                    </a>

                    <p class="mb-0 me-4 text-secondary">
                        {{ $comment->likes->count() }}
                    </p>

                    <a href="" class="text-secondary me-1" style="text-decoration: none">
                        <i class="far fa-thumbs-down"></i>
                    </a>

                    <p class="mb-0 text-secondary">
                        {{ $comment->dislikes->count() }}
                    </p>

                    @if(auth()->check() && auth()->user()->is_admin)
                        @if(!$comment->reply)
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-3" id="replyButton"
                                    data-bs-toggle="modal" data-bs-target="#addReplyModal"
                                    data-bs-url="{{ route('admin.reply.add', $comment->id) }}">
                                Reply to this comment
                                <i class="bi bi-x-circle"></i>
                            </button>
                        @endif
                    @endif
                </div>

                @if($comment->reply)
                    <div class="d-flex flex-row mx-5 px-5 justify-content-center">
                        <div class="col-md-10">
                            <div class="card border-0 p-2 reply-card">
                                <div class="card-body text-secondary">
                                    <div class="d-flex flex-row justify-content-between">
                                        <p class="mb-0 fw-bold">Reply:</p>
                                        @if(auth()->check() && auth()->user()->is_admin)
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-secondary" type="button"
                                                   id="adminReplyActionDropdown" data-bs-toggle="dropdown"
                                                   aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="adminReplyActionDropdown">
                                                    <div class="dropdown-header py-1">
                                                        <p class="mb-0 text-secondary fw-600 fs-7">Action</p>
                                                    </div>
                                                    <button class="dropdown-item fw-200 fs-7" id="editButton"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateReplyModal"
                                                            data-bs-content="{{ $comment->reply->description }}"
                                                            data-bs-url="{{ route('admin.reply.update', $comment->reply->id) }}">
                                                        Edit
                                                    </button>
                                                    <form
                                                        action="{{ route('admin.reply.delete', $comment->reply->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item fw-200 fs-7" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mb-0">
                                        {{ $comment->reply->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @include('user.product.partials.modals.create')
    @include('user.product.partials.modals.edit')
    @include('user.product.partials.modals.delete')
    @include('admin.product.partials.modals.create')
    @include('admin.product.partials.modals.edit')
    @include('admin.product.partials.modals.delete')
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
@section('script')
    @include('user.product.partials.modals.script')
    @include('admin.product.partials.modals.scripts.store-and-update')
@endsection
