<script>
    //CHECK VALUE OF STAR SELECTED
    $(document).on('click', 'div label', function () {
        const that = this;
        setTimeout(function () {
            console.log('checked val=', $(that).parent().find("input[type='radio']:checked").val());
        }, 1);
    });

    //ADD COMMENT MODAL SCRIPT
    //get comment modal, masukin ke variable
    const addCommentModal = document.getElementById('addCommentModal');
    //saat modal ditampilkan, jalankan function
    addCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        //ambil value dari attribute data-bs-url yang ada di button modal
        //masukin value/url ke attribute action di form dengan id commentForm
        addCommentModal.querySelector('#commentForm').action = button.getAttribute('data-bs-url');
    });

    //EDIT COMMENT MODAL SCRIPT
    //get update comment modal, masukin ke variable
    const updateCommentModal = document.getElementById('updateCommentModal');
    //saat modal ditampilkan, jalankan function
    updateCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        //ambil title comment dari attribute data-bs-title
        updateCommentModal.querySelector('#title').value = button.getAttribute('data-bs-title');
        //ambil description comment dari attribute data-bs-description
        updateCommentModal.querySelector('#description').textContent = button.getAttribute('data-bs-description');

        //ambil tag img di modal, masukin ke variable
        let picture_thumbnail = updateCommentModal.querySelector('#picture-thumbnail');
        //set img src = null
        picture_thumbnail.src = null;
        //set img src = path ke gambar comment
        picture_thumbnail.src = `{!! asset('storage/comments') !!}` + '/' + button.getAttribute('data-bs-picture');
        $('#picture-thumbnail').attr('src', picture_thumbnail.src);

        //update rating
        $('input[name="rating_edit"]:checked').prop('checked', false);
        const rating_value = button.getAttribute('data-bs-rating');
        $('input[name="rating_edit"][value="' + rating_value + '"]').prop('checked', true);

        //ambil value dari attribute data-bs-url
        //masukin value/url ke attribute action di form dengan id updateCommentForm
        updateCommentModal.querySelector('#updateCommentForm').action = button.getAttribute('data-bs-url');
    });

    //DELETE COMMENT MODAL SCRIPT
    //get delete comment moadal, masukin ke variable
    const deleteCommentModal = document.getElementById('deleteCommentModal');
    //saat modal ditampilkan, jalankan function
    deleteCommentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        //ambil value dari data-bs-url
        //masukin value/url ke attribute action di form dengan id deleteCommentForm
        deleteCommentModal.querySelector('#deleteCommentForm').action = button.getAttribute('data-bs-url');
    });
</script>
