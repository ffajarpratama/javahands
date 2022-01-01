<div class="modal fade" id="addCommentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d-flex flex-row justify-content-end align-items-center p-3">
                <button type="button" class="btn-close mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="commentForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body p-5 mb-3">
                    <div class="d-flex flex-row justify-content-center align-items-center mb-3">
                        <p class="mb-0 text-jh-darker fs-30-px fw-600">
                            Write a Review
                        </p>
                    </div>

                    <div class="row g-0">
                        <p class="mb-0 text-black fs-12-px fw-600">
                            Score <sup class="text-danger">*</sup>
                        </p>
                    </div>

                    <div class="d-flex flex-row justify-content-between mb-3">
                        <div class="rating">
                            <input type="radio" id="5star" name="rating" value="5" />
                            <label class="full" for="5star" title="Excellent"></label>

                            <input type="radio" id="4star" name="rating" value="4" />
                            <label class="full" for="4star" title="Pretty good"></label>

                            <input type="radio" id="3star" name="rating" value="3" />
                            <label class="full" for="3star" title="Ok"></label>

                            <input type="radio" id="2star" name="rating" value="2" />
                            <label class="full" for="2star" title="Bad"></label>

                            <input type="radio" id="1star" name="rating" value="1" />
                            <label class="full" for="1star" title="Umm"></label>
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
