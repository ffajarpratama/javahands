@extends('layouts.app')
@section('header')
    @include('layouts.partials.header')
@endsection
@section('content')
    <div class="container p-5 mb-5">
        <div class="d-flex flex-row mb-3">
            {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('about') }}
        </div>

        <div class="row g-0 text-center justify-content-center mb-3">
            <div class="col">
                <p class="mb-0 fw-700 fs-0 text-black">
                    About Us
                </p>
            </div>
        </div>

        <div class="row g-0 mb-5">
            <div class="col text-center px-5">
                <p class="text-black mb-0 fs-24-px fw-400 px-5">
                    We were born in a special province that rich in culture, D.I. Yogyakarta, Indonesia,
                    which is located on the island of Java. Javahands is made to connect Indonesian
                    handicraft artisan to world. Javahands is dedicated to bringing the purity of
                    Javanese cultural craftsmanship to the world. Our product is are obtained directly
                    from the artisan to improve their life.
                </p>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center mx-5 mb-5 pt-5 text-black">
            <div class="col-md-5 me-5">
                <img src="{{ asset('placeholders/asset/tugujogja.png') }}" style="max-width: 100%" alt="..." />
            </div>
            <div class="col-md-5 px-2 text-center ms-1">
                <p class="mb-4 fw-700 text-black fs-30-px">Our Story</p>
                <p class="mb-4">
                    Javahands was founded in Yogyakarta, Indonesia. This city is very famous for its
                    culture. this make the handicrafts from artisans in Yogyakarta has a high cultural
                    value.
                </p>
                <p class="mb-0">
                    The idea of Javahands began during the pandemic which made sales of handicrafts drop
                    drastically due to the closure of tourist attractions and export restrictions. Many
                    people who rely on this handicraft sector got difficulties in their lives. We here to
                    help them improve their lives by connect them to global market.
                </p>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center align-items-center mx-5 mb-5 pt-5 text-black">
            <div class="col-md-5 px-2 text-center me-5">
                <p class="mb-4">
                    Javahands is more than a company. We're pioneering the maker to market movement in
                    Yogyakarta. We're trying to connect between market and artisan of handicraft in
                    Yogyakarta.
                </p>
                <p class="mb-0">
                    Our vision is to do business differently, putting our artisans first. That means you
                    can trust that every product you bought from us, directly impacts the life and
                    community of its artisans in Yogyakarta.
                </p>
            </div>
            <div class="col-md-5 ms-1">
                <img src="{{ asset('placeholders/asset/pengrajin.png') }}" style="max-width: 100%" alt="..." />
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center mx-5 mb-5 pt-5 text-black">
            <div class="col-md-5 me-5">
                <img src="{{ asset('placeholders/asset/images 3.png') }}" style="max-width: 100%" alt="..." />
            </div>
            <div class="col-md-5 text-center ms-1">
                <p class="fw-700 text-black fs-30-px">Built on Quality</p>
                <p>
                    All of handmade products that made by our artisans are using authentic raw materials
                    like rattan, leather, hyacinth and other materials. You won't find synthetic in our
                    products. These materials are crafted from scratch until it becomes a product that is
                    ready for sale.
                </p>
                <p class="mb-0">
                    Our artisans are professional and very experienced in their field. That means you can
                    trust that every handmade purchase you bought from us have nice quality. Every
                    product that we sell is made by a human being, and comes with its own character and
                    story to tell.
                </p>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center align-items-center mx-5 mb-5 pt-5 text-black">
            <div class="col-md-5 px-2 text-center me-5">
                <p class="fw-700 text-black fs-30-px">Our Legality</p>
                <p>
                    Javahands is a business that operates under the auspices of the legal company
                    <strong>PT. APRA Nusantara Global</strong> which is very experienced company in the field of exporting
                    commodities from Indonesia. Don't be afraid to transact with us. We guarantee 100%
                    of your safety and comfort in transact with us.
                </p>
            </div>
            <div class="col-md-5 ms-1">
                <img src="{{ asset('placeholders/asset/Group 43.png') }}" style="max-width: 100%" alt="..." />
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center mx-5 mb-5 pt-5 text-black">
            <div class="col-md-5 me-5">
                <img src="{{ asset('placeholders/asset/images 5.png') }}" style="max-width: 100%" alt="..." />
            </div>
            <div class="col-md-5 text-center ms-1">
                <p class="fw-700 text-black fs-30-px">Impact to Community</p>
                <p>
                    So many artisans that involved in this business, They are the reason why our company
                    stand for. We are trying to help improve their life by connecting their products to
                    the world. You can trust that every products you bought from us, directly impacts the
                    life and community of its artisans in Yogyakarta.
                </p>
                <p class="mb-0">
                    Javahands want to preserve the craft tradition and create opportunities for our
                    artisans by bringing their products and stories to the world through long-term, fair
                    trading relationships.
                </p>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
