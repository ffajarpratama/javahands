@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="col-md-4 d-inline-flex">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-jh-primary mr-2">
                            Edit this product
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-4">
                        <div class="card shadow mb-2"
                             style="width: 350px; height: 350px; border-radius: 15px; border: 1px solid #E0E0E0;">
                            <img src="{{ asset('products/' . $product->picture) }}" class="m-auto" alt="..."
                                 style="width: 200px; height: auto">
                        </div>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-md-5">
                        <div class="row">
                            <p class="mb-0 fs-5" style="color: #564134; font-weight: 400;">{{ $newProductName }}</p>
                        </div>

                        <div class="row">
                            <p class="mb-0 fs-1 font-weight-bold" style="color: #564134;">{{ $productLastName }}</p>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-auto pr-2">
                                <p class="fs-4" style="text-decoration: line-through; color: black;">
                                    {{ '$' . number_format($product->price) }}
                                </p>
                            </div>
                            <div class="col-md-auto px-0">
                                <h5 class="text-danger fw-bolder" style="font-size: 30px;">
                                    {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                                </h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="bg-primary text-center text-white p-4"
                                     style="background: linear-gradient(90deg, #564134 2.02%, #2E190D 57.59%); box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.25);border-radius: 5px;">
                                    <p class="fw-light">“Handmade in Yogyakarta”</p>

                                    <p class="mb-0 fw-light">By shopping with us, you’re supporting traditional Javanese
                                        artisans and bringing home a beautiful products made from premium materials.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10 text-white fw-light">
                        <div class="card mb-5">
                            <div class="card-body"
                                 style="background: linear-gradient(280.95deg, #2E190D 33.43%, #564134 96.17%); box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.25); border-radius: 10px;">
                                <div class="row">
                                    <div class="col-md-7">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-description-tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#nav-description" type="button" role="tab"
                                                        aria-controls="nav-description"
                                                        aria-selected="true">Description
                                                </button>
                                                <button class="nav-link" id="nav-confidence-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-confidence" type="button" role="tab"
                                                        aria-controls="nav-confidence" aria-selected="false">Buy with
                                                    confidence
                                                </button>
                                                <button class="nav-link" id="nav-impact-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-impact" type="button" role="tab"
                                                        aria-controls="nav-impact" aria-selected="false">Impact
                                                </button>
                                            </div>
                                        </nav>
                                    </div>
                                </div>

                                <div class="row" style="font-size: 14px;">
                                    <div class="col-md-7 pr-0">
                                        <div class="tab-content pt-3 pr-5 pb-3 pl-3" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                                 aria-labelledby="nav-description-tab">
                                                <table class="table-borderless mb-3">
                                                    <tr>
                                                        <td style="width: 10%">Material</td>
                                                        <td style="width: 2%">:</td>
                                                        <td style="width: 50%">Rattan and Leather</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-top">Measurements</td>
                                                        <td class="align-top">:</td>
                                                        <td>7 3/4" x 3 3/4" (7 3/4" is the diameter) or<br>
                                                            20 cm x 9,5 cm (diameter 20 cm)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Strap drop</td>
                                                        <td>:</td>
                                                        <td>22" or 55cm</td>
                                                    </tr>
                                                </table>

                                                <p>Our handmade handbag that comes with fashionable pattern design. The
                                                    bag
                                                    simply
                                                    adds some ethnic and traditional vibes to any look and offers plenty
                                                    of
                                                    space
                                                    to
                                                    carry your belongings with its comfort leather shoulder strap..</p>

                                                <p><strong class="fw-bold">Please Note</strong> : The bag is 100%
                                                    handmade.
                                                    Therefore, the appearance and the
                                                    size
                                                    may vary slightly due to the handcrafted nature of the bag.
                                                    Furthermore,
                                                    the
                                                    color of the inside material may differ.</p>
                                            </div>
                                            <div class="tab-pane fade" id="nav-confidence" role="tabpanel"
                                                 aria-labelledby="nav-confidence-tab">
                                                <ul>
                                                    <li>All of our products are 100% hand-crafted directly from artisans
                                                    </li>
                                                    <li>Highest quality products</li>
                                                    <li>Best prices: 100% online-based we have significantly fewer costs
                                                        than
                                                        traditional companies.
                                                    </li>
                                                    <li>100% Secure Payments. We accept PayPal and all major credit
                                                        cards.
                                                    </li>
                                                    <li>Outstanding customer service. Happy customers are our biggest
                                                        asset.
                                                    </li>
                                                    <li>Not happy? Return it and get a refund.</li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="nav-impact" role="tabpanel"
                                                 aria-labelledby="nav-impact-tab">
                                                <p>We supporting some of Indonesia’s most talented artisans. Our product
                                                    deserve
                                                    to be seen and to be appreciated beyond the world not only in
                                                    tourist
                                                    attraction in Yogyakarta. The artisans behind them deserve to be
                                                    properly
                                                    compensated for their incredible work. It brings us the greatest joy
                                                    to
                                                    know
                                                    that we are empowering Javanese artisans to take control of their
                                                    future,
                                                    but also connecting them with buyers who feel a true affinity for
                                                    their
                                                    magical work.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5 pl-0 pt-3 pr-3 pb-3">
                                        <div class="card shadow mx-auto"
                                             style="width: 350px; height: 350px; border-radius: 15px; border: 1px solid #E0E0E0;">
                                            <img src="{{ asset('products/' . $product->picture) }}" class="m-auto"
                                                 alt="..."
                                                 style="width: 200px; height: auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center" style="color: black;">
                            <div class="col-md-auto p-2">
                                <p class="mb-0 fs-1 font-weight-bold">
                                    {{ round($product->comments->average('rating'), 1) }}
                                </p>
                            </div>
                            <div class="col-md-auto my-auto p-2">
                                <div class="fs-5" style="color: #FFB700">
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
                            </div>
                            <div class="col-md-auto my-auto p-2">
                                <p class="mb-0 fs-6">
                                    ({{ $product->comments->count() }} reviews)
                                </p>
                            </div>
                        </div>

                        <div class="row mb-2 d-flex justify-content-start">
                            <hr class="mb-0" style="color: black;">
                            <div class="col-md-auto p-2">
                                <p class="mb-0 fs-2 font-weight-bold" style="color: #1D0C03;">
                                    Reviews
                                </p>
                            </div>
                            <div class="col-md-auto my-auto p-2" style="color: black;">
                                <p class="mb-0 fs-5">
                                    ({{ $product->comments->count() }})
                                </p>
                            </div>
                            <div class="col-md-auto ms-auto my-auto p-2" style="color: black;">
                                <div class="dropdown" style="display: {{ $comments->count() != 0 ? '' : 'none' }};">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort by
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=newest' }}">Newest</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=popular' }}">Popular</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=rating' }}">Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                            <hr style="color: black;">
                        </div>

                        @foreach($comments as $comment)
                            <div class="row mb-3 d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="row mb-3 d-flex justify-content-start">
                                        <div class="col-md-auto my-auto">
                                            <img src="{{ asset('placeholders/dummy-profile-picture.png') }}" alt="...">
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="row">
                                                <p class="mb-0 fs-5" style="color: #2E190D; font-weight: 400;">
                                                    {{ $comment->user->name }}
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="col" style="color: #FFB700">
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
                                        <div class="col-md-auto ms-auto">
                                            <p class="text-secondary mb-0">
                                                {{ date('d/m/y', strtotime($comment->created_at)) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p class="mb-0 fs-5 font-weight-bold" style="color: #2E190D;">
                                            This bag is perfect for me
                                        </p>
                                        <p class="text-secondary">
                                            I was really pleased when I got this in the mail. It’s just as cute as the
                                            picture shows, well-made And a nice lining. I hear compliments on it
                                            everywhere I go. The only one little thing about it that was a deterrent at
                                            first was that it does not open up very wide, but I’ve gotten used to that
                                            now. Also make snap the snaps all the way to cloRead more about review
                                            stating I LOVE THIS BAG!se otherwise things will fall out of your bag. I
                                            bought another for my girlfriend for her birthday And she loved it too.
                                            Also,
                                            the shipment was really quick and packaged really, really nice with a little
                                            bag. Definitely recommend this line.
                                        </p>
                                        <img class="mb-3" src="{{ asset('placeholders/review-1.png') }}" alt="..."
                                             style="width: 180px; height: auto;">
                                    </div>

                                    <div class="row justify-content-start text-secondary fs-6 mb-3">
                                        <div class="col-md-auto my-auto">
                                            <p class="mb-0">Was this review helpful?</p>
                                        </div>
                                        <div class="col-md-auto pr-2 my-auto">
                                            <a href="" class="text-secondary" style="text-decoration: none">
                                                <i class="far fa-thumbs-up"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-auto pl-0 pr-2 my-auto">
                                            {{ $comment->likes->count() }}
                                        </div>
                                        <div class="col-md-auto pr-2 pl-2 my-auto">
                                            <a href="" class="text-secondary" style="text-decoration: none">
                                                <i class="far fa-thumbs-down"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-auto pl-0 pr-2 my-auto">
                                            {{ $comment->dislikes->count() }}
                                        </div>
                                        <div class="col-md-auto pl-2">
                                            <button class="btn btn-sm btn-outline-secondary">
                                                Reply to this comment
                                            </button>
                                        </div>

                                        <div class="row justify-content-center mt-3">
                                            <div class="col-md-10">
                                                <div class="card border-0 p-2"
                                                     style="background: rgba(204, 169, 148, 0.26); border-radius: 5px;">
                                                    <div class="card-body">
                                                        <p class="mb-0">Reply:</p>
                                                        <p class="mb-0">
                                                            Dear Rena, We apologize for your inconvenience. We try to
                                                            present the natural color of the raw materials we use in
                                                            this series.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
