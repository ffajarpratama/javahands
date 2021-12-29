@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid py-5">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Add New Product</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="name">Product Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               class="form-control text-secondary @error('name') is-invalid @enderror"
                                               name="name" id="name" required>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col md-3 col-form-label">
                                        <label for="categories">Product Categories</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="categories[]" id="categories"
                                                class="form-control select2-dropdown-multiple" multiple>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="picture" class="form-label">Picture</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input name="picture"
                                               class="form-control form-control @error('picture') is-invalid @enderror"
                                               id="picture" type="file" required>
                                    </div>
                                    @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="price">Price ($)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               class="form-control text-secondary @error('price') is-invalid @enderror"
                                               name="price" id="price" required>
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="discount">Discount (%)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               class="form-control text-secondary @error('discount') is-invalid @enderror"
                                               name="discount" id="discount" required>
                                    </div>
                                    @error('discount')
                                    <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="description">Description</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea
                                            class="form-control text-secondary @error('description') is-invalid @enderror"
                                            name="description" required
                                            id="description" cols="30" rows="5"
                                            style="resize: none;"></textarea>
                                    </div>
                                    @error('description')
                                    <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="row mb-3 text-right">
                                    <div class="col">
                                        <a href="{{ route('admin.products.index', ['category' => 'all_products']) }}"
                                           class="btn btn-outline-secondary">
                                            Back
                                        </a>

                                        <button class="btn btn-jh-primary" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
