{{--EDIT PROFILE MODAL--}}
<div class="modal fade" id="editProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d-flex flex-row justify-content-between align-items-center pt-3 px-5 mt-3">
                <p class="mb-0 text-jh-darker fs-30-px fw-600">
                    Update your Profile
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editProfileForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body pt-0 px-5 pb-5 mb-3">

                    <hr style="color: #C4C4C4; border-radius: 2px; height: 2px;">

                    <div class="row g-0 mb-3">
                        <div class="col-md-6 pe-1">
                            <label for="first_name" class="fs-7 fw-600">
                                First Name <sup class="text-danger">*</sup>
                            </label>
                            <input id="first_name" type="text"
                                   class="fs-7 text-secondary form-control @error('first_name') is-invalid @enderror" name="first_name"
                                   value="{{ $user->first_name }}" required autocomplete="first_name">

                            @error('first_name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 ps-1">
                            <label for="last_name" class="fs-7 fw-600">
                                Last Name <sup class="text-danger">*</sup>
                            </label>
                            <input id="last_name" type="text"
                                   class="fs-7 text-secondary form-control @error('last_name') is-invalid @enderror" name="last_name"
                                   value="{{ $user->last_name }}" required autocomplete="last_name">

                            @error('last_name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-0">
                        <label for="title" class="mb-0 text-black fs-12-px fw-600">
                            Title <sup class="text-danger">*</sup>
                        </label>
                    </div>

                    <div class="row g-0 mb-3">
                        <input type="text" class="form-control fs-12-px" name="title" id="title" required
                               placeholder="Add title for comment">
                    </div>

                    <div class="row g-0">
                        <label for="description" class="mb-0 fs-12-px text-black fw-600">
                            Review <sup class="text-danger">*</sup>
                        </label>
                    </div>

                    <div class="row g-0 mb-3">
                        <textarea name="description" id="description" class="form-control fs-12-px" required
                                  style="resize: none" cols="30" rows="5" placeholder="Add review"></textarea>
                    </div>

                    <div class="row g-0">
                        <label for="picture" class="mb-0 fs-12-px text-black fw-600">
                            Add Picture <sup class="text-danger">*</sup>
                        </label>
                    </div>

                    <div class="row g-0 mb-5">
                        <input type="file" name="picture" id="picture" class="form-control fs-12-px text-secondary"
                               required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-jh-secondary py-3 fs-6 fw-600">
                            Post Comment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--END EDIT PROFILE MODAL--}}
