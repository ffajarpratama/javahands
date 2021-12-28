@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid py-5">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <div class="card shadow mb-2"
                                 style="width: 350px; height: 350px; border-radius: 15px; border: 1px solid #E0E0E0;">
                                <img src="{{ asset('products/' . $product->picture) }}" class="m-auto" alt="..."
                                     style="width: 200px; height: auto">
                            </div>

                            <label class="font-weight-bold" for="picture">Update Picture</label>
                            <input name="picture"
                                   class="form-control form-control @error('picture') is-invalid @enderror"
                                   id="picture" type="file">

                            @error('picture')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-7">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="font-weight-bold" for="name">Name</label>
                                    <input type="text"
                                           class="form-control text-secondary @error('name') is-invalid @enderror"
                                           name="name" id="name" value="{{ $product->name }}">

                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="font-weight-bold" for="categories">Select Categories</label>
                                    <select name="categories[]" id="categories"
                                            class="form-control select2-dropdown-multiple" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->categories->contains($category) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="font-weight-bold" for="price">Price ($)</label>
                                    <input type="text"
                                           class="form-control text-secondary @error('price') is-invalid @enderror"
                                           name="price" id="price" value="{{ $product->price }}">

                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="discounted_price" class="font-weight-bold">Discounted Price ($)</label>
                                    <input type="text" class="form-control text-secondary" name="discounted_price"
                                           id="discounted_price" disabled
                                           value="{{ '$' . number_format($product->price - ($product->price * ($product->discount / 100))) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="discount" class="font-weight-bold">Discount (%)</label>
                                    <input type="text"
                                           class="form-control text-secondary @error('discount') is-invalid @enderror"
                                           name="discount" id="discount" value="{{ $product->discount }}">

                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="font-weight-bold">Description</label>
                                    <textarea
                                        class="form-control text-secondary @error('description') is-invalid @enderror"
                                        name="description" id="description" cols="30" rows="5"
                                        style="resize: none;">{{ $product->description }}</textarea>

                                    @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col text-right">
                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                       class="btn btn-outline-secondary">
                                        Back
                                    </a>

                                    <button class="btn btn-jh-primary" type="submit">
                                        Save
                                    </button>
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
