@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <div class="row mt-3 mb-5">
            <div class="col">
                <div class="card border-0" style="background: #1d0c03; border-radius: 15px">
                    <img class="card-img" src="{{ asset('placeholders/products/featured-product.png') }}" style="-webkit-mask-image: -webkit-gradient(linear, right top, left bottom, from(rgba(0, 0, 0, 1)), to(rgba(0, 0, 0, 0))); mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));" alt="featured"/>
                    <div class="card-img-overlay text-white d-flex flex-column justify-content-end p-5">
                        <div class="row align-bottom">
                            <div class="col-md-4">
                                <h2 class="card-title fw-bold">Summertime Bag</h2>
                                <h3 class="fw-bold">$15</h3>
                                <p class="card-text">
                                    Knitted rattan material lasts longer than leather and free from termites
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mb-5">
            <div class="col-md-4">
                <h3 class="fw-bold" style="color: #2E190D;">Featured</h3>
            </div>
            <div class="col-md-4 text-end" style="color: #2E190D;">
                <a href="{{ route('user.products.index', ['category' => 'all_products']) }}" style="text-decoration: none; color: black; font-weight: 500">
                    See All
                </a>
            </div>
        </div>

       <div class="row justify-content-between mb-5">
           @foreach($products as $product)
               <div class="col-md-auto">
                   <a href="" style="text-decoration: none;">
                       <div class="card" style="height: 314px; width: 240px; border: 1px solid #e0e0e0; border-radius: 5px; box-shadow: 0 0 19px -8px rgba(0, 0, 0, 0.29);">
                           <img class="mx-auto" src="{{ asset('products/' . $product->picture) }}" style="width: 85%; height: 314px; object-fit: contain" alt="..."/>
                       </div>
                       <div class="row mt-2 text-start ms-2" style="color: #2E190D;">
                           <p class="px-0 mb-1 fs-6" style="font-weight: 500;">{{ $product->name }}</p>
                           <p class="px-0 mb-0 fs-4" style="font-weight: 800;">
                               {{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}
                           </p>
                       </div>
                   </a>
               </div>
           @endforeach
       </div>
    </div>
@endsection
@section('footer')
    @include('layouts.partials.footer')
@endsection
