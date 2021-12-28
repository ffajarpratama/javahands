<div class="row justify-content-center mb-4">
    <div class="col-md-10">
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
</div>
