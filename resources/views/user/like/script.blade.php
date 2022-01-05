<script>
    //LIKE AND UNLIKE COMMENT SCRIPT
    //saat like diklik, jalankan function
    $('.like-btn').each(function () {
        $(this).click(function () {
            //ambil comment_id dari attribute data-content di button dengan class like-btn
            const comment_id = $(this).data('content');
            //ambil like_button
            const like_button = $(this);
            //ambil icon untuk like button
            const like_icon = like_button.find('i');
            //ambil tag p dengan class like-counter-{id comment}
            let like_counter = $('.like-counter-' + comment_id);

            //kirim request axios dengan method POST ke url: /likes/{id comment}
            //url: /likes/{id comment} make method like($comment_id) di LikeController
            axios.post('/likes/' + comment_id)
            //jalankan function saat response diberikan url
                .then((response) => {
                    //like comment
                    //cek attribute data-liked pada like button apakah 0 atau 1
                    //kalo 0
                    if (like_button.attr('data-liked') === '0') {
                        //ganti icon like button
                        like_icon.removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
                        //set data-liked = 1
                        like_button.attr('data-liked', '1')

                        //unlike comment
                    } else {
                        //saat tombol like diklik lagi
                        //ganti icon like button
                        like_icon.removeClass('fas fa-thumbs-up').addClass('far fa-thumbs-up');
                        //set data-liked = 0
                        like_button.attr('data-liked', '0');
                    }

                    //update likes count berdasarkan response data yang diberikan url
                    const likes_count = response.data;
                    //set text like_counter = likes count
                    like_counter.text(likes_count);
                }).catch((error) => {
                    //cek apakah user yang belum login klik like button
                    //cek apakah response status yang diberikan adalah 401/unauthorized
                    if (error.response.status === 401) {
                        //show alert
                        alert('Please log in first!');
                    }
                });
        });
    });
    //END LIKE AND UNLIKE COMMENT SCRIPT

    //DISLIKE AND UN-DISLIKE COMMENT SCRIPT
    //saat dislike diklik, jalankan function
    $('.dislike-btn').each(function () {
        $(this).click(function () {
            //ambil comment_id dari attribute data-content di button dengan class dislike-btn
            const comment_id = $(this).data('content');
            //ambil dislike_button
            const dislike_button = $(this);
            //ambil icon untuk dislike button
            const dislike_icon = dislike_button.find('i');
            //ambil tag p dengan class dislike-counter-{id comment}
            let dislike_counter = $('.dislike-counter-' + comment_id);

            //kirim request axios dengan method POST ke url: /dislikes/{id comment}
            //url: /dislikes/{id comment} make method dislike($comment_id) di DislikeController
            axios.post('/dislikes/' + comment_id)
            //jalankan function saat response diberikan url
                .then((response) => {
                    //dislike comment
                    //cek attribute data-disliked pada dislike button apakah 0 atau 1
                    //kalo 0
                    if (dislike_button.attr('data-disliked') === '0') {
                        //ganti icon dislike button
                        dislike_icon.removeClass('far fa-thumbs-down').addClass('fas fa-thumbs-down');
                        //set data-disliked = 1
                        dislike_button.attr('data-disliked', '1')

                        //un-dislike comment
                    } else {
                        //saat tombol dislike diklik lagi
                        //ganti icon dislike button
                        dislike_icon.removeClass('fas fa-thumbs-down').addClass('far fa-thumbs-down');
                        //set data-disliked = 0
                        dislike_button.attr('data-disliked', '0');
                    }

                    //update dislikes count berdasarkan response data yang diberikan url
                    const dislikes_count = response.data;
                    //set text dislike_counter = likes count
                    dislike_counter.text(dislikes_count);
                }).catch((error) => {
                    //cek apakah user yang belum login klik dislike button
                    //cek apakah response status yang diberikan adalah 401/unauthorized
                if (error.response.status === 401) {
                    //show alert
                    alert('Please log in first!');
                }
            });
        });
    });
    //END DISLIKE AND UN-DISLIKE COMMENT SCRIPT
</script>
