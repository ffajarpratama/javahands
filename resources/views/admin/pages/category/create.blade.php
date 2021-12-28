@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid py-5">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Add New Category</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-3 col-form-label">
                                        <label for="name">Category Name</label>
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

                                <div class="row mb-3 text-right">
                                    <div class="col">
                                        <a href="{{ route('admin.categories.index') }}"
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
