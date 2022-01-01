{{--DELETE PRODUCT MODAL--}}
<div class="modal fade" id="deleteProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="deleteProductModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="row g-0 justify-content-end">
                <button type="button" class="btn-close my-3 me-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="d-flex flex-row justify-content-center p-3">
                <p class="mb-0 fs-30-px fw-700 text-danger">Delete product?</p>
            </div>
            <div class="d-flex flex-row justify-content-end p-3">
                <button class="btn btn-outline-secondary me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--END DELETE PRODUCT MODAL--}}
