@extends('layouts.app')
@section('content')
    <div class="container p-5 mb-5">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

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

            <div class="row g-0 justify-content-between">
                <div class="col-md-auto me-3">
                    <div class="card product-details-card mb-1">
                        <img src="{{ asset('placeholders/products/product-placeholder.png') }}"
                             class="m-auto product-details-img" alt="...">
                    </div>

                    <label class="text-bistre fs-7 fw-700 mb-1" for="picture">Add Picture</label>
                    <input name="picture"
                           class="form-control text-secondary form-control @error('picture') is-invalid @enderror"
                           id="picture" type="file">

                    @error('picture')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="col-md-7">
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="col-md-3">
                            <p class="fs-5 fw-700 text-bistre mb-0 px-0">Product Details</p>
                        </div>
                        <div class="col">
                            <hr>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-bistre fs-7 fw-700 mb-1" for="name">Name</label>
                        <input type="text"
                               class="form-control text-secondary @error('name') is-invalid @enderror"
                               name="name" id="name" value="{{ old('name') }}">

                        @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-bistre fs-7 fw-700 mb-1" for="categories">Select Categories</label>
                        <select name="categories[]" id="categories"
                                class="form-control select2-dropdown-multiple" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-bistre fs-7 fw-700 mb-1" for="price">Price ($)</label>
                        <input type="text"
                               class="form-control text-secondary @error('price') is-invalid @enderror"
                               name="price" id="price" value="{{ old('price') }}">

                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="text-bistre fs-7 fw-700 mb-1">Discount (%)</label>
                        <input type="text"
                               class="form-control text-secondary @error('discount') is-invalid @enderror"
                               name="discount" id="discount" value="{{ old('discount') }}">

                        @error('discount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="col-md-auto me-3">
                            <p class="fs-5 fw-700 text-bistre mb-0 px-0">Product Description</p>
                        </div>
                        <div class="col">
                            <hr>
                        </div>
                    </div>

                    <div class="d-flex flex-row mb-3">
                        <div class="col-md-3 col-form-label">
                            <label class="fs-7 text-bistre fw-700" for="material">Materials</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text"
                                   class="form-control text-secondary @error('material') is-invalid @enderror"
                                   name="material" id="material" value="{{ old('material') }}" required>
                        </div>
                        @error('material')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row mb-3">
                        <div class="col-md-3 col-form-label">
                            <label class="fs-7 text-bistre fw-700" for="measurement">Measurements</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text"
                                   class="form-control text-secondary @error('measurement') is-invalid @enderror"
                                   name="measurement" id="measurement" value="{{ old('measurement') }}" required>

                            <small class="fs-12-px text-secondary">*Please provide detailed measurements whether in
                                centimetres or inches!</small>
                        </div>
                        @error('measurement')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row mb-3">
                        <div class="col-md-3 col-form-label">
                            <label class="fs-7 text-bistre fw-700" for="description">Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control text-secondary @error('description') is-invalid @enderror"
                                      name="description" required id="description" cols="30" rows="5"
                                      style="resize: none;">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row mb-3">
                        <div class="col-md-3 col-form-label">
                            <label class="fs-7 text-bistre fw-700" for="additional_note">Additional Notes</label>
                        </div>
                        <div class="col-md-9">
                            <textarea
                                class="form-control text-secondary @error('additional_note') is-invalid @enderror"
                                name="additional_note" required id="additional_note" cols="30" rows="5"
                                style="resize: none;">{{ old('additional_note') }}</textarea>

                            <small class="fs-12-px text-secondary">*Please provide more information regarding the product if
                                necessary!</small>
                        </div>
                        @error('additional_note')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-row justify-content-end my-5">
                        <a href="{{ route('products.index', ['category' => 'all_products']) }}"
                           class="btn btn-outline-secondary me-3">
                            Back
                        </a>

                        <button class="btn btn-jh-primary" type="submit">
                            Submit
                            <i class="fas fa-check ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        //select2 multiple dropdown
        $('.select2-dropdown-multiple').select2();
    </script>
@endsection
