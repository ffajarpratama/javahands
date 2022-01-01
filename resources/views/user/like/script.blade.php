<script>
    //LIKE AND UNLIKE COMMENT SCRIPT
    $('.like-btn').each(function () {
        $(this).click(function () {
            const comment_id = $(this).data('content');
            const like_button = $(this);
            const like_icon = like_button.find('i');
            let like_counter = $('.like-counter-' + comment_id);

            axios.post('/user/likes/' + comment_id)
                .then((response) => {
                    //like comment
                    if (like_button.attr('data-liked') === '0') {
                        like_icon.removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
                        like_button.attr('data-liked', '1')

                        //unlike comment
                    } else {
                        like_icon.removeClass('fas fa-thumbs-up').addClass('far fa-thumbs-up');
                        like_button.attr('data-liked', '0');
                    }

                    const likes_count = response.data;
                    like_counter.text(likes_count);
                }).catch((error) => {
                    if (error.response.status === 401) {
                        alert('Please log in first!');
                    }
                });
        });
    });
    //END LIKE AND UNLIKE COMMENT SCRIPT

    //DISLIKE AND UN-DISLIKE COMMENT SCRIPT
    $('.dislike-btn').each(function () {
        $(this).click(function () {
            const comment_id = $(this).data('content');
            const dislike_button = $(this);
            const dislike_icon = dislike_button.find('i');
            let dislike_counter = $('.dislike-counter-' + comment_id);

            axios.post('/user/dislikes/' + comment_id)
                .then((response) => {
                    //dislike comment
                    if (dislike_button.attr('data-disliked') === '0') {
                        dislike_icon.removeClass('far fa-thumbs-down').addClass('fas fa-thumbs-down');
                        dislike_button.attr('data-disliked', '1')

                        //un-dislike comment
                    } else {
                        dislike_icon.removeClass('fas fa-thumbs-down').addClass('far fa-thumbs-down');
                        dislike_button.attr('data-disliked', '0');
                    }

                    const dislikes_count = response.data;
                    dislike_counter.text(dislikes_count);
                }).catch((error) => {
                if (error.response.status === 401) {
                    alert('Please log in first!');
                }
            });
        });
    });
    //END DISLIKE AND UN-DISLIKE COMMENT SCRIPT
</script>
