<div class="card mb-5">
    <div class="card-body"
         style="background: linear-gradient(280.95deg, #2E190D 33.43%, #564134 96.17%); box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.25); border-radius: 10px;">
        <div class="row">
            <div class="col-md-7">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-description" type="button" role="tab"
                                aria-controls="nav-description" aria-selected="true">
                            Description
                        </button>
                        <button class="nav-link" id="nav-confidence-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-confidence" type="button" role="tab" aria-controls="nav-confidence"
                                aria-selected="false">
                            Buy with confidence
                        </button>
                        <button class="nav-link" id="nav-impact-tab" data-bs-toggle="tab" data-bs-target="#nav-impact"
                                type="button" role="tab" aria-controls="nav-impact" aria-selected="false">
                            Impact
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

                        <p>
                            Our handmade handbag that comes with fashionable pattern design. The bag simply adds some
                            ethnic and traditional vibes to any look and offers plenty of space to carry your belongings
                            with its comfort leather shoulder strap..
                        </p>

                        <p>
                            <strong class="fw-bold">Please Note:</strong> The bag is 100% handmade. Therefore, the
                            appearance and the size may vary slightly due to the handcrafted nature of the bag.
                            Furthermore, the color of the inside material may differ.
                        </p>
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
                                Best prices: 100% online-based we have significantly fewer costs than traditional
                                companies.
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
                            We supporting some of Indonesia’s most talented artisans. Our product deserve to be seen and
                            to be appreciated beyond the world not only in tourist attraction in Yogyakarta. The
                            artisans behind them deserve to be properly compensated for their incredible work. It brings
                            us the greatest joy to know that we are empowering Javanese artisans to take control of
                            their future, but also connecting them with buyers who feel a true affinity for their
                            magical work.
                        </p>
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
</div>)

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
