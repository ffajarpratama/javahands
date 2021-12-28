@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pb-5">
        @include('admin.pages.product.partials.flash-message')

       @include('admin.pages.product.partials.product-buttons', ['product' => $product])

        <div class="row justify-content-center">
            <div class="col-md-10">

                @include('admin.pages.product.partials.product-upper', ['product' => $product])

                <div class="row justify-content-center">
                    <div class="col-md-10 text-white fw-light">

                        @include('admin.pages.product.partials.product-middle', ['product' => $product])
                        @include('admin.pages.product.partials.product-lower', ['product' => $product])

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.pages.product.partials.modals.create')
    @include('admin.pages.product.partials.modals.edit')

@endsection
@section('script')
   @include('admin.pages.product.partials.modals.scripts.store-and-update')
@endsection
