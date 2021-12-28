<div class="row justify-content-center mb-5">
    <div class="col-md-10">
        <div class="row justify-content-center">
            <div class="col-md-4 d-inline-flex">
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-jh-primary btn-icon-split mr-2 pl-0">
                    <div class="icon text-white">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-jh-primary mr-2">
                    Edit this product
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                </form>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
