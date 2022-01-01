<script>
    //CHECK VALUE OF STAR SELECTED
    $(document).on('click', 'div label', function () {
        const that = this;
        setTimeout(function () {
            console.log('checked val=', $(that).parent().find("input[type='radio']:checked").val());
        }, 1);
    });

    //ADD COMMENT MODAL SCRIPT
    const addCommentModal = document.getElementById('addCommentModal');
    addCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        addCommentModal.querySelector('#commentForm').action = button.getAttribute('data-bs-url');
    });

    //EDIT COMMENT MODAL SCRIPT
    const updateCommentModal = document.getElementById('updateCommentModal');
    updateCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        updateCommentModal.querySelector('#title').value = button.getAttribute('data-bs-title');
        updateCommentModal.querySelector('#description').textContent = button.getAttribute('data-bs-description');

        let picture_thumbnail = updateCommentModal.querySelector('#picture-thumbnail');
        picture_thumbnail.src = null;
        picture_thumbnail.src = `{!! asset('storage/comments') !!}` + '/' + button.getAttribute('data-bs-picture');
        $('#picture-thumbnail').attr('src', picture_thumbnail.src);

        $('input[name="rating_edit"]:checked').prop('checked', false);
        const rating_value = button.getAttribute('data-bs-rating');
        $('input[name="rating_edit"][value="' + rating_value + '"]').prop('checked', true);

        updateCommentModal.querySelector('#updateCommentForm').action = button.getAttribute('data-bs-url');
    });

    //DELETE COMMENT MODAL SCRIPT
    const deleteCommentModal = document.getElementById('deleteCommentModal');
    deleteCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        deleteCommentModal.querySelector('#deleteCommentForm').action = button.getAttribute('data-bs-url');
    });
</script>
