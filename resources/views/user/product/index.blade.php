@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <h3>Product Categories</h3>
                <a href="{{ route('user.products.index') }}">All Products {{ $allProductCount }}</a> <br>
                @foreach($categories as $category)
                    <a href="{{ route('user.products.get_by_category', $category->name) }}">{{ $category->name }} {{ $category->products->count() }}</a> <br>
                @endforeach
            </div>
            <div class="col-md-9">
                <table class="table table-hover table-bordered" aria-describedby="products_table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>{{ round($product->comments->average('rating'), 1) }}</td>
                            <td style="width: 10%;">
                                @foreach($product->categories as $category)
                                    <span class="badge bg-primary">
                                                {{ $category->name }}
                                            </span>
                                @endforeach
                            </td>
                            <td style="width: 55%;">
                                @foreach($product->comments as $comment)
                                    <ol class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $comment->description }}</div>
                                                Rating: {{ $comment->rating }}, Likes: {{ $comment->likes->count() }},
                                                Dislikes: {{ $comment->dislikes->count() }}
                                            </div>
                                        </li>
                                    </ol>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
