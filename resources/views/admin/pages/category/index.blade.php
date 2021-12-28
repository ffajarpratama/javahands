@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid py-5">

        @include('admin.pages.product.partials.flash-message')

        <div class="row mb-4">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-jh-primary btn-icon-split">
                    <div class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="text">Add New Category</div>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row row-cols-3 row-cols-md-4 g-4">
                    @foreach($categories as $category)
                        <div class="col">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            {{ $category->name }}
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                     aria-labelledby="dropdownMenuLink" style="">
                                                    <div class="dropdown-header">Action</div>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                                    <form
                                                        action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer small text-right">
                                    {{ $category->products->count() }} Products
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
