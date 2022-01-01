<script>
    const addReplyModal = document.getElementById('addReplyModal');
    addReplyModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        addReplyModal.querySelector('#replyForm').action = button.getAttribute('data-bs-url');
    });

    const updateReplyModal = document.getElementById('updateReplyModal')
    updateReplyModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        updateReplyModal.querySelector('#description').textContent = button.getAttribute('data-bs-content')
        updateReplyModal.querySelector('#updateReplyForm').action = button.getAttribute('data-bs-url');
    })
</script>
