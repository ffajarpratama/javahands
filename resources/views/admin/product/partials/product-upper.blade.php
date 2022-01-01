<div class="row justify-content-center mb-5">
    <div class="col-md-4">
        <div class="card shadow mb-2"
             style="width: 350px; height: 350px; border-radius: 15px; border: 1px solid #E0E0E0;">
            @if(!$product->picture)
                <img src="{{ asset('placeholders/products/product-placeholder.png') }}" class="m-auto" alt="..."
                     style="width: 200px; height: auto">
            @else
                <img src="{{ asset('storage/products/' . $product->picture) }}" class="m-auto" alt="..."
                     style="width: 200px; height: auto">
            @endif
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
            @if($product->discount != 0)
                <div class="col-md-auto pr-0">
                    <p class="fs-4" style="text-decoration: line-through; color: black;">
                        {{ '$' . number_format($product->price) }}
                    </p>
                </div>
            @endif
            <div class="col-md-auto">
                <h5 class="{{ $product->discount != 0 ? 'text-danger' : 'text-gray-900' }} fw-bolder"
                    style="font-size: 30px;">
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
