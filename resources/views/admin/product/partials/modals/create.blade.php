<div class="modal fade" id="addReplyModal" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="addReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="replyForm" action="" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="description" class="mb-3 fw-700 text-jh-dark">Add reply to this comment</label>
                        <textarea name="description" id="description" class="form-control"
                                  style="resize: none" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-jh-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
